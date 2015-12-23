<?php
//if uninstall not called from WordPress exit
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) 
    exit();
$option_name = 'plugin_option_name';
delete_option( $option_name );
// For site options in multisite
delete_site_option( $option_name );  

//drop a custom db table
global $wpdb;
$table_name1='viz_sentiment';
$table_name2='viz_categories';
$table_name3='viz_comments';
$table_name4='viz_posts';
$table_name5='viz_tags';
$table_name6='viz_postcounts';
//$wpdb->query( "DROP TABLE IF EXISTS {$wpdb->prefix}mytable" );
$wpdb->query( "DROP TABLE IF EXISTS $table_name1" );
$wpdb->query( "DROP TABLE IF EXISTS $table_name2" );
$wpdb->query( "DROP TABLE IF EXISTS $table_name3" );
$wpdb->query( "DROP TABLE IF EXISTS $table_name4" );
$wpdb->query( "DROP TABLE IF EXISTS $table_name5" );
$wpdb->query( "DROP TABLE IF EXISTS $table_name6" );
//note in multisite looping through blogs to delete options on each blog does not scale. You'll just have to leave them.
?>