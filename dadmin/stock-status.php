<?php

include('config/connection.php');
if(empty($_REQUEST['vpid'])){
$pid=$_REQUEST['pid'];
$acid=$_REQUEST['Instock'];
$query=mysqli_query($conn,"SELECT * FROM stock WHERE p_id=$pid");
$data=mysqli_fetch_array($query);
	$cid=$data['c_id'];
	$sid=$data['s_id'];



	$query=mysqli_query($conn,"UPDATE `stock` SET `stock`='$acid' WHERE p_id=$pid");
if($query)
{   ?>


	<script>
   //alert("Your request successfully add");
  window.location.href="products-detail.php?pid=<?php echo $pid;?>"


	</script>


<?php }
}
else{
	$pid=$_REQUEST['pid'];
	$acid=$_REQUEST['Instock'];
	$vpid=$_REQUEST['vpid'];
	$query=mysqli_query($conn,"UPDATE `stock` SET `stock`='$acid' WHERE p_id=$pid");
if($query)
{   ?>


	<script>
   //alert("Your request successfully add");
  window.location.href="vendor-products-detail.php?pid=<?php echo $vpid;?>"


	</script>


<?php }

}

?>