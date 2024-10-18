<?php

class User extends Model
{

    protected $con;
    protected $id;
    protected $columnSet;
    protected $valueSet;
    protected $record;
    protected $tableName;

    public $message = array();
    public $errMessage = array();

    public function __construct($con)
    {

        $this->con = $con;
        $this->setConnection($con);
        $this->setUserId();

    }


    //Check if user is logged in
    public static function isLoggedIn()
    {

        //Return true if session has been set, false if it hasn't
        if ((isset($_SESSION['loginid'])) && ($_SESSION['loginid'] != "")) {
            return true;
        } else {
            return false;
        }

    }


    function generateRandomPassword()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    //Fetch User Header
    public function headerUser()
    {
        if (isset($_SESSION['loginid'])) {
            $query = "SELECT firstname FROM user WHERE status='Active' AND id = '" . $_SESSION['loginid'] . "'";

            return $this->getDataArray($query)[0]['firstname'];
        } else {
            return 'Login/Register';
        }
    }

    //For User Register
    //Rgister new user within database
    public function register(array $data)
    {

        // unset($this->message);
        $tableName = 'user';

        if ($this->checkEmailIdExist($data['emailId'])) {
            $this->message['status'] = 'failed';
            $this->errMessage['emailId'] = 'Email ID already Registered';

            return false;
        } else if ($this->checkMobileNumberExist($data['mobileNumber'])) {
            $this->message['status'] = 'failed';
            $this->errMessage['mobileNumber'] = 'Email already Registered';
            return false;
        } else {

            $password = md5($data['userPassword']);
            $data['userPassword'] = $password;
            if (empty($this->errMessage)) {

                $dataArr = array(
                    "role" => 'User',
                    "firstname" => (isset($data['firstName'])) ? $data['firstName'] : "",
                    "lastname" => (isset($data['lastName'])) ? $data['lastName'] : "",
                    "mobile" => $data['mobileNumber'],
                    "email" => $data['emailId'],
                    "password" => $data['userPassword'],
                    "agt_verify" => 'true',
                );
                $insert = $this->save($tableName, $dataArr);
                
                if ($insert) {

                    $this->message['status'] = 'registered';
                    $this->message['result'] = 'User registered Successfully';
                } else {
                    $this->message['status'] = 'formMsg';
                    $this->message['result'] = 'Error Occur Please re-submit the registration form';
                }
            } else {
                $this->message['status'] = 'failed';
            }
            return true;
        }
    }


    //Check if user Email exist or not
    protected function checkEmailIdExist($emailId)
    {

        $emailQuery = "SELECT id FROM user WHERE email='" . $emailId . "'";
        $emailResult = mysqli_query($this->con, $emailQuery);
        $emailNumResults = mysqli_num_rows($emailResult);

        return ($emailNumResults > 0) ? true : false;

    }

    //Check if user Mobile exist or not
    public function checkMobileNumberExist($mobileNunber)
    {

        $mobileQuery = "SELECT id FROM user WHERE email='" . $mobileNunber . "'";
        $mobileResult = mysqli_query($this->con, $mobileQuery);
        $mobileNumResults = mysqli_num_rows($mobileResult);

        return ($mobileNumResults > 0) ? true : false;

    }

    public function generateOtp($type, $userInfo, $action)
    {

         $otp = rand(1000, 9999);
        //$otp = "1234";
        $dataArr = array(
            "user_info" => $userInfo,
            "type" => $type,
            "otp" => $otp
        );

        if ($this->save('user_tmp_table', $dataArr)) {
            if ($action == 'change_pass') {
                $msg = "is your OTP to change password of your account on Organic Feeds. Do Not Share your OTP with anyone.";
            } else if ($action == 'login') {
                $msg = "is your OTP to login to your account on Organic Feeds. Do Not Share your OTP with anyone.";
            } else if ($action == 'update_address') {
                $msg = "is your OTP to update your address on Organic Feeds. Do Not Share your OTP with anyone.";
            } else {
                $msg = "is your OTP to verify your account on Organic Feeds. Do Not Share your OTP with anyone.";
            }
            return true;

        } else {
            return false;
        }
    }

    public static function sendOrderSuccessMsg($mobile_num, $orderID)
    {

        $msg = "Dear customer, your order no " . $orderID . " is Out for Delivery. To track your please visit our website " . BASE_URL . "track-order.php. Organics Feed";

        $number = '91' . $mobile_num;
        $msgs = urldecode($msg);
        $apiKey = urlencode('MzQzMzQxNjIzNzY5Njg3OTczNmQ0YzY0Mzg2MjU0MzE=');
        $numbers = array($number);
        $sender = urlencode('ORFEED');
        $message = rawurlencode($msgs);
        $numbers = implode(',', $numbers);
        $data = array('apikey' => $apiKey, 'numbers' => $numbers, "sender" => $sender, "message" => $message);
        $ch = curl_init('https://api.textlocal.in/send/');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $status = (json_decode($response));

        if ($status->status == 'success') {
            return true;
        } else {
            return false;
        }

    }





