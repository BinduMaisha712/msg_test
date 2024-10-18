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
                        <form action="" method="post" id="formWizard" class="form--wizard" enctype="multipart/form-data">
                            <h3>ADD DELIVERY TIME FOR CHECKOUT</h3>
                            <section>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">START TIME: *</span>
                                                <input type="time" name="stime" class="form-control" value="<?php if(isset($_POST['stime'])){ echo $_POST['stime'];}?>" required>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">END TIME: *</span>
                                                <input type="time" name="etime" class="form-control" value="<?php if(isset($_POST['etime'])){ echo $_POST['etime'];}?>" required>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label><button class="btn btn-success btn-md" id="sub" name="submit">Submit</button></label>
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </form>
                        <!-- Form Wizard End -->
                        <?php
                       //print_r($_POST); 
                        if(isset($_POST['submit']))
                        {
                            $stime= date('h:i A', strtotime($_POST['stime']));
                            $etime= date('h:i A', strtotime($_POST['etime']));
                            $sel_query=mysqli_query($conn,"SELECT * FROM `del_time` WHERE stime='$stime' and etime='".$etime."'");
                            if(mysqli_num_rows($sel_query)>0)
                            {
                                //echo "<script>";
                                echo '<div id="snackbar">This time slot is already added..</div>';
                                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                            }
                            else
                            {
                               $query=mysqli_query($conn,"INSERT INTO `del_time`(`stime`,`etime`) VALUES ('$stime','$etime')");
                                if($query)
                                {
                                    $lastid = mysqli_insert_id($conn);

                                    echo '<div id="snackbar">This time slot is added successfully..</div>';
                                    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                    echo"var delay = 1000;setTimeout(function(){ window.location = 'view-timigs.php'; }, delay);";
                                    echo "</script>";
                                }
                                else
                                {
                                    echo '<div id="snackbar">This time slot is not added..</div>';
                                    echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                                }
                                
                            }
                                
                        }

                        ?>
                    </div>
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
           
            <!-- Main Footer End -->
        