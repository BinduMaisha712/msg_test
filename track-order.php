<?php include 'header.php';

$dashboard = new Dashboard($con);
if (isset($_GET['id'])) {
	$id = $_GET['id'];
	//show track details
	$details = $dashboard->trackOrder($id);

	// echo '<pre>';
	// print_r($details);
	// exit();
	if (empty($details)) {
?>
		<script type="text/javascript">
			window.location.href = "index.php";
		</script>
	<?php
	}
} else {
	?>
	<script type="text/javascript">
		window.location.href = "index.php";
	</script>
<?php
}
?>

<link rel="stylesheet" href="assets/css/track-order.css">
<!-- header end-->

<div class="breadcrumb-area breadcrumb-bg-two">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:;">Order Track</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- tracking content here -->
<div class="breadcrumbs_area other_bread">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="mytrackdivsec">
					<section>
						<div class="container mt-5">
							<div class="row">
								<div class="col-lg-11 col-md-11 col-sm-12">
									<div class="text-left toptrctxt">

										<h4 class="card-title text-left ordid">Order Id: <?= $details['order_id']; ?></h4>

										<div class="row">
											<div class="col-md-6">
												<h2 class="card-title text-left" <?= (end($details['status'])['tracking_status'] == 'Delivered') ? 'style="color:green;"' : ''; ?> <?= (end($details['status'])['tracking_status'] == 'Cancelled') ? 'style="color:red;"' : ''; ?>><?= end($details['status'])['tracking_status'] ?></h2>
												<span class="dteordr"><?= end($details['status'])['date'] ?>&nbsp;<?= end($details['status'])['time'] ?></span>
											</div>

											<div class="col-md-6 text-right newrighttrackdiv">
												<?php
												//show invoice

													if ($details['invoice_generated'] == '1') {

														$invoiceToken = $dashboard->invoiceTokenByOrderId($details['order_id']);

														if ($invoiceToken != NULL) {
															echo '<a class="btn myinvoice" target="_blank" href="invoice.php?' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '&oid=' . $details['order_id'] . '&' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '"  class=""><i class="fa fa-download"></i> Download Invoice</a>';
														}
													}
											 else {
													if (end($details['status'])['delivery_date'] != "") {
												?>
														<h4 class="card-title">Estimated Delivery</h4>
														<h3><?= end($details['status'])['delivery_date'] ?></h3>
												<?php
													}
												}
												?>


											</div>
										</div>


										<h4 class="mt-4 mb-4"><strong>Shipping Address:</strong> <?= $details['shipping_address']['address'] ?></h4>


										<div class="progress">
											<!--Show Order Status Bar-->
											<div class="determinate" style="width: <?= $dashboard->orderProgressBar(end($details['status'])['tracking_status']) ?>%"></div>
										</div>


									</div>
								</div>
							</div>
					</section>

					<section class="mt-3 mb-5">
						<div class="container">
							<div class="row">
								<div class="col-lg-12 col-md-12 col-sm-12">

									<div class="row">
										<div class="col-lg-4 col-md-4 col-sm-12">
											<div id="track">
												<div>
													<h3>Shippment tracking</h3>
												</div>
												<ul>

													<?php
													$totalStatus = count($details['status']);

													if ($totalStatus == 1 && $details['status'] != 'Cancelled') {
													} else {

														if ((end($details['status'])['tracking_status'] == 'Delivered') || (end($details['status'])['tracking_status'] == 'Cancelled')) {
															for ($i = 0; $i < ($totalStatus - 1); $i++) {
													?>
																<li>
																	<p><strong><?= $details['status'][$i]['date']; ?>&nbsp;<?= $details['status'][$i]['time']; ?></strong></p>
																	<h4><?= $details['status'][$i]['tracking_status']; ?></h4>
																</li>
															<?php
															}
															?>
												</ul>
												<?php
															$color = (end($details['status'])['tracking_status'] == 'Delivered') ? 'green' : 'red';
												?>
												<div id="stop">
													<li style="color:<?= $color; ?>;">
														<p><strong><?= end($details['status'])['date'] ?>&nbsp;<?= end($details['status'])['time'] ?></strong></p>
														<h4><?= end($details['status'])['tracking_status'] ?></h4>
														<?= (end($details['status'])['tracking_status'] == 'Cancelled') ? '<p class="mt-1" style="color:blue !important;">By: ' . end($details['status'])['by'] . '</p>' : ''; ?>
														<?= (end($details['status'])['tracking_status'] == 'Cancelled') ? '<p class="mt-1" style="color:black !important;">Reason: ' . end($details['status'])['reason'] . '</p>' : ''; ?>
													</li>
												</div>
												<?php

														} else {
															for ($i = 0; $i < $totalStatus; $i++) {
												?>
													<li>
														<p><strong><?= $details['status'][$i]['date']; ?>&nbsp;<?= $details['status'][$i]['time']; ?></strong></p>
														<h4><?= $details['status'][$i]['tracking_status']; ?></h4>
													</li> <?php
															}
															echo '</ul>';
														}
													} ?>

											</div>
										</div>


										<div class="col-lg-8 col-md-8 col-sm-12 alldiv">
											<div class="mydivprt">
												<div class="trackimgdiv">
													<?php
													if ($details['product_detail']['images'] != 0) {
													?>
														<a href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $details['product_detail']['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><img src="asset/image/product/<?= $details['product_detail']['images'][0]['image']; ?>" width="100%" class="trckimgwd" alt="big-1"></a>
													<?php
													} else {
													?>
														<a href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $details['product_detail']['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><img src="asset/image/product/image-not-found.jpg" class="trckimgwd" width="100%" alt="big-1"></a>
													<?php
													} ?>
												</div>
												<div class="trackptext" style="">
													<?php $catInfo = ($details['product_detail']['subcat_id'] == "") ? "cat_" . $details['product_detail']['cat_id'] : "subcat_" . $details['product_detail']['subcat_id'] ?>

													<h4><a href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $details['product_detail']['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $details['product_detail']['product_name'] . ", " . ", " . $homePage->getCatName($catInfo); ?></h4></a>
													<p> Tracking ID - <span class="font-weight-bold text-dark"><?= $details['tracking_id']; ?></span></p>

													<?php
														$ProductTax = $details['product_detail']['tax'] ?? 0;
														$PriceWithTax = $details['price'] + ($details['price'] / 100 * $ProductTax);
													?>

													<h4 class="mt-3 mb-4 bold"> <span>&#x20B9;</span> <?= $PriceWithTax ?? ''; ?> <span class="small text-muted"> via (<?= $details['payment_type']; ?>) + shipping charges </span></h4>

												</div>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</section>

					<section class="cancelorder">
						<?php
						if ((end($details['status'])['tracking_status'] == 'Delivered') || (end($details['status'])['tracking_status'] == 'Cancelled')) {
						} else {
						?>

							<div class="coupon-accordion">
								<!--Accrodion Start-->
								<h3><span id="showcoupon1"> Cancel Order? Click here to cancel this order</span></h3>
								
								<div id="checkout_coupon1" class="coupon-content">
									<div class="checkout-info">
										<form id="cancelOrder">
											<input type="hidden" name="tracking_id" value="<?= $details['tracking_id']; ?>">
										
											<div class="form-group">
												<label for="reason" class="rlbl">Reason</label>
												<textarea class="form-control" id="reason" name="reason" rows="3" required></textarea>
											</div>
											  <input type="hidden" id = 'orderid' value = '<?= $details['order_id']; ?>'>
											<button class="btn btn-outline-danger btn-sm cnslord mytrash" type="submit">Cancel Order</button>
											<div id="ErrMsg"></div>
										</form>
									</div>

								</div>

							</div>

						<?php
						}
						?>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
<?php include('include/footer.php') ?>

