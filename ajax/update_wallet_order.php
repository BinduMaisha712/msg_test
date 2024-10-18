<?php
include "../config.php";
include '../dadmin/functions/common.php'; 

if (isset($_POST['orderId']) && isset($_POST['action'])) {

    $userId = $_SESSION['loginid'];
    $orderId = $_POST['orderId'];

    $email_agent = mysqli_fetch_assoc(mysqli_query($con, "SELECT email FROM user WHERE id = '$userId' and agt_verify='true' and status='active'"))['email'];
    $agentid = mysqli_fetch_assoc(mysqli_query($con, "SELECT id, balance, spent_amt FROM agents WHERE email = '$email_agent' and status = '1' and trash = '0'"));
    $agt_id = $agentid['id'];
    $agt_bla = $agentid['balance'];
    $agt_spa = $agentid['spent_amt'];

    $amount = mysqli_fetch_assoc(mysqli_query($con, "SELECT orderprice FROM order_tbl WHERE order_id = '$orderId'"))['orderprice'];
    $toaamt= $amount+100;
    $date = date('Y-m-d');
    $time = date('H:i:s');
    $dateTime = $date . ' ' . $time;
    $txnId = 'TXN' . generateNumToken(6);

    $amt_bla = $agt_bla-$toaamt;
    $agt_spent = $agt_spa+$toaamt;

    $insertagttra = mysqli_query($con, "INSERT INTO `agent_transactions`(`agent_id`, `amount`, `action`, `txn_id`, `txn_status`, `paymentrp_status`, `date`, `time`,`date_time`) VALUES ('$agt_id','$toaamt','spent','$txnId','Success','Success','$date','$time','$dateTime')");
   
    $updateOrderTblQ = mysqli_query($con, "UPDATE `order_tbl` SET `payment_status`='Success' WHERE order_id = '$orderId'");
   
    $updateagtbla = mysqli_query($con, "UPDATE `agents` SET `balance`='$amt_bla', `spent_amt`='$agt_spent' WHERE id = '$agt_id'");
    
    $updateOrderDetailQ = mysqli_query($con, "UPDATE `order_details` SET `payment_status`='Success' WHERE order_id = '$orderId'"); 
    
    if ($insertagttra && $updateOrderTblQ && $updateagtbla && $updateOrderDetailQ) {
        $data['status'] = true;
        
        $resmsg = mysqli_query($con, "SELECT email FROM agents WHERE id = $agt_id");
        $row2 = mysqli_fetch_assoc($resmsg);
        $email = $row2['email']; 
        $curDate = date('Y-m-d H:i:s');
    
        $subject = 'MSG: Transaction Successful';
        $message = "Your Wallet A/c has been debited with Rs. $toaamt on $curDate. Transaction ID: $txnId. The transaction was successful.";
    
        sendEmail($email, $subject, $message);
    
    } else {
        $data['status'] = false;
    }
}

echo json_encode($data);
?>
