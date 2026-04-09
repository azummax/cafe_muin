<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);

// 헤더 출력
if($header_skin)
	include_once('./header.php');

?>

<style>
	body .at-main{width:100%;}
</style>

<div class="search_container">
	<form class="form" role="form" name="fsearch" onsubmit="return fsearch_submit(this);" method="get">
		<input type="hidden" name="srows" value="<?php echo $srows ?>">
		<input type="hidden" name="sfl" value="<?php echo "wr_subject||wr_content||as_tag" ?>"><!--제목&내용-->
		<input type="hidden" name="sop" value="<?php echo "and" ?>"><!--그리고-->
		<div class="search_top">
			<div class="search_top_inner">
				<label for="gr_id" class="sound_only">그룹</label>
				<select name="gr_id" id="gr_id" class="search_select">
					<option value="">전체</option>
					<?php echo $group_option ?>
				</select>
				<script>document.getElementById("gr_id").value = "<?php echo $gr_id ?>";</script>
			</div>
			<div class="search_top_inner">
				<label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
				<input type="text" name="stx" value="<?php echo $text_stx ?>" id="stx" required class="search_input" maxlength="20" placeholder="두글자 이상 입력">
			</div>
			<button type="submit" class="search_submin_btn"><img src="/thema/Basic/img/board_search.png" alt="검색" /></button>
		</div>
	</form>
    <script>
    function fsearch_submit(f)
    {
        if (f.stx.value.length < 2) {
            alert("검색어는 두글자 이상 입력하십시오.");
            f.stx.select();
            f.stx.focus();
            return false;
        }

        // 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
        var cnt = 0;
        for (var i=0; i<f.stx.value.length; i++) {
            if (f.stx.value.charAt(i) == ' ')
                cnt++;
        }

        if (cnt > 1) {
            alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
            f.stx.select();
            f.stx.focus();
            return false;
        }

        f.action = "";
        return true;
    }
    </script>
</div>



<?php
if ($stx) {
	if ($board_count) {
 ?>
	 <ul class="search_bbs_list clear">
	 	<li>
			<a href="?<?php echo $search_query ?>&amp;gr_id=<?php echo $gr_id ?>" class="ellipsis"  >
				전체 <?php echo number_format($total_count); ?>건
			</a>
		</li>
		<?php for($i=0;$i < count($bo_list);$i++) { ?>
	 		<li>
				<a href="<?php echo $bo_list[$i]['href']; ?>" class="ellipsis" >
					<?php echo $bo_list[$i]['name'];?> <?php echo number_format($bo_list[$i]['cnt']);?>건
				</a>
			</li>
		<?php } ?>
	 </ul>
<?php } else { ?>
	<p class="search-none text-center text-muted<?php echo (G5_IS_MOBILE) ? '' : ' search-none';?>">검색된 자료가 하나도 없습니다.</p>
<?php } } else { ?>
	<p class="search-none text-center text-muted<?php echo (G5_IS_MOBILE) ? '' : ' search-none';?>">검색어는 두글자 이상, 공백은 1개만 입력할 수 있습니다.</p>
<?php } ?>

<div class="clearfix"></div>



<?php
$k=0;
for ($idx=$table_index, $k=0; $idx<count($search_table) && $k<$rows; $idx++) {
?>
	<strong class="search_list_tit">
		<a href="./board.php?bo_table=<?php echo $search_table[$idx] ?>&amp;<?php echo $search_query ?>"><?php echo $bo_subject[$idx]; ?><span>(<?php echo count($list[$idx]); ?>)</span></a>
	</strong>

	<ul class="search_list_content ">
	<?php
	for ($i=0; $i<count($list[$idx]) && $k<$rows; $i++, $k++) {

		$img = apms_wr_thumbnail($list[$idx][$i]['bo_table'], $list[$idx][$i], 80, 80, false, true); // 썸네일
		$img['src'] = ($img['src']) ? $img['src'] : apms_photo_url($list[$idx][$i]['mb_id']); // 회원사진

		if ($list[$idx][$i]['wr_is_comment']) {
			$comment_def = '<span class="tack-icon bg-orange">댓글</span> ';
			$comment_href = '#c_'.$list[$idx][$i]['wr_id'];
			$fa_icon = 'comment';
			$txt = '[댓글] ';
		} else {
			$comment_def = '';
			$comment_href = '';
			$fa_icon = 'file-text-o';
			$txt = '';
		}
	 ?>
		 <li>
			<a href="<?php echo $list[$idx][$i]['href'] ?><?php echo $comment_href ?>">
				<strong><?php echo $list[$idx][$i]['subject'] ?></strong>
				<p><?php echo apms_cut_text($list[$idx][$i]['content'], 60, '… <span class="search_content_more">[ 더보기 ]</span>'); ?></p>
			</a>
		 </li>
	<?php }  ?>
	</ul>
	<div class="search_content_more_all">
		<a href="./board.php?bo_table=<?php echo $search_table[$idx] ?>&amp;<?php echo $search_query ?>">검색결과 전체보기</a>
	</div>
<?php }  ?>

<?php if($total_count > 0) { ?>
	<div class="text-center search-page">
		<ul class="pagination pagination-sm en">
			<?php echo apms_paging($write_page_rows, $page, $total_page, $list_page); ?>
		</ul>
	</div>
<?php } ?>