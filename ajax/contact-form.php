<?php 
require('../config.php');


$data = array();
$errMessage = array();

// }
// print_r ($_POST);


////////// Add Contact Form //////////

if(($_POST['fullName'] == "")||($_POST['fullName'] == NULL)){
    $errMessage['fullName'] = 'Field Required';
}
if(($_POST['email'] == "")||($_POST['email'] == NULL)){
    $errMessage['email'] = 'Field Required';
}
if(($_POST['phone'] == "")||($_POST['phone'] == NULL)){
    $errMessage['phone'] = 'Field Required';
}
if(($_POST['subject'] == "")||($_POST['subject'] == NULL)){
    $errMessage['subject'] = 'Field Required';
}
if(($_POST['message'] == "")||($_POST['message'] == NULL)){
    $errMessage['message'] = 'Field Required';
}

if(empty($errMessage)){

    $dataArr = array(
        "name" => $_POST['fullName'],
        "email" => $_POST['email'],
        "phone" => $_POST['phone'],
        "subject" => $_POST['subject'],
        "message" => $_POST['message'],
    );


    if($user->save('contact_form',$dataArr)){
        $data['status'] = 'success';
        $data['result'] = 'Message sent!';

        }else{
            $data['status'] = 'formMsg';
            $data['result'] = 'Error Occur Please re-try again';
        }


    }else{
        $data['status'] = 'inputErr';
        $data['errMessage'] = $errMessage;
    }
////////// Add Contact Form //////////

echo json_encode($data);
?>