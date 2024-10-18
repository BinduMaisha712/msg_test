<?php

include ('includes/header.php');
?>
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
									<th>Order Status</th>
									<th>Order Details</th>
                                    <th>Order Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
	  $id = $_GET['id'];
    $query=mysqli_query($conn,"SELECT * FROM `order_tbl` where userid='$id' ");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
     $track =  mysqli_query($conn,"SELECT * FROM `order_status` WHERE order_id='$data[order_id]' order by id Desc  ");
	 $track_data = mysqli_fetch_array($track);
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                   <td><?php echo $data['order_id'];?></td>
                                     
									<td><?php echo $track_data['tracking_status'];
									if($track_data['tracking_status']=="Cancelled"){
										echo " by ".$track_data['by']."<br> Reason: ".$track_data['reason'];
									}
									
									 ?></td>
									 <td><a href="order-details.php?order_id=<?php echo $data['order_id']; ?>" class="btn btn-default">view</a></td>
                                    
                                    
									<td><?php echo $data['date'].$data['time']; ?></td>
                                </tr>

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
