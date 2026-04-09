<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$view_skin_url.'/view.css?ver='.date("YmdHis").'" media="screen">', 0);

$attach_list = '';
$attach_link = '';
if ($view['link']) {
	// 링크
	for ($i=1; $i<=count($view['link']); $i++) {
		if ($view['link'][$i]) {
			$attach_link .= '<li><a href="'.$view['link_href'][$i].'" target="_blank" title="새창열림" class="ellipsis">'.cut_str($view['link'][$i], 70).'</a></li>';
		}
	}
}

// 가변 파일
$j = 0;
if ($view['file']['count']) {
	for ($i=0; $i<count($view['file']); $i++) {
		if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) {
			if ($board['bo_download_point'] < 0 && $j == 0) {
				$attach_list .= '<li><a href="'.$view['file'][$i]['href'].'" title="파일 다운로드" class="ellipsis">다운로드시 <b>'.number_format(abs($board['bo_download_point'])).'</b>'.AS_MP.' 차감 (최초 1회 / 재다운로드시 차감없음)</a></li>';
			}
			$attach_list .= '<li><a href="'.$view['file'][$i]['href'].'" title="파일 다운로드" class="ellipsis">'.$view['file'][$i]['source'].' ('.$view['file'][$i]['size'].')</a></li>';
			$j++;
		}
	}
}

$view_font = (G5_IS_MOBILE) ? '' : ' font-12';
$view_subject = get_text($view['wr_subject']);

?>


<section itemscope itemtype="http://schema.org/NewsArticle">
	<div class="view_tit">
		<h3 class="view_subject"><?php echo $view['wr_subject']; ?></h3>
	</div>

	<div class="view_box">
		<div class="view_top">
			<span class="view_name"><b>작성자</b><?php echo $view['wr_name']; ?></span>
			<span class="view_date"><b>등록일</b><?php echo date('Y.m.d', $view['date']);?></span>
			<span class="view_hit"><b>조회수</b><?php echo $view['wr_hit']; ?></span>
		</div>

		<div class="view_inner">

			<?php if ($is_torrent) echo apms_addon('torrent-basic'); // 토렌트 파일정보 ?>

			<div itemprop="description" class="view_content">
		<?php
//					$v_img_count = count($view['file']);
//					if($v_img_count ) {
//						echo '<div class="view-img">'.PHP_EOL;
//						for ($i=0; $i<=count($view['file']); $i++) {
//							if ($view['file'][$i]['view']) {
//								echo get_view_thumbnail($view['file'][$i]['view'],1200);
//							}
//						}
//						echo '</div>'.PHP_EOL;
//					}
//				 ?>

				<?php echo get_view_thumbnail($view['content'],1200); ?>
			</div>

			<?php if($is_file){ ?>
			<div class="view_file">
				<strong>첨부파일</strong>
				<ul>
					<?php echo $is_file;  ?>
				</ul>
			</div>
			<?php } ?>
<!-- 			<?php if($attach_link){ ?> -->
<!-- 			<div class="view_file view_link"> -->
<!-- 				<strong>링크</strong> -->
<!-- 				<ul> -->
<!-- 					<?php echo $attach_link;  ?> -->
<!-- 				</ul> -->
<!-- 			</div> -->
<!-- 			<?php } ?> -->
		</div>
	</div>
</section>


<?php if($bo_table == 'qna'){ include_once('./view_comment.php'); } ?>
