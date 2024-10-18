    <?php include('includes/header.php'); 
    
    ?>
<style type="text/css">
    div.ex1 {
  width: 50%;
  height: 100px;
  overflow: auto;
}
</style>
        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                
                <div class="panel">

                    <!-- Edit Product Start -->
                    <div class="records--body">
                        <div class="title">
                            <h6 class="h6">Change Footer Content</h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <div class="panel-content">
                                <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                <?php
                              
                                $lquery=mysqli_query($conn,"SELECT * FROM `aboutus` WHERE id='1' "); //products select query
                                $ldata=mysqli_fetch_array($lquery);?>
                                   <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">About Us: *</span>
                                        <div class="col-md-9">
                                            <textarea name="aboutus"  class="form-control" required><?php if(isset($_POST['aboutus'])){ echo $_POST['aboutus'];}else{echo $ldata['aboutus']; }?></textarea>
                                        </div>
                                    </div>
                                  <!--   <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">About Us Image: </span>
                                        <div class="col-md-9">
                                            <input type="file" name="image" id="image" onchange="check()" class="form-control">
                                            <?php if($ldata['image']!=''){ ?><a href="../asset/image/<?=$ldata['image'];?>" target="_blank">Click to View</a><?php } ?>
                                            <span class="help-block" id="er">Image Dimensions 644*677 & ( png, jpg ,jpeg )</span>
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
                                                            var width = this.width; console.log(height); console.log(width);
                                                            if (height !=677 || width != 644) {
                                                                document.getElementById('er').innerHTML='<font color="red">Height must be 677px and Width must be 644px.</font>';
                                                                document.getElementById('sub').disabled=true;
                                                            }
                                                            else{
                                                                document.getElementById('er').innerHTML='Image Dimensions 644*677';
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
                                        </div>
                                    </div> -->
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Our Vision: *</span>

                                        <div class="col-md-9">
                                            
											<textarea name="vision" class="form-control" required><?php echo $ldata['vision']; ?></textarea>
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Our Mission: *</span>

                                        <div class="col-md-9">
                                            
											<textarea name="mission"  class="form-control" required><?php echo $ldata['mission']; ?></textarea>
                                        </div>
                                    </div>
									
                                <!-- <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Heading 1</span>
                                    <div class="col-md-9">
                                        <input type='text' name="head1" class="form-control" value="<?php //if(isset($_POST['head1'])){ echo $_POST['head1']; }else{ echo $ldata['head1'];}?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Division 1</span>
                                    <div class="col-md-9">
                                        <input type='text' name="div1" class="form-control" value="<?php// if(isset($_POST['div1'])){ echo $_POST['div1']; }else{ echo $ldata['div1'];}?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Heading 2</span>
                                    <div class="col-md-9">
                                        <input type='text' name="head2" class="form-control" value="<?php //if(isset($_POST['head2'])){ echo $_POST['head2']; }else{ echo $ldata['head2'];}?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Division 2</span>
                                    <div class="col-md-9">
                                        <input type='text' name="div2" class="form-control" value="<?php //if(isset($_POST['div2'])){ echo $_POST['div2']; }else{ echo $ldata['div2'];}?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Heading 3</span>
                                    <div class="col-md-9">
                                        <input type='text' name="head3" class="form-control" value="<?php //if(isset($_POST['head3'])){ echo $_POST['head3']; }else{ echo $ldata['head3'];}?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Division 3</span>
                                    <div class="col-md-9">
                                        <input type='text' name="div3" class="form-control" value="<?php// if(isset($_POST['div3'])){ echo $_POST['div3']; }else{ echo $ldata['div3'];}?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Heading 4</span>
                                    <div class="col-md-9">
                                        <input type='text' name="head4" class="form-control" value="<?php //if(isset($_POST['head4'])){ echo $_POST['head4']; }else{ echo $ldata['head4'];}?>"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Division 4</span>
                                    <div class="col-md-9">
                                        <input type='text' name="div4" class="form-control" value="<?php //if(isset($_POST['div4'])){ echo $_POST['div4']; }else{ echo $ldata['div4'];}?>"/>
                                    </div>
                                </div> -->
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
       
        $aboutus = $_POST["aboutus"]; 
//			$vision = $_POST["vision"]; 
//			$mission = $_POST["mission"]; 
	$i=0;
        // $file_name = $_FILES['image']['name'];
        // if(!empty($file_name))
        // {
        //     $file_size =$_FILES['image']['size'];
        //     $file_tmp =$_FILES['image']['tmp_name'];
        //     $file_type=$_FILES['image']['type'];
            
        //     if(move_uploaded_file($file_tmp,"../asset/image/about/".$file_name))
        //     {
        //         $iquery=mysqli_query($conn,"UPDATE `aboutus` SET  `aboutus`='$aboutus',image='$file_name',head1='".$_POST['head1']."',head2='".$_POST['head2']."',head3='".$_POST['head3']."',head4='".$_POST['head4']."',div1='".$_POST['div1']."',div2='".$_POST['div2']."',div3='".$_POST['div3']."',div4='".$_POST['div4']."' WHERE id=1");
        //         if($iquery)
        //         {
        //             echo '<div id="snackbar">Content Updated successfully..</div>';
        //             echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        //             echo"var delay = 1000;setTimeout(function(){ window.location = 'edit-aboutus.php'; }, delay);";
        //             echo "</script>";
        //         }
        // }
        // }
        // else
        // {
              $aboutus = mysqli_real_escape_string($conn,$aboutus);
              $vision=  mysqli_real_escape_string($conn,$_POST['vision']);
            
              $mission =  mysqli_real_escape_string($conn,$_POST['mission']);
             $iquery=mysqli_query($conn,"UPDATE `aboutus` SET  `aboutus`='$aboutus',vision='$vision',mission='".$mission."' WHERE id=1");
            if($iquery)
            {
                echo '<div id="snackbar">Content Updated successfully..</div>';
                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                echo"var delay = 1000;setTimeout(function(){ window.location = 'edit-aboutus.php'; }, delay);";
                echo "</script>";
            }
         }
 

    include('includes/footer.php'); ?>
