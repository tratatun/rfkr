$(function(){
	$('a[data-role="toogle"]').click(function(e){
		e.preventDefault();
		var $this = $(this),
			$currentToogleBody = $this.closest('.toogle').find('.toogle__body');
		if($currentToogleBody.hasClass('open')){
			$currentToogleBody.removeClass('open');
			$currentToogleBody.slideUp(400);
		} else {
			$currentToogleBody.addClass('open');
			$currentToogleBody.slideDown(400);
		}
	});
});