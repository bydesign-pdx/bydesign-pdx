<?php
/**
 * NOO Meta Boxes Package
 *
 * Setup NOO Meta Boxes for Page
 * This file add Meta Boxes to WP Page edit page.
 *
 * @package    NOO Framework
 * @subpackage NOO Meta Boxes
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

if (!function_exists('noo_page_meta_boxes')):
	function noo_page_meta_boxes() {
		// Declare helper object
		$prefix = '_noo_wp_page';
		$helper = new NOO_Meta_Boxes_Helper($prefix, array(
			'page' => 'page'
		));

		// Page Settings
		$meta_box = array(
			'id' => "{$prefix}_meta_box_page",
			'title' => __('Page Settings', NOO_TEXT_DOMAIN) ,
			'description' => __('Choose various setting for your Page.', NOO_TEXT_DOMAIN) ,
			'fields' => array(
				array(
					'label' => __('Body Custom CSS Class', NOO_TEXT_DOMAIN) ,
					'id' => "_noo_body_css",
					'type' => 'text',
				),
				array(
					'label' => __('Hide Page Title', NOO_TEXT_DOMAIN) ,
					'id' => "{$prefix}_hide_page_title",
					'type' => 'checkbox',
				),
				// array(
				// 	'type' => 'divider'
				// ),
				// array(
				// 	'label' => __('Enable One Page Navigation', NOO_TEXT_DOMAIN) ,
				// 	'id' => "{$prefix}_enable_one_page",
				// 	'type' => 'checkbox',
				// 	'child-fields' => array(
				// 		'on' => "{$prefix}_one_page_menu"
				// 	)
				// ),
				// array(
				// 	'label' => __('Select One Page Menu', NOO_TEXT_DOMAIN) ,
				// 	'id' => "{$prefix}_one_page_menu",
				// 	'type' => 'menus'
				// ),
			)
		);

		$helper->add_meta_box($meta_box);

		//
		// Revolution Sliders
		//
		if ( class_exists( 'RevSlider' ) ) {
			// Home Slider
			$meta_box = array(
				'id' => "{$prefix}_meta_box_home_slider",
				'title' => __('Home Slider', NOO_TEXT_DOMAIN),
				'fields' => array(
					array(
					'id'    => "{$prefix}_enable_home_slider",
					'label' => __( 'Enable Home Slider' , NOO_TEXT_DOMAIN ),
					'desc'  => __( 'Enable Home Slider which displayed on the top of your site, along with the Header.', NOO_TEXT_DOMAIN ),
					'type'  => 'checkbox',
					'std'   => 'off',
					'child-fields' => array(
							'on'   => "{$prefix}_slider_rev,{$prefix}_slider_position,{$prefix}_slider_custom_bg"
						)
					),
					array(
						'label' => __( 'Revolution Slider', NOO_TEXT_DOMAIN ),
						'desc' => __( 'Select a Slider from Revolution Slider.', NOO_TEXT_DOMAIN ),
						'id'   => "{$prefix}_slider_rev",
						'type' => 'rev_slider',
						'std'  => ''
					),
					array(
						'label' => __('Slider Position', NOO_TEXT_DOMAIN) ,
						'id' => "{$prefix}_slider_position",
						'type' => 'radio',
						'std' => 'below',
						'options' => array(
							'above' => array(
								'label' => __('Above Header', NOO_TEXT_DOMAIN) ,
								'value' => 'above',
								) ,
							'below' => array(
								'label' => __('Below Header', NOO_TEXT_DOMAIN) ,
								'value' => 'below',
								) ,
							),
						'child-fields' => array(
							'above' => "{$prefix}_slider_above_scroll_bottom",
						),
					),
					array(
						'label' => __('Use custom background video?', NOO_TEXT_DOMAIN) ,
						'id' => "{$prefix}_slider_custom_bg",
						'type' => 'checkbox',
						'child-fields' => array(
							'on' => "{$prefix}_slider_bg_video,{$prefix}_slider_bg_video_poster"
							)
					),
					array(
						'label' => __( 'Background Video', NOO_TEXT_DOMAIN ),
						'desc' => __( 'Input the URL to your .mp4 video file.', NOO_TEXT_DOMAIN ),
						'id'   => "{$prefix}_slider_bg_video",
						'type' => 'text',
						'std'  => ''
					),
					array(
						'label' => __( 'Video Poster Image (on Mobile)', NOO_TEXT_DOMAIN ),
						'desc' => __( 'The poster image is used on Mobile where the background video is not available', NOO_TEXT_DOMAIN ),
						'id'   => "{$prefix}_slider_bg_video_poster",
						'type' => 'image',
						'std'  => ''
						),
					array(
						'label' => __( 'Show Scroll Bottom Button', NOO_TEXT_DOMAIN ),
						'desc' => __( 'Show the scroll bottom button on the slider.', NOO_TEXT_DOMAIN ),
						'id'   => "{$prefix}_slider_above_scroll_bottom",
						'type' => 'checkbox',
						'std'  => '',
						// 'child-fields' => array(
						// 		'on' => "{$prefix}_slider_above_scroll_bottom_position,{$prefix}_slider_above_scroll_bottom_color,{$prefix}_slider_above_scroll_bottom_hover_color"
						// 	)
						),
					// array(
					// 	'name'    => __( 'Scroll Bottom Button Position', NOO_TEXT_DOMAIN ),
					// 	'id'      => "{$prefix}_slider_above_scroll_bottom_position",
					// 	'type'    => 'select',
					// 	'std'     => 'top left',
					// 	'options' => array( 'top left', 'top center', 'top right', 'bottom left', 'bottom center', 'bottom right' )
					// 	),
					// array(
					// 	'name' => __( 'Scroll Bottom Button Color', NOO_TEXT_DOMAIN ),
					// 	'desc' => __( 'The color of the scroll bottom button.', NOO_TEXT_DOMAIN ),
					// 	'id'   => "{$prefix}_slider_above_scroll_bottom_color",
					// 	'type' => 'color',
					// 	'std'  => '#ffffff'
					// 	),
					// array(
					// 	'name' => __( 'Scroll Bottom Button Hover Color', NOO_TEXT_DOMAIN ),
					// 	'desc' => __( 'The hover color of the scroll bottom.', NOO_TEXT_DOMAIN ),
					// 	'id'   => "{$prefix}_slider_above_scroll_bottom_hover_color",
					// 	'type' => 'color',
					// 	'std'  => '#ffffff'
					// 	)
				)
			);

			$helper->add_meta_box($meta_box);
		}

		// Page Sidebar
		$meta_box = array(
			'id' => "{$prefix}_meta_box_sidebar",
			'title' => __('Sidebar', NOO_TEXT_DOMAIN),
			'context'      => 'side',
			'priority'     => 'default',
			'fields' => array(
				array(
					'label' => __('Page Sidebar', NOO_TEXT_DOMAIN) ,
					'id' => "{$prefix}_sidebar",
					'type' => 'sidebars',
					'std' => 'sidebar-main'
				) ,
			)
		);

		$helper->add_meta_box( $meta_box );
	}
endif;

add_action('add_meta_boxes', 'noo_page_meta_boxes');