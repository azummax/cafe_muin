<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

if($header_skin)
	include_once('./header.php');

?>

<div id="mb_confirm_wrap">
	<div class="at-container">
		<?php if ($url == 'member_leave.php') { ?>
			<div class="leave_box">
				<strong>회원탈퇴 전에 아래사항을 꼭 확인해주시기 바랍니다.</strong>
				<ul>
					<li>카페 뮌 회원탈퇴 시 각종 서비스 및 기타 컨텐츠 제공 서비스가 중단됩니다.</li>
					<li>서비스 이용기록은 모두 삭제되며, 삭제된 데이터는 복구되지 않습니다.</li>
					<li>홈페이지에 올린 게시글(상담) 및 댓글은 탈퇴 시에도 그대로 유지됩니다. (상세내역은 확인이 불가합니다.)</li>
				</ul>
			</div>
		<?php }else{ ?>
			<p>	
				저희 카페 뮌은 회원님의 소중한 개인정보를 안전하게 보호하고 개인정보 도용으로 인한 피해를 <br />
				방지하기 위하여 비밀번호를 확인합니다. 비밀번호는 타인에게 노출되지 않도록 주의해주세요.	
			</p>
		<?php } ?>
		<form class="form" role="form" name="fmemberconfirm" action="<?php echo $url ?>" onsubmit="return fmemberconfirm_submit(this);" method="post">
			<input type="hidden" name="mb_id" value="<?php echo $member['mb_id'] ?>">
			<input type="hidden" name="w" value="u">

			<div class="input_box">
				<label for="confirm_mb_password">비밀번호</label>
				<input type="password" name="mb_password" id="confirm_mb_password" required class="input_com" size="15" maxLength="20">
			</div>

			<div class="reg_submit center">
				<button type="submit" id="btn_sumbit" data-rolling="확인하기"><span>확인하기</span></button>
			</div>
		</form>
	</div>
</div>


<script>
function fmemberconfirm_submit(f) {
    document.getElementById("btn_submit").disabled = true;

    return true;
}
</script>
<!-- } 회원 비밀번호 확인 끝 -->