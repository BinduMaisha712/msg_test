    <?php 
include('../config.php');
//$request = json_decode(file_get_contents('php://input'), 1);
$request = $_POST;
$response = array();
if(!empty($request['email']) && !empty($request['otp']))
{
    $get_otp = "SELECT * FROM user_tmp_table WHERE user_info = '" . $request['email'] . "' ORDER BY id DESC LIMIT 0,1";
    $get_otp_sql = mysqli_query($con, $get_otp);
    $get_otp_count = mysqli_num_rows($get_otp_sql);
    if ($get_otp_count == 1) {
        $otp_data = mysqli_fetch_array($get_otp_sql);
        if($otp_data['otp'] == $request['otp'])
        {
            $otptimeStamp = strtotime($otp_data['datentime'] . " +2 hours");
            $now = strtotime("now");
            if ($now < $otptimeStamp) {
                $update_email = "UPDATE user SET emailverified='Yes' WHERE email='" . $request['email'] . "'";
                if (mysqli_query($con, $update_email)) {
                    if(!empty($request['password']))
                    {
                        $check_mail = "SELECT * FROM user WHERE email='".$request['email']."'" ;
                    $runQuery = mysqli_query($con,$check_mail);
                    if(mysqli_num_rows($runQuery)>0){
                        $RunData = mysqli_fetch_array($runQuery);
                        $update ="UPDATE user SET password ='".md5($request['password'])."' WHERE email='".$request['email']."'" ;
                        if(mysqli_query($con,$update)){
                        $username = $RunData['firstname']." " .$RunData['lastname'];
                          $username = ucfirst($username);
                          $useremail = $RunData['email'];
                            $response = array('status'=>'success','message' => 'Your password have been Successfully updated!');
                        }
                    }else{
                        $response = array('status' => 'failure', 'message' => 'Email Not Found');
                    }
                        
                    }else{
                        $response = array('status' => 'failure', 'message' => 'Password Required');
                    }
                    
                }else{
                    $response = array('status' => 'failure', 'message' => 'Something Went Wrong');
                }
                
            }else{
                $response = array('status' => 'failure', 'message' => 'OTP Expired');
            }
            
        }else{
            $response = array('status' => 'failure', 'message' => 'Invalid OTP');
        }
        
    }else{
        $response = array('status' => 'failure', 'message' => 'Invalid OTP');
    }

}else{
    $response = array('status' => 'failure', 'message' => 'Email & OTP Required');
}
echo json_encode($response);


?>