<?php #01Sep15a

// Register shortcode
	add_shortcode('slideshow','register_d4slideshow_slideshow');
	add_shortcode('slide','register_d4slideshow_slide');
	function register_d4slideshow_slideshow( $atts, $content = null ) {
			wp_enqueue_script('jcycle2');
			$attr = shortcode_atts( array(
				'time'         => '4000',
				'pager'        => 'false',
				'slides'       => '.cycle-slide'
			), $atts );
			$output = '<div';
				$output .= ' class="cycle-slideshow"';
				$output .= ' style="position:relative;"';
				$output .= ' data-cycle-slides="' . $attr['slides'] . '"';
				$output .= ' data-timeout="' . $attr['time'] . '"';
				if ( $attr['pager'] != 'false' ) {
					$output .= ' data-cycle-pager="#per-slide-template"';
				}
			$output .= '>';
				$output .= do_shortcode($content);

				if ( $attr['pager'] != 'false' ) {
					$output .= '<div id="per-slide-template"></div>';
				}
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
