<?php
class common{
    public function __construct(){
    }
    public function cleanObject($object){
         //$val = array("\n","\r");
         $val = array("\r\n", "\n", "\r");
         return $object = str_replace($val, "<br>", $object);

    }
	public function getCategories($pid){
    	global $wpdb;
        $query = "SELECT
        name FROM viz_categories WHERE post_id='".$pid."'";
        $results = $wpdb->get_results($query);
        return $results;

	}
	public function getTags($pid){
    	global $wpdb;
        $query = "SELECT
        tag FROM viz_tags WHERE post_id='".$pid."'";
        $results = $wpdb->get_results($query);
        return $results;
	}
	public function postCount($pid){
    	global $wpdb;
        $query = "SELECT
        count_t FROM viz_postcounts WHERE posts_id='".$pid."'";
        $results = $wpdb->get_results($query);
        return $results;
	}
	function getSentiment($comment_id){
        global $wpdb;
        $query = "SELECT
        neg,neutral,pos,label FROM viz_sentiment WHERE comment_id='".$comment_id."' LIMIT 0,1";
        $results = $wpdb->get_results($query);
        $neg = '';
        $neutral = '';
        $pos = '';
        $label = '';
        if(count($results)>=1){
            $neg = $results[0]->neg;
            $neutral = $results[0]->neutral;
            $pos = $results[0]->pos;
            $label = $results[0]->label;
        }
        return array($neg,$neutral,$pos,$label);
    }

}
?>