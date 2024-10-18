<?php

include('config/connection.php');
$id=$_REQUEST['id'];

$status=$_REQUEST['status'];

	$query=mysqli_query($conn,"UPDATE `headerimage` SET `status`='$status' WHERE id=$id");
if($query)
{

	 echo "<script type='text/javascript'>";
                                //echo "alert('Your request successfully add');";
                                echo "window.location.href = 'view-header-image.php';";
                                echo "</script>";
}
?>