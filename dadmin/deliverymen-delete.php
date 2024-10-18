<?php
	include("config/connection.php");
	$order_id=$_GET['order_id'];
	$tracking_id=$_GET['tracking_id'];
	$query=mysqli_query($conn,"UPDATE `delivery_schedule` SET `delivery_status`='Cancelled',`delivery_status_by`='admin',`status`='Inactive' WHERE `tracking_id`='$tracking_id'");
?>
<script type="text/javascript">
	window.location.href='order-details.php?order_id=<?php echo $order_id; ?>'
</script>