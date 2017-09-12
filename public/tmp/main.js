'use strict';
var GLOBALS = {
	$body: $('body'),
	$header: $('.headers-container'),
	$mainCarousel: $('.main-block__carousel'),
	$mainCarouselPrevBtn: $('.carousel-arrow_prev'),
	$mainCarouselNextBtn: $('.carousel-arrow_next'),
	$searchContainer: $('.search-container'),
	$newsImageCarousel: $('.carousel-news-image'),
	$newsImageCarouselPrevBtn: $('.carousel-news-image .slick-prev'),
	$newsImageCarouselNextBtn: $('.carousel-news-image .slick-next'),
	VISIBLE_CLASS: 'visible',
	INVISIBLE_CLASS: 'invisible',
	OPEN_CLASS: 'open'
};;$(function(){
	var $searchBlock = $('.search-container');

	$(document).on('click', '.subheader__search', function(){
		$searchBlock.addClass('open');
	});

	$(document).on('click', '.close__icon', function(){
		$searchBlock.removeClass('open');
	});

	CKEDITOR.replace( 'editor' );
});;$(function(){
	GLOBALS.$mainCarousel.slick({
		arrows: false,
		infinite: false
	});

	var currentCarouselSlide = GLOBALS.$mainCarousel.slick('slickCurrentSlide');
	if(currentCarouselSlide === 0){
		doInactiveCarouselBtn(GLOBALS.$mainCarouselPrevBtn);
	}

	$(document).on('click', '.carousel-arrow_prev', function(){
		clickCarouselPrev(GLOBALS.$mainCarousel, GLOBALS.$mainCarouselNextBtn, GLOBALS.$mainCarouselPrevBtn);
	});

	$(document).on('click', '.carousel-arrow_next', function(){
		clickCarouselNext(GLOBALS.$mainCarousel, GLOBALS.$newsImageCarouselNextBtn, GLOBALS.$newsImageCarouselPrevBtn);
	});

	GLOBALS.$mainCarousel.on('afterChange', function(event, slick, currentSlide, nextSlide){
		if(currentSlide === 0){
			doInactiveCarouselBtn(GLOBALS.$mainCarouselPrevBtn);
		} else {
			doActiveCarouselBtn(GLOBALS.$mainCarouselPrevBtn);
		}

		if(currentSlide === GLOBALS.$mainCarousel.find('.carousel__slide').length - 1){
			doInactiveCarouselBtn(GLOBALS.$mainCarouselNextBtn);
		} else {
			doActiveCarouselBtn(GLOBALS.$mainCarouselNextBtn);
		}
	});

	GLOBALS.$newsImageCarousel.slick({
		arrows: true,
		infinite: false,
		asNavFor: '.carousel-news',
	});

	$('.carousel-news').slick({
		arrows: false,
		infinite: false,
		dots: true,
		asNavFor: '.carousel-news-image'
	});



	function doActiveCarouselBtn(btnSelector){
		btnSelector.removeClass('inactive');
	}

	function doInactiveCarouselBtn(btnSelector){
		btnSelector.addClass('inactive');
	}

	function clickCarouselPrev(carousel, nextBtn, prevBtn){
		carousel.slick('slickPrev');
		var currentSlide = carousel.slick('slickCurrentSlide');

		if(nextBtn.hasClass('inactive')){
			doActiveCarouselBtn(nextBtn);
		}

		if(currentSlide === 0){
			doInactiveCarouselBtn(prevBtn);
			return false;
		} else {
			doActiveCarouselBtn(prevBtn);
		}
	}

	function clickCarouselNext(carousel, nextBtn, prevBtn){
		carousel.slick('slickNext');
		var currentSlide = carousel.slick('slickCurrentSlide');

		if(currentSlide > 0){
			doActiveCarouselBtn(prevBtn);
		}
		if(currentSlide === carousel.find('.carousel__slide').length - 1){
			doInactiveCarouselBtn(nextBtn);
			return false;
		} else {
			doActiveCarouselBtn(nextBtn);
		}
	}
});;$(function(){
	addedBgHeader();

	$(window).scroll(function(){
		addedBgHeader();
	});

	$('.news-container').niceScroll({cursorcolor:"#8ecdff", grabcursorenabled: false});
	$('.content-block').niceScroll({cursorcolor:"#8ecdff", grabcursorenabled: false});

	$('.animate-anchor').click(function(){
		var $this = $(this),
			anchor = $this.attr('data-id'),
			$scrollToBlock = $(anchor);

		$scrollToBlock.animatescroll({
			scrollSpeed: 1500
		});
	});

	function addedBgHeader(){
		var scrollValue = $(document).scrollTop();
		scrollValue > 40 ? GLOBALS.$header.addClass('scrolled') : GLOBALS.$header.removeClass('scrolled');
	}
});;$(function(){
	$("select").minimalect({
		placeholder: 'Не выбрано'
	});

	// $.validator.addMethod("checkSelect", function(value, element) {
	// 	var $selectedOption = $(element).closest('.form-group').find('.minict_wrapper').find('li.selected');
	// 	if($selectedOption){
	// 		$(element).parents(".error").removeClass(errorClass).addClass(validClass);
	// 	}
	// });

	$('.message-send__form').validate({
		highlight: function(element, errorClass, validClass) {
			$(element).closest('.form-group').addClass(errorClass).removeClass(validClass);
			$('.message-send__form').addClass(errorClass).removeClass(validClass);
		},
		unhighlight: function(element, errorClass, validClass) {
			$(element).parents(".error").removeClass(errorClass).addClass(validClass);
		},
		rules: {
			firstname: {
				required: true,
				minlength: 2
			},
			lastname: {
				required: true,
				minlength: 2
			},
			address: {
				required: true,
				minlength: 10
			},
			email: {
				required: true,
				email: true
			},
			message: {
				required: true
			},
			thematic: {
				required: true
			}
		}
	});
});;$(function(){
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

;$(function(){
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
});;$(function(){
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