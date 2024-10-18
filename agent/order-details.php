<style>
    .wrap-cell {
        word-wrap: break-word; /* Breaks the word if necessary */
        word-break: break-all; /* Ensures long words are broken */
        white-space: normal; /* Allows text to wrap */
    }
</style>

<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
    error_reporting(0);
    include ('includes/header.php');
    date_default_timezone_set("Asia/kolkata");
    $date=date("Y-m-d");
    $time=date("H:i:s");
    $order_id=$_GET['order_id'];
    unset($_SESSION['proid']);
    unset($_SESSION['trackid']);
 
?>
<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet" />
<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <div class="panel-heading">
                <h3 class="panel-title">order Details</h3>
            </div>

            <div class="panel-content">
                <div class="panel-subtitle">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
    $tracking_query=mysqli_query($conn,"SELECT * FROM `order_tbl` WHERE order_id='$order_id'");
    $tracking_data=mysqli_fetch_array($tracking_query);
    $userid=$tracking_data['userid'];
    $order_tbl_id=$tracking_data['id'];
    $sel_warehouse_query=mysqli_query($conn,"SELECT * FROM `warehouse_schedule` WHERE order_id='$order_id' AND status='Active'");
    $sel_warehouse_data=mysqli_fetch_array($sel_warehouse_query);
    $warehouseid=$sel_warehouse_data['warehouse_id'];
    $ware_sel=mysqli_query($conn,"SELECT * FROM `warehouse` WHERE id=$warehouseid");
    $ware_data=mysqli_fetch_array($ware_sel);
    $sel_deliveryman=mysqli_query($conn,"SELECT * FROM `delivery_schedule` WHERE order_id='$order_id' AND status='Active'");
    $sel_deliveryman_data=mysqli_fetch_array($sel_deliveryman);
    $deli_id=$sel_deliveryman_data['deliverymen_id'];
    $sel_deliveryman_name=mysqli_query($conn,"SELECT * FROM `deliverymen` WHERE id=$deli_id");
    $deli_name_data=mysqli_fetch_array($sel_deliveryman_name);
    $query=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
    $status_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE order_id='$order_id' ORDER BY id DESC");
    $status_data=mysqli_fetch_array($status_query);
    $user_query=mysqli_query($conn,"SELECT * FROM `user` WHERE id='$userid'");
    $user_data=mysqli_fetch_array($user_query);
    $ship_query=mysqli_query($conn,"SELECT * FROM `shiping_address` WHERE `user_id`='$userid' AND order_id = '$order_id' ORDER BY id DESC");
    $ship_data=mysqli_fetch_array($ship_query);      
?>                          
                            <!-- Showing Oreder Details -->
                            <table class="table table-responsive table-simple" width="100%">
                                <tr>
                                    <th>Order Id</th>
                                    <td style="color: green;">: <?php echo $order_id; ?></td>
                                    <td></td>
                                    <th>Order Date</th>
                                    <td>:
                                        <?php echo $tracking_data['date']; ?>&nbsp;<?php echo $tracking_data['time']; ?>
                                    </td>
                                </tr>

                                <!-- <tr>
                                            <th>Delivery Men Name</th>
                                            <td class="btn btn-link collapse-icon collapsed" data-toggle="collapse" data-target="#collapse03" <?php if($deli_name_data['name']=='') { ?>style="color: #007bff;" <?php }else{ ?>style="color: green;" <?php } ?> >: <?php if($deli_name_data['name']==''){ echo "No Delivery Men Assign"; }else{ ?><a href="delivery-men-details.php?did=<?php echo $deli_name_data['id']; ?>" target="_blank"> <?php echo $deli_name_data['name']; } ?></a></td>
                                            <td></td>
                                            <th>Warehouse</th>
                                            <td class="btn btn-link collapse-icon collapsed" data-toggle="collapse" data-target="#collapse04" <?php if($ware_data['name']=='') { ?>style="color: #007bff;" <?php }else{ ?>style="color: green;" <?php } ?> >: <?php if($ware_data['name']==''){ echo "No Warehouse Assign"; }else{?><a href="warehouse.php?flag=3&wid=<?php echo $ware_data['id'] ?>" target="_blank"><?php  echo $ware_data['name'].",".$ware_data['mobile']; } ?></a></td>
                                            
                                        </tr>-->
                                <tr>
                                    <th>Current Order Status</th>
                                    <td class="btn btn-link collapse-icon collapsed" data-toggle="collapse"
                                        data-target="#collapse05"
                                        <?php if($tracking_data['order_status']=="Completed"){ ?> style="color: green;"
                                        <?php }else{ ?>style="color: #FFA500;" <?php } ?>>:
                                        <?php echo $tracking_data['order_status']; ?>

                                    </td>
                                    <td></td>
                                    <th>Payment Type</th>
                                    <td style="color: green;">: <?php echo $tracking_data['payment_type']; ?></td>
                                </tr>

                                <?php if($tracking_data['payment_type'] == 'Cash On Delivery'){?>
                                <tr>
                                    <th>Invoice : </th>
                                    <td> <button type="button" class="btn btn-outline-primary"
                                            onclick="generateInvoice('<?= $order_id; ?>')">Generate Invoice</button>
                                        <?php
                                       
                                        $countInvoice = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM invoice_generate  WHERE order_id ='$order_id'"));
                                        if($countInvoice > 0){
                                            $uid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM invoice_generate  WHERE order_id ='$order_id'"))['user_id'];
                                        ?>

                                        <?php $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
                                            $token = str_shuffle($str);?>

                                        <a onclick="window.open('../invoice.php?<?=  $token?>=<?=$token?>&oid=<?= $order_id ?>&<?= $token ;?>=<?=$token;?>&uid=<?=$uid;?>&<?= $token ;?>=<?=$token;?>')"
                                            class="btn btn-outline-primary">View Invoice </a>

                                        <?php }?>

                                    </td>
                                </tr>

                                <?php }?>



                                <?php 
                                            if($tracking_data['promo_code_id'] > 0){
                                                $promo_id=$tracking_data['promo_code_id'];
                                                $sel_promo=mysqli_query($conn,"SELECT * FROM `promo_code` WHERE id='$promo_id'");
                                                $promo_data=mysqli_fetch_array($sel_promo);
                                        ?>
                                <tr>
                                    <th>Promo Code</th>
                                    <td style="color: green;">: <?php echo $promo_data['code']; ?></td>
                                    <td></td>
                                    <th>Promo Code Discount</th>
                                    <td>:
                                        <?php if($promo_data['percentage']=='yes') echo $promo_data['price']." %"; else echo "₹ ".$promo_data['price']; ?>
                                    </td>
                                </tr>

                                <?php } ?>




                            </table>
                            
                            <!-- Showing Product Details -->
                            
                        </div>
                    </div>




                </div>

                <div id="accordion01">


                    <?php

