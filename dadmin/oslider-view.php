 <?php include('includes/header.php');
$id=$_REQUEST['id']; ?>
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
                        <form action="" method="post" id="formWizard" class="form--wizard"enctype="multipart/form-data">
                            <h3>View Offer Slider</h3>
                            <section>
                                <?php
                                $sel=mysqli_query($conn,"select * from offer_slider where id='$id'");
                                $var=mysqli_fetch_assoc($sel); ?>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Select Category / Sub category: *</span>
                                                <select name="subcategory" required="" class="form-control">
                                                    <option value="">----select category/ sub category------</option>
                                                    <?php
                                                    $sql=mysqli_query($conn,"select * from category where status='Active'");
                                                    while($row=mysqli_fetch_assoc($sql))
                                                    {
                                                        $sel_query=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE cat_id='".$row['id']."' and status='Active'");
                                                        if(mysqli_num_rows($sel_query)>0)
                                                        {
                                                            while($data=mysqli_fetch_array($sel_query))
                                                            { ?>
                                                                <option value="<?php echo"subcat_".$data['id']; ?>"<?php if(isset($_POST['subcategory'])){ if($_POST['subcategory']=='subcat_'.$data['id']){ echo"selected";}}else{ if($var['cat_id']=='subcat_'.$data['id']){ echo"selected";}}?>><?php echo $data['sub_cat_name']; ?></option>
                                                                    
                                                            <?php 
                                                            }
                                                        }
                                                        else{ ?>
                                                            <option value="cat_<?=$row['id'];?>"<?php if(isset($_POST['subcategory'])){ if($_POST['subcategory']=='cat_'.$row['id']){ echo"selected";}}else{ if($var['cat_id']=='cat_'.$row['id']){ echo"selected";}}?>><?=$row['cat_name'];?></option>
                                                        <?php
                                                        }
                                                    }?>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Off Type *</span>
                                                <select name="oftype" required="" class="form-control">
                                                    <option value="">----Select Type------</option>
                                                    <option value="flat" <?php if(isset($_POST['oftype'])){ if($_POST['oftype']=='flat'){ echo"selected";}}else{ if($var['off_type']=='flat'){ echo"selected";}}?>>Flat</option>
                                                    <option value="per" <?php if(isset($_POST['oftype'])){ if($_POST['oftype']=='per'){ echo"selected";}}else{ if($var['off_type']=='per'){ echo"selected";}}?>>Percentage</option>
                                                </select>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Off Value: *</span>
                                                <input type="text" name="offvalue" class="form-control" required placeholder="Enter value for off" value="<?php if(isset($_POST['offvalue'])){ echo $_POST['offvalue'];}else{ echo $var['off_value'];}?>"/>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Text On Image: *</span>
                                                <input type="text" name="imgtext" class="form-control" required placeholder="Enter text visible on the image" value="<?php if(isset($_POST['imgtext'])){ echo $_POST['imgtext']; }else{ echo $var['text_image'];}?>"/>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Slider Image: </span>
                                                <input type="file" onchange="return check()" id="image" name="slider[]" class="form-control">
                                                <a href="../asset/image/offer/<?=$var['image'];?>" target="_blank">Click To View</a>
                                            </label>
                                            <span class="help-block" id="er">Image Dimension 510*310px</span>
                                            <br><br/>
                                            <script>
                                            function check() {
                                            var fileUpload = $("#image")[0];
                                            var regex = new RegExp("(.jpg|.png|.jpeg)$");
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
                                                            if ((height < 300) || (width < 500)) {
                                                                document.getElementById('er').innerHTML='<font color="red">Height must be 310px and Width must be 510px.</font>';
                                                                document.getElementById('sub').disabled=true;
                                                            }
                                                            else{
                                                                document.getElementById('er').innerHTML='Image Dimension Height: '+height+'px, Width: '+width+'px';
                                                                document.getElementById('sub').disabled=false;
                                                            }
                                                        };
                                                    };
                                                } 
                                            }
                                            else {
                                                document.getElementById('er').innerHTML='<font color="red">Please select a valid Image file.</font>';
                                                document.getElementById('sub').disabled=true;
                                            }
                                        }
                                            </script>
                                            <label>
                                                <input type="checkbox" name="click" class="form-control" <?php if(isset($_POST['click'])){ echo"checked ";}else{ if($var['click']=='yes'){ echo"checked";}}?> style="height: 15px;margin: 0px; width: 3%;">
                                                <span class="label-text">Make Slider Clickable</span>
                                            </label><br>
                                            <label><button class="btn btn-success btn-md" id="sub" name="submit">Submit</button></label>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </form>
                        <!-- Form Wizard End -->
                        <?php
                        if(isset($_POST['submit']))
                        {
                            // print_r($_POST);                            print_r($_FILES); 
                            date_default_timezone_set("Asia/kolkata");
                            $date=date("Y-m-d");
                            $time=date("H:i:s");
                            $subcategory=$_POST['subcategory'];
                            if(isset($_POST['click']))
                            { $click='yes'; }
                            else{ $click='no'; }
                            // echo"[[".$slider_name=($_FILES["slider"]["name"]);
                            if((!empty($_FILES["slider"]["name"][0])))
                            { 
                                $slider_name=($_FILES["slider"]["name"]);
                                $slider_type=($_FILES["slider"]["tmp_name"]);
                               

                                $i=0;
                                foreach ($slider_name as $key => $value)
                                { 
                                    $sn = $i++;
                                    $mul_img=$_FILES["slider"]["tmp_name"][$sn];
                                     $temp = explode(".", $value);
                              $imgName = 'img'.round(microtime(true)). $key . '.' . end($temp);


                                    move_uploaded_file($mul_img, "../asset/image/offer/".$imgName);

                                    $test = getimagesize('../asset/image/offer/'.$imgName);
                                    $width = $test[0];
                                    $height = $test[1];
                                    if ($width !=510 || $height != 310)
                                    {
                                      echo '<div id="snackbar">Please Check Image Dimensions....</div>';
                                      echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                                        unlink('../asset/image/offer/'.$imgName);
                                    }
                                    else{
                                        $query=mysqli_query($conn,"update `offer_slider` set`image`='$imgName',`cat_id`='$subcategory',`off_type`='".$_POST['oftype']."',`off_value`='".$_POST['offvalue']."',`text_image`='".$_POST['imgtext']."',`click`='$click' where id='$id'")or die(mysqli_error($conn));

                                        if($query)
                                        { 
                                            echo '<div id="snackbar">Slider Updated Successfully..</div>';
                                            echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                            echo"var delay = 1000;setTimeout(function(){ window.location = 'oslider.php'; }, delay);";
                                            echo "</script>";
                                        }
                                    }
                                }
                            }
                            else{
                                $query=mysqli_query($conn,"update `offer_slider` set `cat_id`='$subcategory',`off_type`='".$_POST['oftype']."',`off_value`='".$_POST['offvalue']."',`text_image`='".$_POST['imgtext']."',`click`='$click' where id='$id'")or die(mysqli_error($conn));

                                if($query)
                                {
                                    echo '<div id="snackbar">Slider Updated Successfully..</div>';
                                    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                    echo"var delay = 1000;setTimeout(function(){ window.location = 'oslider.php'; }, delay);";
                                    echo "</script>";
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