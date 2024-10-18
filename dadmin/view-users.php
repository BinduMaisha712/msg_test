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
                                    <th>User Name</th>
                                    <th>Mobile</th>
                                    <th>Email</th>
									<!-- <th>Gender</th> -->
									<th>Status</th>
									<th>Order History</th>
									<th>View User's Cart</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query($conn,"SELECT * FROM `user` ORDER BY id DESC");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['firstname'];?></td>
									<td><?php echo $data['mobile'];?></td>
									<td><?php echo $data['email'];?></td>
									<!-- <td><?php echo $data['gender'];?></td> -->
									 <td>
 <?php

  if( $data['status']=='Active' ){
?>
  Active 
<?php
     }
     else
     { 
         ?>
  Inactive  
  <?php
     }


     ?>                                       
                                    </td>
									<td> 
                    <a href="user-order-history.php?id=<?php echo $data['id']; ?>" > 
                    <button class="btn btn-success">View</button> </a> </td>
                                    <td> 
                                      <a href="user-cart.php?id=<?php echo $data['id']; ?>" >
                                       <button class="btn btn-success">View</button> </a> </td>
									<td><?php echo $data['datentime']; ?></td>
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
