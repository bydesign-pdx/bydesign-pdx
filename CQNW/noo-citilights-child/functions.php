<?php

add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(), array( 'parent-style' ) );
}

/*
add_filter('wp_nav_menu_items','add_contact_details', 10, 2);
function add_contact_details( $items, $args ) {
    if( $args->theme_location == 'primary' )
        return $items."<div id='navContact'><i class='fa fa-mobile'></i><div id='callUsContainer'><div id='callUs'>CALL US NOW</div><div id='callUsNumber'><a href='tel:0015034524000'>(503) 452 4000</a></div></div></div>";

    return $items;
}

*/

?>