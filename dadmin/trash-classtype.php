<?php
session_start();
include('config/connection.php');
$id=$_REQUEST['eid'];
$Active=$_REQUEST['Active'];
$trash=$_REQUEST['trash'];

//$acid='Inactive';

	    
        $up=("update classtype set status='$Active', `trash`='$trash' where id='$id'");
        $query=mysqli_query($conn,$up);
        if($query)
         {
          if($trash == 'Yes'){
            echo "<script type='text/javascript'>";        
            echo "window.location.href = 'view-classtype.php';";
            echo "</script>";  
          }else{
            echo "<script type='text/javascript'>";        
            echo "window.location.href = 'classtype-trash-view.php';";
            echo "</script>";  
          }
  
         }
              

?>