<?php session_start();
include('config/connection.php');

$msg['message']="";
$flag=1;
$password = md5($_POST['pass']);
$wuser = $_POST['wuser']; // Retrieve the session value
$query = "SELECT * from agents where email ='" . $wuser . "' AND password='".$password."'";
// $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from agents where email ='" . $wuser . "'"))['password'];
// print_r($query);die;
$result = mysqli_query($conn, $query) or die(mysql_error());
if(mysqli_num_rows($result)==0) {
    $msg['message']="Incorrect Password";
    $flag=0;
}
echo $flag;
?>