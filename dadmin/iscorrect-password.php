

<?php
    include('config/connection.php');
session_start();
$msg['message']="";
$flag=1;
$password=$_POST['pass'];
        $query = "SELECT * from admin where user_name='".$_SESSION['user']."' AND password='".$password."'";
$result = mysqli_query($conn, $query) or die(mysql_error());
if(mysqli_num_rows($result)==0)
{
$msg['message']="Incorrect Password";
$flag=0;
}
echo $flag;
//echo json_encode()

?>