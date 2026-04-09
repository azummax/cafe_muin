<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);
add_stylesheet('<link rel="stylesheet" href="/css/mypage_common.css" media="screen">', 0);

// 목록헤드
if(isset($wset['ihead']) && $wset['ihead']) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/head/'.$wset['ihead'].'.css" media="screen">', 0);
	$head_class = 'list-head';
} else {
	$head_class = (isset($wset['icolor']) && $wset['icolor']) ? 'tr-head border-'.$wset['icolor'] : 'tr-head border-black';
}

// 헤더 출력
if($header_skin)
	include_once('./header.php');

?>

<?php include($member_skin_path.'/mypage_top.php'); //마이페이지 상단 ?>
<div class="mypage_container">
	<?php include($member_skin_path.'/mypage_sidebar.php'); //마이페이지 메뉴 ?>
	<div class="mypage_content">
		<strong class="order_tit">주문내역</strong>
	
		<div class="order_list_box mgB60">
			<?php for ($i=0; $i < count($list); $i++) { ?>
				<div class="order_list_item">
					<strong class="order_date"><?php echo date("Y.m.d", strtotime($list[$i]['od_time'])); ?></strong>
					<div class="order_detail">
						<div class="order_item">
							<span class="box01">
								<?php echo get_it_image($item[$i]['it_id'], 75, 75); ?>
							</span>
							<span class="box02">
								<a href="<?php echo $list[$i]['od_href']; ?>"><?php echo $item[$i]['good_name']; ?></a>
								<b><?php echo display_price($list[$i]['od_total_price']); ?></b>
							</span>
							<span class="box03">
								<strong><?php echo $list[$i]['od_status']; ?></strong>
							</span>
							<span class="box04">
								<a href="<?php echo G5_BBS_URL;?>/qalist.php">1:1 문의</a>
							</span>
						</div>
						<div class="order_number">
							<input type="hidden" name="ct_id[<?php echo $i; ?>]" value="<?php echo $list[$i]['ct_id']; ?>">
							<a href="<?php echo $list[$i]['od_href']; ?>"><b>주문번호</b> <?php echo $list[$i]['od_id']; ?></a>
						</div>
					</div>
				</div>
			<?php } ?>
			<?php if ($i == 0) { ?>
				<div class="well"><strong>주문 내역이 없습니다.</strong></div>
			<?php } ?>
		</div>

		<div class="text-center">
			<ul class="pagination pagination-sm en">
				<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
			</ul>
		</div>

		<?php if($setup_href) { ?>
			<p class="text-center">
				<a class="btn btn-color btn-sm win_memo" href="<?php echo $setup_href;?>">
					<i class="fa fa-cogs"></i> 스킨설정
				</a>
			</p>
		<?php } ?>
	</div><!--mypage_content end-->
</div><!--mypage_container end-->