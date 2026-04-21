<?php
if (!defined('_GNUBOARD_'))
	exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="/page/common.css">');
?>

<style>
	body .sub_top_tit {
		margin-bottom: 30px;
	}

	@media all and (max-width:1024px) {
		body .sub_top_tit {
			margin-bottom: 20px;
		}
	}

	.typing-cursor::after {
		content: '|';
		animation: blink 1.2s step-start infinite;
		font-weight: 300;
	}

	@keyframes blink {
		50% {
			opacity: 0;
		}
	}

	#brand_story01 .cont_top strong {
		display: block;
		padding-top: 30px;
		min-height: 100px;
		font-weight: 600 !important;
		font-size: 32px !important;
		color: #111;
		line-height: 1.35;
		letter-spacing: -1px;
		word-break: keep-all;
	}

	#brand_story01 .cont_top strong b#type-line1 {
		display: inline-block;
		margin-bottom: 6px;
		min-height: 42px;
		font-weight: 600 !important;
		font-size: 32px !important;
		color: #111;
	}

	#brand_story01 .cont_top strong span#type-line2 {
		display: block;
		min-height: 40px;
		font-size: 32px !important;
	}

	#brand_story01 .cont_top strong span#type-line2>span.grad_text {
		display: inline-block;
		background: linear-gradient(to right, #fa5f03 0%, #ff9f00 100%);
		-webkit-background-clip: text;
		-webkit-text-fill-color: transparent;
		background-clip: text;
	}

	#type-line2-bold {
		font-weight: 600 !important;
		display: inline;
		font-size: 32px !important;
	}

	#type-line2-post {
		font-weight: 600 !important;
		display: inline;
		font-size: 32px !important;
	}

	.typing-cursor::after {
		content: '|';
		animation: blink 1.2s step-start infinite;
		font-weight: 300;
		color: #111;
		/* fallback for base cursor */
	}

	span.grad_text .typing-cursor::after {
		background: linear-gradient(to right, #fa5f03, #ff9f00);
		-webkit-background-clip: text;
		-webkit-text-fill-color: #fa5f03;
		/* Show solid cursor over gradient */
	}

	#brand_story01 .sec_num b {
		padding-top: 0 !important;
	}

	#brand_story01 .sec_num b::before {
		font-size: 14px !important;
		margin-bottom: 6px !important;
	}

	#brand_story01 .cont_sec03 ul,
	#brand_story01 .cont_sec04 ul { display:flex; flex-wrap:nowrap; justify-content:center; gap:30px; }
	#brand_story01 .cont_sec03 ul li,
	#brand_story01 .cont_sec04 ul li { flex:1; width: 33.33%; max-width: 33.33%; box-sizing: border-box; border-radius: 24px; overflow: hidden; }
	#brand_story01 .cont_sec03 ul li img,
	#brand_story01 .cont_sec04 ul li img { width: 100%; display: block; object-fit: cover; }
	#brand_story01 .cont_sec05 .img_box img { width: 100%; border-radius: 24px; }

	/* 모바일 전용 해상도 분기점 (PC 레이아웃 절대 방어) */
	@media all and (max-width: 768px) {
		#brand_story01 .cont_top strong { min-height: auto; font-size: 20px !important; padding-top: 10px; margin-bottom: 40px; }
		#brand_story01 .cont_top strong b#type-line1,
		#brand_story01 .cont_top strong span#type-line2,
		#type-line2-bold,
		#type-line2-post { font-size: 20px !important; min-height: auto !important; line-height: 1.4 !important; }
		
		#brand_story01 .cont_sec02 ul,
		#brand_story01 .cont_sec03 ul,
		#brand_story01 .cont_sec04 ul { flex-direction: column !important; flex-wrap: wrap !important; gap: 16px !important; }
		
		#brand_story01 .cont_sec02 ul li,
		#brand_story01 .cont_sec03 ul li,
		#brand_story01 .cont_sec04 ul li,
        #brand_story01 .cont_sec05 .img_box { 
            width: 100% !important; 
            max-width: 100% !important; 
            flex: none !important; 
            aspect-ratio: 2 / 1 !important; /* 정사각에서 세로 절반 사이즈로 크롭 */
        }
        
        #brand_story01 .cont_sec02 ul li img,
		#brand_story01 .cont_sec03 ul li img,
		#brand_story01 .cont_sec04 ul li img,
        #brand_story01 .cont_sec05 .img_box img {
            height: 100% !important;
            object-fit: cover !important;
            object-position: center !important;
        }

		#brand_story01 section p { font-size: 15px !important; margin-bottom: 30px !important; }
		.mgB90 { margin-bottom: 50px !important; }
	}
</style>

