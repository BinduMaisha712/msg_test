<?php

include('config/connection.php');
$id=$_REQUEST['id'];
$query=mysqli_query($conn,"delete from `return_exchange_desc` WHERE id=$id");
if($query)
{
echo"1";
}
?>