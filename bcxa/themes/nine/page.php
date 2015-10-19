<?php global $data;

get_header(); ?>

<div class="page-wrap">
<?php get_template_part( 'framework/inc/slider' ); ?>
<div id="page-body" class="page-body">
	<div class="container"><?php

		get_template_part( 'framework/inc/titlebar' ); ?>

		<div class="row">
			<div class="span12"><?php
				if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>><?php
						the_content();
						wp_link_pages(array('before' => 'Pages: ', 'next_or_number' => 'number')); ?>
					</article><?php

					if(!$data['check_disablecomments']) {
						comments_template();
					}

				endwhile; endif; ?>
			</div>
		</div>

	</div>
</div>

<?php get_footer(); ?>