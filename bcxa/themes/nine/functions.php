<?php

/* Theme Support
-------------------------------------------------------------------------------------------------------------------*/

// Translation
load_theme_textdomain('moutheme', get_template_directory() . '/framework/inc/languages');

// Default RSS feed links
add_theme_support('automatic-feed-links');

// Allow shortcodes in widget text
add_filter('widget_text', 'do_shortcode');

// Post Formats
add_theme_support( 'post-formats', array('gallery', 'video')); 	

// Register Navigation
register_nav_menu('main_navigation', 'Main Navigation');
register_nav_menu('footer_navigation', 'Footer Navigation');

// Content Width
if (!isset( $content_width )) $content_width = 1170;

// Thumbnails
add_theme_support('post-thumbnails');

add_image_size('blog-full', 798, 333, true);
add_image_size('blog-medium', 370, 270, true);		

add_image_size('portfolio-four', 270, 210, true);
add_image_size('portfolio-three', 370, 286, true);
add_image_size('portfolio-two', 570, 440, true);
add_image_size('portfolio-mini', 870, 400);
add_image_size('portfolio-full', 1170, 9999);

add_image_size('mini', 60, 60, true);



/* Includes
-------------------------------------------------------------------------------------------------------------------*/

include_once('framework/inc/enqueue.php'); // Enqueue JavaScripts & CSS
include_once('framework/inc/customjs.php'); // Load Custom JS
include_once('framework/inc/sidebars.php'); // Generated Sidebars
include_once('framework/inc/sidebar-generator.php'); // Include Sidebar Generator
include_once('framework/inc/shortcodes.php'); // Load Shortcodes
include_once('framework/inc/cpt-portfolio.php'); // Portfolio
include_once('framework/inc/cpt-slider.php'); // Flex Slider

// Widgets
include_once('framework/inc/widgets/embed.php');
include_once('framework/inc/widgets/facebook.php');
include_once('framework/inc/widgets/flickr.php');
include_once('framework/inc/widgets/twitter/widget.php');
include_once('framework/inc/widgets/contact.php');
include_once('framework/inc/widgets/blog.php');
	
// Slightly Modified Options Framework
require_once('admin/index.php');
	
// Include Meta Box Script
define( 'RWMB_URL', trailingslashit( get_template_directory_uri() . '/framework/inc/meta-box' ) );
define( 'RWMB_DIR', trailingslashit( get_template_directory() . '/framework/inc/meta-box' ) );
require_once RWMB_DIR . 'meta-box.php';
include 'framework/inc/meta-boxes.php';
    
// Automatic Plugin Activation
require_once('framework/inc/plugin-activation.php');
	
