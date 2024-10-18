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
                                                        <th>Date</th>
                                                        <th>Action</th>
                                                      
                                                    </tr>
                                                </thead>
                                                <tbody>
                    <?php
                            $query=mysqli_query($conn,"SELECT * FROM `promo_code` WHERE trash = 'Yes' ORDER BY `date` DESC");
                        
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
                                                                        $&nbsp;<?php echo $data['price']; ?>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                        <?php echo $data['price']; ?>%
                                                                    <?php
                                                                } ?>
                                                        </td>

                                                       <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td>
                                                        <td><a href="promo-code-trash.php?pid=<?php echo $data['id'].'&Active=Active&trash=No'; ?>" onClick="return confirm('Are you sure you want to Restore this Promo code')" class="btn btn-success">Move to live</a></td>
                                                       
                                                        
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