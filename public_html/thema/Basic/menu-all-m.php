<div class="m_menu_head">
	<h2>Menu</h2>
	<button type="button" id="m_menu_close_btn" onclick="document.getElementById('m_all_menu').classList.remove('open'); document.getElementById('m_all_btn').classList.remove('on'); $('#all_dummy').fadeOut(220); document.body.style.overflow = '';"><iconify-icon icon="ri:close-line"></iconify-icon></button>
</div>
<ul class="menu_list">
<?php
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
	for ($i=1; $i < $menu_cnt; $i++) {

		if(!$menu[$i]['gr_id']) continue;

?>
	<li class="dep1_li">
		<a class="dep1_a <?php echo $menu[$i]['on'];?>" href="<?php echo cm_qa_href($menu[$i]['href'], $is_member, $menu[$i]['name']);?>"<?php echo $menu[$i]['target'];?>>
			<span class="m_menu_text"><?php echo strip_tags($menu[$i]['name']);?></span>
            <?php if($menu[$i]['is_sub']) { ?>
                <iconify-icon icon="solar:alt-arrow-down-linear" class="m_menu_arrow"></iconify-icon>
            <?php } ?>
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

<div class="m_menu_foot">
    <?php if ($is_member): ?>
        <a href="<?php echo G5_BBS_URL; ?>/logout.php" class="btn_m_logout">로그아웃</a>
    <?php else: ?>
        <a href="<?php echo G5_BBS_URL; ?>/login.php" class="btn_m_login">로그인</a>
        <a href="<?php echo G5_BBS_URL; ?>/register.php" class="btn_m_join">회원가입</a>
    <?php endif; ?>
</div>