$(function(){
	
	//메인배너
	var pcSlider = new Swiper("#pc_slider .swiper-container", {
		speed: 1000,
		loop: true,
		loopedSlides: 1,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		pagination: {
			el: "#pc_slider .slider_pagination",
			clickable: true,
		},
		observer: true,
		observeParents: true,
	});

	//메인배너 모바일
	var mSlider = new Swiper("#m_slider .swiper-container", {
		speed: 1000,
		loop: true,
		loopedSlides: 1,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		pagination: {
			el: "#m_slider .slider_pagination",
			clickable: true,
		},
		observer: true,
		observeParents: true,
	});

	//메인 인스타그램
	var mainSlider = new Swiper("#main_insta .swiper-container", {
		slidesPerView: 6,
		spaceBetween: 30,
		speed: 1000,
		loop: true,
		loopedSlides: 6,
		autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},
		breakpoints: {
			1600: {
				slidesPerView: 'auto',
				spaceBetween: 20,
				centeredSlides: true,
			},
			768: {
				slidesPerView: 'auto',
				spaceBetween: 15,
				centeredSlides: true,
			},
		},
		observer: true,
		observeParents: true,
	});

})