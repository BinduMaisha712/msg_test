<?php
if(file_exists('./dadmin/functions/common.php')){
    include_once('./dadmin/functions/common.php');
}elseif(file_exists('../dadmin/functions/common.php')){
    include_once('../dadmin/functions/common.php');
}elseif(file_exists('../../dadmin/functions/common.php')){
    include_once('../../dadmin/functions/common.php');
}elseif(file_exists('../../../dadmin/functions/common.php')){
    include_once('../../../dadmin/functions/common.php');
}elseif(file_exists('../../../../dadmin/functions/common.php')){
    include_once('../../../../dadmin/functions/common.php');
}

// include_once('../dadmin/functions/common.php');
// include('../config.php');

$order_id = ORDERID;
$token = TOKEN;

$query1 = "SELECT  ig.*,ot.payment_type,ot.payment_mode,ot.orderprice,ot.gst,ot.shipping,ot.promo_code_id
        FROM invoice_generate as ig
        INNER JOIN order_tbl as ot on ot.order_id=ig.order_id
        WHERE ig.order_id = '" . $order_id . "'";
  
        
$invoiceDetail =  mysqli_fetch_array(mysqli_query($con, $query1));
// print_r($invoiceDetail);

$query2 = mysqli_query($con, "SELECT p.*,od.* FROM products p, order_details od WHERE od.productid = p.id AND od.order_id = '".$order_id."'");
$prArr = [];
$cancelledProPrice = 0;
while($item = mysqli_fetch_assoc($query2))
{
    // print_r($item);
    $productStatus = mysqli_fetch_assoc(mysqli_query($con, "SELECT tracking_status FROM order_status WHERE order_id = '$order_id' AND tracking_id = '".$item['tracking_id']."' ORDER BY id DESC"))['tracking_status'];

  if($productStatus != 'Cancelled'){
      array_push( $prArr, $item);
  }
  else{
      $cancelledProPrice += $item['price'] + $item['gst'];
  }
}
$invoiceDetail['products'] =  $prArr;
// print_r($invoiceDetail['products']);

// SHIPPING ADDRESS 
$query3 = "SELECT u.id,u.order_id,u.first_name,u.last_name,u.phone,u.email, u.flat,u.street, u.locality,u.city,u.zip_code,sl.state,c.country_name, u.addr_type 
FROM shiping_address as u 
LEFT JOIN countries as c on c.id=u.country
LEFT JOIN state_list as sl on sl.id=u.state
WHERE u.order_id = '".$order_id."'";

$queryQ = mysqli_query($con, $query3);

$r = mysqli_fetch_array($queryQ);

$address = ($r['flat'] != "")? $r['flat'].", ":"";
$address .= ($r['street'] != "")? $r['street'].", ":"";
$address .=  ($r['locality'] != "")? $r['locality'].", ":"" ;
$address .= ($r['city'] != "")? $r['city'].", ":"" ;
$address .= ($r['state'] != "")? $r['state'].", ":"" ;
$address .= ($r['country_name'] != "")? $r['country_name']:"" ;
$address .= ($r['zip_code'] != "")? " - ".$r['zip_code']:"";

$r['address'] = $address;

$invoiceDetail['shipping_address'] = $r; // Query was successful
 
// BILLING ADDRESS 
$query4 = "SELECT ot.order_id,ot.payment_type,ot.payment_status,ot.payment_mode,
u.first_name,u.last_name,u.phone,u.email, u.flat,u.street, u.locality,u.city,u.zip_code,
sl.state,c.country_name,u.addr_type,ot.shipping,ot.orderprice,occ.coupon_code,occ.discount_price
FROM order_tbl as ot
LEFT JOIN billing_address as u on ot.order_id=u.order_id
LEFT JOIN countries as c on c.id=u.country
LEFT JOIN state_list as sl on sl.id=u.state
LEFT JOIN order_coupon_code as occ on occ.order_id=ot.order_id
WHERE ot.order_id = '".$order_id."'";

$result2 = mysqli_fetch_assoc(mysqli_query($con, $query4));

$address = ($result2['flat'] != "")? $result2['flat'].", ":"";
$address .= ($result2['street'] != "")? $result2['street'].", ":"";
$address .=  ($result2['locality'] != "")? $result2['locality'].", ":"" ;
$address .= ($result2['city'] != "")? $result2['city'].", ":"" ;
$address .= ($result2['state'] != "")? $result2['state'].", ":"" ;
$address .= ($result2['country_name'] != "")? $result2['country_name']:"" ;
$address .= ($result2['zip_code'] != "")? " - ".$result2['zip_code']:"";

