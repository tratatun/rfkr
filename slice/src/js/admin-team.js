$(function(){
	var $addAdminBlock = $('.add-admin');

	$('.change-admin').find('select').attr('disabled', true);
	console.log(777);

	$('.btn-add-admin').click(function(){
		var $this = $(this);
		GLOBALS.$body.find('.button-container button').removeClass(GLOBALS.VISIBLE_CLASS).removeClass(GLOBALS.INVISIBLE_CLASS);
		GLOBALS.$body.find('.btn-control-save').addClass(GLOBALS.VISIBLE_CLASS);
		$this.addClass(GLOBALS.INVISIBLE_CLASS);
		$addAdminBlock.addClass('open').slideDown(400);
	});

	$('.btn-reset_add').click(function(){
		if($addAdminBlock.hasClass('open')){
			closePanelAddAdmin();
		}

		$('.change-admin').removeClass('open').slideUp(400);
		GLOBALS.$body.find('.button-container button').removeClass(GLOBALS.VISIBLE_CLASS).removeClass(GLOBALS.INVISIBLE_CLASS);

	});

	$('.btn-change').click(function(){
		if($addAdminBlock.hasClass('open')){
			closePanelAddAdmin();
		}
		$('.change-admin').addClass('open').slideDown(400);
		GLOBALS.$body.find('.button-container button').removeClass(GLOBALS.VISIBLE_CLASS).removeClass(GLOBALS.INVISIBLE_CLASS);
		GLOBALS.$body.find('.btn-add-admin').addClass(GLOBALS.INVISIBLE_CLASS);
	});

	function closePanelAddAdmin(){
		GLOBALS.$body.find('.button-container button').removeClass(GLOBALS.VISIBLE_CLASS).removeClass(GLOBALS.INVISIBLE_CLASS);
		GLOBALS.$body.find('.btn-add-admin').addClass(GLOBALS.VISIBLE_CLASS);
		GLOBALS.$body.find('.btn-control-save').addClass(GLOBALS.INVISIBLE_CLASS);
		$addAdminBlock.removeClass('open').slideUp(400);
	}
});

