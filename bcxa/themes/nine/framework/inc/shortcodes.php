<?php

/* Remove extra P tags
-------------------------------------------------------------------------------------------------------------------*/

function shortcodes_formatter($content) {
	$block = join("|", array(
		"accordion",
   		"tabs",
   		"alert",
   		"custom_button",
   		"infobox",
   		"imagebox",
   		"iconbox",
   		"testimonial",
   		"pricing_table",
   		"calltoaction",
   		"tooltip",
   		"progressbar",
   		"styled_list",
   		"gap",
   		"divider",
   		"clearfix",
   		"one_fourth",
   		"one_third",
   		"one_second",
   		"two_third",
   		"three_fourth",
   		"video",
   		"staff",
   		"maps",
   		"dropcap",
   		"icon",
   		"client",
   		"clients",
   		"blog_v1",
   		"blog_v2",
   		"portfolio_v1",
   		"portfolio_v2"
   	)	);

	// opening tag
	$rep = preg_replace("/(<p>)?\[($block)(\s[^\]]+)?\](<\/p>|<br \/>)?/","[$2$3]",$content);

	// closing tag
	$rep = preg_replace("/(<p>)?\[\/($block)](<\/p>|<br \/>)/","[/$2]",$rep);

	return $rep;
}

add_filter('the_content', 'shortcodes_formatter');
add_filter('widget_text', 'shortcodes_formatter');


/* Accordion
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_accordion($atts, $content=null, $code) {

	extract(shortcode_atts(array(
		'open' => '1'
	), $atts));

	if (!preg_match_all("/(.?)\[(accordion-item)\b(.*?)(?:(\/))?\](?:(.+?)\[\/accordion-item\])?(.?)/s", $content, $matches)) {
		return do_shortcode($content);
	} else {
		$output = '';
		for($i = 0; $i < count($matches[0]); $i++) {
			$matches[3][$i] = shortcode_parse_atts($matches[3][$i]);
						
			$output .= '<div class="accordion-group"><h3 class="accordion-title"><span></span>' . $matches[3][$i]['title'] . '</h3><div class="accordion-content">' . do_shortcode(trim($matches[5][$i])) .'</div></div>';
		}
		return '<div class="accordion" rel="' . $open . '">' . $output . '</div>';
	}
	
}


/* Tabs
-------------------------------------------------------------------------------------------------------------------*/

global $randomid;

function shortcode_tabs( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));

	global $randomid;

	$randomid = rand();
    
    $out = '';
	
	$out .= '<ul class="nav nav-tabs">';
	foreach ($atts as $key => $tab) {
		if($key == 'tab1') {
			$out .= '<li class="active"><a href="#' . $randomid . $key . '" data-toggle="tab">' . $tab . '</a></li>';
		} else {
			$out .= '<li><a href="#' . $randomid . $key . '" data-toggle="tab">' . $tab . '</a></li>';
		}
	}
	$out .= '</ul>';
	
	$out .= '<div class="tab-content">';

	$out .= do_shortcode($content) .'</div>';
	
	return $out;
}

function shortcode_tab( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));

    global $randomid;
    
	$out = '';
	if($atts['id'] == 1) {
		$out .= '<div id="'. $randomid . 'tab' . $atts['id'] . '" class="tab-pane active">' . do_shortcode($content) .'</div>';
	} else {
		$out .= '<div id="'. $randomid . 'tab' . $atts['id'] . '" class="tab-pane">' . do_shortcode($content) .'</div>';
	}
	
	return $out;
}


