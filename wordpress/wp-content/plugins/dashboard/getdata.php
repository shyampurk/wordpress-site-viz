<?php
//print_r($_REQUEST);
//require_once('index.php');


//@session_start();
@ob_start();
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Max-Age: 604800');
header('Access-Control-Allow-Headers: x-requested-with');
ini_set('html_errors', 0);
define('SHORTINIT', true);


//require_once( ABSPATH . WPINC . '/index.php' );
//require_once(dirname(__FILE__)."index.php");
//require_once( "WP-ROOT-PATH/wp-config.php");
//require_once(plugins_url('dashboard/index.php'));

//echo 'Pul='.dirname(__FILE__);
//require_once(plugins_url('dashboard/index1.php'));
//echo( $wpdb );
//global $wpdb;
//echo 'wpdb2='.$wpdb.'<br>';

/*$pluginpath = plugin_dir_path( __FILE__ );
define('MY_AWESOME_PLUGIN_PATH', $pluginpath);
include(MY_AWESOME_PLUGIN_PATH . 'test1.php');
if( function_exists( 'my_output' ) ) {
    my_output();
}*/



require_once('../../../wp-load.php');

if($_REQUEST['action'] == 'get_product_serial_callback'){
//require_once( '../plugins/dashboard//test1.php');
//require_once(dirname(__FILE__)."test1.php");
//include( plugin_dir_path( __FILE__ ) . 'dashboard/test1.php'); 




//echo "akjgg";
	//echo "I will give you the result";
	
	/*
    	$data.="{".'"id":'.'"'.$id.'"'.",".'"first_name":'.'"'.$first_name.'"'.",".'"added_date":'.'"'.$added_date.'"'.",".'"created_date":'.'"'.$created_date.'"'.",".'"text_content":'.'"'.$text_content.'"'.",".'"media_name":'.'"'.$media_name.'"'.",".'"profile_image":'.'"'.$profileImg.'"'.",".'"type":'.'"'.$diaryType.'"'.",".'"mt":'.'"'.$mediaType.'"'."}".",";
    	
    	if(count($allDiaryContent) > 1){
				$data=substr($data,0,-1); 
			}
	*/
	
	//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
	//$data = json_encode($arr);

	
	
	$data = getPosts();
	$data='{'.'"records"'.':['.$data.']}';
	die($data);
}else{
	//echo "Please call me on proper way";
	$output = json_encode(array('result'=>'errorCommon', 'text' => 'Norecords'));
	die($output);
}

