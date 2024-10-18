<?php

include('config/connection.php');
$pid=$_REQUEST['pid'];
$acid=$_REQUEST['Instock'];



	$query=mysqli_query($conn,"UPDATE `hot_deals_stock` SET `stock`='$acid' WHERE p_id=$pid");
if($query)
{   ?>


	<script>
   //alert("Your request successfully add");
  window.location.href="hot-deals-detail.php?pid=<?php echo $pid;?>"


	</script>


<?php }

?>