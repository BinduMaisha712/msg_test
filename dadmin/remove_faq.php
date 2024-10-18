<?php

include('config/connection.php');
$id=$_REQUEST['id'];
$query=mysqli_query($conn,"delete from `faq` WHERE id=$id");
if($query)
{
echo"1";
}
?>