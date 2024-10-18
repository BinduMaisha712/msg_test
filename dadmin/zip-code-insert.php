<?php 
	include('config/connection.php');
 	 $cityId = $_POST['cityid'];
 	 $zipId = $_POST['zipid'];
 	 $pId = $_POST['pid'];
 	 $sel=mysqli_query("SELECT * FROM `hot_deals_place_code` WHERE p_id=$pId AND z_id=$zipId");
 	 if($sel_data=mysqli_num_rows($sel)>0)
 	 {

 	 }else{
 	 		$ins="INSERT INTO `hot_deals_place_code`(`p_id`, `z_id`) VALUES ('$pId','$zipId')";
 	 		$query=mysqli_query($ins);
 	 	}

 	 ?>