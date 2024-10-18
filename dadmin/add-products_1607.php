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
                                            $sel_query=mysqli_query($conn,"SELECT * FROM `category` WHERE status='Active'");

                                            while($data=mysqli_fetch_assoc($sel_query))
                                            {
                                              ?>
                                            <option value="<?php echo $data['id']; ?>"
                                                data-clastype="<?= $data['classtype_id']?>">
                                                <?php echo $data['cat_name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row" id="subcategory"></div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Product Name: *</span>

                                    <div class="col-md-9">
                                        <input type="text" name="product" class="form-control" id="productName" required
                                            placeholder="Please enter product name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Product Brand: *</span>

                                    <div class="col-md-9">
                                        <input type="text" name="brand" class="form-control" id="productBrand" required
                                            placeholder="Please enter product brand">
                                    </div>
                                </div>

                                <!-- <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Stock: </span>
                                        <div class="col-md-9">
                                            <select name="stock" class="form-control">
                                                <option value="Yes">Yes</option>
                                                <option value="No">No</option>
                                            </select>
                                            
                                        </div>
                                    </div> -->


                                <!-- FOR WEIGHT-->
                                <div class="classtypeField">



                                </div>
                                <input type="hidden" id="classtype_id" name="classtype_id">
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product in Top Featured:
                                    </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="top" class="" id="topFeatured" value="Yes"
                                            onclick="getproductlist(this.id);"> Yes

                                        <div id="topFeaturedList"></div>

                                    </div>
                                </div>


                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product in New Arrivals:
                                    </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="new" class="" id="newArrivals" value="Yes"
                                            onclick="getproductlist(this.id);"> Yes
                                        <div id="newArrivalsList"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product in Festive Collection:
                                    </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="hot" class="" id="hotDeals" value="Yes"
                                            onclick="getproductlist(this.id);"> Yes
                                        <div id="hotDealsList"></div>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">COD Applicable: </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="cod" class="" id="codApplicable" value="Yes"
                                            onclick="getproductlist(this.id);"> Yes
                                        <div id="codApplicableList"></div>
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
                                        <!-- <div class="col-md-9"> -->
                                        <div class="field_wrapper form-group">
                                            <div class="input-group">
                                                <!-- <textarea class="form-control" name="description[]" required=""></textarea> -->

                                                <div class="row">
                                                    <div class="col-12">
                                                        <textarea name="editor" id="editor" name="description" rows="10"
                                                            cols="80" required=""></textarea>
                                                    </div>
                                                </div>

                                                <br>


                                                <!-- <script type="text/javascript">
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
                                    </script> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row" id="metaList">
                                    <span class="label-text col-md-3 col-form-label">Want To Add Meta Content: </span>
                                    <div class="col-md-9">
                                        <input type="radio" name="isMeta" class="" id="addMeta2" value="Yes" checked
                                            onclick="getMetalist(this.value);"> Now
                                        <input type="radio" name="isMeta" class="" id="addMeta1" value="No"
                                            onclick="getMetalist(this.value);"> Later

                                        <!-- <div id="metaList"></div> -->

                                    </div>
                                </div>
                                <div class="metaFieldWrapper">

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="card card-outline-danger p-2">
                                                <div class="form-group row">
                                                    <span class="label-text col-md-3 col-form-label">Meta Title: </span>
                                                    <div class="col-md-9">
                                                        <input type="text" name="title" id="metatitle" value=""
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="form-group row">
                                                    <span class="label-text col-md-3 col-form-label">Meta Tags: </span>

                                                    <div class="col-md-9 field_wrapper1">
                                                        <input type="text" name="meta[]" value=""
                                                            class="form-control" />

                                                    </div>
                                                    <br>

                                                </div>
                                                <div class="row pt-2">
                                                    <div class="col-12 text-right">
                                                        <a href="javascript:void(0);" class="addMetatags"
                                                            title="Add METATAGS">&emsp;<span class="btn btn-success">ADD
                                                                META TAGS</span></a>
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                $(document).ready(function() {
                                                    var maxField1 = 10; //Input fields increment limitation
                                                    var addButton1 = $('.addMetatags'); //Add button selector
                                                    var wrapper1 = $('.field_wrapper1'); //Input field wrapper
                                                    var fieldHTML1 =
                                                        '<div><input type="text" name="meta[]" value="" class="form-control"/><a href="javascript:void(0);" class="remove_button1">Remove</a><br></div>'; //New input field html 
                                                    var x = 1; //Initial field counter is 1

                                                    //Once add button is clicked
                                                    $(addButton1).click(function() {
                                                        //Check maximum number of input fields
                                                        if (x < maxField1) {
                                                            x++; //Increment field counter
                                                            $(wrapper1).append(
                                                            fieldHTML1); //Add field html
                                                        }
                                                    });

                                                    //Once remove button is clicked
                                                    $(wrapper1).on('click', '.remove_button1', function(e) {
                                                        e.preventDefault();
                                                        $(this).parent('div')
                                                    .remove(); //Remove field html
                                                        x--; //Decrement field counter
                                                    });
                                                });
                                                </script>
                                                <br>
                                                <br>
                                                <div class="form-group row">
                                                    <span class="label-text col-md-3 col-form-label">Meta Keywords:
                                                    </span>

                                                    <div class="col-md-9 field_wrapper2">
                                                        <input type="text" name="key[]" value="" class="form-control" />

                                                    </div>
                                                    <br>

                                                </div>
                                                <div class="row pt-2">
                                                    <div class="col-12 text-right">
                                                        <a href="javascript:void(0);" class="addMetaKey"
                                                            title="Add METAKEYWORDS">&emsp;<span
                                                                class="btn btn-success">ADD META KEYWORDS</span></a>
                                                    </div>
                                                </div>
                                                <script type="text/javascript">
                                                $(document).ready(function() {
                                                    var maxField2 = 10; //Input fields increment limitation
                                                    var addButton2 = $('.addMetaKey'); //Add button selector
                                                    var wrapper2 = $('.field_wrapper2'); //Input field wrapper
                                                    var fieldHTML2 =
                                                        '<div><input type="text" name="key[]" value="" class="form-control"/><a href="javascript:void(0);" class="remove_button2">Remove</a><br></div>'; //New input field html 
                                                    var x = 1; //Initial field counter is 1

                                                    //Once add button is clicked
                                                    $(addButton2).click(function() {
                                                        //Check maximum number of input fields
                                                        if (x < maxField2) {
                                                            x++; //Increment field counter
                                                            $(wrapper2).append(
                                                            fieldHTML2); //Add field html
                                                        }
                                                    });

                                                    //Once remove button is clicked
                                                    $(wrapper2).on('click', '.remove_button2', function(e) {
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
    function getproductlist(checkedId) {

        // console.log(checkedId);
        if ($("#" + checkedId).is(':checked')) {

            fieldHTML = '';
            console.log(checkedId);
            var classType = $('#classtype_id').val();
            if ((classType == 1) || (classType == 3) || (classType == 4)) {
                var colorElement = document.getElementsByClassName("productColorList");
                var sizeElement = document.getElementsByClassName("productSizeList");

                fieldHTML += '<div class="form-group row">';

                if (colorElement.length > 0) {
                    for (i = 0; i < colorElement.length; i++) {

                        colorid = colorElement[i].id;
                        randomColorArr = colorid.split("_");
                        randomNo = randomColorArr[1];

                        // console.log(randomNo);

                        for (j = 0; j < sizeElement.length; j++) {
                            sizeId = sizeElement[j].id;
                            randomSizeArr = sizeId.split("_");



                            if (randomSizeArr.includes(randomNo)) {

                                if ($("#" + sizeId).is(':checked')) {

                                    forColor = $('#' + colorid).val();
                                    forSize = $('#' + sizeId).val();
                                    forSizeSymbole = forSize.split("@");

                                    // console.log(forSizeSymbole);

                                    fieldHTML += '<div class="col-md-4">';
                                    fieldHTML += '<div class="form-check-inline">';
                                    fieldHTML += '<label class="form-check-label1">';
                                    fieldHTML += '<input type="checkbox" class="form-check-input1" id="' + checkedId +
                                        randomNo + forSizeSymbole[0] + '" name="' + checkedId + '[' + randomNo + '][' +
                                        forSizeSymbole[0] + ']' + '" value="Yes" checked>&nbsp;&nbsp;';
                                    fieldHTML += 'For ' + forColor + '&nbsp;(' + forSizeSymbole[1] + ')</label>';
                                    fieldHTML += '</div>';
                                    fieldHTML += '</div>';

                                    // console.log(forColor, forSize);


                                }

                            }
                        }

                    }

                }
            } else {
                var weightElement = document.getElementsByClassName("productWeightList");

                fieldHTML += '<div class="form-group row">';


                for (j = 0; j < weightElement.length; j++) {
                    sizeId = weightElement[j].id;
                    randomSizeArr = sizeId.split("_");




                    if ($("#" + sizeId).is(':checked')) {

                        forSize = $('#' + sizeId).val();
                        forSizeSymbole = forSize.split("@");


                        fieldHTML += '<div class="col-md-4">';
                        fieldHTML += '<div class="form-check-inline">';
                        fieldHTML += '<label class="form-check-label1">';
                        fieldHTML += '<input type="checkbox" class="form-check-input1" id="' + checkedId +
                            forSizeSymbole[0] + '" name="' + checkedId + '[' + forSizeSymbole[0] + ']' +
                            '" value="Yes" checked>&nbsp;&nbsp;';
                        fieldHTML += 'For ' + forSizeSymbole[1] + '</label>';
                        fieldHTML += '</div>';
                        fieldHTML += '</div>';



                    }


                }



            }

            fieldHTML += '</div>';
            console.log(fieldHTML);
            $('#' + checkedId + 'List').append(fieldHTML);
        } else {

            $('#' + checkedId + 'List').html("");

        }

    }


    function getMetalist(checkedId) {

        // // console.log(checkedId);
        if (checkedId == 'Yes') {
            $('.metaFieldWrapper').show();

        } else {
            $('.metaFieldWrapper').hide();

        }

    }

    $("#productName").focusout(function() {

        $("#metatitle").val($('#productName').val());
    })

    $(document).ready(function() {
        $('.metaFieldWrapper').show();
        var productValueArray = [];
        $('.addValueToArray').click(function() {
            id = this.id;
            if ($("#" + id).is(':checked')) {

                productValueArray.push(productValue);
            } else {
                // let arr = ['A', 'B', 'C'];
                productValueArray = productValueArray.filter(e => e !== productValue);
            }


        });


    });

    //Once remove button is clicked
    function remove(Id) {
        alert(Id);
        // $('.colorFieldWrapper').on('click', '.removeColorDiv', function(e){
        e.preventDefault();
        // $("a#DeleteItem").parent().parent().remove();
        $('#' + Id).parent('div').parent('div').parent('div').remove(); //Remove field html
        // });
    }


    function getColor() {

        var classType = $('#classtype_id').val();
        if (classType == 1) {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.addColor'); //Add button selector
            var wrapper = $('.colorFieldWrapper'); //Input field wrapper
            var fieldHTML = ''; //New input field html 
            var x = 1; //Initial field counter is 1


            //Once add button is clicked
            //Check maximum number of input fields
            if (x < maxField) {
                //////// HTML Block /////////
                var random = Math.floor(Math.random() * 1000) + 1;

                fieldHTML = '';
                fieldHTML += '<div class="row pt-2" id="remove_' + random + '">';
                fieldHTML += '<div class="col-md-12">';

                fieldHTML += '<div class="card card-outline-danger p-2">';

                fieldHTML +=
                    '<span class="text-right clickable close-icon removeColorDiv p-2" title="Remove" onclick="remove(this.id);" ><i class="fa fa-times"></i></span>';

                fieldHTML += '<div class="card-block">';

                fieldHTML += '<div class="form-group row">';
                fieldHTML += '<span class="label-text col-md-3 col-form-label">Color: </span>';


                fieldHTML += '<div class="col-md-9">';


                fieldHTML += '<input class="form-control productColorList" name="productColor[' + random +
                    ']" id="color_' + random + '" placeholder="Please enter product color name" list="colors">';
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




                fieldHTML += '</div>';





                fieldHTML += '<div class="form-group row">';
                fieldHTML += '<span class="label-text col-md-3 col-form-label">Images: </span>';
                fieldHTML += '<div class="col-md-9">';
                fieldHTML += '<input type="file" name="image[' + random + '][]" id="image' + random +
                    '" onchange="return check(this.id)" multiple class="form-control" required>';
                fieldHTML += '<span class="help-block" id="erimage' + random +
                    '">Image Dimension Minimum Height: 600px, Minimum Width: 500px, & ( png, jpg ,jpeg )</span>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';


                fieldHTML += '<div class="form-group row">';
                fieldHTML += '<span class="label-text col-md-3 col-form-label">Sizes: </span>';
                fieldHTML += '<div class="col-md-9">';
                fieldHTML += '<div class="row">';
                <?php
$sel_query=mysqli_query($conn,"SELECT id,name,symbol,classtype_id FROM `size_class` where status='Active'");

while($data=mysqli_fetch_assoc($sel_query))
{
 if($data['classtype_id']==1)
 {   ?>



                fieldHTML += '<div class="col-md-4">';
                fieldHTML += '<div class="form-check-inline">';
                fieldHTML += '<label class="form-check-label1">';
                fieldHTML += '<input type="checkbox" class="form-check-input1 productSizeList" id="productSizes_' +
                    random + '_<?=$data['id'];?>" onchange="getSize(this,' + random + ')" name="productSizes[' +
                    random + '][]" value="<?=$data['id'];?>@<?=$data['symbol'];?>">&nbsp;&nbsp;<?=$data['symbol'];?> <
                    /label>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';

                <?php }
} ?>

                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';

                fieldHTML += '<div id="price' + random + '"></div>';

                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';

                ///////// HTML Block /////////                      




                // console.log(fieldHTML);


                $(wrapper).append(fieldHTML); //Add field html

                x++; //Increment field counter

            }

        }
        if (classType == 3) {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.addColor'); //Add button selector
            var wrapper = $('.colorFieldWrapper'); //Input field wrapper
            var fieldHTML = ''; //New input field html 
            var x = 1; //Initial field counter is 1


            //Once add button is clicked
            //Check maximum number of input fields
            if (x < maxField) {

                ///////// HTML Block /////////
                var random = Math.floor(Math.random() * 1000) + 1;

                fieldHTML = '';
                fieldHTML += '<div class="row pt-2">';
                fieldHTML += '<div class="col-md-12">';

                fieldHTML += '<div class="card card-outline-danger p-2">';

                fieldHTML +=
                    '<span class="text-right clickable close-icon removeColorDiv p-2" title="Remove"><i class="fa fa-times" onclick="remove(this.id);" id="remove_' +
                    random + '"></i></span>';

                fieldHTML += '<div class="card-block">';

                fieldHTML += '<div class="form-group row">';
                fieldHTML += '<span class="label-text col-md-3 col-form-label">Color: </span>';


                fieldHTML += '<div class="col-md-9">';


                fieldHTML += '<input class="form-control productColorList" name="productColor[' + random +
                    ']" id="color_' + random + '" placeholder="Please enter product color name" list="colors">';
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




                fieldHTML += '</div>';





                fieldHTML += '<div class="form-group row">';
                fieldHTML += '<span class="label-text col-md-3 col-form-label">Images: </span>';
                fieldHTML += '<div class="col-md-9">';
                fieldHTML += '<input type="file" name="image[' + random + '][]" id="image' + random +
                    '" onchange="return check(this.id)" multiple class="form-control" required>';
                fieldHTML += '<span class="help-block" id="erimage' + random +
                    '">Image Dimension Minimum Height: 600px, Minimum Width: 500px, & ( png, jpg ,jpeg )</span>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';


                fieldHTML += '<div class="form-group row">';
                fieldHTML += '<span class="label-text col-md-3 col-form-label">Storage: </span>';
                fieldHTML += '<div class="col-md-9">';
                fieldHTML += '<div class="row">';
                <?php
$sel_query=mysqli_query($conn,"SELECT id,name,symbol,classtype_id FROM `size_class` where status='Active'");

while($data=mysqli_fetch_assoc($sel_query))
{
 if($data['classtype_id']==3)
 {   ?>



                fieldHTML += '<div class="col-md-4">';
                fieldHTML += '<div class="form-check-inline">';
                fieldHTML += '<label class="form-check-label1">';
                fieldHTML += '<input type="checkbox" class="form-check-input1 productSizeList" id="productSizes_' +
                    random + '_<?=$data['id'];?>" onchange="getSize(this,' + random + ')" name="productSizes[' +
                    random + '][]" value="<?=$data['id'];?>@<?=$data['symbol'];?>">&nbsp;&nbsp;<?=$data['symbol'];?> <
                    /label>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';

                <?php }
} ?>
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';

                fieldHTML += '<div id="price' + random + '"></div>';

                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';

                ///////// HTML Block /////////                      




                // console.log(fieldHTML);


                $(wrapper).append(fieldHTML); //Add field html
                x++; //Increment field counter

            }

        }
        if (classType == 4) {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.addColor'); //Add button selector
            var wrapper = $('.colorFieldWrapper'); //Input field wrapper
            var fieldHTML = ''; //New input field html 
            var x = 1; //Initial field counter is 1


            //Once add button is clicked
            //Check maximum number of input fields
            if (x < maxField) {

                ///////// HTML Block /////////
                var random = Math.floor(Math.random() * 1000) + 1;

                fieldHTML = '';
                fieldHTML += '<div class="row pt-2">';
                fieldHTML += '<div class="col-md-12">';

                fieldHTML += '<div class="card card-outline-danger p-2">';

                fieldHTML +=
                    '<span class="text-right clickable close-icon removeColorDiv p-2" title="Remove"><i class="fa fa-times" onclick="remove(this.id);" id="remove_' +
                    random + '"></i></span>';

                fieldHTML += '<div class="card-block">';

                fieldHTML += '<div class="form-group row">';
                fieldHTML += '<span class="label-text col-md-3 col-form-label">Color: </span>';


                fieldHTML += '<div class="col-md-9">';


                fieldHTML += '<input class="form-control productColorList" name="productColor[' + random +
                    ']" id="color_' + random + '" placeholder="Please enter product color name" list="colors">';
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




                fieldHTML += '</div>';





                fieldHTML += '<div class="form-group row">';
                fieldHTML += '<span class="label-text col-md-3 col-form-label">Images: </span>';
                fieldHTML += '<div class="col-md-9">';
                fieldHTML += '<input type="file" name="image[' + random + '][]" id="image' + random +
                    '" onchange="return check(this.id)" multiple class="form-control" required>';
                fieldHTML += '<span class="help-block" id="erimage' + random +
                    '">Image Dimension Minimum Height: 600px, Minimum Width: 500px, & ( png, jpg ,jpeg )</span>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';


                fieldHTML += '<div class="form-group row">';
                fieldHTML += '<span class="label-text col-md-3 col-form-label">Sizes: </span>';
                fieldHTML += '<div class="col-md-9">';
                fieldHTML += '<div class="row">';
                <?php
$sel_query=mysqli_query($conn,"SELECT id,name,symbol,classtype_id FROM `size_class` where status='Active'");

while($data=mysqli_fetch_assoc($sel_query))
{
 if($data['classtype_id']==4)
 {   ?>



                fieldHTML += '<div class="col-md-4">';
                fieldHTML += '<div class="form-check-inline">';
                fieldHTML += '<label class="form-check-label1">';
                fieldHTML += '<input type="checkbox" class="form-check-input1 productSizeList" id="productSizes_' +
                    random + '_<?=$data['id'];?>" onchange="getSize(this,' + random + ')" name="productSizes[' +
                    random + '][]" value="<?=$data['id'];?>@<?=$data['symbol'];?>">&nbsp;&nbsp;<?=$data['symbol'];?> <
                    /label>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';

                <?php }
} ?>
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';

                fieldHTML += '<div id="price' + random + '"></div>';

                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';
                fieldHTML += '</div>';

                ///////// HTML Block /////////                      




                // console.log(fieldHTML);


                $(wrapper).append(fieldHTML); //Add field html
                x++; //Increment field counter

            }

        }


    }

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
                            " is invalid). <br/>Please select 'png','jpg' or 'jpeg' images.</b></font>";
                        document.getElementById('sub').disabled = true;
                    } else {
                        $('#er' + imageId).empty();
                        createReader(file, function(w, h) {
                            console.log(file.name + ' ' + w + ' ' + h);
                            if ((w < 500) || (h < 600)) {
                                $('#er' + imageId).empty();
                                document.getElementById(imageId).value = "";
                                document.getElementById("er" + imageId).innerHTML = '<font color="red"><b>' +
                                    file.name +
                                    ' is not match with dimensions. <br/>Please Select Image of Minimum Width: 500px and Minimum: 600px.</b></font>';
                                document.getElementById('sub').disabled = true;
                            } else {
                                document.getElementById("er" + imageId).innerHTML = 'Image Dimension Height:' +
                                    h + 'px and Width: ' + w + 'px';
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
            console.log(divs);
            $('#p' + selId).remove();
            $('#price' + random).append(divs);

            // var randomId = '-container';

            var content = '<hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label">' +
                'Price for ' + sizeSymbole[1] + ': </span><div class="col-md-9">' +
                '<input type="text" name="price[' + random + '][]" class="form-control productPriceList" id="amount' +
                i + '" ' +
                'placeholder="Only Enter Rs" required></div></div><div class="form-group row">' +
                '<span class="label-text col-md-3 col-form-label">Discount Price: </span>' +
                '<div class="col-md-9"><input type="text" name="disc_price[' + random + '][]" onblur="check_amount(' +
                i + ')"' +
                ' class="form-control" id="disamount' + i + '" placeholder="Only Enter Rs"><span class="help-block" ' +
                ' id="disam' + i + '"></span></div></div>'

                +
                '<div class="form-group row">' +
                '<span class="label-text col-md-3 col-form-label">Stock: </span><div class="col-md-3">' +
                '<select name="stock[' + random + '][]" id="stock' + selId + random +
                '" class="form-control" onchange="setStock(' + random + ',this);">' +
                '<option value="">Select Stock</option><option value="Yes">Yes</option><option value="No">No</option>' +
                '</select></div><div class="col-md-6" id="in_stock' + selId + random + '"></div></div>'

                +
                '<div class="form-group row">' +
                '<span class="label-text col-md-3 col-form-label">Min: </span><div class="col-md-3">' +
                '<input type="number" name="min[' + random + '][]"' +
                ' class="form-control" min="1" placeholder="Please enter minimum quantity"></div>' +
                '<div class="col-md-6" id="">' +
                '<div class="row"><span class="label-text col-md-6 col-form-label">Max: </span><div class="col-md-6">' +
                '<input type="number" name="max[' + random + '][]"' +
                ' class="form-control" min="0" placeholder="Please enter maximum quantity"></div></div></div>';

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

    //for weight
    function getWeight(sel, random) {

        console.log(sel);
        selId = sel.id;
        // var opts = [], 
        // opt;
        if ($("#" + selId).is(':checked')) {

            var weightSymbole = sel.value.split("@");

            // opts.push(opt);
            //console.log(opt.value);
            var i = Math.floor(Math.random() * 1000) + 1;
            var divs = '<div id="p' + selId + '"></div>';
            console.log(divs);
            $('#p' + selId).remove();
            $('#price' + random).append(divs);

            // var randomId = '-container';

            var content = '<hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label">' +
                'Price for ' + weightSymbole[1] + ': </span><div class="col-md-9">' +
                '<input type="text" name="price[' + random + '][]" class="form-control productPriceList" id="amount' +
                i + '" ' +
                'placeholder="Only Enter Rs" required></div></div><div class="form-group row">' +
                '<span class="label-text col-md-3 col-form-label">Discount Price: </span>' +
                '<div class="col-md-9"><input type="text" name="disc_price[' + random + '][]" onblur="check_amount(' +
                i + ')"' +
                ' class="form-control" id="disamount' + i + '" placeholder="Only Enter Rs"><span class="help-block" ' +
                ' id="disam' + i + '"></span></div></div>'

                +
                '<div class="form-group row">' +
                '<span class="label-text col-md-3 col-form-label">Stock: </span><div class="col-md-3">' +
                '<select name="stock[' + random + '][]" id="stock' + selId + random +
                '" class="form-control" onchange="setStock(' + random + ',this);">' +
                '<option value="">Select Stock</option><option value="Yes">Yes</option><option value="No">No</option>' +
                '</select></div><div class="col-md-6" id="in_stock' + selId + random + '"></div></div>'

                +
                '<div class="form-group row">' +
                '<span class="label-text col-md-3 col-form-label">Min: </span><div class="col-md-3">' +
                '<input type="number" name="min[' + random + '][]"' +
                ' class="form-control" min="1" placeholder="Please enter minimum quantity"></div>' +
                '<div class="col-md-6" id="">' +
                '<div class="row"><span class="label-text col-md-6 col-form-label">Max: </span><div class="col-md-6">' +
                '<input type="number" name="max[' + random + '][]"' +
                ' class="form-control" min="0" placeholder="Please enter maximum quantity"></div></div></div>';

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



    function setStock(random, q) {

        status = q.value;
        id = q.id;

        var divs = '<div id="nstock' + id + '"></div>';
        console.log(divs);
        $('#nstock' + id).remove();
        $('#in_' + id).append(divs);


        if (status == 'Yes') {

            console.log("asas");
            var content =
                '<div class="row"><span class="label-text col-md-6 col-form-label">Quantity: </span><div class="col-md-6">' +
                '<input type="number" name="inStock[' + random + '][]"' +
                ' class="form-control" min="0" placeholder="No. of Item in Stock" required>' +
                '</div></div>';
            $('#nstock' + id).append(content);
        } else {
            $('#nstock' + id).remove();
        }
    }


    function check_amount(id) {
        var price = document.getElementById('amount' + id).value;
        var discount = document.getElementById('disamount' + id).value;
        console.log(price);
        //  console.log(discount > price);
        if (discount !== '') {
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
        }
        if (price === '') {
            document.getElementById('disam' + id).innerHTML = '<font color="red">Please fill the price</font>';
            document.getElementById('disamount' + id).value = '';
            setTimeout(fade_out, 4000);

            function fade_out() {
                $("#disam" + id).innerHTML = '';
            }
        }
    }

    function clothing() {
        var html =
            '<div class="colorFieldWrapper"><div class="row"><div class="col-md-12"><div class="card card-outline-danger p-2"><div class="form-group row"><span class="label-text col-md-3 col-form-label">Color: </span><div class="col-md-9"><input class="form-control productColorList" name="productColor[0]" id="color_0" list="colors" placeholder="Please enter product color name"><datalist id="colors"><?php $sel_query=mysqli_query($conn,"SELECT color_name FROM `color_info`"); while($data=mysqli_fetch_assoc($sel_query)){?><option><?=$data['color_name']?></option><?php } ?></datalist></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Images: </span><div class="col-md-9"><input type="file" name="image[0][]" id="image0" onchange="return check(this.id)" multiple class="form-control" required><span class="help-block" id="erimage0">Image Dimension 510*600px & ( png, jpg ,jpeg )</span></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Sizes: </span><div class="col-md-9"><div class="row"><?php $sel_query=mysqli_query($conn,"SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=1");$random = 1; while($data=mysqli_fetch_assoc($sel_query)){ ?><div class="col-md-4"><div class="form-check-inline"><label class="form-check-label1"><input type="checkbox" class="form-check-input1 productSizeList" name="productSizes[0][]" id="productSizes_0_<?=$random?>" value="<?=$data['id'];?>@<?=$data['symbol'];?>" onchange="getSize(this,0)">&nbsp;&nbsp;<?=$data['name']." (".ucwords($data['symbol']).")"?></label></div></div><?php $random++; } ?></div</div> </div><div id="price0"></div> <!-- Price Input Added Here --></div></div> </div></div> </div><!-- Add Color --><div class="row pt-2"> <div class="col-12 text-right"> <a href="javascript:void(0);" class="addColor" title="Add Color" onclick="getColor();">&emsp;<span class="btn btn-success">ADD COLOR</span></a></div></div><!-- Add Color -->';

        $('.classtypeField').html(html);

    }

    function weight() {
        var html =
            '<div class="colorFieldWrapper"><div class="row"><div class="col-md-12"><div class="card card-outline-danger p-2"><div class="form-group row"><span class="label-text col-md-3 col-form-label">Images: </span><div class="col-md-9"><input type="file" name="image[0][]" id="image0" onchange="return check(this.id)" multiple class="form-control" required><span class="help-block" id="erimage0">Image Dimension 510*600px & ( png, jpg ,jpeg )</span></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Sizes: </span><div class="col-md-9"><div class="row"><?php $sel_query=mysqli_query($conn,"SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=2");$random = 1; while($data=mysqli_fetch_assoc($sel_query)){ ?><div class="col-md-4"><div class="form-check-inline"><label class="form-check-label1"><input type="checkbox" class="form-check-input1 productWeightList" name="productWeight[0][]" id="productWeight_0_<?=$random?>" value="<?=$data['id'];?>@<?=$data['symbol'];?>" onchange="getWeight(this,0)">&nbsp;&nbsp;<?=ucwords($data['symbol'])?></label></div></div><?php $random++; } ?></div</div> </div><div id="price0"></div> <!-- Price Input Added Here --></div></div> </div></div>';

        $('.classtypeField').html(html);

    }

    function gadgets() {
        var html =
            '<div class="colorFieldWrapper"><div class="row"><div class="col-md-12"><div class="card card-outline-danger p-2"><div class="form-group row"><span class="label-text col-md-3 col-form-label">Color: </span><div class="col-md-9"><input class="form-control productColorList" name="productColor[0]" id="color_0" list="colors" placeholder="Please enter product color name"><datalist id="colors"><?php $sel_query=mysqli_query($conn,"SELECT color_name FROM `color_info`"); while($data=mysqli_fetch_assoc($sel_query)){?><option><?=$data['color_name']?></option><?php } ?></datalist></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Images: </span><div class="col-md-9"><input type="file" name="image[0][]" id="image0" onchange="return check(this.id)" multiple class="form-control" required><span class="help-block" id="erimage0">Image Dimension 510*600px & ( png, jpg ,jpeg )</span></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Storage: </span><div class="col-md-9"><div class="row"><?php $sel_query=mysqli_query($conn,"SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=3");$random = 1; while($data=mysqli_fetch_assoc($sel_query)){ ?><div class="col-md-4"><div class="form-check-inline"><label class="form-check-label1"><input type="checkbox" class="form-check-input1 productSizeList" name="productSizes[0][]" id="productSizes_0_<?=$random?>" value="<?=$data['id'];?>@<?=$data['symbol'];?>" onchange="getSize(this,0)">&nbsp;&nbsp;<?=ucwords($data['symbol'])?></label></div></div><?php $random++; } ?></div</div> </div><div id="price0"></div> <!-- Price Input Added Here --></div></div> </div></div></div> <!-- Add Color --><div class="row pt-2"> <div class="col-12 text-right"> <a href="javascript:void(0);" class="addColor" title="Add Color" onclick="getColor();">&emsp;<span class="btn btn-success">ADD COLOR</span></a></div></div><!-- Add Color -->';

        $('.classtypeField').html(html);

    }

    function shoe() {
        var html =
            '<div class="colorFieldWrapper"><div class="row"><div class="col-md-12"><div class="card card-outline-danger p-2"><div class="form-group row"><span class="label-text col-md-3 col-form-label">Color: </span><div class="col-md-9"><input class="form-control productColorList" name="productColor[0]" id="color_0" list="colors" placeholder="Please enter product color name"><datalist id="colors"><?php $sel_query=mysqli_query($conn,"SELECT color_name FROM `color_info`"); while($data=mysqli_fetch_assoc($sel_query)){?><option><?=$data['color_name']?></option><?php } ?></datalist></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Images: </span><div class="col-md-9"><input type="file" name="image[0][]" id="image0" onchange="return check(this.id)" multiple class="form-control" required><span class="help-block" id="erimage0">Image Dimension 510*600px & ( png, jpg ,jpeg )</span></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Sizes: </span><div class="col-md-9"><div class="row"><?php $sel_query=mysqli_query($conn,"SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=4");$random = 1; while($data=mysqli_fetch_assoc($sel_query)){ ?><div class="col-md-4"><div class="form-check-inline"><label class="form-check-label1"><input type="checkbox" class="form-check-input1 productSizeList" name="productSizes[0][]" id="productSizes_0_<?=$random?>" value="<?=$data['id'];?>@<?=$data['symbol'];?>" onchange="getSize(this,0)">&nbsp;&nbsp;<?=ucwords($data['symbol'])?></label></div></div><?php $random++; } ?></div</div> </div><div id="price0"></div> <!-- Price Input Added Here --></div></div> </div></div></div> <!-- Add Color --><div class="row pt-2"> <div class="col-12 text-right"> <a href="javascript:void(0);" class="addColor" title="Add Color" onclick="getColor();">&emsp;<span class="btn btn-success">ADD COLOR</span></a></div></div><!-- Add Color -->';

        $('.classtypeField').html(html);

    }

    function others() {
        var html =
            '<div class="colorFieldWrapper"><div class="row"><div class="col-md-12"><div class="card card-outline-danger p-2"><div class="form-group row"><span class="label-text col-md-3 col-form-label">Images: </span><div class="col-md-9"><input type="file" name="image[0][]" id="image0" onchange="return check(this.id)" multiple class="form-control" required><span class="help-block" id="erimage0">Image Dimension 510*600px & ( png, jpg ,jpeg )</span></div></div><hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label"> Price : </span><div class="col-md-9"><input type="text" name="price" class="form-control productPriceList" id="amount0" placeholder="Only Enter Rs" required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Discount Price: </span><div class="col-md-9"><input type="text" name="disc_price" onblur="check_amount(0)" class="form-control" id="disamount0" placeholder="Only Enter Rs"><span class="help-block" id="disam0"></span></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Stock: </span><div class="col-md-3"><select name="stock" id="stock0" class="form-control" onchange="setStock(0,this);"><option value="">Select Stock</option><option value="Yes">Yes</option><option value="No">No</option></select></div><div class="col-md-6" id="in_stock0"></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Min: </span><div class="col-md-3"><input type="number" name="min" class="form-control" min="1" placeholder="Please enter minimum quantity"></div><div class="col-md-6" id=""><div class="row"><span class="label-text col-md-6 col-form-label">Max: </span><div class="col-md-6"><input type="number" name="max" class="form-control" min="0" placeholder="Please enter maximum quantity"></div></div></div></div></div></div></div>';

        $('.classtypeField').html(html);

    }
    </script>

    <script type="text/javascript">
    $('#category').on("change", function() {
        var element = $(this).find('option:selected');
        var classType = element.attr("data-clastype");

        $('#classtype_id').val(classType);
        if (classType == 1) {
            clothing();
        }
        if (classType == 2) {
            weight();
        }
        if (classType == 3) {
            gadgets();
        }
        if (classType == 4) {
            shoe();
        }
        if (classType == 5) {
            others();
        }
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

    // $(document).ready(function(){
    //   alert('cgj');
    //    alert("hlw");

    // });
    </script>

    <?php include('includes/footer.php');
?>
    <script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
    <script>
    CKEDITOR.replace('editor', {
        toolbar: [{
                name: 'document',
                groups: ['mode', 'document', 'doctools'],
                items: ['Source', '-', 'Preview', '-', 'Templates']
            },
            {
                name: 'clipboard',
                groups: ['clipboard', 'undo'],
                items: ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo']
            },
            {
                name: 'editing',
                groups: ['find', 'selection', 'spellchecker'],
                items: ['Find', 'Replace', '-', 'SelectAll', '-', 'Scayt']
            },
            {
                name: 'forms',
                items: ['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button',
                    'ImageButton', 'HiddenField'
                ]
            },
            '/',
            {
                name: 'basicstyles',
                groups: ['basicstyles', 'cleanup'],
                items: ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-',
                    'RemoveFormat'
                ]
            },
            {
                name: 'paragraph',
                groups: ['list', 'indent', 'blocks', 'align', 'bidi'],
                items: ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote',
                    'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock',
                    '-', 'BidiLtr', 'BidiRtl', 'Language'
                ]
            },
            {
                name: 'links',
                items: ['Link', 'Unlink', 'Anchor']
            },
            {
                name: 'insert',
                items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe']
            },
            '/',
            {
                name: 'styles',
                items: ['Styles', 'Format', 'Font', 'FontSize']
            },
            {
                name: 'colors',
                items: ['TextColor', 'BGColor']
            },
            {
                name: 'tools',
                items: ['Maximize', 'ShowBlocks']
            },
            {
                name: 'others',
                items: ['-']
            },
            {
                name: 'about',
                items: ['About']
            }
        ]
    });
    </script>
    <?php

if(isset($_POST['submit']))
{
    echo '<pre>';
    print_r($_POST);
    print_r($_FILES);
    
    
    date_default_timezone_set("Asia/kolkata");
    $date=date("Y-m-d");
    $time=date("H:i:s");
    
    
    $groupCode = uniqid();

    $category=$_POST['category'];
    $subcategory='';
    if(isset($_POST['subcategory']))
    {
        $subcategory=$_POST['subcategory'];
    }
    $product=addslashes($_POST['product']);
    $sel_query=mysqli_query($conn,"SELECT * FROM `products` WHERE product_name='$product' AND cat_id='$category'");
    if(mysqli_num_rows($sel_query)>0)
    {
        echo '<div id="snackbar">This product is already added...</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo"var delay = 1000;setTimeout(function(){ window.location = 'add-products.php'; }, delay);";
        echo "</script>";

    }else{

       $w=1;
        //echo count($_POST['size']);
        if($_POST['classtype_id']==1 || $_POST['classtype_id']==3 || $_POST['classtype_id']==4)
        {
        foreach($_POST['productColor'] as $color){

            $key = array_search($color, $_POST['productColor']);


            $p_uniqu = uniqid();

            $i=0;
            foreach($_POST['productSizes'][$key] as $size){

                $new='No'; $hot='No'; $top='No'; $cod='No';

                $sizeInfo = explode("@",$size);

                if(isset($_POST['new']))
                    { $new = (isset($_POST['newArrivals'][$key][$sizeInfo[0]])) ? $_POST['newArrivals'][$key][$sizeInfo[0]] : "No"; }
                if(isset($_POST['hot']))
                    { $hot = (isset($_POST['hotDeals'][$key][$sizeInfo[0]])) ? $_POST['hotDeals'][$key][$sizeInfo[0]] : "No"; }
                if(isset($_POST['top']))
                    { $top = (isset($_POST['topFeatured'][$key][$sizeInfo[0]])) ? $_POST['topFeatured'][$key][$sizeInfo[0]] : "No"; }
                if(isset($_POST['cod']))
                    { $cod = (isset($_POST['codApplicable'][$key][$sizeInfo[0]])) ? $_POST['codApplicable'][$key][$sizeInfo[0]] : "No"; }

                $price = $_POST['price'][$key][$i];
                $disc_price = $_POST['disc_price'][$key][$i];

                $inStockQ = (isset($_POST['inStock'][$key][$i])) ? $_POST['inStock'][$key][$i] : 0;
                $stock = (isset($_POST['stock'][$key][$i])) ? $_POST['stock'][$key][$i] : NULL;

                $min = (isset($_POST['min'][$key][$i])) ? $_POST['min'][$key][$i] : 1;
                $max = (isset($_POST['max'][$key][$i])) ? $_POST['max'][$key][$i] : NULL;

                if($min == ""){
                    $min = 1;
                }
    /// If Discount Is NULL
                if($disc_price==""){
                    $disc_price =  $price;
                }

                $mySqlQuery = "INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`color_name`, `price`,`discount`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`in_stock`,`minimum`,`maximum`,`size`,`product_code`,`group_code`,`date`,`time`) VALUES "
                . "('$category','$subcategory','$product','".$color."','".$price."','".$disc_price."','$hot','$new','$top','$cod','$stock','$inStockQ','$min','$max','".$sizeInfo[0]."','".$p_uniqu."','".$groupCode."','$date','$time')";
                $query=mysqli_query($conn,$mySqlQuery)or die(mysqli_error());


                $sel_query=mysqli_query($conn,"SELECT MAX(id) as id FROM `products`");
                if(mysqli_num_rows($sel_query)>0)
                {
                    $vaar= mysqli_fetch_assoc($sel_query);
                    $lastProductID=$vaar['id'];

        /// Update Stock Record ///
                    $dquery=mysqli_query($conn,"INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`,`created_time`) VALUES ('$lastProductID','$inStockQ','Credit','$date','$time')")or die(mysqli_error());
        /// Update Stock Record ///
        //description
                    $description=$_POST['editor'];

        // exit();
                    $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('$category','$subcategory','$lastProductID','$description')")or die(mysqli_error());


                    $isMeta=$_POST['isMeta'];
                    if($isMeta=='Yes')
                    {
                        $meta=$_POST['meta'];
                        $keys=$_POST['key'];
                        $title=$_POST['title'];
                       $seopageQuery=mysqli_query($conn,"INSERT INTO seopages(page_name,pid,title,status) VALUES('product-detail','$lastProductID','$title','Active')");
                         $lastPageQuery=mysqli_query($conn,"SELECT MAX(id) as id FROM `seopages`");
                           if(mysqli_num_rows($lastPageQuery)>0)
                           {
                               $vaar1= mysqli_fetch_assoc($lastPageQuery);
                              $pageid=$vaar1['id'];
                           }

                           $metaTagQuery="INSERT INTO metatags(seo_id,meta,status) VALUES";
                                                   foreach($meta as $val)
                                                   {
                                                    $metaTagQuery.="(".$pageid.",'".$val."','Active'),";
                                                   }
                                                   $metaTagQuery=substr($metaTagQuery, 0,-1);
                                                   $query1=mysqli_query($conn,$metaTagQuery);

                         $metaKeywordQuery="INSERT INTO keywords(seo_id,keyword,status) VALUES";
                                                   foreach($keys as $val1)
                                                   {
                                                    $metaKeywordQuery.="(".$pageid.",'".$val1."','Active'),";
                                                   }
                                                   $metaKeywordQuery=substr($metaKeywordQuery, 0,-1);
                                                   $query1=mysqli_query($conn,$metaKeywordQuery);

                    }

                    $i++;

                }

            }

//images
            $image_name=($_FILES["image"]["name"][$key]);  
            $image_type=($_FILES["image"]["tmp_name"][$key]);  
            $i=0;
            foreach ($image_name as $imageKey => $value)
            {

// print_r($value);
                $mul_img=$_FILES["image"]["tmp_name"][$key][$i];
// print_r($_FILES["image"]["tmp_name"]);
// exit();

                $temp = explode(".", $value);
                $newfilename = $temp[0].round(microtime(true)). $i . '.' . end($temp);

                move_uploaded_file($mul_img,"../asset/image/product/".$newfilename);
                $test = getimagesize('../asset/image/product/'.$newfilename);
                $width = $test[0];
                $height = $test[1];
                $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('$category','$subcategory','$p_uniqu','$newfilename')")or die(mysqli_error());
                $i++;
            }

            $sel_query=mysqli_query($conn,"SELECT id FROM `color_info` WHERE color_name='$color'");
            if(mysqli_num_rows($sel_query)==0)
            {

                $insert=mysqli_query($conn,"INSERT INTO `color_info` (`color_name`) VALUES ('$color')")or die(mysqli_error());

            }

            




            $p_uniqu++;

        }
    }
    else if($_POST['classtype_id']==2)
    {
        $i=0;
        $key=0;
        $p_uniqu = uniqid();
            foreach($_POST['productWeight'][$key] as $size){

                $new='No'; $hot='No'; $top='No'; $cod='No';

                $sizeInfo = explode("@",$size);

                if(isset($_POST['new']))
                    { $new = (isset($_POST['newArrivals'][$sizeInfo[0]])) ? $_POST['newArrivals'][$sizeInfo[0]] : "No"; }
                if(isset($_POST['hot']))
                    { $hot = (isset($_POST['hotDeals'][$sizeInfo[0]])) ? $_POST['hotDeals'][$sizeInfo[0]] : "No"; }
                if(isset($_POST['top']))
                    { $top = (isset($_POST['topFeatured'][$sizeInfo[0]])) ? $_POST['topFeatured'][$sizeInfo[0]] : "No"; }
                if(isset($_POST['cod']))
                    { $cod = (isset($_POST['codApplicable'][$sizeInfo[0]])) ? $_POST['codApplicable'][$sizeInfo[0]] : "No"; }

                $price = $_POST['price'][$key][$i];
                $disc_price = $_POST['disc_price'][$key][$i];

                $inStockQ = (isset($_POST['inStock'][$key][$i])) ? $_POST['inStock'][$key][$i] : 0;
                $stock = (isset($_POST['stock'][$key][$i])) ? $_POST['stock'][$key][$i] : NULL;

                $min = (isset($_POST['min'][$key][$i])) ? $_POST['min'][$key][$i] : 1;
                $max = (isset($_POST['max'][$key][$i])) ? $_POST['max'][$key][$i] : NULL;

                if($min == ""){
                    $min = 1;
                }
    /// If Discount Is NULL
                if($disc_price==""){
                    $disc_price =  $price;
                }
                $color="";
                $mySqlQuery = "INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`color_name`, `price`,`discount`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`in_stock`,`minimum`,`maximum`,`size`,`product_code`,`group_code`,`date`,`time`) VALUES "
                . "('$category','$subcategory','$product','".$color."','".$price."','".$disc_price."','$hot','$new','$top','$cod','$stock','$inStockQ','$min','$max','".$sizeInfo[0]."','".$p_uniqu."','".$groupCode."','$date','$time')";
                $query=mysqli_query($conn,$mySqlQuery)or die(mysqli_error());


                $sel_query=mysqli_query($conn,"SELECT MAX(id) as id FROM `products`");
                if(mysqli_num_rows($sel_query)>0)
                {
                    $vaar= mysqli_fetch_assoc($sel_query);
                    $lastProductID=$vaar['id'];

        /// Update Stock Record ///
                    $dquery=mysqli_query($conn,"INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`,`created_time`) VALUES ('$lastProductID','$inStockQ','Credit','$date','$time')")or die(mysqli_error());
        /// Update Stock Record ///
        //description
                    $description=$_POST['editor'];

        // exit();
                    $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('$category','$subcategory','$lastProductID','$description')")or die(mysqli_error());


                    $isMeta=$_POST['isMeta'];
                    if($isMeta=='Yes')
                    {
                        $meta=$_POST['meta'];
                        $keys=$_POST['key'];
                        $title=$_POST['title'];
                       $seopageQuery=mysqli_query($conn,"INSERT INTO seopages(page_name,pid,title,status) VALUES('product-detail','$lastProductID','$title','Active')");
                         $lastPageQuery=mysqli_query($conn,"SELECT MAX(id) as id FROM `seopages`");
                           if(mysqli_num_rows($lastPageQuery)>0)
                           {
                               $vaar1= mysqli_fetch_assoc($lastPageQuery);
                              $pageid=$vaar1['id'];
                           }

                           $metaTagQuery="INSERT INTO metatags(seo_id,meta,status) VALUES";
                                                   foreach($meta as $val)
                                                   {
                                                    $metaTagQuery.="(".$pageid.",'".$val."','Active'),";
                                                   }
                                                   $metaTagQuery=substr($metaTagQuery, 0,-1);
                                                   $query1=mysqli_query($conn,$metaTagQuery);

                         $metaKeywordQuery="INSERT INTO keywords(seo_id,keyword,status) VALUES";
                                                   foreach($keys as $val1)
                                                   {
                                                    $metaKeywordQuery.="(".$pageid.",'".$val1."','Active'),";
                                                   }
                                                   $metaKeywordQuery=substr($metaKeywordQuery, 0,-1);
                                                   $query1=mysqli_query($conn,$metaKeywordQuery);

                    }

                    $i++;

                }

            }

//images
            $image_name=($_FILES["image"]["name"][$key]);  
            $image_type=($_FILES["image"]["tmp_name"][$key]);  
            $i=0;
            foreach ($image_name as $imageKey => $value)
            {

// print_r($value);
                $mul_img=$_FILES["image"]["tmp_name"][$key][$i];
// print_r($_FILES["image"]["tmp_name"]);
// exit();

                $temp = explode(".", $value);
                $newfilename = $temp[0].round(microtime(true)). $i . '.' . end($temp);

                move_uploaded_file($mul_img,"../asset/image/product/".$newfilename);
                $test = getimagesize('../asset/image/product/'.$newfilename);
                $width = $test[0];
                $height = $test[1];
                $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('$category','$subcategory','$p_uniqu','$newfilename')")or die(mysqli_error());
                $i++;
            }

    }
    else
    {

    }
        echo '<div id="snackbar">Product Added Sucessfully...</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo"var delay = 1000;setTimeout(function(){ window.location = 'view-all-products.php'; }, delay);";
        echo "</script>";
    }

} ?>