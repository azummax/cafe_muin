<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);
add_stylesheet('<link rel="stylesheet" href="/css/mypage_common.css" media="screen">', 0);

if($header_skin)
	include_once('./header.php');

?>

<?php include($member_skin_path.'/mypage_top.php'); //마이페이지 상단 ?>
<div class="mypage_container">
	<?php include($member_skin_path.'/mypage_sidebar.php'); //마이페이지 메뉴 ?>
	<div class="mypage_content">
		<section>
			<h4>최근 주문내역</h4>
			<?php
				// 최근 주문내역
			    $sql = " select * from {$g5['g5_shop_order_table']} where mb_id = '{$member['mb_id']}' order by od_id desc limit 0, 5 ";
			    $result = sql_query($sql);
			?>
			<div class="table-responsive">
				<table class="table mypage-tbl">			
				<thead>
				<tr>
					<th scope="col">주문서번호</th>
					<th scope="col">주문일시</th>
					<th scope="col">상품수</th>
					<th scope="col">주문금액</th>
					<th scope="col">입금액</th>
					<th scope="col">미입금액</th>
					<th scope="col">상태</th>
				</tr>
				</thead>
			    <tbody>
			    <?php 
				for ($i=0; $row=sql_fetch_array($result); $i++) {
			        $uid = md5($row['od_id'].$row['od_time'].$row['od_ip']);

					switch($row['od_status']) {
						case '주문' : $od_status = '입금확인중'; break;
						case '입금' : $od_status = '입금완료'; break;
						case '준비' : $od_status = '상품준비중'; break;
						case '배송' : $od_status = '상품배송'; break;
						case '완료' : $od_status = '배송완료'; break;
						default		: $od_status = '주문취소'; break;
					}
			    ?>
					<tr>
						<td>
							<input type="hidden" name="ct_id[<?php echo $i; ?>]" value="<?php echo $row['ct_id']; ?>">
							<a href="<?php echo G5_SHOP_URL; ?>/orderinquiryview.php?od_id=<?php echo $row['od_id']; ?>&amp;uid=<?php echo $uid; ?>"><?php echo $row['od_id']; ?></a>
						</td>
						<td><?php echo substr($row['od_time'],2,14); ?> (<?php echo get_yoil($row['od_time']); ?>)</td>
						<td><?php echo $row['od_cart_count']; ?></td>
						<td><?php echo display_price($row['od_cart_price'] + $row['od_send_cost'] + $row['od_send_cost2']); ?></td>
						<td><?php echo display_price($row['od_receipt_price']); ?></td>
						<td><?php echo display_price($row['od_misu']); ?></td>
						<td><?php echo $od_status; ?></td>
					</tr>
			    <?php } ?>
				<?php if ($i == 0) { ?>
					<tr><td colspan="7" class="empty_table">주문 내역이 없습니다.</td></tr>
				<?php } ?>
			    </tbody>
			    </table>
			</div>
			<p class="text-right">
				<a href="./orderinquiry.php"><i class="fa fa-arrow-right"></i> 주문내역 더보기</a>
			</p>
		</section>
	</div>
</div><!--mypage_container end-->