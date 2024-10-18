<?php require('../config.php');
include '../dadmin/functions/common.php';
session_start();

$date = date('Y-m-d');
$time = date('H:i:s');

$currentDate = new DateTime(); // Get the current date and time
$currentDate->modify('-1 days'); // Modify the date to be 5 days before
$newDate = $currentDate->format('Y-m-d'); // Format the date as YYYY-MM-DD

$currentDateData = mysqli_query($con, "SELECT id, agent_id, order_id, SUM(amt) AS total_amt
FROM agent_disc
WHERE disc_date = '$newDate'
GROUP BY agent_id");


if ($currentDateData) {

    while ($row = mysqli_fetch_assoc($currentDateData)) {
        $txnId = 'TXNAC' . generateNumToken(6);
        $agent_id = $row['agent_id'];
        $id = $row['id'];
        $total_amt = $row['total_amt'];
        $query1 = mysqli_query($con, "SELECT * FROM order_status WHERE order_id = '{$row['order_id']}' AND tracking_status = 'Delivered'");
        if (mysqli_num_rows($query1) > 0) {
            $queryInsert = mysqli_query($con, "UPDATE `agents` SET `balance` = balance+$total_amt WHERE id = $agent_id");
            $txnUpdate = mysqli_query($con, "INSERT INTO `agent_transactions`(`agent_id`, `amount`, `action`, `txn_id`, `txn_status`, `paymentrp_status`, `date`, `time`) VALUES ('$agent_id','$total_amt','Commission Credited','$txnId','Success','Success','$date','$time')");
            $statusUpdate = mysqli_query($con, "UPDATE `agent_disc` SET `status` = 'Credited' WHERE id = $id");
        }
    }
    $data['status'] = true;
    $data['message'] = 'Claimed Successfully..';
} else {
    $data['status'] = false;
    $data['message'] = 'There is some error updating transaction..';
}

echo $data;