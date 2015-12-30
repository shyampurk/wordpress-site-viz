<?
/*
Plugin Name: siteviz
Plugin URI: http://www.bharatbaba.com
Description:  Plugin to import all the posts,comments, categories. Very simple just plug n play.
Author: Jay Bharat/9844542127/jaybharatjay@gmail.com
Version: 5.0/31-July-2015
Author URI: http://www.bharatbaba.com
*/

/*
	We are using 44 function in this page
    This page is related: This page will act when any action happen for post and comments
    This page will call: Automatically when any changes happen in post and comments
    This page wil call manulaly by this way: No way
    Functions are: 
	class importPostsComments
	1.public function __construct()
	2.public function giveMeCommentIdForReply()
	3.public function giveMeCommentId()
	4.private function editPostViz($comment_count, $comment_post_ID)
	5.public function commentAdminPubnub()
	6.public function commentEditAdminPubnub()
	7.public function commentQuickEditAdminPubnub()
	8.public function addpostCumPubnubPost($post_ID)
	9.public function draftpostCumPubnubPost
	10.public function publishpostCumPubnubPost($post_ID)
	11.public function deletepostCumPubnubPost($post_ID)
	12.public function editpostCumPubnubPost()
	13.public function trashCommentCumPubnubPost()
	14.public function trashinEditCommentCumPubnubPost()
	15.private function trashComment($comment_ID)
	16.private function updatePost($temp)
	17.private function deletePost($post_ID)
	18.private function dbTablePosts()
	19.private function getWpPosts($post_ID)
	20.private function getWpDraftPosts($post_ID)
	21.private function ifDuplicatePost($ID)
	22.private function insertPost($temp)
	23.private function dbTableComments()
	24.private function getWpComments($comment_id)
	25.private function ifDuplicateComments($comment_ID)
	26.private function updateComments($temp)
	27.private function insertComments($temp)
	28.private function editCommentsCumPubnunCommentPublish($comment_id)
	29.private function dbTableCategories()
	30.private function dbTableTags()
	31.private function dbTableSentiment()
	32.private function categoriesForPost($posts_id)
	33.private function tagsForPost($posts_id)
	34.private function updateCategories($resultsCategories,$postID)
	35.private function updateTags($resultsTags,$postID)
	36.public function importSentiment($comment_ID)
	37.private function addEditSentiment($comment_ID,$neg,$neutral,$pos,$label)
	38.private function pubnubPostEditPublish($whichPost)
	39.private function pubnubPostNewPublish($whichPost)
	40.private function pubnubPostDraft($whichPost)
	41.private function pubnubPostPublish($whichPost)
	42.private function pubnubPostDeletePublish($whichPost)
	43.private function pubnubCommentDeletePublish($whichComment)
	44.private function pubnubPublishComments($whichComment)
*/

//new post or edit post
$importPosts = new importPostsComments();
class importPostsComments{
    public function __construct(){
    
			if(count($_POST)){
			    $post_ID = '';
    			if(@$_POST['_wp_http_referer']){
    			    if(@$_POST['post_status'] ==  'draft' ){
        			    //draft coding
        			    add_action('edit_post', array($this, 'draftpostCumPubnubPost'), 0);
    			    }else if(@$_POST['post_status'] ==  'publish'){
    			        add_action('edit_post', array($this, 'publishpostCumPubnubPost'), 0);
    			    }else{
        			    if(strripos($_POST['_wp_http_referer'],"post-new")){
            			add_action('edit_post', array($this, 'addpostCumPubnubPost'), 0);
                        }
            			else if(strripos($_POST['_wp_http_referer'],"edit")){
            			    if($_POST['action'] == 'editpost'){
            			        $post_ID = $_POST['post_ID'];
                                add_action('edit_post', array($this, 'editpostCumPubnubPost'), 0);
                            }else if($_POST['action'] == 'editedcomment'){
                                add_action('edit_comment', array($this, 'commentEditAdminPubnub'), 0);
                            }
            			}   
    			    }
    			}
    			else if(@$_POST['comment_post_ID'] != ""){
                    if(@$_POST['action'] == "edit-comment"){
                        add_action('edit_comment', array($this, 'commentQuickEditAdminPubnub'), 0);
                    }else if(@$_POST['action'] == "replyto-comment"){
                        
                       add_action('comment_post', array($this, 'giveMeCommentIdForReply'), 0); 
                       
                    }else{
                        add_action('comment_post', array($this, 'giveMeCommentId'), 0);
                    }
                }
                else if(@$_POST['action'] == "inline-save"){
                    
    			    $post_ID = $_POST['post_ID'];
    			    add_action('edit_post', array($this, 'editpostCumPubnubPost'), 0);
                }
                else if(@$_POST['action'] == "dim-comment"){
                    add_action('transition_comment_status', array($this, 'commentAdminPubnub'), 0);
                }
                else if(@$_POST['action'] == "delete-comment"){
                    add_action('trash_comment', array($this, 'trashCommentCumPubnubPost'), 0);
                }

			}
			else if(@$_GET['action'] === "trash"){
			    add_action('edit_post', array($this, 'deletepostCumPubnubPost'), 0);  
            }
            else if(@$_GET['action'] === "trashcomment"){
                add_action('trash_comment', array($this, 'trashinEditCommentCumPubnubPost'), 0);  
            }
		}
		
