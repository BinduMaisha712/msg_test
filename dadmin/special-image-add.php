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
                            <h3>Add Special Specification Image</h3>
                            <section>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Special Specification Image: *</span><br><br>
                                                <input type="file" name="slider[]" class="form-control" multiple required>
                                            </label><br><br>
                                            <label><button class="btn btn-success btn-md" name="submit">Submit</button></label>
                                        <?php

                        if(isset($_POST['submit']))
                        {     $id  = $_GET['id'];
                              $slider_name=($_FILES["slider"]["name"]);
                                $slider_type=($_FILES["slider"]["tmp_name"]);
                                
                                $i=0;
                            foreach ($slider_name as $key => $value)
                            {
                                $sn = $i++;
                                $mul_img=$_FILES["slider"]["tmp_name"][$sn];
                                
                                   move_uploaded_file($mul_img, "image/special/".$value);
                                  
                                    $test = getimagesize('image/special/'.$value);
                                    $width = $test[0];
                                    $height = $test[1];

                                    if ($width > 1200 || $width < 1200  )
                                    {
                                    echo '<p style="color:red">Image Dimension is wrong, Width has to be 1200px.';
                                    unlink('image/special/'.$value);

                                    }
                                    else{
                                        $query=mysqli_query($conn,"INSERT INTO `special_image`(`productid`, `image`) VALUES ('$id','$value')");
										

                                      if($query)
                                {

                                  echo "<script type='text/javascript'>";
                                    echo "alert('New Image Added in Special Specification Successfully');";
                                    echo "window.location.href = 'special-products-view.php?id=$id';";
                                    echo "</script>";
                                }
                                
                                    }
                                
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