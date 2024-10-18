<?php

include ('includes/header.php');
 $cid=$_REQUEST['cid'];
?>
        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="Category : <?php $query=mysqli_query($conn,"SELECT * FROM `category` WHERE id=$cid"); $data=mysqli_fetch_array($query); echo $data['cat_name']; ?>">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Subcategory</th>
                                    <th>Status</th>
                                    <th>View Products</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE cat_id='$cid'");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['sub_cat_name'];?></td>
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
                                    <td><a class="btn btn-success" href="products-view.php?sid=<?php echo $data['id']; ?>&cid=<?php echo $cid; ?>">View</a></td>
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
           