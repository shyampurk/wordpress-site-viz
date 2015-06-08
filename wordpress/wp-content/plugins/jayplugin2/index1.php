<?
/*
Plugin Name: Jay sql query
Plugin URI: http://www.bharatbaba.com
Description:  Jay sql query how to write
Author: Jay Bharat/9844542127/jaybharatjay@gmail.com
Version: 1.0/26-may-2015
Author URI: http://www.bharatbaba.com
*/

function jay_comments($howmany) {
	
  global $wpdb;
  $request = "SELECT ID, comment_ID, comment_content, comment_author, comment_author_url, post_title FROM $wpdb->comments LEFT JOIN $wpdb->posts ON $wpdb->posts.ID=$wpdb->comments.comment_post_ID WHERE post_status IN ('publish','static') ";
	$comments = $wpdb->get_results($request);
	echo "<pre>";print_r($comments);echo "</pre>";
}

function jay_posts($howmany) {

	  global $wpdb;
    $query = "SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->term_relationships ON
($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON
($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->posts.post_status = 'publish'
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->term_taxonomy.term_id = 1
ORDER BY post_date ASC
";

	$results = $wpdb->get_results($query);
	//return $results;
	
	//class/array data to object
	foreach($results as $temp){
    $ID = $temp->ID;
    $post_author = $temp->post_author;
    $post_date = $temp->post_date;
    $post_date_gmt = $temp->post_date_gmt;
    $post_content = $temp->post_content;
    $post_title = $temp->post_title;
    $post_excerpt = $temp->post_excerpt;
    $post_status = $temp->post_status;
    $comment_status = $temp->comment_status;
    $ping_status = $temp->ping_status;
    $post_password = $temp->post_password;
    $post_name = $temp->post_name;
    $to_ping = $temp->to_ping;
    $pinged = $temp->pinged;
    $post_modified = $temp->post_modified;
    $post_modified_gmt = $temp->post_modified_gmt;
    $post_content_filtered = $temp->post_content_filtered;
    $post_parent = $temp->post_parent;
    $guid = $temp->guid;
    $menu_order = $temp->menu_order;
    $post_type = $temp->post_type;
    $post_mime_type = $temp->post_mime_type;
    $comment_count = $temp->comment_count;
    $object_id = $temp->object_id;
    $term_taxonomy_id = $temp->term_taxonomy_id;
    $term_order = $temp->term_order;
    $term_id = $temp->term_id;
    $taxonomy = $temp->taxonomy;
    $description = $temp->description;
    $parent = $temp->parent;
    $count = $temp->count;

    //checking the duplicate record in db start
    //global $wpdb;
    $query = "SELECT COUNT(id) AS total FROM viz_posts
WHERE posts_ID = '".$ID."' LIMIT 0,1
";
  $results = $wpdb->get_results($query);
  $duplicate = 0;
  $duplicate = $results[0]->total;
  //checking the duplicate record in db close

    //post saving into db table start
  if($duplicate){
    //update
      global $wpdb;
      $table = "viz_posts";
      $data_array = array(
        'post_author' => $post_author, 'post_date' => $post_date, 'post_date_gmt' => $post_date_gmt, 
        'post_content' => $post_content, 'post_title' => $post_title, 'post_excerpt' => $post_excerpt, 
        'post_status' => $post_status, 'comment_status' => $comment_status, 'ping_status' => $ping_status,
        'post_password' => $post_password, 'post_name' => $post_name, 'to_ping' => $to_ping
        , 'pinged' => $pinged, 'post_modified' => $post_modified, 'post_modified_gmt' => $post_modified_gmt
        , 'post_content_filtered' => $post_content_filtered, 'post_parent' => $post_parent, 'guid' => $guid
        , 'menu_order' => $menu_order, 'post_type' => $post_type, 'post_mime_type' => $post_mime_type
        , 'comment_count' => $comment_count, 'object_id' => $object_id, 'term_taxonomy_id' => $term_taxonomy_id
        , 'term_order' => $term_order, 'term_id' => $term_id, 'taxonomy' => $taxonomy
        , 'description' => $description, 'parent' => $parent, 'count' => $count
       );
      $where = array('posts_ID' => $ID);
      $wpdb->update( $table, $data_array, $where );
  }else{
    //insert
    global $wpdb;
    $wpdb->insert("viz_posts", array(
     "posts_ID" => $ID,
     "post_author" => $post_author,
     "post_date" => $post_date,
     "post_date_gmt" => $post_date_gmt,
     "post_content" => $post_content,
     "post_title" => $post_title,
     "post_excerpt" => $post_excerpt,
     "post_status" => $post_status ,
     "comment_status" => $comment_status ,
     "ping_status" => $ping_status ,
     "post_password" => $post_password ,
     "post_name" => $post_name ,
     "to_ping" => $to_ping ,
     "pinged" => $pinged ,
     "post_modified" => $post_modified ,
     "post_modified_gmt" => $post_modified_gmt ,
     "post_content_filtered" => $post_content_filtered ,
     "post_date_gmt" => $post_parent ,
     "guid" => $guid ,
     "menu_order" => $menu_order ,
     "post_type" => $post_type ,
     "post_mime_type" => $post_mime_type ,
     "comment_count" => $comment_count ,
     "object_id" => $object_id ,
     "term_taxonomy_id" => $term_taxonomy_id ,
     "term_order" => $term_order ,
     "term_id" => $term_id ,
     "taxonomy" => $taxonomy ,
     "description" => $description ,
     "parent" => $parent ,
     "count" => $count 
  ));
}
//post saving into db table close
		
	}//foreach close
	//return $results;
}//function close

//code closed