<?php 
include('../config.php');
$userInfo = $_POST['email'];
$otp = $_POST['otp'];

$userType =  'email' ;
$query = "SELECT * FROM user_tmp_table WHERE user_info = '" . $userInfo . "' ORDER BY id DESC LIMIT 0,1";
$query = mysqli_query($con, $query);

$count = mysqli_num_rows($query);
if ($count == 1) {
    $data = mysqli_fetch_array($query);

    if ($data['otp'] == $otp) {
        $otptimeStamp = strtotime($data['datentime'] . " +2 hours");
        $now = strtotime("now");
        if ($now < $otptimeStamp) {

            $query = "UPDATE user SET emailverified='Yes' WHERE " . $userType . "='" . $userInfo . "'";
            if (mysqli_query($con, $query)) {
               
                $result['status'] = 'success';
                $result['msg'] = 'Your account has been Successfully verified!';

                    $query = "SELECT id,email, mobile FROM user WHERE status='Active' AND email = '" . $userInfo . "' AND role='User'";
                    
                 $userData = mysqli_fetch_assoc(mysqli_query($con, $query));
                //  print_r($userData);
                     $userdata2 = [
                        'userLoginStatus' => true,
                        'loginid' => $userData['id'],
                        'email' => $userData['email'],
                        'mobile' => $userData['mobile'],
                    ];
           
                    $directLogin = 'https://micodetest.com/msg_updated/api/login-token.php?t='.encrypt_decrypt($userdata2);
                    $result['url'] = $directLogin;
                        
            } else {
                $result['status'] = 'failure';
                $result['msg'] = 'Error Occur! Please try again';
            }

        } else {
            $result['status'] = 'failure';
            $result['msg'] = 'OTP expired!';
        }
    } else {
        $result['status'] = 'failure';
        $result['msg'] = 'OTP not matched!';
    }
} else {
    ;
    $result['status'] = 'failure';
    $result['msg'] = 'OTP not matched!';
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

echo json_encode($result);