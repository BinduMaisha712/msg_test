<?php

	 include('includes/header.php'); 
    $eid=$_REQUEST['eid']; ?>
<style type="text/css">
    .header{
    border-top-left-radius: calc(0.25rem - 1px);                    
    border-top-right-radius: calc(0.25rem - 1px);
    border-bottom-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border: 1px solid #725d93;
}
                 </style>

                    <!-- Main Container Start -->
                    <main class="main--container">

                        <!-- Main Content Start -->
                        <section class="main--content">
                            
                            <div class="panel">

                                <!-- Edit Product Start -->
                                <div class="records--body"><br>
                                    <div class="header">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#first" style="color: #ffa500;">VENDOR DETAILS</button>
                                    </div>

                                    <!-- Tab Content Start -->
                                    <div class="tab-content collapse show" id="first">
                                        <!-- Tab Pane Start -->
                                        <div class="tab-pane fade show active" id="tab01">
                                             <?php
                        
                                                //$vid=$_REQUEST['vid'];
                                                $query=mysqli_query($conn,"SELECT * FROM `vendor` WHERE id=$eid");
                                                $data=mysqli_fetch_array($query);
                                                
                                            ?>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table table-bordered table-cells-middle">
                                                       
                                                    <tbody>
                                                        <tr>
                                                            <th>Company Name</th>
                                                            <td>
                                                               <?php echo $data['name']; ?> 
                                                            </td>
                                                            <th>Contact Person Name</th>
                                                            <td>
                                                               <?php echo $data['cp_name']; ?> 
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Mobile</th>
                                                            <td colspan="3">
                                                               <?php echo $data['mobile']; ?>
                                                               <?php 
                                                               $mobile_query=mysqli_query($conn,"SELECT * FROM `vendor_mobile` WHERE vendor_id=$eid");
                                                               while($mobile_data=mysqli_fetch_array($mobile_query))
                                                               {
                                                                    echo " , ".$mobile_data['mobile'];
                                                               }

                                                                ?>
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
                                        <!-- Tab Pane End -->
                                    </div>
                                    <!-- Tab Content End -->
                                </div>


                                    <!-- Edit Product Start -->
                                <div class="records--body">
                                    <div class="header">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#demo" style="color: #ffa500;">VENDOR DETAILS UPDATE</button>
                                    </div>
                                        

                                    <!-- Tab Content Start -->
                                    <div class="tab-content collapse" id="demo">
                                        <!-- Tab Pane Start -->
                                        <div class="tab-pane fade show active" id="tab01">
                                            <form action="" method="post" enctype="multipart/form-data">                                
                                              
                                    <?php
                                        $sel_query=mysqli_query($conn,"select * from vendor where id=$eid");
                                        $sel_data=mysqli_fetch_array($sel_query);

                                    ?>
                                                 <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Company Name: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="name" class="form-control" required placeholder="Enter Name.." value="<?php echo $sel_data['name'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Contact Person Name: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="cpname" class="form-control" required placeholder="Enter Name.." value="<?php echo $sel_data['cp_name'] ?>">
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="mobile" class="form-control" placeholder="Enter Mobile No.." value="<?php echo $sel_data['mobile'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $mobile_query=mysqli_query($conn,"SELECT * FROM `vendor_mobile` WHERE vendor_id=$eid");
                                                        if(mysqli_num_rows($mobile_query) > 0)
                                                        {
                                                            while($mobile_data=mysqli_fetch_array($mobile_query))
                                                            { ?>
                                                                 <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                                        <div class="col-md-9">
                                                            <input type="hidden" name="phoneid[]" value="<?php echo $mobile_data['id']; ?>">
                                                            <input type="number" name="phone[]" class="form-control" placeholder="Enter Mobile No.." value="<?php echo $mobile_data['mobile']; ?>" required>
                                                        </div>
                                                    </div>
                                                          <?php  }
                                                        }
                                                     ?>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Email: </span>

                                                        <div class="col-md-9">
                                                            <input type="email" name="email" required class="form-control" id="amount" value="<?php echo $sel_data['email'] ?>" placeholder="Enter Email Id..">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Country: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="country" class="form-control" required placeholder="Enter Country Name.." value="<?php echo $sel_data['country'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> City: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="city" class="form-control" required placeholder="Enter City Name.." value="<?php echo $sel_data['city'] ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Pin Code: *</span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="pincode" class="form-control" required placeholder="Enter pincode.." value="<?php echo $sel_data['pincode'] ?>" >
                                                        </div>
                                                    </div>
                                                        <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Password : *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="password" class="form-control" required placeholder="Enter password.." value="<?php echo $sel_data['password'] ?>" >
                                                        </div>
                                                    </div>
                                                 
                                                    <div class="input_wrap">
                                                        <div class="form-group row">
                                                            <span class="label-text col-md-3 col-form-label">Address: </span>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="address" required><?php echo $sel_data['address']; ?></textarea>
                                                            </div>
                                                         </div>
                                                    </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-9 offset-md-3">
                                                        <button class="btn btn-success" name="update">update</button>

                                                    </div>
                                                </div>
                                            </form>
                                           
                                        </div>
                                        <!-- Tab Pane End -->
                                    </div>
                                    <!-- Tab Content End -->
                                </div>
                                  <?php
                
                if(isset($_POST['update']))
                {
                    
                        $name=$_POST['name'];
                        $cpname=$_POST['cpname'];
                        $mobile=$_POST['mobile'];
                        $phone=$_POST['phone'];
                        $phoneid=$_POST['phoneid'];
                        $email=$_POST['email'];
                        $country=$_POST['country'];
                        $city=$_POST['city'];
                        $pincode=$_POST['pincode'];
                        $address=$_POST['address'];
                        $password=$_POST['password'];

                        $query=mysqli_query($conn,"UPDATE `vendor` SET `name`='$name',`cp_name`='cpname',`mobile`='$mobile',`email`='$email',`country`='$country',`city`='$city',`pincode`=$pincode,`address`='$address',`password`='$password' WHERE id=$eid");
                        foreach(array_combine($phone,$phoneid) as $phone => $phoneid)
                        {
                            $mobile_update=mysqli_query($conn,"UPDATE `vendor_mobile` SET `mobile`='$phone' WHERE id=$phoneid");

                        }
                   
                       if($query)
                        {
                            echo '<div id="snackbar">Vendor Successfully Updated...</div>';
                            echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                            echo"var delay = 1000;setTimeout(function(){ window.location = 'vendor-edit.php?eid=".$eid."'; }, delay);";
                            echo "</script>";
                    }
                    else
                    {

                        echo "not ok";
                    }
                }


                ?>
                                <!-- Edit Product End -->

                                 <!-- Edit Product Start -->
                                <div class="records--body">
                                    <div class="header">
                                        <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#third" style="color: #ffa500;">VENDOR PRODUCTS</button>
                                    </div>
                                        
                                    <div class="records--list collapse" data-title="Product View" id="third">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Product</th>
                                    <th>Status</th>
                                    <th>Approval</th>
                                    <th>View</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $vendor_id=$_GET['eid'];
    $query=mysqli_query($conn,"SELECT * FROM `vendor_products` WHERE vendor_id=$vendor_id ORDER BY id DESC");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['product_name'];?></td>
                                 <td>
 <?php

  if( $data['status']=='Active' ){
?>
  <a class="btn btn-success" href="javascript:;">Active</a>  
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="javascript:;">Inactive</a>  
  <?php
     }


     ?>                                       
                                    </td>
                                    <td>
                                       <?php

  if( $data['admin_approval']=='Approved' ){
?>
  <a class="btn btn-success" href="javascript:;">approved</a>  
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="javascript:;">Unapproved</a>  
  <?php
     }


     ?>
                                    </td>
                                    <td>
                                        <a class="btn btn-success" href="vendor-products-detail.php?pid=<?php echo $data['id']; ?>" target="_blank">View</a>
                                    </td>
                                    <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td> 
                                </tr>

<?php  $sr++; } ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                                   
                                </div>

                                <!-- Edit Product End -->

                            </div>
                        </section>
                        <!-- Main Content End -->
               
                       
                        <?php include('includes/footer.php'); 
?>