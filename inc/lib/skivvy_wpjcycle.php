<?php 
/*
 *
 *		Register Posttype & Script
 *
 */
function register_skivvy_wpjcycle() {

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
			'menu_icon' => 'dashicons-images-alt2',
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

} add_action('init', 'register_skivvy_wpjcycle');



/*
 *
 *		add Slideshow to admin bar
 *
 */
function wpjcycle_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' => 'site-name',
		'id' => 'slideshow',
		'title' => __('Slideshow'),
		'href' => admin_url( 'edit.php?post_type=jcycle_slider'),
		'meta' => false // array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
	));
} add_action('wp_before_admin_bar_render', 'wpjcycle_admin_bar', 30);



/*
 *
 *		Remove Auto p for sliders
 *
 */
function xautop_slider( $content ) {

		'jCycle_slider' === get_post_type() && remove_filter( 'the_content', 'wpautop' );
		return $content;

} add_filter( 'the_content', 'xautop_slider', 0 );
?>