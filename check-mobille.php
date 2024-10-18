<?php
require('config.php');
$user = new User($con);
if (isset($_POST['mobile'])) {
		$mobile = $_POST['mobile'];
		$query = "SELECT * FROM user where email = '$mobile'";
		$runquery = mysqli_query($con,$query);
		if(mysqli_num_rows($runquery)>0){
			$Rundata = mysqli_fetch_array($runquery);

			
				$sendotp = $user->generateEmailForgotPasswordOTP('Mobile',$mobile);
				$responsemsg = sendForgetOTP($con, $mobile);
				if($sendotp==true){
					$array = array('status'=>"sendopt",'msg'=>"",'varifistatus'=>"mobile_varified");
				}
			
		}else{
			$array = array('status'=>'notregisterd','msg'=>"<span style='color:red;'>Account not exists. <a href= 'account.php' style='color:blue;' >Please register</a></span.");
		}

		echo json_encode($array);
}

?>