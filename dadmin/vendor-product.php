<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
                <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="Product View">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Approval</th>
                                    <th>View</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $vendor_id=$_GET['vid'];
    $query=mysqli_query($conn,"SELECT * FROM `vendor_products` WHERE vendor_id=$vendor_id ORDER BY id DESC");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['product_name'];?></td>
                                 <td>
 <?php

  if( $data['status']=='Active' ){
?>
  <a class="btn btn-success" href="javascript:;">Active</a>  
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="javascript:;">Inactive</a>  
  <?php
     }


     ?>                                       
                                    </td>
                                    <td>
                                       <?php

  if( $data['admin_approval']=='Approved' ){
?>
  <a class="btn btn-success" href="javascript:;">approved</a>  
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="javascript:;">Unapproved</a>  
  <?php
     }


     ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="vendor-products-detail.php?pid=<?php echo $data['id']; ?>">View</a>
                                    </td>
                                    <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td> 
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
           