<?php
//http://localhost/wordpress/wp-content/plugins/dashboard/getdata.php?action=get_product_serial_callback
@ob_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Max-Age: 604800');
header('Access-Control-Allow-Headers: x-requested-with');
ini_set('html_errors', 0);
define('SHORTINIT', true);



require_once('../../../wp-load.php');

if($_REQUEST['action'] == 'get_product_serial_callback'){

	$data = getPosts();
	//$data='{'.'"records"'.':['.$data.']}';
	//die($data);
}else{
	//echo "Please call me on proper way";
	$output = json_encode(array('result'=>'errorCommon', 'text' => 'Norecords'));
	die($output);
}

function getPosts(){
    global $wpdb;  
    $postsCommentsJson = '';
    /*$queryAllPosts = "SELECT viz_posts.id,viz_posts.posts_ID,viz_posts.post_author,viz_posts.post_date,viz_posts.post_date_gmt,viz_posts.post_content,viz_posts.post_title,viz_posts.post_status,viz_posts.post_name,viz_posts.post_modified,viz_posts.post_modified_gmt,viz_posts.post_type,viz_posts.comment_count FROM viz_posts 
    WHERE viz_posts.post_status = 'publish'
    AND viz_posts.post_type = 'post'
    ORDER BY viz_posts.post_date DESC
    LIMIT 0,1
    ";*/
    $queryAllPosts = "SELECT viz_posts.id,viz_posts.posts_ID,viz_posts.post_author,viz_posts.post_date,viz_posts.post_date_gmt,viz_posts.post_content,viz_posts.post_title,viz_posts.post_status,viz_posts.post_name,viz_posts.post_modified,viz_posts.post_modified_gmt,viz_posts.post_type,viz_posts.comment_count FROM viz_posts 
    WHERE viz_posts.post_status = 'publish'
    AND viz_posts.post_type = 'post'
    ORDER BY viz_posts.post_date DESC
    ";
    $results = $wpdb->get_results($queryAllPosts);
    if(count($results)>1){
       $data = '';
        //echo "<pre>";print_r($results);echo "</pre>";

        foreach($results as $temp){
            $id = $temp->id;
            $pid = $temp->posts_ID;
            $post_author = $temp->post_author;
            $post_date = $temp->post_date;
            $post_date_gmt = $temp->post_date_gmt;
            $post_content = $temp->post_content;
            $post_title = $temp->post_title;
            $post_status = $temp->post_status;
            $post_name = $temp->post_name;
            $post_modified = $temp->post_modified;
            $post_modified_gmt = $temp->post_modified_gmt;
            $post_type = $temp->post_type;
            $comment_count = $temp->comment_count;
            $post_content = cleanObject($post_content);
            
            $temp3='';
            
            $categories = getCategories($pid);
            $temp3='';
            if(count($categories)>=1){
                
                foreach($categories as $temp2){
                    $temp3.=$temp2->name.',';
                }
                //f(count($categories)>=1){
                //}
                $temp3=substr($temp3,0,-1);
            }
            
            $data.="{".
                '"id":'. '"'.$id.'",'.
                '"pid":'. '"'.$pid.'",'.
                '"post_author":'. '"'.$post_author.'",'.
                '"post_date":'. '"'.$post_date.'",'.
                '"post_content":'. '"'.$post_content.'",'.
                '"post_title":'. '"'.$post_title.'",'.
                '"post_name":'. '"'.$post_name.'",'.
                '"categories":'. '"'.$temp3.'",'.
                '"commentsAndMeta":'. '{';

            $commentsFoundForThisPost = false;
            $commentsJson = '';
            if($comment_count){ 
                $comments = getComments($pid);
                //echo "<pre>";print_r($comments);echo "</pre>";
                if(count($comments)>=1){
                   $commentsFoundForThisPost = true;
                   foreach($comments as $temp2){
                     
                       $comment_id = $temp2->comment_id;
                       list($neg,$neutral,$pos,$label) = getSentiment($comment_id);
                       $comment_content = $temp2->comment_content;
                       $comment_author = $temp2->comment_author;
                       $comment_author_email = $temp2->comment_author_email;
                       $comment_date = $temp2->comment_date;
                       $comment_date_gmt = $temp2->comment_date_gmt;
                       $comment_approved = $temp2->comment_approved;
                       $comment_content = cleanObject($comment_content);
                       $commentsJson.= '{'.
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
                        '},';
                       
                   }//foreach close 
                }else if(count($comments)==1){
                    $commentsFoundForThisPost = true;
                    $comment_id = $comments[0]->comment_id;
                    list($neg,$neutral,$pos,$label) = getSentiment($comment_id);
                    $comment_content = $comments[0]->comment_content;
                    $comment_author = $comments[0]->comment_author;
                    $comment_author_email = $comments[0]->comment_author_email;
                    $comment_date = $comments[0]->comment_date;
                    $comment_date_gmt = $comments[0]->comment_date_gmt;
                    $comment_approved = $comments[0]->comment_approved;
                    $commentsJson= '{'.
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
            }//if close
           
            if($commentsFoundForThisPost){
                 $data.='"comment":'.'['.$commentsJson.']';
            }
            $data.='}'.
            '},';
            
            
            
            
        }//foreach close
        //echo "hi123";
        $data=substr($data,0,-1); 
        //$data='['.$data.']'; 
        //die($data);
        //$data='{'.'"records"'.':['.$data.']}';
        $data='{'.'"result":'.'"Yes",'.'"records"'.':['.$data.']}';
        //$data='{'.'"result":'.'"Yes",'.'"records"'.':'.$data.'}';
       // $data='{'.'"records"'.':['.$data.']}';
      
        die($data);
        //echo $data;
        //die($data);
       //$output = json_encode(array('result'=>'errorCommon', 'text' => 'Norecords'));
       //echo $output;

      //$output = json_encode(array('result'=>'yesResult', 'text' => $data));
      //echo $output;
    }else if(count($results)==1){
        $data = '';
        $id = $results[0]->id;
        $pid = $results[0]->posts_ID;
        $post_author = $results[0]->post_author;
        $post_date = $results[0]->post_date;
        $post_date_gmt = $results[0]->post_date_gmt;
        $post_content = $results[0]->post_content;
        $post_content = cleanObject($post_content);
        $post_title = $results[0]->post_title;
        $post_status = $results[0]->post_status;
        $post_name = $results[0]->post_name;
        $post_modified = $results[0]->post_modified;
        $post_modified_gmt = $results[0]->post_modified_gmt;
        $post_type = $results[0]->post_type;
        $comment_count = $results[0]->comment_count;
        
        
            $categories = getCategories($pid);
            
            $temp3='';
            if(count($categories)>=1){
                
                foreach($categories as $temp2){
                    $temp3.=$temp2->name.',';
                }
                //f(count($categories)>=1){
                //}
                $temp3=substr($temp3,0,-1);
            }

        
        $data="{".
            '"id":'. '"'.$id.'",'.
            '"pid":'. '"'.$pid.'",'.
            '"post_author":'. '"'.$post_author.'",'.
            '"post_date":'. '"'.$post_date.'",'.
            '"post_content":'. '"'.$post_content.'",'.
            '"post_title":'. '"'.$post_title.'",'.
            '"post_name":'. '"'.$post_name.'",'.
            '"categories":'. '"'.$temp3.'",'.
            '"commentsAndMeta":'. '{';

            $commentsFoundForThisPost = false;
            $commentsJson = '';
            if($comment_count){ 
                $comments = getComments($pid);
                //echo "<pre>";print_r($comments);echo "</pre>";
                if(count($comments)>1){
                   $commentsFoundForThisPost = true;
                   foreach($comments as $temp2){
                       $comment_id = $temp2->comment_id;
                       list($neg,$neutral,$pos,$label) = getSentiment($comment_id);

                       $comment_content = $temp2->comment_content;
                       $comment_content = cleanObject($comment_content);
                       $comment_author = $temp2->comment_author;
                       $comment_author_email = $temp2->comment_author_email;
                       $comment_date = $temp2->comment_date;
                       $comment_date_gmt = $temp2->comment_date_gmt;
                       $comment_approved = $temp2->comment_approved;
                       
                       $commentsJson.= '{'.
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
                        '},';
                       
                   }//foreach close 
                }else if(count($comments)==1){
                    $commentsFoundForThisPost = true;
                    $comment_id = $comments[0]->comment_id;
                    list($neg,$neutral,$pos,$label) = getSentiment($comment_id);

                    $comment_content = $comments[0]->comment_content;
                    $comment_author = $comments[0]->comment_author;
                    $comment_author_email = $comments[0]->comment_author_email;
                    $comment_date = $comments[0]->comment_date;
                    $comment_date_gmt = $comments[0]->comment_date_gmt;
                    $comment_approved = $comments[0]->comment_approved;
                    $commentsJson= '{'.
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
            }//if close
           
            if($commentsFoundForThisPost){
                 $data.='"comment":'.'['.$commentsJson.']';
            }
            $data.='}'.
            '}';        
            //echo $data='['.$data.']'; 
             $data='{'.'"result":'.'"Yes",'.'"records"'.':['.$data.']}';
             die($data);
            //echo $data;
    }else{
        $output = json_encode(array('result'=>'errorCommon', 'text' => 'Norecords'));
        die($output);
    }
}

function getComments($pid){
    global $wpdb;  
    $queryAllComments = "SELECT
     viz_comments.comment_id,  viz_comments.comment_content,viz_comments.comment_author,viz_comments.comment_author_email,viz_comments.comment_date,viz_comments.comment_date_gmt,viz_comments.comment_approved FROM viz_comments 
WHERE 
viz_comments.posts_ID = $pid
AND viz_comments.comment_approved = '1'
ORDER BY viz_comments.comment_date ASC

";

    $results = $wpdb->get_results($queryAllComments);
    return $results;
}//get Comments close

function cleanObject($object){
    //$val = array("\n","\r");
    $val = array("\r\n", "\n", "\r");
    return $object = str_replace($val, "", $object);
}

function getCategories($pid){
    global $wpdb;
    $query = "SELECT
    name FROM viz_categories WHERE post_id='".$pid."'";
    $results = $wpdb->get_results($query);
    //print_r($results);//die('12');
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
    //print_r($results);//die('12');
    //return array($arrBusiness,$arrMovie,$arrLiveperformaces,$totalSolrResult,$continue);
    //list($arrBusiness,$arrMovie,$arrLiveperformaces,$totalSolrResult,$continue) = $this->solrHref($solrQuery);

}
?>