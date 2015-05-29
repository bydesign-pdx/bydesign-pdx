<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]-->
	<?php $flatroom_settings = get_option( "flatroom_settings" ); ?>
	<style type="text/css">
		body.dark .bg-images {
			background-image: url('<?php echo $flatroom_settings['bg_image']; ?>');
		}
	</style>
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
		<div id="page">

		<header id="site-header" class="site-header" role="banner">
			<?php $flatroom_header_settings = get_option( "flatroom_header_settings" ); ?>
			<?php $flatroom_footer_settings = get_option( "flatroom_footer_settings" ); ?>
			
			<?php if ( has_nav_menu('main-menu') ) {
				if ($flatroom_settings['show_menu'] == "") { ?>
					<div id="main-menu">
						<div class="bg-color"></div>
						<nav class="main-navigation" role="navigation">
							<a href="#" class="close no-border">close <span>&#215;</span></a>
							<?php wp_nav_menu( array(
								'theme_location'  => 'main-menu',
								'container_class' => 'menu-container',
								'link_before'          => '
								<div class="setsquare">
									<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
										 width="40.566px" height="10px" viewBox="0 0 40.566 10" enable-background="new 0 0 40.566 10" xml:space="preserve">
									<path fill-rule="evenodd" clip-rule="evenodd" fill="#111111" d="M28.284,2c-3.806,2.188-8,8-8,8s-4.214-5.957-8.062-8.062
										C8.742,0.035,0,0,0,0h40.566C40.566,0,31.703,0.035,28.284,2z"/>
									</svg>
								</div>',
							) ); ?>
							<div class="more">
								<a href="#" class="more-a no-border"><?php _e( 'More', 'flatroom' ); ?></a>
								<ul class="more-ul"></ul>
							</div>
							<div class="clearfix"></div>
						</nav><!-- .main-navigation -->
					</div><!-- #main-menu -->
				<?php } else { ?>
					<div class="bg-color second-bg"></div>
					<nav id="second-menu" role="navigation">
						<a href="#" class="close no-border">close <span>&#215;</span></a>
						<?php wp_nav_menu( array(
							'theme_location' => 'main-menu',
							'container_class' => 'second-container',
							'link_before'     => '<span>',
							'link_after'      => '</span>',
						) ); ?>
							<div class="more">
								<a href="#" class="more-a no-border"><?php _e( 'More', 'flatroom' ); ?></a>
								<ul class="more-ul"></ul>
							</div>
						<div class="clearfix"></div>
					</nav>
				<?php }
			} ?>
	
			<div class="clearfix"></div>
			<div class="header-top-margin"></div>
			<div class="clearfix"></div>

      <div class="header-right-box pull-right">
        <?php if (flatroom_is_multilingual()): ?>
          <div class="language-box">
            <?php flatroom_language_switcher(); ?>
          </div><!-- .language-box -->
        <?php endif; ?>

        <?php if ( has_nav_menu('main-menu')) : ?>
          <div class="menu-button-box">
            <a href="#" class="menu-button no-border ">
              <span></span>
              <span></span>
              <span></span>
              <?php _e( 'Menu', 'flatroom' ); ?>
            </a>
          </div><!-- .menu-button-box -->
        <?php endif ?>
      </div>

			<div class="logo-box">
				<div class="site-logo">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
						<img src="<?php echo $flatroom_header_settings['logo']; ?>" alt="Logo">
					</a>
				</div>	
			</div><!-- .logo-box -->
			<div class="header-icons">
				<div class="header-icons-buttons">
					<?php if ($flatroom_header_settings['header_phone'] == "") {
						$prev = 'prev';
					}
					
					if ($flatroom_header_settings['header_email'] !== "") { ?>
					<a href="email" class="email <?php echo $prev ?>">
						<span></span>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
							<path fill="#41A3E1" d="M16,4.001H4.002c-1.104,0-2,0.896-2,2.001V14c0,1.105,0.896,1.998,2,1.998H16 c1.104,0,1.999-0.893,1.999-1.998V6.003C17.999,4.897,17.104,4.001,16,4.001z M16,13.002C16,13.553,15.552,14,15.001,14H5.002 c-0.553,0-1.001-0.447-1-1V7c0-0.553,0.447-0.998,1-0.998h9.999C15.552,6.003,16,6.448,16,7V13.002z"/>
							<polygon fill="#41A3E1" points="13.501,7.502 10.001,11 6.501,7.502 5.501,8.502 7.001,10.002 5.501,11.502 6.501,12.5 8.001,11 10.001,12.5 12.001,11 13.501,12.5 14.5,11.5 13,10 14.5,8.5 "/>
						</svg>
					</a>
					<?php }
					
					if ($flatroom_header_settings['header_phone'] !== "") { ?>
					<a href="phone" class="phone prev">
						<span></span>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
							<path fill="#41A3E1" d="M13.498,11.499c-1,1-1,2-2,2c-1,0-2-1-3-2c-0.999-0.998-1.999-2-1.999-3C6.5,7.5,7.5,7.5,8.499,6.5	c1-1-1.999-4-2.999-4s-3,3-3,3c0,2,2.055,6.055,4,7.999c1.945,1.945,5.998,4.001,7.998,4.001c0,0,3.002-2.001,3.002-3.001 S14.498,10.501,13.498,11.499z"/>
						</svg>
					</a>
					<?php } ?>
					<a href="search" class="search active">
						<span></span>
						<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve">
							<path fill-rule="evenodd" clip-rule="evenodd" fill="#41A3E1" d="M17.613,17.626c-0.481,0.48-1.26,0.48-1.741,0l-2.893-2.892 c-1.134,0.791-2.507,1.263-3.994,1.263c-3.865,0-6.999-3.132-6.999-6.998C1.986,5.133,5.12,2,8.985,2S15.984,5.133,15.984,9	c0,1.489-0.471,2.862-1.263,3.995l2.892,2.892C18.094,16.366,18.094,17.146,17.613,17.626L17.613,17.626z M8.985,4 c-2.762,0-5,2.238-5,5c0,2.76,2.238,4.999,5,4.999s5-2.238,5-4.999C13.985,6.238,11.747,4,8.985,4L8.985,4z"/>
						</svg>
					</a>
				</div>
				<div class="header-icons-body">
					<?php if ($flatroom_header_settings['header_email'] !== "") { ?>
					<div class="text email no-border">
						<a href="mailto:<?php echo $flatroom_header_settings['header_email']; ?>">
							<?php echo $flatroom_header_settings['header_email']; ?>
						</a>
					</div>
					<?php }
					
					if ($flatroom_header_settings['header_phone'] !== "") { ?>
					<div class="text phone">
						<span><?php _e( 'Call Us:', 'flatroom' ); ?></span>
						<?php echo $flatroom_header_settings['header_phone']; ?>
					</div>
					<?php } ?>
					<div class="active search"><?php get_search_form(); ?></div>
				</div>
			</div><!-- .header-icons -->
			<div class="login-register">
				<div class="standart">
					<div class="links">
						<?php
						$flatroom_settings = get_option( "flatroom_settings" );
						$current_user = wp_get_current_user();
						$logout = wp_logout_url(home_url());
						if ( is_user_logged_in() ) {
              $username    = '<strong>' . $current_user->user_login . '</strong>';
              $logout_link = '<a href="' . $logout . '">' . __( 'Logout', 'flatroom' ) . '</a>';
              printf( __( 'Welcome, %1$s | %2$s', 'flatroom' ), $username, $logout_link );
						} else {
							if (!empty($flatroom_settings['login_page'])) { ?>
								<a href="<?php echo get_permalink($flatroom_settings['login_page']); ?>"><?php _e( 'Login', 'flatroom' ); ?></a>
							<?php } else { ?>
								<a href="<?php echo esc_url( home_url( '/wp-admin' ) ); ?>"><?php _e( 'Login', 'flatroom' ); ?></a>
							<?php } ?>
							<span><?php _e( 'or', 'flatroom' ); ?></span>
							<?php if (!empty($flatroom_settings['register_page'])) { ?>
								<a href="<?php echo get_permalink($flatroom_settings['register_page']); ?>"><?php _e( 'Register', 'flatroom' ); ?></a>
							<?php } else { ?>
								<a href="<?php echo esc_url( home_url( '/wp-admin' ) ); ?>"><?php _e( 'Register', 'flatroom' ); ?></a>
							<?php } ?>
							<span class="and"><?php _e( 'and', 'flatroom' ); ?></span>
						<?php } ?>
					</div>

					<?php if (post_type_exists('property')
						&& function_exists('user_has_cap')
						&& user_has_cap()) : ?>
						<a class="btn" href="<?php echo esc_url( home_url( 'wp-admin/post-new.php?post_type=property' ) ); ?>"><?php _e( 'Add Your Property', 'flatroom' ); ?></a>
					<?php else: ?>
						<?php
							$login_p_link = !empty($flatroom_settings['login_page'])
								? get_permalink($flatroom_settings['login_page'])
								: home_url( '/wp-admin' );
						?>
						<a class="btn" href="<?php echo $login_p_link; ?>"><?php _e( 'Add Your Property', 'flatroom' ); ?></a>
					<?php endif; ?>

				</div>
			</div><!-- .login-register -->
			
			<div class="clearfix"></div>
			<div class="header-bottom-margin"></div>
			<div class="clearfix"></div>
		</header><!-- #site-header -->

		<div id="main" class="blog-id-<?php echo get_current_blog_id(); ?>">
		<div class="bg-images"></div>