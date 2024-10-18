<?php require('../config.php');
// include('../web-structure/common_helper/core_query.php');
$data = array();
$inputErr = array();
$user = new User($con);

if (isset($_POST['action']) && $_POST['action'] == 'agent_login') {
    $email  = $_POST['logInMobileNumber'];
    $userPassword = $_POST['logInPassword'];

    $emailCheckQuery = mysqli_query($con, "SELECT COUNT(*) as count FROM agents WHERE email = '" . $email . "'");
    $emailCheckResult = mysqli_fetch_assoc($emailCheckQuery);

    if ($emailCheckResult['count'] > 0) {
        $query22 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM agents WHERE  email = '" . $email . "' AND  password = '" . md5($userPassword) . "'"));
        if (!empty($query22)) {
            if ($query22['status'] == '0') {
                $data['status'] = false;
                $data['result'] = 'Please contact Admin to activate your account.';
                $data['type'] = 'Login';
            } else {
                $query = "SELECT id,email, phone FROM agents WHERE status='1' AND email = '" . $email . "'";
                $userInfo = mysqli_fetch_assoc(mysqli_query($con, $query));
                $_SESSION['agent_loginid'] = $userInfo['id'];
                $_SESSION['agent_email'] = $userInfo['email'];
                $_SESSION['agent_mobile'] = $userInfo['phone'];
                $otpVerified = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE email = '".$email."'"))['emailverified'];
                if ($otpVerified== 'Yes') {
                    $data['status'] = true;
                    $data['result'] = 'Agent LogIn Successfully';
                    $data['type'] = 'Login';
                    $_SESSION['agentLoginStatus'] = true;
                } else {
                    $otp = rand(1000, 9999);
                    //$otp = 1234;
                    $DateTime = date("Y-m-d H:i:s");
                    $queryotp = "INSERT INTO `user_tmp_table`(`user_info`, `otp`, `type`, `datentime`) VALUES ('$email', '$otp', 'email', '$DateTime')";
                    $insertotp = mysqli_query($con, $queryotp);
                    if ($insertotp) {
                        $msg1 = "Thank's for registration";
                        $msg2 = "Use this OTP to verify your account";
                        include('../emailer_html/otp.php');
                        $EmailOTP_HTML = $content;
                        sendEmail($email, "Verify Your Account", $EmailOTP_HTML);
                        $responsemsg = sendWelcomeOTP($con, $userInfo['email']);
                        $verifyOtp = $user->verifyEmailOTP($_POST['userInfo'], $otp);
                        $otpVerified;
                        if ($otpVerified == 'Yes') {
                            $data['status'] = true;
                            $data['result'] = 'Agent LogIn Successfully';
                            $data['type'] = 'Login';
                            $_SESSION['agentLoginStatus'] = true;
                            $query = "SELECT id,email, phone FROM agents WHERE status='1' AND email = '" . $email . "'";
                            $userInfo = mysqli_fetch_assoc(mysqli_query($con, $query));
                            $_SESSION['agent_loginid'] = $userInfo['id'];
                            $_SESSION['agent_email'] = $userInfo['email'];
                            $_SESSION['agent_mobile'] = $userInfo['phone'];
                            $_SESSION['agentLoginStatus'] = true;
                        } else {
                            $data['status'] = true;
                            $data['result'] = 'Enter OTP';
                            $data['type'] = 'Login';
                        }
                    }
                }
            }
        } else {
            $data['status'] = false;
            $data['result'] = 'Email or Password are Incorrect';
            $data['type'] = 'Login';
        }
    } else {
        // Email is not registered
        $data['status'] = false;
        $data['result'] = 'Email is not registered. Please sign up.';
        $data['type'] = 'Login';
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'agent_register' ) {
    $email  = $_POST['email'];
    $userPassword = md5($_POST['pass']);
    $phone = $_POST['phone'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    
    $addflat  = $_POST['addflat'];
    $addstreet = $_POST['addstreet'];
    $addlocality = $_POST['addlocality'];
    $addcountry = $_POST['addcountry'];
    $addstate = $_POST['addstate'];
    $addcity = $_POST['addcity'];
    $addzip = $_POST['addzip'];
    

    $mailExistAgents = mysqli_num_rows(mysqli_query($con, "SELECT * FROM agents WHERE email = '".$email."'"));
    $mailExistUsers = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user WHERE email = '".$email."'"));
    if ($mailExistAgents || $mailExistUsers) {
        $data['status'] = false;
        $data['result'] = 'This email is already registered.';
        $data['type'] = 'Register';
    } else {
         $otp = rand(1000, 9999);
        //$otp = 1234;
        $DateTime = date("Y-m-d H:i:s");
        $queryotp = "INSERT INTO `user_tmp_table`(`user_info`, `otp`, `type`, `datentime`) VALUES ('$email', '$otp', 'email', '$DateTime')";
        $insertotp = mysqli_query($con, $queryotp);
        if ($insertotp) {
            $msg1 = "Thank's for registration";
            $msg2 = "Use this OTP to verify your account";
            include('../emailer_html/otp.php');
            $EmailOTP_HTML = $content;
            $insertAgent = mysqli_query($con, "INSERT INTO `agents`(`email`, `password`, `phone`, `first_name`, `last_name`) VALUES ('$email', '$userPassword', '$phone' , '$first_name', '$last_name')");
            $lastid = mysqli_insert_id($con);
            $insertUser = mysqli_query($con, "INSERT INTO `user`(`agt_id`,`role`, `firstname`, `lastname`, `mobile`, `email`, `password`,`agt_verify`,`flat`, `street`, `locality`, `country`, `state`, `city`,`zipcode`) VALUES ('$lastid', 'agent', '$first_name', '$last_name' , '$phone', '$email' ,'$userPassword','false','$addflat', '$addstreet', '$addlocality' , '$addcountry', '$addstate' ,'$addcity','$addzip')");
            sendEmail($email, "Verify Your Account", $EmailOTP_HTML);
            $responsemsg = sendWelcomeOTP($con, $email);

            // $verifyOtp = $user->verifyEmailOTP($_POST['userInfo'], $otp);

            $otpVerified = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE email = '".$email."'"))['emailverified'];
            if ($otpVerified == 'Yes') {
                if ($insertAgent && $insertUser) {
                    $data['status'] = true;
                    $data['result'] = 'Agent Registered Successfully. Please wait for account verification from admin.';
                    $data['type'] = 'Register';
                }  else {
                    $data['status'] = false;
                    $data['result'] = 'Some Error Occured'; 
                    $data['type'] = 'Register';
                }
            } else {
                    $data['status'] = true;
                    $data['result'] = 'Enter OTP'; 
                    $data['type'] = 'Register';
            }
        }
    }
}
echo json_encode($data);