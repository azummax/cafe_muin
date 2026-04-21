<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.G5_SHOP_SKIN_URL.'/style.css">', 0);
?>

<!-- 상품진열 10 시작 { -->
<?php
for ($i=1; $row=sql_fetch_array($result); $i++) {
    if ($this->list_mod >= 2) { // 1줄 이미지 : 2개 이상
        if ($i%$this->list_mod == 0) $sct_last = 'sct_last'; // 줄 마지막
        else if ($i%$this->list_mod == 1) $sct_last = 'sct_clear'; // 줄 첫번째
        else $sct_last = '';
    } else { // 1줄 이미지 : 1개
        $sct_last = 'sct_clear';
    }

    if ($i == 1) {
        if ($this->css) {
            echo "<ul class=\"{$this->css}\">\n";
        } else {
            echo "<ul class=\"sct sct_10\">\n";
        }
    }

    echo "<li class=\"sct_li {$sct_last}\">\n";

    global $is_member;
    $it_price = get_price($row);
    $price_html = "";
    if (!$is_member) {
        $price_html = '<span class="cm_new_price" style="font-size:18px; color:#999;">비공개</span>';
    } else {
        $it_cust_price = $row['it_cust_price'];
        if ($it_cust_price > 0 && $it_price > 0 && $it_cust_price > $it_price) {
            $price_html = '<del class="cm_new_cust_price" style="color:#999; font-size:18px; text-decoration:line-through; margin-right:6px;">'.number_format($it_cust_price).'원</del> <span class="cm_new_price" style="color:#ff6600; font-size:18px; font-weight:500;">'.number_format($it_price).'원</span>';
        } else {
            $price_html = '<span class="cm_new_price" style="color:#ff6600; font-size:18px; font-weight:500;">'.number_format($it_price).'원</span>';
        }
    }

    echo "<a href=\"{$this->href}{$row['it_id']}\" class=\"cm_new_card\">\n";
    echo "  <div class=\"cm_new_img_box\">\n";
    if ($this->view_it_img) {
        echo get_it_image($row['it_id'], $this->img_width, $this->img_height, '', '', stripslashes($row['it_name']))."\n";
    }
    echo "  </div>\n";
    
    echo "  <div class=\"cm_new_txt_box\">\n";
    if ($this->view_it_name) {
        echo "      <strong class=\"cm_new_title\">".stripslashes($row['it_name'])."</strong>\n";
    }
    if ($this->view_it_basic && $row['it_basic']) {
        echo "      <span class=\"cm_new_brand\">".stripslashes($row['it_basic'])."</span>\n";
    }
    if ($this->view_it_cust_price || $this->view_it_price) {
        echo "      <div class=\"cm_new_price_wrap\">{$price_html}</div>\n";
    }
    echo "  </div>\n";
    echo "</a>\n";


    
    echo "</li>\n";
}

if ($i > 1) echo "</ul>\n";

if($i == 1) echo "<p class=\"sct_noitem\">등록된 상품이 없습니다.</p>\n";
?>
<!-- } 상품진열 10 끝 -->