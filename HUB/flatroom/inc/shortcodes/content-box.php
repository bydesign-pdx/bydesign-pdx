<?php

function flatroom_content_box($attributes, $content) {
	return flatroom_get_template('content-box.php', array(
		'attributes' => $attributes,
		'content'    => $content
	), false);
}
add_shortcode('content_box', 'flatroom_content_box');

function flatroom_information($attributes) {
	return flatroom_get_template('content-information.php', array(
		'attributes' => $attributes,
	), false);
}
add_shortcode('information', 'flatroom_information');