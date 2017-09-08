$(function(){
	var $addAdminBlock = $('.add-admin'),
		$btnAddAdmin = $('.btn-add-admin'),
		$btnChangeAdmin = $('.change-admin');

	$btnChangeAdmin.find('select').attr('disabled', true);

	$btnAddAdmin.click(function(){
		var $this = $(this);
		removeBtnClasses();
		GLOBALS.$body.find('.btn-control-save').addClass(GLOBALS.VISIBLE_CLASS);
		$this.addClass(GLOBALS.INVISIBLE_CLASS);
		$addAdminBlock.addClass(GLOBALS.OPEN_CLASS).slideDown(400);
	});

	$('.btn-reset_add').click(function(){
		if($addAdminBlock.hasClass(GLOBALS.OPEN_CLASS)){
			closePanelAddAdmin();
		}

		$btnChangeAdmin.removeClass(GLOBALS.OPEN_CLASS).slideUp(400);
		removeBtnClasses();
	});

	$('.btn-change').click(function(){
		if($addAdminBlock.hasClass(GLOBALS.OPEN_CLASS)){
			closePanelAddAdmin();
		}
		$('.change-admin').addClass(GLOBALS.OPEN_CLASS).slideDown(400);
		removeBtnClasses();
		GLOBALS.$body.find('.btn-add-admin').addClass(GLOBALS.INVISIBLE_CLASS);
	});

	function closePanelAddAdmin(){
		removeBtnClasses();
		GLOBALS.$body.find('.btn-add-admin').addClass(GLOBALS.VISIBLE_CLASS);
		GLOBALS.$body.find('.btn-control-save').addClass(GLOBALS.INVISIBLE_CLASS);
		$addAdminBlock.removeClass(GLOBALS.OPEN_CLASS).slideUp(400);
	}

	function removeBtnClasses(){
		GLOBALS.$body.find('.button-container button').removeClass(GLOBALS.VISIBLE_CLASS).removeClass(GLOBALS.INVISIBLE_CLASS);
	}
});

