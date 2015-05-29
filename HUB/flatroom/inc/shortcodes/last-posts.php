<?php

function flatroom_posts($attr) {

    $attributes = array(
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 5
    );

    if (!empty($attr['count']) && is_numeric($attr['count'])) {
        $attributes['posts_per_page'] = $attr['count'];
    }
    
    if (!empty($attr['cat']) && is_numeric($attr['cat'])) {
        $attributes['cat'] = $attr['cat'];
    }
    
    if (!empty($attr['order'])) {
        $attributes['order'] = $attr['order'];
    }
    
    if (!empty($attr['orderby'])) {
        $attributes['orderby'] = $attr['orderby'];
    }

    return flatroom_get_template('last-posts.php', array(
        'query'      => new WP_Query($attributes),
        'attributes' => $attr,
    ), false);
}
add_shortcode('posts', 'flatroom_posts');