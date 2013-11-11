<?php /*
	Plugin Name: WP Jcycle2
	Plugin URI: https://github.com/atelierabbey/WPJcycle
	Description: A simple slider plugin - activate_jcycle .
	Version: 1.0
	Author: Grayson A.C. Laramore
	Author URI: http://wwww.SillyCoyote.com
	License: GPL2
*/
/// ACTIVATE!!!

add_action( 'init', 'register_slider_posttype' );
# add_action( 'manage_d4am_slider_custom_column', 'Skivvy_AddThumbValue', 10, 2 );
# add_filter( 'manage_d4am_slider_columns', 'Skivvy_AddThumbnailColumn' );
add_filter( 'the_content', 'xautop_slider', 0 );



// Register Script
function jcycle_register() {
	wp_register_script( 'jcycle2', plugins_url( 'jquery.cycle2.min.js' , __FILE__ ), array( 'jquery' ), '1.7', true );
} add_action('init', 'jcycle_register');

// Register Post type
function register_slider_posttype() { 
	register_post_type( 'jCycle_slider', array(
		'labels' => array(
			'name' => 'Slides',
			'singular_name' => 'Slide',
			'menu_name' => 'Slideshow',
			'all_items' => 'Slides',
			#'add_new' => '',
			#'add_new_item' => '',
			#'edit_item' => '',
			#'new_item' => '',
			#'view_item' => '',
		),
		'description' => '',
		'public' => true,
		'supports' => array(
			'title',
			'editor',
			#'author',
			'thumbnail',
			#'excerpt',
			#'trackbacks',
			#'custom-fields',
			#'comments',
			'revisions',
			#'page-attributes',
			#'post-formats'
		),
		#'taxonomies' => '',
		#'has_archive' => '',
		#'rewrite' => false,
		#'can_export' => true
	) );
}

// Remove Auto p for sliders
function xautop_slider( $content )
{
    'jCycle_slider' === get_post_type() && remove_filter( 'the_content', 'wpautop' );
    return $content;
}
?>
