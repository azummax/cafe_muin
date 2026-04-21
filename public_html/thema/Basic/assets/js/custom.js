/*
 *  Amina App 1.0
 *
 *  Copyright (c) 2015 Amina
 *  http://amina.co.kr
 *
 */

(function($) {
	$.fn.amina_menu = function(option) {
        var cfg = { name: '.sub', show: '', hide: '' };

		if(typeof option == "object")
            cfg = $.extend(cfg, option);

		var subname = cfg.name;
		var submenu = $(this).find(subname).parent();

		submenu.each(function(i){
			$(this).hover(
				function(e){
					var targetmenu = $(this).children(subname + ":eq(0)");
					if (targetmenu.queue().length <= 1) {
						switch(cfg.show) {
							case 'show'  : targetmenu.show(); break;
							case 'fade'  : targetmenu.fadeIn(300, 'swing'); break;
							default		 : targetmenu.slideDown(300, 'swing'); break;
						}
					}
				},
				function(e){
					var targetmenu = $(this).children(subname + ":eq(0)");
					switch(cfg.hide) {
						case 'fade'		: targetmenu.fadeOut(100, 'swing'); break;
						case 'slide'	: targetmenu.slideUp(100, 'swing'); break;
						default			: targetmenu.hide(); break;
					}
				}
			) //end hover
			$(this).click(function(){
				$(this).children(subname + ":eq(0)").hide();
			})
		}); //end submenu.each()

		$(this).find(subname).css({display:"none", visibility:"visible"});
	}
}(jQuery));

function go_page(url) {
	document.location.href = decodeURIComponent(url);
	return false;
}

function tsearch_submit(f) {

	if (f.stx.value.length < 2) {
		alert("검색어는 두글자 이상 입력하십시오.");
		f.stx.select();
		f.stx.focus();
		return false;
	}

	f.action = f.url.value;

	return true;
}

$(document).ready(function() {

    $('#favorite').on('click', function(e) {
        var bookmarkURL = window.location.href;
        var bookmarkTitle = document.title;
        var triggerDefault = false;

        if (window.sidebar && window.sidebar.addPanel) {
            // Firefox version < 23
            window.sidebar.addPanel(bookmarkTitle, bookmarkURL, '');
        } else if ((window.sidebar && (navigator.userAgent.toLowerCase().indexOf('firefox') > -1)) || (window.opera && window.print)) {
            // Firefox version >= 23 and Opera Hotlist
            var $this = $(this);
            $this.attr('href', bookmarkURL);
            $this.attr('title', bookmarkTitle);
            $this.attr('rel', 'sidebar');
            $this.off(e);
            triggerDefault = true;
        } else if (window.external && ('AddFavorite' in window.external)) {
            // IE Favorite
            window.external.AddFavorite(bookmarkURL, bookmarkTitle);
        } else {
            // WebKit - Safari/Chrome
            alert((navigator.userAgent.toLowerCase().indexOf('mac') != -1 ? 'Cmd' : 'Ctrl') + '+D 키를 눌러 즐겨찾기에 등록하실 수 있습니다.');
        }

        return triggerDefault;
    });

	// Tooltip
    $('body').tooltip({
		selector: "[data-toggle='tooltip']"
    });

	// Mobile Menu
    $('#mobile_nav').sly({
		horizontal: 1,
		itemNav: 'centered', //basic
		smart: 1,
		mouseDragging: 1,
		touchDragging: 1,
		releaseSwing: 1,
		startAt: menu_startAt,
		speed: 300,
		elasticBounds: 1,
		dragHandle: 1,
		dynamicHandle: 1
    });

	if(menu_sub) {
		$('#mobile_nav_sub').sly({
			horizontal: 1,
			itemNav: 'centered', //basic
			smart: 1,
			mouseDragging: 1,
			touchDragging: 1,
			releaseSwing: 1,
			startAt: menu_subAt,
			speed: 300,
			elasticBounds: 1,
			dragHandle: 1,
			dynamicHandle: 1
		});
	}

	$(window).resize(function(e) {
		$('#mobile_nav').sly('reload');
		if(menu_sub) {
			$('#mobile_nav_sub').sly('reload');
		}
	});

	// Amina Menu
	$('.nav-slide').amina_menu({name:'.sub-slide', show: sub_show, hide: sub_hide});

	// Carousel Swipe
	$(".swipe-carousel").swiperight(function(e) {
		e.preventDefault();
		$(this).carousel('prev');
	});
	
	$(".swipe-carousel").swipeleft(function(e) {  
		e.preventDefault();
		$(this).carousel('next');
	});

	// Top & Bottom Button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 250) {
			$('#go-btn').fadeIn();
		} else {
			$('#go-btn').fadeOut();
		}
	});

	$('.go-top').on('click', function () {
		$('html, body').animate({ scrollTop: '0px' }, 500);
		return false;
	});

	$('.go-bottom').on('click', function () {
		$('html, body').animate({ scrollTop: $(document).height() }, 500);
		return false;
	});

});

