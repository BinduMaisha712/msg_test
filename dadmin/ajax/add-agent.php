<?php
include('../config/connection.php');

if(isset($_POST['firstname'])) {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $mobileno = mysqli_real_escape_string($conn, $_POST['mobileno']);
    $emailid = mysqli_real_escape_string($conn, $_POST['emailid']);
    $password = md5(mysqli_real_escape_string($conn, $_POST['password'])); // Applying MD5 hash
    $status = '1';
    
    $addflat  = $_POST['addflat'];
    $addstreet = $_POST['addstreet'];
    $addlocality = $_POST['addlocality'];
    $addcountry = $_POST['addcountry'];
    $addstate = $_POST['addstate'];
    $addcity = $_POST['addcity'];
    $addzip = $_POST['addzip'];

    $checkQuery = mysqli_prepare($conn, "SELECT COUNT(*) FROM `agents` WHERE `email` = ?");
    mysqli_stmt_bind_param($checkQuery, 's', $emailid);
    mysqli_stmt_execute($checkQuery);
    mysqli_stmt_bind_result($checkQuery, $checkResult);
    mysqli_stmt_fetch($checkQuery);
    mysqli_stmt_close($checkQuery);

    if ($checkResult > 0) {
        echo json_encode(array('status' => 'error', 'message' => 'This Email is already exists!.'));
    } else {
        // Email does not exist, proceed with the insertion
        $checkQuery1 = mysqli_prepare($conn, "SELECT COUNT(*) FROM `user` WHERE `email` = ?");
        
        mysqli_stmt_bind_param($checkQuery1, 's', $emailid);
        mysqli_stmt_execute($checkQuery1);
        mysqli_stmt_bind_result($checkQuery1, $checkResult1);
        mysqli_stmt_fetch($checkQuery1);
        mysqli_stmt_close($checkQuery1);
        if ($checkResult1 > 0) {
            echo json_encode(array('status' => 'error', 'message' => 'Email Already exist as a User.'));
        } else {
            $insertQuery = mysqli_prepare($conn, "INSERT INTO `agents` (`first_name`, `last_name`, `phone`, `email`, `password`, `status`) VALUES (?, ?, ?, ?, ?, ?)");
            mysqli_stmt_bind_param($insertQuery, 'ssssss', $firstname, $lastname, $mobileno, $emailid, $password, $status);
            mysqli_stmt_execute($insertQuery);
            $lastid = mysqli_insert_id($conn);
            
           // $insertUser = mysqli_query($conn, "INSERT INTO `user`(`agt_id`, `role`, `firstname`, `lastname`, `mobile`, `email`, `emailverified`, `password`,`agt_verify`) VALUES ('$lastid', 'agent', '$firstname', '$lastname' , '$mobileno', '$emailid' , 'Yes', '$password','true')");
            $insertUser = mysqli_query($conn, "INSERT INTO `user`(`agt_id`,`role`, `firstname`, `lastname`, `mobile`, `email`,`emailverified`, `password`,`agt_verify`,`flat`, `street`, `locality`, `country`, `state`, `city`,`zipcode`) VALUES ('$lastid', 'agent', '$firstname', '$lastname' , '$mobileno', '$emailid' ,'Yes','$password','true','$addflat', '$addstreet', '$addlocality' , '$addcountry', '$addstate' ,'$addcity','$addzip')");
            if (mysqli_affected_rows($conn) > 0) {
                echo json_encode(array('status' => 'success', 'message' => 'Agent Added Successfully'));
            } else {
                echo json_encode(array('status' => 'error', 'message' => 'No records updated.'));
            }
            mysqli_stmt_close($insertQuery);
        }
    }
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Invalid input.'));
}
?>
