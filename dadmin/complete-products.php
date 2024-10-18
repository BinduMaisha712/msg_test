<?php 
error_reporting(0);
include ('includes/header.php'); ?>
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
                                    <th>User Name</th>
                                    <th>Total Price</th>
                                    <th>Order Date</th>
                                    <th>Order Details</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    if(!empty($_GET['fromdate']) && !empty($_GET['todate']))
    {
        $fromdate=$_GET['fromdate'];
        $todate=$_GET['todate'];
        $status=$_GET['status'];
        if(!empty($_GET['status']) && $_GET['status']=='Complete')
        {
            // $query=mysqli_query($conn,"SELECT * FROM `order_tbl` WHERE order_id In (SELECT order_id FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Delivered') AND order_id IN (SELECT order_id FROM `delivery_schedule` WHERE delivery_status='Delivered' ) ORDER BY `id` DESC");
            $query=mysqli_query($conn,"SELECT * FROM `order_tbl` WHERE order_id In (SELECT order_id FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Delivered') ORDER BY `id` DESC");
        }
       
    }
    $sr=1;
    while($data=mysqli_fetch_assoc($query))
    {
      $order_id=$data['order_id'];
      $userid=$data['userid'];
      $user_query=mysqli_query($conn,"SELECT * FROM `user` WHERE id='$userid'");
      $user_data=mysqli_fetch_array($user_query);
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
									 <td style="color: green;"><?php echo $data['order_id'];?></td>
                                    <td><?php echo $user_data['firstname'];?>&nbsp;<?php echo $user_data['lastname'];?></td>
                                    <td style="color: #e16123;">
                                        <?php
                                        $canquery=mysqli_query($conn,"SELECT * FROM order_details WHERE order_id='$order_id'");
                                        while($candata=mysqli_fetch_array($canquery))
                                        {
                                            $tracking_id=$candata['tracking_id'];
                                            $can_query=mysqli_query($conn,"SELECT * FROM order_details WHERE tracking_id IN (SELECT tracking_id FROM `order_status` WHERE tracking_id='$tracking_id' AND tracking_status='Cancelled')");
                                            $can_data=mysqli_fetch_array($can_query);
                                            $can_price=$can_data['quantity']*$can_data['price'];
                                            $canprice+=$can_price;
                                        }
                                        ?>
                                        <span >$&nbsp;</span>&nbsp;<?php echo $data['orderprice']-$canprice;?>
                                        <?php unset($canprice); ?>
                                    </td>
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

        $pro_select=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
    $sn=1;
    while($pro_data=mysqli_fetch_array($pro_select)){
        $tracking_id=$pro_data['tracking_id'];

            $status_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' AND tracking_status='Delivered' ORDER BY id DESC");
         if(mysqli_num_rows($status_query)>0){
        $status_data=mysqli_fetch_array($status_query);
    
?>                                  
                                    <tr>
                                        <td></td>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $tracking_id; ?></td>
                                        
                                        <td colspan="3" <?php if($status_data['tracking_status']=="Cancelled"){ ?> style="color: #ff4040;" <?php }elseif($status_data['tracking_status']=="Ordered and Approved"){ ?>style="color: green;"<?php }elseif($status_data['tracking_status']=="Delivered"){ ?> style="color: green;"<?php }elseif($status_data['tracking_status']==''){ ?> style="color:#007bff;" <?php }else{ ?>style="color: #20c997;" <?php } ?> >  <?php if($status_data['tracking_status']==''){ echo "pending"; }else{ echo $status_data['tracking_status']."&nbsp;(".$status_data['date']."&nbsp;".$status_data['time'].")"; } ?>
                                        
                                    </td> 
                                    <td><?php 
$date_sel=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' AND delivery_date!=''");
$date_data=mysqli_fetch_array($date_sel);
echo $date_data['delivery_date']."&nbsp".$date_data['delivery_time'];
                                     ?></td> 
                                    </tr>
<?php $sn++;  } } ?>
                                </tbody>
                                

<?php  $sr++; } ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
