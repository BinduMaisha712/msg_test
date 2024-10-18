    <?php include('includes/header.php'); 
    $code="";
         $query1=mysqli_query($conn,"SELECT id,code FROM google_analytic WHERE id=1 ");
     if(mysqli_num_rows($query1)>0)
     {
        $row=mysqli_fetch_assoc($query1);
        $code=$row['code'];
    }?>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">                
                <div class="panel">

                    <!-- Edit Product Start -->
                    <div class="records--body">
                        <div class="title">
                            <h6 class="h6">Google Analytic Code</h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                    <div class="panel-content">
                                <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                  

                                
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Google Analytic Code: </span>
                                        <div class="col-md-9">
                                            <div class="field_wrapper form-group">
                                        <div class="input-group">
                                            <textarea class="form-control" name="code"  required="required" style="height: 270px;"><?= $code;?></textarea>
                                        </div><br>

          
                                     </div>
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
     $code=$_POST['code'];
     $code=str_replace("'", '"', $code);
     $query2=mysqli_query($conn,"SELECT id FROM google_analytic WHERE id=1");
     if(mysqli_num_rows($query2)>0)
     {  echo "UPDATE  `google_analytic`  SET `code`='$code' WHERE id=1";
     
             $ins=mysqli_query($conn,"UPDATE  `google_analytic`  SET `code`='$code' WHERE id=1");
    
             if($ins){
                echo '<div id="snackbar">Google Analytic Code Update successfully..</div>';
                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                echo"var delay = 1000;setTimeout(function(){ window.location = 'google-analytic-code.php'; }, delay);";
                echo "</script>";
             }
     }
     
 }
          include('includes/footer.php'); ?>
