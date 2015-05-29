<?php //noo_get_layout( 'footer', 'widgetized' ); ?>

<div class="noo-vc-row row footerTop" style="margin-right:0px;margin-left:0px;">

<div class="noo-vc-col col-md-3 col-sm-6 foot1">
	<div class="wpb_raw_code wpb_content_element wpb_raw_html" style="margin-bottom: 0px;">
		<div class="wpb_wrapper">
			<div id="footerFirst" style="height: 431px; background: url(<?php echo get_post_meta(7293, "Footer_Img1", true); ?>) 50% 50% / cover no-repeat;"></div>
		</div> 
	</div> </div>
<div class="noo-vc-col col-md-3 col-sm-6 foot2" style="height: 431px;">
	<div class="wpb_raw_code wpb_content_element wpb_raw_html">
		<div class="wpb_wrapper">
			<div id="whoWeAreCont">
<div id="whoWeAreTitle">About</div>
<div id="whoWeAreText">Cindy Brown, SIOR is the founder and Managing Principal broker of Commercial Quest NW., a locally owned commercial real estate company based in Portland Oregon. Cindy has been actively involved in commercial real estate brokerage since 1997, selling and leasing commercial and industrial property throughout the Portland metro area. <a href="http://cqnw.bydesignhub.wpengine.com/agents/cindy/"><span id="learnMore">Learn more <i class="fa fa-arrow-circle-o-right"></i></span></a></div>
</div>
		</div> 
	</div> </div>
<div class="noo-vc-col col-md-3 col-sm-6 foot3">
	<div class="wpb_raw_code wpb_content_element wpb_raw_html" style="margin-bottom: 0px;">
		<div class="wpb_wrapper">
			<div id="footerThird" style="height: 431px; background: url(<?php echo get_post_meta(7293, "Footer_Img2", true); ?>) 50% 50% / cover no-repeat;"></div>
		</div> 
	</div> </div>
<div class="noo-vc-col col-md-3 col-sm-6 foot4"><div class="noo-text-block">
<div id="contactFooter" style="height: 431px;">
<div id="getInTouch">Get in touch</div>
<table>
<tbody>
<tr id="addressFooter">
<td id="addressIconFooter"><i class="fa fa-map-marker"></i></td>
<td id="addressFooterText"><span style="white-space: nowrap;">15220 NW LAIDLAW ROAD,</span><br>
<span style="white-space: nowrap;">SUITE 270</span><br>
<span style="white-space: nowrap;">PORTLAND, OR 97229</span></td>
</tr>
<tr id="phoneFooter">
<td id="phoneIconFooter"><i class="fa fa-phone"></i></td>
<td id="phoneFooterNumber"><a href="tel:+15034524000">(503) 452 4000</a></td>
</tr>
<tr id="emailFooter">
<td id="emailIconFooter"><i class="fa fa-envelope-o"></i></td>
<td id="emailFooterAddress"><a href="mailto:info@cqnwre.com">info@cqnwre.com</a></td>
</tr>
</tbody>
</table>
<div id="firstFooter">Be the first to know<div class="wpcf7" id="wpcf7-f7257-p6403-o1" lang="en-US" dir="ltr">
<div class="screen-reader-response"></div>
<form name="" action="/#wpcf7-f7257-p6403-o1" method="post" class="wpcf7-form" novalidate>
<div style="display: none;">
<input type="hidden" name="_wpcf7" value="7257">
<input type="hidden" name="_wpcf7_version" value="4.0.3">
<input type="hidden" name="_wpcf7_locale" value="en_US">
<input type="hidden" name="_wpcf7_unit_tag" value="wpcf7-f7257-p6403-o1">
<input type="hidden" name="_wpnonce" value="f9970509ca">
</div>
<p><span id="emailForm"><span class="wpcf7-form-control-wrap your-email"><input type="email" name="your-email" value="" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email" aria-required="true" aria-invalid="false" placeholder="Email address"></span></span><span id="emailButton"><input type="submit" value="&#xf054" class="wpcf7-form-control wpcf7-submit" id="footerEmailButton"><img class="ajax-loader" src="http://cqnw.bydesignhub.wpengine.com/wp-content/plugins/contact-form-7/images/ajax-loader.gif" alt="Sending ..." style="visibility: hidden;"></span></p>
<div class="wpcf7-response-output wpcf7-display-none"></div></form></div></div>
</div>

