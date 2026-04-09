<?php
if (!defined('_GNUBOARD_')) exit;
include_once(THEMA_PATH . '/assets/thema.php');

// "문의하기" 메뉴 강제 추가 (고객지원 하위)
if (isset($menu) && is_array($menu)) {
    for ($i = 1; $i < count($menu); $i++) {
        if (isset($menu[$i]['name']) && strpos($menu[$i]['name'], '고객지원') !== false) {
            $menu[$i]['sub'][] = array(
                'name' => '문의하기',
                'href' => G5_BBS_URL.'/qalist.php',
                'on'   => '',
                'is_sub' => false,
                'target' => ''
            );
            $menu[$i]['is_sub'] = true;
            break;
        }
    }
}
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
        <ul class="sub_path at-container mgB80">
            <li><a href="/" title="홈"><iconify-icon icon="solar:home-linear" width="18" height="18"></iconify-icon></a></li>
            <?php if ($group['gr_subject'] && $group['gr_subject'] != $page_title): ?>
                <li><?php echo $group['gr_subject']; ?></li>
            <?php endif; ?>
            <li><?php echo $page_title; ?></li>
        </ul>

        <div class="m_path <?php echo $page_title ? 'sub' : ''; ?>">
            <ul class="m_path_ul">
                <?php
                for ($i = 1; $i < $menu_cnt; $i++) {
                    if (!$menu[$i]['gr_id']) continue;
                    if ($menu[$i]['on'] == "on") { ?>
                    <li class="m_path_dep1">
                        <a class="m_path_dep1_a ellipsis" href="<?php echo $menu[$i]['href']; ?>" <?php echo $menu[$i]['target']; ?>>
                            <?php echo $menu[$i]['name']; ?>
                        </a>
                        <?php if ($menu[$i]['is_sub']) { ?>
                        <ul class="m_path_dep2_ul">
                            <?php for ($j = 0; $j < count($menu[$i]['sub']); $j++) { ?>
                            <li class="m_path_dep2 <?php echo $menu[$i]['sub'][$j]['on']; ?>">
                                <a href="<?php echo $menu[$i]['sub'][$j]['href']; ?>" class="m_path_dep2_a ellipsis" <?php echo $menu[$i]['sub'][$j]['target']; ?>>
                                    <?php echo $menu[$i]['sub'][$j]['name']; ?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </li>
                <?php } } ?>
            </ul>
        </div>

        <h2 class="sub_top_tit at-container mgB80" <?php echo $is_index ? '' : 'id="common_content"'; ?>>
            <?php echo $page_title; ?>
        </h2>
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