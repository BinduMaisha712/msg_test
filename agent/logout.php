<?php    
require('../config.php');


// Expire cache immediately
header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past

// Alternatively, you can set a future expiration date
// header("Cache-Control: max-age=3600"); // Cache for 1 hour (adjust the time as needed)

// Clear browser cache for specific pages
header("Pragma: no-cache"); // HTTP/1.0

// Clear cache for specific resources
// header("Cache-Control: no-store, must-revalidate");
// header("Expires: 0");

// Example of clearing cache for a CSS file
// header("Content-Type: text/css");

if ($_SESSION['ismobile'] != 'yes') {
    USER::logout();      
    header('location:../agent-account.php');
} else {
    USER::logout();      
    header('location:../blank.php');
}

 ?>