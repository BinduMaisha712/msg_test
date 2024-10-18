<?php
include('config.php');
 function encrypt_decryptt($string, $action = 'decrypt'){
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'KJY878776hjassffsdfpopewodsf4545345'; // user define private key
        $secret_iv = 'dfhbsr5u467hfth435645'; // user define secret key
        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
        if ($action == 'encrypt') {
            $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
            $output = base64_encode($output);
        } else if ($action == 'decrypt') {
            $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
        }
    return $output;
}
$message ="";
if (isset($_POST['token'])) {
    $mobile = encrypt_decryptt($_POST['token'] ,$action = 'decrypt'); 
    $userid = encrypt_decryptt($_POST['userid'],$action = 'decrypt');
    $passw =  $_POST['passw'];
    $userid = encrypt_decryptt($_POST['userid'],$action = 'decrypt');
   	$query = "SELECT * FROM user WHERE email='".$mobile."' &&  id ='".$userid."'" ;
   	

   	$runQuery = mysqli_query($con,$query);
   	if(mysqli_num_rows($runQuery)>0){
   		$RunData = mysqli_fetch_array($runQuery);
   		$agt_id =$RunData['agt_id'];
        $agentup = "UPDATE agents SET password ='".md5($passw)."' WHERE email='".$mobile."' and id ='".$agt_id."'";
        $r23=mysqli_query($con,$agentup);
        if ($r23) {
            $affected_rows = mysqli_affected_rows($con);
        }
        
   		$update ="UPDATE user SET password ='".md5($passw)."' WHERE email='".$mobile."' &&  id ='".$userid."'" ;
   		if(mysqli_query($con,$update)){
        $username = $RunData['firstname']." " .$RunData['lastname'];
          $username = ucfirst($username);
          $useremail = $RunData['email'];
   		  $message = array('status' => 'success', 'agent' => $affected_rows, 'message' => 'Your password has been successfully updated!');
   		}

	}else{
		$message = array('status'=>'failed','message' => 'Error Occur! Please try again');
	}

	echo json_encode($message);
}



?>