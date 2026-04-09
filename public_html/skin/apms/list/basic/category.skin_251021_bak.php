<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$btn3 = (isset($wset['btn3']) && $wset['btn3']) ? $wset['btn3'] : 'black';

?>

<div class="shop_top_box mgB60">
	<ul class="sub_path mgB80">
		<li><a href="/"><img src="/thema/Basic/img/sub_path_home.png" alt="메인으로 이동" /></a></li>
		<li>전체제품</li>
		<?php
			echo ($page_nav1) ? '<li>'.$page_nav1.'</li>' : '';
			echo ($page_nav2) ? '<li>'.$page_nav2.'</li>' : '';
			echo ($page_nav3) ? '<li>'.$page_nav3.'</li>' : '';
		?>
	</ul>
	<h2 class="sub_top_tit"><?php echo $page_title;?></h2>
</div>


<?php if($is_cate) { ?>
<ul class="product_tab mgB60">
	<li class="<?php if( !$up_href ){ echo 'on'; } ?>">
		<a href="<?php echo $up_href;?>">
			<div class="ico_box all"></div>
			<strong>전체보기</strong>
		</a>
	</li>
	<?php
	$ca_cnt = count($cate);
	for ($i=0; $i < $ca_cnt; $i++) {
	?>
		<li<?php echo ($cate[$i]['on']) ? ' class="on"' : '';?><?php echo $cate_w;?>>
			<a href="./list.php?ca_id=<?php echo urlencode($cate[$i]['ca_id']);?>">
				<div class="ico_box ico0<?php echo $i+1;?>"></div>
				<strong><?php echo $cate[$i]['name'];?></strong>
			</a>
		</li>
	<?php } ?>
</ul>
<?php } ?>


<div class="product_top mgB60">
	<strong class="item_total">Total <b><?php echo number_format($total_count); ?></b></strong>
	<form class="search_form">
		<div class="search_box">
			<label for="search_select" class="sound_only">검색조건</label>
			<select class="input_com" id="search_select">
				<option>제목</option>
				<option>내용</option>
			</select>
			<div class="input_box">
				<label for="search_input" class="sound_only">검색어</label>
				<input type="text" class="input_com" id="search_input">
				<button onclick="alert('준비중입니다'); return false" class="search_btn">검색</button>
			</div>
		</div>
	</form>
</div>