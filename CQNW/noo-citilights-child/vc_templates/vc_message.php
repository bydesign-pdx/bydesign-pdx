<?php
extract(shortcode_atts(array(
    'visibility'      => 'all',
    'class'           => '',
    'id'              => '',
    'custom_style'    => '',
    'heading'         => '',
    'type'            => 'info',
    'dismissible'     => ''
), $atts));

$class            = ( $class         != ''    ) ? 'noo-message alert ' . esc_attr( $class ) : 'noo-message alert';
$class           .= " alert-{$type}";
$class           .= ( $dismissible   == 'true') ? ' alert-dimissible' : '';
$visibility       = ( $visibility    != ''    ) && ( $visibility != 'all' ) ? esc_attr( $visibility ) : '';
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

$id           = ( $id != '' ) ? 'id="' . esc_attr( $id ) . '"' : '';
$class        = ( $class != '' ) ? 'class="' . $class . '"' : '';
$custom_style = ( $custom_style    != ''     ) ? ' style="' . $custom_style . '"' : '';

$html   = array();
$html[] = "<div {$id} {$class} {$custom_style} role=\"alert\">";
if( $dismissible == 'true' ) {
	$html[] = '<button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">' . __( 'Close', NOO_TEXT_DOMAIN ) . '</span></button>';
}
if( $heading != '' ) {
	$html[] = '  <h4>' . esc_attr( $heading ) . '</h4>';
}

$html[] = noo_handler_shortcode_content( $content, true );
$html[] = "</div>";

echo implode( "\n", $html );
