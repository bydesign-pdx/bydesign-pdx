<?php get_header(); ?>

	<header class="page-header bg-color">
		<div class="container">
			<div class="row">
				<div class="span12">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</div>
			</div>
			<div class="setsquare">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="40.566px" height="10px" viewBox="0 0 40.566 10" enable-background="new 0 0 40.566 10" xml:space="preserve">
				<path fill-rule="evenodd" clip-rule="evenodd" fill="#111111" d="M28.284,2c-3.806,2.188-8,8-8,8s-4.214-5.957-8.062-8.062
					C8.742,0.035,0,0,0,0h40.566C40.566,0,31.703,0.035,28.284,2z"/>
				</svg>
			</div>
			<div class="setsquare two">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
					 width="40.566px" height="10px" viewBox="0 0 40.566 10" enable-background="new 0 0 40.566 10" xml:space="preserve">
				<path fill-rule="evenodd" clip-rule="evenodd" fill="#111111" d="M28.284,2c-3.806,2.188-8,8-8,8s-4.214-5.957-8.062-8.062
					C8.742,0.035,0,0,0,0h40.566C40.566,0,31.703,0.035,28.284,2z"/>
				</svg>
			</div>
		</div>
	</header><!-- .page-header -->

	<div id="primary" class="container">
		<div class="row">
			<div id="content" class="span12 bg-dark" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'image-attachment' ); ?>>
					<div class="entry-meta">
						<?php
							$published_text = '<span class="attachment-meta">%1$s <time class="entry-date" datetime="%2$s">%3$s</time> %4$s <a href="%5$s" title="%6$s %7$s" rel="gallery">%8$s</a></span>';
							$post_title = get_the_title( $post->post_parent );
							if ( empty( $post_title ) || 0 == $post->post_parent )
								$published_text = '<span class="attachment-meta"><time class="entry-date" datetime="%2$s">%3$s</time></span>';

							printf( $published_text,
                __( 'Published on', 'flatroom' ),
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
                __( 'in', 'flatroom' ),
								esc_url( get_permalink( $post->post_parent ) ),
                __( 'Return to', 'flatroom' ),
								esc_attr( strip_tags( $post_title ) ),
								$post_title
							);

							$metadata = wp_get_attachment_metadata();
							printf( '<span class="attachment-meta full-size-link"><a href="%1$s" title="%2$s">%3$s (%4$s &times; %5$s)</a></span>',
								esc_url( wp_get_attachment_url() ),
								esc_attr__( 'Link to full-size image', 'flatroom' ),
								__( 'Full resolution', 'flatroom' ),
								$metadata['width'],
								$metadata['height']
							);

							edit_post_link( __( ' Edit', 'flatroom' ), '<span class="edit-link">', '</span>' );
						?>
					</div><!-- .entry-meta -->
	
					<div class="entry-content">
						<nav id="image-navigation" class="navigation image-navigation no-border" role="navigation">
							<span class="nav-previous pull-left"><?php previous_image_link( false, '<span class="meta-nav">←</span> ' . __( 'Previous', 'flatroom' ) ); ?></span>
							<span class="nav-next pull-right"><?php next_image_link( false, __( 'Next', 'flatroom' ) . ' <span class="meta-nav">→</span>' ); ?></span>
						</nav><!-- #image-navigation -->
	
						<div class="entry-attachment">
							<div class="attachment">
								<?php flatroom_the_attached_image(); ?>
	
								<?php if ( has_excerpt() ) : ?>
								<div class="entry-caption">
									<?php the_excerpt(); ?>
								</div>
								<?php endif; ?>
							</div><!-- .attachment -->
						</div><!-- .entry-attachment -->
	
						<?php if ( ! empty( $post->post_content ) ) : ?>
						<div class="entry-description">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'flatroom' ), 'after' => '</div>' ) ); ?>
						</div><!-- .entry-description -->
						<?php endif; ?>
	
					</div><!-- .entry-content -->
				</article><!-- #post -->
	
				<?php comments_template(); ?>
	
			</div><!-- #content -->
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>