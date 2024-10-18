<?php ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include('config/connection.php');
$orderid=$_REQUEST['orderid'];
$id=$_REQUEST['id'];

$status=$_REQUEST['status'];
if($status=="refund_initiated")
{
    $status1=1;
}
else
{
    $status1=2;
}

	$query=mysqli_query($conn,"UPDATE `refund_order` SET `status`='$status1' WHERE id=$id");
	        echo $order_query ="SELECT * FROM refund_order WHERE id=".$id;
            $oeder_run = mysqli_query($conn,$order_query);
            $order_get = mysqli_fetch_assoc($oeder_run);
            
            $orderdet_query ="SELECT * FROM order_details WHERE order_id = '$orderid' AND id = '".$order_get['od_p_id']."'";
            $oederset_run = mysqli_query($conn,$orderdet_query);
            $ord=mysqli_fetch_assoc($oederset_run);
            $order_query ="SELECT * FROM order_tbl WHERE order_id = '$orderid'";
            $oeder_run = mysqli_query($conn,$order_query);
            $order_get = mysqli_fetch_array($oeder_run);
            $shipping = $order_get['shipping']; 
            $orderprice = $order_get['orderprice'];
            $order_date  = $order_get['date'];
            $payment_mode  = $order_get['payment_mode'];
            $userid = $order_get['userid'];
        
        
     
        $by="admin";
     
     $query1="INSERT INTO `order_status`(`user_id`,`order_id`,`tracking_id`, `tracking_status`,`by`,`reason`,`date`,`time`,`delivery_date`,`delivery_time`) VALUES ('$userid','$orderid','".$ord['tracking_id']."','$status','$by','','".date('Y-m-d')."','".date("H:i:s")."','','')";
    mysqli_query($conn,$query1);
if($query)
{

	echo "<script type='text/javascript'>";
        //echo "alert('Your request successfully add');";
        echo "window.location.href = 'refundorder.php';";
    echo "</script>";
}
?>