<?php
/*
Author: Ole Fredrik Lie
URL: http://olefredrik.com
*/


// Various clean up functions
require_once('library/cleanup.php'); 

// Required for Foundation to work properly
require_once('library/foundation.php');

// Register all navigation menus
require_once('library/navigation.php');

// Add menu walker
require_once('library/menu-walker.php');

// Create widget areas in sidebar and footer
require_once('library/widget-areas.php');

// Return entry meta information for posts
require_once('library/entry-meta.php');

// Enqueue scripts
require_once('library/enqueue-scripts.php');

// Add theme support
require_once('library/theme-support.php');

	wp_enqueue_script('jquery');
	
	wp_register_script( 'site', get_stylesheet_directory_uri().'/js/site.js', array( 'jquery' ) );
	wp_enqueue_script( 'site' );

	

	function get_custom_cat_template($single_template) {
	     global $post;
	 
	       if ( in_category( 'video' )) {
	          $single_template = dirname( __FILE__ ) . '/single-video.php';
	     }

		   else if ( in_category( 'photo' )) {
	          $single_template = dirname( __FILE__ ) . '/single-photo.php';
	     }
		   
	     return $single_template;
	}
	 
	add_filter( "single_template", "get_custom_cat_template" ) ;


?>