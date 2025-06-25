<?php
	/**
	 * Wondercat functions and definitions
	 *
	 * @package Wondercat
	 */

	// Exit if accessed directly.
	defined( 'ABSPATH' ) || exit;


	//loads the custom CSS at style.css
	add_action( 'wp_enqueue_scripts', 'wondercat_enqueue_styles' );

	function wondercat_enqueue_styles() {
		wp_enqueue_style( 
			'wondercat-style', 
			get_stylesheet_uri()
		);
	}



	//loads inc contents
	require_once get_theme_file_path( 'inc/acf.php' );



	//Example PHP function
	add_filter( 'the_content', 'wondercat_test_function', 1 );

	function wondercat_test_function($content){
		$acf_example = get_field('test_one');
		return "{$content} <h2>{$acf_example}</h2>";
	}

	