add_action('tgmpa_register', 'moutheme_register_required_plugins');
function moutheme_register_required_plugins() {
	$plugins = array(
		array(
			'name'     				=> 'Slider Revolution', // The plugin name
			'slug'     				=> 'revslider', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/revslider.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'Post Types Order', // The plugin name
			'slug'     				=> 'post-types-order', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/post-types-order.zip', // The plugin source
			'required' 				=> false, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
			'name'     				=> 'CF-Post-Formats', // The plugin name
			'slug'     				=> 'cf-post-formats', // The plugin slug (typically the folder name)
			'source'   				=> get_template_directory_uri() . '/framework/plugins/cf-post-formats.zip', // The plugin source
			'required' 				=> true, // If false, the plugin is only 'recommended' instead of required
			'version' 				=> '', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
			'force_activation' 		=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
			'external_url' 			=> '', // If set, overrides default API URL and points to an external URL
		),
		array(
        	'name'      => 'Contact Form 7',
        	'slug'      => 'contact-form-7',
        	'required'  => false,
        ),
	);

	// Change this to your theme text domain, used for internationalising strings
	$theme_text_domain = 'moutheme-framework';

	/**
	 * Array of configuration settings. Amend each line as needed.
	 * If you want the default strings to be available under your own theme domain,
	 * leave the strings uncommented.
	 * Some of the strings are added into a sprintf, so see the comments at the
	 * end of each line for what each argument will be.
	 */
	$config = array(
		'domain'       		=> $theme_text_domain,         	// Text domain - likely want to be the same as your theme.
		'default_path' 		=> '',                         	// Default absolute path to pre-packaged plugins
		'parent_menu_slug' 	=> 'themes.php', 				// Default parent menu slug
		'parent_url_slug' 	=> 'themes.php', 				// Default parent URL slug
		'menu'         		=> 'install-required-plugins', 	// Menu slug
		'has_notices'      	=> true,                       	// Show admin notices or not
		'is_automatic'    	=> true,					   	// Automatically activate plugins after installation or not
		'message' 			=> '',							// Message to output right before the plugins table
		'strings'      		=> array(
			'page_title'                       			=> __( 'Install Required Plugins', $theme_text_domain ),
			'menu_title'                       			=> __( 'Install Plugins', $theme_text_domain ),
			'installing'                       			=> __( 'Installing Plugin: %s', $theme_text_domain ), // %1$s = plugin name
			'oops'                             			=> __( 'Something went wrong with the plugin API.', $theme_text_domain ),
			'notice_can_install_required'     			=> _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_install_recommended'			=> _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_install'  					=> _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s)
			'notice_can_activate_required'    			=> _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_can_activate_recommended'			=> _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_activate' 					=> _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s)
			'notice_ask_to_update' 						=> _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s)
			'notice_cannot_update' 						=> _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s)
			'install_link' 					  			=> _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
			'activate_link' 				  			=> _n_noop( 'Activate installed plugin', 'Activate installed plugins' ),
			'return'                           			=> __( 'Return to Required Plugins Installer', $theme_text_domain ),
			'plugin_activated'                 			=> __( 'Plugin activated successfully.', $theme_text_domain ),
			'complete' 									=> __( 'All plugins installed and activated successfully. %s', $theme_text_domain ), // %1$s = dashboard link
			'nag_type'									=> 'updated' // Determines admin notice type - can only be 'updated' or 'error'
		)
	);

	tgmpa($plugins, $config);
	
}


add_action( 'admin_head', 'cpt_icons' );

function cpt_icons() { ?>
<style type="text/css" media="screen">
#menu-posts-slide .wp-menu-image { background: url(<?php echo get_template_directory_uri() . '/framework/img/admin/icons.png'; ?>) -2px -3px no-repeat !important; }
#menu-posts-slide:hover .wp-menu-image, #menu-posts-slide.wp-has-current-submenu .wp-menu-image { background-position: -2px -35px !important; }
</style>
<?php } 



/* Comments
-------------------------------------------------------------------------------------------------------------------*/
	
function moutheme_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment; ?>

	<li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
	   <article id="comment-<?php comment_ID(); ?>">

	   		<header class="comment-meta"><?php
	   			echo get_avatar($comment, $size = '54'); ?>
			 	<cite class="fn"><?php printf( __( '%s', 'moutheme'), get_comment_author_link() ) ?></cite><br>
			 	<time><?php printf(__('%1$s', 'moutheme'), get_comment_date() ) ?></a><?php edit_comment_link( __( '(Edit)', 'moutheme'),'  ','' ) ?></time><?php
			 	comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
			 	<b class="caret"></b>
			</header>

	        <section class="comment-content"><?php
	        	comment_text();
				if ( $comment->comment_approved == '0' ) : ?>
			        <p><?php _e( 'Your comment is awaiting moderation.', 'moutheme' ) ?></p><?php
			    endif; ?>
			</section>
				      
	   </article>
	</li><?php
}



/* Search Form
-------------------------------------------------------------------------------------------------------------------*/
	
function my_search_form( $form ) {

    $form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" ><input type="text" value="' . get_search_query() . '" placeholder="' . __("To search type and hit Enter&hellip;", "moutheme") . '" name="s" id="s"></form>';

    return $form;
}

add_filter( 'get_search_form', 'my_search_form' );



/* Custom Excerpt
-------------------------------------------------------------------------------------------------------------------*/

function new_excerpt_length($length) {
	global $smof_data;
    if(isset($smof_data['text_excerptlength']))
    	return $smof_data['text_excerptlength'];
    else
    	return 55;
}
add_filter('excerpt_length', 'new_excerpt_length');
 
