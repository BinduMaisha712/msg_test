<?php

$uname = mysqli_real_escape_string($conn, $_POST['username']);
$pass = mysqli_real_escape_string($conn, $_POST['password']);
$res = mysqli_query($conn, "SELECT * FROM admin WHERE user_name='$uname' AND password='$pass'");

$found = false;

while ($data = mysqli_fetch_array($res)) {
    // if (strcmp($uname, $data['user_name']) == 0 && strcmp($pass, $data['password']) == 0) {
        $_SESSION['user'] = $uname;
        $_SESSION['user_type'] = 'admin';
        header("location:index.php");
        exit;
    // }
}

if (!$found) {
    $_SESSION['error'] = "Wrong Username or Password";
    header("location:login.php");
    exit;
}
?>
