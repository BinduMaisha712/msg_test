<?php
require('../config.php');
$checkout = new Checkout($con);


 $data = $checkout->removecoupon();
     echo json_encode($data);


?>