// Changing excerpt more
if(isset($smof_data['check_readmore']) && $smof_data['check_readmore'] != "0") { // Admin Option Check
	function new_excerpt_more($more) {
		global $post;
		return '';
	}
	add_filter('excerpt_more', 'new_excerpt_more');
}

// Word Limiter
function limit_words($string, $word_limit) {
	$words = explode(' ', $string);
	return implode(' ', array_slice($words, 0, $word_limit));
}



/* Footer Columns
-------------------------------------------------------------------------------------------------------------------*/

function footer_column_width($value) {
	switch ($value) {
		case '25%':
		    $column_width = 'span3';
		    break;
		case '33%':
		    $column_width = 'span4';
		    break;
		case '50%':
		    $column_width = 'span6';
		    break;
		case '66%':
		    $column_width = 'span8';
		    break;
		case '75%':
		    $column_width = 'span9';
		    break;
		case '100%':
		    $column_width = 'span12';
		    break;
	}
	return $column_width;
}



/* Breadcrumbs
-------------------------------------------------------------------------------------------------------------------*/

function moutheme_breadcrumbs() {
        global $smof_data,$post;
        echo '<ul class="breadcrumbs">';
        
        if ( !is_front_page() ) {
        echo '<li><a href="';
        echo home_url();
        echo '">'.__('Home', 'moutheme');
        echo "</a></li>";
        }

        $params['link_none'] = '';
        $separator = '';

        if (is_category() && !is_singular('portfolio')) {
            $category = get_the_category();
            $ID = $category[0]->cat_ID;
            echo is_wp_error( $cat_parents = get_category_parents($ID, TRUE, '', FALSE ) ) ? '' : '<li>&nbsp;/&nbsp;'.$cat_parents.'</li>';
        }

        if(is_singular('portfolio')) {
            echo get_the_term_list($post->ID, 'portfolio_filter', '<li>', '&nbsp;/&nbsp;', '</li>');  
            echo '<li>&nbsp;/&nbsp;' . get_the_title() . '</li>';
        }

        if(is_home()) { echo '<li>&nbsp;/&nbsp;'.$smof_data['blog_title'].'</li>'; }
        if(is_page() && !is_front_page()) {
            $parents = array();
            $parent_id = $post->post_parent;
            while ( $parent_id ) :
                $page = get_page( $parent_id );
                if ( $params["link_none"] )
                    $parents[]  = get_the_title( $page->ID );
                else
                    $parents[]  = '<li>&nbsp;/&nbsp;<a href="' . get_permalink( $page->ID ) . '" title="' . get_the_title( $page->ID ) . '">' . get_the_title( $page->ID ) . '</a></li>' . $separator;
                $parent_id  = $page->post_parent;
            endwhile;
            $parents = array_reverse( $parents );
            echo join( ' ', $parents );
            echo '<li>&nbsp;/&nbsp;'.get_the_title().'</li>';
        }
        if(is_single() && !is_singular('portfolio')) {
            $categories_1 = get_the_category($post->ID);
            if($categories_1):
                foreach($categories_1 as $cat_1):
                    $cat_1_ids[] = $cat_1->term_id;
                endforeach;
                $cat_1_line = implode(',', $cat_1_ids);
            endif;
            $categories = get_categories(array(
                'include' => $cat_1_line,
                'orderby' => 'id'
            ));
            if ( $categories ) :
                foreach ( $categories as $cat ) :
                    $cats[] = '<li>&nbsp;/&nbsp;<a href="' . get_category_link( $cat->term_id ) . '" title="' . $cat->name . '">' . $cat->name . '</a></li>';
                endforeach;
                echo join( ' ', $cats );
            endif;
            echo '<li>&nbsp;/&nbsp;'.get_the_title().'</li>';
        }
        if(is_tag()){ echo '<li>&nbsp;/&nbsp;' . "Tag: " . single_tag_title('',FALSE) . '</li>'; }
        if(is_404()){ echo '<li>&nbsp;/&nbsp;'.__("404 - Page not Found", 'moutheme').'</li>'; }
        if(is_search()){ echo '<li>&nbsp;/&nbsp;'.__("Search", 'moutheme').'</li>'; }
        if(is_year()){ echo '<li>&nbsp;/&nbsp;'.get_the_time('Y').'</li>'; }

        echo "</ul>";
} ?>