<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="/page/common.css">');
?>

<div id="brand_story03">
	<section class="cont_sec01 mgB90">
		<div class="img_box">
			<div class="big_thum">
				<img src="/thema/Basic/img/brand_story03_img01.jpg" alt="카페 뮌 카페 전경" id="big_img" />
			</div>
			<ul class="sm_thum">
				<li><img tabindex="0" class="small_img" src="/thema/Basic/img/brand_story03_img01.jpg" alt="카페 뮌 카페 전경" /></li>
				<li><img tabindex="0" class="small_img" src="/thema/Basic/img/brand_story03_img02.jpg" alt="카페 뮌 카페 내부" /></li>
				<li><img tabindex="0" class="small_img" src="/thema/Basic/img/brand_story03_img03.jpg" alt="카페 뮌 디저트와 음료" /></li>
				<li><img tabindex="0" class="small_img" src="/thema/Basic/img/brand_story03_img04.jpg" alt="카페 뮌 디저트와 음료" /></li>
				<li><img tabindex="0" class="small_img" src="/thema/Basic/img/brand_story03_img05.jpg" alt="카페 뮌 카페 카운터" /></li>
			</ul>
		</div>
		<div class="txt_box">
			<h3 class="sub_tit01"><b>카페 뮌 카페</b> <span>Earthborn Cafe</span></h3>
			<p>
				'나'와 '지구'의 건강을 생각하는 사람들을 위해 매일 건강한 빵을 굽고 있습니다. <br />
				이 세상에 걱정 없이 집어들 수 있는 음식이 많아지도록 새로운 대체단백질과
				식물성단백질을 연구, 개발합니다.
			</p>
			<ul>
				<li><b>Address</b>인천광역시 연수구 송도과학로56 105호</li>
				<li><b>Tel</b>0507.1337.5138</li>
				<li><b>H.P</b>010.9195.5138</li>
			</ul>
			<div class="link_box">
				<a href="https://naver.me/FVc112MD" target="_blank" title="새창열림" class="naver">네이버 지도</a>
				<a href="https://kko.to/c11Gw8593Z" target="_blank" title="새창열림" class="kakao">카카오 지도</a>
			</div>
		</div>
	</section>

	<section class="cont_sec02">
		<h3 class="sub_tit01 mgB30"><b>오시는 길</b></h3>
		<div class="map_con">
			<div id="daumRoughmapContainer1698129376721" class="root_daum_roughmap root_daum_roughmap_landing map_inner"></div>
		</div>
	</section>
</div>


<!-- 카카오맵 -->
<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>

<script charset="UTF-8">
	new daum.roughmap.Lander({
		"timestamp" : "1698129376721",
		"key" : "2gk6f",
	}).render();
</script>

<!-- 이미지변경 -->
<script>
	var bigPic = document.querySelector('#big_img');
	var smPic = document.querySelectorAll('.small_img');

	for(var i = 0; i < smPic.length; i++){
		smPic[i].addEventListener('mouseover', changePic);
		smPic[i].addEventListener('focus', changePic);
	}

	function changePic(){
		var newSrc = this.src;
		var newAlt = this.alt;
		bigPic.setAttribute('src', newSrc);
		bigPic.setAttribute('alt', newAlt);
	}
</script>