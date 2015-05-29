<?php

function flatroom_banner($attributes) {
    return flatroom_get_template('banner.php', array('attributes' => $attributes), false);
}
add_shortcode('banner', 'flatroom_banner');