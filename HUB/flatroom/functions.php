<?php
/*
Theme Name: Flat Room
Theme URI: http://http://wordpress.flatroom.itembridge.com/
Author: Infostyle
Author URI: http://themeforest.net/user/InfoStyle
Description: Flat Room responsive theme
Version: 1.1.0
License: GNU ThemeForest Regular & Extended License
License URI: http://themeforest.net/licenses/regular_extended
*/

/******************************************************************************
    Enqueues scripts and styles for front end.
*******************************************************************************/
add_action( 'wp_enqueue_scripts', 'flatroom_scripts_styles' );
function flatroom_scripts_styles() {
    wp_deregister_style( 'dsidx' );
    wp_deregister_style( 'dsidxpress-unconditional' );
    wp_deregister_style( 'dsidxwidgets-unconditional' );
    wp_enqueue_style( 'dsidx', get_template_directory_uri() . '/css/idx/dsidx.css');
    wp_enqueue_style( 'dsidxpress-unconditional', get_template_directory_uri() . '/css/idx/dsidxpress.css');
    wp_enqueue_style( 'dsidxwidgets-unconditional', get_template_directory_uri() . '/css/idx/dsidxwidgets.css');

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )
        wp_enqueue_script( 'comment-reply' );

    /* JS */
    wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/bootstrap/js/bootstrap.min.js', array(), false, true );
    wp_enqueue_script( 'carouFredSel', get_template_directory_uri() . '/js/jquery.carouFredSel-6.2.1-packed.js', array(), '6.2.1', true);
    wp_enqueue_script( 'touchSwipe', get_template_directory_uri() . '/js/jquery.touchSwipe.min.js', array(), '1.3.3', true);
    wp_enqueue_script( 'selectbox', get_template_directory_uri() . '/js/jquery.selectbox-0.2.min.js', array(), '0.2', true);
    wp_enqueue_script( 'fancyBox', get_template_directory_uri() . '/js/jquery.fancybox.pack.js', array(), '2.1.5', true);
    wp_enqueue_script( 'jquery.jqplot', get_template_directory_uri() . '/js/jqplot/jquery.jqplot.min.js', array(), 'false', true);
    wp_enqueue_script( 'shCore', get_template_directory_uri() . '/js/jqplot/shCore.min.js', array(), 'false', true);
    wp_enqueue_script( 'shBrushJScript', get_template_directory_uri() . '/js/jqplot/shBrushJScript.min.js', array(), 'false', true);
    wp_enqueue_script( 'shBrushXml', get_template_directory_uri() . '/js/jqplot/shBrushXml.min.js', array(), 'false', true);
    wp_enqueue_script( 'jqplot.cursor', get_template_directory_uri() . '/js/jqplot/jqplot.cursor.min.js', array(), 'false', true);
    wp_enqueue_script( 'jqplot.dateAxisRenderer', get_template_directory_uri() . '/js/jqplot/jqplot.dateAxisRenderer.min.js', array(), 'false', true);
    wp_enqueue_script( 'jqplot.highlighter', get_template_directory_uri() . '/js/jqplot/jqplot.highlighter.min.js', array(), 'false', true);
    wp_enqueue_script( 'jqplot.canvasTextRenderer', get_template_directory_uri() . '/js/jqplot/jqplot.canvasTextRenderer.min.js', array(), 'false', true);
    wp_enqueue_script( 'jqplot.canvasAxisLabelRenderer', get_template_directory_uri() . '/js/jqplot/jqplot.canvasAxisLabelRenderer.min.js', array(), 'false', true);

    wp_enqueue_script( 'main', get_template_directory_uri() . '/js/main.js', array(
        'jquery',
        'jquery-ui-core',
        'jquery-effects-pulsate',
        'jquery-effects-explode',
        'jquery-ui-draggable',
        'jquery-ui-autocomplete',
        'bootstrap',
        'carouFredSel',
        'selectbox',
        'fancyBox',
        'jquery.jqplot',
        'shCore',
        'shBrushJScript',
        'shBrushXml',
        'jqplot.highlighter',
        'jqplot.dateAxisRenderer',
        'jqplot.cursor',
        'jqplot.canvasTextRenderer',
        'jqplot.canvasAxisLabelRenderer'
    ), false, true );

    wp_enqueue_script( 'combobox', get_template_directory_uri() . '/js/jquery.ui.combobox.js', array(), '0.1', true);

    wp_localize_script( 'main', 'flatroom', array(
        'any'        => __('- Any -', 'flatroom'),
        'hide'       => __('Hide', 'flatroom'),
        'showfilter' => __('Show filter', 'flatroom'),
    ));

    /* CSS */
    wp_enqueue_style('jquery-ui', 'http://code.jquery.com/ui/1.10.1/themes/overcast/jquery-ui.min.css');
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style( 'buttons', get_template_directory_uri() . '/css/buttons/buttons.css');
    wp_enqueue_style( 'animation', get_template_directory_uri() . '/css/buttons/animation.css');
    wp_enqueue_style( 'social-icons', get_template_directory_uri() . '/css/buttons/social-icons.css');  
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/bootstrap/css/bootstrap.min.css');
    wp_enqueue_style( 'bootstrap-responsive', get_template_directory_uri() . '/bootstrap/css/bootstrap-responsive.min.css');
    wp_enqueue_style( 'jquery.jqplot', get_template_directory_uri() . '/css/jquery.jqplot.css');
    wp_enqueue_style( 'flatroom-style', get_stylesheet_uri());
    wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/responsive.css');
    wp_enqueue_style( 'responsive', get_template_directory_uri() . '/css/print.css');

    wp_enqueue_style( 'flatroom-ie', get_template_directory_uri() . '/css/ie.css');
    wp_style_add_data( 'flatroom-ie', 'conditional', 'lt IE 9' );
    wp_enqueue_style( 'social-icons-ie7', get_template_directory_uri() . '/css/buttons/social-icons-ie7.css');
    wp_style_add_data( 'social-icons-ie7', 'conditional', 'lt IE 7' );
}

