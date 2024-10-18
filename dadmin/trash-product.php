<?php
session_start();
include('config/connection.php');
$id=$_REQUEST['eid'];
$Active=$_REQUEST['Active'];
$trash=$_REQUEST['trash'];
$groupCode=$_REQUEST['product'];

//$acid='Inactive';

	     $query=mysqli_query($conn,"select * From category where id=(Select c.id From category c,products p WHERE c.id=p.cat_id And p.id=$id) AND trash='No'");
       if(mysqli_num_rows($query)>0)
       {
        $up=("update products set status='$Active', `trash`='$trash' where id='$id'");
        $query=mysqli_query($conn,$up);
        if($query)
         {
          if($trash == 'Yes'){
            echo "<script type='text/javascript'>";        
            echo "window.location.href = 'view-products-list.php?product=".$groupCode."';";
            echo "</script>";  
          }else{
            echo "<script type='text/javascript'>";        
            echo "window.location.href = 'product-trash-view.php';";
            echo "</script>";  
          }
  
         }
      }
      else
      {
       $query1=mysqli_query($conn,"select * From category where id=(Select c.id From category c,products p WHERE c.id=p.cat_id And p.id=$id) AND trash='Yes'");

      if(mysqli_num_rows($query1)>0)
       {
        $_SESSION['alert']="This Product Cannot live First Live Category ..";
 
         echo "<script type='text/javascript'>";        
         echo " window.location.href = 'product-trash-view.php'";
         echo "</script>";         
       }

      }
       
        

?>