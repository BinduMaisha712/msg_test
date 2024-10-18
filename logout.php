<?php  

require('config.php');

if ($_SESSION['ismobile'] != 'yes') {
    USER::logout();      
    header('location:index.php');
} else {
    USER::logout();
    header('location:blank.php');
}

 ?>