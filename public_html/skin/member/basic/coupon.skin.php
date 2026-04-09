<?php
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$skin_url.'/style.css" media="screen">', 0);
add_stylesheet('<link rel="stylesheet" href="/css/mypage_common.css" media="screen">', 0);

?>

<?php include($member_skin_path.'/mypage_top.php'); //마이페이지 상단 ?>
<div class="mypage_container">
	<?php include($member_skin_path.'/mypage_sidebar.php'); //마이페이지 메뉴 ?>
	<div class="mypage_content">
		<strong class="order_tit">쿠폰</strong>
		<div class="my_table_box">
			<table>
				<colgroup>
					<col width="" />
					<col width="15%" />
					<col width="10%" />
					<col width="10%" />
					<col width="20%" />
				</colgroup>
				<tbody>
					<tr>
						<th class="text-center" scope="col">쿠폰명</th>
						<th class="text-center" scope="col">적용대상</th>
						<th class="text-center" scope="col">구매금액</th>
						<th class="text-center" scope="col">할인금액</th>
						<th class="text-center" scope="col">사용기한</th>
					</tr>
					<?php 
						for($i=0; $i < count($cp); $i++) { 
							$cp_a = ($cp[$i]['cp_href']) ? '<a href="'.$cp[$i]['cp_href'].'" target="_blank">' : '<a>';	
					?>
					<tr>
						<td><?php echo $cp_a;?><?php echo $cp[$i]['cp_subject']; ?></a></td>
						<td class="text-center"><?php echo $cp_a;?><?php echo $cp[$i]['cp_target']; ?></a></td>
						<td class="text-center"><?php echo number_format($cp[$i]['cp_minimum']); ?>원</td>
						<td class="text-center"><?php echo $cp[$i]['cp_price']; ?></td>
						<td class="text-center"><?php echo substr($cp[$i]['cp_start'], 2, 8); ?> ~ <?php echo substr($cp[$i]['cp_end'], 2, 8); ?></td>
					</tr>
					<?php } ?>
					<?php if($i == 0) { ?>
					<tr><td colspan="5" class="text-center text-muted" height="150">사용할 수 있는 쿠폰이 없습니다.</td></tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>