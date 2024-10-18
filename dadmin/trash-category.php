<?php
session_start();
include('config/connection.php');
$id=$_REQUEST['eid'];
$Active=$_REQUEST['Active'];
$trash=$_REQUEST['trash'];

//$acid='Inactive';

if($trash=='No')
{
 $sel_query=mysqli_query($conn,"SELECT * FROM `category` WHERE cat_name=(SELECT cat_name FROM category Where id=$id) AND trash='No'");
 if(mysqli_num_rows($sel_query)>0)
 {
        $_SESSION['alert']="This Category is already added Cannot live..";
                                       //echo "<script>";
  echo "<script type='text/javascript'>";        
  echo "window.location.href = 'category-trash-view.php'";
  echo "</script>";  
    
}
else{  
  $up=mysqli_query($conn,"update category set status='$Active', `trash`='$trash' where id='$id'");
  $up1=mysqli_query($conn,"update subcategory set status='$Active', `trash`='$trash' where cat_id='$id'");
  $up2=mysqli_query($conn,"update products set status='$Active', `trash`='$trash' where cat_id='$id'");


  if($up)
  {
   
      echo "<script type='text/javascript'>";        
      echo "window.location.href = 'category-trash-view.php';";
      echo "</script>";  
    

  }
 }
}else
{
  $up=mysqli_query($conn,"update category set status='$Active', `trash`='$trash' where id='$id'");
  $up1=mysqli_query($conn,"update subcategory set status='$Active', `trash`='$trash' where cat_id='$id'");
  $up2=mysqli_query($conn,"update products set status='$Active', `trash`='$trash' where cat_id='$id'");


  if($up)
  {
echo "<script type='text/javascript'>";        
      echo "window.location.href = 'view.php';";
      echo "</script>";  

  }
}
?>