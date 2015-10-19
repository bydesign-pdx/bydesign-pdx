<?php
/* Template Name: Portolio */

get_header(); ?>

<div class="page-wrap">
<div id="page-body" class="page-body">
	<div class="container"><?php

		get_template_part( 'framework/inc/titlebar' ); ?>

		<section class="content">
			<div class="row"><?php
				if (have_posts()) : while (have_posts()) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class("span12 content"); ?>><?php
						the_content();
						wp_link_pages(array("before" => "Pages: ", "next_or_number" => "number")); ?>
					</article><?php
				endwhile; endif;

				if( rwmb_meta('moutheme_portfolio-filter') ) {
					$portfolio_filters = get_terms('portfolio_filter');
					if($portfolio_filters): ?>
						<ul id="filter" class="span12">
							<li><?php _e('Showing', 'moutheme'); ?></li>	
							<li class="active"><a href="#" data-filter="*"><?php _e("All", "moutheme"); ?></a></li><?php
							foreach($portfolio_filters as $portfolio_filter):
								if( rwmb_meta('moutheme_portfoliofilter')  && !in_array("0", rwmb_meta('moutheme_portfoliofilter') ) ):
									if( in_array( $portfolio_filter->term_id, rwmb_meta('moutheme_portfoliofilter') ) ): ?>
										<li><a href="#" data-filter=".term-<?php echo $portfolio_filter->slug; ?>"><?php echo $portfolio_filter->name; ?></a></li><?php
									endif;
								else: ?>
									<li data-filter=".term-<?php echo $portfolio_filter->slug; ?>"><a href="#" data-filter=".term-<?php echo $portfolio_filter->slug; ?>"><?php echo $portfolio_filter->name; ?></a></li><?php
								endif;
							endforeach; ?>
						</ul><?php
					endif;
				} ?>
			
				<div id="filterable-portfolio"><?php

					// Make query
					global $wp_query;
					$portfolioitems = $data["text_portfolioitems"]; // Get Items per Page Value
					$paged = get_query_var("paged") ? get_query_var("paged") : 1;
					$args = array(
						"post_type" 		=> "portfolio",
						"posts_per_page" 	=> $portfolioitems,
						"post_status" 		=> "publish",
						"orderby" 			=> "date",
						"order" 			=> "DESC",
						"paged" 			=> $paged
					);
					// Only pull from selected Filters if chosen
					$selectedfilters = rwmb_meta('moutheme_portfoliofilter');
					if($selectedfilters && $selectedfilters[0] == 0) {
						unset($selectedfilters[0]);
					}
					if($selectedfilters){
						$args["tax_query"][] = array(
							"taxonomy" 	=> "portfolio_filter",
							"field" 	=> "ID",
							"terms" 	=> $selectedfilters
						);
					}
					$wp_query = new WP_Query($args);

					// Get layout
					$columns = rwmb_meta('moutheme_columns');

					// Get thumbnail size
					if ($columns == 'span3') {
						$thumb_size = 'portfolio-four';
					} elseif ($columns == 'span4') {
						$thumb_size = 'portfolio-three';
					} else {
						$thumb_size = 'portfolio-two';
					}
					
					// Item Layout
					$item_layout = rwmb_meta('moutheme_item-layout');

					while ( $wp_query->have_posts() ) : $wp_query->the_post();

						$terms = get_the_terms( get_the_ID(), 'portfolio_filter' );

						$embedd = "";
						
						if( rwmb_meta('moutheme_embed') != "") {
							if ( rwmb_meta('moutheme_source') == "youtube" ) {
								$lightbox_link = '<a href="http://www.youtube.com/embed/' . rwmb_meta('moutheme_embed') . '" class="from-left youtube" rel="cbox[portfolio]" title="'. get_the_title() .'"></a>';
		    				} else if ( rwmb_meta('moutheme_source') == "vimeo" ) {
		    					$lightbox_link = '<a href="http://player.vimeo.com/video/' . rwmb_meta('moutheme_embed') . '" class="from-left vimeo" rel="cbox[portfolio]" title="'. get_the_title() .'"></a>';
		    				} else if ( rwmb_meta('moutheme_source') == 'own' ) {
		    					$randomid = rand();
		    					$lightbox_link = '<a href="#embedd-video-' . $randomid . '" class="from-left" title="'. get_the_title() .'" rel="cbox[portfolio]"></a>';
		    					$embedd = '<div id="embedd-video-' . $randomid . '" class="embedd-video"><p>' . rwmb_meta('moutheme_embed') . '</p></div>';
							}
						} else {
							$lightbox_link = '<a href="' . wp_get_attachment_url( get_post_thumbnail_id() ) . '" class="from-left" rel="cbox[portfolio]" title="'. get_the_title() .'">' . __('Open In Lightbox', 'moutheme') . '</a>';
			    		}

						if ( has_post_thumbnail()) { ?> 
							<article class="<?php if($terms) : foreach ($terms as $term) { echo 'term-'.$term->slug.' '; } endif; ?>p-item <?php echo $columns; ?>"><div><?php
								the_post_thumbnail($thumb_size); ?>
								<div class="overlay"><?php
									if( $item_layout == 'overlay_desc' ) { ?>
										<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3><?php
										if( rwmb_meta('moutheme_short-desc') != '' ) { ?><span class="line"></span><p><?php echo rwmb_meta('moutheme_short-desc'); ?></p><?php }
									} ?>
									<nav<?php if( $item_layout == 'overlay' || $item_layout == 'overlay_plus_desc' ) { ?> class="centered"<?php } ?>><?php echo $lightbox_link; ?><a href="<?php the_permalink() ?>" class="from-right"></a></nav>
								</div></div><?php
								if( $item_layout == 'overlay_plus_desc' ) { ?>
									<div class="item-desc">
										<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php
										if( rwmb_meta('moutheme_short-desc') != '' ) echo ('<p>' . rwmb_meta('moutheme_short-desc') . '</p>'); ?>
									</div><?php
								} ?>
							</article><?php
							echo $embedd;
						}

					endwhile; ?>
					
				</div>
				<div class="span12"><?php get_template_part('framework/inc/nav/nav'); ?></div>
			</div>
		</section>
	</div>
</div>
<?php get_footer(); ?>