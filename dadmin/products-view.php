<?php
$cid=$_REQUEST['cid'];
$sid=$_REQUEST['sid'];
//$pid=$_REQUEST['pid'];
include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
                <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="Category : <?php $query=mysqli_query($conn,"SELECT * FROM `category` WHERE id=$cid"); $data=mysqli_fetch_array($query); 
                    $query1=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE id=$sid");
					$data1=mysqli_fetch_array($query1);
                    echo $data['cat_name']; ?> subcategory:<?php  echo $data1['sub_cat_name']; ?>
                    ">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Products Available Vendor</th>
                                    <th>View</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query($conn,"SELECT * FROM `products` WHERE subcat_id=$sid");
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
  <a class="btn btn-success" href="products-status.php?pid=<?php echo $data['id'].'&Active=Inactive'; ?>&cid=<?php echo  $cid; ?>&sid=<?php echo $sid; ?>" onClick="return confirm('are you sure you want to Inactive this products')">Active</a>  
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="products-status.php?pid=<?php echo $data['id'].'&Active=Active'; ?>&cid=<?php echo  $cid; ?>&sid=<?php echo $sid; ?>" onClick="return confirm('are you sure you want to Active this products')">Inactive</a>  
  <?php
     }


     ?>                                       
                                    </td>
                                    <td><?php
                                            if($data['vendor_id']==0) echo 'No' ;else echo 'Yes';
                                     ?></td>
                                    <td>
                                        <a class="btn btn-success" href="products-detail.php?pid=<?php echo $data['id']; ?>">View</a>
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
           