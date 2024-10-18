<?php

$data = [];

include('../config.php');
if (isset($_POST['action']) && $_POST['action'] == 'getEstimate') {



    // $userIp = $_SERVER['REMOTE_ADDR'];

    // $checkUserQ = mysqli_query($con, "SELECT * FROM shipping_api_token WHERE user_ip = '$userIp' ORDER BY id DESC");

    // $checkUserIp = mysqli_fetch_assoc($checkUserQ);

    // $sessionTime = $checkUserIp['timestamp'];
    // $sessionExpirationTime = date("Y-m-d H:i:s", strtotime($sessionTime . '+10 days'));
    // $currentTime = date('Y-m-d H:i:s');


    // if (mysqli_num_rows($checkUserQ) == 0 || $sessionExpirationTime < $currentTime) {
    //     $curl1 = curl_init();
    //     curl_setopt_array($curl1, array(
    //         CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/auth/login',
    //         CURLOPT_RETURNTRANSFER => true,
    //         CURLOPT_ENCODING => '',
    //         CURLOPT_MAXREDIRS => 10,
    //         CURLOPT_TIMEOUT => 0,
    //         CURLOPT_FOLLOWLOCATION => true,
    //         CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //         CURLOPT_CUSTOMREQUEST => 'POST',
    //         CURLOPT_POSTFIELDS => '{
    //         "email": "gogoshopper@gmail.com",
    //         "password": "gogo@2020"
    //     }',
    //         CURLOPT_HTTPHEADER => array(
    //             'Content-Type: application/json'
    //         ),
    //     )
    //     );

    //     $response_data1 = curl_exec($curl1);
    //     curl_close($curl1);
    //     $response_data1 = json_decode($response_data1);
    //     $shiprocket_token = $response_data1->token;

    // } else {
    //     $shiprocket_token = $checkUserIp['api_token'];
    // }

    // // echo $apiToken;


    


  


    // $curl2 = curl_init();
    // curl_setopt_array($curl2, array(
    //     CURLOPT_URL => 'https://apiv2.shiprocket.in/v1/external/shipments',
    //     CURLOPT_RETURNTRANSFER => true,
    //     CURLOPT_ENCODING => '',
    //     CURLOPT_MAXREDIRS => 10,
    //     CURLOPT_TIMEOUT => 0,
    //     CURLOPT_FOLLOWLOCATION => true,
    //     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //     CURLOPT_CUSTOMREQUEST => 'POST',
    //     CURLOPT_POSTFIELDS => $order_data_post,
    //     CURLOPT_HTTPHEADER => array(
    //         'Content-Type: application/json',
    //         "Authorization: Bearer $shiprocket_token"
    //     ),
    // )
    // );

    // $response_order = curl_exec($curl2);

    // curl_close($curl2);

    // $response_order = json_decode($response_order);
 
    $data['err'] = '';
    $data['price'] = 100;

}


echo json_encode($data);

?>