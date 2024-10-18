<?php
error_reporting(0);
include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
                <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="<?php echo $_GET['status']; ?> Order">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Order Id</th>
                                    <th>User Name</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Order Details</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                
                                if(!empty($_GET['fromdate']) && !empty($_GET['todate'])){
                                    $fromdate=$_GET['fromdate'];
                                    $todate=$_GET['todate'];
                                    if(isset($_GET['vendor']) && $_GET['vendor']=='vendor')
                                    {
                                        $query=mysqli_query($conn,"SELECT * FROM `vendor_order_tbl` WHERE `vendor_date` BETWEEN '$fromdate' AND '$todate' AND `order_status`='Cancelled' AND order_status_by='vendor'");
                                    }else{
                                    if($_GET['status']=='Cancelled'){
                                        $query=mysqli_query($conn,"SELECT * FROM `warehouse_schedule` WHERE `war_date` BETWEEN '$fromdate' AND '$todate' AND `order_status`='Cancelled' AND order_status_by='warehouse'");
                                    }else{
                                        $query=mysqli_query($conn,"SELECT * FROM `order_details`  WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_id NOT IN (SELECT tracking_id FROM `warehouse_schedule`) AND tracking_id NOT IN (SELECT tracking_id FROM vendor_order_tbl) ORDER BY `id` DESC");
                                    }
                                }
                                       
                               }else{
                                $query=mysqli_query($conn,"SELECT * FROM `order_details`  WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_id NOT IN (SELECT tracking_id FROM `warehouse_schedule`) ORDER BY `id` DESC");
                            }
                                  $sr=1;
                                  $sn=1;
                                while($data=mysqli_fetch_assoc($query))
                                {
                                    $order_id[]=$data['order_id'];
                                    $order_id=array_unique($order_id);
                                }
                                if(!empty($order_id)) {
                                foreach($order_id as $order_id){
                                      $query=mysqli_query($conn,"SELECT * FROM `order_tbl` WHERE order_id='$order_id'");
                                      $data=mysqli_fetch_assoc($query);
                                      $userid=$data['userid'];
                                      $user_query=mysqli_query($conn,"SELECT * FROM `user` WHERE id='$userid'");
                                      $user_data=mysqli_fetch_assoc($user_query);
                                ?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                     <td style="color: green;"><?php echo $data['order_id'];?></td>
                                    <td><?php echo $user_data['firstname'];?>&nbsp;<?php echo $user_data['lastname'];?></td>
                                    <td style="color: #e16123;"><span >$&nbsp;</span>&nbsp;<?php echo $data['orderprice'];?></td>
                                    <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td>
                                     <td><a href="order-details.php?order_id=<?php echo $data['order_id']; ?>" class="btn btn-success" target="_blank">view</a></td>
                                     <td>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $sr; ?>" aria-expanded="false" aria-controls="collapse<?php echo $sr; ?>">+</button>
                                     </td>
                                </tr>
                                <tbody id="collapse<?php echo $sr; ?>" class="collapse <?php if($sr==1) echo "show"; ?>" aria-labelledby="heading<?php echo $sr; ?>" data-parent="#accordionExample">
                                    <tr>
                                        <th ></th>
                                        <th width="10%">Sr.No</th>
                                        <th width="15%">Tracking Id</th>
                                        <th colspan="3">Status</th>
                                        <th width="20%">Delivery Date</th>
                                    </tr>
<?php
if($_GET['vendor']=='vendor')
{
    $pro_select=mysqli_query($conn,"SELECT * FROM `vendor_order_tbl` WHERE order_id='$order_id' AND `vendor_date` BETWEEN '$fromdate' AND '$todate' AND `order_status`='Cancelled' AND order_status_by='vendor'");
}else{
    if($_GET['status']=='Cancelled'){
        $pro_select=mysqli_query($conn,"SELECT * FROM `warehouse_schedule` WHERE order_id='$order_id' AND `war_date` BETWEEN '$fromdate' AND '$todate' AND `order_status`='Cancelled' AND order_status_by='warehouse'");
    }else{
        $pro_select=mysqli_query($conn,"SELECT * FROM `order_details`  WHERE order_id='$order_id' AND `date` BETWEEN '$fromdate' AND '$todate' AND tracking_id NOT IN (SELECT tracking_id FROM `warehouse_schedule`)");
    }
}
    $sn=1;
    while($pro_data=mysqli_fetch_assoc($pro_select)){
        $tracking_id=$pro_data['tracking_id'];
        $status_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' ORDER BY id DESC");
        $status_data=mysqli_fetch_assoc($status_query);
?>                                  
                                    <tr>
                                        <td></td>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $tracking_id; ?></td>
                                        
                                        <td colspan="3" <?php if($status_data['tracking_status']=="Cancelled"){ ?> style="color: #ff4040;" <?php }elseif($status_data['tracking_status']=="Ordered and Approved"){ ?>style="color: green;"<?php }elseif($status_data['tracking_status']=="Delivered"){ ?> style="color: green;"<?php }elseif($status_data['tracking_status']==''){ ?> style="color:#007bff;" <?php }else{ ?>style="color: #20c997;" <?php } ?> >  <?php if($status_data['tracking_status']==''){ echo "pending"; }else{ echo $status_data['tracking_status']."&nbsp;(".$status_data['date']."&nbsp;".$status_data['time'].")"; } ?>
                                        
                                    </td> 
                                    <td><?php 
$date_sel=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' AND delivery_date!=''");
$date_data=mysqli_fetch_assoc($date_sel);
echo $date_data['delivery_date']."&nbsp".$date_data['delivery_time'];
                                     ?></td> 
                                    </tr>
<?php $sn++; } ?>
                                </tbody>
                                

<?php  $sr++; } } ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
           