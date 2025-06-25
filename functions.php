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
	function wondercat_test_function(){
		var_dump('foo');
	}

	wondercat_test_function();