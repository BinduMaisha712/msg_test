<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">

            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="CATEGORY VIEWS">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>View Subcategory</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    
    $query=mysqli_query($conn,"SELECT * FROM `category` ORDER BY id DESC");
  
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['cat_name'];?></td>
                                    <td>
 <?php

  if( $data['status']=='Active' ){
?>
  <button class="btn btn-success">Active</button>  
<?php
     }
     else
     { 
         ?>
  <button class="btn btn-danger">Inactive</button>  
  <?php
     }


     ?>                                       
                                    </td>
                                    <td><a class="btn btn-success" href="subcategory-view-products.php?cid=<?php echo $data['id']; ?>">View</a></td>
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
