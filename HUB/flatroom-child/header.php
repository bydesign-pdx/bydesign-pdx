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
        #contact-form   .gfield_error,
#contact-form   .gform_wrapper li.gfield.gfield_error.gfield_contains_required,
.gform_wrapper li.gfield.gfield_error.gfield_contains_required label.gfield_label, .gform_wrapper li.gfield.gfield_error.gfield_contains_required div.ginput_container {
    padding-top:0!important;
    padding-right:0!important;
    padding-bottom:0!important;
    padding-left:0!important;
    margin-top:0!important;
    margin-right:0!important;
    margin-bottom:0!important;
    margin-left:0!important;
    border: 0!important;
    background: transparent!important;
}
#contact-form   .validation_message {
    display:none!important;
}

	</style>
	<?php wp_head(); ?>
	<?php
		$domain = get_blog_details( get_current_blog_id() )->domain;

		if ( strtolower( $domain ) === 'nwpropertyhub.com' ) {
			?>
			<link rel="stylesheet" type="text/css" href="/wp-content/themes/flatroom-child/css/nwpropertyhub.css" />
			<?php
		}
	?>
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
					
				</div>
				<div class="header-icons-body">
					<a href="<?= $flatroom_settings['agent_apply_url'] ?>" class="apply" target="_blank">
						<span></span>
						Apply Now
					</a>
				</div>
			</div><!-- .header-icons -->


			<?php /*
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
			</div><!-- .login-register -->  */ ?>
			
			<div class="clearfix"></div>
			<div class="header-bottom-margin"></div>
			<div class="clearfix"></div>
		</header><!-- #site-header -->

		<div id="main" class="blog-id-<?php echo get_current_blog_id(); ?>">
		<div class="bg-images"></div>