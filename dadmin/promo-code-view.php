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
                                                        <th>Code</th>                        
                                                        <th>Title</th>
                                                        <th>Price</th>
                                                        <th>View Promo Code</th>
                                                        
                                                        <th>Status</th>
                                                        <th>Trash</th>
                                                        <th>Date</th>
                                                      
                                                    </tr>
                                                </thead>
                                                <tbody>
                    <?php
                            $query=mysqli_query($conn,"SELECT * FROM `promo_code` WHERE trash = 'No' ORDER BY `date` DESC");
                        
                        $sr=1;
                        while($data=mysqli_fetch_array($query))
                        {
                    ?>
                                                    <tr>
                                                        <td><?php echo $sr ?></td>                            
                                                        <td><?php echo $data['code'];?></td>
                                                        
                                                        <td><?php echo $data['title'];?></td>
                                                        
                                                        <td>
                                                            <?php if($data['percentage']=='no'){
                                                                    ?>
                                                                        <?= $currency ?? '' ?>&nbsp;<?php echo $data['price']; ?>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                        <?php echo $data['price']; ?>%
                                                                    <?php
                                                                } ?>
                                                        </td>
                                                                                                           
                                                        <td><a class="btn btn-success" href="promo-code-details.php?pid=<?php echo $data['id']; ?>">View</a></td>
                                                       

                                                        <td><?php

  if( $data['status']=='Active' ){
?>
  <a class="btn btn-success btn-md" href="promo-code-status.php?pid=<?php echo $data['id'].'&Active=Inactive'; ?>" onClick="return confirm('Are you sure you want to Inactive this products')">Active</a> 
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="promo-code-status.php?pid=<?php echo $data['id'].'&Active=Active'; ?>" onClick="return confirm('Are you sure you want to Active this products')">Inactive</a>
  <?php
     } ?></td>
                                                        <td><a href="promo-code-trash.php?pid=<?php echo $data['id'].'&Active=Inactive&trash=Yes'; ?>" onClick="return confirm('Are you sure you want to Delete this Promo code')"><i class="fa fa-trash" style=" font-size: 30px;"></i></a></td>
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
                                <?php include('includes/footer.php'); 
?>