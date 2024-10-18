<?php
	include ('includes/header.php');
                    ?>
                            <!-- Main Container Start -->
                            <main class="main--container">
                                <!-- Main Content Start -->
                                <section class="main--content">
                                    <div class="panel">
                                        <!-- Records List Start -->
                                        <div class="records--list" data-title="VENDOR VIEWS">
                                            <table id="recordsListView">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No</th>
                                                        <th>Company Name</th>
                                                        <th>Contact Person Name</th>                                 
                                                        <th>Mobile</th>
                                                        <th>Address</th>
                                                        <th>View Vendor</th>
                                                                                                           
                                                    </tr>
                                                </thead>
                                                <tbody>
                    <?php
                        $query=mysqli_query($conn,"SELECT * FROM `vendor` ORDER BY id DESC");
                        $sr=1;
                        while($data=mysqli_fetch_array($query))
                        {
                    ?>
                                                    <tr>
                                                        <td><?php echo $sr ?></td>                            
                                                        <td><?php echo $data['name'];?></td>
                                                        <td><?php echo $data['cp_name'] ?></td>
                                                        <td><?php echo $data['mobile'];?></td>
                                                        
                                                        <td><?php echo $data['address'];?></td>
                                                        <td><a class="btn btn-success" href="vendor-edit.php?eid=<?php echo $data['id']; ?>">View</a></td>
                                                        
                                                        
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