		public function giveMeCommentIdForReply() {
            $this->dbTableComments();
            $comment_post_ID = $_POST['comment_post_ID'];
            $comment = $_POST['content'];
            global $wpdb;
            $query = "SELECT comment_ID  
			FROM $wpdb->comments 
			WHERE comment_post_ID = '$comment_post_ID'
			AND 
            comment_content  = '$comment'
			ORDER BY comment_ID DESC
			LIMIT 0,1
		    ";
			$results = $wpdb->get_results($query,OBJECT);
			$comment_ID = $results[0]->comment_ID;
			$trueFalse = $this->editCommentsCumPubnunCommentPublish($comment_ID);
			$trueFalse = $this->importSentiment($comment_ID);
			$this->pubnubPublishComments($comment_ID);
        }
		
        public function giveMeCommentId() {
            $this->dbTableComments();
            $comment_post_ID = $_POST['comment_post_ID'];
            $comment = $_POST['comment'];
            global $wpdb;
            $query = "SELECT comment_ID  
			FROM $wpdb->comments 
			WHERE comment_post_ID = '$comment_post_ID'
			AND 
            comment_content  = '$comment'
			ORDER BY comment_ID DESC
			LIMIT 0,1
		    ";
		   	    
			$results = $wpdb->get_results($query,OBJECT);
			$comment_ID = @$results[0]->comment_ID;
			$trueFalse = $this->editCommentsCumPubnunCommentPublish($comment_ID);
			$trueFalse = $this->importSentiment($comment_ID);
			
            $query = "SELECT comment_count  FROM $wpdb->posts WHERE ID = '$comment_post_ID' LIMIT 0,1";
            $results = $wpdb->get_results($query,OBJECT);
			$comment_count = $results[0]->comment_count;
			$trueFalse = $this->editPostViz($comment_count, $comment_post_ID);
			
			$this->pubnubPublishComments($comment_ID);
        }
        
        private function editPostViz($comment_count, $comment_post_ID){
		      global $wpdb;
		      $table = "viz_posts";
		      $data_array = array(
		        'comment_count' => $comment_count
		       );
		      $where = array('posts_ID' => $comment_post_ID);
		      $wpdb->update( $table, $data_array, $where );
		      return true;
        }
        
        public function commentAdminPubnub(){
            
             $ID = $_POST['id'];
    	     $new = $_POST['new'];
    	     if($new == 'approved'){
        	     $new = 1;
    	     }else{
        	     $new = 0;
    	     }
             //update
             global $wpdb;
             $table = "viz_comments";
             $data_array = array(
		        'comment_approved' => $new		        
		       );
            $where = array('comment_id' => $ID);
            $wpdb->update( $table, $data_array, $where );
            $this->pubnubPublishComments($ID);
        }
		
		
		public function commentEditAdminPubnub(){
    		$comment_id = $_POST['c'];
    		//now get record for above id
    		$results = $this->getWpComments($comment_id);
    		
    		if($results[0]->comment_post_ID != ''){
		      $duplicate = $this->ifDuplicateComments($comment_id);
		      if($duplicate){
		       $this->updateComments($results);
		      }else{
		       $this->insertComments($results);
		      }
		      $trueFalse = $this->importSentiment($comment_id);
              $this->pubnubPublishComments($comment_id);
		    }//if close
		}
		
		public function commentQuickEditAdminPubnub(){ 
    		$comment_id = $_POST['comment_ID'];
    		//now get record for above id
    		$results = $this->getWpComments($comment_id);
    		if($results[0]->comment_post_ID != ''){
		      $duplicate = $this->ifDuplicateComments($comment_id);
		      if($duplicate){
		       $this->updateComments($results);
		      }else{
		       $this->insertComments($results);
		      }
		      $trueFalse = $this->importSentiment($comment_id);
              $this->pubnubPublishComments($comment_id);
		    }//if close
		}
        
