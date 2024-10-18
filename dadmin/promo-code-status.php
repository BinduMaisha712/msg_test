<?php

include('config/connection.php');
$pid=$_REQUEST['pid'];
$acid=$_REQUEST['Active'];

	$query=mysqli_query($conn,"UPDATE `promo_code` SET `status`='$acid' WHERE id=$pid");
if($query)
{ ?>

	<script>
   //alert("Your request successfully add");
  window.location.href="promo-code-view.php";
	</script>
	<?php
}
?>