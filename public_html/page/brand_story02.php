<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="/page/common.css">');
?>

<div id="brand_story02">
	<section class="cont_sec01 mascot_box mgB100">
		<div class="left_box">
				<div class="img_box">
					<img src="/thema/Basic/img/brands_stroy-2_ima_01.png" alt="희망그린식품 로고" />
				</div>
		</div>
		<div class="txt_box">
			<strong>카페 뮌 <span>Cafe Muin</span></strong>
<!-- 			<h3 class="sub_tit01"><b>지구의 아름다움을 사랑해요</b></h3> -->
			<p>
				카페 뮌(CAFEMUIN)은 '자연으로부터 온 건강함'을 철학으로, 엄선된 천연 재료만을 사용하여 몸과 마음의 균형을 돕는 음료를 제안합니다. 당신의 건강은 물론 지구의 내일까지 생각하는 지속 가능한 라이프스타일을 카페 뮌과 함께 시작해 보세요. 편안한 휴식과 순수한 맛을 선사합니다.
			</p>
<!-- 				<span> -->
<!-- 					보니는 지구본의 시그니처 쌀마들렌 등껍질을 가지고 있어요. <br /> -->
<!-- 					건강한 지구빵을 만들기 위해 전국을 탐험하는 용감한 모험가예요. -->
<!-- 				</span> -->
			</p>
			<div class="add_box">
				<dl class="contact-info">
					<div class="contact-row">
						<dt>Address</dt>
						<dd>(06308) 서울 강남구 개포로28길 20 1층 101호</dd>
					</div>
					<div class="contact-row">
						<dt>Tel</dt>
						<dd>02-2039-9371</dd>
					</div>
					<div class="contact-row">
						<dt>E-mail</dt>
						<dd>foodability@naver.com</dd>
					</div>
				</dl>
			</div>
			<div class="map_box">
				<ul>
					<li>
						<a href="https://map.naver.com/p/search/%EC%84%9C%EC%9A%B8%20%EA%B0%95%EB%82%A8%EA%B5%AC%20%EA%B0%9C%ED%8F%AC%EB%A1%9C28%EA%B8%B8%2020" target="_blank">
							<img src="/thema/Basic/img/brands_stroy-2_Naver_logo.png" alt="네이버 로고" />
							네이버 지도
						</a>
					</li>
					<li>
						<a href="https://map.kakao.com/link/search/%EC%84%9C%EC%9A%B8%20%EA%B0%95%EB%82%A8%EA%B5%AC%20%EA%B0%9C%ED%8F%AC%EB%A1%9C28%EA%B8%B8%2020" target="_blank">
							<img src="/thema/Basic/img/brands_stroy-2_kakao_logo.png" alt="카카오 로고" />
							카카오 지도
						</a>
					</li>
				</ul>
			</div>
		</div>
	</section>

	<section class="cont_sec02 mgB100">
		<h2>오시는 길</h2>
		<div class="map">
			<!-- * 카카오맵 - 지도퍼가기 -->
			<!-- 1. 지도 노드 -->
			<div id="daumRoughmapContainer1775607711304" class="root_daum_roughmap root_daum_roughmap_landing"></div>

			<!--
				2. 설치 스크립트
				* 지도 퍼가기 서비스를 2개 이상 넣을 경우, 설치 스크립트는 하나만 삽입합니다.
			-->
			<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

			<!-- 3. 실행 스크립트 -->
			<script charset="UTF-8">
				new daum.roughmap.Lander({
					"timestamp" : "1775607711304",
					"key" : "kc7b2gsm6r6",
					"mapWidth" : "1260",
					"mapHeight" : "540"
				}).render();
			</script>
		</div>
	</section>
<!-- 	<section class="cont_sec02 mascot_box mgB100"> -->
<!-- 		<div class="img_box"> -->
<!-- 			<img src="/thema/Basic/img/brand_story02_img01.png" alt="지구본 마스코트 누리" /> -->
<!-- 		</div> -->
<!-- 		<div class="txt_box"> -->
<!-- 			<strong>NURI <span>누리</span></strong> -->
<!-- 			<h3 class="sub_tit01"><b>지구빵을 만들어요</b></h3> -->
<!-- 			<p> -->
<!-- 				<span> -->
<!-- 					누리는 지구본의 시그니처 까눌레 등껍질을 가지고 있는 수줍음 많은 거북이예요. <br /> -->
<!-- 					송도 바다를 한가로이 헤엄치다 탐험 중인 보니를 만나게 되었어요. -->
<!-- 				</span> -->
<!-- 				<span> -->
<!-- 					새로운 도전을 두려워해 송도 바다에만 머물던 누리는 온 세상을 누비며 <br /> -->
<!-- 					멋진 경험을 하는 보니를 보고 용기를 내어 건강한 지구빵을 만드는  -->
<!-- 					여행길에 올라요. -->
<!-- 				</span> -->
<!-- 			</p> -->
<!-- 		</div> -->
<!-- 	</section> -->

<!-- 	<section class="cont_sec03"> -->
<!-- 		<h3 class="sub_tit01 mgB30"><b>보니의 탐험</b> <span>보니는 지구의 아름다움을 사랑해요.</span></h3> -->
<!-- 		<img src="/thema/Basic/img/brand_story02_img03.jpg" alt="송도바다를 탐험하는 보니 → 해풍을 맞고 자란 쑥을 발견한 보니 → 지리산에 질좋은 밀밭이 있네요. → 군산에는 오랜 수탈도 이겨낸 논이 있네요. → 무첨가두유, 지리산통밀, 국내산 쌀가루, 비정제원당, 국내산 현미강유, 국내산 참쑥" /> -->
<!-- 	</section> -->
</div>