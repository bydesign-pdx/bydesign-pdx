<?php
/*
Template Name: Page Right Sidebar
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
				<div class="span9 pageTitle">
					<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
						<div class="entry-thumbnail team-member-thumbnail">
							<?php the_post_thumbnail(); ?>
						</div>
					<?php endif; ?>
                    
                    <div id="titlesText">
					
                        <span class="team-member-title"><h1 class="entry-title">
                        
                        <?php //bloginfo('name'); 
                        
                        if(get_field('heading_title')):
                            the_field('heading_title');
                        else:
                            bloginfo('name');
                        endif;
                        
                        
                        ?>
                        
                        
                        </h1></span><!-- <br /> -->
                        <span class="team-member-subtitle">
                        <?php 
                        
                        $description = get_bloginfo('description'); 
                        echo str_replace('{','<br />',str_replace('}','',str_replace('[','<br /><small>',str_replace(']','</small>',$description)))); 
                        
                
                        
                        ?>
                        </span>
                    </div>
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
	
	<div id="primary" class="container right-sidebar">
		<div class="row">
			<div id="content" class="span9 bg-dark" role="main">
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="entry-content">
							<?php the_content(); ?>
							<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'flatroom' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
						</div><!-- .entry-content -->
					</article><!-- #post -->
				<?php endwhile; ?>
                
                
			</div><!-- #content -->
			
			<?php get_sidebar('page'); ?>
		</div>
	</div><!-- #primary -->

<?php get_footer(); ?>