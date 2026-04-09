<ul class="menu_list">
<?php
	for ($i=1; $i < $menu_cnt; $i++) {

		if(!$menu[$i]['gr_id']) continue;

		$dep1_href = $menu[$i]['href'];
		if ($menu[$i]['is_sub'] && count($menu[$i]['sub']) > 0) {
			$dep1_href = $menu[$i]['sub'][0]['href'];
		}
?>
	<li class="dep1_li">
		<a class="dep1_a" href="<?php echo $dep1_href;?>"<?php echo $menu[$i]['target'];?> <?php if( $i == 1){ echo "id='gnb_start'"; } ?>>
			<?php echo $menu[$i]['name'];?>
		</a>
		<?php if($menu[$i]['is_sub']) { //Is Sub Menu ?>
			<ul class="dep2_ul">
				<?php for($j=0; $j < count($menu[$i]['sub']); $j++) { ?>
					<li class="dep2_li">
						<a href="<?php echo $menu[$i]['sub'][$j]['href'];?>" class="dep2_a <?php echo $menu[$i]['sub'][$j]['on'];?>"<?php echo $menu[$i]['sub'][$j]['target'];?>>
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