/* Pricing Table
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_pricing_table( $atts, $content = null ) {
	extract( shortcode_atts( array(
    'title' => '',
    'price' => '',
    'price_cents' => '',
    'price_desc' => '',
    'button_text' => '',
    'button_url' => ''
    ), $atts ) );

    $out = '';
	
	$out .= '<div class="sc_pricing"><h2>' . $title . '</h2><div class="price"><big>' . $price . '</big><span class="price-details"><em>' . $price_cents . '</em>' . $price_desc . '</span></div><ul>';

	$out .= do_shortcode($content);

	if($button_text != '') {
		$out .= '</ul><div class="btn-container"><a href="' . $button_url . '" class="btn btn-color">' . $button_text . '</a></div></div>';
	} else {
		$out .= '</ul></div>';
	}
	
	return $out;
}

function shortcode_item( $atts, $content = null ) {
	extract(shortcode_atts(array(
    ), $atts));
    
	$out = '';
	$out .= '<li>' . do_shortcode($content) .'</li>';
	
	return $out;
}


/* Alert
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_alert( $atts, $content = null) {

	extract( shortcode_atts( array(
		'type'  => 'warning',
		'close'	=> ''
	), $atts ) );

	$close_button = '';

	// Close button      
	if($close == 'true') $close_button = '<button class="close">&times;</button>';
      
    return '<div class="alert alert-' . $type . '">' . do_shortcode($content) . $close_button . '</div>';
}


/* Button
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_buttonlink( $atts, $content = null ) {
    extract(shortcode_atts(array(
        'link' => '#',
        'color' => 'color',
        'size' => 'medium'
    ), $atts));

	$out = '<a href="' . $link . '" class="btn btn-'. $color . ' btn-'. $size . '">' . do_shortcode($content). '</a>';
    return $out;
}


/* Info Box
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_infobox( $atts, $content = null) {
	extract( shortcode_atts( array(
    'image' => '',
    'icon_class' => '',
    'title' => '',
    'button_text' => '',
    'button_url' => ''
    ), $atts ) );
	
	$visual = $button = $heading = '';

	// Image
	if($image != '') {
		if( $button_url != '' ) {
			$visual = '<a href="' . $button_url . '" class="icon"><img src="' . $image . '" alt=""></a>';
		} else {
			$visual = '<p class="icon"><img src="' . $image . '" alt=""></p>';			
		}
	} elseif ($icon_class != '') {
		if( $button_url != '' ) {
			$visual = '<a href="' . $button_url . '" class="icon hover-true"><i class="icon-' . $icon_class . '"></i></a>';
		} else {
			$visual = '<p class="icon hover-true"><i class="icon-' . $icon_class . '"></i></p>';
		}
	} else {
		$visual = '';
	}
	
	// Title
	if($title != '') $heading = '<h2 class="title">' . $title . '</h2><hr>';

	// Button
	if($button_text != '' && $button_url != '') $button = '<p class="button"><a class="btn btn-small" href="' . $button_url . '">' . $button_text . '</a></p>';

    return '<div class="sc_infobox">' . $visual . $heading . '<p class="content">' . do_shortcode($content) . '</p>' . $button . '</div>';
}


/* Image Box
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_imagebox( $atts, $content = null) {
	extract( shortcode_atts( array(
    'image' => '',
    'title' => '',
    'button_text' => '',
    'button_url' => ''
    ), $atts ) );
	
	$visual = $button = $heading = '';

	// Image
	if($image != '') {
		if( $button_url != '' ) {
			$visual = '<a href="' . $button_url . '" class="image"><img src="' . $image . '" alt=""></a>';
		} else {
			$visual = '<p class="image"><img src="' . $image . '" alt=""></p>';
		}
	} else {
		$visual = '';
	}
	
	// Title
	if($title != '') $heading = '<h2 class="title">' . $title . '</h2>';

	// Button
	if($button_text != '' && $button_url != '') $button = '<p class="button"><a class="btn btn-small" href="' . $button_url . '">' . $button_text . '</a></p>';

    return '<div class="sc_imagebox">' . $visual . $heading . '<p class="content">' . do_shortcode($content) . '</p>' . $button . '</div>';
}

/* Icon Box
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_iconbox( $atts, $content = null) {
	extract( shortcode_atts( array(
    'image' => '',
    'icon_class' => '',
    'title' => '',
    'button_text' => '',
    'button_url' => ''
    ), $atts ) );
	
	$visual = $button = $heading = '';

	// Image
	if($image != '') {
		if( $button_url != '' ) {
			$visual = '<a href="' . $button_url . '" class="icon"><img src="' . $image . '" alt=""></a>';
		} else {
			$visual = '<p class="icon"><img src="' . $image . '" alt=""></p>';
		}
	} elseif ($icon_class != '') {
		if( $button_url != '' ) {
			$visual = '<a href="' . $button_url . '" class="icon"><i class="icon-' . $icon_class . '"></i></a>';
		} else {
			$visual = '<p class="icon"><i class="icon-' . $icon_class . '"></i></p>';
		}
	} else {
		$visual = '';
	}
	
	// Title
	if($title != '') $heading = '<h2 class="title">' . $title . '</h2>';

	// Button
	if($button_text != '' && $button_url != '') $button = '<p class="button"><a class="btn btn-small btn-color" href="' . $button_url . '">' . $button_text . '</a></p>';

    return '<div class="sc_iconbox">' . $visual . '<div class="body">' . $heading . '<p class="content">' . do_shortcode($content) . '</p>' . $button . '</div></div>';
}


/* Testimonial
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_testimonial($atts, $content = null) {
	extract( shortcode_atts( array(
    'author' => ''
    ), $atts ) );

    return '<div class="sc_testimonial"><blockquote>' . do_shortcode($content) . '</blockquote><div class="corner"></div><div class="author">' . $author . '</div></div>';
}


/* Call to Action
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_calltoaction($atts, $content = null) {
	extract( shortcode_atts( array(
    'button_text' => '',
    'button_link' => '',
    'full_width'  => ''
    ), $atts ) );

	$link = $html = $style = '';

	if( $button_text != '' && $button_link != '' )
		$link = '<div class="pull-right"><a href="' . $button_link . '" class="btn btn-color">' . $button_text . '</a></div>';

	if( $full_width == 'yes' ) {
		$style = ' full';
	}

	$html = '<div class="sc_call-to-action' . $style . '"><h2>' . do_shortcode($content) . '</h2>' . $link . '</div>';
	return $html;
}


/* Tooltip
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_tooltip($atts, $content = null) {
	extract( shortcode_atts( array(
    'text' => ''
    ), $atts ) );

    $html = '';

	$html = '<span data-original-title="' . $text . '" rel="tooltip" data-placement="top">' . do_shortcode($content) . '</span>';
	return $html;
}


/* Progressbar
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_progressbar($atts, $content = null) {
	extract( shortcode_atts( array(
    'percentage' => ''
    ), $atts ) );

    $html = '';

	$html = '<div class="progress-bar"><p>' . do_shortcode($content) . '</p><div class="progress progress-striped active"><div style="width: ' . $percentage . '%;" class="bar"></div></div></div>';
	return $html;
}


/* Divider
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_divider() {
    return '<hr>';
}


/* Clients
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_clients($atts, $content = null) {
	extract( shortcode_atts( array(
    'columns' => ''
    ), $atts ) );
	$html = '<div class="sc_clients"><div class="clients-carousel"><ul>';
	$html .= do_shortcode($content);
	$html .= '</ul></div></div>';
	return $html;
}
/* Client Item
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_client($atts, $content = null) {
	extract( shortcode_atts( array(
    'link' => '',
    'image' => ''
    ), $atts ) );
	$html = '<li><span>';
	$html .= '<a href="' . $link . '"><img src="' . $image . '" alt=""></a>';
	$html .= '</span></li>';
	return $html;
}


/* Gap
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_gap( $atts, $content = null) {

	extract(shortcode_atts(array('height' => '10'), $atts));
      
    if($height == '') {
    	$return = '';
    } else {
		$return = 'style="height: ' . $height . 'px;"';
	}
      
    return '<div class="gap" ' . $return . '></div>';
}


/* Icon
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_icon( $atts, $content = null) {

	extract(shortcode_atts(array('name' => ''), $atts));
      
    return '<i class="icon-' . $name . '"></i>';
}


/* Dropcap
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_dropcap( $atts, $content = null) {

	extract(shortcode_atts(array('style' => 'default'), $atts));
      
    if($style == 'default') {
    	$class = 'dropcap';
    } else {
    	$class = 'dropcap-color';
	}
      
    return '<div class="' . $class . '">' . do_shortcode($content) . '</div>';
}


/* Clear
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_clearfix() {  
    return '<div class="clearfix"></div>';  
}


/* Columns
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_one_fourth( $atts, $content = null ) {
extract( shortcode_atts( array(
    'last' => ''
    ), $atts ) );

	$class = $clear = '';

	if($last == 'yes') {
		$class = ' last';
		$clear = '<div class="clearfix"></div>';
	}

	return '<div class="one-fourth' . $class . '">' . do_shortcode($content) . '</div>' . $clear;
}

function shortcode_one_third( $atts, $content = null ) {
extract( shortcode_atts( array(
    'last' => ''
    ), $atts ) );

	$class = $clear = '';

	if($last == 'yes') {
		$class = ' last';
		$clear = '<div class="clearfix"></div>';
	}

	return '<div class="one-third' . $class . '">' . do_shortcode($content) . '</div>' . $clear;
}

function shortcode_one_second( $atts, $content = null ) {
extract( shortcode_atts( array(
    'last' => ''
    ), $atts ) );

	$class = $clear = '';

	if($last == 'yes') {
		$class = ' last';
		$clear = '<div class="clearfix"></div>';
	}

	return '<div class="one-second' . $class . '">' . do_shortcode($content) . '</div>' . $clear;
}

function shortcode_two_third( $atts, $content = null ) {
extract( shortcode_atts( array(
    'last' => ''
    ), $atts ) );

	$class = $clear = '';

	if($last == 'yes') {
		$class = ' last';
		$clear = '<div class="clearfix"></div>';
	}

	return '<div class="two-third' . $class . '">' . do_shortcode($content) . '</div>' . $clear;
}

function shortcode_three_fourth( $atts, $content = null ) {
extract( shortcode_atts( array(
    'last' => ''
    ), $atts ) );

	$class = $clear = '';

	if($last == 'yes') {
		$class = ' last';
		$clear = '<div class="clearfix"></div>';
	}

	return '<div class="three-fourth' . $class . '">' . do_shortcode($content) . '</div>' . $clear;
}


/* Video
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_video($atts) {
	extract(shortcode_atts(array(
		'type' 	    => '',
		'id' 	    => '',
		'autoplay' 	=> ''
	), $atts));
	
	$autoplay = ($autoplay == 'yes' ? '1' : false);
		
	if($type == "vimeo") $return = '<div class="video-embed"><iframe src="http://player.vimeo.com/video/' . $id . '?autoplay=' . $autoplay . '&amp;title=0&amp;byline=0&amp;portrait=0" width="560" height="315" class="iframe"></iframe></div>';
	
	else if($type == "youtube") $return = '<div class="video-embed"><iframe src="http://www.youtube.com/embed/' . $id . '?HD=1;rel=0;showinfo=0" width="560" height="315" class="iframe"></iframe></div>';
		
	if (!empty($id)){
		return $return;
	}
}


/* Lists
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_styled_list( $atts, $content = null) {
	extract( shortcode_atts( array(
		'marker' => ''
	), $atts ) );

	return '<div class="' . $marker . '-list">' . do_shortcode($content) . '</div>';
}


/* Blog Posts v1
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_blog_v1($atts, $content = null){
	extract(shortcode_atts(array(
		'title'      => 'From The Blog',
       	'posts'      => '6',
       	'categories' => 'all',
       	'columns'    => '4',
       	'layout'     => '1'
    ), $atts));
    
    global $post;
    global $data;

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $posts,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
    );
    
    if($categories != 'all'){
    	
    	// string to array
    	$str = $categories;
    	$arr = explode(',', $str);
    	
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'category',
			'field' 	=> 'slug',
			'terms' 	=> $arr
		);
	}

    query_posts($args);

	if( $title != '' ) {
		$heading = '<h2 class="title">' . $title . '</h2>';
	} else {
		$heading = '';		
	}

	if( $columns == '3' ) {
		$class_1 = 'one-third';
		$class_2 = 'two-third';
		$thumb_size = 'portfolio-four';
	} else {
		$class_1 = 'one-fourth';		
		$class_2 = 'three-fourth';
		$thumb_size = 'portfolio-three';
	}	

	if( $content != '' ) {
	    $out = '<div class="sc_posts"><div class="' . $class_1 . '">' . $heading . '<p>' . do_shortcode($content) . '</p><nav class="direct-buttons"><a href="#" class="next"></a><a href="#" class="prev"></a></nav></div><div class="' . $class_2 . ' last"><div class="recent-posts"><ul>';
	} else {
	    $out = '<div class="sc_posts"><div class="' . $class_1 . '">' . $heading . '<nav class="direct-buttons"><a href="#" class="next"></a><a href="#" class="prev"></a></nav></div><div class="' . $class_2 . ' last"><div class="recent-posts"><ul>';
	}

	if( have_posts() ) : 

		$post_counter = 0;

		while ( have_posts() ) : the_post();

			$post_counter++;

			$thumbnail = '';

			if ( false === get_post_format() ) {
				$type = '<img src="' . get_template_directory_uri() . '/framework/img/format-standard.png" alt="">';
				if (has_post_thumbnail()) {
					$thumbnail = get_the_post_thumbnail($post_id, $thumb_size);
				}
			} else {
				$type = '<img src="' . get_template_directory_uri() . '/framework/img/format-' . get_post_format() . '.png" alt="">';
				if ( 'video' === get_post_format() ) {
					$thumbnail = '<div class="video-thumb">' . get_post_meta($post->ID, '_format_video_embed', true) . '</div>';
				} else {
					if ( $images = get_children(array("post_parent" => get_the_ID(), "post_type" => "attachment", "post_mime_type" => "image" ))) {
						$thumbnail = '<div class="flexslider"><ul class="slides">';
						foreach( $images as $image ) :
							$thumbnail .= '<li><a href="' . get_permalink() . '">' . wp_get_attachment_image($image->ID, $thumb_size) . '</a></li>';
						endforeach;
						$thumbnail .= '</ul></div>';
					}
				}
			}
			
			// Output
			if ( false === get_post_format() ) {
				$out .= '<li class="' . $class_1 . '"><a href="' . get_permalink() . '"><span class="type">' . $type . '</span>' . $thumbnail . '</a></li>';
			} else {
				$out .= '<li class="' . $class_1 . '"><span class="type">' . $type . '</span>' . $thumbnail . '</li>';				
			}
			
		endwhile;

		$out .= '</ul></div></div></div>';
		
		wp_reset_query();
	
	endif;

	return $out;
}


/* Blog Posts v2
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_blog_v2($atts, $content = null){
	extract(shortcode_atts(array(
       	'posts'      => '3',
       	'categories' => 'all',
       	'excerpt_words' => '15'
    ), $atts));
    
    global $post;
    global $data;

	$args = array(
		'post_type'      => 'post',
		'posts_per_page' => $posts,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
    );
    
    if($categories != 'all'){
    	
    	// string to array
    	$str = $categories;
    	$arr = explode(',', $str);
    	
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'category',
			'field' 	=> 'slug',
			'terms' 	=> $arr
		);
	}

    query_posts($args);

	$out = '<div class="sc_blog_2">';

	if( have_posts() ) : 

		$post_counter = 0;

		while ( have_posts() ) : the_post();

			if ( false === get_post_format() ) {
				$type = '<img src="' . get_template_directory_uri() . '/framework/img/format-standard.png" alt="">';
			} else {
				$type = '<img src="' . get_template_directory_uri() . '/framework/img/format-' . get_post_format() . '.png" alt="">';
			}
			
			ob_start();  
    		get_template_part('framework/inc/meta-mini');  
    		$meta = ob_get_contents();  
    		ob_end_clean(); 

			// Output
			$out .= '<div class="blog-item"><span class="type">' . $type . '</span><div><h2><a href="' . get_permalink() . '">' . get_the_title() . '</a></h2><footer class="meta"><ul>' . $meta . '</ul></footer><p>' . wp_trim_words( get_the_excerpt(), $excerpt_words, '&hellip;' ) . '</div></div>';
			
		endwhile;

		$out .= '</div>';
		
		wp_reset_query();
	
	endif;

	return $out;
}


/* Portfolio Posts v1
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_portfolio_v1($atts, $content = null){
	extract(shortcode_atts(array(
		'title'      => 'Recent Works',
       	'posts'      => '6',
       	'categories' => 'all',
       	'columns'    => '4'
    ), $atts));
    
    global $post;
    global $data;

	$args = array(
		'post_type'      => 'portfolio',
		'posts_per_page' => $posts,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
    );
    
    if($categories != 'all'){
    	
    	// string to array
    	$str = $categories;
    	$arr = explode(',', $str);
    	
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'portfolio_filter',
			'field' 	=> 'slug',
			'terms' 	=> $arr
		);
	}

    query_posts($args);

	if( $title != '' ) {
		$heading = '<h2 class="title">' . $title . '</h2>';
	} else {
		$heading = '';		
	}

	if( $columns == '3' ) {
		$class_1 = 'one-third';
		$class_2 = 'two-third';
	} else {
		$class_1 = 'one-fourth';		
		$class_2 = 'three-fourth';
	}	

	if( $content != '' ) {
	    $out = '<div class="sc_posts"><div class="' . $class_1 . '">' . $heading . '<p>' . do_shortcode($content) . '</p><nav class="direct-buttons"><a href="#" class="next"></a><a href="#" class="prev"></a></nav></div><div class="' . $class_2 . ' last"><div class="recent-posts"><ul>';
	} else {
	    $out = '<div class="sc_posts"><div class="' . $class_1 . '">' . $heading . '<nav class="direct-buttons"><a href="#" class="next"></a><a href="#" class="prev"></a></nav></div><div class="' . $class_2 . ' last"><div class="recent-posts"><ul>';
	}

	if( have_posts() ) : 

		$post_counter = 0;

		while ( have_posts() ) : the_post();

			$post_counter++;

			// Thumbnail
			if (has_post_thumbnail()) {
				$thumbnail = get_the_post_thumbnail($post->ID, 'portfolio-four');
			} else {
				$thumbnail = '';
			}

			$embedd = "";
			
			if( get_post_meta( get_the_ID(), "moutheme_embed", true ) != "") {
				if ( get_post_meta( get_the_ID(), "moutheme_source", true ) == "youtube" ) {
					$lightbox_link = '<a href="http://www.youtube.com/embed/' . rwmb_meta('moutheme_embed') . '?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" class="from-left" rel="cbox[portfolio]" title="'. get_the_title() .'"><i class="icon-play"></i></a>';
				} else if ( get_post_meta( get_the_ID(), "moutheme_source", true ) == "vimeo" ) {
					$lightbox_link = '<a href="http://player.vimeo.com/video/' . rwmb_meta('moutheme_embed') . '?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" class="from-left" rel="cbox[portfolio]" title="'. get_the_title() .'"><i class="icon-play"></i></a>';
				} else if ( get_post_meta( get_the_ID(), 'moutheme_source', true ) == 'own' ) {
					$randomid = rand();
					$lightbox_link = '<a href="#embedd-video-'.$randomid.'" class="from-left" title="'. get_the_title() .'" rel="cbox[portfolio]"><i class="icon-play"></i></a>';
					$embedd = '<div id="embedd-video-'.$randomid.'" class="embedd-video"><p>' . rwmb_meta('moutheme_embed') . '</p></div>';
				}
			} else {
				$lightbox_link = '<a href="'. wp_get_attachment_url( get_post_thumbnail_id() ) .'" class="from-left" rel="cbox[portfolio]" title="'. get_the_title() .'">' . __('Open In Lightbox', 'moutheme') . '</a>';
    		}

			if(get_post_meta( get_the_ID(), "moutheme_short-desc", true ) != '' ) {
				$desc = get_post_meta( get_the_ID(), "moutheme_short-desc", true );
			} else {
				$desc = substr(get_the_excerpt(),0,35).'&hellip;';
			}
			
			// Output
			$out .= '<li class="' . $class_1 . ' p-item"><div>' . $thumbnail . '<div class="overlay"><h3><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3><span class="line"></span><p>' . $desc . '</p><nav>' . $lightbox_link . '<a href="' . get_permalink() . '" class="from-right">' . __('Project Details', 'moutheme') . '</a></nav></div></div></li>';
			
		endwhile;

		$out .= '</ul></div></div></div>';
		
		wp_reset_query();
	
	endif;

	return $out;
}


/* Portfolio Posts v2
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_portfolio_v2($atts, $content = null){
	extract(shortcode_atts(array(
       	'posts'      => '6',
       	'columns'    => '3',
       	'categories' => 'all'
    ), $atts));
    
    global $post;
    global $data;

	$args = array(
		'post_type'      => 'portfolio',
		'posts_per_page' => $posts,
		'order'          => 'DESC',
		'orderby'        => 'date',
		'post_status'    => 'publish'
    );
    
    if($categories != 'all'){
    	
    	// string to array
    	$str = $categories;
    	$arr = explode(',', $str);
    	
		$args['tax_query'][] = array(
			'taxonomy' 	=> 'portfolio_filter',
			'field' 	=> 'slug',
			'terms' 	=> $arr
		);
	}

    query_posts($args);

	if( $title != '' ) {
		$heading = '<h2 class="title">' . $title . '</h2>';
	} else {
		$heading = '';		
	}

	if( $columns == '3' ) {
		$class = 'one-third';
		$in_row = 3;
	} elseif ( $columns == '4' ) {
		$class = 'one-fourth';		
		$in_row = 4;
	} else {
		$class = 'one-second';		
		$in_row = 2;
	}

    $out = '<div class="sc_portfolio"><ul>';

	if( have_posts() ) : 

		$post_counter = 0;

		while ( have_posts() ) : the_post();

			$post_counter++;

			// Thumbnail
			if (has_post_thumbnail()) {
				$thumbnail = get_the_post_thumbnail($post->ID, 'portfolio-four');
			} else {
				$thumbnail = '';
			}

			if ( $post_counter % $in_row == 0 ) {
				$last = ' last';
			} else {
				$last = '';
			}

			$embedd = "";
			
			if( rwmb_meta('moutheme_embed') != "") {
				if ( get_post_meta( get_the_ID(), "moutheme_source", true ) == "youtube" ) {
					$lightbox_link = '<a href="http://www.youtube.com/embed/' . rwmb_meta('moutheme_embed') . '?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" class="from-left" rel="cbox[portfolio]" title="'. get_the_title() .'"><i class="icon-play"></i></a>';
				} else if ( get_post_meta( get_the_ID(), "moutheme_source", true ) == "vimeo" ) {
					$lightbox_link = '<a href="http://player.vimeo.com/video/' . rwmb_meta('moutheme_embed') . '?rel=0&showinfo=0&modestbranding=1&hd=1&autohide=1&color=white" class="from-left" rel="cbox[portfolio]" title="'. get_the_title() .'"><i class="icon-play"></i></a>';
				} else if ( get_post_meta( get_the_ID(), 'moutheme_source', true ) == 'own' ) {
					$randomid = rand();
					$lightbox_link = '<a href="#embedd-video-'.$randomid.'" class="from-left" title="'. get_the_title() .'" rel="cbox[portfolio]"><i class="icon-play"></i></a>';
					$embedd = '<div id="embedd-video-'.$randomid.'" class="embedd-video"><p>' . rwmb_meta('moutheme_embed') . '</p></div>';
				}
			} else {
				$lightbox_link = '<a href="' . wp_get_attachment_url( get_post_thumbnail_id() ) . '" class="from-left" rel="cbox[portfolio]" title="' . get_the_title() . '">' . __('Open In Lightbox', 'moutheme') . '</a>';
    		}

			if(rwmb_meta('moutheme_short-desc') != '' ) {
				$desc = '<p>' . rwmb_meta('moutheme_short-desc') . '</p>';
			}
			
			// Output
			$out .= '<li class="' . $class . $last . ' p-item"><div>' . $thumbnail . '<div class="overlay"><nav class="centered">' . $lightbox_link . '<a href="' . get_permalink() . '" class="from-right">' . __('Project Details', 'moutheme') . '</a></nav></div></div><div class="item-desc"><h3><a href="' . get_permalink() . '" title="' . get_the_title() . '">' . get_the_title() . '</a></h3>' . $desc . '</div></li>';
			
		endwhile;

		$out .= '</ul></div>';
		
		wp_reset_query();
	
	endif;

	return $out;
}

/* Staff
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_staff( $atts, $content = null) {
extract( shortcode_atts( array(
    'photo'    => '',			
    'title'    => '',
    'facebook' => '',
    'twitter'  => '',
    'linkedin' => '',
    'flickr' => ''
    ), $atts ) );
	
	$visual = $heading = $job = $social = '';

	// Photo
	if($photo != '') $visual = '<p class="image"><img src="' . $photo . '" alt=""></p>';

	// Title
	if($title != '') $heading = '<h4 class="title">' . $title . '</h4>';

	// Social links
	if($facebook != '' || $twitter != '' || $linkedin != '' || $flickr != '') {
		$social = '<div class="i-large"><ul>';

		// Facebook
		if($facebook != '') $social .= '<li class="s-facebook"><a target="_blank" href="' . $facebook . '">Facebook</a></li>';

		// Twitter
		if($twitter != '') $social .= '<li class="s-twitter"><a target="_blank" href="' . $twitter . '">Twitter</a></li>';

		// LinkedIn
		if($linkedin != '') $social .= '<li class="s-linkedin"><a target="_blank" href="' . $linkedin . '">LinkedIn</a></li>';

		// Flickr
		if($flickr != '') $social .= '<li class="s-flickr"><a target="_blank" href="' . $flickr . '">Flickr</a></li>';

		$social .= '</ul></div>';
	} 

    return '<div class="sc_team-member">' . $visual . $heading . $job . do_shortcode($content) . $social . '</div>';
}


/* Googel Map
-------------------------------------------------------------------------------------------------------------------*/

