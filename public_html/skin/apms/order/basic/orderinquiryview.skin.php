<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);
add_stylesheet('<link rel="stylesheet" href="/css/mypage_common.css" media="screen">', 0);

// 목록헤드
if(isset($wset['ivhead']) && $wset['ivhead']) {
	add_stylesheet('<link rel="stylesheet" href="'.G5_CSS_URL.'/head/'.$wset['ivhead'].'.css" media="screen">', 0);
	$head_class = 'list-head';
} else {
	$head_class = (isset($wset['ivcolor']) && $wset['ivcolor']) ? 'tr-head border-'.$wset['ivcolor'] : 'tr-head border-black';
}

// 헤더 출력
if($header_skin)
	include_once('./header.php');

?>

<?php include($member_skin_path.'/mypage_top.php'); //마이페이지 상단 ?>
<div class="mypage_container">
	<?php include($member_skin_path.'/mypage_sidebar.php'); //마이페이지 메뉴 ?>
	<div class="mypage_content">
		<style>
			.delivery-info { margin:0px; padding:0px; padding-left:15px; line-height:22px; white-space:nowrap; text-align:center; }
		</style>

		<strong class="order_tit mgB40">주문내역 상세</strong>

		<strong class="order_tit02"><span>주문번호</span><?php echo $od_id; ?></strong>

		<div class="order_table_box line_box mgB40">
			<table>
			<colgroup>
				<col width="9%" />
				<col width="" />
				<col width="8%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="10%" />
				<col width="15%" />
			</colgroup>
			<tbody>
			<tr class="<?php echo $head_class;?>">
				<th scope="col"><span>이미지</span></th>
				<th scope="col"><span>상품명 / 옵션명</span></th>
				<th scope="col"><span>수량</span></th>
				<th scope="col"><span>판매가</span></th>
				<th scope="col"><span>상품금액</span></th>
				<th scope="col"><span>적립금</span></th>
				<th scope="col"><span>상태</span></th>
				<th scope="col"><span class="last">배송/이용정보</span></th>
			</tr>
			<?php for($i=0; $i < count($item); $i++) { ?>
				<?php for($k=0; $k < count($item[$i]['opt']); $k++) { ?>
					<?php if($k == 0) { ?>
						<tr<?php echo ($i == 0) ? ' class="tr-line"' : '';?>>
							<td class="text-center no_line" rowspan="<?php echo $item[$i]['rowspan']; ?>">
								<div class="item-img">
									<?php echo get_it_image($item[$i]['it_id'], 75, 75); ?>
									<!-- <div class="item-type"><?php echo $item[$i]['pt_it']; ?></div> -->
								</div>
							</td>
							<td colspan="6" class="left_txt"><a href="./item.php?it_id=<?php echo $item[$i]['it_id']; ?>"><strong><?php echo $item[$i]['it_name']; ?></strong></a></td>
							<td class="no_line" rowspan="<?php echo $item[$i]['rowspan']; ?>">
								<ul class="delivery-info">
									<?php if($item[$i]['seller']) { // 판매자?>
										<li><b><?php echo $item[$i]['seller'];?></b></li>
									<?php } ?>
									<li>
										<?php echo $item[$i]['ct_send_cost'];?>배송
										<?php if($item[$i]['sendcost']) { // 개별배송비 ?>
											(<?php echo number_format($item[$i]['sendcost']);?>원)
										<?php } ?>
									</li>
									<?php if ($item[$i]['is_delivery']) { // 배송가능 ?>

										<?php if($item[$i]['de_company'] && $item[$i]['de_invoice']) { ?>
											<li>
												<?php echo $item[$i]['de_company'];?>
												<?php echo $item[$i]['de_invoice'];?>
											</li>
											<?php if($item[$i]['de_check']) { ?>
												<li>
													<?php echo str_replace("문의전화: ", "", $item[$i]['de_check']);?>
												</li>
											<?php } ?>
										<?php } ?>
										<?php if($item[$i]['de_confirm']) { //수령확인 ?>
											<li>
												<a href="<?php echo $item[$i]['de_confirm'];?>" class="delivery-confirm">
													<span class="orangered">수령확인</span>
												</a>
											</li>
										<?php } ?>

									<?php } else { //배송불가 - 컨텐츠 ?>

										<?php if($list[$i]['use_date']) { ?>
											<li>최종일시 : <?php echo $list[$i]['use_date'];?></li>
										<?php } ?>
										<?php if($list[$i]['use_file']) { ?>
											<li>최종자료 : <?php echo $list[$i]['use_file'];?></li>
										<?php } ?>
										<?php if($list[$i]['use_cnt']) { ?>
											<li>이용횟수 : <?php echo number_format($list[$i]['use_cnt']);?>회</li>
										<?php } ?>

									<?php } ?>
								</ul>
							</td>
						</tr>
					<?php } ?>
					<tr>
						<td class="left_txt"><?php echo $item[$i]['opt'][$k]['ct_option']; ?></td>
						<td class="text-center"><?php echo number_format($item[$i]['opt'][$k]['ct_qty']); ?></td>
						<td class="text-right"><?php echo number_format($item[$i]['opt'][$k]['opt_price']); ?></td>
						<td class="text-right"><?php echo number_format($item[$i]['opt'][$k]['sell_price']); ?></td>
						<td class="text-right"><?php echo number_format($item[$i]['opt'][$k]['point']); ?></td>
						<td class="text-center"><?php echo $item[$i]['opt'][$k]['ct_status']; ?></td>
					</tr>
				<?php } ?>
			<?php } ?>
			</tbody>
			</table>
		</div>

		<div class="total_info_box mgB70">
			<ul>
				<li>
					<div class="left_box">주문총액</div>
					<div class="right_box">
						<strong><?php echo number_format($od['od_cart_price']); ?><span>원</span></strong>
					</div>
				</li>
				<?php if($od['od_cart_coupon'] > 0) { ?>
				<li>
					<div class="left_box">개별상품 쿠폰할인</div>
					<div class="right_box">
						<strong><?php echo number_format($od['od_cart_coupon']); ?><span>원</span></strong>
					</div>
				</li>
				<?php } ?>
				<?php if($od['od_coupon'] > 0) { ?>
				<li>
					<div class="left_box">주문금액 쿠폰할인</div>
					<div class="right_box">
						<strong><?php echo number_format($od['od_coupon']); ?><span>원</span></strong>
					</div>
				</li>
				<?php } ?>
				<?php if ($od['od_send_cost'] > 0) { ?>
				<li>
					<div class="left_box">배송비</div>
					<div class="right_box">
						<strong><?php echo number_format($od['od_send_cost']); ?><span>원</span></strong>
					</div>
				</li>
				<?php } ?>
				<?php if($od['od_send_coupon'] > 0) { ?>
				<li>
					<div class="left_box">배송비 쿠폰할인</div>
					<div class="right_box">
						<strong><?php echo number_format($od['od_send_coupon']); ?><span>원</span></strong>
					</div>
				</li>
				<?php } ?>
				<?php if ($od['od_send_cost2'] > 0) { ?>
				<li>
					<div class="left_box">추가배송비</div>
					<div class="right_box">
						<strong><?php echo number_format($od['od_send_cost2']); ?><span>원</span></strong>
					</div>
				</li>
				<?php } ?>
				<?php if ($od['od_cancel_price'] > 0) { ?>
				<li>
					<div class="left_box">취소금액</div>
					<div class="right_box">
						<strong><?php echo number_format($od['od_cancel_price']); ?><span>원</span></strong>
					</div>
				</li>
				<?php } ?>
				<li class="total">
					<div class="left_box"> <b>합계</b></div>
					<div class="right_box">
						<strong><?php echo number_format($tot_price); ?><span>원</span></strong>
					</div>
				</li>
				<li class="point">
					<div class="left_box">적립 예정 적립금 <span>(비회원으로 주문하시는 경우 적립금은 지급되지 않습니다.)</span></div>
					<div class="right_box">
						<strong><?php echo number_format($tot_point); ?><span>원</span></strong>
					</div>
				</li>
			</ul>
		</div>

		<strong class="order_tit">결제정보</strong>
		<div class="order_table_box mgB70">
			<table class="table_left">
				<colgroup>
					<col width="15%" />
					<col width="85%" />
				</colgroup>
				<tbody>
					<tr>
						<th scope="row">주문번호</th>
						<td><?php echo $od_id; ?></td>
					</tr>
					<tr>
						<th scope="row">주문일시</th>
						<td><?php echo $od['od_time']; ?></td>
					</tr>
					<tr>
						<th scope="row">결제방식</th>
						<td><?php echo ($easy_pay_name ? $easy_pay_name.'('.$od['od_settle_case'].')' : check_pay_name_replace($od['od_settle_case']) ); ?></td>
					</tr>
					<tr class="active">
						<th scope="row">결제금액</th>
						<td><?php echo $od_receipt_price; ?></td>
					</tr>
					<?php if($od['od_receipt_price'] > 0) {	?>
					<tr>
						<th scope="row">결제일시</th>
						<td><?php echo $od['od_receipt_time']; ?></td>
					</tr>
					<?php } ?>
					<?php if($app_no_subj) { // 승인번호, 휴대폰번호, 거래번호 ?>
					<tr>
						<th scope="row"><?php echo $app_no_subj; ?></th>
						<td><?php echo $app_no; ?></td>
					</tr>
					<?php } ?>
					<?php if($disp_bank) { // 계좌정보 ?>
					<tr>
						<th scope="row">입금자명</th>
						<td><?php echo get_text($od['od_deposit_name']); ?></td>
					</tr>
					<tr>
						<th scope="row">입금계좌</th>
						<td><?php echo get_text($od['od_bank_account']); ?></td>
					</tr>
					<?php } ?>
					<?php if($disp_receipt_href) { ?>
					<tr>
						<th scope="row">영수증</th>
						<td><a <?php echo $disp_receipt_href;?>>영수증 출력</a></td>
					</tr>
					<?php } ?>
					<?php if ($od['od_receipt_point'] > 0) { ?>
					<tr>
						<th scope="row">적립금사용</th>
						<td><?php echo display_point($od['od_receipt_point']); ?></td>
					</tr>
					<?php } ?>
					<?php if ($od['od_refund_price'] > 0) { ?>
					<tr>
						<th scope="row">환불 금액</th>
						<td><?php echo display_price($od['od_refund_price']); ?></td>
					</tr>
					<?php } ?>
					<?php if($taxsave_href) { ?>
					<tr>
						<th scope="row">현금영수증</th>
						<td>
							<a <?php echo $taxsave_href;?> class="btn btn-black btn-xs">
								<?php echo ($taxsave_confirm) ? '현금영수증 확인하기' : '현금영수증을 발급하시려면 클릭하십시오.';?>
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>

		<?php if($is_orderform) { ?>
			<strong class="order_tit">주문하신 분</strong>
			<div class="order_table_box mgB70">
				<table class="table_left">
					<colgroup>
						<col width="15%" />
						<col width="85%" />
					</colgroup>
					<tbody>
						<tr>
							<th scope="row">이 름</th>
							<td><?php echo get_text($od['od_name']); ?></td>
						</tr>
						<tr>
							<th scope="row">전화번호</th>
							<td><?php echo get_text($od['od_tel']); ?></td>
						</tr>
						<tr>
							<th scope="row">핸드폰</th>
							<td><?php echo get_text($od['od_hp']); ?></td>
						</tr>
						<tr>
							<th scope="row">주 소</th>
							<td><?php echo get_text(sprintf("(%s%s)", $od['od_zip1'], $od['od_zip2']).' '.print_address($od['od_addr1'], $od['od_addr2'], $od['od_addr3'], $od['od_addr_jibeon'])); ?></td>
						</tr>
						<tr>
							<th scope="row">E-mail</th>
							<td><?php echo get_text($od['od_email']); ?></td>
						</tr>
					</tbody>
				</table>
			</div>

			<strong class="order_tit">받으시는 분</strong>
			<div class="order_table_box mgB70">
				<table class="table_left">
					<colgroup>
						<col width="15%" />
						<col width="85%" />
					</colgroup>
					<tbody>
						<tr>
							<th scope="row">이 름</th>
							<td><?php echo get_text($od['od_b_name']); ?></td>
						</tr>
						<tr>
							<th scope="row">전화번호</th>
							<td><?php echo get_text($od['od_b_tel']); ?></td>
						</tr>
						<tr>
							<th scope="row">핸드폰</th>
							<td><?php echo get_text($od['od_b_hp']); ?></td>
						</tr>
						<tr>
							<th scope="row">주 소</th>
							<td><?php echo get_text(sprintf("(%s%s)", $od['od_b_zip1'], $od['od_b_zip2']).' '.print_address($od['od_b_addr1'], $od['od_b_addr2'], $od['od_b_addr3'], $od['od_b_addr_jibeon'])); ?></td>
						</tr>
						<?php if ($default['de_hope_date_use']) { // 희망배송일을 사용한다면 ?>
						<tr>
							<th scope="row">희망배송일</th>
							<td><?php echo substr($od['od_hope_date'],0,10).' ('.get_yoil($od['od_hope_date']).')' ;?></td>
						</tr>
						<?php } ?>
						<?php if ($od['od_memo']) { ?>
						<tr>
							<th scope="row">전하실 말씀</th>
							<td><?php echo conv_content($od['od_memo'], 0); ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>

			<strong class="order_tit">배송정보</strong>
			<div class="order_table_box mgB70">
				<table class="table_left">
					<colgroup>
						<col width="15%" />
						<col width="85%" />
					</colgroup>
					<tbody>
						<?php if ($od['od_invoice'] && $od['od_delivery_company']) {?>
						<tr>
							<th scope="row">배송회사</th>
							<td><?php echo $od['od_delivery_company']; ?> <?php echo get_delivery_inquiry($od['od_delivery_company'], $od['od_invoice'], 'dvr_link'); ?></td>
						</tr>
						<tr>
							<th scope="row">운송장번호</th>
							<td><?php echo $od['od_invoice']; ?></td>
						</tr>
						<tr>
							<th scope="row">배송일시</th>
							<td><?php echo $od['od_invoice_time']; ?></td>
						</tr>
						<?php }	else { ?>
						<tr>
							<td colspan="2">아직 배송하지 않았거나 배송정보를 입력하지 못하였습니다.</td>
						</tr>
						<?php }	?>
					</tbody>
				</table>
			</div>
		<?php } ?>

		<strong class="order_tit">결제합계</strong>
		<div class="order_table_box">
			<table class="table_left" style="min-width:auto;">
				<colgroup>
					<col width="85%" />
					<col width="15%" />
				</colgroup>
				<tbody>
					<tr>	
						<th scope="row">총구매액</th>
						<td class="right_txt"><strong><?php echo display_price($tot_price); ?></strong></td>
					</tr>
					<?php if ($misu_price > 0) { ?>
					<tr class="active">
						<th scope="row">미결제액</th>
						<td class="right_txt"><strong><?php echo display_price($misu_price);?></strong></td>
					</tr>
					<?php } ?> 
					<tr>
						<th scope="row" id="alrdy">결제금액</th>
						<td class="right_txt"><strong><?php echo $wanbul; ?></strong></td>
					</tr>
				</tbody>
			</table>
		</div>

		<?php if($cancel_price != 0){ // 취소한 내역이 있다면 ?>
			<div class="no_desc mgT30">주문 취소, 반품, 품절된 내역이 있습니다.</div>
		<?php } ?>

		<?php if ($is_account_test) { ?>
			<div class="alert alert-danger">
				관리자가 가상계좌 테스트를 한 경우에만 보입니다.
			</div>

			<form class="form" role="form" method="post" action="http://devadmin.kcp.co.kr/Modules/Noti/TEST_Vcnt_Noti_Proc.jsp" target="_blank">
				<div class="panel panel-default">
					<div class="panel-heading"><strong><i class="fa fa-cog fa-lg"></i> 모의입금처리</strong></div>
					<div class="table-responsive">
						<table class="div-table table bsk-tbl bg-white">
						<col width="120">
						<tbody>
						<tr>
							<th scope="col"><label for="e_trade_no">KCP 거래번호</label></th>
							<td><input type="text" name="e_trade_no" value="<?php echo $od['od_tno']; ?>" class="form-control input-sm"></td>
						</tr>
						<tr>
							<th scope="col"><label for="deposit_no">입금계좌</label></th>
							<td><input type="text" name="deposit_no" value="<?php echo $deposit_no; ?>" class="form-control input-sm"></td>
						</tr>
						<tr>
							<th scope="col"><label for="req_name">입금자명</label></th>
							<td><input type="text" name="req_name" value="<?php echo $od['od_deposit_name']; ?>" class="form-control input-sm"></td>
						</tr>
						<tr>
							<th scope="col"><label for="noti_url">입금통보 URL</label></th>
							<td><input type="text" name="noti_url" value="<?php echo G5_SHOP_URL; ?>/settle_kcp_common.php" class="form-control input-sm"></td>
						</tr>
						</tbody>
						</table>
					</div>
				</div>
				<div id="sod_fin_test" class="text-center">
					<input type="submit" value="입금통보 테스트" class="btn btn-color btn-sm">
				</div>
			</form>
		<?php } ?>

		<?php if ($cancel_price == 0) { // 취소한 내역이 없다면 ?>
			<?php if ($custom_cancel) { ?>
				<div id="sod_fin_cancelfrm" class="collapse">
					<form class="form" role="form" method="post" action="./orderinquirycancel.php" onsubmit="return fcancel_check(this);">
						<input type="hidden" name="od_id"  value="<?php echo $od['od_id']; ?>">
						<input type="hidden" name="token"  value="<?php echo $token; ?>">
						<div class="input_box">
							<label for="cancel_memo">사유</label>
							<input type="text" name="cancel_memo" id="cancel_memo" required class="form-control input-sm" size="40" maxlength="100">
							<button type="submit" class="btn btn-black btn-sm">확인</button>
						</div>
					</form>
				</div>
			<?php } ?>
		<?php } ?>

		<div class="print-hide order_btn_box grid3 mgT60">
			<?php if ($cancel_price == 0) { // 취소한 내역이 없다면 ?>
				<?php if ($custom_cancel) { ?>
					<button type="button" data-toggle="collapse" href="#sod_fin_cancelfrm" aria-expanded="false" aria-controls="sod_fin_cancelfrm" class="order_btn">주문 취소</button>
				<?php } ?>
			<?php } ?>
			<a href="./orderinquiry.php" class="order_btn">목록보기</a>
			<button type="button" onclick="apms_print();" class="order_btn">프린트하기</button>
		</div>

		<?php if($setup_href) { ?>
			<div class="print-hide text-center mgT30">
				<a class="btn btn-color btn-sm win_memo" href="<?php echo $setup_href;?>"><i class="fa fa-cogs"></i> 스킨설정</a>
			</div>
		<?php } ?>

		<script>
		function fcancel_check(f) {
			if(!confirm("주문을 정말 취소하시겠습니까?"))
				return false;

			var memo = f.cancel_memo.value;
			if(memo == "") {
				alert("취소사유를 입력해 주십시오.");
				return false;
			}

			return true;
		}

		$(function(){
			$(".delivery-confirm").click(function(){
				if(confirm("상품을 수령하셨습니까?\n\n확인시 배송완료 처리가됩니다.")) {
					return true;
				}
				return false;
			});
		});
		</script>
	</div>
</div>
