$(function(){
	$('a[data-role="toogle"]').click(function(e){
		e.preventDefault();
		var $this = $(this),
			thisHref = $this.attr('href'),
			$currentToogleBody = $(thisHref),
			$currentToogle = $this.closest('.toogle');
		if($currentToogle.hasClass('open')){
			$currentToogle.removeClass('open')
			$currentToogleBody.slideUp(400);
		} else {
			$currentToogle.addClass('open');
			$currentToogleBody.slideDown(400);
		}
	});
});