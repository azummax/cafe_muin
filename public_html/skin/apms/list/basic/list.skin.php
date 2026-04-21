<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

//자동높이조절
apms_script('imagesloaded');
apms_script('height');

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/style.css" media="screen">', 0);

// 버튼컬러
$btn1 = (isset($wset['btn1']) && $wset['btn1']) ? $wset['btn1'] : 'black';
$btn2 = (isset($wset['btn2']) && $wset['btn2']) ? $wset['btn2'] : 'color';

// 썸네일
$thumb_w = (isset($wset['thumb_w']) && $wset['thumb_w'] > 0) ? $wset['thumb_w'] : 400;
$thumb_h = (isset($wset['thumb_h']) && $wset['thumb_h'] > 0) ? $wset['thumb_h'] : 540;
$img_h = apms_img_height($thumb_w, $thumb_h, '135');

$wset['line'] = (isset($wset['line']) && $wset['line'] > 0) ? $wset['line'] : 2;
$line_height = 20 * $wset['line'];

// 간격
$gap_right = (isset($wset['gap']) && ($wset['gap'] > 0 || $wset['gap'] == "0")) ? $wset['gap'] : 15;
$minus_right = ($gap_right > 0) ? '-'.$gap_right : 0;

$gap_bottom = (isset($wset['gapb']) && ($wset['gapb'] > 0 || $wset['gapb'] == "0")) ? $wset['gapb'] : 30;
$minus_bottom = ($gap_bottom > 0) ? '-'.$gap_bottom : 0;

// 가로수
$item = (isset($wset['item']) && $wset['item'] > 0) ? $wset['item'] : 4;

// 반응형
if(_RESPONSIVE_) {
	$lg = (isset($wset['lg']) && $wset['lg'] > 0) ? $wset['lg'] : 3;
	$md = (isset($wset['md']) && $wset['md'] > 0) ? $wset['md'] : 3;
	$sm = (isset($wset['sm']) && $wset['sm'] > 0) ? $wset['sm'] : 2;
	$xs = (isset($wset['xs']) && $wset['xs'] > 0) ? $wset['xs'] : 2;
}

// 새상품
$is_new = (isset($wset['new']) && $wset['new']) ? $wset['new'] : 'red'; 
$new_item = ($wset['newtime']) ? $wset['newtime'] : 24;

// DC
$is_dc = (isset($wset['dc']) && $wset['dc']) ? $wset['dc'] : 'orangered'; 

// 그림자
$shadow_in = '';
$shadow_out = (isset($wset['shadow']) && $wset['shadow']) ? apms_shadow($wset['shadow']) : '';
if($shadow_out && isset($wset['inshadow']) && $wset['inshadow']) {
	$shadow_in = '<div class="in-shadow">'.$shadow_out.'</div>';
	$shadow_out = '';	
}

$list_cnt = count($list);

include_once($list_skin_path.'/category.skin.php');
?>

<style>
	.list-wrap { margin-right:<?php echo $minus_right;?>px; }
	.list-wrap .item-row { width:<?php echo apms_img_width($item);?>%; }
	.list-wrap .item-list { margin-right:<?php echo $gap_right;?>px; margin-bottom:<?php echo $gap_bottom;?>px; }
	.list-wrap .img_box { padding-bottom:<?php echo $img_h;?>%; }
	<?php if(_RESPONSIVE_) { // 반응형일 때만 작동 ?>
		<?php if($lg) { ?>
		@media (max-width:1199px) { 
			.responsive .list-wrap .item-row { width:<?php echo apms_img_width($lg);?>%; } 
		}
		<?php } ?>
		<?php if($md) { ?>
		@media (max-width:991px) { 
			.responsive .list-wrap .item-row { width:<?php echo apms_img_width($md);?>%; } 
		}
		<?php } ?>
		<?php if($sm) { ?>
		@media (max-width:768px) { 
			.responsive .list-wrap .item-row { width:<?php echo apms_img_width($sm);?>%; } 
		}
		<?php } ?>
		<?php if($xs) { ?>
		@media (max-width:480px) { 
			.responsive .list-wrap .item-row { width:<?php echo apms_img_width($xs);?>%; } 
		}
		<?php } ?>
	<?php } ?>
