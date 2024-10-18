    <?php include('includes/header.php'); ?>
    <style type="text/css">
        .steps{
            display: none;
        }
    </style>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <div class="panel-content">
                        <!-- Form Wizard Start -->
                        <form action="" method="post" id="formWizard" class="form--wizard"enctype="multipart/form-data">
                            <h3>Add Brands Logo in Best Seller</h3>
                            <section>
							<div class="form-group row">
                                        <span class="label-text col-md-2 col-form-label">Brand Name: *</span>

                                        <div class="col-md-10">
                                            <input type="text" name="brandname" class="form-control" required value="">
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <span class="label-text col-md-2 col-form-label">Logo: *</span>

                                        <div class="col-md-10">
                                           <input type="file" name="brandlogo"   required>
                                        </div>
                                    </div>
                                <div class="row">

                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text"></span><br><br>
                                                
                                            </label><br><br>
                                            <label><button class="btn btn-success btn-md" name="submit">Submit</button></label>
										<?php

										if(isset($_POST['submit']))
										{
											$brandname = $_POST["brandname"];
											
										$brandlogo_name =($_FILES["brandlogo"]["name"]);
										$brandlogo_type=($_FILES["brandlogo"]["tmp_name"]);


										move_uploaded_file($brandlogo_type, "image/brandlogo/".$brandlogo_name);


										$query=mysqli_query($conn,"INSERT INTO `brandslogo`(`id`, `logo`, `brandname`, `status`) VALUES ('','$brandlogo_name','$brandname','Active')");

										
										
										if($query)
										{


										echo "<script type='text/javascript'>";
										echo "alert('Logo Updated Successfully in Best Seller Added Successfully');";
										echo "window.location.href = 'view-brands-logo.php';";
										echo "</script>";
										}


										}

										?>

										</div>
                                    </div>
                                </div>
                            </section>
                        </form>
                        <!-- Form Wizard End -->
                        
                    </div>
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
           
            <!-- Main Footer End -->
        