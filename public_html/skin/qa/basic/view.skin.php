<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

$attach_list = '';
if ($view['download_count']) {
	for ($i=0; $i<$view['download_count']; $i++) {
		$attach_list .= '<li><a href="'.$view['download_href'][$i].'" target="_blank" class="ellipsis">';
		$attach_list .= $view['download_source'][$i].'</a></li>'.PHP_EOL;
	}
}

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);
add_stylesheet('<link rel="stylesheet" href="/skin/board/Basic-Board/style.css" media="screen">', 0);
add_stylesheet('<link rel="stylesheet" href="/skin/board/Basic-Board/view/basic/view.css" media="screen">', 0);

// 헤더 출력
if($header_skin)
	include_once('./header.php');

// 사진
$view['photo'] = apms_photo_url($view['mb_id']);

?>

<style>
	#btm_customer{display:none;}
</style>

<section class="view_container">
	<div class="view_tit">
		<h3 class="view_subject"><?php echo $view['subject']; ?></h3>
	</div>

	<div class="view_box">
		<div class="view_top">
			<span class="view_name"><b>작성자</b><?php echo $view['name']; ?></span>
			<span class="view_date"><b>등록일</b><?php echo date("Y.m.d", strtotime($view['qa_datetime'])); ?></span>
			<?php if($view['email']) { ?>
			<span class="view_email"><b>이메일</b><?php echo $view['email']; ?></span>
			<?php } ?>
			<?php if($view['hp']) { ?>
			<span class="view_tel"><b>연락처</b><?php echo $view['hp']; ?></span>
			<?php } ?>
		</div>
	</div>

	<div class="view_inner">
		<div class="view_content">
			<?php
				// 이미지 출력
				if($view['img_count']) {
					echo '<div class="view-img">'.PHP_EOL;
					for ($i=0; $i<$view['img_count']; $i++) {
						echo get_view_thumbnail($view['img_file'][$i], $qaconfig['qa_image_width']);
					}
					echo '</div>'.PHP_EOL;
				}
			 ?>

			 <?php echo get_view_thumbnail($view['content'], $qaconfig['qa_image_width']); ?>
		</div>

		<?php if($attach_list){ ?>
		<div class="view_file">
			<strong>첨부파일</strong>
			<ul>
				<?php echo $attach_list;  ?>
			</ul>
		</div>
		<?php } ?>

		<div class="view_answer mgT80">
			<?php
			// 질문글에서 답변이 있으면 답변 출력, 답변이 없고 관리자이면 답변등록폼 출력
			if(!$view['qa_type']) {
				if($view['qa_status'] && $answer['qa_id'])
					include_once($skin_path.'/view.answer.skin.php');
				else
					include_once($skin_path.'/view.answerform.skin.php');
			}
			?>
		</div>
	</div>
</section>


<a href="<?php echo $list_href ?>" class="view_list_btn">목록보기</a>

<div class="view_paging">
	<?php if ($next_href) { ?>
	<a role="button" href="<?php echo $next_href; ?>" class="view_paging_prev">
		<b>PREV</b>
		<p class="ellipsis">질문 있습니다.</p>
	</a>
	<?php }else{ ?>
	<div class="view_paging_prev">
		<b>PREV</b>
		<p class="ellipsis">이전글이 없습니다.</p>
	</div>
	<?php } ?>
	<?php if ($prev_href) { ?>
	<a role="button" href="<?php echo $prev_href; ?>" class="view_paging_next">
		<b>NEXT</b>
		<p class="ellipsis">질문 있습니다.</p>
	</a>
	<?php }else{ ?>
	<div class="view_paging_next">
		<b>NEXT</b>
		<p class="ellipsis">다음글이 없습니다.</p>
	</div>
	<?php } ?>
</div>

<div class="view_btn_box">
	<div>
		<?php if($view['qa_type']) { ?>
			<a href="<?php echo $rewrite_href; ?>" class="board_btn">추가질문</a>
		<?php } ?>
		<?php if ($update_href) { ?><a href="<?php echo $update_href ?>" class="board_btn">수정</a><?php } ?>
		<?php if ($delete_href) { ?><a href="<?php echo $delete_href ?>" class="board_btn" onclick="del(this.href); return false;">삭제</a><?php } ?>
	</div>
	<?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="board_btn">글쓰기</a><?php } ?>
</div>

<script>
$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });
});
</script>