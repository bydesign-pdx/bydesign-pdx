<h1><?php _e( 'Nothing Found', 'flatroom' ); ?></h1>

<div class="page-content">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php echo __( 'Ready to publish your first post?', 'flatroom' ) . '<a href="' . admin_url( 'post-new.php' ) . '">' . __( 'Get started here', 'flatroom' ) . '</a>.'; ?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'flatroom' ); ?></p>
	<div class="row">
		<div class="span6"><?php get_search_form(); ?></div>
	</div>

	<?php else : ?>

	<p><?php _e( "It seems we can't find what you're looking for. Perhaps searching can help.", 'flatroom' ); ?></p>
	<div class="row">
		<div class="span6"><?php get_search_form(); ?></div>
	</div>

	<?php endif; ?>
</div><!-- .page-content -->