function shortcode_map($atts) {

	// default atts
	$atts = shortcode_atts(array(	
		'lat'   => '0', 
		'lon'    => '0',
		'id' => 'map',
		'z' => '1',
		'w' => '400',
		'h' => '300',
		'maptype' => 'ROADMAP',
		'address' => '',
		'kml' => '',
		'kmlautofit' => 'yes',
		'marker' => '',
		'markerimage' => '',
		'traffic' => 'no',
		'bike' => 'no',
		'fusion' => '',
		'start' => '',
		'end' => '',
		'infowindow' => '',
		'infowindowdefault' => 'yes',
		'directions' => '',
		'hidecontrols' => 'false',
		'scale' => 'false',
		'scrollwheel' => 'true',
		'style' => ''		
	), $atts);
									
	$returnme = '<div id="' .$atts['id'] . '" style="width:' . $atts['w'] . 'px;height:' . $atts['h'] . 'px;" class="google_map ' . $atts['style'] . '"></div>';
	
	//directions panel
	if($atts['start'] != '' && $atts['end'] != '') {
		$panelwidth = $atts['w']-20;
		$returnme .= '<div id="directionsPanel" style="width:' . $panelwidth . 'px;height:' . $atts['h'] . 'px;border:1px solid gray;padding:10px;overflow:auto;"></div><br>';
	}

	$returnme .= '
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script><style type="text/css">.entry-content img {max-width: 100000%; /* override */}</style>
	<script type="text/javascript">
		var latlng = new google.maps.LatLng(' . $atts['lat'] . ', ' . $atts['lon'] . ');
		var myOptions = {
			zoom: ' . $atts['z'] . ',
			center: latlng,
			scrollwheel: ' . $atts['scrollwheel'] .',
			scaleControl: ' . $atts['scale'] .',
			disableDefaultUI: ' . $atts['hidecontrols'] .',
			mapTypeId: google.maps.MapTypeId.' . $atts['maptype'] . '
		};
		var ' . $atts['id'] . ' = new google.maps.Map(document.getElementById("' . $atts['id'] . '"),
		myOptions);
		';
				
		//kml
		if($atts['kml'] != '') {
			if($atts['kmlautofit'] == 'no') {
				$returnme .= '
				var kmlLayerOptions = {preserveViewport:true};
				';
			} else {
				$returnme .= '
				var kmlLayerOptions = {preserveViewport:false};
				';
			}
			$returnme .= '
			var kmllayer = new google.maps.KmlLayer(\'' . html_entity_decode($atts['kml']) . '\',kmlLayerOptions);
			kmllayer.setMap(' . $atts['id'] . ');
			';
		}

		//directions
		if($atts['start'] != '' && $atts['end'] != '') {
			$returnme .= '
			var directionDisplay;
			var directionsService = new google.maps.DirectionsService();
		    directionsDisplay = new google.maps.DirectionsRenderer();
		    directionsDisplay.setMap(' . $atts['id'] . ');
    		directionsDisplay.setPanel(document.getElementById("directionsPanel"));

				var start = \'' . $atts['start'] . '\';
				var end = \'' . $atts['end'] . '\';
				var request = {
					origin:start, 
					destination:end,
					travelMode: google.maps.DirectionsTravelMode.DRIVING
				};
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						directionsDisplay.setDirections(response);
					}
				});
			';
		}
		
		//traffic
		if($atts['traffic'] == 'yes') {
			$returnme .= '
			var trafficLayer = new google.maps.TrafficLayer();
			trafficLayer.setMap(' . $atts['id'] . ');
			';
		}
	
		//bike
		if($atts['bike'] == 'yes') {
			$returnme .= '			
			var bikeLayer = new google.maps.BicyclingLayer();
			bikeLayer.setMap(' . $atts['id'] . ');
			';
		}
		
		//fusion tables
		if($atts['fusion'] != '') {
			$returnme .= '			
			var fusionLayer = new google.maps.FusionTablesLayer(' . $atts['fusion'] . ');
			fusionLayer.setMap(' . $atts['id'] . ');
			';
		}
	
		//address
		if($atts['address'] != '') {
			$returnme .= '
		    var geocoder_' . $atts['id'] . ' = new google.maps.Geocoder();
			var address = \'' . $atts['address'] . '\';
			geocoder_' . $atts['id'] . '.geocode( { \'address\': address}, function(results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					' . $atts['id'] . '.setCenter(results[0].geometry.location);
					';
					
					if ($atts['marker'] !='') {
						//add custom image
						if ($atts['markerimage'] !='') {
							$returnme .= 'var image = "'. $atts['markerimage'] .'";';
						}
						$returnme .= '
						var marker = new google.maps.Marker({
							map: ' . $atts['id'] . ', 
							';
							if ($atts['markerimage'] !='') {
								$returnme .= 'icon: image,';
							}
						$returnme .= '
							position: ' . $atts['id'] . '.getCenter()
						});
						';

						//infowindow
						if($atts['infowindow'] != '') {
							//first convert and decode html chars
							$thiscontent = htmlspecialchars_decode($atts['infowindow']);
							$returnme .= '
							var contentString = \'' . $thiscontent . '\';
							var infowindow = new google.maps.InfoWindow({
								content: contentString
							});
										
							google.maps.event.addListener(marker, \'click\', function() {
							  infowindow.open(' . $atts['id'] . ',marker);
							});
							';

							//infowindow default
							if ($atts['infowindowdefault'] == 'yes')
							{
								$returnme .= '
									infowindow.open(' . $atts['id'] . ',marker);
								';
							}
						}
					}
			$returnme .= '
				} else {
				alert("Geocode was not successful for the following reason: " + status);
			}
			});
			';
		}

		//marker: show if address is not specified
		if ($atts['marker'] != '' && $atts['address'] == '') {
			//add custom image
			if ($atts['markerimage'] !='') {
				$returnme .= 'var image = "'. $atts['markerimage'] .'";';
			}

			$returnme .= '
				var marker = new google.maps.Marker({
				map: ' . $atts['id'] . ', 
				';
				if ($atts['markerimage'] !='') {
					$returnme .= 'icon: image,';
				}
			$returnme .= '
				position: ' . $atts['id'] . '.getCenter()
			});
			';

			//infowindow
			if($atts['infowindow'] != '') {
				$returnme .= '
				var contentString = \'' . $atts['infowindow'] . '\';
				var infowindow = new google.maps.InfoWindow({
					content: contentString
				});
							
				google.maps.event.addListener(marker, \'click\', function() {
				  infowindow.open(' . $atts['id'] . ',marker);
				});
				';
				//infowindow default
				if ($atts['infowindowdefault'] == 'yes')
				{
					$returnme .= '
						infowindow.open(' . $atts['id'] . ',marker);
					';
				}				
			}
		}
		
		$returnme .= '</script>';
		
		return $returnme;
}
add_shortcode('map', 'shortcode_map');