</div></div>
</div>
<?php
	$image_logo = noo_get_image_option( 'noo_bottom_bar_logo_image', '' );
	$noo_bottom_bar_content = noo_get_option( 'noo_bottom_bar_content', '' );
?>
<?php if ( $image_logo || $noo_bottom_bar_content ) : ?>
	<footer class="colophon site-info" role="contentinfo">
		<div class="container-full">
			<?php if ( $noo_bottom_bar_content != '' || $noo_bottom_bar_social ) : ?>
			<div class="footer-more">
				<div class="container-boxed max">
					<div class="row">
						<div class="col-md-6">
						<?php if ( $noo_bottom_bar_content != '' ) : ?>
							<div class="noo-bottom-bar-content">
								<?php echo $noo_bottom_bar_content; ?>
							</div>
						<?php endif; ?>
						</div>
						<div class="col-md-6 text-right">
						<?php if ( $image_logo ) : ?>
							<?php
								echo '<img src="' . $image_logo . '" alt="' . get_bloginfo( 'name' ) . '">';
							?>
						<?php endif; ?>
						</div>
						
					</div>
				</div>
			</div>
			<?php endif; ?>
		</div> <!-- /.container-boxed -->
	</footer> <!-- /.colophon.site-info -->
<?php endif; ?>
</div> <!-- /#top.site -->
<?php wp_footer(); ?>
</body>
</html>


<script>

