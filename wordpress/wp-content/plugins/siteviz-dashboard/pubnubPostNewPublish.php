<?php
/*
	We are using 7 function in this page
    This page is related: It will fetch the particular post record from db it containts: posts,categories,tags,counts
    This page will call: In pop method on if any post is added
    This page will call automatically by this way: Through pop call via index2.php using pubnub api
    This page wil call manulaly by this way: No way
    Functions are: 
	function getPosts($pubnub,$whichPost)
	function cleanObject($object)
	function getCategories($pid)
	function getTags($pid)
	function postCount($pid)

*/
//categories
ini_set("display_errors", 1);
require_once('classCommon.php');
$common = new common();
require_once('lib/autoloader.php');
use Pubnub\Pubnub;
require_once('commonFunctions.php');
//$common = new common();
$arraySettings = getSettings();
$pubnub_subs_key = $arraySettings[0]->pubnub_subs_key;
$pubnub_pub_key = $arraySettings[0]->pubnub_pub_key;
$pubnub_chanel_name = $arraySettings[0]->pubnub_chanel_name;
$pubnub = new Pubnub($pubnub_pub_key, $pubnub_subs_key);

$data = getPosts($pubnub,$whichPost,$pubnub_chanel_name,$common);
function getPosts($pubnub,$whichPost,$pubnub_chanel_name,$common){
    global $wpdb;  
    $postsCommentsJson = '';
       
    $queryAllPosts = "SELECT viz_posts.id,viz_posts.posts_ID,viz_posts.post_author,
    ".$wpdb->prefix."users.display_name,
viz_posts.post_date,viz_posts.post_date_gmt,viz_posts.post_title,viz_posts.post_status,viz_posts.post_name,viz_posts.post_modified,viz_posts.post_modified_gmt,viz_posts.post_type,viz_posts.comment_count ,".$wpdb->prefix."users.user_login  FROM viz_posts , ".$wpdb->prefix."users
    WHERE viz_posts.post_type = 'post'
    AND  viz_posts.posts_ID=$whichPost
    AND ".$wpdb->prefix."users.ID=viz_posts.post_author
    AND ".$wpdb->prefix."users.id = viz_posts.post_author
    ORDER BY viz_posts.post_date ASC
    ";

    $results = $wpdb->get_results($queryAllPosts);
    if(count($results)>=1){
       $data = '';
        foreach($results as $temp){
            $id = $temp->id;
            $pid = $temp->posts_ID;
            $post_author = $temp->post_author;
            $display_name = $temp->display_name;
            $post_date = $temp->post_date;
            $post_date_gmt = $temp->post_date_gmt;
            //$post_content = $temp->post_content;
            $post_title = $temp->post_title;
            $post_status = $temp->post_status;
            $post_name = $temp->post_name;
            $post_modified = $temp->post_modified;
            $post_modified_gmt = $temp->post_modified_gmt;
            $post_type = $temp->post_type;
            $comment_count = $temp->comment_count;
            //$post_content = cleanObject($post_content);
            //$post_content = addslashes($post_content);
            
            $user_login = $temp->user_login;
            $temp3='';
            
            $categories = $common->getCategories($pid);
            
            
            
            if(count($categories)>=1){
                
                foreach($categories as $temp2){
                    $temp3.=$temp2->name.',';
                }
                
                $temp3=substr($temp3,0,-1);
            }
            
            
            //tags start
            $tags = $common->getTags($pid);
            $temp4='';
            if(count($tags)>=1){
                
                foreach($tags as $temp2){
                    $temp4.=$temp2->tag.',';
                }
                $temp4=substr($temp4,0,-1);
            }
            //tags close
            
            //post count start
            $postcount = $common->postCount($pid);
            if(count($postcount)>=1){
                $postcount = $postcount['0']->count_t;
            }else{
                $postcount = 0;
            }
            //post count close
            
            
            $data.="{".
                '"id":'. '"'.$id.'",'.
                '"pid":'. '"'.$pid.'",'.
                '"post_status":'. '"'.$post_status.'",'.
                '"post_author":'. '"'.$post_author.'",'.
                '"post_author_name":'. '"'.$display_name.'",'.
                '"user_login":'. '"'.$user_login.'",'.
                '"post_date":'. '"'.$post_date.'",'.
                '"post_count":'. '"'.$postcount.'",'.
                '"post_title":'. '"'.$post_title.'",'.
                //'"post_content":'. '"'.$post_content.'",'.
                '"post_name":'. '"'.$post_name.'",'.
                '"tags":'. '"'.$temp4.'",'.
                '"categories":'. '"'.$temp3.'"';
        }//foreach close
        
        $data='{'.'"result":'.'"Yes",'.'"action":'.'"New",'.'"records"'.':['.$data.'}]}';
        $publish_result = $pubnub->publish($pubnub_chanel_name,$data);
    }else{
        
    }
}
?>