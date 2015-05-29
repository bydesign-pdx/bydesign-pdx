		</div><!-- #main -->

		<footer id="site-footer" class="bg-light" role="contentinfo">
			<?php $flatroom_footer_settings = get_option( "flatroom_footer_settings" ); ?>
			<div class="top-box">
				<div class="container">
					<div class="row">
						<div class="span2 footer-navigation">
							<h3 class="title">
							<?php
								$menu_location = 'footer-menu';
								$menu_locations = get_nav_menu_locations();
								if (has_nav_menu($menu_location)):
									$menu_object = (isset($menu_locations[$menu_location]) ? wp_get_nav_menu_object($menu_locations[$menu_location]) : null);
									$menu_name = (isset($menu_object->name) ? $menu_object->name : '');
									echo esc_html($menu_name);
								else :
									echo _e( 'Pages', 'flatroom' );
								endif
							?>
							</h3>
							<nav role="navigation">
								<?php wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
							</nav>
						</div><!-- .footer-navigation -->
						
						<div class="span4 about-us">
							<?php
								$page = $flatroom_footer_settings['about_us_page'];
								$number = $flatroom_footer_settings['number'];
								$query = new WP_Query('page_id='.$page);
								while($query->have_posts()){ $query->the_post();
							?>
							<a href="<?php the_permalink(); ?>" class="about-us-link no-border">
								<h3 class="title"><?php the_title(); ?></h3>
								<div class="text"><?php flatroom_excerpt(get_the_excerpt(), $number); ?></div>
							</a>
							<?php } ?>
							<?php wp_reset_postdata(); ?>
						</div><!-- .about-us -->
						
						<div class="span3 contact-us">
							<h3 class="title"><?php _e( 'Contact Us', 'flatroom' ); ?></h3>
							<ul>
								<li>
									<?php _e( $flatroom_footer_settings['label_phone'], 'flatroom' ); ?>
									<?php echo $flatroom_footer_settings['phone']; ?>
								</li>
								<li>
									<?php _e( $flatroom_footer_settings['label_address'], 'flatroom' ); ?>
									<?php echo $flatroom_footer_settings['address']; ?>
								</li>
								<li>
									<?php _e( $flatroom_footer_settings['label_email'], 'flatroom' ); ?>
									<a href="mailto:<?php echo $flatroom_footer_settings['email']; ?>"><?php echo $flatroom_footer_settings['email']; ?></a>
								</li>
							</ul>
							
						</div>
						<div class="span3 sidebar">
							<?php dynamic_sidebar( 'sidebar-footer' ); ?>
						</div>
					</div>
				</div>
			</div><!-- .top-box -->
			<div class="bottom-box">
				<div class="container">
					<div class="row">
						<div class="span6 pull-right">
							<?php
								$itembridge_options = get_option('theme_itembridge_options');
								if ($itembridge_options['social']) {
									echo '<ul class="social-icon">'.do_shortcode($itembridge_options['social']).'</ul>';
								}
							?>
						</div>
						<div class="span6">
							<?php echo $flatroom_footer_settings['copyright']; ?>
						</div>
						
					</div>
				</div>
				<a href="#" id="up"><?php _e( 'Up', 'flatroom' ); ?></a>
			</div><!-- .bottom-box -->
		</footer><!-- #colophon -->
	</div><!-- #page -->
	<?php wp_footer(); ?>
</body>
</html>