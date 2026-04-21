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
<?php
// 미수금(미결제액) 총계
$sql_misu = " select sum(od_misu) as total_misu
		from {$g5['g5_shop_order_table']}
		where mb_id = '{$member['mb_id']}' and od_status NOT IN ('취소', '반품', '품절') ";
$misuRes = sql_fetch($sql_misu);
$total_misu = (int)$misuRes['total_misu'];
?>

<div class="b2b-dashboard print-hide">
	<div class="dashboard-header">
		<h2>나의 비즈니스 현황</h2>
	</div>
	<div class="dashboard-grid">
		<!-- 회원 프로필 카드 -->
		<div class="dash-card profile-card">
			<div class="profile-info">
				<span class="user-grade"><?php echo $member['grade'];?></span>
				<strong class="user-name"><b><?php echo $member['mb_name'];?></b>님</strong>
				<span class="user-id">(@<?php echo $member['mb_id'];?>)</span>
			</div>
			<?php if($member['mb_level'] >= 2) { ?>
			<div class="benefit-box">
				<i class="fa fa-gift"></i>
				<div>
					<span>도매회원 전용 혜택</span>
					<strong>전 상품 기본 할인 적용중</strong>
				</div>
			</div>
			<?php } ?>
		</div>
		
		<!-- 미수금/결제 카드 -->
		<div class="dash-card misu-card">
			<div class="card-title">결제 대기 (미수금) <a href="/shop/orderinquiry.php" class="view-more"><i class="fa fa-angle-right"></i></a></div>
			<div class="card-value">
				<strong class="<?php echo $total_misu > 0 ? 'text-danger' : ''; ?>"><?php echo number_format($total_misu); ?></strong><span>원</span>
			</div>
		</div>

		<!-- 미니 스탯 지표 -->
		<div class="dash-card stat-group">
			<div class="stat-item">
				<a href="/shop/orderinquiry.php">
					<i class="fa fa-truck bg-orange"></i>
					<div class="stat-info">
						<span>진행중인 주문</span>
						<strong><?php echo number_format($order_count); ?></strong>
					</div>
				</a>
			</div>
			<div class="stat-item">
				<a href="/bbs/point.php">
					<i class="fa fa-database bg-dark"></i>
					<div class="stat-info">
						<span>보유 적립금</span>
						<strong><?php echo number_format($member['mb_point']); ?></strong>
					</div>
				</a>
			</div>
			<div class="stat-item">
				<a href="/shop/coupon.php">
					<i class="fa fa-ticket bg-gray"></i>
					<div class="stat-info">
						<span>사용 가능 쿠폰</span>
						<strong><?php echo number_format($cp_count); ?></strong>
					</div>
				</a>
			</div>
		</div>
	</div>
</div><!-- b2b-dashboard end -->