<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
                <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="HOT DEALS PRODUCTS">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query($conn,"SELECT * FROM `hot_deals_products`");
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
  <a class="btn btn-success" href="hot-deals-status.php?pid=<?php echo $data['id'].'&Active=Inactive'; ?>" onClick="return confirm('are you sure you want to Inactive this products')">Active</a>  
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="hot-deals-status.php?pid=<?php echo $data['id'].'&Active=Active'; ?>" onClick="return confirm('are you sure you want to Active this products')">Inactive</a>  
  <?php
     }


     ?>                                       
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="hot-deals-detail.php?pid=<?php echo $data['id']; ?>">View</a>
                                    </td>
                                    <td><?php echo $data['datetime'] ?></td> 
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
           