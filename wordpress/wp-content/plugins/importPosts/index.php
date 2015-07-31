<?
/*
Plugin Name: siteviz
Plugin URI: http://www.bharatbaba.com
Description:  Plugin to import all the posts,comments, categories. Very simple just plug n play.
Author: Jay Bharat/9844542127/jaybharatjay@gmail.com
Version: 5.0/31-July-2015
Author URI: http://www.bharatbaba.com
*/


$importPosts = new importPostsComments();
class importPostsComments{
		public function __construct(){
			//Hook for adding importPostsComments
			add_action('init', array($this, 'importPosts'), 0);
			add_action('init', array($this, 'importComments'), 0); 
			add_action('init', array($this, 'importSentiment'), 0); 
			
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



		  


		  //table create close
		}//function dbTablePosts close
		
		

		private function getWpPosts(){
			global $wpdb;
			$query = "SELECT $wpdb->posts.ID,$wpdb->posts.post_author,$wpdb->posts.post_date,$wpdb->posts.post_date_gmt,$wpdb->posts.post_content,$wpdb->posts.post_title,$wpdb->posts.post_status,$wpdb->posts.post_name,$wpdb->posts.post_modified,$wpdb->posts.post_modified_gmt,$wpdb->posts.post_type,$wpdb->posts.comment_count FROM $wpdb->posts
		    
		    WHERE $wpdb->posts.post_status = 'publish'
		    AND $wpdb->posts.post_type = 'post'
		    ORDER BY $wpdb->posts.post_date ASC
		    ";
		   
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


		


		  //table create close
		}//function dbTableCategories close
		
		private function dbTableSentiment(){
			//table create start
		    global $wpdb;
		    $charset_collate = $wpdb->get_charset_collate();
		    $table_name='viz_sentiment';
		   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PK',
		  
		  `comment_id` bigint(20) unsigned NOT NULL COMMENT 'FK',
		  
		  `neg` varchar(256) NOT NULL DEFAULT '',
		  `neutral` varchar(256) NOT NULL DEFAULT '',  
		  `pos` varchar(256)  NOT NULL COMMENT '',
		  `label` varchar(256)  NOT NULL COMMENT '',
		  
		  PRIMARY KEY (`id`)
		  
		  ) ENGINE=MyISAM $charset_collate AUTO_INCREMENT=1;";
		  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		  dbDelta( $sql );


		


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
		
		public function importSentiment(){
		
		    $this->dbTableSentiment();
		
    		$results = $this->getWpComments();
    		//print_r($results);
    		
    		if(count($results)){
			 for($i = 0; $i < count($results); $i++){
			  
			    if($results[$i]->comment_approved=='1'){
    		      $comment_content = $results[$i]->comment_content;
    		      $comment_ID = $results[$i]->comment_ID;
    		      
    		      
    		      
    		      //curl start
        	        //$post = "language=english&text='super awesome movie'" ;
        	      
        	        $post = "language=english&text=$comment_content" ;
        
        
                    $headers = array();
                    $headers[] = 'X-Mashape-Key: qMoASitCA6mshhjabj2hxCxq1iDYp1wZgKUjsnI2TgbAhvgJls';
                    $headers[] = 'Content-Type: application/x-www-form-urlencoded';
                    $headers[] = 'Accept: application/json';
                    
                    
                    $ch = curl_init();
                    
                    curl_setopt($ch, CURLOPT_URL, 'https://japerk-text-processing.p.mashape.com/sentiment/');
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
                    //curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post));
                    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                    curl_setopt($ch,CURLOPT_POSTFIELDS, $post);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    
                    $response = curl_exec($ch);
                                                  
                    //curl close
                     $decode = json_decode($response,true);
                    //print_r ($decode);
                    $neg = $decode['probability']['neg'];
                    $neutral = $decode['probability']['neutral'];
                    $pos = $decode['probability']['pos'];
                    $label = $decode['label'];
    
    		      
    		      
                    //start
                    $trueFalseAddEdit = $this->addEditSentiment($comment_ID,$neg,$neutral,$pos,$label);
                    //$results = $this->getViz_sentiment($comment_ID);
        			 
                    //close
                }//if close $results[$i]->comment_approved
		     }//for close
		    }//if close  
		}//function importSentiment close
		
		private function addEditSentiment($comment_ID,$neg,$neutral,$pos,$label){
    		global $wpdb;
    		
		     $query = "SELECT COUNT(id) AS total FROM viz_sentiment
		     WHERE comment_id = '".$comment_ID."' LIMIT 0,1
		     ";
		     $results = $wpdb->get_results($query);
		     $duplicate = 0;
		     $duplicate = $results[0]->total;
		     //return $duplicate;
		     if($duplicate>=1){ 
    		      //update
    		      //global $wpdb;
    		      $table = "viz_sentiment";
    		      $data_array = array(
    		        'neg' => $neg, 
    		        'neutral' => $neutral, 
    		        'pos' => $pos, 
    		        'label' => $label
    		       );
    		      $where = array('comment_id' => $comment_ID);
    		      $wpdb->update( $table, $data_array, $where );
    		      return true;
    		      //update closedir
             }//if close
             else{
                 //add start        		    
        			//global $wpdb;
        		     $wpdb->insert("viz_sentiment", array(
        		     "comment_id" => $comment_ID,
        		     'neg' => $neg, 
        		     'neutral' => $neutral, 
        		     'pos' => $pos, 
        		     'label' => $label
        		     ));
        		     return true;
                 //add close
             }//else close
             return false;
		}//function addEditSentiment close
		
}//class close
//code closed

