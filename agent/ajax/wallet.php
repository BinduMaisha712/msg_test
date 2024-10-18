<?php require('../config/connection.php');
include '../../dadmin/functions/common.php'; 
session_start();

if (isset($_POST['action']) && $_POST['action'] == 'recharge_wallet' &&  $_POST['amount'] != '') {

    $amount  = $_POST['amount'];
    $agent_id = $_SESSION['agent_loginid'];
    $txnId = 'TXN' . generateNumToken(6) ;
    $date = date('Y-m-d');
    $time = date('H:i:s');

    $saveTxn = mysqli_query($conn, "INSERT INTO `agent_transactions`( `agent_id`, `amount`, `action`, `txn_id`, `date`, `time` ) VALUES ('$agent_id', '$amount' , 'added', '$txnId', '$date', '$time' )");
    
    if($saveTxn){
        echo '<div id="snackbar">Recharged Successfully.</div>';
        echo "<script type='text/javascript'> document.getElementById('amount').value = '';var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000); ";
        // setTimeout(() => {window.location.href= 'wallet-details.php'  }, 600);
        echo "</script>";
    }else{
        echo '<div id="snackbar">Some error occured. Please try again later.</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo "</script>";
    }
  
}


// echo json_encode($data);