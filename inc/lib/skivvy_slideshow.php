<?php
/*
*
*		Register Posttype & Script
*
*/
function register_skivvy_slideshow() {

// Register Script
	wp_register_script( 'jcycle2', plugins_url( '../../js/jquery.cycle2.min.js' , __FILE__ ), array( 'jquery' ), '1.7', true );

// Register Post type
	register_post_type(
		'skivvy_slider',
		array( 'labels' => array(
				'name' => 'Slides',
				'singular_name' => 'Slide',
				'menu_name' => 'Slideshow',
				'all_items' => 'Slides',
				'add_new' => 'New Slide',
				'add_new_item' => 'New Slide',
				'edit_item' => 'Edit Slide',
				'new_item' => 'New Slide',
				'view_item' => 'View Slide',
		),
		'description' => '',
		'menu_icon' => 'dashicons-images-alt2',
		'public' => true,
		'exclude_from_search' => true,
		'show_in_nav_menus' => false,
		'supports' => array(
			'title',
			'editor',
			#'author',
			'thumbnail',
			#'excerpt',
			#'trackbacks',
			'custom-fields',
			#'comments',
			'revisions',
			#'page-attributes',
			#'post-formats'
		),
		#'taxonomies' => '',
		#'has_archive' => '',
		#'rewrite' => false,
		#'can_export' => true,
	) );

} add_action('init', 'register_skivvy_slideshow');



/*
 *
 *		add Slideshow to admin bar
 *
 */
function slideshow_admin_bar() {
	global $wp_admin_bar;
	$wp_admin_bar->add_menu( array(
		'parent' => 'site-name',
		'id' => 'slideshow',
		'title' => __('Slideshow'),
		'href' => admin_url( 'edit.php?post_type=skivvy_slider'),
		'meta' => false // array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
	));
} add_action('wp_before_admin_bar_render', 'slideshow_admin_bar', 30);



/*
 *
 *		Remove Auto p for sliders
 *
 */
function xautop_slider( $content ) {
	'skivvy_slider' === get_post_type() && remove_filter( 'the_content', 'wpautop' );
	return $content;
} add_filter( 'the_content', 'xautop_slider', 0 );




/*
**
**		Add Thumbnails in Manage Posts/Pages List
**
*/
function skivvy_slider_AddThumbColumn($columns) {
	$new = array();
	foreach($columns as $key => $title) {
		if ($key == 'title') {
			$new['slider_thumbnail'] = __('Thumb', 'skivvy');
		} // Put the Thumbnail column before the Author column
		$new[ $key ] = $title;
	}
	return $new;
}
add_filter( 'manage_skivvy_slider_posts_columns', 'skivvy_slider_AddThumbColumn' );


function skivvy_slider_AddThumbValue($column_name, $post_id) {

	$width = (int) 60;
	$height = (int) 60;

	if ( 'slider_thumbnail' == $column_name ) :

		// thumbnail of WP 2.9
		$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
		// image from gallery
		$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
		if ($thumbnail_id)
			$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
		elseif ($attachments) {
			foreach ( $attachments as $attachment_id => $attachment ) {
				$thumb = wp_get_attachment_image( $attachment_id, array($width, $height), true );
			}
		}
		if ( isset($thumb) && $thumb ) {
			edit_post_link( $thumb, '', '', $post_id );
		} else {
			echo __('None');
		}

	endif;
}
add_action( 'manage_skivvy_slider_posts_custom_column', 'skivvy_slider_AddThumbValue', 10, 6 );


?>