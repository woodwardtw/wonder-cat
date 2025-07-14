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

	//Example that saves up to 99 posts to a folder called data	
	function wondercat_json_cache($post_id, $post, $update) {
	    // Only run for published posts
	    if($post->post_type === 'post' && $post->post_status === 'publish') {
	        $url = get_home_url() . '/wp-json/wp/v2/posts?per_page=99';

	        $file = file_get_contents($url);
	        if($file === false) {
	            write_log('Failed to fetch JSON from: ' . $url);
	            return;
	        }

	        $destination = get_stylesheet_directory() . '/data/';
	        // Create directory if it doesn't exist
	        if(!is_dir($destination)) {
	            wp_mkdir_p($destination);
	        }
	        write_log($destination);
	        $result = file_put_contents($destination . 'posts.json', $file); 
	        if($result === false) {
	            write_log('Failed to write JSON file to: ' . $destination);
	        }
	    }
	}
	add_action('save_post', 'wondercat_json_cache', 10, 3);

	//increase rest response limit to 200 and can go to 
	function wondercat_increase_rest_posts_per_page($args, $request) {
	    $args['posts_per_page'] = 200; // or whatever limit you want
	    return $args;
	}
	add_filter('rest_post_query', 'wondercat_increase_rest_posts_per_page', 10, 2);


/* Add USER EXPERIENCE to author archives */
function ue_post_author_archive($query) {
    if (!$query->is_main_query() || !$query->is_author()) {
        return;
    }
    
    $query->set('post_type', array('user-experience', 'post'));
}
add_action('pre_get_posts', 'ue_post_author_archive');


//LOGGER -- like frogger but more useful

if ( ! function_exists('write_log')) {
   function write_log ( $log )  {
      if ( is_array( $log ) || is_object( $log ) ) {
         error_log( print_r( $log, true ) );
      } else {
         error_log( $log );
      }
   }
}

