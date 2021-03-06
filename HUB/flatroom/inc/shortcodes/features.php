<?php

function flatroom_features($attr) {

    $attributes = array(
        'post_type'      => 'features',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    );
  
    if (!empty($attr['count']) && is_numeric($attr['count'])) {
        $attributes['posts_per_page'] = $attr['count'];
    }
  
    if (!empty($attr['ids'])) {
        $array = array_map('trim', explode(',', $attr['ids']));
    
        $ids   = array_filter($array, function ($element) {
            return (!empty($element) && is_numeric($element));
        });
    
        if (!empty($ids)) {
            $attributes['post__in'] = $ids;
        }
    }
  
    return flatroom_get_template('features.php', array(
        'query'      => new WP_Query($attributes),
        'attributes' => $attr,
    ), false);
}
add_shortcode( 'features', 'flatroom_features' );