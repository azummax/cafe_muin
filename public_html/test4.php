<?php
include_once('./common.php');
if (!isset($g5['board_table'])) exit;
$sql = "SELECT TABLE_NAME FROM information_schema.tables WHERE TABLE_SCHEMA='cafemuin' AND TABLE_NAME LIKE 'g5_write_%'";
$res = sql_query($sql);
while($row = sql_fetch_array($res)) {
    $t = $row['TABLE_NAME'];
    $r2 = sql_fetch_array(sql_query("SELECT count(*) as c FROM $t"));
    echo $t . " => " . $r2['c'] . "\n";
}
echo "=== Notice board ===\n";
$r3 = sql_query("SELECT wr_id, wr_subject, wr_datetime FROM g5_write_notice ORDER BY wr_id DESC LIMIT 5");
while($row = sql_fetch_array($r3)) {
    print_r($row);
}
?>
