$(function(){
	$(document).on('click', '.subheader__search', function(){
		GLOBALS.$body.addClass('open-search');
	});

	$(document).on('click', '.close__icon', function(){
		GLOBALS.$body.removeClass('open-search');
	});

	$('.toogle').click(function(e){
		e.preventDefault();
		var $this = $(this),
			thisHref = $this.attr('href'),
			$currentToogle = $(thisHref);

		if($currentToogle.hasClass('open')){
			$currentToogle.removeClass('open').removeAttr('style');
			return false;
		}

		var $currentToogleHeight = $currentToogle.css('height', 'auto').outerHeight();
		$currentToogle.css("height",$currentToogleHeight).addClass('open');
	});
});