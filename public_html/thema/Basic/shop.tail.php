<?php
if (!defined('_GNUBOARD_'))
	exit; // 개별 페이지 접근 불가

?>
<?php if ($col_name) { ?>
	<?php if ($col_name == "two") { ?>
		</div>
		<div class="col-md-<?php echo $col_side; ?><?php echo ($at_set['side']) ? ' pull-left' : ''; ?> at-col at-side">
			<?php include_once($is_side_file); // Side ?>
		</div>
		</div>
	<?php } else { ?>
		</div><!-- .at-content -->
	<?php } ?>
	</div><!-- .at-container -->
<?php } ?>
</div><!-- .at-body -->

<footer id="ft" class="<?php if (!$is_index) { echo 'sub'; } ?>">
	<!-- 상단 링크 바 -->
	<div class="ft_top_bar">
		<div class="at-container ft_top_inner">
			<ul class="ft_links">
				<li class="ft_link_li ft_link_bold"><a href="<?php echo G5_BBS_URL; ?>/page.php?hid=privacy">개인정보처리방침</a></li>
				<li class="ft_link_li"><a href="<?php echo G5_BBS_URL; ?>/page.php?hid=provision">이용약관</a></li>
				<li class="ft_link_li ft_link_icon"><a href="http://www.speranzafood.co.kr" target="_blank">희망그린식품 브랜드 <iconify-icon icon="solar:arrow-right-up-linear" width="14"></iconify-icon></a></li>
			</ul>
			<div class="ft_right_group">
				<ul class="ft_sns_list">
					<li><a href="#" aria-label="Facebook"><iconify-icon icon="ri:facebook-fill" width="18"></iconify-icon></a></li>
					<li><a href="#" aria-label="Instagram"><iconify-icon icon="ri:instagram-line" width="18"></iconify-icon></a></li>
				</ul>
				<div class="ft_family_wrap">
					<button type="button" class="ft_family_btn" onclick="this.nextElementSibling.classList.toggle('show'); this.classList.toggle('active');">
						패밀리사이트 <iconify-icon icon="mdi:menu-down" class="ft_family_arrow" width="24"></iconify-icon>
					</button>
					<ul class="ft_family_list">
						<li><a href="http://www.speranzafood.co.kr" target="_blank">희망그린식품</a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<!-- 본문 영역 -->
	<div class="ft_main">
		<div class="at-container ft_main_inner">
			<!-- 좌: 회사정보 -->
			<div class="ft_info_col">
				<div class="ft_logo_wrap">
					<img src="/thema/Basic/img/ft_logo.png" alt="카페뮌 로고" />
				</div>
				<dl class="ft_dl">
					<div class="ft_dl_row"><dt>대표자</dt><dd>조창기</dd></div>
					<div class="ft_dl_row"><dt>주소</dt><dd>(06308) 서울 강남구 개포로28길 20 1층 101호</dd></div>
					<div class="ft_dl_row"><dt>대표전화</dt><dd>02-2039-9371</dd></div>
					<div class="ft_dl_row"><dt>이메일</dt><dd>foodability@naver.com</dd></div>
					<div class="ft_dl_row"><dt>사업자등록번호</dt><dd>691-10-01347</dd></div>
					<div class="ft_dl_row"><dt>통신판매업신고번호</dt><dd>2022-서울강남-04952</dd></div>
				</dl>
				<p class="ft_copy">Copyright &copy; 2026 CAFEMUIN. CO., LTD. All Rights Reserved.</p>
			</div>

			<!-- 우: 고객센터 -->
			<div class="ft_cs_col">
				<p class="ft_cs_label">고객만족센터</p>
				<strong class="ft_cs_tel">02-2039-9371</strong>
				<p class="ft_cs_hours">
					[상담시간]&nbsp;&nbsp;AM 9:00 ~ PM 6:00<br>
					[점심시간]&nbsp;&nbsp;PM 12:00 ~ PM 1:00<br>
					<span class="ft_cs_gray">(토, 일, 공휴일 휴무)</span>
				</p>
			</div>
		</div>
	</div>
</footer><!--footer end-->
</div><!-- .wrapper -->

