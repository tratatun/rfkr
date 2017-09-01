$(function(){
	$(document).on('click', '.subheader__search', function(){
		GLOBALS.$body.addClass('open-search');
	});

	$(document).on('click', '.close__icon', function(){
		GLOBALS.$body.removeClass('open-search');
	})
});