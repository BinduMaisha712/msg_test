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
                            <h3>EDIT DELIVERY TIME FOR CHECKOUT</h3>
                            <?php
                            $sql_f=mysqli_query($conn,"select * from del_time where id='".$_REQUEST['id']."'") or die(mysqli_error($conn));
                            $fetch=mysqli_fetch_assoc($sql_f); ?>
                            <section>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">START TIME: *</span>
                                                <input type="text" name="stime" id="stime" class="form-control" value="<?php if(isset($_POST['stime'])){ echo $_POST['stime'];} else{ echo $fetch['stime']; }?>" onkeyup="myFunction()" required>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">END TIME: *</span>
                                                <input type="text" name="etime" class="form-control" value="<?php if(isset($_POST['etime'])){ echo $_POST['etime'];} else{ echo $fetch['etime']; }?>" onkeyup="myFunction1()" required>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label><button class="btn btn-success btn-md" id="sub" name="submit">Submit</button></label>
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                            <script type="text/javascript">
                            function myFunction()
                            {
                                document.getElementById('stime').type = 'time';
                            }
                            function myFunction1()
                            {
                                document.getElementById('etime').type = 'time';
                            }
                            </script>
                        </form>
                        <!-- Form Wizard End -->
                        <?php
                       //print_r($_POST); 
                        if(isset($_POST['submit']))
                        {
                            $stime= date('h:i A', strtotime($_POST['stime']));
                            $etime= date('h:i A', strtotime($_POST['etime']));
                            
                           $query=mysqli_query($conn,"UPDATE `del_time` set `stime`='$stime',`etime`='$etime' where id='".$_REQUEST['id']."'");
                            if($query)
                            {
                                $lastid = mysqli_insert_id($conn);

                                echo '<div id="snackbar">This time slot is updated successfully..</div>';
                                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                echo"var delay = 1000;setTimeout(function(){ window.location = 'view-timigs.php'; }, delay);";
                                echo "</script>";
                            }
                            else
                            {
                                echo '<div id="snackbar">This time slot is not updated..</div>';
                                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
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
        