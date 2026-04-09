<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 분류
$categories = explode('|', $qaconfig['qa_category']); // 구분자가 | 로 되어 있음
$ca_cnt = count($categories);
?>

<ul class="faq_tab mgB40">
	<li>
		<a href="./qalist.php" class="ellipsis<?php echo (!$sca) ? ' on' : '';?>">전체<?php if(!$sca) echo '('.number_format($total_count).')';?></a>
	</li>
	<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
		<li>
			<a href="./qalist.php?sca=<?php echo urlencode($categories[$i]);?>" class="ellipsis<?php echo ($categories[$i] == $sca) ? ' on' : '';?>">
				<?php echo $categories[$i];?><?php if($categories[$i] == $sca) //echo '('.number_format($total_count).')';?>
			</a>
		</li>
	<?php } ?>
</ul>
