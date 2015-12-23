<?php
/*
  Plugin Name: siteviz integrated
  Plugin URI: http://www.bharatbaba.com
  Description: An advanced siteviz for seeing all comments-posts-categories by push and pull technique.
  Version: 2.0/12-Dec-2015
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


class read_all_data_ajax_pubnub {
    protected $options;
    public function __construct() {
        register_activation_hook(__FILE__, array(&$this, "install"));
        register_deactivation_hook(__FILE__, array(&$this, "unInstall"));
        if (is_admin()) {
            add_action("admin_menu", array(&$this, "adminMenu"));
        } else {
            add_shortcode('siteviz-ajax', array(&$this, "embed"));
        }
        
              
    }
    
    /*public function adminMenu1() {
        add_options_page
                (
                "Siteviz Ajax", "Siteviz Ajax", "administrator", "siteviz-ajax", array
            (
            &$this,
            "drawAdminPage"
                )
        );
    }*/
    
    function adminMenu(){
        //add_menu_page( 'Test Plugin Page', 'Test Plugin', 'manage_options', 'test-plugin', 'test_init' );
        add_menu_page( 'Siteviz Page', 'Siteviz', 'manage_options', 'siteviz-plugin', array
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
            <h2>siteviz ajax data cum pubnub</h2>
        </div>
        
        <div id='textAreaDiv'><textarea id="textareaId" rows="50" cols="80"></textarea></div>
        
        <script type="text/javascript">
                jQuery(document).ready(function($){ 
                        jQuery.ajax({
                                    type: 'GET', 
                                    url: "<?php echo plugins_url('siteviz-dashboard/getdata-new.php'); ?>",
                                    
                                    //dataType : "JSON",
                                    dataType : "text",
                                    data : {action: "get_product_serial_callback"},
                                    //dataType: "json",
                                    async: false,
                                    cache: false,
                                    
                                    success: function(data){
                                        //var json_obj = JSON.parse(data);
                                   
                                        $('#textareaId').val('');
                                        if((data['result'] == 'errorCommon') && (data['text'] == 'Norecords')){
                                            
        									textMsg = 'No data found';
        									$('#textareaId').val(textMsg);
        									
        									$("#textareaId").css("color","red");
        									
        								}else {//if(json_obj['result']=="Yes"){
        								    
        								    $('#textareaId').val(data);
        								    
        	                                //if (json_obj.records.length >= 1) {}
        	                                
        	                           }
                                    }//success close
                            });
                    });
        </script>
        
        
        <!--pubnub ajax start-->
        <script src="http://cdn.pubnub.com/pubnub.min.js"></script>
      <script type="text/javascript">  
var pubnub = PUBNUB({
    subscribe_key: 'sub-c-6c450ff2-3ae9-11e5-8579-02ee2ddab7fe', // always required
    publish_key: 'pub-c-3e92490d-3935-49d6-a2f1-f7f935f88036'    // only required if publishing
});
// Subscribe to a channel
 pubnub.subscribe({
    channel: 'demojay',
    message: function(m){
        //alert('message1='+m);
        //document.getElementById('chatHistory').innerHTML=m;  
        document.getElementById("textareaId").value =m; 
    },
    error: function (error) {
      // Handle error here
      //alert('Error'+JSON.stringify(error));
    }
 });
</script>
<!--div id='textAreaDiv'><textarea id="textareaId" rows="50" cols="80"></textarea></div-->
<div id="chatHistory">&nbsp;</div>
        <!-- pubnub ajax close-->
        <?php
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
new read_all_data_ajax_pubnub();
require_once('index2.php');
?>