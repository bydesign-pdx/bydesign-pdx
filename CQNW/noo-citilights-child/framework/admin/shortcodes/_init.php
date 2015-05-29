<?php
/**
 * NOO Shortcodes packages
 *
 * Initialize Admin funciton for NOO Shortcodes
 * This file initialize a button on the WP editor that enable NOO Shortcodes input.
 *
 * @package    NOO Framework
 * @subpackage NOO Shortcodes
 * @version    1.0.0
 * @author     Kan Nguyen <khanhnq@nootheme.com>
 * @copyright  Copyright (c) 2014, NooTheme
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       http://nootheme.com
 */

// Add Admin Shortcode Button
add_action( 'init', 'noo_shortcodes_button_init' );

function noo_shortcodes_button_init() {
	if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) ) {
		return;
	}

	if ( get_user_option( 'rich_editing' ) == 'true' ) {
		add_filter( 'mce_external_plugins', 'noo_shortcodes_button' );
		add_filter( 'mce_buttons', 'noo_shortcodes_button_register' );
	}  
}

function noo_shortcodes_button( $plugin_array ) {
	if ( floatval( get_bloginfo( 'version' ) ) >= 3.9 ) {
		$tinymce_js = NOO_FRAMEWORK_ADMIN_URI .'/assets/js/noo_shortcodes.tinymce.js';
	} else {
		$tinymce_js = NOO_FRAMEWORK_ADMIN_URI .'/assets/js/noo_shortcodes.tinymce3.js';
	}
	$plugin_array['noo_shortcodes'] = $tinymce_js;
	return $plugin_array;
}

function noo_shortcodes_button_register ( $buttons ) {
	array_push( $buttons, 'noo_shortcodes_mce_button' );
	return $buttons;
}

/** 
 * Localize Data
 */
function noo_shorcodes_data() {
	$data = array(
			'url' => NOO_FRAMEWORK_ADMIN_URI . '/shortcodes',
			'contact_form_7' => ( class_exists( 'WPCF7_ContactForm' ) ? 'true' : 'false' ),
			'rev_slider' => ( class_exists( 'RevSlider' ) ? 'true' : 'false' ),
		);

	return $data;
}

/** 
 * Localize String
 */
