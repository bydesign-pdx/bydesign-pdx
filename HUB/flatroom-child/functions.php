<?php
/*
Theme Name: Flat Room Child
Template: flatroom
Theme URI: http://wordpress.flatroom.itembridge.com/
Author: Infostyle
Author URI: http://themeforest.net/user/InfoStyle
Description: Flat Room Child responsive theme
Version: 1.1.0
License: GNU ThemeForest Regular & Extended License
License URI: http://themeforest.net/licenses/regular_extended
*/


//custom - footer menu
$custFootMenu = array();




/******************************************************************************
	Shortcodes
******************************************************************************/

/**
 * purchasing
 */
function my_purchasing_shortcode ( $attributes, $content = null )
{
	$title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Purchasing A Home';
	$content = isset($content) && $content ? $content : 'Your dream home is at your fingertips. We can help you own your first, second or vacation home property in a few simple steps. Let’s see what type of financing options will work for you.';

	$return = '
		<h3 id="headPurchase" class="header-purchasing fa fa-home">'.$title.'</h3>
		<p>'.$content.'</p>
	';

	return $return;
}
add_shortcode( 'hub-purchasing', 'my_purchasing_shortcode' );

/**
 * refinance
 */
function my_refinance_shortcode ( $attributes, $content = null )
{
	$title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Need To Refinance?';
	$content = isset($content) && $content ? $content : 'Saving money is good. If you need a lower rate, want to leverage your home’s equity, or simply want to lower your payments let’s find a refinance solution that will make it happen. Capitalize on these low rates.';

	$return = '
		<h3 id="headRefinance" class="header-refinance fa fa-refresh">'.$title.'</h3>
		<p>'.$content.'</p>
	';
	
}
add_shortcode( 'hub-refinance', 'my_refinance_shortcode' );

/**
 * products
 */
function my_products_shortcode ( $attributes, $content = null )
{
	$title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Niche Products';
	$content = isset($content) && $content ? $content : 'We offer a wide array of niche products as well as mortgage loans for manufactured homes, modular homes, properties with large acreage, WA Bond Programs, low interest second mortgages, Homepath, Future income programs, extended lock options and more.';

	$return = '
		<h3 id="headNiche" class="header-niche fa fa-check-square-o">'.$title.'</h3>
		<p>'.$content.'</p>
	';

	return $return;
}
add_shortcode( 'hub-products', 'my_products_shortcode' );

/**
 * options
 */
 
  $title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Loan Options';
 array_push($custFootMenu, array("fa-code-fork","loans", $title));
 
 
function my_options_shortcode ( $attributes, $content = null )
{
	$title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Loan Options';
	$flatroom_settings = get_option( "flatroom_settings" );
	$loanLink = $flatroom_settings['agent_apply_url'];
	$content = isset($content) && $content ? $content : '
		<p><strong>Purchasing or Refinancing in Oregon, Washington and California? </strong>
		Look no further. I have a wealth of knowledge on a wide range of financing options. I\'ve included below, the types of mortgage loans I specialize in:</p>
		<ul>
			<li>Conventional Loans</li>
			<li>Conforming High Balance Loans</li>
			<li>Jumbo Loans</li>
			<li>Fixed/Adjustable Rate Loans</li>
			<li>Construction Loans | Lot Loans</li>
			<li>Second Home Loans | Investment Loans</li>
			<li>FHA Loans</li>
			<li>VA Loans</li>
			<li>USDA</li>
			<li>Self Employed Loans</li>
			<li>Reverse Mortgages</li>
			<li>Energy Efficient Mortgage (Green Mortgages)</li>
			<li>Niche Products</li>
			<li>Refinance Loans | Remodel Loans | Rehab Loans</li>
		</ul>
		<div id="info"></div>
		<p>Purchasing a home and navigating your loan options can be a difficult task in this market. I can help make this simple and straightforward. I can also help with refinancing your current mortgage. This can be fantastic opportunity to gain immediate and long-term savings. It doesn\'t always mean a mountain of paperwork.</p>
		<p>Learn more about the available <a href="/loan-options" target="_blank">loan options</a> available and <a href="' . $loanLink . '" target="_blank">apply today!</a></p>
	';

	$return = '
		<h3 id="loans" class="header-loan fa fa-code-fork">'.$title.'</h3>
		'.$content.'
	';

	return $return;
}
add_shortcode( 'hub-options', 'my_options_shortcode' );

