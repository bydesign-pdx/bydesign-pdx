<?php

function flatroom_chart($attributes) {
	return flatroom_get_template('chart.php', array(
		'attributes' => $attributes,
	), false);
}
add_shortcode('chart', 'flatroom_chart');