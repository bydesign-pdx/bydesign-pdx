jQuery(document).ready(function($){

	$("#switcher-head a").click(function(event){
		event.stopPropagation();
	});

	// Open/hide switcher panel
	$("#switcher-head").click(function(){
		if( $(this).hasClass("open") ) {
			$("#style-switcher").animate({
				left: 0
			}, 500);
			$(this).removeClass("open");
		} else {
			$("#style-switcher").animate({
				left: -212
			}, 500);			
			$(this).addClass("open");
		}
	});

	$("#image-bg a").click(function(){
		$("#image-bg a").removeClass("active");
		var bg_image = $(this).attr('data-value');
		$(this).addClass("active");
		$("input#image_bg").val(bg_image);
		$("input#pattern_bg").val(0);
	});

	$("#pattern-bg a").click(function(){
		$("#pattern-bg a").removeClass("active");
		var bg_pattern = $(this).attr('data-value');
		$(this).addClass("active");
		$("input#pattern_bg").val(bg_pattern);
		$("input#image_bg").val(0);
	});
	
});