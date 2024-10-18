
    <?php include('includes/header.php'); 
    $did=$_REQUEST['did'];
       ?>

        <!-- Main Container Start -->
        <main class="main--container">

            <!-- Main Content Start -->
            <section class="main--content">
                
                <div class="panel">

                    <!-- Edit Product Start -->
                    <div class="records--body">
                        <div class="title">
                            <h6 class="h6">Delivery-Men Details</h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                  
<?php
    $sel_query=mysqli_query($conn,"select * from deliverymen where id=$did");
    $sel_data=mysqli_fetch_array($sel_query);

?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label"> Name: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="name" class="form-control" required value="<?php echo $sel_data['name']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                        <div class="col-md-9">
                                            <input type="number" name="mobile" class="form-control" value="<?php echo $sel_data['mobile']; ?>" id="amount">
                                        </div>
                                    </div>
                                      <?php
                                        $mobile_query=mysqli_query($conn,"SELECT * FROM `deliverymen_mobile` WHERE deliverymen_id=$did");
                                        if(mysqli_num_rows($mobile_query) > 0){
                                            while($mobile_data=mysqli_fetch_array($mobile_query)){
                                         ?>
                                            <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                        <div class="col-md-9">
                                            <input type="hidden" name="mobileid[]" value="<?php echo $mobile_data['id']; ?>">
                                            <input type="number" name="phone[]" class="form-control" value="<?php echo $mobile_data['mobile']; ?>" id="amount">
                                        </div>
                                    </div>
                                    <?php   } } ?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Email: </span>

                                        <div class="col-md-9">
                                            <input type="email" name="email" class="form-control" value="<?php echo $sel_data['email']; ?>" id="amount">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Password: </span>

                                        <div class="col-md-9">
                                            <input type="text" name="password" class="form-control" value="<?php echo $sel_data['password']; ?>" id="amount">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Address: </span>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="3" name="address"><?php echo $sel_data['address']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-9 offset-md-3">
                                            <button class="btn btn-success" name="submit">update</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Tab Pane End -->
                        </div>
                        <!-- Tab Content End -->
                    </div>
                    <!-- Edit Product End -->
                </div>
            </section>
            <!-- Main Content End -->
<?php
    
    if(isset($_POST['submit']))
    {
        
         $name=$_POST['name'];
         $mobile=$_POST['mobile'];
         $phone=$_POST['phone'];
         $mobileid=$_POST['mobileid'];
         $email=$_POST['email'];
         $password=$_POST['password'];
         $address=$_POST['address'];
       $query=mysqli_query($conn,"UPDATE `deliverymen` SET `name`='$name',`mobile`='$mobile',`email`='$email',`password`='$password',`address`='$address' WHERE id=$did");
       foreach(array_combine($phone, $mobileid) as $phone => $mobileid)
       {
            $moile_update=mysqli_query($conn,"UPDATE `deliverymen_mobile` SET `mobile`='$phone' WHERE id=$mobileid");
       }
        if($query)
            {

                ?>
                <script type="text/javascript">
                    alert('deliveryman updated..');
                    window.location.href='delivery-men-details.php?did=<?php echo $did; ?>';

                </script>
            <?php }
        else
        {

            echo "not ok";
        }
    }


?>
           
            <?php include('includes/footer.php'); ?>