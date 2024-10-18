<?php
include "../config.php";
include '../dadmin/functions/common.php';

$response = array();

if (isset($_POST['orderId'])) {
    $userId = $_SESSION['loginid'];
    $orderId = $_POST['orderId'];

    $orderprice = mysqli_fetch_assoc(mysqli_query($con, "SELECT orderprice FROM order_tbl WHERE order_id = '$orderId'"))['orderprice'];

    $rewardsPrice = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM admin_rewards WHERE id = 1"))['min_amt'];

    $rewardsPercent = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM admin_rewards WHERE id = 1"))['percent'];
 
    // $totalRewards = ($orderprice / $rewardsPrice) * ($rewardsPercent);
    if($orderprice >= $rewardsPrice){
        $totalRewards = $orderprice * ($rewardsPercent/100);
    }
    else{
        $totalRewards = 0;
    }    
    $email_agent = mysqli_fetch_assoc(mysqli_query($con, "SELECT email FROM user WHERE id = '$userId' and agt_verify='true' and status='active'"))['email'];
    $agentid = mysqli_fetch_assoc(mysqli_query($con, "SELECT id, spent_amt FROM agents WHERE email = '$email_agent' and status = '1' and trash = '0'"));
    $agt_id = $agentid['id'];
    $agt_spa = $agentid['spent_amt'];

    $old_reward_points = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM agents WHERE id = $agt_id"))['total_rewards'];
    $reward_update = mysqli_query($con, "UPDATE agents SET total_rewards = total_rewards + $totalRewards WHERE id = $agt_id;");

    $toaamt = $orderprice + 100;


    $escaped_agt_id = mysqli_real_escape_string($con, $agt_id);
    $escaped_orderId = mysqli_real_escape_string($con, $orderId);
    $escaped_toaamt = mysqli_real_escape_string($con, $toaamt);
    $escaped_reward_points = mysqli_real_escape_string($con, $totalRewards);

    $medal_result = mysqli_query($con, "SELECT * FROM achievement_structure 
    WHERE min_amount < $agt_spa AND max_amount > $agt_spa 
    ORDER BY id LIMIT 1");

    $medal_result_row = mysqli_fetch_assoc($medal_result);
    
    //If achievement doesn't exists in table then Insert
    $does_achivement_exists_sql = "SELECT `agent_achievement` FROM `agent_achievement` WHERE `agent_id` = '$escaped_agt_id' AND `agent_achievement` = '{$medal_result_row['achievement']}' LIMIT 1;";
    $does_achivement_exists = mysqli_query($con, $does_achivement_exists_sql);
    if(mysqli_num_rows($does_achivement_exists) == 0){
        $medal_query = "INSERT INTO `agent_achievement` (`agent_id`, `agent_achievement`) VALUES ('$escaped_agt_id', '{$medal_result_row['achievement']}')";
        $medal_query_update = mysqli_query($con, $medal_query);
    }
    
    $medal_ag_update = mysqli_query($con, "UPDATE `agents` SET `medal` = '{$medal_result_row['achievement']}' WHERE id = '$escaped_agt_id'");
    // Construct the SQL query
    $finalrp = $escaped_reward_points;
    $query = "INSERT INTO `agent_reward` (`agent_id`, `order_id`, `order_amt`, `rp_credit`) VALUES ('$escaped_agt_id', '$escaped_orderId', '$escaped_toaamt', '$finalrp')";
    // Execute the query
    $reward_txn_update = mysqli_query($con, $query);
    if ($reward_update) {
        $response['status'] = true;
        $response['message'] = "Reward Points Updated Successfully";
    } else {
        $response['status'] = false;
        $response['message'] = "Error updating Reward Points: " . mysqli_error($con);
    }
} else {
    $response['status'] = false;
    $response['message'] = "No orderId provided";
}

// Return JSON response
echo json_encode($response);
