<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$wset['qcont']) $wset['qcont'] = 60;

$list_cnt = count($list);

?>

<?php for ($i=0; $i < $list_cnt; $i++) { ?>
	<div class="qa_box">
		<a href="#" onclick="more_iq('more_iq_<?php echo $i; ?>'); return false;">
			<span class="num"><?php echo $list[$i]['iq_num']; ?></span>
			<span class="subject ellipsis">
				<?php echo $list[$i]['iq_subject']; ?>
				<?php if($list[$i]['iq_secret']) { ?>
					<img src="/thema/Basic/img/qna_secret.png" alt="">
				<?php } ?>
			</span>
			<span class="name"><?php echo preg_replace('/(?<=.{1})./u','*',$list[$i]['iq_name']); ?></span>
			<span class="date"><?php echo apms_date($list[$i]['iq_time']);?></span>
			<span class="state"><?php echo ($list[$i]['iq_answer']) ? '<b class="answer on">답변완료</b>' : '<b class="answer">답변대기중</b>';?></span>
		</a>
		<div class="qa_content" id="more_iq_<?php echo $i; ?>" style="display:none;">
			<div class="content_inner"><?php echo get_view_thumbnail($list[$i]['iq_question'], $default['pt_img_width']); // 문의 내용 ?></div>
			<?php if ($list[$i]['iq_btn']) { ?>
				<div class="print-hide media-btn sm_btn_box">
					<a href="#" onclick="apms_form('itemqa_form', '<?php echo $list[$i]['iq_edit_href'];?>'); return false; " class="bk">수정</a>
					<a href="#" onclick="apms_delete('itemqa', '<?php echo $list[$i]['iq_del_href'];?>', '<?php echo $list[$i]['iq_del_return'];?>'); return false; ">삭제</a>
					<?php if(!$list[$i]['iq_answer'] && $is_admin) { ?>
						<a href="#" onclick="apms_form('itemans_form', '<?php echo $list[$i]['iq_ans_href'];?>'); return false; ">답변</a>
					<?php } ?>
				</div>
			<?php } ?>

			<?php if($list[$i]['answer']) { ?>
				<div class="qa_answer">
					<div class="content_inner">
						<strong class="tit">답변</strong>
						<?php echo get_view_thumbnail($list[$i]['iq_answer'], $default['pt_img_width']); ?>
					</div>
					<?php if($list[$i]['iq_btn'] && $list[$i]['iq_answer']) { ?>
						<div class="print-hide media-btn sm_btn_box">
							<a href="#" onclick="apms_form('itemans_form', '<?php echo $list[$i]['iq_ans_href'];?>'); return false; " class="bk">수정</a>
						</div>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>

<div class="print-hide well text-center" style="margin-top:30px;"> 
	결제, 배송 등과 관련된 문의는 <a href="<?php echo $at_href['secret'];?>"><b>1:1 문의</b></a>로 등록해 주세요.
</div>

<div class="pagination_btn_box">
	<button type="button" class="review_write qna" onclick="apms_form('itemqa_form', '<?php echo $itemqa_form; ?>');">상품문의하기<span class="sound_only"> 새 창</span></button>
	<ul class="pagination pagination-sm en">
		<?php echo apms_ajax_paging('itemqa', $write_pages, $page, $total_page, $list_page); ?>
	</ul>
	<?php if($admin_href) { ?>
	<div class="sm_btn_box">
		<a href="<?php echo $itemqa_list; ?>" class="bk">더보기</a>
		<a href="<?php echo $admin_href; ?>">관리</a>
	</div>
	<?php } ?>
</div>

<script>
function more_iq(id) {
	$("#" + id).toggle();
}
</script>