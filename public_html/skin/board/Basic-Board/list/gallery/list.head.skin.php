<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if($is_category) {
	$category_href = G5_BBS_URL.'/board.php?bo_table='.$bo_table;
	$category_tabs = (isset($boset['tab']) && $boset['tab']) ? $boset['tab'] : '';
	include_once($board_skin_path.'/category.skin.php'); // 카테고리
}
?>
