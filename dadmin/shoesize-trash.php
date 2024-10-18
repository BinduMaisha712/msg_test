<?php

include('config/connection.php');
$id=$_REQUEST['eid'];
$Active=$_REQUEST['Active'];
$trash=$_REQUEST['trash'];

	$query=mysqli_query($conn,"UPDATE `size_class` SET `status`='$Active', `trash`='$trash' WHERE id=$id");
if($query)
{
        if($trash == 'Yes'){
            echo "<script type='text/javascript'>";          
            echo "window.location.href = 'view-classtype-list.php?id=4';";
            echo "</script>";
        }else{
            echo "<script type='text/javascript'>";          
            echo "window.location.href = 'shoesize-class-trash-view.php';";
            echo "</script>";
        }
	
}
?>