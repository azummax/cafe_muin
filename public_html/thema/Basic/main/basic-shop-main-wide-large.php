<?php
if(function_exists('opcache_reset')) { opcache_reset(); }
if (!defined('_GNUBOARD_'))
	exit; // 개별 페이지 접근 불가

// 위젯 대표아이디 설정
$wid = 'SMBWL';

// 게시판 제목 폰트 설정
$font = 'font-18 en';

// 게시판 제목 하단라인컬러 설정 - red, blue, green, orangered, black, orange, yellow, navy, violet, deepblue, crimson..
$line = 'navy';

?>
<!-- Swiper 설정 -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<!-- ============================
	 HERO TEXT
	 ============================ -->
<div class="cm_hero_text">
	<h2 id="hero_typewriter"></h2>
</div>

<script>
(function() {
    var lines = [
        "Simply Smart, Purely Premium.",
        "캡슐로 완성하는 특별한 휴식, 카페 뮌."
    ];
    var el = document.getElementById('hero_typewriter');
    var lineIndex = 0, charIndex = 0;
    var delay = 60; // ms per character

    function typeLine() {
        if (!el) return;
        var cursorHtml = '<span class="typing-cursor"></span>';

        if (charIndex < lines[lineIndex].length) {
            var html = '';
            for (var i = 0; i < lineIndex; i++) {
                html += lines[i] + (i < lines.length - 1 ? '<br>' : '');
            }
            var typed = lines[lineIndex].substring(0, charIndex + 1);
            html += typed;
            el.innerHTML = html + cursorHtml;
            charIndex++;
            setTimeout(typeLine, delay);
        } else if (lineIndex < lines.length - 1) {
            // Move to next line after a short pause
            lineIndex++;
            charIndex = 0;
            setTimeout(typeLine, 300);
        } else {
            // Done: remove cursor after a moment
            setTimeout(function() {
                var cursor = el.querySelector('.typing-cursor');
                if (cursor) cursor.style.display = 'none';
            }, 1800);
        }
    }

    // Start after a short initial delay
    setTimeout(typeLine, 300);
})();
</script>


<!-- ============================
	 HERO SECTION (Images Only)
	 ============================ -->
<section class="cm_hero">
	<!-- 전체 슬라이더에 공유되는 페이지네이션 UI (단일, 절대 위치) -->
	<div class="hero_progress_pag">
		<span class="hpp-cur">01</span>
		<div class="hpp-bar-wrap">
			<div class="hpp-bar-fill"></div>
		</div>
		<span class="hpp-total">03</span>
	</div>

	<div class="swiper cmHeroSwiper">
		<div class="swiper-wrapper">
			<!-- Slide 1 (Set A) -->
			<div class="swiper-slide">
				<div class="hero_slide_set">
					<div class="hero_img hero_img_left">
						<img src="/thema/Basic/img/hero1.png" alt="시금치와 채소가 있는 자연 배경" onerror="this.src='https://placehold.co/600x800/1e1e1e/white?text=Img+A1'">
					</div>
					<div class="hero_img hero_img_right">
						<img src="/thema/Basic/img/hero2.png" alt="상큼한 복숙아 아이스티 음료" onerror="this.src='https://placehold.co/800x800/ff6a12/white?text=Img+A2'">
					</div>
				</div>
			</div>
			<!-- Slide 2 (Set B) -->
			<div class="swiper-slide">
				<div class="hero_slide_set">
					<div class="hero_img hero_img_left">
						<img src="/thema/Basic/img/hero3.png" alt="신선한 과일과 채소" onerror="this.src='https://placehold.co/600x800/0bab6d/white?text=Img+B1'">
					</div>
					<div class="hero_img hero_img_right">
						<img src="/thema/Basic/img/hero4.png" alt="건강한 자연" onerror="this.src='https://placehold.co/800x800/089157/white?text=Img+B2'">
					</div>
				</div>
			</div>
			<!-- Slide 3 (Set C) -->
			<div class="swiper-slide">
				<div class="hero_slide_set">
					<div class="hero_img hero_img_left">
						<img src="/thema/Basic/img/hero5.png" alt="카페 문 히어로 이미지 5" onerror="this.src='https://placehold.co/600x800/5c3d2e/white?text=Img+C1'">
					</div>
					<div class="hero_img hero_img_right">
						<img src="/thema/Basic/img/hero6.png" alt="카페 문 히어로 이미지 6" onerror="this.src='https://placehold.co/800x800/8b5e3c/white?text=Img+C2'">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var SLIDE_DELAY = 4000; // ms (swiper autoplay delay)
    var TOTAL_SLIDES = 3;
    var curEl  = document.querySelector('.hpp-cur');
    var totEl  = document.querySelector('.hpp-total');
    var fillEl = document.querySelector('.hpp-bar-fill');

    function pad(n) { return n < 10 ? '0' + n : '' + n; }

    function resetProgress(realIndex) {
        var cur = (realIndex % TOTAL_SLIDES) + 1;
        if (curEl)  curEl.textContent  = pad(cur);
        if (totEl)  totEl.textContent  = pad(TOTAL_SLIDES);
        // 애니메이션 재시작: 클래스 제거 후 다시 적용
        if (fillEl) {
            fillEl.classList.remove('running');
            void fillEl.offsetWidth; // reflow 강제
            fillEl.classList.add('running');
        }
    }

    var swiper = new Swiper(".cmHeroSwiper", {
        loop: true,
        speed: 800,
        autoplay: {
            delay: SLIDE_DELAY,
            disableOnInteraction: false,
        },
        effect: "slide",
        on: {
            init: function() {
                resetProgress(0);
            },
            slideChange: function() {
                resetProgress(this.realIndex);
            }
        }
    });
});
</script>

