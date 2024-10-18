<style type="text/css">
    .steps{
        display: none;
    }
</style>
<?php  include('includes/header.php'); ?>
    <!-- Main Container Start -->
    <main class="main--container">
        <!-- Main Content Start -->
        <section class="main--content">
            <div class="panel">
                <div class="panel-content">
                    <!-- Form Wizard Start -->
                    <form action="" method="post" id="formWizard" class="form--wizard">
                    <h3></h3>
                    <section>
                        <div class="row">
                            <div class="col-md-8">                                        
                            <div class="input_wrap">
                                <div class="form-group">
                                    <label>
                                        <span class="label-text">SUB-CATEGORY NAME: *</span><br>
                                        <?php
                                        $ide=$_REQUEST['seid'];
                                        $vid=$_REQUEST['vid'];
                                        $sel=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE id='$ide'");
                                        $res=mysqli_fetch_array($sel);?>
                                        <input type="text" name="sub_cat_name" value="<?php if(isset($_POST['sub_cat_name'])){ echo $_POST['sub_cat_name'];}else{ echo $res['sub_cat_name']; }?>" class="form-control" required=""/>
                                    </label>
                                        </div>
                                    </div><br>
                                            <div class="form-group">
                                            <label><button class="btn btn-success btn-md pull-right" name="submit">Update</button></label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                    </form>
                        <!-- Form Wizard End -->
                        <?php

                        if(isset($_POST['submit']))
                        {                            
                            $subname=$_POST['sub_cat_name'];          
                            $query=mysqli_query($conn,"UPDATE `subcategory` SET `sub_cat_name`='$subname' WHERE id=$ide");
                             if($query)
                             { 
                                 echo '<div id="snackbar">Subcategory Updated...</div>';
                                 echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                 echo"var delay = 2000;setTimeout(function(){ window.location = 'subcategory-view.php?vid=".$vid."'; }, delay);";
                                 echo "</script>";
                             }                            
                        }  ?>
                    </div>
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
           
            <!-- Main Footer End -->
        