/* ==============================================================
   스크롤 리빌(Scroll Reveal) 기능을 위한 Intersection Observer 설정
   ============================================================== */
document.addEventListener("DOMContentLoaded", function() {
    // 1. 애니메이션 적용 대상 셀렉터 (메인, 제품, 이벤트, 소개, 고객지원 등 포괄)
    var targetSelectors = [
        '.sub_top_tit_wrap',
        '.shop_top_box',
        '.product_tab:not(.main_tab)', // 서브페이지 카테고리 컨테이너
        '.product_tab.main_tab > li',  // 메인페이지 원형 아이콘 카테고리 (Stagger)
        '.sub_cate_tab',
        '.cm-faq-cat-ul',
        '.main_sec',
        '.cm_main_intro',
        '.cm_ticker',                  // 띠배너 텍스트영역
        '.cm_new_arrival_tit',         // 메인 신상품 타이틀 영역
        '.cm_new_card',                // 메인 리스트/슬라이드용 제품 카드
        '.cm_quick_list > li',         // 하단 퀵메뉴 3개 카드 (Stagger)
        '.item-row',                   // 서브페이지 제품 리스트
        '.list-row',                   // 게시판 리스트 열
        '.gallery-item',               // 갤러리 리스트
        '.cm_event_card',              // 이벤트 카드
        '.view-wrap',                  // 게시글 본문 뷰어
        '.intro_box',
        '.greeting_box',
        '.cont_top > img',             // 카페 뮌 소개 상단 이미지
        'section[class^="cont_sec"] .sec_num',  // 카페 뮌 소개 번호
        'section[class^="cont_sec"] .sub_tit01',// 카페 뮌 소개 타이틀
        'section[class^="cont_sec"] > p',       // 카페 뮌 소개 텍스트
        'section[class^="cont_sec"] ul > li',   // 카페 뮌 소개 갤러리/목록 (Stagger)
        'section[class^="cont_sec"] .img_box'   // 카페 뮌 소개 하단 썸네일
    ];

    var elements = document.querySelectorAll(targetSelectors.join(', '));
    
    // 대상 요소들에 공통 클래스 주입
    elements.forEach(function(el) {
        if (!el.classList.contains('cm-reveal')) {
            el.classList.add('cm-reveal');
        }
    });

    // 2. Intersection Observer 설정
    var observerOptions = {
        root: null,
        rootMargin: '0px',
        threshold: 0.1
    };

    // Stagger 애니메이션용 카운터 및 타이머
    var revealStaggerCounter = 0;
    var revealStaggerTimeout = null;

    var observerCallback = function(entries, observer) {
        entries.forEach(function(entry) {
            if (entry.isIntersecting) {
                // 화면에 동시다발적으로 나타나는 요소들에 대해 0.08초씩 순차적인 딜레이(Stagger) 할당
                // 최대 딜레이는 0.4초로 제한 (요소가 너무 늦게 나타나지 않도록)
                var delay = Math.min(revealStaggerCounter * 0.08, 0.4);
                entry.target.style.transitionDelay = delay + 's';
                revealStaggerCounter++;
                
                // 활성화 클래스 추가 및 1회만 실행되게 unobserve (once: true 효과)
                entry.target.classList.add('cm-reveal-active');
                observer.unobserve(entry.target);

                // 연이어 화면에 진입하는 요소들의 딜레이 처리가 끝나면(일정 시간 새 진입요소가 없으면) 카운터 리셋
                clearTimeout(revealStaggerTimeout);
                revealStaggerTimeout = setTimeout(function() {
                    revealStaggerCounter = 0;
                }, 200);
            }
        });
    };

    var observer = new IntersectionObserver(observerCallback, observerOptions);

    // 공통 클래스를 가진 모든 요소 옵저빙 시작
    var revealElements = document.querySelectorAll('.cm-reveal');
    revealElements.forEach(function(el) {
        // 이미 보인 상태일수도 있으므로 강제 로드시점 위치 보정은 css transform이 알아서 처리하게 둠.
        observer.observe(el);
    });
});
