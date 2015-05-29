<?php
/*
Template Name: Page FAQ
*/

get_header(); ?>
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
	
	<div id="primary" class="container faq">
		<div id="content" class="bg-dark" role="main">
			<?php while ( have_posts() ) : the_post(); ?>
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
			<?php endwhile; ?>
			
			<?php $support = new WP_Query('post_type=faqs'); ?>
			<?php if ($support->have_posts()) : ?>
			<div id="faq-accordion" class="row accordion">
				<?php while ( $support->have_posts() ) : $support->the_post(); ?>
				<div class="accordion-group span6">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#faq-accordion" href="#collapse-<?php the_ID(); ?>">
							<?php the_title(); ?>
						</a>
					</div>
					<div id="collapse-<?php the_ID(); ?>" class="accordion-body collapse">
						<div class="accordion-inner">
							<?php the_content(); ?>
						</div>
					</div>
				</div>
				<?php endwhile; ?>
			</div>
			<?php endif; ?>
		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_footer(); ?>