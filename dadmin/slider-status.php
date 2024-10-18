<?php

include('config/connection.php');
$id=$_REQUEST['sid'];

$acid=$_REQUEST['Active'];

	$query=mysqli_query($conn,"UPDATE `slider` SET `status`='$acid' WHERE id=$id");
if($query)
{

	 echo "<script type='text/javascript'>";
                                //echo "alert('Your request successfully add');";
                                echo "window.location.href = 'slider-view.php';";
                                echo "</script>";
}
?>