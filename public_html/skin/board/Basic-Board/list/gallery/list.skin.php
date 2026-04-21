<?php
if (!defined('_GNUBOARD_')) exit;
add_stylesheet('<link rel="stylesheet" href="'.$list_skin_url.'/list.css">', 0);

$list_cnt = count($list);
?>

<?php if ($list_cnt > 0): ?>
<ul class="event-gallery-grid">
    <?php for ($i = 0; $i < $list_cnt; $i++):
        $thumb = '';
        // 첫 번째 첨부 이미지 추출
        if (!empty($list[$i]['wr_file'])) {
            $sql_f = "SELECT bf_file FROM {$g5['board_file_table']} WHERE bo_table='{$bo_table}' AND wr_id='{$list[$i]['wr_id']}' AND bf_type > 0 ORDER BY bf_no LIMIT 1";
            $row_f = sql_fetch($sql_f);
            if ($row_f['bf_file']) {
                $thumb = G5_DATA_URL.'/file/'.$bo_table.'/'.$row_f['bf_file'];
            }
        }
        // wr_content에서 이미지 추출 (대체)
        if (!$thumb && preg_match('/<img[^>]+src=[\'"]([^\'"]+)[\'"]/', $list[$i]['wr_content'], $m)) {
            $thumb = $m[1];
        }
    ?>
            <li class="event-gallery-item">
                <a href="<?php echo $list[$i]['href']; ?>" class="event-gallery-link">
                    <div class="event-gallery-img-wrap">
                        <?php if ($thumb): ?>
                            <img src="<?php echo $thumb; ?>" alt="<?php echo get_text($list[$i]['wr_subject']); ?>" class="event-gallery-img" loading="lazy">
                        <?php else: ?>
                            <div class="event-gallery-no-img">
                                <iconify-icon icon="ph:image-light" width="48" height="48"></iconify-icon>
                            </div>
                        <?php endif; ?>
                        
                        <?php 
                        $is_ended = false;
                        if ($list[$i]['wr_2'] && $list[$i]['wr_2'] < G5_TIME_YMD) {
                            $is_ended = true;
                        }
                        if ($is_ended): 
                        ?>
                        <div class="event-gallery-ended-overlay">
                            이벤트가 종료되었습니다.
                        </div>
                        <?php endif; ?>
                    </div>
            <div class="event-gallery-info">
                <strong class="event-gallery-subject"><?php echo get_text($list[$i]['wr_subject']); ?></strong>
            </div>
        </a>
    </li>
    <?php endfor; ?>
</ul>
<?php else: ?>
<div class="event-gallery-empty">
    <iconify-icon icon="ph:calendar-blank-light" width="56" height="56"></iconify-icon>
    <p>등록된 이벤트가 없습니다.</p>
</div>
<?php endif; ?>
