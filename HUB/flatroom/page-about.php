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
					<h1 class="entry-title"><?php the_title(); ?></h1>
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
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<?php the_content(); ?>
<?php /*
<div class="clearfix"></div>
<div class="row">
	<div class="span6">
		<div class="about-us-box">
			<div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/about-us-agents.png" alt=""></div>
			<div class="bow">}</div>
			<div class="more-then">
				<div class="title">More then</div>
				<div class="count">3 500</div>
				<a href="#" class="go-to no-border">Go to the  list <span>&#8250;</span></a>
			</div>
			<div class="more-text">qualified agents</div>
		</div>
		<div class="about-us-box">
			<div class="icon"><img src="<?php echo get_template_directory_uri(); ?>/images/about-us-newsletter.png" alt=""></div>
			<div class="bow">}</div>
			<div class="more-then">
				<div class="title">More then</div>
				<div class="count">3 500</div>
				<a href="#" class="go-to no-border">Subscribe to our newsletter <span>&#8250;</span></a>
			</div>
			<div class="more-text">active subscribers</div>
		</div>
	</div>
	<div class="span6">
		<div class="about-us-box">
			<h6>The quantity of transactions on our site</h6>
		</div>
	</div>
</div>*/?>
						</div><!-- .entry-content -->
					</article><!-- #post -->
				<?php endwhile; ?>
			</div><!-- #content -->
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>