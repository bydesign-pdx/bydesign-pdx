<?php global $smof_data; ?><!DOCTYPE html>
<!--[if IE 7]><html xmlns="http://www.w3.org/1999/xhtml" class="ie ie7 <?php if(isset($smof_data['layout'])) echo $smof_data['layout']; ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html xmlns="http://www.w3.org/1999/xhtml" class="ie ie8 <?php if(isset($smof_data['layout'])) echo $smof_data['layout']; ?>" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)]><!--><html xmlns="http://www.w3.org/1999/xhtml" class="<?php if(isset($smof_data['layout'])) echo $smof_data['layout']; ?>" <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php bloginfo('name'); ?> <?php wp_title(' - ', true, 'left'); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1.0"><?php

if($smof_data['media_favicon']): ?>
<link rel="shortcut icon" href="<?php echo $smof_data['media_favicon']; ?>" type="image/x-icon"><?php
endif;

if($smof_data['media_favicon_iphone']): ?>
<!-- For iPhone -->
<link rel="apple-touch-icon-precomposed" href="<?php echo $smof_data['media_favicon_iphone']; ?>"><?php
endif;

if($smof_data['media_favicon_ipad']): ?>
<!-- For iPad -->
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $smof_data['media_favicon_ipad']; ?>"><?php
endif; ?>

<link rel="pingback" href="<?php bloginfo("pingback_url"); ?>"><?php
if ( is_singular() ) wp_enqueue_script( "comment-reply" );

wp_head();

if( $smof_data['textarea_custom_css'] ) {
	echo('<style>' . $smof_data['textarea_custom_css'] . '</style>');
} ?>
<link href='http://fonts.googleapis.com/css?family=Oxygen:300,700' rel='stylesheet' type='text/css'>
</head>
<body <?php body_class(); ?>><?php

if(!$smof_data['header_layout']) $smof_data['header_layout'] = 1;

// Include header layout
include_once('framework/inc/headers/header-v' . $smof_data['header_layout'] . '.php'); ?>