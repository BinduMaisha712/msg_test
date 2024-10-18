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
