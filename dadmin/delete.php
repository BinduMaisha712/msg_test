<?php include('includes/header.php'); ?>

<?php

$id = $_GET['id'];

$query = mysqli_query($conn,"DELETE FROM `brandslogo` WHERE id='$id' ");

if($query)
{


echo "<script type='text/javascript'>";
echo "window.location.href = 'view-brands-logo.php';";
echo "</script>";
}

?>
 <?php include('includes/footer.php'); ?>