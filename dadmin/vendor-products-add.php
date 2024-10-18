<?php 
	include('config/connection.php');
	$pid=$_GET['pid'];
	$stock=$_GET['stock'];
	$vpid=$_GET['vpid'];
	$vid=$_GET['vid'];
	date_default_timezone_set("Asia/kolkata");
	$date=date("Y-m-d");
	$time=date("H:i:s");
	$pro_up=mysqli_query($conn,"UPDATE `products` SET `vendor_id`='$vid',`vendor_product_id`='vpid' WHERE id=$pid");
	$vp_query=mysqli_query($conn,"UPDATE `vendor_products` SET admin_approval='Approved'");
	$pro_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$pid");
	$pro_data=mysqli_fetch_array($pro_query);
	$product_code=$pro_data['product_code'];
	$app_query=mysqli_query($conn,"INSERT INTO `vendor_approval_products`(`vendor_id`, `p_id`, `vp_id`,`product_code`,`date`, `time`) VALUES ('$vid','$pid','$vpid','$product_code','$date','$time')");
	$sel_query=mysqli_query($conn,"SELECT * FROM `stock` WHERE p_id=$pid");
	$sel_data=mysqli_fetch_array($sel_query);
	$stock=$sel_data['stock_no']+$stock;
	$update_query=mysqli_query($conn,"UPDATE `stock` SET `stock`='Instock',`stock_no`='$stock' WHERE p_id=$pid");
	if($update_query){
		?>
		<script type="text/javascript">
			window.location.href="vendor-products-detail.php?pid=<?php echo $vpid; ?>";
		</script>
		<?php
	}

?>