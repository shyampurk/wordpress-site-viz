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
require_once('commonFunctions.php');
class read_all_data_ajax_pubnub {
    protected $options;
    public function __construct() {
        register_activation_hook(__FILE__, array(&$this, "install"));
        register_deactivation_hook(__FILE__, array(&$this, "unInstall"));
        global $wpdb;
        if (is_admin()) {
             $adminMenu = 'adminMenu';
             add_action("admin_menu", array(&$this, $adminMenu));
        } else {
            add_shortcode('siteviz-ajax', array(&$this, "embed"));
        }  
    }
    
    
    function adminMenu(){
        add_menu_page( 'Siteviz Page', 'Siteviz', 'manage_options', 'siteviz-plugin', array
            (
            &$this,
            "drawAdminPage"
                )
            );
    }
    
    function acceptConfiguration(){
        add_menu_page( 'Siteviz Page', 'Siteviz', 'manage_options', 'siteviz-plugin', array
            (
            &$this,
            "drawAdminPage"
                )
            );
        
    }

    
    
    public function drawAdminPage() {   
    global $wpdb;
    //add_settings_section( $id, $title, $callback, $page );
    do_settings_sections( 'myoption-group' );
        ?>
        <div style="width:820px;">
            <h2>siteviz ajax data cum pubnub</h2>
        </div>
        
        
        
        
        
        <?php
        
        //print_r($_POST); 
        dbTableSettings();
        $arraySettings = getSettings();
        //echo "array2=<pre>";print_r($arraySettings);echo "</pre>";
        if(@$arraySettings[0]->pubnub_subs_key !=''){
            //edit  
            $text1 = "Edit";
            editSettings($_POST);
            $arraySettings = getSettings();
            $pubnub_subs_key = $arraySettings[0]->pubnub_subs_key;
            $pubnub_pub_key = $arraySettings[0]->pubnub_pub_key;
            $pubnub_chanel_name = $arraySettings[0]->pubnub_chanel_name;
            
        }else{
            //add
            $text1 = "Add";
            $pubnub_subs_key = $_POST['pubnub_subs_key'];
            $pubnub_pub_key = $_POST['pubnub_pub_key'];
            $pubnub_chanel_name = $_POST['pubnub_chanel_name'];
            addSettings($_POST);
        }
               
        ?>
        
       




<div style="display: table;">
<form action="http://localhost/wordpress2/wp-admin/admin.php?page=siteviz-plugin" method="POST">
        <div style="display: table-row;">
            <div style="display: table-cell;">Please enter subscribe key[<?php echo $text1; ?>]:</div>
            <div style="display: table-cell;"><input type="text"  name="pubnub_subs_key" value="<?php echo @$pubnub_subs_key; ?>"/></div>
            <div style="display: table-cell;">Please enter publish key:</div>
            <div style="display: table-cell;"><input type="text"  name="pubnub_pub_key" value="<?php echo @$pubnub_pub_key; ?>"/></div>

        </div>
        <div style="display: table-row;">
            <div style="display: table-cell;">Please enter channel name:</div>
            <div style="display: table-cell;"><input type="text"  name="pubnub_chanel_name" value="<?php echo @$pubnub_chanel_name; ?>"/></div>
            
            <div style="display: table-cell;"><input type="submit" value="submit" name="pubnub_submt_key"></div>
        </div>
</form>
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