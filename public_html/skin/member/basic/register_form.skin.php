<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

if($header_skin)
	include_once('./header.php');

?>
<script src="<?php echo G5_JS_URL ?>/jquery.register_form.js"></script>
<?php if($config['cf_cert_use'] && ($config['cf_cert_ipin'] || $config['cf_cert_hp'])) { ?>
    <script src="<?php echo G5_JS_URL ?>/certify.js?v=<?php echo APMS_SVER; ?>"></script>
<?php } ?>

<style>
	#btm_customer{display:none;}
</style>

<ul class="reg_step mgB70">
	<li class="on">
		<span class="ico01"></span>
		<strong>회원정보입력</strong>
	</li>
	<li>
		<span class="ico02"></span>
		<strong>가입완료</strong>
	</li>
</ul>

<form class="form-horizontal register-form" role="form" id="fregisterform" name="fregisterform" action="<?php echo $action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
	<input type="hidden" name="w" value="<?php echo $w ?>">
	<input type="hidden" name="url" value="<?php echo $urlencode ?>">
	<input type="hidden" name="pim" value="<?php echo $pim;?>"> 
	<input type="hidden" name="agree" value="<?php echo $agree ?>">
	<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
	<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
	<input type="hidden" name="cert_no" value="">
	<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
	<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
		<input type="hidden" name="mb_nick_default" value="<?php echo get_text($member['mb_nick']) ?>">
		<input type="hidden" name="mb_nick" value="<?php echo get_text($member['mb_nick']) ?>">
	<?php }  ?>

	<div class="reg_form_tit">
		<h3><b>Step 1</b>사이트 이용정보 입력</h3>
		<p><span class="orangered">*</span> 필수입력 항목입니다.</p>
	</div>
	<div class="reg_form_box mgB70">
		<div class="reg_write_box">
			<div class="reg_tit">
				<label for="reg_mb_id">아이디 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
			</div>
			<div class="reg_content">
				<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> class="input_com" minlength="3" maxlength="20">
			</div>
		</div><!--reg_write_box end-->
		
		<div class="reg_write_box">
			<div class="reg_tit">
				<label for="reg_mb_password">비밀번호 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
			</div>
			<div class="reg_content">
				<input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?> class="input_com" minlength="3" maxlength="20">
			</div>
		</div><!--reg_write_box end-->

		<div class="reg_write_box">
			<div class="reg_tit">
				<label for="reg_mb_password_re">비밀번호 확인 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
			</div>
			<div class="reg_content">
				<input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> class="input_com" minlength="3" maxlength="20">
			</div>
		</div><!--reg_write_box end-->
	</div><!--reg_form_box end-->


	<div class="reg_form_tit">
		<h3><b>Step 2</b>회원정보 입력</h3>
		<p><span class="orangered">*</span> 필수입력 항목입니다.</p>
	</div>
	<div class="reg_form_box mgB70">
		<div class="reg_write_box">
			<div class="reg_tit">
				<label for="reg_mb_1">기업명 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
			</div>
			<div class="reg_content">
				<input type="text" id="reg_mb_1" name="mb_1" value="<?php echo get_text($member['mb_1']) ?>" required class="input_com" size="50" maxlength="255">
			</div>
		</div><!--reg_write_box end-->

		<div class="reg_write_box">
			<div class="reg_tit">
				<label for="reg_mb_name">대표자명 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
			</div>
			<div class="reg_content">
				<input type="text" id="reg_mb_name" name="mb_name" value="<?php echo get_text($member['mb_name']) ?>" required <?php echo $readonly; ?> class="input_com" size="10">
			</div>
		</div><!--reg_write_box end-->

		<div class="reg_write_box">
			<div class="reg_tit">
				<label for="reg_mb_tel">대표번호 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
			</div>
			<div class="reg_content">
				<input type="text" name="mb_tel" value="<?php echo get_text($member['mb_tel']) ?>" id="reg_mb_tel" required class="input_com" maxlength="20" placeholder="- 없이 입력하세요.">
			</div>
		</div><!--reg_write_box end-->

		<?php if ($config['cf_use_addr']) { ?>
			<div class="reg_write_box">
				<div class="reg_tit">
					<label>주소 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
				</div>
				<div class="reg_content">
					<div class="flex_box">
						<input type="text" name="mb_zip" value="<?php echo $member['mb_zip1'].$member['mb_zip2'] ?>" id="reg_mb_zip" required class="input_com" size="6" maxlength="6">
						<button type="button" class="reg_btn win_zip_find" style="margin-top:0px;" onclick="win_zip('fregisterform', 'mb_zip', 'mb_addr1', 'mb_addr2', 'mb_addr3', 'mb_addr_jibeon');">우편번호검색</button>
					</div>
					<div class="addr_input">
						<input type="text" name="mb_addr1" value="<?php echo get_text($member['mb_addr1']) ?>" id="reg_mb_addr1" required class="input_com" size="50" placeholder="기본주소">
						<input type="text" name="mb_addr2" value="<?php echo get_text($member['mb_addr2']) ?>" id="reg_mb_addr2" class="input_com" size="50" placeholder="상세주소">
						<input type="text" name="mb_addr3" value="<?php echo get_text($member['mb_addr3']) ?>" id="reg_mb_addr3" class="input_com" size="50" readonly="readonly" placeholder="참고항목">
						<input type="hidden" name="mb_addr_jibeon" value="<?php echo get_text($member['mb_addr_jibeon']); ?>">
					</div>
				</div>
			</div><!--reg_write_box end-->
		<?php }  ?>

		<div class="reg_write_box">
			<div class="reg_tit">
				<label for="reg_mb_2">사업자등록번호 <span class="orangered">*</span></label>
			</div>
			<div class="reg_content">
				<input type="text" id="reg_mb_2" name="mb_2" value="<?php echo get_text($member['mb_2']) ?>" required class="input_com" size="50" maxlength="255" placeholder="- 없이 입력하세요.">
			</div>
		</div><!--reg_write_box end-->

		<div class="reg_write_box">
			<div class="reg_tit">
				<label for="biz_cert_file">사업자등록증 (파일첨부) <?php if($w == '') { ?><span class="orangered">*</span><?php } ?></label>
			</div>
			<div class="reg_content">
				<input type="file" name="biz_cert_file" id="biz_cert_file" <?php echo ($w == '') ? 'required' : ''; ?>>
				<?php if ($w == 'u' && $member['mb_3']) { ?>
					<div style="margin-top:10px;">
						<a href="/data/member_biz/<?php echo $member['mb_3'] ?>" target="_blank" style="text-decoration:underline;">등록된 사업자등록증 보기</a>
					</div>
				<?php } ?>
			</div>
		</div><!--reg_write_box end-->

		<div class="reg_write_box">
			<div class="reg_tit">
				<label for="reg_mb_email">이메일 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
			</div>
			<div class="reg_content">
				<input type="hidden" name="old_email" value="<?php echo $member['mb_email'] ?>">
				<input type="email" name="mb_email" value="<?php echo isset($member['mb_email'])?$member['mb_email']:''; ?>" id="reg_mb_email" required class="input_com" size="70" maxlength="100">
			</div>
		</div><!--reg_write_box end-->

	</div><!--reg_form_box end-->


	<?php if($w==''){ ?>
	<div class="reg_form_tit">
		<h3><b>Step 3</b>개인정보 수집 및 활용 동의</h3>
	</div>
	<div class="reg_form_box mgB70">
		<div class="agree_content mgB30">
			<?php include_once(G5_PATH.'/page/privacy.php'); ?>
		</div>
		<span class="reg_ck">
			<input type="checkbox" name="reg_agree1" value="1" id="reg_agree1" >
			<label for="reg_agree1">개인정보 수집 및 활용에 대한 내용을 확인하였으며 이에 동의합니다. <span class="orangered">*</span></label>
		</span>
	</div><!--reg_form_box end-->

	<div class="reg_form_tit">
		<h3><b>Step 4</b>이용약관 동의</h3>
	</div>
	<div class="reg_form_box mgB70">
		<div class="agree_content mgB30">
			<?php include_once(G5_PATH.'/page/provision.php'); ?>
		</div>
		<span class="reg_ck">
			<input type="checkbox" name="reg_agree2" value="1" id="reg_agree2" >
			<label for="reg_agree2">이용약관에 대한 내용을 확인하였으며 이에 동의합니다. <span class="orangered">*</span></label>
		</span>
	</div><!--reg_form_box end-->
	<?php } ?>

	<!--
	<div class="agree_ect_box mgB30">
		<strong>마케팅 및 이벤트 목적의 개인정보 수집 및 이용동의</strong>
		<span class="reg_ck">
			<input type="checkbox" name="mb_mailling" value="1" id="reg_mb_mailling" <?php echo ($member['mb_mailling'])?'checked':''; ?>>
			<label for="reg_mb_mailling"><b>[선택]</b> 이메일 수신 동의</label>
		</span>
		<?php if ($config['cf_use_hp']) {  ?>
		<span class="reg_ck">
			<input type="checkbox" name="mb_sms" value="1" id="reg_mb_sms" <?php echo ($member['mb_sms'])?'checked':''; ?>>
			<label for="reg_mb_sms"><b>[선택]</b> SMS 수신 동의</label>
		</span>
		<?php }  ?>
	</div>
	-->

	<div class="reg_write_box captcha_box">
		<div class="reg_tit">
			<label for="captcha_key">자동등록방지 <span class="orangered">*</span><strong class="sound_only">필수</strong></label>
		</div>
		<div class="reg_content">
			<?php echo captcha_html(); ?>
		</div>
	</div>

	<div class="reg_submit">
		<?php if(!$pim) { ?>
		<a href="<?php echo G5_URL ?>" role="button">취소</a>
		<?php } ?>
		<button type="submit" id="btn_submit" accesskey="s"><?php echo $w==''?'회원가입':'정보수정'; ?></button>
	</div>