/******************************************************************************
    Admin js/css
*******************************************************************************/
function flatroom_admin_style() {
    wp_enqueue_style( 'social-icons', get_template_directory_uri() . '/css/buttons/social-icons.css');
    wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style( 'admin_css', get_template_directory_uri() . '/css/admin-style.css' );
    
    wp_enqueue_script( 'admin_js', get_template_directory_uri() . '/js/admin-script.js', array('jquery-ui-sortable'), '1.0.0' );
}
add_action('admin_enqueue_scripts', 'flatroom_admin_style');

/******************************************************************************
    Include additional files
*******************************************************************************/
require get_template_directory() . '/inc/itembrige-icons.php';
require get_template_directory() . '/inc/social-icon.php';
require get_template_directory() . '/inc/meta-boxes.php';
require get_template_directory() . '/inc/post-type.php';
require get_template_directory() . '/inc/shortcodes/columns.php';
require get_template_directory() . '/inc/shortcodes/social-icon.php';
require get_template_directory() . '/inc/shortcodes/pricing.php';
require get_template_directory() . '/inc/shortcodes/faq.php';
require get_template_directory() . '/inc/shortcodes/features.php';
require get_template_directory() . '/inc/shortcodes/link-offers.php';
require get_template_directory() . '/inc/shortcodes/banner.php';
require get_template_directory() . '/inc/shortcodes/content-box.php';
require get_template_directory() . '/inc/shortcodes/last-posts.php';
require get_template_directory() . '/inc/shortcodes/chart.php';
require get_template_directory() . '/inc/widgets/widget-search.php';
require get_template_directory() . '/inc/widgets/widget-faq.php';
require get_template_directory() . '/inc/colors.php';
require get_template_directory() . '/inc/page-login.php';
require get_template_directory() . '/inc/pager.php';
require get_template_directory() . '/inc/shortcodes/team.php';


