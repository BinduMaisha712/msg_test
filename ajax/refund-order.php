<?php error_reporting(E_ALL);
ini_set('display_errors', 1);

require('../config.php');
$dashboard = new Dashboard($con);

$data = array();

// session_start();

date_default_timezone_set('Asia/Kolkata');
$date=date("Y-m-d");
$time=date('H:i:s');


if($_POST['id']){

    $query = "SELECT * FROM order_details WHERE id='".$_POST['id']."'";

        $queryData = mysqli_query($con,$query);
        $d=(mysqli_fetch_assoc($queryData));
       
        $orderIdData = $d['order_id'];
        $orderIdPrice = $d['price'];
            $tempArr = array(
        "order_id" => $orderIdData,
        "od_p_id" => $_POST['id'],
        "price" => $orderIdPrice
    );


      $orderStatus = $homePage->forcedInsert('refund_order',$tempArr);   ///// Insert Order Status Data

    $tempArr = array(
        "user_id" => $_SESSION['loginid'],
        "order_id" => $d['order_id'],
        "tracking_id" => $d['tracking_id'],
        "tracking_status" => 'Refund',
        "`by`" => 'User',
        "reason" =>'',
        "date" => $date,
        "time" => $time
    );


      $orderStatus = $homePage->forcedInsert('order_status',$tempArr);   ///// Insert Order Status Data
     
      $quantity=$d['quantity'];
      $pdetails=$homePage->getProductById($d['productid']);
       ///////// Manage Stock /////////
      $isdeal=$homePage->isDealByProduct($d['productid']);
      if(!empty($isdeal))
      {
        if($isdeal[0]['stock']!=0)
        {
          $dealstock=$isdeal[0]['stock'] + $quantity;
        
        $tempArr = array(
      "pid" => $d['productid'],
      "stock" => $dealstock,
     );
     $dealstockUpdate = $cart->dealsave('today_deal',$tempArr);
   }
      }

    $stock = $pdetails['in_stock'] + $quantity;
    $isStock = ($stock == 0)?'No':'Yes';
    $tempArr = array(
      "id" => $d['productid'],
      "stock" => $isStock,
      "in_stock" => $stock
     );
     $stockUpdate = $homePage->save('products',$tempArr);

     $tempArr = array(
         "p_id" => $d['productid'],
         "stock" => $stock,
         "type" => 'Credit',
         "created_date" => $date,
         "created_time" => $time
     );
     $stockUpdate = $homePage->forcedInsert('stock',$tempArr);
    ///////// Manage Stock ///////// 

        


    if($orderStatus){
        $data['status'] = true;
        $data['result'] = 'Refund request Sent Successfully!';

    }else{
        $data['status'] = true;
        $data['result'] = 'Error Occur! Please try again';

    }
}




echo json_encode($data);

?>