<?php

include('config/connection.php');
$id=$_REQUEST['id'];
$acid=$_REQUEST['Active'];
$pid=$_REQUEST['pid'];

	$query=mysqli_query($conn,"UPDATE `available_place_code` SET `status`='$acid' WHERE id=$id");
if($query)
{ ?>

	 							 <script type='text/javascript'>
                                //echo "alert('Your request successfully add');";
                                window.location.href ="products-detail.php?pid=<?php echo $pid; ?>";
                                 </script>
 <?php }
?>