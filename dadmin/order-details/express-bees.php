 <?php
    // $conn = mysqli_connect('localhost','root','', 'micodetest_msg_updated');
    
    $con = mysqli_connect('localhost','micodetest_msg_updated','_Cji4CLU@%GI', 'micodetest_msg_updated');
    $conn = $con;
    if (defined('BASE_URL')) {
    //   define('BASE_URL', 'https://localhost/msg/');
       define('BASE_URL', 'https://micodetest.com/msg_updated/');
    }
    
    date_default_timezone_set('Asia/Kolkata');
    if ($con -> connect_errno) {
      echo "Failed to connect to MySQL: " . $con -> connect_error;
      exit();
    }
?>

<?php
    // Getting Product Info
    // $order_id = 'MS572536502777';
    $orderID = $order_id;
    
    $trackingId = $tracking_id;
    // $trackingId = $_POST['tracking_id'];

    $sel2 = mysqli_query($conn, "SELECT * FROM order_details WHERE order_id = '$orderID'");

    // echo $sel; echo '<h1> this </h1>';
    
    $i = 1;
    while ($order_details = mysqli_fetch_array($sel2)) {
        $pid = $order_details['productid'];
        $qty = $order_details['quantity'];
        $product = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = '$pid'"));
        if ($qty > 1) {
            $product['weight'] = $product['weight'] * $qty;
        }


        $colorName = "";

        if (!empty($product['class0'])) {
            $colorName .= "(" . mysqli_fetch_assoc(mysqli_query($conn, "SELECT symbol FROM size_class WHERE id=" . $product['class0']))['symbol'] . ')';
        }
        if (!empty($product['class1'])) {
            $colorName .= " (" . $product['class1'] . ')';
        }
        if ($product['class2'] != '')
            $colorName .= ' (' . $product['class2'] . ')';
            
            
        $productsHeight = $product['height'];
        $productsWidth = $product['width'];
        $productsWeight = $product['weight'];
        $productsLength = $product['length'];
        $productTrackingId = $order_details['tracking_id'];
        $i++;
        // ==========================================
        // Placing Shipment Order through ExpressBees
        
        if($trackingId == $productTrackingId){
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
            $query34 = mysqli_query($con, $query);
            $orderDetails = mysqli_fetch_array($query34);
            
            // print_r($orderDetails); die;
            // $allOrdersQ = mysqli_query($con, 'select od.quantity as qty, od.price, od.order_id as sku , p.product_name as name from order_details od, products p where od.order_id = "'. $orderID.'" and p.id = od.productid');
            $allOrdersQ = mysqli_query($con, 'select od.quantity as qty, od.price, od.order_id as sku , p.product_name as name from order_details od, products p where od.order_id = "'. $orderID.'" and od.tracking_id = "'. $trackingId.'" and p.id = od.productid');
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
                $collectable_amt = $orderDetails['orderprice'];
            } else {
                $type = 'prepaid';
                $collectable_amt = 0;
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
                'consignee' => [
                    'name'=>$ship_data['first_name'] . ' ' . $ship_data['last_name'] ,
                     'address' => $ship_data['flat'] . ', ' . $ship_data['street'] . ', ' . $ship_data['locality'],
                    'city' => $ship_data['city'],
                    'pincode' => $ship_data['zip_code'],
                    //'pincode' => '110098',
                    'state' => $stateCode,
                    'phone' => $ship_data['phone'], 
                
                ],
                // 'consignee' => [
                //     'name' => 'Maisha Info - SK',
                //     'address' => 'Bajekan road, Village Nejia Khera, Near MSG All Trading International Private Limited, Sirsa-125055 (Haryana)',
                //     'city' => 'Sirsa',
                //     'state' => 'Haryana',
                //     'pincode' => '125055',
                //     'phone' => '9520400050',
                
                // ],
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
                'collectable_amount' => $collectable_amt,
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
            
            
             $booking = curl_exec($curl2);
             $response = json_decode($booking);
           
            //$response->status = 1; //Adde This line to test, Remove it for production
            
            curl_close($curl2);
         
            if ($response->status == '' || $response->status == false) {
                $data['status'] = false;
                $data['shipping_status'] = false;
                $data['msg'] = $response->message;
            }
            else if($response->status == 1) {
        
                $data['status'] = true;
                $data['shipping_status'] = true;
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
                if(isset($_POST['products']) ) $productIdString = implode(',', $_POST['products']);
        
                $updateOrderDetail = mysqli_query($con, "UPDATE `order_details` SET `shipment_id`= '$shippingId', `order_status`= 'Assigned Delivery' WHERE productid IN ($productIdString) AND order_id = '$orderID'");
            
        
                // $fetchUnassignedDel = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = '$orderID' AND order_status != 'Assigned Delivery'");
        
                if (mysqli_num_rows($fetchUnassignedDel) == 0) {
                    
        
                    $prevOrderStatus = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM order_status WHERE order_id = '$orderID' ORDER BY id DESC LIMIT 1"));
        
                    $userid = $prevOrderStatus['user_id'];
                    $order_tbl_id = $prevOrderStatus['order_tbl_id'];
                    $order_id = $prevOrderStatus['order_id'];
                    $tracking_id = $prevOrderStatus['tracking_id'];
                    $status = 'Order has been processed to ship via shipping partner';
                    $by = $prevOrderStatus['by'];
                    $reason = $prevOrderStatus['reason'];
                    $date = date('Y-m-d');
                    $time = date('H:i:s');
                    // $query = mysqli_query($con, "INSERT INTO `order_status`(`user_id`,`order_id`,`tracking_id`, `tracking_status`,`by`,`reason`,`date`,`time`) VALUES ('$userid','$order_id','$tracking_id','$status','$by','$reason','$date','$time')");
                }
        
                // insert shipping details 
                $insertShipmentDetails = mysqli_query($con, "INSERT INTO `order_shipping_details`(`orderId`, `product_ids`, `shipment_id`, `ship_order_id`, `courier_id`, `courier_name`, `awb`, `cost_estimate`,`shipment_status`,`payment_type`,`label`, `tracking_url`, `additional_info`, `manifest`) VALUES ('$orderID','$productIdString', '$shippingId','$xOrderId','$courierId','$courierName','$awb','','$bookingStatus', '$paytype','$label','$trackingUrl','$addintionalInfo', '$manifest')");
                if($insertShipmentDetails){
                    $data['status'] = true;
                    $data['shipping_status'] = true;
                    $data['msg'] = 'Shipment Booked Successfully!';
                }else{
                    $data['status'] = false;
                    $data['shipping_status'] = true;
                    $data['msg'] = "Order Has Booked for Shipping But Shipping Details couldn't Saved Successfully!";
                }
              
              
                // update order detail 
        
            }
        // }
            echo json_encode($data);
        } // shipment tracking id, "if" block ends here 


    }//While loop ends here
?>

<!-- 
    1. commented API Request Call @ line: 188, 189
    2. using static data @ line: 129
    3. set $response->status = 1 @ Line: 191
-->