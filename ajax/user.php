<?php require('../config.php');
//include('../web-structure/common_helper/core_query.php');

function encrypt_decryptt($string, $action = 'decrypt')
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'KJY878776hjassffsdfpopewodsf4545345'; // user define private key
    $secret_iv = 'dfhbsr5u467hfth435645'; // user define secret key
    $key = hash('sha256', $secret_key);
    $iv = substr(hash('sha256', $secret_iv), 0, 16); // sha256 is hash_hmac_algo
    if ($action == 'encrypt') {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if ($action == 'decrypt') {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}


$data = array();
$inputErr = array();
// }
// print_r ($_POST);

$user = new User($con);


////////// Sign Up //////////
$t = 0;
if (isset($_POST['register'])) {
    
    $username = $_POST['mobileNumber'];
    $emailId = $_POST['emailId'];
    $check = "SELECT * FROM user WHERE email ='$emailId' || mobile = '$username' ";
    $runcheck = mysqli_query($con, $check);

    if ($user->register($_POST)) {

        //     echo 'status
        $user->generateRegisterEmailOTP('email', $_POST['emailId'], '');
       // print_r($user->message);exit;
        $responsemsg = sendWelcomeOTP($con, $emailId);
        echo $responsemsg;
        if ($user->message['status'] == 'registered ') {

            $data = $user->message;
            $data["result"] = $user->message->result;


            if (isset($_SESSION['tmp_user_lname'])) {
                unset($_SESSION['tmp_user_lname']);
            }
            if (isset($_SESSION['tmp_user_fname'])) {
                unset($_SESSION['tmp_user_fname']);
            }
            if (isset($_SESSION['tmp_user_email'])) {
                unset($_SESSION['tmp_user_email']);
            }
        } else {
            $data = $user->message;
            $data["result"] = $user->errMessage;
        }
    } else {
        $data = $user->message;
        $data["errMessage"] = $user->errMessage;
    }
    $data['emailId'] = $_POST['emailId'];
    
}
////////// Sign Up //////////

//For login
////////// Log IN //////////
if (isset($_POST['logIn'])) {

    if (isset($_POST["remember"])) {
        if (($_POST["remember"]) == 'on') {
            setcookie("username", $_POST["logInMobileNumber"], time() + 3600, "/");
            setcookie("password", $_POST["logInPassword"], time() + 3600, "/");
        } else {
            setcookie("username", "");
            setcookie("password", "");
        }
    }

    $tempArr = array(
        "mobileNumber" => $_POST['logInMobileNumber'],
        "userPassword" => $_POST['logInPassword']
    );

    if ($_POST['logInPassword'] == "LogInWithOTP") {
        if ($user->checkMobileNumberExist($_POST['logInMobileNumber'])) {
            if ($user->generateOtp('mobile', $_POST['logInMobileNumber'], 'login')) {
                $data['status'] = 'otpSent';
                $data['result'] = 'OTP Sent!';
            }
        } else {
            $data['status'] = 'formMsg';
            $data['result'] = 'Mobile number not registred!';
        }
    } else {
        if ($user->logIn($tempArr)) {
            if ($user->message['status'] == 'logIn') {

                $cart->addToCartFromSession();   /////// Added all items From Session To Cart Table
                $wishList->addToWishListFromSession();  /////// Added all items From Session To Wishlist Table
                $data = $user->message;
            } else {
                $data = $user->message;
                $data["errMessage"] = $user->errMessage;
            }
        } else {
            $data = $user->message;
            $data["errMessage"] = $user->errMessage;
        }
    }

    $data['mobileNumber'] = $_POST['logInMobileNumber'];
}
////////// Log IN //////////

////////// Change Password //////////
if (isset($_POST['changePassword'])) {
    // print_r($_POST);
    $data['mobileNumber'] = $_POST['userInfo'];
    if ($user->comparePassword($_POST['userInfo'], $_POST['newPassword'])) {
        $mobile = $_POST['userInfo'];

        $currentPass = mysqli_fetch_assoc(mysqli_query($con, "SELECT password FROM user WHERE email = '$mobile'"))['password'];


       
        if (md5($_POST['currentPassword']) == $currentPass) {
            if($_POST['confirmNewPassword'] == $_POST['newPassword']){
                $otp = $user->generateEmailForgotPasswordOTP('email', $_POST['userInfo'], 'change_pass');
                $data['status'] = 'otpSent';
                $data['result'] = 'OTP Sent!';
            }
            else{
                $data['status'] = 'otpNotSent';
                $data['result'] = 'Password and Confirm Password do not match.';
            }
        } else {
            $data['status'] = 'formMsg';
            $data['result'] = 'Current password is incorrect.';
        }
    } else {
        $data['status'] = 'formMsg';
        $data['result'] = 'Not use your current Password as new Password!';
    }
}
////////// Change Password //////////

////////// Edit Profile //////////
if (isset($_POST['editProfile'])) {

    if ($_POST['firstName'] == '') {
        $inputErr['firstName'] = 'Field Required';
    }
    if ($_POST['lastName'] == '') {
        $inputErr['lastName'] = 'Field Required';
    }
    if (!isset($_POST['gender'])) {
        $inputErr['gender'] = 'Please Select Gender';
    }
    if (!isset($_POST['addressType'])) {
        $inputErr['addressType'] = 'Please Select Address Type';
    }
    if ($_POST['addressFlat'] == '') {
        $inputErr['addressFlat'] = 'Field Required';
    }
    if ($_POST['addressStreet'] == '') {
        $inputErr['addressStreet'] = 'Field Required';
    }
    // if ($_POST['addressLocality'] == '') {
    //     $inputErr['addressLocality'] = 'Field Required';
    // }
    if ($_POST['addressCountry'] == '') {
        $inputErr['addressCountry'] = 'Field Required';
    }
    if ($_POST['addressState'] == '') {
        $inputErr['addressState'] = 'Field Required';
    }
    if ($_POST['addressCity'] == '') {
        $inputErr['addressCity'] = 'Field Required';
    }
    if ($_POST['addressZipCode'] == '') {
        $inputErr['addressZipCode'] = 'Field Required';
    }

    if (empty($inputErr)) {
        $dataArr = array(
            "id" => $_POST['userId'],
            "firstname" => $_POST['firstName'],
            "lastname" => $_POST['lastName'],
            "gender" => $_POST['gender'],
            "addr_type" => $_POST['addressType'],
            "flat" => $_POST['addressFlat'],
            "street" => $_POST['addressStreet'],
            "locality" => $_POST['addressLocality'],
            "country" => $_POST['addressCountry'],
            "state" => $_POST['addressState'],
            "city" => $_POST['addressCity'],
            "zipcode" => $_POST['addressZipCode']
        );

        if ($user->save('user', $dataArr)) {
            $data['action'] = 'addressFormSubmit';
            $data['status'] = 'success';
            $data['result'] = 'Information Updated Successfully';
        } else {
            $data['status'] = 'formMsg';
            $data['result'] = 'Error Occur Please re-try again';
        }
    } else {
        $data['status'] = 'failed';
        $data['errMessage'] = $inputErr;
    }
}
////////// Edit Profile //////////

////////// Update Address //////////
if (isset($_POST['updateAddress'])) {
    if (!isset($_POST['newAddressType'])) {
        $inputErr['newAddressType'] = 'Please Select Address Type';
    }
    if ($_POST['newAddressFirstName'] == '') {
        $inputErr['newAddressFirstName'] = 'Field Required';
    }
    if ($_POST['newAddressLastName'] == '') {
        $inputErr['newAddressLastName'] = 'Field Required';
    }
    if ($_POST['newAddressFlat'] == '') {
        $inputErr['newAddressFlat'] = 'Field Required';
    }
    if ($_POST['newAddressStreet'] == '') {
        $inputErr['newAddressStreet'] = 'Field Required';
    }
    // if($_POST['newAddressLocality']==''){
    //     $inputErr['newAddressLocality'] = 'Field Required';
    // }
    if ($_POST['newAddressCountry'] == '') {
        $inputErr['newAddressCountry'] = 'Field Required';
    }
    if ($_POST['newAddressState'] == '') {
        $inputErr['newAddressState'] = 'Field Required';
    }
    if ($_POST['newAddressCity'] == '') {
        $inputErr['newAddressCity'] = 'Field Required';
    }
    if ($_POST['newAddressZipCode'] == '') {
        $inputErr['newAddressZipCode'] = 'Field Required';
    }
    if ($_POST['newAddressEmail'] == '') {
        $inputErr['newAddressEmail'] = 'Field Required';
    }
    if ($_POST['newAddressMobile'] == '') {
        $inputErr['newAddressMobile'] = 'Field Required';
    }

    if (empty($inputErr)) {
        if (isset($_POST['shippingAddress']) && $_POST['shippingAddress'] == "edit") {
            //  print_r($_POST);
            //  exit();
            $dataArr = [
                "id" => $_POST['shippingAddressId'],
                "user_id" => $_SESSION['loginid'],
                "first_name" => $_POST['newAddressFirstName'],
                "last_name" => $_POST['newAddressLastName'],
                "addr_type" => $_POST['newAddressType'],
                "flat" => $_POST['newAddressFlat'],
                "street" => $_POST['newAddressStreet'],
                "locality" => $_POST['newAddressLocality'] ?? '',
                "country" => $_POST['newAddressCountry'],
                "state" => $_POST['newAddressState'],
                "city" => $_POST['newAddressCity'],
                "zip_code" => $_POST['newAddressZipCode'],
                "phone" => $_POST['newAddressMobile'],
                "email" => $_POST['newAddressEmail'],
            ];
        } else {

            $dashboard = new Dashboard($con);
            $userData = $dashboard->getUserDetail();

            if (empty($userData['flat']) && empty($userData['street']) && empty($userData['locality']) && empty($userData['city']) && empty($userData['zipcode']) && empty($userData['state']) && empty($userData['country'])) {

                //user details
                $tempArr = array(
                    "id" => $_SESSION['loginid'],
                    "addr_type" => $_POST['newAddressType'],
                    "flat" => $_POST['newAddressFlat'],
                    "street" => $_POST['newAddressStreet'],
                    "locality" => $_POST['newAddressLocality'],
                    "country" => $_POST['newAddressCountry'],
                    "state" => $_POST['newAddressState'],
                    "city" => $_POST['newAddressCity'],
                    "zipcode" => $_POST['newAddressZipCode']
                );

                $user->forcedInsert('user', $tempArr); ///// Update User table Address Details
            }

            $dataArr = [
                "user_id" => $_SESSION['loginid'],
                "first_name" => $_POST['newAddressFirstName'],
                "last_name" => $_POST['newAddressLastName'],
                "addr_type" => $_POST['newAddressType'],
                "flat" => $_POST['newAddressFlat'],
                "street" => $_POST['newAddressStreet'],
                "locality" => $_POST['newAddressLocality'] ?? '',
                "country" => $_POST['newAddressCountry'],
                "state" => $_POST['newAddressState'],
                "city" => $_POST['newAddressCity'],
                "zip_code" => $_POST['newAddressZipCode'],
                "phone" => $_POST['newAddressMobile'],
                "email" => $_POST['newAddressEmail'],
            ];
        }
        //  print_r($user->save('user_shipping_addresses',$dataArr));
        //  exit();
        if ($user->save('user_shipping_addresses', $dataArr)) {
            $data['status'] = 'success';
            $data['result'] = 'Address Added Successfully';
        } else {
            $data['status'] = 'formMsg';
            $data['result'] = 'Error Occur Please re-try again';
        }
    } else {
        $data['status'] = 'failed';
        $data['errMessage'] = $inputErr;
    }
}
////////// Update Address //////////

if (isset($_POST['action']) && $_POST['action'] == 'sendNewOtp') {
    $mobile = $_POST['mobile'];
    $checkMobile = mysqli_num_rows(mysqli_query($con, "SELECT * FROM user WHERE mobile = '$mobile'"));
    if ($checkMobile > 0) {
        $data['status'] = false;
        $data['msg'] = 'Mobile Number Already Exists.';
    } else {
        // send otp 
        if ($user->generateOtp('mobile', $_POST['mobile'], 'update_address')) {
            $data['status'] = true;
            $data['msg'] = 'OTP Sent';
        } else {
            $data['status'] = false;
            $data['msg'] = 'Could not send otp';
        };
    }
}

if (isset($_POST['url'])) {
    $data['url'] = $_POST['url'];
} else {
    $data['url'] = 'reload';
}

if (isset($_POST['contact'])) {
    $fName = $_POST['fName'];
    $lName = $_POST['lName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $msg = $_POST['msg'];
    $datetime = date('Y-m-d H:i:s');

    $insertQuery = mysqli_query($con, "INSERT INTO `user_queries`( `first_name`, `last_name`, `email`, `phone`, `msg`, `date_time`) VALUES ('$fName','$lName','$email','$phone','$msg', '$datetime')");

    if ($insertQuery) {
        $data['status'] = true;
        $data['msg'] = 'Thanks for contacting us! We will be in touch with you shortly.';

        // sendmail 

        $info = 'Your Message';
        $greeting = "Hi " . $fName . " " . $lName . ",";
        $heading = 'Thank you for reaching out. We will be in touch with you shortly';
        $queryl = 'select * from `logo` where id="1"';
        $queryll = mysqli_query($con, $queryl);
        $results = mysqli_fetch_array($queryll);
        $logo = BASE_URL . 'asset/image/logo/' . $results['logo'];
        include('../emailer_html/user/query.php');

        sendEmail($email, "Message sent to Organics Feed", $content);

        //   $mail->AddAddress($email, $fName . ' ' . $lName);
        //   $mail->Subject = "Message sent to Organics Feed";
        //   $mail->MsgHTML($content);
        //   $mail->send();   


        // sendmail to admin
        $adminEmail = mysqli_fetch_assoc(mysqli_query($con, "SELECT email FROM footer"))['email'];
        $info = 'Message';
        $greeting = '';
        $heading = $fName . " " . $lName . ' sent a message on Organic Feeds';
        $queryl = 'select * from `logo` where id="1"';
        $queryll = mysqli_query($con, $queryl);
        $results = mysqli_fetch_array($queryll);
        $logo = BASE_URL . 'asset/image/logo/' . $results['logo'];
        include('../emailer_html/user/query.php');

        sendEmail($adminEmail, "Recieved a message from " . $fName . " " . $lName, $content);

        //  $mail->AddAddress($adminEmail, $fName . ' ' . $lName);
        //  $mail->Subject = "Recieved a message from " . $fName . " " . $lName;
        //  $mail->MsgHTML($content);
        //  $mail->send();  

    } else {
        $data['status'] = false;
        $data['msg'] = 'Sorry! could not send your query. Please try again later.';
    }
}

$data['fName'] = $user->headerUser();

echo json_encode($data);
