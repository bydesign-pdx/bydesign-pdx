<?php
function flatroom_colors_customize_register( $wp_customize ) {
    $wp_customize->add_setting( 'color' , array(
        'default'     => '#41a3e1',
        'transport'   => 'refresh',
    ) );
    $wp_customize->add_section( 'colors_section' , array(
        'title'      => __( 'Color', 'flatroom' ),
        'priority'   => 30,
    ) );
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'color', array(
        'label'        => __( 'Color', 'flatroom' ),
        'section'    => 'colors_section',
        'settings'   => 'color',
    ) ) );
}
add_action( 'customize_register', 'flatroom_colors_customize_register' );

function flatroom_hex2rgba($color, $opacity = false) {
	
	$flatroom_settings = get_option( "flatroom_settings" );

	$default = '';

	//Return default if no color provided
	if(empty($color))
          return $default; 

	//Sanitize $color if "#" is provided 
        if ($color[0] == '#' ) {
        	$color = substr( $color, 1 );
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
                $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
                $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
                return $default;
        }

        //Convert hexadec to rgb
        $rgb =  array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
        	if(abs($opacity) > 1)
        		$opacity = 1.0;
        	$output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
        	$output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
}

function flatroom_customize_css()
{
	
	$flatroom_settings = get_option( "flatroom_settings" );
    ?>
        <style type="text/css">
            .btn,
            .btn:visited,
            .btn:hover,
            .btn:focus,
			.btn.disabled,
			.btn[disabled],
            .new-radio.checked span,
            .bg-color,
            #site-header .header-icons-buttons a.active,
            body.dark #main,
            .ibr-homepage #main,
            .page-header,
            #sidebar .sidebar-button span,
            .prev-next:hover,
			.prev-next:focus,
            .sidebar .dsidx-widget-listings .dsidx-slideshow .dsidx-move-up:hover,
            .sidebar .dsidx-widget-listings .dsidx-slideshow .dsidx-move-down:hover,
            .sidebar .dsidx-widget-single-listing .dsidx-widget-single-listing-photos .dsidx-widget-single-listing-slideshow-control:hover,
            .property-view #content .galery .thumbs-box .prev:hover,
            .property-view #content .galery .thumbs-box .next:hover,
            #dsidx-header .jb-navigation .jbn-nav-button:hover,
            #jb-glry-dlg .jb-navigation .jbn-nav-button:hover,
            #comments #respond #submit,
            #site-footer,
            #site-footer .title:before,
			#site-footer .widget-title:before,
            body.dark .bg-dark .no-dark .btn,
            body.dark .bg-dark .no-dark .btn:visited,
            body.dark .bg-dark .no-dark .btn:hover,
            body.dark .bg-dark .no-dark .btn:focus,
			.fancybox-wrap .fancybox-nav:hover,
			.home-tabs-overlay,
			.post-navigation .nav-links .back-to-list .back-icon span,
			.team-member .worker-info .image-hover,
			.jqplot-highlighter-tooltip,
			.jqplot-canvasOverlay-tooltip {
                background-color: <?php echo get_theme_mod('color'); ?>;
            }
            body.dark .bg-dark .no-dark a,
            #site-header .header-icons-buttons a.active,
            #site-header .header-icons-buttons a,
            #site-header .header-icons-buttons a:hover,
			body.dark #site-footer .about-us-link:hover .title,
			.team-member .worker-info,
			#sidebar .ibr-agents-widget .autor-content .email a,
			.features-shortcode .senond .features-icon-box .border,
			#wp-calendar a:hover {
                border-color: <?php echo get_theme_mod('color'); ?>;
            }
            #site-header .header-icons-buttons a.active:after {
                border-left-color: <?php echo get_theme_mod('color'); ?>;
            }
            .page-header .container:after,
            body.dark .page-header .container:before {
                border-top-color: <?php echo get_theme_mod('color'); ?>;
            }
            a,
            body.dark .bg-dark .no-dark a,
            a:hover,
            a:focus,
            body.dark .bg-dark .no-dark a:hover,
            body.dark .bg-dark .no-dark a:focus,
            a.no-border,
            .no-border a,
            body.dark .bg-dark .btn,
            body.dark .bg-dark .btn:visited,
            body.dark .bg-dark .btn:hover,
            body.dark .bg-dark .btn:focus,
            .accordion-heading .accordion-toggle:before,
            .accordion-heading .accordion-toggle:hover,
            body.dark .bg-dark .accordion-heading .accordion-toggle:hover,
            .pagination ul > .active > a,
            .pagination ul > .active > span,
            .login-register .links a,
            #site-header .header-icons-buttons a,
            #site-header .header-icons-buttons a span,
            #searchform #searchsubmit,
            #sidebar .widget-area .widget-title:first-letter,
            #sidebar .widget_nav_menu li a > .open-sub,
            #sidebar .widget_pages li a > .open-sub,
            .sidebar .widget-features .features-icon,
            .sidebar .dsidx-widget-listings .featured-listing .price,
            .sidebar .dsidx-widget-single-listing .dsidx-widget-single-listing-price,
            .more-link,
            .more-link:visited,
            body.dark .bg-dark .pricing-box .title a,
            .pricing-box .price-box,
            .pricing-box .options li .act,
            .agent .social a:hover,
            .property .bottom-box,
            #dsidx-actions a,
            #dsidx-listings .dsidx-listing .dsidx-primary-data .dsidx-address a,
            #comments .comment-list .comment .comment-author .fn,
            body.dark #comments #respond #submit,
            body.dark #site-footer .title:first-letter,
            body.dark #site-footer a,
            body.dark #site-footer .widget .newsletter .submit,
            .features-shortcode .features-icon,
            .property-on-map .on-map-price,
            .properties-shortcode .on-widget-price,
            .ibr-properties-widget .on-widget-price,
			body.dark #site-footer .widget-title:first-letter,
			body.dark #site-footer .ibr-subscribe-widget .submit,
			body.dark #site-footer .about-us-link:hover .title,
			#sidebar .ibr-subscribe-widget .submit,
			.about-us-box .more-then .count,
			.team-member .worker-name,
			#sidebar a:hover,
			#sidebar .ibr-properties-widget .on-widget-title a,
			#sidebar .ibr-agents-widget .autor-content .title a,
			#sidebar .ibr-agents-widget .autor-content .email a,
			.property-view #content .agent-info a,
			body.dark .bg-dark .agent .social a:hover,
			#wp-calendar a,
			.shortcode .shortcode-title .link,
			.banner-shortcode .title,
			.features-shortcode .senond .features-title,
			.jqplot-xaxis-label,
			.jqplot-yaxis-label,
			#main .home-slider.type-property .slide .slide-content .slide-badge .price-label,
			body.dark .bg-dark .team-member .worker-info .image-hover a {
                color: <?php echo get_theme_mod('color'); ?>;
            }
            #site-header .header-icons-buttons a svg path,
            #site-header .header-icons-buttons a svg polygon,
            .new-checkbox svg polygon,
            .agent .autor-meta svg path,
            .agent .autor-meta svg polygon,
			.page-header .container .setsquare svg path,
			#main .home-slider .slider-nav a:hover svg polygon {
                fill: <?php echo get_theme_mod('color'); ?>;
            }
            @media (max-width: 979px) {
                #main-menu .main-navigation .menu li.active > a {
                    color: <?php echo get_theme_mod('color'); ?>;
                }
            }
            
            /* RGBa Color */
            .btn:hover,
            .btn:focus,
            #main-menu .bg-color,
			.second-bg,
            #comments #respond #submit:hover,
            body.dark .bg-dark .no-dark .btn:hover,
            body.dark .bg-dark .no-dark .btn:focus,
			.home-tabs-overlay,
			.fancybox-overlay {
                background-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.75); ?>;
            }
            body.dark #sidebar .widget-area .aside-border {
                background-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.2); ?>;
            }
            .prev-next:hover,
			.prev-next:focus,
            .sidebar .dsidx-widget-listings .dsidx-slideshow .dsidx-move-up:hover,
            .sidebar .dsidx-widget-listings .dsidx-slideshow .dsidx-move-down:hover,
            .sidebar .dsidx-widget-single-listing .dsidx-widget-single-listing-photos .dsidx-widget-single-listing-slideshow-control:hover,
            #dsidx-header .jb-navigation .jbn-nav-button:hover,
            #jb-glry-dlg .jb-navigation .jbn-nav-button:hover {
                background-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.9); ?>;
            }
            .property .bottom-box {
                background-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.08); ?>;
            }
            body.dark #main,
            .ibr-homepage #main {
                background-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.97); ?>;
            }
			.ibr-homepage #main {
                background-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.97); ?>;
            }
			.team-member .worker-info .image-hover {
                background-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.85); ?>;
            }
            a:visited,
            body.dark .bg-dark .no-dark a:visited {
                color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.75); ?>;
            }
            a,
            body.dark .bg-dark .no-dark a,
			#sidebar .ibr-agents-widget .autor-content .email a {
                border-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.4); ?>;
            }
            a:hover,
            a:focus,
            body.dark .bg-dark .no-dark a:hover,
            body.dark .bg-dark .no-dark a:focus,
			#sidebar .ibr-agents-widget .autor-content .email a:hover {
                border-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.75); ?>;
            }
			body.dark #site-footer .about-us-link:hover .title {
				border-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.6); ?>;
			}
            #site-header .header-icons-buttons a,
			#wp-calendar a:hover {
                border-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), 0.5); ?>;
            }
			body.dark #main,
			.ibr-homepage #main {
				background-color: <?php echo flatroom_hex2rgba(get_theme_mod('color'), $flatroom_settings['opacity']); ?>;
			}
        </style>
    <?php
}
add_action( 'wp_head', 'flatroom_customize_css');