        public function addpostCumPubnubPost($post_ID){
            $this->dbTablePosts();
            $results = $this->getWpPosts($post_ID);            
            if($this->ifDuplicatePost($post_ID)){
                $this->updatePost($results[0]); 
            }else{
                $this->insertPost($results[0]);
            }
            $this->pubnubPostNewPublish($post_ID);    
        }
		
		public function draftpostCumPubnubPost($post_ID){
    		$this->dbTablePosts();
            $results = $this->getWpDraftPosts($post_ID);            
            if($this->ifDuplicatePost($post_ID)){
                $this->updatePost($results[0]); 
            }else{
                $this->insertPost($results[0]);
            }
            $this->pubnubPostDraft($post_ID); 
		}
		public function publishpostCumPubnubPost($post_ID){
    		$this->dbTablePosts();
            $results = $this->getWpDraftPosts($post_ID);            
            if($this->ifDuplicatePost($post_ID)){
                $this->updatePost($results[0]); 
            }else{
                $this->insertPost($results[0]);
            }
            $this->pubnubPostPublish($post_ID); 
		}
		
		public function deletepostCumPubnubPost($post_ID){
            $this->deletePost($post_ID);           
            $this->pubnubPostDeletePublish($post_ID);    
        }
		
		
		public function editpostCumPubnubPost() {
		    $this->dbTablePosts();
            $post_ID = $_POST['post_ID'];
            
            $results = $this->getWpPosts($post_ID); 
                     
            if($this->ifDuplicatePost($post_ID)){
                $this->updatePost($results[0]);
            }else{
                $this->insertPost($results[0]);
            }
            $this->pubnubPostEditPublish($post_ID);
        }
        public function trashCommentCumPubnubPost(){
            //trash the comment
            $comment_ID = $_POST['id'];
            $this->trashComment($comment_ID);           
            $this->pubnubCommentDeletePublish($comment_ID); 
        }
        public function trashinEditCommentCumPubnubPost(){
            //trash the comment
            $comment_ID = $_GET['c'];
            $this->trashComment($comment_ID);           
            $this->pubnubCommentDeletePublish($comment_ID); 
        }
        
        private function trashComment($comment_ID){
            global $wpdb;
            $wpdb->delete( 'viz_comments', array( 'comment_id' => $comment_ID ) );
    		return true;
        }
        private function updatePost($temp){
		     $ID = $temp->ID;
		     $post_author = $temp->post_author;
		     $post_date = $temp->post_date;
		     $post_date_gmt = $temp->post_date_gmt;
		     //$post_content = $temp->post_content;
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
		        //'post_content' => $post_content, 
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
		      //update close
		    //categories start
            $this->dbTableCategories();
		    if(count($temp)){
                    $ID = $temp->ID;
					$resultsCategories = $this->categoriesForPost($ID);
					$this->updateCategories($resultsCategories,$ID);
		    }
            //categories close
            
            //tag start
            $this->dbTableTags();
		    if(count($temp)){
                    $ID = $temp->ID;
					$resultsTags = $this->tagsForPost($ID);
					$this->updateTags($resultsTags,$ID);
		    }
            //tag close
            
            
            
            return true;
		}
		
		private function deletePost($post_ID){
		    global $wpdb;
    		$wpdb->delete( 'viz_posts', array( 'posts_ID' => $post_ID ) );
    		return true;
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
		  `post_content` longtext NOT NULL DEFAULT '',
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
		}
		
		private function getWpPosts($post_ID){
			global $wpdb;
		   
		    $query = "SELECT $wpdb->posts.ID,$wpdb->posts.post_author,$wpdb->posts.post_date,$wpdb->posts.post_date_gmt,$wpdb->posts.post_title,$wpdb->posts.post_status,$wpdb->posts.post_name,$wpdb->posts.post_modified,$wpdb->posts.post_modified_gmt,$wpdb->posts.post_type,$wpdb->posts.comment_count FROM $wpdb->posts
		    WHERE $wpdb->posts.post_type = 'post'
		    AND $wpdb->posts.ID = $post_ID
		    LIMIT 0,1
		    ";

			$results = $wpdb->get_results($query);
			return $results;
		}
		
