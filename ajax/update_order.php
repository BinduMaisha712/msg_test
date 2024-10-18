<?php
include "../config.php";

if(isset($_POST['action']) && $_POST['action'] == 'updateTxn')
{
    $userId = $_SESSION['loginid'];
    $orderId = $_POST['orderId'];
    $trxn_id = $_POST['txn_id'];

    $amount = mysqli_fetch_assoc(mysqli_query($con, "SELECT orderprice FROM order_tbl WHERE order_id = '$orderId'"))['orderprice'];

    $date  = date('Y-m-d');
    $time = date('H:i:s');

    $insertOnlineTxnQ = mysqli_query($con, "INSERT INTO `online_payment_detail`(`user_id`, `order_id`, `trnx_id`, `amount`, `trnx_status`, `trnx_date`, `trnx_time`) VALUES ('$userId','$orderId','$trxn_id','$amount','Success','$date','$time')");

    $updateOrderTblQ = mysqli_query($con, "UPDATE `order_tbl` SET `payment_status`='Success' WHERE order_id = '$orderId'");

    $updateOrderDetailQ = mysqli_query($con, "UPDATE `order_details` SET `payment_status`='Success' WHERE order_id = '$orderId'");

    if($insertOnlineTxnQ && $updateOrderTblQ && $updateOrderDetailQ){
        $data['status'] = true;
    }else{
        $data['status'] = false;
    }

}
    

echo json_encode($data);
?>