<div id="buttom_quick">
	<?php if ($is_admin) { ?>
	<button id="admin_btn" onclick="location.href='<?php echo G5_ADMIN_URL; ?>';" title="관리자" style="display:flex; flex-direction:column; align-items:center; justify-content:center; color:#fff; box-sizing:border-box; padding:0; border:none;">
		<div style="display:flex; flex-direction:column; align-items:center; justify-content:center; width:100%; transform: translateY(-1px);">
			<iconify-icon icon="solar:user-linear" width="26" height="26" style="margin-bottom:8px;"></iconify-icon>
			<span style="font-size:13px; line-height:1; font-weight:400; letter-spacing:0;">관리자</span>
		</div>
	</button>
	<?php } ?>
	<?php
	// 1:1 문의 글쓰기 URL
	$qa_write_url = G5_BBS_URL . '/qawrite.php';
	// 로그인 여부에 따라 이동 URL 결정 (미로그인 시 로그인 페이지 → 글쓰기 페이지로 redirect)
	$chat_href = $is_member
		? $qa_write_url
		: G5_BBS_URL . '/login.php?url=' . urlencode($qa_write_url);
	?>
	<button id="chat_btn" onclick="location.href='<?php echo $chat_href; ?>';" title="문의하기" style="display:flex; flex-direction:column; align-items:center; justify-content:center; color:#fff; box-sizing:border-box; padding:0; border:none;">
		<div style="display:flex; flex-direction:column; align-items:center; justify-content:center; width:100%; transform: translateY(-1px);">
			<iconify-icon icon="solar:chat-round-dots-linear" width="24" height="24" style="margin-bottom:8px;"></iconify-icon>
			<span style="font-size:13px; line-height:1; font-weight:400; letter-spacing:0;">문의하기</span>
		</div>
	</button>
	<button id="top_btn" title="맨 위로" style="display:flex; flex-direction:column; align-items:center; justify-content:center; box-sizing:border-box; padding:0; border:none;">
		<div style="display:flex; flex-direction:column; align-items:center; justify-content:center; width:100%; transform: translateY(-3px);">
			<iconify-icon icon="solar:alt-arrow-up-linear" width="20" height="20" style="margin-bottom:4px;"></iconify-icon>
			<span style="font-size:13px; line-height:1; font-weight:400; letter-spacing:0;">TOP</span>
		</div>
	</button>
</div>

<!--[if lt IE 9]>
<script type="text/javascript" src="<?php echo THEMA_URL; ?>/assets/js/respond.js"></script>
<![endif]-->

<!-- Iconify -->
<script src="https://code.iconify.design/iconify-icon/2.1.0/iconify-icon.min.js"></script>

<!-- JavaScript -->
<script>
	var sub_show = "<?php echo $at_set['subv']; ?>";
	var sub_hide = "<?php echo $at_set['subh']; ?>";
	var menu_startAt = "<?php echo ($m_sat) ? $m_sat : 0; ?>";
	var menu_sub = "<?php echo $m_sub; ?>";
	var menu_subAt = "<?php echo ($m_subsat) ? $m_subsat : 0; ?>";
</script>
<script src="<?php echo THEMA_URL; ?>/assets/bs3/js/bootstrap.min.js"></script>
<script src="<?php echo THEMA_URL; ?>/assets/js/sly.min.js"></script>
<script src="<?php echo THEMA_URL; ?>/assets/js/custom.js"></script>
<?php if ($is_sticky_nav) { ?>
	<script src="<?php echo THEMA_URL; ?>/assets/js/sticky.js"></script>
<?php } ?>

<?php //echo apms_widget('basic-sidebar'); //사이드바 및 모바일 메뉴(UI) ?>

