<?php

include('config/connection.php');
$pid=$_REQUEST['pid'];
$acid=$_REQUEST['Active'];

	$query=mysqli_query($conn,"UPDATE `hot_deals_products` SET `status`='$acid' WHERE id=$pid");
if($query)
{ ?>

	<script>
   //alert("Your request successfully add");
  window.location.href="hot-deals-view.php";
	</script>
	<?php
}
?>