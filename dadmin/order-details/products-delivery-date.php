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
        $product_id=$sel_datas['productid'];
     
        $product_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$product_id");
        $product_data=mysqli_fetch_array($product_query);
        
        $grom34=$product_data['class1'];

        $prodcolor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT symbol FROM size_class WHERE id=" . $product_data['class0']));

?>                                                  <tr>
                                                        <td><?php echo $tracking_id; ?>
                                                        <br />
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
                                                    <button class="btn btn-success" name="delivery_date" style="float:right;">Submit</button>
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
