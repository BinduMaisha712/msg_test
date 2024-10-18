<?php

include ('includes/header.php');
 $vid=$_REQUEST['vid'];
?>
        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="Category : <?php $query=mysqli_query($conn,"SELECT * FROM `category` WHERE id=$vid"); $data=mysqli_fetch_array($query); echo $data['cat_name']; ?>">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Subcategory</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE cat_id='$vid'");
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
  <a class="btn btn-success" href="subcat-status.php?said=<?php echo $data['id'].'&Active=Inactive';?>&vid=<?php echo $vid; ?>" onClick="return confirm('are you sure you want to Inactive this products')">Active</a>  
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="subcat-status.php?said=<?php echo $data['id'].'&Active=Active'; ?>&vid=<?php echo $vid; ?>" onClick="return confirm('are you sure you want to Active this products')">Inactive</a>  
  <?php
     }


     ?>                                       
                                    </td>
                                    <td><a href="subcategory-edit.php?seid=<?php echo $data['id'];?>&vid=<?php echo $vid; ?>"><span class="fa fa-edit" style="color:green; font-size: 30px;"></span></a></td>
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
           