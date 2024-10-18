 <?php 

            include('../config.php');
            $user = new User($con);
            $otp = rand(1000, 9999);
            $email = $_POST['email'];
            
              $insertOtp = mysqli_query($con, "INSERT INTO `user_tmp_table`( `user_info`, `otp`, `type`) VALUES ('".$_POST['email']."', '$otp', 'email')");
              $sendotp = $user->generateEmailForgotPasswordOTP('email',$_POST['email']);
        
            if ($insertOtp) {
	           
	           
                    $responsemsg = sendForgetOTP($con, $email);
                    echo $responsemsg;
                // $msg2 = "Use this OTP to verify your account";
                
                // // SEND OTP ON SMS 
                // $msg = "Dear user, use this otp " . $otp . " to change password.";

                // $number = '91' . $mobile;
                // $msg = $msg;
                // $msgs = urldecode($msg);
                // $apiKey = urlencode('MzQzMzQxNjIzNzY5Njg3OTczNmQ0YzY0Mzg2MjU0MzE=');
                // $numbers = array($number);
                // $sender = urlencode('ETHNIKALA');
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
                //   $stjsd = 'Use OTP sent on mail, to verify account';
                // }
                // $user = new User($con);
                // $user->generateRegisterEmailOTP('email', $email, '');
                
                 $data['status'] = "success";
                $data['msg'] = 'Otp sent successfully';
            }else {
                 $data['status'] = "failure";
                $data['msg'] = 'Error Occur try again';
            }
            
            echo json_encode($data);