/**
 * bio
 */
 $title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Info';
 array_push($custFootMenu, array("fa-user","headBio", "Info")); //not $title ??
 
function my_bio_shortcode ( $attributes, $content = null)
{
	$title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Info';
	
	$content = isset($content) && $content ? $content : '
		<p>Helping you find the best loan and doing the right thing&#8230; every single time!</p>
		<p>I&#8217;ve been originating mortgages in Oregon, Washington, and California since 2003 and have become successful by treating my clients fairly and taking the time to help them make the smartest decisions. Being a part of the Summit Mortgage Team allows me to offer a wide range of programs and fund most loans as a direct lender, using our mortgage bank.</p>
		<p>My specialty and focus is to educate my clients. I&#8217;ve worked with many first time homebuyers, as well as experienced homeowners and investors.</p>
		<p>Summit Mortgage offers a wide variety of loan products and I make it my goal to help you select the best available mortgage product for your financial needs. I&#8217;ll do my best to help you obtain competitive rates and terms for your unique situation.</p>
		<p>We offer the following lending options and typically underwrite and fund these applications in-house, as a direct lender.</p>
	';

	$return = '
		<h3 id="headBio" class="header-bio fa fa-user">'.$title.'</h3>
		'.$content.'
	';

	return $return;
}
add_shortcode( 'hub-bio', 'my_bio_shortcode' );







/**
 * custom section
 */

//get frontpage ID
$front_page_id = get_option( 'page_on_front' );
 
if( have_rows('custom_section', $front_page_id) ):

	// loop through the rows of data - max 1.
	while ( have_rows('custom_section', $front_page_id) ) : the_row();

		// display a sub field value
		$customTitle = get_sub_field('custom_field_title');
		$customIcon = get_sub_field('custom_field_icon');
		$customContent = get_sub_field('custom_field_content');
		
	endwhile;

else :

	// no rows found

endif;
			
array_push($custFootMenu, array($customIcon,"headCustom", $customTitle));	

 
function my_custom_shortcode ( $attributes, $content = null)
{	


	if( have_rows('custom_section') ):

		// loop through the rows of data - max 1.
		while ( have_rows('custom_section') ) : the_row();
	
			// display a sub field value
			$customTitle = get_sub_field('custom_field_title');
			$customIcon = get_sub_field('custom_field_icon');
			$customContent = get_sub_field('custom_field_content');
			
		endwhile;
		
		$return = '
		<h3 id="headCustom" class="header-custom fa ' . $customIcon . '">'.$customTitle.'</h3>
		'.$customContent.'
	';
	
	else :
	
		// no rows found
		
		$return = '';
	
	endif;


	

	return $return;
}
add_shortcode( 'hub-custom', 'my_custom_shortcode' );







/**
 * around-town
 */
 
  $title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Around Town';
 array_push($custFootMenu, array("fa-star","headAroundTown", "Resources"));
 
 
