<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

$btn3 = (isset($wset['btn3']) && $wset['btn3']) ? $wset['btn3'] : 'black';

?>

<?php
$current_ca_id = isset($_GET['ca_id']) ? $_GET['ca_id'] : '10';
$cat_names = array(
    '10' => '전체',
    '1010' => '커피',
    '1020' => '라떼',
    '1030' => '에이드',
    '1040' => '차'
);
$display_title = isset($cat_names[$current_ca_id]) ? $cat_names[$current_ca_id] : $page_title;
?>
<div class="shop_top_box mgB60">
	<ul class="sub_path at-container mgB30">
		<li><a href="/" title="홈"><iconify-icon icon="ph:house-light" width="18" height="18"></iconify-icon></a></li>
		<li>전체제품</li>
		<?php
			echo ($page_nav1) ? '<li>'.$page_nav1.'</li>' : '<li>'.$display_title.'</li>';
			echo ($page_nav2) ? '<li>'.$page_nav2.'</li>' : '';
			echo ($page_nav3) ? '<li>'.$page_nav3.'</li>' : '';
		?>
	</ul>
	<div class="sub_top_tit_wrap at-container mgB30">
		<h2 class="sub_top_tit"><?php echo $display_title;?></h2>
	</div>
</div>


<?php if($is_cate) { ?>
<ul class="product_tab mgB60">
	<li class="<?php echo ($current_ca_id == '10') ? 'on' : ''; ?>">
		<a href="./list.php?ca_id=10">
			<div class="ico_box all"></div>
			<strong>전체</strong>
		</a>
	</li>
	<li class="<?php echo ($current_ca_id == '1010') ? 'on' : ''; ?>">
		<a href="./list.php?ca_id=1010">
			<div class="ico_box ico01"></div>
			<strong>커피</strong>
		</a>
	</li>
	<li class="<?php echo ($current_ca_id == '1020') ? 'on' : ''; ?>">
		<a href="./list.php?ca_id=1020">
			<div class="ico_box ico02"></div>
			<strong>라떼</strong>
		</a>
	</li>
	<li class="<?php echo ($current_ca_id == '1030') ? 'on' : ''; ?>">
		<a href="./list.php?ca_id=1030">
			<div class="ico_box ico03"></div>
			<strong>에이드</strong>
		</a>
	</li>
	<li class="<?php echo ($current_ca_id == '1040') ? 'on' : ''; ?>">
		<a href="./list.php?ca_id=1040">
			<div class="ico_box ico04"></div>
			<strong>차</strong>
		</a>
	</li>
</ul>
<?php } ?>


<div class="product_top mgB60">
	<strong class="item_total">Total<b class="count"><?php echo number_format($total_count); ?></b></strong>
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
				<button type="button" onclick="alert('준비중입니다'); return false" class="search_btn" aria-label="검색"><iconify-icon icon="ph:magnifying-glass-light" width="22" height="22"></iconify-icon></button>
			</div>
		</div>
	</form>
</div>