<?php
session_start();
$loginid=$_SESSION['loginid']; 
include('config/connection.php');
date_default_timezone_set('Asia/Kolkata');
$date=date("Y-m-d");
$time=date('H:s:i');

$coupon_code = $_REQUEST['coupon_code'];

 $sel=mysqli_query($conn,"SELECT * FROM `promo_code` WHERE `code`='$coupon_code'");
if(mysqli_num_rows($sel) > 0){
 $data['status'] = 0; // This promo code already exists
 echo json_encode($data);   
}else{
   $data['status'] = 1; // not
 echo json_encode($data);    
}