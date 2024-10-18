<?php include('includes/header.php');

$query = "SELECT p.*,c.cat_name,sc.sub_cat_name FROM products as p 
 LEFT JOIN category as c on c.id=p.cat_id and c.status = 'Active'
 LEFT JOIN subcategory as sc on sc.id=p.subcat_id and sc.status = 'Active'
 WHERE p.trash = 'No'  and p.id='" . $_REQUEST['id'] . "'";
$sql1 = mysqli_query($conn, $query);
if (mysqli_num_rows($sql1) > 0) {
    $roww = mysqli_fetch_assoc($sql1);
} else {
?>
    <script type="text/javascript">
        window.location.href = "view-all-products.php";
    </script>
<?php
}
$pid = $_REQUEST['id'];

$sdate = $stime = $edate = $etime = $dealstock = $deal_price = "";
$query1 = "SELECT * FROM today_deal WHERE pid=" . $_REQUEST['id'];
$sql2 = mysqli_query($conn, $query1);
if (mysqli_num_rows($sql2) > 0) {
    $roww1 = mysqli_fetch_assoc($sql2);
    $sdate     =  $roww1['startdate'];
    $stime     =  $roww1['starttime'];
    $edate     =  $roww1['enddate'];
    $etime     =  $roww1['endtime'];
    $dealstock =  $roww1['stock'];
    $deal_price =  $roww1['price'];
}
$issubcategory = mysqli_fetch_assoc(mysqli_query($conn, "SELECT c.issubcategory FROM category c  WHERE c.id=(SELECT cat_id FROM products WHERE id='" . $_REQUEST['id'] . "' GROUP BY group_code)"))['issubcategory'];
if ($issubcategory == 'Yes') {
    $classtype = json_decode(mysqli_fetch_assoc(mysqli_query($conn, "SELECT classtype_id FROM subcategory WHERE id=(SELECT subcat_id FROM products WHERE id='" . $_REQUEST['id'] . "' GROUP BY group_code)"))['classtype_id']);
} elseif ($issubcategory == 'No') {
    $classtype = json_decode(mysqli_fetch_assoc(mysqli_query($conn, "SELECT classtype_id FROM category WHERE id=(SELECT cat_id FROM products WHERE id='" . $_REQUEST['id'] . "' GROUP BY group_code)"))['classtype_id']);
}
$classtype1 = implode(", ", $classtype);
$c = 0;
if ($roww['class0'] != '') {
    $c++;
}
if ($roww['class1'] != '') {
    $c++;
}
if ($roww['class2'] != '') {
    $c++;
}
if ($roww['class3'] != '') {
    $c++;
}
$classtypeNameQuery = mysqli_query($conn, "SELECT id,name FROM classtype WHERE id IN($classtype1)");
while ($row = mysqli_fetch_array($classtypeNameQuery)) {
    $classtypeName[] = array('id' => $row['id'], 'name' => $row['name']);
}
if ($c == 2) {
    $secondaryClassName = $classtypeName[0]['name'];
    $primaryClassName = $classtypeName[1]['name'];
    if ($classtype[0] == $classtypeName[0]['id']) {
        $primaryClassName = $classtypeName[0]['name'];
        $secondaryClassName = $classtypeName[1]['name'];
    }
} elseif ($c == 1 || $classtype[0] != 16) {
    $primaryClassName = $classtypeName[0]['name'];
}
// exit();
?>
<style>
    .input-group-append span {
        margin: 10px 0 !important;
        padding: 2px 13px;
        font-size: 10px;
    }


    a.remove_button1 {
        background-color: #ff4040;
        color: white;
        padding: 5px 8px;
        font-size: 10px;
        border-radius: 25px;
    }

    span.fa.fa-trash {
        border: 1px solid #cccccc;
        padding: 5px;
        color: red;
        border-radius: 10px;
        background-color: beige;
    }

    .setsqnc span {
        border-radius: 10px;
    }

    .oorg {
        padding: 2px 14px;
        font-size: 10px;
        margin-top: 10px;
    }

    a.remove_button2 {
        background-color: #ff4040;
        color: white;
        padding: 5px 8px;
        font-size: 10px;
        border-radius: 25px;
    }
