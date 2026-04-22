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
						case '주문' : $od_status = '입금확인중'; $status_class = 'confirm'; break;
						case '입금' : $od_status = '입금완료';   $status_class = 'paid';    break;
						case '준비' : $od_status = '상품준비중'; $status_class = 'ready';   break;
						case '배송' : $od_status = '상품배송';   $status_class = 'shipping'; break;
						case '완료' : $od_status = '배송완료';   $status_class = 'done';    break;
						default		: $od_status = '주문취소';   $status_class = 'cancel';  break;
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
						<td>
							<div style="margin-bottom:6px;">
								<span class="status-badge status-<?php echo $status_class; ?>"><?php echo $od_status; ?></span>
							</div>
							<div class="action-btn-group" style="display:flex; flex-direction:column; gap:4px;">
								<a href="<?php echo G5_SHOP_URL; ?>/orderinquiryview.php?od_id=<?php echo $row['od_id']; ?>&amp;uid=<?php echo $uid; ?>" class="btn-action view">주문상세</a>
								<a href="javascript:void(0);" onclick="window.open('<?php echo G5_SHOP_URL; ?>/orderreceipt.php?od_id=<?php echo $row['od_id']; ?>&amp;uid=<?php echo $uid; ?>', 'receipt', 'width=600,height=800,scrollbars=yes');" class="btn-action print">거래명세서</a>
							</div>
						</td>
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

		<section style="margin-top:50px;">
			<h4>최근 나의 문의 및 활동</h4>
			<?php
			// 나의 최근 게시물 추출
			$sql_new = " select a.*, b.bo_subject, c.wr_subject, c.wr_datetime 
						 from {$g5['board_new_table']} a,
							  {$g5['board_table']} b,
							  {$g5['write_prefix']}qa c
						 where a.mb_id = '{$member['mb_id']}'
						   and a.bo_table = b.bo_table 
						   and a.bo_table = 'qa'
						   and a.wr_id = c.wr_id 
						 order by a.bn_id desc limit 0, 5 ";
						 // 임의로 데이터를 보이기 위해 쿼리 단순화 및 일반 게시글(board_new) 조회
			
			$sql_new = " select a.*, b.bo_subject 
						 from {$g5['board_new_table']} a 
						 join {$g5['board_table']} b on a.bo_table = b.bo_table 
						 where a.mb_id = '{$member['mb_id']}' 
						 order by a.bn_id desc limit 0, 5 ";
			$res_new = sql_query($sql_new);
			?>
			<div class="table-responsive">
				<table class="table mypage-tbl">			
				<thead>
				<tr>
					<th scope="col" style="width:120px;">게시판</th>
					<th scope="col">제목</th>
					<th scope="col" style="width:120px;">작성일</th>
				</tr>
				</thead>
				<tbody>
				<?php 
				$new_cnt = 0;
				for ($i=0; $row=sql_fetch_array($res_new); $i++) {
					$new_cnt++;
					$tmp_write_table = $g5['write_prefix'] . $row['bo_table'];
					$wr = sql_fetch(" select wr_subject, wr_datetime from {$tmp_write_table} where wr_id = '{$row['wr_id']}' ");
					if(!$wr) continue;
				?>
					<tr>
						<td><?php echo $row['bo_subject']; ?></td>
						<td class="text-left"><a href="<?php echo G5_BBS_URL; ?>/board.php?bo_table=<?php echo $row['bo_table']; ?>&amp;wr_id=<?php echo $row['wr_id']; ?>"><?php echo conv_subject($wr['wr_subject'], 120, '...'); ?></a></td>
						<td><?php echo date("Y-m-d", strtotime($wr['wr_datetime'])); ?></td>
					</tr>
				<?php } ?>
				
				<?php if ($new_cnt == 0) { ?>
					<tr><td colspan="3" class="empty_table">최근 문의 내역이 없습니다.</td></tr>
				<?php } ?>
				</tbody>
				</table>
			</div>
		</section>
	</div>
</div><!--mypage_container end-->