<?php 
include('config/connection.php');
 	 $cityId = $_POST['cityid'];
 	 $zipId = $_POST['zipid'];
 	 $pId = $_POST['pid'];

  $id_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$pId");
    $id_data=mysqli_fetch_array($id_query);
    $cid=$id_data['cat_id'];
     $sid=$id_data['subcat_id'];
     
      $sel=mysqli_query($conn,"SELECT * FROM `available_place_code` WHERE p_id=$pId AND z_id=$zipId");
 	 if($sel_data=mysqli_num_rows($sel)>0)
 	 {

 	 }else{

	$ins=("INSERT INTO `available_place_code`(`c_id`, `s_id`, `p_id`, `z_id`) VALUES ('$cid','$sid','$pId','$zipId')");
     $statequery=mysqli_query($conn,$ins);

}
?>
