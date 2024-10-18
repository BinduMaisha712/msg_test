<?php

include('config/connection.php');
$id=$_REQUEST['id'];
$query=mysqli_query($conn,"DELETE from `metatags` WHERE id=$id");
if($query)
{
echo"1";
}
?>