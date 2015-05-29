<?php get_header(); ?>

	<header class="page-header bg-color">
		<div class="container">
			<div class="row">
				<div class="span12">
					<h1 class="entry-title"><?php _e( 'Not found', 'flatroom' ); ?></h1>
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
				<div class="page-content">
					<h2><?php _e( "This is somewhat embarrassing, isn't it?", 'flatroom' ); ?></h2>
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try a search?', 'flatroom' ); ?></p>

					<div class="row">
						<div class="span6"><?php get_search_form(); ?></div>
					</div>
				</div><!-- .page-content -->
			</div><!-- #content -->
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>