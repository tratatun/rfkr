$(function(){
	addedBgHeader();

	$(window).scroll(function(){
		addedBgHeader();
	});

	$('.news-container').niceScroll({cursorcolor:"#8ecdff", grabcursorenabled: false});
	$('.content-block').niceScroll({cursorcolor:"#8ecdff", grabcursorenabled: false});

	$('.animate-anchor').click(function(){
		var $this = $(this),
			anchor = $this.attr('data-id'),
			$scrollToBlock = $(anchor);

		$scrollToBlock.animatescroll({
			scrollSpeed: 1500
		});
	});

	function addedBgHeader(){
		var scrollValue = $(document).scrollTop();
		scrollValue > 40 ? GLOBALS.$header.addClass('scrolled') : GLOBALS.$header.removeClass('scrolled');
	}
});