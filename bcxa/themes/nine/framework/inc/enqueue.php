<?php

function moutheme_scripts() {

	global $smof_data;
	
/*  Register JS
    ------------------------------------------------------- */

    wp_register_script('modernizr', get_template_directory_uri() . '/framework/js/modernizr.custom.js', 'jquery', '1.0', FALSE);

	wp_register_script('responsivenav', get_template_directory_uri() . '/framework/js/responsive-nav.min.js', 'jquery', '1.0.14', TRUE);
	wp_register_script('colorbox', get_template_directory_uri() . '/framework/js/jquery.colorbox-min.js', 'jquery', '1.4.4', TRUE);
	wp_register_script('flexslider', get_template_directory_uri() . '/framework/js/jquery.flexslider-min.js', 'jquery', '2.1', TRUE);
	wp_register_script('bootstrap', get_template_directory_uri() . '/framework/js/bootstrap.js', 'jquery', '1.0', TRUE);
	wp_register_script('fitvids', get_template_directory_uri() . '/framework/js/fitvids.js', 'jquery', '1.0');
	wp_register_script('isotope', get_template_directory_uri() . '/framework/js/isotope.js', 'jquery', '1.5', TRUE);
	wp_register_script('imagesloaded', get_template_directory_uri() . '/framework/js/jquery.imagesloaded.min.js', 'jquery', '2.1.1', TRUE);
	wp_register_script('carousel', get_template_directory_uri() . '/framework/js/jcarousel.js', 'jquery', '1.0.0', TRUE);
	wp_register_script('sticky', get_template_directory_uri() . '/framework/js/jquery.sticky.js', 'jquery', '1.0.0', TRUE);
	wp_register_script('main', get_template_directory_uri() . '/framework/js/main.js', 'jquery', '1.0', TRUE);
	

/*  Enqueue JS
    ------------------------------------------------------- */

	wp_enqueue_script('jquery');
	wp_enqueue_script('modernizr');
  	wp_enqueue_script('responsivenav');
	wp_enqueue_script('fitvids');
	wp_enqueue_script('bootstrap'); 	
  	
	if(is_page_template('portfolio.php')) {
		wp_enqueue_script('isotope');
		wp_enqueue_script('imagesloaded');
	}
	
	wp_enqueue_script('flexslider');
  	wp_enqueue_script('colorbox');
  	wp_enqueue_script('carousel');

	global $post;
	$slug = get_post( $post )->post_name;

	if( $smof_data['sticky_nav'] && $slug != 'home-sample-3' ) {
		wp_enqueue_script('sticky');
	}

  	wp_enqueue_script('main');

  	if( $smof_data['textarea_trackingcode'] ) {
  		echo $smof_data['textarea_trackingcode'];
  	}

}

add_action( 'wp_enqueue_scripts', 'moutheme_scripts' );  

function moutheme_styles() {

	global $smof_data;
	
/*  Register CSS
    ------------------------------------------------------- */

	wp_register_style( 'bootstrap', get_template_directory_uri() . '/framework/css/bootstrap.css', array(), '1', 'all' );
	wp_register_style( 'responsive', get_template_directory_uri() . '/framework/css/responsive.css', array(), '1', 'all' );
	wp_register_style( 'fontawesome', get_template_directory_uri() . '/framework/css/font-awesome.min.css', array(), '1', 'all' );
	wp_register_style( 'options', get_template_directory_uri() . '/framework/css/generated-options.css', 'style' );

	
/*  Enqueue CSS
    ------------------------------------------------------- */

	wp_enqueue_style('bootstrap'); 
	wp_enqueue_style('stylesheet', get_stylesheet_uri(), array(), '1', 'all'); // Main Stylesheet
	wp_enqueue_style('options');
	wp_enqueue_style('fontawesome');
	
	wp_enqueue_style('responsive');

	if($smof_data['google_body'] && $smof_data['google_body'] != 'Select Font'):
		wp_enqueue_style( 'font-body', 'http://fonts.googleapis.com/css?family=' . urlencode($smof_data['google_body']) . ':400,400italic,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' );
	endif;

	if($smof_data['google_menu'] && $smof_data['google_menu'] != 'Select Font'):
		wp_enqueue_style( 'font-menu', 'http://fonts.googleapis.com/css?family=' . urlencode($smof_data['google_menu']) . ':400,400italic,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' );
	endif;

	if($smof_data['google_heading'] && $smof_data['google_heading'] != 'Select Font'):
		wp_enqueue_style( 'font-heading', 'http://fonts.googleapis.com/css?family=' . urlencode($smof_data['google_heading']) . ':400,400italic,700,700italic&amp;subset=latin,greek-ext,cyrillic,latin-ext,greek,cyrillic-ext,vietnamese' );
	endif;
	
}  
add_action( 'wp_enqueue_scripts', 'moutheme_styles', 1 ); ?>