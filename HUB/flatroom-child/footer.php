<?php

global $custFootMenu;
/*
echo "<div style='visibility:hidden;'>";
//print_r($custFootMenu[0]);
echo $custFootMenu[0][0]." - ".$custFootMenu[0][1]." - ".$custFootMenu[0][2].".<br>";
echo $custFootMenu[1][0]." - ".$custFootMenu[1][1]." - ".$custFootMenu[1][2].".<br>";

foreach ($custFootMenu as &$value) {
	echo $value[0] . ' : ' . $value[1] . ' : ' . $value[2];
	
}
echo "</div>";
*/

?>		</div><!-- #main -->

		<footer id="site-footer" class="bg-light" role="contentinfo">
    <div class="clear"></div>
    
			<?php $flatroom_footer_settings = get_option( "flatroom_footer_settings" ); ?>
            
            
            <?php 
			
			$homePageID = get_option('page_on_front');
			$footerLinks = get_field('footer_links', $homePageID);
			
			?>
            
            
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
								<?php //wp_nav_menu( array( 'theme_location' => 'footer-menu' ) ); ?>
                                
                                <div class="menu-welcome-container">
                                	<ul id="menu-welcome" class="menu">
                                    
                                    <?php //custom dynamic menu - unused items hidden with jQuery
                                    foreach ($custFootMenu as &$value) {
										
										$thisLink =  '<li id="link' . $value[1] . '" class="footLink fa ' . $value[0] . '" style="display:none;"><a href="' . get_site_url() . '/#' . $value[1] . '">' . $value[2] . '</a></li>';
										
                                        echo $thisLink;
                                        	
									}

									?>
                                    
                                   

                                    	
									</ul>
                              	</div>

							</nav>
						</div><!-- .footer-navigation -->
                        
						<div class="span3 about-us testing">
							<?php
								$page = $flatroom_footer_settings['about_us_page'];
								$number = $flatroom_footer_settings['number'];
								$query = new WP_Query('page_id='.$page);
								while($query->have_posts()){ $query->the_post();
							?>
							<span>
								<h3 class="title"><?php the_title(); ?></h3>
								<div class="text"><?php flatroom_excerpt(get_the_excerpt(), $number); ?></div>
							</span>
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
						<div class="span4 sidebar">
							<?php dynamic_sidebar( 'sidebar-footer' ); ?>
						</div>
					</div>
          <?php //dynamic_sidebar( 'sidebar-footer' ); ?>
          <p class="footer-copyright">COPYRIGHT &copy; <?php echo date('Y'); ?> - ALL RIGHTS RESERVED</p>
				</div>
			</div><!-- .top-box -->
			<?php /*?><div class="bottom-box">
				<div class="container">
					<div class="row">
						<div class="span6 pull-right">
							<?php
								$itembridge_options = get_option('theme_itembridge_options');
								if ($itembridge_options['social']) {
									echo '<ul class="social-icon">'.do_shortcode($itembridge_options['social']).'</ul>';
								}
							?>
							<ul class="social-menu">
								<li class="social-facebook"><a href="http://google.com">Facebook</a></li>
								<li class="social-twitter"><a href="http://yahoo.com">Twitter</a></li>
								<li class="social-google"><a href="http://yahoo.com">Google+</a></li>
								<li class="social-flickr"><a href="http://yahoo.com">Flickr</a></li>
								<li class="social-email"><a href="http://yahoo.com">Email</a></li>
							</ul>
						</div>
						<div class="span6">
							<?php echo $flatroom_footer_settings['copyright']; ?>
						</div>
						
					</div>
				</div>
				<a href="#" id="up"><?php _e( 'Up', 'flatroom' ); ?></a>
			</div><?php */?><!-- .bottom-box -->
		</footer><!-- #colophon -->
	</div><!-- #page -->
    
    <style>
  /*
  .testimonials-widget .widget-title:before{
	  font-family: FontAwesome;
	  content: "\f086";
  }
  */
  
  </style>
  
  
	<?php wp_footer(); ?>
  
  <script src="<?php echo get_template_directory_uri(); ?>/js/global.js"></script>
  
  <?php
  
  	
	
	
	




/*linkHeadBio
linkheadCustom
linkheadAroundTown
linkheadVideo
linkheadBlog
linkheadContact*/

  ?>
  

  
  

  
  
  <script>
  
  jQuery(document).ready(function($){
	  
	  	var footerLinks = <?php echo json_encode($footerLinks); ?>;
		//console.log(footerLinks);
		var removeLink = "<?php echo get_site_url() . "/#"; ?>";
		
	  
		$(".footLink").each(function(){
			
			var thisLink = $(this).find("a").attr("href").replace(removeLink,'');
			
			//console.log(thisLink);
		
			if($.inArray(thisLink, footerLinks)!==-1){
				$(this).css({"display":"block"});
			}
		
			/*if($(thisLink).length){
			$(this).css({"display":"block"});
			}*/
			
		});
		
		
		
	  
  });
  
  </script>
  
  
  
  
       
</body>
</html>