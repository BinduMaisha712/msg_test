<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                   
                                    <th>Status</th>
                                    <th>Free</th>
                                    <th>View Details</th>
                                    <th>Trash</th>
                                    
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query($conn,"SELECT * FROM `deliverymen` WHERE trash = 'No' ORDER BY id DESC");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['name'];?></td>
                                    <td><?php echo $data['mobile'];?></td>
                                    
                                    <td>
 <?php

  if( $data['status']=='Active' ){
?>
  <a class="btn btn-success" href="delivery-status.php?aid=<?php echo $data['id'].'&Active=Inactive'; ?>" onClick="return confirm('are you sure you want to Inactive')">Active</a>  
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="delivery-status.php?aid=<?php echo $data['id'].'&Active=Active'; ?>" onClick="return confirm('are you sure you want to Active')">Inactive</a>  
  <?php
     }


     ?>                                       
                                    </td>
                                       <td>
 <?php

  if( $data['free']=='Yes' ){
?>
  <a class="btn btn-success" href="delivery-status-free.php?aid=<?php echo $data['id'].'&Yes=No'; ?>" onClick="return confirm('are you sure deliverymen is not free')">Yes</a>  
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="delivery-status-free.php?aid=<?php echo $data['id'].'&Yes=Yes'; ?>" onClick="return confirm('are you sure deliverymen is free')">No</a>  
  <?php
     }


     ?>                                       
                                    </td>
                                    <td><a class="btn btn-success" href="delivery-men-details.php?did=<?php echo $data['id']; ?>">View</a></td>
                                    <td><a href="deliverymen-trash.php?did=<?php echo $data['id'].'&Active=Inactive&trash=Yes'; ?>" onClick="return confirm('Are you sure you want to Delete this Delivery Men')"><i class="fa fa-trash" style=" font-size: 30px;"></i></a></td>
                                    
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
           
