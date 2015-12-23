<?php
/*
	We are using 4 function in this page
    This page is related: It will save the particular comment id.
    This page will call: In pop method if any comment is added
    This page will call automatically by this way: Through pop call via index2.php using pubnub api
	This is dependent to: pubnub libraray to save comments via pop technology
    This page wil call manulaly by this way: No way
    Functions are: 
	function capture_url()
	function dbTablePostcount()
	function ifDuplicatePost($url)
	function slt_url_to_postid( $url )
*/
add_action( 'init', 'capture_url' );

	function capture_url() {
		$url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
		$postid = slt_url_to_postid( $url); 
		
			if(@$postid){
				//echo $url;
				dbTablePostcount();
				//echo 'temp='.
				$temp = ifDuplicatePost($postid);
				$table = "viz_postcounts";
				if($temp){
					//read , add 1 and update row
					 $count_t = $temp+1;
					 //row data close
					  //update
					  global $wpdb;
					  $data_array = array(
						'count_t' => $count_t
					   );
					  $where = array('posts_id' => $postid);
					  $wpdb->update( $table, $data_array, $where );
					  return true;
					  //update close
		
				}else{
					//add row
					 $count_t = 1;
					 //row data close
					 global $wpdb;
					 $wpdb->insert($table, array(
					 "posts_id" => $postid,
					 'count_t' => $count_t
					 ));
					 return true;
					 //add row close
				}
			}
	
	}

	 function dbTablePostcount(){
				//table create start
				global $wpdb;
				$charset_collate = $wpdb->get_charset_collate();
				$table_name='viz_postcounts';
			   $sql = "CREATE TABLE IF NOT EXISTS $table_name (
	  `id_viz_postcounts` bigint(20) NOT NULL AUTO_INCREMENT,
	  `posts_id` bigint(20) NOT NULL COMMENT 'FK from post',
	  `count_t` int(2) NOT NULL,
	  `last_opened` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
	  PRIMARY KEY (`id_viz_postcounts`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;";
			  require_once(ABSPATH . 'wp-admin/includes/upgrade.php' );
			  dbDelta( $sql);
			  //table create close
	 }

    
	function ifDuplicatePost($url){
	
		global $wpdb;
		$table_name='viz_postcounts';
		$query = "SELECT count_t FROM $table_name
			 WHERE posts_id = '".$url."' LIMIT 0,1
			 ";
			 $results = $wpdb->get_results($query);
			 $duplicate = 0;
			 $duplicate = @$results[0]->count_t;
			 return $duplicate;
	
	}
    
    
    
    function slt_url_to_postid( $url ) {
		$post_id = url_to_postid( $url );
		if ( $post_id == 0 ) {
			// Try custom post types
			$cpts = get_post_types( array(
				'public'   => true,
				'_builtin' => false
			), 'objects', 'and' );
        // Get path from URL
        $url_parts = explode( '/', trim( $url, '/' ) );
        $url_parts = array_splice( $url_parts, 3 );
        $path = implode( '/', $url_parts );
        // Test against each CPT's rewrite slug
        foreach ( $cpts as $cpt_name => $cpt ) {
            $cpt_slug = $cpt->rewrite['slug'];
            if ( strlen( $path ) > strlen( $cpt_slug ) && substr( $path, 0, strlen( $cpt_slug ) ) == $cpt_slug ) {
                $slug = substr( $path, strlen( $cpt_slug ) );
                $query = new WP_Query( array(
                    'post_type'         => $cpt_name,
                    'name'              => $slug,
                    'posts_per_page'    => 1
                ));
                if ( is_object( $query->post ) )
                    $post_id = $query->post->ID;
            }
        }
    }
    return $post_id;
}
?>