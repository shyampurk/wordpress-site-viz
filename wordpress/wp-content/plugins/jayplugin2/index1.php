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
	//echo "how=".$howmany;
    //echo 'from plugin';
  //$wpdb->query('select * from my_plugin_table where foo = "bar"');
  global $wpdb;
  $request = "SELECT ID, comment_ID, comment_content, comment_author, comment_author_url, post_title FROM $wpdb->comments LEFT JOIN $wpdb->posts ON $wpdb->posts.ID=$wpdb->comments.comment_post_ID WHERE post_status IN ('publish','static') ";
	//if(!$show_pass_post) $request .= "AND post_password ='' ";
	//$request .= "AND comment_approved = '1' ORDER BY comment_ID DESC LIMIT $no_comments";
	$comments = $wpdb->get_results($request);
	echo "<pre>";print_r($comments);echo "</pre>";
}

function jay_posts($howmany) {


//create table start
//function jal_install () {
   //global $wpdb;

   //$table_name = $wpdb->prefix . "liveshoutbox"; 
//}



global $wpdb;

$charset_collate = $wpdb->get_charset_collate();

$sql = "CREATE TABLE $table_name (
  id mediumint(9) NOT NULL AUTO_INCREMENT,
  time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
  name tinytext NOT NULL,
  text text NOT NULL,
  url varchar(55) DEFAULT '' NOT NULL,
  UNIQUE KEY id (id)
) $charset_collate;";

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
dbDelta( $sql );
echo "I am here";
//create table close








	  global $wpdb;
      $query = "SELECT * FROM $wpdb->posts
LEFT JOIN $wpdb->term_relationships ON
($wpdb->posts.ID = $wpdb->term_relationships.object_id)
LEFT JOIN $wpdb->term_taxonomy ON
($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
WHERE $wpdb->posts.post_status = 'publish'
AND $wpdb->term_taxonomy.taxonomy = 'category'
AND $wpdb->term_taxonomy.term_id = 1
ORDER BY post_date DESC
";

	$results = $wpdb->get_results($query);
	//return $results;
	
	//class/array data to object
	foreach($results as $temp){
		echo "<hr>";
		echo "<br>ID=".$temp->ID;
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
		
	}
	return $results;
	/*
	//ID,post_author,post_date,post_date_gmt,post_content,post_title,post_excerpt,post_status,comment_status,ping_status,post_password,post_name,to_ping,pinged,post_modified,post_modified_gmt,post_content_filtered,post_parent,guid,menu_order,post_type,post_mime_type,comment_count,object_id,term_taxonomy_id,term_order,term_id,taxonomy,description,parent,count
	
	CREATE TABLE `posts` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`ID`),
  KEY `post_name` (`post_name`(191)),
  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`ID`),
  KEY `post_parent` (`post_parent`),
  KEY `post_author` (`post_author`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;*/

}

//code closed