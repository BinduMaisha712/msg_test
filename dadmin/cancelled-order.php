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
                                    $sr=1;
                                   $can_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_status='Cancelled' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                        while($can_data1=mysqli_fetch_array($can_query))
                                        {
                                            $can_order_id1[]=$can_data1['order_id'];
                                            $can_order_id1=array_unique($can_order_id1);
                                        }
                                         
                                        foreach($can_order_id1 as $can_order_id1)
                                        {
                                            $query=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$can_order_id1'");
                                            while($data=mysqli_fetch_array($query))
                                            {
                                                $tracking_id[]=$data['tracking_id'];
                                                
                                            }
                                            $query1=mysqli_query($conn,"SELECT * FROM `order_status` WHERE order_id='$can_order_id1' AND tracking_status='Cancelled'");
                                            while($data1=mysqli_fetch_array($query1))
                                            {
                                                $tracking_id1[]=$data1['tracking_id'];
                                                
                                            }
                                             $tcount=count($tracking_id);
                                             $tcount1=count($tracking_id1);
                                            
                                             if($tcount1==$tcount)
                                             {
                                    
                                                                  
                                foreach($tracking_id as $tracking_id){
                                        $sel=mysqli_query($conn,"SELECT * FROM order_details WHERE tracking_id='$tracking_id'") OR die(mysqli_error($conn));
                                        $sel_data=mysqli_fetch_array($sel);
                                        $order_id=[];
                                        $order_id[]=$sel_data['order_id'];
                                        $order_id=array_unique($order_id);
                                    }
                                    foreach($order_id as $order_id){
                                      $query=mysqli_query($conn,"SELECT * FROM `order_tbl` WHERE order_id='$order_id'");
                                      $data=mysqli_fetch_array($query);
                                      $userid=$data['userid'];
                                      $user_query=mysqli_query($conn,"SELECT * FROM `user` WHERE id='$userid'");
                                      $user_data=mysqli_fetch_array($user_query);
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

    $sn=1;
    foreach($tracking_id1 as $tracking_id4){

        $status_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id4' ORDER BY id DESC");
        $status_data=mysqli_fetch_array($status_query);
?>                                  
                                    <tr>
                                        <td></td>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $tracking_id4; ?></td>
                                        
                                        <td colspan="3" <?php if($status_data['tracking_status']=="Cancelled"){ ?> style="color: #ff4040;" <?php }elseif($status_data['tracking_status']=="Ordered and Approved"){ ?>style="color: green;"<?php }elseif($status_data['tracking_status']=="Delivered"){ ?> style="color: green;"<?php }elseif($status_data['tracking_status']==''){ ?> style="color:#007bff;" <?php }else{ ?>style="color: #20c997;" <?php } ?> >  <?php if($status_data['tracking_status']==''){ echo "pending"; }else{ echo $status_data['tracking_status']."&nbsp;(".$status_data['date']."&nbsp;".$status_data['time'].")"; } ?>
                                        
                                    </td> 
                                    <td><?php 
$date_sel=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id4' AND delivery_date!=''");
$date_data=mysqli_fetch_array($date_sel);
echo $date_data['delivery_date']."&nbsp".$date_data['delivery_time'];
                                     ?></td> 
                                    </tr>
<?php $sn++; } ?>
                                </tbody>
                                

<?php  $sr++; } ?>
                                                <?php
                                             }
                                             unset($tracking_id);
                                             unset($tracking_id1);
                                        }
                                       
                               }else{
                                $srr=0;
                                $can_query1=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_status='Cancelled'");
                                        while($can_data1=mysqli_fetch_array($can_query1))
                                        {
                                            $can_order_id1[]=$can_data1['order_id'];
                                            $can_order_id1=array_unique($can_order_id1);
                                        }
                                         
                                        foreach($can_order_id1 as $can_order_id1)
                                        {
                                            $query=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$can_order_id1'");
                                            while($data=mysqli_fetch_array($query))
                                            {
                                                $tracking_id[]=$data['tracking_id'];
                                                
                                            }
                                            $query1=mysqli_query($conn,"SELECT * FROM `order_status` WHERE order_id='$can_order_id1' AND tracking_status='Cancelled'");
                                            while($data1=mysqli_fetch_array($query1))
                                            {
                                                $tracking_id1[]=$data1['tracking_id'];
                                                
                                            }
                                             $tcount=count($tracking_id);
                                             $tcount1=count($tracking_id1);
                                            
                                             if($tcount1==$tcount)
                                             {
                                    
                                                                  
                                foreach($tracking_id as $tracking_id){
                                        $sel=mysqli_query($conn,"SELECT * FROM order_details WHERE tracking_id='$tracking_id'") OR die(mysqli_error($conn));
                                        $sel_data=mysqli_fetch_array($sel);
                                        $order_id=[];
                                        $order_id[]=$sel_data['order_id'];
                                        $order_id=array_unique($order_id);
                                    }
                                    
                                    foreach($order_id as $order_id){
                                       $srr++;
                                      $query=mysqli_query($conn,"SELECT * FROM `order_tbl` WHERE order_id='$order_id'");
                                      $data=mysqli_fetch_array($query);
                                      $userid=$data['userid'];
                                      $user_query=mysqli_query($conn,"SELECT * FROM `user` WHERE id='$userid'");
                                      $user_data=mysqli_fetch_array($user_query);
                                ?>
                                <tr>
                                    <td><?php echo $srr; ?></td>                            
                                     <td style="color: green;"><?php echo $data['order_id'];?></td>
                                    <td><?php echo $user_data['firstname'];?>&nbsp;<?php echo $user_data['lastname'];?></td>
                                    <td style="color: #e16123;"><span >$&nbsp;</span>&nbsp;<?php echo $data['orderprice'];?></td>
                                    <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td>
                                     <td><a href="order-details.php?order_id=<?php echo $data['order_id']; ?>" class="btn btn-success" target="_blank">view</a></td>
                                     <td>
                                        <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse<?php echo $srr; ?>" aria-expanded="false" aria-controls="collapse<?php echo $srr; ?>">+</button>
                                     </td>
                                </tr>
                                <tbody id="collapse<?php echo $srr; ?>" class="collapse <?php if($srr==1) echo "show"; ?>" aria-labelledby="heading<?php echo $srr; ?>" data-parent="#accordionExample">
                                    <tr>
                                        <th ></th>
                                        <th width="10%">Sr.No</th>
                                        <th width="15%">Tracking Id</th>
                                        <th colspan="3">Status</th>
                                        <th width="20%">Delivery Date</th>
                                    </tr>
<?php

    $sn=1;
    foreach($tracking_id1 as $tracking_id4){

        $status_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id4' ORDER BY id DESC");
        $status_data=mysqli_fetch_array($status_query);
?>                                  
                                    <tr>
                                        <td></td>
                                        <td><?php echo $sn; ?></td>
                                        <td><?php echo $tracking_id4; ?></td>
                                        
                                        <td colspan="3" <?php if($status_data['tracking_status']=="Cancelled"){ ?> style="color: #ff4040;" <?php }elseif($status_data['tracking_status']=="Ordered and Approved"){ ?>style="color: green;"<?php }elseif($status_data['tracking_status']=="Delivered"){ ?> style="color: green;"<?php }elseif($status_data['tracking_status']==''){ ?> style="color:#007bff;" <?php }else{ ?>style="color: #20c997;" <?php } ?> >  <?php if($status_data['tracking_status']==''){ echo "pending"; }else{ echo $status_data['tracking_status']."&nbsp;(".$status_data['date']."&nbsp;".$status_data['time'].")"; } ?>
                                        
                                    </td> 
                                    <td><?php 
$date_sel=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id4' AND delivery_date!=''");
$date_data=mysqli_fetch_array($date_sel);
echo $date_data['delivery_date']."&nbsp".$date_data['delivery_time'];
                                     ?></td> 
                                    </tr>
<?php $sn++; } ?>
                                </tbody>
                                

<?php   } ?>
                                                <?php
                                             }
                                             unset($tracking_id);
                                             unset($tracking_id1);
                                        }
                                        
                               }
                                  ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
           