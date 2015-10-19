<?php
/**
 * Registering meta boxes
 *
 * All the definitions of meta boxes are listed below with comments.
 * Please read them CAREFULLY.
 *
 * You also should read the changelog to know what has been changed before updating.
 *
 * For more information, please visit:
 * @link http://www.deluxeblogtips.com/meta-box/docs/define-meta-boxes
 */

/********************* META BOX DEFINITIONS ***********************/

/**
 * Prefix of meta keys (optional)
 * Use underscore (_) at the beginning to make keys hidden
 * Alt.: You also can make prefix empty to disable it
 */
// Better has an underscore as last sign
$prefix = 'moutheme_';

global $meta_boxes;

$meta_boxes = array();

global $data;

/* ----------------------------------------------------- */

$revolutionslider = array();

if(class_exists('RevSlider')){
    $slider = new RevSlider();
	$arrSliders = $slider->getArrSliders();
	foreach($arrSliders as $revSlider) { 
		$revolutionslider[$revSlider->getAlias()] = $revSlider->getTitle();
	}
}

$types = get_terms('portfolio_filter', 'hide_empty=0');
$types_array[0] = 'All categories';
if($types) {
	foreach($types as $type) {
		$types_array[$type->term_id] = $type->name;
	}
}

/* ----------------------------------------------------- */
// Slide Metabox
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	//'id' => 'standard',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Slide Details',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'slide' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// Auto save: true, false (default). Optional.
	'autosave' => true,

	// List of meta fields
	'fields' => array(
		// SELECT BOX
		array(
			'name'     => 'Caption Position',
			'id'       => "{$prefix}position",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'pos-top-left' => 'top left',
				'pos-bottom-left' => 'bottom left',
				'pos-center' => 'center (caption + video)',
				'pos-top-right' => 'top right',
				'pos-bottom-right' => 'bottom right',
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
		),
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Caption Text',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}caption",
			// Field description (optional)
			'desc'  => '(optional)',
			'type' => 'textarea',
			'cols' => '20',
			'rows' => '3',
			// Default value (optional)
			'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
		),
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Button Text',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}button_text",
			// Field description (optional)
			'desc'  => '(optional)',
			'type'  => 'text',
			// Default value (optional)
			'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
		),
		// TEXT
		array(
			// Field name - Will be used as label
			'name'  => 'Button URL',
			// Field ID, i.e. the meta key
			'id'    => "{$prefix}button_url",
			// Field description (optional)
			'desc'  => '(optional)',
			'type'  => 'text',
			// Default value (optional)
			'std'   => '',
			// CLONES: Add to make the field cloneable (i.e. have multiple value)
			'clone' => false,
		),
		array(
			'name'	=> 'Slide Image',
			'desc'	=> 'natural size will be used, image need to be horizontal-oriented (for example demo images are 1258x400 pixels)',
			'id'	=> $prefix . 'slide_image',
			'type'	=> 'plupload_image',
			'max_file_uploads' => 1,
		),
	)
);

/* ----------------------------------------------------- */
// Page Settings
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'pagesettings',
	'title' => 'Page Title Settings',
	'pages' => array( 'page' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		array(
				'name'		=> 'Title Bar',
				'id'		=> $prefix . "titlebar",
				'type'		=> 'select',
				'options'	=> array(
					'title_subtitle'	=> 'Title & Subtitle',
					'title_breadcrumbs' => 'Title & Breadcrumbs',
					'hero_title'        => 'Hero Title',
					'no_titlebar'		=> 'No Title Bar'
				),
				'multiple'	=> false,
				'std'		=> array( 'title_subtitle' )
		),
		array(
			'name'		=> 'Subtitle',
			'id'		=> $prefix . 'subtitle',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Hero Title',
			'id'		=> $prefix . 'hero',
			'clone'		=> false,
			'type'		=> 'textarea',
			'std'		=> ''
		)
	)
);


/* ----------------------------------------------------- */
// Slider Settings
/* ----------------------------------------------------- */

