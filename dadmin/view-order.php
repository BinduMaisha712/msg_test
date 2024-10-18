<?php
error_reporting(0);

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);

include('includes/header.php'); ?>
<style>
    #recordsListViewuu tr:hover {
        background: #F5F5F5;
    }

    .vieordr{
       justify-content: space-between;
       padding: 20px 20px 10px 20px
    }
</style>
<!-- Main Container Start -->
<main class="main--container">

    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <!-- Records List Start -->
            <div class="records--list">
                <div class="d-flex vieordr">
                    <h4>View Order</h4>
                    <button id="exportButton" class="btn btn-primary">Export to Excel</button>
                    
                </div>
                
                  <div class="filter-outer-container d-flex justify-content-center container-fluid" style="padding: 20px 20px;">
                    <div class="filter-container" style="padding: 20px; background-color: #f7f7f7; border-radius: 10px; width: 90%; margin: 0;">
                        <form id="combinedFilterForm" method="GET"  style="display: flex; flex-direction: column; gap: 15px;">

                            <div class="filter-item" style="display: flex; gap: 15px; flex-wrap: wrap;">
                                <div style="flex: 1;">
                                    <label for="fromdate" style="font-weight: bold; margin-bottom: 5px;">From Date:</label>
                                    <!-- <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Select start date"> -->
                                    <input type="date" id="fromdate" name="fromdate" class="form-control" placeholder="Select start date" value="<?php echo isset($_POST['fromdate']) ? $_POST['fromdate'] : ''; ?>">
                                </div>
                                <div style="flex: 1;">
                                    <label for="todate" style="font-weight: bold; margin-bottom: 5px;">To Date:</label>
                                    <input type="date" id="todate" name="todate" class="form-control" placeholder="Select end date" value="<?php echo isset($_POST['todate']) ? $_POST['todate'] : ''; ?>">
                                    <!-- <input type="date" id="todate" name="todate" class="form-control" placeholder="Select end date"> -->
                                </div>

                                <div style="flex: 1;">
                                    <label for="role" style="font-weight: bold; margin-bottom: 5px;">User Type:</label>
                                    <select id="role" name="role" class="form-control">
                                        <option value="All" <?php echo (isset($_POST['role']) && $_POST['role'] == 'All') ? 'selected' : ''; ?>>All</option>
                                        <option value="User" <?php echo (isset($_POST['role']) && $_POST['role'] == 'User') ? 'selected' : ''; ?>>User Type</option>
                                        <option value="agent" <?php echo (isset($_POST['role']) && $_POST['role'] == 'agent') ? 'selected' : ''; ?>>Agent Type</option>
                                    </select>
                                </div>

                                <div style="flex: 1;">
                                    <label for="order_status" style="font-weight: bold; margin-bottom: 5px;">Order Status:</label>
                                    <select id="order_status" name="order_status" class="form-control">
                                        <option value="All" <?php echo (isset($_POST['order_status']) && $_POST['order_status'] == 'All') ? 'selected' : ''; ?>>All Orders</option>
                                        <option value="Pending" <?php echo (isset($_POST['order_status']) && $_POST['order_status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                        <option value="Completed" <?php echo (isset($_POST['order_status']) && $_POST['order_status'] == 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                        <option value="Cancelled" <?php echo (isset($_POST['order_status']) && $_POST['order_status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
                                    </select>
                                </div>

                            </div>

                            <!-- Search Input -->
                            <div class="filter-item" style="flex: 1;">
                                <label for="search" style="font-weight: bold; margin-bottom: 5px;">Search Orders:</label>
                                <input type="text" id="search" name="search" class="form-control" placeholder="Search by customer Mobile Number / OrderId" 
                                 value="<?php echo isset($_POST['search']) ? $_POST['search'] : ''; ?>">
                                <!-- <input type="text" id="search" name="search" class="form-control" placeholder="Search by customer Mobile Number"> -->
                            </div>

                            <div class="filter-item" style="text-align: center;">
                                <button type="submit" class="btn btn-primary" style="width: 100px;">Apply</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <table id="recordsListViewuu" class="dataTable no-footer" role="grid" style="width:auto">
                    <thead>
                        <tr style="background:#f8f8f8;">
                            <th>Sr.No</th>
                            <th>Order Id</th>
                            <th>Payment Mode</th>
                            <th>Total Price</th>
                            <th>Payment</th>
                            <th>Date</th>
                            <th>Details</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                        $dateCondition = '';
                        $roleCondition = '';
                        $statusCondition = '';
                        $searchCondition = '';
                        
                        if (isset($_GET['fromdate']) && isset($_GET['todate']) && !empty($_GET['fromdate']) && !empty($_GET['todate'])) {
                            $fromdate = $_GET['fromdate'];
                            $todate = $_GET['todate'];
                            $dateCondition = "`date` BETWEEN '$fromdate' AND '$todate' AND ";
                        }
                        
                        if (isset($_GET['role']) && $_GET['role'] != 'All') {
                            $role = $_GET['role'];
                            $roleCondition = "`user_role` = '$role' AND ";
                        }
                        
                        if (isset($_GET['order_status']) && $_GET['order_status'] != 'All') {
                            $orderStatus = $_GET['order_status'];
                            $statusCondition = "`order_status` = '$orderStatus' AND ";
                        }
                        
                        if (isset($_GET['search']) && !empty($_GET['search'])) {
                            $search = $_GET['search'];
                            // $searchCondition = "(mobile LIKE '%$search%' OR order_id LIKE '%$search%') AND ";
                            $searchCondition = "SELECT * FROM `order_tbl` WHERE (customer_mobile LIKE '%$search%' OR order_id LIKE '%$search%')";


                        }
                        
                        
                        
                        if (isset($_GET['fromdate']) && isset($_GET['todate'])) {
                            $fromdate = $_GET['fromdate'];
                            $todate = $_GET['todate'];
                            $dateCondition = "`date` BETWEEN '" . $fromdate . "' AND '" . $todate . "' AND ";
                        } else {
                            $dateCondition = "";
                        }


                        if (!empty($_GET['status']) && $_GET['status'] == 'Completed') {
                            $mysqlQuery = "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . " order_status = 'Completed' ORDER BY `id` DESC";
                            //   echo $mysqlQuery; 
                            //   exit();
                            $query = mysqli_query($conn, $mysqlQuery);
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'ProductComplete') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE order_id In (SELECT order_id FROM `order_status` WHERE " . $dateCondition . " tracking_status='Delivered') ORDER BY `id` DESC");
                        }


                        if (!empty($_GET['status']) && $_GET['status'] == 'Received') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . " order_id != '' ORDER BY `id` DESC");
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'productsReceived') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . " order_id != '' ORDER BY `id` DESC");
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'Pending') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . "  order_id NOT IN (SELECT order_id FROM `order_status`) ORDER BY `id` DESC");
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'Cancelled') {
                            if (isset($_GET['fromdate']) && isset($_GET['todate'])) {
                            $query = mysqli_query($conn, "SELECT os.*, od.userid,payment_type, payment_status, payment_mode, orderprice FROM order_status os, order_tbl od WHERE od.date BETWEEN '" . $fromdate . "' AND '" . $todate . "' AND  os.tracking_status = 'Cancelled' AND od.order_id= os.order_id GROUP BY os.order_id  ORDER BY os.id DESC");
                            }else{
                              $query = mysqli_query($conn, "SELECT os.*, od.userid,payment_type, payment_status, payment_mode, orderprice FROM order_status os, order_tbl od WHERE  os.tracking_status = 'Cancelled' AND od.order_id= os.order_id GROUP BY os.order_id  ORDER BY os.id DESC");

                            }
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'CancelledProduct') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE order_id In (SELECT order_id FROM `order_status` WHERE " . $dateCondition . " tracking_status='Cancelled') ORDER BY `id` DESC");
                        }

                        if (!empty($_GET['status']) && $_GET['status'] == 'Delivered') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE `date` BETWEEN '$fromdate' AND '$todate' And order_id In (SELECT order_id FROM `order_status` WHERE tracking_status='Delivered' || 'your item has been delivered') AND order_id IN (SELECT order_id FROM `delivery_schedule`) ORDER BY `id` DESC");
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'Delivery') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE order_id In (SELECT order_id FROM `order_status` WHERE (tracking_status!='Delivered' || 'Cancelled') AND `delivery_date` BETWEEN '$fromdate' AND '$todate') ORDER BY `id` DESC");
                        }

                        if (!empty($_GET['payment']) && $_GET['payment'] == 'Online') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . " payment_type='Online' ORDER BY id DESC");
                        }
                        if (!empty($_GET['payment']) && $_GET['payment'] == 'COD') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE payment_type='Cash On Delivery' AND order_id = ANY (SELECT order_id FROM `order_status` WHERE `date` BETWEEN '" . $fromdate . "' AND '" . $todate . "' AND tracking_status='Delivered') ORDER BY id DESC");
                        }
                        if (!empty($_GET['status']) && $_GET['status'] == 'TOTAL PAYMENT') {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE " . $dateCondition . " ORDER BY `id` DESC");
                        }

                        if ((!isset($_GET['status'])) && (!isset($_GET['payment']))) {
                            $query = mysqli_query($conn, "SELECT * FROM `order_tbl` ORDER BY id DESC");
                        }
                        
                        // if ((isset($_GET)) && (!isset($_GET['status'])) && (!isset($_GET['payment']))) {
                        //     $query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE ".$dateCondition." ORDER BY `id` DESC");
                            
                        //     if ($query) {
                        //         echo "Query executed successfully.";
                        //     } else {
                        //         echo "Error: " . mysqli_error($conn);
                        //     }
                            
                        // }

                        $sr = 1;
                        while ($data = mysqli_fetch_array($query)) {
                            $order_id = $data['order_id'];
                            $userid = $data['userid'];

                        ?>
                            <tr style="cursor: pointer;" data-toggle="collapse" data-target="#collapse<?php echo $sr; ?>" aria-expanded="false" aria-controls="collapse<?php echo $sr; ?>">
                                <td><?php echo $sr ?></td>
                                <td style="color: green;"><?php echo $data['order_id']; ?></td>
                                <td><?php echo $data['payment_mode']; ?></td>
                                <td style="color: #e16123;">
                                    <?php
                                    $canquery = mysqli_query($conn, "SELECT * FROM order_details WHERE order_id='$order_id'");
                                    $canprice = 0;
                                    $cancelledProPrice = 0;
                                    $cancelledProducts =  0;
                                    $deliveredProducts = 0;
                                    $deliveredProductsPrice = 0;
                                    $totalProductsCount = mysqli_num_rows($canquery);
                                    // $query = mysqli_query($conn, "SELECT * FROM `order_details` WHERE order_id='$order_id'");
                                    while($pr = mysqli_fetch_assoc($canquery)){
                                        $orderSttsFetch = mysqli_fetch_array(mysqli_query($conn, "select od.*, os.tracking_status from order_details od, order_status os where od.order_id='" . $order_id . "' AND od.order_id = os.order_id AND od.tracking_id=os.tracking_id AND od.productid='" . $pr['productid'] . "' ORDER BY os.id DESC LIMIT 1;"))['tracking_status'];
                              
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
                                        $can_query = mysqli_query($conn, "SELECT * FROM order_details WHERE tracking_id IN (SELECT tracking_id FROM `order_status` WHERE tracking_id='$tracking_id' AND tracking_status='Cancelled' AND reason != 'Transaction Failed')");
                                        if (mysqli_num_rows($can_query) > 0) {
                                            $can_data = mysqli_fetch_array($can_query);
                                            $can_price = $can_data['quantity'] * $can_data['price'];
                                            $canprice += $can_price;
                                        }
                                    }
                                    // echo 'cancelled price is ' . $cancelledProPrice;
                                    // echo 'order price is ' . $data['orderprice'];
                                    // print_r($data);
                                    ?>
                                    <span><i class="fa fa-inr"></i>&nbsp;</span>&nbsp;<?php echo $data['orderprice'];?>
                                    <!--<span><i class="fa fa-inr"></i>&nbsp;</span>&nbsp;<?php echo  $deliveredProductsPrice ?>-->
                                  
                                    <?php unset($canprice); ?>
                                </td>
                                <td <?php if ($data['payment_status'] == 'Success') { ?> style="color:green;" <?php } if ($data['payment_status'] == 'Pending') { ?> style="color:#007bff;"  <?php }  if ($data['payment_status'] == 'Failed') {  ?> style="color: red;" <?php } ?>> 

                                <?php if( $totalProductsCount - $cancelledProducts == 0 ){ echo 'Cancelled';}
                                else if (( $deliveredProducts + $cancelledProducts == $totalProductsCount) && $data['payment_mode']=='COD'){
                                    echo 'Success';
                                }
                                else { echo  $data['payment_status']; }
                                 ?>
                                </td>



                                <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td>
                                <td><a href="order-details.php?order_id=<?php echo $data['order_id']; ?>" class="btn btn-success" target="_blank">view</a></td>

                            </tr>
                    <tbody id="collapse<?php echo $sr; ?>" class="collapse <?php if ($sr == 1) echo "show"; ?>" aria-labelledby="heading<?php echo $sr; ?>" data-parent="#accordionExample">
                       <tr>
                            <!-- <th></th> -->
                            <th>Sr.No</th>
                            <th>Tracking Id</th>
                            <th>Payment</th>
                            <th>Product Name</th>
                            <th>Sku Code</th>
                            <th>Hsn Code</th>

                            <?php
                            $deliveryStatusQ = "SELECT id FROM order_details WHERE " . $dateCondition . " tracking_id IN (SELECT tracking_id FROM order_status WHERE tracking_status='Delivered') AND order_id='$order_id'";
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
                        </tr>
                       <?php
                            if (isset($_GET['status']) && $_GET['status'] == 'Delivered') {
                                $pro_select = mysqli_query($conn, "SELECT  DISTINCT tracking_id FROM `order_status` WHERE delivery_date BETWEEN '$fromdate' AND '$todate' AND order_id='$order_id'");
                            } else {
                                // $pro_select = mysqli_query($conn, "SELECT * FROM `order_details` WHERE order_id='$order_id'");
                                $pro_select = mysqli_query($conn, "SELECT od.*, p.sku_code, p.hsn_code, p.product_name 
                                                            FROM `order_details` od 
                                                            JOIN `products` p ON od.productid = p.id 
                                                            WHERE od.order_id='$order_id'");
                            }
                            $sn = 1;
                            while ($pro_data = mysqli_fetch_array($pro_select)) {
                                $tracking_id = $pro_data['tracking_id'];
                                $product_name = isset($pro_data['product_name']) ? $pro_data['product_name'] : 'N/A'; 
                                $sku_code = isset($pro_data['sku_code']) ? $pro_data['sku_code'] : 'N/A'; 
                                $hsn_code = isset($pro_data['hsn_code']) ? $pro_data['hsn_code'] : 'N/A'; 

                                $status_query = mysqli_query($conn, "SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' ORDER BY id DESC");

                                $status_data = mysqli_fetch_array($status_query);

                        ?>
                             <tr>
                                <!-- <td></td> -->
                                <td><?php echo $sn; ?></td>
                                <td><?php echo $tracking_id; ?></td>

                                <td <?php if (($data['payment_type'] == "Online") && ($data['payment_status'] == "Success")) { ?> style="color: green;" <?php } else if (($data['payment_type'] == "Cash On Delivery") && ($status_data['tracking_status'] == "Delivered")) { ?> style="color: green;" <?php } else if ($data['payment_status'] == 'Pending') { ?> style="color:#007bff;" <?php    }
                                                                                                                                                                                                                                                                                                                                                                if ($data['payment_status'] == 'Failed') {  ?> style="color: red;" <?php } ?>>
                                    <?php if (($data['payment_type'] == "Online") && ($data['payment_status'] == "Success")) {
                                        echo $data['payment_status'];
                                    } else if (($data['payment_type'] == "Cash On Delivery") && ($status_data['tracking_status'] == "Delivered")) {
                                        echo 'Success';
                                    } else {
                                        echo $data['payment_status'];
                                    } ?>

                                </td>
                                <td><?php echo $product_name; ?></td> 
                                <td><?php echo $sku_code; ?></td> 
                                 <td><?php echo $hsn_code; ?></td> 

                                <?php
                                $deliveryStatusQuery = mysqli_query($conn, $deliveryStatusQ);
                                // echo $deliveryStatusQ;
                                $num = mysqli_num_rows($deliveryStatusQuery);
                                if ($num > 0) {
                                ?>
                                    <td colspan="2" <?php if ($status_data['tracking_status'] == "Cancelled") { ?> style="color: #ff4040;" <?php } elseif ($status_data['tracking_status'] == "Ordered and Approved") { ?>style="color: green;" <?php } elseif ($status_data['tracking_status'] == "Delivered") { ?> style="color: green;" <?php } elseif ($status_data['tracking_status'] == '') { ?> style="color:#007bff;" <?php } else { ?>style="color: #20c997;" <?php } ?>> <?php if ($status_data['tracking_status'] == '') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "pending";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo $status_data['tracking_status'] . "&nbsp;(" . $status_data['date'] . "&nbsp;" . $status_data['time'] . ")";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?>

                                    </td>
                                    <td>
                                        <?php
                                            $date_sel = mysqli_query($conn, "SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' AND delivery_date!=''");
                                            $date_data = mysqli_fetch_array($date_sel);
                                            if ($date_data !== null) {
                                                echo "" . $date_data['delivery_date'] . "&nbsp" . $date_data['delivery_time'];
                                            } else {
                                                echo "";
                                            }
                                            ?>
                                    </td>
                                <?php
                                } else {
                                ?>
                                    <td colspan="3" <?php if ($status_data['tracking_status'] == "Cancelled") { ?> style="color: #ff4040;" <?php } elseif ($status_data['tracking_status'] == "Ordered and Approved") { ?>style="color: green;" <?php } elseif ($status_data['tracking_status'] == "Delivered") { ?> style="color: green;" <?php } elseif ($status_data['tracking_status'] == '') { ?> style="color:#007bff;" <?php } else { ?>style="color: #20c997;" <?php } ?>> <?php if ($status_data['tracking_status'] == '') {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo "pending";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                                                                                                                                                                    echo $status_data['tracking_status'] . "&nbsp;(" . $status_data['date'] . "&nbsp;" . $status_data['time'] . ")";
                                                                                                                                                                                                                                                                                                                                                                                                                                                                } ?>

                                    </td>
                                <?php
                                }
                                ?>

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
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.15.6/xlsx.full.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#exportButton').click(function() {
                var wb = XLSX.utils.table_to_book(document.getElementById('recordsListViewuu'), {sheet: "Sheet JS"});
                XLSX.writeFile(wb, 'order_records.xlsx');
            });
        });
    </script>
    
      <script>
        function submitCombinedFilter(event) {
        event.preventDefault(); 

        let fromDate = document.getElementById('fromdate').value;
        let toDate = document.getElementById('todate').value;
        let role = document.getElementById('role').value;
        let orderStatus = document.getElementById('order_status').value;
        let search = document.getElementById('search').value;

        let queryParams = [];

        if (fromDate) {
            queryParams.push('fromdate=' + encodeURIComponent(fromDate));
        }
        if (toDate) {
            queryParams.push('todate=' + encodeURIComponent(toDate));
        }
        if (role && role !== 'All') {
            queryParams.push('role=' + encodeURIComponent(role));
        }
        if (orderStatus && orderStatus !== 'All') {
            queryParams.push('order_status=' + encodeURIComponent(orderStatus));
        }
        if (search) {
            queryParams.push('search=' + encodeURIComponent(search));
        }
        let url = 'view-order.php';
        if (queryParams.length > 0) {
            url += '?' + queryParams.join('&');
        }
        window.location.href = url;
    }

    </script>
