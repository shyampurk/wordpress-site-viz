<?
/*
Plugin Name: Jay WP Plugin Demo
Plugin URI: http://www.bharatbaba.com
Description:  Tutorial for how to develope a plugin in wordpress
Author: Jay Bharat/9844542127/jaybharatjay@gmail.com
Version: 1.0/26-may-2015
Author URI: http://www.bharatbaba.com
*/

function limited_character_post( $limit ) {
  $content = explode( ' ', get_the_content(), $limit );
  
  if ( count( $content ) >= $limit ) {
    array_pop( $content );
    $content = implode(" ",$content).'...';
  } else {
    $content = implode(" ",$content);
  }	
  
  $content = preg_replace('/\[.+\]/','', $content);
  $content = apply_filters('the_content', $content); 

  return $content;
}
//code closed