include('order-details/user-details.php');
include('order-details/products-details.php');
// include('order-details/vender-details.php');
// include('order-details/delivery-men-details.php');
// include('order-details/warehouse-details.php');
// include('order-details/products-delivery-date.php');
// include('order-details/update-products-status.php');
// include('order-details/assign_delivery.php');

?>

                </div>
            </div>
            <!-- Order Details Section Ends Here -->
            
            <hr>
            <!-- Showing Product Details -->
            <div class="panel-heading">
                <h3 class="panel-title">Product Details</h3>
            </div>
            <div class="panel-content">
                <div class="panel-subtitle">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-responsive table-simple" width="100%">
                                <tr>
                                    <th>Tracking Id</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Total Price</th>
                                    <th>Payment Type</th>
                                    <th>Payment Status</th>
                                    <th>Order Status</th>
                                </tr>
                                <?php while($product = mysqli_fetch_assoc($query)){ ?>
                                    <?php 
                                        //echo "<pre>"; print_r($product); 
                                        $productOrderStatusSql = "SELECT * FROM `order_status` WHERE `order_id` = '$order_id' AND `tracking_id` = '".$product['tracking_id']."' ORDER BY `id` DESC LIMIT 1;";
                                        $productOrderStatus = mysqli_fetch_assoc(mysqli_query($conn, $productOrderStatusSql));
                                        
                                    ?>
                                    
                                    <tr>
                                        <td><?= $product['tracking_id'] ?></td>
                                        <td><i><?= $product['productname'] ?></i></td>
                                        <td><?= $product['quantity'] ?></td>
                                        <td><?= $product['price'] ?></td>
                                        <td><?= $product['payment_type'] ?></td>
                                        <td style="color:<?php echo $product['payment_status'] == 'Success'?'green':'red'; ?>;"> <?= $product['payment_status'] ?> </td>
                                        <td style="color:<?php echo $productOrderStatus['tracking_status'] == 'Delivered'?'green':''; ?>;"><b><?= $productOrderStatus['tracking_status'] ?></b></td>
                                    </tr>
                                    
                                <?php }?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product Details Section Ends Here -->
            
        </div>
    </section>
    <!-- Main Content End -->

    <!-- Main Footer Start -->


    <?php  include('includes/footer.php'); ?>
    <script>
    function generateInvoice(orderId) {
        // console.log(orderId)
        $.ajax({
            url: '../dadmin/generateCODInvoice.php',
            data: {
                orderid: orderId
            },
            dataType: 'JSON',
            type: 'POST',
            success: function(data) {
                console.log(data)
                $('#snackbar').text(data.msg);
                $('#snackbar').addClass('show');
                setTimeout(() => {
                    $('#snackbar').removeClass('show');
                    window.location.reload();
                }, 1000);
            }
        })
    }
    </script>