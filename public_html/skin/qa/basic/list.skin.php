<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);
add_stylesheet('<link rel="stylesheet" href="/skin/board/Basic-Board/style.css" media="screen">', 0);
add_stylesheet('<link rel="stylesheet" href="/css/mypage_common.css" media="screen">', 0);

// 헤더 출력
if($header_skin)
	include_once('./header.php');

$is_view = false;
$list_cnt = count($list);

?>

<?php include($member_skin_path.'/mypage_top.php'); //마이페이지 상단 ?>
<div class="mypage_container">
	<?php include($member_skin_path.'/mypage_sidebar.php'); //마이페이지 메뉴 ?>
	<div class="mypage_content">
		<strong class="order_tit" style="border:0;">1:1 문의</strong>

		<section class="qa-list<?php echo (G5_IS_MOBILE) ? ' font-14' : '';?>"> 
			<!-- <div class="qa_search">
				<strong class="qa_total">Total<b><?php echo $total_count; ?></b></strong>
				<div class="qa_search_box">
					<form name="fsearch" method="get" role="form" class="form">
						<input type="hidden" name="sca" value="<?php echo $sca ?>">
						<label for="stx" class="sound_only">검색어</label>
						<input type="text" name="stx" value="<?php echo stripslashes($stx) ?>" required id="stx" class="input_com" maxlength="15">
						<button type="submit">검색</button>
					</form>
				</div>
			</div> -->

			<?php if($category_option) include_once($skin_path.'/category.skin.php'); // 카테고리 ?>

			<div class="list-wrap">
				<form name="fqalist" id="fqalist" action="./qadelete.php" onsubmit="return fqalist_submit(this);" method="post" role="form" class="form">
				<input type="hidden" name="stx" value="<?php echo $stx; ?>">
				<input type="hidden" name="sca" value="<?php echo $sca; ?>">
				<input type="hidden" name="page" value="<?php echo $page; ?>">
				<input type="hidden" name="token" value="<?php echo get_text($token); ?>">

					<?php include_once($skin_path.'/list.rows.php'); ?>

					<div class="list-btn-box">
						<?php if ($is_checkbox || $admin_href || $setup_href) { ?>
							<div class="text-center">
								<?php if ($is_checkbox) { ?>
									<input type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value" class="btn btn-black btn-sm">
								<?php } ?>
								<?php if ($admin_href) { ?>
									<a href="<?php echo $admin_href ?>" class="btn btn-black btn-sm"><i class="fa fa-cog"></i></a>
								<?php } ?>
								<?php if($setup_href) { ?>
									<a class="btn btn-color btn-sm win_memo" href="<?php echo $setup_href;?>">
										<i class="fa fa-cogs"></i> 스킨설정
									</a>
								<?php } ?>
							</div>
						<?php } ?>
						<?php if ($write_href) { ?>
							<a href="<?php echo $write_href ?>" class="board_btn">글쓰기</a>
						<?php } ?>
					</div>
				</form>
			</div>

			<?php if($is_checkbox) { ?>
				<noscript>
				<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
				</noscript>
			<?php } ?>

			<div class="list-page text-center">
				<ul class="pagination pagination-sm en">
					<?php echo preg_replace('/(\.php)(&amp;|&)/i', '$1?', apms_paging(G5_IS_MOBILE ? $config['cf_mobile_pages'] : $config['cf_write_pages'], $page, $total_page, './qalist.php'.$qstr.'&amp;page='));?>
				</ul>
			</div>

			<div class="clearfix"></div>
		</section>
	</div>
</div>

<?php if ($is_checkbox) { ?>
<script>
function all_checked(sw) {
    var f = document.fqalist;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]")
            f.elements[i].checked = sw;
    }
}

function fqalist_submit(f) {
    var chk_count = 0;

    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_qa_id[]" && f.elements[i].checked)
            chk_count++;
    }

    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }

    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다"))
            return false;
    }

    return true;
}
</script>
<?php } ?>
