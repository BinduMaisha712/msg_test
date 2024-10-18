<?php include('includes/header.php'); ?>
<style type="text/css">
    div.ex1 {
  width: 50%;
  height: 100px;
  overflow: auto;
}
</style>
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Change Currency of the Website</h6>
                </div>
                <div class="tab-content">
                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade show active" id="tab01">
                        <div class="panel-content">
                            <form action="" method="post" enctype="multipart/form-data" name="form">                                
                            <?php
                                $lquery=mysqli_query($conn,"SELECT * FROM `currency` WHERE id='1' "); //products select query
                                $ldata=mysqli_fetch_assoc($lquery);?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Change Currency of the Website: </span>
                                        <div class="col-md-9">
                                        <div class="input-group">
                                            <input class="form-control" name="currency" type="text" required="required" value='<?= $ldata['currency'];?>'>
                                        </div><br>

          
                                        </div>
                                    </div>
                               
                                    <div class="row mt-3">
                                        <div class="col-md-9 offset-md-3">
                                            <button class="btn btn-success" name="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
                $currency=$_POST['currency'];
                $iquery=mysqli_query($conn,"UPDATE `currency` SET `currency`='$currency' WHERE id=1");
                if($iquery)
                {
                    echo '<div id="snackbar">Currency Updated To Website...</div>';
                    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                    echo"var delay = 1000;setTimeout(function(){ window.location = 'edit-currency.php'; }, delay);";
                    echo "</script>";
                }
                else
                {

                    echo "not ok";
                }
            } ?>
            <!-- Main Footer Start -->


            <?php include('includes/footer.php'); ?>
