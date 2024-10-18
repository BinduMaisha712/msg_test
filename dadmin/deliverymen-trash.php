<?php

include('config/connection.php');
$id=$_REQUEST['did'];

$acid=$_REQUEST['Active']; 
$trash=$_REQUEST['trash'];

	$query=mysqli_query($conn,"UPDATE `deliverymen` SET `status`='$acid', `trash`='$trash' WHERE id=$id");
        
if($query)
{
         if($trash == 'Yes'){
             echo "<script type='text/javascript'>";           
            echo "window.location.href = 'delivery-men-view.php';";
            echo "</script>";
         }else{
              echo "<script type='text/javascript'>";           
            echo "window.location.href = 'deliverymen-trash-view.php';";
            echo "</script>";
         }

}
?>
