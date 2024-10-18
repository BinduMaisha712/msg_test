<?php
require('../config.php');
// include('../sendmail.php');

$data = array();
// session_start();
$otp="";
 
if(!isset($_POST['userInfo'])){
    $_POST['userInfo'] = $_POST['mobile'];
}
if(!isset($_POST['otp'])){
    $_POST['otp'] = $_POST['otpmobile'];
}
if($_POST['userInfo']){

    if((isset($_POST['otp']))&&!empty($_POST['otp'])){
       
        $otps=$_POST['otp'];
      foreach($otps as $ot){
            $otp .= $ot; 
        }

      

    }
    // print_r($_POST);
    $verifyOtp = $user->verifyOtp($_POST['userInfo'],$otp);
    // print_r($verifyOtp); echo 'fdsf' ; die();

  if($verifyOtp['status'] == 'success'){

    // change password 
    // print_r($_POST);
    
        $newPass = md5($_POST['newPassword']);
        $mobile = $_POST['userInfo'];

        $updatePass = mysqli_query($con, "UPDATE user SET password = '$newPass' WHERE email = '$mobile'");
     
        if($updatePass){
           $data['message'] = 'Password changed Successfully';
           $data['status'] = true;
        }
        else{
            $data['message'] = 'Could not change password';
            $data['status'] = false;
        }


        // $mobile = $_POST['userInfo'];
        // $user = mysqli_fetch_assoc(mysqli_querY($con, "SELECT * FROM user WHERE mobile ='$mobile'"));
        // $fName = $user['firstname'];
        // $lName = $user['lastname'];

        // $email = $user['email'];
        // $username = $fName . ' ' . $lName;

        //send mail 
        // include('../emailer_html/user/index.php');
        // $mail->AddAddress($email, $username);
        // $mail->Subject = "Password Changed Successfully";
        // $mail->MsgHTML($content);
        // $mail->send();
        
    }else{
        $data['message'] = 'Incorrect OTP';
        $data['status'] = false;
    }

    // print_r($data);
// exit();
}
$data['redirect']= 0;
if(isset($_POST['url'])){
    $data['redirect']= 1;
    $data['url']=$_POST['url'];
}else{
    $data['redirect']= 0;
    
}
// echo 'data ';
// print_r($data);
echo json_encode($data);
