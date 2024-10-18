<?php require('../config/connection.php');
include '../../dadmin/functions/common.php';
include '../../web-structure/common_helper/core_query.php';
session_start();

if (isset($_POST['payment_id']) && !empty($_POST['payment_id'])) {
    $payment_id = $_POST['payment_id'];
    $amt = $_POST['amt'];
    $agid = $_POST['id'];
    $date = date('Y-m-d');
    $time = date('H:i:s');
    $added_on = date('Y-m-d h:i:s');

    // Perform the transaction processing
    mysqli_query($conn, "insert into agent_transactions (`agent_id`, `amount`, `action`, `txn_id`,`paymentrp_status`, `date`, `time`,`date_time`) values('$agid','$amt', 'added','$payment_id','Success','$date','$time','$added_on')");

    $resmsg = mysqli_query($conn, "SELECT email FROM agents WHERE id = $agid");
    $row2 = mysqli_fetch_assoc($resmsg);
    $email = $row2['email']; 
    $curDate = date('Y-m-d H:i:s');

    $subject = 'MSG: Transaction Successful';
    $message = "Your Wallet A/c will be credited with Rs. $amt after admin approval on $curDate. Transaction ID: $payment_id. The transaction was successful.";
    
    sendEmail($email, $subject, $message);

    echo '<div id="snackbar">Recharged Successfully.</div>';
    echo "<script type='text/javascript'> document.getElementById('amount').value = '';var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000); ";
    echo "</script>";


} else {
    // Display error message if payment_id is empty or not set
    echo '<div id="snackbar">Some error occurred. Please try again later.</div>';
    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
    echo "</script>";
}

?>