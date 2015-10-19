<?php
/* Template Name: Page: Side Navigation */

global $data;

get_header(); ?>

<div class="page-wrap">
<?php get_template_part( 'framework/inc/slider' ); ?>
<div id="page-body" class="page-body">
	<div class="container">
		<?php get_template_part( 'framework/inc/titlebar' ); ?>
		<div class="row">
			<div class="span3">
				<ul class="side-nav"><?php

					$post_ancestors = get_post_ancestors($post->ID);
					$post_parent = end($post_ancestors); ?>
			
					<li <?php if(is_page($post_parent)): ?> class="current_page_item"<?php endif; ?>>
						<a href="<?php echo get_permalink($post_parent); ?>"><?php echo get_the_title($post_parent); ?></a>
					</li><?php

					if($post_parent) {
						$children = wp_list_pages("title_li=&child_of=" . $post_parent . "&echo=0");
					} else {
						$children = wp_list_pages("title_li=&child_of=" . $post->ID . "&echo=0");
					}
			
					if ($children) { echo $children; } ?>
				</ul>
			</div>
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