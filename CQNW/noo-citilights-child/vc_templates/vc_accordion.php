<?php
extract(shortcode_atts(array(
    'visibility'      => 'all',
    'class'           => '',
    'id'              => '',
    'custom_style'    => '',
    'title'           => '',
    'active_tab'      => '',
    'icon_style'      => '',
), $atts));

$visibility       = ( $visibility      != ''     ) && ( $visibility != 'all' ) ? esc_attr( $visibility ) : '';
$class            = ( $class           != ''     ) ? 'noo-vc-accordion panel-group ' . esc_attr( $class ) : 'noo-vc-accordion panel-group ';
if($icon_style != '') {
    $class .= " icon-{$icon_style}";
}
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

$custom_style     = ( $custom_style    != ''     ) ? ' ' . $custom_style : '';

$id   = ( $id != '' ) ? esc_attr( $id ) : 'noo-accordion-' . noo_vc_elements_id_increment();
$active_tab = ( $active_tab != '' && ( intval($active_tab, 10) > 0 ) ) ? intval($active_tab) - 1 : 0;
$html = array();

$html[] = "<div id=\"{$id}\" data-active-tab=\"{$active_tab}\" class=\"{$class}\" {$custom_style}>";
$html[] = "  ".noo_handler_shortcode_content( $content, true );
$html[] = "</div>";
$html[] = "<script>";
$html[] = "jQuery('document').ready(function ($) {";
$html[] = "  $('#{$id} .panel-title a').attr('data-parent', '#{$id}');";
$html[] = "  $('#{$id} .noo-accordion-tab:eq({$active_tab})').addClass('in');";
$html[] = "  $('#{$id}').on('show.bs.collapse', function (e) {
               $(e.target).prev('.panel-heading').addClass('active');
            });";
$html[] = "  $('#{$id}').on('hide.bs.collapse', function (e) {
               $(e.target).prev('.panel-heading').removeClass('active');
            });";
$html[] = "  $('#{$id} .in').prev('.panel-heading').addClass('active');";  
$html[] = "});";
$html[] = "</script>";

echo implode( "\n", $html );