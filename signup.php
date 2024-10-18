<?php

include('../config.php');


if (!empty($_POST['emailId']) && !empty($_POST['mobileNumber']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['userPassword'])) {
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
            // VERIFICATION MAIL =======================
            $otp = rand(1000, 9999);
            // $otp = 1234;
            $insertOtp = mysqli_query($con, "INSERT INTO `user_tmp_table`( `user_info`, `otp`, `type`) VALUES ('" . $_POST['emailId'] . "', '$otp', 'email')");

            if ($insertOtp) {
                $stjsd = 'User registered Successfully';
                $user = new User($con);
                $user->generateRegisterEmailOTP('email', $email, '');
                // $msg1 = "Thank's for registration";
                // $msg2 = "Use this OTP to verify your account";

                // SEND OTP ON SMS 
                // $msg = "Dear user, your account created successfully use otp " . $otp . " for account verification.";

                // $number = '91' . $mobile;
                // $msg = $msg;
                // $msgs = urldecode($msg);
                // $apiKey = urlencode('MzQzMzQxNjIzNzY5Njg3OTczNmQ0YzY0Mzg2MjU0MzE=');
                // $numbers = array($number);
                // $sender = urlencode('MSG');
                // $message = rawurlencode($msgs);
                // $numbers = implode(',', $numbers);
                // $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
                // $ch = curl_init('https://api.textlocal.in/send/');
                // curl_setopt($ch, CURLOPT_POST, true);
                // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                // $response = curl_exec($ch);
                // curl_close($ch);

                // $status = (json_decode($response));

                // if ($status->status == 'success') {
                //     $stjsd = 'Use OTP sent on mail, to verify account';
                // }
            }

            $data['status'] = "success";
            $data['msg'] = $stjsd;
        } else {
            $data['status'] = "failure";
            $data['msg'] = 'Error Occur Please re-submit the registration form';
        }
    }
} else {
    $data['status'] = "failure";
    $data['msg'] = 'All Fields are mandatory';
}
echo json_encode($data);
