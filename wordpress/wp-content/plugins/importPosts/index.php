<?
/*
Plugin Name: import posts and comments
Plugin URI: http://www.bharatbaba.com
Description:  Plugin to import all the posts,comments. Very simple just plug n play.
Author: Jay Bharat/9844542127/jaybharatjay@gmail.com
Version: 4.0/13-June-2015
Author URI: http://www.bharatbaba.com
*/


$importPosts = new importPostsComments();
class importPostsComments{
		public function __construct(){
			//Hook for adding importPostsComments
			add_action('init', array($this, 'importPosts'), 0);
			add_action('init', array($this, 'importComments'), 0); 
			
			
		}
		private function dbTablePosts(){
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
		  
		  PRIMARY KEY (`id`),
		  KEY `post_name` (`post_name`(191)),
		  KEY `type_status_date` (`post_type`,`post_status`,`post_date`,`posts_ID`),
		  KEY `post_author` (`post_author`)
		  ) ENGINE=MyISAM $charset_collate AUTO_INCREMENT=1;";
		  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		  dbDelta( $sql );



		  /*
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
		  */


		  //table create close
		}//function dbTablePosts close
		
		

		private function getWpPosts(){
			global $wpdb;
			$query = "SELECT $wpdb->posts.ID,$wpdb->posts.post_author,$wpdb->posts.post_date,$wpdb->posts.post_date_gmt,$wpdb->posts.post_content,$wpdb->posts.post_title,$wpdb->posts.post_status,$wpdb->posts.post_name,$wpdb->posts.post_modified,$wpdb->posts.post_modified_gmt,$wpdb->posts.post_type,$wpdb->posts.comment_count FROM $wpdb->posts
		    
		    WHERE $wpdb->posts.post_status = 'publish'
		    AND $wpdb->posts.post_type = 'post'
		    ORDER BY $wpdb->posts.post_date ASC
		    ";
		    //echo "<br>Query=".$query;
		    /*
			
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

			----------------------------
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

		    ----------------------


			SELECT * FROM wp_posts
		    LEFT JOIN wp_term_relationships ON
		    (wp_posts.ID = wp_term_relationships.object_id)
		    LEFT JOIN wp_term_taxonomy ON
		    (wp_term_relationships.term_taxonomy_id = wp_term_taxonomy.term_taxonomy_id)
		    WHERE wp_posts.post_status = 'publish'
		    AND wp_term_taxonomy.taxonomy = 'category'
		    AND wp_term_taxonomy.term_id = 1
		    ORDER BY post_date ASC


			-------------------------

		    SELECT *  FROM `wp_posts` WHERE `post_status` LIKE 'publish' AND `post_type`='post'

		    */
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
		private function updatePost($temp){
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
		        'comment_count' => $comment_count
		        
		       );
		      $where = array('posts_ID' => $ID);
		      $wpdb->update( $table, $data_array, $where );
		      return true;
		      //update close
		}//function update close
		private function insertPost($temp){
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
		     "comment_count" => $comment_count 
		    
		     ));
		     return true;
		}//function insert close
		
		public function importPosts($howmany) {
		    $this->dbTablePosts();
			$results = $this->getWpPosts();
			if(count($results)){
			 for($i = 0; $i < count($results); $i++){
		      $ID = $results[$i]->ID;
		      $duplicate = $this->ifDuplicatePost($ID);
		      if($duplicate){
		       $this->updatePost($results[$i]);
		      }else{
		       $this->insertPost($results[$i]);
		      }
		     }//for close
		    }//if close 

		    $this->dbTableCategories();
		    if(count($results)){
		    	for($i = 0; $i < count($results); $i++){
		    	    $ID = $results[$i]->ID;

					$resultsCategories = $this->categoriesForPost($ID);
					$this->updateCategories($resultsCategories,$ID);

		      	}
		    }
		}//function importPosts close

		private function dbTableComments(){
			//table create start
		    global $wpdb;
		    $charset_collate = $wpdb->get_charset_collate();
		    $table_name='viz_comments';
		   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'pk',
		  `posts_id` bigint(20) unsigned NOT NULL,
		  `comment_id` bigint(20) unsigned NOT NULL,
		  `comment_content` text NOT NULL,
		  `comment_author` tinytext NOT NULL,
		  `comment_author_email` varchar(100) NOT NULL,
		  `comment_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  `comment_date_gmt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
		  `comment_approved` varchar(20) NOT NULL,
		  PRIMARY KEY (`id`)
		  ) ENGINE=MyISAM $charset_collate AUTO_INCREMENT=1;";
		  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		  dbDelta( $sql );
		  //table create close
		}//function dbTable close

		private function getWpComments(){
			global $wpdb;
			$query = "SELECT comment_ID, comment_post_ID,  comment_content, comment_author, comment_author_email, comment_date,comment_date_gmt, comment_approved FROM $wpdb->comments ORDER BY  comment_id ASC
		    ";
		   	$results = $wpdb->get_results($query);
			return $results;
		}

		private function ifDuplicateComments($comment_ID){
			//checking the duplicate record in db start
		     global $wpdb;
		     $query = "SELECT COUNT(id) AS total FROM viz_comments
		     WHERE comment_id = '".$comment_ID."' LIMIT 0,1
		     ";
		     $results = $wpdb->get_results($query);
		     $duplicate = 0;
		     $duplicate = $results[0]->total;
		     return $duplicate;
		     //checking the duplicate record in db close
		
		}

		private function updateComments($temp){
			 //row data start, class/array data to object
		     $comment_ID = $temp->comment_ID;
		     $comment_post_ID = $temp->comment_post_ID;
		     $comment_content = $temp->comment_content;
		     $comment_author = $temp->comment_author;
		     $comment_author_email = $temp->comment_author_email;
		     $comment_date = $temp->comment_date;
		     $comment_date_gmt = $temp->comment_date_gmt;
		     $comment_approved = $temp->comment_approved;
		     
		     //row data close
		      //update
		      global $wpdb;
		      $table = "viz_comments";
		      $data_array = array(
		        'posts_id' => $comment_post_ID, 
		        'comment_content' => $comment_content, 
		        'comment_author' => $comment_author, 
		        'comment_author_email' => $comment_author_email, 
		        'comment_date' => $comment_date,
		        'comment_date_gmt' => $comment_date_gmt,
		        'comment_approved' => $comment_approved
		       );
		      $where = array('comment_id' => $comment_ID);
		      $wpdb->update( $table, $data_array, $where );
		      return true;
		      //update close
		}//function update close


		private function insertComments($temp){
			 //row data start, class/array data to object
		     $comment_ID = $temp->comment_ID;
		     $comment_post_ID = $temp->comment_post_ID;
		     $comment_content = $temp->comment_content;
		     $comment_author = $temp->comment_author;
		     $comment_author_email = $temp->comment_author_email;
		     $comment_date = $temp->comment_date;
		     $comment_date_gmt = $temp->comment_date_gmt;
		     $comment_approved = $temp->comment_approved;
		     //row data close
		    //}//foreach close
			global $wpdb;
		     $wpdb->insert("viz_comments", array(
		     "comment_id" => $comment_ID,
		     'posts_id' => $comment_post_ID, 
		     'comment_content' => $comment_content, 
		     'comment_author' => $comment_author, 
		     'comment_author_email' => $comment_author_email, 
		     'comment_date' => $comment_date,
		     'comment_date_gmt' => $comment_date_gmt,
		     'comment_approved' => $comment_approved
		     ));
		     return true;
		}//function insert close

		public function importComments($howmany) {
		    $this->dbTableComments();
			$results = $this->getWpComments();
			if(count($results)){
			 for($i = 0; $i < count($results); $i++){
		      $comment_id = $results[$i]->comment_ID;
		      $duplicate = $this->ifDuplicateComments($comment_id);
		      if($duplicate){
		       $this->updateComments($results[$i]);
		      }else{
		       $this->insertComments($results[$i]);
		      }
		     }//for close
		    }//if close  
		}//function importComments close




		private function dbTableCategories(){
			//table create start
		    global $wpdb;
		    $charset_collate = $wpdb->get_charset_collate();
		    $table_name='viz_categories';
		   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PK',
		  `term_id` bigint(20) unsigned NOT NULL COMMENT 'FK',
		  `post_id` bigint(20) unsigned NOT NULL COMMENT 'FK',
		  
		  `name` varchar(200) NOT NULL DEFAULT '',
		  `slug` varchar(200) NOT NULL DEFAULT '',  
		  `term_group` bigint(10) unsigned NOT NULL COMMENT '',
		  
		  PRIMARY KEY (`id`)
		  
		  ) ENGINE=MyISAM $charset_collate AUTO_INCREMENT=1;";
		  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		  dbDelta( $sql );


		  /*
			SELECT wt.* FROM wp_posts p
 INNER JOIN wp_term_relationships r ON r.object_id=p.ID
 INNER JOIN wp_term_taxonomy t ON t.term_taxonomy_id = r.term_taxonomy_id
 INNER JOIN wp_terms wt on wt.term_id = t.term_id
WHERE p.ID=75 AND t.taxonomy="category"
		  */


		  //table create close
		}//function dbTableCategories close

		private function categoriesForPost($posts_id){
			global $wpdb;
			$query = "SELECT wt.* FROM wp_posts p
 INNER JOIN wp_term_relationships r ON r.object_id=p.ID
 INNER JOIN wp_term_taxonomy t ON t.term_taxonomy_id = r.term_taxonomy_id
 INNER JOIN wp_terms wt on wt.term_id = t.term_id
WHERE p.ID=$posts_id AND t.taxonomy='category'
		    ";
		   	$resultsCategories = $wpdb->get_results($query);
			return $resultsCategories;
		}//function categoriesForPost close

		private function updateCategories($resultsCategories,$postID){
			//delete present categories for crossponding postID
			$table_name='viz_categories';
			$qry = "DELETE FROM $table_name WHERE post_id=$postID";
			global $wpdb;
			$wpdb->query($qry);
			//delete close

			foreach($resultsCategories as $temp){
			     $term_id = $temp->term_id;
			     $post_id = $postID;
			     $name = $temp->name;
			     $slug = $temp->slug;
			     $term_group = $temp->term_group;
		    }//foreach close

			//global $wpdb;
		     $wpdb->insert($table_name, array(
		     "term_id" => $term_id,
		     "post_id" => $post_id,
		     "name" => $name,
		     "slug" => $slug,
		     "term_group" => $term_group
		     ));
		     return true;
		}//function categoriesForPost close

}//class close
//code closed

/*
SELECT wt.* FROM wp_posts p
 INNER JOIN wp_term_relationships r ON r.object_id=p.ID
 INNER JOIN wp_term_taxonomy t ON t.term_taxonomy_id = r.term_taxonomy_id
 INNER JOIN wp_terms wt on wt.term_id = t.term_id
WHERE p.ID=1 AND t.taxonomy="category"
*/

