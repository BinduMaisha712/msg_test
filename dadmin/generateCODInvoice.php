<?php
require('config/connection.php');

$data = array();
   if(isset($_POST['orderid']))
    {
       $order_id = $_POST['orderid'];
        
        // for tracking id
        
        $orderRow1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM order_status WHERE order_id ='$order_id'"));
        
        $checkit11 = mysqli_query($conn, "SELECT * FROM invoice_generate WHERE order_id='" . $order_id . "' and tracking_id='" . $orderRow1['tracking_id'] . "'");
           $uid = $orderRow1['user_id'];
            $invoiceNo = rand(10000, 99999);
            $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
            $txnDate = date('Y-m-d');
            $txnTime = date('H:i:s');
            $token = substr(str_shuffle($str), 0, 30);
            $tid = $orderRow1['tracking_id'];
            $query = "INSERT INTO `invoice_generate`( `user_id`, `order_id`, `tracking_id`, `invoice_no`, `invoice_date`, `invoice_time`, `token`) VALUES ('$uid','$order_id','$tid','$invoiceNo','$txnDate','$txnTime','$token')";
            
            mysqli_query($conn, $query);
      
        
        $userID = mysqli_fetch_assoc(mysqli_query($conn, "SELECT userid From order_tbl WHERE order_id = '$order_id'"))['userid'];
        $fetchUserDetails = mysqli_fetch_array(mysqli_query($conn, "SELECT u.firstname, u.lastname, u.email FROM user u, order_tbl ot WHERE u.id = ot.userid AND ot.order_id = '$order_id'"));
    
        
        $txnId = $orderRow1['tracking_id'];
        $token = mysqli_fetch_array(mysqli_query($conn, "SELECT token FROM `invoice_generate` WHERE order_id = '$order_id'"))['token'];
    
      
    
        define('ORDERID', $order_id);
        define('TOKEN', $token);
    
        include('invoice_admin/invoice-pdf.php');
        $destination = __DIR__ . '../../invoice/pdf_invoices/';

        $invoice_name = 'INVOICE_' . round(microtime(true)) . '.pdf';
         $pdf2->Output($destination . $invoice_name, 'F');
        
        $invoice = $destination . $invoice_name;
         
        
        
        mysqli_query($conn,"UPDATE `order_tbl` SET invoice_generated='1' WHERE order_id = '".$order_id."'");
    
       if(mysqli_query($conn,"UPDATE `invoice_generate` SET pdf='".$invoice_name."' WHERE order_id = '".$order_id."'")){
          $data['status'] = true;
          $data['msg']=  "Invoice Generated Successfully.";
       }else{
            $data['status'] = false;
          $data['msg']=  "Could Not Generate Invoice.";
       };
    

    }
    echo json_encode($data);

    ?>