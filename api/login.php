<?php 

include('../config.php');
// print_r($_POST);
// die;
       if ($_POST['email'] != "") {
            $email = $_POST['email'];
        } else {
            $data['status'] = 'failure';
            $data['msg'] = 'Please enter email !';
        }
        if ($_POST['userPassword'] != "") {
            $userPassword = $_POST['userPassword'];
        } else {
              $data['status'] = 'failure';
            $data['msg'] = 'Please enter passsword!';
        }

        if ($_POST['email'] != "" && $_POST['userPassword'] != "") {
            
        $sel_user = "SELECT * FROM user WHERE email='" . $_POST['email'] . "'";
        $user_email = mysqli_query($con, $sel_user);
        $user_row = mysqli_num_rows($user_email);

            if ($user_row > 0) { //// If Mobile Number is registered

            $emailVerStatus = mysqli_fetch_assoc($user_email)['emailverified'];
            // print_r($emailVerStatus);
                if ($emailVerStatus == 'Yes') { 
                    
                    $query = "SELECT * FROM user WHERE status='Active' AND email = '" . $email . "' AND  password = '" . md5($userPassword) . "'";
                   
                    $count = mysqli_num_rows(mysqli_query($con, $query));
                    
                    if ($count == 1) {

                        $queryUser = "SELECT id,email, mobile FROM user WHERE status='Active' AND email = '" . $email . "' AND role='User'";
                        $userDataUser = mysqli_fetch_assoc(mysqli_query($con, $queryUser));
                    
                        $queryAgent = "SELECT id,email, mobile FROM user WHERE status='Active' AND email = '" . $email . "' AND role='Agent'";
                        $userDataAgent = mysqli_fetch_assoc(mysqli_query($con, $queryAgent));
                    
                        if ($userDataUser) {
                            $userData = [
                                'userLoginStatus' => true,
                                'loginid' => $userDataUser['id'],
                                'email' => $userDataUser['email'],
                                'mobile' => $userDataUser['mobile'],
                            ];
                    
                            $directLogin = 'https://micodetest.com/msg_updated/api/login-token.php?t=' . encrypt_decrypt($userData);
                            $data['url'] = $directLogin;
                            $data['status'] = 'success';
                            $data['msg'] = 'User LogIn Successfully';
                        } elseif ($userDataAgent) {
                                             
                            $userData = [
                                'userLoginStatus' => true,
                                'loginid' => $userDataAgent['id'],
                                'email' => $userDataAgent['email'],
                                'mobile' => $userDataAgent['phone'],
                            ];
                    
                            $directLogin = 'https://micodetest.com/msg_updated/api/login-token.php?tagent=' . encrypt_decrypt($userData);
                            $data['url'] = $directLogin;
                            $data['status'] = 'success';
                            $data['msg'] = 'Agent LogIn Successfully';
                        }

                    } else {
                        $data['status'] = 'failure';
                        $data['msg'] = 'Email or Password are Incorrect'; ////// Error Occur
                    }
                } else {
                    
              $otp = 1234;
              $insertOtp = mysqli_query($con, "INSERT INTO `user_tmp_table`( `user_info`, `otp`, `type`) VALUES ('".$_POST['email']."', '$otp', 'email')");
        
            if ($insertOtp) {

                $stjsd = 'Mobile is Registered but not Verified';
                
                $data['status'] = 'failure';
                $data['msg'] = $stjsd;
            }
                }
            } else {
                $data['status'] = 'failure';
                $data['msg'] = 'Email is not Registered';
            }
        } else {
            $data['status'] = 'failure';
            $data['msg'] = 'Incorrect Credentials';
        }
        
        function encrypt_decrypt($string, $action = 'encrypt')
      {
            $encrypt_method = "AES-256-CBC";
            $secret_key = 'Rsale_1_8392_KG'; // user define private key
            $secret_iv = 'vAidEerrgf5HJ5g27'; // user define secret key
            $key = hash('sha256', $secret_key);
            $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
            if ($action == 'encrypt') {
                $output = openssl_encrypt(json_encode($string), $encrypt_method, $key, 0, $iv);
                $output = base64_encode($output);
            } else if ($action == 'decrypt') {
                $output = json_decode(openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv));
            }
            return $output;
        }

echo json_encode($data);
?>