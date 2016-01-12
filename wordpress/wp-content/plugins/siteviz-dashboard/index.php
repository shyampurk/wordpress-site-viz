<?php
/*
  Plugin Name: siteviz integrated
  Plugin URI: http://www.bharatbaba.com
  Description: An advanced siteviz for seeing all comments-posts-categories by push and pull technique. Plugin to import all the posts,comments, categories. Very simple just plug n play.
  Version: 2.0/12-Jan-2016
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
        
        //jay 10-jan-2016 start
        // Add a new submenu under Settings:
       
    add_action('admin_menu', 'Siteviz');
 
/*function Siteviz() {
    add_submenu_page(
        'tools.php',
        'My Custom Submenu Page jay1',
        'My Custom Submenu Page jay2',
        'manage_options',
        'my-custom-submenu-page',
        'wpdocs_my_custom_submenu_page_callback' );
}*/
function Siteviz() {
    add_submenu_page(
        'options-general.php',
        'Siteviz',
        'Siteviz',
        'manage_options',
        'my-custom-submenu-page',
        'Siteviz_callback' );
}
 
function Siteviz_callback() {
    //echo '<div class="wrap"><div id="icon-tools" class="icon32"></div>';
        echo '<h2>Siteviz settings</h2>';
         //print_r($_POST); 
        dbCreateTableSettings();
        $arraySettings = getSettings();
        //echo "array2=<pre>";print_r($arraySettings);echo "</pre>";
        if((@$arraySettings[0]->pubnub_subs_key !='')||(@$arraySettings[0]->mashape_Key !='')){
            //edit  
            $text1 = "Edit";
            if(@$_POST['pubnub_submt_key']){
                editPubnubSettings($_POST);
            }
            $arraySettings = getSettings();
            $pubnub_subs_key = $arraySettings[0]->pubnub_subs_key;
            $pubnub_pub_key = $arraySettings[0]->pubnub_pub_key;
            //$pubnub_chanel_name = $arraySettings[0]->pubnub_chanel_name;
            $pubnub_chanel_name = "demojay";
        }else{
            //add
            $text1 = "Add";
            $pubnub_subs_key = $_POST['pubnub_subs_key'];
            $pubnub_pub_key = $_POST['pubnub_pub_key'];
            //$pubnub_chanel_name = $_POST['pubnub_chanel_name'];
            $pubnub_chanel_name = "demojay";
            if($_POST['pubnub_submt_key']){
                addPubnubSettings($_POST);
            }
        }
         echo pubnubForm($text1,$pubnub_subs_key,$pubnub_pub_key); ?>
         
         
         <?php
       
        $arraySettings = getSettings();
        if((@$arraySettings[0]->mashape_Key !='')||(@$arraySettings[0]->pubnub_subs_key !='')){
            //edit  
            $text1 = "Edit";
            if(@$_POST['mashape_submt_key']){
                editMashapeSettings($_POST);
            }
            $arraySettings = getSettings();
            $mashape_Key = $arraySettings[0]->mashape_Key;
                        
        }else{
            //add
            $text1 = "Add";
            $mashape_Key = @$_POST['mashape_Key'];
           
            if(@$_POST['mashape_submt_key']){
                addMashapeSettings($_POST);
            }
        }
             echo mashapeForm($text1,$mashape_Key) ; 
        ?>
    <?php //echo '</div>';
}
        //jay 10-jan-2016 close
        
        
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
        <?php
        $arraySettings = getSettings();
        $pubnub_subs_key = $arraySettings[0]->pubnub_subs_key;
        $pubnub_pub_key = $arraySettings[0]->pubnub_pub_key;
        $pubnub_chanel_name = $arraySettings[0]->pubnub_chanel_name;
        ?>
      <script type="text/javascript">  
var pubnub = PUBNUB({
    subscribe_key: '<?php echo $pubnub_subs_key; ?>', // always required
    publish_key: '<?php echo $pubnub_pub_key; ?>'    // only required if publishing
});
// Subscribe to a channel
 pubnub.subscribe({
    channel: '<?php echo $pubnub_chanel_name; ?>',
    message: function(m){
        document.getElementById("textareaId").value =m; 
    },
    error: function (error) {
      // Handle error here
      //alert('Error'+JSON.stringify(error));
    }
 });
</script>
<style type="text/css">
.table{
    display: table;border-style: solid;
    border-width: 2px 2px 2px 2px;padding:3px;
    }
.bold{
    font-size: 14px;
    font-weight: bold;
    font-family: verdana;
    text-align: center;
    }

</style>

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
/*
    Please enter subscribe key[Edit]:sub-c-6c450ff2-3ae9-11e5-8579-02ee2ddab7fe
    Please enter publish key:pub-c-3e92490d-3935-49d6-a2f1-f7f935f88036
    Please enter channel name:demojay
    Please enter Mashape-Key[Edit]:qMoASitCA6mshhjabj2hxCxq1iDYp1wZgKUjsnI2TgbAhvgJls
*/

?>
