(function($){
$(document).ready(function() {
    $('#loginform input[type="text"]').attr('placeholder', 'Username *');
    $('#loginform input[type="password"]').attr('placeholder', 'Password *');
    $('#registerform #user_login').attr('placeholder', 'Username *');
    $('#registerform #user_email').attr('placeholder', 'E-mail *');
    
    //Checkbox
	$('input[type="checkbox"]').wrap('<div class="new-checkbox"></div>');
	$('.new-checkbox').append('<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20" xml:space="preserve"><polygon fill="#41A3E1" points="9.298,13.391 4.18,9.237 3,10.079 9.297,17 17.999,4.678 16.324,3 "/></svg>');
	$('input[type="checkbox"]:checked, input[type="radio"]:checked').parent('.new-checkbox').addClass('checked');
		$('html').click(function(){
		$('input[type="checkbox"]').parent('.new-checkbox').removeClass('checked');
		$('input[type="checkbox"]:checked').parent('.new-checkbox').addClass('checked');
		$('input[type="checkbox"]').parent().removeClass('disabled');
		$('input[type="checkbox"]:disabled').parent().addClass('disabled');
	});
});
})(jQuery);