<?php
require('config.php');

if(!isset($_GET['uid']))
{
if (!empty($_SESSION['loginid'])) {
	$loginid = $_SESSION['loginid'];
}
if (empty($_SESSION['loginid']) && (!isset($_SESSION['user_type']) || $_SESSION['user_type'] != 'admin')) {
	echo '<script type="text/javascript">
        window.location.href="account.php";
    </script>';

}
}
else if (isset($_GET['uid'])){
	$loginid = $_GET['uid'];
}
else{
    $loginid = 'admin';
}
$dashboard = new Dashboard($con);

// $invoiceToken = $dashboard->invoicePdfByOrderId($row['order_id']);
                                    
$details =$dashboard->userInvoiceByOrderId($_GET['oid'],$loginid);

$date = date_create($details['invoice_date']);
//  $token = mysqli_fetch_array(mysqli_query($con, "SELECT token FROM `invoice_generate` WHERE order_id = '$order_id'"))['token'];
   
//   define('ORDERID', $_GET['oid']);
//     define('TOKEN', $token);
// echo $details['token']."<br>";

// echo $_GET['id']."<br>";
// echo $loginid;

if (empty($details)) {
?>
	<script type="text/javascript">
		window.location.href = "index.php";
	</script>
<?php
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Invoice</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">

	<style>
		body {
			line-height: 24px;
			font-style: normal;
			font-weight: 400;
			font-size: 18px;
			visibility: visible;
			font-family: Raleway;
			color: #747474;
		}

		footer {
			background: #061531;
			color: #c8c6c6;
			padding-top: 12px;
		}

		a {
			background: #c8c6c6;
			padding: 4px;
		}

		#btn a {
			background: #c8c6c6;
			color: #061531;
			font-size: 14px;
			padding: 3px 14px;
			line-height: 30px;
			font-weight: 600;
			display: inline-block;
			text-transform: uppercase;
			margin-bottom: 0;
			text-decoration: none;
			border-radius: 2%;
		}
	</style>

</head>

<?php
//show logo
$logo = $homePage->logo();
?>

<body>
	<header>
		<div class="container">
			<div class="row">
				<div class="col-lg-4 col-md-4 p-2">
					<img src="asset/image/logo/<?= $logo['logo'];?>" style="width: 65%;">
				</div>
				<div class="col-lg-8 col-md-8">
					<div class="row">
						<div class="col-md-12 d-flex justify-content-end pt-4">
							<h3>Dear <?= $details['firstname'] ?></h3><br>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12 d-flex justify-content-end">
							<p>Following your invoice details for dates: <?= date_format($date, "d M, Y"); ?></p>
						</div>
					</div>
				</div>

				<!-- <div class="col-lg-8 col-md-8 d-flex justify-content-end pt-4">
					<h3>Dear Sandeep</h3><br>
					<p>Following your invoice details for dates: 2021-05-20</p>
				</div> -->
			</div>
		</div>
	</header>
	<div id="Iframe-Master-CC-and-Rs" class="set-margin set-padding set-border set-box-shadow center-block-horiz">
		<div class="responsive-wrapper responsive-wrapper-wxh-572x612" style="-webkit-overflow-scrolling: touch; overflow: auto; text-align: center">
			<iframe src="<?= BASE_URL ?>/invoice/pdf_invoices/<?= $details['pdf']; ?>" width="80%" height="800">
				<p style="font-size: 110%;"><em><strong>ERROR: </strong>
						An &#105;frame should be displayed here but your browser version does not support &#105;frames. </em>Please update your browser to its most recent version and try again.</p>
			</iframe>
		</div>
	</div>

	<footer class="mt-3">
		<div class="container">
			<div class="row  mt-2">
				<div class="col-md-10">
					<h4>If you have any queries related to products. Please visit our website.</h4>
				</div>
				<div class="col-md-2" id="btn">
					<a href="<?= BASE_URL ?>" target="_blank">Visit us</a>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 mt-4">
					<p><?= $details['firstname'] ?>, Thank you for choosing us. Your recent purchase is very important to us and we are happy to have you as our customer. We hope you will continue to shop with us.</p>
				</div>
			</div>
		</div>
	</footer>


	<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>

</body>

</html>