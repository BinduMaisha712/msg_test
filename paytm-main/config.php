<?php

$username = "root";
$password = "";
$server = "localhost";
$db = "stock_img";

$con = mysqli_connect($server, $username, $password, $db);

if (!$con) {
  die("Connection failed: " . mysqli_connect_error());
}


$base_url = "https://micodetest.com/glintz-silver/order-completed.php";
date_default_timezone_set("Asia/Kolkata");

$str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
$urltoken = substr(str_shuffle($str), 0, 40);


$token = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz'.round(microtime(true));
$userTok = substr(str_shuffle($str), 0, 24);