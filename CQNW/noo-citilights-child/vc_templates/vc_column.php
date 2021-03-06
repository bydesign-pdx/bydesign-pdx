
<?php

extract( shortcode_atts( array(
	'visibility'            => 'all',
	'class'                 => '',
	'id'                    => '',
	'custom_style'          => '',
	'width'                 => '',
	'alignment'        		=> '',
	'animation'        		=> '',
	'animation_offset'   	=> '',
	'animation_duration'    => '1000',
	'animation_delay'		=>'0'
	), $atts ) );

$id           = ( $id         != '' ) ? 'id="' . esc_attr( $id ) . '"' : '';
$class        = ( $class      != '' ) ? 'noo-vc-col ' . esc_attr( $class ) : 'noo-vc-col';
$class       .= ( $alignment  != '' ) ? ' text-' . $alignment : '';
$visibility   = ( $visibility != '' ) && ( $visibility != 'all' ) ? esc_attr( $visibility ) : '';
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

switch ( $width ) {
	case '1/1' :
		$width = ' col-md-12';
		break;
	case '1/2' :
		$width = ' col-md-6 col-sm-12';
		break;
	case '1/3' :
		$width = ' col-md-4 col-sm-6';
		break;
	case '2/3' :
		$width = ' col-md-8 col-sm-12';
		break;
	case '1/4' :
		$width = ' col-md-3 col-sm-6';
		break;
	case '3/4' :
		$width = ' col-md-9 col-sm-12';
		break;
	case '1/6' :
		$width = ' col-md-2 col-sm-6';
		break;
	case '5/6' :
		$width = ' col-md-10 col-sm-12';
		break;
	default:
		$width = ' col-md-12';
}

$html = "";

if(!empty($animation)){
	$html .="<div class=\"animatedParent\" data-appear-top-offset=\"$animation_offset\">";
	$custom_style = ";-webkit-animation-duration:".$animation_duration."ms;animation-duration:".$animation_duration."ms; -webkit-animation-delay:".$animation_delay."ms;animation-delay:".$animation_delay."ms; ";
}
$custom_style = ( $custom_style != '' ) ? ' style="' . esc_attr($custom_style).'"' : '';

$html .= "<div {$id} class=\"{$class}{$width} ".(!empty($animation) ? 'animated '.$animation : '')."\" {$custom_style}>" . do_shortcode( $content ) . "</div>";
if(!empty($animation))
	$html .="</div>";

echo $html;

?>