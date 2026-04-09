<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

if($header_skin)
	include_once('./header.php');

?>

<div id="login_wrap">
	<div class="login_box">
		<form class="form" role="form" name="flogin" action="<?php echo $login_action_url ?>" onsubmit="return flogin_submit(this);" method="post">
			<input type="hidden" name="url" value='<?php echo $login_url ?>'>
			<span class="login_input">
				<label for="login_id"><b>ID</b></label>
				<input type="text" name="mb_id" id="login_id" required size="20" maxLength="20" placeholder="아이디">
			</span>
			<span class="login_input">
				<label for="login_pw"><b>Password</b></label>
				<input type="password" name="mb_password" id="login_pw" required size="20" maxLength="20" placeholder="비밀번호">
			</span>
			<input type="checkbox" name="auto_login" id="login_auto_login"><label  for="login_auto_login"> 아이디 저장 </label>
			<div class="btn_box">
				<button type="submit" class="login_btn">로그인</button>
				<a href="<?php echo G5_BBS_URL; ?>/register_form.php" class="join_btn">회원가입</a>
			</div>
		</form>
		<span class="lost"><a href="<?php echo G5_BBS_URL; ?>/password_lost.php" target="_blank" id="login_info_lost"><b>아이디 찾기</b><b>비밀번호 찾기</b></a></span>
	</div>
	


	<?php if ($default['de_level_sell'] == 1) { // 상품구입 권한 ?>
		<!-- 주문하기, 신청하기 -->
		<?php if (preg_match("/orderform.php/", $url)) { ?>

			<div class="nonmembers_login">
				<strong class="tit01">비회원 구매<span>(비회원 주문은 포인트를 지급하지 않습니다.)</span></strong>
				<strong class="tit02">개인정보처리방침안내</strong>
				<div class="table_box">
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
				<span class="reg_ck">
					<input type="checkbox" id="agree" value="1">
					<label for="agree" class="checkbox-inline">개인정보처리방침안내에 동의합니다.</label>
				</span>
				<a href="javascript:guest_submit(document.flogin);" class="nonmembers_btn">비회원으로 구매하기</a>
			</div>
			<script>
			function guest_submit(f) {
				if (document.getElementById('agree')) {
					if (!document.getElementById('agree').checked) {
						alert("개인정보처리방침안내에 동의하셔야 합니다.");
						return;
					}
				}

				f.url.value = "<?php echo $url; ?>";
				f.action = "<?php echo $url; ?>";
				f.submit();
			}
			</script>

		<?php } else if (preg_match("/orderinquiry.php$/", $url)) { ?>

			<div class="nonmembers_order">
				<strong>비회원 주문조회</strong>
				<p>메일로 발송해드린 주문서의 <strong>주문번호</strong> 및 주문 시 입력하신 <strong>비밀번호</strong>를 정확히 입력해주십시오.</p>
				<form class="no_mb_order_form" role="form" name="forderinquiry" method="post" action="<?php echo urldecode($url); ?>" autocomplete="off">
					<div class="input_box">
						<input type="text" name="od_id" value="<?php echo $od_id; ?>" id="od_id" required class="input_com" size="20" placeholder="주문서번호">
						<input type="password" name="od_pwd" size="20" id="od_pwd" required class="input_com" placeholder="비밀번호">
					</div>
					<button type="submit" class="login_btn login_btn1 nonmembers_btn">확인하기</button>
				</form>
			</div>

		<?php } ?>
	<?php } ?>
</div>



<script>
$(function(){
    $("#login_auto_login").click(function(){
        if (this.checked) {
            this.checked = confirm("자동로그인을 사용하시면 다음부터 회원아이디와 비밀번호를 입력하실 필요가 없습니다.\n\n공공장소에서는 개인정보가 유출될 수 있으니 사용을 자제하여 주십시오.\n\n자동로그인을 사용하시겠습니까?");
        }
    });
});

function flogin_submit(f) {
    return true;
}
</script>
<!-- } 로그인 끝 -->