$result2['address'] = $address;

$invoiceDetail['billing_address'] =  $result2;
$invoiceDetail['coupon_code'] = $result2['coupon_code'];
$invoiceDetail['discount_price'] = $result2['discount_price'];


//show logo
$logo = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM logo WHERE id = '1'"));

$totaltax=0;

// print_r($invoiceDetail);


ini_set('max_execution_time', 3000);
require('fpdf182/fpdf.php');
            

$pdf2 = new FPDF();
$pdf2->AliasNbPages();
$pdf2->AddPage();
$pdf2->SetFont('Times', '', 9); //need online data

$pdf2->Image('asset/image/logo/'.$logo['logo'], 14, 14, 30);
 
$pdf2->Cell(10);
// Title

$pdf2->Line(55, 15, 55, 40);


$pdf2->Text(57, 18, 'Invoice Number  :  #' . $invoiceDetail['invoice_no']);
$pdf2->Text(57, 25, 'Date  :  ' . date_format(date_create($invoiceDetail['invoice_date']), "d M, Y"));
// $pdf2->Text(57,31.4,'Payment Type  :  Cash');
$pdf2->Text(57, 31.4, 'Payment Mode  :  ' . $invoiceDetail['payment_type']);
$pdf2->Text(57, 38.4, 'Order ID  :  ' . $order_id);

$pdf2->SetXY(125, 14);
$pdf2->SetTextColor(10, 87, 162);
$pdf2->SetFillColor(255, 227, 214);
$pdf2->SetFont('Arial', 'B', 12);
$pdf2->Cell(75, 15, 'Shipping Details  :', 0, 0, 'L', true);

$pdf2->SetXY(125, 29);
$pdf2->SetTextColor(0, 0, 0);
$pdf2->SetFont('Times', '', 9);
$pdf2->Cell(0, 6, 'Name  :  ' . $invoiceDetail['shipping_address']['first_name'] . ' ' . $invoiceDetail['shipping_address']['last_name'], 0, 1, 'L', true);
$pdf2->SetXY(125, 35);
$pdf2->Cell(0, 6, 'Mobile No.  :  ' . $invoiceDetail['shipping_address']['phone'], 0, 1, 'L', true);
$pdf2->SetXY(125, 41);
$pdf2->Cell(0, 6, 'Email  :  ' . $invoiceDetail['shipping_address']['email'], 0, 1, 'L', true);
$pdf2->SetXY(125, 47);
$pdf2->MultiCell(0, 6, 'Address  : ' . $invoiceDetail['shipping_address']['address'], 0, 1, 'L', true);
 
$shippingBox = $pdf2->GetY();

$pdf2->ln(5);

//for company address        
$pdf2->SetFont('Times', 'B', 11);
$pdf2->SetTextColor(0, 0, 0);
$pdf2->Cell(0, 6, 'MSG', 0, 1);
$pdf2->SetFont('Times', '', 10);
$pdf2->Cell(0, 6, '' . '', 0, 1);
$pdf2->Cell(0, 6, 'Phone: ' . contactInfo('phone', $con), 0, 1);
$pdf2->Cell(0, 6, 'Email: ' . contactInfo('email', $con), 0, 1);
//$pdf2->Cell(0, 6, 'Website: https://organicsfeed.com', 0, 1);
$pdf2->Cell(0, 6, '', 0, 1);
// $pdf2->Cell(0,6,'GST: 100346161100003',0,1);
$pdf2->SetDrawColor(1, 1, 1);

$pdf2->SetXY(125, $shippingBox + 2);
$pdf2->SetTextColor(10, 87, 162);
$pdf2->SetFillColor(255, 227, 214);
$pdf2->SetFont('Arial', 'B', 12);
$pdf2->Cell(0, 19, 'Billing Details  :', 0, 0, 'L', true);

