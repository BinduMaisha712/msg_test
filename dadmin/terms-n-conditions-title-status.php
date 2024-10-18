<?php

include('config/connection.php');
$tid=$_REQUEST['tid'];
$acid=$_REQUEST['Active'];

$query=mysqli_query($conn,"UPDATE `terms&conditions_title` SET `status`='$acid' WHERE id=$tid");
if($query)
{ 
    $query1=mysqli_query($conn,"UPDATE `terms&condition` SET `status`='$acid' WHERE title_id=$tid");?>
<script type='text/javascript'>
window.location.href ="terms-n-conditions-view.php";
 </script>
 <?php }
?>