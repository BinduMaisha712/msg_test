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
                    <h6 class="h6">EDIT HOME COFIGURATION</h6>
                </div>
                <div class="tab-content">
                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade show active" id="tab01">
                        <div class="panel-content">
                            <form action="" method="post" enctype="multipart/form-data" name="form">                                
                            <?php
$id=$_REQUEST['id'];

                                $lquery=mysqli_query($conn,"SELECT * FROM `home` WHERE id='$id' "); //products select query
                                $ldata=mysqli_fetch_assoc($lquery);?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">EDIT HOME COFIGURATION: </span>
                                        <div class="col-md-9">
                                        <div class="input-group">
                                            <input class="form-control" name="name" type="text" required="required" value='<?= $ldata['name'];?>'>
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
                $name=addslashes($_POST['name']);
                $iquery=mysqli_query($conn,"UPDATE `home` SET `name`='$name' WHERE id=$id");
                if($iquery)
                {
                    echo '<div id="snackbar">Home congiguration Updated To Website...</div>';
                    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                    echo"var delay = 1000;setTimeout(function(){ window.location = 'home.php'; }, delay);";
                    echo "</script>";
                }
                else
                {

                    echo "not ok";
                }
            } ?>
            <!-- Main Footer Start -->


            <?php include('includes/footer.php'); ?>
