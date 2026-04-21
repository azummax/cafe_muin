<?php
/**
 * 링크 URL에서 qawrite.php 여부를 확인하여,
 * 비로그인이면 login.php?url=... 으로 교체해 반환하는 헬퍼
 */
if (!function_exists('cm_qa_href')) {
    function cm_qa_href($href, $is_member, $name = '') {
        if (strpos($href, 'qawrite.php') !== false || strpos($href, 'qalist.php') !== false || trim(strip_tags($name)) == '문의하기') {
            $qa_url = G5_BBS_URL . '/qawrite.php';
            if (!$is_member) {
                return G5_BBS_URL . '/login.php?url=' . urlencode($qa_url);
            }
            return $qa_url;
        }
        return $href;
    }
}
?>
<ul class="menu_list">
<?php
	for ($i=1; $i < $menu_cnt; $i++) {

		if(!$menu[$i]['gr_id']) continue;

		$dep1_href = $menu[$i]['href'];
		if ($menu[$i]['is_sub'] && count($menu[$i]['sub']) > 0) {
			// 이벤트 게시판은 진행중인 이벤트 탭으로 강제 이동하지 않고 전체보기를 유지
			if (strpos($menu[$i]['href'], 'bo_table=event') === false) {
				$dep1_href = $menu[$i]['sub'][0]['href'];
			}
		}
		$dep1_href = cm_qa_href($dep1_href, $is_member, $menu[$i]['name']);
?>
	<li class="dep1_li">
		<a class="dep1_a" href="<?php echo $dep1_href;?>"<?php echo $menu[$i]['target'];?> <?php if( $i == 1){ echo "id='gnb_start'"; } ?>>
			<?php echo $menu[$i]['name'];?>
		</a>
		<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
			<ul class="dep2_ul">
				<?php for($j=0; $j < count($menu[$i]['sub']); $j++) { ?>
					<li class="dep2_li">
						<a href="<?php echo cm_qa_href($menu[$i]['sub'][$j]['href'], $is_member, $menu[$i]['sub'][$j]['name']);?>" class="dep2_a <?php echo $menu[$i]['sub'][$j]['on'];?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
							<?php echo $menu[$i]['sub'][$j]['name'];?>
						</a>
						<!-- <?php if($menu[$i]['sub'][$j]['is_sub']) { // Is Sub Menu ?>
							<ul class="dep3_ul">
								<?php
									for($k=0; $k < count($menu[$i]['sub'][$j]['sub']); $k++) {
								?>
									<li class="dep3_li">
										<a href="<?php echo $menu[$i]['sub'][$j]['sub'][$k]['href'];?>" class="dep3_a <?php echo $menu[$i]['sub'][$j]['sub'][$k]['on'];?>"<?php echo $menu[$i]['sub'][$j]['sub'][$k]['target'];?>>
											<?php echo $menu[$i]['sub'][$j]['sub'][$k]['name'];?>
										</a>
									</li>
								<?php } ?>
							</ul>
						<?php } ?> -->
					</li>
				<?php } //for ?>
			</ul>
		<?php } ?>
	</li>
<?php } //for ?>
</ul>

<script>
$(function(){
	$('#gnb .dep1_li').mouseenter(function(){
		$(this).children('ul').stop().fadeIn(300);
		$(this).addClass('on');
	});
	$('#gnb .dep1_li').mouseleave(function(){
		$(this).children('ul').stop().fadeOut(300);
		$(this).removeClass('on');
	});

	$('#gnb .dep1_li').focusin(function(){
		$(this).children('ul').stop().fadeIn(300);
		$(this).addClass('on');
	});
	$('#gnb .dep1_li').focusout(function(){
		$(this).children('ul').stop().fadeOut(300);
		$(this).removeClass('on');
	});
});
</script>