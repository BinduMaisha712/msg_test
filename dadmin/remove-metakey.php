<?php

include('config/connection.php');
$id=$_REQUEST['id'];
$query=mysqli_query($conn,"DELETE from `keywords` WHERE id=$id");
if($query)
{
echo"1";
}
?>