</style>
<div class="list-wrap clear">
	<?php
	// 리스트
	for ($i=0; $i < $list_cnt; $i++) {

		// DC
		$cur_price = $dc_per = '';
		if($list[$i]['it_cust_price'] > 0 && $list[$i]['it_price'] > 0) {
			$cur_price = '<strike>&nbsp;'.number_format($list[$i]['it_cust_price']).'&nbsp;</strike>';
			$dc_per = round((($list[$i]['it_cust_price'] - $list[$i]['it_price']) / $list[$i]['it_cust_price']) * 100);
		}

		// 라벨
		$item_label = '';
		if($dc_per || $list[$i]['it_type5']) {
			$item_label = '<div class="label-cap bg-red">DC</div>';	
		} else if($list[$i]['it_type3'] || $list[$i]['pt_num'] >= (G5_SERVER_TIME - ($new_item * 3600))) {
			$item_label = '<div class="label-cap bg-'.$wset['new'].'">New</div>';
		}

		// 아이콘
		$item_icon = item_icon($list[$i]);
		$item_icon = ($item_icon) ? '<div class="label-tack">'.$item_icon.'</div>' : '';

		// 이미지
		$img = apms_it_thumbnail($list[$i], $thumb_w, $thumb_h, false, true);

	?>
		<div class="item-row">
			<a href="<?php echo $list[$i]['href'];?>" class="item-list cm_new_card">
				<div class="cm_new_img_box">
					<img src="<?php echo $img['src'];?>" alt="<?php echo $img['alt'];?>" onerror="this.src='https://placehold.co/500x500/f5f5f5/cccccc?text=NO+IMAGE'">
				</div>
                <div class="cm_new_txt_box">
                    <strong class="cm_new_title"><?php echo $list[$i]['it_name']; ?></strong>
                    <div class="cm_new_price_wrap">
                    <?php
                    global $is_member;
                    $it_price = $list[$i]['it_price'];
                    $it_cust_price = $list[$i]['it_cust_price'];
                    if (!$is_member) {
                        echo '<span class="cm_new_price" style="font-size:18px; color:#999;">비공개</span>';
                    } else {
                        if ($it_cust_price > 0 && $it_price > 0 && $it_cust_price > $it_price) {
                            echo '<del class="cm_new_cust_price" style="color:#999; font-size:18px; text-decoration:line-through; margin-right:6px;">'.number_format($it_cust_price).'원</del> <span class="cm_new_price" style="color:#ff6600; font-size:18px; font-weight:500;">'.number_format($it_price).'원</span>';
                        } else {
                            echo '<span class="cm_new_price" style="color:#ff6600; font-size:18px; font-weight:500;">'.number_format($it_price).'원</span>';
                        }
                    }
                    ?>
                    </div>
                </div>
			</a>

		</div>
	<?php } // end for ?>
	<?php if(!$list_cnt) { ?>
		<div class="list-none">등록된 상품이 없습니다.</div>
	<?php } ?>
</div>
<script>
$(document).ready(function(){
	$('.list-wrap').imagesLoaded(function(){
		$('.list-wrap .item-content').matchHeight();
	});
});
</script>

<div class="list-btn text-center">
	<div class="list-page">
		<ul class="pagination pagination-sm en">
			<?php echo apms_paging($write_pages, $page, $total_page, $list_page); ?>
		</ul>
	</div>
	<div class="btn-group">
		<?php if ($is_event) { ?>
			<a class="btn btn-<?php echo $btn2;?> btn-sm" href="./event.php"><i class="fa fa-gift"></i> 이벤트</a>
		<?php } ?>
		<?php if ($write_href) { ?>
			<a class="btn btn-<?php echo $btn1;?> btn-sm" href="<?php echo $write_href;?>"><i class="fa fa-upload"></i><span class="hidden-xs"> 등록</span></a>
		<?php } ?>
		<?php if ($admin_href) { ?>
			<a class="btn btn-<?php echo $btn1;?> btn-sm" href="<?php echo $admin_href;?>"><i class="fa fa-th-large"></i><span class="hidden-xs"> 관리</span></a>
		<?php } ?>
		<?php if ($config_href) { ?>
			<a class="btn btn-<?php echo $btn1;?> btn-sm" href="<?php echo $config_href;?>"><i class="fa fa-cog"></i><span class="hidden-xs"> 설정</span></a>
		<?php } ?>
		<?php if($setup_href) { ?>
			<a class="btn btn-<?php echo $btn1;?> btn-sm win_memo" href="<?php echo $setup_href;?>"><i class="fa fa-cogs"></i><span class="hidden-xs"> 스킨설정</span></a>
		<?php } ?>
		<?php if ($rss_href) { ?>
			<!-- <a class="btn btn-<?php echo $btn2;?> btn-sm" title="카테고리 RSS 구독하기" href="<?php echo $rss_href;?>" target="_blank"><i class="fa fa-rss fa-lg"></i></a> -->
		<?php } ?>
	</div>
</div>
