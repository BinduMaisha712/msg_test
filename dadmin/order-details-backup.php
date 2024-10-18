<?php
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
<link href="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.css" rel="stylesheet"/>
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
    $ship_query=mysqli_query($conn,"SELECT * FROM `shiping_address` WHERE `user_id`='$userid' ORDER BY id DESC");
    $ship_data=mysqli_fetch_array($ship_query);      
?>
                                            <table class="table table-responsive table-simple" width="100%" >
                                        <tr>
                                            <th>Order Id</th>
                                            <td style="color: green;">: <?php echo $order_id; ?></td>
                                            <td></td>
                                            <th>Order Date</th>
                                            <td>: <?php echo $tracking_data['date']; ?>&nbsp;<?php echo $tracking_data['time']; ?></td>
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
                                            <td class="btn btn-link collapse-icon collapsed" data-toggle="collapse" data-target="#collapse05" <?php if($tracking_data['order_status']=="Completed"){ ?> style="color: green;" <?php }else{ ?>style="color: #FFA500;" <?php } ?> >: <?php echo $tracking_data['order_status']; ?>
                                        
                                        </td>
                                    <td></td>
                                    <th>Payment Type</th>
                                            <td style="color: green;">: <?php echo $tracking_data['payment_type']; ?></td>
                                        </tr>
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
                                            <td>: <?php if($promo_data['percentage']=='yes') echo $promo_data['price']." %"; else echo "₹ ".$promo_data['price']; ?></td>
                                        </tr>
                                       
                                    <?php } ?>
                                        
                                    </table>
                                        </div>
                                    </div>
                                    
                                
                                    
                                    
                                </div>

                                <div id="accordion01">
                                    <!-- Card Start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="h5">
                                                <button class="btn btn-link collapse-icon" data-toggle="collapse" data-target="#collapse01" style="color: #725d93;">User Details</button>
                                            </h5>
                                        </div>

                                        <div id="collapse01" class="collapse show" data-parent="#accordion01">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <table class="table table-responsive table-simple" width="100%" >
                                                            <h5 style="color: #725d93;">Shipping Address :--</h5>
                                                            <tr>
                                                                <th>User</th>
                                                                <td>: <?php echo $ship_data['first_name'];?>&nbsp;<?php echo $ship_data['last_name'];?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Mobile</th>
                                                                <td>: <?php echo $ship_data['phone']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <td>: <?php echo $ship_data['email']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Address</th>
                                                                <td>: <?php echo $ship_data['flat']; ?>,<?php echo $ship_data['street']; ?>,<?php echo $ship_data['locality']; ?>,<?php echo $ship_data['landmark']; ?>,<?php echo $ship_data['city']; ?>,<?php echo $ship_data['zip_code']; ?>,<?php echo $ship_data['state']; ?>,<?php echo $ship_data['country']; ?> 
                                                                </td>
                                                            </tr>
                                                
                                                
                                                        </table>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <table class="table table-responsive table-simple" width="100%" >
                                                            <h5 style="color: #725d93;">Billing Address :--</h5>
                                                            <tr>

                                                                <th>Name</th>
                                                                <td>: <?php echo $user_data['firstname'];?>&nbsp;<?php echo $user_data['lastname'];?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Mobile</th>
                                                                <td>: <?php echo $user_data['mobile']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Email</th>
                                                                <td>: <?php echo $user_data['email']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Address</th>
                                                                <td>: <?php echo $user_data['flat']; ?>,<?php echo $user_data['street']; ?>,<?php echo $user_data['locality']; ?>,<?php echo $user_data['landmark']; ?>,<?php echo $user_data['city']; ?>,<?php echo $user_data['zipcode']; ?>,<?php echo $user_data['state']; ?>,<?php echo $user_data['country']; ?>
                                                                    
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>

                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card End -->

                                    <!-- Card Start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="h5">
                                                <button class="btn btn-link collapse-icon collapsed" data-toggle="collapse" data-target="#collapse02" style="color: #725d93;">Products Details</button>
                                            </h5>
                                        </div>

                                        <div id="collapse02" class="collapse" data-parent="#accordion01">
                                            <div class="card-body">
                                                <table class="table table-responsive table-simple">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Products Name</th>
                                    <th>Tracking Id</th>
                                    <th>Products Weight</th>
                                    <th>Products Quantity</th>
                                    <th>Products Price</th>
                                    <th>Products Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
<?php
    $sr=1;
     $status_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE order_id='$order_id' ORDER BY id DESC");
    $status_data=mysqli_fetch_array($status_query);
    while($data=mysqli_fetch_array($query))
    {
         $product_id=$data['productid'];
        $product_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$product_id");
        $product_data=mysqli_fetch_array($product_query);
        $img_query=mysqli_query($conn,"SELECT * FROM `image` WHERE p_id='".$product_data['product_code']."'");
        $img_data=mysqli_fetch_array($img_query);
     
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><a href="edit_product.php?id=<?php echo $product_data['product_code'];?>" target="_blank" ><?php echo $product_data['product_name'];?></a>  </td>
                                    <td><b><?php echo $data['tracking_id']; ?></b></td>
                                    <td><b><?php echo $product_data['weight']; ?></b></td>
                                    <!-- <td><a href="edit_product.php?id=<?php echo $product_data['product_code'];?>" target="_blank"><img src="../asset/image/product/<?php echo $img_data['image']; ?>" alt="cart-image" style="width: 30px; height: 30px;" /></a></td> -->
                                     <td><?php echo $data['quantity'];?></td>
                                    <td><?php echo $data['price']/$data['quantity']; ?></td>
                                    <td><?php echo $data['price']; ?></td>
                                    
                                </tr>                              
                                
<?php  $sr++; } ?>
        <?php
        $order_coupon_details=mysqli_query($conn,"select * from order_coupon_code where order_id='".$order_id."'");					    		
        $getcuopondata = mysqli_fetch_assoc($order_coupon_details);
        if(!empty($getcuopondata)){ ?>
                         
        <tr><td></td><td></td><td></td><td colspan="2">Subtotal</td><td></td><td><i class="fas fa-rupee-sign" aria-hidden="true"></i>&nbsp;<?php echo $getcuopondata['totalprice'] + $getcuopondata['discount_price']?></td></tr>
        <tr><td></td><td></td><td></td><td colspan="2">Discount</td><td></td><td><i class="fas fa-rupee-sign" aria-hidden="true"></i>&nbsp;<?php echo $getcuopondata['discount_price'];?></td></tr>
        <tr><td></td><td></td><td></td><td colspan="2">Shipping Charges</td><td></td><td><i class="fas fa-rupee-sign" aria-hidden="true"></i>&nbsp;<?php echo $tracking_data['shipping'];?></td></tr>        
        <tr><td></td><td></td><td></td><td colspan="2">Total</td><td></td><td><i class="fas fa-rupee-sign" aria-hidden="true"></i>&nbsp;<?php echo $getcuopondata['totalprice'];?></td></tr>

      <?php } ?>                             
                                
                            </tbody>
                        </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card End -->


                                    <!-- Card Start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="h5">
                                                <button class="btn btn-link collapse-icon collapsed" data-toggle="collapse" data-target="#collapse06" style="color: #725d93;">Vendor Details</button>
                                            </h5>
                                        </div>

                                        <div id="collapse06" class="collapse" data-parent="#accordion01">
                                            <div class="card-body">
                                                <table class="table table-responsive table-simple" id="table1">
                          
