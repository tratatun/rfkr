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

	$('.btn-add-admin').click(function(){
		var $this = $(this);
		GLOBALS.$body.find('.btn-control-add').addClass('visible');
		$this.addClass('invisible');
		$('.add-admin').slideDown(400);
	});

	$('.btn-reset_add').click(function(){
		GLOBALS.$body.find('.btn-add-admin').addClass('visible');
		GLOBALS.$body.find('.btn-control-add').addClass('invisible');
		$('.add-admin').slideUp(400);
	});
});