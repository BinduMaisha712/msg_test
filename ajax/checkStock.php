<?php
require('../config.php');

// session_start();

// print_r($_SESSION['products']['id']);
$checkout = new Checkout($con);

$data = array();
$errMessage = array();

// }
// exit();
// $loginId = $_SESSION['loginid'];
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d");
$time = date('H:s:i');
$timeStamp = date("Y-m-d h:i:s");

$orderPlaced = false;
$checkOutStatus = false;
$placeOrder = false;

$itemOutofstock = 0;
$OOSItemsIds = [];
$i = 0;

$allIds = '';
    $html = '';
    
foreach ($checkout->cartDetail() as $item) {
  if ((isset($item['stock']) && ($item['stock'] !== 'Yes'))  || (isset($item['quantity']) && $item['quantity'] > $item['in_stock'])) {
      
    $itemId = $item['id'];
    $itemOutofstock++;
    array_push($OOSItemsIds, $item['id']);

    if (isset($_SESSION['loginid'])) {

      $loginId = $_SESSION['loginid'];

      $deleteFromCart = mysqli_query($con, "DELETE FROM add_cart WHERE pid = '$itemId' AND user_id = '$loginId'");

    } else {
      $key = array_search($item['id'], $_SESSION['products']['id']);

      // remove unavailable items from cart (from session)
      unset($_SESSION['products']['id'][$key]);
    }
    
    foreach ($OOSItemsIds as $id) {
      $allIds .= $id . ",";
      
      $query_res = mysqli_query($con, "SELECT p.*, i.image FROM products p, image i WHERE p.id = $id AND p.product_code = i.p_id;");
      if($query_res)$product= mysqli_fetch_assoc($query_res);
      $html .= '<div> <img style="width: 60px"  src = "asset/image/product/'. $product['image'] .'"> ' . $product['product_name'] . '</div>';
    }

    $data['oostatus'] = "outOfStock";
    $data['html'] = $html;
  }
}

echo json_encode($data);

?>