<?php
    $query=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
    $sr=1;
    $v=0;
    while($data=mysqli_fetch_array($query))
    {
        $product_id=$data['productid'];
        $qty=$data['quantity'];
        $tracking_id=$data['tracking_id'];
        $w_query=mysqli_query($conn,"SELECT * FROM `warehouse_schedule` WHERE `tracking_id`='$tracking_id' AND status='Active'");
        if(mysqli_num_rows($w_query) > 0){  }else{
            if($sr==1)
            {
                ?>
                            <thead>
                                <tr>
                                    
                                    <th width="35%">Products Name</th>
                                    <th>Tracking Id</th>
                                    <th width="50%" style="text-align: center;">Vendor</th>                                   
                                </tr>
                            </thead>
                        <tbody>
        <?php
            }
        $product_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$product_id");
        $product_data=mysqli_fetch_array($product_query);
        $img_query=mysqli_query($conn,"SELECT * FROM `image` WHERE p_id=$product_id");
        $img_data=mysqli_fetch_array($img_query);     
        ?>
                                <tr>
                                                              
                                    <td><a href="edit_product.php?id=<?php echo $product_data['product_code'];?>" target="_blank" ><?php echo $product_data['product_name']."  <br/>( <small>".$product_data['weight']."</small> )";?></a>  </td>
                                    <th><?php echo $data['tracking_id']; ?></th>
                                     
                                      <td align="center">
<?php 
        $cancl_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' AND tracking_status='Cancelled'");
            if(mysqli_num_rows($cancl_query)>0){
                    $cancl_data=mysqli_fetch_array($cancl_query);
                    echo "<span style='color:red;'>Status : Cancelled (".$cancl_data['date']." ".$cancl_data['time'].") ,". "By : ".$cancl_data['by']." , Reason : ".$cancl_data['reason']."</span>";
                    

            }else{
                
        $sel_stk=mysqli_query($conn,"SELECT * FROM `vendor_order_tbl` WHERE `order_id`='$order_id' AND p_id='$product_id' AND tracking_id='$tracking_id' AND `status`='Active' ");
        if(mysqli_num_rows($sel_stk))
        {
            

            $sel_stk_data=mysqli_fetch_array($sel_stk);
            $v_id=$sel_stk_data['vendor_id'];
            $vendor_query1=mysqli_query($conn,"SELECT * FROM `vendor` WHERE id='$v_id'");
            $vendor_data1=mysqli_fetch_array($vendor_query1);
             ?>
                    <table class="table table-responsive" width="100%" style="">
                                    <tr style="line-height: 0.22;">
                                        <td colspan="4" style="padding: 0"></td>
                                        <td style="padding: 0">  
                                            <a href="vendor-order-delete.php?tracking_id=<?php echo $tracking_id; ?>&pid=<?php echo $product_id; ?>&order_id=<?php echo $order_id;?>"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                        <tr style="line-height: 0.22;">
                                            <th>Name</th>
                                            <td style="color: green;">: <?php echo $vendor_data1['name']; ?></td>
                                            
                                            <th>CP-Name</th>
                                            <td>: <?php echo $vendor_data1['cp_name']; ?></td>
                                        </tr>
                                        
                                        <tr style="line-height: 0.22;">
                                            <th>NO</th>
                                            <td colspan="3">: <?php echo $vendor_data1['mobile']; ?></td>
                                        </tr>
                                        <tr style="line-height: 0.22;">
                                            <th>Email</th>
                                            <td colspan="3">: <?php echo $vendor_data1['email']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status </th>
                                            <td colspan="3">: 
                                                <?php
                                                if($sel_stk_data['order_status']==''){
                                                    echo "Pending";
                                                }elseif($sel_stk_data['order_status']=='Cancelled'){
                                                echo "<span style='color:red'>".$sel_stk_data['order_status']." (".$sel_stk_data['date']."&nbsp;".$sel_stk_data['time'].")</span><br>";
                                                echo "<span style='color:red'>BY : ".$sel_stk_data['order_status_by'].", Reason : ".$sel_stk_data['reason']."</span>";
                                                
                                            }else{
                                                    echo $sel_stk_data['order_status']." (".$sel_stk_data['date']."&nbsp;".$sel_stk_data['time'].")";
                                                }

                                                ?>
                                            

                                            </td>
                                        </tr>
                                    </table>
     <?php   }else{ 

            $v=1;
 ?>
                                    <form action="" method="post">
                                        <input type="checkbox" name="tracking_id[]" id="selectvendor<?php echo $sr; ?>" value="<?php echo $tracking_id; ?>">
                                         <script type="text/javascript">
                                        $("#selectvendor<?php echo $sr;?>").change(function() {
                                                var tracking_id=$("#selectvendor<?php echo $sr;?>").val();
                                                $.ajax({
                                                        type: "POST",
                                                        url: 'select-vendor.php?tracking_id='+tracking_id,
                                                        success: function(response) {

                                                                if(response!= null) 
                                                                {
                                                                    //alert(response);
                                                                    $("#vendorselect").html(response);
                                                                }
                                                            }
                                                    });                                            
                                        });
                                            
                                    </script>
                                    <?php } } ?>
                                    </td>                                  
                                </tr>

	<?php $sr++; } }
    if($sr==1){
            echo "<h3 style='text-align:center;'>All Products Assigned Warehouse</h3>";
        } if($v==0){ }else{
        ?>
                <tr><td>Select Vendor</td><td colspan="3">
                     <select name="vendor" class="form-control" onchange="if(confirm('Are you sure you want to assigne product this vendor ?')){this.form.submit()}" id="vendorselect">
                                            <option>----select vendor----</option>
                                        </select>
                                    </form>     
                                </td>
                            </tr>
         
<?php }
                                if(isset($_POST['vendor'])){
                                    unset($_SESSION['proid']);
                                    for ( $i=0;$i<count($_POST['tracking_id']);$i++) {
                                            $vid = $_POST['vendor'];
                                            $tracking_id = $_POST['tracking_id'][$i];
                                            $prquery=mysqli_query($conn,"SELECT * FROM `order_details` WHERE tracking_id='$tracking_id'");
                                            $prodata=mysqli_fetch_array($prquery);
                                            $product_id=$prodata['productid'];
                                            $qty=$prodata['quantity'];
                                        $sel=mysqli_query($conn,"SELECT * FROM `vendor_approval_products` WHERE p_id=$product_id");
                                        $datas=mysqli_fetch_array($sel);
                                        $vendor_product_id=$datas['vp_id'];
                                        $vsel=mysqli_query($conn,"SELECT * FROM `vendor_order_tbl` WHERE tracking_id='$tracking_id'");
                                        if(mysqli_num_rows($vsel)>0){
                                            $vupdate=mysqli_query($conn,"UPDATE `vendor_order_tbl` SET `vendor_id`='$vid',`order_status`='',order_status_by='',reason='',status='Active' WHERE tracking_id='$tracking_id'");
                                        }else{
                                        $ins_query=mysqli_query($conn,"INSERT INTO `vendor_order_tbl`(`vendor_id`, `vp_id`, `quantity`,`order_tbl_id`,`order_id`,`tracking_id`,`p_id`,`date`,`time`) VALUES ('$vid','$vendor_product_id','$qty','$order_tbl_id','$order_id','$tracking_id','$product_id','$date','$time')");
                                    }
                                        $sel1=mysqli_query($conn,"SELECT * FROM `order_status` WHERE `tracking_id`='$tracking_id' AND `tracking_status`='Your Order has been placed'");
                                        if(mysqli_num_rows($sel1)>0){ }else{
                                        $query=mysqli_query($conn,"INSERT INTO `order_status`(`user_id`,`order_tbl_id`, `order_id`,`tracking_id`, `tracking_status`,`date`,`time`) VALUES ('$userid','$order_tbl_id','$order_id','$tracking_id','Your Order has been placed','$date','$time')");
                                            }
            $vendor_sel=mysqli_query($conn,"SELECT * FROM `vendor_order_tbl` WHERE `order_id`='$order_id' AND p_id='$product_id' AND status='Active'");
            $vendor_data=mysqli_fetch_array($vendor_sel);
            $vp_id=$vendor_data['vp_id'];
            $vquantity=$vendor_data['quantity'];
            $vendor_psel=mysqli_query($conn,"SELECT * FROM `vendor_stock` WHERE `vp_id`='$vp_id'");
            $vendor_psel_data=mysqli_fetch_array($vendor_psel);
            $newvpstock=$vendor_psel_data['stock_no']-$vquantity;
            if($newvpstock==0)
            {
                $vendor_stock_up=mysqli_query($conn,"UPDATE `vendor_stock` SET `stock`='OutOfStock',`stock_no`='$newvpstock' WHERE vp_id=$vp_id");
            }else
            {
                $vendor_stock_up=mysqli_query($conn,"UPDATE `vendor_stock` SET `stock_no`='$newvpstock' WHERE vp_id=$vp_id");
            }   } ?>
                                <script type="text/javascript">
                                     window.location.href="order-details.php?order_id=<?php echo $order_id; ?>";
                                </script>
                            <?php    } ?>
                            </tbody>
                        </table>
                   
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card End -->

                                    
                                    <!-- Card Start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="h5">
                                                <button class="btn btn-link collapse-icon collapsed" data-toggle="collapse" data-target="#collapse03" style="color: #725d93;">Delivery Men Details</button>
                                            </h5>
                                        </div>

                                        <div id="collapse03" class="collapse" data-parent="#accordion01">
                                            <div class="card-body">
                                                <table class="table table-responsive table-simple">
                                                    <thead>
                                                        <tr>
                                                            <th>Products Name</th>
                                                            <th>Tracking Id</th>
                                                            <th width="50%" style="text-align: center;">Deliverymen</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php 
    $order_query=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
    while($order_data=mysqli_fetch_array($order_query)){
        $product_id=$order_data['productid'];
        $tracking_id=$order_data['tracking_id'];
        $product_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$product_id");
        $product_data=mysqli_fetch_array($product_query);
        $img_query=mysqli_query($conn,"SELECT * FROM `image` WHERE p_id=$product_id");
        $img_data=mysqli_fetch_array($img_query);
?>
                                                        <tr>
                                                            <td><a href="edit_product.php?id=<?php echo $product_data['product_code'];?>" target="_blank" ><?php echo $product_data['product_name']."  <br/>( <small>".$product_data['weight']."</small> )";?></a>  </td>
                                                           
                                                            <form action="" method="post">
                                                            <th><?php echo $tracking_id; ?></th>
                                                            <td align="center">

<?php 
$cancl_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' AND tracking_status='Cancelled'");
            if(mysqli_num_rows($cancl_query)>0){
                    $cancl_data=mysqli_fetch_array($cancl_query);
                    echo "<span style='color:red;'>Status : Cancelled (".$cancl_data['date']." ".$cancl_data['time'].") ,". "By : ".$cancl_data['by']." , Reason : ".$cancl_data['reason']."</span>";
}else{
    $sel=mysqli_query($conn,"SELECT * FROM `delivery_schedule` WHERE `tracking_id`='$tracking_id' AND status='Active'");
                if(mysqli_num_rows($sel) > 0){ 
                    $sel_data=mysqli_fetch_array($sel);
                    $deli_id=$sel_data['deliverymen_id'];
                    $sel_deliveryman_name=mysqli_query($conn,"SELECT * FROM `deliverymen` WHERE id=$deli_id");
                    $deli_name_data=mysqli_fetch_array($sel_deliveryman_name);

                 ?>
                                <table class="table table-responsive" width="100%" style="">
                                    <tr style="line-height: 0.22;">
                                        <td colspan="4" style="padding: 0"></td>
                                        <td style="padding: 0">
                                            <a href="deliverymen-delete.php?order_id=<?php echo $order_id; ?>&tracking_id=<?php echo $tracking_id; ?>"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                        <tr style="line-height: 0.22;">
                                            <th>Name</th>
                                            <td style="color: green;">: <?php echo $deli_name_data['name']; ?></td>
                                            
                                            <th>M-No</th>
                                            <td>: <?php echo $deli_name_data['mobile']; ?></td>
                                        </tr>
                                        
                                        <tr style="line-height: 0.22;">
                                            <th>Email</th>
                                            <td colspan="3">: <?php echo $deli_name_data['email']; ?></td>
                                        </tr>
                                        <tr style="line-height: 0.22;">
                                            <th>Address</th>
                                            <td colspan="3">: <?php echo $deli_name_data['address']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td colspan="3">
                                                <?php
                                                if($sel_data['delivery_status']==''){
                                                        echo "Delivery is Pending";
                                                    }
                                                    else{
                                                        //echo $sel_deliveryman_data['delivery_status'];
                                                        if($sel_data['delivery_status']=='Cancelled'){
                                                        echo "<span style='color:red'>Cancelled by ".$sel_data['delivery_status_by']." (".$sel_data['dmen_date']." ".$sel_data['dmen_time'].")</span>";
                                                        echo "<br><span style='color:red'> Reason : ".$sel_data['reason']."</span>";                          
                                                        }
                                                        else{
                                                            echo "Delivered Successfully (".$sel_data['dmen_date']." ".$sel_data['dmen_time'].")";  
                                                        }
                                                    }
                                                ?>

                                            </td>
                                        </tr>
                                    </table>
               <?php  }else{ $d=1; ?>
                                                            
                                                                <input type="checkbox" name="tracking_id[]" value="<?php echo $order_data['tracking_id']; ?>">
                                                <?php } } ?>
                                                            </td>
                                                        </tr>
<?php } if($d==1){ ?>
                                                    <tr>
                                                        <th>Deliverymen</th>
                                                        <td colspan="2">
                                                            <select name="deliverymen" class="form-control" onchange="if(confirm('Are you sure you want to assigne product this deliverymen?..')){this.form.submit()}">
                                                                <option>---select deliverymen---</option>
<?php
    $sel_query=mysqli_query($conn,"SELECT * FROM `deliverymen` WHERE status='Active' AND free='Yes'");
        while($sel_data=mysqli_fetch_array($sel_query)){                                          
             //$d_query=mysqli_query($conn,"SELECT * FROM `delivery_schedule` WHERE deliverymen_id='$sel_data[id]' AND order_id='$order_id' AND status='Active'");
             //$dnum = mysqli_num_rows($d_query);
                //if($dnum==0){ ?>
                                                            <option value="<?php echo $sel_data['id']; ?>" ><?php echo $sel_data['name']; ?></option>
                            <?php 
                                //}                          
                                                    } ?>
                                                            </select>
                                                        </td>
                                                    </tr><?php } ?>
                                                    </form>
