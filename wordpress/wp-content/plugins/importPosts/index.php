<?
/*
Plugin Name: import posts
Plugin URI: http://www.bharatbaba.com
Description:  Plugin to import all the posts, plug n play.
Author: Jay Bharat/9844542127/jaybharatjay@gmail.com
Version: 3.0/13-June-2015
Author URI: http://www.bharatbaba.com
*/


// Hook for adding importPosts
//add_action('init', 'importPosts');
$importPosts = new importPosts();
class importPosts{
		public function __construct(){
			//add_action('init', 'importPosts');
					add_action('init', array($this, 'importPosts'), 0);
		}
		private function dbTable(){
			//table create start
		    global $wpdb;
		    $charset_collate = $wpdb->get_charset_collate();
		    $table_name='viz_posts';
		   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PK',
		  `posts_ID` bigint(20) unsigned NOT NULL COMMENT 'FK',
		  `post_author` bigint(20) unsigned NOT NULL DEFAULT '0',
		  `post_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  `post_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  `post_content` longtext NOT NULL,
		  `post_title` text NOT NULL,
		  `post_status` varchar(20) NOT NULL DEFAULT 'publish',
		  `post_name` varchar(200) NOT NULL DEFAULT '',
		  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  `post_modified_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  `post_type` varchar(20) NOT NULL DEFAULT 'post',
		  `comment_count` bigint(20) NOT NULL DEFAULT '0',
		  `object_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'wp_term_relationships',
		  `term_taxonomy_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'wp_term_relationships',
		  `term_order` int(11) NOT NULL DEFAULT '0' COMMENT 'wp_term_relationships',
		  `term_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT 'wp_term_taxonomy',
		  `taxonomy` varchar(32) NOT NULL DEFAULT '''''' COMMENT 'wp_term_taxonomy',
		  `description` longtext NOT NULL COMMENT 'wp_term_taxonomy',
		  `count` bigint(20) NOT NULL DEFAULT '0' COMMENT 'wp_term_taxonomy',
		  PRIMARY KEY (`id`),
		  KEY `post_name` (`post_name`(191)),
		  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`posts_ID`),
		  KEY `post_author` (`post_author`)
		  ) ENGINE=MyISAM $charset_collate AUTO_INCREMENT=1;";
		  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		  dbDelta( $sql );
		  //table create close
		}//function dbTable close
		
		private function getWpPosts(){
			global $wpdb;
			$query = "SELECT $wpdb->posts.ID,$wpdb->posts.post_author,$wpdb->posts.post_date,$wpdb->posts.post_date_gmt,$wpdb->posts.post_content,$wpdb->posts.post_title,$wpdb->posts.post_status,$wpdb->posts.post_name,$wpdb->posts.post_modified,$wpdb->posts.post_modified_gmt,$wpdb->posts.post_type,$wpdb->posts.comment_count,$wpdb->term_relationships.object_id,$wpdb->term_relationships.term_taxonomy_id AS term_taxonomy_id,$wpdb->term_taxonomy.term_taxonomy_id AS term_taxonomy_idb,$wpdb->term_relationships.term_order,$wpdb->term_taxonomy.term_id,$wpdb->term_taxonomy.taxonomy,$wpdb->term_taxonomy.description,$wpdb->term_taxonomy.count  FROM $wpdb->posts
		    LEFT JOIN $wpdb->term_relationships ON
		    ($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		    LEFT JOIN $wpdb->term_taxonomy ON
		    ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
		    WHERE $wpdb->posts.post_status = 'publish'
		    AND $wpdb->term_taxonomy.taxonomy = 'category'
		    AND $wpdb->term_taxonomy.term_id = 1
		    ORDER BY post_date ASC
		    ";
		    //echo "<br>Query=".$query;
		    /*$query = "SELECT * FROM $wpdb->posts
		    LEFT JOIN $wpdb->term_relationships ON
		    ($wpdb->posts.ID = $wpdb->term_relationships.object_id)
		    LEFT JOIN $wpdb->term_taxonomy ON
		    ($wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id)
		    WHERE $wpdb->posts.post_status = 'publish'
		    AND $wpdb->term_taxonomy.taxonomy = 'category'
		    AND $wpdb->term_taxonomy.term_id = 1
		    ORDER BY post_date ASC
		    ";*/
			$results = $wpdb->get_results($query);
			//print_r($results);
			return $results;
		}
		private function ifDuplicatePost($ID){
			//checking the duplicate record in db start
		     global $wpdb;
		     $query = "SELECT COUNT(id) AS total FROM viz_posts
		     WHERE posts_ID = '".$ID."' LIMIT 0,1
		     ";
		     $results = $wpdb->get_results($query);
		     $duplicate = 0;
		     $duplicate = $results[0]->total;
		     return $duplicate;
		     //checking the duplicate record in db close
		
		}
		private function update($temp){
			 //row data start, class/array data to object
		     $ID = $temp->ID;
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
		     $object_id = $temp->object_id;
		     $term_taxonomy_id = '1';//$temp->term_taxonomy_id;
		     $term_order = $temp->term_order;
		     $term_id = $temp->term_id;
		     $taxonomy = $temp->taxonomy;
		     $description = $temp->description;
		     $count = $temp->count;
		     //row data close
		      //update
		      global $wpdb;
		      $table = "viz_posts";
		      $data_array = array(
		        'post_author' => $post_author, 
		        'post_date' => $post_date, 
		        'post_date_gmt' => $post_date_gmt, 
		        'post_content' => $post_content, 
		        'post_title' => $post_title, 
		        'post_status' => $post_status,
		        'post_name' => $post_name,
		        'post_modified' => $post_modified, 
		        'post_modified_gmt' => $post_modified_gmt,
		        'post_type' => $post_type,
		        'comment_count' => $comment_count, 
		        'object_id' => $object_id, 
		        'term_taxonomy_id' => $term_taxonomy_id, 
		        'term_order' => $term_order, 
		        'term_id' => $term_id, 
		        'taxonomy' => $taxonomy, 
		        'description' => $description,
		        'count' => $count
		       );
		      $where = array('posts_ID' => $ID);
		      $wpdb->update( $table, $data_array, $where );
		      return true;
		      //update close
		}//function update close
		private function insert($temp){
			 //row data start, class/array data to object
		     $ID = $temp->ID;
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
		     $object_id = $temp->object_id;
		     $term_taxonomy_id = '1';//$temp->term_taxonomy_id;
		     $term_order = $temp->term_order;
		     $term_id = $temp->term_id;
		     $taxonomy = $temp->taxonomy;
		     $description = $temp->description;
		     $count = $temp->count;
		     //row data close
		    //}//foreach close
			global $wpdb;
		     $wpdb->insert("viz_posts", array(
		     "posts_ID" => $ID,
		     "post_author" => $post_author,
		     "post_date" => $post_date,
		     "post_date_gmt" => $post_date_gmt,
		     "post_content" => $post_content,
		     "post_title" => $post_title,
		     "post_status" => $post_status ,
		     "post_name" => $post_name ,
		     "post_modified" => $post_modified ,
		     "post_modified_gmt" => $post_modified_gmt ,
		     "post_type" => $post_type ,
		     "comment_count" => $comment_count ,
		     "object_id" => $object_id ,
		     "term_taxonomy_id" => $term_taxonomy_id ,
		     "term_order" => $term_order ,
		     "term_id" => $term_id ,
		     "taxonomy" => $taxonomy ,
		     "description" => $description ,
		     "count" => $count 
		     ));
		     return true;
		}//function insert close
		
		public function importPosts($howmany) {
		    $this->dbTable();//exit;
			$results = $this->getWpPosts();
			if(count($results)){
			 for($i = 0; $i < count($results); $i++){
		      $ID = $results[$i]->ID;
		      $duplicate = $this->ifDuplicatePost($ID);
		      if($duplicate){
		       $this->update($results[$i]);
		      }else{
		       $this->insert($results[$i]);
		      }
		     }//for close
		    }//if close  
		}//function importPosts close
}//class close
		//code closed