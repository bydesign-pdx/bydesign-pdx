<?php
extract(shortcode_atts(array(
    'visibility'      => 'all',
    'class'           => '',
    'id'              => '',
    'custom_style'    => '',
), $atts));

$visibility       = ( $visibility      != ''     ) && ( $visibility != 'all' ) ? esc_attr( $visibility ) : '';
$class            = ( $class           != ''     ) ? "noo-text-block " . esc_attr( $class ) : 'noo-text-block';
switch ($visibility) {
    case 'hidden-phone':
        $class .= ' hidden-xs';
        break;
    case 'hidden-tablet':
        $class .= ' hidden-sm hidden-md';
        break;
    case 'hidden-pc':
        $class .= ' hidden-lg';
        break;
    case 'visible-phone':
        $class .= ' visible-xs-block visible-xs-inline visible-xs-inline-block';
        break;
    case 'visible-tablet':
        $class .= ' visible-sm-block visible-sm-inline visible-sm-inline-block visible-md-block visible-md-inline visible-md-inline-block';
        break;
    case 'visible-phone':
        $class .= ' visible-lg-block visible-lg-inline visible-lg-inline-block';
        break;
}

$class = ( $class != '' ) ? ' class="' . $class . '"' : '';
$custom_style = ( $custom_style != '' ) ? ' style="' . $custom_style . '"' : '';

$html = array();
$html[] = "<div {$id} {$class} {$custom_style}>";
$html[] = noo_handler_shortcode_content( $content, true );
$html[] = '</div>';

echo implode( "\n", $html );