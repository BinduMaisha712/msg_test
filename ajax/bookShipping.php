<?php



require('../config.php');
if (isset($_POST['action']) && $_POST['action'] == 'bookShipping') {

    // generate token *****************************************

    $userIp = $_SERVER['REMOTE_ADDR'];

    $checkUserQ = mysqli_query($con, "SELECT * FROM shipping_api_token WHERE user_ip = '$userIp' ORDER BY id DESC");

    $checkUserIp = mysqli_fetch_assoc($checkUserQ);

    $sessionTime = $checkUserIp['timestamp'];
    $sessionExpirationTime = date("Y-m-d H:i:s", strtotime($sessionTime . '+10 days'));
    $currentTime = date('Y-m-d H:i:s');


    if (mysqli_num_rows($checkUserQ) == 0 || $sessionExpirationTime < $currentTime) {
        $curl1 = curl_init();
        curl_setopt_array($curl1, array(
            CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => '{
            "email": "gogoshopper@gmail.com",
            "password": "gogo@2020"
        }',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        )
        );

        $response_data1 = curl_exec($curl1);
        curl_close($curl1);
        $response_data1 = json_decode($response_data1);
        $shiprocket_token = $response_data1->token;

    } else {
        $shiprocket_token = $checkUserIp['api_token'];
    }


    //place order ********************************************************
    $orderId = $_POST['orderID'];
    $orderDetails = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM order_tbl WHERE order_id = '$orderId'"));
    $userid = $orderDetails['userid'];
    $billing_details = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `user` WHERE id='$userid'"));
    $shipping_details = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `shiping_address` WHERE `user_id`='$userid' ORDER BY id DESC"));

    // $productIds  = $_POST['products'];

    $od1 = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = '$orderId'");
    $productIds = [];

    while ($row = mysqli_fetch_assoc($od1)) {
        $od = mysqli_fetch_array(mysqli_query($con, "select od.*, os.tracking_status from order_details od, order_status os where od.order_id='" . $row['order_id'] . "' AND od.order_id = os.order_id AND od.tracking_id=os.tracking_id AND od.productid='" . $row['productid'] . "' ORDER BY os.id DESC LIMIT 1;"))['tracking_status'];

        if ($od != 'Cancelled') {
            array_push($productIds, $row['productid']);
        }
    }
    $cart_data = array();

    foreach ($productIds as $pro) {
        // print_r($pro);
        $productDetails = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM order_details WHERE productid = '$pro'"));
        $product = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM products WHERE id = '$pro'"));

        //  print_r($productDetails);
        $cart_item = array(
            "name" => substr($product['product_name'], 0, 119),
            "sku" => substr($product['product_name'], 0, 49),
            "units" => $productDetails['quantity'],
            "selling_price" => $product['price'],
            "discount" => 8395789345,
            "tax" => $productDetails['gst'],
            "hsn" => ''
        );

        array_push($cart_data, $cart_item);
    }

    $pro_pay_mode = 'COD';
    $pro_price = '100';
    $pro_name = 'JFIKj';
    $sku = 'ufsdi';
    $pro_qty = 2;
    $hsn = 738467398;
    $date = date('Y-m-d');

    $order_data = array(
        "order_id" => $orderId,
        "order_date" => $date,
        "pickup_location" => "Primary",
        "channel_id" => "",
        "comment" => "",
        "billing_customer_name" => $billing_details['firstname'],
        "billing_last_name" => $billing_details['lastname'],
        "billing_address" => $billing_details['flat'] . ', ' . $billing_details['street'] . ', ' . $billing_details['locality'],
        "billing_address_2" => "",
        "billing_city" => $billing_details['city'],
        "billing_pincode" => $billing_details['zipcode'],
        "billing_state" => $billing_details['state'],
        "billing_country" => 'India',
        "billing_email" => $billing_details['email'],
        "billing_phone" => $billing_details['mobile'],
        "shipping_is_billing" => false,
        "shipping_customer_name" => $shipping_details['first_name'],
        "shipping_last_name" => $shipping_details['last_name'],
        "shipping_address" => $shipping_details['flat'] . ', ' . $shipping_details['street'] . ', ' . $shipping_details['locality'],
        "shipping_address_2" => '',
        "shipping_city" => $shipping_details['city'],
        "shipping_pincode" => $shipping_details['zip_code'],
        "shipping_country" => 'India',
        "shipping_state" => $shipping_details['state'],
        "shipping_email" => $shipping_details['email'],
        "shipping_phone" => $shipping_details['phone'],
        "payment_method" => $orderDetails['payment_type'],
        "shipping_charges" => 0,
        "giftwrap_charges" => 0,
        "transaction_charges" => 0,
        "total_discount" => 0,
        "sub_total" => '999',
        "length" => 10,
        "breadth" => 15,
        "height" => 20,
        "weight" => 2.5,
        "order_items" => ''
    );

    $order_data["order_items"] = $cart_data;

    $order_data_post = json_encode($order_data);
    $curl2 = curl_init();
    curl_setopt_array($curl2, array(
        CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/orders/create/adhoc',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'POST',
        CURLOPT_POSTFIELDS => $order_data_post,
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            "Authorization: Bearer $shiprocket_token"
        ),
    )
    );

    $response_order = curl_exec($curl2);

    curl_close($curl2);

    $response_order = json_decode($response_order);

    // print_r($response_order);
    if ($response_order->status_code == 1) {

        $data['status'] = true;
        $data['msg'] = 'Shipment Booked Successfully';

        // update order details 
        $updateOrderDetail = mysqli_query($con, "UPDATE `order_details` SET `shipment_id`= '$shippingId', `order_status`= 'Assigned Delivery' WHERE productid IN ($productIdString) AND order_id = '$orderID'");

        $orderD = mysqli_query($con, "SELECT * FROM order_details WHERE order_id = '$orderId'");
        $productIdArr = [];
        while ($r = mysqli_fetch_assoc($orderD)) {

            array_push($productIdArr, $r['productid']);

            $userid = $r['user_id'];
            $order_id = $r['order_id'];
            $tracking_id = $r['tracking_id'];
            $status = 'Seller has processed your Order';
            $date = date('Y-m-d');
            $time = date('H:i:s');

            $query = mysqli_query($con, "INSERT INTO `order_status`(`user_id`,`order_id`,`tracking_id`, `tracking_status`,`by`,`reason`,`date`,`time`) VALUES ('$userid','$order_id','$tracking_id','$status','$date','$time')");
        }
        $productIdString = implode(',', $productIdArr);
        $insertShipmentDetails = mysqli_query($con, "INSERT INTO `order_shipping_details`(`orderId`, `product_ids`, `shipment_id`, `pickup_id`, `courier_id`, `courier_name`, `awb`, `cost_estimate`, `tracking_url`) VALUES ('$orderID','$productIdString', '$shippingId','$pickupId','$courierId','$courierName','$awb','$costEstimate','$trackingUrl')");

    } else {
        if (isset($response_order->errors)) {
            $data['msg'] = '';
            foreach ($response_order->errors as $err) {
                // print_r($err[0]);
                $data['msg'] .= $err[0];
            }
        } else {
            $data['status'] = false;
            $data['msg'] = 'Some error occured. Could not book shipment.';
        }
    }


}
echo json_encode($data);
?>