/* Pre Process Shortcodes
-------------------------------------------------------------------------------------------------------------------*/

function pre_process_shortcode($content) {
    global $shortcode_tags;
 
    // Backup current registered shortcodes and clear them all out
    $orig_shortcode_tags = $shortcode_tags;
    remove_all_shortcodes();
    
    add_shortcode('accordion', 'shortcode_accordion');
    add_shortcode('tabs', 'shortcode_tabs');
    add_shortcode('tab', 'shortcode_tab');
    add_shortcode('alert', 'shortcode_alert');
    add_shortcode('custom_button', 'shortcode_buttonlink');
    add_shortcode('infobox', 'shortcode_infobox');
    add_shortcode('imagebox', 'shortcode_imagebox');
    add_shortcode('iconbox', 'shortcode_iconbox');
    add_shortcode('testimonial', 'shortcode_testimonial');
    add_shortcode('pricing_table', 'shortcode_pricing_table');
    add_shortcode('item', 'shortcode_item');
    add_shortcode('calltoaction', 'shortcode_calltoaction');
    add_shortcode('tooltip', 'shortcode_tooltip');
    add_shortcode('progressbar', 'shortcode_progressbar');
    add_shortcode('styled_list', 'shortcode_styled_list');
    add_shortcode('gap', 'shortcode_gap');
    add_shortcode('divider', 'shortcode_divider');
    add_shortcode('clearfix', 'shortcode_clearfix');
    add_shortcode('one_fourth', 'shortcode_one_fourth');
	add_shortcode('one_third', 'shortcode_one_third');
	add_shortcode('one_second', 'shortcode_one_second');
	add_shortcode('two_third', 'shortcode_two_third');
	add_shortcode('three_fourth', 'shortcode_three_fourth');
	add_shortcode('video', 'shortcode_video');
	add_shortcode('staff', 'shortcode_staff');
	add_shortcode('maps', 'shortcode_map');
	add_shortcode('dropcap', 'shortcode_dropcap');
	add_shortcode('icon', 'shortcode_icon');

	add_shortcode('clients', 'shortcode_clients');
	add_shortcode('client', 'shortcode_client');
	add_shortcode('blog_v1', 'shortcode_blog_v1');
	add_shortcode('blog_v2', 'shortcode_blog_v2');
	add_shortcode('portfolio_v1', 'shortcode_portfolio_v1');
	add_shortcode('portfolio_v2', 'shortcode_portfolio_v2');
 
    // Do the shortcode (only the one above is registered)
    $content = do_shortcode($content);
 
    // Put the original shortcodes back
    $shortcode_tags = $orig_shortcode_tags;
 
    return $content;
}