function getPosts(){
    global $wpdb;  
    
     /*echo $queryAllPosts = "SELECT $wpdb->posts.ID,$wpdb->posts.post_author,$wpdb->posts.post_date,$wpdb->posts.post_date_gmt,$wpdb->posts.post_content,$wpdb->posts.post_title,$wpdb->posts.post_status,$wpdb->posts.post_name,$wpdb->posts.post_modified,$wpdb->posts.post_modified_gmt,$wpdb->posts.post_type,$wpdb->posts.comment_count FROM $wpdb->posts 
    WHERE $wpdb->posts.post_status = 'publish'
    AND $wpdb->posts.post_type = 'post'
    ORDER BY $wpdb->posts.post_date ASC
    LIMIT 0,1
    ";*/
    
    echo $queryAllPosts = "SELECT viz_posts.id,viz_posts.posts_ID,viz_posts.post_author,viz_posts.post_date,viz_posts.post_date_gmt,viz_posts.post_content,viz_posts.post_title,viz_posts.post_status,viz_posts.post_name,viz_posts.post_modified,viz_posts.post_modified_gmt,viz_posts.post_type,viz_posts.comment_count FROM viz_posts 
    WHERE viz_posts.post_status = 'publish'
    AND viz_posts.post_type = 'post'
    ORDER BY viz_posts.post_date ASC
    LIMIT 0,10
    ";
    
    $results = $wpdb->get_results($queryAllPosts);
    //$data = json_encode($results);
    //return $data;
    $data = '';
    //echo 'total='.count($results);
    if(count($results)>1){
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
            $data.="{".'"id":'.'"'.$id.'"'.",".'"pid":'.'"'.$pid.'"'.",".'"post_author":'.'"'.$post_author.'"'.",".'"post_date":'.'"'.$post_date.'"'.",".'"post_date_gmt":'.'"'.$post_date_gmt.'"'.",".'"post_content":'.'"'.$post_content.'"'.",".'"post_title":'.'"'.$post_title.'"'.",".'"post_status":'.'"'.$post_status.'"'.",".'"post_name":'.'"'.$post_name.'"'.",".'"post_modified":'.'"'.$post_modified.'"'.",".'"post_modified_gmt":'.'"'.$post_modified_gmt.'"'.",".'"post_type":'.'"'.$post_type.'"'.",".'"comment_count":'.'"'.$comment_count.'"'."}".",";
            
            
            //get Comments start
            $queryAllComments = "SELECT viz_comments.comment_content,viz_comments.comment_author,viz_comments.comment_author_email,viz_comments.comment_date,viz_comments.comment_date_gmt,viz_comments.comment_approved FROM viz_comments 
    WHERE viz_comments.comment_post_ID = $pid
    ORDER BY viz_comments.comment_date ASC
    LIMIT 0,1
    ";
            $results2 = $wpdb->get_results($queryAllComments);
            echo "<pre>";print_r($results2);echo "</pre>";

    /*
            $comment_ID = $temp->comment_ID;
		     $comment_post_ID = $temp->;
		     $comment_content = $temp->;
		     $comment_author = $temp->;
		     $comment_author_email = $temp->;
		      = $temp->;
		     $comment_date_gmt = $temp->;
		     $comment_approved = $temp->;
            //get Comments close
            */
            
            
            
        }//foreach close
        /*(count($allDiaryContent) > 1){
				$data=substr($data,0,-1); 
			}*/
        $data=substr($data,0,-1); 
        return $data;
    }else if(count($results)==1){
            //echo "<pre>";print_r($results);echo "</pre>";
            $id = $results[0]->id;
            $pid = $results[0]->posts_ID;
            $post_author = $results[0]->post_author;
            $post_date = $results[0]->post_date;
            $post_date_gmt = $results[0]->post_date_gmt;
            $post_content = $results[0]->post_content;
            $post_title = $results[0]->post_title;
            $post_status = $results[0]->post_status;
            $post_name = $results[0]->post_name;
            $post_modified = $results[0]->post_modified;
            $post_modified_gmt = $results[0]->post_modified_gmt;
            $post_type = $results[0]->post_type;
            $comment_count = $results[0 ]->comment_count;
            $data.="{".'"id":'.'"'.$id.'"'.",".'"pid":'.'"'.$pid.'"'.",".'"post_author":'.'"'.$post_author.'"'.",".'"post_date":'.'"'.$post_date.'"'.",".'"post_date_gmt":'.'"'.$post_date_gmt.'"'.",".'"post_content":'.'"'.$post_content.'"'.",".'"post_title":'.'"'.$post_title.'"'.",".'"post_status":'.'"'.$post_status.'"'.",".'"post_name":'.'"'.$post_name.'"'.",".'"post_modified":'.'"'.$post_modified.'"'.",".'"post_modified_gmt":'.'"'.$post_modified_gmt.'"'.",".'"post_type":'.'"'.$post_type.'"'.",".'"comment_count":'.'"'.$comment_count.'"'."}";
            return $data;
    }else{
        $output = json_encode(array('result'=>'errorCommon', 'text' => 'Norecords'));
        die($output);
    }
    

	//print_r($results);
	
	//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
	//$data = json_encode($arr);

	
	
	//echo "hi 123";
	
	//$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
	//echo $data = json_encode($arr);
}
?>