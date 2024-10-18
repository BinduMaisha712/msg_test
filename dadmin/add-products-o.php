<?php include('includes/header.php'); ?>
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">                
        <div class="panel">
            <!-- Edit Product Start -->
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Product Add</h6>
                </div>
                <!-- Tab Content Start -->
                <div class="tab-content">
                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade show active" id="tab01">
                        <div class="panel-content">
                            <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Select Category: *</span>
                                        <div class="col-md-9">
                                            <select name="category" id="category" class="form-control" required>
                                                <option value="">-----select category-----</option> 
                                                    <?php
                                                      $sel_query=mysqli_query($conn,"SELECT * FROM `category`");

                                                      while($data=mysqli_fetch_assoc($sel_query))
                                                      {
                                                      ?> 
                                                  <option value="<?php echo $data['id']; ?>" > <?php echo $data['cat_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="subcategory"></div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Product Name: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="product" class="form-control" required placeholder="Enter Products Name">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Stock: </span>
                                        <div class="col-md-9">
                                            <select name="stock" class="form-control">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            
                                        </div>
                                    </div>


                            <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Color: </span>
                                     
                                     
                            <div class="col-md-9">

                                <div class="colorFieldWrapper">
                                    <div class="row">

                                        <div class="col-md-9">
                                        <input class="form-control" name="color" id="color" list="colors">
                                        <datalist id="colors"> 

                                        <?php
                                                      $sel_query=mysqli_query($conn,"SELECT color_name FROM `color_info`");

                                                      while($data=mysqli_fetch_assoc($sel_query))
                                                      {
                                                      ?> 
                                                 <option><?=$data['color_name']?></option>
                                                <?php } ?>
                                        </datalist>
                                        </div>

                                        <div class="col-md-3">
                                            <a href="javascript:void(0);" class="addColor" title="Add Color">&emsp;<span class="btn btn-success">ADD</span></a>
                                        </div>
               
                                    </div>

                                </div>
                            </div>
                         </div>









                                  
                                   <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Show Product in Top Featured: </span>
                                        <div class="col-md-9">
                                            <input type="checkbox" name="top" class="" id="" value="Yes">  Yes
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Show Product in New Arrivals: </span>
                                        <div class="col-md-9">
                                            <input type="checkbox" name="new" class="" id="" value="Yes">  Yes
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Show Product in Festive Collection: </span>
                                        <div class="col-md-9">
                                            <input type="checkbox" name="hot" class="" id="" value="Yes">  Yes
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">COD Applicable: </span>
                                        <div class="col-md-9">
                                            <input type="checkbox" name="cod" class="" id="" value="Yes">  Yes
                                        </div>
                                    </div>
<!--                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Product Number :</span>
                                        <div class="col-md-9">
                                            <input type="text" name="p_number" class="form-control" id="" placeholder="Enter Product's Unique Numbers">
                                        </div>
                                    </div>                                    -->
                                    <div class="input_wrap">
                                        <div class="form-group row">
                                            <span class="label-text col-md-3 col-form-label">Description: </span>
                                                <div class="col-md-9">
                                                    <div class="field_wrapper form-group">
                                        <div class="input-group">
                                            <textarea class="form-control" name="description[]" required=""></textarea>
                                            <div class="input-group-append">
                                            <a href="javascript:void(0);" class="add_button" title="Add field">&emsp;<span class="btn btn-success">ADD</span></a>
                                            </div>
                                        </div>
                                        <br>
                                        <script type="text/javascript">
                                        $(document).ready(function(){
                                            var maxField = 10; //Input fields increment limitation
                                            var addButton = $('.add_button'); //Add button selector
                                            var wrapper = $('.field_wrapper'); //Input field wrapper
                                            var fieldHTML = '<div><textarea class="form-control" name="description[]"></textarea><a href="javascript:void(0);" class="remove_button">Remove</a></div><br>'; //New input field html 
                                            var x = 1; //Initial field counter is 1

                                            //Once add button is clicked
                                            $(addButton).click(function(){
                                                //Check maximum number of input fields
                                                if(x < maxField){ 
                                                    x++; //Increment field counter
                                                    $(wrapper).append(fieldHTML); //Add field html
                                                }
                                            });

                                            //Once remove button is clicked
                                            $(wrapper).on('click', '.remove_button', function(e){
                                                e.preventDefault();
                                                $(this).parent('div').remove(); //Remove field html
                                                x--; //Decrement field counter
                                            });
                                        });
                                        </script>
                                    </div>
                                </div>
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
<script type="text/javascript">
                                        $(document).ready(function(){
                                            var maxField = 10; //Input fields increment limitation
                                            var addButton = $('.addColor'); //Add button selector
                                            var wrapper = $('.colorFieldWrapper'); //Input field wrapper
                                            var fieldHTML = ''; //New input field html 
                                            var x = 1; //Initial field counter is 1




           
                                            
                                            fieldHTML += '<div class="row pt-2">';
                                            fieldHTML += '<div class="col-md-12">';

                                            fieldHTML += '<div class="card card-outline-danger p-2">';
                                            fieldHTML += '<span class="text-right clickable close-icon removeColorDiv"><i class="fa fa-times"></i></span>';
                                            fieldHTML += '<div class="card-block">';


                                            fieldHTML += '<div class="col-md-12">';
                                            fieldHTML += '<input class="form-control" name="color" id="color" list="colors" placeholder="Please enter color name">';
                                            fieldHTML += '<datalist id="colors">'; 

                                        <?php
                                                      $sel_query=mysqli_query($conn,"SELECT color_name FROM `color_info`");

                                                      while($data=mysqli_fetch_assoc($sel_query))
                                                      {
                                                      ?> 
                                            fieldHTML += '<option><?=$data['color_name']?></option>';
                                                <?php } ?>
                                                fieldHTML += '</datalist>';
                                                fieldHTML += '</div>';

                                                ////////// Image Upload Section //////////
                                                fieldHTML += '<div class="col-12 pt-2">';

                                                fieldHTML += '<div class="form-group">';
                                                fieldHTML += '<label><strong>Upload Images</strong></label>';
                                                fieldHTML += '<div class="custom-file">';
                                                fieldHTML += '<input type="file" name="files'+x+'[]" multiple class="custom-file-input form-control" id="customFile'+x+'">';
                                                fieldHTML += '<label class="custom-file-label" for="customFile'+x+'">Choose Images</label>';
                                                fieldHTML += '</div>';
                                                fieldHTML += '</div>';

                                                fieldHTML += '</div>';
                                                ////////// Image Upload Section //////////
                                                
                                                
                                                ////////// Size Section //////////
                                                fieldHTML += '<div class="col-12 pt-2">';

                                                <?php
                                                      $sel_query=mysqli_query($conn,"SELECT id,name,symbol FROM `size_class` where status='Active'");

                                                      while($data=mysqli_fetch_assoc($sel_query))
                                                      {
                                                      ?> 

                                                fieldHTML += '<div class="form-check-inline">';
                                                fieldHTML += '<label class="form-check-label">';
                                                fieldHTML += '<input type="checkbox" class="form-check-input" name="productSizes" value="<?=$data['id'];?>"><?=$data['symbol'];?>';
                                                fieldHTML += '</label>';
                                                fieldHTML += '</div>';

                                                <?php } ?>
                                                fieldHTML += '</div>';
                                                ////////// Size Section //////////
                                            

                                                fieldHTML += '</div>';
                                                fieldHTML += '</div>';
                                                fieldHTML += '</div>';
                                                fieldHTML += '</div>';
                                            
                                            
                                            
                                            
                                            
                                            

                                            //Once add button is clicked
                                            $(addButton).click(function(){
                                                //Check maximum number of input fields
                                                if(x < maxField){ 
                                                    $(wrapper).append(fieldHTML); //Add field html
                                                    changeFileInput(x);
                                                    x++; //Increment field counter

                                                }
                                            });

                                            //Once remove button is clicked
                                            $(wrapper).on('click', '.removeColorDiv', function(e){
                                                e.preventDefault();
                                                // $("a#DeleteItem").parent().parent().remove();
                                                $(this).parent('div').parent('div').parent('div').remove(); //Remove field html
                                                x--; //Decrement field counter
                                            });
                                        });



                                        function changeFileInput(x) {
  $('input[type="file"]').on("change", function() {
    let filenames = [];
    // let fileN = document.getElementById("customFile"+x).name;
    let files = document.getElementById("customFile"+x).files;
    console.log(files);
    if (files.length > 1) {
      filenames.push("Total Files (" + files.length + ")");
    } else {
      for (let i in files) {
        if (files.hasOwnProperty(i)) {
          filenames.push(files[i].name);
        }
      }
    }
    $(this)
      .next(".custom-file-label")
      .html(filenames.join(","));
  });
};
                                        </script>

<script type="text/javascript">
$(document).ready(function(){
    $('#category').on("change",function () {
        if($(this).val() != '') {
            var categoryId = $(this).find('option:selected').val();
            $.ajax({
                url: "ajax.php",
                type: "POST",
                data: "categoryId="+categoryId,
                success: function (response) {
                    $("#subcategory").html(response);
                }
            });
        } else {
            $("#subcategory").html('');
        }
    }); 

});
</script>
<?php include('includes/footer.php');
if(isset($_POST['submit']))
{
    //print_r($_POST);//print_r($_FILES);
    date_default_timezone_set("Asia/kolkata");
    $date=date("Y-m-d");
    $time=date("H:i:s");
    $new='No'; $hot='No'; $top='No'; $cod='No';
    
    $category=$_POST['category'];
    $subcategory='';
    if(isset($_POST['subcategory']))
    {
        $subcategory=$_POST['subcategory'];
    }
    $product=$_POST['product'];
    $sel_query=mysqli_query($conn,"SELECT * FROM `products` WHERE product_name='$_POST[product]'");
    if(mysqli_num_rows($sel_query)>0)
    {
        echo '<div id="snackbar">This product is already added...</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo"var delay = 1000;setTimeout(function(){ window.location = 'add-products.php'; }, delay);";
        echo "</script>";
            
    }
    else
    {
        $sel_query=mysqli_query($conn,"SELECT * FROM `products` order by id desc");
        if(mysqli_num_rows($sel_query)>0)
        {
            $vaar= mysqli_fetch_assoc($sel_query);
            $p_uniqu=$vaar['product_code']+1;
        }
        else{
            $p_uniqu=rand(1000,999);
        }
        //echo count($_POST['size']);
        for($w=0;$w<count($_POST['size']); $w++)
        {

            $sizeDetail = explode("@",$_POST['size'][$w]);
            $sizeId=$sizeDetail[0];

            if(isset($_POST['new']))
            { $new=$_POST['new']; }
            if(isset($_POST['hot']))
            { $hot=$_POST['hot']; }
            if(isset($_POST['top']))
            { $top=$_POST['top']; }
            if(isset($_POST['cod']))
            { $cod=$_POST['cod']; }
            if(empty($_POST['disc_price'][$w])) {
                $disc_price = '0';
            } else {
                $disc_price = $_POST['disc_price'][$w];
            }
            //insert query


            $query=mysqli_query($conn,"INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`size`, `price`,`discount`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`product_code`,`date`,`time`) VALUES "
                    . "('$category','$subcategory','$product','".$sizeId."','".$_POST['price'][$w]."','".$disc_price."','$hot','$new','$top','$cod','".$_POST['stock']."','".$p_uniqu."','$date','$time')")or die(mysqli_error());
        
                    $colors=$_POST['productColor'][$sizeId];
            
                    // $last_id = $conn->lastInsertId(); ////// Get last Inserted Id of Product Table 

                    $sel_query=mysqli_query($conn,"SELECT MAX(id) as id FROM `products`");
                    if(mysqli_num_rows($sel_query)>0)
                    {
                        $vaar= mysqli_fetch_assoc($sel_query);
                        $lastProductID=$vaar['id'];

    foreach($colors as $color){
        $query=mysqli_query($conn,"INSERT INTO `color_tb`(`pid`, `color`) VALUES "
        . "('$lastProductID','$color')")or die(mysqli_error());
    }
}

          
        
                }
        //images
        $image_name=($_FILES["image"]["name"]);  
        $image_type=($_FILES["image"]["tmp_name"]);  
        $i=0;
        foreach ($image_name as $key => $value)
        {
            $sn = $i++;
            $mul_img=$_FILES["image"]["tmp_name"][$sn];
            move_uploaded_file($mul_img,"../asset/image/product/".$value);
            $test = getimagesize('../asset/image/product/'.$value);
            $width = $test[0];
            $height = $test[1];
            $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('$category','$subcategory','$p_uniqu','$value')")or die(mysqli_error());
        }

        //description
        $description=$_POST['description'];
        if(!empty($description[0])){
            foreach($description as $key => $value)
             {
                 $value=mysqli_real_escape_string($conn,$value);
                 $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('$category','$subcategory','$p_uniqu','$value')")or die(mysqli_error());
             }
         }
        echo '<div id="snackbar">Product Added Sucessfully...</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo"var delay = 1000;setTimeout(function(){ window.location = 'view-all-products.php'; }, delay);";
        echo "</script>";
    }

} ?>