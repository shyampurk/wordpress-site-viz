<?php
/*
  Plugin Name: SiteViz
  Plugin URI: http://www.pubnub.com
  Description: A plugin for visualizing the wordpress site structure in the form of categories, posts and comments.
  Version: 1.0/21-June-2016
  Author: PubNub
  Author URI: http://www.pubnub.com
  License: GPL2
 */
 
  
require_once('commonFunctions.php');
define( 'MY_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );
class read_all_data_ajax_pubnub {
    protected $options;
    public function __construct() {
        register_activation_hook(__FILE__, array(&$this, "install"));
        register_deactivation_hook(__FILE__, array(&$this, "unInstall"));
        
        global $wpdb;
        
        
       
    add_action('admin_menu', 'Siteviz');
 

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
            //Mashape API not implemented
             //echo mashapeForm($text1,$mashape_Key) ; 
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
    wp_enqueue_script("siteviz" , plugin_dir_url(__FILE__) . "scripts/siteviz.js");
        ?>
       

        <style>
        .d3-tip {
          line-height: 1;
          font-weight: bold;
          background: rgba(209, 73, 73, 0.8);
          color: #fff;
          border-radius: 2px;
          
          word-wrap: break-word;
        }

        .comment-wrap {
            width : 400px;
            word-wrap: break-word;
        }

        /* Creates a small triangle extender for the tooltip */
        .d3-tip:after {
          box-sizing: border-box;
          display: inline;
          font-size: 10px;
          width: 100%;
          line-height: 1;
          color: rgba(209, 73, 173, 0.8);
          content: "\25BC";
          position: absolute;
          text-align: center;

        }

        #vizHeaderDiv {
            font-size: 1.5em;
            padding-top: 10px;
        }    

        </style>


        <div>
            <div id='vizHeaderDiv'><span><strong>Realtime Site Visualization</strong></span></div>        
            <div id='vizAreaDiv'> </div>
        </div>
        <script type="text/javascript">
                var viz = null;
                jQuery(document).ready(function($){ 
                
                        loadAllPostData();
                        
                });

                function loadAllPostData(){

                    jQuery.ajax({
                                    type: 'GET', 
                                    url: "<?php echo plugins_url('siteviz-dashboard/getdata-new.php'); ?>",
                                    
                                    //dataType : "JSON",
                                    //dataType : "text",
                                    data : {action: "get_product_serial_callback"},
                                    dataType: "json",
                                    async: false,
                                    cache: false,
                                    
                                    success: function(data){
                                        //var json_obj = JSON.parse(data);
                                   
                                        
                                        if((data['result'] == 'errorCommon') && (data['text'] == 'Norecords')){
                                            
                                            alert('No Posts Found');
                                            


                                            
                                        }else {//if(json_obj['result']=="Yes"){
                                            
                                            //$('#textareaId').val(data);
                                            
                                            //if (json_obj.records.length >= 1) {}
                                            viz = new VizElement(document.getElementById("vizAreaDiv"),data,"<?php echo MY_PLUGIN_PATH; ?>");

                                       }
                                    }//success close
                            });

                }
        </script>
        
        
        <!--pubnub ajax start-->
        <script src="http://cdn.pubnub.com/pubnub.min.js"></script>
        <script src="https://d3js.org/d3.v3.min.js" charset="utf-8"></script>
        <script src="http://labratrevenge.com/d3-tip/javascripts/d3.tip.v0.6.3.js"></script>
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
        //document.getElementById("textareaId").value =m; 
        if(viz){
            viz.refresh(m);    
        } else {
            loadAllPostData();
        }
        
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


?>
