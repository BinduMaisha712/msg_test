<?php

include('config/connection.php');
$id=$_REQUEST['said'];
$acid=$_REQUEST['Active'];
$vid=$_REQUEST['vid'];



	$query=mysqli_query($conn,"UPDATE `subcategory` SET `status`='$acid' WHERE id=$id");
if($query)
{   ?>


	<script>
   //alert("Your request successfully add");
  window.location.href="subcategory-view.php?vid=<?php echo $vid; ?>"


	</script>


<?php }

?>