<?php global $text_direction; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
	<title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<meta name="Robots" content="noindex, nofollow" />
	<?php if(@file_exists(TEMPLATEPATH.'/css/print-css.css')): ?>
		<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/css/print-css.css" type="text/css" media="screen, print" />
	<?php else: ?>
		<link rel="stylesheet" href="<?php echo plugins_url('wp-print/print-css.css'); ?>" type="text/css" media="screen, print" />
	<?php endif; ?>
	<?php if('rtl' == $text_direction): ?>
		<?php if(@file_exists(TEMPLATEPATH.'/print-css-rtl.css')): ?>
			<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/print-css-rtl.css" type="text/css" media="screen, print" />
		<?php else: ?>
			<link rel="stylesheet" href="<?php echo plugins_url('wp-print/print-css-rtl.css'); ?>" type="text/css" media="screen, print" />
		<?php endif; ?>
	<?php endif; ?>
	<link rel="canonical" href="<?php the_permalink(); ?>" />
	
	<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	<script src='<?php echo get_template_directory_uri(); ?>/js/jquery.rating.pack.js'></script>
	<script src='<?php echo get_template_directory_uri(); ?>/js/print.js'></script>
</head>
<body>
<p style="text-align: center;"><strong>- <?php bloginfo('name'); ?> - <span dir="ltr"><?php bloginfo('url')?></span> -</strong></p>
<div class="Center">
	<div id="Outline">
    <?php
      // Select corresponding template.
      $post_id    = get_the_ID();
      $post_type  = get_post_type($post_id);
      $agent_page = IBR_Agent::get_page_id('ibr_agent_page');
      $template   = 'posts';

      if ('property' == $post_type) {
        $template = 'property';
      }
      elseif ($post_id == $agent_page) {
        $template = 'agent';
      }

      flatroom_get_template('print-' . $template, array(
        'text_direction' => $text_direction,
        'print_options'  => $print_options,
        'post_id'        => $post_id,
        'post_type'      => $post_type,
      ));
    ?>

    <p style="text-align: <?php echo ('rtl' == $text_direction) ? 'left' : 'right'; ?>;" id="print-link"><?php _e('Click', 'wp-print'); ?> <a href="#Print" style="color: #41a3e1;" onclick="window.print(); return false;" title="<?php _e('Click here to print.', 'wp-print'); ?>"><?php _e('here', 'wp-print'); ?></a> <?php _e('to print.', 'wp-print'); ?></p>
	</div>
</div>

<p style="text-align: center;"><?php echo stripslashes($print_options['disclaimer']); ?></p>
</body>
</html>