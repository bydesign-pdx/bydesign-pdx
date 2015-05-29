<article id="post-<?php the_ID(); ?>" <?php if ( is_single() ) { post_class( "bg-dark" ); } else { post_class(); }?>>
	<?php if ( is_single() ) : ?>
		<div class="entry-meta">
			<?php _e( 'Posted by', 'flatroom' ); ?>
			<a class="author-link" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
				<?php echo get_the_author(); ?>
			</a>
			<?php _e( 'on', 'flatroom' ); ?>
			<?php flatroom_entry_date(); ?>
		</div><!-- .entry-meta -->
		<div class="entry-content">
			<?php the_content( __( 'More', 'flatroom' ) . ' <span>&#8250;</span>' ); ?>
		</div><!-- .entry-content -->
	<?php else : ?>
		<header class="entry-header">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
		</header><!-- .entry-header -->
	
		<div class="entry-content">
			<?php the_content( __( 'More', 'flatroom' ) . ' <span>&#8250;</span>' ); ?>
		</div><!-- .entry-content -->
		
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
