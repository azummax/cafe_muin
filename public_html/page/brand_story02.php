<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="/page/common.css">');
?>

<style>
	#brand_story02 { max-width: 1320px; margin: 0 auto; padding: 0 15px; }

	/* 지도 설정 (1320px 중앙정렬 및 라운드) */
	#brand_story02 .cont_map { width: 100vw; max-width: 1320px; margin: 50px 0 80px; position: relative; left: 50%; transform: translateX(-50%); padding: 0 15px; box-sizing: border-box; }
	#brand_story02 .cont_map .map { border-radius: 16px; overflow: hidden; border: 1px solid rgba(0, 0, 0, 0.06); }
	
	/* 하단 연락처 및 버튼 레이아웃 */
	#brand_story02 .cont_contact_wrap { max-width: 1320px; margin: 0 auto; padding-bottom: 0px; display: flex; flex-direction: row; justify-content: space-between; align-items: flex-end; gap: 40px; }
	
	.contact_list { list-style: none; padding: 0; margin: 0; text-align: left; }
	.contact_list li { display: flex; align-items: center; margin-bottom: 25px; font-size: 18px; }
	.contact_list li:last-child { margin-bottom: 0; }
	.contact_list li .icon_circ { width: 44px; height: 44px; border-radius: 50%; background: #111; color: #fff; display: flex; align-items: center; justify-content: center; font-size: 18px; margin-right: 25px; }
	.contact_list li strong { width: 120px; font-weight: 600; color: #111; letter-spacing: -0.5px; }
	.contact_list li span { color: #333; letter-spacing: -0.5px; }
	
	.map_links { display: flex; gap: 10px; }
	.map_links a.btn_map { display: flex; align-items: center; justify-content: center; height: 60px; padding: 0 25px; border: 1px solid #111; border-radius: 30px; text-decoration: none; color: #111; font-weight: 600; font-size: 18px; background: #fff; transition: background 0.2s; letter-spacing: -0.5px; }
	.map_links a.btn_map img { height: 28px; margin-right: 12px; }
	.map_links a.btn_map:hover { background: #f8f8f8; }

	@media (max-width: 768px) {
		#brand_story02 .cont_map { margin: 30px 0 50px; }
		#brand_story02 .cont_map .map .root_daum_roughmap,
		#brand_story02 .cont_map .map .wrap_map { height: 280px !important; }
		
		#brand_story02 .cont_contact_wrap { flex-direction: column; align-items: flex-start; gap: 40px; padding-bottom: 0px; }
		.contact_list li { font-size: 15px; align-items: center; flex-wrap: wrap; margin-bottom: 25px; }
		.contact_list li .icon_circ { width: 40px; height: 40px; font-size: 16px; margin-right: 15px; flex-shrink: 0; }
		.contact_list li strong { width: calc(100% - 55px); flex: none; padding-top: 0; font-size: 16px; }
		.contact_list li span { width: 100%; padding-left: 55px; padding-top: 4px; word-break: keep-all; color: #555; }
		.map_links { width: 100%; justify-content: flex-start; flex-wrap: wrap; gap: 10px; }
		.map_links a.btn_map { height: 50px; padding: 0 20px; font-size: 15px; white-space: nowrap; }
		.map_links a.btn_map svg { width: 24px; height: 24px; margin-right: 8px !important; }
	}
</style>

<div id="brand_story02">
    <!-- TOP: Map Section -->
	<section class="cont_map">
		<div class="map">
			<!-- * 카카오맵 - 지도퍼가기 -->
			<div id="daumRoughmapContainer1775607711304" class="root_daum_roughmap root_daum_roughmap_landing" style="width: 100%;"></div>
			<script charset="UTF-8" class="daum_roughmap_loader_script" src="https://ssl.daumcdn.net/dmaps/map_js_init/roughmapLoader.js"></script>
			<script charset="UTF-8">
				new daum.roughmap.Lander({
					"timestamp" : "1775607711304",
					"key" : "kc7b2gsm6r6",
					"mapWidth" : "100%",
					"mapHeight" : "480"
				}).render();
			</script>
		</div>
	</section>

    <!-- BOTTOM: Contact Section -->
	<section class="cont_contact_wrap">
        <ul class="contact_list">
            <li>
                <div class="icon_circ"><i class="fa fa-map-marker"></i></div>
                <strong>Location</strong>
                <span>(06308) 서울 강남구 개포로28길 20 1층 101호</span>
            </li>
            <li>
                <div class="icon_circ"><i class="fa fa-phone"></i></div>
                <strong>Phone</strong>
                <span>02-2039-9371</span>
            </li>
            <li>
                <div class="icon_circ"><i class="fa fa-envelope"></i></div>
                <strong>E-mail</strong>
                <span>foodability@naver.com</span>
            </li>
        </ul>
        <div class="map_links">
            <a href="https://map.naver.com/p/search/%EC%84%9C%EC%9A%B8%20%EA%B0%95%EB%82%A8%EA%B5%AC%20%EA%B0%9C%ED%8F%AC%EB%A1%9C28%EA%B8%B8%2020" target="_blank" class="btn_map naver">
                <svg width="30" height="30" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right:10px;">
					<path d="M14 2C9.58 2 6 5.58 6 10C6 16.5 14 25 14 25C14 25 22 16.5 22 10C22 5.58 18.42 2 14 2Z" fill="#03C75A"/>
					<path d="M16.5 15H15L12 10.5V15H10.5V6H12L15 10.5V6H16.5V15Z" fill="white"/>
				</svg>
                네이버 지도
            </a>
            <a href="https://map.kakao.com/link/search/%EC%84%9C%EC%9A%B8%20%EA%B0%95%EB%82%A8%EA%B5%AC%20%EA%B0%9C%ED%8F%AC%EB%A1%9C28%EA%B8%B8%2020" target="_blank" class="btn_map kakao">
                <svg width="30" height="30" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right:10px;">
					<rect width="28" height="28" rx="8" fill="#FAE100"/>
					<path d="M14 6C10.13 6 7 9.13 7 13C7 18.5 14 23 14 23C14 23 21 18.5 21 13C21 9.13 17.87 6 14 6ZM14 16C12.34 16 11 14.66 11 13C11 11.34 12.34 10 14 10C15.66 10 17 11.34 17 13C17 14.66 15.66 16 14 16Z" fill="#0077FF"/>
					<circle cx="14" cy="13" r="3" fill="#FAE100"/>
				</svg>
                카카오맵
            </a>
        </div>
	</section>
</div>