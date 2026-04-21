<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

if($header_skin)
	include_once('./header.php');

?>

<ul class="reg_step mgB60">
	<li>
		<span class="ico01"></span>
		<strong>회원정보입력</strong>
	</li>
	<li class="on">
		<span class="ico02"></span>
		<strong>가입완료</strong>
	</li>
</ul>

<div id="register_result_box">
	<strong>회원 가입이 완료되었습니다.</strong>
	<p>
		카페 뮌의 회원이 되어주셔서 감사합니다. <br />
		가입하신 아이디와 비밀번호로 로그인 하시면 다양한 서비스를 이용하실 수 있습니다.
	</p>
	<?php if (is_use_email_certify()) { ?>
		<div class="email_info">
			<p>회원 가입 시 입력하신 이메일 주소로 인증메일이 발송되었습니다.</p>
			<p>발송된 인증메일을 확인하신 후 인증처리를 하시면 사이트를 원활하게 이용하실 수 있습니다.</p>
			<p id="result_email">
				<span>아이디</span>
				<strong><?php echo $mb['mb_id'] ?></strong><br>
				<span>이메일 주소</span>
				<strong><?php echo $mb['mb_email'] ?></strong>
			</p>
			<p>이메일 주소를 잘못 입력하셨다면, 사이트 관리자에게 문의해주시기 바랍니다.</p>
		</div>
	<?php } ?>
	<div class="reg_submit center">
		<a href="<?php echo G5_URL; ?>/"><span>메인으로</span></a>
	</div>
</div>