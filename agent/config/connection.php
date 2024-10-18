 <?php
// $conn = mysqli_connect('localhost','root','', 'micodetest_msg_updated');

$conn = mysqli_connect('localhost','micodetest_msg_updated','_Cji4CLU@%GI', 'micodetest_msg_updated');
if (defined('BASE_URL')) {
//   define('BASE_URL', 'https://localhost/msg/');
   define('BASE_URL', 'https://micodetest.com/msg_updated/');
}

date_default_timezone_set('Asia/Kolkata');
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}
// define('BASE_URL', 'http://micodetest.com/msg_updated/');

?>