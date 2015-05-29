<?php get_header(); ?>

	<header class="page-header bg-color">
		<div class="container">
			<div class="row">
				<div class="span12">
					<h1 class="entry-title"><?php printf( __( 'Search Results for: %s', 'flatroom' ), get_search_query() ); ?></h1>
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
			<div id="content" class="span9 bg-dark" role="main">
				<div class="properies-list-container">
					<div class="properties-list">
						<?php if ( have_posts() ) : ?>
							<?php /* The loop */ ?>
							
							<?php while ( have_posts() ) : the_post(); ?>
			
								<?php if (function_exists('ibr_get_template') && (get_post_type() == 'property')) : ?>
			
									<?php
										$property = new IBR_Property(get_the_ID());
										$property->view('list-item');
									?>
			
								<?php else: ?>
			
									<?php get_template_part( 'content', get_post_format() ); ?>
			
								<?php endif; ?>
			
							<?php endwhile; ?>
				
							<?php flatroom_paging_nav(); ?>
						<?php else : ?>
							<?php get_template_part( 'content', 'none' ); ?>
						<?php endif; ?>
					</div>
				</div>
	
			</div><!-- #content -->

			<?php get_sidebar(); ?>
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>