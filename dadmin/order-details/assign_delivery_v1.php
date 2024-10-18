 <?php
// $conn = mysqli_connect('localhost','root','', 'micodetest_msg_updated');

$con = mysqli_connect('localhost','micodetest_msg_updated','_Cji4CLU@%GI', 'micodetest_msg_updated');
if (defined('BASE_URL')) {
//   define('BASE_URL', 'https://localhost/msg/');
   define('BASE_URL', 'https://micodetest.com/msg_updated/');
}

date_default_timezone_set('Asia/Kolkata');
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}

// define('BASE_URL', 'http://localhost/msg/');

?>
<?php

// if (isset($reAssignDelivery) && $reAssignDelivery) {
//     $productsLength = $productsDimensions['length'];
//     $productsHeight = $productsDimensions['height'];
//     $productsWidth = $productsDimensions['width'];
//     $productsWeight = $productsDimensions['weight'];
// } else {
//     $productsLength = $_POST['length'];
//     $productsHeight = $_POST['height'];
//     $productsWidth = $_POST['breadth'];
//     $productsWeight = $_POST['weight'];
// }



// if ((isset($_POST['action']) && $_POST['action'] == 'bookShipping') || isset($reAssignDelivery)) {

    // $orderID = $_POST['orderID'];

    $ch = curl_init();
    $headers  = [
        'Accept: application/json',
        'Content-Type: application/json'
    ];
    $postData = [
        'email' => 'Puretradingcompany@yahoo.com',
        'password' => 'ptC@12345'
    ];

    curl_setopt($ch, CURLOPT_URL, "https://shipment.xpressbees.com/api/users/login");
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($postData));
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    $response =  json_decode(curl_exec($ch));
    
    curl_close($ch);
    $token = $response->data;

    $query = "SELECT * FROM order_tbl WHERE order_id = '" . $orderID . "'";
    $query = mysqli_query($con, $query);
    $orderDetails = mysqli_fetch_array($query);
    
    // print_r($orderDetails); die;
    $allOrdersQ = mysqli_query($con, 'select od.quantity as qty, od.price, od.order_id as sku , p.product_name as name from order_details od, products p where od.order_id = "'. $orderID.'" and p.id = od.productid');
    $allProducts = [];
    while($pr = mysqli_fetch_assoc($allOrdersQ)){
        array_push( $allProducts,$pr);
    }
    // print_r($allProducts);
    $shipmentMode = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM order_details WHERE order_id = '$orderID'"));

    $tracking_query = mysqli_query($con, "SELECT * FROM `order_tbl` WHERE order_id='$orderID'");
    $tracking_data = mysqli_fetch_array($tracking_query);
    $userid = $tracking_data['userid'];
    $ship_query = mysqli_query($con, "SELECT * FROM `shiping_address` WHERE `user_id`='$userid' ORDER BY id DESC");
    $ship_data = mysqli_fetch_array($ship_query);
    
    // print_r($ship_data);
    // die();

    $stateId = $ship_data['state'];
    // echo  "SELECT state_code FROM state_list WHERE id = '$stateId'";
    $runQ = mysqli_query($con, "SELECT state_code FROM state_list WHERE id = '$stateId'");
    $stateCode = mysqli_fetch_assoc($runQ)['state_code'];
     $stateCode  = 'DL';
    
    // echo "SELECT state_code FROM state_list WHERE id = '$stateId'";

    if ($orderDetails['payment_mode'] == 'COD') {
        $type = 'cod';
    } else {
        $type = 'prepaid';
    }
    $xpressArr = [
        'order_number' => $orderID,
        'payment_type' => $type,
        'package_weight' => (int)$productsWeight,
        'package_length' => (int)$productsLength,
        'package_breadth' => (int)$productsWidth,
        'package_height' => (int)$productsHeight,
        'request_auto_pickup' => 'yes',
        'order_amount' => $orderDetails['orderprice'],
        // 'consignee' => [
        //     'name'=>$ship_data['first_name'] . ' ' . $ship_data['last_name'] ,
        //      'address' => $ship_data['flat'] . ', ' . $ship_data['street'] . ', ' . $ship_data['locality'],
        //     'city' => $ship_data['city'],
        //     // 'pincode' => $ship_data['zip_code'],
        //     'pincode' => '110098',
        //     'state' => $stateCode,
        //     'phone' => $ship_data['phone'], 
        
        // ],
        'consignee' => [
            'name' => 'MSG Ecommerce',
            'address' => 'Bajekan road, Village Nejia Khera, Near MSG All Trading International Private Limited, Sirsa-125055 (Haryana)',
            'city' => 'Sirsa',
            'state' => 'Haryana',
            'pincode' => '125055',
            'phone' => '9520400050',
        
        ],
        'pickup' =>[
            'warehouse_name' =>  'MSG Ecommerce',
            'name' => 'MSG Ecommerce',
            'address' => 'Bajekan road, Village Nejia Khera, Near MSG All Trading International Private Limited, Sirsa-125055 (Haryana)',
            'city' => 'Sirsa',
            'state' => 'Haryana',
            'pincode' => '125055',
            'phone' => '9520400050',
            'gst_number' => '06AAVFP3145L1ZP',
            ],
        'collectable_amount' => $orderDetails['orderprice'],
        'order_items' => $allProducts,
        
    ];
    
    // echo "<pre>";
    // print_r($xpressArr); die;
    $url = 'https://shipment.xpressbees.com/api/shipments2';
   
    $headers  = [
        'Accept: application/json',
        'Content-Type: application/json',
        'Authorization: Bearer '. $token,
    ];

    $curl2 = curl_init();
    curl_setopt_array($curl2, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => json_encode($xpressArr),
        CURLOPT_HTTPHEADER => $headers,
    ));
    
    // die();

    $response = json_decode(curl_exec($curl2));
    //  print_r($response);
    curl_close($curl2);
 
    
    if ($response->status == '' || $response->status == false) {
        $data['status'] = false;
        $data['msg'] = $response->message;
    }
    else if($response->status == 1) {

        $data['status'] = true;
        $data['msg'] = 'Shipment Booked Successfully';

        $shippingId = $response->data->shipment_id;
        $xOrderId  = $response->data->order_id;
        $awb = $response->data->awb_number;
        $courierId = $response->data->courier_id;
        $courierName = $response->data->courier_name;
        
        $bookingStatus = $response->data->status;
        $addintionalInfo = $response->data->additional_info;
        $paytype = $response->data->payment_type;
        $label = $response->data->label;
        $manifest = $response->data->manifest;
        
      

        $productIdString = '';
        $productIdString = implode(',', $_POST['products']);

        $updateOrderDetail = mysqli_query($con, "UPDATE `order_details` SET `shipment_id`= '$shippingId', `order_status`= 'Assigned Delivery' WHERE productid IN ($productIdString) AND order_id = '$orderID'");
    

        $fetchUnassignedDel = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = '$orderID' AND order_status != 'Assigned Delivery'");

        if (mysqli_num_rows($fetchUnassignedDel) == 0) {
            

            $prevOrderStatus = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM order_status WHERE order_id = '$orderID' ORDER BY id DESC LIMIT 1"));
            // print_r($prevOrderStatus);

            $userid = $prevOrderStatus['user_id'];
            $order_tbl_id = $prevOrderStatus['order_tbl_id'];
            $order_id = $prevOrderStatus['order_id'];
            $tracking_id = $prevOrderStatus['tracking_id'];
            $status = 'Seller has processed your Order';
            $by = $prevOrderStatus['by'];
            $reason = $prevOrderStatus['reason'];
            $date = date('Y-m-d');
            $time = date('H:i:s');


            $query = mysqli_query($con, "INSERT INTO `order_status`(`user_id`,`order_id`,`tracking_id`, `tracking_status`,`by`,`reason`,`date`,`time`) VALUES ('$userid','$order_id','$tracking_id','$status','$by','$reason','$date','$time')");
           
        }

        // insert shipping details 
         
        $insertShipmentDetails = mysqli_query($con, "INSERT INTO `order_shipping_details`(`orderId`, `product_ids`, `shipment_id`, `ship_order_id`, `courier_id`, `courier_name`, `awb`, `cost_estimate`,`shipment_status`,`payment_type`,`label`, `tracking_url`, `additional_info`, `manifest`) VALUES ('$orderID','$productIdString', '$shippingId','$xOrderId','$courierId','$courierName','$awb','','$bookingStatus', '$paytype','$label','$trackingUrl','$addintionalInfo', '$manifest')");
        
          if($insertShipmentDetails){
            $data['status'] = true;
            $data['msg'] = 'Shipment Booked Successfully';
        }else{
              $data['status'] = false;
            $data['msg'] = 'Some error occured.';
        }
      
      
        // update order detail 

    }
// }
echo json_encode($data);
