<?php
        function addPubnubSettings($post){
            //echo "inside=";print_r($post);
            // inside=Array ( [pubnub_subs_key] => a [pubnub_pub_key] => b [pubnub_chanel_name] => c [pubnub_submt_key] => submit ) 
            if(@$post['pubnub_submt_key']=='submit'){
                //if(($post['pubnub_subs_key']!='')&&($post['pubnub_pub_key']!='')&&($post['pubnub_chanel_name']!='')){
        		     $pubnub_subs_key = $post['pubnub_subs_key'];
        		     $pubnub_pub_key = $post['pubnub_pub_key'];
        		     $pubnub_chanel_name = $post['pubnub_chanel_name'];
        		     //row data close
		    
                     global $wpdb;
        		     $wpdb->insert("viz_settings", array(
        		     "pubnub_subs_key" => $pubnub_subs_key,
        		     'pubnub_pub_key' => $pubnub_pub_key, 
        		     'pubnub_chanel_name' => $pubnub_chanel_name
        		     ));
        		     return true;

                //}
            }
        }
        function addMashapeSettings($post){
            if(@$post['mashape_submt_key']=='submit'){
                //if(($post['mashape_Key']!='')){
        		     $mashape_Key = $post['mashape_Key'];
                     //row data close
		    
                     global $wpdb;
        		     $wpdb->insert("viz_settings", array(
        		     "mashape_Key" => $mashape_Key        		     ));
        		     return true;

                //}
            }
        }

        function editPubnubSettings($post){
            if(@$post['pubnub_submt_key']=='submit'){
                //if(($post['pubnub_subs_key']!='')&&($post['pubnub_pub_key']!='')&&($post['pubnub_chanel_name']!='')){

                     //row data start, class/array data to object
        		     $pubnub_subs_key = $post['pubnub_subs_key'];
                     $pubnub_pub_key = $post['pubnub_pub_key'];
                     $pubnub_chanel_name = $post['pubnub_chanel_name'];		     
        		     //row data close
        		      //update
        		      global $wpdb;
        		      $table = "viz_settings";
        		      $data_array = array(
        		        'pubnub_subs_key' => $pubnub_subs_key, 
        		        'pubnub_pub_key' => $pubnub_pub_key, 
        		        'pubnub_chanel_name' => $pubnub_chanel_name		       );
        		      $where = array('id' => 1);
        		      $wpdb->update( $table, $data_array, $where );
        		      return true;
        		      //update close
                //}
            }
        }
        
        function editMashapeSettings($post){
            if(@$post['mashape_submt_key']=='submit'){
                //if(($post['mashape_Key']!='')){

                     //row data start, class/array data to object
        		     $mashape_Key = $post['mashape_Key'];
                     	     
        		     //row data close
        		      //update
        		      global $wpdb;
        		      $table = "viz_settings";
        		      $data_array = array(
        		        'mashape_Key' => $mashape_Key	       );
        		      $where = array('id' => 1);
        		      $wpdb->update( $table, $data_array, $where );
        		      return true;
        		      //update close
                //}
            }
        }

        function dbCreateTableSettings(){
			//table create start
		   global $wpdb;
		   $charset_collate = $wpdb->get_charset_collate();
		   $table_name='viz_settings';
		   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT COMMENT 'pk',
		  `pubnub_subs_key` varchar(100) NOT NULL,
		  `pubnub_pub_key` varchar(100)  NOT NULL,
		  `pubnub_chanel_name` varchar(100) NOT NULL,
		  `mashape_Key` varchar(100) NOT NULL,
		  PRIMARY KEY (`id`)
		  ) ENGINE=MyISAM $charset_collate AUTO_INCREMENT=1;";
		  require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
		  dbDelta( $sql );
		  //table create close
		}
		
		/*function getPubnubSettings(){
    		global $wpdb;
    		$table_name='viz_settings';
		    $query = "SELECT pubnub_subs_key, pubnub_pub_key, pubnub_chanel_name  FROM ".$table_name;
		   	$resultsTags = $wpdb->get_results($query);
			return $resultsTags;
		}
		function getMashapeSettings(){
    		global $wpdb;
    		$table_name='viz_settings';
		    $query = "SELECT mashape_Key  FROM ".$table_name;
		   	$resultsTags = $wpdb->get_results($query);
			return $resultsTags;
		}*/
		function getSettings(){
    		global $wpdb;
    		$table_name='viz_settings';
		    $query = "SELECT pubnub_subs_key, pubnub_pub_key, pubnub_chanel_name, mashape_Key  FROM ".$table_name;
		   	$resultsTags = $wpdb->get_results($query);
			return $resultsTags;
		}
?>