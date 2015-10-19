<?php global $data;

if (!is_singular('portfolio')) {

	if (is_page()) {

		$selected_title = rwmb_meta('moutheme_titlebar');
		$subtitle = rwmb_meta('moutheme_subtitle');
		$hero_title = rwmb_meta('moutheme_hero');

		if($selected_title == "title_subtitle") { ?>
			<div id="page-title">
				<hgroup><?php
					if($subtitle) { echo "<h2>" . $subtitle . "</h2>"; }
					the_title('<h1>', '</h1>'); ?>
				</hgroup>
			</div><?php
		} elseif ( $selected_title == "title_breadcrumbs" ) { ?>
			<div id="page-title">
				<hgroup><?php
					moutheme_breadcrumbs();
					the_title('<h1>', '</h1>'); ?>
				</hgroup>
			</div><?php
		} elseif ($selected_title == "hero_title") { ?>
			<div id="page-title" class="hero-title">
				<hgroup><h1><?php echo $hero_title; ?></h1></hgroup>
			</div><?php
		} 

	} else {

		if ($data["select_blogtitlebar"] == "Title + Subtitle") { ?>
			<div id="page-title">
				<hgroup>
					<?php if($data["text_blogsubtitle"]) { echo "<h2>" . $data["text_blogsubtitle"] . "</h2>"; } ?>
					<h1><?php echo $data["text_blogtitle"]; ?></h1>
				</hgroup>
			</div><?php
		} elseif ( $data["select_blogtitlebar"] == "Title + Breadcrumbs" ) { ?>
			<div id="page-title">
				<hgroup><?php
					if($data["check_blogbreadcrumbs"] == 0) {
						moutheme_breadcrumbs();
					} ?>
					<h1><?php echo $data["text_blogtitle"]; ?></h1>
				</hgroup>
			</div><?php
		}

	}

} else {

	if (get_post_meta( get_the_ID(), 'moutheme_titlebar', true ) == 'title_breadcrumbs') { ?>

		<div id="page-title">
			<hgroup><?php
				moutheme_breadcrumbs();
				the_title('<h1>', '</h1>'); ?>
			</hgroup>
		</div><?php

	} else {

		$subtitle = get_post_meta( get_the_ID(), "moutheme_subtitle", true ); ?>

		<div id="page-title">
			<hgroup>
				<?php if($subtitle) { echo "<h2>" . $subtitle . "</h2>"; } ?>
				<h1><?php the_title(); ?></h1>
			</hgroup>
		</div><?php
		
	} 

} ?>