<!-- 카페 뮌 헤더 인터랙션 -->
<script>
(function($) {
    'use strict';
	
    // 중복 실행 방지
    if (window.cafeMuenNavInitialized) return;
    window.cafeMuenNavInitialized = true;

    var hd          = document.getElementById('hd');
    var searchBtn   = document.getElementById('search_toggle_btn');
    var searchM     = document.getElementById('search_m');
    var searchPanel = document.getElementById('search_panel');
    var searchClose = document.getElementById('search_close');
    var pcAllBtn    = document.getElementById('pc_all_btn');
    var mAllBtn     = document.getElementById('m_all_btn');
    var $pcAllMenu  = $('#pc_all_menu');
    var mAllMenu    = document.getElementById('m_all_menu');
    var $dummy      = $('#all_dummy');
    var searchInput = document.getElementById('search_stx');

    // ──────────────────────────────────
    // 상태 플래그 (단일 출처)
    // ──────────────────────────────────
    var pcMenuOpen = false;

    // ──────────────────────────────────
    // 검색
    // ──────────────────────────────────
    function openSearch() {
        closePcMenu();
        closeMMenu();
        if (searchPanel) {
            searchPanel.classList.add('open');
            if (searchInput) setTimeout(function(){ searchInput.focus(); }, 100);
        }
    }
    function closeSearch() {
        if (searchPanel) searchPanel.classList.remove('open');
    }

    // ──────────────────────────────────
    // PC 전체메뉴
    // ──────────────────────────────────
    function openPcMenu() {
        if ($pcAllMenu.is(':animated')) return;
        closeSearch();
        closeMMenu();
        pcMenuOpen = true;
        if (pcAllBtn) pcAllBtn.classList.add('on');
        $pcAllMenu.stop(true, true).hide().slideDown(280);
        $dummy.stop(true, true).fadeIn(280);
    }

    function closePcMenu(done) {
        if (!pcMenuOpen) { if(done) done(); return; }
        if ($pcAllMenu.is(':animated')) { $pcAllMenu.stop(true, true); }
        pcMenuOpen = false;
        if (pcAllBtn) pcAllBtn.classList.remove('on');
        $pcAllMenu.slideUp(220, function() {
            if(done) done();
        });
        $dummy.stop(true, true).fadeOut(220);
    }

    function togglePcMenu(e) {
        if (e) { e.preventDefault(); e.stopPropagation(); }
        if (pcMenuOpen) {
            closePcMenu();
        } else {
            openPcMenu();
        }
    }

    // ──────────────────────────────────
    // 모바일 전체메뉴
    // ──────────────────────────────────
    function openMMenu() {
        closeSearch();
        closePcMenu();
        if (mAllMenu) {
            mAllMenu.classList.add('open');
            if (mAllBtn) mAllBtn.classList.add('on');
            $dummy.stop(true, true).fadeIn(220);
            document.body.style.overflow = 'hidden';
        }
    }

    function closeMMenu() {
        if (mAllMenu) {
            mAllMenu.classList.remove('open');
            if (mAllBtn) mAllBtn.classList.remove('on');
            document.body.style.overflow = '';
        }
    }

    function toggleMMenu(e) {
        if (e) { e.preventDefault(); e.stopPropagation(); }
        if (mAllMenu && mAllMenu.classList.contains('open')) {
            closeMMenu();
            $dummy.stop(true, true).fadeOut(220);
        } else {
            openMMenu();
        }
    }

    // ──────────────────────────────────
    // 전체 닫기 (더미 클릭 등)
    // ──────────────────────────────────
    function closeAll() {
        closeSearch();
        closePcMenu();
        closeMMenu();
        $dummy.stop(true, true).fadeOut(220);
    }

    // ──────────────────────────────────
    // 이벤트 바인딩
    // ──────────────────────────────────
    if (searchBtn)   searchBtn.addEventListener('click', openSearch);
    if (searchM)     searchM.addEventListener('click', openSearch);
    if (searchClose) searchClose.addEventListener('click', closeSearch);
    if (pcAllBtn)    pcAllBtn.addEventListener('click', togglePcMenu);
    if (mAllBtn)     mAllBtn.addEventListener('click', toggleMMenu);
    $dummy.on('click', closeAll);

    // 창 크기 변경 시 모바일 메뉴 상태 초기화 (PC 뷰로 전환 시)
    window.addEventListener('resize', function() {
        if (window.innerWidth > 1024) {
            if (mAllMenu && mAllMenu.classList.contains('open')) {
                closeAll();
            }
        }
    });

    // ──────────────────────────────────
    // 모바일 서브메뉴 아코디언
    // ──────────────────────────────────
    if (mAllMenu) {
        $(document).on('click', '#m_all_menu .dep1_a', function(e) {
            var $li = $(this).parent();
            var $sub = $li.children('.dep2_ul');
            if ($sub.length > 0) {
                e.preventDefault();
                var isOpen = $li.hasClass('on');
                
                // 열려있던 다른 메뉴들 닫기
                $('#m_all_menu .dep1_li.on').removeClass('on').children('.dep2_ul').slideUp(200);
                
                // 클릭한 메뉴 닫혀있으면 열기
                if (!isOpen) {
                    $li.addClass('on');
                    $sub.slideDown(200);
                }
            }
        });
    }

    // ──────────────────────────────────
    // GNB 드롭다운 (PC)
    // ──────────────────────────────────
    var gnbItems = document.querySelectorAll('#gnb .dep1_li');
    gnbItems.forEach(function(li) {
        var sub = li.querySelector('.dep2_ul');
        if (!sub) return;
        li.addEventListener('mouseenter', function() { sub.style.display = 'block'; li.classList.add('on'); });
        li.addEventListener('mouseleave', function() { sub.style.display = ''; li.classList.remove('on'); });
        li.addEventListener('focusin',    function() { sub.style.display = 'block'; li.classList.add('on'); });
        li.addEventListener('focusout',   function(e) {
            if (!li.contains(e.relatedTarget)) { sub.style.display = ''; li.classList.remove('on'); }
        });
    });

    // ──────────────────────────────────
    // 스크롤 시 헤더 그림자 & TOP 버튼
    // ──────────────────────────────────
    var topBtn = document.getElementById('top_btn');
    window.addEventListener('scroll', function() {
        if (hd) hd.classList.toggle('scrolled', window.scrollY > 10);
        if (topBtn) topBtn.classList.toggle('show', window.scrollY > 200);
    });

    // ──────────────────────────────────
    // TOP 버튼 클릭
    // ──────────────────────────────────
    if (topBtn) {
        topBtn.addEventListener('click', function() {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

})(jQuery);
</script>


<?php if ($is_designer || $is_demo)
	include_once(THEMA_PATH . '/assets/switcher.php'); //Style Switcher ?>