function my_around_town_shortcode( $attributes, $content )
{
	$title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Around Town';

	$return = '

<div class="shortcode properties-shortcode carousel-box around-town first">
	<h3 id="headAroundTown" class="shortcode-title fa fa-star">' . $title . '</h3>
    <div class="row">
        <a href="#" class="prev-next prev" style="display: block;">&#8249;</a>
        <a href="#" class="prev-next next" style="display: block;">&#8250;</a>
        <div class="caroufredsel_wrapper" style="display: block; text-align: start; float: none; position: relative; top: auto; right: auto; bottom: auto; left: auto; z-index: auto; width: 600px; height: 292px; margin: 0px 0px 20px; overflow: hidden; cursor: move;">
            <div class="carousel" style="text-align: left; float: none; position: absolute; top: 0px; right: auto; bottom: auto; left: 0px; margin: 0px; width: 3000px; height: 292px;">';
			
			?>
            
            <?php if( have_rows('pdf') ):

				// loop through the rows of data
				while ( have_rows('pdf') ) : the_row();
			
					// display a sub field value
					$pdfLink = get_sub_field('pdf_link');
					$pdfImage = get_sub_field('pdf_image');
					$pdfTitle = get_sub_field('pdf_title');
					
					$return .= '<div class="span2">
                    <div class="property no-dark pdf-image">
                        <div class="pdf-wrapper">
                            <a href="' . $pdfLink . '" target="_blank">
                                <img src="' . $pdfImage . '">
                            </a>
                        </div>
                        <a href="' . $pdfLink . '" target="_blank">' . $pdfTitle . '</a> 
                    </div>
                    
                </div>';
					
			
				endwhile;
			
				else :
				
					// no rows found
				
				endif;
			
			?>
            
            
                <?php
                $return .= '</div></div></div></div>';

	return trim(preg_replace('/<p[^>]*><\\/p[^>]*>/', ' ', preg_replace('/\s\s+/', ' ', $return)));
}
add_shortcode('around-town', 'my_around_town_shortcode');








/**
 * videos
 */
 
  $title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Videos';
 array_push($custFootMenu, array("fa-video-camera","headVideo", $title));
 
 
function my_videos_shortcode ( $attributes, $content )
{
	$title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Videos';

	$return = '
		<div id="headVideo" class="shortcode properties-shortcode carousel-box videos">

			<h3 class="shortcode-title fa fa-video-camera">'.$title.'</h3>

			<div class="row">
				<a href="#" class="prev-next prev">&#8249;</a>
				<a href="#" class="prev-next next">&#8250;</a>

				<div class="carousel">
	';

	$return .= do_shortcode($content);

	$return .= '
				</div>
			</div>
		</div>
	';

	return $return;
}
add_shortcode( 'videos', 'my_videos_shortcode' );

/**
 * video-item
 */
function my_video_item_shortcode ( $attributes, $content )
{
	$link = isset($attributes['link']) ? $attributes['link'] : '';
	$width = isset($attributes['width']) ? $attributes['width'] : 420;
	$height = isset($attributes['height']) ? $attributes['height'] : 236;

	$return = '
					<div class="span4" style="height:'.($height+30).'px;width:'.$width.'px;">
						<div class="property no-dark" style="height:'.$height.'px;width:'.$width.'px;">
							<iframe src="'.$link.'" width="'.$width.'" height="'.$height.'" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen style="margin-top:-5px;"></iframe>
						</div>
					</div>
	';

	return $return;
}
add_shortcode( 'video-item', 'my_video_item_shortcode' );

/**
 * around-town-item
 */

/* 
function my_around_town_item_shortcode( $attributes, $content )
{
	$pdf = isset($attributes['pdf']) ? $attributes['pdf'] : '';
	$thumbnail = isset($attributes['thumbnail']) ? $attributes['thumbnail'] : '';
    $pdf_title = isset($attributes['pdf_title']) ? $attributes['pdf_title'] : '';
	

	$return = '
					<div class="span2">
						<div class="property no-dark pdf-image">
                        <div class="pdf-wrapper">
							<a href="'.$pdf.'" target="_blank"><img src="'.$thumbnail.'" /></a>
                            </div>
                            <a href="'.$pdf.'" target="_blank">'.$pdf_title.'</a>
						</div>
					</div>
	';

	return trim(preg_replace('/\s\s+/', ' ', $return));
}
add_shortcode( 'around-town-item', 'my_around_town_item_shortcode' );


*/



/**
 * blog
 */
 
  $title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Blog';
 array_push($custFootMenu, array("fa-bullhorn","headBlog", $title));
 
 