</style>
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

                                <input type="hidden" name="productId" value="<?= $roww['id']; ?>">
                                <input type="hidden" name="productCode" value="<?= $roww['product_code']; ?>">
                                <input type="hidden" name="groupCode" value="<?= $roww['group_code']; ?>">


                                <div class="form-group row">

                                    <span class="label-text col-md-3 col-form-label">Category: *</span>
                                    <div class="col-md-9">

                                        <input type="hidden" name="category" value="<?= $roww['cat_id']; ?>">
                                        <input type="text" name="categoryName" class="form-control"
                                            value="<?= $roww['cat_name']; ?>" readonly>

                                    </div>
                                </div>

                                <?php
                                if ($roww['subcat_id'] != "") {
                                ?>
                                    <div class="form-group row">

                                        <span class="label-text col-md-3 col-form-label">Sub Category: *</span>
                                        <div class="col-md-9">

                                            <input type="hidden" name="subcategory" value="<?= $roww['subcat_id']; ?>">
                                            <input type="text" name="subcategoryName" class="form-control"
                                                value="<?= $roww['sub_cat_name']; ?>" readonly>

                                        </div>
                                    </div>

                                <?php
                                }
                                ?>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Product Name: *</span>
                                    <div class="col-md-9">
                                        <input type="text" name="product" class="form-control" required
                                            placeholder="Enter Products Name" value="<?= $roww['product_name']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Product Brand: *</span>

                                    <div class="col-md-9">
                                        <input type="text" name="brand" class="form-control"
                                            value="<?php echo $roww['brand']; ?>">
                                    </div>
                                </div>
                                <div class="form-group row" id="TaxSection" style="background: ivory;padding: 15px;border: 1px solid #FF9800;border-radius: 10px;">
                                    <span class="label-text col-md-3 col-form-label">Tax Status</span>
                                    <div class="col-md-9">
                                        <input type="text" placeholder="0% to 100%" name="product_tax" value="<?= $roww['tax']; ?>" title="please input the desired percentage value for the tax. either enter 0 or leave it blank." class="form-control" style="border-color:gray;" pattern="^(?:\d{1,2}(?:\.\d{1,2})?|100(?:\.0{1,2})?)$" oninput="if (typeof this.reportValidity === 'function') {this.reportValidity();}">
                                        <span><b>NOTE: If the product is exempt from tax, please either enter "0" in the tax field or leave it blank. Otherwise, please input the desired percentage value for the tax.</b></span>
                                    </div>
                                </div>

                                <hr>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Image: </span>
                                    <div class="col-md-9" id="productImages">
                                        <!-- image sequence set -->
                                        <div class="setsqnc">
                                            <span><a href="set_sequence.php?pid=<?php echo $roww['product_code']; ?>">Set
                                                    Sequence</a></span>
                                        </div>
                                        <!-- end here -->
                                        <?php
                                        $sq_im = mysqli_query($conn, "select * from image where status='Active' AND p_id='" . $roww['product_code'] . "' ORDER BY set_seq ASC");
                                        while ($ro_im = mysqli_fetch_assoc($sq_im)) { ?>
                                            <span>
                                                <img src='../asset/image/product/<?= $ro_im['image']; ?>' width="100px"
                                                    style="border:1px solid">
                                                <span class="fa fa-trash"
                                                    onclick="remove_img('<?= $ro_im['id']; ?>','<?= $roww['product_code']; ?>')"
                                                    style="cursor:pointer"></span></span>
                                        <?php
                                        } ?>
                                    </div>

                                    <span class="label-text col-md-3 mt-2 col-form-label">Add Image: </span>
                                    <div class="col-md-9 mt-2">
                                        <input type="file" name="image[]" id="image" onchange="return check()" multiple class="form-control">
                                        <span class="help-block" id="erImage">Image Dimension Height: 1000px and Width: 1000px</span>
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
                                                        if ($.inArray(ext, ['png', 'jpg', 'jpeg', 'gif']) === -1) {
                                                            document.getElementById("image").value = "";
                                                            document.getElementById("erImage").innerHTML =
                                                                '<font color="red"><b>You are trying to upload files which not allowed ' +
                                                                "(" + file.name +
                                                                " is invalid). <br/>Please select 'png', 'jpg', 'gif' or 'jpeg' images.</b></font>";

                                                        } else {
                                                            $('#erImage').empty();
                                                            createReader(file, function(w, h) {
                                                                console.log(file.name + ' ' + w + ' ' + h);
                                                                if ((w != 1000) || (h != 1000)) {
                                                                    $('#erImage').empty();
                                                                    document.getElementById('image').value = "";
                                                                    document.getElementById("erImage").innerHTML = '<font color="red"><b>' +
                                                                        file.name +
                                                                        ' is not match with dimensions. <br/>Please Select Image of  Width: 1000px and Height: 1000px.</b></font>';

                                                                } else {
                                                                    document.getElementById("erImage").innerHTML = 'Image Dimension Height:' +
                                                                        h + 'px and Width: ' + w + 'px';
                                                                    //   document.getElementById('image').value = "";
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
                                            <option value="Yes" <?php if ($roww['stock'] == 'Yes') {
                                                                    echo "selected";
                                                                } ?>>Yes
                                            </option>
                                            <option value="No" <?php if ($roww['stock'] == 'No') {
                                                                    echo "selected";
                                                                } ?>>No
                                            </option>
                                        </select>

                                    </div>
                                </div>


                                <?php if ($c > 1) {
                                ?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label"><?= $primaryClassName; ?>: </span>

                                        <div class="col-md-9">
                                            <input class="form-control" name="productColor" id="color" list="colors"
                                                value="<?= $roww['class1']; ?>" placeholder="Please enter product color name"
                                                required>

                                            <datalist id="colors">
                                                <?php
                                                $sel_query = mysqli_query($conn, "SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=$classtype[0]");

                                                while ($data = mysqli_fetch_assoc($sel_query)) {
                                                ?>
                                                    <option><?= $data['name'] ?></option>
                                                <?php } ?>
                                            </datalist>
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    if ($roww['class1'] != '') { ?>
                                        <input class="form-control" type="hidden" name="productColor" id="color" list="colors"
                                            value="<?= $roww['class1']; ?>" required>

                                    <?php
                                    } else {
                                    ?>
                                        <input class="form-control" type="hidden" name="productColor" id="color" list="colors"
                                            value="<?= $roww['class0']; ?>" required>

                                <?php
                                    }
                                } ?>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Price: </span>

                                    <div class="col-md-9">
                                        <input class="form-control" name="productPrice" id="price"
                                            value="<?= $roww['price']; ?>" placeholder="Only Enter Rs" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Discount: </span>

                                    <div class="col-md-9">
                                        <input class="form-control" name="productDiscount" id="discount"
                                            value="<?= $roww['discount']; ?>" placeholder="Only Enter Rs">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Agent Commission (%): </span>

                                    <div class="col-md-9">
                                        <input class="form-control" name="userdisc" type="number"
                                            value="<?= $roww['userdisc']; ?>" placeholder="Only Enter Rs" max="100">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">In Stock: </span>

                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="in_stock" id="in_stock"
                                            value="<?= $roww['in_stock']; ?>" readonly>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Minimum: </span>

                                    <div class="col-md-9">
                                        <input type="number" class="form-control" min="1" name="minimum" id="minimum"
                                            value="<?= $roww['minimum']; ?>" placeholder="Please enter minimum quantity"
                                            required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Maximum: </span>

                                    <div class="col-md-9">
                                        <input type="number" class="form-control" min="1" name="maximum" id="maximum"
                                            value="<?= $roww['maximum']; ?>" placeholder="Please enter maximum quantity"
                                            required>
                                    </div>
                                </div>
                                <?php
                                $query = 'SELECT * FROM home WHERE id=3';
                                $homequery1 = mysqli_query($conn, $query);
                                $home = mysqli_fetch_assoc($homequery1);
                                ?>

                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product in
                                        <?= $home['name'] ?>: </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="productTop" class="" id="" value="Yes"
                                            <?php if ($roww['top'] == 'Yes') {
                                                echo 'checked';
                                            } ?>> Yes
                                    </div>
                                </div>
                                <?php
                                $query = 'SELECT * FROM home WHERE id=1';
                                $homequery1 = mysqli_query($conn, $query);
                                $home = mysqli_fetch_assoc($homequery1);
                                ?>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product in
                                        <?= $home['name'] ?>: </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="productNew" class="" id="" value="Yes"
                                            <?php if ($roww['new_arrivals'] == 'Yes') {
                                                echo 'checked';
                                            } ?>> Yes
                                    </div>
                                </div>
                                <?php
                                $query = 'SELECT * FROM home WHERE id=2';
                                $homequery1 = mysqli_query($conn, $query);
                                $home = mysqli_fetch_assoc($homequery1);
                                ?>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Show Product On Home Page
                                        <?= $home['name'] ?>: </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="productHot" class="" id="" value="Yes"
                                            <?php if ($roww['hot_deals'] == 'Yes') {
                                                echo 'checked';
                                            } ?>> Yes
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">COD Applicable: </span>
                                    <div class="col-md-9">
                                        <input type="checkbox" name="productCod" class="" id="" value="Yes"
                                            <?php if ($roww['cod'] == 'Yes') {
                                                echo 'checked';
                                            } ?>> Yes
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <!--<span class="label-text col-md-3 col-form-label">Add Deals: </span>-->
                                    <!--<div class="col-md-9">-->
                                    <!--  <input type="checkbox" name="todayDeal" class="" id="todayDealsApplicable" value="Yes" <?php if ($deal_price != '') {
                                                                                                                                        echo 'checked';
                                                                                                                                    } ?> onclick="getdeal(this.id);">  Yes-->
                                    <!--</div>-->
                                </div>
                                <div id="todaysdealdiv" <?php if ($deal_price == '') {
                                                            echo 'style="display:none;"';
                                                        } ?>>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Deal Start Date: </span>
                                        <div class="col-md-9">
                                            <input type="date" name="sdate" class="form-control dealdate" value="<?= $sdate; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Deal Start Time: </span>
                                        <div class="col-md-9">
                                            <input type="time" name="stime" class="form-control" value="<?= $stime; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Deal End Date: </span>
                                        <div class="col-md-9">
                                            <input type="date" name="edate" class="form-control dealdate" value="<?= $edate; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Deal End Time: </span>
                                        <div class="col-md-9">
                                            <input type="time" name="etime" class="form-control" value="<?= $etime; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Deal Stock: </span>
                                        <div class="col-md-9">
                                            <input type="text" name="dealstock" id="dealstock" class="form-control" pattern="[1-9][0-9]*" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="20" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"
                                                value="<?= $dealstock; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Deal Price: </span>
                                        <div class="col-md-9">
                                            <input type="text" name="deal_price" class="form-control" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"
                                                value="<?= $deal_price; ?>" id="dealamount" onblur="check_dealamount()">
                                            <span class="help-block" id="dealam"></span>
                                        </div>
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
                                        <div class="col-12">
                                            <div class="field_wrapper form-group">
                                                <div class="input-group">
                                                    <?php
                                                    $i = 1;
                                                    $sql_dd = mysqli_query($conn, "select * from description where p_id='" . $roww['id'] . "'");
                                                    if (mysqli_num_rows($sql_dd) > 0) {

                                                        $row_dd = mysqli_fetch_assoc($sql_dd);
                                                    ?>
                                                        <textarea class="form-control" id="editor" name="description"
                                                            required=""><?= $row_dd['description'] ?></textarea>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="input_wrap">
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Specification: </span>
                                        <div class="col-12">
                                            <div class="field_wrapper form-group">
                                                <div class="input-group">
                                                    <?php
                                                    $i = 1;
                                                    $sql_dd = mysqli_query($conn, "select * from specification where p_id='" . $roww['id'] . "'");
                                                    if (mysqli_num_rows($sql_dd) > 0) {

                                                        $row_dd = mysqli_fetch_assoc($sql_dd);
                                                    ?>
                                                        <textarea class="form-control" id="specification" name="specification"
                                                            required=""><?= $row_dd['specification'] ?></textarea>
                                                    <?php
                                                    } else { ?>
                                                        <textarea class="form-control" id="specification" name="specification"
                                                            required=""></textarea>
                                                   <?php } 
                                                    ?>
                                                </div>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php
                                $pid = $roww['id'];
                                $query1 = mysqli_query($conn, "SELECT id,title FROM seopages WHERE page_name='product-detail' AND pid=$pid AND status='Active' ORDER BY id DESC");
                                if (mysqli_num_rows($query1) > 0) {
                                    $row_title = mysqli_fetch_assoc($query1);
                                    $title = $row_title['title'];
                                    $pageid = $row_title['id'];
                                ?>

                                <?php
                                } else {
                                ?>
                                    <div class="form-group row" id="metaList">
                                        <span class="label-text col-md-3 col-form-label">Want To Add Meta Content: </span>
                                        <div class="col-md-9">
                                            <input type="radio" name="isMeta" class="isMeta" id="addMeta2" value="Yes"
                                                onclick="getMetalist(this.value);"> Now
                                            <input type="radio" name="isMeta" class="isMeta" id="addMeta1" value="No"
                                                checked onclick="getMetalist(this.value);"> Later
                                        </div>
                                    </div>
                                <?php

                                } ?>

                                <!-- <div id="metaList"></div> -->


                                <div class="metaFieldWrapper">

                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="card card-outline-danger p-2">
                                                <div class="form-group row">
                                                    <span class="label-text col-md-3 col-form-label">Meta Title: </span>
                                                    <div class="col-md-9">
                                                        <input type="text" name="title" id="metatitle"
                                                            value="<?php if (!empty($title)) {
                                                                        echo $title;
                                                                    } ?>"
                                                            class="form-control">
                                                    </div>
                                                </div>
                                                <br>
                                                <?php
                                                if (mysqli_num_rows($query1) > 0) {
                                                    $cn = 1;
                                                    $i = 0;
                                                    $query2 = mysqli_query($conn, "SELECT * FROM `metatags` WHERE seo_id=$pageid");
                                                    if (mysqli_num_rows($query2) > 0) { ?>
                                                        <div class="form-group">
                                                            <div class="form-group row">
                                                                <span class="label-text col-md-3 col-form-label">Meta Tags:
                                                                </span>
                                                                <div class="col-md-9 field_wrapper1">

                                                                    <?php
                                                                    while ($data2 = mysqli_fetch_array($query2)) { ?>

                                                                        <input type="text" id="in<?= $data2['id']; ?>"
                                                                            name="ex_meta[<?= $data2['id']; ?>]"
                                                                            value="<?php if (isset($_POST['meta'][$i])) {
                                                                                        echo $_POST['meta'][$i];
                                                                                    } else {
                                                                                        echo $data2['meta'];
                                                                                    } ?>"
                                                                            class="form-control" />
                                                                        <div class="input-group-append" id="btn<?= $data2['id']; ?>">
                                                                            <span class="btn btn-danger"
                                                                                onclick="remove('<?= $data2['id']; ?>')">Remove</span>
                                                                        </div>
                                                                        <script>
                                                                            function remove(val) {
                                                                                var x = confirm(
                                                                                    'Are you sure to delete this Meta Tags');
                                                                                if (x == true) {
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "remove-metatags.php",
                                                                                        data: 'id=' + val,
                                                                                        success: function(data) {
                                                                                            if (data == 1)

                                                                                                $("#in" + val).remove();
                                                                                            $("#btn" + val).remove();
                                                                                        }
                                                                                    })

                                                                                }
                                                                            }
                                                                        </script>

                                                                        <?php
                                                                        if ($cn == mysqli_num_rows($query1)) { ?>
                                                                            <div class="row pt-2">
                                                                                <div class="col-12 text-right">
                                                                                    <a href="javascript:void(0);" class="addMetatags"
                                                                                        title="Add METATAGS">&emsp;<span
                                                                                            class="btn btn-success">ADD META
                                                                                            TAGS</span></a>
                                                                                </div>
                                                                            </div>
                                                                    <?php
                                                                        }

                                                                        $cn++;
                                                                        $i++;
                                                                    }
                                                                    ?>
                                                                    <br />


                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } else { ?>
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
                                                    <?php
                                                    }
                                                } else { ?>
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
                                                <?php
                                                } ?>
                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        var maxField1 = 10; //Input fields increment limitation
                                                        var addButton1 = $('.addMetatags'); //Add button selector
                                                        var wrapper1 = $('.field_wrapper1'); //Input field wrapper
                                                        //New input field html 
                                                        var x = 1; //Initial field counter is 1

                                                        //Once add button is clicked
                                                        $(addButton1).click(function() {
                                                            //Check maximum number of input fields
                                                            if (x < maxField1) {
                                                                x++; //Increment field counter
                                                                var fieldHTML1 =
                                                                    '<div id="meta_' + x + '"><input type="text" name="meta[]" value="" class="form-control"/><a href="javascript:void(0);" class="remove_button1">Remove</a><br></div>';
                                                                $(wrapper1).append(
                                                                    fieldHTML1);
                                                                $('html, body').animate({
                                                                    scrollTop: $('#meta_' + x).offset().top
                                                                }, 1000); //Add field html
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
                                                <?php
                                                if (mysqli_num_rows($query1) > 0) {
                                                    $cn = 1;
                                                    $i = 0;
                                                    $query3 = mysqli_query($conn, "SELECT * FROM `keywords` WHERE seo_id=$pageid");
                                                    if (mysqli_num_rows($query3) > 0) { ?>
                                                        <div class="form-group">
                                                            <div class="form-group row">
                                                                <span class="label-text col-md-3 col-form-label">Meta Keywords:
                                                                </span>
                                                                <div class="col-md-9 field_wrapper2">

                                                                    <?php
                                                                    while ($data3 = mysqli_fetch_array($query3)) { ?>

                                                                        <input type="text" id="key<?= $data3['id']; ?>"
                                                                            name="ex_key[<?= $data3['id']; ?>]"
                                                                            value="<?php if (isset($_POST['key'][$i])) {
                                                                                        echo $_POST['key'][$i];
                                                                                    } else {
                                                                                        echo $data3['keyword'];
                                                                                    } ?>"
                                                                            class="form-control" />
                                                                        <span class="btn btn-danger oorg" id="btnKey<?= $data3['id']; ?>"
                                                                            onclick="rem('<?= $data3['id']; ?>')">Remove</span>
                                                                        <script>
                                                                            function rem(val) {
                                                                                var x = confirm(
                                                                                    'Are you sure to delete this Meta Keywords');
                                                                                if (x == true) {
                                                                                    $.ajax({
                                                                                        type: "POST",
                                                                                        url: "remove-metakey.php",
                                                                                        data: 'id=' + val,
                                                                                        success: function(data) {
                                                                                            if (data == 1)

                                                                                                $("#key" + val).remove();
                                                                                            $("#btnKey" + val).remove();
                                                                                        }
                                                                                    })

                                                                                }
                                                                            }
                                                                        </script>

                                                                        <?php
                                                                        if ($cn == mysqli_num_rows($query1)) { ?>
                                                                            <div class="row pt-2">
                                                                                <div class="col-12 text-right">
                                                                                    <a href="javascript:void(0);" class="addMetaKey"
                                                                                        title="Add METAKEYWORDS">&emsp;<span
                                                                                            class="btn btn-success">ADD META
                                                                                            KEYWORDS</span></a>
                                                                                </div>
                                                                            </div>
                                                                    <?php
                                                                        }

                                                                        $cn++;
                                                                        $i++;
                                                                    }
                                                                    ?>
                                                                    <br />


                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php
                                                    } else { ?>
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
                                                    <?php
                                                    }
                                                } else { ?>
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
                                                <?php
                                                } ?>

                                                <script type="text/javascript">
                                                    $(document).ready(function() {
                                                        var maxField2 = 10; //Input fields increment limitation
                                                        var addButton2 = $('.addMetaKey'); //Add button selector
                                                        var wrapper2 = $('.field_wrapper2'); //Input field wrapper
                                                        //New input field html 
                                                        var x = 1; //Initial field counter is 1

                                                        //Once add button is clicked
                                                        $(addButton2).click(function() {
                                                            //Check maximum number of input fields
                                                            if (x < maxField2) {
                                                                x++; //Increment field counter
                                                                var fieldHTML2 =
                                                                    '<div id="key_' + x + '"><input type="text" name="key[]" value="" class="form-control"/><a href="javascript:void(0);" class="remove_button2">Remove</a><br></div>';
                                                                $(wrapper2).append(
                                                                    fieldHTML2);
                                                                //Add field html
                                                                $('html, body').animate({
                                                                    scrollTop: $('#key_' + x).offset().top
                                                                }, 1000);
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

                                <div class="row m-3">
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
    <div id="alertStatus"></div>

    <script type="text/javascript">
        function getMetalist(checkedId) {

            // // console.log(checkedId);
            if (checkedId == 'Yes') {
                $('.metaFieldWrapper').show();

            } else {
                $('.metaFieldWrapper').hide();

            }

        }
        if ($(".isMeta:checked ").val() == 'No')
            $('.metaFieldWrapper').hide();
        else
            $('.metaFieldWrapper').show();


        function check_dealamount() {
            var price = document.getElementById('price').value;
            var discount = document.getElementById('dealamount').value;
            console.log(price);
            console.log(discount);
            // console.log(discount > price);
            if (discount !== '') {
                if (Number(discount) > Number(price)) {
                    document.getElementById('dealam').innerHTML =
                        '<font color="red">Deal price should be less than actual price</font>';
                    document.getElementById('sub').disabled = true;
                    setTimeout(fade_out, 4000);

                    function fade_out() {
                        $("#disam").innerHTML = '';
                    }
                } else {
                    document.getElementById('dealam').innerHTML = '';
                    document.getElementById('sub').disabled = false;
                }
            }
            if (price === '') {
                document.getElementById('dealam').innerHTML = '<font color="red">Please fill the price</font>';
                document.getElementById('dealamount').value = '';
                setTimeout(fade_out, 4000);

                function fade_out() {
                    $("#dealam").innerHTML = '';
                }
            }
        }


        function remove_img(id, productCode) {
            console.log(id, productCode);
            var x = confirm('Are You Sure To Remove This image');
            if (x == true) {
                $.ajax({
                    url: "ajax/remove-image.php",
                    type: "POST",
                    data: {
                        id: id,
                        productCode: productCode
                    },
                    success: function(data) {
                        data = JSON.parse(data);
                        console.log(data);
                        $("#alertStatus").html(data.result);
                        if (data.status == 'success') {
                            $('#productImages').html(data.imageData);
                        }
                    }
                });
            }
        }




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
        CKEDITOR.replace('specification', {
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
        if ($('#todayDealsApplicable').is(':checked')) {
            if ($('input[name=sdate]').val() != '') {
                $('input[name=edate]').attr('required', true);

                $('input[name=stime]').attr('required', true);

                $('input[name=etime]').attr('required', true);
                $('input[name=dealstock]').attr('required', true);
                $('input[name=deal_price]').attr('required', true);
            } else if ($('input[name=edate]').val() != '') {
                $('input[name=sdate]').attr('required', true);

                $('input[name=stime]').attr('required', true);

                $('input[name=etime]').attr('required', true);
                $('input[name=dealstock]').attr('required', true);
                $('input[name=deal_price]').attr('required', true);
            } else if ($('input[name=dealstock]').val() != '') {
                $('input[name=edate]').attr('required', true);

                $('input[name=stime]').attr('required', true);

                $('input[name=etime]').attr('required', true);
                $('input[name=sdate]').attr('required', true);
                $('input[name=deal_price]').attr('required', true);
            } else if ($('input[name=deal_price]').val() != '') {
                $('input[name=edate]').attr('required', true);

                $('input[name=stime]').attr('required', true);

                $('input[name=etime]').attr('required', true);
                $('input[name=sdate]').attr('required', true);
                $('input[name=dealstock]').attr('required', true);
            }

        }


        $(document).on('focusout', '.dealdate', function() {
            console.log($('input[name=sdate]').val());
            if ($('input[name=sdate]').val() != '') {
                $('input[name=edate]').attr('required', true);

                $('input[name=stime]').attr('required', true);

                $('input[name=etime]').attr('required', true);
                $('input[name=dealstock]').attr('required', true);
                $('input[name=deal_price]').attr('required', true);
            } else if ($('input[name=edate]').val() != '') {
                $('input[name=sdate]').attr('required', true);

                $('input[name=stime]').attr('required', true);

                $('input[name=etime]').attr('required', true);
                $('input[name=dealstock]').attr('required', true);
                $('input[name=deal_price]').attr('required', true);
            } else if ($('input[name=edate]').val() == '' && $('#dealstock').val() == '' && $('#dealamount').val() == '') {
                $('input[name=edate]').removeAttr('required');

                $('input[name=sdate]').removeAttr('required');
                $('input[name=stime]').removeAttr('required');

                $('input[name=etime]').removeAttr('required');
                $('input[name=dealstock]').removeAttr('required');
                $('input[name=deal_price]').removeAttr('required');
            } else if ($('input[name=sdate]').val() == '' && $('#dealstock').val() == '' && $('#dealamount').val() == '') {
                $('input[name=edate]').removeAttr('required');

                $('input[name=sdate]').removeAttr('required');
                $('input[name=stime]').removeAttr('required');

                $('input[name=etime]').removeAttr('required');
                $('input[name=dealstock]').removeAttr('required');
                $('input[name=deal_price]').removeAttr('required');
            }


        });
        $(document).on('focusout', '#dealamount', function() {
            console.log($('input[name=sdate]').val());
            if ($('#dealamount').val() != '') {
                $('input[name=edate]').attr('required', true);

                $('input[name=stime]').attr('required', true);

                $('input[name=etime]').attr('required', true);
                $('input[name=dealstock]').attr('required', true);
                $('input[name=sdate]').attr('required', true);
            } else if ($('input[name=edate]').val() == '' && $('input[name=sdate]').val() == '' && $('#dealamount').val() == '') {
                $('input[name=edate]').removeAttr('required');

                $('input[name=sdate]').removeAttr('required');
                $('input[name=stime]').removeAttr('required');

                $('input[name=etime]').removeAttr('required');
                $('input[name=dealstock]').removeAttr('required');
                $('input[name=deal_price]').removeAttr('required');
            }

        });
        $(document).on('focusout', '#dealstock', function() {
            console.log($('input[name=sdate]').val());
            if ($('#dealstock').val() != '') {
                $('input[name=edate]').attr('required', true);

                $('input[name=stime]').attr('required', true);

                $('input[name=etime]').attr('required', true);
                $('input[name=deal_price]').attr('required', true);
                $('input[name=sdate]').attr('required', true);
            } else if ($('input[name=sdate]').val() == '' && $('input[name=edate]').val() == '' && $('#dealamount').val() == '') {
                $('input[name=edate]').removeAttr('required');

                $('input[name=sdate]').removeAttr('required');
                $('input[name=stime]').removeAttr('required');

                $('input[name=etime]').removeAttr('required');
                $('input[name=dealstock]').removeAttr('required');
                $('input[name=deal_price]').removeAttr('required');
            }


        });


        function getdeal(id) {
            if ($('#' + id).is(':checked')) {
                $('#todaysdealdiv').show();
                $('input[name=edate]').attr('required', true);
                $('input[name=sdate]').attr('required', true);

                $('input[name=stime]').attr('required', true);

                $('input[name=etime]').attr('required', true);
                $('input[name=dealstock]').attr('required', true);
                $('input[name=deal_price]').attr('required', true);
            } else {
                $('#todaysdealdiv').hide();
                $('input[name=edate]').removeAttr('required');
                $('input[name=sdate]').removeAttr('required');

                $('input[name=stime]').removeAttr('required');

                $('input[name=etime]').removeAttr('required');
                $('input[name=dealstock]').removeAttr('required');
                $('input[name=deal_price]').removeAttr('required');
            }
        }
    </script>

    <?php



    if (isset($_POST['submit'])) {
        // echo '<pre>';
        // print_r($_POST);
        //  print_r($_FILES);
        //exit();
        date_default_timezone_set("Asia/kolkata");
        $date = date("Y-m-d");
        $time = date("H:i:s");





        $new = 'No';
        $hot = 'No';
        $top = 'No';
        $cod = 'No';
        $deal = 'No';

        $productCode = $_POST['productCode'];
        $groupCode = $_POST['groupCode'];
        $brand = $_POST['brand'];
        $productId = $_POST['productId'];
        $disc_price = $_POST['productDiscount'];

        $userdisc = $_POST['userdisc'];

        $product = addslashes($_POST['product']);
        $product_tax = (isset($_POST['product_tax'])) ? $_POST['product_tax'] : 0;

        if (isset($_POST['productNew'])) {
            $new = $_POST['productNew'];
        }
        if (isset($_POST['productHot'])) {
            $hot = $_POST['productHot'];
        }
        if (isset($_POST['productTop'])) {
            $top = $_POST['productTop'];
        }
        if (isset($_POST['productCod'])) {
            $cod = $_POST['productCod'];
        }
        if (isset($_POST['todayDeal'])) {
            $deal = 'Yes';
        }

        $sel_query = mysqli_query($conn, "SELECT * FROM `products` WHERE product_name='" . $product . "' AND class1='" . $_POST['productColor'] . "' AND class0='" . $roww['class0'] . "' AND cat_id='" . $roww['cat_id'] . "' AND id!=$productId AND trash != 'Yes'");
        if (mysqli_num_rows($sel_query) > 0) {
            //echo "<script>";
            echo '<div id="snackbar">This Product is already added..</div>';
            echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
        } else {
            $color = "";
            if ($c > 1) {
                $color = $_POST['productColor'];
            }
            if ($disc_price == "") {
                $disc_price = 0;
            }
            if ($userdisc == "") {
                $userdisc = 0;
            }


            $query = "UPDATE products
                SET product_name= '" . $product . "',
                tax='" . $product_tax . "',
                class1= '" . $color . "',
                price= '" . $_POST['productPrice'] . "',
                brand= '" . $_POST['brand'] . "',
                discount= '" . $disc_price . "',
                userdisc= '" . $userdisc . "',
                maximum= '" . $_POST['maximum'] . "',
                minimum= '" . $_POST['minimum'] . "',
                hot_deals= '$hot',
                new_arrivals= '$new',
                top= '$top',
                cod= '$cod',
                stock= '" . $_POST['stock'] . "',
                date= '$date',
                time= '$time'
                WHERE id = '" . $productId . "';";
            // echo $query;
            // exit();
            $up = mysqli_query($conn, $query);


            //description

            $description = $_POST['description'];

            $query = "UPDATE description SET description= '" . $description . "' WHERE p_id = '" . $productId . "';";

            $dquery = mysqli_query($conn, $query);
            // Specification
            $specification = $_POST['specification'];
            $queryselect = "SELECT * FROM specification WHERE p_id = '" . $productId . "';";
            $queryselect1 = mysqli_query($conn, $queryselect);
            if (mysqli_num_rows($queryselect1) > 0) {
                $queryspec = "UPDATE specification SET specification= '" . $specification . "' WHERE p_id = '" . $productId . "';";
                $queryspec1 = mysqli_query($conn, $queryspec);
            } else {
                $queryspec = "INSERT INTO `specification` (`cat_id`, `subcat_id`, `p_id`, `specification`) VALUES ('" . $roww['cat_id'] . "', '" . $roww['subcat_id'] . "', '$productId', '$specification')";
                $queryspec1 = mysqli_query($conn, $queryspec);
            }

            if (mysqli_num_rows($sql2) > 0) {
                if ($deal == 'Yes') {
                    $query5 = "UPDATE today_deal
    SET startdate= '" . $_POST['sdate'] . "',starttime= '" . $_POST['stime'] . "',enddate= '" . $_POST['edate'] . "',endtime= '" . $_POST['etime'] . "',stock= '" . $_POST['dealstock'] . "',price= '" . $_POST['deal_price'] . "' WHERE pid= " . $productId;

                    $dealquery = mysqli_query($conn, $query5);
                } else {
                    $query5 = "DELETE FROM today_deal WHERE pid= " . $productId;
                    $dealquery = mysqli_query($conn, $query5);
                }
            } else {
                if ($deal == 'Yes') {
                    $dealquery = mysqli_query($conn, "INSERT INTO `today_deal`(`pid`, `startdate`, `starttime`, `enddate`,`endtime`, `stock`,`price`) VALUES ('$productId','" . $_POST['sdate'] . "','" . $_POST['stime'] . "','" . $_POST['edate'] . "','" . $_POST['etime'] . "','" . $_POST['dealstock'] . "','" . $_POST['deal_price'] . "')") or die(mysqli_error());
                }
            }
            // exit();
            //seopage
            //print_r($_POST);
            if (isset($_POST['isMeta'])) {

                if ($_POST['isMeta'] == 'Yes') {

                    $meta = $_POST['meta'];
                    $keys = $_POST['key'];
                    $title = $_POST['title'];
                    $seopageQuery = mysqli_query($conn, "INSERT INTO seopages(page_name,pid,title,status) VALUES('product-detail','$productId','$title','Active')");
                    $lastPageQuery = mysqli_query($conn, "SELECT MAX(id) as id FROM `seopages`");
                    if (mysqli_num_rows($lastPageQuery) > 0) {
                        $vaar1 = mysqli_fetch_assoc($lastPageQuery);
                        $pageid = $vaar1['id'];
                    }

                    $metaTagQuery = "INSERT INTO metatags(seo_id,meta,status) VALUES";
                    foreach ($meta as $val) {
                        $metaTagQuery .= "(" . $pageid . ",'" . $val . "','Active'),";
                    }
                    $metaTagQuery = substr($metaTagQuery, 0, -1);
                    $query1 = mysqli_query($conn, $metaTagQuery);

                    $metaKeywordQuery = "INSERT INTO keywords(pid,seo_id,keyword,status) VALUES";
                    foreach ($keys as $val1) {
                        $metaKeywordQuery .= "('" . $_GET['id'] . "'," . $pageid . ",'" . $val1 . "','Active'),";
                    }
                    $metaKeywordQuery = substr($metaKeywordQuery, 0, -1);
                    $query1 = mysqli_query($conn, $metaKeywordQuery);
                    echo $metaKeywordQuery;
                }
            } else {
                $query1 = mysqli_query($conn, "SELECT id,title FROM seopages WHERE page_name='product-detail' AND pid=$pid AND status='Active'");
                if (mysqli_num_rows($query1) > 0) {
                    $row_title = mysqli_fetch_assoc($query1);
                    $pageid = $row_title['id'];
                    $query5 = mysqli_query($conn, "UPDATE  `seopages` SET title='$title' WHERE id=$pageid AND pid=$productId");
                    if ($query5) {



                        if (isset($_POST['meta']) && !empty($_POST['meta'])) {
                            $meta = $_POST['meta'];
                            $metaTagQuery = "INSERT INTO metatags(seo_id,meta,status) VALUES";
                            foreach ($meta as $val) {
                                $metaTagQuery .= "(" . $pageid . ",'" . $val . "','Active'),";
                            }
                            $metaTagQuery = substr($metaTagQuery, 0, -1);
                            $query1 = mysqli_query($conn, $metaTagQuery);
                        }
                        if (isset($_POST['ex_meta']) && !empty($_POST['ex_meta'])) {
                            $UpdateMeta = $_POST['ex_meta'];
                            foreach ($UpdateMeta as $key => $update) {
                                $updateMetaQuery = mysqli_query($conn, "UPDATE metatags SET meta='$update' WHERE id='$key' AND seo_id='$pageid'");
                            }
                        }

                        if (isset($_POST['key']) && !empty($_POST['key'])) {
                            $keys = $_POST['key'];
                            $metaKeywordQuery = "INSERT INTO keywords(seo_id,keyword,status) VALUES";
                            foreach ($keys as $val1) {
                                $metaKeywordQuery .= "(" . $pageid . ",'" . $val1 . "','Active'),";
                            }
                            $metaKeywordQuery = substr($metaKeywordQuery, 0, -1);
                            $query1 = mysqli_query($conn, $metaKeywordQuery);
                        }

                        if (isset($_POST['ex_key']) && !empty($_POST['ex_key'])) {
                            $UpdateMetaKey = $_POST['ex_key'];
                            foreach ($UpdateMetaKey as $key1 => $update1) {
                                $updateMetaQuery = mysqli_query($conn, "UPDATE keywords SET keyword='$update1' WHERE id='$key1' AND seo_id='$pageid'");
                            }
                        }
                    }
                }
            }



            //images
            $image_name = ($_FILES["image"]["name"]);
            // print_r($image_name);
            // exit();


            //images
            // echo '<pre>';
            // print_r($_FILES);
            // exit();

            if ((isset($_FILES["image"])) && ($_FILES["image"]["name"][0] != "")) {
                echo 'imaefkld';
                $image_name = ($_FILES["image"]["name"]);
                $image_type = ($_FILES["image"]["tmp_name"]);
                $ik = 0;
                foreach ($image_name as $value) {
                    $mul_img = $_FILES["image"]["tmp_name"][$ik];

                    $temp = explode(".", $value);
                    $newfilename = round(microtime(true)) . $ik . '.' . end($temp);

                    move_uploaded_file($mul_img, "../asset/image/product/" . $newfilename);
                    $test = getimagesize('../asset/image/product/' . $newfilename);
                    $width = $test[0];
                    $height = $test[1];

                    $last_seq = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM image WHERE p_id  = '$productCode' ORDER BY set_seq DESC"));
                    $set_seq =  $last_seq['set_seq'] + 1;
                    $iquery = mysqli_query($conn, "INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`, `set_seq`) VALUES ('" . $_POST['category'] . "','" . $_POST['subcategory'] . "','$productCode','$newfilename', '$set_seq')") or die(mysqli_error());
                    $ik++;
                }
            }

            echo '<div id="snackbar">Product Updated Sucessfully...</div>';
            echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
            echo "var delay = 1000;setTimeout(function(){ window.location = 'edit_product.php?id=" . $productId . "'; }, delay);";
            echo "</script>";
        }
    } ?>