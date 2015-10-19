<?php
function nine_js_custom() {

	global $smof_data; ?>

	<script type="text/javascript"><?php
	if(isset($smof_data['slider_speed']) && isset($smof_data['slider_effect_speed'])) { ?>
		slider_speed = <?php echo($smof_data['slider_speed'] * 1000); ?>;
		slider_effect_speed = <?php echo $smof_data['slider_effect_speed']; ?>;<?php
	} ?>
	</script><?php

}
add_action( 'wp_head', 'nine_js_custom', 100 );