		private function getWpDraftPosts($post_ID){
			global $wpdb;
		   		    $query = "SELECT $wpdb->posts.ID,$wpdb->posts.post_author,$wpdb->posts.post_date,$wpdb->posts.post_date_gmt,$wpdb->posts.post_title,$wpdb->posts.post_status,$wpdb->posts.post_name,$wpdb->posts.post_modified,$wpdb->posts.post_modified_gmt,$wpdb->posts.post_type,$wpdb->posts.comment_count FROM $wpdb->posts
		    WHERE 
		    $wpdb->posts.ID = $post_ID
		    LIMIT 0,1
		    ";

			$results = $wpdb->get_results($query);
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
		
		
		
		private function insertPost($temp){
			 //row data start, class/array data to object
		     $ID = $temp->ID;
		     $post_author = $temp->post_author;
		     $post_date = $temp->post_date;
		     $post_date_gmt = $temp->post_date_gmt;
		     //$post_content = $temp->post_content;
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
		     //"post_content" => $post_content,
		     "post_title" => $post_title,
		     "post_status" => $post_status ,
		     "post_name" => $post_name ,
		     "post_modified" => $post_modified ,
		     "post_modified_gmt" => $post_modified_gmt ,
		     "post_type" => $post_type ,
		     "comment_count" => $comment_count 
		    
		     ));
		     
