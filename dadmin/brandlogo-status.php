<?php

include('config/connection.php');

$id = $_GET['id'];
$status = $_GET['status'];
	$query=mysqli_query($conn,"UPDATE `brandslogo` SET `status`='$status' WHERE  id=$id");
if($query)
{ ?>

	<script>
   //alert("Your request successfully add");
  window.location.href="view-brands-logo.php"
	</script>
	<?php
}
?>