function my_blog_shortcode ( $attributes, $content )
{
	$feed = isset($attributes['feed']) ? $attributes['feed'] : 'http://go-summit.com/blog/';
	$title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Blog';
	$limit = isset($attributes['limit']) ? (int)$attributes['limit'] : 10;
	$text = isset($attributes['text']) ? $attributes['text'] : '';

	$feed_xml = fetch_feed( array( $feed ) );

	$return = '
		<div class="shortcode properties-shortcode carousel-box blog">

			<h3 id="headBlog" class="shortcode-title fa fa-bullhorn" style="line-height:0.9;">
				'.$title.'
			</h3>

			<p style="margin: 10px 37px -10px;">'.$text.'</p>

			<div class="row">
				<a href="#" class="prev-next prev">&#8249;</a>
				<a href="#" class="prev-next next">&#8250;</a>

				<div class="carousel">
	';

	$count = 0;
	foreach ( $feed_xml->get_items() as $item )
	{
		if ( $count++ >= $limit )
		{
			break;
		}

		$item_title = $item->get_title();
		$item_link = $item->get_permalink();
		$item_image = '';
		$item_image_src = '/wp-content/themes/flatroom-child/images/summit_blog.png';

		$data = $item->data['child']['http://purl.org/rss/1.0/modules/content/']['encoded'][0]['data'];
		$image = array();
		preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', $data, $image);
		if ( isset( $image['src'] ) )
		{
			$item_image = '<img src="'.$image['src'].'" style="width:86px;height:86px;background:#ccc;border:1px solid #ccc;" />';
			$item_image_src = $image['src'];
		}

		$return .= '
					<div class="span1" style="width:86px;">
						<div class="property no-dark" style="padding:0;border:0;box-shadow:none;-webkit-box-shadow:none;">
							<a href="'.$item_link.'" style="display:block;height:100px;position:relative;" target="_blank">
								<div class="item_image" style="background-image:url('.$item_image_src.');background-position:center center;background-size:cover;background-repeat:no-repeat;height:86px;border:1px solid #ccc;"></div>
								<p style="margin: 10px 0 0 0;">'.$item_title.'</p>
							</a>
						</div>
					</div>
		';
	}

	$return .= '
				</div>
			</div>
		</div>
	';

	return $return;
}
add_shortcode( 'hub-blog', 'my_blog_shortcode' );










/**
 * contact
 */
 
 $title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Contact';
 array_push($custFootMenu, array("fa-phone","headContact", $title));
 
 
