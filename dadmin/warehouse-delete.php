<?php
	include("config/connection.php");
	$order_id=$_GET['order_id'];
	$tracking_id=$_GET['tracking_id'];
	$query=mysqli_query($conn,"UPDATE `warehouse_schedule` SET `order_status`='Cancelled',`order_status_by`='admin',`status`='Inactive' WHERE `tracking_id`='$tracking_id'");
	//$del=mysqli_query($conn,"DELETE FROM `warehouse_order_tbl` WHERE `order_id`='$order_id'");


?>
<script type="text/javascript">
	window.location.href='order-details.php?order_id=<?php echo $order_id; ?>'
</script>