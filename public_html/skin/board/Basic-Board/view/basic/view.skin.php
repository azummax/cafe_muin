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
		if (isset($view['file'][$i]['source']) && $view['file'][$i]['source']) {
			$file_ext = pathinfo($view['file'][$i]['source'], PATHINFO_EXTENSION);
			$file_ext = strtolower($file_ext);
            
            

			$icon = '<i class="fa fa-file-o"></i>';
			if(in_array($file_ext, array('zip','rar','tar','gz','7z'))) $icon = '<i class="fa fa-file-archive-o" style="color:#e9b518;"></i>';
			else if(in_array($file_ext, array('pdf'))) $icon = '<i class="fa fa-file-pdf-o" style="color:#d33;"></i>';
			else if(in_array($file_ext, array('doc','docx'))) $icon = '<i class="fa fa-file-word-o" style="color:#2a5699;"></i>';
			else if(in_array($file_ext, array('xls','xlsx'))) $icon = '<i class="fa fa-file-excel-o" style="color:#1d6f42;"></i>';
			else if(in_array($file_ext, array('ppt','pptx'))) $icon = '<i class="fa fa-file-powerpoint-o" style="color:#d24726;"></i>';
			else if(in_array($file_ext, array('jpg','jpeg','png','gif','webp'))) $icon = '<i class="fa fa-file-image-o" style="color:#6c8ebf;"></i>';

			if ($board['bo_download_point'] < 0 && $j == 0) {
				$attach_list .= '<li><a href="'.$view['file'][$i]['href'].'" class="file_down_link" style="color:#d55; margin-bottom:8px;">다운로드시 <b>'.number_format(abs($board['bo_download_point'])).'</b>'.AS_MP.' 차감 (최초 1회 / 재다운로드시 차감없음)</a></li>';
			}
			$attach_list .= '<li><a href="'.$view['file'][$i]['href'].'" class="file_down_link">'.$icon.' <span class="file_name">'.$view['file'][$i]['source'].'</span> <span class="file_size">('.$view['file'][$i]['size'].')</span></a></li>';
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
				<?php echo get_view_thumbnail($view['content'],1200); ?>
			</div>

			<?php if($attach_list){ ?>
			<strong class="view_file_label">첨부파일</strong>
			<div class="view_file">
				<ul>
					<?php echo $attach_list; ?>
				</ul>
			</div>
			<?php } ?>
			
		</div>
	</div>
</section>


<?php if($bo_table == 'qna'){ include_once('./view_comment.php'); } ?>
