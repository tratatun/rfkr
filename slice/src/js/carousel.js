$(function(){
	GLOBALS.$mainCarousel.slick({
		arrows: false,
		infinite: false
	});

	var currentCarouselSlide = GLOBALS.$mainCarousel.slick('slickCurrentSlide');
	if(currentCarouselSlide === 0){
		doInactivePrevBtn();
	}

	$(document).on('click', '.carousel-arrow_prev', function(){
		GLOBALS.$mainCarousel.slick('slickPrev');
		var currentSlide = GLOBALS.$mainCarousel.slick('slickCurrentSlide');

		if(GLOBALS.$mainCarouselNextBtn.hasClass('inactive')){
			doActiveNextBtn();
		}

		if(currentSlide === 0){
			doInactivePrevBtn();
			return false;
		} else {
			doActivePrevBtn();
		}
	});

	$(document).on('click', '.carousel-arrow_next', function(){
		GLOBALS.$mainCarousel.slick('slickNext');
		var currentSlide = GLOBALS.$mainCarousel.slick('slickCurrentSlide');

		if(currentSlide > 0){
			doActivePrevBtn();
		}
		if(currentSlide === GLOBALS.$mainCarousel.find('.carousel__slide').length - 1){
			doInactiveNextBtn();
			return false;
		} else {
			doActiveNextBtn();
		}
	});

	GLOBALS.$mainCarousel.on('afterChange', function(event, slick, currentSlide, nextSlide){
		if(currentSlide === 0){
			doInactivePrevBtn();
		} else {
			doActivePrevBtn();
		}

		if(currentSlide === GLOBALS.$mainCarousel.find('.carousel__slide').length - 1){
			doInactiveNextBtn();
		} else {
			doActiveNextBtn();
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



	var currentNewsCarouselSlide = GLOBALS.$newsImageCarousel.slick('slickCurrentSlide');
	if(currentNewsCarouselSlide === 0){
		doInactivePrevBtn();
	}




	function doActiveNextBtn(){
		GLOBALS.$mainCarouselNextBtn.removeClass('inactive');
	}

	function doInactiveNextBtn(){
		GLOBALS.$mainCarouselNextBtn.addClass('inactive');
	}

	function doActivePrevBtn() {
		GLOBALS.$mainCarouselPrevBtn.removeClass('inactive');
	}

	function doInactivePrevBtn(){
		GLOBALS.$mainCarouselPrevBtn.addClass('inactive');
	}
});