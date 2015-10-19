<section class="p-item p-item-full span9"><?php
	if(rwmb_meta('moutheme_embed') == ""){ ?>	
		<div id="portfolio-slider" class="flexslider"><?php

		    $images = rwmb_meta( 'moutheme_screenshot', 'type=image&size=portfolio-mini' );

			if($images) { ?>
				<ul class="slides"><?php
					foreach ( $images as $image ) {
						echo ('<li><a href="' . $image['full_url'] . '"><img src="' . $image['url'] . '" alt="' . $image['title'] . '"></a></li>');
					} ?>
				</ul><?php
			} ?>
	    </div><?php
	} else {
	    if (rwmb_meta('moutheme_source') == 'vimeo') {
	        echo ('<div id="portfolio-video"><iframe src="http://player.vimeo.com/video/' . rwmb_meta('moutheme_embed') . '?title=0&amp;byline=0&amp;portrait=0&amp;color=ffffff" width="960" height="540" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>');
	    } else if (rwmb_meta('moutheme_source') == 'youtube') {
	        echo ('<div id="portfolio-video"><iframe width="960" height="540" src="http://www.youtube.com/embed/' . rwmb_meta('moutheme_embed') . '?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" frameborder="0" allowfullscreen></iframe></div>');
	    } else {
	        echo ('<div id="portfolio-video">' . rwmb_meta('moutheme_embed') . '</div>');
	    }
	} ?>
</section>
<section class="p-item-description span3"><?php
	get_template_part('framework/inc/nav/nav-portfolio');
	the_content(); ?>
</section>