function my_contact_shortcode ( $attributes, $content = null )
{
	$title = isset($attributes['title']) ? ucwords($attributes['title']) : 'Contact';
	$image = isset($attributes['image']) ? ucwords($attributes['image']) : '';
	$custom = isset($attributes['custom']) ? $attributes['custom'] : '';
	$nmls_number = isset($attributes['nmls_number']) ? $attributes['nmls_number'] : '';
	$facebook = isset($attributes['facebook']) ? $attributes['facebook'] : '';
	$linkedin = isset($attributes['linkedin']) ? $attributes['linkedin'] : '';
	$yelp = isset($attributes['yelp']) ? $attributes['yelp'] : '';
	$mortgageMapp = isset($attributes['mortgagemapp']) ? $attributes['mortgagemapp'] : '';
	
	
	
	
	
	
	if(empty($facebook)){
		$facebookLink = "";
	}
	else{
		$facebookLink = '<a href="'.$facebook.'" target="_blank" class="fa fa-facebook"></a>';
	}
	
	
	if(empty($linkedin)){
		$linkedinLink = "";
	}
	else{
		$linkenInLink = '<a href="'.$linkedin.'" target="_blank" class="fa fa-linkedin"></a>';
	}
	
	
	if(empty($yelp)){
		$yelpLink = "";
	}
	else{
		$yelpLink = '<a href="'.$yelp.'" target="_blank" class="fa fa-yelp"></a>';
	}
	
	if(empty($mortgageMapp)){
		$mortgageMappLink = "";
	}
	else{
		$mortgageMappLink = '<a href="'.$mortgageMapp.'" target="_blank" style="text-decoration:none;border: 0 none;" class="mortgageMapp"><img src="/wp-content/themes/flatroom-child/images/mappapp.png" style="text-decoration:none;border: 0 none;" /></a>';
	}
	
	
	

	$gravity_form_shortcode = '[gravityform id="1" name="Contact" title="false" description="false"]';

	if ( ! $content )
	{
		$content = '
			<a href="http://go-summit.com/" target="_blank">Summit Mortgage Corporation</a> | 
			<a href="http://www.nmlsconsumeraccess.org/entitydetails.aspx/COMPANY/'.$nmls_number.'" target="_blank">NMLS</a> '.$nmls_number.'<br />
			Information is not guaranteed and should be verified. Licensed in CA by the Department of Business Oversight under the Residential Mortgage Act. Questions and concerns may be directed to <a href="mailto:support@go-summit.com">support@go-summit.com</a>. NMLS Consumer Access <a href="http://www.nmlsconsumeraccess.org/entitydetails.aspx/COMPANY/'.$nmls_number.'" target="_blank">www.nmlconsumeraccess.org</a>. 
			'.$custom.'
			<br />
		';
	}

	$return = '
		<h3 id="headContact" class="header-contact fa fa-phone">'.$title.'</h3>
		<div class="clear"></div>
		<div class="contact-thumbnail">
			<img src="'.$image.'" alt="" />
		</div>
		<div class="enquire contact-form">
			<h4 class="title">Inquire</h4>
			<div id="contact-form">
				'.do_shortcode($gravity_form_shortcode).'
			</div>
			<p class="fine-print">
				'.$content.'
				<span>&nbsp;</span>
			</p>
			<div class="footer-social">';
			
			
			
			
			
			if( have_rows('social_media') ):

				// loop through the rows of data
				while ( have_rows('social_media') ) : the_row();
			
					// display a sub field value
					$socialLink = get_sub_field('social_link');
					$socialIcon = get_sub_field('social_icon');
					$socialImage = get_sub_field('social_image');
					$socialLinks;
					
					if(empty($socialImage)){
						$return .= '<a href="'.$socialLink.'" target="_blank" class="fa ' . $socialIcon . '"></a>';
					}
					else{
						$return .= '<a href="'.$socialLink.'" style="text-decoration:none;border: 0 none;" target="_blank"><img src="' . $socialImage . '" style="text-decoration:none;border: 0 none;height:30px;" /></a>';
					}
					/*else{
						$return .= '<a href="'.$socialLink.'" target="_blank">No Image Selected</a>';
					}*/
					
			
				endwhile;
		
			else :
			
				// no rows found
			
			endif;
			
	
	
			
			
			//$facebookLink.$linkenInLink.$yelpLink.$mortgageMappLink.'
			
			$return .= '</div></div>';

	return $return;
}
add_shortcode( 'hub-contact', 'my_contact_shortcode' );




/**
 * calculators
 */
function my_calculators_shortcode ( $attributes, $content )
{
	$return = '
<div class="calculator-widget last">
	<div id="mlcalc" class="fwidget widget_mlcalc">
		<div id="tabs">
			<ul id="tab-nav">
				<li><a href="#mortgage">Mortgage</a></li>
				<li><a href="#loan">Loan</a></li>
			</ul>

			<div class="calculator" id="mortgage">
				'.do_shortcode('[mlcalc default="mortgage_only" size="wide" price="300,000" down="10" mterm="30" rate="4.5" tax="3,000" insurance="1,500" pmi="0.52" language="en"]') . '
			</div>

			<div class="calculator" id="loan">
				'.do_shortcode('[mlcalc default="loan_only" size="wide" price="300,000" down="10" mterm="30" rate="4.5" tax="3,000" insurance="1,500" pmi="0.52" language="en"]') . '
			</div>
		</div> <!-- /tabs -->
	</div>
</div>
';

	return $return;
}
add_shortcode( 'calculators', 'my_calculators_shortcode' );



function hex2rgb ( $colour )
{
    if ( $colour[0] == '#' ) {
            $colour = substr( $colour, 1 );
    }
    if ( strlen( $colour ) == 6 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[1], $colour[2] . $colour[3], $colour[4] . $colour[5] );
    } elseif ( strlen( $colour ) == 3 ) {
            list( $r, $g, $b ) = array( $colour[0] . $colour[0], $colour[1] . $colour[1], $colour[2] . $colour[2] );
    } else {
            return false;
    }
    $r = hexdec( $r );
    $g = hexdec( $g );
    $b = hexdec( $b );
    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}

