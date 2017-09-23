$(function(){
	var $searchBlock = $('.search-container');

	$(document).on('click', '.subheader__search', function(){
		var scrollValue = $(document).scrollTop();

		$searchBlock.addClass('open');

		if(scrollValue  === 0){
			GLOBALS.$header.addClass('scrolled');
		}
	});

	$(document).on('click', '.close__icon', function(){
		var scrollValue = $(document).scrollTop();

		$searchBlock.removeClass('open');

		if(scrollValue  === 0){
			GLOBALS.$header.removeClass('scrolled');
		}
	});

	$('#editor').ckeditor();

});