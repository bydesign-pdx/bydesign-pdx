<?php

/******************************************************************************
    FAQ
*******************************************************************************/
function flatroom_faqs_type() {
    register_post_type( 'faqs',
        array(
            'labels' => array(
            'name' => ('FAQ'),
            'singular_name' => ('Single'),
            'add_new_item' => ('Add New Single'),
            'has_archive' => true,
            'add_new' => 'Add New',
            'edit_item' => 'Edit Single',
            'view_item' => 'View Single'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
              'title',
              'editor',
              'page-attributes',
            ),
        )
    );
}
add_action( 'init', 'flatroom_faqs_type' );

/******************************************************************************
    Features
*******************************************************************************/
function flatroom_features_type() {
    register_post_type( 'features',
        array(
            'labels' => array(
            'name' => ('Features'),
            'singular_name' => ('Single'),
            'add_new_item' => ('Add New Single'),
            'has_archive' => true,
            'add_new' => 'Add New',
            'edit_item' => 'Edit Single',
            'view_item' => 'View Single'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
              'title',
              'editor',
            ),
        )
    );
}
add_action( 'init', 'flatroom_features_type' );

/******************************************************************************
    Team
*******************************************************************************/
function flatroom_team_type() {
    register_post_type( 'team',
        array(
            'labels' => array(
            'name' => ('Team'),
            'singular_name' => ('Worker'),
            'add_new_item' => ('Add New Worker'),
            'has_archive' => true,
            'add_new' => 'Add New',
            'edit_item' => 'Edit Worker',
            'view_item' => 'View Worker'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
              'title',
              'editor',
              'thumbnail'
            ),
        )
    );
}
add_action( 'init', 'flatroom_team_type' );

/******************************************************************************
    Pricing
*******************************************************************************/
function flatroom_pricing_type() {
    register_post_type( 'pricing',
        array(
            'labels' => array(
            'name' => ('Pricing'),
            'singular_name' => ('Pricing'),
            'add_new_item' => ('Add New Single'),
            'has_archive' => true,
            'add_new' => 'Add Pricing',
            'edit_item' => 'Edit Pricing',
            'view_item' => 'View Pricing'
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array(
              'title',
              'editor',
            ),
        )
    );
    register_taxonomy (
        'pricing_cat',
        'pricing',
        array(
            'labels' => array(
                'name' => __('Pricing Type', 'flatroom'),
                'add_new_item' => __('Add new pricing type', 'flatroom'),
                'new_item_name' => __('New pricing type', 'flatroom'),
            ),
            'show_ui' => true,
            'show_tagcloud' => false,
            'hierarchical' => true
        )
    );
}
add_action( 'init', 'flatroom_pricing_type' );

/******************************************************************************
    Properties
*******************************************************************************/
if ( ! function_exists( 'query_post_type' ) ) :
add_filter('pre_get_posts', 'query_post_type');
function query_post_type($query) {
    $post_types = get_post_types();
    if ( is_tag()) {
        $post_type = get_query_var('faqs', 'features', 'pricing', 'team');
        if ( $post_type )
            $post_type = $post_type;
        else
            $post_type = $post_types;
        $query->set('post_type', $post_type);
    return $query;
    }
}
endif;