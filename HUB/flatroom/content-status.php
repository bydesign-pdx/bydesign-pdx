<article id="post-<?php the_ID(); ?>" <?php if ( is_single() ) { post_class( "bg-dark" ); } else { post_class(); }?>>
	<div class="entry-content">
		<?php the_content( __( 'More', 'flatroom' ) . ' <span>&#8250;</span>' ); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'flatroom' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php flatroom_entry_date(); ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