<div id="brand_story01">
	<div class="cont_top mgB90">
		<strong>
			<b id="type-line1"></b>
			<span id="type-line2"><span class="grad_text"><b id="type-line2-bold"></b><span
						id="type-line2-post"></span></span></span>
		</strong>
		<script>
			document.addEventListener("DOMContentLoaded", function () {
				var line1Text = "품질에 타협하지 않는 정직한 음료를 공급하며,";
				var line2BoldText = "언제 어디서나 머물고 싶은 특별한 카페 문화";
				var line2PostText = "를 만들어갑니다.";
				var l1 = document.getElementById("type-line1");
				var l2b = document.getElementById("type-line2-bold");
				var l2p = document.getElementById("type-line2-post");
				var i = 0, j = 0, k = 0, speed = 60;

				l1.classList.add("typing-cursor");

				function typeL1() {
					if (i < line1Text.length) {
						l1.textContent += line1Text.charAt(i);
						i++;
						setTimeout(typeL1, speed);
					} else {
						l1.classList.remove("typing-cursor");
						l2b.classList.add("typing-cursor");
						setTimeout(typeL2Bold, 300);
					}
				}
				function typeL2Bold() {
					if (j < line2BoldText.length) {
						l2b.textContent += line2BoldText.charAt(j);
						j++;
						setTimeout(typeL2Bold, speed);
					} else {
						l2b.classList.remove("typing-cursor");
						l2p.classList.add("typing-cursor");
						typeL2Post();
					}
				}
				function typeL2Post() {
					if (k < line2PostText.length) {
						l2p.textContent += line2PostText.charAt(k);
						k++;
						setTimeout(typeL2Post, speed);
					} else {
						setTimeout(function () { l2p.classList.remove("typing-cursor"); }, 2500);
					}
				}
				setTimeout(typeL1, 400);
			});
		</script>
		<img src="/thema/Basic/img/brand_story01_img00.png" alt="" />
	</div>



	<section class="cont_sec02 mgB90">
		<span class="sec_num">
			<b>01</b>
		</span>
		<h3 class="sub_tit01">감각이 깨어나는 <b>스마트한 공간</b></h3>
		<p class="mgB60">
			카페 뮌(MÜN)은 '머문다'는 이름처럼 번잡함을 덜어내고 오직 맛의 본질에 집중할 수 있는 공간을 지향합니다.<br />
			무인 시스템의 편리함에 전문가의 감각을 더해 누구에게도 방해받지 않는 프리미엄 라운지를 설계했습니다.
		</p>
		<ul>
			<li>
				<img src="/thema/Basic/img/brand_story01_img02.png" alt="" />
			</li>
			<li>
				<img src="/thema/Basic/img/brand_story01_img03.png" alt="" />
			</li>
		</ul>
	</section>

	<section class="cont_sec03 mgB90">
		<span class="sec_num">
			<b>02</b>
		</span>
		<h3 class="sub_tit01">단 한 알로 완성된 <b>최상의 풍미</b></h3>
		<p class="mgB60">
			전 세계 산지에서 직송된 최상급 원두의 신선함을 정교한 기술력이 집약된 프리미엄 캡슐에 담았습니다.<br />
			바리스타의 손길 없이도 갓 추출한 듯 깊고 진한 커피 에센스는 오직 뮌에서만 누릴 수 있는 최고의 특권입니다.
		</p>
		<ul>
			<li>
				<img src="/thema/Basic/img/brand_story01_img04.png" alt="" />
			</li>
			<li>
				<img src="/thema/Basic/img/brand_story01_img05.png" alt="" />
			</li>
			<li>
				<img src="/thema/Basic/img/brand_story01_img06.png" alt="" />
			</li>
		</ul>
	</section>

	<section class="cont_sec04 mgB90">
		<span class="sec_num">
			<b>03</b>
		</span>
		<h3 class="sub_tit01">타협하지 않는 <b>품질의 기준</b></h3>
		<p class="mgB60">
			우리는 음료 한 잔이 선사하는 완벽한 경험을 위해 엄선된 재료와 검증된 레시피만을 고집합니다.<br />
			납품 전문가의 안목으로 완성한 프리미엄 제품들은 당신의 미각에 잊지 못할 특별함을 선사합니다.
		</p>
		<ul>
			<li>
				<img src="/thema/Basic/img/brand_story01_img07.png" alt="" />
			</li>
			<li>
				<img src="/thema/Basic/img/brand_story01_img08.png" alt="" />
			</li>
			<li>
				<img src="/thema/Basic/img/brand_story01_img09.png" alt="" />
			</li>
		</ul>
	</section>

	<section class="cont_sec05">
		<span class="sec_num">
			<b>04</b>
		</span>
		<h3 class="sub_tit01">일상의 품격을 높이는 <b>진정한 휴식</b></h3>
		<p class="mgB60">
			정갈하게 정돈된 공간에서 마주하는 한 잔의 음료는 지친 하루에 활력을 불어넣는 가장 완벽한 마침표가 됩니다.<br />
			가장 편안한 자세로 머물며 일상의 격을 높여주는 차별화된 맛과 함께 당신만의 소중한 영감을 다시 채워보세요.
		</p>
		<div class="img_box">
			<img src="/thema/Basic/img/brand_story01_img10.png" alt="" />
		</div>
	</section>
</div>