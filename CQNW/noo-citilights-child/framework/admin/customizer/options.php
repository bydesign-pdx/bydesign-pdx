<?php
/**
 * NOO Customizer Package.
 *
 * Register Options
 * This file register options used in NOO-Customizer
 *
 * @package    NOO Framework
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */
// =============================================================================


// 0. Remove Unused WP Customizer Sections
if ( ! function_exists( 'noo_customizer_remove_wp_native_sections' ) ) :
	function noo_customizer_remove_wp_native_sections( $wp_customize ) {
		$wp_customize->remove_section( 'title_tagline' );
		// $wp_customize->remove_section( 'colors' );
		// $wp_customize->remove_section( 'background_image' );
		$wp_customize->remove_section( 'nav' );
		$wp_customize->remove_section( 'static_front_page' );
	}

add_action( 'customize_register', 'noo_customizer_remove_wp_native_sections' );
endif;


//
// Register NOO Customizer Sections and Options
//

// 1. Site Enhancement options.
if ( ! function_exists( 'noo_customizer_register_options_general' ) ) :
	function noo_customizer_register_options_general( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Customizer_Helper( $wp_customize );

		// Section: Site Enhancement
		$helper->add_section(
			'noo_customizer_section_site_enhancement',
			__( 'Site Enhancement', NOO_TEXT_DOMAIN ),
			__( 'Enable/Disable some features for your site.', NOO_TEXT_DOMAIN )
		);

		// Control: Favicon
		$helper->add_control(
			'noo_custom_favicon',
			'noo_image',
			__( 'Custom Favicon', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// // Control: Breadcrumbs
		// $helper->add_control(
		// 	'noo_breadcrumbs',
		// 	'noo_switch',
		// 	__( 'Enable Breadcrumbs', NOO_TEXT_DOMAIN ),
		// 	1,
		// 	array(),
		// 	array( 'transport' => 'postMessage' )
		// );

		// // Control: Back to Top
		// $helper->add_control(
		// 	'noo_back_to_top',
		// 	'noo_switch',
		// 	__( 'Back To Top Button', NOO_TEXT_DOMAIN ),
		// 	1,
		// 	array(),
		// 	array( 'transport' => 'postMessage' )
		// );

		// Control: Smooth Scrolling
		$helper->add_control(
			'noo_smooth_scrolling',
			'noo_switch',
			__( 'Smooth Scrolling', NOO_TEXT_DOMAIN ),
			0,
			array(),
			array( 'transport' => 'postMessage' )
		);
	}
add_action( 'customize_register', 'noo_customizer_register_options_general' );
endif;

// 2. Design and Layout options.
if ( ! function_exists( 'noo_customizer_register_options_layout' ) ) :
	function noo_customizer_register_options_layout( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Customizer_Helper( $wp_customize );

		// Section: Layout & Skin
		$helper->add_section(
			'noo_customizer_section_layout',
			__( 'Design and Layout', NOO_TEXT_DOMAIN ),
			__( 'Set Style and Layout for your site. Boxed Layout will come with additional setting options for background color and image.', NOO_TEXT_DOMAIN )
		);

		// Control: Site Skin
		$helper->add_control(
			'noo_site_skin',
			'noo_radio',
			__( 'Site Design', NOO_TEXT_DOMAIN ),
			'light',
			array(
				'choices' => array( 'light' => __( 'Light', NOO_TEXT_DOMAIN ),
				'dark'    => __( 'Dark', NOO_TEXT_DOMAIN ) )
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Site Layout
		$helper->add_control(
			'noo_site_layout',
			'noo_radio',
			__( 'Site Layout', NOO_TEXT_DOMAIN ),
			'fullwidth',
			array(
				'choices' => array( 'fullwidth' => __( 'Fullwidth', NOO_TEXT_DOMAIN ), 'boxed' => __( 'Boxed', NOO_TEXT_DOMAIN ) ),
				'json'  => array(
					'child_options' => array(
						'boxed' => 'noo_layout_site_width
									,noo_layout_site_max_width
									,noo_layout_bg_color
                                    ,noo_layout_bg_image_sub_section
                                    ,noo_layout_bg_image
                                    ,noo_layout_bg_repeat
                                    ,noo_layout_bg_align
                                    ,noo_layout_bg_attachment
                                    ,noo_layout_bg_cover'
					)
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Site Width (%)
		$helper->add_control(
			'noo_layout_site_width',
			'ui_slider',
			__( 'Site Width (%)', NOO_TEXT_DOMAIN ),
			'90',
			array(
				'json' => array(
					'data_min' => '60',
					'data_max' => '100',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Site Max Width (px)
		$helper->add_control(
			'noo_layout_site_max_width',
			'ui_slider',
			__( 'Site Max Width (px)', NOO_TEXT_DOMAIN ),
			'1200',
			array(
				'json' => array(
					'data_min'  => '980',
					'data_max'  => '1600',
					'data_step' => '10',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Background Color
		$helper->add_control(
			'noo_layout_bg_color',
			'color_control',
			__( 'Background Color', NOO_TEXT_DOMAIN ),
			'#ffffff',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Sub-section: Background Image
		$helper->add_sub_section(
			'noo_layout_bg_image_sub_section',
			__( 'Background Image', NOO_TEXT_DOMAIN ),
			__( 'Upload your background image here, you have various settings for your image:<br/><strong>Repeat Image</strong>: enable repeating your image, you will need it when using patterned background.<br/><strong>Alignment</strong>: Set the position to align your background image.<br/><strong>Attachment</strong>: Make your image scroll with your site or fixed.<br/><strong>Auto resize</strong>: Enable it to ensure your background image always fit the windows.', NOO_TEXT_DOMAIN )
		);

		// Control: Background Image
		$helper->add_control(
			'noo_layout_bg_image',
			'noo_image',
			__( 'Background Image', NOO_TEXT_DOMAIN ),
			null,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Repeat Image
		$helper->add_control(
			'noo_layout_bg_repeat',
			'radio',
			__( 'Background Repeat', NOO_TEXT_DOMAIN ),
			'no-repeat',
			array(
				'choices' => array(
					'repeat' => __( 'Repeat', NOO_TEXT_DOMAIN ),
					'no-repeat' => __( 'No Repeat', NOO_TEXT_DOMAIN ),
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Align Image
		$helper->add_control(
			'noo_layout_bg_align',
			'select',
			__( 'BG Image Alignment', NOO_TEXT_DOMAIN ),
			'left top',
			array(
				'choices' => array(
					'left top'       => __( 'Left Top', NOO_TEXT_DOMAIN ),
					'left center'     => __( 'Left Center', NOO_TEXT_DOMAIN ),
					'left bottom'     => __( 'Left Bottom', NOO_TEXT_DOMAIN ),
					'center top'     => __( 'Center Top', NOO_TEXT_DOMAIN ),
					'center center'     => __( 'Center Center', NOO_TEXT_DOMAIN ),
					'center bottom'     => __( 'Center Bottom', NOO_TEXT_DOMAIN ),
					'right top'     => __( 'Right Top', NOO_TEXT_DOMAIN ),
					'right center'     => __( 'Right Center', NOO_TEXT_DOMAIN ),
					'right bottom'     => __( 'Right Bottom', NOO_TEXT_DOMAIN ),
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Enable Scrolling Image
		$helper->add_control(
			'noo_layout_bg_attachment',
			'radio',
			__( 'BG Image Attachment', NOO_TEXT_DOMAIN ),
			'fixed',
			array(
				'choices' => array(
					'fixed' => __( 'Fixed Image', NOO_TEXT_DOMAIN ),
					'scroll' => __( 'Scroll with Site', NOO_TEXT_DOMAIN ),
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Auto Resize
		$helper->add_control(
			'noo_layout_bg_cover',
			'noo_switch',
			__( 'Auto Resize', NOO_TEXT_DOMAIN ),
			0,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Sub-Section: Links Color
		$helper->add_sub_section(
			'noo_general_sub_section_links_color',
			__( 'Color', NOO_TEXT_DOMAIN ),
			__( 'Here you can set the color for links and various elements on your site.', NOO_TEXT_DOMAIN )
		);

		// Control: Site Links Color
		$helper->add_control(
			'noo_site_link_color',
			'color_control',
			__( 'Links Color', NOO_TEXT_DOMAIN ),
			noo_default_primary_color(),
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Site Links Hover Color
		$helper->add_control(
			'noo_site_link_hover_color',
			'color_control',
			__( 'Links Hover Color', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Secondary Color
		$helper->add_control(
			'noo_site_secondary_color',
			'color_control',
			__( 'Secondary Color', NOO_TEXT_DOMAIN ),
			'#f0e797',
			array(),
			array( 'transport' => 'postMessage' )
		);
	}
add_action( 'customize_register', 'noo_customizer_register_options_layout' );
endif;

// 3. Typography options.
if ( ! function_exists( 'noo_customizer_register_options_typo' ) ) :
	function noo_customizer_register_options_typo( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Customizer_Helper( $wp_customize );

		// Section: Typography
		$helper->add_section(
			'noo_customizer_section_typo',
			__( 'Typography', NOO_TEXT_DOMAIN ),
			__( 'Customize your Typography settings. Merito integrated all Google Fonts. See font preview at <a target="_blank" href="http://www.google.com/fonts/">Google Fonts</a>.', NOO_TEXT_DOMAIN )
		);

		// Control: Use Custom Fonts
		$helper->add_control(
			'noo_typo_use_custom_fonts',
			'noo_switch',
			__( 'Use Custom Fonts?', NOO_TEXT_DOMAIN ),
			0,
			array( 'json' => array( 
				'on_child_options'  => 'noo_typo_headings_font,noo_typo_body_font' 
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Use Custom Font Color
		$helper->add_control(
			'noo_typo_use_custom_fonts_color',
			'noo_switch',
			__( 'Custom Font Color?', NOO_TEXT_DOMAIN ),
			0,
			array( 'json' => array(
				'on_child_options'  => 'noo_typo_headings_font_color,noo_typo_body_font_color'
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Sub-Section: Headings
		$helper->add_sub_section(
			'noo_typo_sub_section_headings',
			__( 'Headings', NOO_TEXT_DOMAIN )
		);

		// Control: Headings font
		$helper->add_control(
			'noo_typo_headings_font',
			'google_fonts',
			__( 'Headings Font', NOO_TEXT_DOMAIN ),
			noo_default_headings_font_family(),
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Headings Font Color
		$helper->add_control(
			'noo_typo_headings_font_color',
			'color_control',
			__( 'Font Color', NOO_TEXT_DOMAIN ),
			noo_default_headings_color(),
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Headings Font Uppercase
		$helper->add_control(
			'noo_typo_headings_uppercase',
			'checkbox',
			__( 'Transform to Uppercase', NOO_TEXT_DOMAIN ),
			0,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Sub-Section: Body
		$helper->add_sub_section(
			'noo_typo_sub_section_body',
			__( 'Body', NOO_TEXT_DOMAIN )
		);

		// Control: Body font
		$helper->add_control(
			'noo_typo_body_font',
			'google_fonts',
			__( 'Body Font', NOO_TEXT_DOMAIN ),
			noo_default_font_family(),
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Body Font Size
		$helper->add_control(
			'noo_typo_body_font_size',
			'font_size',
			__( 'Font Size (px)', NOO_TEXT_DOMAIN ),
			noo_default_font_size(),
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Body Font Color
		$helper->add_control(
			'noo_typo_body_font_color',
			'color_control',
			__( 'Font Color', NOO_TEXT_DOMAIN ),
			noo_default_text_color(),
			array(),
			array( 'transport' => 'postMessage' )
		);
	}
add_action( 'customize_register', 'noo_customizer_register_options_typo' );
endif;

// // 4. Color options.
// if ( ! function_exists( 'noo_customizer_register_options_color' ) ) :
// 	function noo_customizer_register_options_color( $wp_customize ) {

// 		// declare helper object.
// 		$helper = new NOO_Customizer_Helper( $wp_customize );

// 		// Section: Color
// 		$helper->add_section(
// 			'noo_customizer_section_color',
// 			__( 'Color', NOO_TEXT_DOMAIN )
// 		);
// 	}
// add_action( 'customize_register', 'noo_customizer_register_options_color' );
// endif;

// // 5. Buttons options.
// if ( ! function_exists( 'noo_customizer_register_options_buttons' ) ) :
// 	function noo_customizer_register_options_buttons( $wp_customize ) {

// 		// declare helper object.
// 		$helper = new NOO_Customizer_Helper( $wp_customize );

// 		// Section: Buttons
// 		$helper->add_section(
// 			'noo_customizer_section_buttons',
// 			__( 'Buttons', NOO_TEXT_DOMAIN )
// 		);
// 	}
// add_action( 'customize_register', 'noo_customizer_register_options_buttons' );
// endif;

// 6. Header options.
if ( ! function_exists( 'noo_customizer_register_options_header' ) ) :
	function noo_customizer_register_options_header( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Customizer_Helper( $wp_customize );

		// Section: Header
		$helper->add_section(
			'noo_customizer_section_header',
			__( 'Header', NOO_TEXT_DOMAIN ),
			__( 'Customize settings for your Header, including Navigation Bar (Logo and Navigation) and an optional Top Bar.', NOO_TEXT_DOMAIN ),
			true
		);

		// Sub-section: General Options
		$helper->add_sub_section(
			'noo_header_sub_section_general',
			__( 'General Options', NOO_TEXT_DOMAIN ),
			''
		);

		// // Control: Header Layout
		// $helper->add_control(
		// 	'noo_header_layout',
		// 	'noo_radio',
		// 	__( 'Header Layout', NOO_TEXT_DOMAIN ),
		// 	'inline', 
		// 	array(
		// 		'choices' => array(
		// 			'inline'       => __( 'Inline Logo and NavBar', NOO_TEXT_DOMAIN ),
		// 			'stack'        => __( 'Stack Logo and NavBar', NOO_TEXT_DOMAIN ),
		// 		)
		// 	)
		// );

		// // Control: Header Background Color
		// $helper->add_control(
		// 	'noo_header_bg_color',
		// 	'alpha_color',
		// 	__( 'Header Background Color', NOO_TEXT_DOMAIN),
		// 	'',
		// 	array(),
		// 	array( 'transport' => 'postMessage' )
		// );

		// Sub-Section: Navigation Bar
		$helper->add_sub_section(
			'noo_header_sub_section_nav',
			__( 'Navigation Bar', NOO_TEXT_DOMAIN ),
			__( 'Adjust settings for Navigation Bar. You also can customize some settings for the Toggle Button on Mobile in this section.', NOO_TEXT_DOMAIN )
		);

		// Control: NavBar Position
		$helper->add_control(
			'noo_header_nav_position',
			'noo_radio',
			__( 'NavBar Position', NOO_TEXT_DOMAIN ),
			'fixed_top', 
			array(
				'choices' => array(
					'static_top'       => __( 'Static Top', NOO_TEXT_DOMAIN ),
					'fixed_top'     => __( 'Fixed Top', NOO_TEXT_DOMAIN ),
					// 'fixed_left'     => __( 'Fixed Left', NOO_TEXT_DOMAIN ),
					// 'fixed_right'     => __( 'Fixed Right', NOO_TEXT_DOMAIN ),
				),
				'json' => array(
					'child_options' => array(
						'fixed_top'   => 'noo_header_nav_shrinkable,noo_header_nav_smart_scroll',
						'fixed_left'  => 'noo_header_side_nav_width,noo_header_side_nav_alignment,noo_header_side_logo_margin_top,noo_header_side_nav_link_height',
						'fixed_right' => 'noo_header_side_nav_width,noo_header_side_nav_alignment,noo_header_side_logo_margin_top,noo_header_side_nav_link_height',
					)
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Shrink NavBar when Scroll
		$helper->add_control(
			'noo_header_nav_shrinkable',
			'checkbox',
			__( 'Shrink NavBar when Scroll', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Smart Scroll
		$helper->add_control(
			'noo_header_nav_smart_scroll',
			'checkbox',
			__( 'Only Display when Scroll Up', NOO_TEXT_DOMAIN ),
			0,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Show Search Icon
		$helper->add_control(
			'noo_header_nav_icon_search',
			'checkbox',
			__( 'Show Search Icon', NOO_TEXT_DOMAIN ),
			0,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Phone Number
		$helper->add_control(
			'noo_header_nav_phone_number',
			'text',
			__( 'Phone Number', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Divider 2
		$helper->add_control( 'noo_header_nav_divider_2', 'divider', '' );

		// Control: Custom NavBar Font
		$helper->add_control(
			'noo_header_custom_nav_font',
			'noo_switch',
			__( 'Use Custom NavBar Font and Color?', NOO_TEXT_DOMAIN ),
			0,
			array( 'json' => array( 
				'on_child_options'  => 'noo_header_nav_font,noo_header_nav_link_color,noo_header_nav_link_hover_color' 
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: NavBar font
		$helper->add_control(
			'noo_header_nav_font',
			'google_fonts',
			__( 'NavBar Font', NOO_TEXT_DOMAIN ),
			noo_default_font_family(),
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: NavBar Font Size
		$helper->add_control(
			'noo_header_nav_font_size',
			'ui_slider',
			__( 'Font Size (px)', NOO_TEXT_DOMAIN ),
			'14',
			array(
				'json' => array(
					'data_min' => '9',
					'data_max' => '30',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: NavBar Link Color
		$helper->add_control(
			'noo_header_nav_link_color',
			'color_control',
			__( 'Link Color', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: NavBar Link Hover Color
		$helper->add_control(
			'noo_header_nav_link_hover_color',
			'color_control',
			__( 'Link Hover Color', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: NavBar Font Uppercase
		$helper->add_control(
			'noo_header_nav_uppercase',
			'checkbox',
			__( 'Transform to Uppercase', NOO_TEXT_DOMAIN ),
			0,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Divider 3
		$helper->add_control( 'noo_header_nav_divider_3', 'divider', '' );

		// Control: Custom Dropdown Style
		$helper->add_control(
			'noo_header_nav_dropdown_custom',
			'noo_switch',
			__( 'Custom Dropdown Style', NOO_TEXT_DOMAIN ),
			0,
			array(
				'json' => array(
					'on_child_options'  => 'noo_header_nav_dropdown_bg_color,noo_header_nav_dropdown_link_color,noo_header_nav_dropdown_link_hover_color,noo_header_nav_dropdown_font_size'
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Dropdown Background Color
		$helper->add_control(
			'noo_header_nav_dropdown_bg_color',
			'alpha_color',
			__( 'Dropdown Background Color', NOO_TEXT_DOMAIN),
			'#ffffff',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Dropdown Font Size
		$helper->add_control(
			'noo_header_nav_dropdown_font_size',
			'ui_slider',
			__( 'Dropdown Font Size (px)', NOO_TEXT_DOMAIN ),
			'14',
			array(
				'json' => array(
					'data_min' => '9',
					'data_max' => '30',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Dropdown Link Color
		$helper->add_control(
			'noo_header_nav_dropdown_link_color',
			'color_control',
			__( 'Dropdown Link Color', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Dropdown Link Hover Color
		$helper->add_control(
			'noo_header_nav_dropdown_link_hover_color',
			'color_control',
			__( 'Dropdown Link Hover Color', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Sub-Section: Logo
		$helper->add_sub_section(
			'noo_header_sub_section_logo',
			__( 'Logo', NOO_TEXT_DOMAIN ),
			__( 'All the settings for Logo go here. If you do not use Image for Logo, plain text will be used.', NOO_TEXT_DOMAIN )
		);

		// Control: Use Image for Logo
		$helper->add_control(
			'noo_header_use_image_logo',
			'noo_switch',
			__( 'Use Image for Logo?', NOO_TEXT_DOMAIN ),
			0,
			array(
				'json' => array(
					'on_child_options'   => 'noo_header_logo_image
                                        ,noo_header_logo_retina_image
                                        ,noo_header_logo_image_height',
					'off_child_options'  => 'blogname
										,noo_header_logo_font
                                        ,noo_header_logo_font_size
                                        ,noo_header_logo_font_color
                                        ,noo_header_logo_uppercase'
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Blog Name
		$helper->add_control(
			'blogname',
			'text',
			__( 'Blog Name', NOO_TEXT_DOMAIN ),
			get_bloginfo( 'name' ),
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Logo font
		$helper->add_control(
			'noo_header_logo_font',
			'google_fonts',
			__( 'Logo Font', NOO_TEXT_DOMAIN ),
			noo_default_logo_font_family(),
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Logo Font Size
		$helper->add_control(
			'noo_header_logo_font_size',
			'ui_slider',
			__( 'Font Size (px)', NOO_TEXT_DOMAIN ),
			'30',
			array(
				'json' => array(
					'data_min' => '15',
					'data_max' => '80',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Logo Font Color
		$helper->add_control(
			'noo_header_logo_font_color',
			'color_control',
			__( 'Font Color', NOO_TEXT_DOMAIN ),
			noo_default_logo_color(),
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Logo Font Uppercase
		$helper->add_control(
			'noo_header_logo_uppercase',
			'checkbox',
			__( 'Transform to Uppercase', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Logo Image
		$helper->add_control(
			'noo_header_logo_image',
			'noo_image',
			__( 'Upload Your Logo', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Logo Retina Image
		$helper->add_control(
			'noo_header_logo_retina_image',
			'noo_image',
			__( 'Retina Logo', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Logo Image Height
		$helper->add_control(
			'noo_header_logo_image_height',
			'ui_slider',
			__( 'Image Height (px)', NOO_TEXT_DOMAIN ),
			'30',
			array(
				'json' => array(
					'data_min' => '15',
					'data_max' => '80',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Sub-Section: NavBar Alignment
		$helper->add_sub_section(
			'noo_header_sub_section_alignment',
			__( 'NavBar Alignment', NOO_TEXT_DOMAIN ),
			''
		);

		// // Control: Side Nav - Width (px)
		// $helper->add_control(
		// 	'noo_header_side_nav_width',
		// 	'ui_slider',
		// 	__( 'Side Nav - Width', NOO_TEXT_DOMAIN ),
		// 	'240',
		// 	array(
		// 		'json' => array(
		// 			'data_min'  => '100',
		// 			'data_max'  => '500',
		// 			'data_step' => '5',
		// 		)
		// 	),
		// 	array( 'transport' => 'postMessage' )
		// );

		// // Control: Side Nav - Link Alignment
		// $helper->add_control(
		// 	'noo_header_side_nav_alignment',
		// 	'radio',
		// 	__( 'Side Nav - Link Alignment', NOO_TEXT_DOMAIN),
		// 	'center',
		// 	array(
		// 		'choices' => array(
		// 			'center'   => __( 'Center', NOO_TEXT_DOMAIN ),
		// 			'left'	=> __( 'Left', NOO_TEXT_DOMAIN ),
		// 			'right'   => __( 'Right', NOO_TEXT_DOMAIN ),
		// 		)
		// 	),
		// 	array( 'transport' => 'postMessage' )
		// );

		// // Control: Side Nav - Link Spacing (px)
		// $helper->add_control(
		// 	'noo_header_side_nav_link_height',
		// 	'ui_slider',
		// 	__( 'Side Nav - Link Spacing (px)', NOO_TEXT_DOMAIN ),
		// 	'40',
		// 	array(
		// 		'json' => array(
		// 			'data_min' => '0',
		// 			'data_max' => '100',
		// 		)
		// 	),
		// 	array( 'transport' => 'postMessage' )
		// );

		// // Control: Side Nav - Logo Top Alignment (px)
		// $helper->add_control(
		// 	'noo_header_side_logo_margin_top',
		// 	'ui_slider',
		// 	__( 'Side Nav - Logo Top Alignment (px)', NOO_TEXT_DOMAIN ),
		// 	'30',
		// 	array(
		// 		'json' => array(
		// 			'data_min' => '0',
		// 			'data_max' => '100',
		// 		)
		// 	),
		// 	array( 'transport' => 'postMessage' )
		// );

		// Control: NavBar Height (px)
		$helper->add_control(
			'noo_header_nav_height',
			'ui_slider',
			__( 'NavBar Height (px)', NOO_TEXT_DOMAIN ),
			'70',
			array(
				'json' => array(
					'data_min' => '20',
					'data_max' => '150',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: NavBar Link Spacing (px)
		$helper->add_control(
			'noo_header_nav_link_spacing',
			'ui_slider',
			__( 'NavBar Link Spacing (px)', NOO_TEXT_DOMAIN ),
			'12',
			array(
				'json' => array(
					'data_min' => '5',
					'data_max' => '30',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Mobile Icon Size (px)
		$helper->add_control(
			'noo_header_nav_toggle_size',
			'ui_slider',
			__( 'Mobile Icon Size (px)', NOO_TEXT_DOMAIN ),
			'25',
			array(
				'json' => array(
					'data_min' => '15',
					'data_max' => '100',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Sub-Section: Top Bar
		$helper->add_sub_section(
			'noo_header_sub_section_top_bar',
			__( 'Top Bar', NOO_TEXT_DOMAIN ),
			__( 'Top Bar lays on top of your site, above Navigation Bar. It is suitable for placing contact information and social media link. Enable to control its layout and content.', NOO_TEXT_DOMAIN )
		);

		// Control: Header TopBar
		$helper->add_control(
			'noo_header_top_bar',
			'noo_switch',
			__( 'Enable Top Bar', NOO_TEXT_DOMAIN ),
			0,
			array(
				'json' => array(
					'on_child_options'  => 'noo_top_bar_social,noo_top_bar_content,noo_top_bar_email,noo_top_bar_show_register,noo_top_bar_show_login'
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Top Bar Social
		$helper->add_control(
			'noo_top_bar_social',
			'noo_switch',
			__( 'Show Social Icons', NOO_TEXT_DOMAIN ),
			'1',
			array(
				'json' => array(
					'on_child_options' => 'noo_top_bar_social_layout',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Top Bar Layout (with Social)
		$helper->add_control(
			'noo_top_bar_social_layout',
			'radio',
			__( 'Social Position', NOO_TEXT_DOMAIN ),
			'content_left',
			array(
				'choices' => array(
					'content_right'   => __( 'Social Left', NOO_TEXT_DOMAIN ),
					'content_left'   => __( 'Social Right', NOO_TEXT_DOMAIN ),
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Top Bar Email
		$helper->add_control(
			'noo_top_bar_email',
			'text',
			__( 'Email', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Top Bar Register
		$helper->add_control(
			'noo_top_bar_show_register',
			'checkbox',
			__( 'Show Register Link', NOO_TEXT_DOMAIN ),
			'1',
			array(
				'json' => array(
					'on_child_options' => 'noo_top_bar_register_page',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Register Page
		$helper->add_control(
			'noo_top_bar_register_page',
			'pages_select',
			__( 'Custom Register Page', NOO_TEXT_DOMAIN ),
			'1',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Top Bar Login
		$helper->add_control(
			'noo_top_bar_show_login',
			'checkbox',
			__( 'Show Login Link', NOO_TEXT_DOMAIN ),
			'1',
			array(
				'json' => array(
					'on_child_options' => 'noo_top_bar_login_page',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Login Page
		$helper->add_control(
			'noo_top_bar_login_page',
			'pages_select',
			__( 'Custom Login Page', NOO_TEXT_DOMAIN ),
			'1',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// // Control: Top Bar Content
		// $helper->add_control(
		// 	'noo_top_bar_content',
		// 	'textarea',
		// 	__( 'Custom Content (HTML)', NOO_TEXT_DOMAIN ),
		// 	'',
		// 	array(),
		// 	array( 'transport' => 'postMessage' )
		// );
	}
add_action( 'customize_register', 'noo_customizer_register_options_header' );
endif;

// 7. Footer options.
if ( ! function_exists( 'noo_customizer_register_options_footer' ) ) :
	function noo_customizer_register_options_footer( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Customizer_Helper( $wp_customize );

		// Section: Footer
		$helper->add_section(
			'noo_customizer_section_footer',
			__( 'Footer', NOO_TEXT_DOMAIN )
		);

		// Control: Footer Columns (Widgetized)
		$helper->add_control(
			'noo_footer_widgets',
			'select',
			__( 'Footer Columns (Widgetized)', NOO_TEXT_DOMAIN ),
			'4',
			array(
				'choices' => array(
					0       => __( 'None (No Footer Main Content)', NOO_TEXT_DOMAIN ),
					1     => __( 'One', NOO_TEXT_DOMAIN ),
					2     => __( 'Two', NOO_TEXT_DOMAIN ),
					3     => __( 'Three', NOO_TEXT_DOMAIN ),
					4     => __( 'Four', NOO_TEXT_DOMAIN )
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// // Control: Show Footer Menu
		// $helper->add_control(
		// 	'noo_bottom_bar_menu',
		// 	'checkbox',
		// 	__( 'Show Footer Menu', NOO_TEXT_DOMAIN ),
		// 	0,
		// 	array(),
		// 	array( 'transport' => 'postMessage' )
		// );

		// // Control: Show Footer Social Icons
		// $helper->add_control(
		// 	'noo_bottom_bar_social',
		// 	'checkbox',
		// 	__( 'Show Footer Social Icons', NOO_TEXT_DOMAIN ),
		// 	1,
		// 	array(),
		// 	array( 'transport' => 'postMessage' )
		// );

		// Control: Footer Image
		$helper->add_control(
			'noo_bottom_bar_logo_image',
			'noo_image',
			__( 'Upload Footer Logo', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Bottom Bar Content
		$helper->add_control(
			'noo_bottom_bar_content',
			'textarea',
			__( 'Bottom Bar Content (HTML)', NOO_TEXT_DOMAIN ),
			'2014 Nootheme. All Rights Reserved. Powered by Wordpress',
			array(),
			array( 'transport' => 'postMessage' )
		);

	}
add_action( 'customize_register', 'noo_customizer_register_options_footer' );
endif;

// 8. WP Sidebar options.
if ( ! function_exists( 'noo_customizer_register_options_sidebar' ) ) :
	function noo_customizer_register_options_sidebar( $wp_customize ) {

		global $wp_version;
		if ( $wp_version >= 4.0 ) {
			// declare helper object.
			$helper = new NOO_Customizer_Helper( $wp_customize );

			// Change the sidebar panel priority
			$widget_panel = $wp_customize->get_panel('widgets');
			if(!empty($widget_panel)) {
				$widget_panel->priority = $helper->get_new_section_priority();
			}
		}
	}
add_action( 'customize_register', 'noo_customizer_register_options_sidebar' );
endif;

// 9. Blog options.
if ( ! function_exists( 'noo_customizer_register_options_blog' ) ) :
	function noo_customizer_register_options_blog( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Customizer_Helper( $wp_customize );

		// Section: Blog
		$helper->add_section(
			'noo_customizer_section_blog',
			__( 'Blog', NOO_TEXT_DOMAIN ),
			__( 'In this section you have settings for your Blog page, Archive page and Single Post page.', NOO_TEXT_DOMAIN ),
			true
		);

		// Sub-section: Blog Page (Index Page)
		$helper->add_sub_section(
			'noo_blog_sub_section_blog_page',
			__( 'Blog Page', NOO_TEXT_DOMAIN ),
			__( 'Choose Layout and Headline settings for your Blog Page', NOO_TEXT_DOMAIN )
		);

		// Control: Blog Layout
		$helper->add_control(
			'noo_blog_layout',
			'noo_radio',
			__( 'Blog Layout', NOO_TEXT_DOMAIN ),
			'sidebar',
			array(
				'choices' => array(
					'fullwidth'   => __( 'Full-Width', NOO_TEXT_DOMAIN ),
					'sidebar'   => __( 'With Right Sidebar', NOO_TEXT_DOMAIN ),
					'left_sidebar'   => __( 'With Left Sidebar', NOO_TEXT_DOMAIN )
				),
				'json' => array(
					'child_options' => array(
						'fullwidth'   => '',
						'sidebar'   => 'noo_blog_sidebar',
						'left_sidebar'   => 'noo_blog_sidebar'
					)
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Blog Sidebar
		$helper->add_control(
			'noo_blog_sidebar',
			'widgets_select',
			__( 'Blog Sidebar', NOO_TEXT_DOMAIN ),
			'sidebar-main',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// // Control: Blog Style
		// $helper->add_control(
		// 	'noo_blog_style',
		// 	'noo_radio',
		// 	__( 'Blog Style', NOO_TEXT_DOMAIN ),
		// 	'standard',
		// 	array(
		// 		'choices' => array(
		// 			'standard'   => __( 'Standard Blog', NOO_TEXT_DOMAIN ),
		// 			'masonry'   => __( 'Masonry Blog', NOO_TEXT_DOMAIN ),
		// 		),
		// 		'json'	=> array(
		// 			'child_options'	=> array(
		// 				'masonry'	=> 'noo_blog_masonry_columns'
		// 			)
		// 		)
		// 	),
		// 	array( 'transport' => 'postMessage' )
		// );

		// // Control: Masonry Columns
		// $helper->add_control(
		// 	'noo_blog_masonry_columns',
		// 	'select',
		// 	__( 'Masonry Columns', NOO_TEXT_DOMAIN ),
		// 	'2',
		// 	array(
		// 		'choices' => array(
		// 			2     => __( 'Two', NOO_TEXT_DOMAIN ),
		// 			3     => __( 'Three', NOO_TEXT_DOMAIN ),
		// 			4     => __( 'Four', NOO_TEXT_DOMAIN )
		// 		)
		// 	),
		// 	array( 'transport' => 'postMessage' )
		// );

		// // Control: Show Blog Headline
		// $helper->add_control(
		// 	'noo_blog_heading',
		// 	'noo_switch',
		// 	__( 'Show Blog Headline', NOO_TEXT_DOMAIN ),
		// 	0,
		// 	array(
		// 		'json' => array(
		// 			'on_child_options' => 'noo_blog_heading_image,noo_blog_heading_title,noo_blog_heading_sub_title'
		// 		)
		// 	),
		// 	array( 'transport' => 'postMessage' )
		// );

		// // Control: Headline Background Image
		// $helper->add_control(
		// 	'noo_blog_heading_image',
		// 	'noo_image',
		// 	__( 'Headline Background Image', NOO_TEXT_DOMAIN ),
		// 	'',
		// 	array(),
		// 	array( 'transport' => 'postMessage' )
		// );

		// // Control: Headline Title
		// $helper->add_control(
		// 	'noo_blog_heading_title',
		// 	'text',
		// 	__( 'Headline Title', NOO_TEXT_DOMAIN ),
		// 	__( 'My Blog', NOO_TEXT_DOMAIN ),
		// 	array(),
		// 	array( 'transport' => 'postMessage' )
		// );

		// // Control: Headline Sub-Title
		// $helper->add_control(
		// 	'noo_blog_heading_sub_title',
		// 	'textarea',
		// 	__( 'Headline Sub-Title', NOO_TEXT_DOMAIN ),
		// 	'',
		// 	array('json' => array('size' => 'small')),
		// 	array( 'transport' => 'postMessage' )
		// );

		// Control: Divider 1
		$helper->add_control( 'noo_blog_divider_1', 'divider', '' );

		// Control: Show Post Meta
		$helper->add_control(
			'noo_blog_show_post_meta',
			'checkbox',
			__( 'Show Post Meta', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Show Post Tag
		$helper->add_control(
			'noo_blog_show_post_tag',
			'checkbox',
			__( 'Show Post Tags', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Show Readmore link
		$helper->add_control(
			'noo_blog_show_readmore',
			'checkbox',
			__( 'Show Readmore link', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Excerpt Length
		$helper->add_control(
			'noo_blog_excerpt_length',
			'text',
			__( 'Excerpt Length', NOO_TEXT_DOMAIN ),
			'60',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Sub-section: Archive Page
		$helper->add_sub_section(
			'noo_blog_sub_section_archive',
			__( 'Archive Page', NOO_TEXT_DOMAIN )
		);

		// Control: Archive Layout
		$helper->add_control(
			'noo_blog_archive_layout',
			'noo_same_as_radio',
			__( 'Archive Layout', NOO_TEXT_DOMAIN ),
			'same_as_blog',
			array(
				'choices' => array(
					'same_as_blog'	=> __( 'Same as Blog Layout', NOO_TEXT_DOMAIN ),
					'fullwidth'   => __( 'Full-Width', NOO_TEXT_DOMAIN ),
					'sidebar'   => __( 'With Right Sidebar', NOO_TEXT_DOMAIN ),
					'left_sidebar'   => __( 'With Left Sidebar', NOO_TEXT_DOMAIN ),
				),
				'json' => array(
					'child_options' => array(
						'fullwidth'   => '',
						'sidebar'   => 'noo_blog_archive_sidebar',
						'left_sidebar'   => 'noo_blog_archive_sidebar',
					)
				),
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Archive Sidebar
		$helper->add_control(
			'noo_blog_archive_sidebar',
			'widgets_select',
			__( 'Archives Sidebar', NOO_TEXT_DOMAIN ),
			'sidebar-main',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// // Control: Archive Style
		// $helper->add_control(
		// 	'noo_blog_archive_style',
		// 	'noo_same_as_radio',
		// 	__( 'Archive Style', NOO_TEXT_DOMAIN ),
		// 	'same_as_blog',
		// 	array(
		// 		'choices' => array(
		// 			'same_as_blog'   => __( 'Same as Blog Style', NOO_TEXT_DOMAIN ),
		// 			'standard'   => __( 'Standard', NOO_TEXT_DOMAIN ),
		// 			'masonry'   => __( 'Masonry', NOO_TEXT_DOMAIN ),
		// 		),
		// 		'json'	=> array(
		// 			'child_options'	=> array(
		// 				'masonry'	=> 'noo_blog_archive_masonry_columns'
		// 			)
		// 		)
		// 	),
		// 	array( 'transport' => 'postMessage' )
		// );

		// // Control: Masonry Columns
		// $helper->add_control(
		// 	'noo_blog_archive_masonry_columns',
		// 	'select',
		// 	__( 'Masonry Columns', NOO_TEXT_DOMAIN ),
		// 	'2',
		// 	array(
		// 		'choices' => array(
		// 			2     => __( 'Two', NOO_TEXT_DOMAIN ),
		// 			3     => __( 'Three', NOO_TEXT_DOMAIN ),
		// 			4     => __( 'Four', NOO_TEXT_DOMAIN )
		// 		)
		// 	),
		// 	array( 'transport' => 'postMessage' )
		// );

		// Sub-section: Single Post
		$helper->add_sub_section(
			'noo_blog_sub_section_post',
			__( 'Single Post', NOO_TEXT_DOMAIN )
		);

		// Control: Post Layout
		$helper->add_control(
			'noo_blog_post_layout',
			'noo_same_as_radio',
			__( 'Post Layout', NOO_TEXT_DOMAIN ),
			'same_as_blog',
			array(
				'choices' => array(
					'same_as_blog'   => __( 'Same as Blog Layout', NOO_TEXT_DOMAIN ),
					'fullwidth'   => __( 'Full-Width', NOO_TEXT_DOMAIN ),
					'sidebar'   => __( 'With Right Sidebar', NOO_TEXT_DOMAIN ),
					'left_sidebar'   => __( 'With Left Sidebar', NOO_TEXT_DOMAIN ),
				),
				'json' => array(
					'child_options' => array(
						'fullwidth'   => '',
						'sidebar'   => 'noo_blog_post_sidebar',
						'left_sidebar'   => 'noo_blog_post_sidebar',
					)
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Post Sidebar
		$helper->add_control(
			'noo_blog_post_sidebar',
			'widgets_select',
			__( 'Post Sidebar', NOO_TEXT_DOMAIN ),
			'sidebar-main',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Divider 1
		$helper->add_control( 'noo_blog_post_divider_1', 'divider', '' );

		// Control: Show Post Meta
		$helper->add_control(
			'noo_blog_post_show_post_meta',
			'checkbox',
			__( 'Show Post Meta', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Show Post Tags
		$helper->add_control(
			'noo_blog_post_show_post_tag',
			'checkbox',
			__( 'Show Post Tags', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Show Author Bio
		$helper->add_control(
			'noo_blog_post_author_bio',
			'checkbox',
			__( 'Show Author\'s Bio', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Divider 2
		$helper->add_control( 'noo_blog_post_divider_2', 'divider', '' );

		// Control: Enable Social Sharing
		$helper->add_control(
			'noo_blog_social',
			'noo_switch',
			__( 'Enable Social Sharing', NOO_TEXT_DOMAIN ),
			1,
			array(
				'json' => array( 'on_child_options' => 'noo_blog_social_title,
														noo_blog_social_facebook,
		                                                noo_blog_social_twitter,
		                                                noo_blog_social_google,
		                                                noo_blog_social_pinterest,
		                                                noo_blog_social_linkedin'
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Sharing Title
		$helper->add_control(
			'noo_blog_social_title',
			'text',
			__( 'Sharing Title', NOO_TEXT_DOMAIN ),
			__( 'Share This Post', NOO_TEXT_DOMAIN ),
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Facebook Share
		$helper->add_control(
			'noo_blog_social_facebook',
			'checkbox',
			__( 'Facebook Share', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Twitter Share
		$helper->add_control(
			'noo_blog_social_twitter',
			'checkbox',
			__( 'Twitter Share', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Google+ Share
		$helper->add_control(
			'noo_blog_social_google',
			'checkbox',
			__( 'Google+ Share', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Pinterest Share
		$helper->add_control(
			'noo_blog_social_pinterest',
			'checkbox',
			__( 'Pinterest Share', NOO_TEXT_DOMAIN ),
			0,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: LinkedIn Share
		$helper->add_control(
			'noo_blog_social_linkedin',
			'checkbox',
			__( 'LinkedIn Share', NOO_TEXT_DOMAIN ),
			0,
			array(),
			array( 'transport' => 'postMessage' )
		);

	}
add_action( 'customize_register', 'noo_customizer_register_options_blog' );
endif;

// 11. Property options.
if ( ! function_exists( 'noo_customizer_register_options_property' ) ) :
	function noo_customizer_register_options_property( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Customizer_Helper( $wp_customize );

		// Section: Property
		$helper->add_section(
			'noo_customizer_section_property',
			__( 'Agent & Property', NOO_TEXT_DOMAIN ),
			'',
			true
		);

		// Sub-section: Agent Layout
		$helper->add_sub_section(
			'noo_property_sub_section_agent_layout',
			__( 'Agent Layout', NOO_TEXT_DOMAIN ),
			__( 'Setting here will affect all the pages of Agent. Index page, Archive page and Single agent page.', NOO_TEXT_DOMAIN )
		);

		// Control: Agent Layout
		$helper->add_control(
			'noo_agent_layout',
			'noo_radio',
			__( 'Agent Layout', NOO_TEXT_DOMAIN ),
			'fullwidth',
			array(
				'choices' => array(
					'fullwidth'   => __( 'Full-Width', NOO_TEXT_DOMAIN ),
					'sidebar'   => __( 'With Right Sidebar', NOO_TEXT_DOMAIN ),
					'left_sidebar'   => __( 'With Left Sidebar', NOO_TEXT_DOMAIN )
				),
				'json' => array(
					'child_options' => array(
						'fullwidth'   => '',
						'sidebar'   => 'noo_agent_sidebar',
						'left_sidebar'   => 'noo_agent_sidebar',
					)
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Agent Sidebar
		$helper->add_control(
			'noo_agent_sidebar',
			'widgets_select',
			__( 'Agent Sidebar', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Sub-section: Property Layout
		$helper->add_sub_section(
			'noo_property_sub_section_general',
			__( 'Property Layout', NOO_TEXT_DOMAIN ),
			__( 'Setting here will affect all the pages of Property. Index page, Archive page and Single property page.', NOO_TEXT_DOMAIN )
		);

		// Control: Property Layout
		$helper->add_control(
			'noo_property_layout',
			'noo_radio',
			__( 'Property Layout', NOO_TEXT_DOMAIN ),
			'fullwidth',
			array(
				'choices' => array(
					'fullwidth'   => __( 'Full-Width', NOO_TEXT_DOMAIN ),
					'sidebar'   => __( 'With Right Sidebar', NOO_TEXT_DOMAIN ),
					'left_sidebar'   => __( 'With Left Sidebar', NOO_TEXT_DOMAIN )
				),
				'json' => array(
					'child_options' => array(
						'fullwidth'   => '',
						'sidebar'   => 'noo_property_sidebar',
						'left_sidebar'   => 'noo_property_sidebar',
					)
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Property Sidebar
		$helper->add_control(
			'noo_property_sidebar',
			'widgets_select',
			__( 'Property Sidebar', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Sub-section: Property Listing
		$helper->add_sub_section(
			'noo_property_sub_section_listing',
			__( 'Property Listing', NOO_TEXT_DOMAIN ),
			__( 'This section has setting for Property listing pages (Index or Archive pages)', NOO_TEXT_DOMAIN )
		);

		// Control: Listing Map
		$helper->add_control(
			'noo_property_listing_map',
			'checkbox',
			__( 'Show Map on Header', NOO_TEXT_DOMAIN ),
			1,
			array(
				'json' => array(
					'on_child_options' => 'noo_property_listing_map_layout',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Map Layout
		$helper->add_control(
			'noo_property_listing_map_layout',
			'noo_radio',
			__( 'Map Search Layout', NOO_TEXT_DOMAIN ),
			'horizontal',
			array(
				'choices' => array(
					'horizontal'   => __( 'Horizontal Search', NOO_TEXT_DOMAIN ),
					'vertical'   => __( 'Vertical Search', NOO_TEXT_DOMAIN ),
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Default List Layout
		$helper->add_control(
			'noo_property_listing_layout',
			'noo_radio',
			__( 'Default List Layout', NOO_TEXT_DOMAIN ),
			'grid',
			array(
				'choices' => array(
					'grid'   => __( 'Grid Layout', NOO_TEXT_DOMAIN ),
					'list'   => __( 'List Layout', NOO_TEXT_DOMAIN ),
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Sub-section: Property Detail
		$helper->add_sub_section(
			'noo_property_sub_section_detail',
			__( 'Property Detail', NOO_TEXT_DOMAIN ),
			__( 'This section has setting for Property detail pages (Single pages)', NOO_TEXT_DOMAIN )
		);

		// Control: Detail Map
		$helper->add_control(
			'noo_property_detail_map',
			'checkbox',
			__( 'Show Map on Header', NOO_TEXT_DOMAIN ),
			0,
			array(
				'json' => array(
					'on_child_options' => 'noo_property_detail_map_layout',
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Map Layout
		$helper->add_control(
			'noo_property_detail_map_layout',
			'noo_radio',
			__( 'Map Search Layout', NOO_TEXT_DOMAIN ),
			'horizontal',
			array(
				'choices' => array(
					'horizontal'   => __( 'Horizontal Search', NOO_TEXT_DOMAIN ),
					'vertical'   => __( 'Vertical Search', NOO_TEXT_DOMAIN ),
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Divider 1
		$helper->add_control( 'noo_property_divider_1', 'divider', '' );

		// Control: Enable Social Sharing
		$helper->add_control(
			'noo_property_social',
			'noo_switch',
			__( 'Enable Social Sharing', NOO_TEXT_DOMAIN ),
			1,
			array(
				'json' => array( 'on_child_options' => 'noo_property_social_facebook,
		                                                noo_property_social_twitter,
		                                                noo_property_social_google,
		                                                noo_property_social_pinterest,
		                                                noo_property_social_linkedin'
				)
			),
			array( 'transport' => 'postMessage' )
		);

		// Control: Facebook Share
		$helper->add_control(
			'noo_property_social_facebook',
			'checkbox',
			__( 'Facebook Share', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Twitter Share
		$helper->add_control(
			'noo_property_social_twitter',
			'checkbox',
			__( 'Twitter Share', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Google+ Share
		$helper->add_control(
			'noo_property_social_google',
			'checkbox',
			__( 'Google+ Share', NOO_TEXT_DOMAIN ),
			1,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Pinterest Share
		$helper->add_control(
			'noo_property_social_pinterest',
			'checkbox',
			__( 'Pinterest Share', NOO_TEXT_DOMAIN ),
			0,
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: LinkedIn Share
		$helper->add_control(
			'noo_property_social_linkedin',
			'checkbox',
			__( 'LinkedIn Share', NOO_TEXT_DOMAIN ),
			0,
			array(),
			array( 'transport' => 'postMessage' )
		);

		if( defined('DSIDXPRESS_PLUGIN_VERSION') ) {
			// Sub-section: dsIDXPress Plugin
			$helper->add_sub_section(
				'noo_property_sub_section_idx',
				__( 'dsIDXPress Plugin', NOO_TEXT_DOMAIN ),
				__( 'This section has settings dedicated to dsIDXPress plugin. Please note that you will have to use "dsIDX Template" on dsIDX general option for it to work.', NOO_TEXT_DOMAIN )
			);

			// Control: IDX Layout
			$helper->add_control(
				'noo_property_idx_layout',
				'noo_radio',
				__( 'IDX Layout', NOO_TEXT_DOMAIN ),
				'fullwidth',
				array(
					'choices' => array(
						'fullwidth'   => __( 'Full-Width', NOO_TEXT_DOMAIN ),
						'sidebar'   => __( 'With Right Sidebar', NOO_TEXT_DOMAIN ),
						'left_sidebar'   => __( 'With Left Sidebar', NOO_TEXT_DOMAIN )
					),
					'json' => array(
						'child_options' => array(
							'fullwidth'   => '',
							'sidebar'   => 'noo_property_idx_sidebar',
							'left_sidebar'   => 'noo_property_idx_sidebar',
						)
					)
				),
				array( 'transport' => 'postMessage' )
			);

			// Control: IDX Sidebar
			$helper->add_control(
				'noo_property_idx_sidebar',
				'widgets_select',
				__( 'IDX Sidebar', NOO_TEXT_DOMAIN ),
				'',
				array(),
				array( 'transport' => 'postMessage' )
			);

			// Control: Enable Google Map
			$helper->add_control(
				'noo_property_idx_gmap',
				'checkbox',
				__( 'Show Google Map on IDX page ( The map will show if you use IDX Listing widget on the same page. )', NOO_TEXT_DOMAIN ),
				'',
				array(),
				array( 'transport' => 'postMessage' )
			);
		}

	}
add_action( 'customize_register', 'noo_customizer_register_options_property' );
endif;

// // 11. Page options.
// if ( ! function_exists( 'noo_customizer_register_options_page' ) ) :
// 	function noo_customizer_register_options_page( $wp_customize ) {

// 		// declare helper object.
// 		$helper = new NOO_Customizer_Helper( $wp_customize );

// 		// Section: Page
// 		$helper->add_section(
// 			'noo_customizer_section_page',
// 			__( 'Page', NOO_TEXT_DOMAIN )
// 		);

// 	}
// add_action( 'customize_register', 'noo_customizer_register_options_page' );
// endif;

// 12. WooCommerce options.
// if( NOO_WOOCOMMERCE_EXIST ) :
// 	if ( ! function_exists( 'noo_customizer_register_options_woocommerce' ) ) :
// 		function noo_customizer_register_options_woocommerce( $wp_customize ) {

// 			// declare helper object.
// 			$helper = new NOO_Customizer_Helper( $wp_customize );

// 			// Section: Revolution Slider
// 			$helper->add_section(
// 				'noo_customizer_section_shop',
// 				__( 'WooCommerce', NOO_TEXT_DOMAIN ),
// 				'',
// 				true
// 			);

// 			// Sub-section: Shop Page
// 			$helper->add_sub_section(
// 				'noo_woocommerce_sub_section_shop_page',
// 				__( 'Shop Page', NOO_TEXT_DOMAIN ),
// 				__( 'Choose Layout and Headline Settings for your Shop Page.', NOO_TEXT_DOMAIN )
// 			);

// 			// Control: Shop Layout
// 			$helper->add_control(
// 				'noo_shop_layout',
// 				'noo_radio',
// 				__( 'Shop Layout', NOO_TEXT_DOMAIN ),
// 				'fullwidth',
// 				array(
// 					'choices' => array(
// 						'fullwidth'   => __( 'Full-Width', NOO_TEXT_DOMAIN ),
// 						'sidebar'   => __( 'With Right Sidebar', NOO_TEXT_DOMAIN ),
// 						'left_sidebar'   => __( 'With Left Sidebar', NOO_TEXT_DOMAIN )
// 					),
// 					'json' => array(
// 						'child_options' => array(
// 							'fullwidth'   => '',
// 							'sidebar'   => 'noo_shop_sidebar',
// 							'left_sidebar'   => 'noo_shop_sidebar',
// 						)
// 					)
// 				),
// 				array( 'transport' => 'postMessage' )
// 			);

// 			// Control: Shop Sidebar
// 			$helper->add_control(
// 				'noo_shop_sidebar',
// 				'widgets_select',
// 				__( 'Shop Sidebar', NOO_TEXT_DOMAIN ),
// 				'',
// 				array(),
// 				array( 'transport' => 'postMessage' )
// 			);

// 			// Control: Number of Product per Page
// 			$helper->add_control(
// 				'noo_shop_num',
// 				'ui_slider',
// 				__( 'Products Per Page', NOO_TEXT_DOMAIN ),
// 				'12',
// 				array(
// 					'json' => array(
// 						'data_min'  => '4',
// 						'data_max'  => '50',
// 						'data_step' => '2'
// 					)
// 				),
// 				array( 'transport' => 'postMessage' )
// 			);

// 			// Control: Show Shop Headline
// 			$helper->add_control(
// 				'noo_shop_heading',
// 				'noo_switch',
// 				__( 'Show Shop Headline', NOO_TEXT_DOMAIN ),
// 				0,
// 				array(
// 					'json' => array(
// 						'on_child_options' => 'noo_shop_heading_image,noo_shop_heading_title,noo_shop_heading_sub_title'
// 					)
// 				),
// 				array( 'transport' => 'postMessage' )
// 			);

// 			// Control: Headline Background Image
// 			$helper->add_control(
// 				'noo_shop_heading_image',
// 				'noo_image',
// 				__( 'Headline Background Image', NOO_TEXT_DOMAIN ),
// 				'',
// 				array(),
// 				array( 'transport' => 'postMessage' )
// 			);

// 			// Control: Headline Title
// 			$helper->add_control(
// 				'noo_shop_heading_title',
// 				'text',
// 				__( 'Headline Title', NOO_TEXT_DOMAIN ),
// 				__( 'My Shop', NOO_TEXT_DOMAIN ),
// 				array(),
// 				array( 'transport' => 'postMessage' )
// 			);

// 			// Control: Headline Sub Title
// 			$helper->add_control(
// 				'noo_shop_heading_sub_title',
// 				'textarea',
// 				__( 'Headline Sub-Title', NOO_TEXT_DOMAIN ),
// 				'',
// 				array( 'json' => array('size' => 'small') ),
// 				array( 'transport' => 'postMessage' )
// 			);

// 			// Sub-section: Single Product
// 			$helper->add_sub_section(
// 				'noo_woocommerce_sub_section_product',
// 				__( 'Single Product', NOO_TEXT_DOMAIN )
// 			);

// 			// Control: Product Layout
// 			$helper->add_control(
// 				'noo_woocommerce_product_layout',
// 				'noo_same_as_radio',
// 				__( 'Product Layout', NOO_TEXT_DOMAIN ),
// 				'same_as_shop',
// 				array(
// 					'choices' => array(
// 						'same_as_shop'   => __( 'Same as Shop Layout', NOO_TEXT_DOMAIN ),
// 						'fullwidth'   => __( 'Full-Width', NOO_TEXT_DOMAIN ),
// 						'sidebar'   => __( 'With Right Sidebar', NOO_TEXT_DOMAIN ),
// 						'left_sidebar'   => __( 'With Left Sidebar', NOO_TEXT_DOMAIN ),
// 					),
// 					'json' => array(
// 						'child_options' => array(
// 							'fullwidth'   => '',
// 							'sidebar'   => 'noo_woocommerce_product_sidebar',
// 							'left_sidebar'   => 'noo_woocommerce_product_sidebar',
// 						)
// 					)
// 				),
// 				array( 'transport' => 'postMessage' )
// 			);

// 			// Control: Product Sidebar
// 			$helper->add_control(
// 				'noo_woocommerce_product_sidebar',
// 				'widgets_select',
// 				__( 'Product Sidebar', NOO_TEXT_DOMAIN ),
// 				'',
// 				array(),
// 				array( 'transport' => 'postMessage' )
// 			);

// 		}
// 	add_action( 'customize_register', 'noo_customizer_register_options_woocommerce' );
// 	endif;
// endif;

// // 13. Revolution Slider options.
// if ( ! function_exists( 'noo_customizer_register_options_rev_slider' ) ) :
// 	function noo_customizer_register_options_rev_slider( $wp_customize ) {

// 		// declare helper object.
// 		$helper = new NOO_Customizer_Helper( $wp_customize );

// 		// Section: Revolution Slider
// 		$helper->add_section(
// 			'noo_customizer_section_rev_slider',
// 			__( 'Revolution Slider', NOO_TEXT_DOMAIN )
// 		);

// 	}
// add_action( 'customize_register', 'noo_customizer_register_options_rev_slider' );
// endif;

// 14. Social Media options
if ( ! function_exists( 'noo_customizer_register_options_social' ) ) :
	function noo_customizer_register_options_social( $wp_customize ) {

		// Declare helper object.
		$helper = new NOO_Customizer_Helper( $wp_customize );

		// Section: Social Media
		$helper->add_section(
			'noo_customizer_section_social',
			__( 'Social Media', NOO_TEXT_DOMAIN ),
			__( 'Input URLs of your social media profile. Inputting URL here means that corresponding social icon will be displayed when Social Icon is enabled on Top Bar and/or on Bottom Bar.', NOO_TEXT_DOMAIN )
		);

		// Control: Facebook Profile URL
		$helper->add_control(
			'noo_social_facebook',
			'text',
			__( 'Facebook Profile URL', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Twitter Profile URL
		$helper->add_control(
			'noo_social_twitter',
			'text',
			__( 'Twitter Profile URL', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Google+ Profile URL
		$helper->add_control(
			'noo_social_google',
			'text',
			__( 'Google+ Profile URL', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Pinterest Profile URL
		$helper->add_control(
			'noo_social_pinterest',
			'text',
			__( 'Pinterest Profile URL', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: LinkedIn Profile URL
		$helper->add_control(
			'noo_social_linkedin',
			'text',
			__( 'LinkedIn Profile URL', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: RSS Feed URL
		$helper->add_control(
			'noo_social_rss',
			'text',
			__( 'RSS Feed URL', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Youtube Profile URL
		$helper->add_control(
			'noo_social_youtube',
			'text',
			__( 'Youtube Profile URL', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Instagram Profile URL
		$helper->add_control(
			'noo_social_instagram',
			'text',
			__( 'Instagram Profile URL', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

	}
add_action( 'customize_register', 'noo_customizer_register_options_social' );
endif;

// 15. Custom Code
if ( ! function_exists( 'noo_customizer_register_options_custom_code' ) ) :
	function noo_customizer_register_options_custom_code( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Customizer_Helper( $wp_customize );

		// Section: Custom Code
		$helper->add_section(
			'noo_customizer_section_custom_code',
			__( 'Custom Code', NOO_TEXT_DOMAIN ),
			__( 'In this section you can add custom JavaScript and CSS to your site.<br/>Your Google analytics tracking code should be added to Custom JavaScript field.', NOO_TEXT_DOMAIN )
		);

		// Control: Custom JS (Google Analytics)
		$helper->add_control(
			'noo_custom_javascript',
			'textarea',
			__( 'Custom JavaScript', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);

		// Control: Custom CSS
		$helper->add_control(
			'noo_custom_css',
			'textarea',
			__( 'Custom CSS', NOO_TEXT_DOMAIN ),
			'',
			array(),
			array( 'transport' => 'postMessage' )
		);
	}
add_action( 'customize_register', 'noo_customizer_register_options_custom_code' );
endif;

// 16. Import/Export Settings.
if ( ! function_exists( 'noo_customizer_register_options_tools' ) ) :
	function noo_customizer_register_options_tools( $wp_customize ) {

		// declare helper object.
		$helper = new NOO_Customizer_Helper( $wp_customize );

		// Section: Custom Code
		$helper->add_section(
			'noo_customizer_section_tools',
			__( 'Import/Export Settings', NOO_TEXT_DOMAIN ),
			__( 'All themes from NooTheme share the same theme setting structure so you can export then import settings from one theme to another conveniently without any problem.', NOO_TEXT_DOMAIN )
		);

		// Sub-section: Import Settings
		$helper->add_sub_section(
			'noo_tools_sub_section_import',
			__( 'Import Settings', NOO_TEXT_DOMAIN ),
			__( 'Click Upload button then choose a JSON file (.json) from your computer to import settings to this theme.<br/>All the settings will be loaded for preview here and will not be saved until you click button "Save and Publish".', NOO_TEXT_DOMAIN )
		);

		// Control: Upload Settings
		$helper->add_control(
			'noo_tools_import',
			'import_settings',
			__( 'Upload', NOO_TEXT_DOMAIN )
		);

		// Sub-section: Export Settings
		$helper->add_sub_section(
			'noo_tools_sub_section_export',
			__( 'Export Settings', NOO_TEXT_DOMAIN ),
			__( 'Simply click Download button to export all your settings to a JSON file (.json).<br/>You then can use that file to restore theme settings to any theme of NooTheme.', NOO_TEXT_DOMAIN )
		);

		// Control: Download Settings
		$helper->add_control(
			'noo_tools_export',
			'export_settings',
			__( 'Download', NOO_TEXT_DOMAIN )
		);

	}
add_action( 'customize_register', 'noo_customizer_register_options_tools' );
endif;

