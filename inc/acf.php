<?php
	/**
	 * ACF related functions and definitions
	 *
	 * @package Wondercat
	 */

	// Exit if accessed directly.
	defined( 'ABSPATH' ) || exit;

	//save acf json
	add_filter('acf/settings/save_json', 'wondercat_json_save_point');
	 
	function wondercat_json_save_point( $path ) {
	    
	    // update path
	    $path = get_stylesheet_directory(__FILE__) . '/acf-json'; //replace w get_stylesheet_directory() for theme
	    
	    
	    // return
	    return $path;
	    
	}


	// load acf json
	add_filter('acf/settings/load_json', 'wondercat_json_load_point');

	function wondercat_json_load_point( $paths ) {
	    
	    // remove original path (optional)
	    unset($paths[0]);
	    
	    
	    // append path
	    $paths[] = get_stylesheet_directory(__FILE__)  . '/acf-json';//replace w get_stylesheet_directory() for theme
	    
	    
	    // return
	    return $paths;
	    
	}