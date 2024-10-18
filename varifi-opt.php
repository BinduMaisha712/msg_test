<?php

include('config.php');
$user = new User($con);

if(isset($_POST['mobile'])){
    // print_r($_POST);
	$mobile = $_POST['mobile'];
	$mobiletype= "mobile";
	$otp = $_POST['otpmobile'];
	
	$query = "SELECT * FROM user_tmp_table WHERE user_info = '".$mobile."' ORDER BY id DESC LIMIT 1";
    $query = mysqli_query($con,$query);
    $count = mysqli_num_rows($query);
    if($count == 1){

    	$data = mysqli_fetch_array($query);
    	if($data['otp'] == $otp){
    		 $otptimeStamp = strtotime($data['datentime']. " +2 hours");
             $now = strtotime("now");
            //  if($now<$otptimeStamp){
             	  $query = "UPDATE user SET emailverified='Yes' WHERE email='".$mobile."'";
                 
             	if (mysqli_query($con,$query)) {
             		$getdata = "SELECT * FROM user WHERE email='".$mobile."'";
             			$Runquery = mysqli_query($con,$getdata);
             			$RunData = mysqli_fetch_array($Runquery);
             			$userid = $RunData['id'];
                        $username = $RunData['firstname']." " .$RunData['lastname'];
                        $username = ucfirst($username);
                        $useremail = $RunData['email'];
             			$toke= encrypt_decryptt($mobile, $action = 'encrypt');
             			$useid = encrypt_decryptt($userid, $action = 'encrypt');


             			$message = array('status'=>'success','message' => 'Your account have been Successfully verified!','tokenmob'=>$toke,'tokentwo'=>$useid);
                       }else{
                       
                       	$message = array('status'=>'failed','message' => "<span style='color:red;'>Error Occur! Please try again</span>");
                       }
            //  }else{
            //  		$message = array('status'=>'failed','message' => "<span style='color:red;'>OTP expired!</span>");
            //  }
    	}
    	else{
             		$message = array('status'=>'failed','message' => "<span style='color:red;'>OTP not matched!</span>");
                    
             }

    }
    else{
             		$message = array('status'=>'failed','message' => "<span style='color:red;'>OTP not matched!</span>");
                    
        }
         echo json_encode($message);

}

     function encrypt_decryptt($string, $action = 'encrypt'){
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

?>