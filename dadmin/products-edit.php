    <?php include('includes/header.php'); 
    $pid=$_REQUEST['pid'];
    $id_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$pid");
    $id_data=mysqli_fetch_array($id_query);
    $cid=$id_data['cat_id'];
     $sid=$id_data['subcat_id'];


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
                                                    <option value="<?php echo $data['id']; ?>" <?php if($cid == $data['id']) { ?> selected="selected" <?php } ?> > <?php echo $data['cat_name']; ?></option>
                                                <?php } ?>
                                                </select>
                                        </div>
                                    </div>
                                           <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Select Sub-Category: *</span>

                                        <div class="col-md-9">
                                            <select name="subcategory" id="subcategory" class="form-control">
                                               <option value="">----select ---- </option>
<?php
    if(isset($_REQUEST['pid']))
    {
        $query=mysqli_query($conn,"SELECT * FROM `subcategory`");
        while($data=mysqli_fetch_array($query))
        { ?>
<option value="<?php echo $data['id']; ?>" <?php if($sid==$data['id']) { ?> selected="selected" <?php } ?> ><?php echo $data['sub_cat_name']; ?></option>
        <?php }
    }
?>   
                                                </select>
                                        </div>
                                    </div>
<?php
    $pquery=mysqli_query($conn,"select * from products where id=$pid"); //products select query
    $pdata=mysqli_fetch_array($pquery);

    $des_query=mysqli_query($conn,"select * from description where p_id=$pid"); //description select query
?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Product Name: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="product" class="form-control" required value="<?php echo $pdata['product_name']; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Product Brand: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="brand" class="form-control" required value="<?php echo $pdata['brand']; ?>">
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">price: </span>

                                        <div class="col-md-9">
                                            <input type="text" name="price" required class="form-control" value="<?php echo $pdata['price']; ?>" id="amount">
                                        </div>
                                    </div>
    <?php  
        while($des_data=mysqli_fetch_array($des_query))
        {
    ?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Description: </span>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="3" name="description[]" ><?php echo $des_data['description']; ?></textarea>
                                        </div>
                                    </div>
<?php } ?>


                                   <!-- <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Country:</span>
                                        <div class="col-md-9">
                                            <select name="country[]" id="country" class="form-control" required>
                                                <option value="">---Select Country---</option>
<?php 
    
    $query=mysqli_query($conn,"SELECT * FROM countries ORDER BY country_name ASC LIMIT 95,8");
    while($data=mysqli_fetch_array($query))
    {
        ?>
                                    <option <?php if ($data['id'] == 99 ) echo 'selected' ; ?> value="<?php echo $data['id']; ?>"><?php echo $data['country_name'];?></option>
        <?php 
    }

?>
                                            </select>
                                        </div>
                                    </div>

                                        <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">City:</span>
                                        <div class="col-md-9 field_wrappera">
                                            <select name="city[]" id="city" class="form-control" required>
                                                <option value="">---Select City---</option>
<?php 
    
    $query=mysqli_query($conn,"SELECT * FROM city_list");
    while($data=mysqli_fetch_array($query))
    {
        ?>
                                    <option value="<?php echo $data['id']; ?>"><?php echo $data['city_name'];?></option>
        <?php 
    }

?>
                                            </select>
                                        </div>
                                    </div>
                                   <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Available Place: </span>
                                        <div class="col-md-9">
                                          <div class="dropdown">
                                          <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown">Select zip-code
                                          <span class="caret"></span></button>
                                          <ul class="dropdown-menu form-control"  id="sell">
                                           
                                          </ul>
                                        </div>                            
                                     </div>
                                    </div>--->
                                    <div class="input_wrap">
                                        <div class="form-group row">
                                        
                                                <span class="label-text col-md-3 col-form-label">Specifications: </span><br><div class="col-md-9">
                                                <div class="field_wrapper form-group">
                                        <div class="input-group">
                                            <input type="text" name="spacifications[]" value="" class="form-control"  />
                                            <div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field">&emsp;<span class="btn btn-success">ADD</span></a></div>
                                        </div><br>
                                     </div>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = '<div><input type="text" name="spacifications[]" value="" class="form-control"/><a href="javascript:void(0);" class="remove_button">Remove</a></div><br>'; //New input field html 
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
                                    </div><br>
                               
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Image: </span>

                                        <div class="col-md-9">
