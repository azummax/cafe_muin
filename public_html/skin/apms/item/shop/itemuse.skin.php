<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!$wset['ucont']) $wset['ucont'] = 85;

$list_cnt = count($list);

?>

<?php for ($i=0; $i < $list_cnt; $i++) { ?>
	<div class="review_box">
		<a href="#" onclick="more_is('more_is_<?php echo $i; ?>'); return false;">
			<div class="star_box">
				<?php echo apms_get_star($list[$i]['is_score']); //별점 ?>
			</div>
			<div class="txt_box">
				<strong class="skip_tag"><?php echo $list[$i]['is_num']; ?>.<?php echo $list[$i]['is_subject']; ?></strong>
				<div class="info">
					<span class="date"><?php echo apms_date($list[$i]['is_time']);?></span>
					<span class="name"><?php echo $list[$i]['is_name']; ?></span>
				</div>
				<div class="content ellipsis">
					<?php echo apms_cut_text($list[$i]['is_content']); ?>
				</div>
			</div>
		</a>
		<div class="review_content media-content" id="more_is_<?php echo $i; ?>" style="display:none;">
			<div class="content_inner"><?php echo get_view_thumbnail($list[$i]['is_content'], $default['pt_img_width']); // 후기 내용 ?></div>
			<?php if ($list[$i]['is_btn']) { ?>
				<div class="print-hide media-btn sm_btn_box">
					<a href="#" onclick="apms_form('itemuse_form', '<?php echo $list[$i]['is_edit_href'];?>'); return false; " class="bk">수정</a>
					<a href="#" onclick="apms_delete('itemuse', '<?php echo $list[$i]['is_del_href'];?>', '<?php echo $list[$i]['is_del_return'];?>'); return false; ">삭제</a>
					<?php if ($is_admin) { ?>
						<a href="<?php echo G5_ADMIN_URL;?>/shop_admin/itemuselist.php" target="_blank" title="새창열림">답글쓰기</a>
					<?php } ?>
				</div>
			<?php } ?>
			<?php if ($list[$i]['is_reply']) { ?>
				<div class="review_reply">
					<div class="info">
						<!-- <span><?php echo $list[$i]['is_reply_subject']; //답변 제목 ?></span> -->
						<span>2023.00.00</span>
						<span><?php echo $list[$i]['is_reply_name']; //답변 작성자 ?></span>
					</div>
					<?php echo get_view_thumbnail($list[$i]['is_reply_content'], $default['pt_img_width']); //답변 내용 ?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>

<?php if(!$list_cnt){ ?>
<div class="print-hide well text-center" style="margin-top:30px;"> 
	등록된 리뷰가 없습니다.
</div>
<?php } ?>

<div class="pagination_btn_box">
	<button type="button" class="review_write" onclick="apms_form('itemuse_form', '<?php echo $itemuse_form; ?>');">후기작성하기<span class="sound_only">새 창</span></button>
	<ul class="pagination pagination-sm en">
		<?php echo apms_ajax_paging('itemuse', $write_pages, $page, $total_page, $list_page); ?>
	</ul>
	<?php if($admin_href) { ?>
	<div class="sm_btn_box">
		<a href="<?php echo $itemuse_list; ?>" class="bk">더보기</a>
		<a href="<?php echo $admin_href; ?>">관리</a>
	</div>
	<?php } ?>
</div>

<script>
function more_is(id) {
	$("#" + id).toggle();
}
</script>