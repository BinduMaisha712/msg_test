<?php include('header.php');
$dashboard = new Dashboard($con);
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d");
$time = date('H:i:s');
$timeStamp = date("Y-m-d h:i:s");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
// error_reporting(0);

// 
?>
<link rel="stylesheet" href="assets/css/order-completed.css">
<?php
if (isset($_GET['id'])) {
  $orderId = $_GET['id'];

  $productsDetails = $dashboard->orderProducts($orderId);
  // echo '<pre>';
  //     print_r($productsDetails);
  // exit();
} else {
?>
  <script type="text/javascript">
    window.location.href = "index.php";
  </script>
<?php
}



$uid = mysqli_fetch_assoc(mysqli_query($con, "SELECT userid FROM order_tbl WHERE order_id = '$orderId'"))['userid'];


$str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
$token = substr(str_shuffle($str), 0, 30);

// for tracking id
$fetchOrder1 = mysqli_query($con, "SELECT * FROM order_status WHERE order_id ='$orderId'");
$orderRow1 = mysqli_fetch_assoc($fetchOrder1);

// print_r($orderRow1);

$checkit11 = mysqli_query($con, "SELECT * FROM invoice_generate WHERE user_id='" . $uid . "' and order_id='" . $orderId . "' and tracking_id='" . $orderRow1['tracking_id'] . "'");

if (mysqli_num_rows($checkit11) == 0) {

  $invoiceNo = rand(10000, 99999);
  $submit_array['invoice_no'] = $invoiceNo;

  $tid = $orderRow1['tracking_id'];
  $query = "INSERT INTO `invoice_generate`( `user_id`, `order_id`, `tracking_id`, `invoice_no`, `invoice_date`, `invoice_time`, `token`) VALUES ('$uid','$orderId','$tid','$invoiceNo','$date','$time','$token')";

  mysqli_query($con, $query);
}



$orderDetails = $dashboard->orderDetails($orderId);
// echo '<pre>';
// print_r($orderDetails);
// exit();
if (empty($orderDetails)) {
?>
  <script type="text/javascript">
    window.location.href = "index.php";
  </script>
<?php
}
//////// if Order Status is Automatic ////////
$checkout = new Checkout($con);
if ($checkout->orderConfig() == 'Automatic') {
  $message = "THANK YOU ! Your Order Has Been Successfully Placed";
} else {
  $message = "THANK YOU ! Your Order Has Been Confirmed";
}
//////// if Order Status is Automatic ////////
?>
<style>
  h3.my-text {
    font-size: 18px;
    font-weight: 700;
    font-size: 13px;
  }

  h4.text-muted.my-text {
    font-size: 17px;
    font-weight: 700;
    font-size: 13px;

  }

  h4.my-text-one {
    font-size: 17px;
    font-weight: 700;
    font-size: 13px;

  }

  h5.text-title {
    font-size: 13px;
  }

  button.btn.btn-primary a {
    color: white;
    font-family: 'Syne';
  }

  .product-image img {
    max-width: 50%;
  }

  .success-message h4 {
    font-weight: 800;
    color: green;
  }

  .text-dark {
    font-size: 14px;
  }

  li.name a {
    font-size: 15px;
    text-align: left;
    font-family: 'Syne';
    color: black;
    font-size: 12px;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
  }
