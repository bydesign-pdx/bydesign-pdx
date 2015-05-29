<?php

function flatroom_link_offers($attributes, $content) {
	return flatroom_get_template('link-offset.php', array(
		'attributes' => $attributes,
		'content'    => $content
	), false);
}
add_shortcode('link_offers', 'flatroom_link_offers');

function flatroom_one_link($attributes) {
	return flatroom_get_template('one-link.php', array(
		'attributes' => $attributes
	), false);
}
add_shortcode('one_link', 'flatroom_one_link');

function flatroom_separator($attributes) {
	return flatroom_get_template('link-separator.php', array(
		'attributes' => $attributes
	), false);
}
add_shortcode('separator', 'flatroom_separator');