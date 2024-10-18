    <?php include('includes/header.php'); 
    
    if(isset($_GET['id'])){

        $lquery=mysqli_query($conn,"SELECT * FROM `headerimage` WHERE id='".$_GET['id']."'"); //products select query
        $ldata=mysqli_fetch_array($lquery);

        $imageName=$ldata['header'];
        $heading=$ldata['heading'];
        $content=$ldata['content'];
        $catTypeId=$ldata['cat_type_id'];
        $clickStatus=$ldata['click'];
        $buttonName=$ldata['button_name'];
    }else{
        $imageName="";
        $heading="";
        $content="";
        $catTypeId="";
        $clickStatus="";
        $buttonName="";
    }
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
                            <h6 class="h6">Change Header Image of the Website</h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <div class="panel-content">
                                <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                  

                                    <?php
if(isset($_GET['id'])){
    ?>
                               <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Current Header Image on Website: </span>

                                        <div class="col-md-9">
                                          
                                            <img src="../asset/image/header/<?php echo $imageName; ?>" width="500px" height="100px" class="img_reponsive"> 
                                            
                                        </div>
                                    </div>
    <?php
}
                                    ?>
                                    

<!-- Select Category / Sub category -->
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
                                                            { 

                                                                 ?>
                                                                <option value="<?php echo"subcat_".$data['id']; ?>"
                                                                
                                                                <?=($catTypeId=="subcat_".$data['id'])?"selected":"";?>
                                                                
                                                                ><?php echo $data['sub_cat_name']; ?></option>
                                                            <?php 
                                                           
                                                           }
                                                        }
                                                        else{?>
                                                            <option value="<?php echo"cat_".$row['id']; ?>"
                                                                
                                                                <?=($catTypeId=="cat_".$row['id'])?"selected":"";?>
                                                                
                                                                ><?php echo $row['cat_name']; ?></option>
                                                        <?php
                                                        }
                                                    }?>
                                                </select>
                                            </label><br>
                                        </div>
                                    </div>

                                    </div>



                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Image:</span>
                                        <div class="col-md-9"><input type="file" onchange="return check()" id="image" name="image"  <?=(isset($_GET['id']))?"":"required";?> ></div>
                                    </div>
                                    <span class="help-block" id="er">Image Dimension Minimum Height: 400px, Minimum Width: 800px & ( png, jpg ,jpeg )</span>
                                    <br><br/>
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
                                                            if ((height < 400) || (width < 800)) {
                                                                document.getElementById('er').innerHTML='<font color="red">Image Height must be greater then 400px and Width must be greater then 800px</font>';
                                                                document.getElementById('sub').disabled=true;
                                                            }else{
                                                                document.getElementById('er').innerHTML='Image Dimension Width: '+width+', height: '+height;
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
                                                <input type="checkbox" name="click" class="form-control" <?=($clickStatus=='Yes')?"checked":"";?> style="height: 15px;margin: 0px; width: 3%;">
                                                <span class="label-text">Make Slider Clickable</span>
                                            </label><br>

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
        $catTypeId = $_POST['subcategory'];
        // $heading = $_POST['heading'];
        // $content = $_POST['content'];
        // $buttonName = $_POST['buttonName'];

        if(isset($_POST['click']))
        { $clickStatus='Yes'; }
        else{ $clickStatus='No'; }
        
        $image_name=($_FILES["image"]["name"]);  
        $imagetmpname=($_FILES["image"]["tmp_name"]);
        $i=0;
    
        if(isset($_GET['id'])){

if($image_name == ""){
    $image_name = $imageName;
}

            $query="";
        $iquery=mysqli_query($conn,"UPDATE `headerimage` 
        SET 
        `header`='$image_name',
        `heading`='$heading',
        `content`='$content',
        `cat_type_id`='$catTypeId',
        `click`='$clickStatus',
        `button_name`='$buttonName'
         WHERE  id=".$_GET['id']);
        }else{
            $iquery=mysqli_query($conn,"INSERT INTO `headerimage`(`header`,`cat_type_id`,`click`) 
            VALUES ('$image_name','$catTypeId','$clickStatus')");
           
           
        }

        move_uploaded_file($imagetmpname,"../asset/image/header/".$image_name);
    
        if($iquery)
        {
            echo '<div id="snackbar">Banner Updated Successfully..</div>';
            echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
            echo"var delay = 1000;setTimeout(function(){ window.location = 'view-header-image.php'; }, delay);";
            echo "</script>";
        }
        else
        {

            echo '<div id="snackbar">Error Occur! Please try again..</div>';
            echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
            echo"var delay = 1000;setTimeout(function(){ window.location = 'header-image.php'; }, delay);";
            echo "</script>";
        }
    }
    include('includes/footer.php'); ?>
