<?php
    $classes = array('separator');
    if (isset($attributes['type'])) {
        $classes[] = $attributes['type'];
    }
?>

<td class="<?php echo implode(' ', $classes); ?>">
	<div class="line"></div>
	<div class="arrow"></div>
</td>
