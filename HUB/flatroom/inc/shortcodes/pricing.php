<?php

function flatroom_pricing($attr) {

    $attributes = array(
        'post_type'      => 'pricing',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );
  
    if (!empty($attr['count']) && is_numeric($attr['count'])) {
        $attributes['posts_per_page'] = $attr['count'];
    }
  
    if (!empty($attr['type'])) {
        $attributes['pricing_cat'] = $attr['type'];
    }
  
    return flatroom_get_template('pricing.php', array(
        'query'      => new WP_Query($attributes),
        'attributes' => $attr,
    ), false);
}
add_shortcode( 'pricing', 'flatroom_pricing' );