<?php $mquery=mysqli_query($conn,"SELECT * FROM `image` WHERE p_id=$pid");
    while($mdata=mysqli_fetch_array($mquery)){ ?>  <img src="image/<?php echo $mdata['image']; ?>" width="75px" height="75px"> <?php } ?>
                                            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Image:</span>
                                        <div class="col-md-9"><input type="file"  name="image[]" required="" class="form-control" multiple=""></div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Available</span>
                                        <div class="col-md-9"><input type="checkbox"  name="ava" required="" value="COD">&emsp;COD&emsp;&emsp;&emsp;<input type="checkbox"  name="ava1" value="Online">&emsp;Online</div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Stock</span>
                                        <div class="col-md-9"><input type="Number" class="form-control" name="stock" required="" placeholder="available stock"></div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Delivery Charges </span>
                                        <div class="col-md-9"><input type="Number" class="form-control" name="charges" required="" placeholder="delivery charges"></div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Show Discount</span>
                                        <div class="col-md-9">
                                            <select class="form-control" name="discount" required>
                                                <option value=" ">------Select discount-------</option>
                                                <option value="10">10%</option>
                                                <option value="20">20%</option>
                                                <option value="30">30%</option>
                                                <option value="40">40%</option>
                                                <option value="50">50%</option>
                                                <option value="60">60%</option>
                                                <option value="70">70%</option>
                                                <option value="80">80%</option>
                                                <option value="90">90%</option>
                                            </select>
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
        $category=$_POST['category'];
        $subcategory=$_POST['subcategory'];
        $product=$_POST['product'];
        $brand=$_POST['brand'];
        $price=$_POST['price'];
        $ava=$_POST['ava'];
        $ava1=$_POST['ava1'];
        $stock=$_POST['stock'];
        $charges=$_POST['charges'];
        $discount=$_POST['discount'];
        $sel_query=mysqli_query($conn,"SELECT * FROM `products` WHERE product_name='$product' AND cat_id='$category' AND id!=$pid");
                      if(mysqli_num_rows($sel_query)>0)
                       {
                                       //echo "<script>";
                            echo '<div id="snackbar">This Product is already added..</div>';
                            echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                        }
                        else
                        {
           
                $up=mysqli_query($conn,"UPDATE `products` SET `brand`='$brand',`discount`='$discount' WHERE id=$_REQUEST[pid]");

                $image_name=($_FILES["image"]["name"]);  
                $image_type=($_FILES["image"]["tmp_name"]);  

                  $i=0;
                foreach ($image_name as $key => $value)
                {
                    $sn = $i++;
                    $mul_img=$_FILES["image"]["tmp_name"][$sn];
					 move_uploaded_file($mul_img,"image/".$value);
					$test = getimagesize('image/'.$value);
					$width = $test[0];
					$height = $test[1];

					if ($width > 500 || $height > 500 || $width < 500 || $height < 500)
					{
					//echo "<script type='text/javascript'>";
					//echo "alert('Wrong Image Size');";

					//echo "</script>";

					// echo '<p style="color:red">Image Dimension is wrong, Height has to be 409px and width has to be 899px.';
					unlink('image/image/'.$value);

					}
					else{

					$iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('$category','$subcategory','$pid','$value')");
                    
					}
					
                       
                   
                }


                     $spacifications=$_POST['spacifications'];  //spacifications inserts--------
                     if(!empty($specifications[0])){
                     foreach($spacifications as $key => $value)
                     {
                        $value=mysqli_real_escape_string($value);
                         $ins=("INSERT INTO `specifications`(`c_id`, `s_id`, `p_id`, `specifications`) VALUES ('$category','$subcategory','$pid','$value')");
                        $query=mysqli_query($conn,$ins);
                     }
                 }
                                    //--------------stock insert--------------
                    $ins=("INSERT INTO `stock`(`c_id`, `s_id`, `p_id`, `cod`,`online`,`stock_no`,`delivery_charges`) VALUES ('$category','$subcategory','$pid','$ava','$ava1','$stock','$charges')");
                     $stockquery=mysqli_query($conn,$ins);

        if($stockquery)
            {

                ?>
                <script type="text/javascript">
                    alert('product add');
                    window.location.href='products-detail.php?pid=<?php echo $pid; ?>';

                </script>
            <?php }
        else
        {

            echo "not ok";
        }
    }
}


?>
            <!-- Main Footer Start -->
 <script type="text/javascript">

                                         // ---------city ajax code---------------
$(document).ready(function(){

    $('#country').on("change",function () {
        var countryId = $(this).find('option:selected').val();
        $.ajax({
            url: "city_ajax.php",
            type: "POST",
            data: "countryId="+countryId,
            success: function (response) {
               //alert(response);
                //console.log(response);
                $("#city").html(response);
            },
        });
    }); 

});

                                            //----------------- zip code ajax code------------

$(document).ready(function(){

    $('#city').on("change",function () {
        var cityId = $(this).find('option:selected').val();
        
        $.ajax({
            url: "products-zip-code-ajax.php?pid=<?php echo $pid;?>",
            type: "POST",
            data: "cityId="+cityId,
            success: function (response) {
               //alert(response);
                //console.log(response);
               $("#sell").html(response);
            },
        });
    }); 

});

let amount = document.querySelector('#amount'), preAmount = amount.value;
        amount.addEventListener('input', function(){
            if(isNaN(Number(amount.value))){
                amount.value = preAmount;
                return;
            }

            let numberAfterDecimal = amount.value.split(".")[1];
            if(numberAfterDecimal && numberAfterDecimal.length > 3){
                amount.value = Number(amount.value).toFixed(3);;
            }
            preAmount = amount.value;
        })

</script> 

<script type="text/javascript">                         //---------zip code insert--------
    function addalldat(zipid,cityid,pid)
    {
        $.ajax({
            url: "products-zip-code-insert-ajax.php",
            type: "POST",
            data: {"cityid": cityid,"zipid": zipid,"pid": pid},
            success: function (response) {
               //alert(response);
                //console.log(response);
               //$("#").html(response);
            },
        });
    }
</script>


            <?php include('includes/footer.php'); ?>
