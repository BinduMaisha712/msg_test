<?php
    

                    include('includes/header.php'); ?>
                    <?php
                        
                        $vid=$_REQUEST['vid'];
                        $query=mysqli_query($conn,"SELECT * FROM `vendor` WHERE id=$vid");
                        $data=mysqli_fetch_array($query);
                        
                    ?>

                     <main class="main--container">
                         <section class="main--content">
                                    <div class="panel">
                                            <!-- Tab Content Start -->
                                            <div class="tab-content">
                                                <!-- Tab Pane Start -->
                                                <div class="tab-pane fade show active" id="tab01">
                                                   <h4 class="subtitle">VENDOR DETAILS</h4>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table table-bordered table-cells-middle">
                                                       
                                                    <tbody>
                                                        <tr>
                                                            <th>Name</th>
                                                            <td>
                                                               <?php echo $data['name']; ?> 
                                                            </td>
                                                            <th>Mobile</th>
                                                            <td>
                                                               <?php echo $data['mobile']; ?>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            
                                                            <th>Email</th>
                                                            <td>
                                                               <?php echo $data['email']; ?>
                                                            </td>
                                                            <th>Country</th>
                                                            <td>
                                                                <?php echo $data['country']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            
                                                                <th>City</th>  
                                                                <td>
                                                                    <?php echo $data['city']; ?>
                                                                </td>
                                                                <th>Pin Code</th>
                                                                <td> 
                                                                    <?php echo $data['pincode'] ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                
                                                            </tr>
                                                           
                                                            <tr>
                                                                <th>Address</th>
                                                                <td><?php echo $data['address']; ?></td>
                                                                <th>Password</th>
                                                                <td><?php echo $data['password']; ?></td>
                                                            </tr>
                                                               
                                                            </tr>
                                                            
                                                    </tbody>
                                                </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </section>

                    <?php include('includes/footer.php'); 

?>