/******************************************************************************
    Sets up the content width value based on the theme's design.
*******************************************************************************/
if ( ! isset( $content_width ) )
    $content_width = 1130;

function flatroom_setup() {

    /* This theme supports all available post formats by default. */
    add_theme_support( 'post-formats', array(
      'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
    ) );

    /* This theme uses wp_nav_menu() in one location. */
    register_nav_menus( array(
        'main-menu' => __( 'Main Menu', 'flatroom' ),
        'footer-menu' => __( 'Footer Menu', 'flatroom' ),
    ) );

    /* This theme uses a custom image size for featured images, displayed on "standard" posts and pages. */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 604, 270, true );

    /* This theme uses its own gallery styles. */
    add_filter( 'use_default_gallery_style', '__return_false' );

    add_editor_style( array( 'css/editor-style.css' ) );

    // Adds RSS feed links to <head> for posts and comments.
    add_theme_support( 'automatic-feed-links' );

    // Switches default core markup for search form, comment form, and comments
    // to output valid HTML5.
    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
}
add_action( 'after_setup_theme', 'flatroom_setup' );

/******************************************************************************
    Registers two widget areas.
*******************************************************************************/
function flatroom_widgets_init() {
    register_sidebar( array(
        'name'          => __( 'Main Widget Area', 'flatroom' ),
        'id'            => 'sidebar',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside><div class="aside-border"></div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Pages Widget Area', 'flatroom' ),
        'id'            => 'sidebar-page',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside><div class="aside-border"></div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Categories/Post Widget Area', 'flatroom' ),
        'id'            => 'sidebar-post',
        'description'   => '',
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget'  => '</aside><div class="aside-border"></div>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name'          => __( 'Footer Widget Area', 'flatroom' ),
        'id'            => 'sidebar-footer',
        'description'   => __( 'Appears in the footer section of the site.', 'flatroom' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="title">',
        'after_title'   => '</h3>',
    ) );
}
add_action( 'widgets_init', 'flatroom_widgets_init' );

/******************************************************************************
    Displays navigation to next/previous set of posts when applicable.
*******************************************************************************/
if ( ! function_exists( 'flatroom_paging_nav' ) ) :
function flatroom_paging_nav() {
    global $wp_query;
    flatroom_pager(array('query' => $wp_query));
}
endif;

/******************************************************************************
    Settings
*******************************************************************************/
function flatroom_customize_register($wp_customize){
    
    /* General Settings */
    $wp_customize->add_section('flatroom_settings', array(
        'title'    => __('General Settings', 'flatroom'),
        'priority' => 10,
    ));
    //Show Main menu
    $wp_customize->add_setting('flatroom_settings[show_menu]', array(
        'default'        => false,
        'capability' => 'edit_theme_options',
        'type'       => 'option',
    ));

    $wp_customize->add_control('flatroom_settings', array(
        'settings' => 'flatroom_settings[show_menu]',
        'label'    => __('Show Main menu', 'flatroom'),
        'section'  => 'flatroom_settings',
        'type'     => 'checkbox',
        'priority' => 5,
    ));

    //Dark/Light
    $wp_customize->add_setting('flatroom_settings[styles]', array(
        'default'        => 'light',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'styles', array(
        'settings' => 'flatroom_settings[styles]',
        'label'   => 'Site Styles',
        'section' => 'flatroom_settings',
        'priority' => 10,
        'type'    => 'select',
        'choices'    => array(
            'light' => 'Light',
            'dark' => 'Dark',
        ),
    ));

    //Dark Background Image
    $wp_customize->add_setting('flatroom_settings[bg_image]', array(
        'default'           => get_template_directory_uri() . '/images/bg_image.jpg',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'bg_image', array(
        'label'    => __('Dark Background Image', 'flatroom'),
        'section'  => 'flatroom_settings',
        'settings' => 'flatroom_settings[bg_image]',
        'priority' => 15,
    )));

    //Overlay Opacity
    $wp_customize->add_setting('flatroom_settings[opacity]', array(
        'default'        => '0.97',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('opacity', array(
        'label'      => __('Overlay Opacity:', 'flatroom'),
        'section'    => 'flatroom_settings',
        'settings'   => 'flatroom_settings[opacity]',
        'priority' => 17,
    ));

    //Category template
    $wp_customize->add_setting('flatroom_settings[cat_template]', array(
        'default'        => 'cat_not',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',

    ));
    $wp_customize->add_control( 'cat_template', array(
        'settings' => 'flatroom_settings[cat_template]',
        'label'   => 'Category/Single Post Sidebar',
        'section' => 'flatroom_settings',
        'priority' => 20,
        'type'    => 'select',
        'choices'    => array(
            'cat_not' => 'Not Sidebar',
            'cat_left' => 'Left Sidebar',
            'cat_right' => 'Right Sidebar',
        ),
    ));

    //Login Page
    $wp_customize->add_setting('flatroom_settings[login_page]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('login_page', array(
        'label'      => __('Login Page', 'flatroom'),
        'section'    => 'flatroom_settings',
        'type'    => 'dropdown-pages',
        'settings'   => 'flatroom_settings[login_page]',
        'priority' => 50,
    ));

    //Register Page
    $wp_customize->add_setting('flatroom_settings[register_page]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('register_page', array(
        'label'      => __('Register Page', 'flatroom'),
        'section'    => 'flatroom_settings',
        'type'    => 'dropdown-pages',
        'settings'   => 'flatroom_settings[register_page]',
        'priority' => 60,
    ));

    /* Header Settings */
    $wp_customize->add_section('flatroom_header_settings', array(
        'title'    => __('Header Settings', 'flatroom'),
        'priority' => 11,
    ));
    //Header Phone
    $wp_customize->add_setting('flatroom_header_settings[header_phone]', array(
        'default'        => '123-45-678',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('header_phone', array(
        'label'      => __('Phone:', 'flatroom'),
        'section'    => 'flatroom_header_settings',
        'settings'   => 'flatroom_header_settings[header_phone]',
        'priority' => 10,
    ));

    //Header Email
    $wp_customize->add_setting('flatroom_header_settings[header_email]', array(
        'default'        => 'example@itembridge.com',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('header_email', array(
        'label'      => __('Email:', 'flatroom'),
        'section'    => 'flatroom_header_settings',
        'settings'   => 'flatroom_header_settings[header_email]',
        'priority' => 15,
    ));

    //Logo
    $wp_customize->add_setting('flatroom_header_settings[logo]', array(
        'default'           => get_template_directory_uri() . '/images/logo.png',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'logo', array(
        'label'    => __('Logo', 'flatroom'),
        'section'  => 'flatroom_header_settings',
        'settings' => 'flatroom_header_settings[logo]',
        'priority' => 20,
    )));
    
    /* Footer Settings */
    $wp_customize->add_section('flatroom_footer_settings', array(
        'title'    => __('Footer Settings', 'flatroom'),
        'priority' => 12,
    ));

    // Phone
    $wp_customize->add_setting('flatroom_footer_settings[label_phone]', array(
        'default'        => 'Phone:',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('label_phone', array(
        'label'      => __('Phone', 'flatroom'),
        'section'    => 'flatroom_footer_settings',
        'settings'   => 'flatroom_footer_settings[label_phone]',
        'priority' => 10,
    ));
    $wp_customize->add_setting('flatroom_footer_settings[phone]', array(
        'default'        => '123-45-678',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('phone', array(
        'section'    => 'flatroom_footer_settings',
        'settings'   => 'flatroom_footer_settings[phone]',
        'priority' => 20,
    ));
        
    // Address
    $wp_customize->add_setting('flatroom_footer_settings[label_address]', array(
        'default'        => 'Address:',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('label_address', array(
        'label'      => __('Address', 'flatroom'),
        'section'    => 'flatroom_footer_settings',
        'settings'   => 'flatroom_footer_settings[label_address]',
        'priority' => 30,
    ));
    $wp_customize->add_setting('flatroom_footer_settings[address]', array(
        'default'        => 'Avenue of the American Ind.',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('address', array(
        'section'    => 'flatroom_footer_settings',
        'settings'   => 'flatroom_footer_settings[address]',
        'priority' => 40,
    ));

    // Email
    $wp_customize->add_setting('flatroom_footer_settings[label_email]', array(
        'default'        => 'Email:',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('label_email', array(
        'label'      => __('Email', 'flatroom'),
        'section'    => 'flatroom_footer_settings',
        'settings'   => 'flatroom_footer_settings[label_email]',
        'priority' => 50,
    ));
    $wp_customize->add_setting('flatroom_footer_settings[email]', array(
        'default'        => 'example@itembridge.com',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('email', array(
        'section'    => 'flatroom_footer_settings',
        'settings'   => 'flatroom_footer_settings[email]',
        'priority' => 60,
    ));

    //About Us
    $wp_customize->add_setting('flatroom_footer_settings[about_us_page]', array(
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('about_us_page', array(
        'label'      => __('About Us', 'flatroom'),
        'section'    => 'flatroom_footer_settings',
        'type'    => 'dropdown-pages',
        'settings'   => 'flatroom_footer_settings[about_us_page]',
        'priority' => 80,
    ));
    $wp_customize->add_setting('flatroom_footer_settings[number]', array(
        'default'        => '37',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('number', array(
        'label'      => __('Number of words', 'flatroom'),
        'section'    => 'flatroom_footer_settings',
        'settings'   => 'flatroom_footer_settings[number]',
        'priority' => 90,
    ));

    //Copyright
    $wp_customize->add_setting('flatroom_footer_settings[copyright]', array(
        'default'        => 'Copyright © ItemBridge inc., 2013',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('copyright', array(
        'label'      => __('Copyright', 'flatroom'),
        'section'    => 'flatroom_footer_settings',
        'settings'   => 'flatroom_footer_settings[copyright]',
        'priority' => 100,
    ));

    /* Contact Us Settings */
    $wp_customize->add_section('flatroom_contact_settings', array(
        'title'    => __('Contact Us Settings', 'flatroom'),
        'priority' => 15,
    ));
    // Show the form > Contact Us
    $wp_customize->add_setting('flatroom_contact_settings[show_form]', array(
      'default'        => true,
      'capability' => 'edit_theme_options',
      'type'       => 'option',
    ));

    $wp_customize->add_control('flatroom_contact_settings', array(
      'settings' => 'flatroom_contact_settings[show_form]',
      'label'    => __('Show the form > Contact Us', 'flatroom'),
      'section'  => 'flatroom_contact_settings',
      'type'     => 'checkbox',
      'priority' => 30,
    ));

    // Contact form submition e-mail
    $wp_customize->add_setting('flatroom_contact_settings[submition_email]', array(
        'default'        => 'mail@example.com',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control('submition_email', array(
        'label'      => __('Contact form submition e-mail', 'flatroom'),
        'section'    => 'flatroom_contact_settings',
        'settings'   => 'flatroom_contact_settings[submition_email]',
        'priority' => 40,
    ));
}
add_action('customize_register', 'flatroom_customize_register');

/******************************************************************************
    Body classes
*******************************************************************************/
function flatroom_body_class( $classes ) {
    $flatroom_settings = get_option( 'flatroom_settings' );

    if(!empty($flatroom_settings['styles']))
        $classes[] = $flatroom_settings['styles'];

    if ( !empty($flatroom_settings['show_menu']))
        $classes[] = 'main-menu-visible';

    if ( ! is_multi_author() )
        $classes[] = 'single-author';

    if ( ! get_option( 'show_avatars' ) )
        $classes[] = 'no-avatars';

    return $classes;
}
add_filter( 'body_class', 'flatroom_body_class' );

/******************************************************************************
    Breadcrumb
*******************************************************************************/
function flatroom_breadcrumb() {
    echo '<div class="title">You are here:</div> ';

    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
    $delimiter = '<span class="separator">/</span>'; // delimiter between crumbs
    $home = __('Home', 'flatroom'); // text for the 'Home' link
    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $before = ''; // tag before the current crumb
    $after = '';
    global $post;
    $homeLink = home_url();
    
    if (is_home() || is_front_page()) {

        echo 'Home';

    }
    else {
  
    echo '<a href="' . $homeLink . '">' . $home . '</a> ' . $delimiter . '';

    if ( is_category() ) {
        $thisCat = get_category(get_query_var('cat'), false);
        if ($thisCat->parent != 0) echo get_category_parents($thisCat->parent, TRUE, ' ' . $delimiter . ' ');
        echo $before . single_cat_title('', false) . $after;

    } elseif ( is_search() ) {
        echo $before . 'Search results for "' . get_search_query() . '"' . $after;

    } elseif ( is_day() ) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('d') . $after;

    } elseif ( is_month() ) {
        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
        echo $before . get_the_time('F') . $after;

    } elseif ( is_year() ) {
        echo $before . get_the_time('Y') . $after;

    } elseif ( is_single() && !is_attachment() ) {
        if ( get_post_type() != 'post' ) {
            $post_type = get_post_type_object(get_post_type());
            $slug = $post_type->rewrite;
            echo '<a href="' . $homeLink . '/' . $slug['slug'] . '/">' . $post_type->labels->singular_name . '</a>';
            if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;
        } else {
            $cat = get_the_category(); $cat = $cat[0];
            $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
            if ($showCurrent == 0) $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
            echo $cats;
            if ($showCurrent == 1) echo $before . get_the_title() . $after;
        }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
        $post_type = get_post_type_object(get_post_type());
        echo $before . $post_type->labels->singular_name . $after;

    } elseif ( is_attachment() ) {
        $parent = get_post($post->post_parent);
        $cat = get_the_category($parent->ID); $cat = $cat[0];
        echo get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
        echo '<a href="' . get_permalink($parent) . '">' . $parent->post_title . '</a>';
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_page() && !$post->post_parent ) {
        if ($showCurrent == 1) echo $before . get_the_title() . $after;

    } elseif ( is_page() && $post->post_parent ) {
        $parent_id  = $post->post_parent;
        $breadcrumbs = array();
        while ($parent_id) {
            $page = get_page($parent_id);
            $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
            $parent_id  = $page->post_parent;
        }
        $breadcrumbs = array_reverse($breadcrumbs);
        for ($i = 0; $i < count($breadcrumbs); $i++) {
            echo $breadcrumbs[$i];
            if ($i != count($breadcrumbs)-1) echo ' ' . $delimiter . ' ';
        }
        if ($showCurrent == 1) echo ' ' . $delimiter . ' ' . $before . get_the_title() . $after;

    } elseif ( is_tag() ) {
        echo $before . 'Posts tagged "' . single_tag_title('', false) . '"' . $after;

    } elseif ( is_author() ) {
        global $author;
        $userdata = get_userdata($author);
        echo $before . 'Articles posted by ' . $userdata->display_name . $after;

    } elseif ( is_404() ) {
        echo $before . 'Error 404' . $after;
    }

    if ( get_query_var('paged') ) {
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
            echo __('Page', 'flatroom') . ' ' . get_query_var('paged');
        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
  }
}

/******************************************************************************
    Number of words > "the_content"
*******************************************************************************/
function flatroom_excerpt($string, $word_limit) {
    $words = explode(' ', $string, ($word_limit + 1));
    if (count($words) > $word_limit)
    array_pop($words);
    echo implode(' ', $words).'';
}

/******************************************************************************
    Data > Link
*******************************************************************************/
if ( ! function_exists( 'flatroom_entry_date' ) ) :
function flatroom_entry_date( $echo = true ) {
    if ( has_post_format( array( 'chat', 'status' ) ) )
        $format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'flatroom' );
    else
        $format_prefix = '%2$s';
    $date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
        esc_url( get_permalink() ),
        esc_attr( sprintf( __( 'Permalink to %s', 'flatroom' ), the_title_attribute( 'echo=0' ) ) ),
        esc_attr( get_the_date( 'c' ) ),
        esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
    );
    if ( $echo )
        echo $date;
    return $date;
}
endif;

/******************************************************************************
    Comments
*******************************************************************************/
function flatroom_comment($comment, $args, $depth){
    $GLOBALS['comment'] = $comment; ?>
        <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
          <div id="comment-<?php comment_ID(); ?>">
              <div class="avatar-box"><?php echo get_avatar($comment); ?></div>
              <div class="comment-author vcard">
                  <?php echo __( 'Posted by', 'flatroom' ) . ' <cite class="fn no-border">' . get_comment_author_link() . '</cite> <span class="says">' . __( 'on', 'flatroom' ) . '</span>'; ?>
                  <a class="no-border" href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php printf(get_comment_date()) ?></a>, <?php printf(get_comment_time('h:i')) ?>
                  <span class="no-border"><?php edit_comment_link(__('(Edit)', 'flatroom'),'  ','') ?></span>
              </div>
              <?php if ($comment->comment_approved == '0') : ?>
                  <div class="moderation"><?php _e('Your comment is awaiting moderation.', 'flatroom') ?></div>
              <?php endif; ?>
              <div class="comment-body"><?php comment_text() ?></div>
              <div class="reply no-border">
                  <?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
              </div>
          </div>
<?php }

function remove_comment_fields($fields) {
    unset($fields['url']);
    return $fields;
}
add_filter('comment_form_default_fields','remove_comment_fields');


if ( ! function_exists( 'flatroom_post_nav' ) ) :
/******************************************************************************
    Displays navigation to next/previous post when applicable.
*******************************************************************************/
function flatroom_post_nav() {
    global $post;

    // Don't print empty markup if there's nowhere to navigate.
    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )
        return;
    ?>
    <nav class="navigation post-navigation" role="navigation">
        <div class="nav-links no-border">
            <div class="col-3 prev">
                <?php previous_post_link( '%link', _x( '<span class="meta-nav">&#8249;</span> Previous post', 'flatroom' ) ); ?>
            </div><div class="col-3">
                <?php $categories = get_the_category();
                if($categories[0]){
                    echo '<a href="' . get_category_link($categories[0]->term_id ) . '" class="back-to-list">
                      <span class="back-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                      </span>
                      Back to list
                    </a>';
                } ?>
            </div><div class="col-3 next">
                <?php next_post_link( '%link', _x( 'Next post link <span class="meta-nav">&#8250;</span>', 'flatroom' ) ); ?>
            </div>
        </div><!-- .nav-links -->
    </nav><!-- .navigation -->
    <?php
}
endif;

/******************************************************************************
    Prints the attached image with a link to the next attached image.
*******************************************************************************/
if ( ! function_exists( 'flatroom_the_attached_image' ) ) :
function flatroom_the_attached_image() {
    $post                = get_post();
    $attachment_size     = apply_filters( 'flatroom_attachment_size', array( 724, 724 ) );
    $next_attachment_url = wp_get_attachment_url();

    $attachment_ids = get_posts( array(
        'post_parent'    => $post->post_parent,
        'fields'         => 'ids',
        'numberposts'    => -1,
        'post_status'    => 'inherit',
        'post_type'      => 'attachment',
        'post_mime_type' => 'image',
        'order'          => 'ASC',
        'orderby'        => 'menu_order ID'
    ) );

    if ( count( $attachment_ids ) > 1 ) {
        foreach ( $attachment_ids as $attachment_id ) {
            if ( $attachment_id == $post->ID ) {
                $next_id = current( $attachment_ids );
                break;
            }
        }

        if ( $next_id )
            $next_attachment_url = get_attachment_link( $next_id );

        else
            $next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
    }

    printf( '<a href="%1$s" title="%2$s" rel="attachment">%3$s</a>',
        esc_url( $next_attachment_url ),
        the_title_attribute( array( 'echo' => false ) ),
        wp_get_attachment_image( $post->ID, $attachment_size )
    );
}
endif;

/******************************************************************************
    Post Pasword
*******************************************************************************/
function flatroom_password_form() {
    global $post;
    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
    $o = '<form class="password-form" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post">
    <p>' . __( 'To view this protected post, enter the password below:', 'flatroom') . '</p>
    <label for="' . $label . '">' . __( 'Password:', 'flatroom' ) . ' <input class="input-pass" name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /></label><input class="btn" type="submit" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
    </form>
    ';
    return $o;
}
add_filter( 'the_password_form', 'flatroom_password_form' );

/******************************************************************************
    Autocreation Login/Register Page
*******************************************************************************/
if (isset($_GET['activated']) && is_admin()){
    //Login
    $login_p_title = 'Login';
    $login_p_template = 'page-login.php';
    $page_check = get_page_by_title($login_p_title);
    $login_p = array(
        'post_type' => 'page',
        'post_title' => $login_p_title,
        'post_status' => 'publish',
        'post_author' => 1,
    );
    $options = get_option('flatroom_settings', array());
    if(!isset($page_check->ID)){
        $login_p_id = wp_insert_post($login_p);
        if(!empty($login_p_template)){
            update_post_meta($login_p_id, '_wp_page_template', $login_p_template);
        }
        $options['login_page'] = $login_p_id;
    }
    else {
        $options['login_page'] = $page_check->ID;
    }

    //Register
    $register_p_title = 'Register';
    $register_p_template = 'page-register.php';
    $page_check = get_page_by_title($register_p_title);
    $register_p = array(
        'post_type' => 'page',
        'post_title' => $register_p_title,
        'post_status' => 'publish',
        'post_author' => 1,
    );
    if(!isset($page_check->ID)){
        $register_p_id = wp_insert_post($register_p);
        if(!empty($register_p_template)){
            update_post_meta($register_p_id, '_wp_page_template', $register_p_template);
        }
        $options['register_page'] = $register_p_id;
    }
    else {
        $options['register_page'] = $page_check->ID;
    }
    update_option('flatroom_settings', $options);
}

function flatroom_get_template($template, $args = array(), $echo = true) {
    // Get the template slug
    $template_slug = trim(str_replace( '.php', '', $template ));
    $template = $template_slug . '.php';
    $file = get_template_directory() . '/inc/templates/' . $template;

    extract($args);
  
    if ($echo) {
        include($file);
    }
    else {
        ob_start();
        include($file);
        return ob_get_clean();
    }
    return false;
}

add_image_size('220x200c', 220, 220, true);

/******************************************************************************
WPML support
 *******************************************************************************/
function flatroom_is_multilingual() {
  $plugins = get_option('active_plugins', array());
  return (in_array('sitepress-multilingual-cms/sitepress.php', $plugins));
}

function flatroom_language_switcher() {
  global $sitepress;

  flatroom_get_template('language-selector.php', array(
    'active_languages' => $sitepress->get_ls_languages(),
    'settings'         => $sitepress->get_settings(),
  ));
}