<ul class="product_tab main_tab">
	<li>
		<a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=1010">
			<div class="ico_box ico01"></div>
			<strong>커피</strong>
		</a>
	</li>
	<li>
		<a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=1020">
			<div class="ico_box ico02"></div>
			<strong>라떼</strong>
		</a>
	</li>
	<li>
		<a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=1030">
			<div class="ico_box ico03"></div>
			<strong>에이드</strong>
		</a>
	</li>
	<li>
		<a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=1040">
			<div class="ico_box ico04"></div>
			<strong>차</strong>
		</a>
	</li>
	<!--<li>
		<a href="<?php echo G5_SHOP_URL; ?>/listtype.php?type=4">
			<div class="ico_box ico09"></div>
			<strong>신상품</strong>
		</a>
	</li> -->
	<!--
	<li>
		<a href="<?php echo G5_SHOP_URL; ?>/list.php?ca_id=50">
			<div class="ico_box ico12"></div>
			<strong>적립금</strong>
		</a>
	</li>
	-->
</ul>
<!--product_tab end-->

<!-- ============================
     TICKER BANNER
     ============================ -->
<div class="cm_ticker">
	<div class="cm_ticker_track">
		<!-- opacity 100 -->
		<span class="cm_ticker_item">Smarter Choice, Premium Taste, Everywhere with MÜN</span>
		<span class="cm_ticker_sep"></span>
		<!-- opacity 30 -->
		<span class="cm_ticker_item dim">Smarter Choice, Premium Taste, Everywhere with MÜN</span>
		<span class="cm_ticker_sep"></span>
		<!-- opacity 100 -->
		<span class="cm_ticker_item">Smarter Choice, Premium Taste, Everywhere with MÜN</span>
		<span class="cm_ticker_sep"></span>
		<!-- opacity 30 -->
		<span class="cm_ticker_item dim">Smarter Choice, Premium Taste, Everywhere with MÜN</span>
		<span class="cm_ticker_sep"></span>
		<!-- ↑ 위 4세트의 절반(2세트)만큼 translateX(-50%)로 루프 -->
		<!-- opacity 100 -->
		<span class="cm_ticker_item">Smarter Choice, Premium Taste, Everywhere with MÜN</span>
		<span class="cm_ticker_sep"></span>
		<!-- opacity 30 -->
		<span class="cm_ticker_item dim">Smarter Choice, Premium Taste, Everywhere with MÜN</span>
		<span class="cm_ticker_sep"></span>
		<!-- opacity 100 -->
		<span class="cm_ticker_item">Smarter Choice, Premium Taste, Everywhere with MÜN</span>
		<span class="cm_ticker_sep"></span>
		<!-- opacity 30 -->
		<span class="cm_ticker_item dim">Smarter Choice, Premium Taste, Everywhere with MÜN</span>
		<span class="cm_ticker_sep"></span>
	</div>
