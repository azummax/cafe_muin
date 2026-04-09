<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
?>

<div class="answer_tit">
	<strong class="answer_A">A</strong>
	<?php echo get_text($answer['qa_subject']); ?>
</div>

<div class="answer_cont">
	<?php echo $answer['content']; ?>
	<span class="date">
		<b>답변 등록일</b> <?php echo date("Y.m.d", strtotime($answer['qa_datetime'])); ?>
	</span>
</div>

<div class="view_btn_box">
	<div>
		<!-- <a href="<?php echo $rewrite_href; ?>" class="board_btn">추가질문</a> -->
		<?php if($answer_update_href || $answer_delete_href) { ?>
			<?php if($answer_update_href) { ?>
				<a href="<?php echo $answer_update_href; ?>" class="board_btn">답변수정</a>
			<?php } ?>
			<?php if($answer_delete_href) { ?>
				<a href="<?php echo $answer_delete_href; ?>" class="board_btn" onclick="del(this.href); return false;">답변삭제</a>
			<?php } ?>
		<?php } ?>
	</div>
</div>
