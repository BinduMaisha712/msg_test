<?php
session_start();
include('config/connection.php');
$id=$_REQUEST['hid'];
$type=$_REQUEST['type'];
$groupCode=$_REQUEST['product'];

$ssql=mysqli_query($conn,"select * from products where id='$id'");
$row=mysqli_fetch_assoc($ssql);
// print_r($row);
// echo $row[$type];
if($row[$type]=='Yes')
{
	$up=("update products set `$type`='No' where id='$id'");
	mysqli_query($conn,$up);
}
elseif($row[$type]=='No')
{
	$up=("update products set `$type`='Yes' where id='$id'");
	mysqli_query($conn,$up);
   $_SESSION['alert']='updated';
}
if($row[$type]=='Active')
{   
	$up=("update products set $type='Inactive' where id='$id'");
	mysqli_query($conn,$up);
   $_SESSION['alert']='updated';
}
elseif($row[$type]=='Inactive')
	{
	$query=mysqli_query($conn,"SELECT id FROM category WHERE status='Active' AND id=".$row['cat_id']);
   if(mysqli_num_rows($query)>0)
   {
	$up=("update products set $type='Active' where id='$id'");
	mysqli_query($conn,$up);
   $_SESSION['alert']='updated';
   }
   else
   {
    $_SESSION['alert']='Cannot Active First Active Category ';

   }
}
echo"<script>window.location.href='view-products-list.php?product=".$groupCode."';</script>";
