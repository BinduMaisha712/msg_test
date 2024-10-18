<?php
include('config.php');

if (isset($_POST['token'])) {

    $userid = $_POST['userid'];
    $mobile = $_POST['mobile'];
    $passw =  $_POST['passw'];

   	$query = "SELECT * FROM user WHERE mobile='".$mobile."' &&  id ='".$userid."'" ;

   	$runQuery = mysqli_query($con,$query);
   	if(mysqli_num_rows($runQuery)>0){
   		$RunData = mysqli_fetch_array($runQuery);
   		$update ="UPDATE user SET password ='".md5($passw)."' WHERE mobile='".$mobile."' &&  id ='".$userid."'" ;
   		if(mysqli_query($con,$update)){
        $username = $RunData['firstname']." " .$RunData['lastname'];
          $username = ucfirst($username);
          $useremail = $RunData['email'];
   			$message = array('status'=>'success','message' => 'Your password have been Successfully updated!');
   		}

	}else{
		$message = array('status'=>'failed','message' => 'Error Occur! Please try again');
	}

	echo json_encode($message);
}



?>