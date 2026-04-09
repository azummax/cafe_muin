<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<section id="sod_frm_pay" class="order-payment">
	<strong class="order_tit mgB15">
		결제정보
		<?php if (!$default['de_card_point']) { ?>
			<span><b>무통장입금</b> 이외의 결제 수단으로 결제하시는 경우 <b>적립금을 적립해드리지 않습니다.</b></span>
		<?php } ?>
	</strong>
	<div class="order_form_box">
		<?php if($oc_cnt > 0) { ?>
		<div class="order_write_box">
			<div class="title pdT0">
				<label for="">주문할인금액</label>
			</div>
			<div class="content">
				<span id="od_cp_price">0</span>원
				<input type="hidden" name="od_cp_id" value="">
				<div class="btn-group">
					<button type="button" id="od_coupon_btn" class="btn btn-black btn-sm">쿠폰적용</button>
				</div>
			</div>
		</div><!--order_write_box end-->
		<?php } ?>

		<?php if($sc_cnt > 0) { ?>
		<div class="order_write_box">
			<div class="title pdT0">
				<label for="">배송할인금액</label>
			</div>
			<div class="content">
				<input type="hidden" name="sc_cp_id" value="">
				<button type="button" id="sc_coupon_btn" class="btn btn-black btn-sm">쿠폰적용</button>
			</div>
		</div><!--order_write_box end-->
		<?php } ?>

		<div class="order_write_box">
			<div class="title pdT0">
				<label for="">총주문금액</label>
			</div>
			<div class="content">
				<b><span id="od_tot_price"><?php echo number_format($tot_price); ?></span></b>원
			</div>
		</div><!--order_write_box end-->

		<div class="order_write_box">
			<div class="title pdT0">
				<label for="">추가배송비</label>
			</div>
			<div class="content">
				<span id="od_send_cost2">0</span>원
				<label class="order_desc" style="margin:0;">(지역에 따라 추가되는 도선료 등의 배송비입니다.)</label>
			</div>
		</div><!--order_write_box end-->

		<?php if($is_none) { ?>
			<div class="no_desc">
				<?php if($default['as_point']) { ?>
					<b>보유하신 적립금이 부족합니다.</b>
				<?php } else { ?>
					<b>결제할 방법이 없습니다.</b> 운영자에게 알려주시면 감사하겠습니다.
				<?php } ?>
			</div>
		<?php } else { ?>
			<div class="order_write_box">
				<div class="title pdT0">
					<label for="">결제방법</label>
				</div>
				<div class="content">
					<?php if($is_po) { ?>
						 <span class="order_radio">
							<input type="radio" id="od_settle_point" name="od_settle_case" value="적립금">
							<label for="od_settle_point">적립금결제</label>
						 </span>
					<?php } ?>

					<?php if($is_mu) { ?>
						<span class="order_radio">
							<input type="radio" id="od_settle_bank" name="od_settle_case" value="무통장"> 
							<label for="od_settle_bank">무통장입금</label>
						</span>
					<?php } ?>

					<?php if($is_vbank) { ?>
						<span class="order_radio">
							<input type="radio" id="od_settle_vbank" name="od_settle_case" value="가상계좌"> 
							<label for="od_settle_vbank"><?php echo $escrow_title;?>가상계좌</label>
						</span>
					<?php } ?>

					<?php if($is_iche) { ?>
						<span class="order_radio">
							<input type="radio" id="od_settle_iche" name="od_settle_case" value="계좌이체"> 
							<label for="od_settle_iche"><?php echo $escrow_title;?>계좌이체</label>
						</span>
					<?php } ?>

					<?php if($is_hp) { ?>
						<span class="order_radio">
							<input type="radio" id="od_settle_hp" name="od_settle_case" value="휴대폰"> 
							<label for="od_settle_hp">휴대폰</label>
						</span>
					<?php } ?>

					<?php if($is_card) { ?>
						<span class="order_radio">
							<input type="radio" id="od_settle_card" name="od_settle_case" value="신용카드"> 
							<label for="od_settle_card">신용카드</label>
						</span>
					<?php } ?>

					<?php if($is_easy_pay) { ?>
						<span class="order_radio">
							<input type="radio" id="od_settle_easy_pay" name="od_settle_case" value="간편결제"> 
							<label for="od_settle_easy_pay"><span class="<?php echo $pg_easy_pay_name;?>"><?php echo $pg_easy_pay_name;?></span></label>
						</span>
					<?php } ?>

					<?php if($is_kakaopay) { ?>
						 <span class="order_radio">
							<input type="radio" id="od_settle_kakaopay" name="od_settle_case" value="KAKAOPAY"> 
							<label for="od_settle_kakaopay"><span class="kakaopay_icon">KAKAOPAY</span></label>
						 </span>
					<?php } ?>

					<?php if($is_samsung_pay) { ?>
						<span class="order_radio">
							<input type="radio" id="od_settle_samsung_pay" data-case="samsungpay" name="od_settle_case" value="삼성페이"> 
							<label for="od_settle_samsung_pay"><span class="samsung_pay">삼성페이</span></label>
						</span>
					<?php } ?>

					<?php if($is_inicis_lpay) { ?>
						<span class="order_radio">
							<input type="radio" id="od_settle_inicislpay" data-case="lpay" name="od_settle_case" value="lpay"> 
							<label for="od_settle_inicislpay"><span class="inicis_lpay">L.pay</span></label>
						</span>
					<?php } ?>

					<?php if($is_mu) { //무통장입금 ?>
						<div id="settle_bank" style="display:none">
							<div class="sm_write_box">
								<div class="sm_title"><label for="od_bank_account">입금할 계좌</label></div>
								<div class="sm_content">
									<select name="od_bank_account" id="od_bank_account" class="input_com">
										<option value="">선택하십시오.</option>
										<?php echo $bank_account; ?>
									</select>
								</div>
							</div>

							<div class="sm_write_box">
								<div class="sm_title"><label for="od_deposit_name">입금자명</label></div>
								<div class="sm_content">
									<input type="text" name="od_deposit_name" id="od_deposit_name" class="input_com" size="10" maxlength="20">
								</div>
							</div>
						</div>
					<?php } ?>
				</div>
			</div><!--order_write_box end-->

			<?php if($is_point) { ?>
			<div class="order_write_box">
				<div class="title">
					<label for="od_temp_point">사용 적립금</label>
				</div>
				<div class="content">
					<input type="hidden" name="max_temp_point" value="<?php echo $temp_point;?>">
					<div class="flex_box">
						<input type="text" name="od_temp_point" value="0" id="od_temp_point" class="input_com" size="10" style="max-width:230px;">
						<span style="margin-left:10px;">원</span>
					</div>
					<p id="sod_frm_pt" class="order_desc">
						보유적립금(<?php echo display_point($member['mb_point']);?>)중 <strong id="use_max_point">최대 <?php echo display_point($temp_point);?></strong>까지 사용 가능 
						(<?php echo $point_unit;?>점 단위로 입력)
					</p>
				</div>
			</div><!--order_write_box end-->
			<?php } ?>
		<?php } ?>
	</div><!--order_form_box end-->
</section>
