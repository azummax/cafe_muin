<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

$page_title = '아이디/비밀번호 찾기';

include_once(G5_PATH.'/head.php');

?>

<form class="form-horizontal" role="form" name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
	<div id="pw_lost_container">
		<p>
			회원가입 시 등록하신 이메일 주소를 입력해 주세요. 해당 이메일로 아이디와 비밀번호 정보를 보내드립니다.
		</p>
		<div class="email_box">
			<label for="mb_email">이메일주소</label>
			<input type="text" name="mb_email" id="mb_email" required class="input_com" size="30" maxlength="100">
		</div>
		<div class="captcha_box">
			<?php echo captcha_html(); ?>
		</div>
	</div>

	<div class="reg_submit center mgB80">
		<button type="submit" id="pw_lost_btn" data-rolling="확인"><span>확인</span></button>
	</div>
</form>

<script>
function fpasswordlost_submit(f) {
    <?php echo chk_captcha_js();  ?>

    return true;
}

$(function() {
    var sw = screen.width;
    var sh = screen.height;
    var cw = document.body.clientWidth;
    var ch = document.body.clientHeight;
    var top  = sh / 2 - ch / 2 - 100;
    var left = sw / 2 - cw / 2;
    moveTo(left, top);
});
</script>
<!-- } 회원정보 찾기 끝 -->