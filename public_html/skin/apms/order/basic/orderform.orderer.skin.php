<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<?php if(!$is_orderform) { //주문서가 필요없는 주문일 때 ?>

	<section id="sod_frm_orderer" style="margin-bottom:0px;">
		<strong class="order_tit">결제자 정보</strong>
		<div class="order_form_box">
			<div class="order_write_box">
				<div class="title">
					<label for="od_id">아이디 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
				</div>
				<div class="content">
					<input type="text" name="od_id" value="<?php echo get_text($member['mb_id']); ?>" id="od_id" class="input_com" disabled>
				</div>
			</div><!--order_write_box end-->
			
			<div class="order_write_box">
				<div class="title">
					<label for="od_name">이름 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
				</div>
				<div class="content">
					<input type="text" name="od_name" value="<?php echo get_text($member['mb_name']); ?>" id="od_name" required class="input_com" maxlength="20">
				</div>
			</div><!--order_write_box end-->

			<div class="order_write_box">
				<div class="title">
					<label for="od_tel">연락처 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
				</div>
				<div class="content">
					<input type="text" name="od_tel" value="<?php echo ($member['mb_hp']) ? get_text($member['mb_hp']) : get_text($member['mb_tel']); ?>" id="od_tel" required class="input_com" maxlength="20">
				</div>
			</div><!--order_write_box end-->

			<div class="order_write_box">
				<div class="title">
					<label for="od_memo">요청사항</label>
				</div>
				<div class="content">
					<textarea name="od_memo" rows=3 id="od_memo" class="input_com"></textarea>
				</div>
			</div><!--order_write_box end-->
		
			<input type="hidden" name="od_email" value="<?php echo $member['mb_email']; ?>">
			<input type="hidden" name="od_hp" value="<?php echo get_text($member['mb_hp']); ?>">
			<input type="hidden" name="od_b_name" value="<?php echo get_text($member['mb_name']); ?>">
			<input type="hidden" name="od_b_tel" value="<?php echo get_text($member['mb_tel']); ?>">
			<input type="hidden" name="od_b_hp" value="<?php echo get_text($member['mb_hp']); ?>">
			<input type="hidden" name="od_b_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2']; ?>">
			<input type="hidden" name="od_b_addr1" value="<?php echo get_text($member['mb_addr1']); ?>">
			<input type="hidden" name="od_b_addr2" value="<?php echo get_text($member['mb_addr2']); ?>">
			<input type="hidden" name="od_b_addr3" value="<?php echo get_text($member['mb_addr3']); ?>">
			<input type="hidden" name="od_b_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
		</div><!--order_form_box end-->
	</section>

<?php } else { ?>

	<?php if($is_guest_order) { // 비회원 주문일 때 ?>
		<!-- 주문하시는 분 입력 시작 { -->
		<section id="sod_frm_agree" class="mgB70">
			<strong class="order_tit">개인정보처리방침안내 <span><b>비회원으로 주문</b>하시는 경우 <b>적립금은 지급하지 않습니다.</b></span></strong>
			<div class="order_table_box">
				<table>
					<colgroup>
						<col width="33.3333%" />
						<col width="33.3333%" />
						<col width="33.3333%" />
					</colgroup>
					<thead>
						<tr>
							<th scope="col">목적</th>
							<th scope="col">항목</th>
							<th scope="col">보유기간</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>이용자 식별 및 본인 확인</td>
							<td>이름, 비밀번호</td>
							<td>5년(전자상거래등에서의 소비자보호에 관한 법률)</td>
						</tr>
						<tr>
							<td>배송 및 CS대응을 위한 이용자 식별</td>
							<td>주소, 연락처(이메일, 휴대전화번호)</td>
							<td>5년(전자상거래등에서의 소비자보호에 관한 법률)</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div data-toggle="buttons" class="priv_btn">
				<label class="btn btn-sm btn-block">
					<input type="checkbox" name="agree" value="1" id="agree" autocomplete="off">
					<b>개인정보처리방침안내</b>에 동의합니다.
				</label>
			</div>
		</section>
	<?php } ?>

	<!-- 주문하시는 분 입력 시작 { -->
	<section id="sod_frm_orderer" class="mgB70">
		<strong class="order_tit mgB15">주문자 정보</strong>
		<div class="order_form_box">
			<div class="order_write_box">
				<div class="title">
					<label for="od_name">이름 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
				</div>
				<div class="content">
					<input type="text" name="od_name" value="<?php echo get_text($member['mb_name']); ?>" id="od_name" required class="input_com" maxlength="20">
				</div>
			</div><!--order_write_box end-->

			<?php if (!$is_member) { // 비회원이면 ?>
				<div class="order_write_box">
					<div class="title">
						<label for="od_pwd">비밀번호 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
					</div>
					<div class="content">
						<input type="password" name="od_pwd" id="od_pwd" required class="input_com" maxlength="20">
						<p class="order_desc">영,숫자 3~20자 (주문서 조회시 필요)</p>
					</div>
				</div><!--order_write_box end-->	
			<?php } ?>

			<div class="order_write_box">
				<div class="title">
					<label for="od_tel">전화번호 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
				</div>
				<div class="content">
					<input type="text" name="od_tel" value="<?php echo get_text($member['mb_tel']); ?>" id="od_tel" required class="input_com" maxlength="20">
				</div>
			</div><!--order_write_box end-->

			<div class="order_write_box">
				<div class="title">
					<label for="od_hp">핸드폰</label>
				</div>
				<div class="content">
					<input type="text" name="od_hp" value="<?php echo get_text($member['mb_hp']); ?>" id="od_hp" class="input_com" maxlength="20">
				</div>
			</div><!--order_write_box end-->

			<div class="order_write_box">
				<div class="title">
					<label for="">주소 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
				</div>
				<div class="content">
					<div class="addr_btn">
						<input type="text" name="od_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2'] ?>" id="od_zip" required class="input_com" size="6" maxlength="6">
						<button type="button" class="btn btn-black btn-sm" style="margin-top:0px;" onclick="win_zip('forderform', 'od_zip', 'od_addr1', 'od_addr2', 'od_addr3', 'od_addr_jibeon');">주소 검색</button>
					</div>
					<div class="addr_input">
						<input type="text" name="od_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="od_addr1" required class="input_com" size="60" placeholder="기본주소">
						<input type="text" name="od_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="od_addr2" class="input_com" size="50" placeholder="상세주소">
						<input type="text" name="od_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="od_addr3" class="input_com" size="50" readonly="readonly" placeholder="참고항목">
						<input type="hidden" name="od_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']) ?>">
					</div>
				</div>
			</div><!--order_write_box end-->

			<div class="order_write_box">
				<div class="title">
					<label for="od_email">E-mail <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
				</div>
				<div class="content">
					<input type="text" name="od_email" value="<?php echo $member['mb_email']; ?>" id="od_email" required class="input_com email" size="35" maxlength="100">
				</div>
			</div><!--order_write_box end-->

			<?php if ($default['de_hope_date_use']) { // 배송희망일 사용 ?>
			<div class="order_write_box">
				<div class="title">
					<label for="od_hope_date">희망배송일</label>
				</div>
				<div class="content">
					<!-- <select name="od_hope_date" id="od_hope_date" class="input_com">
						<option value="">선택하십시오.</option>
						<?php
							for ($i=0; $i<7; $i++) {
								$sdate = date("Y-m-d", time()+86400*($default['de_hope_date_after']+$i));
								echo '<option value="'.$sdate.'">'.$sdate.' ('.get_yoil($sdate).')</option>'.PHP_EOL;
							}
						?>
					</select> -->
					<input type="text" name="od_hope_date" value="" id="od_hope_date" required class="input_com" size="11" maxlength="10" readonly="readonly" style="max-width:230px;">
					<span class="hope_span">이후로 배송 바랍니다.</span>
				</div>
			</div><!--order_write_box end-->
			<?php } ?>
		</div><!--order_form_box end-->
	</section>
	<!-- } 주문하시는 분 입력 끝 -->

	<!-- 받으시는 분 입력 시작 { -->
	<section id="sod_frm_taker" class="mgB70">
		<strong class="order_tit mgB15">배송지 정보</strong>
		<div class="order_form_box">
			<div class="order_write_box">
				<div class="title pdT0">
					<label for="">배송지선택</label>
				</div>
				<div class="content">
					<?php if($is_member) { ?>
						<span class="order_radio">
							<input type="radio" name="ad_sel_addr" value="same" id="ad_sel_addr_same">
							<label for="ad_sel_addr_same">주문자와 동일</label>
						</span>
						<?php if($addr_default) { ?>
							<span class="order_radio">
								<input type="radio" name="ad_sel_addr" value="<?php echo get_text($addr_default);?>" id="ad_sel_addr_def">
								<label for="ad_sel_addr_def">기본배송지</label>
							</span>
						<?php } ?>

						<?php for($i=0; $i < count($addr_sel); $i++) { ?>
							<span class="order_radio">
								<input type="radio" name="ad_sel_addr" value="<?php echo get_text($addr_sel[$i]['addr']);?>" id="ad_sel_addr_<?php echo $i+1;?>">
								<label for="ad_sel_addr_<?php echo $i+1;?>">최근배송지<?php echo ($addr_sel[$i]['name']) ? '('.get_text($addr_sel[$i]['name']).')' : '';?></label>
							</span>
						<?php } ?>
						<span class="order_radio">
							<input type="radio" name="ad_sel_addr" value="new" id="od_sel_addr_new">
							<label for="od_sel_addr_new">신규배송지</label>
						</span>
						<a href="<?php echo G5_SHOP_URL;?>/orderaddress.php" id="order_address">배송지목록</a>
					<?php } else { ?>
						<span class="order_radio">
							<input type="checkbox" name="ad_sel_addr" value="same" id="ad_sel_addr_same">
							<label for="ad_sel_addr_same">주문자와 동일</label>
						</span>
					<?php } ?>
				</div>
			</div><!--order_write_box end-->

			<?php if($is_member) { ?>
				<div class="order_write_box">
					<div class="title">
						<label for="ad_subject">배송지명</label>
					</div>
					<div class="content">
						<div class="flex_box mo">
							<input type="text" name="ad_subject" id="ad_subject" class="input_com" maxlength="20">
							<span class="order_radio">
								<input type="checkbox" name="ad_default" id="ad_default" value="1">
								<label for="ad_default">기본배송지로 설정</label>
							</span>
						</div>
					</div>
				</div><!--order_write_box end-->
			<?php } ?>

			<div class="order_write_box">
				<div class="title">
					<label for="od_b_name">이름 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
				</div>
				<div class="content">
					<input type="text" name="od_b_name" id="od_b_name" required class="input_com" maxlength="20">
				</div>
			</div><!--order_write_box end-->

			<div class="order_write_box">
				<div class="title">
					<label for="od_b_tel">전화번호 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
				</div>
				<div class="content">
					<input type="text" name="od_b_tel" id="od_b_tel" required class="input_com" maxlength="20">
				</div>
			</div><!--order_write_box end-->

			<div class="order_write_box">
				<div class="title">
					<label for="od_b_hp">핸드폰</label>
				</div>
				<div class="content">
					<input type="text" name="od_b_hp" id="od_b_hp" class="input_com" maxlength="20">
				</div>
			</div><!--order_write_box end-->

			<div class="order_write_box">
				<div class="title">
					<label for="">주소 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
				</div>
				<div class="content">
					<div class="addr_btn">
						<input type="text" name="od_b_zip" id="od_b_zip" required class="input_com" size="6" maxlength="6">
						<button type="button" class="btn btn-black btn-sm" style="margin-top:0px;" onclick="win_zip('forderform', 'od_b_zip', 'od_b_addr1', 'od_b_addr2', 'od_b_addr3', 'od_b_addr_jibeon');">주소 검색</button>
					</div>
					<div class="addr_input">
						<input type="text" name="od_b_addr1" id="od_b_addr1" required class="input_com" size="60" placeholder="기본주소">
						<input type="text" name="od_b_addr2" id="od_b_addr2" class="input_com" size="50" placeholder="상세주소">
						<input type="text" name="od_b_addr3" id="od_b_addr3" class="input_com" size="50" readonly="readonly" placeholder="참고항목">
						<input type="hidden" name="od_b_addr_jibeon" value="">
					</div>
				</div>
			</div><!--order_write_box end-->

			<div class="order_write_box">
				<div class="title">
					<label for="od_memo">요청사항</label>
				</div>
				<div class="content">
					<textarea name="od_memo" rows=3 id="od_memo" class="input_com"></textarea>
				</div>
			</div><!--order_write_box end-->
		</div><!--order_form_box end-->
	</section>
	<!-- } 받으시는 분 입력 끝 -->
<?php } ?>