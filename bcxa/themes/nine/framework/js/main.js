jQuery(document).ready(function($){

/*  Menus
    ------------------------------------------------------- */
	
	$("#header nav > ul > li").each(function(){
		if($("ul", this).size()) $(this).addClass("dd");
	});

	var navigation = responsiveNav("#nav", { // Selector: The ID of the wrapper
		animate: true, // Boolean: Use CSS3 transitions, true or false
		transition: 400, // Integer: Speed of the transition, in milliseconds
		label: "Menu", // String: Label for the navigation toggle
		insert: "before", // String: Insert the toggle before or after the navigation
		customToggle: "", // Selector: Specify the ID of a custom toggle
		openPos: "relative", // String: Position of the opened nav, relative or static
		jsClass: "js", // String: 'JS enabled' class which is added to <html> el
		init: function(){}, // Function: Init callback
		open: function(){}, // Function: Open callback
		close: function(){} // Function: Close callback
	});


/*  Flexslider
    ------------------------------------------------------- */
	
	if($().flexslider && typeof slider_speed != 'undefined' && typeof slider_effect_speed != 'undefined') {

		$(".flexslider").not("#main-slider .flexslider").flexslider({
			controlNav: false,
			slideshowSpeed: slider_speed,
			animationSpeed: slider_effect_speed,
		});

		$("#main-slider .flexslider").flexslider({
			slideshowSpeed: slider_speed,
			animationSpeed: slider_effect_speed,
			start: function(slider) {

				$("#main-slider .slides > li").each(function(){

					$(".cap-container > div", this).each(function(){
						effect_in = $(this).attr("data-effect-in");
						effect_out = $(this).attr("data-effect-out");

						$(this).addClass("animated " + effect_in);
					});

				});
			},
			before: function(slider) {
				current_slide = $("#main-slider .slides > li").eq(slider.currentSlide);

				$(".cap-container > div", current_slide).each(function(){
					effect_in = $(this).attr("data-effect-in");
					effect_out = $(this).attr("data-effect-out");

					$(this).removeClass("animated " + effect_in).addClass("animated " + effect_out);
				});
			},
			after: function(slider) {
				current_slide = $("#main-slider .slides > li").eq(slider.currentSlide);

				$(".cap-container > div", current_slide).each(function(){
					effect_in = $(this).attr("data-effect-in");
					effect_out = $(this).attr("data-effect-out");

					$(this).removeClass("animated " + effect_out).addClass("animated " + effect_in);
				});
			}
		});

	}



/*  Accordion
    ------------------------------------------------------- */	
	
	// Accordion
	$('.accordion-title').click(function() {
		$('.accordion-title').removeClass('a-open');
		$('.accordion-content').slideUp(200);
		if($(this).next().is(':hidden') == true) {
			$(this).addClass('a-open');
			$(this).next().slideDown(200);
		}
	});
	$('.accordion-content').hide();

	$('.accordion').each(function(){
		open_tab = $(this).attr('rel') - 1;
		if( open_tab != 0) {
			group = $('.accordion-group:eq(' + open_tab + ')', this);

			$('.accordion-title', group).addClass('a-open');
			$('.accordion-content', group).show();
		}
	});

	$("[rel=tooltip]").tooltip();


/*  Isotope Filter
    ------------------------------------------------------- */

	if( $().isotope ) {

		var $container = $('#filterable-portfolio');
	
	    $container.imagesLoaded(function () {
    	    $container.isotope({
        	    itemSelector: '.p-item',
            	layoutMode: 'fitRows'
        	});
    	});
	
    	$('#filter li a').click(function(event) {

    		event.preventDefault();

    		$('.active', '#filter').removeClass('active');
    		$(this).parent('li').addClass('active');

        	var selector = $(this).attr('data-filter');
        	$container.isotope({
            	filter: selector
        	});

        	$(window).resize();

		});

       	$(window).resize(function() {
       		$container.isotope('reLayout');
       	});

	}


/*  Lightbox (Colorbox plugin)
    ------------------------------------------------------- */

	if($().colorbox) {

		/* catch carousel and gallery images for ColorBox */
		$("#page-body ul").each(function(){
			/*gallery_id = Math.floor(Math.random()*1001);
			$("a[href$='.jpg'], a[href$='.png'], a[href$='.gif']", this).attr("data-gallery", 1).colorbox({
				rel: gallery_id,
				transition: "elastic"
			});*/
		});

		/* catch alone images for ColorBox */
		$("a[href$='.jpg'], a[href$='.png'], a[href$='.gif']").each(function(){
			if(!$(this).attr("data-gallery")){
				$(this).colorbox({
					transition: "elastic"
				});
			}
		});

		/* catch video for ColorBox */
		$("a[href*='youtube.com'], a[href*='vimeo.com']").not(".i-small a, .i-large a").each(function(){
			if(!$(this).attr("data-gallery")){
				$(this).colorbox({
					iframe:true,
					innerWidth:425,
					innerHeight:344,
					transition: "elastic"
				});
			}
		});

	}


/*  Fix Accent Columns Height
    ------------------------------------------------------- */

	$.fixFooterBlock = function() {

		special_section = $(".accent-col > div:first-child");

		$(special_section).height("auto");

		footer_height = $("#footer > .container").height();

		ss_height = $(special_section).height();
		ss_inner_height = $(special_section).innerHeight();

		ss_new_height = footer_height - (ss_inner_height - ss_height);

		$(special_section).height(ss_new_height);

	}

	$.fixFooterBlock();

	$(window).resize(function(){
		$.fixFooterBlock();
	});


/*  Carousel
    ------------------------------------------------------- */

	$('.clients-carousel').jcarousel({
		wrap: 'circular'
	}).jcarouselAutoscroll({
    	'target': '+=1',
    	'interval': 10000
	});

	$('.sc_posts .recent-posts').jcarousel({
		wrap: 'circular'
	});

	$('.sc_posts .prev').click(function(event) {
		event.preventDefault();
	    $('.sc_posts .recent-posts').jcarousel('scroll', '-=1');
	});
	$('.sc_posts .next').click(function(event) {
		event.preventDefault();
	    $('.sc_posts .recent-posts').jcarousel('scroll', '+=1');
	});


/*  Form Submit Fix
    ------------------------------------------------------- */

	$(".form-submit").prepend("<span></span>");


/*  Fit Videos
    ------------------------------------------------------- */

	$(".video-embed, .embed_code, #portfolio-video, .thumbnail, .cap-media, .video-thumb").fitVids();


});


jQuery(window).bind("load", function() {

	if(jQuery().sticky) {
	    if( jQuery("body").hasClass("admin-bar") ) {
	    	jQuery("#sticky-nav").delay(1000).sticky({topSpacing:28});
		} else {
	    	jQuery("#sticky-nav").delay(1000).sticky({topSpacing:0});
		}
	}

});