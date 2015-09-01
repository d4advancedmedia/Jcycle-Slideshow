<?php #17Aug15


// Register Post type
	add_action('init', 'register_d4slideshow_posttype');
	function register_d4slideshow_posttype() {

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
			'public' => false,
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

	}

//		Remove Auto p for sliders
	function xautop_d4slideshow( $content ) {
		'skivvy_slider' === get_post_type() && remove_filter( 'the_content', 'wpautop' );
		return $content;
	} add_filter( 'the_content', 'xautop_d4slideshow', 0 );



//		Register admin style
	add_action( 'admin_enqueue_scripts', 'd4slideshow_admin_style' );
	function d4slideshow_admin_style() {

		// Styles
		wp_register_style( 'skivvy_admin_slideshow_style', plugins_url( '/lib/admin/admin.css' , __FILE__ ), false, 1, 'screen' );
		wp_enqueue_style( 'skivvy_admin_slideshow_style' );

	}
	


//		add Slideshow to admin bar
	add_action('wp_before_admin_bar_render', 'slideshow_admin_bar', 30);
	function slideshow_admin_bar() {
		global $wp_admin_bar;
		$wp_admin_bar->add_menu( array(
			'parent' => 'site-name',
			'id' => 'slideshow',
			'title' => __('Slideshow'),
			'href' => admin_url( 'edit.php?post_type=skivvy_slider'),
			'meta' => false // array( 'html' => '', 'class' => '', 'onclick' => '', target => '', title => '' );
		));
	}


//		Add Thumbnails in Manage Custom Post Type List
	add_filter( 'manage_skivvy_slider_posts_columns', 'd4slideshow_slider_AddThumbColumn' );
	function d4slideshow_slider_AddThumbColumn($columns) {
		$new = array();
		foreach($columns as $key => $title) {
			if ($key == 'title') {
				$new['slider_thumbnail'] = __('Thumb', 'skivvy');
			} // Put the Thumbnail column before the Author column
			$new[ $key ] = $title;
		}
		return $new;
	}
	add_action( 'manage_skivvy_slider_posts_custom_column', 'd4slideshow_slider_AddThumbValue', 10, 6 );
	function d4slideshow_slider_AddThumbValue($column_name, $post_id) {

		if ( 'slider_thumbnail' == $column_name ) :

			// thumbnail of WP 2.9
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );
			// image from gallery
			$attachments = get_children( array('post_parent' => $post_id, 'post_type' => 'attachment', 'post_mime_type' => 'image') );
			if ($thumbnail_id)
				$thumb = wp_get_attachment_image( $thumbnail_id, 'thumbnail', true );
			elseif ($attachments) {
				foreach ( $attachments as $attachment_id => $attachment ) {
					$thumb = wp_get_attachment_image( $attachment_id, 'thumbnail', true );
				}
			}
			if ( isset($thumb) && $thumb ) {
				edit_post_link( $thumb, '', '', $post_id );
			} else {
				echo __('None');
			}

		endif;
	}



?>