</div>

<?php
$cm_tabs = array(
    'all'    => array('name'=>'전체',  'keyword'=>''),
    'coffee' => array('name'=>'커피',   'keyword'=>'커피'),
    'latte'  => array('name'=>'라떼',   'keyword'=>'라떼'),
    'ade'    => array('name'=>'에이드', 'keyword'=>'에이드'),
    'tea'    => array('name'=>'차',     'keyword'=>'차')
);
?>
<section id="main_new_arrival">
    <div class="cm_new_arrival_tit">
        <h2>New Arrival</h2>
        <p>무인의 편리함 속에 프리미엄의 품격을 더한 신제품을 만나보세요.</p>
        
        <div class="cm_new_tabs">
            <?php foreach($cm_tabs as $id => $tab) { ?>
                <button type="button" class="cm_tab_btn <?php echo ($id=='all')?'active':''; ?>" data-target="content-<?php echo $id; ?>"><?php echo $tab['name']; ?></button>
            <?php } ?>
        </div>
    </div>

    <div class="at-container cm_new_sliders_wrap">
        <?php foreach($cm_tabs as $id => $tab) { 
            $keyword = $tab['keyword'];
            $where_add = "";
            if($id === 'tea') $where_add = " and (it_name like '%차%' or it_name like '%티%') ";
            else if ($keyword) $where_add = " and it_name like '%{$keyword}%' ";
        ?>
        <div class="cm_tab_content" id="content-<?php echo $id; ?>" style="position:relative; <?php echo ($id=='all')?'':'display:none;'; ?>">
            <div class="swiper cmNewArrivalSwiper">
                <div class="swiper-wrapper">
                    <?php
                    // 카테고리별 최신 상품 6개 추출
                    $sql = " select * from {$g5['g5_shop_item_table']} where it_use = 1 {$where_add} order by it_order, it_time desc limit 6 ";
                    $result = sql_query($sql);
                    while ($row = sql_fetch_array($result)) {
                        $it_price = get_price($row);
                        
                        $price_html = "";
                        if (!$is_member) {
                            $price_html = '<span class="cm_new_price" style="font-size:18px; color:#999;">비공개</span>';
                        } else {
                            $it_cust_price = $row['it_cust_price'];

                            if ($it_cust_price > 0 && $it_price > 0 && $it_cust_price > $it_price) {
                                $price_html = '<del class="cm_new_cust_price" style="color:#999; font-size:18px; text-decoration:line-through; margin-right:6px;">'.number_format($it_cust_price).'원</del> <span class="cm_new_price" style="color:#ff6600; font-size:18px; font-weight:500;">'.number_format($it_price).'원</span>';
                            } else {
                                $price_html = '<span class="cm_new_price" style="color:#ff6600; font-size:18px; font-weight:500;">'.number_format($it_price).'원</span>';
                            }
                        }
                    ?>
                    <div class="swiper-slide">
                        <a href="<?php echo G5_SHOP_URL.'/item.php?it_id='.$row['it_id']; ?>" class="cm_new_card">
                            <div class="cm_new_img_box">
                                <img src="<?php echo get_it_imageurl($row['it_id']); ?>" alt="<?php echo get_text($row['it_name']); ?>">
                            </div>
                            <div class="cm_new_txt_box">
                                <strong class="cm_new_title"><?php echo get_text($row['it_name']); ?></strong>
                                <div class="cm_new_price_wrap"><?php echo $price_html; ?></div>
                            </div>
                        </a>
                    </div>
                    <?php } ?>
                </div>
                <!-- 스크롤바 바텀 여백 확보용 빈 영역 -->
                <div style="height: 70px;"></div>
                <div class="swiper-scrollbar"></div>
            </div>
            <div class="cm_new_prev"><iconify-icon icon="solar:alt-arrow-left-linear"></iconify-icon></div>
            <div class="cm_new_next"><iconify-icon icon="solar:alt-arrow-right-linear"></iconify-icon></div>
        </div>
        <?php } ?>
    </div>
