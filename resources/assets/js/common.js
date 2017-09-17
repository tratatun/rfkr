$(function(){
	var $searchBlock = $('.search-container');

	$(document).on('click', '.subheader__search', function(){
		$searchBlock.addClass('open');
	});

	$(document).on('click', '.close__icon', function(){
		$searchBlock.removeClass('open');
	});

	$('#editor').ckeditor();

});