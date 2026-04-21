<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

$ca_cnt = count($categories);
$boset['ctype'] = (isset($boset['ctype']) && $boset['ctype']) ? $boset['ctype'] : '';
$boset['mctab'] = (isset($boset['mctab']) && $boset['mctab']) ? $boset['mctab'] : 'color';

//탭
$category_tabs = (isset($boset['tab']) && $boset['tab']) ? $boset['tab'] : '';
switch($category_tabs) {
	case '-top'		: $category_tabs .= ' tabs-'.$boset['mctab'].'-top'; break;
	case '-bottom'	: $category_tabs .= ' tabs-'.$boset['mctab'].'-bottom'; break;
	case '-line'	: $category_tabs .= ' tabs-'.$boset['mctab'].'-top tabs-'.$boset['mctab'].'-bottom'; break;
	case '-btn'		: $category_tabs .= ' tabs-'.$boset['mctab'].'-bg'; break;
	case '-box'		: $category_tabs .= ' tabs-'.$boset['mctab'].'-bg'; break;
	default			: $category_tabs .= ($boset['tabline']) ? ' tabs-'.$boset['mctab'].'-top' : ' trans-top'; break;
}

$cate_w = ($boset['ctype'] == "2") ? apms_bunhal($ca_cnt + 1, $boset['bunhal']) : ''; //전체 포함으로 +1 해줌

?>

<?php if($bo_table == 'event') { 
    // 테마 설정에 의해 $sca 가 강제 적용되었더라도, 주소창에 sca 파라미터가 없으면 '전체'로 강제 인식
    if (empty($_GET['sca'])) {
        $sca = '';
        $qstr = preg_replace('/&amp;sca=[^&]+/', '', $qstr);
    }
?>
<!-- Event Board uses FAQ Tab Design -->
<div class="cm-faq-category" style="margin: 70px 0;">
    <ul class="cm-faq-cat-ul" style="justify-content: center; gap: 8px;">
		<li class="cm-faq-cat-li<?php echo (!$sca) ? ' on' : '';?>">
			<a href="./board.php?bo_table=<?php echo $bo_table;?>" class="cm-faq-cat-a">전체</a>
		</li>
		<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
			<li class="cm-faq-cat-li<?php echo ($categories[$i] === $sca) ? ' on' : '';?>">
				<a href="./board.php?bo_table=<?php echo $bo_table;?>&amp;sca=<?php echo urlencode($categories[$i]);?>" class="cm-faq-cat-a">
					<?php echo $categories[$i];?>
				</a>
			</li>
		<?php } ?>
	</ul>
</div>
<?php } else { ?>
<!-- Default Board Tab Design -->
<ul class="sub_cate_tab grid<?php echo $ca_cnt + 1;?>">
	<li<?php echo $cate_w;?>>
		<a href="./board.php?bo_table=<?php echo $bo_table;?>" class="ellipsis<?php echo (!$sca) ? ' on' : '';?>">전체</a>
	</li>
	<?php for ($i=0; $i < $ca_cnt; $i++) { ?>
		<li<?php echo $cate_w;?>>
			<a href="./board.php?bo_table=<?php echo $bo_table;?>&amp;sca=<?php echo urlencode($categories[$i]);?>" class="ellipsis<?php echo ($categories[$i] === $sca) ? ' on' : '';?>">
				<?php echo $categories[$i];?>
			</a>
		</li>
	<?php } ?>
</ul>
<?php } ?>
