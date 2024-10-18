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
                                    <th>Category</th>                                   
                                    <th>Created Date</th>                                   
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            //print_r($_SESSION);
                            if(isset($_SESSION['alert']))
                            {
                               
                                  echo '<div id="snackbar">'.$_SESSION['alert'].'</div>';
                                  echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                  
                                  // echo"var delay = 1000;setTimeout(function(){ window.location = 'add-products.php'; }, delay);";
                                  echo "</script>";
                                  unset($_SESSION['alert']);
                               
                              }
                              $query=mysqli_query($conn,"SELECT * FROM `category` WHERE trash = 'Yes' ORDER BY id DESC");
                              $sr=1;
                              while($data=mysqli_fetch_array($query))
                              {  
                              ?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['cat_name'];?></td> 
                                      <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td>                                     
                                      <td><a href="trash-category.php?eid=<?php echo $data['id'].'&Active=Active&trash=No'; ?>" onClick="return confirm('Are you sure you want to Restore this Category')" class="btn btn-success">Move to Live</a></td>
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
           