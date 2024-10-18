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
                                    <th>Created Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query($conn,"SELECT * FROM `deliverymen` WHERE trash = 'Yes' ORDER BY id DESC");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['name'];?></td>
                                    <td><?php echo $data['mobile'];?></td> 
                                     <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td>
                                    <td><a href="deliverymen-trash.php?did=<?php echo $data['id'].'&Active=Active&trash=No'; ?>" onClick="return confirm('Are you sure you want to Restore this Delivery Men')" class="btn btn-success">Move to Live</a></td>
                                    
                                   
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
           
