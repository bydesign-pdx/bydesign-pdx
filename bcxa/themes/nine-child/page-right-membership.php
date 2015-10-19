<?php
/* Template Name: Page: Left Sidebar Membership */

global $data;

get_header(); ?>

<div class="page-wrap">
<?php get_template_part( 'framework/inc/slider' ); ?>
<a id="who" style="height:0;"></a>
<a id="brochure" style="height:0;"></a>
<div id="page-body-members" class="page-body">
	<div class="container">
		<?php get_template_part( 'framework/inc/titlebar' ); ?>
		<div class="row">
			<?php get_sidebar(); ?>
			<div class="span9"><?php
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