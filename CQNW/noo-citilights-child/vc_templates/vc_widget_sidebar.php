<?php
extract(shortcode_atts(array(
    'visibility'      => 'all',
    'class'           => '',
    'id'              => '',
    'custom_style'    => '',
    'title'           => '',
    'sidebar_id'      => ''
), $atts));

if ( $sidebar_id == '' )
	return '';

$class         = ( $class != '' ) ? 'noo-widget-area-wrapper ' . esc_attr( $class ) : 'noo-widget-area-wrapper';
$visibility    = ( $visibility != '' ) && ( $visibility != 'all' ) ? esc_attr( $visibility ) : '';
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

$id            = ( $id != '' ) ? 'id="' . esc_attr( $id ) . '"' : '';
$class         = ( $class != '' ) ? 'class="' . esc_attr( $class ) . '"' : '';
$custom_style  = ($custom_style != '' ) ? 'style="' . esc_attr( $custom_style ) . '"' : '';

ob_start();
dynamic_sidebar($sidebar_id);
$sidebar_value = ob_get_contents();
ob_end_clean();

$sidebar_value = trim($sidebar_value);
$sidebar_value = (substr($sidebar_value, 0, 3) == '<li' ) ? '<ul>'.$sidebar_value.'</ul>' : $sidebar_value;

$html    = array();
$html[] .= "<div {$id} {$class} {$custom_style} >";
$html[] .= '  <div class="noo-widget-area">';
if(!empty($title))
	$html[] .= '    <h3 class="noo-widget-area-title">' . esc_attr( $title ) . '</h3>';
$html[] .= $sidebar_value;
$html[] .= '  </div>';
$html[] .= '</div>';

echo implode( "\n", $html );