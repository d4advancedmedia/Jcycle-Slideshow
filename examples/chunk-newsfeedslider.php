<?php

// Enqueue script
	wp_enqueue_script('jcycle2');
	wp_enqueue_script('cycle2-carousel');





// Slide Loop
	$slidequery = new WP_Query(array(
				// 'post_type' => 'skivvy_slider',
				'posts_per_page' => 4,
				'order' => 'DESC',
				'orderby' => 'date'
	));
	$slideArray = array();
	while ( $slidequery->have_posts() ) {
		$slidequery->the_post();

		$background_image = '';
		if (has_post_thumbnail()) {
			$image_url = wp_get_attachment_image_src(get_post_thumbnail_id(),'slideshow', true);
			$background_image = $image_url[0];
		}

		$slideArray[] = array(
			'title'   => get_the_title(),
			'time'    => get_the_time('F j, Y'),
			'content' => get_the_snippet( array ( 'length' =>20, 'more' => '' )),
			'url'     => get_permalink(),
			'bgimg'   => $background_image
		);
	} wp_reset_postdata();

// Slide generation
	$i = 1;
	foreach ($slideArray as $slide) {
		
		$background_image = '';
		if ( $slide['bgimg'] != '' ) {
			$background_image = 'background-image:url(' . $slide['bgimg'] . ');';
		}
		// Generate $output1
			$output1 .= '<div class="cycle-slide sliderdft'. $i.'" style="position:absolute;' . $background_image . '"';
			/*$output1 .= ' data-cycle-pager-template="<div>'.
														'<h3>'. $slide['title'] . '</h3>'.
														'<div>' .
														'<span>' .
														'<small>'. $slide['time'] . '</small>'.
															$slide['content'] .
														 '</span>'.
														 '</div>'.
													'</div>"'; //*/
			$output1 .= '>';
				$output1 .= '<h3 class="chunk-dark textright button">';
					$output1 .= '<a href="' . $slide['url'] . '">';
						$output1 .= $slide['title'];
						$output1 .= '<br>';
						$output1 .= '<small>Learn More</small>';
					$output1 .= '</a>';
				$output1 .= '</h3>';
			$output1 .= '</div>';
		// Generate $output2
		
			$output2 .= '<div class="cycle-slide chunk-dark ticker-'. $i .' chunk-dark">';
				$output2 .= '<div class="button">';
					$output2 .= '<a href="'. $slide['url'] .'">';
						$output2 .= '<h4>' . $slide['title'] . '</h4>';
						##$output2 .= '<small class="post_date">[ ' . $slide['time'] . ' ]</small>';	
						$output2 .= '<span>' . $slide['content'] . '</span>' ;
					$output2 .= '</a>';
				$output2 .= '</div>'; //*/
			$output2 .= '</div>'; //*/
		$i++;
	}


// Render slider concotion 
	echo (
		'<div class="one_full">'.
			'<div class="page-wrapper clearfix">'.
				'<div id="slideshow-images" style="position:relative;" class="cycle-slideshow two_third"'.
					' data-cycle-fx="fade"'.
				#	' data-cycle-pager-fx=scrollVert'.
					' data-cycle-slides=".cycle-slide"'.
				#	' data-pause-on-hover="true"'.
					' data-timeout="4000"'.
				#	' data-cycle-pager="#per-slide-template"'.
				'>'.
					$output1.
				'</div>'.
				'<div id="pagers-container" class="one_third chunk-midd">'.
					'<h3>'.
						'Lastest News'.
					'</h3>'.
				#	'<div id="per-slide-template"></div>'.
					'<div id="slideshow-ticker" style="position:relative;" class="cycle-slideshow"'.
						' data-cycle-fx="carousel"'.
						' data-cycle-slides=".cycle-slide"'.
					#	' data-pause-on-hover="true"'.
						' data-timeout="4000"'.
					#	' data-cycle-pager="#per-slide-template"'.
						' data-cycle-carousel-visible=3'.
    					' data-cycle-carousel-vertical=true'.
					'>'.
						$output2 .
					'</div>'.
				'</div>'.
			'</div>'.
		'</div>'
	);

	
?>