    public function verifyOtp($userInfo, $otp, $userType = NULL)
    {

        $userType = ($userType == NULL) ? 'email' : $userType;
        $query = "SELECT * FROM user_tmp_table WHERE user_info = '" . $userInfo . "' ORDER BY id DESC LIMIT 1";
        $query = mysqli_query($this->con, $query);

        $count = mysqli_num_rows($query);
        if ($count == 1) {
            $data = mysqli_fetch_array($query);

            if ($data['otp'] == $otp) {
                $otptimeStamp = strtotime($data['datentime'] . " +2 hours");
                $now = strtotime("now");
                if ($now < $otptimeStamp) {

                    $query = "UPDATE user SET emailverified='Yes' WHERE " . $userType . "='" . $userInfo . "'";
                    if (mysqli_query($this->con, $query)) {
                        $result['status'] = 'success';
                        $result['message'] = 'Your account have been Successfully verified!';

                        if ($userType == 'mobile') {
                            $query = "SELECT id,email, mobile FROM user WHERE status='Active' AND mobile = '" . $userInfo . "'";

                            //  print_r($this->getDataArray($query)); 
                            $_SESSION['loginid'] = $this->getDataArray($query)[0]['id'];
                            $_SESSION['email'] = $this->getDataArray($query)[0]['email'];
                            $_SESSION['mobile'] = $this->getDataArray($query)[0]['mobile'];
                            $_SESSION['userLoginStatus'] = true;

                            $cart = new Cart($this->con);
                            $cart->addToCartFromSession(); /////// Added all items From Session To Cart Table

                        }


                    } else {
                        $result['status'] = 'failed';
                        $result['message'] = 'Error Occur! Please try again';
                    }

                } else {
                    $result['status'] = 'failed';
                    $result['message'] = 'OTP expired!';
                }
            } else {
                $result['status'] = 'failed';
                $result['message'] = 'OTP not matched!';
            }
        } else {
            ;
            $result['status'] = 'failed';
            $result['message'] = 'OTP not matched!';
        }

        return $result;
    }
    
      public function verifyEmailOTP($userInfo, $otp, $userType=NULL){

        //$userType = ($userType==NULL)?'mobile':$userType;

        $userType = 'Email';
         $query = "SELECT * FROM user_tmp_table WHERE user_info = '".$userInfo."' ORDER BY id DESC LIMIT 1";
        $query = mysqli_query($this->con,$query);
        $count = mysqli_num_rows($query);
        if($count == 1){
            $data = mysqli_fetch_array($query);

            if($data['otp'] == $otp){
                $otptimeStamp = strtotime($data['datentime']. " +24 hours");
                $now = strtotime("now");
                 if($now<$otptimeStamp){
     
                     //$query = "UPDATE user SET mobileverified='Yes' WHERE ".$userType."='".$userInfo."'";
                     $query = "UPDATE user SET emailverified='Yes' WHERE email='".$userInfo."'";
                     if (mysqli_query($this->con,$query)) {
                         $result['status'] = 'success';
                         $result['message'] = 'Your account have been Successfully verified!';

                            //$cart->addToCartFromSession();    /////// Added all items From Session To Cart Table
                            //$wishList->addToWishListFromSession();  /////// Added all items From Session To Wishlist Table

                            /*** Write here user auto login ***/
                            $query = "SELECT id,email FROM user WHERE status='Active' AND email = '".$userInfo."'";
                            $_SESSION['loginid'] = $this->getDataArray($query)[0]['id'];
                            $_SESSION['email'] = $this->getDataArray($query)[0]['id'];
                            $_SESSION['userLoginStatus'] = true;

                             if($userType == 'mobile'){
                                 $query = "SELECT id,email FROM user WHERE status='Active' AND mobile = '".$userInfo."'";
    
                                 $_SESSION['loginid'] = $this->getDataArray($query)[0]['id'];
                                 $_SESSION['email'] = $this->getDataArray($query)[0]['id'];
                                 $_SESSION['userLoginStatus'] = true;

                                //$cart = new Cart($this->con);
                                //$cart->addToCartFromSession();    /////// Added all items From Session To Cart Table

                             }

                       }else{
                         $result['status'] = 'failed';
                         $result['message'] = 'Error Occur! Please try again';
                       }
                     
                 }else{
                     $result['status'] = 'failed';
                     $result['message'] = 'OTP expired!';
                 }
            }else{
                $result['status'] = 'failed';
                $result['message'] = 'OTP not matched!';
            }
       
        }else{
            $result['status'] = 'failed';
            $result['message'] = 'OTP not matched!';
        }

        return $result;
    }  
    

