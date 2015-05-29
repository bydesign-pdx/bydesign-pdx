<?php

add_shortcode('link_offers', 'link_offers_shortcode');
function link_offers_shortcode($attributes, $content) {
    return '<div class="shortcode link-offers-shortcode">
        <div class="link-offers-content">
            <table>
                <tr>
                    ' . do_shortcode($content) . '
                </tr>
            </table>
        </div>
    </div>';
}

add_shortcode('one_link', 'itembridge_one_link');
function itembridge_one_link($attributes) {
    $title    = $attributes['title'];
    $count    = $attributes['count'];
    $link     = $attributes['link'];
    $link_url = $attributes['link_url'];
    $align    = $attributes['align'];
    $size     = $attributes['size'];
    
    if (isset($attributes['size']) && ($attributes['size'] == 'big')) {
        $size_class = "big";
    }
    if (isset($attributes['align']) && ($attributes['align'] == 'left')) {
        $class = "left";
    }
    $output = '
    <td class="'. $class .''. $size_class .'">
        <a href="'. $link_url .'">
            <div class="title">'. $title .'</div>
            <div class="count">'. $count .'</div>
            <div class="go-to">'. $link .' <span>&#8250;</span></div>
        </a>
    </td>
    ';
    return $output;
}

add_shortcode('separator', 'itembridge_separator');
function itembridge_separator($attributes) {
    $type    = $attributes['type'];
    
    if (isset($attributes['type']) && ($attributes['type'] == 'right')) {
        $class = "right";
    }

    $output = '
    <td class="separator '. $class .'">
		<div class="line"></div>
		<div class="arrow"></div>
	</td>
    ';
    return $output;
}