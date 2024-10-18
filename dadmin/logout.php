
<?php    
session_start();
 $ses=$_SESSION['user'];    
 unset($_SESSION['user']);       
 header('location:login.php');  
 ?>