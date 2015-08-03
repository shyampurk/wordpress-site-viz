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
    
        ?>
        <div style="width:820px;">
            <h2>Siteviz ajax data</h2>
        </div>
        <div id='textAreaDiv'><textarea id="textareaId" rows="50" cols="80"></textarea></div>
        
        
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
                jQuery(document).ready(function($){
                    //alert('Hello World!');
                    // url: "<?php echo admin_url('admin-ajax.php'); ?>",
//https://codex.wordpress.org/Determining_Plugin_and_Content_Directories


                    jQuery.ajax({
                                type: 'GET', 
                                url: "<?php echo plugins_url('dashboard/getdata.php'); ?>",
                                //url: ajaxurl,
                                //dataType : "JSON",
                                dataType : "text",
                                data : {action: "get_product_serial_callback"},
                                //dataType: "json",
				async: false,
				cache: false,
                                //cache: false, 
                                success: function(data){//alert(data);
                                var json_obj = JSON.parse(data);
                                //alert('length12='+(json_obj['records'].length));
                                //alert(json_obj);
                                    //alert(data.records.length);
                                    //alert(data['result']);
                                    //alert(data['message']);return false;
                                    //$("#textareaId").html("");
                                    $('#textareaId').val('');
                                    if((data['result'] == 'errorCommon') && (data['text'] == 'Norecords')){
                                        //alert('11');
    									//$("#regEmailDiv").removeClass( "input-group" );
    									//$("#regEmailGlyphicon").hide();
    									textMsg = 'No data found';
    									$('#textareaId').val(textMsg);
    									//alert(textMsg);//return false;
    									$("#textareaId").css("color","red");
    									//$('#textareaId').text(textMsg);
    									//$("#resultEmail").addClass("clsPyType");
    								}else if(json_obj['result']=="Yes"){
    								    //alert('length='+(json_obj['records'].length));
    								    //$("#textareaId").html("");
    								    $('#textareaId').val(data);
    								    //if(data.records != undefined)
    								    //alert(data['result']);
                                        //alert(data);//return false;

                                        //$('#textareaId').val(textMsg);return false;
    	                                //alert('data');
    	                                //alert(data['result']);return false;
    	                                //alert('length='+(data['text']));
    	                               // alert('length='+(data.records.length));
    	                                if (json_obj.records.length >= 1) {
    	                                //alert('length12='+(data['records'].length));
    	                                
    	                                
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