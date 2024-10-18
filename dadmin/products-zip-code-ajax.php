<?php 
include('config/connection.php');
 $cityId = $_POST['cityId'];
  $pid = $_REQUEST['pid'];
   $id_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$pid");
    $id_data=mysqli_fetch_array($id_query);
    $cid=$id_data['cat_id'];
     $sid=$id_data['subcat_id'];
$sel=mysqli_query($conn,"SELECT * FROM `available_place` WHERE p_id=$pid AND city=$cityId");
    if($sel_data=mysqli_num_rows($sel)>0)
    {

    }else{
          $ins=("INSERT INTO `available_place`(`c_id`, `s_id`, `p_id`, `city`) VALUES ('$cid','$sid','$pid','$cityId')");
          $statequery=mysqli_query($conn,$ins);
        }
          $query=mysqli_query($conn,"SELECT * FROM `zip_list` WHERE city_id = $cityId order by id asc"); 
		

       while($data=mysqli_fetch_array($query))
        {

       
        echo "<label><input type='checkbox' name='zip_code[]' value='".$data['id']."' onClick='addalldat(".$data['id'].",".$cityId.",".$pid.")'/>".$data['area_name']."(".$data['zip_code'].")</label>";

	}
?>
