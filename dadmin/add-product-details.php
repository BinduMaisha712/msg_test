<?php include('includes/header.php'); 

if(isset($_GET['product'])){
    $groupCode = $_GET['product'];


    $sel_query=mysqli_query($conn,"SELECT * FROM `products` where group_code='".$groupCode."'");
    if(mysqli_num_rows($sel_query)>0)
    {
        $productDetail= mysqli_fetch_assoc($sel_query);

        $catName=mysqli_query($conn,"SELECT cat_name FROM `category` where id='".$productDetail['cat_id']."'");
        $catName= mysqli_fetch_assoc($catName);
    }
    else{
      
        $catName="";
    }
}else{
    $groupCode="";
}


?>
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <!-- Edit Product Start -->
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Product Detail</h6>
                </div>
                <!-- Tab Content Start -->
                <div class="tab-content">
                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade show active" id="tab01">
                        <div class="panel-content">
                            <form action="" id="addProductDetails" method="post" enctype="multipart/form-data"
                                name="form">
                                <input type="hidden" name="groupCode" class="form-control" value="<?=$groupCode;?>">



                                <!-- If Product Group Code is NULL -->
                                <?php if(isset($_GET['product'])){?>

                                <div class="form-group row">

                                    <span class="label-text col-md-3 col-form-label">Category: *</span>
                                    <div class="col-md-9">

                                        <input type="hidden" name="category" value="<?=$productDetail['cat_id'];?>">
                                        <input type="text" name="categoryName" class="form-control"
                                            value="<?=$catName['cat_name'];?>" readonly>

                                    </div>
                                </div>

                                <?php
                                if($productDetail['subcat_id'] != ""){
                                    $subCatName=mysqli_query($conn,"SELECT sub_cat_name FROM `subcategory` where id='".$productDetail['subcat_id']."'");
                                    $subCatName= mysqli_fetch_assoc($subCatName);

                                    ?>
                                <div class="form-group row">

                                    <span class="label-text col-md-3 col-form-label">Sub Category: *</span>
                                    <div class="col-md-9">

                                        <input type="hidden" name="subcategory"
                                            value="<?=$productDetail['subcat_id'];?>">
                                        <input type="text" name="subcategoryName" class="form-control"
                                            value="<?=$subCatName['sub_cat_name'];?>" readonly>

                                    </div>
                                </div>

                                <?php
                                }
                                ?>

                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Product Name: *</span>

                                    <div class="col-md-9">
                                        <input type="hidden" name="productCode"
                                            value="<?=$productDetail['product_code'];?>" readonly>
                                        <input type="text" name="product" class="form-control"
                                            value="<?=$productDetail['product_name'];?>" readonly>
                                    </div>
                                </div>
                                <?php } ?>
                                <!-- If Product Group Code is NULL -->







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


                                        <input class="form-control" name="productColor" id="color" list="colors"
                                            placeholder="Please enter product color name">
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




                                </div>





                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Images: </span>
                                    <div class="col-md-9">
                                        <input type="file" name="image[]" id="image0" onchange="return check(this.id)"
                                            multiple class="form-control" required>
                                        <span class="help-block" id="erimage0">Image Dimension 1000*1000px & ( png, jpg
                                            ,jpeg )</span>
                                    </div>
                                </div>


                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Sizes: </span>
                                    <div class="col-md-9">
                                        <div class="row">
                                            <?php
                                                      $sel_query=mysqli_query($conn,"SELECT id,name,symbol FROM `size_class` where status='Active'");

                                                      $random = 1;
                                                      while($data=mysqli_fetch_assoc($sel_query))
                                                      {
                                                      ?>



                                            <div class="col-md-4">
                                                <div class="form-check-inline">
                                                    <label class="form-check-label1">
                                                        <input type="checkbox" class="form-check-input1"
                                                            name="productSizes[]" id="productSizes0<?=$random?>"
                                                            value="<?=$data['id'];?>@<?=$data['symbol'];?>"
                                                            onchange="getSize(this,0)">&nbsp;&nbsp;<?=$data['name']." (".ucwords($data['symbol']).")"?>
                                                    </label>
                                                </div>
                                            </div>

                                            <?php 
                                            $random++;
                                            } ?>

                                        </div>
                                    </div>
                                </div>

                                <div id="price0"></div> <!-- Price Input Added Here -->




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


                                <div class="row mt-3">
                                    <div class="col-md-9 offset-md-3">
                                        <button type="submit" class="btn btn-success" name="submit"
                                            id="sub">Submit</button>
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
    function check(imageId) {
        var x = document.getElementById(imageId);
        if ('files' in x) {
            for (var i = 0; i < x.files.length; i++) {
                var file = x.files[i];
                if ('name' in file) {
                    var ext = file.name.split('.').pop().toLowerCase();
                    if ($.inArray(ext, ['png', 'jpg', 'jpeg']) === -1) {
                        document.getElementById(imageId).value = "";
                        document.getElementById("er" + imageId).innerHTML =
                            '<font color="red"><b>You are trying to upload files which not allowed ' + "(" + file.name +
                            " is invalid). <br/>Please select png images.</b></font>";
                        document.getElementById('sub').disabled = true;
                    } else {
                        $('#er' + imageId).empty();
                        createReader(file, function(w, h) {
                            console.log(file.name + ' ' + w + ' ' + h);
                            if (w != 1000 && h != 1000) {
                                $('#er' + imageId).empty();
                                document.getElementById(imageId).value = "";
                                document.getElementById("er" + imageId).innerHTML = '<font color="red"><b>' +
                                    file.name +
                                    ' is not match with dimensions. <br/>Please Select Image of Width - (1000)px and height:- (1000)px.</b></font>';
                                document.getElementById('sub').disabled = true;
                            } else {
                                document.getElementById("er" + imageId).innerHTML =
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



    function getSize(sel, random) {

        console.log(sel);
        selId = sel.id;
        // var opts = [], 
        // opt;
        if ($("#" + selId).is(':checked')) {

            var sizeSymbole = sel.value.split("@");

            // opts.push(opt);
            //console.log(opt.value);
            var i = Math.floor(Math.random() * 1000) + 1;
            var divs = '<div id="p' + selId + '"></div>';
            $('#p' + selId).remove();
            $('#price' + random).append(divs);

            // var randomId = '-container';

            var content =
                '<hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label">Price for ' +
                sizeSymbole[1] +
                ': </span><div class="col-md-9"><input type="text" name="price[]" class="form-control" id="amount' + i +
                '" placeholder="Only Enter Rs" required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Discount Price: </span><div class="col-md-9"><input type="text" name="disc_price[]" onblur="check_amount(' +
                i + ')" class="form-control" id="disamount' + i +
                '" placeholder="Only Enter Rs"><span class="help-block" id="disam' + i + '"></span></div></div>';



            //console.log(content);
            $('#p' + selId).append(content);
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
            // console.log(i);
            $('#p' + selId).remove();
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
            document.getElementById('disam' + id).innerHTML = '<font color="red">Please fill the price first</font>';
            document.getElementById('disamount' + id).value = '';
            setTimeout(fade_out, 4000);

            function fade_out() {
                $("#disam" + id).innerHTML = '';
            }
        }
    }
    </script>

    <script type="text/javascript">
    ////////// Add Record Form //////////
    $('#addProductDetails').submit(function(event) { //trigger on form submit
        event.preventDefault();
        console.log(this);
        var formData = new FormData(this);

        $.ajax({
            url: "ajax/add-product-details.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(response) {
                console.log(response);
            }
        });

    });


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

 ?>
    <div id="snackbar1"></div>