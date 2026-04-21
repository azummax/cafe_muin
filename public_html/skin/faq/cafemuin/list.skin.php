<?php
if (!defined('_GNUBOARD_')) exit;

add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css">', 0);
?>

<?php if (count($faq_master_list) > 1): ?>
<div class="cm-faq-category">
    <ul class="cm-faq-cat-ul">
        <?php foreach ($faq_master_list as $v):
            $active = ($v['fm_id'] == $fm_id) ? ' on' : '';
        ?>
        <li class="cm-faq-cat-li<?php echo $active; ?>">
            <a href="<?php echo $category_href; ?>?fm_id=<?php echo $v['fm_id']; ?>" class="cm-faq-cat-a">
                <?php echo $v['fm_subject']; ?>
            </a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<?php endif; ?>

<section class="cm-faq-section">
    <?php
    // 어드민 토큰을 루프 전에 한 번만 생성 (루프 안에서 생성 시 매번 덮어써져 마지막 것만 유효해지는 문제 방지)
    $admin_delete_token = '';
    if ($is_admin) {
        if (function_exists('get_admin_token')) {
            $admin_delete_token = get_admin_token();
        } else {
            $admin_delete_token = md5(uniqid(mt_rand(), true));
            set_session('ss_admin_token', $admin_delete_token);
        }
    }
    ?>
    <?php if (count($faq_list)): ?>
    <ul class="cm-faq-list" id="cm_faq_accordion">
        <?php $idx = 0; foreach ($faq_list as $v):
            if (empty($v)) continue;
            $idx++;
        ?>
        <li class="cm-faq-item" id="cm_faq_item_<?php echo $idx; ?>">
            <button class="cm-faq-q" onclick="cmFaqToggle(<?php echo $idx; ?>)" aria-expanded="false">
                <span class="cm-faq-q-label">Q</span>
                <span class="cm-faq-q-text"><?php echo apms_get_text($v['fa_subject']); ?></span>
                <iconify-icon icon="ph:caret-down-light" class="cm-faq-arrow" width="20" height="20"></iconify-icon>
            </button>
            <div class="cm-faq-a" id="cm_faq_a_<?php echo $idx; ?>">
                <div class="cm-faq-a-inner">
                    <span class="cm-faq-a-label">A</span>
                    <div class="cm-faq-a-content">
                        <?php echo apms_content(conv_content($v['fa_content'], 1)); ?>
                        <?php if ($is_admin) { ?>
                        <div style="text-align: right; margin-top: 15px; padding-top: 15px; border-top: 1px dashed #eee;">
                            <a href="<?php echo G5_ADMIN_URL; ?>/faqform.php?w=u&amp;fm_id=<?php echo $fm_id; ?>&amp;fa_id=<?php echo $v['fa_id']; ?>" class="board_btn" style="border-radius:3px; padding:2px 10px; border:1px solid #333; color:#333; text-decoration:none; display:inline-block;"><i class="fa fa-pencil"></i> 수정</a>
                            <a href="<?php echo G5_ADMIN_URL; ?>/faqformupdate.php?w=d&amp;fm_id=<?php echo $fm_id; ?>&amp;fa_id=<?php echo $v['fa_id']; ?>&amp;token=<?php echo $admin_delete_token; ?>" onclick="return confirm('정말 삭제하시겠습니까?');" class="board_btn" style="border-radius:3px; padding:2px 10px; margin-left:5px; border:1px solid #333; color:#333; text-decoration:none; display:inline-block;"><i class="fa fa-times"></i> 삭제</a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php else: ?>
    <div class="cm-faq-empty">
        <iconify-icon icon="ph:question-light" width="56" height="56"></iconify-icon>
        <p>등록된 FAQ가 없습니다.</p>
        <?php if ($is_admin): ?>
        <a href="<?php echo G5_ADMIN_URL; ?>/faqmasterlist.php" class="cm-faq-admin-btn">FAQ 관리 바로가기</a>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</section>

<?php if ($is_admin) { ?>
<div style="text-align: right; margin-top: 30px;">
    <a href="<?php echo G5_ADMIN_URL; ?>/faqform.php?fm_id=<?php echo $fm_id; ?>" style="display:inline-block; padding:0 35px; height:44px; line-height:44px; border:1px solid #333; background:#333; color:#fff; font-size:16px; border-radius:5px; text-decoration:none;">글쓰기</a>
</div>
<?php } ?>

<script>
function cmFaqToggle(idx) {
    var $item = $('#cm_faq_item_' + idx);
    var $answer = $('#cm_faq_a_' + idx);
    var $btn = $item.find('.cm-faq-q');
    var isOpen = $item.hasClass('open');

    // 모두 닫기
    $('.cm-faq-item.open').not($item).removeClass('open')
        .find('.cm-faq-q').attr('aria-expanded', 'false').end()
        .find('.cm-faq-a').slideUp(300);

    if (!isOpen) {
        $item.addClass('open');
        $btn.attr('aria-expanded', 'true');
        $answer.slideDown(300);
    } else {
        $item.removeClass('open');
        $btn.attr('aria-expanded', 'false');
        $answer.slideUp(300);
    }
}
</script>
