<?php
/*
	We are using 4 function in this page
    This page is related: It will save the particular comment id.
    This page will call: In pop method if any comment is added
    This page will call automatically by this way: Through pop call via index2.php using pubnub api
	This is dependent to: pubnub libraray to save comments via pop technology
    This page wil call manulaly by this way: No way
    Functions are: 
	function getPosts($pubnub,$whichPost)
	function cleanObject($object)
	function getCategories($pid)
	function getSentiment($comment_id)
*/
ini_set("display_errors", 1);
require_once('lib/autoloader.php');
use Pubnub\Pubnub;
$pubnub = new Pubnub('pub-c-3e92490d-3935-49d6-a2f1-f7f935f88036', 'sub-c-6c450ff2-3ae9-11e5-8579-02ee2ddab7fe');
$data = getPosts($pubnub,$whichComment);
function getPosts($pubnub,$whichComment){
    global $wpdb;  
    $queryAllComments = "SELECT
     viz_comments.posts_id,  viz_comments.comment_id,  viz_comments.comment_content,viz_comments.comment_author,viz_comments.comment_author_email,viz_comments.comment_date,viz_comments.comment_date_gmt,viz_comments.comment_approved FROM viz_comments 
WHERE 
viz_comments.comment_id = $whichComment
LIMIT 0,1
";
    $comments = $wpdb->get_results($queryAllComments);
    if($comments){
        $data = '';
        $data="{".
            
            '"Type":'. '"Comments",'.
            '"commentsAndMeta":'. '{';
            $commentsJson = '';                
            $commentsFoundForThisPost = false;
            if($comments){
                $commentsFoundForThisPost = true;
                $comment_post_id = $comments[0]->posts_id;
                $comment_id = $comments[0]->comment_id;
                list($neg,$neutral,$pos,$label) = getSentiment($comment_id);

                $comment_content = $comments[0]->comment_content;
                $comment_content = cleanObject($comment_content);
                $comment_author = $comments[0]->comment_author;
                $comment_author_email = $comments[0]->comment_author_email;
                $comment_date = $comments[0]->comment_date;
                $comment_date_gmt = $comments[0]->comment_date_gmt;
                $comment_approved = $comments[0]->comment_approved;
                $commentsJson= '{'.
                       '"comment_post_id":'. '"'.$comment_post_id.'",'.
                       '"comment_content":'. '"'.$comment_content.'",'.
                       '"comment_author":'. '"'.$comment_author.'",'.
                       '"comment_author_email":'. '"'.$comment_author_email.'",'.
                       '"comment_date":'. '"'.$comment_date.'",'.
                       '"comment_date_gmt":'. '"'.$comment_date_gmt.'",'.
                       '"comment_approved":'. '"'.$comment_approved.'",'.
                       '"neg":'. '"'.$neg.'",'.
                       '"neutral":'. '"'.$neutral.'",'.
                       '"pos":'. '"'.$pos.'",'.
                       '"label":'. '"'.$label.'"'.
                       
                    '}';
            }
            if(count($comments)>1){
                $commentsJson=substr($commentsJson,0,-1); 
            }
            if($commentsFoundForThisPost){
                 $data.='"comment":'.'['.$commentsJson.']';
            }
            $data.='}'.
            '}';        
             $data='{'.'"result":'.'"Yes",'.'"records"'.':['.$data.']}';
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

function getSentiment($comment_id){
    global $wpdb;
    $query = "SELECT
    neg,neutral,pos,label FROM viz_sentiment WHERE comment_id='".$comment_id."' LIMIT 0,1";
    $results = $wpdb->get_results($query);
    $neg = '';
    $neutral = '';
    $pos = '';
    $label = '';
    if(count($results)>=1){
        $neg = $results[0]->neg;
        $neutral = $results[0]->neutral;
        $pos = $results[0]->pos;
        $label = $results[0]->label;
    }
    return array($neg,$neutral,$pos,$label);
}
?>