<?php
                        if(isset($_POST['deliverymen'])){
                            $id=$_POST['deliverymen'];
                            $tracking_id=$_POST['tracking_id'];
                            foreach($tracking_id as $tracking_id){
                                $sel=mysqli_query($conn,"SELECT * FROM `delivery_schedule` WHERE `tracking_id`='$tracking_id'");
                                    if(mysqli_num_rows($sel) > 0){
                                            $update=mysqli_query($conn,"UPDATE `delivery_schedule` SET `deliverymen_id`='$id',`delivery_status`='',`delivery_status_by`='',`reason`='',`status`='Active',`date`='$date',`time`='$time',`dmen_date`='',`dmen_time`='' WHERE `tracking_id`='$tracking_id'");
                                           
                                    }else{

                                        $ins=mysqli_query($conn,"INSERT INTO `delivery_schedule` (`deliverymen_id`,`order_tbl_id`,`order_id`,`tracking_id`,`date`,`time`) VALUES ('$id','$order_tbl_id','$order_id','$tracking_id','$date','$time')");
                                    }
                                }
                                     ?>
                                <script type="text/javascript">
                                    window.location.href="order-details.php?order_id=<?php echo $order_id; ?>";
                                </script>
                                <?php 
                                 }  
?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card End -->

                                    <!-- Card Start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="h5">
                                                <button class="btn btn-link collapse-icon collapsed" data-toggle="collapse" data-target="#collapse04" style="color: #725d93;">Warehouse Details</button>
                                            </h5>
                                        </div>

                                        <div id="collapse04" class="collapse" data-parent="#accordion01">
                                            <div class="card-body">

                                                <table class="table table-responsive table-simple">