add_action( 'wp_enqueue_scripts', 'flatroom_scripts_styles_child', 11 );
function flatroom_scripts_styles_child() {
	wp_enqueue_script( 'flatroom-child-jquery-ui', '//code.jquery.com/ui/1.11.0/jquery-ui.js', array(), '1.0.0', false );
	wp_enqueue_script( 'flatroom-child-custom', get_template_directory_uri() . '-child/js/custom.js', array(), '1.0.0', true );
	wp_enqueue_style( 'responsive-child', get_template_directory_uri() . '-child/css/responsive.css', array('responsive', 'flatroom-style') );
}

// Allow shortcodes to be used in widgets
add_filter('widget_text', 'do_shortcode');






/******************************************************************************
    Settings
*******************************************************************************/
function my_customize_register($wp_customize)
{
    
    /* General Settings */
    $wp_customize->add_section('my_settings', array(
        'title'    => __('Custom Settings', 'flatroom'),
        'priority' => 10,
    ));

    // Header background image
    $wp_customize->add_setting('flatroom_settings[header_image]', array(
        'default'           => get_stylesheet_directory_uri() . '/images/header_image.jpg',
        'capability'        => 'edit_theme_options',
        'type'           => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'header_image', array(
        'label'    => __('Header Background Image', 'flatroom'),
        'section'  => 'my_settings',
        'settings' => 'flatroom_settings[header_image]',
        'priority' => 1,
    )));

    //
    $wp_customize->add_setting('flatroom_settings[agent_color]', array(
        'default'     => '#41a3e1',
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'agent_color', array(
        'label'        => __( 'Agent Color', 'flatroom' ),
        'section'    => 'my_settings',
        'settings'   => 'flatroom_settings[agent_color]',
        'priority' 	 => 2
    )));

    //
    $wp_customize->add_setting('flatroom_settings[agent_apply_url]', array(
        'default'     => 'https://secure.web-loans.com/secure.aspx?u=summitmortgage.lendingoutpost.com&lo=12',
        'capability'  => 'edit_theme_options',
        'type'        => 'option',
    ));
    $wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'agent_apply_url', array(
        'label'        => __( 'Apply URL', 'flatroom' ),
        'section'    => 'my_settings',
        'settings'   => 'flatroom_settings[agent_apply_url]',
        'priority' 	 => 3
    )));
}
add_action('customize_register', 'my_customize_register');


function my_css ()
{
	$theme_settings = get_option( "flatroom_settings" );

	$header_image_url = $theme_settings['header_image'];
	$agent_color_hex = $theme_settings['agent_color'];
	$agent_color_rgb = hex2rgb($agent_color_hex);
	$agent_image_prefix = get_stylesheet_directory_uri();
	$agent_image_suffix = trim($agent_color_hex, "#");

	if ( ! file_exists ( get_stylesheet_directory() . '/images/icon-bio-header-'.$agent_image_suffix.'.png' ) )
	{
		$agent_image_suffix = 'default';
	}

	$output="
		<style>
    #site-header,
    .page-template-page-homepage-php #page {
      background-image: url('$header_image_url');
    }
    .page-template-page-homepage-php #main,
    #main .page-header {
     background: $agent_color_hex;
      background: rgb(".$agent_color_rgb['red'].", ".$agent_color_rgb['green'].", ".$agent_color_rgb['blue'].");
      background: rgba(".$agent_color_rgb['red'].", ".$agent_color_rgb['green'].", ".$agent_color_rgb['blue'].", .7);
    }
    .worker-hover {
      background: rgba(".$agent_color_rgb['red'].", ".$agent_color_rgb['green'].", ".$agent_color_rgb['blue'].", 0.5);
    }
     .contact-form .btn,
    .prev-next:hover,
    .btn, .btn:visited, .btn.disabled, .btn[disabled], .btn.disabled:hover, .btn[disabled]:hover,
   
    .sbmButton,
    .worker-image i,
    #contact-form .gform_button {
     background: $agent_color_hex !important;
    }
    #content-wrapper h3.property-title a,
    .testimonials-widget .testimonial-thumbnail:before,
    .property .bottom-box,
    .worker-name,
    .header-calc:before, #sidebar a, .testimonials-widget .testimonial-thumbnail, .testimonials-widget .widget-title:before,
    .header-bio:before,
    .team-widget .widget-title:before,
    .around-town > h3:before,
    .header-contact:before,
    .videos > h3:before,
    .listings > h3:before,
    .entry-title a, .search #main .btn, .calc h4.color,
    .fa:before {
      color: rgb(".$agent_color_rgb['red'].", ".$agent_color_rgb['green'].", ".$agent_color_rgb['blue'].")!important;
    }
   	#site-footer, #site-footer .top-box { background: $agent_color_hex !important; }

		</style>
	";

	echo $output;
}

