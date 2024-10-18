<?php
include('../config/connection.php');
include '../../web-structure/common_helper/core_query.php';

// Sanitize and validate input
$id = mysqli_real_escape_string($conn, $_POST['idpayment']);
$agentid = mysqli_real_escape_string($conn, $_POST['agid']);
$tran_id = mysqli_real_escape_string($conn, $_POST['txnss_id']);
$acid = mysqli_real_escape_string($conn, $_POST['payment_status']);
$amount = mysqli_real_escape_string($conn, $_POST['amount']);
$action = mysqli_real_escape_string($conn, $_POST['action']);

// Initialize variables
$query = false;
$updateBalanceQuery = false;

// If the payment was successful, update wallet balance
if ($acid == "Success") {
    if ($action =="added") {
        $result = mysqli_query($conn, "SELECT `balance` FROM `agents` WHERE `id` = '$agentid'");

        // Check if the query was successful
        if ($result) {
            $row = mysqli_fetch_assoc($result);
            $newWalletBalance = $row['balance'];

            // Update wallet balance
            $updateBalanceQuery = mysqli_query($conn, "UPDATE `agents` SET `balance` = $newWalletBalance + $amount WHERE `id` = '$agentid'");
        } else {
            echo json_encode(array('status' => 'error', 'message' => 'Error fetching wallet balance: ' . mysqli_error($conn)));
            exit; // Exit the script if there is an error
        }
    }

}

// Update transaction status
$query = mysqli_query($conn, "UPDATE `agent_transactions` SET `txn_status`='$acid' WHERE id='$id' AND `agent_id`='$agentid'");

    $resmsg = mysqli_query($conn, "SELECT email FROM agents WHERE id = $agentid");
    $row2 = mysqli_fetch_assoc($resmsg);
    $email = $row2['email']; 
    
    $subject = 'MSG: Transaction Status';
    //$message = "Your Transaction with ID: $tran_id was $acid. Amount: &#8377;$amount.";
    $message = "Your Wallet A/c has been credited with Rs. $amount. Transaction ID: $tran_id was $acid.";
    
    sendEmail($email, $subject, $message);

// Check the result of the queries
if ($query && $updateBalanceQuery) {
    if (mysqli_affected_rows($conn) > 0) {
        echo json_encode(array('status' => 'success', 'message' => 'Transaction status and wallet balance updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'No records updated.'));
    }
} elseif ($query) {
    echo json_encode(array('status' => 'success', 'message' => 'Transaction status updated successfully'));
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Error updating transaction status: ' . mysqli_error($conn)));
}
?>