<?php
        function addPubnubSettings($post){
            //echo "inside=";print_r($post);
            // inside=Array ( [pubnub_subs_key] => a [pubnub_pub_key] => b [pubnub_chanel_name] => c [pubnub_submt_key] => submit ) 
            //echo "Helo";
            if(@$post['pubnub_submt_key']=='submit'){
                
                //if(($post['pubnub_subs_key']!='')&&($post['pubnub_pub_key']!='')&&($post['pubnub_chanel_name']!='')){
        		     $pubnub_subs_key = $post['pubnub_subs_key'];
        		     $pubnub_pub_key = $post['pubnub_pub_key'];
        		     $pubnub_chanel_name = $post['pubnub_chanel_name'];
        		     //row data close
		    
                     global $wpdb;
                     //print_r($wpdb);
                     /*
        		     $wpdb->insert("viz_settings", array(
        		     "pubnub_subs_key" => $pubnub_subs_key,
        		     'pubnub_pub_key' => $pubnub_pub_key, 
        		     'pubnub_chanel_name' => $pubnub_chanel_name
        		     ));
                     */
                     $wpdb->insert("viz_settings", array(
                     "pubnub_subs_key" => $pubnub_subs_key,
                     'pubnub_pub_key' => $pubnub_pub_key, 
                     'pubnub_chanel_name' => 'demo'
                     ));

                     //echo $wpdb->last_query;
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
                     //$pubnub_chanel_name = $post['pubnub_chanel_name'];	
                     $pubnub_chanel_name = "demo";	     
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
		
		function pubnubForm($text1='',$pubnub_subs_key='',$pubnub_pub_key=''){?>
    		<div class="table">
<div class="bold">Pubnub key setting:</div>
<?php /*<form action="http://localhost/wordpress2/wp-admin/admin.php?page=siteviz-plugin" method="POST">*/?>
<!--<form action="admin.php?page=siteviz-plugin" method="POST">-->
<form action="options-general.php?page=my-custom-submenu-page" method="POST">
        <div style="display: table-row;">
            <div style="display: table-cell;">Please enter subscribe key[<?php echo $text1; ?>]:</div>
            <div style="display: table-cell;"><input type="text"  name="pubnub_subs_key" value="<?php echo @$pubnub_subs_key; ?>"/></div>
            <div style="display: table-cell;">Please enter publish key:</div>
            <div style="display: table-cell;"><input type="text"  name="pubnub_pub_key" value="<?php echo @$pubnub_pub_key; ?>"/></div>

        </div>
        <!--<div style="display: table-row;">
            <div style="display: table-cell;">Please enter channel name:</div>
            <div style="display: table-cell;"><input type="text"  name="pubnub_chanel_name" value="<?php echo @$pubnub_chanel_name; ?>"/></div>-->
            
            <div style="display: table-cell;"><input type="submit" value="submit" name="pubnub_submt_key"></div>
        </div>
</form>
</div>
		<?php }
		
		function mashapeForm($text1='',$mashape_Key=''){?>
		<div class="table">
<div class="bold">Mashape key setting:</div>
<?php /*<form action="http://localhost/wordpress2/wp-admin/admin.php?page=siteviz-plugin" method="POST">*/?>
<!--<form action="admin.php?page=siteviz-plugin" method="POST">-->
<form action="options-general.php?page=my-custom-submenu-page" method="POST">
        <div style="display: table-row;">
            <div style="display: table-cell;">Please enter Mashape-Key[<?php echo $text1; ?>]:</div>
            <div style="display: table-cell;"><input type="text" size="58" name="mashape_Key" value="<?php echo @$mashape_Key; ?>"/></div>
            
        </div>
        <div style="display: table-row;">
            
            <div style="display: table-cell;">&nbsp;</div>
            <div style="display: table-cell;text-align: center;"><input type="submit" value="submit" name="mashape_submt_key" ></div>
        </div>
</form>
</div>
		<?php } ?>