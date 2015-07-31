<?php
/*
  Plugin Name: Jay Siteviz ajax data RumbleTalk
  Plugin URI: http://www.bharatbaba.com
  Description: An advanced siteviz for seeing all comments-posts-categories by ajax.
  Version: 1.0
  Author: Bharatababa com
  Author URI: http://www.bharatbaba.com
  License: GPL2

  Copyright 2014-2020 bharatbaba Ltd (email : jaybharatjay@gmail.com)

  This program is free trial software; you can redistribute it and/or modify
  it under the terms of the GNU General Public License, version 2, as
  published by the Free Software Foundation.

  This program is distributed in the hope that it will be useful,
  but WITHOUT ANY WARRANTY; without even the implied warranty of
  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  GNU General Public License for more details.

  You should have received a copy of the GNU General Public License
  along with this program; if not, write to the Free Software
  Foundation, Inc., 51 Franklin St, Fifth Floor, Bangalore, KA  +9102110-1301  IND
 */
//print_r( $wpdb );
//echo 'wpdb1='.$wpdb.'<br>';



class Read_all_data_ajax {

    protected $options;

    public function __construct() {
       
      
      //global $wpdb;
      
        register_activation_hook(__FILE__, array(&$this, "install"));
        register_deactivation_hook(__FILE__, array(&$this, "unInstall"));

        if (is_admin()) {
            add_action("admin_menu", array(&$this, "adminMenu"));
        } else {
            add_shortcode('siteviz-ajax', array(&$this, "embed"));
        }
        
        
    }



    public function adminMenu() {
        add_options_page
                (
                "Siteviz Ajax", "Siteviz Ajax", "administrator", "siteviz-ajax", array
            (
            &$this,
            "drawAdminPage"
                )
        );
    }

    public function drawAdminPage() {   
    global $wpdb;
    //echo 'aa='.$wpdb->posts;
    //echo '<br>bb='.$wpdb->get_results;
    /*echo $queryAllPosts = "SELECT $wpdb->posts.ID,$wpdb->posts.post_author,$wpdb->posts.post_date,$wpdb->posts.post_date_gmt,$wpdb->posts.post_content,$wpdb->posts.post_title,$wpdb->posts.post_status,$wpdb->posts.post_name,$wpdb->posts.post_modified,$wpdb->posts.post_modified_gmt,$wpdb->posts.post_type,$wpdb->posts.comment_count FROM $wpdb->posts 
    WHERE $wpdb->posts.post_status = 'publish'
    AND $wpdb->posts.post_type = 'post'
    ORDER BY $wpdb->posts.post_date ASC
    ";
*/
 
        ?>
        <div style="width:820px;">
            <h2>Siteviz ajax data</h2>
        </div>
        
        
        
        <!--js start by jay-->
        <!--script type="text/javascript" >
	jQuery(document).ready(function($) {

		var data = {
			'action': 'my_action',
			'whatever': 1234
		};

		// since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
		$.post(ajaxurl, data, function(response) {
			alert('Got this from the server: ' + response);
		});
		
		
		
	});
	</script-->
	
	
	
	<script type="text/javascript">
                jQuery(document).ready(function(){
                    //alert('Hello World!');
                    // url: "<?php echo admin_url('admin-ajax.php'); ?>",
//https://codex.wordpress.org/Determining_Plugin_and_Content_Directories


                    jQuery.ajax({
                                type: 'GET', 
                                url: "<?php echo plugins_url('dashboard/getdata.php'); ?>",
                                //url: ajaxurl,
                                dataType : "JSON",
                                data : {action: "get_product_serial_callback"},
                                                                 //cache: false, 
                                success: function(data){
                                
	                                if((data['result'] == 'errorCommon') && (data['message'] == 'Norecords')){
										//$("#regEmailDiv").removeClass( "input-group" );
										//$("#regEmailGlyphicon").hide();
										textMsg = 'No data found';
										alert(textMsg);return false;
										$("#resultEmail").css("color","green");
										$('#resultEmail').text(textMsg);
										$("#resultEmail").addClass("clsPyType");
									}else{
	                                
		                                //alert('data');
		                                alert(data['result']);return false;
		                                //alert('length='+(data.records.length));
		                                if (data.records.length >= 1) {
		                                
		                                
		                                
		                                /*
    		                                diary.js
    		                                
    		                                thtml+='<div class="clsMsgHdr" id="divMsgHdr">';
                                    thtml+='<div class="clsMsgHdr2" id="divMsgHdr2">';
										if(profile_image == ""){
											thtml+='<div><img src="../../images/profile2.png" width="63" class="clsDiaryCircle"></div>';
										}else{
											var profileImgPath = socketUrl+'/imagesDynamic/profileImages/'+profile_image;
											thtml+='<div><img src="'+profileImgPath+'" width="63" class="clsDiaryCircle"></div>';
										}                                     	
                                        thtml+='<div class="clsHdr2Name">';
    	                                   	thtml+='<span class="clsPyTypeUprBold">'+first_name+'</span><br/>';
	    	                                thtml+='<span class="clsPyType">'+added_date+' | 2 HRTS</span>';
                                         thtml+='</div>';
		                                */
			                                
		                                }//if data close
		                                //alert('Eureka');
	                               }
                                }//success close
                            });
                });
        </script>
	
	
	        <!--js close by jay-->
        
        
        
        <?php
        //define('WPFP_PATH', plugins_url() . '/dashboard'); 
//require_once(WPFP_PATH . '/test1.php');

    }//drawAdminPage close

       
    

    public function install() {
        foreach ($this->options as $opt) {
            add_option($opt);
        }
    }//install cloase

    public function unInstall() {
        foreach ($this->options as $opt) {
            delete_option($opt);
        }
    }//unInstall close

}//class close

new Read_all_data_ajax();
?>