</form>

<script>
$(function() {

	$("#reg_zip_find").css("display", "inline-block");

	<?php if($config['cf_cert_use'] && $config['cf_cert_ipin']) { ?>
	// 아이핀인증
	$("#win_ipin_cert").click(function(e) {
		if(!cert_confirm())
			return false;

		var url = "<?php echo G5_OKNAME_URL; ?>/ipin1.php";
		certify_win_open('kcb-ipin', url, e);
		return;
	});
	<?php } ?>

	<?php if($config['cf_cert_use'] && $config['cf_cert_hp']) { ?>
	// 휴대폰인증
	$("#win_hp_cert").click(function(e) {
		if(!cert_confirm())
			return false;

		<?php
		switch($config['cf_cert_hp']) {
			case 'kcb':
				$cert_url = G5_OKNAME_URL.'/hpcert1.php';
				$cert_type = 'kcb-hp';
				break;
			case 'kcp':
				$cert_url = G5_KCPCERT_URL.'/kcpcert_form.php';
				$cert_type = 'kcp-hp';
				break;
			case 'lg':
				$cert_url = G5_LGXPAY_URL.'/AuthOnlyReq.php';
				$cert_type = 'lg-hp';
				break;
			default:
				echo 'alert("기본환경설정에서 휴대폰 본인확인 설정을 해주십시오");';
				echo 'return false;';
				break;
		}
		?>

		certify_win_open("<?php echo $cert_type; ?>", "<?php echo $cert_url; ?>", e);
		return;
	});
	<?php } ?>
});

