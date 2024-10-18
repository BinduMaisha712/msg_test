<?php
error_reporting(0);
include('config/connection.php');
$hid=$_REQUEST['hid'];
$nid=$_REQUEST['nid'];
$bid=$_REQUEST['bid'];
$sid=$_REQUEST['sid'];
$tid=$_REQUEST['tid'];
$acid=$_REQUEST['No'];
	
	$query=mysqli_query($conn,"UPDATE `products` SET `hot_deals`='$acid' WHERE id=$hid");
	$query=mysqli_query($conn,"UPDATE `products` SET `new_arrivals`='$acid' WHERE id=$nid");
	$query=mysqli_query($conn,"UPDATE `products` SET `best_seller`='$acid' WHERE id=$bid");
	$query=mysqli_query($conn,"UPDATE `products` SET `special`='$acid' WHERE id=$sid");
	$query=mysqli_query($conn,"UPDATE `products` SET `today_deal`='$acid' WHERE id=$tid");

	header('location:view-all-products.php');
?>