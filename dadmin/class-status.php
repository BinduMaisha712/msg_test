<?php

include('config/connection.php');
$id=$_REQUEST['aid'];
$classId=$_REQUEST['classtype'];

$acid=$_REQUEST['Active'];

	$query=mysqli_query($conn,"UPDATE `size_class` SET `status`='$acid' WHERE id=$id");
if($query)
{

	 echo "<script type='text/javascript'>";
                                //echo "alert('Your request successfully add');";
                                echo "window.location.href = 'view-classtype-list.php?id=$classId';";
                                echo "</script>";
}
?>