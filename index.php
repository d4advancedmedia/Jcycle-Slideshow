<?php
/*
	Plugin Name: D4 Slideshow
	Plugin URI: https://github.com/d4advancedmedia/Slideshow
	GitHub Theme URI: https://github.com/d4advancedmedia/Slideshow
	GitHub Branch: master
	Description: A simple slider plugin - based on Malsup's Cycle2 http://jquery.malsup.com/cycle2/.
	Version: 16Sep15
	Author: D4 Adv. Media
	License: GPL2
*/

// Register Script
	add_action( 'wp_enqueue_scripts', 'register_d4slideshow_script' );
	function register_d4slideshow_script() {
		wp_register_script( 'jcycle2', plugins_url( '/js/jquery.cycle2.min.js' , __FILE__ ), array( 'jquery' ), 'v20131005', true );



		// A plugin for displaying slides in a carousel. A carousel slideshow differs from a normal slideshow in that it displays multiple images at a time while advancing them one-by-one. 
			wp_register_script( 'cycle2-carousel', plugins_url( '/js/jquery.cycle2.carousel.min.js' , __FILE__ ), array( 'jcycle2' ), 'v20141007', true );
		// A plugin for transitioning slides via CSS3 transformations. 
			wp_register_script( 'cycle2-flip', plugins_url( '/js/jquery.cycle2.flip.min.js' , __FILE__ ), array( 'jcycle2' ), 'v20141007', true );
		// A fade/fadeout plugin for old versions of IE. This plugin corrects issues that arise when cleartype is used with opacity. 
			wp_register_script( 'cycle2-iefade', plugins_url( '/js/jquery.cycle2.ie-fade.min.js' , __FILE__ ), array( 'jcycle2' ), 'v20141007', true );
		// A vertical scroll plugin. Similar to the scrollHorz transition effect, but moves slides vertically. 
			wp_register_script( 'cycle2-scrollVert', plugins_url( '/js/jquery.cycle2.scrollVert.min.js' , __FILE__ ), array( 'jcycle2' ), 'v20141007', true );
		// A plugin which supports the classic Cycle Shuffle animation. The shuffle animation is somewhat like moving a card from the top of a deck of cards to the back of the deck, or vice versa. 
			wp_register_script( 'cycle2-shuffle', plugins_url( '/js/jquery.cycle2.shuffle.min.js' , __FILE__ ), array( 'jcycle2' ), 'v20141007', true );
		// A plugin for tile-based slide transitions. Tile animations break images into smaller sections and transition them out piece by piece. Interesting effects can be achieved by changing the direction, tile count, and speed of the transitions. 
			wp_register_script( 'cycle2-tile', plugins_url( '/js/jquery.cycle2.tile.min.js' , __FILE__ ), array( 'jcycle2' ), 'v20141007', true );

		// Support for animating captions and overlays. 
			wp_register_script( 'cycle2-caption2', plugins_url( '/js/jquery.cycle2.caption2.min.js' , __FILE__ ), array( 'jcycle2' ), 'v20141007', true );
		// Support for centering slides horizontally and vertically within the slideshow container. You can do this easily yourself with fixed-size slideshows and simple CSS. This plugin makes life simpler when your slideshow has a fluid width or height. 
			wp_register_script( 'cycle2-center', plugins_url( '/js/jquery.cycle2.center.min.js' , __FILE__ ), array( 'jcycle2' ), 'v20141007', true );
		// If you want swipe events and you're not using jQuery Mobile, download this plugin. This plugin provides support for advancing slides forward or back using a swipe gesture on touch devices. 
			wp_register_script( 'cycle2-swipe', plugins_url( '/js/jquery.cycle2.swipe.min.js' , __FILE__ ), array( 'jcycle2' ), 'v20141007', true );
		// Adds support for autostart/autostop for YouTube video slideshows. 
			wp_register_script( 'cycle2-video', plugins_url( '/js/jquery.cycle2.video.min.js' , __FILE__ ), array( 'jcycle2' ), 'v20141007', true );


	}



include ('inc/slideshow_shortcode.php');
include ('inc/slideshow_posttype.php');


// Video Metabox & shortcode
# include ('lib/metabox-video-attachment.php');

?>