$pdf2->SetXY(125, $shippingBox + 18);
$pdf2->SetTextColor(0, 0, 0);
$pdf2->SetFont('Times', '', 9);
$pdf2->Cell(0, 6, 'Name  :  ' . $invoiceDetail['billing_address']['first_name'] . ' ' . $invoiceDetail['billing_address']['last_name'], 0, 1, 'L', true);
$pdf2->SetXY(125, $shippingBox + 24);
$pdf2->Cell(0, 6, 'Mobile No.  :  ' . $invoiceDetail['billing_address']['phone'], 0, 1, 'L', true);
$pdf2->SetXY(125, $shippingBox + 30);
$pdf2->Cell(0, 6, 'Email  :  ' . $invoiceDetail['billing_address']['email'], 0, 1, 'L', true);
$pdf2->SetXY(125, $shippingBox + 36);
$pdf2->MultiCell(0, 6, 'Address  :  ' . $invoiceDetail['billing_address']['address'], 0, 1, 'L', true);



$pdf2->ln(5);


$pdf2->Line(10, 115, 100, 115);
$pdf2->SetXY(10, 122);

$pdf2->Ln(5);
$pdf2->SetFont('Times', 'B', 8);
$pdf2->SetFillColor(220, 220, 220);
$pdf2->SetTextColor(0, 0, 0);

//table
$pdf2->Cell(92, 10, 'Product', 0, 0, 'C', 1);
$pdf2->Cell(30, 10, 'Unit Price', 0, 0, 'C', 1);
// $pdf2->Cell(35,10,'Value (Ex Tax)',0,0,'C',1);
$pdf2->Cell(20, 10, 'Quantity', 0, 0, 'C', 1);
$pdf2->Cell(20, 10, 'Tax', 0, 0, 'C', 1);
// $pdf2->Cell(25,10,'Tax',0,0,'C',1);
$pdf2->Cell(30, 10, 'Amount', 0, 0, 'C', 1);

$pdf2->SetFont('Times', '', 8.5);
$pdf2->SetFillColor(255, 227, 214);

$pdf2->Ln(10.5);
$lnNewRow = 0;

$totalAmount = 0;
// print_r($invoiceDetail);
// $totalProduct = count($invoiceDetail['products']);
// echo '<pre>';

$totalTax = 0;
$product = $invoiceDetail['products'];
$pr = 1;
foreach($invoiceDetail['products'] as $presult){

if($presult['class0'] != ''){
 $getClass0 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM size_class WHERE id = " . $presult['class0']));
 $class0 = ' ('. $getClass0['symbol'] . ')';
}else{
    $class0 = '';
}
$class1 = ($presult['class1'] != '')? ' (' . $presult['class1'] . ')' :'';
$class2 = ($presult['class2'] != '')? ' (' . $presult['class2'] . ')' :'';
$class3 = ($presult['class3'] != '')? ' (' . $presult['class3'] . ')' :'';

$pdf2->Ln($lnNewRow + 1);

$celHeight = 10;
$cellWidth = 92;
$presult['productname'] = $presult['productname'] . $class0.$class1.$class2.$class3;

if ($pdf2->GetStringWidth($presult['productname'] ) < 92) {
    $line = 1;
} else {
    $textLength = strlen($presult['productname']);
    $errMargin = 10;
    $startChar = 0;
    $maxChar = 0;
    $textArray = array();
    $tmpString = "";

    while ($startChar < $textLength) {
        while ($pdf2->GetStringWidth($tmpString) < ($cellWidth - $errMargin) && ($startChar + $maxChar) < $textLength) {
            $maxChar++;
            $tmpString = substr($presult['product_name'], $startChar, $maxChar);
        }
        $startChar = $startChar + $maxChar;
        array_push($textArray, $tmpString);
        $maxChar = 0;
        $tmpString = "";
    }
    $line = count($textArray);
}

$xPos = $pdf2->GetX();
$yPos = $pdf2->GetY();

$pdf2->MultiCell($cellWidth, $celHeight, $presult['productname'], 0, 'L', 1);

$pdf2->SetXY($xPos + $cellWidth, $yPos);
if ($line > 1) {
    $h = $line * $celHeight;
} else {
    $h = 10;
}

$unitPrice = $presult['price'] / $presult['quantity'];

$product_tax = $presult['gst'] ?? 0;
// $totalPriceProduct = $unitPrice * $presult['quantity'];
// $totalPriceProductTAX = ($totalPriceProduct / 100) * $product_tax;
// $GetProductTAX = $totalPriceProductTAX . ' (' . $product_tax . '%)';

if ($invoiceDetail['payment_mode'] == "Online" || $invoiceDetail['payment_mode'] == "wallet") {
    if ($invoiceDetail['gst']==""){
            $totaltax = $totaltax+$product_tax;
        }else{
            $totaltax = $invoiceDetail['gst'];
        }

} else {
  $totaltax = $totaltax+$product_tax;
}


// $value = $unitPrice * ($product['gst']/100);

// $amount = $product['price']*$product['quantity'];
$pdf2->Cell(30, $h, 'Rs. ' . number_format($unitPrice, 2), 0, 0, 'C', 1);
// $pdf2->Cell(35,$h,'Rs. '.number_format(($unitPrice-$value),2),0,0,'C',1);
$pdf2->Cell(20, $h, $presult['quantity'], 0, 0, 'C', 1);
$pdf2->Cell(20, $h, 'Rs. ' . $product_tax, 0, 0, 'C', 1);
// $pdf2->Cell(25,$h,$product['gst'].'%',0,0,'C',1);
$pdf2->Cell(30, $h, 'Rs. ' . number_format($presult['price']+$product_tax, 2), 0, 0, 'C', 1);

$lnNewRow = $h;

$totalAmount = $totalAmount + $presult['price'];

$pr ++ ; 

} 

