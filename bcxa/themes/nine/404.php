<?php get_header();

global $smof_data; ?>

<div class="page-wrap">
<div id="page-body" class="page-body">
	<div class="container">
		<div id="page-title">
			<hgroup>
				<h2><?php _e( 'error 404', 'moutheme' ); ?></h2>
				<h1><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'moutheme' ); ?></h1>
			</hgroup>
		</div>
		<div class="row">
			<div class="span12" id="main-col">
				<div id="page-404">
					<h1><?php _e( '404', 'moutheme' ); ?></h1>
					<h2><?php _e( "The page you've searched for has not been found.", 'moutheme' ); ?></h2>
					<a href="<?php echo home_url(); ?>/" class="btn btn-color"><?php _e( 'Go to Homepage', 'moutheme' ); ?></a>
				</div>
			</div>
		</div>
	</div>
</div>

<?php get_footer(); ?>