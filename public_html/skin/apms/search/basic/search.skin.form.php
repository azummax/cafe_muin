<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<aside class="shop_search_box1 mgB100">
	<form id="frmdetailsearch" name="frmdetailsearch" class="form-horizontal" role="form">
	<input type="hidden" name="qsort" id="qsort" value="<?php echo $qsort ?>">
	<input type="hidden" name="qorder" id="qorder" value="<?php echo $qorder ?>">
	<input type="hidden" name="qcaid" id="qcaid" value="<?php echo $qcaid ?>">
	<input type="hidden" name="qname" id="qname" value="1">

		<div class="shop_search">
			<div class="inner_box">
				<label for="ssch_q" class="skip_tag">검색어</label>
				<input type="text" name="q" value="<?php echo $q; ?>" id="ssch_q" size="40" maxlength="30">
				<button type="submit"><img src="/thema/Basic/img/hd_search.png" alt="검색"></button>
			</div>
		</div>
	</form>

	<script>
		function set_sort(qsort) {
			var f = document.frmdetailsearch;
			var qorder = "desc";

			if(qsort == "it_price_min") {
				qsort = "it_price";
				qorder = "asc";
			}
			f.qsort.value = qsort;
			f.qorder.value = qorder;
			f.submit();
		}

		function set_ca_id(qcaid) {
			var f = document.frmdetailsearch;
			f.qcaid.value = qcaid;
			f.submit();
		}
	</script>

</aside>

<aside class="shop_search_box2 mgB60">
	<strong class="search_total">총 <b><?php echo number_format($total_count); ?></b>개의 상품이 검색되었습니다.</strong>

	<div class="search_select">
		<!-- <div class="inner_box">
			<select name="sortodr" onchange="set_ca_id(this.value); return false;">
				<option value="">전체(<?php echo number_format($total_count);?>)</option>
				<?php for($i=0;$i < count($category); $i++) { ?>
					<option value="<?php echo $category[$i]['ca_id'];?>"<?php echo ($qcaid === $category[$i]['ca_id']) ? ' selected' : '';?>><?php echo $category[$i]['ca_name'];?>(<?php echo number_format($category[$i]['cnt']);?>)</option>
				<?php } ?>
			</select>
		</div> -->
		<div class="inner_box">
			<select name="sortodr" onchange="set_sort(this.value); return false;">
				<option value="">정렬하기</option>
				<option value="it_sum_qty"<?php echo ($qsort == 'it_sum_qty') ? ' selected' : '';?>>판매많은순</option>
				<option value="it_price_min"<?php echo ($qsort == 'it_price' && $qorder == 'asc') ? ' selected' : '';?>>낮은가격순</option>
				<option value="it_price"<?php echo ($qsort == 'it_price' && $qorder == 'desc') ? ' selected' : '';?>>높은가격순</option>
				<option value="it_use_avg"<?php echo ($qsort == 'it_use_avg') ? ' selected' : '';?>>평점높은순</option>
				<option value="it_use_cnt"<?php echo ($qsort == 'it_use_cnt') ? ' selected' : '';?>>후기많은순</option>
				<option value="pt_good"<?php echo ($qsort == 'pt_good') ? ' selected' : '';?>>추천많은순</option>
				<option value="pt_comment"<?php echo ($qsort == 'pt_comment') ? ' selected' : '';?>>댓글많은순</option>
				<option value="it_update_time"<?php echo ($qsort == 'it_update_time') ? ' selected' : '';?>>최근등록순</option>
			</select>
		</div>
	</div>

</aside>
