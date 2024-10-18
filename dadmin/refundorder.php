<?php ob_start(); 
 session_start(); 
include("config/connection.php");

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
                                    <th>Image</th>
									<th>Product</th>
									<th>Price</th>
									<th>Status</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
	
    $query=mysqli_query($conn,"SELECT r.*,od.*,r.id as rid FROM `refund_order` r,order_details od WHERE r.od_p_id=od.id ORDER BY r.id desc ");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
    //  $track =  mysqli_query($conn,"SELECT * FROM `order_status` WHERE order_id='$data[order_id]' order by id Desc  ");
// 	 $track_data = mysqli_fetch_array($track);
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                   <td><?php echo $data['order_id'];?></td>
                                     <td><img src="../asset/image/product/<?= $data['productimage']; ?>"></td>
									<td><?= $data['productname']; ?></td>
									 <td><?= $data['price']; ?> </td>
                                    <td><?php if($data['status']=='0'){ echo 'Pending'; }else if($data['status']=='1'){ echo 'Refund Initiated'; }else{ echo 'refunded'; } ?></td>
                                    
									<td><?php echo $data['created_date']; ?></td>
									<td><?php if($data['status']=='0'){ ?><select class="update_status" data-id="<?= $data['rid']; ?>" data-orderid="<?= $data['order_id']; ?>"><option value="">Update status</option><option value="refund_initiated">Refund Intitiated</option><option value="refunded">Refunded</option></select> <?php }else if($data['status']=='1'){ ?><select class="update_status" data-id="<?= $data['rid']; ?>" data-orderid="<?= $data['order_id']; ?>"><option value="">Update Status</option><option value="refunded">Refunded</option><?php } ?></td>
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
            
            <script>
                $(document).on('change','.update_status',function(){
                   var id=$(this).attr('data-id');
                    var orderid=$(this).attr('data-orderid');
                    var status=$(this).val();
                    window.location.href="refund_status.php?orderid="+orderid+"&id="+id+"&status="+status;
                });
            </script>