<?php
     $order_query=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
    $sr=1;
    while($order_data=mysqli_fetch_array($order_query)){
        $product_id=$order_data['productid'];
        $tracking_id=$order_data['tracking_id'];
        $v_query=mysqli_query($conn,"SELECT * FROM `vendor_order_tbl` WHERE `tracking_id`='$tracking_id' AND status='Active'");
        if(mysqli_num_rows($v_query) > 0){   }else{
            if($sr==1){
?>
                                                    <thead>
                                                        <tr>
                                                            <th>Products Name</th>
                                                            <th>Tracking Id</th>
                                                            <th width="50%" style="text-align: center;">Warehouse</th>
                                                        </tr>
                                                    </thead>
                <?php } ?>
                                                    <tbody>
<?php 
        $product_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$product_id");
        $product_data=mysqli_fetch_array($product_query);
        $img_query=mysqli_query($conn,"SELECT * FROM `image` WHERE p_id=$product_id");
        $img_data=mysqli_fetch_array($img_query);
?>
                                                        <tr>
                                                            <td><a href="edit_product.php?id=<?php echo $product_data['product_code'];?>" target="_blank" ><?php echo $product_data['product_name']."  <br/>( <small>".$product_data['weight']."</small> )";?></a>  </td>
                                                            <form action="" method="post">
                                                            <th><?php echo $tracking_id; ?></th>
                                                            <td align="center">
<?php 
    $cancl_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' AND tracking_status='Cancelled'");
            if(mysqli_num_rows($cancl_query)>0){
                    $cancl_data=mysqli_fetch_array($cancl_query);
                    echo "<span style='color:red;'>Status : Cancelled (".$cancl_data['date']." ".$cancl_data['time'].") ,". "By : ".$cancl_data['by']." , Reason : ".$cancl_data['reason']."</span>";
}else{
    $sel=mysqli_query($conn,"SELECT * FROM `warehouse_schedule` WHERE `tracking_id`='$tracking_id' AND status='Active'");
                if(mysqli_num_rows($sel) > 0){
                    $sel_data=mysqli_fetch_array($sel);
                    $warehouse_id=$sel_data['warehouse_id'];
                    $sel_warehouse_name=mysqli_query($conn,"SELECT * FROM `warehouse` WHERE id=$warehouse_id");
                    $ware_name_data=mysqli_fetch_array($sel_warehouse_name);

                 ?>
                                <table class="table table-responsive" width="100%" style="">
                                    <tr style="line-height: 0.22;">
                                        <td colspan="4" style="padding: 0"></td>
                                        <td style="padding: 0">
                                            <a href="warehouse-delete.php?order_id=<?php echo $order_id; ?>&tracking_id=<?php echo $tracking_id; ?>"><i class="fa fa-times"></i></a>
                                        </td>
                                    </tr>
                                        <tr style="line-height: 0.22">
                                            <th>Name</th>
                                            <td style="color: green;">: <?php echo $ware_name_data['name']; ?></td>
                                        </tr>
                                        <tr style="line-height: 0.22">
                                            <th>No</th>
                                            <td>: <?php echo $ware_name_data['mobile']; ?></td>
                                        </tr>
                                        
                                        <tr style="line-height: 0.22;">
                                            <th>Email</th>
                                            <td colspan="3">: <?php echo $ware_name_data['email']; ?></td>
                                        </tr>
                                        <tr style="line-height: 0.22;">
                                            <th>Address</th>
                                            <td colspan="3">: <?php echo $ware_name_data['address']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td colspan="3">
                                                <?php
                                                if($sel_data['order_status']==''){
                                                        echo "order is Pending";
                                                    }
                                                    else{
                                                        //echo $sel_deliveryman_data['delivery_status'];
                                                        if($sel_data['order_status']=='Cancelled'){
                                                        echo "<span style='color:red'>Cancelled by ".$sel_data['order_status_by']." (".$sel_data['war_date'].$sel_data['war_time'].")</span>";
                                                        echo "<br><span style='color:red'> Reason : ".$sel_data['reason']."</span>";                          
                                                        }
                                                        else{
                                                            echo "Packed (".$sel_data['war_date']." ".$sel_data['war_time'].")";    
                                                        }
                                                    }
                                                ?>

                                            </td>
                                        </tr>
                                    </table>
               <?php  }else{ $de=1; ?>
                                                            
                                                                <input type="checkbox" name="tracking_id[]" value="<?php echo $order_data['tracking_id']; ?>" id="selectwarehouse<?php echo $sr;?>">
                                        <script type="text/javascript">
                                        $("#selectwarehouse<?php echo $sr;?>").change(function() {
                                                var tracking_id=$("#selectwarehouse<?php echo $sr;?>").val();
                                                $.ajax({
                                                        type: "POST",
                                                        url: 'warehouse-select.php?tracking_id='+tracking_id,
                                                        success: function(response) {
                                                                if(response!= null) 
                                                                {
                                                                    //alert(response);
                                                                    $("#warehouseselect").html(response);
                                                                }
                                                            }
                                                    });                                            
                                        });
                                            
                                    </script>
                                                <?php } } ?>
                                                            </td>
                                                        </tr>
<?php $sr++; }  } //---while loop end---
if($sr==1){
            echo "<h3 style='text-align:center;'>All Products Assigned Vendors</h3>";
        }
 if($de==1){  ?>
                                                    <tr>
                                                        <th>Warehouse</th>
                                                        <td colspan="2">
                                                            <pre><div id=""></div></pre>
                                                            <select name="warehouse" class="form-control" onchange="if(confirm('Are you sure you want to assigne product this Warehouse?..')){this.form.submit()}" id="warehouseselect">
                                                                <option>---select warehouse---</option>

                                                            </select>
                                                        </td>
                                                    </tr><?php } ?>
                                                    </form>
