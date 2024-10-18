<?php

include('config/connection.php');
$id=$_REQUEST['id'];

$acid=$_REQUEST['Active'];
$flag=0;
	$query=mysqli_query($conn,"UPDATE `social_media` SET `status`='$acid' WHERE id=$id");
if($query)
{

	$flag=1;
}
echo $flag;
?>