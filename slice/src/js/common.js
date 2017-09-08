$(function(){
	var $searchBlock = $('.search-container');

	$(document).on('click', '.subheader__search', function(){
		$searchBlock.addClass('open');
	});

	$(document).on('click', '.close__icon', function(){
		$searchBlock.removeClass('open');
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