<?php
error_reporting(0);

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

include('includes/header.php'); ?>
<style>
#recordsListView tr:hover {
    background: #F5F5F5;
}
</style>
<!-- Main Container Start -->
<main class="main--container">

    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <!-- Records List Start -->
            <div class="records--list" data-title="VIEW ORDERS">
                <table id="recordsListView">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Order Id</th>
                            <th>Payment Mode</th>
                            <th>Shipping Charge</th>
                            <th>Total Price</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $agent_id = $_SESSION['agent_loginid'];
                        $agenteml = mysqli_fetch_assoc(mysqli_query($conn, "SELECT email FROM agents WHERE id = '$agent_id'"))['email'];
                    
                        $agentuid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM user WHERE email = '$agenteml'"))['id'];
                        
                        if (isset($_GET['fromdate']) && isset($_GET['todate'])) {
                            $fromdate = $_GET['fromdate'];
                            $todate = $_GET['todate'];
                            $dateCondition = "`date` BETWEEN '" . $fromdate . "' AND '" . $todate . "' AND ";
                        } else {
                            $dateCondition = "";
                        }


                        if (!empty($_GET['status']) && $_GET['status'] == 'Complete') {
                            $mysqlQuery = "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . " order_status = 'Completed' and userid='$agentuid' ORDER BY `id` DESC";
                            //   echo $mysqlQuery; 
                            //   exit();
                            $query = mysqli_query($conn, $mysqlQuery);
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'ProductComplete') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE order_id In (SELECT order_id FROM `order_status` WHERE " . $dateCondition . " tracking_status='Delivered') and userid='$agentuid' ORDER BY `id` DESC");
                        }
                        
                        // newly Added query
                        if (!empty($_GET['status']) && $_GET['status'] == 'all') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE $dateCondition userid='$agentuid' ORDER BY `id` DESC");
                        }
                        
                        if (!empty($_GET['status']) && $_GET['status'] == 'OutForDelivery') {
                            // $sql = "SELECT * FROM `order_status` AS os1 WHERE " . $dateCondition . " `user_id` = '$agentuid' AND `tracking_status` = 'your item out for delivery' AND NOT EXISTS (SELECT 1 FROM `order_status` AS os2 WHERE os2.`order_id` = os1.`order_id` AND os2.`tracking_status` IN ('Delivered', 'Cancelled'));";
                            $sql = "SELECT * FROM `order_tbl` WHERE `order_id` IN (SELECT os1.`order_id` FROM `order_status` AS os1 WHERE " . $dateCondition . " `user_id` = '$agentuid' AND `tracking_status` = 'your item out for delivery' AND NOT EXISTS (SELECT 1 FROM `order_status` AS os2 WHERE os2.`order_id` = os1.`order_id` AND os2.`tracking_status` IN ('Delivered', 'Cancelled')));";
                            $query = mysqli_query($conn, $sql);
                            
                        }
                        // newly added Query Ends Here

                        if (!empty($_GET['status']) && $_GET['status'] == 'Received') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . " order_id != '' and userid='$agentuid' ORDER BY `id` DESC");
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'productsReceived') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . " order_id != '' and userid='$agentuid' ORDER BY `id` DESC");
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'Pending') {
                            // $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . "  order_id NOT IN (SELECT order_id FROM `order_status`) and userid='$agentuid' ORDER BY `id` DESC");
                            $pendingOrdersSql = "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . " `order_status` = 'Pending'  and userid='$agentuid' ORDER BY `id` DESC";
                            // echo "$pendingOrdersSql";
                            $query = mysqli_query($conn, $pendingOrdersSql);
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'Cancelled') {
                            if (isset($_GET['fromdate']) && isset($_GET['todate'])) {
                            $query = mysqli_query($conn, "SELECT os.*, od.userid,payment_type, payment_status, payment_mode, orderprice FROM order_status os, order_tbl od WHERE od.date BETWEEN '" . $fromdate . "' AND '" . $todate . "' AND  os.tracking_status = 'Cancelled' AND od.order_id= os.order_id and od.userid='$agentuid' GROUP BY os.order_id  ORDER BY os.id DESC");
                            }else{
                              $query = mysqli_query($conn, "SELECT os.*, od.userid,payment_type, payment_status, payment_mode, orderprice FROM order_status os, order_tbl od WHERE  os.tracking_status = 'Cancelled' AND od.order_id= os.order_id and od.userid='$agentuid' GROUP BY os.order_id  ORDER BY os.id DESC");

                            }
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'CancelledProduct') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE order_id In (SELECT order_id FROM `order_status` WHERE " . $dateCondition . " tracking_status='Cancelled') and userid='$agentuid' ORDER BY `id` DESC");
                        }

                        if (!empty($_GET['status']) && $_GET['status'] == 'Delivered') {
                            // $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE `date` BETWEEN '$fromdate' AND '$todate' And order_id In (SELECT order_id FROM `order_status` WHERE tracking_status='Delivered' || 'your item has been delivered') AND order_id IN (SELECT order_id FROM `delivery_schedule`) and userid='$agentuid' ORDER BY `id` DESC");
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE `date` BETWEEN '$fromdate' AND '$todate' And order_id In (SELECT order_id FROM `order_status` WHERE tracking_status='Delivered' || 'your item has been delivered')  and userid='$agentuid' ORDER BY `id` DESC");
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'Delivery') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE order_id In (SELECT order_id FROM `order_status` WHERE (tracking_status!='Delivered' || 'Cancelled') AND `delivery_date` BETWEEN '$fromdate' AND '$todate') and userid='$agentuid' ORDER BY `id` DESC");
                        }

                        if (!empty($_GET['payment']) && $_GET['payment'] == 'Online') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . " payment_type='Online' and userid='$agentuid' ORDER BY id DESC");
                        }
                        if (!empty($_GET['payment']) && $_GET['payment'] == 'COD') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE payment_type='Cash On Delivery' AND order_id = ANY (SELECT order_id FROM `order_status` WHERE `date` BETWEEN '" . $fromdate . "' AND '" . $todate . "' AND tracking_status='Delivered') and userid='$agentuid' ORDER BY id DESC");
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'TOTAL PAYMENT') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . " and userid='$agentuid' ORDER BY `id` DESC");
                        }

                        if ((!isset($_GET['status'])) && (!isset($_GET['payment']))) {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE userid='$agentuid' ORDER BY id DESC");
                        }

                        $sr = 1;
                        while ($data = mysqli_fetch_array($query)) {
                            $order_id = $data['order_id'];
                            $userid = $data['userid'];

                        ?>
                        <tr style="cursor: pointer;" data-toggle="collapse" data-target="#collapse<?php echo $sr; ?>"
                            aria-expanded="false" aria-controls="collapse<?php echo $sr; ?>">
                            <td><?php echo $sr ?></td>
                            <td style="color: green;"><?php echo $data['order_id']; ?></td>
                            <td><?php echo $data['payment_mode']; ?></td>
                            <td><?php echo $data['shipping']; ?></td>
                            <td style="color: #e16123;">
                                <?php
                                    $canquery = mysqli_query($conn, "SELECT * FROM order_details WHERE order_id='$order_id' and user_id='$agentuid'");
                                    $canprice = 0;
                                    $cancelledProPrice = 0;
                                    $cancelledProducts =  0;
                                    $deliveredProducts = 0;
                                    $deliveredProductsPrice = 0;
                                    $totalProductsCount = mysqli_num_rows($canquery);
                                    // $query = mysqli_query($conn, "SELECT * FROM `order_details` WHERE order_id='$order_id'");
                                    while($pr = mysqli_fetch_assoc($canquery)){
                                        $orderSttsFetch = mysqli_fetch_array(mysqli_query($conn, "select od.*, os.tracking_status from order_details od, order_status os where od.order_id='" . $order_id . "' AND od.order_id = os.order_id AND od.tracking_id=os.tracking_id AND od.productid='" . $pr['productid'] . "' and od.user_id='$agentuid' ORDER BY os.id DESC LIMIT 1;"))['tracking_status'];
                              
                                        if($orderSttsFetch == 'Cancelled'){
                                            $cancelledProPrice += $pr['price'] + $pr['gst'];
                                            $cancelledProducts ++;
                                        }
                                        if($orderSttsFetch == 'Delivered'){
                                            $deliveredProducts ++;
                                            $deliveredProductsPrice += $pr['price'] + $pr['gst'];
                                        }
                                    }
                                    while ($candata = mysqli_fetch_array($canquery)) {
                                        $tracking_id = $candata['tracking_id'];
                                        $can_query = mysqli_query($conn, "SELECT * FROM order_details WHERE tracking_id IN (SELECT tracking_id FROM `order_status` WHERE tracking_id='$tracking_id' AND tracking_status='Cancelled' AND reason != 'Transaction Failed') and user_id='$agentuid'");
                                        if (mysqli_num_rows($can_query) > 0) {
                                            $can_data = mysqli_fetch_array($can_query);
                                            $can_price = $can_data['quantity'] * $can_data['price'];
                                            $canprice += $can_price;
                                        }
                                    }
                                    ?>
                                <span><i class="fa fa-inr"></i>&nbsp;</span>&nbsp;<?php echo $data['orderprice'] + 100   ; ?>
                                <!--<span><i class="fa fa-inr"></i>&nbsp;</span>&nbsp;<?php echo  $deliveredProductsPrice ?>-->

                                <?php unset($canprice); ?>
                            </td>
                            <td <?php if ($data['payment_status'] == 'Success') { ?> style="color:green;"
                                <?php } if ($data['payment_status'] == 'Pending') { ?> style="color:#007bff;"
                                <?php }  if ($data['payment_status'] == 'Failed') {  ?> style="color: red;" <?php } ?>>

                                <?php if( $totalProductsCount - $cancelledProducts == 0 ){ echo 'Cancelled';}
                                else if (( $deliveredProducts + $cancelledProducts == $totalProductsCount) && $data['payment_mode']=='COD'){
                                    echo 'Success';
                                }
                                else { echo  $data['payment_status']; }
                                 ?>
                            </td>



                            <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td>
                            <td><a href="order-details.php?order_id=<?php echo $data['order_id']; ?>"
                                    class="btn btn-success" target="_blank">view</a></td>

                        </tr>
                    <tbody id="collapse<?php echo $sr; ?>" class="collapse <?php if ($sr == 1) echo "show"; ?>"
                        aria-labelledby="heading<?php echo $sr; ?>" data-parent="#accordionExample">
                        <tr>
                            <th></th>
                            <th>Sr.No</th>
                            <th>Tracking Id</th>
                            <th>Payment</th>

                            <?php
                            $deliveryStatusQ = "SELECT id FROM order_details WHERE " . $dateCondition . " tracking_id IN (SELECT tracking_id FROM order_status WHERE tracking_status='Delivered') AND order_id='$order_id' and user_id='$agentuid'";
                            $deliveryStatusQuery = mysqli_query($conn, $deliveryStatusQ);
                            $num = mysqli_num_rows($deliveryStatusQuery);
                            if ($num > 0) {
                            ?>
                            <th colspan="2" class="text-center">Status</th>
                            <th>Delivery Date</th>
                            <?php
                            } else {
                            ?>
                            <th colspan="3" class="text-center">Status</th>
                            <?php
                            }
                            ?>
                            <th></th>
                        </tr>
                        <?php
                            if (isset($_GET['status']) && $_GET['status'] == 'Delivered') {
                                $pro_select = mysqli_query($conn, "SELECT  DISTINCT tracking_id FROM `order_status` WHERE delivery_date BETWEEN '$fromdate' AND '$todate' AND order_id='$order_id' and user_id='$agentuid'");
                            } else {
                                $pro_select = mysqli_query($conn, "SELECT * FROM `order_details` WHERE order_id='$order_id' and user_id='$agentuid'");
                            }
                            $sn = 1;
                            while ($pro_data = mysqli_fetch_array($pro_select)) {
                                $tracking_id = $pro_data['tracking_id'];

                                $status_query = mysqli_query($conn, "SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' and user_id='$agentuid' ORDER BY id DESC");

                                $status_data = mysqli_fetch_array($status_query);

                        ?>
                        <tr>
                            <td></td>
                            <td><?php echo $sn; ?></td>
                            <td><?php echo $tracking_id; ?></td>

                            <td <?php if (($data['payment_type'] == "Online") && ($data['payment_status'] == "Success")) { ?>
                                style="color: green;"
                                <?php } else if (($data['payment_type'] == "Cash On Delivery") && ($status_data['tracking_status'] == "Delivered")) { ?>
                                style="color: green;" <?php } else if ($data['payment_status'] == 'Pending') { ?>
                                style="color:#007bff;"
                                <?php    }
                                                                                                                                                                                                                                                                                                                                                                if ($data['payment_status'] == 'Failed') {  ?>
                                style="color: red;" <?php } ?>>
                                <?php if (($data['payment_type'] == "Online") && ($data['payment_status'] == "Success")) {
                                        echo $data['payment_status'];
                                    } else if (($data['payment_type'] == "Cash On Delivery") && ($status_data['tracking_status'] == "Delivered")) {
                                        echo 'Success';
                                    } else {
                                        echo $data['payment_status'];
                                    } ?>

                            </td>


                            <?php
                                $deliveryStatusQuery = mysqli_query($conn, $deliveryStatusQ);
                                // echo $deliveryStatusQ;
                                $num = mysqli_num_rows($deliveryStatusQuery);
                                if ($num > 0) {
                                ?>
                            <td colspan="2" <?php if ($status_data['tracking_status'] == "Cancelled") { ?>
                                style="color: #ff4040;"
                                <?php } elseif ($status_data['tracking_status'] == "Ordered and Approved") { ?>style="color: green;"
                                <?php } elseif ($status_data['tracking_status'] == "Delivered") { ?>
                                style="color: green;" <?php } elseif ($status_data['tracking_status'] == '') { ?>
                                style="color:#007bff;" <?php } else { ?>style="color: #20c997;" <?php } ?>> <?php if ($status_data['tracking_status'] == '') {
                                        echo "pending";
                                    } else {
                                        echo $status_data['tracking_status'] . "&nbsp;(" . $status_data['date'] . "&nbsp;" . $status_data['time'] . ")";
                                    } ?>

                            </td>
                            <td>
                                <?php
                                    $date_sel = mysqli_query($conn, "SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' AND delivery_date!='' and user_id='$agentuid'");
    
                                    $date_data = mysqli_fetch_array($date_sel);
                                   if ($date_data && !is_null($date_data['delivery_date']) && !is_null($date_data['delivery_time'])) {
                                        echo $date_data['delivery_date'] . "&nbsp" . $date_data['delivery_time'];
                                    } else {
                                        echo "";
                                    }
                                 ?>
                            </td>
                            <?php
                                } else {
                                ?>
                            <td colspan="3" <?php if ($status_data['tracking_status'] == "Cancelled") { ?>
                                style="color: #ff4040;"
                                <?php } elseif ($status_data['tracking_status'] == "Ordered and Approved") { ?>style="color: green;"
                                <?php } elseif ($status_data['tracking_status'] == "Delivered") { ?>
                                style="color: green;" <?php } elseif ($status_data['tracking_status'] == '') { ?>
                                style="color:#007bff;" <?php } else { ?>style="color: #20c997;" <?php } ?>> <?php if ($status_data['tracking_status'] == '') {
                                        echo "pending";
                                    } else {
                                        echo $status_data['tracking_status'] . "&nbsp;(" . $status_data['date'] . "&nbsp;" . $status_data['time'] . ")";
                                    } ?>

                            </td>
                            <?php
                                }
                                ?>



                            <td></td>
                        </tr>
                        <?php $sn++;
                            } ?>

                        <!-- invoice -->
                        <?php
                            // if ($status_data['tracking_status'] == "Your Order has been placed" || $status_data['tracking_status'] == "Delivered" || $status_data['tracking_status'] == "your item out for delivery" || $status_data['tracking_status'] == "Your item has been received in the hub nearest to you" || $status_data['tracking_status'] == "Your item has been picked up by courier partner" || $status_data['tracking_status'] == "Packed") {
                        ?>
                        <tr>
                             <?php if ($data['payment_type'] == 'Online'  && $data['payment_status'] != 'Pending') { ?>
                                    <td colspan="8" class="myinvoicetd">
                                        <!--C:\xampp2\htdocs\bodylove\invoice\invoice-pdf.php-->
                                        <a href="../invoice.php?oid=<?php echo $order_id; ?>" class="vewinv" target="_blank">View Invoice &nbsp;<i class="fa fa-file"></i></a>
                                    </td>
                                <?php } ?>
                                <?php if ($data['payment_type'] == 'Pay With Wallet'  && $data['payment_status'] != 'Pending') { ?>
                                    <td colspan="8" class="myinvoicetd">
                                        <!--C:\xampp2\htdocs\bodylove\invoice\invoice-pdf.php-->
                                        <a href="../invoice.php?oid=<?php echo $order_id; ?>" class="vewinv" target="_blank">View Invoice &nbsp;<i class="fa fa-file"></i></a>
                                    </td>
                                <?php } ?>
                        </tr>
                        <?php //} ?>
                    </tbody>


                    <?php $sr++;
                        } ?>

                    </tbody>
                </table>
            </div>
            <!-- Records List End -->
        </div>
    </section>
    <!-- Main Content End -->

    <!-- Main Footer Start -->
    <?php include('includes/footer.php'); ?>