$meta_boxes[] = array(
	'id' => 'sliderselect',
	'title' => 'Slider Settings',
	'pages' => array( 'page', 'post', 'portfolio' ),
	'context' => 'normal',
	'priority' => 'high',

	// List of meta fields
	'fields' => array(
		// SELECT BOX
		array(
			'name'     => 'Select',
			'id'       => "{$prefix}slider_type",
			'type'     => 'select',
			'std'      => 'none',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'none' => 'no slider',
				'revolution' => 'Revolution',
				'flex' => 'Flex',
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
		),		
		array(
			'name'		=> 'Revolution Slider',
			'id'		=> $prefix . "revolutionslider",
			'type'		=> 'select',
			'options'	=> $revolutionslider,
			'multiple'	=> false
		),
		// TAXONOMY
		array(
			'name'    => 'Flex Slider',
			'id'      => "{$prefix}flexslider",
			'type'    => 'taxonomy',
			'options' => array(
				// Taxonomy name
				'taxonomy' => 'slider',
				// How to show taxonomy: 'checkbox_list' (default) or 'checkbox_tree', 'select_tree' or 'select'. Optional
				'type' => 'select_tree',
				// Additional arguments for get_terms() function. Optional
				'args' => array()
			),
		)
	)
);


/* ----------------------------------------------------- */
// Project Info Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id' => 'portfolio_info',
	'title' => 'Project Information',
	'pages' => array( 'portfolio' ),
	'context' => 'normal',
	
	'fields' => array(
		array(
			'name'		=> 'Title Bar',
			'id'		=> $prefix . "titlebar",
			'type'		=> 'select',
			'options'	=> array(
				'title_subtitle'	=> 'Title & Subtitle',
				'title_breadcrumbs' => 'Title & Breadcrumbs'
			),
			'multiple'	=> false,
			'std'		=> array( 'title' )
		),
		array(
			'name'		=> 'Subtitle',
			'id'		=> $prefix . 'subtitle',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Short Description',
			'id'		=> $prefix . 'short-desc',
			'desc'		=> '',
			'clone'		=> false,
			'type'		=> 'text',
			'std'		=> ''
		),
		array(
			'name'		=> 'Detail Layout',
			'id'		=> $prefix . 'portfolio-detaillayout',
			'desc'		=> 'Choose Layout for Detailpage',
			'type'		=> 'select',
			'options'	=> array(
				'default'           => 'Default (options)',
				'portfolio_full'	=> 'Full Width',
				'portfolio_minimal' => 'Minimal'
			),
			'multiple'	=> false,
			'std'		=> 'wide'
		)
	)
);

/* ----------------------------------------------------- */
// Project Slides Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'portfolio_slides',
	'title'		=> 'Project Slides',
	'pages'		=> array( 'portfolio' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'	=> 'Project Slider Images',
			'desc'	=> 'Upload up to 20 project images for a slideshow - or only one to display a single image. <br /><br /><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.',
			'id'	=> $prefix . 'screenshot',
			'type'	=> 'plupload_image',
			'max_file_uploads' => 20,
		)
		
	)
);

/* ----------------------------------------------------- */
// Project Video Metabox
/* ----------------------------------------------------- */
$meta_boxes[] = array(
	'id'		=> 'portfolio_video',
	'title'		=> 'Project Video',
	'pages'		=> array( 'portfolio', 'slide' ),
	'context' => 'normal',

	'fields'	=> array(
		array(
			'name'		=> 'Video Source',
			'id'		=> $prefix . 'source',
			'type'		=> 'select',
			'options'	=> array(
				'youtube'		=> 'Youtube',
				'vimeo'			=> 'Vimeo',
				'own'			=> 'Own Embed Code'
			),
			'multiple'	=> false,
			'std'		=> array( 'no' )
		),
		array(
			'name'	=> 'Video URL or own Embedd Code<br>(Audio Embedd Code is possible, too)',
			'id'	=> $prefix . 'embed',
			'desc'	=> 'Just paste the ID of the video (E.g. http://www.youtube.com/watch?v=<strong>GUEZCxBcM78</strong>) you want to show, or insert own Embed Code. <br />This will show the Video <strong>INSTEAD</strong> of the Image Slider.<br><br><strong>Notice:</strong> The Preview Image will be the Image set as Featured Image.',
			'type' 	=> 'textarea',
			'std' 	=> "",
			'cols' 	=> "40",
			'rows' 	=> "8"
		)
	)
);

