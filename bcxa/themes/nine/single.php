<?php get_header(); ?>

<div class="page-wrap">
<?php get_template_part( 'framework/inc/slider' ); ?>
<div id="page-body" class="page-body">
	<div class="container">

		<?php if ($data['select_blogtitlebar'] == 'Title + Subtitle') { ?>

			<div id="page-title">
				<hgroup>
					<?php if($data['text_blogsubtitle']){ echo '<h2>'.$data['text_blogsubtitle'].'</h2>'; } ?>
					<h1><?php echo $data['text_blogtitle']; ?></h1>
				</hgroup>
			</div>

		<?php } elseif ( $data['select_blogtitlebar'] == 'Title + Breadcrumbs' ) { ?>

			<div id="page-title">
				<hgroup>
					<?php if($data['check_blogbreadcrumbs'] == 0){ ?>
						<?php moutheme_breadcrumbs(); ?>
					<?php } ?>
					<h1><?php echo $data['text_blogtitle']; ?></h1>
				</hgroup>
			</div>

		<?php } ?>

		<div class="row">
			<?php get_sidebar(); ?>
			<div class="span9">
	
				<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
					
					<?php get_template_part( 'framework/inc/post-format/single', get_post_format() ); ?>
				
					<div class="comments-area" id="comments"><?php comments_template(); ?></div>
		
				<?php endwhile; endif; ?>

			</div>

			

		</div>

	</div>
</div>

<?php get_footer(); ?>