<?php
                    if(isset($_POST['warehouse'])){
                            unset($_SESSION['trackid']);
                            $warehouse=$_POST['warehouse'];
                            $tracking_id=$_POST['tracking_id'];
                            foreach($tracking_id as $tracking_id)
                            {
                                $sel=mysqli_query($conn,"SELECT * FROM `warehouse_schedule` WHERE tracking_id='$tracking_id'");
                                    if(mysqli_num_rows($sel) > 0){
                                            $update=mysqli_query($conn,"UPDATE `warehouse_schedule` SET `warehouse_id`='$warehouse',`order_status`='',`order_status_by`='',`reason`='',`status`='Active',`date`='$date',`time`='$time',war_date='',war_time='' WHERE tracking_id='$tracking_id'");
                                    }else{
                                        $status_query2=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' AND `tracking_status`='Your Order has been placed'");
                                            if(mysqli_num_rows($status_query2) > 0 ){ }else{
                                            $query3=mysqli_query($conn,"INSERT INTO `order_status`(`user_id`, `order_tbl_id`,`order_id`,`tracking_id`, `tracking_status`,`date`,`time`) VALUES ('$userid','$order_tbl_id','$order_id','$tracking_id','Your Order has been placed','$date','$time')");
                                            }
                                        $ins=mysqli_query($conn,"INSERT INTO `warehouse_schedule`(`warehouse_id`,`order_tbl_id`,`order_id`,`tracking_id`,`date`,`time`) VALUES ('$warehouse','$order_tbl_id','$order_id','$tracking_id','$date','$time')");
                                    }
                                }
                                     ?>
                                <script type="text/javascript">
                                    window.location.href="order-details.php?order_id=<?php echo $order_id; ?>";
                                </script>
                                <?php 
                                 }  
?>
                                                    </tbody>
                                                </table>
                                            </div>  
                                        </div>
                                    </div>
                                    <!-- Card End -->
                                    <!-- Card Start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="h5">
                                                <button class="btn btn-link collapse-icon" data-toggle="collapse" data-target="#collapse07" style="color: #725d93;">Products Delivery Date </button>
                                            </h5>
                                        </div>

                                        <div id="collapse07" class="collapse" data-parent="#accordion01">
                                            <div class="card-body">
                                                <table class="table table-simple">
                                                    <thead>
                                                        <tr>
                                                            <th>Tracking Id</th>
                                                            <th colspan="4">Delivery Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
<?php
    $sel=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
    $sr=1;
    while($sel_datas=mysqli_fetch_array($sel)){
        $tracking_id=$sel_datas['tracking_id'];
     
?>                                                  <tr>
                                                        <td><?php echo $tracking_id; ?></td>
                                                        <td colspan="4">
                                                <?php 
$cancl_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' AND tracking_status='Cancelled'");
            if(mysqli_num_rows($cancl_query)>0){
                    $cancl_data=mysqli_fetch_array($cancl_query);
                    echo "<span style='color:red;'>Status : Cancelled (".$cancl_data['date']." ".$cancl_data['time'].") ,". "By : ".$cancl_data['by']." , Reason : ".$cancl_data['reason']."</span>";
                    

            }else{
                                                    $sel_deliverystatus=mysqli_query($conn,"SELECT * FROM `order_status` WHERE `tracking_id`='$tracking_id' AND `tracking_status`!=' '");
                                                    if(mysqli_num_rows($sel_deliverystatus) >0){
                                                    $sel_deliverydate=mysqli_query($conn,"SELECT * FROM `order_status` WHERE `tracking_id`='$tracking_id' AND `delivery_date`!=' '");
                                                    
                                                    if(mysqli_num_rows($sel_deliverydate) > 0)
                                                    { 
                                                        $del_data=mysqli_fetch_assoc($sel_deliverydate);
                                                        echo $del_data['delivery_date']." ". $del_data['delivery_time'];
                                                         ?>
                                                
                                                <form action="" method="post" id="dateupdate<?php echo $sr; ?>" style="display: none;">
                                                    <input type="date" name="delivery-date" class="form-control"  required=""><br>
                                                    <input type="time" value="13:30" name="delivery-time" placeholder="Time" class="form-control" autocomplete="off" required><br>
                                                    <input type="hidden" name="tracking_id" value="<?php echo $tracking_id; ?>">
                                                    <button class="btn btn-success" name="delivery_date">Submit</button>
                                                    <a href="javascript:;" class="btn btn-danger" onclick="datecancel<?php echo $sr; ?>()" id="datecancel<?php echo $sr; ?>">Cancel</a>
                                                </form>
                                            <?php
                                                        ?>&emsp;&emsp;<button class="btn btn-success" onclick="dateupdate<?php echo $sr; ?>()" id="dateupdatebtn<?php echo $sr; ?>">Update</button><?php
                                                }else{
                                                 ?>
                                                
                                                <form action="" method="post">
                                                    <input type="date" name="delivery-date" class="form-control"  required=""><br>
                                                    <input type="time" value="13:30" name="delivery-time"  placeholder="Time" class="form-control" autocomplete="off" required><br>
                                                    <input type="hidden" name="tracking_id" value="<?php echo $tracking_id; ?>">
                                                    <button class="btn btn-success" name="delivery_date">Submit</button>
                                                </form>
                                            <?php } } }?>
                                            <script type="text/javascript">
                                                function dateupdate<?php echo $sr; ?>()
                                                {
                                                    $("#dateupdate<?php echo $sr; ?>").show();
                                                    $("#dateupdatebtn<?php echo $sr; ?>").hide();
                                                    
                                                }
                                                function datecancel<?php echo $sr; ?>()
                                                {
                                                    $("#dateupdate<?php echo $sr; ?>").hide();
                                                    $("#dateupdatebtn<?php echo $sr; ?>").show();
                                                }
                                            </script>
                                                
                                            </td>
<script type="text/javascript">
var timepicker<?php echo $sr; ?> = new TimePicker('timess<?php echo $sr; ?>', {
  lang: 'en',
  theme: 'dark'
});
timepicker<?php echo $sr; ?>.on('change', function(evt) {
  
  var value = (evt.hour || '00') + ':' + (evt.minute || '00');
  evt.element.value = value;

});
 </script>
                                                    </tr>
<?php $sr++; } //---while loop end-----?>
<?php 
                                                    $status_data['delivery_date'];
                                                    if(isset($_POST['delivery_date']))
                                                    {
                                                        $delivery_date=$_POST['delivery-date'];
                                                        $delivery_time=$_POST['delivery-time'];
                                                        $tracking_id=$_POST['tracking_id'];
                                                        $upda=mysqli_query($conn,"UPDATE `order_status` SET `delivery_date`='$delivery_date',`delivery_time`='$delivery_time' WHERE tracking_id='$tracking_id'");
                                                        if($upda)
                                                        {
                                                            ?>
                                                            <script type="text/javascript">
                                                                window.location.href="order-details.php?order_id=<?php echo $order_id; ?>"
                                                            </script>
                                                            <?php 
                                                        }
                                                    }
                                                 ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Card Start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="h5">
                                                <button class="btn btn-link collapse-icon" data-toggle="collapse" data-target="#collapse05" style="color: #725d93;">Update Products Status </button>
                                            </h5>
                                        </div>

                                        <div id="collapse05" class="collapse show" data-parent="#accordion01">
                                            <div class="card-body">
