<?php
//categories
ini_set("display_errors", 1);
require_once('lib/autoloader.php');
use Pubnub\Pubnub;
$pubnub = new Pubnub('pub-c-3e92490d-3935-49d6-a2f1-f7f935f88036', 'sub-c-6c450ff2-3ae9-11e5-8579-02ee2ddab7fe');
$data = getPosts($pubnub,$whichPost);
function getPosts($pubnub,$whichPost){
    
    if($whichPost){
       $data = '';
            $data.="{".
                '"post_id":'. '"'.$whichPost.'"';
        $data='{'.'"result":'.'"Yes",'.'"action":'.'"Delete",'.'"records"'.':['.$data.'}]}';
        $publish_result = $pubnub->publish('demojay',$data);
        
    }else{
        //$output = json_encode(array('result'=>'errorCommon', 'text' => 'Norecords'));
        //die($output);
    }
}
?>