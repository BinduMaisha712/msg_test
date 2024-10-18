<?php

include('config/connection.php');
$id=$_REQUEST['aid'];

$acid=$_REQUEST['Active'];

	$query=mysqli_query($conn,"UPDATE `del_time` SET `status`='$acid' WHERE id=$id");
if($query)
{

	 echo "<script type='text/javascript'>";
                                //echo "alert('Your request successfully add');";
                                echo "window.location.href = 'view-timigs.php';";
                                echo "</script>";
}
?>