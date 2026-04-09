<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="/page/common.css?ver='.date("YmdHis").'">');
?>

<?php if($is_admin){ ?>
	<div class="text-right mgB30">
		<a href="<?php echo G5_BBS_URL;?>/board.php?bo_table=content" class="btn btn-black btn-sm">게시글 업로드</a>
	</div>
<?php } ?>

<div id="content">
	<ul class="cate_tab mgB40">
		<li  class="on"><button id="" class="ellipsis">전체</button></li>
		<li><button id="cont_sec01" class="ellipsis">이벤트</button></li>
		<li><button id="cont_sec02" class="ellipsis">희망그린 스토리</button></li>
	</ul>

	<section class="cont_sec01 mgB90 tab_cont on" id="cont_sec01">
		<div class="tit_box">
			<h3 class="sub_tit01"><b>이벤트</b></h3>
			<p>지금 진행 중인 이벤트를 확인하세요.</p>
			<div class="slider_btn">
				<button class="slider_prev">이전</button>
				<button class="slider_next">다음</button>
			</div>
		</div>
		<?php echo apms_widget('content', $wid.'-cw1'); ?>
	</section>

	<section class="cont_sec02 mgB90 tab_cont on" id="cont_sec02">
		<div class="tit_box">
			<h3 class="sub_tit01"><b>희망그린 스토리</b></h3>
			<p>지구와 함께 자라는 맛의 이야기, 이것이 희망그린의 스토리입니다.</p>
			<div class="slider_btn">
				<button class="slider_prev">이전</button>
				<button class="slider_next">다음</button>
			</div>
		</div>
		<?php echo apms_widget('content', $wid.'-cw2'); ?>
	</section>
</div>


<script>
$(function(){
	// 이벤트
	var subSlider1 = new Swiper(".cont_sec01 .swiper-container", {
		slidesPerView: 4,
		spaceBetween: 20,
		speed: 1000,
		/*autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},*/
		navigation: {
			nextEl: ".cont_sec01 .slider_next",
			prevEl: ".cont_sec01 .slider_prev",
		},
		breakpoints: {
			1024: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 15,
			},
		},
		observer: true,
		observeParents: true,
	});

	// 희망그린 스토리
	var subSlider2 = new Swiper(".cont_sec02 .swiper-container", {
		slidesPerView: 4,
		spaceBetween: 20,
		speed: 1000,
		/*autoplay: {
			delay: 5000,
			disableOnInteraction: false,
		},*/
		navigation: {
			nextEl: ".cont_sec02 .slider_next",
			prevEl: ".cont_sec02 .slider_prev",
		},
		breakpoints: {
			1024: {
				slidesPerView: 3,
				spaceBetween: 20,
			},
			768: {
				slidesPerView: 2,
				spaceBetween: 15,
			},
		},
		observer: true,
		observeParents: true,
	});
});

// 탭 추가됨 (2024-05-27)
function tabContent() {
	const tab = document.querySelectorAll('.cate_tab li');
	const content = document.querySelectorAll('.tab_cont');
	
	tab.forEach((btn, idx) => {
		btn.addEventListener('click', function(){
			tab.forEach((btn) => {
				btn.classList.remove('on');
			})
			tab[idx].classList.add('on');
			
			const tabId = btn.querySelector('button').id;
			content.forEach((item, idx) => {
				item.classList.remove('on');
				const contentId = item.id;
				if(tabId == contentId){
					content[idx].classList.add('on');
				}
			})
		})
	})
				
	// 전체
	tab[0].addEventListener('click', function(){
		for(let i = 0; i < content.length; i++){
			content[i].classList.add('on');
		}
	})
	
}
tabContent();
</script>