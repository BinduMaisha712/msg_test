<?php

include('config/connection.php');
$id=$_REQUEST['aid'];

$acid=$_REQUEST['Active'];

	$query=mysqli_query($conn,"UPDATE `deliverymen` SET `status`='$acid' WHERE id=$id");
if($query)
{

	 echo "<script type='text/javascript'>";
                                //echo "alert('Your request successfully add');";
                                echo "window.location.href = 'delivery-men-view.php';";
                                echo "</script>";
}
?>
