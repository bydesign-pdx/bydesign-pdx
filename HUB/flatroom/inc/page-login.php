<?php
function flatroom_login_head(){
    wp_enqueue_style( 'login_css', get_template_directory_uri() . '/css/login-style.css' );
	wp_enqueue_script( 'login_js', get_template_directory_uri() . '/js/login.js', array(
		'jquery'
	), false, true );
    $flatroom_header_settings = get_option( "flatroom_header_settings" );
    
    ?>
    <style type="text/css">
        .login h1 a {
            background-image: url(<?php echo $flatroom_header_settings['logo']; ?>) !important;
        }
        .login #wp-submit,
        .login #wp-submit:hover,
        .login #wp-submit:focus,
        body.dark.login {
            background-color: <?php echo get_theme_mod('color'); ?>;
        }
        .login .new-checkbox svg polygon {
            fill: <?php echo get_theme_mod('color'); ?>;
        }
        .login #login a {
            border-bottom-color: <?php echo get_theme_mod('color'); ?>;
            border-bottom-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.4); ?>;
            color: <?php echo get_theme_mod('color'); ?> !important;
        }
        .login #login a:visited {
            color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.75); ?> !important;
        }
        body.login #login a:hover,
        body.login #login a:focus,
        body.login #nav a:hover,
        body.login #backtoblog a:hover {
            border-bottom-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.75); ?>;
            color: <?php echo get_theme_mod('color'); ?> !important;
        }
        .login #wp-submit:hover,
        .login #wp-submit:focus {
            background: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.75); ?>;
        }
    </style>
<?php }  
add_action('login_head', 'flatroom_login_head');

function flatroom_login_headerurl( $url ) {
    return home_url();
}
add_filter( 'login_headerurl', 'flatroom_login_headerurl' );

function flatroom_login_headertitle() {
    return '';
}
add_filter( 'login_headertitle', 'flatroom_login_headertitle' );

function flatroom_login_body_class( $classes ) {
    $flatroom_settings = get_option( "flatroom_settings" );
    $classes[] = $flatroom_settings['styles'];
	$classes[] = 'login-page-standart';
	return $classes;
}
add_filter( 'login_body_class', 'flatroom_login_body_class' );