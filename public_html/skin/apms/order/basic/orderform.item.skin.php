<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<div class="table-responsive order-item mgB70">
	<table id="sod_list" class="div-table table bg-white bsk-tbl">
	<tbody>
	<colgroup>
		<col width="10%" />
		<col width="" />
		<col width="6%" />
		<col width="10%" />
		<col width="8%" />
		<col width="10%" />
		<col width="8%" />
		<col width="8%" />
	</colgroup>
	<tr class="tr-head">
		<th scope="col"><span>이미지</span></th>
		<th scope="col"><span>상품명</span></th>
		<th scope="col"><span>수량</span></th>
		<th scope="col"><span>판매가</span></th>
		<th scope="col"><span>쿠폰</span></th>
		<th scope="col"><span>상품금액</span></th>
		<th scope="col"><span>적립금</span></th>
		<th scope="col"><span class="last">배송비</span></th>
	</tr>
	<?php for($i=0; $i < count($item); $i++) { ?>
		<tr<?php echo ($i == 0) ? ' class="tr-line"' : '';?>>
			<td class="text-center img_box">
				<div class="item-img">
					<?php echo get_it_image($item[$i]['it_id'], 100, 100); ?>
					<!-- <div class="item-type"><?php echo $item[$i]['pt_it']; ?></div> -->
				</div>
			</td>
			<td>
				<input type="hidden" name="it_id[<?php echo $i; ?>]"    value="<?php echo $item[$i]['hidden_it_id']; ?>">
				<input type="hidden" name="it_name[<?php echo $i; ?>]"  value="<?php echo $item[$i]['hidden_it_name']; ?>">
				<input type="hidden" name="it_price[<?php echo $i; ?>]" value="<?php echo $item[$i]['hidden_sell_price']; ?>">
				<input type="hidden" name="cp_id[<?php echo $i; ?>]" value="<?php echo $item[$i]['hidden_cp_id']; ?>">
				<input type="hidden" name="cp_price[<?php echo $i; ?>]" value="<?php echo $item[$i]['hidden_cp_price']; ?>">
				<?php if($default['de_tax_flag_use']) { ?>
					<input type="hidden" name="it_notax[<?php echo $i; ?>]" value="<?php echo $item[$i]['hidden_it_notax']; ?>">
				<?php } ?>
				<strong class="item_name"><?php echo $item[$i]['it_name']; ?></strong>
				<?php if($item[$i]['it_options']) { ?>
					<div class="item_option"><?php echo $item[$i]['it_options'];?></div>
				<?php } ?>
			</td>
			<td class="text-center"><?php echo $item[$i]['qty']; ?></td>
			<td class="text-center"><?php echo $item[$i]['ct_price']; ?></td>
			<td class="text-center">
				<?php if($item[$i]['is_coupon']) { ?>
					<div class="btn-group">
						<button type="button" class="cp_btn btn btn-black btn-xs">적용</button>
					</div>
				<?php }else{ ?>
					-
				<?php } ?>
			</td>
			<td class="text-center"><b><?php echo $item[$i]['total_price']; ?></b></td>
			<td class="text-center"><?php echo $item[$i]['point']; ?></td>
			<td class="text-center"><?php echo $item[$i]['ct_send_cost']; ?></td>
		</tr>
	<?php } ?>
	</tbody>
	</table>
</div>

<?php if ($goods_count) $goods .= ' 외 '.$goods_count.'건'; ?>

<!-- 주문상품 합계 시작 { -->
<div class="final_price_box mgB70">
	<strong class="order_tit">최종 결제 금액</strong>
	<ul class="price_list">
		<li>
			<b>주문금액</b>
			<strong><b><?php echo number_format($tot_sell_price); ?></b>원</strong>
		</li>
		<li>
			<b>배송비</b>
			<strong><b><?php echo number_format($send_cost); ?></b>원</strong>
		</li>
		<?php if($it_cp_count > 0) { ?>
		<li>
			<b>쿠폰할인</b>
			<strong id="ct_tot_coupon">0 원</strong>
		</li>
		<?php } ?>
		<li>
			<b>합계</b>
			<?php $tot_price = $tot_sell_price + $send_cost; // 총계 = 주문상품금액합계 + 배송비 ?>
			<strong id="ct_tot_price"><b><?php echo number_format($tot_price); ?></b>원</strong>
		</li>
	</ul>
	<div class="point_box">
		<div>
			<strong><b>적립 예정 적립금</b>(비회원으로 주문하시는 경우 적립금은 지급되지 않습니다.)</strong>
		</div>
		<strong><b><?php echo number_format($tot_point); ?></b>원</strong>
	</div>
	<?php if($is_guest_order){ ?>
		<a href="<?php echo $order_login_url;?>" class="order_login">로그인 후 주문합니다.</a>
	<?php } ?>
</div>
