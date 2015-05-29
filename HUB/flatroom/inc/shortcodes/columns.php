<?php

/* Row Shortcode */
function flatroom_row($atts, $content) {
    return '<div class="row-fluid">' . do_shortcode($content) . '</div>';
}
add_shortcode('row', 'flatroom_row');

/* 1 Column Shortcode */
function flatroom_col1($atts, $content) {
    return '<div class="span12"><p>' . $content . '</p></div>';
}
add_shortcode('col1', 'flatroom_col1');

/* 2 Column Shortcode */
function flatroom_col2($atts, $content) {
    return '<div class="span6"><p>' . $content . '</p></div>';
}
add_shortcode('col2', 'flatroom_col2');

/* 3 Column Shortcode */
function flatroom_col3($atts, $content) {
    return '<div class="span4"><p>' . $content . '</p></div>';
}
add_shortcode('col3', 'flatroom_col3');

/* 4 Column Shortcode */
function flatroom_col4($atts, $content) {
    return '<div class="span3"><p>' . $content . '</p></div>';
}
add_shortcode('col4', 'flatroom_col4');