$pdf2->Ln(5);


$pdf2->SetFont('Times', '', 9.5);
$pdf2->SetFillColor(220, 220, 220);
$pdf2->Ln(18);
$pdf2->Cell(48, 8, 'SUBTOTAL', 0, 0, 'L', 1);
$pdf2->SetFillColor(255, 227, 214);
$pdf2->Cell(48, 8, 'Rs. ' . number_format($invoiceDetail['orderprice'] - $totaltax - $cancelledProPrice, 2), 0, 0, 'C', 1);
$pdf2->Ln(8);

$pdf2->SetFillColor(0, 0, 0);
$pdf2->Ln(1);

if ($invoiceDetail['promo_code_id'] != "") {

    $pdf2->SetFillColor(220, 220, 220);
    $pdf2->Cell(48, 8, 'Promo Code (' . $invoiceDetail['coupon_code'] . ')', 0, 0, 'L', 1);
    $pdf2->SetFillColor(255, 227, 214);
    $pdf2->Cell(48, 8, '- Rs ' . number_format($invoiceDetail['discount_price'], 2), 0, 0, 'C', 1);

    $pdf2->Ln(8);

    $pdf2->SetFillColor(0, 0, 0);
    $pdf2->Ln(1);
}

if ($invoiceDetail['shipping'] != 0) {

    $pdf2->SetFillColor(220, 220, 220);
    $pdf2->Cell(48, 8, 'Shipping Charge', 0, 0, 'L', 1);
    $pdf2->SetFillColor(255, 227, 214);
    $pdf2->Cell(48, 8, '+ Rs ' . number_format($invoiceDetail['shipping'], 2), 0, 0, 'C', 1);

    $pdf2->Ln(8);

    $pdf2->SetFillColor(0, 0, 0);
    $pdf2->Ln(1);
}

$pdf2->SetFillColor(220, 220, 220);
$pdf2->Cell(48, 8, 'Tax', 0, 0, 'L', 1);
$pdf2->SetFillColor(255, 227, 214);
$pdf2->Cell(48, 8, 'Rs ' . number_format($totaltax, 2), 0, 0, 'C', 1);

$pdf2->Ln(8);

$pdf2->SetFillColor(0, 0, 0);
$pdf2->Ln(1);
if($invoiceDetail['shipping'] == 0){
    $shipCharge = 0;
}
else{
   $shipCharge = $invoiceDetail['shipping'];
}

$pdf2->SetFillColor(220, 220, 220);
$pdf2->Cell(48, 8, 'Total', 0, 0, 'L', 1);
$pdf2->SetFillColor(255, 227, 214);
$pdf2->Cell(48, 8, 'Rs. ' . number_format($invoiceDetail['orderprice'] - $cancelledProPrice+ $shipCharge, 2) , 0, 0, 'C', 1);
$pdf2->Ln(8);

$pdf2->SetFont('Times', '', 8);

// $pdf2->SetX(0);
$pdf2->Ln(15);

$pdf2->Cell(0, 6, '', 'C');
$pdf2->Ln(6);
$pdf2->Cell(3);
$pdf2->Cell(0, 6, '                                                                                             ***This is computer generated invoice***', 'C');
$pdf2->Ln(15);
$pdf2->Cell(0, -15, '-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------');

?>