</section>

<!-- 퀵메뉴 섹션 -->
<section id="main_quick_menu">
    <div class="at-container">
        <ul class="cm_quick_list">
            <li style="--qcolor: #ec8a74;">
                <a href="http://www.speranzafood.co.kr" target="_blank">
                    <div class="quick_img"><img src="/thema/Basic/img/quick_icon_1.png" alt="Brand Site"></div>
                    <div class="quick_subtit">Brand Site</div>
                    <h3 class="quick_tit">희망그린식품</h3>
                    <p class="quick_desc">신선함과 믿음을 전하는<br>희망그린식품의 이야기를 만나보세요.</p>
                    <div class="quick_more">View More</div>
                </a>
            </li>
            <li style="--qcolor: #9cc221;">
                <a href="#href">
                    <div class="quick_img"><img src="/thema/Basic/img/quick_icon_2.png" alt="Event"></div>
                    <div class="quick_subtit">Event</div>
                    <h3 class="quick_tit">이벤트</h3>
                    <p class="quick_desc">쇼핑의 즐거움을 더해줄<br>다양한 이벤트가 준비되어 있습니다.</p>
                    <div class="quick_more">View More</div>
                </a>
            </li>
            <li style="--qcolor: #7fcced;">
                <a href="#href">
                    <div class="quick_img"><img src="/thema/Basic/img/quick_icon_3.png" alt="Contact Us"></div>
                    <div class="quick_subtit">Contact Us</div>
                    <h3 class="quick_tit">고객지원</h3>
                    <p class="quick_desc">더 나은 서비스와 만족을 위해<br>항상 준비되어 있습니다.</p>
                    <div class="quick_more">View More</div>
                </a>
            </li>
        </ul>
    </div>
</section>

<script>
document.addEventListener("DOMContentLoaded", function() {
    let swipers = {};

    document.querySelectorAll('.cm_tab_content').forEach(function(contentWrap) {
        let swiperEl = contentWrap.querySelector('.cmNewArrivalSwiper');
        let id = contentWrap.getAttribute('id');
        
        swipers[id] = new Swiper(swiperEl, {
            slidesPerView: 1,
            spaceBetween: 20,
            loop: false,
            navigation: {
                nextEl: contentWrap.querySelector('.cm_new_next'),
                prevEl: contentWrap.querySelector('.cm_new_prev'),
            },
            scrollbar: {
                el: swiperEl.querySelector('.swiper-scrollbar'),
                draggable: true,
            },
            breakpoints: {
                768: { slidesPerView: 2, spaceBetween: 24 },
                1024: { slidesPerView: 3, spaceBetween: 40 }
            }
        });
    });

    const tabBtns = document.querySelectorAll('.cm_tab_btn');
    tabBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active from all tabs
            tabBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');

            // Hide all tab contents
            document.querySelectorAll('.cm_tab_content').forEach(c => c.style.display = 'none');
            
            // Show target content
            const targetId = this.getAttribute('data-target');
            const targetWrap = document.getElementById(targetId);
            targetWrap.style.display = 'block';

            // Update swiper dimensions due to display:none
            if(swipers[targetId]) {
                swipers[targetId].update();
            }
        });
    });
});
</script>

<script src="<?php echo G5_JS_URL ?>/main.js"></script>