    //For login
    public function logIn(array $data)
    {

        if ($data['mobileNumber'] != "") {
            $mobileNumber = $data['mobileNumber'];
        } else {
            $this->errMessage['logInMobileNumber'] = 'Please enter email !';
        }
        if ($data['userPassword'] != "") {
            $userPassword = $data['userPassword'];
        } else {
            $this->errMessage['logInPassword'] = 'Please enter passsword!';
        }

        // echo $userPassword;
        if (empty($this->errMessage)) {

            if ($this->checkMobileNumberExist($mobileNumber)) { //// If Mobile Number is registered

                if ($this->checkMobileNumberVerifiedStatus($mobileNumber)) { //// If Mobile Number is registered and Verified 

                    // $password = md5($data['logInPassword']);
                    //Query database for info based on username or email
                    $query = "SELECT count(*) as userCount FROM user WHERE status='Active' AND email = '" . $mobileNumber . "' AND password = '" . md5($userPassword) . "' AND agt_verify='true'";
                    //    echo $query;
                    $count = $this->getDataArray($query)[0]['userCount'];

                    if ($count == 1) {
                        $query = "SELECT id,email, mobile FROM user WHERE status='Active' AND email = '" . $mobileNumber . "'";
                        $_SESSION['loginid'] = $this->getDataArray($query)[0]['id'];
                        $_SESSION['email'] = $this->getDataArray($query)[0]['email'];
                        $_SESSION['mobile'] = $this->getDataArray($query)[0]['mobile'];
                        $_SESSION['userLoginStatus'] = true;

                        $this->message['status'] = 'logIn';
                        $this->message['result'] = 'User LogIn Successfully';
                    } else {
                        $this->message['status'] = 'formMsg';
                        $this->message['result'] = 'Email or Password are Incorrect, [Agents contact Admin]'; ////// Error Occur
                    }
                } else {
                    $this->message['status'] = 'notVerified';
                    $this->message['result'] = 'Email is Registered but not Verified';
                    $this->generateOtp('email', $mobileNumber, '');
                }
            } else {
                $this->message['status'] = 'formMsg';
                $this->message['result'] = 'Email is not Registered';

            }
        } else {
            $this->message['status'] = 'failed';
        }
        return true;
    }

    //Check if user Mobile Verified Status
    protected function checkMobileNumberVerifiedStatus($mobileNunber)
    {
        $mobileQuery = "SELECT emailverified FROM user WHERE email='" . $mobileNunber . "'";
        $mobileResult = mysqli_query($this->con, $mobileQuery);
        $mobileResults = mysqli_fetch_array($mobileResult);
        return ($mobileResults['emailverified'] == 'Yes') ? true : false;
    }
    // logout
    public static function logout()
    {
        session_start();
        $_SESSION = array();
        session_destroy();
    }

    public function comparePassword($mobileNumber, $newPassword)
    {
        $query = "SELECT count(*) as userCount FROM user WHERE status='Active' AND mobile = '" . $mobileNumber . "' AND  password = '" . md5($newPassword) . "'";

        $count = $this->getDataArray($query)[0]['userCount'];
        if ($count > 0) {
            return false;
        } else {
            return true;
        }
    }


    public function generateRegisterEmailOTP($type, $userInfo, $pageName = false)
    {

       $otp = rand(1000, 9999);
       // $otp = '1234';
        $dataArr = array(
            "user_info" => $userInfo,
            "type" => $type,
            "otp" => $otp
        );

        if ($this->save('user_tmp_table', $dataArr)) {

            $msg1 = "Thank's for registration";
            $msg2 = "Use this OTP to verify your account";
            include('../emailer_html/otp.php');
               

            $EmailOTP_HTML = $content;
            sendEmail($userInfo, "Verify Your Account", $EmailOTP_HTML);
            return true;
        }

    }


    public function generateEmailForgotPasswordOTP($type, $userInfo, $pageName = false)
    {

        $otp = rand(1000, 9999);
        //$otp = '1234';
        $dataArr = array(
            "user_info" => $userInfo,
            "type" => $type,
            "otp" => $otp
        );

        if ($this->save('user_tmp_table', $dataArr)) {

            $msg1 = "Reset Password";
            $msg2 = "Use this OTP to change your password";
            if (file_exists('emailer_html/otp.php')) {
            include('emailer_html/otp.php');
            }else if(file_exists('../emailer_html/otp.php')){
                include('../emailer_html/otp.php'); 
            }
               

            $EmailOTP_HTML = $content;
            sendEmail($userInfo, "A request has been received to change the password", $EmailOTP_HTML);
            return true;
        }

    }


}
$user = new User($con);
?>