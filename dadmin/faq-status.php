<?php

include('config/connection.php');
$tid=$_REQUEST['tid'];
$acid=$_REQUEST['Active'];

$query=mysqli_query($conn,"UPDATE `faq_title` SET `status`='$acid' WHERE id=$tid");
if($query)
{ $query1=mysqli_query($conn,"UPDATE `faq` SET `status`='$acid' WHERE title_id=$tid");?>

	 							 <script type='text/javascript'>
                                window.location.href ="faq-view.php";
                                 </script>
 <?php }
?>