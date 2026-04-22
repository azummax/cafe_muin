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
			<?php
			$mb_lv = (int)$member['mb_level'];
			if ($mb_lv >= 6)     $grade_name = 'VIP';
			elseif ($mb_lv == 5) $grade_name = '골드';
			elseif ($mb_lv == 4) $grade_name = '실버';
			else                 $grade_name = '신규';
			?>
			<div class="profile-info">
				<span class="user-grade"><?php echo $grade_name; ?></span>
				<strong class="user-name"><b><?php echo $member['mb_name'];?></b>님</strong>
				<span class="user-id">(@<?php echo $member['mb_id'];?>)</span>
			</div>
			<div class="profile-actions">
				<a href="<?php echo G5_BBS_URL; ?>/qalist.php" class="profile-btn btn-inquiry">1:1 문의</a>
				<a href="<?php echo $at_href['logout']; ?>" class="profile-btn btn-logout">로그아웃</a>
			</div>
		</div>
		
		<!-- 회원등급 혜택 카드 -->
		<div class="dash-card grade-benefit-card">
			<?php
			$mb_lv = (int)$member['mb_level'];
			if ($mb_lv == 2) {
			?>
			<div class="grade-badge badge-new">신규 회원 안내</div>
			<div class="grade-benefit-title">승인 대기 중</div>
			<div class="grade-benefit-desc">관리자 승인 후<br>제품 구매가 가능합니다.</div>
			<div class="grade-benefit-next">승인 완료 후 실버 등급으로 시작됩니다.</div>
			<?php } elseif ($mb_lv == 4) { ?>
			<div class="grade-badge badge-silver">실버 등급 혜택</div>
			<div class="grade-discount">
				<span class="grade-rate">3%</span>
				<span class="grade-rate-label">할인 쿠폰 매달 자동 지급</span>
			</div>
			<div class="grade-condition">월 구매액 100만원 미만</div>
			<div class="grade-next-wrap">
				<div class="grade-benefit-next">→ 골드 달성 시 <b>8%</b> 할인</div>
				<div class="grade-next-cond">월 구매액 100만원 이상이 되면 골드 등급으로 승급됩니다.</div>
			</div>
			<?php } elseif ($mb_lv == 5) { ?>
			<div class="grade-badge badge-gold">골드 등급 혜택</div>
			<div class="grade-discount">
				<span class="grade-rate">8%</span>
				<span class="grade-rate-label">할인 쿠폰 매달 자동 지급</span>
			</div>
			<div class="grade-condition">월 구매액 100만원~200만원</div>
			<div class="grade-next-wrap">
				<div class="grade-benefit-next">→ VIP 달성 시 <b>15%</b> 할인</div>
				<div class="grade-next-cond">월 구매액 200만원 이상이 되면 VIP 등급으로 승급됩니다.</div>
			</div>
			<?php } elseif ($mb_lv == 6) { ?>
			<div class="grade-badge badge-vip">VIP 등급 혜택</div>
			<div class="grade-discount">
				<span class="grade-rate">15%</span>
				<span class="grade-rate-label">할인 쿠폰 매달 자동 지급</span>
			</div>
			<div class="grade-condition">월 구매액 200만원 이상</div>
			<div class="grade-benefit-next">✓ 최상위 VIP 등급입니다</div>
			<?php } elseif ($mb_lv > 6) { ?>
			<div class="grade-badge badge-admin">관리자</div>
			<div class="grade-benefit-title">관리자 계정</div>
			<div class="grade-benefit-desc">전체 서비스에 대한<br>접근 권한이 있습니다.</div>
			<?php } else { ?>
			<div class="grade-badge badge-new">일반</div>
			<div class="grade-benefit-title">기본 회원</div>
			<div class="grade-benefit-desc">관리자 승인 후 이용 가능합니다.</div>
			<?php } ?>
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