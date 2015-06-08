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
		echo "<hr>";
		echo "<br>ID=".$ID = $temp->ID;
		echo "<br>post_author=".$post_author = $temp->post_author;
		echo "<br>post_date=".$post_date = $temp->post_date;
		echo "<br>post_date_gmt=".$post_date_gmt = $temp->post_date_gmt;
		echo "<br>post_content=".$post_content = $temp->post_content;
		echo "<br>post_title=".$post_title = $temp->post_title;
		echo "<br>post_excerpt=".$post_excerpt = $temp->post_excerpt;
		echo "<br>post_status=".$post_status = $temp->post_status;
		echo "<br>comment_status=".$comment_status = $temp->comment_status;
		echo "<br>ping_status=".$ping_status = $temp->ping_status;
		echo "<br>post_password=".$post_password = $temp->post_password;
		echo "<br>post_name=".$post_name = $temp->post_name;
		echo "<br>to_ping=".$to_ping = $temp->to_ping;
		echo "<br>pinged=".$pinged = $temp->pinged;
		echo "<br>post_modified=".$post_modified = $temp->post_modified;
		echo "<br>post_modified_gmt=".$post_modified_gmt = $temp->post_modified_gmt;
		echo "<br>post_content_filtered=".$post_content_filtered = $temp->post_content_filtered;
		echo "<br>post_parent=".$post_parent = $temp->post_parent;
		echo "<br>guid=".$guid = $temp->guid;
		echo "<br>menu_order=".$menu_order = $temp->menu_order;
		echo "<br>post_type=".$post_type = $temp->post_type;
		echo "<br>post_mime_type=".$post_mime_type = $temp->post_mime_type;
		echo "<br>comment_count=".$comment_count = $temp->comment_count;
		echo "<br>object_id=".$object_id = $temp->object_id;
		echo "<br>term_taxonomy_id=".$term_taxonomy_id = $temp->term_taxonomy_id;
		echo "<br>term_order=".$term_order = $temp->term_order;
		echo "<br>term_id=".$term_id = $temp->term_id;
		echo "<br>taxonomy=".$taxonomy = $temp->taxonomy;
		echo "<br>description=".$description = $temp->description;
		echo "<br>parent=".$parent = $temp->parent;
		echo "<br>count=".$count = $temp->count;


    //checking the duplicate record in db start
    //global $wpdb;
    echo $query = "SELECT COUNT(id) AS total FROM viz_posts
WHERE posts_ID = '".$ID."' LIMIT 0,1
";
  $results = $wpdb->get_results($query);
  echo "<br>Total duplicate=";
  $duplicate = 0;
  echo $duplicate = $results[0]->total;//print_r($results);
  //checking the duplicate record in db close



    //post saving into db table start
  if($duplicate){
    //update
      /*global $wpdb;
      $foobarOptie = $_POST["foobar"];
      $deleteOptie = $_POST["DeleteData"];
      $table = "wp_cool_plugin_options";
      $data_array = array('idOptions' => 1, 'isFoobar' => $foobarOptie, 'DeleteData' => $deleteOptie);
      $where = array('idOptions' => 1);
      $wpdb->update( $table, $data_array, $where );*/

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




	/*
	//ID,post_author,post_date,post_date_gmt,post_content,post_title,post_excerpt,post_status,comment_status,ping_status,post_password,post_name,to_ping,pinged,post_modified,post_modified_gmt,post_content_filtered,post_parent,guid,menu_order,post_type,post_mime_type,comment_count,object_id,term_taxonomy_id,term_order,term_id,taxonomy,description,parent,count
	
	CREATE TABLE `viz_posts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `posts_ID` bigint(20) unsigned NOT NULL COMMENT 'FK',
  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content` longtext NOT NULL,
  `post_title` text NOT NULL,
  `post_excerpt` text NOT NULL,
  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
  `comment_status` varchar(20) NOT NULL DEFAULT 'open',
  `ping_status` varchar(20) NOT NULL DEFAULT 'open',
  `post_password` varchar(20) NOT NULL DEFAULT '',
  `post_name` varchar(200) NOT NULL DEFAULT '',
  `to_ping` text NOT NULL,
  `pinged` text NOT NULL,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_content_filtered` longtext NOT NULL,
  `post_parent` bigint(20) unsigned NOT NULL DEFAULT '0',
  `guid` varchar(255) NOT NULL DEFAULT '',
  `menu_order` int(11) NOT NULL DEFAULT '0',
  `post_type` varchar(20) NOT NULL DEFAULT 'post',
  `post_mime_type` varchar(100) NOT NULL DEFAULT '',
  `comment_count` bigint(20) NOT NULL DEFAULT '0',
  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'wp_term_relationships',
  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'wp_term_relationships',
  `term_order` int(11) NOT NULL DEFAULT '0' COMMENT 'wp_term_relationships',
  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'wp_term_taxonomy',
  `taxonomy` varchar(32) NOT NULL DEFAULT '''''' COMMENT 'wp_term_taxonomy',
  `description` longtext NOT NULL COMMENT 'wp_term_taxonomy',
  `parent` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'wp_term_taxonomy',
  `count` bigint(20) NOT NULL DEFAULT '0' COMMENT 'wp_term_taxonomy',
  PRIMARY KEY (`id`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`posts_ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

*/

}//function close

//code closed