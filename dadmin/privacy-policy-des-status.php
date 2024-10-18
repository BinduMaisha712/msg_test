<?php

include('config/connection.php');
$tid=$_REQUEST['tid'];
$did=$_REQUEST['did'];
$acid=$_REQUEST['Active'];

	$query=mysqli_query($conn,"UPDATE `privacy&policy` SET `status`='$acid' WHERE id=$did");
if($query)
{ ?>

	 							 <script type='text/javascript'>
                                window.location.href ="privacy-policy-details.php?tid=<?php echo $tid; ?>";
                                 </script>
 <?php }
?>