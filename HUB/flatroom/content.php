<article id="post-<?php the_ID(); ?>" <?php if ( is_single() ) { post_class(); } else { post_class( "no-dark" ); }?>>
	<?php if ( is_single() ) : ?>
		<div class="entry-meta">
			<?php _e( 'Posted by', 'flatroom' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php echo get_the_author(); ?>
			</a>
			<?php _e( 'on', 'flatroom' ); ?>
			<?php flatroom_entry_date(); ?>
		</div><!-- .entry-meta -->
		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
			<div class="entry-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
		<?php endif; ?>
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php the_content( __( 'More', 'flatroom' ) . ' <span>&#8250;</span>' ); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>
	<?php else : ?>
		<header class="entry-header">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		</header><!-- .entry-header -->
	
		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
			<div class="entry-summary">
				<?php the_excerpt(); ?>
			</div><!-- .entry-summary -->
		<?php else : ?>
			<div class="entry-content">
				<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
					<div class="entry-thumbnail">
						<?php the_post_thumbnail('thumbnail'); ?>
					</div>
				<?php endif; ?>
				<?php the_excerpt(); ?>
				<div class="clearfix"></div>
			</div><!-- .entry-content -->
		<?php endif; ?>
		<footer class="entry-meta">
			<?php _e( 'Posted by', 'flatroom' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php echo get_the_author(); ?>
			</a>
			<?php _e( 'on', 'flatroom' ); ?>
			<?php flatroom_entry_date(); ?>
		</footer><!-- .entry-meta -->
	<?php endif; ?>
</article><!-- #post -->
