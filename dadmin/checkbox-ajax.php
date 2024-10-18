<?php 
include('config/connection.php');
 $cityId = $_POST['cityId'];
  $pid = $_REQUEST['pid'];
  	$sel=mysqli_query($conn,"SELECT * FROM `hot_deals_available_place` WHERE p_id=$pid AND city=$cityId");
  	if($sel_data=mysqli_num_rows($sel)>0)
  	{

  	}else{
			$ins=("INSERT INTO `hot_deals_available_place`(`p_id`, `city`) VALUES ('$pid','$cityId')");
     		$statequery=mysqli_query($conn,$ins);
 		}
	$query=mysqli_query($conn,"SELECT * FROM `zip_list` WHERE city_id = $cityId order by id asc"); 
		

       while($data=mysqli_fetch_array($query))
        {

       
        echo "<label><input type='checkbox' name='zip_code[]' value='".$data['id']."' onClick='addalldat(".$data['id'].",".$cityId.",".$pid.")'/>".$data['area_name']."(".$data['zip_code'].")</label>";

	}
?>
