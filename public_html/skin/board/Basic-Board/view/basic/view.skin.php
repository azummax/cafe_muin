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
			<style>
			.view_file { border:1px solid #ddd; border-radius:8px; padding:20px; background:#fafafa; margin-top:40px; }
			.view_file strong { display:block; font-size:16px; margin-bottom:15px; color:#333; font-weight:600; }
			.view_file ul { list-style:none; padding:0; margin:0; }
			.view_file ul li { margin-bottom:8px; }
			.view_file ul li:last-child { margin-bottom:0; }
			.view_file ul li a.file_down_link { display:flex; align-items:center; padding:12px 20px; background:#fff; border:1px solid #eaeaea; border-radius:6px; color:#555; text-decoration:none; transition:all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1); box-sizing:border-box; justify-content:flex-start; }
			.view_file ul li a.file_down_link i { font-size:20px; margin-right:12px; width:22px; text-align:center; }
			.view_file ul li a.file_down_link .file_name { font-weight:500; font-family:var(--cm-font); }
			.view_file ul li a.file_down_link .file_size { color:#999; font-size:13px; margin-left:8px; }
			.view_file ul li a.file_down_link:hover { border-color:#333; box-shadow:0 5px 15px rgba(0,0,0,0.06); transform:translateY(-2px); color:#222; }
			.view_file ul li a.file_down_link::before { display:none !important; content:''; }
			</style>
			<div class="view_file">
				<strong><i class="fa fa-paperclip"></i> 첨부파일</strong>
				<ul>
					<?php echo $attach_list;  ?>
				</ul>
			</div>
			<?php } ?>
			
		</div>
	</div>
</section>


<?php if($bo_table == 'qna'){ include_once('./view_comment.php'); } ?>
