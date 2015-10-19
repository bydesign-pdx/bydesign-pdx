<?php get_header();

global $smof_data; ?>

<div class="page-wrap">
<?php get_template_part( 'framework/inc/slider' ); ?>
<div id="page-body" class="page-body">
	<div class="container"><?php

		get_template_part( 'framework/inc/titlebar' ); ?>

		<article class="content">
			<div class="row"><?php

				if (have_posts()) : while (have_posts()) : the_post();
		
					if (rwmb_meta('moutheme_portfolio-detaillayout') == "default") {
						$layout = $smof_data['portfolio_layout'];
					} else {
						$layout = rwmb_meta('moutheme_portfolio-detaillayout');
					}

					if ( $layout == "portfolio_full" ) {
						get_template_part('framework/inc/portfolio/full');
					} else {
						get_template_part('framework/inc/portfolio/minimal');
					}

					$item_layout = rwmb_meta('moutheme_item-layout');

					if( $smof_data['related_items'] ) { // Show related Posts Projects specific ?>

						<div id="related-portfolio"><h2 class="span12"><?php _e('Related Projects', 'moutheme'); ?></h2><?php

						// Get layout
						$columns = $smof_data['related_columns'];

						// Get thumbnail size
						if ($columns == '4 columns') {
							$thumb_size = 'portfolio-four';
							$columns = 'span3';
							$quantity = 4;
						} elseif ($columns == '3 columns') {
							$thumb_size = 'portfolio-three';
							$columns = 'span4';
							$quantity = 3;
						} else {
							$thumb_size = 'portfolio-two';
							$columns = 'span6';
							$quantity = 2;
						}

						$terms = get_the_terms( $post->ID , 'portfolio_filter', 'string');
						$term_ids = array_values( wp_list_pluck( $terms,'term_id' ) );
						$second_query = new WP_Query( array(
							'post_type' => 'portfolio',
							'tax_query' => array(
								array(
									'taxonomy' => 'portfolio_filter',
									'field' => 'id',
									'terms' => $term_ids,
									'operator'=> 'IN' //Or 'AND' or 'NOT IN'
								)),
							'posts_per_page' => $quantity,
							'ignore_sticky_posts' => 1,
							'orderby' => 'date',  // 'rand' for random order
							'post__not_in'=>array($post->ID)
						   ));
							
						//Loop through posts and display...
						if($second_query->have_posts()) {
							while ($second_query->have_posts() ) : $second_query->the_post(); 

								$embedd = "";
								
								if( get_post_meta( get_the_ID(), "moutheme_embed", true ) != "") {
									if ( get_post_meta( get_the_ID(), "moutheme_source", true ) == "youtube" ) {
										$lightbox_link = '<a href="http://www.youtube.com/watch?v='.get_post_meta( get_the_ID(), 'moutheme_embed', true ).'" class="from-left" rel="cbox[portfolio]" title="'. get_the_title() .'"><i class="icon-play"></i></a>';
				    				} else if ( get_post_meta( get_the_ID(), "moutheme_source", true ) == "vimeo" ) {
				    					$lightbox_link = '<a href="http://vimeo.com/'. get_post_meta( get_the_ID(), 'moutheme_embed', true ) .'" class="from-left" rel="cbox[portfolio]" title="'. get_the_title() .'"><i class="icon-play"></i></a>';
				    				} else if ( get_post_meta( get_the_ID(), 'moutheme_source', true ) == 'own' ) {
				    					$randomid = rand();
				    					$lightbox_link = '<a href="#embedd-video-'.$randomid.'" class="from-left" title="'. get_the_title() .'" rel="cbox[portfolio]"><i class="icon-play"></i></a>';
				    					$embedd = '<div id="embedd-video-'.$randomid.'" class="embedd-video"><p>'. get_post_meta( get_the_ID(), 'moutheme_embed', true ) .'</p></div>';
									}
								} else {
									$lightbox_link = '<a href="'. wp_get_attachment_url( get_post_thumbnail_id() ) .'" class="from-left" rel="cbox[portfolio]" title="'. get_the_title() .'"><i class="icon-search"></i></a>';
					    		}

								// Related Item Layout
								$item_layout = $smof_data['related_view'];

								if ( has_post_thumbnail()) { ?>
								<article class="p-item <?php echo $columns; ?>"><div><?php
									the_post_thumbnail($thumb_size); ?>
										<div class="overlay"><?php
											if( $item_layout == 'overlay with description' ) { ?>
												<h3><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h3><?php
												if( rwmb_meta('moutheme_short-desc') != '' ) { ?><span class="line"></span><p><?php echo rwmb_meta('moutheme_short-desc'); ?></p><?php }
											} ?>
											<nav<?php if( $item_layout == 'overlay' || $item_layout == 'overlay + description' ) { ?> class="centered"<?php } ?>><?php echo $lightbox_link; ?><a href="<?php the_permalink() ?>" class="from-right"></a></nav>
										</div></div><?php
										if( $item_layout == 'overlay + description' ) { ?>
											<div class="item-desc">
												<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><?php
												if( rwmb_meta('moutheme_short-desc') != '' ) echo ('<p>' . rwmb_meta('moutheme_short-desc') . '</p>'); ?>
											</div><?php
										} ?>
									</article><?php
									echo $embedd;
								}

						    endwhile;
						    wp_reset_query();
						} ?></div><?php

		} //end related specific
	
		endwhile; endif; ?>
	</div>
</div>
<?php get_footer(); ?>