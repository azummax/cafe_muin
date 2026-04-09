<?php
$sub_menu = '102850';
include_once('./_common.php');

auth_check($auth[$sub_menu], "w");

check_admin_token();

$_POST = array_map('trim', $_POST);

$at_type1 = $_POST['at_type1']; // 회원가입
$at_type2 = $_POST['at_type2']; // 제품주문
$at_type3 = $_POST['at_type3']; // 입금확인
$at_type4 = $_POST['at_type4']; // 배송안내
$at_type5 = $_POST['at_type5']; // 입금요청
$at_type6 = $_POST['at_type6']; // 주문알림
$at_type7 = $_POST['at_type7']; // 게시글알림(관리자)
$at_type8 = $_POST['at_type8']; // 게시글알림(작성자)
$at_type9 = $_POST['at_type9']; // 주문취소
$at_type10 = $_POST['at_type10']; // 계산서발행(업체)
$at_type11 = $_POST['at_type11']; // 계산서발행(관리자)
$at_type13 = $_POST['at_type13']; // 상품사용후기등록알림
$at_type14 = $_POST['at_type14']; // 상품문의문자
$at_type15 = $_POST['at_type15']; // 포인트결제

$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '회원가입'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type1}' where at_type = '회원가입' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '회원가입', at_id = '{$at_type1}' ";
    sql_query($sql);
}

$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '제품주문'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type2}' where at_type = '제품주문' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '제품주문', at_id = '{$at_type2}' ";
    sql_query($sql);
}

$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '입금요청'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type5}' where at_type = '입금요청' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '입금요청', at_id = '{$at_type5}' ";
    sql_query($sql);
}

$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '입금확인'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type3}' where at_type = '입금확인' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '입금확인', at_id = '{$at_type3}' ";
    sql_query($sql);
}

$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '배송안내'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type4}' where at_type = '배송안내' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '배송안내', at_id = '{$at_type4}' ";
    sql_query($sql);
}

$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '주문알림'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type6}' where at_type = '주문알림' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '주문알림', at_id = '{$at_type6}' ";
    sql_query($sql);
}

$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '게시글알림(관리자)'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type7}' where at_type = '게시글알림(관리자)' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '게시글알림(관리자)', at_id = '{$at_type7}' ";
    sql_query($sql);
}

$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '게시글알림(작성자)'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type8}' where at_type = '게시글알림(작성자)' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '게시글알림(작성자)', at_id = '{$at_type8}' ";
    sql_query($sql);
}

$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '주문취소'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type9}' where at_type = '주문취소' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '주문취소', at_id = '{$at_type9}' ";
    sql_query($sql);
}

$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '계산서발행알림(업체)'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type10}' where at_type = '계산서발행알림(업체)' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '계산서발행알림(업체)', at_id = '{$at_type10}' ";
    sql_query($sql);
}

$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '계산서발행알림(관리자)'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type11}' where at_type = '계산서발행알림(관리자)' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '계산서발행알림(관리자)', at_id = '{$at_type11}' ";
    sql_query($sql);
}



$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '상품사용후기등록알림'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type13}' where at_type = '상품사용후기등록알림' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '상품사용후기등록알림', at_id = '{$at_type13}' ";
    sql_query($sql);
}



$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '상품문의문자'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type14}' where at_type = '상품문의문자' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '상품문의문자', at_id = '{$at_type14}' ";
    sql_query($sql);
}



$sql = "select as_id from {$g5['bizm_alimtalk_tplsel_table']} where at_type = '포인트결제'";
$row = sql_fetch($sql);
if ($row['as_id']) {
    $sql = "update {$g5['bizm_alimtalk_tplsel_table']} set at_id = '{$at_type15}' where at_type = '포인트결제' ";
    sql_query($sql);
}
else {
    $sql = "insert into {$g5['bizm_alimtalk_tplsel_table']} set at_type = '포인트결제', at_id = '{$at_type15}' ";
    sql_query($sql);
}


goto_url('./tpl_msg_list.php');
?>