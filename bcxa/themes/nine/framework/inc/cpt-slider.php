<?php

add_action('init', 'types_taxonomies_init', 10);
function types_taxonomies_init() {

	/* Slide Post Type */
	register_post_type(
		'slide',
		array(
			'label' => 'Slides',
			'labels' => array(
				'name' => 'Slides',
				'all_items' => 'All Slides',
				'singular_name' => 'Slide',
				'add_new' => 'Add New',
				'add_new_item' => 'Add New Slide'
			),
			'public' => true,
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'show_ui' => true,
			'show_in_nav_menus' => false,
			'show_in_menu' => true,
			'show_in_admin_bar' => true,
			'menu_position' => 5,
			'menu_icon' => '',
			'supports' => array(
				'title',
				'thumbnail'
			),
			'register_meta_box_cb' => '',
			'taxonomies' => array('slider'),
			'has_archive' => false
		)
	);

	/* Slider Taxonomy */
	register_taxonomy(
		'slider',
		'slide',
		array(
			'hierarchical' => true,
			'label' => 'Sliders',
			'query_var' => true,
			'rewrite' => false,
			'show_in_nav_menus' => false,
			'labels' => array(
				'name' => 'Sliders',
				'singular_name' => 'Slider',
				'all_items' => 'All Sliders',
				'popular_items' => 'Popular Sliders',
				'edit_item' => 'Edit Slider',
				'update_item' => 'Update Slider',
				'add_new_item' => 'Add New Slider'
			),
			'show_tagcloud' => false
		)
	);

} ?>