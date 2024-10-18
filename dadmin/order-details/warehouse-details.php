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