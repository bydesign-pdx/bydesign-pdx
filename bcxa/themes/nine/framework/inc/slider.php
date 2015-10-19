<?php
global $smof_data;

$slider_type = rwmb_meta('moutheme_slider_type');
$slider_revolution = rwmb_meta('moutheme_revolutionslider');
$slider_flex = rwmb_meta('food_wine_slider_custom', 'type=taxonomy&taxonomy=slider');


if ( $slider_type == 'none' ) {}
elseif ( $slider_revolution && $slider_type == 'revolution' ) {

	putRevSlider("$slider_revolution");

} elseif ( $slider_flex[0] -> slug && $slider_type == 'flex' ) {

	// Get default slides
	$slider_query = new WP_Query(array(
		'post_type' => 'slide',
		'slider'    => $slider_flex[0] -> slug,
		'posts_per_page' => -1
	));

	if ( $slider_query->have_posts() ) : ?>
	<div id="main-slider"><div class="flexslider"><ul class="slides"><?php

		while ( $slider_query->have_posts() ) :
			$slider_query->the_post();

			$images = rwmb_meta( 'moutheme_slide_image', 'type=image&size=full' );

			$slide_image = array_shift( array_values( rwmb_meta('moutheme_slide_image', 'type=image') ) );

			$caption = rwmb_meta('moutheme_caption');
			if($caption != '') {
				$cap_strings = '';
				$cap_lines = explode("\n", $caption);
				foreach($cap_lines as $string) {
					$cap_strings .= '<span>' . $string . '</span>';
				}
			}

			$button_text = rwmb_meta('moutheme_button_text');
			$button_url = rwmb_meta('moutheme_button_url');

			$position = rwmb_meta('moutheme_position'); ?>

			<li><?php if($images) {
					foreach ( $images as $image ) {
						echo ('<img src="' . $image['url'] . '" alt="' . $image['title'] . '">');
					}
				}
				if($position == 'pos-center') { ?>
					<div class="caption pos-center">
					<div class="cap-media"><?php
						if (rwmb_meta('moutheme_source') == 'vimeo') {
					        echo ('<div class="slider-video"><iframe src="http://player.vimeo.com/video/' . rwmb_meta('moutheme_embed') . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="960" height="540" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>');
					    } else if (rwmb_meta('moutheme_source') == 'youtube') {
					        echo ('<div class="slider-video"><iframe width="960" height="540" src="http://www.youtube.com/embed/' . rwmb_meta('moutheme_embed') . '?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe></div>');
					    } else {
					        echo ('<div class="slider-video">' . rwmb_meta('moutheme_embed') . '</div>');
					    } ?>
					</div><?php
					if( $cap_strings != '' || $button_text != '' ) { ?>
						<div class="cap-container"><?php
							if( $cap_strings != '' ) { ?><div class="cap-text" data-effect-in="fadeInRight" data-effect-out="fadeOutLeft"><?php echo $cap_strings; ?></div><?php }
							if( $button_text != '' ) { ?><div class="cap-button" data-effect-in="fadeInLeft" data-effect-out="fadeOutRight"><a class="btn btn-color btn-large" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a></div><?php } ?>
						</div><?php
					} ?></div><?php
				} elseif($position == 'pos-top-left') { ?>
					<div class="caption pos-top-left"><?php
					if( $cap_strings != '' || $button_text != '' ) { ?>
						<div class="cap-container"><?php
							if( $cap_strings != '' ) { ?><div class="cap-text" data-effect-in="fadeInRight" data-effect-out="fadeOutLeft"><?php echo $cap_strings; ?></div><?php }
							if( $button_text != '' ) { ?><div class="cap-button" data-effect-in="fadeInLeft" data-effect-out="fadeOutRight"><a class="btn btn-color btn-large" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a></div><?php } ?>
						</div><?php
					} ?></div><?php
				} elseif($position == 'pos-bottom-left') { ?>
					<div class="caption pos-bottom-left"><?php
					if( $cap_strings != '' || $button_text != '' ) { ?>
						<div class="cap-container"><?php
							if( $cap_strings != '' ) { ?><div class="cap-text" data-effect-in="fadeInLeft" data-effect-out="fadeOutRight"><?php echo $cap_strings; ?></div><?php }
							if( $button_text != '' ) { ?><div class="cap-button" data-effect-in="fadeInRight" data-effect-out="fadeOutLeft"><a class="btn btn-color btn-large" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a></div><?php } ?>
						</div><?php
					} ?></div><?php
				} elseif($position == 'pos-top-right') { ?>
					<div class="caption pos-top-right"><?php
					if( $cap_strings != '' || $button_text != '' ) { ?>
						<div class="cap-container"><?php
							if( $cap_strings != '' ) { ?><div class="cap-text" data-effect-in="fadeInLeft" data-effect-out="fadeOutRight"><?php echo $cap_strings; ?></div><?php }
							if( $button_text != '' ) { ?><div class="cap-button" data-effect-in="fadeInRight" data-effect-out="fadeOutLeft"><a class="btn btn-color btn-large" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a></div><?php } ?>
						</div><?php
					} ?></div><?php
				} else { ?>
					<div class="caption pos-bottom-right"><?php
					if( $cap_strings != '' || $button_text != '' ) { ?>
						<div class="cap-container"><?php
							if( $cap_strings != '' ) { ?><div class="cap-text" data-effect-in="fadeInRight" data-effect-out="fadeOutLeft"><?php echo $cap_strings; ?></div><?php }
							if( $button_text != '' ) { ?><div class="cap-button" data-effect-in="fadeInLeft" data-effect-out="fadeOutRight"><a class="btn btn-color btn-large" href="<?php echo $button_url; ?>"><?php echo $button_text; ?></a></div><?php } ?>
						</div><?php
					} ?></div><?php
				} ?>
			</li><?php

		endwhile; ?>
	</ul></div></div><?php
	endif;
	wp_reset_query();
	
}