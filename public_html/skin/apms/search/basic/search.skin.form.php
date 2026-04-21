<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
?>

<aside class="shop_search_box1 mgB60">
	<form id="frmdetailsearch" name="frmdetailsearch" class="form-horizontal" role="form">
	<input type="hidden" name="qsort" id="qsort" value="<?php echo $qsort ?>">
	<input type="hidden" name="qorder" id="qorder" value="<?php echo $qorder ?>">
	<input type="hidden" name="qcaid" id="qcaid" value="<?php echo $qcaid ?>">
	<input type="hidden" name="qname" id="qname" value="1">

		<div class="shop_search">
			<div class="inner_box">
				<label for="ssch_q" class="skip_tag">검색어</label>
				<input type="text" name="q" value="<?php echo $q; ?>" id="ssch_q" size="40" maxlength="30" placeholder="검색어를 입력하세요">
				<button type="submit" class="search_icon_btn" aria-label="검색">
					<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
						<circle cx="11" cy="11" r="8"></circle>
						<line x1="21" y1="21" x2="16.65" y2="16.65"></line>
					</svg>
				</button>
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
	<p class="search_total">
		총 <strong><?php echo number_format($total_count); ?></strong>개의 상품이 검색되었습니다.
	</p>

	<div class="search_select">
		<div class="cm_sort_wrap">
			<select name="sortodr" id="cm_sort_select" onchange="set_sort(this.value); return false;">
				<option value="">정렬하기</option>
				<option value="it_sum_qty"<?php echo ($qsort == 'it_sum_qty') ? ' selected' : '';?>>판매많은순</option>
				<option value="it_price_min"<?php echo ($qsort == 'it_price' && $qorder == 'asc') ? ' selected' : '';?>>낮은가격순</option>
				<option value="it_price"<?php echo ($qsort == 'it_price' && $qorder == 'desc') ? ' selected' : '';?>>높은가격순</option>
				<option value="it_update_time"<?php echo ($qsort == 'it_update_time') ? ' selected' : '';?>>최근등록순</option>
			</select>
			<span class="cm_sort_arrow">
				<svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
					<polyline points="6 9 12 15 18 9"></polyline>
				</svg>
			</span>
		</div>
	</div>

</aside>

