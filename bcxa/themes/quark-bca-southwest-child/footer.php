<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id #maincontentcontainer div and all content after.
 * There are also four footer widgets displayed. These will be displayed from
 * one to four columns, depending on how many widgets are active.
 *
 * @package Quark
 * @since Quark 1.0
 */
?>

		<?php	do_action( 'quark_after_woocommerce' ); ?>
	</div> <!-- /#maincontentcontainer -->

	<div id="footercontainer">

		<footer class="site-footer row" role="contentinfo">
			
			<div class="col grid_4_of_12">
				<div class="widget-area" role="complementary"><?php dynamic_sidebar( 'sidebar-footer'. 1 ); ?></div>
			</div>
			<div class="col grid_3_of_12">
				<div class="widget-area" role="complementary"><?php dynamic_sidebar( 'sidebar-footer'. 2 ); ?></div>
			</div>
			<div class="col grid_5_of_12">
				<div class="widget-area" role="complementary"><?php dynamic_sidebar( 'sidebar-footer'. 3 ); ?></div>
			</div>
			

		</footer> <!-- /.site-footer.row -->

		<?php if ( of_get_option( 'footer_content', quark_get_credits() ) ) {
			echo '<div class="row smallprint">';
			echo apply_filters( 'meta_content', wp_kses_post( of_get_option( 'footer_content', quark_get_credits() ) ) );
			echo '</div> <!-- /.smallprint -->';
		} ?>

	</div> <!-- /.footercontainer -->

</div> <!-- /.#wrapper.hfeed.site -->

<?php wp_footer(); ?>
</body>

</html>
