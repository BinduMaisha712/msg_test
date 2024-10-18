<?php

include('config/connection.php');
$id=$_REQUEST['sid'];
$pid=$_REQUEST['pid'];

$acid=$_REQUEST['Active'];

	$query=mysqli_query($conn,"UPDATE `special_image` SET `status`='$acid' WHERE id=$id");
if($query)
{

	 echo "<script type='text/javascript'>";
                                //echo "alert('Your request successfully add');";
                                echo "window.location.href = 'special-products-view.php?id=$pid';";
                                echo "</script>";
}
?>