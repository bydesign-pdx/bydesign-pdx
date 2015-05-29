<?php
/*
Template Name: Page Contact Us
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
	
	<div id="primary" class="container contact-us">
		<?php
			$flatroom_footer_settings = get_option( "flatroom_footer_settings" );
			$flatroom_contact_settings = get_option( "flatroom_contact_settings" );
			$output = '<script>';
			$output .= 'var url = "' . get_template_directory_uri() . '"';
			$output .= '</script>';
			echo $output;
		?>
		<div class="row">
			<div id="content" class="span5 bg-dark" role="main">
				<?php /* The loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<div class="row-fluid">
							<?php if ($flatroom_footer_settings['phone'] !== "") { ?>
							<div class="span6">
								<address>
									<strong class="title"><i class="ib-icon-cellphone"></i><?php _e( 'Call Us', 'flatroom' ); ?></strong>
									<?php echo $flatroom_footer_settings['phone']; ?>
								</address>
							</div>
							<?php } ?>
							<?php if ($flatroom_footer_settings['email'] !== "") { ?>
							<div class="span6">
								<address>
									<strong class="title"><i class="ib-icon-mail"></i><?php _e( 'Email', 'flatroom' ); ?></strong>
									<a class="no-border" href="mailto:<?php echo $flatroom_footer_settings['email']; ?>"><?php echo $flatroom_footer_settings['email']; ?></a>
								</address>
							</div>
							<?php } ?>
						</div>
						<div class="row-fluid">
							<?php if ($flatroom_footer_settings['address'] !== "") { ?>
							<div class="span12">
								<address>
									<strong class="title"><i class="ib-icon-place-pointer"></i><?php _e( 'Address', 'flatroom' ); ?></strong>
									<?php echo $flatroom_footer_settings['address']; ?>
								</address>
							</div>
							<?php } ?>
						</div>
						
						<?php 
							$map = get_post_meta( get_the_ID(), 'map', true );

							if( ! empty( $map ) ) {
								if ($flatroom_contact_settings['show_form'] != "") { ?>
								<form id="contactform" class="no-dark contact-form" method="POST">
									<input type="hidden" name="submition_email" value="<?php echo $flatroom_contact_settings['submition_email']; ?>">
									<div class="title"><?php _e( 'Say us hello', 'flatroom' ); ?></div>
									<div id="success"></div>
									<input class="input-block-level" type="text" name="name" placeholder="Name *">
									<input class="input-block-level" type="email" name="email" placeholder="Email *">
									<textarea class="input-block-level" name="comment" placeholder="Message *"></textarea>
									<div class="clearfix"></div>
									<button id="submit" class="btn btn-block">Submit</button>
								</form>
								<?php } ?>
								<div class="entry-content">
									<?php the_content(); ?>
								</div><!-- .entry-content -->
							<?php } else {
								if ($flatroom_contact_settings['show_form'] != "") { ?>
									<div class="entry-content">
										<?php the_content(); ?>
									</div><!-- .entry-content -->
								<?php }
							}
						?>

					</article><!-- #post -->
					
				<?php endwhile; ?>
			</div><!-- #content -->
			<div class="span1"></div>
			<div class="span6">
			<?php 
				if( ! empty( $map ) ) { ?>
					<div class="map">
						<?php echo (get_post_meta($post->ID, 'map', true)); ?>
					</div>
				<?php } else {
					if ($flatroom_contact_settings['show_form'] != "") { ?>
						<form id="contactform" class="no-dark contact-form not-map" method="POST">
							<input type="hidden" name="submition_email" value="<?php echo $flatroom_contact_settings['submition_email']; ?>">
							<div class="title"><?php _e( 'Say us hello', 'flatroom' ); ?></div>
							<div id="success"></div>
							<input class="input-block-level" type="text" name="name" placeholder="Name *">
							<input class="input-block-level" type="email" name="email" placeholder="Email *">
							<textarea class="input-block-level" name="comment" placeholder="Message *"></textarea>
							<div class="clearfix"></div>
							<button id="submit" class="btn btn-block">Submit</button>
						</form>
					<?php } else { ?>
						<div class="entry-content not-map">
							<?php the_content(); ?>
						</div><!-- .entry-content -->
					<?php }
				}
			?>
			</div>
		</div>
	</div><!-- #primary -->
	
	

<?php get_footer(); ?>