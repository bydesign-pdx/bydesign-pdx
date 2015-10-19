<?php
/**
 * Template Name: Posts Archive Template
 *
 * Description: Displays an archive of posts, ordered by date.
 *
 * @package Quark
 * @since Quark 1.0
 */

get_header(); ?>

	<div id="primary" class="site-content row" role="main">

		<div class="col grid_8_of_12">
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<h3 class="menu-toggle assistive-text"><?php esc_html_e( 'Menu', 'quark' ); ?></h3>
				<div class="assistive-text skip-link"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'quark' ); ?>"><?php esc_html_e( 'Skip to content', 'quark' ); ?></a></div>
				<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
			</nav> <!-- /.site-navigation.main-navigation -->
			<?php if ( have_posts() ) : ?>

				<?php // Start the Loop ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', 'postarchives' ); ?>
				<?php endwhile; ?>

			<?php else : ?>

				<?php get_template_part( 'no-results' ); // Include the template that displays a message that posts cannot be found ?>

			<?php endif; // end have_posts() check ?>

		</div> <!-- /.col.grid_8_of_12 -->
		<?php get_sidebar(); ?>

	</div> <!-- /#primary.site-content.row -->

<?php get_footer(); ?>