add_filter('the_content', 'pre_process_shortcode', 7);

// Allow Shortcodes in Widgets
add_filter('widget_text', 'pre_process_shortcode', 7);


/* Tiny MCE buttons
-------------------------------------------------------------------------------------------------------------------*/

add_action('init', 'add_button');

function add_button() {  
	if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') ) {
		add_filter('mce_external_plugins', 'add_plugin');
		add_filter('mce_buttons_3', 'register_button_3');
	     add_filter('mce_buttons_3', 'register_button_3');
	     add_filter('mce_buttons_4', 'register_button_4');  
	}
}

// Define Position of TinyMCE Icons
function register_button_3($buttons) {  
   array_push(
   		$buttons,
   		"accordion",
   		"tabs",
   		"alert",
   		"custom_button",
   		"infobox",
   		"imagebox",
   		"iconbox",
   		"testimonial",
   		"calltoaction",
   		"tooltip",
   		"progressbar",
   		"styled_list",
   		"gap",
   		"divider",
   		"clearfix",
   		"one_fourth",
   		"one_third",
   		"one_second",
   		"two_third",
   		"three_fourth");
   return $buttons;  
}

// Define Position of TinyMCE Icons
function register_button_4($buttons) {  
   array_push(
   		$buttons,
   		"video",
   		"staff",
   		"maps",
   		"dropcap",
   		"icon",
   		"pricing_table",
   		"clients",
   		"blog_v1",
   		"blog_v2",
   		"portfolio_v1",
   		"portfolio_v2");
   return $buttons;  
}

function add_plugin($plugin_array) {  
   $plugin_array['accordion'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['tabs'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['alert'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['custom_button'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['infobox'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['imagebox'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['iconbox'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['testimonial'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['calltoaction'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['tooltip'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['progressbar'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['styled_list'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['gap'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['divider'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['clearfix'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['one_fourth'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js'; 
   $plugin_array['one_third'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['one_second'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['two_third'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['three_fourth'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['video'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['staff'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['maps'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['dropcap'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['icon'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['clients'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['pricing_table'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['blog_v1'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['blog_v2'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['portfolio_v1'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';
   $plugin_array['portfolio_v2'] = get_template_directory_uri().'/framework/inc/tinymce/tinymce.js';

   return $plugin_array;  
}