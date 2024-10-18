<?php
    session_start();
    include("config/connection.php");
    include '../dadmin/functions/common.php';
    include('../web-structure/common_helper/core_query.php');
    
    
    // =============== For testing Cron Job ============================
    $update_query = "UPDATE `agent_disc` SET `test`=NULL WHERE `agent_id` = '8';";
    mysqli_query($conn, $update_query);
    
    
    
    
    // =============== Actual Logic goes Here =================
    
    
    $date = date('Y-m-d');
    $time = date('H:i:s');
    
    //Fetching All Records From agent_discount table
    $query = mysqli_query($conn, "SELECT * FROM `agent_disc` WHERE `status` != 'Credited' ORDER BY id DESC;");
    while ($data = mysqli_fetch_assoc($query)) { 
        $order_id = $data['order_id'];
        $agentEmailSql = "SELECT * FROM `agents` WHERE `id` = '".$data['agent_id']."';";
        
        // preparing data to send email
        $agentData =  mysqli_fetch_assoc(mysqli_query($conn, $agentEmailSql));
        $recipient = $agentData['email'];
        $subject = "Congratulations! Your comission amount has been successfully added to your Wallet.";
        $body = "Dear ".$agentData['first_name']."<br> Rs. ".$data['amt']." has been successfully transfered to your wallet! for Order Id: $order_id";
        
        
        $sql = "SELECT * FROM `order_status` WHERE `order_id` = '$order_id' AND `tracking_status` = 'Delivered';";
        $order_tbl_data = mysqli_query($conn, $sql);
        while ($order_stat = mysqli_fetch_assoc($order_tbl_data)) {
            $txnId = 'TXNWL' . generateNumToken(6);
            // if delivery date is set then check if it is 5th day from delivery then credit reward to the agent wallet
            if (isset($order_stat['delivery_date'])) {
                $target_date = new DateTime($order_stat['delivery_date']);
                $current_date = new DateTime();
                $interval = $current_date->diff($target_date);
                $days_difference = $interval->days;
                
                // ============ Test Code =====================
                // $target_date = new DateTime("2024-07-15");
                // $current_date = new DateTime();
                // $interval = $current_date->diff($target_date);
                // $days_difference = $interval->days;
                
                // Check if the delivery date was 5 days ago
                if ($interval->invert == 1 && $days_difference >= 5 && $data['amt'] > 0) {
                    
                    // Updating Credited Status
                    $agent_tr_sql = "UPDATE `agent_disc` SET `status`='Credited' WHERE `order_id` = '$order_id';";
                    mysqli_query($conn, $agent_tr_sql);
                    
                    // Updating Wallet balance
                    $stmt = $conn->prepare("UPDATE `agents` SET `balance` = `balance` + ? WHERE `id` = ?");
                    $stmt->bind_param("di", $data['amt'], $data['agent_id']);
                    $stmt->execute();
                    $stmt->close();
                    
                    // Updating Transaction History
                    $agent_transcation_sql = "INSERT INTO `agent_transactions`(`agent_id`, `amount`, `action`, `txn_id`, `txn_status`, `paymentrp_status`, `date`, `time`) VALUES ('".$data['agent_id']."','".$data['amt']."','Commission Credited','$txnId','Success','Success','$date','$time')";
                    mysqli_query($conn, $agent_transcation_sql);
                    
                    // Sending Email Notification
                    sendEmail($recipient, $subject, $body);
                    
                    echo "Commisin Amount Transffered to Agent for Order ID -> $order_id <br>";
                }
            }
        }
    }

    
    // ============ Test Code =====================
    // $target_date = new DateTime("2024-05-24");
    // $current_date = new DateTime();
    // $interval = $current_date->diff($target_date);
    // $days_difference = $interval->days;
    
?>