<?php 
require('../config.php');


$data = array();

// print_r ($_POST);

$user = new User($con);


if(isset($_POST['userInfo'])&&($_POST['userInfo']!='')){
    $user->generateRegisterEmailOTP('email', $_POST['userInfo'], '');
}
?>