<?php 
    $sel=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
    $sr=1;
    while($order_data=mysqli_fetch_array($sel)) {
            $product_id=$order_data['productid'];
            $tracking_id=$order_data['tracking_id'];
            $product_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$product_id");
            $product_data=mysqli_fetch_array($product_query);
            $status_query3=mysqli_query($conn,"SELECT * FROM `order_status` WHERE `tracking_id`='$tracking_id' ORDER BY id DESC");
            
 ?>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="h5">
                                                            <button class="btn btn-link collapse-icon" data-toggle="collapse" data-target="#demo<?php echo $sr; ?>" style="color: ; font-size: 13px;">(<?php echo $sr; ?>)&nbsp;<?php echo $product_data['product_name']."&emsp;";
                                                            if(mysqli_num_rows($status_query3)>0)
                                                            { 
                                                                $status_data3=mysqli_fetch_array($status_query3);
                                                                if($status_data3['tracking_status']=="Cancelled"){
                                                                    echo "<span style='color: red;'>".$status_data3['tracking_status']."</span>";
                                                                }else{

                                                                    echo "<span style='color: green;'>".$status_data3['tracking_status']."</span>";
                                                                }

                                                            }
                                                            else{
                                                                echo "<span style='color: #007bff;'>Pending</span>";
                                                            }
                                                            ?>
                                                                
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="demo<?php echo $sr; ?>" class="collapse">
                                                      <div class="container">
                                                          <div class="row">
                                                    <div class="col-md-2">Status History : </div>
                                                    <div class="col-md-10">
                                                           <?php
                                            $status_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id'");
                                            if(mysqli_num_rows($status_query) > 0)
                                            {
                                                     while($status_data=mysqli_fetch_array($status_query))
                                                {
                                                    ?>
                                                    <ul>
                                                        <li <?php if($status_data['tracking_status']=="Cancelled"){ ?> style="color: #ff4040;" <?php }else{ ?> style="color: #20c997;" <?php } ?> ><?php  echo $status_data['tracking_status']; ?> <p style="color: green; display: inline;">(<?php  echo $status_data['date']; ?>&nbsp;<?php  echo $status_data['time']; ?>)</p>
<?php
                                                    if($status_data['tracking_status']=="Cancelled"){
                                                        echo "<br>By : ".$status_data['by']; 
                                                        echo "<br>Reason : ".$status_data['reason']; 
                                                    } ?>
                                                        </li>
                                                    </ul>
                                                   
                                                    <?php
                                                   

                                                }
                                            }else{
                                                ?>
                                                <p style="color: #007bff;">Pending</p>
                                                <?php
                                            }
                                           
                                            ?>
                                                    </div>
                                                </div>
                                         <br>
                                         <?php 
                                            $status_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' ORDER BY id DESC");
                                            $status_data=mysqli_fetch_array($status_query);
                                            if($status_data['tracking_status']=='Cancelled' || $status_data['tracking_status']=='Delivered' ){

                                            }else{
                                         ?>
                                                <div class="row">
                                                    <div class="col-md-2">Products Status</div>
                                                    <div class="col-md-10">
                        <form method="post" action="">
                            <div class="form-group row">
                                <div class="col-md-10">
                                     <select class="form-control" name="status" onchange="updateshow<?php echo $sr; ?>()" id="updatebox<?php echo $sr; ?>" required>
<?php
     
    if($status_data==''){ ?>
                                        <option value="">---select status---</option>

                                        <option value="Ordered and Approved" <?php  if($status_data['tracking_status']=='Ordered and Approved'){ ?> selected <?php }?> >Ordered and Approved</option>
                                  
                                        
                                        <option value="Cancelled" >Cancelled</option>

    <?php }else{ 

?>
                                        <option value="">---select status---</option>
<?php

 if($status_data['tracking_status']=='Ordered and Approved'){ ?>
                                        <option value="Your Order has been placed" <?php  if($status_data['tracking_status']=='Your Order has been placed'){ ?> selected <?php }?> >Your Order has been placed</option>
                                        <option value="Seller has processed your Order" <?php  if($status_data['tracking_status']=='Seller has processed your Order'){ ?> selected <?php }?>>Seller has processed your Order</option>
                                        <option value="Packed" <?php  if($status_data['tracking_status']=='Packed'){ ?> selected <?php }?> >Packed</option>
                                        <option value="Your item has been picked up by courier partner" <?php  if($status_data['tracking_status']=='Your item has been picked up by courier partner'){ ?> selected <?php }?> >Your item has been picked up by courier partner</option>

                                        <option value="Your item has been received in the hub nearest to you" <?php  if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?> selected <?php }?> >Your item has been received in the hub nearest to you</option>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                        
                                        <option value="Cancelled" >Cancelled</option>

<?php } if($status_data['tracking_status']=='Your Order has been placed'){ ?> 
                                        <option value="Seller has processed your Order" <?php  if($status_data['tracking_status']=='Seller has processed your Order'){ ?> selected <?php }?>>Seller has processed your Order</option>
                                        <option value="Packed" <?php  if($status_data['tracking_status']=='Packed'){ ?> selected <?php }?> >Packed</option>
                                        <option value="Your item has been picked up by courier partner" <?php  if($status_data['tracking_status']=='Your item has been picked up by courier partner'){ ?> selected <?php }?> >Your item has been picked up by courier partner</option>

                                        <option value="Your item has been received in the hub nearest to you" <?php  if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?> selected <?php }?> >Your item has been received in the hub nearest to you</option>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                       
                                        <option value="Cancelled" >Cancelled</option>
<?php } if($status_data['tracking_status']=='Seller has processed your Order'){ ?> 
                                        <option value="Packed" <?php  if($status_data['tracking_status']=='Packed'){ ?> selected <?php }?> >Packed</option>
                                        <option value="Your item has been picked up by courier partner" <?php  if($status_data['tracking_status']=='Your item has been picked up by courier partner'){ ?> selected <?php }?> >Your item has been picked up by courier partner</option>

                                        <option value="Your item has been received in the hub nearest to you" <?php  if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?> selected <?php }?> >Your item has been received in the hub nearest to you</option>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                        
                                        <option value="Cancelled" >Cancelled</option>
<?php } if($status_data['tracking_status']=='Packed'){ ?> 
                                        <option value="Your item has been picked up by courier partner" <?php  if($status_data['tracking_status']=='Your item has been picked up by courier partner'){ ?> selected <?php }?> >Your item has been picked up by courier partner</option>

                                        <option value="Your item has been received in the hub nearest to you" <?php  if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?> selected <?php }?> >Your item has been received in the hub nearest to you</option>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                        
                                        <option value="Cancelled" >Cancelled</option>

