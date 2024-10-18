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
                    <h6 class="h6">User Order Configuration</h6>
                </div>
                <div class="tab-content">
                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade show active" id="tab01">
                        <div class="panel-content">
                            <form action="" method="post" enctype="multipart/form-data" name="form">                                
                            <?php
                                $lquery=mysqli_query($conn,"SELECT * FROM `order_config` WHERE id='1'"); //products select query
                                $ldata=mysqli_fetch_array($lquery);?>
                                 
                        <div class="form-group row">
                        <span class="label-text col-md-3 col-form-label">Configuration Type: </span>
                        <div class="col-md-9">
                            <select name="configType" class="form-control">
                                <option value="Automatic"
                                <?php
                                if($ldata['config_type']=='Automatic'){
                                echo 'selected';
                                }
                                ?>
                                >Automatic</option>
                                <option value="Manual"
                                <?php
                                if($ldata['config_type']=='Manual'){
                                echo 'selected';
                                }
                                ?>
                                >Manual</option>
                            </select>
                            
                        </div>
                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-9 offset-md-3">
                                            <button class="btn btn-success" name="submit" id="sub">Submit</button>
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
                $message="Error Occur Please try again!";
               if(isset($_POST['configType'])&&$_POST['configType']!=""){
                $configType=$_POST['configType'];
                
                $iquery=mysqli_query($conn,"UPDATE `order_config` SET `config_type`='$configType' WHERE id=1");
                
                if($iquery)
                {
                    $message="Order Configuration Updated...";
                }
                else
                {
                    $message="Error Occur Please try again!";
                }

               }else{
                $message="Please Select Configuration Type";
               }

                    echo '<div id="snackbar">'.$message.'</div>';
                    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                    echo"var delay = 1000;setTimeout(function(){ }, delay);";
                    echo "</script>";
            } 
            ?>
            <!-- Main Footer Start -->


            <?php include('includes/footer.php'); ?>
