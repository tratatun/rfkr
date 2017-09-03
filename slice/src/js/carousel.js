$(function(){
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
});