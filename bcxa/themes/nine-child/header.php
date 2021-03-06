<?php
//
//  Re-direct not-logged-in users to holding page
/*
if(!is_user_logged_in() && curPageURL() != 'http://playgroundrecords.com.ar/wp-login.php') {
    wp_redirect( 'http://playgroundrecords.com.ar/oldSite', 302 );
    exit;
}


//  Get current page URL
//
function curPageURL() {

    $pageURL = 'http';
    if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}

    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
    }

    return $pageURL;
}
*/
?>

<?php
$fixed_header = get_iron_option('enable_fixed_header');
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<script>
	
(function() {
    if ("-ms-user-select" in document.documentElement.style && navigator.userAgent.match(/IEMobile\/10\.0/)) {
        var msViewportStyle = document.createElement("style");
        msViewportStyle.appendChild(
            document.createTextNode("@-ms-viewport{width:auto !important}")
        );
        document.getElementsByTagName("head")[0].appendChild(msViewportStyle);
    }
})();

</script>
	<style>.home #menu-trigger{display:none;}</style>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0">
	<title><?php wp_title('—', true, 'right'); ?></title>
	<?php wp_head(); ?>
</head>
<body <?php body_class("layout-wide ".($fixed_header ? 'fixed_header' : '')); ?> onload="jQuery('header').animate({'opacity': 1})">

	<div id="fb-root"></div>

	<div id="overlay"></div>
	<div class="side-menu">
		<div class="menu-toggle-off"><i class="fa fa-long-arrow-right"></i></div>

		<a class="site-title" rel="home" href="<?php echo home_url('/'); ?>">
		<?php if(get_iron_option('menu_logo') != ''): ?>
			<img class="logo-desktop regular" src="<?php echo esc_url( get_iron_option('menu_logo') ); ?>" data-at2x="<?php echo esc_url( get_iron_option('retina_menu_logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
			<img class="logo-mobile regular" src="<?php echo esc_url( get_iron_option('menu_logo') ); ?>" data-at2x="<?php echo esc_url( get_iron_option('retina_menu_logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
		<?php endif; ?>
		</a>


			<!-- panel -->
			<div class="panel">
				<a class="opener" href="#"><i class="icon-reorder"></i> <?php _e("Menu", IRON_TEXT_DOMAIN); ?></a>

				<!-- nav-holder -->
				<div class="nav-holder">

					<!-- nav -->
					<nav id="nav">
	<?php if ( get_iron_option('header_menu_logo_icon') != '') : ?>
						<a class="logo-panel" href="<?php echo home_url('/'); ?>">
							<img src="<?php echo esc_url( get_iron_option('header_menu_logo_icon') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
						</a>
	<?php endif; ?>
						<?php echo preg_replace('/>\s+</S', '><', wp_nav_menu( array( 'theme_location' => 'main-menu', 'menu_class' => 'nav-menu', 'echo' => false, 'walker' => new iron_nav_walker() ))); ?>
					</nav>
					<div class="clear"></div>

					<div class="panel-networks">
						<?php get_template_part('parts/networks'); ?>
						<div class="clear"></div>
					</div>

				</div>
			</div>

	</div>

	<?php if(empty($fixed_header)) : ?>
	<div id="pusher">
	<?php endif; ?>

	<header class="opacityzero">
		<div class="menu-toggle">
			<i class="fa fa-bars"></i>
		</div>
		<?php get_template_part('parts/top-menu'); ?>

		<?php /*if( get_iron_option('header_logo') != ''): ?>
		<a href="<?php echo home_url('/');?>" class="site-logo">
		  <img id="menu-trigger" class="logo-desktop regular" src="<?php echo esc_url( get_iron_option('header_logo') ); ?>" data-at2x="<?php echo esc_url( get_iron_option('retina_header_logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
		</a>
		<?php endif; */?>
	</header>


	<?php if(!empty($fixed_header)) : ?>
	<div id="pusher">
	<?php endif; ?>
		
        <a href="<?php echo home_url('/');?>" class="site-logo">
		  <img id="menu-trigger" class="logo-desktop regular" src="<?php echo esc_url( get_iron_option('header_logo') ); ?>" data-at2x="<?php echo esc_url( get_iron_option('retina_header_logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
		</a>

		<div id="wrapper">

		
