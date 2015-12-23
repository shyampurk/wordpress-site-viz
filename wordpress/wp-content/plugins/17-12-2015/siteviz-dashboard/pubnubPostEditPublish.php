<?php
/*
	We are using 7 function in this page
    This page is related: It will fetch the particular post record from db it containts: posts,categories,tags,counts
    This page will call: In pop method if any post is edited
    This page will call automatically by this way: Through pop call via index2.php using pubnub api
    This page wil call manulaly by this way: No way
    Functions are: 
	function getPosts($pubnub,$whichPost)
	function cleanObject($object)
	function getCategories($pid)
	function getTags($pid)
	function postCount($pid)
*/
ini_set("display_errors", 1);
require_once('lib/autoloader.php');
use Pubnub\Pubnub;
$pubnub = new Pubnub('pub-c-3e92490d-3935-49d6-a2f1-f7f935f88036', 'sub-c-6c450ff2-3ae9-11e5-8579-02ee2ddab7fe');
$data = getPosts($pubnub,$whichPost);
function getPosts($pubnub,$whichPost){
    global $wpdb;  
    $postsCommentsJson = '';
    
    $queryAllPosts = "SELECT viz_posts.id,viz_posts.posts_ID,viz_posts.post_author,viz_posts.post_date,viz_posts.post_date_gmt,viz_posts.post_title,viz_posts.post_status,viz_posts.post_name,viz_posts.post_modified,viz_posts.post_modified_gmt,viz_posts.post_type,viz_posts.comment_count,".$wpdb->prefix."users.user_login  FROM viz_posts , ".$wpdb->prefix."users
    WHERE
    viz_posts.post_type = 'post'
    AND  viz_posts.posts_ID=$whichPost
    AND  ".$wpdb->prefix."users.ID=viz_posts.post_author
    ORDER BY viz_posts.post_date ASC
    ";

    $results = $wpdb->get_results($queryAllPosts);
    if(count($results)>=1){
       $data = '';
        foreach($results as $temp){
            $id = $temp->id;
            $pid = $temp->posts_ID;
            $post_author = $temp->post_author;
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
            
            $categories = getCategories($pid);
            $temp3='';
            if(count($categories)>=1){
                
                foreach($categories as $temp2){
                    $temp3.=$temp2->name.',';
                }
                
                $temp3=substr($temp3,0,-1);
            }
            
            
            
            //tags start
            $tags = getTags($pid);
            $temp4='';
            if(count($tags)>=1){
                
                foreach($tags as $temp2){
                    $temp4.=$temp2->tag.',';
                }
                $temp4=substr($temp4,0,-1);
            }
            //tags close
            
            //post count start
            $postcount = postCount($pid);
            
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
                '"user_login":'. '"'.$user_login.'",'.
                '"post_date":'. '"'.$post_date.'",'.
                '"post_count":'. '"'.$postcount.'",'.
                '"post_title":'. '"'.$post_title.'",'.
                //'"post_content":'. '"'.$post_content.'",'.
                '"post_name":'. '"'.$post_name.'",'.
                '"tags":'. '"'.$temp4.'",'.
                '"categories":'. '"'.$temp3.'"';
            
            
            
            
        }//foreach close
        
        $data='{'.'"result":'.'"Yes",'.'"action":'.'"Edit",'.'"records"'.':['.$data.'}]}';
        $publish_result = $pubnub->publish('demojay',$data);
        
    }else{
    }
}



function cleanObject($object){
    //$val = array("\n","\r");
    $val = array("\r\n", "\n", "\r");
    return $object = str_replace($val, "<br>", $object);
}

function getCategories($pid){
    global $wpdb;
    $query = "SELECT
    name FROM viz_categories WHERE post_id='".$pid."'";
    $results = $wpdb->get_results($query);
    return $results;

}

function getTags($pid){
    global $wpdb;
    $query = "SELECT
    tag FROM viz_tags WHERE post_id='".$pid."'";
    $results = $wpdb->get_results($query);
    return $results;
}

function postCount($pid){
    global $wpdb;
    $query = "SELECT
    count_t FROM viz_postcounts WHERE posts_id='".$pid."'";
    $results = $wpdb->get_results($query);
    return $results;
}
?>