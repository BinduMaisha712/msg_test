<?php

include('config/connection.php');
$tid=$_REQUEST['tid'];
$did=$_REQUEST['did'];
$acid=$_REQUEST['Active'];

	$query=mysqli_query($conn,"UPDATE `faq` SET `status`='$acid' WHERE id=$did");
if($query)
{ ?>

	 							 <script type='text/javascript'>
                                window.location.href ="faq-details.php?tid=<?php echo $tid; ?>";
                                 </script>
 <?php }
?>