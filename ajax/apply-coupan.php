<?php
require('../config.php');
$checkout = new Checkout($con);

$data = array();

// session_start();


if($_POST['coupanCode']){
  
    $checkout->setCoupan($_POST['coupanCode']);
    $data = $checkout->coupan();
}

echo json_encode($data);

?>