// submit 최종 폼체크
function fregisterform_submit(f)
{
	<?php if($w==''){ ?>
	//개인정보동의
	if(!f.reg_agree1.checked){
		alert("개인정보 수집 및 이용에 동의하셔야 등록할 수 있습니다.");
        return false;
	}

	if(!f.reg_agree2.checked){
		alert("이용약관에 동의하셔야 등록할 수 있습니다.");
        return false;
	}
	<?php } ?>

	// 회원아이디 검사
	if (f.w.value == "") {
		var msg = reg_mb_id_check();
		if (msg) {
			alert(msg);
			f.mb_id.select();
			return false;
		}
	}

	if (f.w.value == "") {
		if (f.mb_password.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password.focus();
			return false;
		}
	}

	if (f.mb_password.value != f.mb_password_re.value) {
		alert("비밀번호가 같지 않습니다.");
		f.mb_password_re.focus();
		return false;
	}

	if (f.mb_password.value.length > 0) {
		if (f.mb_password_re.value.length < 3) {
			alert("비밀번호를 3글자 이상 입력하십시오.");
			f.mb_password_re.focus();
			return false;
		}
	}

	// 기업명 검사
	if (f.mb_1.value.length < 1) {
		alert("기업명을 입력하십시오.");
		f.mb_1.focus();
		return false;
	}

	// 대표자명 검사
	if (f.w.value=="") {
		if (f.mb_name.value.length < 1) {
			alert("대표자명을 입력하십시오.");
			f.mb_name.focus();
			return false;
		}
	}

	// 대표번호 검사
	if (f.mb_tel.value.length < 1) {
		alert("대표번호를 입력하십시오.");
		f.mb_tel.focus();
		return false;
	}

	// 사업자등록번호 검사
	if (f.mb_2.value.length < 1) {
		alert("사업자등록번호를 입력하십시오.");
		f.mb_2.focus();
		return false;
	}

	// 사업자등록증 첨부 검사 (신규가입 시)
	<?php if($w == '') { ?>
	if (!f.biz_cert_file.value) {
		alert("사업자등록증을 첨부해주십시오.");
		f.biz_cert_file.focus();
		return false;
	}
	<?php } ?>
	if (f.biz_cert_file.value) {
		if (!f.biz_cert_file.value.toLowerCase().match(/\.(gif|jpe?g|png|pdf)$/i)) {
			alert("사업자등록증은 이미지 또는 PDF 파일만 가능합니다.");
			f.biz_cert_file.focus();
			return false;
		}
	}

	<?php if($w=='' && $config['cf_cert_use'] && $config['cf_cert_req']) { ?>
	// 본인확인 체크
	if(f.cert_no.value=="") {
		alert("회원가입을 위해서는 본인확인을 해주셔야 합니다.");
		return false;
	}
	<?php } ?>

	// E-mail 검사
	if ((f.w.value == "") || (f.w.value == "u" && f.mb_email.defaultValue != f.mb_email.value)) {
		var msg = reg_mb_email_check();
		if (msg) {
			alert(msg);
			f.reg_mb_email.select();
			return false;
		}
	}

	if (typeof f.mb_img != "undefined") {
		if (f.mb_img.value) {
			if (!f.mb_img.value.toLowerCase().match(/.(gif|jpe?g|png)$/i)) {
				alert("회원이미지가 이미지 파일이 아닙니다.");
				f.mb_img.focus();
				return false;
			}
		}
	}

	if (typeof(f.mb_recommend) != "undefined" && f.mb_recommend.value) {
		if (f.mb_id.value == f.mb_recommend.value) {
			alert("본인을 추천할 수 없습니다.");
			f.mb_recommend.focus();
			return false;
		}

		var msg = reg_mb_recommend_check();
		if (msg) {
			alert(msg);
			f.mb_recommend.select();
			return false;
		}
	}

	<?php echo chk_captcha_js();  ?>

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}
</script>
