<?php

include('config/connection.php');
$id=$_REQUEST['eid'];
$Active=$_REQUEST['Active'];
$trash=$_REQUEST['trash'];
$classId=$_REQUEST['classtype'];

	$query=mysqli_query($conn,"UPDATE `size_class` SET `status`='$Active', `trash`='$trash' WHERE id=$id");
if($query)
{
        if($trash == 'Yes'){
            echo "<script type='text/javascript'>";          
            echo "window.location.href = 'view-classtype-list.php?id=$classId';";
            echo "</script>";
        }else{
            echo "<script type='text/javascript'>";          
            echo "window.location.href = 'size-class-trash-view.php';";
            echo "</script>";
        }
	
}
?>
