
    <?php include('includes/header.php'); 
    $pid=$_REQUEST['pid'];
    $id_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$pid");
    $id_data=mysqli_fetch_array($id_query);
    $cid=$id_data['cat_id'];
     $sid=$id_data['subcat_id'];



    ?>

        <!-- Main Container Start -->
        <main class="main--container">

            <!-- Main Content Start -->
            <section class="main--content">
                
                <div class="panel">

                    <!-- Edit Product Start -->
                    <div class="records--body">
                        <div class="title">
                            <h6 class="h6">Product Details</h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
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
                                            <select name="subcategory" id="subcategory" class="form-control" required="">
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
                                        <span class="label-text col-md-3 col-form-label">price: </span>

                                        <div class="col-md-9">
                                            <input type="text" name="price" class="form-control" value="<?php echo $pdata['price']; ?>" id="amount">
                                        </div>
                                    </div>
    <?php  
        while($des_data=mysqli_fetch_array($des_query))
        {
    ?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Description: </span>
                                        <div class="col-md-9">
                                            <input type="hidden" name="descriptionid[]" value="<?php echo $des_data['id']; ?>" >
                                            <textarea class="form-control" rows="3" name="description[]"><?php echo $des_data['description']; ?></textarea>
                                        </div>
                                    </div>
<?php } ?>
                                    <div class="input_wrap">        <!---- description add---->
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label"></span>
                                        <div class="col-md-9">
                                            <div class="field_wrapper form-group">
                                        <div class="input-group">
                                            
                                            <div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field">&emsp;<span>ADD</span></a></div>
                                        </div>

                                        <script type="text/javascript">
                                        $(document).ready(function(){
                                            var maxField = 10; //Input fields increment limitation
                                            var addButton = $('.add_button'); //Add button selector
                                            var wrapper = $('.field_wrapper'); //Input field wrapper
                                            var fieldHTML = '<div><textarea class="form-control" name="add_description[]"></textarea><a href="javascript:void(0);" class="remove_button">Remove</a></div><br>'; //New input field html 
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
                                      <!-- <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Country:</span>
                                        <div class="col-md-9">
                                            <select name="contry" id="country" class="form-control" required>
                                                <option value="">---Select Country---</option>
<?php 
    
    $query=mysqli_query($conn,"SELECT * FROM countries ORDER BY country_name ASC LIMIT 96,7");
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
                                        <div class="col-md-9">
                                            <select name="city" id="city" class="form-control" required>
                                                <option value="">------Select City----</option>

<?php
    $city_query=mysqli_query($conn,"SELECT * FROM `available_place` WHERE p_id=$pid");
    $city_data=mysqli_fetch_array($city_query);
    $city_id=$city_data['city'];
    $city_query1=mysqli_query($conn,"SELECT * FROM city_list");
    while($city_data1=mysqli_fetch_array($city_query1))
{ ?>
                                        <option value="<?php echo $city_data1['id']; ?>" <?php if($city_id == $city_data1['id']) { ?> selected="selected" <?php } ?> ><?php echo $city_data1['city_name'] ?></option>
                                    <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                        <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Available Place: </span>
                                        <div class="col-md-9">
                                          <div class="dropdown">
                                          <button class="btn btn-default dropdown-toggle form-control" type="button" data-toggle="dropdown">Select zip-code
                                          <span class="caret"></span></button>
                                          <ul class="dropdown-menu form-control"  >
<?php 
    $code_query=mysqli_query($conn,"SELECT * FROM `available_place_code` WHERE p_id=$pid");
    while($code_data=mysqli_fetch_array($code_query))
    { 
     $z_id=$code_data['z_id'];
     $z_query=mysqli_query($conn,"SELECT * FROM zip_list WHERE id=$z_id");
    $z_data=mysqli_fetch_array($z_query);
     ?>                                     <li id="sell" style="background-color: white;"><input type="checkbox" name=""  value="<?php echo $z_data['id'] ?>" <?php if($z_id == $z_data['id']) { ?> checked="checked"  <?php } ?> ><?php echo $z_data['area_name']; ?>&emsp;<?php echo "($z_data[zip_code])"; ?></li>
     <?php } ?>
                                          </ul>
                                        </div>                            
                                     </div>
                                    </div>--->
<!-------------------------specifications selects query------------------->
<?php
    $query=mysqli_query($conn,"SELECT * FROM `specifications` WHERE p_id=$pid");
    while($data=mysqli_fetch_array($query))
    { ?>
                                    <div class="form-group row">
                                                <span class="label-text col-md-3 col-form-label">Specifications: </span><br><div class="col-md-9">
                                                    <input type="hidden" name="spacificationsid[]" value="<?php echo $data['id']; ?>">
                                                <input type="text" name="spacifications[]"  value="<?php echo $data['specifications']; ?>" class="form-control" required></div>
                                        </div>
    <?php } ?>          
                                    <div class="input_wrap">
                                        <div class="form-group row">
                                                <span class="label-text col-md-3 col-form-label"> Specifications:</span><div class="col-md-9">
                                                <div class="field_wrapperb form-group">
                                        <div class="input-group">
                                            <div class="input-group-append"><a href="javascript:void(0);" class="add_buttonb" title="Add field"><span>ADD</span></a></div>
                                        </div>
                                     </div>
                                        <script type="text/javascript">
                                        $(document).ready(function(){
                                            var maxField = 10; //Input fields increment limitation
                                            var addButton = $('.add_buttonb'); //Add button selector
                                            var wrapper = $('.field_wrapperb'); //Input field wrapper
                                            var fieldHTML = '<div><input type="text" name="add_spacifications[]" value="" class="form-control" required/><a href="javascript:void(0);" class="remove_button">Remove</a></div><br>'; //New input field html 
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
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Image: </span>

                                        <div class="col-md-9">
<?php $mquery=mysqli_query($conn,"SELECT * FROM `image` WHERE p_id=$pid AND status='Active'");
    while($mdata=mysqli_fetch_array($mquery)){ ?>  <img src="image/<?php echo $mdata['image']; ?>" width="75px" height="75px"> <?php } ?>
                                            <input type="file" name="image[]" class="form-control"  multiple>
                                        </div>
                                    </div><br>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Available</span>
<?php 
    $stoks_query=mysqli_query($conn,"SELECT * FROM `stock` WHERE p_id=$pid");
    $stoks_data=mysqli_fetch_array($stoks_query);
?>
                                        <div class="col-md-9"><input type="checkbox"  name="ava" <?php if($stoks_data['cod']=="COD") {echo "checked";}?>  value="COD">&emsp;COD&emsp;&emsp;&emsp;<input type="checkbox"  name="ava1" <?php if($stoks_data['online']=="Online") {echo "checked";}?> value="Online">&emsp;Online</div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Stock</span>
                                        <div class="col-md-9"><input type="Number" class="form-control" name="stock" required="" placeholder="available stock" value="<?php echo $stoks_data['stock_no']; ?>"></div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Delivery Charges</span>
                                        <div class="col-md-9"><input type="Number" class="form-control" name="charges" required="" placeholder="Delivery charges" value="<?php echo $stoks_data['delivery_charges']; ?>"></div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Show Discount</span>
                                        <div class="col-md-9">
                                            <select class="form-control" name="discount" required>
                                                <option value=" ">------Select discount-------</option>
            
                                                <option value="10" <?php if ($pdata['discount'] == 10 ) echo 'selected' ; ?> >10%</option>
                                                <option value="20" <?php if ($pdata['discount'] == 20 ) echo 'selected' ; ?> >20%</option>
                                                <option value="30" <?php if ($pdata['discount'] == 30 ) echo 'selected' ; ?> >30%</option>
                                                <option value="40" <?php if ($pdata['discount'] == 40 ) echo 'selected' ; ?> >40%</option>
                                                <option value="50" <?php if ($pdata['discount'] == 50 ) echo 'selected' ; ?> >50%</option>
                                                <option value="60" <?php if ($pdata['discount'] == 60 ) echo 'selected' ; ?> >60%</option>
                                                <option value="70" <?php if ($pdata['discount'] == 70 ) echo 'selected' ; ?> >70%</option>
                                                <option value="80" <?php if ($pdata['discount'] == 80 ) echo 'selected' ; ?> > 80%</option>
                                                <option value="90" <?php if ($pdata['discount'] == 90 ) echo 'selected' ; ?> >90%</option>
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
        $price=$_POST['price'];
       $ava=$_POST['ava'];
       $ava1=$_POST['ava1'];
         $stock=$_POST['stock'];
         $charges=$_POST['charges'];
           //$state=$_POST['state'];
         $city=$_POST['city'];
         $discount=$_POST['discount'];
    //echo "$image_name,$image_type";

        $query=mysqli_query($conn,"UPDATE `products` SET `cat_id`='$category',`subcat_id`='$subcategory',`product_name`='$product',`price`='$price',`discount`='$discount' WHERE id=$pid");

                                                            //------spacifications Update--------

                     $des_sel_query=mysqli_query($conn,"SELECT * FROM `specifications` WHERE `p_id` = $pid");
                $sdata=mysqli_fetch_array($des_sel_query);
                    $sdata=$sdata['id'];
                    $sdata=$sdata-1;
                $spacifications=$_POST['spacifications'];
                $spacificationsid=$_POST['spacificationsid'];
                if(!empty($spacifications[0])){
                     foreach(array_combine($spacificationsid, $spacifications) as $spacificationsid => $spacifications)
                     {
                        $value=mysqli_real_escape_string($value);
                        $sdata++;
                         $ins=("UPDATE `specifications` SET `c_id`='$category', `s_id`='$subcategory', `p_id`='$pid', `specifications`='$spacifications' WHERE p_id=$pid AND id=$spacificationsid");
                         $up1=mysqli_query($conn,$ins);
                        
                     }
                 }
                                                            //---------spacification insert---->

                     $add_spacifications=$_POST['add_spacifications'];
                     if(!empty($add_spacifications[0])){
                     foreach($add_spacifications as $key => $value)
                     {
                        $value=mysqli_real_escape_string($value);
                         $ins=("INSERT INTO `specifications`(`c_id`,`s_id`,`p_id`,`specifications`) VALUES ('$category','$subcategory','$pid','$value')");
                        $query=mysqli_query($conn,$ins);
                     }
                 }

                     
                                    /*--------------Update --------------*/
                    $ins=("UPDATE `stock` SET `c_id`='$category', `s_id`='$subcategory', `p_id`='$pid', `cod`='$ava',`online`='$ava1',`stock_no`='$stock',`delivery_charges`='$charges' WHERE p_id=$pid");
                     $stockquery=mysqli_query($conn,$ins);

        // --------------- image update-----------
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

            $description=$_POST['description'];
            $descriptionid=$_POST['descriptionid'];
            $des_sel_query=mysqli_query($conn,"SELECT * FROM `description` WHERE `p_id` = $pid");
            $sdata=mysqli_fetch_array($des_sel_query);
                $sdata=$sdata['id'];
                $sdata=$sdata-1;
                if(!empty($description[0])){
                    foreach(array_combine($descriptionid, $description) as $descriptionid => $description)
                    {
                        $sdata++ ;
                        $value=mysqli_real_escape_string($value);
                        $up=("UPDATE `description` SET `description` = '$description' WHERE p_id=$pid AND id = $descriptionid");
                        $des_query=mysqli_query($conn,$up);
                    } 
                }
                                            //-------Description insert------------>

                      $add_description=$_POST['add_description'];
                      if(!empty($add_description[0])){
                    foreach($add_description as $key => $value)
                    {
                        $value=mysqli_real_escape_string($value);
                        $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('$category','$subcategory','$pid','$value')");
                    }
                }
        if($query)
            {

                ?>
                <script type="text/javascript">
                    alert('product updated..');
                    window.location.href='products-detail.php?pid=<?php echo $pid; ?>';
                </script>
            <?php }
        else
        {

            echo "not ok";
        }
    }


?>
            <!-- Main Footer Start -->
 <script type="text/javascript">
                                        // ajax code==================================   

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