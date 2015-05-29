<?php get_header(); ?>

	<header class="page-header bg-color">
		<div class="container">
			<div class="row">
				<div class="span3 pull-right">
					<div id="breadcrumb">
						<?php flatroom_breadcrumb(); ?>
					</div>
				</div>
				<div class="span9">
					<h1 class="entry-title"><?php
						if ( is_day() ) :
							printf( __( 'Daily Archives: %s', 'flatroom' ), get_the_date() );
						elseif ( is_month() ) :
							printf( __( 'Monthly Archives: %s', 'flatroom' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'flatroom' ) ) );
						elseif ( is_year() ) :
							printf( __( 'Yearly Archives: %s', 'flatroom' ), get_the_date( _x( 'Y', 'yearly archives date format', 'flatroom' ) ) );
						else :
							_e( 'Archives', 'flatroom' );
						endif;
					?></h1>
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

	<?php
		$flatroom_settings = get_option( "flatroom_settings" );
		if ($flatroom_settings['cat_template'] == "cat_not") {
			$content_class = "span12";
		} elseif ($flatroom_settings['cat_template'] == "cat_left") {
			$content_class = "span9";
			$primary_class = "left-sidebar";
		} else {
			$content_class = "span9";
			$primary_class = "right-sidebar";
		}
	?>

	<div id="primary" class="container <?php echo $primary_class; ?>">
		<div class="row">
			<div id="content" class="<?php echo $content_class; ?>" role="main">
			<?php if ( have_posts() ) : ?>
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'content', get_post_format() ); ?>
				<?php endwhile; ?>
	
				<?php flatroom_paging_nav(); ?>
			<?php else : ?>
				<?php get_template_part( 'content', 'none' ); ?>
			<?php endif; ?>
			</div><!-- #content -->
			<?php
				if ($flatroom_settings['cat_template'] !== "cat_not") {
					get_sidebar('post');
				}
			?>
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>