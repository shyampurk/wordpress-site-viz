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

}
?>