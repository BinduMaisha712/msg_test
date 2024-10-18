 <?php 
  include('../config.php');
  

$query = "SELECT * FROM user WHERE email='".$_POST['email']."'" ;
$passw = $_POST['password'];
$runQuery = mysqli_query($con,$query);

if(mysqli_num_rows($runQuery)>0){
    $RunData = mysqli_fetch_array($runQuery);
    $update ="UPDATE user SET password ='".md5($passw)."' WHERE email='".$_POST['email']."'" ;
    if(mysqli_query($con,$update)){
    $username = $RunData['firstname']." " .$RunData['lastname'];
      $username = ucfirst($username);
      $useremail = $RunData['email'];
        $message = array('status'=>'success','message' => 'Your password have been Successfully updated!');
    }

}else{
    $message = array('status'=>'failure','message' => 'Error Occur! Please try again');
}

echo json_encode($message);
