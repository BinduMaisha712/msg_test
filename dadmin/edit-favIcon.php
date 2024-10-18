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
                    <h6 class="h6">Change Fav Icon of the Website</h6>
                </div>
                <div class="tab-content">
                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade show active" id="tab01">
                        <div class="panel-content">
                            <form action="" method="post" enctype="multipart/form-data" name="form">                                
                            <?php
                                $lquery=mysqli_query($conn,"SELECT * FROM `fav_icon` WHERE id='1' "); //products select query
                                $ldata=mysqli_fetch_assoc($lquery);?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Current Fav Icon on Website: </span>
                                        <div class="col-md-9">
                                            <img src="../asset/image/favIcon/<?php echo $ldata['icon']; ?>" width="80px" height="90px" class="img_reponsive"> 
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Image:</span>
                                        <div class="col-md-9"><input type="file"  name="image" id="image" onchange="check()"  required></div>
                                        <span class="help-block" id="er">Image Dimensions maximum width 71px, maximum height 74px</span><br><br>
                                    </div>
                                    <script>
                                        function check() {
                                            var fileUpload = $("#image")[0];
                                            var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg)$");
                                            if (regex.test(fileUpload.value.toLowerCase())) 
                                            {
                                                if (typeof (fileUpload.files) !== "undefined") 
                                                {
                                                    //Initiate the FileReader object.
                                                    var reader = new FileReader();
                                                    //Read the contents of Image File.
                                                    reader.readAsDataURL(fileUpload.files[0]);
                                                    reader.onload = function (e) 
                                                    {
                                                        //Initiate the JavaScript Image object.
                                                        var image = new Image();
                                                        //Set the Base64 string return from FileReader as source.
                                                        image.src = e.target.result;
                                                        image.onload = function () 
                                                        {
                                                            //Determine the Height and Width.
                                                            var height = this.height;
                                                            var width = this.width;
                                                            if (height > 74 || width > 71) {
                                                                document.getElementById('er').innerHTML='<font color="red">Height must not exceed 74px and Width must not exceed 71px.</font>';
                                                                document.getElementById('sub').disabled=true;
                                                            }
                                                            else{
                                                                document.getElementById('er').innerHTML='Image Dimensions maximum width 71px, maximum height 74px';
                                                                document.getElementById('sub').disabled=false;
                                                            }
                                                        };
                                                    }
                                                } 
                                            }
                                            else {
                                                document.getElementById('er').innerHTML='<font color="red">Please select a valid Image file.</font>';
                                                document.getElementById('sub').disabled=true;
                                            }
                                        }
                                        </script>
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
                $image_name=($_FILES["image"]["name"]);  
                $imagetmpname=($_FILES["image"]["tmp_name"]);
                $i=0;
                $iquery=mysqli_query($conn,"UPDATE `fav_icon` SET `icon`='$image_name' WHERE id=1");
                move_uploaded_file($imagetmpname,"../asset/image/favIcon/".$image_name);
                // move_uploaded_file($imagetmpname,"image/logo/".$image_name);
                if($iquery)
                {
                    echo '<div id="snackbar">Fav Icon Updated To Website...</div>';
                    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                   echo"var delay = 1000;setTimeout(function(){ window.location = 'edit-favIcon.php'; }, delay);";
                    echo "</script>";
                }
                else
                {

                    echo "not ok";
                }
            } ?>
            <!-- Main Footer Start -->


            <?php include('includes/footer.php'); ?>