jQuery(document).ready(function($) {	
	
	//change content based on view - address or area.
	var propView = $(".properties-header .properties-toolbar .selected").attr("data-mode");
	if(typeof propView != 'undefined'){
		if(propView.indexOf("list") >= 0){
			$(".size.grid").css("display","none");
			$(".size.list").css("display","block");
		}
		else if(propView.indexOf("grid") >= 0){
			$(".size.list").css("display","none");
			$(".size.grid").css("display","block");
		}
	}
	
	//listen for changes to the view, and change content accordingly
	$(".properties-header .properties-toolbar a").not(".properties-header .properties-toolbar .properties-ordering a").click(function(){
		var newPropView = $(this).attr("data-mode");
		
		if(newPropView.indexOf("list") >= 0){
			$(".size.grid").css("display","none");
			$(".size.list").css("display","block");
		}
		else if(newPropView.indexOf("grid") >= 0){
			$(".size.list").css("display","none");
			$(".size.grid").css("display","block");
		}
		
	});
	
	
	
	
	
	//$(window).trigger('resize');
	//var carousel = $(".caroufredsel-wrap");
	//carousel.parent().add(carousel).height(carousel.children().first().height());

        $('.calling-desc').find('a').each(function() {
            var Text = $(this).attr("href");
            Text = Text.toLowerCase();
            Text = Text.replace(/[\s]+/g,'').replace(/[()]/g,''); //remove "(" and ")"
            $(this).attr("href", Text);      
    	});

	$(".whyUsButton").wrap("<div class='buttonWrapper'></div>").css({"display":"inline"});

	$(".homeSearch").find("button").text("SEARCH").css({"display":"inline"});

	$(".container-boxed").wrap("<div class='containerWrapper'></div>");

	$("#footerLeft").parent().parent().removeClass("col-md-6").addClass("col-md-12");

	$("#addressIconFooter").html('<i class="fa fa-map-marker"></i>');
	$("#phoneIconFooter").html('<i class="fa fa-phone"></i>');
	$("#emailIconFooter").html('<i class="fa fa-envelope-o"></i>');

	$("#footerThird").parent().parent().css({"margin-bottom":"0"});
	$("#footerFirst").parent().parent().css({"margin-bottom":"0"});
	
	//rename search fields 
	$(".gtype").find(".gtype-label").text("Property Type");
	$(".gsub-location").find(".glocation-label").text("Submarket"); 
	$(".glocation").find(".glocation-label").text("Cities"); 
	
	
	$(".service-icon i").wrap("<a href='/why-us/'></a>");
	
	
	//hover color
	
	$(".hentry .property-summary .property-info .property-action a").each(function(){
	var linkH = $(this).parent().height() - 20 + "px";
	$(this).height(linkH);
	$(this).css("line-height",linkH);
  
  })
  
  /*
  $(".recent-properties .recent-properties-content .property-row .hentry .property-summary .property-info .property-action").hover(function(){
	$(this).animate({backgroundColor: '#b22525'}, 1000);
	$(this).find("a").animate({backgroundColor: '#b22525'}, 1000);
	
	$(this).animate({backgroundColor: '#b18e3c'}, 1000);
  	$(this).find("a").animate({backgroundColor: '#b18e3c'}, 1000);
  
  })
  */
	

	$(window).on("resize", function () {

		if($(window).width() > 767){

		var whoHeight = $("#whoWeAreCont").parent().parent().parent().height();
		var getHeight = $("#getInTouch").parent().parent().parent().height();

		var newHeight;

		if(whoHeight > getHeight){newHeight=whoHeight}
		else if(whoHeight < getHeight){newHeight=getHeight}
		else{newHeight=whoHeight}

		$("#footerFirst").css({"height":newHeight, "background-position":"center center"});
		$("#footerThird").css({"height":newHeight, "background-position":"center center"});
		$("#whoWeAreCont").parent().parent().parent().css({"height":newHeight});

		$("#contactFooter").css({"height":newHeight});
	
		}

		else{

		$("#footerFirst").css({"height":"400px", "background-position":"center center"});
		$("#footerThird").css({"height":"400px", "background-position":"center center"});

		}

	}).resize();

	/*$('.navbar-header a').click(function(event){
    		event.preventDefault();
	});*/

	$("noo-logo-normal").addClass("img-responsive");
	
	$(".properties-content .property-category a:not(:last-of-type)").after(" / ");
	
	if ($("body").hasClass("term-lease")){
		$(".property-label.sold").html("LEASED");
	};
	
	
	var leaseFound;
	$('.col-sm-7.detail-field-value').each(function() {
		var $this = $(this);
		if ($this.find('a').length > 1) {
			$this.find('a:not(:last-of-type)').after(" / ");
		}
		$this.find('a').each(function () {
			if ($(this).text() == 'Lease') {
				leaseFound = "1";

				
			}
			else if($(this).text() == 'Sold'){
				if (leaseFound == "1") {
					$(this).text("Leased");
					$(".images .caroufredsel_wrapper").after('<span class="property-label sold addedLabel">LEASED</span>');
				}
				else{
					$(".images .caroufredsel_wrapper").after('<span class="property-label sold addedLabel">SOLD</span>');
				}
				
	
			}
		});
	});
	
	
	
	$('cite.fn').each(function () {
		if ($(this).text() == 'blabla') {
			$(this).css('color', 'red');
		}
	});


	
	
	//testimonial div size
	/*
	(function() {
		var ev = new $.Event('style'),
			orig = $.fn.css;
		$.fn.css = function() {
			$(this).trigger(ev);
			return orig.apply(this, arguments);
		}
	})();
	
	$('.testimonial-slide .caroufredsel_wrapper').bind('style', function(e) {
		console.log( $(this).attr('style') );
		myStr = $(this).attr('style');
		var subStr = myStr.match("height: (.*)px;");
		
		var newH = subStr[1].substring(0, 3) + "px"; //3 digit number
		console.log(newH);
		
			$('.testimonial-slide').height(newH);
		

	});
*/

	
	window.onload = function(){
		
		/*
			
		var thumbHeight = $(". recent-properties-slider .caroufredsel_wrapper").find(".property-featured img").first().height();
	
		console.log("height now is eq = " + thumbHeight);
		
		$("recent-properties-slider .caroufredsel_wrapper").css({"height":thumbHeight*2});
		$("recent-properties-slider .caroufredsel_wrapper ul").css({"height":thumbHeight*2});
		
		$("recent-properties-slider .caroufredsel_wrapper .property-featured img").css({"display":"inline"});
		*/
			
	}

});

</script>