/********************* META BOX REGISTERING ***********************/

/**
 * Register meta boxes
 *
 * @return void
 */
function moutheme_register_meta_boxes()
{
	global $meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( class_exists( 'RW_Meta_Box' ) ) {
		foreach ( $meta_boxes as $meta_box ) {
			new RW_Meta_Box( $meta_box );
		}
	}
}
// Hook to 'admin_init' to make sure the meta box class is loaded before
// (in case using the meta box class in another plugin)
// This is also helpful for some conditionals like checking page template, categories, etc.
add_action( 'admin_init', 'moutheme_register_meta_boxes' );



/********************* PORTFOLIO META BOX REGISTERING ***********************/

// Register specific page templates metaboxes

global $portfolio_meta_boxes;

$portfolio_meta_boxes = array();
$portfolio_meta_boxes[] = array(
	// Meta box id, UNIQUE per meta box. Optional since 4.1.5
	//'id' => 'standard',

	// Meta box title - Will appear at the drag and drop handle bar. Required.
	'title' => 'Portfolio Settings',

	// Post types, accept custom post types as well - DEFAULT is array('post'). Optional.
	'pages' => array( 'page' ),

	// Where the meta box appear: normal (default), advanced, side. Optional.
	'context' => 'normal',

	// Order of meta box: high (default), low. Optional.
	'priority' => 'high',

	// Auto save: true, false (default). Optional.
	'autosave' => true,

	// List of meta fields
	'fields' => array(

		// SELECT BOX
		array(
			'name'     => 'Columns',
			'id'       => "{$prefix}columns",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'span3' => '4 columns',
				'span4' => '3 columns',
				'span6' => '2 columns'
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
			'std'      => 'select layout'
		),
		// SELECT BOX
		array(
			'name'     => 'Item Layout',
			'id'       => "{$prefix}item-layout",
			'type'     => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options'  => array(
				'overlay' => 'overlay',
				'overlay_desc' => 'overlay with description',
				'overlay_plus_desc' => 'overlay + description'
			),
			// Select multiple values, optional. Default is false.
			'multiple' => false,
			'std'      => 'select layout'
		),
		array(
			'name'		=> 'Portfolio Filter',
			'id'		=> $prefix . "portfolio-filter",
			'type'		=> 'checkbox',
			'std'		=> true
		),
		array(
			'name' => 'Select Portfolio Filters',
			'id' => $prefix . "portfoliofilter",
			'type' => 'select',
			// Array of 'value' => 'Label' pairs for select box
			'options' => $types_array,
			// Select multiple values, optional. Default is false.
			'multiple' => true,
			'desc' => 'Optional: Choose what portfolio category you want to display on this page (If Portfolio Template chosen).'
		)
	)
);

/**
 * Register meta boxes
 *
 * @return void
 */
function portfolio_register_meta_boxes() {
	global $portfolio_meta_boxes;

	// Make sure there's no errors when the plugin is deactivated or during upgrade
	if ( ! class_exists( 'RW_Meta_Box' ) )
		return;

	// Register meta boxes only for some posts/pages
	if ( ! portfolio_maybe_include() )
		return;

	foreach ( $portfolio_meta_boxes as $meta_box ) {
		new RW_Meta_Box( $meta_box );
	}
}

add_action( 'admin_init', 'portfolio_register_meta_boxes' );

/**
 * Check if meta boxes is included
 *
 * @return bool
 */


function portfolio_maybe_include() {
	// Include in back-end only
	if ( ! defined( 'WP_ADMIN' ) || ! WP_ADMIN )
		return false;

	// Always include for ajax
	if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
		return true;

	if ( isset( $_GET['post'] ) )
		$post_id = $_GET['post'];
	elseif ( isset( $_POST['post_ID'] ) )
		$post_id = $_POST['post_ID'];
	else
		$post_id = false;

	$post_id = (int) $post_id;

	// Check for page template
	$checked_templates = array( 'portfolio.php' );

	$template = get_post_meta( $post_id, '_wp_page_template', true );
	if ( in_array( $template, $checked_templates ) )
		return true;

	// If no condition matched
	return false;
}
