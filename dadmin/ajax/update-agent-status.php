<?php
include('../config/connection.php');

$id = $_POST['idagent'];
$acid = $_POST['agent_status'];

$id = mysqli_real_escape_string($conn, $id);
$acid = mysqli_real_escape_string($conn, $acid);

$query = mysqli_query($conn, "UPDATE `agents` SET `status`='$acid' WHERE id=$id");

if ($query) {
    if (mysqli_affected_rows($conn) > 0) {
        echo json_encode(array('status' => 'success', 'message' => 'Agent Status updated successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'No records updated.'));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Error updating agent status: ' . mysqli_error($conn)));
}

if ($acid == '0' || $acid == '1') {
    $agt_verify_value = ($acid == '1') ? 'true' : 'false';
    $update_user_query = mysqli_query($conn, "UPDATE `user` SET `agt_verify`='$agt_verify_value' WHERE agt_id=$id AND role='agent'");
   
    if (!$update_user_query) {
        echo json_encode(array('status' => 'error', 'message' => 'Error updating agt_verify status: ' . mysqli_error($conn)));
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid agent_status value.'));
}
mysqli_close($conn);

?>