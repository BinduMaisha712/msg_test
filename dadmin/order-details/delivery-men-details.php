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
        
        $grom34=$product_data['class1'];

        $prodcolor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT symbol FROM size_class WHERE id=" . $product_data['class0']));
        
        // $img_query=mysqli_query($conn,"SELECT * FROM `image` WHERE p_id='".$product_data['product_code']."'");
        // $img_data=mysqli_fetch_array($img_query);
?>
                                                        <tr>
                                                            <td>
                                                                <a href="edit_product.php?id=<?php echo $product_data['id']; ?>" target="_blank">
                                                                    <?php echo $product_data['product_name']; ?>
                                                                    <?php 
                                                                        echo "<br/><small>";
                                                                        if ($grom34 != '') { 
                                                                            echo $grom34 .','; 
                                                                        }
                                                                        if ($prodcolor['symbol'] != '') {
                                                                            echo $prodcolor['symbol']; 
                                                                        }
                                                                        echo "</small>";
                                                                    ?>
                                                                </a>
                                                            </td>
                                                           
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
                                           <?php
                                           if($sel_data['delivery_status'] != "Delivered"){
                                         ?>
                                            <a href="deliverymen-delete.php?order_id=<?php echo $order_id; ?>&tracking_id=<?php echo $tracking_id; ?>"><i class="fa fa-times"></i></a>
                                    <?php
                                           }
                                           ?>
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
                                                if($sel_data['delivery_status']=='Pending'){
                                                        echo "<span style='color:#FFA500;'>Delivery is Pending</span>";
                                                    }
                                                    else{
                                                        //echo $sel_deliveryman_data['delivery_status'];
                                                        if($sel_data['delivery_status']=='Cancelled'){
                                                        echo "<span style='color:red'>Cancelled by ".$sel_data['delivery_status_by']." (".$sel_data['dmen_date']." ".$sel_data['dmen_time'].")</span>";
                                                        echo "<br><span style='color:red'> Reason : ".$sel_data['reason']."</span>";                          
                                                        }
                                                        else{
                                                            echo "<span style='color:green'>Delivered Successfully</span> (".$sel_data['dmen_date']." ".$sel_data['dmen_time'].")";  
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
                                            $update=mysqli_query($conn,"UPDATE `delivery_schedule` SET `deliverymen_id`='$id',`delivery_status`='Pending',`delivery_status_by`=NULL,`reason`=NULL,`status`='Active',`date`='$date',`time`='$time',`dmen_date`=NULL,`dmen_time`=NULL WHERE `tracking_id`='$tracking_id'");
                                           
                                    }else{
    

                                        $deliveryQuery= "INSERT INTO `delivery_schedule` (`deliverymen_id`,`order_tbl_id`,`order_id`,`tracking_id`,`date`,`time`) VALUES ('$id','$order_tbl_id','$order_id','$tracking_id','$date','$time')";
                                    //  echo $deliveryQuery;
                                    //     exit();
                                        
                                        $ins=mysqli_query($conn,$deliveryQuery);
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