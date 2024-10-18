<?php include('header.php'); ?>
<style>
	td.product-cart-img img {
		width: 100px;
	}

	.wishlist-table td {
		font-size: 1.4rem;
		max-width: 300px;
		width: 7px;
	}

	tbody#wishListProducts {
		border-bottom: 1px solid #e1e1e1;
	}

	.wishlist-table-area {
		padding: 40px 0;
	}
	.shop-table .product-remove {
    position: inherit;
    right: 0rem;
    top: 0rem;
    padding: 0;
}
table {
    border-collapse: collapse;
    width: 100%;
}

@media (max-width: 767px){
    .wishlist-table td {
    font-size: 13px;
    max-width: 300px;
    width: fit-content;
}
}
</style>

<!--Heading Banner Area End-->
<div class="wishList">
	<div id="updateWishlist">
		<?php
		//Show Wishlist Details
    		$items = $wishList->wishListDetail();
		if (isset($items['wishListEmpty'])) {
		?>
			<h1 class="text-center">
				<img src="assets/images/wishlist-empty.png" alt="" width="600px">
			</h1>

			<div class="text-center cart_submit">
				<a href="index.php"><button type="button" class="btn btn-primary btn-rounded btn-md ml-2">Shop Now</button></a>
			</div>

			<br>
		<?php
		} else {
		?>

			<!-- Wishlist Table Area Start-->
			<div class="wishlist-table-area mt-20 mb-5">
				<div class="container ">
					<div class="row">
						<div class="col-lg-12">
							<div class="wishlist-table table-responsive">
								<table class="shop-table ">
									<thead>
										<tr>
											<th class="product-cart-img">
												<span class="nobr">Product Image</span>
											</th>
											<th class="product-name">
												<span class="nobr">Product Name</span>
											</th>
											<th class="product-price">
												<span class="nobr"> Unit Price </span>
											</th>
											<th class="product-stock-stauts">
												<span class="nobr"> Stock Status </span>
											</th>
											<th class="product-remove"></th>
										</tr>
									</thead>
									<tbody id="wishListProducts">
										<?php
										foreach ($items as $item) {
										?>

											<tr>
												<td class="product-thumbnail">
													<a href="product-detail.php?product_id=<?= $item['id']; ?>">
														<img src="asset/image/product/<?= $item['image']; ?>" width="100" height="100" alt="product">
													</a>
												</td>

												<td class="product-name">
													<a href="product-detail.php?product_id=<?= $item['id']; ?>"><?= $item['product_name']; ?></a>
												</td>
												<td class="product-price">
													<span><i class="fa fa-rupee"></i>
														<?php
														$isdeal = $homePage->isDealByProduct($item['id']);
														if (!empty($isdeal)) {
															if ($isdeal[0]['stock'] != 0) {
																$price = $isdeal[0]['price'];
															} else {
																if (($item['price'] == $item['discount']) || ($item['discount'] == 0)) {
																	$price = $item['price'];
																} else {
																	$price = $item['discount'];
																}
															}
														} else {
															if (($item['price'] == $item['discount']) || ($item['discount'] == 0)) {
																$price = $item['price'];
															} else {
																$price = $item['discount'];
															}
														}
														?><span class="mobile_nnm">Unit Price:</span> <?= $price; ?></span>
												</td>
												<td class="product-stock-status">
													<span class="wishlist-in-stock">
														<?= ($item['stock'] == 'Yes') ? "In Stock" : "Out of Stock" ?></span>
												</td>

												<td class="product-remove">
													<a onclick="removeFromWishList(<?= $item['id']; ?>,this.id,'<?= $url; ?>')" id="wishList<?= $item['id']; ?>" style="cursor: pointer;font-size:25px;">×</a>
												</td>
											</tr>
										<?php
										}
										?>

									</tbody>
								</table>
							</div>
						</div>

					</div>
				</div>
			</div>
			<!-- Wishlist Table Area End-->
		<?php
		}  ?>
	</div>
</div>
<!--Brand Area Start-->
<script type="text/javascript">
	var max = 0;
</script>
<?php include('include/footer.php'); ?>