<?php } if($status_data['tracking_status']=='Your item has been picked up by courier partner'){ ?>                            
                                        <option value="Your item has been received in the hub nearest to you" <?php  if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?> selected <?php }?> >Your item has been received in the hub nearest to you</option>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                       
                                        <option value="Cancelled" >Cancelled</option>
<?php }   if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                        
                                        <option value="Cancelled" >Cancelled</option>
<?php } if($status_data['tracking_status']=='your item out for delivery'){ ?>
                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                        
                                        <option value="Cancelled" >Cancelled</option>
<?php } if($status_data['tracking_status']=='Delivered'){ ?>
                                         
<?php } } ?>
                                    </select>
                                    <input type="hidden" name="tracking_id" value="<?php echo $tracking_id; ?>">
                                    <br>
                                    <div class="form-group" id="update<?php echo $sr; ?>" style="display:none;">
                                        
                                        <textarea class="form-control" name="reason" rows="5" placeholder="Reason For Cancellation"></textarea>
                                         
                                        </div>
<script>
function updateshow<?php echo $sr; ?>() {
  var x = document.getElementById("updatebox<?php echo $sr; ?>").value;
   var y = document.getElementById("update<?php echo $sr; ?>");
  if (x == "Cancelled") {
    y.style.display = "flex";
  } else {
    y.style.display = "none";
  }
}
</script>
                                    </div>
                                    <div class="col-md-2">
                                    <button class="btn btn-success" name="order-submit" onclick="return confirm(' Are you sure you want to status update this order ?...');">update</button>
                                    </div>
                                </div>
                                </form>

                    </div>
                                                </div><?php } ?> <!----else products deliverd-->
                                                      </div>  
                                                    </div>
                                                </div>
<?php $sr++; } //----while loop end--- ?>

<?php 
  
