<?php 

session_start();
$id = $_GET['t'];
$sess_arr = encrypt_decrypt($id, 'decrypt');

$agtid = $_GET['tagent'];
$sess_arr3 = encrypt_decrypt($agtid, 'decrypt');
if($sess_arr){
    //  echo 'session array';
    $sess_arr = json_decode(json_encode($sess_arr), true);
    
    $_SESSION['ismobile'] = 'yes';
    $_SESSION['loginid'] = $sess_arr['loginid'];
    $_SESSION['email'] = $sess_arr['email'];
    $_SESSION['mobile'] = $sess_arr['mobile'];
    $_SESSION['userLoginStatus'] = true;
    
    // print_r($_SESSION);
   
    header('Location: ../index.php');

}
else if ($sess_arr3){
    //  echo 'session array';
    $sess_arr3 = json_decode(json_encode($sess_arr3), true);
    
    $_SESSION['ismobile'] = 'yes';
    $_SESSION['agent_loginid'] = $sess_arr3['loginid'];
    $_SESSION['agent_email'] = $sess_arr3['email'];
    $_SESSION['agent_mobile'] = $sess_arr3['mobile'];
    $_SESSION['agentLoginStatus'] = true;

    header('Location: ../index.php');

}

else{
  header('Location: ../index.php');
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