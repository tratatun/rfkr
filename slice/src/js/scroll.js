$(function(){
	$(window).scroll(function(){
		var scrollValue = $(document).scrollTop();
		scrollValue > 40 ? GLOBALS.$header.addClass('scrolled') : GLOBALS.$header.removeClass('scrolled');
	});

	$('.news-container').niceScroll({cursorcolor:"#8ecdff"});
	$('.content-block').niceScroll({cursorcolor:"#8ecdff"});
});