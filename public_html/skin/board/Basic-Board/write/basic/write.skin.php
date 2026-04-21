<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$write_skin_url.'/write.css" media="screen">', 0);

?>

<!-- 게시물 작성/수정 시작 { -->
<div class="write_required_text" style="text-align: right; margin-bottom: 15px; font-family: var(--cm-font); color: #666; font-size: 15px;">
    <span style="color:var(--cm-primary); font-weight: bold; font-size: 16px; margin-right: 3px;">*</span> 표시는 필수 입력 항목입니다.
</div>
<form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" role="form" class="form-horizontal">
<input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
<input type="hidden" name="w" value="<?php echo $w ?>">
<input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
<input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
<input type="hidden" name="sca" value="<?php echo $sca ?>">
<input type="hidden" name="sfl" value="<?php echo $sfl ?>">
<input type="hidden" name="stx" value="<?php echo $stx ?>">
<input type="hidden" name="spt" value="<?php echo $spt ?>">
<input type="hidden" name="sst" value="<?php echo $sst ?>">
<input type="hidden" name="sod" value="<?php echo $sod ?>">
<input type="hidden" name="page" value="<?php echo $page ?>">
<?php
	$option = '';
	$option_hidden = '';
	if ($is_notice || $is_html || $is_secret || $is_mail) {
		if ($is_notice && $bo_table == 'notice') {
			$option .= "\n".'<span class="com_ck"><input type="checkbox" id="notice" name="notice" value="1" '.$notice_checked.'><label for="notice">공지</label></span>';
		}

		if ($is_html) {
			if ($is_dhtml_editor) {
				$option_hidden .= '<input type="hidden" value="html1" name="html">';
			} else {
				//$option .= "\n".'<span class="com_ck"><input type="checkbox" id="html" name="html" onclick="html_auto_br(this);" value="'.$html_value.'" '.$html_checked.'><label for="html">HTML</label></span>';
			}
		}

		if ($is_secret) {
			if ($is_admin || $is_secret==1) {
				$option .= "\n".'<span class="com_ck"><input type="checkbox" id="secret" name="secret" value="secret" '.$secret_checked.'><label for="secret">비밀글</label></span>';
			} else {
				$option_hidden .= '<input type="hidden" name="secret" value="secret">';
			}
		}

		if ($is_notice && $is_admin) {
			$main_checked = ($write['as_type']) ? ' checked' : '';
			//$option .= "\n".'<span class="com_ck"><input type="checkbox" id="as_type" name="as_type" value="1" '.$main_checked.'><label for="as_type">메인글</label></span>';
		}

		if ($is_mail) {
			//$option .= "\n".'<span class="com_ck"><input type="checkbox" id="mail" name="mail" value="mail" '.$recv_email_checked.'><label for="mail">답변메일받기</label></span>';
		}
	}

	echo $option_hidden;
?>

<?php if ($is_name && $bo_table != 'event' && !$is_admin) { ?>
	<div class="write_box">
		<div class="write_tit">
			<label for="wr_name">이름<span style="color:var(--cm-primary); margin-left: 3px;">*</span><strong class="sound_only">필수</strong></label>
		</div>
		<div class="write_content">
			<input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="input_com" size="10" maxlength="20">
		</div>
	</div><!--write_box end-->
<?php } ?>

<?php if ($bo_table == 'event' || $bo_table == 'qa') { // qa는 기존 호환성 위해 남겨둠, event는 이벤트 기간용 ?>
	<div class="write_box">
		<div class="write_tit">
			<label>이벤트 기간<span style="color:var(--cm-primary); margin-left: 3px;">*</span></label>
		</div>
		<div class="write_content">
			<input type="date" name="wr_1" value="<?php echo $wr_1; ?>" required class="input_com" style="width:auto;"> <span style="margin: 0 10px;">~</span> 
			<input type="date" name="wr_2" value="<?php echo $wr_2; ?>" required class="input_com" style="width:auto;">
		</div>
	</div>
<?php } ?>

<?php if ($is_password && $bo_table != 'event' && !$is_admin) { ?>
	<div class="write_box">
		<div class="write_tit">
			<label for="wr_password">비밀번호<span style="color:var(--cm-primary); margin-left: 3px;">*</span><strong class="sound_only">필수</strong></label>
		</div>	
		<div class="write_content">
			<input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="input_com" maxlength="20">
		</div>
	</div><!--write_box end-->
<?php } ?>

<?php if ($option && $bo_table != 'event') { ?>
	<div class="write_box option_box">
		<div class="write_tit">
			<label>옵션</label>
		</div>
		<div class="write_content">
			<?php echo $option ?>
		</div>
	</div><!--write_box end-->
<?php } ?>

<?php if ($is_category) { ?>
	<?php if ($bo_table == 'event') { ?>
		<input type="hidden" name="ca_name" id="ca_name" value="진행중인 이벤트">
	<?php } else { ?>
	<div class="write_box">
		<div class="write_tit">
			<label>분류<span style="color:var(--cm-primary); margin-left: 3px;">*</span></label>
		</div>
		<div class="write_content">
			<select name="ca_name" id="ca_name" required class="input_com" style="width:100%; border:0; background:transparent;">
				<option value="">선택하세요</option>
				<?php echo $category_option ?>
			</select>
		</div>
	</div><!--write_box end-->
	<?php } ?>
<?php } ?>

<div class="write_box">
	<div class="write_tit">
		<label for="wr_subject">제목<span style="color:var(--cm-primary); margin-left: 3px;">*</span><strong class="sound_only">필수</strong></label>
	</div>
	<div class="write_content">
		<div class="subject_box">
			<input type="text" name="wr_subject" value="<?php echo $subject ?>" id="wr_subject" required class="input_com" size="50" maxlength="255" style="border-radius: 5px;">
		</div>
	</div>
</div><!--write_box end-->

<div class="write_box">
	<div class="write_tit">
		<label for="wr_content">내용<span style="color:var(--cm-primary); margin-left: 3px;">*</span><strong class="sound_only">필수</strong></label>
	</div>
	<div class="write_content">
		<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>

		<?php if($write_min || $write_max) { ?>
			<!-- 최소/최대 글자 수 사용 시 -->
			<p class="write_desc">
				※현재 <b id="char_count"></b> 글자이며, 최소 <b><?php echo $write_min; ?></b> 글자 이상, 최대 <b><?php echo $write_max; ?></b> 글자 이하까지 쓰실 수 있습니다.
			</p>
		<?php } ?>
	</div>
</div><!--write_box end-->

<?php if ($is_file) { ?>
	<?php if ($bo_table == 'event' && $file_count > 0): ?>
		<!-- 썸네일 (이벤트 전용) -->
		<div class="write_box">
			<div class="write_tit">
				<label>썸네일 이미지<span style="color:var(--cm-primary); margin-left: 3px;">*</span></label>
			</div>
			<div class="write_content">
				<?php $i = 0; ?>
				<div class="file_box">
					<div class="file_upload">
						<?php if( $w == 'u' && $file[$i]['source']){ echo '<p class="file_name ellipsis on">'.$file[$i]['source'].'</p>'; }else{ ?>
							<p class="file_name ellipsis"></p>
						<?php } ?>
						<input type="file" name="bf_file[]" id="write_file<?php echo $i+1 ?>" title="썸네일 이미지 (필수)" class="file_input">
						<label for="write_file<?php echo $i+1 ?>" class="file_label">썸네일 첨부</label>
					</div>
					<p style="margin-top:8px; font-size:13px; color:#888;">* 이벤트 리스트에 보여질 썸네일 이미지를 등록해주세요 (권장크기: 자유)</p>
					<?php if($w == 'u' && $file[$i]['file']) { ?>
						<span class="com_ck file_remove" style="margin-left: 10px;">
							<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1" ><label for="bf_file_del<?php echo $i ?>">삭제</label>
						</span>
					<?php } ?>
				</div>
			</div>
		</div>

		<!-- 일반 첨부파일 -->
		<?php if ($file_count > 1): ?>
		<div class="write_box">
			<div class="write_tit">
				<label>첨부파일</label>
			</div>
			<div class="write_content">
				<?php for ($i=1; $is_file && $i<$file_count; $i++) { ?>
					<div class="file_box">
						<div class="file_upload">
							<?php if( $w == 'u' && $file[$i]['source']){ echo '<p class="file_name ellipsis on">'.$file[$i]['source'].'</p>'; }else{ ?>
								<p class="file_name ellipsis"></p>
							<?php } ?>
							<input type="file" name="bf_file[]" id="write_file<?php echo $i+1 ?>" title="첨부파일" class="file_input">
							<label for="write_file<?php echo $i+1 ?>" class="file_label">파일 등록</label>
						</div>
						<?php if($w == 'u' && $file[$i]['file']) { ?>
							<span class="com_ck file_remove">
								<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1" ><label for="bf_file_del<?php echo $i ?>">삭제</label>
							</span>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div>
		<?php endif; ?>

	<?php else: // 이벤트 게시판이 아닐 경우 기존방식 ?>
		<div class="write_box">
			<div class="write_tit">
				<label>첨부파일</label>
			</div>
			<div class="write_content">
				<?php for ($i=0; $is_file && $i<$file_count; $i++) { ?>
					<div class="file_box">
						<div class="file_upload">
							<?php if( $w == 'u' && $file[$i]['source']){ echo '<p class="file_name ellipsis on">'.$file[$i]['source'].'</p>'; }else{ ?>
								<p class="file_name ellipsis"></p>
							<?php } ?>
							<input type="file" name="bf_file[]" id="write_file<?php echo $i+1 ?>" title="첨부파일 <?php echo ($i+1) ?>" class="file_input">
							<label for="write_file<?php echo $i+1 ?>" class="file_label">파일 등록</label>
						</div>
						<?php if($w == 'u' && $file[$i]['file']) { ?>
							<span class="com_ck file_remove">
								<input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i;  ?>]" value="1" ><label for="bf_file_del<?php echo $i ?>">삭제</label>
							</span>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		</div><!--write_box end-->
	<?php endif; ?>
	<script>
		$('.file_input').change(function(){
			var file_name = $(this).val();
			file_name = file_name.replace(/.*[\/\\]/, '');
			$(this).siblings('p').text(file_name);
			$(this).siblings('p').addClass('on');
		});
	</script>
<?php } ?>

<?php if ($captcha_html) { //자동등록방지  ?>
	<div class="write_box">
		<div class="write_tit">
			<label for="captcha_key">자동등록방지</label>
		</div>
		<div class="write_content">
			<?php echo $captcha_html; ?>
		</div>
	</div><!--write_box end-->
<?php } ?>

<div class="write_btn_box">
	<a href="./board.php?bo_table=<?php echo $bo_table ?>" role="button">취소</a>
	<button type="submit" id="btn_submit" accesskey="s">등록하기</button>
</div>

</form>

<script>
<?php if($write_min || $write_max) { ?>
// 글자수 제한
var char_min = parseInt(<?php echo $write_min; ?>); // 최소
var char_max = parseInt(<?php echo $write_max; ?>); // 최대
check_byte("wr_content", "char_count");

$(function() {
	$("#wr_content").on("keyup", function() {
		check_byte("wr_content", "char_count");
	});
});
<?php } ?>

function apms_myicon() {
	document.getElementById("picon").value = '';
	document.getElementById("ticon").innerHTML = '<?php echo str_replace("'","\"", $myicon);?>';
	return true;
}

function html_auto_br(obj) {
	if (obj.checked) {
		result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
		if (result)
			obj.value = "html2";
		else
			obj.value = "html1";
	}
	else
		obj.value = "";
}

function fwrite_submit(f) {

	<?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

	var subject = "";
	var content = "";
	$.ajax({
		url: g5_bbs_url+"/ajax.filter.php",
		type: "POST",
		data: {
			"subject": f.wr_subject.value,
			"content": f.wr_content.value
		},
		dataType: "json",
		async: false,
		cache: false,
		success: function(data, textStatus) {
			subject = data.subject;
			content = data.content;
		}
	});

	if (subject) {
		alert("제목에 금지단어('"+subject+"')가 포함되어있습니다");
		f.wr_subject.focus();
		return false;
	}

	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
		if (typeof(ed_wr_content) != "undefined")
			ed_wr_content.returnFalse();
		else
			f.wr_content.focus();
		return false;
	}

	if (document.getElementById("char_count")) {
		if (char_min > 0 || char_max > 0) {
			var cnt = parseInt(check_byte("wr_content", "char_count"));
			if (char_min > 0 && char_min > cnt) {
				alert("내용은 "+char_min+"글자 이상 쓰셔야 합니다.");
				return false;
			}
			else if (char_max > 0 && char_max < cnt) {
				alert("내용은 "+char_max+"글자 이하로 쓰셔야 합니다.");
				return false;
			}
		}
	}

	<?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함  ?>

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}

$(function(){
	$("#wr_content").addClass("input_com write-content");
});
</script>
