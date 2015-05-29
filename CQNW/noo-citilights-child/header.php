<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
<!-- Favicon-->
<?php 
	$favicon = noo_get_image_option('noo_custom_favicon', '');
	if ($favicon != ''): ?>
	<link rel="shortcut icon" href="<?php echo $favicon; ?>" />
<?php
endif; ?>
<?php if ( defined('WPSEO_VERSION') ) : ?>
<title><?php wp_title(''); ?></title>
<?php else : ?>
<title><?php wp_title(' - ', true, 'left'); ?></title>
<?php endif; ?>
<?php wp_head(); ?>


<!--[if lt IE 9]>
<script src="<?php echo NOO_FRAMEWORK_URI . '/vendor/respond.min.js'; ?>"></script>
<![endif]-->

<!-- Analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-51732446-13', 'auto');
  ga('send', 'pageview');

</script>



</head>

<body <?php body_class(); ?>>

	<div class="site">

	<?php
	$rev_slider_pos = home_slider_position(); ?>
	<?php
		if($rev_slider_pos == 'above') {
			noo_get_layout( 'slider-revolution');
		}
	?>
	<?php noo_get_layout('topbar'); ?>
	<header class="noo-header <?php noo_header_class(); ?>" role="banner">
		<?php noo_get_layout('navbar'); ?>
		
	</header>

	<?php
		if($rev_slider_pos == 'below') {
			noo_get_layout( 'slider-revolution');
		}
	?>
	<?php /// noo_get_layout('heading'); ?>