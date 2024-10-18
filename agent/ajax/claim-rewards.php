<?php require('../config/connection.php');
include '../../dadmin/functions/common.php';
session_start();

if ($_POST['covert'] != '' && $_POST['rewardtotal'] != '') {

    $converted  = $_POST['covert'];
    $redemPoints = $_POST['rewardtotal'];
    $agent_id = $_SESSION['agent_loginid'];
    $txnId = 'TXNWL' . generateNumToken(6);
    $date = date('Y-m-d');
    $time = date('H:i:s');
    $rewardclaim = mysqli_query($conn, "UPDATE agents SET total_rewards = total_rewards - $redemPoints AND balance = balance + $converted WHERE id=$agent_id");

    if ($rewardclaim) {

        $saveTxn = mysqli_query($conn, "INSERT INTO `claim_rewards`( `agent_id`, `points`, `txn_id`, `date`, `time` ) VALUES ('$agent_id', '$converted' , '$txnId', '$date', '$time' )");

        $insertagttra = mysqli_query($conn, "INSERT INTO `agent_transactions`(`agent_id`, `amount`, `action`, `txn_id`, `txn_status`, `paymentrp_status`, `date`, `time`) VALUES ('$agent_id','$converted','Rewards Added','$txnId','Success','Success','$date','$time')");

        $data['status'] = true;
        $data['message'] = 'Claimed Successfully..';
    } else {

        $data['status'] = false;
        $data['message'] = 'There is some error updating transaction..';
    }
}


echo json_encode($data);
