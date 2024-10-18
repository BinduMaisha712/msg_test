<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
session_start();

// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");

include("config.php");


$paytmChecksum = "";
$paramList = array();
$isValidChecksum = "FALSE";

$paramList = $_POST;
$paytmChecksum = isset($_POST["CHECKSUMHASH"]) ? $_POST["CHECKSUMHASH"] : ""; //Sent by Paytm pg

//Verify all parameters received from Paytm pg to your application. Like MID received from paytm pg is same as your application�s MID, TXN_AMOUNT and ORDER_ID are same as what was sent by you to Paytm PG for initiating transaction etc.
$isValidChecksum = verifychecksum_e($paramList, 'GlSXxsYYAmiCSzeq', $paytmChecksum); //will return TRUE or FALSE string.


if($isValidChecksum == "TRUE") {
	echo "<b>Checksum matched and following are the transaction details:</b>" . "<br/>";
	if ($_POST["STATUS"] == "TXN_SUCCESS") {
		echo "<b>Transaction status is success</b>" . "<br/>";
		$orderId = $_POST['ORDERID'];
		$txnId = $_POST['TXNID'];
		$date = date('Y-m-d');
		$updateStatus = mysqli_query($con, "UPDATE `stock_order` SET `order_status` = 'Complete', `payment_status` ='Success', `payment_date` = '$date', `txn_id` = '$txnId'  WHERE `order_id` = '$orderId' ");
		$url = $_SESSION['url'] . '&' . $urltoken . $urltoken . '&txn=0&' . $urltoken . '&'  . $urltoken ;
		echo $url;
		// header("Location: " . $url);
	}
	else {
		$orderId = $_POST['ORDERID'];
		$updateStatus = mysqli_query($con, "UPDATE `stock_order` SET `order_status` = 'Pending', `payment_status` ='Failure' WHERE `order_id` = '$orderId' ");
	}

	if (isset($_POST) && count($_POST)>0)
	{ 
		foreach($_POST as $paramName => $paramValue) {
				echo "<br/>" . $paramName . " = " . $paramValue;
		}
	}
}
else {
	echo "<b>Checksum mismatched.</b>";
	//Process transaction as suspicious.
}

?>