<?php
if ( is_active_sidebar( 'sidebar-page' ) ) : ?>
	<div id="sidebar" class="span3 sidebar" role="complementary">
		<a href="#" class="sidebar-button">
			<span></span>
			<span></span>
			<span></span>
		</a>
		<a href="#" class="close">close <span>&#215;</span></a>
		<div class="clearfix"></div>
		<div class="bg-sidebar"></div>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar-page' ); ?>
		</div><!-- .widget-area -->
	</div><!-- #sidebar -->
<?php else : ?>
	<div id="sidebar" class="span3 sidebar" role="complementary">
		<a href="#" class="sidebar-button">
			<span></span>
			<span></span>
			<span></span>
		</a>
		<a href="#" class="close">close <span>&#215;</span></a>
		<div class="clearfix"></div>
		<div class="bg-sidebar"></div>
		<div class="widget-area">
			<?php dynamic_sidebar( 'sidebar' ); ?>
		</div><!-- .widget-area -->
	</div><!-- #sidebar -->
<?php endif; ?>