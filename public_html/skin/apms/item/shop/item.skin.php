<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 관련상품 전체 추출을 위해서 재세팅함
$rmods = 100;
$rrows = 1;

// 버튼컬러
$btn1 = (isset($wset['btn1']) && $wset['btn1']) ? $wset['btn1'] : 'black';
$btn2 = (isset($wset['btn2']) && $wset['btn2']) ? $wset['btn2'] : 'color';

// add_stylesheet('css 구문', 출력순서); 숫자가 작을 수록 먼저 출력됨
add_stylesheet('<link rel="stylesheet" href="'.$item_skin_url.'/style.css" media="screen">', 0);

if($is_orderable) echo '<script src="'.$item_skin_url.'/shop.js"></script>'.PHP_EOL;

// 이미지처리
$j=0;
$thumbnails = array();
$item_image = '';
$item_image_href = '';
for($i=1; $i<=10; $i++) {
	if(!$it['it_img'.$i])
		continue;

	$thumb = get_it_thumbnail($it['it_img'.$i], 60, 60);

	if($thumb) {
		$org_url = G5_DATA_URL.'/item/'.$it['it_img'.$i];
		$img = apms_thumbnail($org_url, 600, 600, false, true);
		//$thumb_url = ($img['src']) ? $img['src'] : $org_url;
		$thumb_url = $org_url;
		if($j == 0) {
			$item_image = $thumb_url; // 큰이미지
			$item_image_href = G5_SHOP_URL.'/largeimage.php?it_id='.$it['it_id'].'&amp;ca_id='.$ca_id.'&amp;no='.$i; // 큰이미지 주소
		}
		//$thumbnails[$j] = '<a data-href="'.G5_SHOP_URL.'/largeimage.php?it_id='.$it['it_id'].'&amp;ca_id='.$ca_id.'&amp;no='.$i.'" data-ref="'.$thumb_url.'" class="thumb_item_image">'.$thumb.'<span class="sound_only"> '.$i.'번째 이미지 새창</span></a>';
		$thumbnails[$j] = "<img src='".$org_url."' alt='상품 이미지' />";
		$j++;
	}
}

// 카운팅
$it_comment_cnt = ($it['pt_comment'] > 0) ? '('.number_format($it['pt_comment']).')' : '';
$it_use_cnt = ($item_use_count > 0) ? '('.number_format($item_use_count).')' : '';
$it_qa_cnt = ($item_qa_count > 0) ? '('.number_format($item_qa_count).')' : '';

// 판매자
$is_seller = ($it['pt_id'] && $it['pt_id'] != $config['cf_admin']) ? true : false;

?>

<style>
	.div-separator, .div-sep-line{display:none;}
</style>

<div class="shop_top_box mgB90">
	<ul class="sub_path">
		<li><a href="/"><img src="/thema/Basic/img/sub_path_home.png" alt="메인으로 이동" /></a></li>
		<li>전체제품</li>
		<?php
			echo ($page_nav1) ? '<li>'.$page_nav1.'</li>' : '';
			echo ($page_nav2) ? '<li>'.$page_nav2.'</li>' : '';
			echo ($page_nav3) ? '<li>'.$page_nav3.'</li>' : '';
		?>
	</ul>
</div>

<?php echo $it_head_html; // 상단 HTML; ?>

