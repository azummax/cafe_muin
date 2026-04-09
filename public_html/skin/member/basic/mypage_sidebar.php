<?
$reqFile = basename($_SERVER['REQUEST_URI'], '?' . $_SERVER['QUERY_STRING']);
?>


<nav class="mypage_sidebar print-hide">
	<ul class="my_menu">
		<li class="dep1_li">
			<a href="<?php echo G5_SHOP_URL;?>/orderinquiry.php" class="dep1_a">주문관리</a>
			<ul class="dep2_ul">
				<li class="dep2_li">
					<a href="<?php echo G5_SHOP_URL;?>/orderinquiry.php" class="dep2_a <?php if($reqFile == "orderinquiry.php" || $reqFile == "orderinquiryview.php") echo "on"; ?>">주문내역</a>
				</li>
				<li class="dep2_li">
					<a href="<?php echo G5_BBS_URL;?>/qawrite.php?sca=주문취소" class="dep2_a">주문취소신청</a>
				</li>
				<li class="dep2_li">
					<a href="<?php echo G5_SHOP_URL;?>/cart.php" class="dep2_a">장바구니</a>
				</li>
				<li class="dep2_li">
					<a href="<?php echo G5_BBS_URL;?>/point.php" class="dep2_a <?php if($reqFile == "point.php") echo "on"; ?>">적립금내역</a>
				</li>
				<li class="dep2_li">
					<a href="<?php echo G5_SHOP_URL;?>/coupon.php" class="dep2_a <?php if($reqFile == "coupon.php") echo "on"; ?>">쿠폰</a>
				</li>
			</ul>
		</li>
		<li class="dep1_li">
			<a href="<?php echo G5_BBS_URL;?>/qalist.php" class="dep1_a">활동관리</a>
			<ul class="dep2_ul">
				<li class="dep2_li">
					<a href="<?php echo G5_BBS_URL;?>/qalist.php" class="dep2_a <?php if($reqFile == "qalist.php") echo "on"; ?>">1:1 문의</a>
				</li>
				<li class="dep2_li">
					<a href="<?php echo G5_SHOP_URL;?>/wishlist.php" class="dep2_a <?php if($reqFile == "wishlist.php") echo "on"; ?>">찜한상품</a>
				</li>
				<!--
				<li class="dep2_li">
					<a href="<?php echo G5_BBS_URL;?>/page.php?hid=my_review" class="dep2_a <?php if($hid == "my_review") echo "on"; ?>">상품후기</a>
				</li>
				-->
			</ul>
		</li>
		<li class="dep1_li">
			<a href="<?php echo $at_href['edit'];?>" class="dep1_a">회원정보관리</a>
			<ul class="dep2_ul">
				<li class="dep2_li">
					<a href="<?php echo $at_href['edit'];?>" class="dep2_a">회원정보수정</a>
				</li>
				<li class="dep2_li">
					<a href="<?php echo $at_href['leave'];?>" class="dep2_a">회원탈퇴</a>
				</li>
				<li class="dep2_li">
					<a href="<?php echo $at_href['logout'];?>" class="dep2_a">로그아웃</a>
				</li>
			</ul>
		</li>
	</ul>
</nav>