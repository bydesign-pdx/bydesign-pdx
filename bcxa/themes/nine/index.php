<?php get_header();

global $smof_data; ?>

<div class="page-wrap">
<div id="page-body" class="page-body">
	<div class="container"><?php

		if ( isset($smof_data['select_blogtitlebar']) && $smof_data['select_blogtitlebar'] == 'Title + Subtitle' ) { ?>

			<div id="page-title">
				<hgroup><?php
					if($smof_data['text_blogsubtitle']) { echo '<h2>' . $smof_data['text_blogsubtitle'] . '</h2>'; } ?>
					<h1><?php echo $smof_data['text_blogtitle']; ?></h1>
				</hgroup>
			</div><?php

		} elseif (  isset($smof_data['select_blogtitlebar']) && $smof_data['select_blogtitlebar'] == 'Title + Breadcrumbs' ) { ?>

			<div id="page-title">
				<hgroup><?php
					if($smof_data['check_blogbreadcrumbs'] == 0) {
						moutheme_breadcrumbs();
					} ?>
					<h1><?php echo $smof_data['text_blogtitle']; ?></h1>
				</hgroup>
			</div><?php

		} ?>

		<div class="row">
			<div class="span9" id="main-col"><?php
				if (have_posts()) :
					while (have_posts()) : the_post();
						get_template_part( 'framework/inc/post-format/content', get_post_format() );
					endwhile;
					if( isset($smof_data['blog_layout']) && $smof_data['blog_layout'] == 'medium' ) { ?>
						<div class="layout-medium"><?php get_template_part( 'framework/inc/nav/nav' ); ?></div><?php
					} else {
						get_template_part( 'framework/inc/nav/nav' );						
					}
				else : ?>
					<h2><?php _e('Not Found', 'moutheme') ?></h2><?php
				endif; ?>
			</div><?php

			get_sidebar(); ?>

		</div>

	</div>
</div>

<?php get_footer(); ?>