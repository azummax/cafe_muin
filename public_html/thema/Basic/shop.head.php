<?php
if (!defined('_GNUBOARD_')) exit;
include_once(THEMA_PATH . '/assets/thema.php');
?>

<a class="skip_a" href="#common_content">본문내용 바로가기</a>
<a class="skip_a skip_a_pc" href="#gnb_start">주메뉴 바로가기</a>
<a class="skip_a skip_a_m" href="#m_all_btn">주메뉴 바로가기</a>

<!-- 딤 처리 배경 -->
<div id="all_dummy"></div>

<!-- 전체 메뉴 (Mobile) -->
<div id="m_all_menu">
    <nav>
        <?php include_once(THEMA_PATH . '/menu-all-m.php'); ?>
    </nav>
</div>

<div id="thema_wrapper" class="wrapper <?php echo $is_thema_layout; ?> <?php echo $is_thema_font; ?>">

    <!-- ============================
         HEADER
         ============================ -->
    <header id="hd" class="<?php if (!$is_index) { echo 'sub'; } ?>">
        <div class="hd_inner">

            <!-- 로고 -->
            <h1 class="hd_logo">
                <a href="<?php echo $at_href['home']; ?>">
                    <img src="/thema/Basic/img/logo.png" alt="카페 뮌" />
                </a>
            </h1>

            <!-- PC GNB -->
            <nav id="gnb">
                <?php include_once(THEMA_PATH . '/menu.php'); ?>
            </nav>

            <!-- PC 우측 유틸 -->
            <div class="hd_utils">
                <!-- 검색 토글 버튼 -->
                <button class="util_btn" id="search_toggle_btn" title="검색">
                    <span>Search</span>
                </button>

                <!-- 로그인/로그아웃 -->
                <?php if ($is_member): ?>
                    <a href="<?php echo $at_href['logout']; ?>" class="util_btn">
                        <span>Logout</span>
                    </a>
                <?php else: ?>
                    <a href="<?php echo $at_href['login']; ?>" class="util_btn">
                        <span>Login</span>
                    </a>
                <?php endif; ?>

                <!-- 장바구니 -->
                <?php if (defined('IS_YC') && IS_YC): ?>
                <a href="<?php echo G5_SHOP_URL; ?>/cart.php" class="util_btn">
                    <span>Cart</span>
                </a>
                <?php endif; ?>

                <!-- 햄버거 버튼 (전체메뉴) -->
                <button id="pc_all_btn" class="hd_hamburger" title="전체메뉴">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div><!-- .hd_utils -->

            <!-- 모바일 전용 우측 -->
            <div class="hd_mo_utils">
                <button id="search_m" class="mo_icon_btn" title="검색">
                    <iconify-icon icon="solar:magnifer-linear" width="22" height="22"></iconify-icon>
                </button>
                <button id="m_all_btn" class="hd_hamburger" title="전체메뉴">
                    <span class="bar"></span>
                    <span class="bar"></span>
                    <span class="bar"></span>
                </button>
            </div>

        </div><!-- .hd_inner -->

        <!-- 검색 패널 (PC + Mobile 공통) -->
        <div id="search_panel">
            <div class="search_panel_inner">
                <form name="tsearch" method="get" onsubmit="return tsearch_submit(this);" role="form">
                    <input type="hidden" name="url" value="<?php echo (defined('IS_YC') && IS_YC) ? $at_href['isearch'] : $at_href['search']; ?>">
                    <div class="search_input_wrap">
                        <input type="text" name="stx" value="<?php echo isset($stx) ? $stx : ''; ?>" placeholder="원하시는 제품을 검색해 보세요." id="search_stx" autocomplete="off">
                        <button type="submit" class="search_submit">
                            <iconify-icon icon="solar:magnifer-linear" width="20" height="20"></iconify-icon>
                        </button>
                        <button type="button" id="search_close" class="search_close">
                            <iconify-icon icon="ri:close-line" width="26" height="26"></iconify-icon>
                        </button>
                    </div>
                </form>
            </div>
        </div><!-- #search_panel -->

        <!-- 전체 메뉴 (PC) -->
        <div id="pc_all_menu">
            <nav class="at-container">
                <?php include_once(THEMA_PATH . '/menu-all.php'); ?>
            </nav>
        </div>

    </header><!-- #hd -->

    <!-- 서브 페이지 경로 / 타이틀 -->
    <?php if ($page_title): ?>
        <?php
        // 현재 활성화된 메뉴명 추적
        $active_dep1_name = '';
        $active_dep2_name = '';

        if(isset($menu) && is_array($menu) && isset($menu_cnt)) {
            for($i = 1; $i < $menu_cnt; $i++) {
                if(isset($menu[$i]['on']) && $menu[$i]['on'] == 'on') {
                    $active_dep1_name = $menu[$i]['name'];
                    if(isset($menu[$i]['sub']) && is_array($menu[$i]['sub'])) {
                        for($j = 0; $j < count($menu[$i]['sub']); $j++) {
                            if(isset($menu[$i]['sub'][$j]['on']) && $menu[$i]['sub'][$j]['on'] == 'on') {
                                $active_dep2_name = $menu[$i]['sub'][$j]['name'];
                                break;
                            }
                        }
                    }
                    break;
                }
            }
        }

        // 메뉴 이름이 있으면 우선 사용, 없으면 기존 page_title / gr_subject 폴백
        $breadcrumb_dep1 = $active_dep1_name ? $active_dep1_name : $group['gr_subject'];
        $breadcrumb_dep2 = $active_dep2_name ? $active_dep2_name : $page_title;
        $main_page_title = $active_dep2_name ? $active_dep2_name : ($active_dep1_name ? $active_dep1_name : $page_title);
        
        // 이벤트 게시판 브레드크럼 카테고리 텍스트 노출 강제 차단
        if(isset($bo_table) && $bo_table == 'event') {
            $breadcrumb_dep2 = '이벤트';
            $main_page_title = '이벤트';
        }
        ?>
        <ul class="sub_path at-container mgB30">
            <li><a href="/" title="홈"><iconify-icon icon="ph:house-light" width="18" height="18"></iconify-icon></a></li>
            <?php if ($breadcrumb_dep1): ?>
                <li><?php echo $breadcrumb_dep1; ?></li>
            <?php endif; ?>
            <?php if ($breadcrumb_dep2 && $breadcrumb_dep1 != $breadcrumb_dep2): ?>
                <li><?php echo $breadcrumb_dep2; ?></li>
            <?php endif; ?>
        </ul>


        <div class="sub_top_tit_wrap at-container mgB30" <?php echo $is_index ? '' : 'id="common_content"'; ?>>
            <h2 class="sub_top_tit">
                <?php echo $main_page_title; ?>
            </h2>
        </div>

        <?php
        // 제품(쇼핑몰) 카테고리가 아닌 경우에만 2차 메뉴 탭 표시
        if (!isset($ca_id) || !$ca_id):
            // 활성 1차 메뉴의 서브메뉴 배열 추출
            $active_sub_menus = array();
            if (isset($menu) && is_array($menu) && isset($menu_cnt)) {
                for ($i = 1; $i < $menu_cnt; $i++) {
                    if (isset($menu[$i]['on']) && $menu[$i]['on'] == 'on') {
                        if (isset($menu[$i]['is_sub']) && $menu[$i]['is_sub'] && !empty($menu[$i]['sub'])) {
                            $active_sub_menus = $menu[$i]['sub'];
                        }
                        break;
                    }
                }
            }
        ?>
        <?php 
          $is_board_subpage = ((basename($_SERVER['PHP_SELF']) == 'board.php' && isset($wr_id) && $wr_id) || basename($_SERVER['PHP_SELF']) == 'write.php');
          if (!empty($active_sub_menus) && (!isset($bo_table) || $bo_table != 'event') && !$is_board_subpage): 
        ?>
        <nav class="sub_tab_nav at-container">
            <ul class="sub_tab_ul">
                <?php foreach ($active_sub_menus as $stab): ?>
                <li class="sub_tab_li <?php echo (isset($stab['on']) && $stab['on'] == 'on') ? 'on' : ''; ?>">
                    <a href="<?php echo $stab['href']; ?>" class="sub_tab_a" <?php echo isset($stab['target']) ? $stab['target'] : ''; ?>>
                        <?php echo $stab['name']; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
        <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <div class="at-body" <?php echo $is_index ? 'id="common_content"' : ''; ?>>
        <?php if ($col_name): ?>
            <div class="at-container">
                <?php if ($col_name == "two"): ?>
                    <div class="row at-row">
                        <div class="col-md-<?php echo $col_content; ?><?php echo $at_set['side'] ? ' pull-right' : ''; ?> at-col at-main">
                <?php else: ?>
                    <div class="at-content">
                <?php endif; ?>
        <?php endif; ?>