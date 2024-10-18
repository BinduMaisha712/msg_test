<?php
include('config/connection.php');
$classtype = json_decode($_POST['classtype']);
$index = $_POST['index'];
$classtypeName = array();
if ($classtype[0] == 16) { ?>
    <div class="colorFieldWrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline-danger p-2">
                    <div class="form-group row"><span class="label-text col-md-3 col-form-label">Images: </span>
                        <div class="col-md-9"><input type="file" name="image[<?= $index ?>][]" id="image<?= $index ?>" 
                        onchange="check(this.id)"  multiple class="form-control" required><span
                                class="help-block" id="erimage<?= $index ?>">Image Dimension 1000*1000px & ( png, jpg ,jpeg
                                )</span>
                                <div id="imagePreview"></div></div>
                    </div>
                    <hr />
                    <div class="form-group row"><span class="label-text col-md-3 col-form-label"> Price : </span>
                        <div class="col-md-9"><input type="text" name="price" class="form-control productPriceList"
                                id="amount_0" placeholder="Only Enter Rs" required></div>
                    </div>
                    <div class="form-group row"><span class="label-text col-md-3 col-form-label">Discount Price: </span>
                        <div class="col-md-9"><input type="text" name="disc_price" onblur="check_amount(<?= $index ?>)"
                                class="form-control" id="disamount_0" placeholder="Only Enter Rs"><span class="help-block"
                                id="disam_<?= $index ?>"></span></div>
                    </div>
                    <div class="form-group row"><span class="label-text col-md-3 col-form-label">Stock: </span>
                        <div class="col-md-3"><select name="stock" id="stock0" class="form-control"
                                onchange="setStock(0,this);" required>
                                <option value="">Select Stock</option>
                                <option value="Yes">Yes</option>
                                <option value="No">No</option>
                            </select></div>
                        <div class="col-md-6" id="in_stock0"></div>
                    </div>
                    <div class="form-group row"><span class="label-text col-md-3 col-form-label">Min: </span>
                        <div class="col-md-3"><input type="number" name="min" class="form-control" min="1"
                                placeholder="Please enter minimum quantity" required></div>
                        <div class="col-md-6" id="">
                            <div class="row"><span class="label-text col-md-6 col-form-label" >Max: </span>
                                <div class="col-md-6"><input type="number" name="max" class="form-control" min="0"
                                        placeholder="Please enter maximum quantity" required></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
} else if (count($classtype) == 1 && $classtype[0] != 16) {
    $classtype1 = implode(", ", $classtype);
    $classtypeNameQuery = mysqli_query($conn, "SELECT id,name FROM classtype WHERE id IN($classtype1)");
    while ($row = mysqli_fetch_array($classtypeNameQuery)) {
        $classtypeName[] = array('id' => $row['id'], 'name' => $row['name']);
    }

    ?>
            <div class="colorFieldWrapper" id="div_<?= $index ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline-danger p-2">
                            <div class="form-group row"><span class="label-text col-md-3 col-form-label">
                                <?= $classtypeName[0]['name'] ?>:
                                </span>
                                <div class="col-md-9">
                                    <div class="row">
                                    <?php $sel_query = mysqli_query($conn, "SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=$classtype[0]");
                                    $random = 1;
                                    if(mysqli_num_rows($sel_query)>1)
                                    {
                                    while ($data = mysqli_fetch_assoc($sel_query)) { ?>
                                            <div class="col-md-4">
                                                <div class="form-check-inline"><label class="form-check-label1"><input
                                                            type="checkbox" required class="form-check-input1 productSizeList productSizes<?= $index ?>"
                                                            name="productSizes[<?= $index ?>][]"
                                                            id="productSizes_<?= $index ?>_<?= $random ?>"
                                                            value="<?= $data['id']; ?>@<?= $data['symbol']; ?>"
                                                            onchange="getSize(this,<?= $index ?>);getDeal(this,<?= $index ?>,<?= $random ?>)">&nbsp;&nbsp;<?= ucwords($data['symbol']) ?></label>
                                                </div>
                                            </div>
                                        <?php $random++;
                                    }
                                    }
                                    else
                                    {
                                        ?>
                                         <div class="col-md-4">
                                                    <div class="form-check-inline" style="color:red;">Please first add your class type
                                                        </div>
                                                        </div>
                                                        <?php
                                    }?>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" id="sixeids_<?= $index; ?>" name="sixeids[<?= $index ?>]" value="">
                            <div class="form-group row"><span class="label-text col-md-3 col-form-label">Images: </span>
                                <div class="col-md-9"><input type="file" name="image[<?= $index ?>][]" id="image<?= $index ?>"   onchange="check(this.id)" 
                                        multiple class="form-control" required><span
                                        class="help-block" id="erimage<?= $index ?>">Image Dimension 1000*1000px & ( png, jpg ,jpeg
                                        )</span><div id="imagePreview"></div></div>
                            </div>
                            <div id="price<?= $index ?>"></div> <!-- Price Input Added Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php
} else if (count($classtype) == 2) {
    $classtype1 = implode(", ", $classtype);
    $classtypeNameQuery = mysqli_query($conn, "SELECT id,name FROM classtype WHERE id IN($classtype1)");
    while ($row = mysqli_fetch_array($classtypeNameQuery)) {
        $classtypeName[] = array('id' => $row['id'], 'name' => $row['name']);
    }

    $secondaryClassName = $classtypeName[0]['name'];
    $primaryClassName = $classtypeName[1]['name'];
    if ($classtype[0] == $classtypeName[0]['id']) {
        $primaryClassName = $classtypeName[0]['name'];
        $secondaryClassName = $classtypeName[1]['name'];
    }

    ?>
            <div class="colorFieldWrapper" id="div_<?= $index ?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-outline-danger p-2">
                    <?php if ($index != 0) { ?><span class="text-right clickable close-icon removeColorDiv p-2" title="Remove" id="remove_<?= $index ?>"
                                    onclick="remove(this.id);"><i class="fa fa-times"></i></span>
                        <?php
                    } ?>
                            <div class="form-group row"><span class="label-text col-md-3 col-form-label">
                            <?= $primaryClassName ?>:
                                </span>
                                <div class="col-md-9"><input class="form-control productColorList" required name="productColor[<?= $index ?>]"
                                        id="color_<?= $index ?>" list="colors"
                                        placeholder="Please enter product <?= $primaryClassName; ?> name"><datalist id="colors">
                                <?php $sel_query = mysqli_query($conn, "SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=$classtype[0]");
                                while ($data = mysqli_fetch_assoc($sel_query)) { ?>
                                            <option>
                                        <?= $data['name'] ?>
                                            </option>
                                <?php } ?>
                                    </datalist></div>
                            </div>
                            <div class="form-group row"><span class="label-text col-md-3 col-form-label">Images: </span>
                                <div class="col-md-9"><input type="file" name="image[<?= $index ?>][]" id="image<?= $index ?>" onchange="check(this.id)" 
                                        multiple class="form-control" required><span
                                        class="help-block" id="erimage<?= $index ?>">Image Dimension 1000*1000px & ( png, jpg ,jpeg
                                        )</span><div id="imagePreview"></div></div>
                            </div>
                            <div class="form-group row"><span class="label-text col-md-3 col-form-label">
                            <?= $secondaryClassName ?>:
                                </span>
                                <div class="col-md-9">
                                    <div class="row">
                                <?php $sel_query = mysqli_query($conn, "SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=$classtype[1]");
                                $random = 1;
                                if(mysqli_num_rows($sel_query)>0)
                                {
                                while ($data = mysqli_fetch_assoc($sel_query)) { ?>
                                            <div class="col-md-4">
                                                <div class="form-check-inline"><label class="form-check-label1"><input type="checkbox" required
                                                            class="form-check-input1 productSizeList productSizes<?= $index ?>" name="productSizes[<?= $index ?>][]"
                                                            id="productSizes_<?= $index ?>_<?= $random ?>"
                                                            value="<?= $data['id']; ?>@<?= $data['symbol']; ?>"
                                                            onchange="getSize(this,<?= $index ?>);getDeal(this,<?= $index ?>,<?= $random ?>)">&nbsp;&nbsp;<?= ucwords($data['symbol']) ?></label>
                                                </div>
                                            </div>
                                    <?php $random++;
                                } }else
                                {
                                    ?>
                                    <div class="col-md-4">
                                                    <div class="form-check-inline" style="color:red;">Please first add your class type
                                                        </div>
                                                        </div>
                                    <?php
                                }?>
                                    </div>
                                </div>
                            </div>
                             <input type="hidden" id="sixeids_<?= $index; ?>" name="sixeids[<?= $index ?>]" value="">
                           
                            <div id="price<?= $index ?>"></div> <!-- Price Input Added Here -->
                        </div>
                    </div>
                </div>
            </div>
            </div>
    <?php if ($index == 0) { ?>
                <!-- Add Color -->
                <div class="row pt-2">
                    <div class="col-12 text-right"> <a href="javascript:void(0);" class="addColor" title="Add Color"
                            onclick="getColor()">&emsp;<span class="btn btn-success">ADD</span></a></div>
                </div>

                <!-- Add Color -->
        <?php
    }
    ?>
            <script type="text/javascript">
                var index = "<?= $index; ?>";
                $('#index').val(parseInt(index) + 1);
            </script>
    <?php
} else if (count($classtype) == 3) {
    $classtype1 = implode(", ", $classtype);
    $classtypeNameQuery = mysqli_query($conn, "SELECT id,name FROM classtype WHERE id IN($classtype1)");
    while ($row = mysqli_fetch_array($classtypeNameQuery)) {
        $classtypeName[] = array('id' => $row['id'], 'name' => $row['name']);
    }

    foreach ($classtypeName as $value) {
        if ($classtype[0] == $value['id']) {
            $primaryClassName = $value['name'];
        }
        if ($classtype[1] == $value['id']) {
            $secondaryClassName = $value['name'];
        }
        if ($classtype[2] == $value['id']) {
            $thirdClassName = $value['name'];
        }
    }

    ?>
                <div class="colorFieldWrapper" id="div_<?= $index ?>">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-outline-danger p-2">
                    <?php if ($index != 0) { ?><span class="text-right clickable close-icon removeColorDiv p-2" title="Remove" id="remove_<?= $index ?>"
                                        onclick="remove(this.id);"><i class="fa fa-times"></i></span>
                        <?php
                    } ?>
                                <div class="form-group row"><span class="label-text col-md-3 col-form-label">
                            <?= $primaryClassName ?>:
                                    </span>
                                    <div class="col-md-9"><input class="form-control productColorList" name="productColor[<?= $index ?>]"
                                            id="color_<?= $index ?>" list="colors"
                                            placeholder="Please enter product <?= $primaryClassName; ?> name"><datalist id="colors">
                                <?php $sel_query = mysqli_query($conn, "SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=$classtype[0]");
                                while ($data = mysqli_fetch_assoc($sel_query)) { ?>
                                                <option>
                                        <?= $data['name'] ?>
                                                </option>
                                <?php } ?>
                                        </datalist></div>
                                </div>
                                <div class="form-group row"><span class="label-text col-md-3 col-form-label">Images: </span>
                                    <div class="col-md-9"><input type="file" name="image[<?= $index ?>][]" id="image<?= $index ?>" onchange="check(this.id)" multiple class="form-control" required><span
                                            class="help-block" id="erimage<?= $index ?>">Image Dimension 1000*1000px & ( png, jpg ,jpeg
                                            )</span><div id="imagePreview"></div></div>
                                </div>
                                <div class="form-group row"><span class="label-text col-md-3 col-form-label">
                            <?= $secondaryClassName ?>:
                                    </span>
                                    <div class="col-md-9">
                                        <div class="row">
                                <?php $sel_query = mysqli_query($conn, "SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=$classtype[1]");
                                $random = 1;
                                if(mysqli_num_rows($sel_query)>0)
                                {
                                while ($data = mysqli_fetch_assoc($sel_query)) { ?>
                                                <div class="col-md-4">
                                                    <div class="form-check-inline"><label class="form-check-label1"><input type="checkbox" required
                                                                class="form-check-input1 productSizeList productSizes<?= $index ?>" name="productSizes[<?= $index ?>][]"
                                                                id="productSizes_<?= $index ?>_<?= $random ?>"
                                                                onchange="getthSizePrice(this,<?= $index ?>);"  
                                                                value="<?= $data['id']; ?>@<?= $data['symbol']; ?>">&nbsp;&nbsp;<?= ucwords($data['symbol']) ?></label>
                                                    </div>
                                                </div>
                                    <?php $random++;
                                } 
                                }else
                                {
                                    ?>
                                    <div class="col-md-4">
                                                    <div class="form-check-inline" style="color:red;">Please first add your class type
                                                        </div>
                                                        </div>
                                    <?php
                                }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group row"><span class="label-text col-md-3 col-form-label">
                            <?= $thirdClassName ?>:
                                    </span>
                                    <div class="col-md-9">
                                        <div class="row">
                                <?php $sel_query = mysqli_query($conn, "SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=$classtype[2]");
                                $random = 1;
                                if(mysqli_num_rows($sel_query)>0)
                                {
                                while ($data = mysqli_fetch_assoc($sel_query)) { ?>
                                                <div class="col-md-4">
                                                    <div class="form-check-inline"><label class="form-check-label1"><input type="checkbox"
                                                                class="form-check-input1 productClassList productSizesClass<?= $index ?>" required
                                                                name="productSizesClass[<?= $index ?>][]"
                                                                id="productClass2_<?= $index ?>_<?= $random ?>"
                                                                value="<?= $data['id']; ?>@<?= $data['symbol']; ?>"
                                                                onchange="getSizePrice(this,<?= $index ?>);getDeal(this,<?= $index ?>,<?= $random ?>);">&nbsp;&nbsp;<?= ucwords($data['symbol']) ?></label>
                                                    </div>
                                                </div>
                                    <?php $random++;
                                }
                                }else
                                {
                                    ?>
                                    <div class="col-md-4">
                                                    <div class="form-check-inline" style="color:red;">Please first add your class type
                                                        </div>
                                                        </div>
                                    <?php
                                }?>
                                        </div>
                                    </div>
                                </div>
                                 <input type="hidden" id="sixeids_<?= $index; ?>" name="sixeids[<?= $index ?>]" value="">
                           
                                <div id="price<?= $index ?>"></div> <!-- Price Input Added Here -->
                            </div>
                        </div>
                    </div>
                </div>
                </div>
    <?php if ($index == 0) { ?>
                    <!-- Add Color -->
                    <div class="row pt-2">
                        <div class="col-12 text-right"> <a href="javascript:void(0);" class="addColor" title="Add Color"
                                onclick="getColor()">&emsp;<span class="btn btn-success">ADD</span></a></div>
                    </div>

                    <!-- Add Color -->
        <?php
    }
    ?>
                <script type="text/javascript">
                    var index = "<?= $index; ?>";
                    $('#index').val(parseInt(index) + 1);
                </script>
    <?php
}
?>