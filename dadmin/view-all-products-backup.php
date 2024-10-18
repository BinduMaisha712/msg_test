<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
                <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="PRODUCTS DETAILS">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Product</th>
                                    <th>Top Featured</th>
                                    <th>Festive Collection</th>
                                    <th>New Arrivals</th>
                                    <th>Status</th>
                                    <th>Created Date</th>
                                    <th>Edit</th>
                                    <th>Trash</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            //print_r($_SESSION);
                            if(isset($_SESSION['alert']))
                            {
                                if($_SESSION['alert']=='updated')
                                {
                                  echo '<div id="snackbar">Updated Succcessfully...</div>';
                                  echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                  
                                  // echo"var delay = 1000;setTimeout(function(){ window.location = 'add-products.php'; }, delay);";
                                  echo "</script>";
                                  unset($_SESSION['alert']);
                                }
                              }
                              $query=mysqli_query($conn,"SELECT * FROM `products` WHERE trash = 'No' group by group_code ORDER BY id DESC");
                              $sr=1;
                              while($data=mysqli_fetch_array($query))
                              {  
                                ?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['product_name'];?></td>
                                    <td>
                                      <?php
                                        if( $data['top']=='No' ){
                                        ?>
                                          <a class="btn btn-danger" href="change_pdec.php?hid=<?=$data['group_code'].'&type=top'; ?>" onClick="return confirm('Are you sure you want to add this products in Top Featured')">No</a>  
                                        <?php
                                        }
                                        else
                                        { ?>
                                          <a class="btn btn-success"  href="change_pdec.php?hid=<?=$data['group_code'].'&type=top'; ?>" onClick="return confirm('Are you sure you want to remove this products in Top Featured')">Yes</a><?php
                                        } ?>                                       
                                    </td>
                                    <td>
                                     <?php
                                      if( $data['hot_deals']=='No' ){ ?>
                                      <a class="btn btn-danger" href="change_pdec.php?hid=<?=$data['group_code'].'&type=hot_deals';?>" onClick="return confirm('Are you sure you want to add this products in New arrivals')">No</a>  
                                    <?php
                                      }
                                     else
                                     {   ?>
                                      <a class="btn btn-success" href="change_pdec.php?hid=<?=$data['group_code'].'&type=hot_deals';?>" onClick="return confirm('Are you sure you want to remove this products in New arrivals')">Yes</a>  
                                      <?php
                                      } ?>                                       
                                    </td> 
                                   <td>
                                     <?php
                                      if( $data['new_arrivals']=='No' ){ ?>
                                      <a class="btn btn-danger" href="change_pdec.php?hid=<?=$data['group_code'].'&type=new_arrivals';?>" onClick="return confirm('Are you sure you want to add this products in New arrivals')">No</a>  
                                    <?php
                                      }
                                     else
                                     {   ?>
                                      <a class="btn btn-success" href="change_pdec.php?hid=<?=$data['group_code'].'&type=new_arrivals';?>" onClick="return confirm('Are you sure you want to remove this products in New arrivals')">Yes</a>  
                                      <?php
                                      } ?>                                       
                                    </td> 
                                    <td>
                                       <?php
                                      if( $data['status']=='Active' ){  ?>
                                        <a href="change_pdec.php?hid=<?=$data['group_code'].'&type=status';?>"><button class="btn btn-success" onClick="return confirm('Are you sure you want to Inactive this products')">Active</button></a>
                                      <?php
                                       }
                                       else
                                       {  ?>
                                        <a href="change_pdec.php?hid=<?=$data['group_code'].'&type=status';?>"><button class="btn btn-danger" onClick="return confirm('Are you sure you want to Active this products')">Inactive</button> </a>
                                        <?php
                                        } ?>                                       
                                      </td>
                                      <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td>
                                      <td><a href="edit_product.php?id=<?=$data['group_code'];?>"><span class="fa fa-edit"></span></a></td>
                                      <td><a href="trash-product.php?eid=<?php echo $data['group_code'].'&Active=Inactive&trash=Yes'; ?>" onClick="return confirm('Are you sure you want to Delete this Product')"><i class="fa fa-trash" style=" font-size: 30px;"></i></a></td>
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
           