<?
// 쿠폰 갯수
$cp_count = 0;
$sql = " select cp_id
            from {$g5['g5_shop_coupon_table']}
            where mb_id IN ( '{$member['mb_id']}', '전체회원' )
              and cp_start <= '".G5_TIME_YMD."'
              and cp_end >= '".G5_TIME_YMD."' ";
$res = sql_query($sql);

for($k=0; $coupon=sql_fetch_array($res); $k++) {
    if(!is_used_coupon($member['mb_id'], $coupon['cp_id']))
        $cp_count++;
}

//주문건수
$sql = " select count(*) as orderCnt
		   from {$g5['g5_shop_order_table']}
		  where mb_id = '{$member['mb_id']}'
			 and od_status in ('주문','준비','배송')
		  ";
$odRes = sql_fetch($sql);
$order_count = $odRes['orderCnt'];


?>

<ul class="mypage_top mgB70 print-hide">
	<li class="mb_box">
		<div>
			<b class="grade">
				<?php echo $member['grade'];?>
			</b>
			<div>
				<strong>
					<b><?php echo $member['mb_name'];?></b>님 반갑습니다.
				</strong>
				<span><?php echo $member['mb_id'];?></span>
			</div>
		</div>
	</li>
	<li>
		<div>
			<b>주문/배송</b>
			<span>
				<strong><?php echo $order_count; ?></strong> 건
			</span>
		</div>
	</li>
	<?php if(IS_YC) { ?>
	<li>
		<div>
			<b>쿠폰</b>
			<span>
				<strong><?php echo number_format($cp_count); ?></strong> 장
			</span>
		</div>
	</li>
	<?php } ?>
	<li>
		<div>
			<b>적립금</b>
			<span>
				<strong><?php echo number_format($member['mb_point']); ?></strong> p
			</span>
		</div>
	</li>
</ul><!--mypage_top end-->