$(function(){
	$(document).on('click', '.subheader__search', function(){
		GLOBALS.$body.addClass('open-search');
	});

	$(document).on('click', '.close__icon', function(){
		GLOBALS.$body.removeClass('open-search');
	});

	$(window).scroll(function(){
		var scrollValue = $(document).scrollTop();
		scrollValue > 40 ? GLOBALS.$header.addClass('scrolled') : GLOBALS.$header.removeClass('scrolled');
	});
});