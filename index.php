<?php /*
	Plugin Name: WP Jcycle2
	Plugin URI: https://github.com/atelierabbey/WPJcycle
	Description: A simple slider plugin - based on Malsup's Cycle2 http://jquery.malsup.com/cycle2/.
	Version: 26Feb14
	Author: Grayson A.C. Laramore
	Author URI: http://wwww.SillyCoyote.com
	License: GPL2
*/


function wpjcycle_register() {

	// Register Script
		wp_register_script( 'jcycle2', plugins_url( 'jquery.cycle2.min.js' , __FILE__ ), array( 'jquery' ), '1.7', true );

	// Register Post type
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

} add_action('init', 'wpjcycle_register');




// add Slideshow to admin bar
function wpjcycle_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' => 'site-name',
		'id' => 'slideshow',
		'title' => __('Slideshow'),
		'href' => admin_url( 'edit.php?post_type=jcycle_slider'),
		'meta' => false // array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
	));
} add_action('wp_before_admin_bar_render', 'skivvy_admin_bar', 0);




// Remove Auto p for sliders
function xautop_slider( $content ) {

		'jCycle_slider' === get_post_type() && remove_filter( 'the_content', 'wpautop' );
		return $content;

} add_filter( 'the_content', 'xautop_slider', 0 );
?>