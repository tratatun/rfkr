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
			thisHref = $this.attr('href');
		console.log(thisHref);
		GLOBALS.$body.find(thisHref).addClass('open').animate({ height: 'auto', overflow: 'visible' }, 300)
	});
});