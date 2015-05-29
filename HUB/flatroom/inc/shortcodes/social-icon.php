<?php

function flatroom_social_box($attr, $content) {
    return '<ul class="chortcode-social">
        <li class="clearfix"></li>
        ' . do_shortcode($content) .
        '<li class="clearfix"></li>
    </ul>';
}
add_shortcode('social_box', 'flatroom_social_box');

function flatroom_social($attr) {
    extract(shortcode_atts(array(
        'href' => '#',
        'type_icon' => 'appstore',
        'target' => '_self'
    ), $attr));
    return '<li class="no-border"><a href="'. $href .'" target="'. $target .'"><i class="icon-' . $type_icon . '"></i></a></li>';
}
add_shortcode( 'social', 'flatroom_social' );