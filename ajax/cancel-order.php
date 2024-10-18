<?php
require('../config.php');
$dashboard = new Dashboard($con);

$data = array();

// session_start();

date_default_timezone_set('Asia/Kolkata');
$date=date("Y-m-d");
$time=date('H:i:s');


if($_POST['tracking_id']){

    $query = "SELECT order_id FROM order_details WHERE tracking_id='".$_POST['tracking_id']."'";

        $queryData = mysqli_query($con,$query);
        $orderIdData = mysqli_fetch_array($queryData)['order_id'];
           $allPros = mysqli_query($con, "SELECT * FROM order_details WHERE order_id='$orderIdData'");
        
        while($data = mysqli_fetch_assoc($allPros)){
            
    $tempArr = array(
        "user_id" => $_SESSION['loginid'],
        "order_id" => $data['order_id'],
        "tracking_id" => $data['tracking_id'],
        "tracking_status" => 'Cancelled',
        "`by`" => 'User',
        "reason" => $_POST['reason'],
        "date" => $date,
        "time" => $time
    );


      $orderStatus = $homePage->forcedInsert('order_status',$tempArr);   ///// Insert Order Status Data
      $details=$dashboard->trackOrder($_POST['tracking_id']);
      $pid=$details['product_detail']['id'];
      $quantity=$details['quantity'];
      $pdetails=$homePage->getProductById($pid);
       ///////// Manage Stock /////////
      $isdeal=$homePage->isDealByProduct($pid);
      if(!empty($isdeal))
      {
        if($isdeal[0]['stock']!=0)
        {
          $dealstock=$isdeal[0]['stock'] + $quantity;
        
        $tempArr = array(
      "pid" => $pid,
      "stock" => $dealstock,
     );
     $dealstockUpdate = $cart->dealsave('today_deal',$tempArr);
   }
      }

    $stock = $pdetails['in_stock'] + $quantity;
    $isStock = ($stock == 0)?'No':'Yes';
    $tempArr = array(
      "id" => $pid,
      "stock" => $isStock,
      "in_stock" => $stock
     );
     $stockUpdate = $homePage->save('products',$tempArr);

     $tempArr = array(
         "p_id" => $pid,
         "stock" => $stock,
         "type" => 'Credit',
         "created_date" => $date,
         "created_time" => $time
     );
     $stockUpdate = $homePage->forcedInsert('stock',$tempArr);
    ///////// Manage Stock ///////// 

        }


    if($orderStatus){
        $data['status'] = true;
        $data['result'] = 'Successfully!';

    }else{
        $data['status'] = true;
        $data['result'] = 'Error Occur! Please try again';

    }
}
if(isset($_POST['action']) && $_POST['action'] == 'fetchOD'){
    $orderId = $_POST['orderId'];
    
    $allPro = mysqli_query($con, "SELECT p.product_name,p.class0, p.class1, p.class2, i.image FROM products p , image i, order_details od  WHERE p.id = od.productid AND od.order_id = '$orderId' AND i.p_id = p.product_code GROUP BY i.p_id");
    $prArr = [];
     $html = '';
     
    while($row = mysqli_fetch_array($allPro)){
   
        
          $colorName = "";
    
        if(!empty($row['class0']) )
        {
        $colorName .= "(" . mysqli_fetch_assoc(mysqli_query($con, "SELECT symbol FROM size_class WHERE id=" . $row['class0']))['symbol']. ')';
        }
        if(!empty($row['class1']) )
        {
        $colorName .= " (" . $row['class1'] . ')';
        }
        
        
        $html .= '<div class="d-flex p-3 align-items-center"> <img width="100px" src="'.BASE_URL.'asset/image/product/'.$row['image'].'" alt=""> <p class="m-2 text-dark">'.$row['product_name'].$colorName.'</p></div>';
    }
    
      $data['html'] = $html;
} 



echo json_encode($data);

?>