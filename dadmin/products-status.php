<?php

include('config/connection.php');
if(!empty($_REQUEST['cid']))
{
$pid=$_REQUEST['pid'];
$cid=$_REQUEST['cid'];
$sid=$_REQUEST['sid'];
$acid=$_REQUEST['Active'];

	$query=mysqli_query($conn,"UPDATE `products` SET `status`='$acid' WHERE id=$pid");
	if($query)
	{ ?>

		<script>
	   //alert("Your request successfully add");
	  window.location.href="products-view.php?cid=<?php echo $cid; ?>&sid=<?php echo $sid; ?>"
		</script>
		<?php
	}
}else{
	$pid=$_REQUEST['pid'];
	$acid=$_REQUEST['Active'];
	$vpid=$_REQUEST['vpid'];
	$query=mysqli_query($conn,"UPDATE `products` SET `status`='$acid' WHERE id=$pid");
	if($query)
	{ ?>

		<script>
	   //alert("Your request successfully add");
	  window.location.href="vendor-products-detail.php?pid=<?php echo $vpid; ?>"
		</script>
		<?php
	}
}

?>