add_action( 'wp_head', 'my_css' );

//font awesome fonts not loading
//add_action( 'wp_footer', 'my_css' );




// testimonials widget

function register_testimonials_widget ()
{
	register_widget( 'Testimonials_Widget' );
}
add_action( 'widgets_init', 'register_testimonials_widget' );

class Testimonials_Widget extends WP_Widget
{
	public function Testimonials_Widget ()
	{
		$widget_ops = array( 'classname' => 'testimonials-widget', 'description' => __('The testimonials widget', 'testimonials') );
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'testimonials-widget' );
        $this->WP_Widget( 'testimonials-widget', __('Testimonials Widget', 'testimonials'), $widget_ops, $control_ops );
	}

	public function widget ( $args, $instance )
	{
		extract($args);

		$title = 'Testimonials';
		$content = $instance['content'];
		
		$pos = strpos($before_title, '">');
		$before_title = substr_replace($before_title, ' fa fa-comments', $pos, 0);

		echo $before_widget;

		// Display the widget title 
		if ( $title )
		{
			echo $before_title . $title . $after_title;
		}

		//Display the name 
		if ( $content )
		{
			echo $content;
		}

		echo $after_widget;
	}

	public function update ( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		$instance['content'] = $new_instance['content'];

		return $instance;
	}

	public function form ( $instance )
	{
		//Set up some default widget settings.
		$defaults = array( 'title' => __('Testimonials', 'testimonials'), 'content' => __('The content', 'testimonials') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<textarea id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" rows="16" cols="20" style="width:100%;"><?php echo $instance['content']; ?></textarea>
		</p>

		<?php
	}
}






// team widget

function register_team_widget ()
{
	register_widget( 'Team_Widget' );
}
add_action( 'widgets_init', 'register_team_widget' );

class Team_Widget extends WP_Widget
{
	public function Team_Widget ()
	{
		$widget_ops = array( 'classname' => 'team-widget', 'description' => __('The team widget', 'team') );
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'team-widget' );
        $this->WP_Widget( 'team-widget', __('Team Widget', 'team'), $widget_ops, $control_ops );
	}

	public function widget ( $args, $instance )
	{
		extract($args);

		$title = $instance['title'];
		$content = $instance['content'];

		$pos = strpos($before_title, '">');
		$before_title = substr_replace($before_title, ' fa fa-users', $pos, 0);

		echo $before_widget;

		// Display the widget title 
		if ( $title )
		{
			echo $before_title . $title . $after_title;
		}

		//Display the name 
		if ( $content )
		{
			echo $content;
		}

		echo $after_widget;
	}

	public function update ( $new_instance, $old_instance )
	{
		$instance = $old_instance;

		$instance['title'] = $new_instance['title'];
		$instance['content'] = $new_instance['content'];

		return $instance;
	}

	public function form ( $instance )
	{
		// Set up some default widget settings.
		$defaults = array( 'title' => __('Your Team', 'team'), 'content' => __('The content', 'team') );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<input type="text" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" style="width:100%;" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<textarea id="<?php echo $this->get_field_id( 'content' ); ?>" name="<?php echo $this->get_field_name( 'content' ); ?>" rows="16" cols="20" style="width:100%;"><?php echo $instance['content']; ?></textarea>
		</p>

		<?php
	}
}



//Allow SVG support

function cc_mime_types($mimes){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');


?>