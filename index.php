<?php
/*
	Plugin Name: D4 Slideshow
	Plugin URI: https://github.com/d4advancedmedia/Slideshow
	GitHub Theme URI: https://github.com/d4advancedmedia/Slideshow
	GitHub Branch: master
	Description: A simple slider plugin - based on Malsup's Cycle2 http://jquery.malsup.com/cycle2/.
	Version: 17Aug15
	Author: D4 Adv. Media
	License: GPL2
*/

// Register Script
	add_action( 'wp_enqueue_scripts', 'register_d4slideshow_script' );
	function register_d4slideshow_script() {
		wp_register_script( 'jcycle2', plugins_url( '/js/jquery.cycle2.min.js' , __FILE__ ), array( 'jquery' ), 'v20131005', true );
	}



include ('inc/slideshow_shortcode.php');
include ('inc/slideshow_posttype.php');


// Video Metabox & shortcode
# include ('lib/metabox-video-attachment.php');

?>
