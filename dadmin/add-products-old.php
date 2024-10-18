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
                                            <option value="<?php echo $data['id']; ?>"> <?php echo $data['cat_name']; ?>
                                            </option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="subcategory"></div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Product Name: *</span>

                                    <div class="col-md-9">
                                        <input type="text" name="product" class="form-control" required
                                            placeholder="Enter Products Name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Image: </span>
                                    <div class="col-md-9">
                                        <input type="file" name="image[]" id="image" onchange="return check()" multiple
                                            class="form-control" required>
                                        <span class="help-block" id="er">Image Dimension 1000*1000px & ( png, jpg ,jpeg
                                            )</span>
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
                                                                    'Image Dimension 1000*1000px';
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
                                    <span class="label-text col-md-3 col-form-label">Size Class: </span>
                                    <div class="col-md-9">
                                        <select name="size[]" class="form-control" id="size" onchange="getSize(this)"
                                            multiple="">
                                            <?php
                                                $sql_w= mysqli_query($conn, "select * from size_class where status='Active'");
                                                while($row_w=mysqli_fetch_assoc($sql_w))
                                                {
                                                    ?>
                                            <option value="<?=$row_w['id'];?>@<?=$row_w['symbol'];?>">
                                                <?=$row_w['name']." ".ucwords($row_w['symbol'])?></option>
                                            <?php
                                                }?>
                                        </select>
                                        <span class="help-block" id="">Control and Select Multiple Sizes</span>
                                        <script>
                                        function getSize(sel) {
                                            var opts = [],
                                                opt;
                                            var len = sel.options.length;
                                            for (var i = 0; i < len; i++) {
                                                opt = sel.options[i];
                                                if (opt.selected) {
                                                    var sizeSymbole = opt.value.split("@");

                                                    opts.push(opt);
                                                    //console.log(opt.value);
                                                    var divs = '<div id="p' + i + '"></div>';
                                                    $('#p' + i).remove();
                                                    $('#price').append(divs);

                                                    // var randomId = '-container';

                                                    var content = '<div class="form-group row">' +
                                                        '<span class="label-text col-md-3 col-form-label">Color: </span>' +
                                                        '<div class="col-md-6 addInputColor' + sizeSymbole[0] + '">' +
                                                        '<input type="color" name="productColor[' + sizeSymbole[0] +
                                                        '][]" value="#ff0000">' +
                                                        '</div>' +
                                                        '<div class="col-md-3">' +
                                                        '<a onclick="addColorInput(' + sizeSymbole[0] +
                                                        ');" class="addColorButton" title="Add field">&emsp;<span class="btn btn-success">ADD</span></a>' +
                                                        '</div></div>' +
                                                        '<div class="form-group row"><span class="label-text col-md-3 col-form-label">Price for ' +
                                                        sizeSymbole[1] +
                                                        ': </span><div class="col-md-9"><input type="text" name="price[]" class="form-control" id="amount' +
                                                        i +
                                                        '" placeholder="Only Enter Rs" required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Discount Price: </span><div class="col-md-9"><input type="text" name="disc_price[]" onblur="check_amount(' +
                                                        i + ')" class="form-control" id="disamount' + i +
                                                        '" placeholder="Only Enter Rs"><span class="help-block" id="disam' +
                                                        i + '"></span></div></div><hr/>';



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
                                                        if (numberAfterDecimal && numberAfterDecimal.length >
                                                            3) {
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
                                                        if (numberAfterDecimals && numberAfterDecimals.length >
                                                            3) {
                                                            disamount.value = Number(disamount.value).toFixed(
                                                            3);
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
                                            //  console.log(discount > price);
                                            if (price !== '') {
                                                if (Number(discount) > Number(price)) {
                                                    document.getElementById('disam' + id).innerHTML =
                                                        '<font color="red">Discount price should be less than actual price</font>';
                                                    document.getElementById('sub').disabled = true;
                                                    setTimeout(fade_out, 4000);

                                                    function fade_out() {
                                                        $("#disam" + id).innerHTML = '';
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
                                                    $("#disam" + id).innerHTML = '';
                                                }
                                            }
                                        }

                                        function addColorInput(size) {
                                            console.log(size);

                                            var maxField = 10; //Input fields increment limitation
                                            var wrapper = $('.addInputColor' + size); //Input field wrapper


                                            var fieldHTML = '<div class="row"><div class="col-md-8 pt-3">' +
                                                '<input type="color" name="productColor[' + size +
                                                '][]" value="#ff0000">' +
                                                '</div><button onclick="removeColorDiv(this);" type="button" class="close" aria-label="Close">' +
                                                '<span aria-hidden="true">&times;</span>' +
                                                '</button></div>';
                                            // var fieldHTML = '<div><textarea class="form-control" name="description[]"></textarea><a href="javascript:void(0);" class="remove_button">Remove</a></div><br>'; //New input field html 
                                            var x = 1; //Initial field counter is 1

                                            //Once add button is clicked


                                            //Check maximum number of input fields
                                            if (x < maxField) {
                                                x++; //Increment field counter
                                                $(wrapper).append(fieldHTML); //Add field html
                                            }

                                            //Once remove button is clicked

                                        }

                                        function removeColorDiv(elem) {
                                            // $(elem).parent('div').remove();
                                            $(elem).parent('div').remove(); //Remove field html
                                        };
                                        </script>
                                    </div>
                                </div>









                                <div id="price">

                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product in Top Featured:
                                    </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="top" class="" id="" value="Yes"> Yes
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product in New Arrivals:
                                    </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="new" class="" id="" value="Yes"> Yes
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product in Festive Collection:
                                    </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="hot" class="" id="" value="Yes"> Yes
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">COD Applicable: </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="cod" class="" id="" value="Yes"> Yes
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
                                                    <textarea class="form-control" name="description[]"
                                                        required=""></textarea>
                                                    <div class="input-group-append">
                                                        <a href="javascript:void(0);" class="add_button"
                                                            title="Add field">&emsp;<span
                                                                class="btn btn-success">ADD</span></a>
                                                    </div>
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