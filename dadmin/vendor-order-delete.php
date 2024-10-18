<?php
include("config/connection.php");
	 $order_id=$_GET['order_id'];
	$product_id=$_GET['pid'];
    $tracking_id=$_GET['tracking_id'];
	$del=mysqli_query($conn,"UPDATE `vendor_order_tbl` SET `order_status`='Cancelled',`order_status_by`='admin',`status`='Inactive' WHERE tracking_id='$tracking_id' AND p_id='$product_id'");

	   $vendor_sel1=mysqli_query($conn,"SELECT * FROM `vendor_order_tbl` WHERE `tracking_id`='$tracking_id' AND p_id='$product_id'");
            $vendor_data=mysqli_fetch_array($vendor_sel1);
            $vp_id=$vendor_data['vp_id'];
            $vquantity=$vendor_data['quantity'];
            $vendor_psel=mysqli_query($conn,"SELECT * FROM `vendor_stock` WHERE `vp_id`='$vp_id'");
            $vendor_psel_data=mysqli_fetch_array($vendor_psel);
            $newvpstock=$vendor_psel_data['stock_no']+$vquantity;
            if($vendor_psel_data['stock_no']==0)
            {
                $vendor_stock_up=mysqli_query($conn,"UPDATE `vendor_stock` SET `stock`='Instock',`stock_no`='$newvpstock' WHERE vp_id=$vp_id");
            }else
            {
                $vendor_stock_up=mysqli_query($conn,"UPDATE `vendor_stock` SET `stock_no`='$newvpstock' WHERE vp_id=$vp_id");
            }
	
?>


<script type="text/javascript">
	window.location.href='order-details.php?order_id=<?php echo $order_id; ?>'
</script>