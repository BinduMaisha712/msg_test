<?php include('includes/header.php');
$sql1=mysqli_query($conn,"select * from products where product_code='".$_REQUEST['id']."' order by id desc");
$roww=mysqli_fetch_assoc($sql1);
$pid=$_REQUEST['id'];
$sql1a=mysqli_query($conn,"select * from products where product_code='".$_REQUEST['id']."' order by id desc");
while ($roww1=mysqli_fetch_assoc($sql1a))
{
    $p_size[]=$roww1['size'];
} ?>
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <!-- Edit Product Start -->
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Product Edit</h6>
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
                                            <option value="<?php echo $data['id']; ?>"
                                                <?php if($data['id']==$roww['cat_id']){echo"selected"; }?>>
                                                <?php echo $data['cat_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="subcategory">
                                    <?php 
                                       $querysub=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE cat_id = '".$roww['cat_id']."' order by id asc"); 
                                        if(mysqli_num_rows($querysub)>0)
                                        { ?>
                                    <span class="label-text col-md-3 col-form-label">Select Sub-Category: *</span>
                                    <div class="col-md-9">
                                        <select name="subcategory" class="form-control" required>
                                            <?php
                                                while($data=mysqli_fetch_array($querysub))
                                                { ?>
                                            <option value='<?=$data['id'];?>'
                                                <?php if($data['id']==$roww['subcat_id']){ echo"Selected"; }?>>
                                                <?=$data['sub_cat_name'];?></option>
                                            <?php
                                                } ?>
                                        </select>
                                    </div>
                                    <?php
                                        }?>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Product Name: *</span>
                                    <div class="col-md-9">
                                        <input type="text" name="product" class="form-control" required
                                            placeholder="Enter Products Name" value="<?=$roww['product_name'];?>">
                                    </div>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Image: </span>
                                    <div class="col-md-9">
                                        <?php
                                        $sq_im=mysqli_query($conn,"select * from image where p_id='$pid'");
                                        while($ro_im=mysqli_fetch_assoc($sq_im))
                                        { ?>
                                        <span style="border: 1px solid;border-left: none;">
                                            <img src='../asset/image/product/<?=$ro_im['image'];?>' width="100px"
                                                style="border:1px solid">
                                            <span class="fa fa-trash" onclick="remove_img('<?=$ro_im['id'];?>')"
                                                style="cursor:pointer"></span></span>
                                        <?php
                                        } ?>
                                    </div>
                                    <span class="label-text col-md-3 col-form-label">Add Image: </span>
                                    <div class="col-md-9">
                                        <input type="file" name="image[]" id="image" onchange="return check()" multiple
                                            class="form-control">
                                        <span class="help-block" id="er">Image Dimension 500*550px</span>
                                    </div>

                                    <br><br />
                                    <script>
                                    function check() {
                                        var x = document.getElementById("image");
                                        if ('files' in x) {
                                            for (var i = 0; i < x.files.length; i++) {
                                                var file = x.files[i];
                                                if ('name' in file) {
                                                    var ext = file.name.split('.').pop().toLowerCase();
                                                    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) === -1) {
                                                        document.getElementById("image").value = "";
                                                        document.getElementById("er").innerHTML =
                                                            '<font color="red"><b>You are trying to upload files which not allowed ' +
                                                            "(" + file.name +
                                                            " is invalid). <br/>Please select png images.</b></font>";
                                                        document.getElementById('sub').disabled = true;
                                                    } else {
                                                        $('#er').empty();
                                                        createReader(file, function(w, h) {
                                                            console.log(file.name + ' ' + w + ' ' + h);
                                                            if (w != 510 && h != 600) {
                                                                $('#er').empty();
                                                                document.getElementById("image").value = "";
                                                                document.getElementById("er").innerHTML =
                                                                    '<font color="red"><b>' + file.name +
                                                                    ' is not match with dimensions. <br/>Please Select Image of Width - (510)px and height:- (600)px.</b></font>';
                                                                document.getElementById('sub').disabled = true;
                                                            } else {
                                                                document.getElementById("er").innerHTML =
                                                                    'Image Dimension 510*600px';
                                                                document.getElementById('sub').disabled = false;
                                                            }
                                                        });
                                                    }
                                                }
                                            }
                                        }

                                        function createReader(file, whenReady) {
                                            var reader = new FileReader;
                                            reader.onload = function(evt) {
                                                var image = new Image();
                                                image.onload = function(evt) {
                                                    var width = this.width;
                                                    var height = this.height;
                                                    if (whenReady) whenReady(width, height);
                                                };
                                                image.src = evt.target.result;
                                            };
                                            reader.readAsDataURL(file);
                                        }
                                    }
                                    </script>
                                </div>
                                <hr>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Stock: </span>
                                    <div class="col-md-9">
                                        <select name="stock" class="form-control">
                                            <option value="Yes" <?php if($roww['stock']=='Yes'){ echo"selected";}?>>Yes
                                            </option>
                                            <option value="No" <?php if($roww['stock']=='No'){ echo"selected";}?>>No
                                            </option>
                                        </select>

                                    </div>
                                </div>
                                <hr />
                                <?php 
                                    $cou=0;
                                    $sql_w= mysqli_query($conn,"select * from size_class where status='Active'");
                                    while($row_w=mysqli_fetch_assoc($sql_w))
                                    {
                                        $check_s=$row_w['id'];
                                        if(in_array($check_s,$p_size))
                                        { 
                                            $sql_pr=mysqli_query($conn,"select * from products where product_code='".$_REQUEST['id']."' and size='$check_s'");
                                            $var_pr=mysqli_fetch_assoc($sql_pr);?>
                                <div id='price_f<?=$var_pr['id'];?>'>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Price for
                                            <?=$row_w['symbol'];?>: </span>
                                        <div class="col-md-9">
                                            <input type="text" name="price<?=$var_pr['id'];?>" class="form-control"
                                                id="amount<?=$var_pr['id'];?>" placeholder="Only Enter Rs"
                                                value="<?=$var_pr['price'];?>" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Discount Price: </span>
                                        <div class="col-md-9">
                                            <input type="text" name="disc_price<?=$var_pr['id'];?>"
                                                onblur="check_amount('<?=$var_pr['id'];?>')" class="form-control"
                                                id="disamount<?=$var_pr['id'];?>" placeholder="Only Enter Rs (Optional)"
                                                value="<?=$var_pr['discount'];?>">
                                            <span class="help-block" id="disam<?=$var_pr['id'];?>"></span>
                                            <span onclick="remove_weight('<?=$var_pr['id'];?>')"
                                                style="color:#f55d2c;cursor: pointer;">Remove</span>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Color for
                                            <?=$row_w['symbol'];?>: </span>
                                        <div class="col-md-9">
                                            <?php
$z=1;
// print_r($roww1['id']);exit();

$query="select * from color_tb where status='Active' and pid='".$var_pr['id']."'";
$query = mysqli_query($conn,$query);
                                    while($p_color=mysqli_fetch_assoc($query))
                                    {
?>
                                            <div class="row">
                                                <div class="col-11">
                                                    <input type="color" class="form-control"
                                                        id="color<?=$var_pr['id'].$z;?>" value="<?=$p_color['color'];?>"
                                                        disabled>
                                                </div>
                                                <div class="col-1">
                                                    <button onclick="removeProductColor(this,<?=$p_color['id'];?>);"
                                                        type="button" class="close" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                            </div>

                                            <?php
        $z++;
                                    }
?>






                                        </div>
                                    </div>
                                </div>
                                <script>
                                function remove_weight(id) {
                                    var x = confirm('Are you sure to delete this weight');
                                    if (x == true) {
                                        $.ajax({
                                            url: "remove_pweight.php",
                                            type: "POST",
                                            data: "id=" + id,
                                            success: function(response) {
                                                //if(response=='1')
                                                //{
                                                $("#price_f" + id).hide();
                                                $('#w_cl').empty();
                                                $('#w_cl').html(response);
                                                //}
                                            }
                                        });
                                    }
                                }
                                </script>
                                <?php }
                                        else
                                        { $cou=1; }
                                    }?>
                                <div id="w_cl">
                                    <?php 
                                    if($cou==1)
                                    { ?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Weight Class: </span>
                                        <div class="col-md-9">

                                            <select name="weight[]" class="form-control" id="weight"
                                                onchange="getweight(this)" multiple="">
                                                <?php
                                                //print_r($p_weight);
                                                $sql_w= mysqli_query($conn, "select * from weight where status='Active'");
                                                while($row_w=mysqli_fetch_assoc($sql_w))
                                                {
                                                    $sql_wc= mysqli_query($conn,"select * from weight_class where id='".$row_w['class']."'");
                                                    $row_wc= mysqli_fetch_assoc($sql_wc);
                                                    $check_w=$row_w['name'].$row_wc['symbol'];
                                                    if(in_array($check_w,$p_weight))
                                                    {}
                                                    else
                                                    { ?>
                                                <option value="<?=$row_w['name'].$row_wc['symbol'];?>">
                                                    <?=$row_w['name']." ".ucwords($row_wc['name'])?></option>
                                                <?php
                                                    }
                                                }?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                    } ?>
                                </div>
                                <script>
                                function getweight(sel) {
                                    var opts = [],
                                        opt;
                                    var len = sel.options.length;
                                    for (var i = 0; i < len; i++) {
                                        opt = sel.options[i];
                                        if (opt.selected) {
                                            opts.push(opt);
                                            //console.log(opt.value);
                                            var divs = '<div id="p' + i + '"></div>';
                                            $('#p' + i).remove();
                                            $('#price').append(divs);
                                            var content =
                                                '<div class="form-group row"><span class="label-text col-md-3 col-form-label">Price for ' +
                                                opt.value +
                                                ': </span><div class="col-md-9"><input type="text" name="price[]" class="form-control" id="amount' +
                                                i +
                                                '" placeholder="Only Enter Rs" required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Discount Price: </span><div class="col-md-9"><input type="text" name="disc_price[]" onblur="check_amount(' +
                                                i + ')" class="form-control" id="disamount' + i +
                                                '" placeholder="Only Enter Rs (Optional)"><span class="help-block" id="disam' +
                                                i + '"></span></div></div>';
                                            //console.log(content);
                                            $('#p' + i).append(content);
                                            //amount decimal
                                            let amount = document.querySelector('#amount' + i),
                                                preAmount = amount.value;
                                            amount.addEventListener('input', function() {
                                                if (isNaN(Number(amount.value))) {
                                                    amount.value = preAmount;
                                                    return;
                                                }

                                                let numberAfterDecimal = amount.value.split(".")[1];
                                                if (numberAfterDecimal && numberAfterDecimal.length > 3) {
                                                    amount.value = Number(amount.value).toFixed(3);
                                                }
                                                preAmount = amount.value;
                                            });
                                            //discount decimal
                                            let disamount = document.querySelector('#disamount' + i),
                                                preAmounts = disamount.value;
                                            disamount.addEventListener('input', function() {
                                                if (isNaN(Number(disamount.value))) {
                                                    disamount.value = preAmounts;
                                                    return;
                                                }

                                                let numberAfterDecimals = disamount.value.split(".")[1];
                                                if (numberAfterDecimals && numberAfterDecimals.length > 3) {
                                                    disamount.value = Number(disamount.value).toFixed(3);
                                                }
                                                preAmounts = disamount.value;
                                            });

                                        } else {
                                            //                                                        console.log(i);
                                            $('#p' + i).remove();
                                        }
                                    }
                                }

                                function check_amount(id) {
                                    var price = document.getElementById('amount' + id).value;
                                    var discount = document.getElementById('disamount' + id).value;
                                    console.log(price);
                                    console.log(discount > price);
                                    if (price !== '') {
                                        if (Number(discount) > Number(price)) {
                                            document.getElementById('disam' + id).innerHTML =
                                                '<font color="red">Discount price should be less than actual price</font>';
                                            document.getElementById('sub').disabled = true;
                                            setTimeout(fade_out, 4000);

                                            function fade_out() {
                                                $("#disam" + id).empty();
                                            }
                                        } else {
                                            document.getElementById('disam' + id).innerHTML = '';
                                            document.getElementById('sub').disabled = false;
                                        }
                                    } else if (price === '') {
                                        document.getElementById('disam' + id).innerHTML =
                                            '<font color="red">Please fill the price first</font>';
                                        document.getElementById('disamount' + id).value = '';
                                        setTimeout(fade_out, 4000);

                                        function fade_out() {
                                            $("#disam" + id).empty();
                                        }
                                    }
                                }
                                </script>
                                <div id="price">

                                </div>
                                <hr />
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product in Top Featured:
                                    </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="top" class="" id="" value="Yes"
                                            <?php if($roww['top']=='Yes'){ echo'checked';}?>> Yes
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product in New Arrivals:
                                    </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="new" class="" id="" value="Yes"
                                            <?php if($roww['new_arrivals']=='Yes'){ echo'checked';}?>> Yes
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product in Hot Deals: </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="hot" class="" id="" value="Yes"
                                            <?php if($roww['hot_deals']=='Yes'){ echo'checked';}?>> Yes
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">COD Applicable: </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="cod" class="" id="" value="Yes"
                                            <?php if($roww['cod']=='Yes'){ echo'checked';}?>> Yes
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
                                                    <?php
                                                            $sql_dd=mysqli_query($conn,"select * from description where p_id='$pid'");
                                                            if(mysqli_num_rows($sql_dd)>0)
                                                            {
                                                                while ($row_dd=mysqli_fetch_assoc($sql_dd)){ ?>
                                                    <div class="input-group"><textarea class="form-control"
                                                            name="description[]"
                                                            required=""><?=$row_dd['description'];?></textarea></div>
                                                    <br />
                                                    <?php
                                                                }
                                                            }
                                                            else{ ?>
                                                    <textarea class="form-control" name="description[]"
                                                        required=""></textarea>
                                                    <?php
                                                            } ?>
                                                    <div class="input-group-append"><a href="javascript:void(0);"
                                                            class="add_button" title="Add field">&emsp;<span
                                                                class="btn btn-success">ADD</span></a></div>
                                                </div>
                                                <br>
                                                <script type="text/javascript">
                                                $(document).ready(function() {
                                                    var maxField = 10; //Input fields increment limitation
                                                    var addButton = $('.add_button'); //Add button selector
                                                    var wrapper = $('.field_wrapper'); //Input field wrapper
                                                    var fieldHTML =
                                                        '<div><textarea class="form-control" name="description[]"></textarea><a href="javascript:void(0);" class="remove_button">Remove</a></div><br>'; //New input field html 
                                                    var x = 1; //Initial field counter is 1

                                                    //Once add button is clicked
                                                    $(addButton).click(function() {
                                                        //Check maximum number of input fields
                                                        if (x < maxField) {
                                                            x++; //Increment field counter
                                                            $(wrapper).append(
                                                            fieldHTML); //Add field html
                                                        }
                                                    });

                                                    //Once remove button is clicked
                                                    $(wrapper).on('click', '.remove_button', function(e) {
                                                        e.preventDefault();
                                                        $(this).parent('div')
                                                    .remove(); //Remove field html
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
    $(document).ready(function() {
        $('#category').on("change", function() {
            if ($(this).val() != '') {
                var categoryId = $(this).find('option:selected').val();
                $.ajax({
                    url: "ajax.php",
                    type: "POST",
                    data: "categoryId=" + categoryId,
                    success: function(response) {
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
    print_r($_POST); print_r($_FILES);
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
    if(isset($_POST['new']))
    { $new=$_POST['new']; }
    if(isset($_POST['hot']))
    { $hot=$_POST['hot']; }
    if(isset($_POST['top']))
    { $top=$_POST['top']; }
    if(isset($_POST['cod']))
    { $cod=$_POST['cod']; }
            
    $up=mysqli_query($conn,"update products set `cat_id`='$category', `subcat_id`='$subcategory', `product_name`='$product',`hot_deals`='$hot',`new_arrivals`='$new',`top`='$top',`cod`='$cod',`stock`='".$_POST['stock']."' where `product_code`='".$_REQUEST['id']."'");
     
    $sql_g=mysqli_query($conn,"select * from products where product_code='".$_REQUEST['id']."' order by id desc");
    while($var=mysqli_fetch_assoc($sql_g))
    {
        // if(empty($_POST[$d_id])) {
        //     $dis_id=0;
        // } else {
        //     $dis_id = $_POST[$d_id];
        // }
        $r_id='price'.$var['id']; $d_id='disc_price'.$var['id'];
        $upd=mysqli_query($conn,"update products set price='".$_POST[$r_id]."', discount='".$_POST[$d_id]."' where id='".$var['id']."'") or die(mysqli_error($conn));
    }
    if($_POST['weight'])
    {
        for($w=0;$w<count($_POST['weight']); $w++)
        { 
            if(empty($_POST['disc_price'][$w])) {
                $disc_price = '0';
            } else {
                $disc_price = $_POST['disc_price'][$w];
            }
            $query=mysqli_query($conn,"INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`weight`, `price`,`discount`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`product_code`,`date`,`time`) VALUES "
                    . "('$category','$subcategory','$product','".$_POST['weight'][$w]."','".$_POST['price'][$w]."','".$disc_price."','$hot','$new','$top','$cod','".$_POST['stock']."','".$_REQUEST['id']."','$date','$time')") or die(mysqli_error($conn));
        }
    }
    //description
    $del=mysqli_query($conn,"delete from description where p_id='$pid'");
    $description=$_POST['description'];
    if(!empty($description[0])){
        foreach($description as $key => $value)
         {
             $value=mysqli_real_escape_string($conn,$value);
            $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('$category','$subcategory','".$_REQUEST['id']."','$value')");
         }
     }
    //images
    $image_name=($_FILES["image"]["name"]);  
    if(empty($image_name==''))
    {}
    else{
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
            $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('$category','$subcategory','".$_REQUEST['id']."','$value')");
        }
    }
    echo '<div id="snackbar">Product Updated Sucessfully...</div>';
    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
    echo"var delay = 1000;setTimeout(function(){ window.location = 'view-all-products.php'; }, delay);";
    echo "</script>";
} ?>