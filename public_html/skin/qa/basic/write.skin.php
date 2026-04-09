<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);
add_stylesheet('<link rel="stylesheet" href="/skin/board/Basic-Board/style.css" media="screen">', 0);
add_stylesheet('<link rel="stylesheet" href="/skin/board/Basic-Board/write/basic/write.css" media="screen">', 0);

// 헤더 출력
if($header_skin)
	include_once('./header.php');

?>

<?php if($is_dhtml_editor) { ?>
	<style>
		#qa_content { border:0; display:none; }
		#btm_customer{display:none;}
	</style>
<?php } ?>

<div id="bo_w" class="write-wrap box-colorset<?php echo (G5_IS_MOBILE) ? ' box-colorset-mobile' : '';?>">
	
	<!-- 게시물 작성/수정 시작 { -->
    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off" role="form" class="form-horizontal">
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="qa_id" value="<?php echo $qa_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
	<input type="hidden" name="token" value="<?php echo $token ?>">
	<input type="hidden" name="qa_category" value="회원">

	<?php if ($category_option) { ?>
		<div class="write_box">
			<div class="write_tit">
				<label for="qa_category">분류</label>
			</div>
			<div class="write_content">
				<select name="qa_category" id="qa_category" required class="input_com">
					<option value="">선택하세요</option>
					<?php echo $category_option ?>
				</select>
			</div>
		</div><!--write_box end-->
	<?php } ?>

	<?php if ($is_email) { ?>
		<div class="write_box">
			<div class="write_tit">
				<label for="qa_email">이메일</label>
			</div>
			<div class="write_content">
				<div class="flex_box">
					<input type="text" name="qa_email" value="<?php echo get_text($write['qa_email']); ?>" id="qa_email" <?php echo $req_email; ?> class="input_com" size="50" maxlength="100">
					<span class="com_ck">
						<input type="checkbox" name="qa_email_recv" value="1" id="qa_email_recv" <?php if($write['qa_email_recv']) echo 'checked="checked"'; ?>>
						<label for="qa_email_recv">답변받기</label>
					</span>
				</div>
			</div>
		</div><!--write_box end-->
	<?php } ?>

	<?php if ($is_hp) { ?>
		<div class="write_box">
			<div class="write_tit">
				<label for="qa_hp">연락처</label>
			</div>
			<div class="write_content">
				<div class="<?php if($qaconfig['qa_use_sms']){ echo 'flex_box'; }?>">
					<input type="text" name="qa_hp" value="<?php echo get_text($write['qa_hp']); ?>" id="qa_hp" <?php echo $req_hp; ?> class="input_com" size="30">
					<?php if($qaconfig['qa_use_sms']) { ?>
						<span class="com_ck">
							<input type="checkbox" name="qa_sms_recv" value="1" id="qa_sms_recv" <?php if($write['qa_sms_recv']) echo 'checked="checked"'; ?>>
							<label for="qa_sms_recv">답변 SMS 수신</label>
						</span>
					<?php } ?>
				</div>
			</div>
		</div><!--write_box end-->
	<?php } ?>

	<div class="write_box">
		<div class="write_tit">
			<label for="qa_subject">제목<span class="orangered">*</span><strong class="sound_only">필수</strong></label>
		</div>
		<div class="write_content">
			<?php if ($is_dhtml_editor) { ?>
				<input type="text" name="qa_subject" value="<?php echo get_text($write['qa_subject']); ?>" id="qa_subject" required class="input_com" size="50" maxlength="255">
				<input type="hidden" name="qa_html" value="1">
			<?php } else { ?>
				<div class="flex_box">
					<input type="text" name="qa_subject" value="<?php echo $write['qa_subject']; ?>" id="qa_subject" required class="input_com" size="50" maxlength="255">
					<span class="com_ck">
						<input type="checkbox" id="qa_html" name="qa_html" onclick="html_auto_br(this);" value="'.$html_value.'" <?php echo $html_checked;?>>
						<label for="qa_html">html</label>
					</span>
				</div>
			<?php } ?>
		</div>
	</div><!--write_box end-->

	<div class="write_box">
		<div class="write_tit">
			<label for="wr_content">내용<span class="orangered">*</span><strong class="sound_only">필수</strong></label>
		</div>
		<div class="write_content">
			<?php echo $editor_html; // 에디터 사용시는 에디터로, 아니면 textarea 로 노출 ?>
		</div>
	</div><!--write_box end-->

	<div class="write_box">
		<div class="write_tit">
			<label>첨부파일</label>
		</div>
		<div class="write_content">
			<div class="file_box">
				<div class="file_upload">
					<?php if( $w == 'u' && $write['qa_source1']){ echo '<p class="file_name ellipsis on">'.$write['qa_source1'].'</p>'; }else{ ?>
						<p class="file_name ellipsis"></p>
					<?php } ?>
					<input type="file" id="qa_write_file1" name="bf_file[1]" title="첨부파일 1 :  용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능" class="file_input">
					<label for="qa_write_file1" class="file_label">파일등록</label>
				</div>
				<?php if($w == 'u' && $write['qa_file1']) { ?>
					<span class="com_ck file_remove">
						<input type="checkbox" id="bf_file_del1" name="bf_file_del[1]" value="1"><label for="bf_file_del1"><?php echo $write['qa_source1']; ?> 삭제</label>
					</span>
				<?php } ?>
			</div>
			<div class="file_box">
				<div class="file_upload">
					<?php if( $w == 'u' && $write['qa_source2']){ echo '<p class="file_name ellipsis on">'.$write['qa_source2'].'</p>'; }else{ ?>
						<p class="file_name ellipsis"></p>
					<?php } ?>
					<input type="file" id="qa_write_file2" name="bf_file[2]" title="첨부파일 2 :  용량 <?php echo $upload_max_filesize; ?> 이하만 업로드 가능" class="file_input">
					<label for="qa_write_file2" class="file_label">파일등록</label>
				</div>
				<?php if($w == 'u' && $write['qa_file2']) { ?>
					<span class="com_ck file_remove">
						<input type="checkbox" id="bf_file_del2" name="bf_file_del[2]" value="1"><label for="bf_file_del2"><?php echo $write['qa_source2']; ?> 삭제</label>
					</span>
				<?php } ?>
			</div>
		</div>
	</div><!--write_box end-->
	<script>
		$('.file_input').change(function(){
			var file_name = $(this).val();
			file_name = file_name.replace(/.*[\/\\]/, '');
			$(this).siblings('p').text(file_name);
			$(this).siblings('p').addClass('on');
		});
	</script>

	<div class="write_btn_box">
		<a href="<?php echo $list_href; ?>" role="button">취소</a>
		<button type="submit" id="btn_submit" accesskey="s">등록하기</button>
	</div>

	</form>
</div>
<script>
function html_auto_br(obj)
{
	if (obj.checked) {
		result = confirm("자동 줄바꿈을 하시겠습니까?\n\n자동 줄바꿈은 게시물 내용중 줄바뀐 곳을<br>태그로 변환하는 기능입니다.");
		if (result)
			obj.value = "2";
		else
			obj.value = "1";
	}
	else
		obj.value = "";
}

function fwrite_submit(f)
{
	<?php echo $editor_js; // 에디터 사용시 자바스크립트에서 내용을 폼필드로 넣어주며 내용이 입력되었는지 검사함   ?>

	var subject = "";
	var content = "";
	$.ajax({
		url: g5_bbs_url+"/ajax.filter.php",
		type: "POST",
		data: {
			"subject": f.qa_subject.value,
			"content": f.qa_content.value
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
		f.qa_subject.focus();
		return false;
	}

	if (content) {
		alert("내용에 금지단어('"+content+"')가 포함되어있습니다");
		if (typeof(ed_qa_content) != "undefined")
			ed_qa_content.returnFalse();
		else
			f.qa_content.focus();
		return false;
	}

	<?php if ($is_hp) { ?>
	var hp = f.qa_hp.value.replace(/[0-9\-]/g, "");
	if(hp.length > 0) {
		alert("휴대폰번호는 숫자, - 으로만 입력해 주십시오.");
		return false;
	}
	<?php } ?>

	$.ajax({
		type: "POST",
		url: g5_bbs_url+"/ajax.write.token.php",
		data: { 'token_case' : 'qa_write' },
		cache: false,
		async: false,
		dataType: "json",
		success: function(data) {
			if (typeof data.token !== "undefined") {
				token = data.token;

				if(typeof f.token === "undefined")
					$(f).prepend('<input type="hidden" name="token" value="">');

				$(f).find("input[name=token]").val(token);
			}
		}
	});

	document.getElementById("btn_submit").disabled = "disabled";

	return true;
}

$(function(){
	$("#qa_content").addClass("form-control input-sm write-content");
});
</script>
<!-- } 게시물 작성/수정 끝 -->