		     //categories start
            $this->dbTableCategories();
		    if(count($temp)){
                    $ID = $temp->ID;
					$resultsCategories = $this->categoriesForPost($ID);
					$this->updateCategories($resultsCategories,$ID);
		    }
            //categories close
            
            
            //tag start
            $this->dbTableTags();
		    if(count($temp)){
                    $ID = $temp->ID;
					$resultsTags = $this->tagsForPost($ID);
					$this->updateTags($resultsTags,$ID);
		    }
            //tag close

            
		     return true;
		}
		
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
		}

		private function getWpComments($comment_id){
			global $wpdb;
             $query = "SELECT comment_ID, comment_post_ID,  comment_content, comment_author, comment_author_email, comment_date,comment_date_gmt, comment_approved FROM $wpdb->comments WHERE  comment_id='$comment_id'";
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
		     $comment_ID = $temp[0]->comment_ID;
		     $comment_post_ID = $temp[0]->comment_post_ID;
		     $comment_content = $temp[0]->comment_content;
		     $comment_author = $temp[0]->comment_author;
		     $comment_author_email = $temp[0]->comment_author_email;
		     $comment_date = $temp[0]->comment_date;
		     $comment_date_gmt = $temp[0]->comment_date_gmt;
		     $comment_approved = $temp[0]->comment_approved;
		     
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
		}


		private function insertComments($temp){
			 //row data start, class/array data to object
		     $comment_ID = $temp[0]->comment_ID;
		     $comment_post_ID = $temp[0]->comment_post_ID;
		     $comment_content = $temp[0]->comment_content;
		     $comment_author = $temp[0]->comment_author;
		     $comment_author_email = $temp[0]->comment_author_email;
		     $comment_date = $temp[0]->comment_date;
		     $comment_date_gmt = $temp[0]->comment_date_gmt;
		     $comment_approved = $temp[0]->comment_approved;
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
		}

		private function editCommentsCumPubnunCommentPublish($comment_id) {
			$results = $this->getWpComments($comment_id);
			if(count($results)){
		      $duplicate = $this->ifDuplicateComments($comment_id);
		      if($duplicate){
		       $this->updateComments($results);
		      }else{
		       $this->insertComments($results);
		      }
		    }//if close  
		}

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
		  require_once(ABSPATH . 'wp-admin/includes/upgrade.php' );
		  dbDelta( $sql);
		  //table create close
		}
		
		
		
		private function dbTableTags(){
			//table create start
		    global $wpdb;
		    $charset_collate = $wpdb->get_charset_collate();
		    $table_name='viz_tags';
		   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PK',
		  
		  `post_id` bigint(20) unsigned NOT NULL COMMENT 'FK',
		  `tag` varchar(200) NOT NULL DEFAULT '',
		  
		  PRIMARY KEY (`id`)
		  ) ENGINE=MyISAM $charset_collate AUTO_INCREMENT=1;";
		  require_once(ABSPATH . 'wp-admin/includes/upgrade.php' );
		  dbDelta( $sql);
		  //table create close
		} 
		
		
		
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
		}
		
		private function categoriesForPost($posts_id){
			global $wpdb;
			$query = "SELECT wt.* FROM ".$wpdb->prefix."posts p
            INNER JOIN ".$wpdb->prefix."term_relationships r ON r.object_id=p.ID
            INNER JOIN ".$wpdb->prefix."term_taxonomy t ON t.term_taxonomy_id = r.term_taxonomy_id
            INNER JOIN ".$wpdb->prefix."terms wt on wt.term_id = t.term_id
            WHERE p.ID=$posts_id AND t.taxonomy='category'
		    ";
		   	$resultsCategories = $wpdb->get_results($query);
			return $resultsCategories;
		}
		
		private function tagsForPost($posts_id){
			global $wpdb;
		    $query = "SELECT slug FROM ".$wpdb->prefix."terms 
INNER JOIN ".$wpdb->prefix."term_taxonomy 
ON ".$wpdb->prefix."term_taxonomy.term_id = ".$wpdb->prefix."terms.term_id 
INNER JOIN ".$wpdb->prefix."term_relationships 
ON ".$wpdb->prefix."term_relationships.term_taxonomy_id = ".$wpdb->prefix."term_taxonomy.term_taxonomy_id 
WHERE taxonomy = 'post_tag' AND object_id = $posts_id";
		   	$resultsTags = $wpdb->get_results($query);
			return $resultsTags;
		}




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
			     $wpdb->insert($table_name, array(
    		     "term_id" => $term_id,
    		     "post_id" => $post_id,
    		     "name" => $name,
    		     "slug" => $slug,
    		     "term_group" => $term_group
    		     ));
		    }//foreach close
            return true;
		}
		
		private function updateTags($resultsTags,$postID){
			//delete present tags for crossponding postID
			$table_name='viz_tags';
			$qry = "DELETE FROM $table_name WHERE post_id=$postID";
			global $wpdb;
			$wpdb->query($qry);
			//delete close
            
			foreach($resultsTags as $temp){
			     $slug = $temp->slug;
			     $post_id = $postID;
			     $wpdb->insert($table_name, array(
    		     "tag" => $slug,
    		     "post_id" => $postID
    		     ));
		    }//foreach close
            return true;
		}
		
		
		
		public function importSentiment($comment_ID){
		    global $wpdb;
		    require_once('commonFunctions.php');
		    $arraySettings = getSettings();
            $mashape_Key = $arraySettings[0]->mashape_Key;
            if(! $mashape_Key){
                return false;
            }
		    $this->dbTableSentiment();
    		$results = $this->getWpComments($comment_ID);
    		if(count($results)){
			 for($i = 0; $i < count($results); $i++){
			    //if($results[$i]->comment_approved=='1')
			    {
    		      $comment_content = $results[$i]->comment_content;
    		      $comment_ID = $results[$i]->comment_ID;
    		      //curl start
        	        //$post = "language=english&text='super awesome movie'" ;
        	        $post = "language=english&text=$comment_content" ;
                    $headers = array();
                    //$headers[] = 'X-Mashape-Key: qMoASitCA6mshhjabj2hxCxq1iDYp1wZgKUjsnI2TgbAhvgJls';
                    $headers[] = "X-Mashape-Key: $mashape_Key";
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
                    $neg = $decode['probability']['neg'];
                    $neutral = $decode['probability']['neutral'];
                    $pos = $decode['probability']['pos'];
                    $label = $decode['label'];
    
    		      
    		      
                    //start
                    $trueFalseAddEdit = $this->addEditSentiment($comment_ID,$neg,$neutral,$pos,$label);
        			 
                    //close
                }//if close $results[$i]->comment_approved
		     }//for close
		    }//if close  
		}
		
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
		}
		
		
		private function pubnubPostEditPublish($whichPost) {
		    if(@$whichPost){
		        
		        include( plugin_dir_path( __FILE__ ) . 'pubnubPostEditPublish.php');
            }
		   
		}
		
		
		
		private function pubnubPostNewPublish($whichPost) {
		    if(@$whichPost){
		        include( plugin_dir_path( __FILE__ ) . 'pubnubPostNewPublish.php');
            }
		   
		}
		
		private function pubnubPostDraft($whichPost) {
		    if(@$whichPost){
		        include( plugin_dir_path( __FILE__ ) . 'pubnubPostDraft.php');
            }
		   
		}
		
		private function pubnubPostPublish($whichPost) {
		    if(@$whichPost){
		        include( plugin_dir_path( __FILE__ ) . 'pubnubPostPublish.php');
            }
		   
		}

		
		
        private function pubnubPostDeletePublish($whichPost) {
		    if(@$whichPost){
		        include( plugin_dir_path( __FILE__ ) . 'pubnubPostDeletePublish.php');
            }
		   
		}
		private function pubnubCommentDeletePublish($whichComment) {
		    if(@$whichComment){
		        include( plugin_dir_path( __FILE__ ) . 'pubnubCommentDeletePublish.php');
            }
		   
		}
		
		
		private function pubnubPublishComments($whichComment) {
		    if(@$whichComment){
		        include( plugin_dir_path( __FILE__ ) . 'publishComments.php');
            }
		   
		}
}//class close
//code closed
require_once('init.php');