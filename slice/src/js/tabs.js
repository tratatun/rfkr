$(function(){
	$('.tabs-switch').click(function(e){
		e.preventDefault();
		var $this = $(this),
			tabsSwitchHref = $this.attr('href'),
			$currentTab = $(tabsSwitchHref);
		$this.closest('.tabs').find('.tabs-switch').removeClass('active')
		$this.addClass('active');
		$this.closest('.tabs').find('.content__pane').removeClass(GLOBALS.VISIBLE_CLASS)
		$currentTab.addClass(GLOBALS.VISIBLE_CLASS);
	});
});