<div class="product_view_con">

	<div class="product_view_top clear mgB80">
		<div class="img_box">
			<div id="big_img"><img id="item_image" src="<?php echo $item_image;?>" alt="상품 이미지"></div>
			<ul class="small_img">
				<?php 
					for($i=0; $i < count($thumbnails); $i++) { 
						if( $i == 0){
							echo "<li class='on'>".$thumbnails[$i]."</li>"; 
						}else{
							echo "<li>".$thumbnails[$i]."</li>"; 
						}
					} 
				?>
			</ul>
		</div>
		<div class="txt_box">
			<div class="product_sns_share">
				<button class="share_btn"><img src="/thema/Basic/img/product_share_btn.png" alt="SNS 공유" /></button>
				<div class="share_box">
					<?php include_once(G5_SNS_PATH."/item.sns.skin.php"); ?>
				</div>
			</div>
			<script>
				$('.product_sns_share .share_btn').click(function(){
					$(this).toggleClass('on');
					$(this).siblings('div').fadeToggle(300);
				});
			</script>

			<form name="fitem" method="post" action="<?php echo $action_url; ?>" class="form item-form" role="form" onsubmit="return fitem_submit(this);">
				<input type="hidden" name="it_id[]" value="<?php echo $it_id; ?>">
				<input type="hidden" name="it_msg1[]" value="<?php echo $it['pt_msg1']; ?>">
				<input type="hidden" name="it_msg2[]" value="<?php echo $it['pt_msg2']; ?>">
				<input type="hidden" name="it_msg3[]" value="<?php echo $it['pt_msg3']; ?>">
				<input type="hidden" name="sw_direct">
				<input type="hidden" name="url">

				<div class="info_basic">
					<?php if ($it['it_maker']) { ?>
						<b class="maker"><?php echo $it['it_maker']; ?></b>
					<?php } ?>
					<h2 class="title"><?php echo stripslashes($it['it_name']); // 상품명 ?></h2>
					<p class="desc">
						<?php echo ($it['it_basic']) ? $it['it_basic'] : apms_cut_text($it['it_explan'], 120); ?>
					</p>
					<div class="price">
						<?php if (!$it['it_use']) { // 판매가능이 아닐 경우 ?>
							<strong>판매중지</strong>
						<?php } else if ($it['it_tel_inq']) { // 전화문의일 경우 ?>
							<strong>전화문의</strong>
						<?php } else { // 전화문의가 아닐 경우?>
							<?php if($it['it_price'] && $it['it_cust_price']) { //할인율
								$sale_per = round((($it['it_cust_price'] - $it['it_price']) / $it['it_cust_price']) * 100);
							?>
								<span class="item_dc"><?php echo $sale_per;?>%</span>
							<?php } ?>
							<b>
								<?php echo display_price(get_price($it)); //판매가격 ?>
								<input type="hidden" id="it_price" value="<?php echo get_price($it); ?>">
							</b>
							<?php if ($it['it_cust_price']) { ?>
								<strike><?php echo display_price($it['it_cust_price']); //시중가격 ?></strike>
							<?php } ?>
						<?php } ?>
					</div>
				</div>

				<ul class="info_detail">
					<?php if ($it['it_maker']) { ?>
						<li><b>판매업체</b><?php echo $it['it_maker']; ?></li>
					<?php } ?>
					<li><b>판매가</b><?php echo($it['it_cust_price']) ? display_price($it['it_cust_price']) : display_price(get_price($it)); ?></li>
					<li><b>배송방법</b>택배</li>
					<?php
						$ct_send_cost_label = '배송비';

						if($it['it_sc_type'] == 1)
							$sc_method = '무료배송';
						else {
							if($it['it_sc_method'] == 1)
								$sc_method = '수령후 지불';
							else if($it['it_sc_method'] == 2) {
								$ct_send_cost_label = '<label for="ct_send_cost">배송비결제</label>';
								$sc_method = '<select name="ct_send_cost" id="ct_send_cost" class="form-control input-sm">
												  <option value="0">주문시 결제</option>
												  <option value="1">수령후 지불</option>
											  </select>';
							}
							else
								$sc_method = '주문시 결제';
						}
					?>
					<li><b><?php echo $ct_send_cost_label; ?></b><?php echo $sc_method; ?></li>
					<?php if ($it['it_origin']) { ?>
						<li><b>제조국</b><?php echo $it['it_origin']; ?></li>
					<?php } ?>
					<?php if ($it['it_brand']) { ?>
						<li><b>브랜드</b><?php echo $it['it_brand']; ?></li>
					<?php } ?>
					<?php if ($it['it_model']) { ?>
						<li><b>모델</b><?php echo $it['it_model']; ?></li>
					<?php } ?>
					<!-- <?php if ($config['cf_use_point']) { // 포인트 사용한다면 ?>
						<li>
							<b>포인트</b>
							<?php
								if($it['it_point_type'] == 2) {
									echo '구매금액(추가옵션 제외)의 '.$it['it_point'].'%';
								} else {
									$it_point = get_item_point($it);
									echo number_format($it_point).'점';
								}
							?>
						</li>
					<?php } ?> -->
					<?php if($it['it_buy_min_qty']) { ?>
						<li><b>최소구매수량</b><?php echo number_format($it['it_buy_min_qty']); ?> 개</li>
					<?php } ?>
					<?php if($it['it_buy_max_qty']) { ?>
						<li><b>최대구매수량</b><?php echo number_format($it['it_buy_max_qty']); ?> 개</li>
					<?php } ?>
				</ul>

				<div id="item_option">
					<?php if($supply_item || $option_item) { ?>
					<div class="option_box">
						<strong>옵션</strong>
						<table class="div-table table">
						<col width="100">
						<tbody>
						<?php if($option_item) { echo $option_item; } // 선택옵션 ?>
						<?php echo $supply_item; // 추가옵션 ?>
						</tbody>
						</table>
					</div>
					<?php }	?>

					<?php if ($is_orderable) { ?>
					<div id="it_sel_option">
						<?php
						if(!$option_item) {
							if(!$it['it_buy_min_qty'])
								$it['it_buy_min_qty'] = 1;
						?>
							<ul id="it_opt_added" class="list-group">
								<li class="it_opt_list list-group-item">
									<input type="hidden" name="io_type[<?php echo $it_id; ?>][]" value="0">
									<input type="hidden" name="io_id[<?php echo $it_id; ?>][]" value="">
									<input type="hidden" name="io_value[<?php echo $it_id; ?>][]" value="<?php echo $it['it_name']; ?>">
									<input type="hidden" class="io_price" value="0">
									<input type="hidden" class="io_stock" value="<?php echo $it['it_stock_qty']; ?>">
									<div class="row">
										<div class="col-sm-7">
											<label>
												<span class="it_opt_subj"><?php echo $it['it_name']; ?></span>
												<span class="it_opt_prc"><span class="sound_only">(+0원)</span></span>
											</label>
										</div>
										<div class="col-sm-5">
											<div class="input-group" style="display:flex; justify-content:flex-end; align-items:center;">
												<button type="button" class="it_qty_minus btn btn-lightgray btn-sm" style="height:35px; border-radius:0;"><iconify-icon icon="ph:minus-light" width="18" height="18"></iconify-icon><span class="sound_only">감소</span></button>
												<label for="ct_qty_<?php echo $i; ?>" class="sound_only">수량</label>
												<input type="text" name="ct_qty[<?php echo $it_id; ?>][]" value="<?php echo $it['it_buy_min_qty']; ?>" id="ct_qty_<?php echo $i; ?>" class="form-control input-sm" size="5" style="width:45px; height:35px; text-align:center; box-shadow:none; border-radius:0;">
												<button type="button" class="it_qty_plus btn btn-lightgray btn-sm" style="height:35px; border-radius:0;"><iconify-icon icon="ph:plus-light" width="18" height="18"></iconify-icon><span class="sound_only">증가</span></button>
											</div>
										</div>
									</div>
									<?php if($it['pt_msg1']) { ?>
										<div style="margin-top:10px;">
											<input type="text" name="pt_msg1[<?php echo $it_id; ?>][]" class="form-control input-sm" placeholder="<?php echo $it['pt_msg1'];?>">
										</div>
									<?php } ?>
									<?php if($it['pt_msg2']) { ?>
										<div style="margin-top:10px;">
											<input type="text" name="pt_msg2[<?php echo $it_id; ?>][]" class="form-control input-sm" placeholder="<?php echo $it['pt_msg2'];?>">
										</div>
									<?php } ?>
									<?php if($it['pt_msg3']) { ?>
										<div style="margin-top:10px;">
											<input type="text" name="pt_msg3[<?php echo $it_id; ?>][]" class="form-control input-sm" placeholder="<?php echo $it['pt_msg3'];?>">
										</div>
									<?php } ?>
								</li>
							</ul>
							<script>
							$(function() {
								price_calculate();
							});
							</script>
						<?php } ?>
					</div>
					<div class="price_box">
						<b>Total</b>
						<strong id="it_tot_price">0</strong>
					</div>
					<?php } ?>
				</div>

				<?php if($is_soldout) { ?>
					<!-- 텍스트 제거 요청으로 주석처리 (2024-06-07) -->
					<!-- <strong class="soldout_txt">재고가 부족하여 구매할 수 없습니다.</strong> -->
				<?php } ?>

				<?php if ($is_orderable) { ?>
					<div class="product_btn_box" style="display:flex; gap:10px; margin-top:20px;">
						<?php
							// 상품정보 체크
							$wish_sql = " select wi_id from {$g5['g5_shop_wish_table']} where mb_id = '{$member['mb_id']}' and it_id = '{$it['it_id']}' ";
							$wish_row = sql_fetch($wish_sql);
							if(!$wish_row['wi_id']){
						?>
						<button type="button" id="wish_item<?php echo $it['it_id']; ?>" class="wish_btn" onclick="apms_wishlist('<?php echo $it['it_id']; ?>'); return false;" style="width:56px; height:56px; border:1px solid #ddd; background:#fff; border-radius:4px; display:flex; justify-content:center; align-items:center;">
							<iconify-icon icon="ph:heart-light" width="24" height="24" style="color:#666;"></iconify-icon><span class="sound_only">위시리스트</span>
						</button>
						<?php }else{ ?>
						<button type="button" id="wish_item<?php echo $it['it_id']; ?>" class="wish_btn on" onclick="apms_wishlist('<?php echo $it['it_id']; ?>'); return false;" style="width:56px; height:56px; border:1px solid #ddd; background:#fff; border-radius:4px; display:flex; justify-content:center; align-items:center;">
							<iconify-icon icon="ph:heart-fill" width="24" height="24" style="color:#ff4d4f;"></iconify-icon><span class="sound_only">위시리스트</span>
						</button>
						<?php } ?>
						<button type="submit" onclick="document.pressed='장바구니';" style="flex:1; height:56px; line-height:56px; background:#333; color:#fff; border:none; border-radius:4px; font-size:16px; font-weight:500;">장바구니</button>
						<button type="submit" onclick="document.pressed='구매하기';" style="flex:1; height:56px; line-height:56px; background:var(--cm-primary); color:#fff; border:none; border-radius:4px; font-size:16px; font-weight:500;">구매하기</button>
					</div>
					<?php if ($naverpay_button_js) { ?>
						<div class="pay_naver"><?php echo $naverpay_request_js.$naverpay_button_js; ?></div>
					<?php } ?>
				<?php } ?>

			</form>
		</div>
	</div><!--product_view_top end-->
	<script>
		var imgBig = document.getElementById('big_img');
		imgBig = imgBig.childNodes[0];
		var allSmall = document.querySelectorAll('.small_img li img');
		var allSmallL = allSmall.length;
		var imgSmallPerent; 

		function alphaImg(){
			imgSmall = this.getAttribute('src');
			imgSmallPerent = this.parentNode;
			for(var i = 0; i < allSmallL; i++){
				allSmall[i].parentNode.classList.remove('on');;
			}
			imgSmallPerent.className = 'on';
			imgBig.setAttribute('src', imgSmall);
		}

		for(var i = 0; i < allSmallL; i++){
			allSmall[i].addEventListener('click', alphaImg, false);
		}
	</script>

	<script>
		// BS3
		$(function() {
			$("select.it_option").addClass("form-control input-sm");
			$("select.it_supply").addClass("form-control input-sm");
		});

		// 재입고SMS 알림
		function popup_stocksms(it_id, ca_id) {
			url = "./itemstocksms.php?it_id=" + it_id + "&ca_id=" + ca_id;
			opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
			popup_window(url, "itemstocksms", opt);
		}

		// 바로구매, 장바구니 폼 전송
		function fitem_submit(f) {

			f.action = "<?php echo $action_url; ?>";
			f.target = "";

			if (document.pressed == "장바구니") {
				f.sw_direct.value = 0;
			} else { // 바로구매
				f.sw_direct.value = 1;
			}

			// 판매가격이 0 보다 작다면
			if (document.getElementById("it_price").value < 0) {
				alert("전화로 문의해 주시면 감사하겠습니다.");
				return false;
			}

			if($(".it_opt_list").length < 1) {
				alert("선택옵션을 선택해 주십시오.");
				return false;
			}

			var val, io_type, result = true;
			var sum_qty = 0;
			var min_qty = parseInt(<?php echo $it['it_buy_min_qty']; ?>);
			var max_qty = parseInt(<?php echo $it['it_buy_max_qty']; ?>);
			var $el_type = $("input[name^=io_type]");

			$("input[name^=ct_qty]").each(function(index) {
				val = $(this).val();

				if(val.length < 1) {
					alert("수량을 입력해 주십시오.");
					result = false;
					return false;
				}

				if(val.replace(/[0-9]/g, "").length > 0) {
					alert("수량은 숫자로 입력해 주십시오.");
					result = false;
					return false;
				}

				if(parseInt(val.replace(/[^0-9]/g, "")) < 1) {
					alert("수량은 1이상 입력해 주십시오.");
					result = false;
					return false;
				}

				io_type = $el_type.eq(index).val();
				if(io_type == "0")
					sum_qty += parseInt(val);
			});

			if(!result) {
				return false;
			}

			if(min_qty > 0 && sum_qty < min_qty) {
				alert("선택옵션 개수 총합 "+number_format(String(min_qty))+"개 이상 주문해 주십시오.");
				return false;
			}

			if(max_qty > 0 && sum_qty > max_qty) {
				alert("선택옵션 개수 총합 "+number_format(String(max_qty))+"개 이하로 주문해 주십시오.");
				return false;
			}

			if (document.pressed == "장바구니") {
				$.post("./itemcart.php", $(f).serialize(), function(error) {
					if(error != "OK") {
						alert(error.replace(/\\n/g, "\n"));
						return false;
					} else {
						if(confirm("장바구니에 담겼습니다.\n\n바로 확인하시겠습니까?")) {
							document.location.href = "./cart.php";
						}
					}
				});
				return false;
			} else {
				return true;
			}
		}

		// Wishlist
		function apms_wishlist(it_id) {
			if(!it_id) {
				alert("코드가 올바르지 않습니다.");
				return false;
			}

			$.post("./itemwishlist.php", { it_id: it_id },	function(error) {
				if(error != "OK") {
					alert(error.replace(/\\n/g, "\n"));
					return false;
				} else {
					if(confirm("위시리스트에 담겼습니다.\n\n바로 확인하시겠습니까?")) {
						document.location.href = "./wishlist.php";
					}
				}
			});

			$('#wish_item' + it_id).addClass('on'); //위시리스트 구분

			return false;
		}

		// Recommend
		function apms_recommend(it_id, ca_id) {
			if (!g5_is_member) {
				alert("회원만 추천하실 수 있습니다.");
			} else {
				url = "./itemrecommend.php?it_id=" + it_id + "&ca_id=" + ca_id;
				opt = "scrollbars=yes,width=616,height=420,top=10,left=10";
				popup_window(url, "itemrecommend", opt);
			}
		}
	</script>

	<div class="product_view_btm">
		<?php if($is_viewer || $is_link) { 
			// 보기용 첨부파일 확장자에 따른 FA 아이콘 - array(이미지, 비디오, 오디오, PDF)
			$viewer_fa = array("picture-o", "video-camera", "music", "file-powerpoint-o");
		?>
			<?php echo apms_line('fa', 'fa-gift'); //라인 ?> 

			<div class="item-view-box">
				<?php if($is_link) { ?>
					<?php for($i=0; $i < count($link); $i++) { ?>
						<a href="<?php echo $link[$i]['url']; ?>" target="_blank" class="at-tip" title="<?php echo ($link[$i]['name']) ? $link[$i]['name'] : '관련링크'; ?>"><i class="fa fa-<?php echo ($link[$i]['fa']) ? $link[$i]['fa'] : 'link';?>"></i></a>
					<?php } ?>
				<?php } ?>

				<?php if($is_viewer) { ?>
					<?php for($i=0; $i < count($viewer); $i++) { $v = ($viewer[$i]['ext'] - 1); ?>
						<?php if($viewer[$i]['href_view']) { ?>
							<a href="<?php echo $viewer[$i]['href_view'];?>" class="view_win at-tip" title="<?php echo ($viewer[$i]['free']) ? '무료보기' : '바로보기';?>">
						<?php } else { ?>
							<a onclick="alert('구매한 회원만 볼 수 있습니다.');" class="at-tip" title="유료보기">
						<?php } ?>
							<i class="fa fa-<?php echo $viewer_fa[$v];?>"></i>
						</a>
					<?php } ?>
				<?php } ?>
				<script>
					var view_win = function(href) {
						var new_win = window.open(href, 'view_win', 'left=0,top=0,width=640,height=480,toolbar=0,location=0,scrollbars=0,resizable=1,status=0,menubar=0');
						new_win.focus();
					}
					$(function() {
						$(".view_win").click(function() {
							view_win(this.href);
							return false;
						});
					});
				</script>
			</div>
		<?php } ?>

		<?php // 비디오
			$item_video = apms_link_video($link_video);
			if($item_video) {
				echo apms_line('fa', 'fa-video-camera');
				echo $item_video;
			}
		?>

		<?php if($is_download) { // 다운로드 ?>
			<?php echo apms_line('fa', 'fa-download'); // 라인 ?> 
			<div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title"><i class="fa fa-download"></i> Download</h3>
				</div>
				<div class="list-group">
					<?php for($i=0; $i < count($download); $i++) { ?>
						<a class="list-group-item break-word" href="<?php echo ($download[$i]['href']) ? $download[$i]['href'] : 'javascript:alert(\'구매한 회원만 다운로드할 수 있습니다.\');';?>">
							<?php if($download[$i]['free']) { ?>
								<?php if($download[$i]['guest_use']) { ?>
									<span class="label label-default label-item pull-right"><span class="font-11 en">Free</span></span> 
								<?php } else { ?>
									<span class="label label-primary label-item pull-right"><span class="font-11 en">Join</span></span> 
								<?php } ?>
							<?php } else { ?>
								<span class="label label-danger label-item pull-right"><span class="font-11 en">Paid</span></span> 
							<?php } ?>
							<i class="fa fa-download"></i> <?php echo $download[$i]['source'];?> (<?php echo $download[$i]['size'];?>)
						</a>
					<?php } ?>
					<?php if($i && $is_remaintime) { //이용기간 안내
						$remain_day = (int)(($is_remaintime - G5_SERVER_TIME) / 86400); //남은일수
					?>
						<a class="list-group-item" href="#">
							<i class="fa fa-bell"></i> <?php echo date("Y.m.d H:i", $is_remaintime);?>(<?php echo number_format($remain_day);?>일 남음)까지 이용가능합니다.
						</a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>

		<?php if ($is_torrent) { // 토렌트 파일정보 ?>
			<?php echo apms_line('fa', 'fa-cube'); // 라인 ?> 
			<?php for($i=0; $i < count($torrent); $i++) { ?>
				<div class="panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title"><i class="fa fa-cube"></i> <?php echo $torrent[$i]['name'];?></h3>
					</div>
					<div class="panel-body">
						<span class="pull-right hidden-xs text-muted en font-11"><i class="fa fa-clock-o"></i> <?php echo date("Y-m-d H:i", $torrent[$i]['date']);?></span>
						<?php if ($torrent[$i]['is_size']) { ?>
								<b class="en font-16"><i class="fa fa-cube"></i> <?php echo $torrent[$i]['info']['name'];?> (<?php echo $torrent[$i]['info']['size'];?>)</b>
						<?php } else { ?>
							<p><b class="en font-16"><i class="fa fa-cubes"></i> Total <?php echo $torrent[$i]['info']['total_size'];?></b></p>
							<div class="text-muted font-12">
								<?php for ($j=0;$j < count($torrent[$i]['info']['file']);$j++) { 
									echo ($j + 1).'. '.implode(', ', $torrent[$i]['info']['file'][$j]['name']).' ('.$torrent[$i]['info']['file'][$j]['size'].')<br>'."\n";
								} ?>
							</div>
						<?php } ?>
					</div>
					<ul class="list-group">
						<li class="list-group-item en font-14 break-word"><i class="fa fa-magnet"></i> <?php echo $torrent[$i]['magnet'];?></li>
						<li class="list-group-item break-word">
							<div class="text-muted" style="font-size:12px;">
								<?php for ($j=0;$j < count($torrent[$i]['tracker']);$j++) { ?>
									<i class="fa fa-tags"></i> <?php echo $torrent[$i]['tracker'][$j];?><br>
								<?php } ?>
							</div>
						</li>
						<?php if($torrent[$i]['comment']) { ?>
							<li class="list-group-item en font-14 break-word"><i class="fa fa-bell"></i> <?php echo $torrent[$i]['comment'];?></li>
						<?php } ?>
					</ul>
				</div>
			<?php } ?>
		<?php } ?>

		<?php echo apms_line('fa'); // 라인 ?> 

		<?php if ($is_good) { // 추천 ?>
			<div class="item-good-box">
				<span class="item-good">
					<a href="#" onclick="apms_good('<?php echo $it_id;?>', '', 'good', 'it_good'); return false;">
						<b id="it_good"><?php echo number_format($it['pt_good']) ?></b>
						<br>
						<i class="fa fa-thumbs-up"></i>
					</a>
				</span>
				<span class="item-nogood">
					<a href="#" onclick="apms_good('<?php echo $it_id;?>', '', 'nogood', 'it_nogood'); return false;">
						<b id="it_nogood"><?php echo number_format($it['pt_nogood']) ?></b>
						<br>
						<i class="fa fa-thumbs-down"></i>
					</a>
				</span>
			</div>
		<?php } ?>

		<?php if ($is_ccl) { // CCL ?>
			<div class="h20"></div>
			<div class="well">
				<img src="<?php echo $ccl_img;?>" alt="CCL" />  &nbsp; 본 자료는 <u><?php echo $ccl_license;?></u>에 따라 이용할 수 있습니다.
			</div>
		<?php } ?>

		<?php if($is_seller && $wset['seller']) { // 판매자 ?>
			<div class="panel panel-default item-seller">
				<div class="panel-heading">
					<h3 class="panel-title">
						<?php if($author['partner']) { ?>
							<a href="<?php echo $at_href['myshop'];?>?id=<?php echo $author['mb_id'];?>" class="pull-right">
								<span class="label label-primary"><span class="font-11 en">My Shop</span></span>
							</a>
						<?php } ?>
						Seller
					</h3>
				</div>
				<div class="panel-body">
					<div class="pull-left text-center auth-photo">
						<div class="img-photo">
							<?php echo ($author['photo']) ? '<img src="'.$author['photo'].'" alt="">' : '<i class="fa fa-user"></i>'; ?>
						</div>
						<div class="btn-group" style="margin-top:-30px;white-space:nowrap;">
							<button type="button" class="btn btn-color btn-sm" onclick="apms_like('<?php echo $author['mb_id'];?>', 'like', 'it_like'); return false;" title="Like">
								<i class="fa fa-thumbs-up"></i> <span id="it_like"><?php echo number_format($author['liked']) ?></span>
							</button>
							<button type="button" class="btn btn-color btn-sm" onclick="apms_like('<?php echo $author['mb_id'];?>', 'follow', 'it_follow'); return false;" title="Follow">
								<i class="fa fa-users"></i> <span id="it_follow"><?php echo $author['followed']; ?></span>
							</button>
						</div>
					</div>
					<div class="auth-info">
						<div style="margin-bottom:4px;">
							<span class="pull-right">Lv.<?php echo $author['level'];?></span>
							<b><?php echo $author['name']; ?></b> &nbsp;<span class="text-muted font-11"><?php echo $author['grade'];?></span>
						</div>
						<div class="div-progress progress progress-striped no-margin">
							<div class="progress-bar progress-bar-exp" role="progressbar" aria-valuenow="<?php echo round($author['exp_per']);?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo round($author['exp_per']);?>%;">
								<span class="sr-only"><?php echo number_format($author['exp']);?> (<?php echo $author['exp_per'];?>%)</span>
							</div>
						</div>
						<p style="margin-top:10px;">
							<?php echo ($author['signature']) ? $author['signature'] : '등록된 서명이 없습니다.'; ?>
						</p>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		<?php } ?>

		<?php if ($is_relation) { ?>
			<div class="div-title-wrap">
				<div class="div-title" style="line-height:30px;">
					<i class="fa fa-cubes fa-lg lightgray"></i> <b>관련아이템</b>
				</div>
				<div class="div-sep-wrap">
					<div class="div-sep sep-bold"></div>
				</div>
			</div>
			<?php include_once('./itemrelation.php'); ?>
		<?php } ?>

		<?php // 위젯에서 해당글 클릭시 이동위치 : icv - 댓글, iuv - 후기, iqv - 문의 ?>
		<div id="item-tab" class="div-tab tabs<?php echo ($wset['tabline']) ? '' : ' trans-top';?>">
			<ul class="tab-list mgB80">
				<?php if($is_ii) { // 상품정보고시 ?>
					<li class="active"><a href="#item-info" data-toggle="tab">제품상세정보</a></li>
				<?php } ?>
				<li><a href="#item-review" data-toggle="tab">리뷰<?php echo $it_use_cnt;?></a></li>
				<!-- <?php if($is_comment) { // 댓글 ?>
					<li><a href="#item-cmt" data-toggle="tab">댓글<?php echo $it_comment_cnt;?></a></li>
				<?php } ?> -->
				<li><a href="#item-qa" data-toggle="tab">상품Q&A<?php echo $it_qa_cnt;?></a></li>
				<li><a href="#item-delivery" data-toggle="tab">배송/교환/환불</a></li>
			</ul>
			<div class="tab-content" style="border:0px; padding:0px;">
				<?php if($is_ii) { // 상품정보고시 ?>
					<div class="tab-pane active" id="item-info">
						<div class="item-explan">
							<?php if ($it['pt_explan']) { // 구매회원에게만 추가로 보이는 상세설명 ?>
								<div class="well"><?php echo apms_explan($it['pt_explan']); ?></div>
							<?php } ?>
							<?php echo apms_explan($it['it_explan']); ?>
						</div>

						<strong class="item_info_tit">상품정보제공고시</strong>
						<div class="item_table">
							<table>
								<caption>상품정보고시</caption>
								<colgroup>
									<col width="25%" />
									<col width="75%" />
								</colgroup>
								<tbody>
									<?php for($i=0; $i < count($ii); $i++) { ?>
										<tr>
											<th><?php echo $ii[$i]['title']; ?></th>
											<td><?php echo $ii[$i]['value']; ?></td>
										</tr>
									<?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				<?php } ?>
				<div class="tab-pane" id="item-review">
					<div id="iuv"></div>
					<div id="itemuse">
						<strong class="item_info_tit">리뷰</strong>
						<?php include_once('./itemuse.php'); ?>
					</div>
				</div>
				<?php if($is_comment) { // 댓글 ?>
					<div class="tab-pane" id="item-cmt">
						<div id="icv"></div>
						<?php include_once('./itemcomment.php'); ?>
					</div>
				<?php } ?>
				<div class="tab-pane" id="item-qa">
					<div id="iqv"></div>
					<div id="itemqa">
						<strong class="item_info_tit">상품Q&A<?php echo $it_qa_cnt;?></strong>
						<?php include_once('./itemqa.php'); ?>
					</div>
				</div>
				<div class="tab-pane" id="item-delivery">
					<strong class="item_info_tit">배송/교환/반품</strong>
					<?php include_once($item_skin_path.'/item.delivery.php'); ?>
				</div>
			</div>							
		</div>

		<?php echo $it_tail_html; // 하단 HTML ?>

		<a class="list_go" href="<?php echo $list_href;?>">목록보기</a>

		<div class="sm_btn_box" style="margin-top:20px;">
			<?php if($prev_href && $is_admin) { ?>
				<a href="<?php echo $prev_href;?>" title="<?php echo $prev_item;?>">이전</a>
			<?php } ?>
			<?php if($next_href && $is_admin) { ?>
				<a href="<?php echo $next_href;?>" title="<?php echo $next_item;?>">다음</a>
			<?php } ?>
			<?php if($edit_href) { ?>
				<a href="<?php echo $edit_href;?>">수정</a>
			<?php } ?>
			<?php if ($write_href) { ?>
				<a href="<?php echo $write_href;?>">등록</a>
			<?php } ?>
			<?php if($item_href) { ?>
				<a href="<?php echo $item_href;?>">관리</a>
			<?php } ?>
			<?php if($setup_href) { ?>
				<a class="win_memo bk" href="<?php echo $setup_href;?>"><i class="fa fa-cogs"></i><span class="skip_tag">스킨설정</span></a>
			<?php } ?>
		</div>
	</div><!--product_view_btm end-->

</div><!--product_view_con end-->


<?php include_once('./itemlist.php'); // 분류목록 ?>
