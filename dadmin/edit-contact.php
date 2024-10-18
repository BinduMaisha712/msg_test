<?php include('includes/header.php');  ?>
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
                <!-- Edit Product Start -->
                <div class="records--body">
                    <div class="title">
                        <h6 class="h6">Change Contact details of the Website</h6>
                    </div>
                    <!-- Tab Content Start -->
                    <div class="tab-content">
                        <!-- Tab Pane Start -->
                        <div class="tab-pane fade show active" id="tab01">
                            <div class="panel-content">
                            <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                <?php
                                $lquery=mysqli_query($conn,"SELECT * FROM `footer` WHERE id='1' "); //products select query
                                $ldata=mysqli_fetch_array($lquery); ?>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Address: </span>  
                                    <div class="col-md-9">
                                        <input type="text" name="address" class="form-control"  value="<?php if(isset($_POST['address'])){ echo $_POST['address'];}else{ echo $ldata['address'];} ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Email: </span>
                                    <div class="col-md-9">
                                        <input type="text" name="email" class="form-control"  value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}else{  echo $ldata['email']; }?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Mobile: </span>
                                    <div class="col-md-9">
                                        <input type="text" name="phone" class="form-control"  value="<?php if(isset($_POST['phone'])){ echo $_POST['phone'];}else{ echo $ldata['phone']; }?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Telephone: </span>
                                    <div class="col-md-9">
                                        <input type="text" name="telephone" class="form-control"  value="<?php if(isset($_POST['telephone'])){ echo $_POST['telephone'];}else{ echo $ldata['telephone']; }?>">
                                    </div>
                                </div>
                               <!-- <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Facebook: </span>
                                    <div class="col-md-9">
                                        <input type="text" name="facebook" class="form-control"  value="<?php //if(isset($_POST['facebook'])){ echo $_POST['facebook'];}else{ echo $ldata['facebook']; }?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Twitter: </span>
                                    <div class="col-md-9">
                                        <input type="text" name="twitter" class="form-control"  value="<?php// if(isset($_POST['twitter'])){ echo $_POST['twitter'];}else{ echo $ldata['twitter']; }?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Google Plus: </span>
                                    <div class="col-md-9">
                                        <input type="text" name="googleplus" class="form-control"  value="<?php //if(isset($_POST['googleplus'])){ echo $_POST['googleplus'];}else{ echo $ldata['googleplus'];} ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Instagram: </span>
                                    <div class="col-md-9">
                                        <input type="text" name="instagram" class="form-control"  value="<?php //if(isset($_POST['instagram'])){ echo $_POST['instagram'];}else{ echo $ldata['instagram']; }?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Linkedin: </span>
                                    <div class="col-md-9">
                                        <input type="text" name="linked" class="form-control"  value="<?php //if(isset($_POST['linked'])){ echo $_POST['linked'];}else{ echo $ldata['linkedin']; }?>">
                                    </div>
                                </div> -->
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
    $address=$_POST["address"]; 
    $email=$_POST["email"]; 
    $phone=$_POST["phone"]; 
    $telephone=$_POST['telephone'];
    // $facebook=$_POST["facebook"]; 
    // $twitter=$_POST["twitter"]; 
    // $googleplus=$_POST["googleplus"]; 
    // $instagram = $_POST["instagram"]; 
    // $linked=$_POST['linked'];  
    
    // echo "UPDATE `footer` SET `address`='$address',`email`='$email',`phone`='$phone',`telephone`='$telephone' WHERE id=1";exit;
    $i=0;
     $iquery=mysqli_query($conn,"UPDATE `footer` SET `address`='$address',`email`='$email',`phone`='$phone',`telephone`='$telephone' WHERE id=1");
                     
        if($iquery)
            {
                echo '<div id="snackbar">Content Updated To Website...</div>';
                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                echo"var delay = 1000;setTimeout(function(){ window.location = 'edit-contact.php'; }, delay);";
                echo "</script>";
                    
            }
        else
        {

            echo "not ok";
        }
    }


?>
           

            <?php include('includes/footer.php'); ?>
