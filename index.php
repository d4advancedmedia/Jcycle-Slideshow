<?php
/*
	Plugin Name: Cycle 2 Slideshow
	Plugin URI: https://github.com/d4advancedmedia/Slideshow
	GitHub Theme URI: https://github.com/d4advancedmedia/Slideshow
	GitHub Branch: master
	Description: A simple slider plugin - based on Malsup's Cycle2 http://jquery.malsup.com/cycle2/.
	Version: 17Aug15
	Author: D4 Adv. Media
	License: GPL2
*/
include ('inc/lib/skivvy_slideshow.php');
include ('inc/lib/metabox-video-attachment.php');

function skivvy_admin_slideshow_style() {

	// Styles
	wp_register_style( 'skivvy_admin_slideshow_style', plugins_url( '/inc/admin/admin.css' , __FILE__ ), false, 1, 'screen' );
	wp_enqueue_style( 'skivvy_admin_slideshow_style' );


}
add_action( 'admin_enqueue_scripts', 'skivvy_admin_slideshow_style' );
?>
