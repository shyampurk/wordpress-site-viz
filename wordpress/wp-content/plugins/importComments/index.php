<?
/*
Plugin Name: import comments
Plugin URI: http://www.bharatbaba.com
Description:  Plugin to import all comments. Plug n Play.
Author: Jay Bharat/9844542127/jaybharatjay@gmail.com
Version: 2.0/14-June-2015
Author URI: http://www.bharatbaba.com
*/



$importPosts = new importComments();
class importComments{
		public function __construct(){
			//add_action('init', 'importPosts');
			add_action('init', array($this, 'importComments'), 0);
		}
		private function dbTable(){
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
		private function ifDuplicatePost($comment_ID){
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
		private function update($temp){
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
		private function insert($temp){
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
		     $wpdb->insert("viz_posts", array(
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
		    $this->dbTable();
			$results = $this->getWpComments();
			if(count($results)){
			 for($i = 0; $i < count($results); $i++){
		      $comment_id = $results[$i]->comment_ID;
		      $duplicate = $this->ifDuplicatePost($comment_id);
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