function noo_shorcodes_language_string() {
	$string = array(
			'base_element' => __( 'Base Element', NOO_TEXT_DOMAIN),
			'row' => __( 'Row', NOO_TEXT_DOMAIN),
			'column' => __( 'Column', NOO_TEXT_DOMAIN),
			'animation' => __( 'Animation Block', NOO_TEXT_DOMAIN),
			'separator' => __( 'Separator', NOO_TEXT_DOMAIN),
			'gap' => __( 'Gap', NOO_TEXT_DOMAIN),
			'clear' => __( 'Clear', NOO_TEXT_DOMAIN),

			'typography' => __( 'Typography', NOO_TEXT_DOMAIN),
			'textblock' => __( 'Text Block', NOO_TEXT_DOMAIN),
			'button' => __( 'Button', NOO_TEXT_DOMAIN),
			'headline' => __( 'Headline', NOO_TEXT_DOMAIN),
			'dropcap' => __( 'Dropcap', NOO_TEXT_DOMAIN),
			'quote' => __( 'Quote', NOO_TEXT_DOMAIN),
			'icon' => __( 'Icon', NOO_TEXT_DOMAIN),
			'social_icon' => __( 'Social Icon', NOO_TEXT_DOMAIN),
			'icon_list' => __( 'Icon List', NOO_TEXT_DOMAIN),
			'icon_list_item' => __( 'Icon List Item', NOO_TEXT_DOMAIN),
			'label' => __( 'Label', NOO_TEXT_DOMAIN),
			'code_block' => __( 'Code Block', NOO_TEXT_DOMAIN),

			'content' => __( 'Content', NOO_TEXT_DOMAIN),
			'accordion' => __( 'Accordion', NOO_TEXT_DOMAIN),
			'tabs' => __( 'Tabs', NOO_TEXT_DOMAIN),
			'tour_section' => __( 'Tour Section', NOO_TEXT_DOMAIN),
			'block_grid' => __( 'Block Grid', NOO_TEXT_DOMAIN),
			'progress_bar' => __( 'Progress Bar', NOO_TEXT_DOMAIN),
			'pricing_table' => __( 'Pricing Table', NOO_TEXT_DOMAIN),
			'pricing_table_column' => __( 'Pricing Table Column', NOO_TEXT_DOMAIN),
			'pie' => __( 'Pie Chart', NOO_TEXT_DOMAIN),
			'cta_button' => __( 'Call to Action', NOO_TEXT_DOMAIN),
			'counter' => __( 'Counter', NOO_TEXT_DOMAIN),
			'message' => __( 'Message Box (Alert)', NOO_TEXT_DOMAIN),

			'citilights' => __( 'Citilights', NOO_TEXT_DOMAIN),
			'recent_properties' => __( 'Recent Properties', NOO_TEXT_DOMAIN),
			'single_property' => __( 'Single Property', NOO_TEXT_DOMAIN),
			'advanced_search_property' => __( 'Property Map & Search', NOO_TEXT_DOMAIN),
			'recent_agents' => __( 'Recent Agents', NOO_TEXT_DOMAIN),
			'membership_packages' => __( 'Membership Packages (pricing table)', NOO_TEXT_DOMAIN),
			'login_register' => __( 'Login/Register', NOO_TEXT_DOMAIN),
			'property_slider' => __( 'Property Slider', NOO_TEXT_DOMAIN),
			'property_slide' => __( 'Property Slide Item', NOO_TEXT_DOMAIN),

			'wordpress_content' => __( 'WordPress Content', NOO_TEXT_DOMAIN),
			'widget_area' => __( 'Widget Area', NOO_TEXT_DOMAIN),
			'blog' => __( 'Post List', NOO_TEXT_DOMAIN),
			'author' => __( 'Author', NOO_TEXT_DOMAIN),
			'team_member' => __( 'Team Member', NOO_TEXT_DOMAIN),
			'contact_form_7' => __( 'Contact Form 7', NOO_TEXT_DOMAIN),
			// 'gravity_form' => __( 'Gravity Form', NOO_TEXT_DOMAIN),
			'protected_content' => __( 'Protected Content', NOO_TEXT_DOMAIN),
			'search_field' => __( 'Search Field', NOO_TEXT_DOMAIN),

			'media' => __( 'Media', NOO_TEXT_DOMAIN),
			'image' => __( 'Image', NOO_TEXT_DOMAIN),
			'rev_slider' => __( 'Slider Revolution', NOO_TEXT_DOMAIN),
			'slider' => __( 'Responsive Slider', NOO_TEXT_DOMAIN),
			'slide' => __( 'Slide (Responsive Slider item)', NOO_TEXT_DOMAIN),
			'lightbox' => __( 'Lightbox', NOO_TEXT_DOMAIN),
			'video_player' => __( 'Video (self hosted)', NOO_TEXT_DOMAIN),
			'video_embed' => __( 'Video Embed', NOO_TEXT_DOMAIN),
			'audio_player' => __( 'Audio (Self Hosted)', NOO_TEXT_DOMAIN),
			'audio_embed' => __( 'Audio Embed', NOO_TEXT_DOMAIN),
			'google_map' => __( 'Google Map', NOO_TEXT_DOMAIN),
			'social_share' => __( 'Social Sharing', NOO_TEXT_DOMAIN),

			'custom' => __( 'Custom', NOO_TEXT_DOMAIN),
			'raw_html' => __( 'Raw HTML', NOO_TEXT_DOMAIN),
			'raw_js' => __( 'Raw Javascript', NOO_TEXT_DOMAIN),

			'title' => __( 'Title', NOO_TEXT_DOMAIN),
			'size' => __( 'Size (px)', NOO_TEXT_DOMAIN),
		);

	return $string;
}

// Enqueue style for shortcodes admin
if ( ! function_exists( 'noo_enqueue_shortcodes_admin_assets' ) ) :
	function noo_enqueue_shortcodes_admin_assets( $hook ) {

		if ( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' ) {
			return;
		}

		// Main style
		wp_register_style( 'noo-shortcodes-admin-css', NOO_FRAMEWORK_ADMIN_URI . '/assets/css/noo-shortcodes-admin.css', array( 'wp-color-picker', 'vendor-font-awesome-css', 'noo-icon-bootstrap-modal-css', 'noo-jquery-ui-slider' ));
		wp_enqueue_style( 'noo-shortcodes-admin-css' );

		// Main script
		wp_register_script( 'noo-shortcodes-admin-js', NOO_FRAMEWORK_ADMIN_URI . '/assets/js/noo-shortcodes-admin.js', array( 'jquery-ui-slider', 'wp-color-picker', 'noo-font-awesome-js' ), null, true );
		wp_localize_script( 'noo-shortcodes-admin-js', 'noo_shortcodes_data', noo_shorcodes_data() );
		wp_localize_script( 'noo-shortcodes-admin-js', 'noo_shortcodes_str', noo_shorcodes_language_string() );
		wp_enqueue_script( 'noo-shortcodes-admin-js' );
	}
	add_action( 'admin_enqueue_scripts', 'noo_enqueue_shortcodes_admin_assets' );
endif;


