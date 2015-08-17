<?php #17Aug15a

// Register shortcode
	add_shortcode('slideshow','register_d4slideshow_slideshow');
	add_shortcode('slide','register_d4slideshow_slide');
	function register_d4slideshow_slideshow( $atts, $content = null ) {
			wp_enqueue_script('jcycle2');
			$attr = shortcode_atts( array(
				'time' => '4000'
			), $atts );
			$output = '<div class="cycle-slideshow" style="position:relative;" data-cycle-slides=".cycle-slide" data-timeout="' . $attr['time'] . '" >';
				$output .= do_shortcode($content);
			$output .= '</div>';
			return $output;

	}
	function register_d4slideshow_slide( $atts, $content = null ) {
		$attr = shortcode_atts( array(
			'img'   => '',
			'style' => '',
			'class' => '',
			'autop' => 'true'
		), $atts );
		// SLIDE
		if ( $attr['img'] != '' ) {
			$background_image = 'background-image:url(\'' . $attr['img'] . '\');';
		}

		$output = '<div class="cycle-slide '. $attr['class'] . '" style="position:absolute;' . $background_image . ' ' . $attr['style'] .'">';
			$output .= '<div class="cycle-content">';
				$output .= '<div class="page-wrapper">';
					if ( $attr['autop'] == 'true' ) {
						$output .= wpautop(apply_filters( 'the_content' , $content));
					} else {
						$output .= apply_filters( 'the_content' , $content);
					}
				$output .= '</div>';
			$output .= '</div>';
		$output .= '</div>';
		return $output;
	} 



?>
