<?php

include('../config.php');

if (!empty($_POST['emailId']) && !empty($_POST['mobileNumber']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['userPassword'])) {
  
    if ($_POST['role']=='user'){
    $emailQuery = "SELECT id FROM user WHERE email='" .  $_POST['emailId'] . "'";
    $emailResult = mysqli_query($con, $emailQuery);
    $count_email = mysqli_num_rows($emailResult);

    $mobileQuery2 = "SELECT * FROM user WHERE mobile='" . $_POST['mobileNumber'] . "'";
    $mobileResult2 = mysqli_query($con, $mobileQuery2);
    $mobileNumResults2 = mysqli_num_rows($mobileResult2);

    if ($count_email > 0) {
        $data['status'] = "failure";
        $data['msg'] = 'Email ID already Registered';
    } else if ($mobileNumResults2 > 0) {
        $data['status'] = "failure";
        $data['msg'] = 'Mobile Number already Registered';
    } else {

        $password = md5($_POST['userPassword']);
        $fname = $_POST['firstName'];
        $lname = $_POST['lastName'];
        $email = $_POST['emailId'];
        $mobile = $_POST['mobileNumber'];

        $insert = mysqli_query($con, "INSERT INTO `user`(`role`, `firstname`, `lastname`, `mobile`, `email`, `password`, `agt_verify`) VALUES ('User','$fname','$lname','$mobile','$email','$password','true')");

            if ($insert) {
                $otp = rand(1000, 9999);
                $insertOtp = mysqli_query($con, "INSERT INTO `user_tmp_table`( `user_info`, `otp`, `type`) VALUES ('" . $_POST['emailId'] . "', '$otp', 'email')");
                $user->generateRegisterEmailOTP('email', $email, '');
                if ($insertOtp) {
                    $stjsd = 'User registered Successfully';
                    $user = new User($con);
                    
                    $responsemsg = sendWelcomeOTP($con, $email);
                    
                    echo $responsemsg;
                }

                $data['status'] = "success";
                $data['msg'] = $stjsd;
            } 

        else {
            $data['status'] = "failure";
            $data['msg'] = 'Error Occur Please re-submit the registration form';
        }
    }
}

if ($_POST['role']=='agent'){
    $emailQueryUser = "SELECT id FROM user WHERE email='" . $_POST['emailId'] . "'";
    $emailResultUser = mysqli_query($con, $emailQueryUser);
    $countEmailUser = mysqli_num_rows($emailResultUser);

    $mobileQueryUser = "SELECT * FROM user WHERE mobile='" . $_POST['mobileNumber'] . "'";
    $mobileResultUser = mysqli_query($con, $mobileQueryUser);
    $mobileNumResultsUser = mysqli_num_rows($mobileResultUser);

    $emailQueryAgent = "SELECT id FROM agents WHERE email='" . $_POST['emailId'] . "'";
    $emailResultAgent = mysqli_query($con, $emailQueryAgent);
    $countEmailAgent = mysqli_num_rows($emailResultAgent);

    $mobileQueryAgent = "SELECT * FROM agents WHERE phone='" . $_POST['mobileNumber'] . "'";
    $mobileResultAgent = mysqli_query($con, $mobileQueryAgent);
    $mobileNumResultsAgent = mysqli_num_rows($mobileResultAgent);

    if ($countEmailUser > 0 || $countEmailAgent > 0) {
        $data['status'] = "failure";
        $data['msg'] = 'Email ID already Registered';
    } elseif ($mobileNumResultsUser > 0 || $mobileNumResultsAgent > 0) {
        $data['status'] = "failure";
        $data['msg'] = 'Mobile Number already Registered';
    }else {

    $password = md5($_POST['userPassword']);
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['emailId'];
    $mobile = $_POST['mobileNumber'];

    $insert2 = mysqli_query($con, "INSERT INTO `agents`(`email`, `password`, `phone`, `first_name`, `last_name`) VALUES ('$email','$password','$mobile','$fname','$lname')");
    $lastid = mysqli_insert_id($con);
    $insert = mysqli_query($con, "INSERT INTO `user`(`agt_id`,`role`, `firstname`, `lastname`, `mobile`, `email`, `password`, `agt_verify`) VALUES ('$lastid','agent','$fname','$lname','$mobile','$email','$password','false')");        

    if ($insert && $insert2) {
        $otp = rand(1000, 9999);
        $insertOtp = mysqli_query($con, "INSERT INTO `user_tmp_table`( `user_info`, `otp`, `type`) VALUES ('" . $_POST['emailId'] . "', '$otp', 'email')");

        if ($insertOtp) {
            $stjsd = 'Agent registered Successfully, Please contact admin to activate your account';
            $user = new User($con);
            $user->generateRegisterEmailOTP('email', $email, '');
            $responsemsg = sendWelcomeOTP($con, $email);
            echo $responsemsg;
        }

        $data['status'] = "success";
        $data['msg'] = $stjsd;
    } else {
        $data['status'] = "failure";
        $data['msg'] = 'Error Occur Please re-submit the registration form';
    }
}
}

}
else {
    $data['status'] = "failure";
    $data['msg'] = 'All Fields are mandatory';
}
echo json_encode($data);
