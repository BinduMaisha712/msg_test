<?php
session_start();
date_default_timezone_set('Asia/Kolkata');
// $con = mysqli_connect('localhost','root','', 'micodetest_msg_updated');
// define('BASE_URL', 'http://localhost/msg/');

$con = mysqli_connect('localhost','msgallshop_db','6PNd)H1%N6Y*', 'msgallshop_db');
define('BASE_URL', 'https://shop.msgalltrading.com/');


include('web-structure/classes/Model.php');
include('web-structure/web-structure-home/HomePage.php');
include('web-structure/web-structure-home/WishList.php');
include('web-structure/web-structure-home/Cart.php');
include('web-structure/web-structure-home/User.php');
include('web-structure/web-structure-home/Listing.php');
include('web-structure/web-structure-home/Dashboard.php');
include('web-structure/web-structure-home/Checkout.php');
include('web-structure/common_helper/core_query.php');
?>