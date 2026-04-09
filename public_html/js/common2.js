$(function(){

	var winW;
	var device;

	function winSize(){
		winW = window.innerWidth;//스크롤포함
	}winSize();

	function menuOpen(){
		if( winW <= 1024 ){
			device = "m";
			$('#pc_all_btn').removeClass('on');
			$('#pc_all_btn').attr('title', '전체메뉴 열기');
			$('#pc_all_menu').fadeOut(300);
		}else{
			device = "p";
			$('#m_all_btn').removeClass('on');
			$('#m_all_btn').attr('title', '전체메뉴 열기');
			$('#m_all_menu, #all_dummy').fadeOut(300);
		}	
	}menuOpen();

	$(window).resize(function(){
		winSize();
		menuOpen();
	});

	// 전체메뉴 및 모바일 메뉴 클릭 이벤트는 thema/Basic/shop.tail.php 에서 통합 관리합니다. (중복 바인딩 방지)
	/*
	$('#pc_all_btn').click(...);
	$('#m_all_btn').click(...);
	$('#all_dummy').click(...);
	*/

	$('#m_all_menu .dep1_a').click(function(){
		var dep2S = $(this).siblings('ul').length;
		if(dep2S > 0){
			if($(this).parent('li').hasClass('on')){
				$('#m_all_menu .dep1_li').removeClass('on');
				$('#m_all_menu .dep2_ul').slideUp(300);
			}else{
				$('#m_all_menu .dep1_li').removeClass('on');
				$('#m_all_menu .dep2_ul').slideUp(300);
				$(this).parent('li').addClass('on');
				$(this).siblings('ul').stop().slideDown(300);	
			}
			return false
		}
	});

	//모바일 검색
	$('#search_m').click(function(){
		$(this).toggleClass('on');
		$('#search_modal').fadeToggle(300);
	});

	//탑버튼
	$('#top_btn').click(function(){
		$('body, html').animate({ scrollTop : 0 }, 500);
	});

	//모바일 path
	$('.m_path_dep1 > a').click(function(){
		$(this).parent('li').toggleClass('on');
		$('.m_path_dep2_ul').slideToggle(300);
		return false
	});

});