</style>
<!--Header Area End-->
<!--Error 404 Area Start-->
<section class="order-completed">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-10">
        <div class="search-form-wrapper py-4">
          <h1 class="order-confirm justify-content-center text-center my-5">
            <img src="assets/img/success.gif" alt="" width="80px">
          </h1>
          <?php
          //   print_r($orderDetails);
          if ($orderDetails['payment_mode'] == 'COD') {
            $cart->clearCart(); ///// Remove All Item From Cart
          ?>
            <div class="success-message">
              <h4>Order Success</h4>
              <h5 class="font-light"><?= $message; ?> </h5>
              <h6 class="font-light">Transaction ID:<?= $orderId ?></h6>
            </div>
          <?php
          } else if ($orderDetails['payment_mode'] == 'Online' && $orderDetails['payment_status'] == 'Success') { ?>

            <div class="success-message">
              <h5 class="font-light"><?= $message; ?> </h5>
              <h6 class="font-light">Transaction ID:<?= $orderId ?></h6>
            </div>


          <?php } else if ($orderDetails['payment_mode'] == 'Online' && $orderDetails['payment_status'] != 'Success') { ?>
            <div class="error-message">
              <p> Transaction Failed ! </p>
            </div>
          <?php } else if ($orderDetails['payment_mode'] == 'wallet' && $orderDetails['payment_status'] == 'Success') { ?>

            <div class="success-message">
              <h4>Order Success</h4>
              <h5 class="font-light"><?= $message; ?> </h5>
              <h6 class="font-light">Transaction ID:<?= $orderId ?></h6>
            </div>


          <?php } else if ($orderDetails['payment_mode'] == 'wallet' && $orderDetails['payment_status'] != 'Success') { ?>
            <div class="error-message">
              <p> Transaction Failed ! </p>
            </div>
          <?php } ?>
          <div class="search-form">
            <div class="back-to-home mt-4 text-center">
              <button class="btn btn-primary btn-rounded btn-md"> <a href="index.php">Back To Home </a></button>
            </div>
          </div>
        </div>
      </div>
    </div>


    <!-- here  -->


    <div class="row flex-row">
      <div class="col-lg-8">
        <div class="card cart-table order-table order-table-2">
          <div class="table-responsive">
            <table class="table mb-0">
              <thead style="height: 60px;">
                <th></th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Tax</th>
                <th>Total</th>
              </thead>
              <tbody>

                <?php
                $total = 0;
                $totalTax = 0;
                $productCount = 0;
                $productsDetailsQ = mysqli_query($con, "SELECT p.id, p.product_name, p.tax,  od.quantity, od.price, ot.orderprice  FROM order_details od, products p, order_tbl ot WHERE od.order_id = '$orderId' AND p.id = od.productid AND ot.order_id = od.order_id");


                while ($detail = mysqli_fetch_assoc($productsDetailsQ)) {
                  $pid = $detail['id'];

                  $prdimg = mysqli_query($con, "SELECT product_code FROM products where id='$pid'");
                  $mypcode = mysqli_fetch_array($prdimg);

                  //show Product Image
                  $images = $homePage->image('product', $mypcode['product_code']); ?>
                  <tr>
                    <td class="product-detail">
                      <div class="product border-0 d-flex align-items-center flex-column">
                        <div class="product-image">
                          <a href="javascript:;">
                            <?php if ($images != '') { ?>
                              <img src="asset/image/product/<?= $images[0]['image']; ?>" alt="<?= $detail['product_name']; ?>">
                            <?php } else { ?>

                              <img src="asset/image/logo/g.jpg" alt="<?= $detail['product_name']; ?>">

                            <?php } ?>

                          </a>
                        </div>

                      </div>
                    </td>
                    <td>
                      <div class="product-detail">
                        <ul>
                          <li class="name">
                            <a target="_new" href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $detail['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $detail['product_name']; ?></a>
                          </li>
                        </ul>
                      </div>
                    </td>

                    <td class="price border-bottom-0">
                      <!--<h4 class="table-title text-content text-muted mb-2">Price</h4>-->
                      <h6 class="theme-color text-dark"><?= $currency; ?>&nbsp;<?= $detail['price'] / $detail['quantity']; ?></h6>
                    </td>

                    <td class="quantity border-bottom-0">
                      <!--<h4 class="table-title text-content text-muted mb-2">Qty</h4>-->
                      <h5 class="text-title text-dark"><?= $detail['quantity']; ?></h5>
                    </td>


                    <td class="quantity border-bottom-0">
                      <h5 class="text-title text-dark">
                        <?php
                        $ProductTaxValue = !empty($detail['tax']) ? $detail['tax'] : '0';

                        $totalPriceProduct = $detail['price'];
                        $totalPriceProductTAX = $totalPriceProduct / 100 * $ProductTaxValue;
                        echo '&#8377;' . $totalPriceProductTAX;
                        echo ' (' . $ProductTaxValue . '%' . ') ';

                        ?>
                      </h5>
                    </td>

                    <td class="subtotal border-bottom-0">
                      <?php
                      $productTotal = $detail['price'];

                      ?>
                      <h5 class="text-dark"><?= $currency; ?>&nbsp;<span class="productTotal"><?= $productTotal + $totalPriceProductTAX; ?></span></h5>
                    </td>

                  </tr>

                <?php
                  $productCount++;
                  $total += $productTotal;
                  $totalTax += $totalPriceProductTAX;
                } ?>

              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-4">
        <div class="row flex-column mb-30">
          <?php

          $productsDetailsQ2 = mysqli_query($con, "SELECT p.product_name,  od.quantity, od.price, ot.orderprice,ot.gst, sa.*  FROM order_details od, products p, order_tbl ot, shiping_address sa WHERE od.order_id = '$orderId' AND p.id = od.productid AND ot.order_id = od.order_id AND ot.order_id=sa.order_id GROUP BY od.order_id");

          while ($detail2 = mysqli_fetch_assoc($productsDetailsQ2)) {  ?>

            <div class="col-lg-12 col-sm-6">
              <div class="summery-box d-flex pl-0 flex-column justify-content-between border p-4">
                <div class="summery-header d-flex justify-content-betweeen mb-3">
                  <h3 class="my-text">Price Details</h3>
                  <h5 class="ms-auto theme-color my-text-one">(<?= $productCount;  ?> Items)</h5>
                </div>

                <ul class="summery-contain pl-0">
                  <li class="d-flex justify-content-between mb-1">
                    <h4 class="text-muted my-text">Total</h4>
                    <h4 class="price my-text-one"><?= $currency; ?>&nbsp;<?= $total; ?></h4>
                  </li>
                  <li class="d-flex justify-content-between mb-1">
                    <?php
                    $seldis_price_query = mysqli_query($con, "SELECT discount_price FROM order_coupon_code WHERE order_id = '$orderId'");
                    $seldis_price = mysqli_fetch_assoc($seldis_price_query);
                    if (!empty($seldis_price)) {
                        $discount_price = $seldis_price['discount_price'];
                    } else {
                        $discount_price = 0;
                    }
                    
                    ?>
                    <h4 class="text-muted my-text">Coupon Discount</h4>
                    <h4 class="price my-text-one">
                      <?php
                        if ($discount_price) { ?>
                            <?= $discount_price; ?>
                        <?php
                        } else {
                        ?>
                            0
                        <?php
                        }
                        $maxtvalue = $total - $discount_price;
                        if ($detail2['gst']!=""){
                            $maxtvalue_tax = $detail2['gst'];
                        }else{
                            $maxtvalue_tax=$totalTax;
                        }
                        
                        ?>

                    </h4>
                  </li>
                  <li class="d-flex justify-content-between">
                    <h4 class="text-muted my-text">Shipping</h4>
                    <h4 class="price text-muted my-text-one"><?= $currency; ?> 100</h4>
                  </li>

                  <li class="d-flex justify-content-between mb-1">
                    <h4 class="text-muted my-text">Tax</h4>
                    <?php
                    if ($orderDetails['payment_mode'] == "Online" || $orderDetails['payment_mode'] == "wallet") {
                    ?>
                      <h4 class="price text-dark my-text-one"><?= $currency; ?> <?= $maxtvalue_tax ?></h4>
                    <?php } else { ?>
                      <h4 class="price text-dark my-text-one"><?= $currency; ?> <?= $totalTax ?></h4>
                    <?php } ?> 
                  </li>

                </ul>

                <ul class="summery-total pl-0">
                  <li class="list-total d-flex justify-content-between">
                    <h4 class="text-muted my-text">Total Amount</h4>
                    <?php
                    if ($orderDetails['payment_mode'] == "Online" || $orderDetails['payment_mode'] == "wallet") {
                    ?>
                      <h4 class="price text-dark my-text-one"><?= $currency; ?>&nbsp;<?=  $maxtvalue + $maxtvalue_tax + 100  ?></h4>
                    <?php } else { ?>
                      <h4 class="price text-dark my-text-one"><?= $currency; ?>&nbsp;<?= $total + $totalTax + 100 ?></h4>
                    <?php } ?>
                  </li>
                </ul>
              </div>

              <?php


              $productsDetailsQ2 = mysqli_query($con, "SELECT p.product_name,  od.quantity, od.price, ot.orderprice, sa.*  FROM order_details od, products p, order_tbl ot, shiping_address sa WHERE od.order_id = '$orderId' AND p.id = od.productid AND ot.order_id = od.order_id AND ot.order_id=sa.order_id GROUP BY od.order_id");

              while ($detail2 = mysqli_fetch_assoc($productsDetailsQ2)) {  ?>



                <div class="summery-box d-flex flex-column justify-content-between p-4 border">
                  <div>
                    <div class="summery-header">
                      <h3 class="text-dark my-text">Shipping Address</h3>
                    </div>
                    <ul class="summery-contain pl-0 pb-0 border-bottom-0">
                      <li class="d-block">
                        <?php $cid = $detail2['country'];
                        $country = mysqli_fetch_assoc(mysqli_query($con, "SELECT country_name FROM countries where id = $cid"))['country_name']; ?>
                        <p class="text-muted my-text-one"><?= $detail2['addr_type'] . ', ' . $detail2['flat'] . ', ' . $detail2['street'] . ', ' . $detail2['locality']; ?>
                          <?= $detail2['city'] . ', ' . $detail2['zip_code'] . ', ' . $country; ?></p>
                      </li>
                    </ul>
                  </div>
                  <ul class="summery-total pl-0">
                    <li class="list-total border-top-0 pt-2 d-flex justify-content-between">
                      <h3 class="text-dark my-text">Order Placed On : </h3>
                      <h4 class="text-muted my-text-one"><span><?= $detail2['o_date']; ?></span></h4>
                    </li>
                  </ul>

                </div>

              <?php } ?>


            </div>



          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</section>
<!--Error 404 Area End-->
<!--Brand Area Start-->
<script type="text/javascript">
  var max = 0;
</script>
<?php include('include/footer.php'); ?>
<?php
$userID = mysqli_fetch_assoc(mysqli_query($con, "SELECT id From order_tbl WHERE order_id = '$orderId'"))['id'];
$fetchUserDetails = mysqli_fetch_array(mysqli_query($con, "SELECT u.firstname, u.lastname, u.email, u.mobile FROM user u, order_tbl ot WHERE u.id = ot.userid AND ot.order_id = '$orderId'"));
$orderprice = $total;

if ($orderDetails['payment_mode'] == "Online" || $orderDetails['payment_mode'] == "wallet") {
  $TotalAmountForEmailOnly = $maxtvalue + $maxtvalue_tax;
} else {
  $TotalAmountForEmailOnly = $total + $totalTax;
}

$logo = mysqli_fetch_assoc(mysqli_query($con, "select * from `logo` where id=1"));
$Logo_Url_for_Email = BASE_URL . 'asset/image/logo/' . $logo['logo'];
// print_r($Logo_Url_for_Email);

if ($orderDetails['payment_mode'] == "Online" || $orderDetails['payment_mode'] == "wallet") {
  //   $txnId = mysqli_fetch_assoc(mysqli_query($con, "SELECT trnx_id FROM online_payment_detail WHERE order_id ='$orderId' "))['trnx_id'];
  // $txnId = $orderDetails['trnx_id'];

  $token = mysqli_fetch_array(mysqli_query($con, "SELECT token FROM `invoice_generate` WHERE order_id = '$orderId'"))['token'];

  define('ORDERID', $orderId);
  define('TOKEN', $token);

  include('invoice/invoice-pdf.php');

  $destination = __DIR__ . '/invoice/pdf_invoices/';

  $invoice_name = 'INVOICE_' . round(microtime(true)) . '.pdf';
  $pdf2->Output($destination . $invoice_name, 'F');
  $cart->clearCart();
  $invoice = $destination . $invoice_name;

  mysqli_query($con, "UPDATE `invoice_generate` SET pdf='" . $invoice_name . "' WHERE order_id = '" . $_GET['id'] . "'");
}

// SEND EMAIL after order placement
$name = $fetchUserDetails['firstname'] . ' ' . $fetchUserDetails['lastname'];
$email = $fetchUserDetails['email'];
$mobile = $fetchUserDetails['mobile'];

$products = mysqli_query($con, "SELECT p.product_name,p.class0,p.product_code, p.class1, p.class2, p.class3, od.quantity,od.gst, od.price FROM products p ,order_details od WHERE p.id = od.productid AND od.order_id = '$orderId'");


$productsElems  = '<table style="width:100%;margin-top: 20px;">
        <tbody>';
while ($product = mysqli_fetch_assoc($products)) {
  $prImg = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM image WHERE p_id ='" . $product['product_code'] . "'"));
  // print_r($prImg);
  // $colorName = mysqlli_fetch_assoc(mysqli_query($con, "SELECT * FROM "));


  $colorName = "";

  if ($product['class0'] != '') {
    $colorName .= "(" . mysqli_fetch_assoc(mysqli_query($con, "SELECT symbol FROM size_class WHERE id=" . $product['class0']))['symbol'] . ')';
  } else {
    echo 'class 0 is blank';
  }
  if ($product['class1'] != '') {
    $colorName .= " (" . $product['class1'] . ')';
  }

  if ($product['class2'] != '') {
    $colorName .= ' (' . $product['class2'] . ')';
  }


  if ($product['class3'] != '') {
    $colorName .= ' (' . $product['class3'] . ')';
  }


  $productsElems .=
    '<tr style="width:100%;border: 1px solid #e5e5e5b8;box-shadow:0px 2px #eee;">
            <td style="width: 20%;">
            <img style="width:100px;height:100px;border-radius:5px;" src="' . BASE_URL . 'asset/image/product/' . $prImg['image'] . '" alt="">
            </td>
            <td style="width: 60%;">
            <h4>' . $product['product_name'] . $colorName . '</h4>
            </td> 
            <td style="width: 20%;">
            <h4>Quantity :  ' . $product['quantity'] . '</h4>
            </td>  
        </tr>';
}
$productsElems .=  "  </tbody>
    </table>";
$order_id = $orderId;

include('emailer_html/membership/index.php');
include('emailer_html/membership/index2.php');
include('emailer_html/membership/admin.php');
$adminEmail = mysqli_fetch_assoc(mysqli_query($con, "SELECT email FROM footer WHERE id = '1'"))['email'];
// $adminEmail = 'afreen@maishainfotech.com';
if ($orderDetails['payment_mode'] == "Online" || $orderDetails['payment_mode'] == "wallet") {
  // $mail->AddAttachment($invoice, '', $encoding = 'base64', $type = 'application/pdf');
  $updateQ = mysqli_query($con, "UPDATE `order_details` SET `invoice`='$invoice' WHERE order_id ='$orderId'");
  $updateQ2 = mysqli_query($con, "UPDATE `order_tbl` SET `invoice_generated`=1 WHERE order_id ='$orderId'");
  $msg = 'Your invoice attached with this mail';
  sendEmail($email, 'MSG Order ID :' . $orderId, $orderCfmMaillOnline, $invoice);

  sendEmail($adminEmail, 'Recieved An Order', $orderCfmMaillAdmin);
  $responsemsg = sendOrderSuccessMsg($con, $mobile, $orderId);
}
// print_r($orderDetails);
// echo $orderDetails['payment_mode'];
if ($orderDetails['payment_mode'] == 'COD') {

  $msg = '';
  sendEmail($email, 'MSG Order ID :' . $orderId, $orderCfmMaillCod);

  sendEmail($adminEmail, 'Recieved An Order', $orderCfmMaillAdmin);
  $responsemsg = sendOrderSuccessMsg($con, $mobile, $orderId);
}
?>
<script>
  var url = "header.php";
  $(".mini_cart").load(url + " #cartDiv");
  $('.cart-add').text('0');
</script>