<?php
require('../config.php');

$data = array();

// session_start();
$otp="";
// print_r($_POST);
// exit();
if($_POST['userInfo']){
    if((isset($_POST['otp']))&&!empty($_POST['otp'])){
        $otps=$_POST['otp'];
        foreach($otps as $ot){
            $otp .= $ot;
        }
    } else {

    }
    $verifyOtp = $user->verifyEmailOTP($_POST['userInfo'], $otp);
    try {
        if (!is_null($verifyOtp) && isset($verifyOtp['status']) && $verifyOtp['status'] == 'success') {
            $cart->addToCartFromSession(); /////// Added all items From Session To Cart Table
            $wishList->addToWishListFromSession(); /////// Added all items From Session To Wishlist Table
        }
    } catch (\Exception $e) {

    }
    if ($verifyOtp == 'success') {
        $data = $verifyOtp;
    } else {
        $data = $verifyOtp;
    }
}
$data['redirect']= 0;
if(isset($_POST['url'])){
    $data['redirect']= 1;
    $data['url']=$_POST['url'];
} else{
    $data['redirect']= 0;
}
echo json_encode($data);
?>