if(isset($_POST['order-submit'])){

     $status=$_POST['status'];
     $reason=$_POST['reason'];
     $tracking_id=$_POST['tracking_id'];
     if($_POST['status']=='Cancelled'){

        $by="admin";
     }else{
        $by=" ";
     }
    $query="INSERT INTO `order_status`(`user_id`,`order_tbl_id`,`order_id`,`tracking_id`, `tracking_status`,`by`,`reason`,`date`,`time`) VALUES ('$userid','$order_tbl_id','$order_id','$tracking_id','$status','$by','$reason','$date','$time')";
    $ins=mysqli_query($conn,$query);
    if($_POST['status']=='Ordered and Approved')
    {
        $select_query=mysqli_query($conn,"SELECT * FROM `order_details` WHERE `tracking_id`='$tracking_id'");
        $select_data=mysqli_fetch_array($select_query);
        $product_id=$select_data['productid'];
        $quantity=$select_data['quantity'];
        $stock_query=mysqli_query($conn,"SELECT in_stock FROM `products` WHERE id = $product_id");
        $stock_data=mysqli_fetch_array($stock_query);
        $stock_no=$stock_data['in_stock'];
        $newstock=$stock_no-$quantity;
            if($newstock==0){
                $stockStatus = "No";
                }else{
                $stockStatus = "Yes";
                }
                $query="INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`, `created_time`) 
                VALUES ('$product_id','$quantity','Debit','$date','$time')";
                $ins=mysqli_query($conn,$query);
                
                $stock_update_query = mysqli_query($conn,"UPDATE `products` SET 
                `stock` = '$stockStatus',
                `in_stock` = '$newstock'
                 WHERE id='$product_id'");           
    
}

if($_POST['status']=='Delivered')
{

    //////// Update Payment Status ////////
    $paymentModeQuery=mysqli_query($conn,"SELECT * FROM `order_tbl` WHERE order_id='$order_id'");
    $paymentModeData=mysqli_fetch_array($paymentModeQuery);
    if($paymentModeData['payment_mode']=='COD')
    {
        $update = mysqli_query($conn,"UPDATE `order_details` SET 
        `payment_status` = 'Success'
         WHERE 	tracking_id='$tracking_id'");
    }

    $resultCount[]="";

    //////// Update Order Table Payment Status ////////
    $orderPaymentStatus = true;
    $orderPaymentDetailsQuery=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
    // $orderTableStatus = $orderDetailsData=mysqli_fetch_array($orderDetailsQuery);
    while($orderPaymentDetailsRow = mysqli_fetch_array($orderPaymentDetailsQuery))
    {

   if($orderPaymentDetailsRow['payment_status'] == 'Pending'){
    $orderPaymentStatus = false;
  
    break;
   }
   
    }
    // echo '<pre>';
    // print_r($resultCount);
    // exit();

    if($orderPaymentStatus){
        $update = mysqli_query($conn,"UPDATE `order_tbl` SET 
        `payment_status` = 'Success'
         WHERE order_id='$order_id'");
    }
    //////// Update Order Table Payment Status ////////

    //////// Update Payment Status ////////
  
  
  
    //////// Update Order Table Status ////////
  $orderTableStatus = true;
  $orderDetailsQuery=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
  // $orderTableStatus = $orderDetailsData=mysqli_fetch_array($orderDetailsQuery);
  while($orderDetailsRow = mysqli_fetch_array($orderDetailsQuery))
  {
  $orderStatusQuery="SELECT id FROM `order_status` WHERE `tracking_id`='".$orderDetailsRow['tracking_id']."' AND (`tracking_status`='Cancelled' OR `tracking_status`='Delivered') ORDER BY id DESC LIMIT 1";
  $orderDetailsData=mysqli_query($conn,$orderStatusQuery);
  $count = mysqli_num_rows($orderDetailsData);

 if($count == 0){
  $orderTableStatus = false;

  break;
 }
 
  }
  
  if($orderTableStatus){
      $update = mysqli_query($conn,"UPDATE `order_tbl` SET 
      `order_status` = 'Completed'
       WHERE order_id='$order_id'");
  }
  //////// Update Order Table Status ////////
}


    if($_POST['status']=='Cancelled'){
        $status=$_POST['status'];
        $by="admin";
        $reason=$_POST['reason'];
        //$update=mysqli_query($conn,"UPDATE `order_tbl` SET `order_status`='$status',`reason`='$reason' WHERE id='$order_id'" );
        $pquery=mysqli_query($conn,"SELECT * FROM `order_tbl` WHERE order_id='$order_id'");
        $pdata=mysqli_fetch_array($pquery);
        if($pdata['promo_code_id']!=0)
        {
            $promo_id=$pdata['promo_code_id'];
            $promo_sel=mysqli_query($conn,"SELECT * FROM `promo_code` WHERE id=$promo_id");
            $promo_data=mysqli_fetch_array($promo_sel);
            $promo_qty=$promo_data['use_quantity']+1;
            $promo_up=mysqli_query($conn,"UPDATE `promo_code` SET `use_quantity`='$promo_qty' WHERE id=$promo_id");
        }

        //////// Update Order Table Status ////////
        $orderTableStatus = true;
        $orderDetailsQuery=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
        // $orderTableStatus = $orderDetailsData=mysqli_fetch_array($orderDetailsQuery);
        while($orderDetailsRow = mysqli_fetch_array($orderDetailsQuery))
        {
        $orderStatusQuery="SELECT id FROM `order_status` WHERE `tracking_id`='".$orderDetailsRow['tracking_id']."' AND (`tracking_status`='Cancelled' OR `tracking_status`='Delivered') ORDER BY id DESC LIMIT 1";
        $orderDetailsData=mysqli_query($conn,$orderStatusQuery);
        $count = mysqli_num_rows($orderDetailsData);

       if($count == 0){
        $orderTableStatus = false;

        break;
       }
       
        }
        
        if($orderTableStatus){
            $update = mysqli_query($conn,"UPDATE `order_tbl` SET 
            `order_status` = 'Completed'
             WHERE order_id='$order_id'");
        }
        //////// Update Order Table Status ////////


        $status_query1=mysqli_query($conn,"SELECT * FROM `order_status` WHERE `tracking_id`='$tracking_id' AND `tracking_status`='Cancelled' ORDER BY id DESC");
        if(mysqli_num_rows($status_query1) > 0)
        {
            $select_query=mysqli_query($conn,"SELECT * FROM `order_details` WHERE `tracking_id`='$tracking_id'");
            $select_data=mysqli_fetch_array($select_query);
            

                $product_id=$select_data['productid'];
                $quantity=$select_data['quantity'];
                
                $orderStatusQuery=mysqli_query($conn,"SELECT count(*) as in_count FROM `order_status` WHERE `tracking_id`='$tracking_id' AND `tracking_status`='Ordered and Approved'");
                $orderStatusData=mysqli_fetch_array($orderStatusQuery);

                if($orderStatusData['in_count']!=0){
                    $stock_query=mysqli_query($conn,"SELECT in_stock FROM `products` WHERE id = $product_id");
                    $stock_data=mysqli_fetch_array($stock_query);
                    $stock_no=$stock_data['in_stock'];
                    $newstock=$stock_no+$quantity;
                        if($newstock==0){
                            $stockStatus = "No";
                            }else{
                            $stockStatus = "Yes";
                            }
                            $query="INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`, `created_time`) 
                            VALUES ('$product_id','$quantity','Credit','$date','$time')";
                            $ins=mysqli_query($conn,$query);
                            
                            $query="UPDATE products SET 
                            stock = '$stockStatus',
                            in_stock = $newstock
                             WHERE id='$product_id'";
                            //  print_r($query);
                            //  exit();
                            $stock_update_query = mysqli_query($conn,$query);          
                }

            $vendor_sel1=mysqli_query($conn,"SELECT * FROM `vendor_order_tbl` WHERE `order_id`='$order_id' AND p_id='$product_id'");
            $vendor_data=mysqli_fetch_array($vendor_sel1);
            $vp_id=$vendor_data['vp_id'];
            $vquantity=$vendor_data['quantity'];
            $vendor_psel=mysqli_query($conn,"SELECT * FROM `vendor_stock` WHERE `vp_id`='$vp_id'");
            $vendor_psel_data=mysqli_fetch_array($vendor_psel);
            $newvpstock=$vendor_psel_data['stock_no']+$vquantity;
            if($vendor_psel_data['stock_no']==0)
            {
                $vendor_stock_up=mysqli_query($conn,"UPDATE `vendor_stock` SET `stock`='Instock',`stock_no`='$newvpstock' WHERE vp_id=$vp_id");
            }else
            {
                $vendor_stock_up=mysqli_query($conn,"UPDATE `vendor_stock` SET `stock_no`='$newvpstock' WHERE vp_id=$vp_id");
            }
            $vendor_up=mysqli_query($conn,"UPDATE `vendor_order_tbl` SET `order_status`='$status',`order_status_by`='$by',`reason`='$reason' WHERE order_id='$order_id' AND p_id='$product_id'");
            
        }
    }
    if($_POST['status']=='Cancelled'){
        $status=$_POST['status'];
        $by="admin";
        $reason=$_POST['reason'];
        $update=mysqli_query($conn,"UPDATE `delivery_schedule` SET `delivery_status`='$status',`delivery_status_by`='$by',`reason`='$reason',`dmen_date`='$date',`dmen_time`='$time' WHERE tracking_id='$tracking_id' And delivery_status=' ' " );
        $updates=mysqli_query($conn,"UPDATE `warehouse_schedule` SET `order_status`='$status',`order_status_by`='$by',`reason`='$reason',`war_date`='$date',`war_time`='$time' WHERE `tracking_id`='$tracking_id'" );
    }
    ?>
    <script type="text/javascript">
            window.location.href="order-details.php?order_id=<?php echo $order_id; ?>";
    </script>
    <?php  
}
?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card End -->
                                    <br>
                                    <!-- Card End -->
                                </div>
                            </div>
                        </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
        

           <?php  include('includes/footer.php'); ?>
