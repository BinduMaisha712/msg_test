<?php

include('config/connection.php');
$id=$_REQUEST['aid'];

$acid=$_REQUEST['Active'];

	$query=mysqli_query($conn,"UPDATE `category` SET `status`='$acid' WHERE id=$id");
	$query1=mysqli_query($conn,"UPDATE `products` SET `status`='$acid' WHERE cat_id=$id");
if($query)
{

	 echo "<script type='text/javascript'>";
                                //echo "alert('Your request successfully add');";
                                echo "window.location.href = 'view.php';";
                                echo "</script>";
}
?>