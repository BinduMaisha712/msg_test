 <?php 

            include('../config.php');
            $user = new User($con);
            $email= $_POST['email'];

            $checkemailexist = mysqli_query($con, "SELECT * FROM `user` WHERE email='" . $_POST['email'] . "'");
                $row_count = mysqli_num_rows($checkemailexist);
                if ($row_count > 0) {
                     $otp = rand(1000, 9999);
                          $insertOtp = mysqli_query($con, "INSERT INTO `user_tmp_table`( `user_info`, `otp`, `type`) VALUES ('".$_POST['email']."', '$otp', 'email')");
                          $user->generateRegisterEmailOTP('email', $_POST['email'], '');
                    
                        if ($insertOtp) {
                            
                            $responsemsg = sendForgetOTP($con, $email);
                            echo $responsemsg;
                            
                             $data['status'] = "success";
                            $data['msg'] = 'Otp sent successfully';
                        }else {
                            $data['status'] = "failure";
                            $data['msg'] = 'Error Occur try again';
                        }
                } else {
                    $data['status'] = "failure";
                    $data['msg'] = 'Email ID is not registered. Please register.';
                }

            
            echo json_encode($data);