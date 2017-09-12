$(function(){
	var $searchBlock = $('.search-container');

	$(document).on('click', '.subheader__search', function(){
		$searchBlock.addClass('open');
	});

	$(document).on('click', '.close__icon', function(){
		$searchBlock.removeClass('open');
	});

	if(GLOBALS.$body.find('#editor').length){
		CKEDITOR.replace( 'editor' );
	}

});