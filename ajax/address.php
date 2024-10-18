<?php
require('../config.php');

$data = array();

// session_start();

if(isset($_POST['action'])){
if($_POST['action'] == 'remove'){

    $tableName= "user_shipping_addresses";
    $recordArr = array(
        "id" => $_POST['addressId'],
        "status" => 'Deleted'
    );

    if($user->save($tableName,$recordArr)){
        $data['status'] = true;
        $data['result'] = 'Address Deleted!';

    }else{
        $data['status'] = true;
        $data['result'] = 'Error Occur! Please try again';

    }
}



if($_POST['action'] == 'edit'){

    $tableName= "user_shipping_addresses";

    $checkout = new Checkout($con);

    $shippingAddress = $checkout->shippingAddressById($_POST['addressId']);
   
    $data['id'] =  $shippingAddress['id'];
    $data['type'] =  $shippingAddress['addr_type'];
    $data['firstName'] =  $shippingAddress['first_name'];
    $data['lastName'] =  $shippingAddress['last_name'];
    $data['country'] =  $shippingAddress['country'];
    $data['flat'] =  $shippingAddress['flat'];
    $data['street'] =  $shippingAddress['street'];
    $data['locality'] =  $shippingAddress['locality'];
    $data['city'] =  $shippingAddress['city'];
    $data['state'] =  $shippingAddress['state'];
    $data['zipCode'] =  $shippingAddress['zip_code'];
    $data['phone'] =  $shippingAddress['phone'];
    $data['email'] =  $shippingAddress['email'];

}
}

echo json_encode($data);

?>