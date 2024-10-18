<?php 
include ('includes/header.php');

if(isset($_GET['product'])){
  if($_GET['product']==""){
    ?>
    <script type="text/javascript">
    window.location.href="view-all-products.php";
  </script>
 <?php
  }else{
    $groupCode = $_GET['product'];
     $issubcategory=mysqli_fetch_assoc(mysqli_query($conn,"SELECT c.issubcategory FROM category c  WHERE c.id=(SELECT cat_id FROM products WHERE group_code='".$groupCode."' GROUP BY group_code)"))['issubcategory'];
    if($issubcategory=='Yes')
    {
      $classtype=json_decode(mysqli_fetch_assoc(mysqli_query($conn,"SELECT classtype_id FROM subcategory WHERE id=(SELECT subcat_id FROM products WHERE group_code='".$groupCode."' GROUP BY group_code)"))['classtype_id']);
    }
    elseif ($issubcategory=='No')
     {
      $classtype=json_decode(mysqli_fetch_assoc(mysqli_query($conn,"SELECT classtype_id FROM category WHERE id=(SELECT cat_id FROM products WHERE group_code='".$groupCode."' GROUP BY group_code)"))['classtype_id']);
      
    }
    $classtype1 = implode(", ", $classtype);
    $query="SELECT p.*,c.cat_name,sc.sub_cat_name FROM products as p 
 LEFT JOIN category as c on c.id=p.cat_id and c.status = 'Active'
 LEFT JOIN subcategory as sc on sc.id=p.subcat_id and sc.status = 'Active'
 WHERE p.trash = 'No' and p.status = 'Active' and p.group_code='".$_GET['product']."' GROUP BY p.group_code";
 $sql1=mysqli_query($conn,$query);
    $roww=mysqli_fetch_assoc($sql1);
    $c=0;
                        if($roww['class0']!='')
                        {
                          $c++;  
                        }
                        if($roww['class1']!='')
                        {
                          $c++;  
                        }
                        if($roww['class2']!='')
                        {
                          $c++;  
                        }
                        if($roww['class3']!='')
                        {
                          $c++;  
                        }
$classtypeNameQuery=mysqli_query($conn,"SELECT id,name FROM classtype WHERE id IN($classtype1)");
while($row=mysqli_fetch_array($classtypeNameQuery))
{
$classtypeName[]=array('id'=>$row['id'],'name'=>$row['name']);
}
if($c==2)
{
$secondaryClassName=$classtypeName[0]['name'];
    $primaryClassName=$classtypeName[1]['name'];
  if($classtype[0]==$classtypeName[0]['id'])
  {
    $primaryClassName=$classtypeName[0]['name'];
    $secondaryClassName=$classtypeName[1]['name'];
  }
   $classtypeexist=array();
    $exissize=mysqli_query($conn,"SELECT class0,class1 FROM products p WHERE  p.group_code='".$_GET['product']."' ");
    while($row=mysqli_fetch_array($exissize))
{
$classtypeexist[]=$row['class0'];
$classtypeexist[]=$row['class1'];
}
}
elseif($c==1 && $classtype[0]!=16)
{
    $classtypeexist=array();
    $primaryClassName=$classtypeName[0]['name'];
    $classtypeexist=array();
    $exissize=mysqli_query($conn,"SELECT class0 FROM products p WHERE p.group_code='".$_GET['product']."' ");
    while($row=mysqli_fetch_array($exissize))
{
$classtypeexist[]=$row['class0'];
}
  }
  elseif($c==3)
{
  $classtype1 = implode(", ", $classtype);
 
$classtypeNameQuery=mysqli_query($conn,"SELECT id,name FROM classtype WHERE id IN($classtype1)");
while($row=mysqli_fetch_array($classtypeNameQuery))
{
$classtypeName[]=array('id'=>$row['id'],'name'=>$row['name']);
}
 $classtypeexist=array();
    $exissize=mysqli_query($conn,"SELECT class0,class1,class2 FROM products p WHERE  p.group_code='".$_GET['product']."' ");
    while($row=mysqli_fetch_array($exissize))
{
$classtypeexist[]=$row['class0'];
$classtypeexist[]=$row['class1'];
$classtypeexist[]=$row['class2'];
}

    foreach($classtypeName as $value)
    {
  if($classtype[0]==$value['id'])
  {
    $primaryClassName=$value['name'];
  }
  if($classtype[1]==$value['id'])
  {
    $secondaryClassName=$value['name'];
        }
  if($classtype[2]==$value['id'])
{
    $thirdClassName=$value['name'];
  }
}
}

}
}
?>
 <style type="text/css">
    
    .info {
  background-color: #e7f3fe;
  border-left: 6px solid #2196F3;
    margin-bottom: 15px;
  padding: 4px 12px;

}
#imagePreview{
    display: flex;
    flex-wrap: wrap;
}
#imagePreview img{
    width: 100px;
    height: 100px;
    margin: 2px;
    border-radius: 5px;
    border: 2px solid grey;
    object-fit: contain;
}
.colorFieldWrapper .card {
    margin-bottom: 22px;
    margin-top: 10px;
}
.field_wrapper1 input {
    margin-bottom: 10px;
    margin-top: 10px;
}a.remove_button1 {
    background-color: red;
    color: white;
    padding: 5px 8px;
    font-size: 10px;
    border-radius: 25px;
}
.field_wrapper2 input {
    margin: 10px 0px;
}
.field_wrapper2 a {
    background-color: red;
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
          <h6 class="h6">Product Add</h6>
        </div>
         <div class="info">
                <p><strong>Info!</strong> You can create product based on classtype. you can enter price individually by product classtype. you can add or remove deal based on product classtype; if you cannot get any deal on product then unchecked add deal and if you want to meta then select now otherwise select later..</p>
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
                    <select name="category" id="category" class="form-control" required readonly>
                      <option value="">-----select category-----</option> 
                      <?php
                      $sel_query=mysqli_query($conn,"SELECT * FROM `category` WHERE status='Active'");

                      while($data=mysqli_fetch_assoc($sel_query))
                      {
                        ?> 
                        <option value="<?php echo $data['id']; ?>" data-issubcat="<?= $data['issubcategory']?>" <?php if($data['issubcategory']=='No'){?> data-clastype='<?= $data['classtype_id']?>' <?php
                      }?> <?php if($roww['cat_id']==$data['id']) echo 'selected'; else echo 'disabled'; ?>> <?php echo $data['cat_name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row" id="subcategory">
              <?php    if($issubcategory=='Yes')
    {
        ?>
        
        <span class="label-text col-md-3 col-form-label">Select Subcategory: *</span>
                  <div class="col-md-9">
                    <select name="subcategory" id="subcat" class="form-control" required readonly>
                      <option value="">-----select subcategory-----</option> 
                      <?php
                      $sel_query=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE status='Active' AND cat_id=".$roww['cat_id']);

                      while($data=mysqli_fetch_array($sel_query))
                      {
                        ?> 
                        <option value="<?php echo $data['id']; ?>" <?php if($roww['subcat_id']==$data['id']) echo 'selected'; else echo 'disabled'; ?>> <?php echo $data['sub_cat_name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
        <?php
    }
    ?>
              </div>
              <div class="form-group row">
                <span class="label-text col-md-3 col-form-label">Product Name: *</span>

                <div class="col-md-9">
                  <input type="text" name="product" class="form-control" id="productName" required placeholder="Please enter product name" value="<?= $roww['product_name']; ?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <span class="label-text col-md-3 col-form-label">Product Brand: </span>

                <div class="col-md-9">
                  <input type="text" name="brand" class="form-control" id="productBrand" value="<?= $roww['brand']; ?>">
                </div>
              </div>

     <div class="form-group row" id="TaxSection" style="background: ivory;padding: 15px;border: 1px solid #FF9800;border-radius: 10px;">
                                    <span class="label-text col-md-3 col-form-label">Tax Status</span>
                                    <div class="col-md-9">
                                      <input type="text" placeholder="0% to 100%" name="product_tax" value="<?= $roww['tax']; ?>" title="please input the desired percentage value for the tax. either enter 0 or leave it blank." class="form-control" style="border-color:gray;" pattern="^(?:\d{1,2}(?:\.\d{1,2})?|100(?:\.0{1,2})?)$" oninput="if (typeof this.reportValidity === 'function') {this.reportValidity();}" >
                                      <span><b>NOTE: If the product is exempt from tax, please either enter "0" in the tax field or leave it blank. Otherwise, please input the desired percentage value for the tax.</b></span>
                                    </div>
                                </div>

              <!-- FOR WEIGHT-->
              <div class="classtypeField" >
<?php
$index=0;
if ($classtype[0] == 16) { ?>
    <div class="colorFieldWrapper">
        <div class="row">
            <div class="col-md-12">
                <div class="card card-outline-danger p-2">
                    <div class="form-group row"><span class="label-text col-md-3 col-form-label">Images: </span>
                        <div class="col-md-9"><input type="file" name="image[<?= $index ?>][]" id="image<?= $index ?>" 
                        onchange="prevImages(this)"  multiple class="form-control" required><span
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
                                    while ($data = mysqli_fetch_assoc($sel_query)) { 
                                    if(!in_array($data['id'],$classtypeexist))
                                    {?>
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
                            <div class="form-group row"><span class="label-text col-md-3 col-form-label">Images: </span>
                                <div class="col-md-9"><input type="file" name="image[<?= $index ?>][]" id="image<?= $index ?>"   onchange="prevImages(this)" 
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
                                <div class="col-md-9"><input type="file" name="image[<?= $index ?>][]" id="image<?= $index ?>" onchange="prevImages(this)" 
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
                                    <div class="col-md-9"><input type="file" name="image[<?= $index ?>][]" id="image<?= $index ?>" onchange="prevImages(this)" multiple class="form-control" required><span
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
              </div>
              <input type="hidden" id="classtype_id" name="classtype_id" value="">
              
              <?php
           $query = 'SELECT * FROM home WHERE id=3';
    $homequery1 = mysqli_query($conn,$query);
    $home = mysqli_fetch_assoc($homequery1);
           ?>
              <div class="form-group row">
                <span class="label-text col-md-3 col-form-label">Show Product in  <?= ucfirst($home['name']);?>: </span>
                <div class="col-md-9">
                  <input type="checkbox" name="top" class="" id="topFeatured" value="Yes" onclick="getproductlist(this.id);">  Yes

                  <div id="topFeaturedList"></div>

                </div>
              </div>

           <?php
           $query = 'SELECT * FROM home WHERE id=1';
    $homequery1 = mysqli_query($conn,$query);
    $home = mysqli_fetch_assoc($homequery1);
           ?>
              <div class="form-group row">
                <span class="label-text col-md-3 col-form-label">Show Product in <?= ucfirst($home['name']);?>: </span>
                <div class="col-md-9">
                  <input type="checkbox" name="new" class="" id="newArrivals" value="Yes" onclick="getproductlist(this.id);">  Yes
                  <div id="newArrivalsList"></div>
                </div>
              </div>
              <?php
           $query = 'SELECT * FROM home WHERE id=2';
    $homequery1 = mysqli_query($conn,$query);
    $home = mysqli_fetch_assoc($homequery1);
           ?>
              <div class="form-group row">
                <span class="label-text col-md-3 col-form-label">Show Product in  <?= ucfirst($home['name']);?>: </span>
                <div class="col-md-9">
                  <input type="checkbox" name="hot" class="" id="hotDeals" value="Yes" onclick="getproductlist(this.id);">  Yes
                  <div id="hotDealsList"></div>
                </div>
              </div>
              <div class="form-group row">
                <span class="label-text col-md-3 col-form-label">COD Applicable: </span>
                <div class="col-md-9">
                  <input type="checkbox" name="cod" class="" id="codApplicable" value="Yes" onclick="getproductlist(this.id);">  Yes
                  <div id="codApplicableList"></div>
                </div>
              </div>
              <!--<div class="form-group row">-->
              <!--  <span class="label-text col-md-3 col-form-label">Add Deals: </span>-->
              <!--  <div class="col-md-9">-->
              <!--    <input type="checkbox" name="todayDeal" class="" id="todayDealsApplicable" value="Yes" checked onclick="getDealList(this.id);">  Yes-->
              <!--  </div>-->
              <!--</div>-->
                  <div id="todayDealsApplicableList">
                  </div>
              <!--                                                                  -->
              <div class="input_wrap">
                <div class="form-group row">
                  <span class="label-text col-md-3 col-form-label">Description: </span>
                  <!-- <div class="col-md-9"> -->
                    <div class="field_wrapper form-group">
                      <div class="input-group">
                        <!-- <textarea class="form-control" name="description[]" required=""></textarea> -->

                        <div class="row">
                          <div class="col-12">
                            <textarea name="editor" id="editor" name="description" rows="10" cols="80" required=""><?= (isset($_POST['description']))?$_POST['description']:''; ?></textarea>
                          </div>
                        </div>

                        <br>

                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group row" id="metaList">
                  <span class="label-text col-md-3 col-form-label">Want To Add Meta Content: </span>
                  <div class="col-md-9">
                    <input type="radio" name="isMeta" class="" id="addMeta2" value="Yes" checked onclick="getMetalist(this.value);">  Now
                    <input type="radio" name="isMeta" class="" id="addMeta1" value="No"  onclick="getMetalist(this.value);">  Later

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
                            <input type="text" name="title"  id="metatitle" value="" class="form-control">
                          </div>
                        </div>
                        <br>
                        <div class="form-group row">
                          <span class="label-text col-md-3 col-form-label">Meta Tags: </span>

                          <div class="col-md-9 field_wrapper1">
                            <input type="text" name="meta[]" value="" class="form-control"/>

                          </div>
                          <br>

                        </div>
                        <div class="row pt-2">
                          <div class="col-12 text-right">
                            <a href="javascript:void(0);" class="addMetatags" title="Add METATAGS">&emsp;<span class="btn btn-success">ADD META TAGS</span></a>
                          </div>
                        </div>
                        <script type="text/javascript">
                         $(document).ready(function(){
                                       var maxField1 = 10; //Input fields increment limitation
                                       var addButton1 = $('.addMetatags'); //Add button selector
                                       var wrapper1 = $('.field_wrapper1'); //Input field wrapper
                                        //New input field html 
                                       var x = 1; //Initial field counter is 1

                                       //Once add button is clicked
                                       $(addButton1).click(function(){
                                           //Check maximum number of input fields
                                           if(x < maxField1){ 
                                               x++; //Increment field counter
                                               var fieldHTML1 = '<div id="meta_'+x+'"><input type="text" name="meta[]" value="" class="form-control"/><a href="javascript:void(0);" class="remove_button1">Remove</a><br></div>';
                                               
                                               $(wrapper1).append(fieldHTML1);
                                               //Add field html
                                                
                                             }
                                           });

                                       //Once remove button is clicked
                                       $(wrapper1).on('click', '.remove_button1', function(e){
                                         e.preventDefault();
                                           $(this).parent('div').remove(); //Remove field html
                                           x--; //Decrement field counter
                                         });
                                     });
                                   </script>
                                   <br>
                                   <br>
                                   <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Meta Keywords: </span>

                                    <div class="col-md-9 field_wrapper2">
                                      <input type="text" name="key[]" value="" class="form-control"/>

                                    </div>
                                    <br>

                                  </div>
                                  <div class="row pt-2">
                                    <div class="col-12 text-right">
                                      <a href="javascript:void(0);" class="addMetaKey" title="Add METAKEYWORDS">&emsp;<span class="btn btn-success">ADD META KEYWORDS</span></a>
                                    </div>
                                  </div>
                                  <script type="text/javascript">
                                   $(document).ready(function(){
                                       var maxField2 = 10; //Input fields increment limitation
                                       var addButton2 = $('.addMetaKey'); //Add button selector
                                       var wrapper2 = $('.field_wrapper2'); //Input field wrapper
                                       var fieldHTML2 = '<div><input type="text" name="key[]" value="" class="form-control"/><a href="javascript:void(0);" class="remove_button2">Remove</a><br></div>'; //New input field html 
                                       var x = 1; //Initial field counter is 1

                                       //Once add button is clicked
                                       $(addButton2).click(function(){
                                           //Check maximum number of input fields
                                           if(x < maxField2){ 
                                               x++; //Increment field counter
                                               $(wrapper2).append(fieldHTML2); //Add field html
                                             }
                                           });

                                       //Once remove button is clicked
                                       $(wrapper2).on('click', '.remove_button2', function(e){
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
                            <input type="hidden" name="index" value="0" id="index">
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
            
            $('#classtype_id').val('<?= json_encode($classtype); ?>');
            
function getDealList(checkedId)
{
  // console.log(checkedId);
if ($("#"+checkedId).is(':checked')){
 var classtype=$('#classtype_id').val();
 var obj = JSON.parse(classtype);
 fieldHTML = '';
 for (i = 0; i < obj.length; ++i) {
  var fclastype=obj[i];
    // do something with `substr[i]`
}
 // console.log(checkedId);
 if(obj.length==2)
 {


  var colorElement = document.getElementsByClassName("productColorList");
  var sizeElement = document.getElementsByClassName("productSizeList");
  fieldHTML += '<div class="form-group row">';

  if (colorElement.length > 0) {
    for(i=0; i<colorElement.length; i++){

      colorid = colorElement[i].id;
      randomColorArr = colorid.split("_");
      randomNo = randomColorArr[1];

        // console.log(randomNo);

        for(j=0; j<sizeElement.length; j++){
          sizeId = sizeElement[j].id;
          randomSizeArr = sizeId.split("_");

          if(randomNo==randomSizeArr[1]){

            if ($("#"+sizeId).is(':checked')){
              forColor = $('#'+colorid).val();
              forSize = $('#'+sizeId).val();

              forSizeSymbole = forSize.split("@");


              var divs='<div class="dealClass" id="d'+sizeId+'"></div>';
console.log(divs);
$('#d'+sizeId).remove();
var sizeId1="'d"+sizeId+"'";
$('#todayDealsApplicableList').append(divs);
var remove='<span class="text-right clickable close-icon removeColorDiv p-2" id="'+i+'_'+j+'" title="Remove" onclick="removeDeal('+sizeId1+');" ><i class="fa fa-times"></i></span>';
// if(i==0 && j==0)
// {
//   var remove="";
// }


var content='<div class="row" id="div1_'+i+'_'+j+'"><div class="col-md-12"><div class="card card-outline-danger p-2"><center><span class="label-text col-md-3 col-form-label"> For '+forColor+'('+forSizeSymbole[1]+')</span></center>'+remove+'<hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Date: </span><div class="col-md-9"><input type="date" name="sdate['+i+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Time: </span><div class="col-md-9"><input type="time" name="stime['+i+'][]" class="form-control"  required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Date: </span><div class="col-md-9"><input type="date" name="edate['+i+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Time: </span><div class="col-md-9"><input type="time" name="etime['+i+'][]" class="form-control"  required></div></div><hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label"> Deal Stock : </span><div class="col-md-9"><input type="text" name="dealstock['+i+'][]" class="form-control productPriceList"  placeholder="No. of Deal Item in Stock" required onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Deal Price: </span><div class="col-md-9"><input type="text" name="deal_price['+i+'][]"  class="form-control" required onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" placeholder="Only Enter Rs" id="dealamount'+i+'" onblur="check_dealamount('+i+')"><span class="help-block" id="dealam'+i+'"></span></div></div></div></div>';

$('#d'+sizeId).append(content);
 



            }
          }

        }

      }
    }
  }
  else if(obj.length==1 && fclastype!=16)
  {
    var i=0;
   var weightElement = document.getElementsByClassName("productSizeList");

   fieldHTML += '<div class="form-group row">';


   for(j=0; j<weightElement.length; j++){
    sizeId = weightElement[j].id;
    randomSizeArr = sizeId.split("_");




    if ($("#"+sizeId).is(':checked')){

      forSize = $('#'+sizeId).val();
      forSizeSymbole = forSize.split("@");


       var divs='<div class="dealClass" id="d'+sizeId+'"></div>';
console.log(divs);
$('#d'+sizeId).remove();
var sizeId1="'d"+sizeId+"'";
$('#todayDealsApplicableList').append(divs);
var remove='<span class="text-right clickable close-icon removeColorDiv p-2" id="'+i+'_'+j+'" title="Remove" onclick="removeDeal('+sizeId1+');" ><i class="fa fa-times"></i></span>';
// if(i==0 && j==0)
// {
//   var remove="";
// }


var content='<div class="row" id="div1_'+i+'_'+j+'"><div class="col-md-12"><div class="card card-outline-danger p-2"><center><span class="label-text col-md-3 col-form-label"> For '+forSizeSymbole[1]+'</span></center>'+remove+'<hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Date: </span><div class="col-md-9"><input type="date" name="sdate['+i+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Time: </span><div class="col-md-9"><input type="time" name="stime['+i+'][]" class="form-control"  required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Date: </span><div class="col-md-9"><input type="date" name="edate['+i+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Time: </span><div class="col-md-9"><input type="time" name="etime['+i+'][]" class="form-control"  required></div></div><hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label"> Deal Stock : </span><div class="col-md-9"><input type="text" name="dealstock['+i+'][]" class="form-control productPriceList"  placeholder="No. of Deal Item in Stock" required onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Deal Price: </span><div class="col-md-9"><input type="text" required onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" name="deal_price['+i+'][]"  class="form-control" placeholder="Only Enter Rs" id="dealamount'+i+'" onblur="check_dealamount('+i+')"><span class="help-block" id="dealam'+i+'"></span></div></div></div></div>';

$('#d'+sizeId).append(content);





    }

    
  }

}
else if(obj.length==3)
{

  var colorElement = document.getElementsByClassName("productColorList");
  var sizeElement = document.getElementsByClassName("productSizeList");
  var classElement = document.getElementsByClassName("productClassList");

  if (colorElement.length > 0) {
    for(i=0; i<colorElement.length; i++){

      colorid = colorElement[i].id;
      randomColorArr = colorid.split("_");
      randomNo = randomColorArr[1];

        // console.log(randomNo);

        for(j=0; j<sizeElement.length; j++){
          sizeId = sizeElement[j].id;
          randomSizeArr = sizeId.split("_");

          if(randomNo==randomSizeArr[1]){

            if ($("#"+sizeId).is(':checked')){
              forColor = $('#'+colorid).val();
              forSize = $('#'+sizeId).val();

              forSizeSymbole = forSize.split("@");

              for(k=0; k<classElement.length; k++){
                classId = classElement[k].id;
                randomClassArr = classId.split("_");

                if(randomNo==randomClassArr[1]){

                  if ($("#"+classId).is(':checked')){
                    forClass = $('#'+classId).val();

                    forClassSymbole = forClass.split("@");
                    
                    var divs='<div class="dealClass" id="d'+sizeId+'_'+k+'"></div>';
console.log(divs);
$('#d'+sizeId+'_'+k).remove();
var sizeId1="'d"+sizeId+"_"+k+"'";
$('#todayDealsApplicableList').append(divs);
var remove='<span class="text-right clickable close-icon removeColorDiv p-2" id="'+i+'_'+j+'_'+k+'" title="Remove" onclick="removeDeal('+sizeId1+');" ><i class="fa fa-times"></i></span>';
// if(i==0 && j==0 && k==0)
// {
//   var remove="";
// }


var content='<div class="row" id="div1_'+i+'_'+j+'_'+k+'"><div class="col-md-12"><div class="card card-outline-danger p-2"><center><span class="label-text col-md-3 col-form-label"> For '+forColor+'&nbsp;('+forSizeSymbole[1]+'&nbsp;('+forClassSymbole[1]+'))</span></center>'+remove+'<hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Date: </span><div class="col-md-9"><input type="date" name="sdate['+i+']['+j+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Time: </span><div class="col-md-9"><input type="time" name="stime['+i+']['+j+'][]" class="form-control"  required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Date: </span><div class="col-md-9"><input type="date" name="edate['+i+']['+j+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Time: </span><div class="col-md-9"><input type="time" name="etime['+i+']['+j+'][]" class="form-control"  required></div></div><hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label"> Deal Stock : </span><div class="col-md-9"><input type="text" name="dealstock['+i+']['+j+'][]" class="form-control productPriceList"  placeholder="No. of Deal Item in Stock" required onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Deal Price: </span><div class="col-md-9"><input type="text" name="deal_price['+i+']['+j+'][]" required onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"  class="form-control" placeholder="Only Enter Rs" id="dealamount'+i+j+'" onblur="check_dealamount('+i+j+')"><span class="help-block" id="dealam'+i+j+'"></span></div></div></div></div>';
$('#d'+sizeId+'_'+k).append(content);

                  
                  }
                }
              }




            }
          }

        }

      }
    }
  }
  else if(fclastype==16)
  {
    var content='<div class="row" id="div1_9"><div class="col-md-12"><div class="card card-outline-danger p-2"><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Date: </span><div class="col-md-9"><input type="date" name="sdate" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Time: </span><div class="col-md-9"><input type="time" name="stime" class="form-control"  required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Date: </span><div class="col-md-9"><input type="date" name="edate" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Time: </span><div class="col-md-9"><input type="time" name="etime" class="form-control"  required></div></div><hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label"> Deal Stock : </span><div class="col-md-9"><input type="text" name="dealstock" class="form-control productPriceList"  placeholder="No. of Deal Item in Stock" required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Deal Price: </span><div class="col-md-9"><input type="text" name="deal_price" required class="form-control" placeholder="Only Enter Rs" id="dealamount0" onblur="check_dealamount(0)"><span class="help-block" id="dealam0"></span></div></div></div></div>';
                  $('#todayDealsApplicableList').html(content);
  }

  // fieldHTML += '</div>';
  // console.log(fieldHTML);
  // $('#'+checkedId+'List').append(fieldHTML);
}else{
  //alert("hii");

  $('#'+checkedId+'List').html("");

}

}

  function getproductlist(checkedId){

// console.log(checkedId);
if ($("#"+checkedId).is(':checked')){
 var classtype=$('#classtype_id').val();
 var obj = JSON.parse(classtype);
 fieldHTML = '';
 console.log(checkedId);
for (i = 0; i < obj.length; ++i) {
  var fclastype=obj[i];
    // do something with `substr[i]`
}
 if(obj.length==2)
 {


  var colorElement = document.getElementsByClassName("productColorList");
  var sizeElement = document.getElementsByClassName("productSizeList");
  fieldHTML += '<div class="form-group row">';

  if (colorElement.length > 0) {
    for(i=0; i<colorElement.length; i++){

      colorid = colorElement[i].id;
      randomColorArr = colorid.split("_");
      randomNo = randomColorArr[1];

        // console.log(randomNo);

        for(j=0; j<sizeElement.length; j++){
          sizeId = sizeElement[j].id;
          randomSizeArr = sizeId.split("_");

          if(randomNo==randomSizeArr[1]){

            if ($("#"+sizeId).is(':checked')){
              forColor = $('#'+colorid).val();
              forSize = $('#'+sizeId).val();

              forSizeSymbole = forSize.split("@");


              fieldHTML += '<div class="col-md-4">';
              fieldHTML += '<div class="form-check-inline">';
              fieldHTML += '<label class="form-check-label1">';
              fieldHTML += '<input type="checkbox" class="form-check-input1" id="'+checkedId+randomNo+forSizeSymbole[0]+'" name="'+checkedId+'['+randomNo+']['+forSizeSymbole[0]+']'+'" value="Yes" checked>&nbsp;&nbsp;';
              fieldHTML += 'For '+forColor+'&nbsp;('+forSizeSymbole[1]+')</label>';
              fieldHTML += '</div>';
              fieldHTML += '</div>';




            }
          }

        }

      }
    }
  }
  else if(obj.length==1 && fclastype!=16)
  {
   var weightElement = document.getElementsByClassName("productSizeList");

   fieldHTML += '<div class="form-group row">';


   for(j=0; j<weightElement.length; j++){
    sizeId = weightElement[j].id;
    randomSizeArr = sizeId.split("_");




    if ($("#"+sizeId).is(':checked')){

      forSize = $('#'+sizeId).val();
      forSizeSymbole = forSize.split("@");


      fieldHTML += '<div class="col-md-4" id="'+checkedId+forSizeSymbole[0]+'1">';
      fieldHTML += '<div class="form-check-inline">';
      fieldHTML += '<label class="form-check-label1">';
      fieldHTML += '<input type="checkbox" class="form-check-input1" id="'+checkedId+forSizeSymbole[0]+'" name="'+checkedId+'['+forSizeSymbole[0]+']'+'" value="Yes" checked>&nbsp;&nbsp;';
      fieldHTML += 'For '+forSizeSymbole[1]+'</label>';
      fieldHTML += '</div>';
      fieldHTML += '</div>';



    }

    
  }

}
else if(obj.length==3)
{


  var colorElement = document.getElementsByClassName("productColorList");
  var sizeElement = document.getElementsByClassName("productSizeList");
  var classElement = document.getElementsByClassName("productClassList");
  fieldHTML += '<div class="form-group row">';

  if (colorElement.length > 0) {
    for(i=0; i<colorElement.length; i++){

      colorid = colorElement[i].id;
      randomColorArr = colorid.split("_");
      randomNo = randomColorArr[1];

        // console.log(randomNo);

        for(j=0; j<sizeElement.length; j++){
          sizeId = sizeElement[j].id;
          randomSizeArr = sizeId.split("_");

          if(randomNo==randomSizeArr[1]){

            if ($("#"+sizeId).is(':checked')){
              forColor = $('#'+colorid).val();
              forSize = $('#'+sizeId).val();

              forSizeSymbole = forSize.split("@");

              for(k=0; k<classElement.length; k++){
                classId = classElement[k].id;
                randomClassArr = classId.split("_");

                if(randomNo==randomClassArr[1]){

                  if ($("#"+classId).is(':checked')){
                    forClass = $('#'+classId).val();

                    forClassSymbole = forClass.split("@");
                    

                    fieldHTML += '<div class="col-md-4">';
                    fieldHTML += '<div class="form-check-inline">';
                    fieldHTML += '<label class="form-check-label1">';
                    fieldHTML += '<input type="checkbox" class="form-check-input1" id="'+checkedId+randomNo+forSizeSymbole[0]+forClassSymbole[0]+'" name="'+checkedId+'['+randomNo+']['+forSizeSymbole[0]+']['+forClassSymbole[0]+']'+'" value="Yes" checked>&nbsp;&nbsp;';
                    fieldHTML += 'For '+forColor+'&nbsp;('+forSizeSymbole[1]+')&nbsp;('+forClassSymbole[1]+'))</label>';
                    fieldHTML += '</div>';
                    fieldHTML += '</div>';
                  }
                }
              }




            }
          }

        }

      }
    }
  }

  fieldHTML += '</div>';
  console.log(fieldHTML);
  $('#'+checkedId+'List').append(fieldHTML);
}else{

  $('#'+checkedId+'List').html("");

}

}


function getDeal(sel,random,id)
{
    if($('#todayDealsApplicable').is(':checked'))
    {
   console.log(sel);
  selId = sel.id;
  var sizeSymbole = sel.value.split("@");
  var classtype=$('#classtype_id').val();
  var fields = selId.split('_');

var first = fields[1];
var second = fields[2];
var id1=first+'_'+second;
 var obj = JSON.parse(classtype);
 var i;
for (i = 0; i < obj.length; ++i) {
  var fclastype=obj[i];
    // do something with `substr[i]`
}
// alert(fclastype);
 if(obj.length==2)
 {
  var colorElement = document.getElementsByClassName("productColorList");
  colorid = colorElement[random].id;
  // randomColorArr = colorid.split("_");
  forColor = $('#'+colorid).val();

// var opts = [], 
// opt;
if ($("#"+selId).is(':checked')){

  var sizeSymbole = sel.value.split("@");

// opts.push(opt);
//console.log(opt.value);
var i = Math.floor(Math.random() * 1000) + 1;
var divs='<div class="dealClass" id="d'+selId+'"></div>';
console.log(divs);
$('#d'+selId).remove();
var selId1="'d"+selId+"'";
$('#todayDealsApplicableList').append(divs);
// var remove="";
// if(id!==1 && (random==0 || random>0))
// {
  var remove='<span class="text-right clickable close-icon removeColorDiv p-2" id="'+random+'_'+id+'" title="Remove" onclick="removeDeal('+selId1+');" ><i class="fa fa-times"></i></span>';
// }

// var randomId = '-container';
var id2="'"+id1+"'";

var content='<div class="row" id="div1_'+random+'_'+id+'"><div class="col-md-12"><div class="card card-outline-danger p-2"><center><span class="label-text col-md-3 col-form-label"> For '+forColor+'('+sizeSymbole[1]+')</span></center>'+remove+'<hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Date: </span><div class="col-md-9"><input type="date" name="sdate['+random+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Time: </span><div class="col-md-9"><input type="time"  name="stime['+random+'][]" class="form-control"  required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Date: </span><div class="col-md-9"><input type="date" name="edate['+random+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Time: </span><div class="col-md-9"><input type="time" name="etime['+random+'][]" class="form-control"  required></div></div><hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label"> Deal Stock : </span><div class="col-md-9"><input type="text" name="dealstock['+random+'][]" class="form-control productPriceList"  placeholder="No. of Deal Item in Stock" onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Deal Price: </span><div class="col-md-9"><input type="text" name="deal_price['+random+'][]" required onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"  class="form-control" placeholder="Only Enter Rs" id="dealamount'+id1+'" onblur="check_dealamount('+id2+')"><span class="help-block" id="dealam'+id1+'"></span></div></div></div></div>';

$('#d'+selId).append(content);
}
else
{
$('#d'+selId).remove();

}
}
else if(obj.length==1 && fclastype!=16)
  {
if ($("#"+selId).is(':checked')){

  var sizeSymbole = sel.value.split("@");
var id2="'"+id1+"'";

// opts.push(opt);
//console.log(opt.value);
var i = Math.floor(Math.random() * 1000) + 1;
var divs='<div class="dealClass" id="d'+selId+'"></div>';
console.log(divs);
$('#d'+selId).remove();
var selId1="'d"+selId+"'";
$('#todayDealsApplicableList').append(divs);
// var remove="";
// if(id!==1 && (random==0 || random>0))
// {
  var remove='<span class="text-right clickable close-icon removeColorDiv p-2" id="'+random+'_'+id+'" title="Remove" onclick="removeDeal('+selId1+');" ><i class="fa fa-times"></i></span>';
// }

// var randomId = '-container';

var content='<div class="row" id="div1_'+random+'_'+id+'"><div class="col-md-12"><div class="card card-outline-danger p-2"><center><span class="label-text col-md-3 col-form-label"> For '+sizeSymbole[1]+'</span></center>'+remove+'<hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Date: </span><div class="col-md-9"><input type="date" name="sdate['+random+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Time: </span><div class="col-md-9"><input type="time" name="stime['+random+'][]" class="form-control"  required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Date: </span><div class="col-md-9"><input type="date" name="edate['+random+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Time: </span><div class="col-md-9"><input type="time" name="etime['+random+'][]" class="form-control"  required></div></div><hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label"> Deal Stock : </span><div class="col-md-9"><input type="text" name="dealstock['+random+'][]" class="form-control productPriceList"  placeholder="No. of Deal Item in Stock" required onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Deal Price: </span><div class="col-md-9"><input type="text" name="deal_price['+random+'][]" required onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"  class="form-control" placeholder="Only Enter Rs" id="dealamount'+id1+'" onblur="check_dealamount('+id2+')"><span class="help-block" id="dealam'+id1+'"></span></div></div></div></div>';

$('#d'+selId).append(content);

}
else
{
$('#d'+selId).remove();

}
}
else if(obj.length==3)
{
  var colorElement = document.getElementsByClassName("productColorList");
  var sizeElement = document.getElementsByClassName("productSizeList");

  if (colorElement.length > 0) {
    for(i=0; i<colorElement.length; i++){

      colorid = colorElement[i].id;
      randomColorArr = colorid.split("_");
      randomNo = randomColorArr[1];

        // console.log(randomNo);

        for(j=0; j<sizeElement.length; j++){
          sizeId = sizeElement[j].id;
          randomSizeArr = sizeId.split("_");

          if(randomNo==randomSizeArr[1]){

            if ($("#"+sizeId).is(':checked')){
              forColor = $('#'+colorid).val();
              forSize = $('#'+sizeId).val();

              forSizeSymbole = forSize.split("@");
if ($("#"+selId).is(':checked')){

  var classSymbole = sel.value.split("@");

// opts.push(opt);
//console.log(opt.value);
//var i = Math.floor(Math.random() * 1000) + 1;
var divs='<div class="dealClass" id="d'+selId+'_'+j+'"></div>';
console.log(divs);
$('#d'+selId+'_'+j).remove();
var selId1="'d"+selId+"_"+j+"'";
$('#todayDealsApplicableList').append(divs);
// var remove="";
// if(id!==1 && (random==0 || random>0))
// {
  var remove='<span class="text-right clickable close-icon removeColorDiv p-2" id="'+random+'_'+id+'" title="Remove" onclick="removeDeal('+selId1+');" ><i class="fa fa-times"></i></span>';
// }


var id2="'"+id1+'_'+j+"'";
var content='<div class="row" id="div1_'+i+'_'+j+'_'+k+'"><div class="col-md-12"><div class="card card-outline-danger p-2"><center><span class="label-text col-md-3 col-form-label"> For '+forColor+'&nbsp;('+forSizeSymbole[1]+'&nbsp;('+classSymbole[1]+'))</span></center>'+remove+'<hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Date: </span><div class="col-md-9"><input type="date" name="sdate['+i+']['+j+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Time: </span><div class="col-md-9"><input type="time" name="stime['+i+']['+j+'][]" class="form-control"  required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Date: </span><div class="col-md-9"><input type="date" name="edate['+i+']['+j+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Time: </span><div class="col-md-9"><input type="time" name="etime['+i+']['+j+'][]" class="form-control"  required></div></div><hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label"> Deal Stock : </span><div class="col-md-9"><input type="text" name="dealstock['+i+']['+j+'][]" class="form-control productPriceList"  placeholder="No. of Deal Item in Stock" required onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;"></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Deal Price: </span><div class="col-md-9"><input type="text" name="deal_price['+i+']['+j+'][]" required onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" class="form-control" placeholder="Only Enter Rs" id="dealamount'+id1+'_'+j+'" onblur="check_dealamount('+id2+')"><span class="help-block" id="dealam'+id1+'_'+j+'"></span></div></div></div></div>';
$('#d'+selId+'_'+j).append(content);

                  
                  }
else
{
$('#d'+selId).remove();

}
                }
              }




            }
          }

        }

      }
    }
    }
$.fn.scrollToCenter = function(speed = 1000) {
    // Get the element you want to scroll to the center of the screen
    var element = $(this);

    // Get the height of the viewport
    var viewportHeight = $(window).height();

    // Get the element's position relative to the top of the document
    var elementTop = element.offset().top;

    // Calculate the distance to scroll
    var scrollDistance = (elementTop !== null) ? elementTop - (viewportHeight / 2) : 0;

    // Animate the scroll to the desired position with the specified speed
    $('html, body').animate({
        scrollTop: scrollDistance
    }, speed);
}

function getMetalist(checkedId){

// // console.log(checkedId);
if (checkedId=='Yes'){
  $('.metaFieldWrapper').show();

}
else
{
  $('.metaFieldWrapper').hide();

}

}

$( "#productName" ).focusout(function() {

  $( "#metatitle" ).val($('#productName').val());
})

$(document).ready(function(){
  $('.metaFieldWrapper').show();
  var productValueArray = [];
  $('.addValueToArray').click(function(){
    id=this.id;
    if ($("#"+id).is(':checked')){

      productValueArray.push(productValue);
    }else{
                                                    // let arr = ['A', 'B', 'C'];
                                                    productValueArray = productValueArray.filter(e => e !== productValue);
                                                  }


                                                });


});

 //Once remove button is clicked

 $('#category').on("change",function () {
  var element = $(this).find('option:selected');
  $('#index').val('0');
  var index=$('#index').val();
  if($(this).val() != '') {
    var categoryId = $(this).find('option:selected').val();
    $.ajax({
      url: "ajax.php",
      type: "POST",
      data: "categoryId="+categoryId,
      success: function (response) {


        $("#subcategory").html(response);
        var issubcategory=element.attr("data-issubcat");
        if(issubcategory=='No')
        {
          var classtype=element.attr("data-clastype");
          $('#classtype_id').val(classtype);  
          $.ajax({
            url: "classtypeByProduct.php",
            type: "POST",
            data: { classtype: classtype,index:index},
            success: function (response) {
              var classtype=$('#classtype_id').val();
 var obj = JSON.parse(classtype);
 var i;
for (i = 0; i < obj.length; ++i) {
  var fclastype=obj[i];
    // do something with `substr[i]`
}
if(fclastype==16)
{
  var content='<div class="row" id="div1_'+random+'_'+id+'"><div class="col-md-12"><div class="card card-outline-danger p-2"><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Date: </span><div class="col-md-9"><input type="date" name="sdate['+random+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Time: </span><div class="col-md-9"><input type="time" name="stime['+random+'][]" class="form-control"  required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Date: </span><div class="col-md-9"><input type="date" name="edate['+random+'][]" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Time: </span><div class="col-md-9"><input type="time" name="etime['+random+'][]" class="form-control"  required></div></div><hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label"> Deal Stock : </span><div class="col-md-9"><input type="text" name="dealstock['+random+'][]" class="form-control productPriceList"  placeholder="No. of Deal Item in Stock" required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Deal Price: </span><div class="col-md-9"><input type="text" name="deal_price['+random+'][]" id="dealamount0" onblur="check_dealamount(0)" class="form-control" placeholder="Only Enter Rs" ><span class="help-block" id="dealam0"></span></div></div></div></div>';
  $('#todayDealsApplicableList').html(content);
}
              $('.classtypeField').html(response);
              $('.classtypeField').scrollToCenter()
              
              $('#todayDealsApplicableList').html('');
              $('#codApplicableList').html('');
              $('#hotDealsList').html('');
              $('#newArrivalsList').html('');
              $('#topFeaturedList').html('');
if(($('.classtypeField').text()).includes('Please first add your class type'))
  {
      $('#sub').attr('disabled',true);
  }
  else
  {
          $('#sub').removeAttr('disabled');
    
  }
            }
          });

        }
        else
        {
          $('#subcat').on("change",function () {
           var element1 = $(this).find('option:selected');
           var classtype=element1.attr("data-clastype");
           $('#classtype_id').val(classtype);       
           $.ajax({
            url: "classtypeByProduct.php",
            type: "POST",
            data: { classtype: classtype,index:index},
            success: function (response) {
              $('.classtypeField').html(response);
              $('#todayDealsApplicableList').html('');
              $('#codApplicableList').html('');
              $('#hotDealsList').html('');
              $('#newArrivalsList').html('');
              $('#topFeaturedList').html('');
               var classtype=$('#classtype_id').val();
               var obj = JSON.parse(classtype);
               var i;
              for (i = 0; i < obj.length; ++i) {
                var fclastype=obj[i];
    // do something with `substr[i]`
              }
              if(fclastype==16)
              {
                 var content='<div class="row" id="div1_9"><div class="col-md-12"><div class="card card-outline-danger p-2"><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Date: </span><div class="col-md-9"><input type="date" name="sdate" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Start Time: </span><div class="col-md-9"><input type="time" name="stime" class="form-control"  required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Date: </span><div class="col-md-9"><input type="date" name="edate" class="form-control" required ></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">End Time: </span><div class="col-md-9"><input type="time" name="etime" class="form-control"  required></div></div><hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label"> Deal Stock : </span><div class="col-md-9"><input type="text" name="dealstock" class="form-control productPriceList"  placeholder="No. of Deal Item in Stock" required></div></div><div class="form-group row"><span class="label-text col-md-3 col-form-label">Deal Price: </span><div class="col-md-9"><input type="text" name="deal_price" required  class="form-control" placeholder="Only Enter Rs" id="dealamount0" onblur="check_dealamount(0)"><span class="help-block" id="dealam0"></span></div></div></div></div>';
                  $('#todayDealsApplicableList').html(content);
                  
                }
                if(($('.classtypeField').text()).includes('Please first add your class type'))
  {
      $('#sub').attr('disabled',true);
  }
  else
  {
         $('#sub').removeAttr('disabled');
    
  }

            }
          });

         });

        }



      }
    });
  } else {
    $("#subcategory").html('');
  }
  
}); 


 function getColor()
 {
   var index=$('#index').val();
   var classtype=$('#classtype_id').val();

   $.ajax({
    url: "classtypeByProduct.php",
    type: "POST",
    data: { classtype: classtype,index:index},
    success: function (response) {
     $('.classtypeField').append(response);
     let lastid='';
     $('.colorFieldWrapper').each(function(){
         
         lastid=this.id;
     });
     console.log(lastid);
      $('#'+lastid).scrollToCenter()
              
   }
 });
 }

 function remove(id)
 {
  var split_id = id.split("_");
  var deleteindex = split_id[1];

  // Remove <div> with id
  $("#div_" + deleteindex).remove();
  // $("#div1_" + deleteindex).remove();
}

function removeDeal(id)
 {
   
   // Remove <div> with id
  $("#" + id).remove();
  if(!$('div').hasClass("dealClass"))
  {
    $('#todayDealsApplicable').attr('checked', false)
  }
}

function getSize(sel,random){
    console.log(sel);
    console.log('hhh');
  $('.colorFieldWrapper').each(function(){
       var id=this.id.split('_')[1];
      var re=0;
    $('.productSizes'+id).each(function(){
        
         if($('#'+this.id).is(':checked'))
         {
             re++;
         }
    });
     $('.productSizes'+id).each(function(){
       if(!$('#'+this.id).is(':checked'))
       {
           
           if(re>0)
          $('#'+this.id).removeAttr('required');
          else
          $('#'+this.id).attr('required',true);
       }
       
     });
    });
 
  console.log(sel.value);
  selId = sel.id;
  var sizeSymbole = sel.value.split("@");
 var fields = selId.split('_');

var first = fields[1];
var second = fields[2];
var id1=first+'_'+second;
var id2="'"+id1+"'";
// var opts = [], 
// opt;
if ($("#"+selId).is(':checked')){

  var sizeSymbole = sel.value.split("@");
console.log(sizeSymbole);
// opts.push(opt);
//console.log(opt.value);
var i = Math.floor(Math.random() * 1000) + 1;
var divs='<div id="p'+selId+'"></div>';
console.log(divs);
$('#p'+selId).remove();
$('#price'+random).append(divs);

// var randomId = '-container';

var content = '<hr/><div class="form-group row"><span class="label-text col-md-3 col-form-label">'
+'Price for '+sizeSymbole[1]+': </span><div class="col-md-9">'
+'<input type="text"    onkeypress="if( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" name="price['+random+'][]" class="form-control productPriceList" id="amount_'+id1+'" '
+'placeholder="Only Enter Rs" required></div></div><div class="form-group row">'
+'<span class="label-text col-md-3 col-form-label">Discount Price: </span>'
+'<div class="col-md-9"><input type="text"    onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" name="disc_price['+random+'][]" onblur="check_amount('+id2+')"'
+' class="form-control" id="disamount_'+id1+'" placeholder="Only Enter Rs"><span class="help-block" '
+' id="disam_'+id1+'"></span></div></div>'

+'<div class="form-group row">'
+'<span class="label-text col-md-3 col-form-label">Stock: </span><div class="col-md-3">'
+'<select required name="stock['+random+'][]" id="stock'+selId+random+'" class="form-control" onchange="setStock('+random+',this);">'
+'<option value="">Select Stock</option><option value="Yes">Yes</option><option value="No">No</option>'
+'</select></div><div class="col-md-6" id="in_stock'+selId+random+'"></div></div>'

+'<div class="form-group row">'
+'<span class="label-text col-md-3 col-form-label">Min: </span><div class="col-md-3">'
+'<input type="number" name="min['+random+'][]"'
+' class="form-control" min="1" placeholder="Please enter minimum quantity"></div>'

+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Max: </span><div class="col-md-6">'
+'<input type="number" name="max['+random+'][]"'
+' class="form-control" min="0" placeholder="Please enter maximum quantity"></div></div></div>'

+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Length (in cm): </span><div class="col-md-6">'
+'<input type="number" name="length['+random+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product length" required></div></div></div>'

+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Width (in cm): </span><div class="col-md-6">'
+'<input type="number" name="width['+random+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product width" required></div></div></div>'

+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Height (in cm): </span><div class="col-md-6">'
+'<input type="number" name="height['+random+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product height" required></div></div></div>'

+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Weight (in gm): </span><div class="col-md-6">'
+'<input type="number" name="weight['+random+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product weight" required></div></div></div>';
 
//console.log(content);
$('#p'+selId).append(content);
$('#amount_'+id1).scrollToCenter()
              

//amount decimal
let amount = document.querySelector('#amount_'+id1), preAmount = amount.value;
amount.addEventListener('input', function(){
  if(isNaN(Number(amount.value))){
    amount.value = preAmount;
    return;
  }

  let numberAfterDecimal = amount.value.split(".")[1];
  if(numberAfterDecimal && numberAfterDecimal.length > 3){
    amount.value = Number(amount.value).toFixed(3);
  }
  preAmount = amount.value;
});
//discount decimal
let disamount = document.querySelector('#disamount_'+id1), preAmounts = disamount.value;
disamount.addEventListener('input', function(){
  if(isNaN(Number(disamount.value))){
    disamount.value = preAmounts;
    return;
  }

  let numberAfterDecimals = disamount.value.split(".")[1]; 
  if(numberAfterDecimals && numberAfterDecimals.length > 3){
    disamount.value = Number(disamount.value).toFixed(3);
  }
  preAmounts = disamount.value;
});

}else{
// console.log(i);
$('#p'+selId).remove();
$('#topFeatured'+sizeSymbole[0]+'1').remove();
$('#newArrivals'+sizeSymbole[0]+'1').remove();
$('#hotDeals'+sizeSymbole[0]+'1').remove();
$('#codApplicable'+sizeSymbole[0]+'1').remove();
}

}

function check(imageId) {
  var x =  document.getElementById(imageId);
  if ('files' in x)
  {
    for (var i = 0; i < x.files.length; i++)
    {      
      var file = x.files[i];
      if ('name' in file)
      {
        var ext = file.name.split('.').pop().toLowerCase();
        if($.inArray(ext, ['png','jpg','jpeg']) === -1)
        {
          document.getElementById(imageId).value = "";
          document.getElementById("er"+imageId).innerHTML='<font color="red"><b>You are trying to upload files which not allowed ' + "(" + file.name + " is invalid). <br/>Please select 'png','jpg' or 'jpeg' images.</b></font>";
            document.getElementById('sub').disabled=true;
           
          
        }   
        else{
          $('#er'+imageId).empty();
          createReader(file, function(w, h){
            console.log(file.name+' '+w+' '+h);
            if((w < 1000) || (h < 1000))
            {
              $('#er'+imageId).empty();
              document.getElementById(imageId).value = "";
              document.getElementById("er"+imageId).innerHTML='<font color="red"><b>'+file.name+' is not match with dimensions. <br/>Please Select Image of  Width : 1000px and  Height: 1000px.</b></font>';
              
               document.getElementById('sub').disabled=true;
            
            }
            else if((w > 1000) || (h > 1000))
            {
              $('#er'+imageId).empty();
              document.getElementById(imageId).value = "";
              document.getElementById("er"+imageId).innerHTML='<font color="red"><b>'+file.name+' is not match with dimensions. <br/>Please Select Image of  Width : 1000px and  Height: 1000px.</b></font>';
              
               document.getElementById('sub').disabled=true;
            
            }
            else{ document.getElementById("er"+imageId).innerHTML='Image Dimension Height:'+h+'px and Width: '+w+'px';
            if(($('.classtypeField').text()).includes('Please first add your class type'))
  {
      $('#sub').attr('disabled',true);
  }
  else
  {
          $('#sub').removeAttr('disabled');
    
  }
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


function getthSizePrice(sel,random){
    console.log(sel);
  console.log(random);
  $('.colorFieldWrapper').each(function(){
       var id=this.id.split('_')[1];
      var re=0;
    $('.productSizes'+id).each(function(){
        
         if($('#'+this.id).is(':checked'))
         {
             re++;
         }
    });
     $('.productSizes'+id).each(function(){
       if(!$('#'+this.id).is(':checked'))
       {
           
           if(re>0)
          $('#'+this.id).removeAttr('required');
          else
          $('#'+this.id).attr('required',true);
       }
       
     });
    });
  $('.colorFieldWrapper').each(function(){
       var id=this.id.split('_')[1];
      var re=0;
    $('.productSizesClass'+id).each(function(){
        
         if($('#'+this.id).is(':checked'))
         {
             re++;
         }
    });
     $('.productSizesClass'+id).each(function(){
       if(!$('#'+this.id).is(':checked'))
       {
           
           if(re>0)
          $('#'+this.id).removeAttr('required');
          else
          $('#'+this.id).attr('required',true);
       }
       
     });
    });
 
  selId = sel.id;
  var sizeSymbole = sel.value.split("@");
  var classElement = document.getElementsByClassName("productClassList");
var fields = selId.split('_');

var first = fields[1];
var second = fields[2];
var id1=first+'_'+second;
// var opts = [], 
// opt;


if ($("#"+selId).is(':checked')){

  var sizeSymbole = sel.value.split("@");

// opts.push(opt);
//console.log(opt.value);
// var divs='<div id="p'+selId+'"></div>';
// console.log(divs);
// $('#p'+selId).remove();
// $('#price'+random).append(divs);
var content="";
var j=0;
// var randomId = '-container';
for(k=0; k<classElement.length; k++){
var id2="'"+id1+'_'+k+"'";

  var i = Math.floor(Math.random() * 1000) + 1;
  classId = classElement[k].id;
  randomClassArr = classId.split("_");
  if(random==randomClassArr[1]) 
  {    
    if ($("#"+classId).is(':checked')){
      console.log(classId);

      forClass = $('#'+classId).val();

      forClassSymbole = forClass.split("@");
      var content1 ='<div id="p'+selId+'">';
// console.log(divs);
$('#p'+selId).remove();
$('#price'+random).append(content1);

content += '<hr/><div id="sizecls_'+id1+'_'+k+'"><div class="form-group row"><span class="label-text col-md-3 col-form-label">'
+'Price for '+forClassSymbole[1]+'('+sizeSymbole[1]+'): </span><div class="col-md-9">'
+'<input type="text" name="price['+random+']['+j+'][]"    onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" class="form-control productPriceList" id="amount_'+id1+'_'+k+'" '
+'placeholder="Only Enter Rs" required></div></div><div class="form-group row">'
+'<span class="label-text col-md-3 col-form-label">Discount Price: </span>'
+'<div class="col-md-9"><input type="text"   onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" name="disc_price['+random+']['+j+'][]" onblur="check_amount('+id2+')"'
+' class="form-control" id="disamount_'+id1+'_'+k+'" placeholder="Only Enter Rs"><span class="help-block" '
+' id="disam_'+id1+'_'+k+'"></span></div></div>'

+'<div class="form-group row">'
+'<span class="label-text col-md-3 col-form-label">Stock: </span><div class="col-md-3">'
+'<select required name="stock['+random+']['+j+'][]" id="stock'+selId+random+j+'" class="form-control" onchange="setStock1('+random+','+j+',this);">'
+'<option value="">Select Stock</option><option value="Yes">Yes</option><option value="No">No</option>'
+'</select></div><div class="col-md-6" id="in_stock'+selId+random+j+'"></div></div>'

+'<div class="form-group row">'
+'<span class="label-text col-md-3 col-form-label">Min: </span><div class="col-md-3">'
+'<input type="number" name="min['+random+']['+j+'][]"'
+' class="form-control" min="1" placeholder="Please enter minimum quantity"></div>'
+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Max: </span><div class="col-md-6">'
+'<input type="number" name="max['+random+']['+j+'][]"'
+' class="form-control" min="0" placeholder="Please enter maximum quantity"></div></div></div>'
+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Length (in cm): </span><div class="col-md-6">'
+'<input type="number" name="length['+random+']['+j+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product length" required></div></div></div>'

+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Width (in cm): </span><div class="col-md-6">'
+'<input type="number" name="width['+random+']['+j+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product width" required></div></div></div>'

+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Height (in cm): </span><div class="col-md-6">'
+'<input type="number" name="height['+random+']['+j+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product height" required></div></div></div>'

+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Weight (in gm): </span><div class="col-md-6">'
+'<input type="number" name="weight['+random+']['+j+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product weight" required></div></div></div>';
 
j++;
}
}
}

$('#p'+selId).append(content);
//amount decimal
// let amount = document.querySelector('#amount'+i), preAmount = amount.value;
// amount.addEventListener('input', function(){
//     if(isNaN(Number(amount.value))){
//         amount.value = preAmount;
//         return;
//     }

//     let numberAfterDecimal = amount.value.split(".")[1];
//     if(numberAfterDecimal && numberAfterDecimal.length > 3){
//         amount.value = Number(amount.value).toFixed(3);
//     }
//     preAmount = amount.value;
// });
// //discount decimal
// let disamount = document.querySelector('#disamount'+i), preAmounts = disamount.value;
// disamount.addEventListener('input', function(){
//     if(isNaN(Number(disamount.value))){
//         disamount.value = preAmounts;
//         return;
//     }

//     let numberAfterDecimals = disamount.value.split(".")[1]; 
//     if(numberAfterDecimals && numberAfterDecimals.length > 3){
//         disamount.value = Number(disamount.value).toFixed(3);
//     }
//     preAmounts = disamount.value;
// });

}else{
// console.log(i);
$('#p'+selId).remove();
$('#topFeatured'+sizeSymbole[0]+'1').remove();
$('#newArrivals'+sizeSymbole[0]+'1').remove();
$('#hotDeals'+sizeSymbole[0]+'1').remove();
$('#codApplicable'+sizeSymbole[0]+'1').remove();
}

}

function getthSizePrice(sel,random){
    
   
    $('.productSizesClass'+random).each(function(){
        
         if($('#'+this.id).is(':checked'))
         {
             var indexl=this.id.split('_');
             var index=indexl[(indexl.length)-1];
            getSizePrice(this,random);
            getDeal(this,random,index)
         }
    });
    
}

function getSizePrice(sel,random){

  
  $('.colorFieldWrapper').each(function(){
       var id=this.id.split('_')[1];
      var re=0;
    $('.productSizes'+id).each(function(){
        
         if($('#'+this.id).is(':checked'))
         {
             re++;
         }
    });
     $('.productSizes'+id).each(function(){
       if(!$('#'+this.id).is(':checked'))
       {
           
           if(re>0)
          $('#'+this.id).removeAttr('required');
          else
          $('#'+this.id).attr('required',true);
       }
       
     });
    });
  $('.colorFieldWrapper').each(function(){
       var id=this.id.split('_')[1];
      var re=0;
    $('.productSizesClass'+id).each(function(){
        
         if($('#'+this.id).is(':checked'))
         {
             re++;
         }
    });
     $('.productSizesClass'+id).each(function(){
       if(!$('#'+this.id).is(':checked'))
       {
           
           if(re>0)
          $('#'+this.id).removeAttr('required');
          else
          $('#'+this.id).attr('required',true);
       }
       
     });
    });
 
  selId = sel.id;
  var sizeSymbole = sel.value.split("@");
  var classElement = document.getElementsByClassName("productSizeList");
var fields = selId.split('_');

var first = fields[1];
var second = fields[2];
var id1=first+'_'+second;
// var opts = [], 
// opt;


if ($("#"+selId).is(':checked')){

  var sizeSymbole = sel.value.split("@");

// opts.push(opt);
//console.log(opt.value);
// var divs='<div id="p'+selId+'"></div>';
// console.log(divs);
// $('#p'+selId).remove();
// $('#price'+random).append(divs);
var content="";
var j=0;
// var randomId = '-container';
for(k=0; k<classElement.length; k++){
var id2="'"+id1+'_'+k+"'";

  var i = Math.floor(Math.random() * 1000) + 1;
  classId = classElement[k].id;
  randomClassArr = classId.split("_");
  if(random==randomClassArr[1]) 
  {    
    if ($("#"+classId).is(':checked')){
      console.log(classId);

      forClass = $('#'+classId).val();

      forClassSymbole = forClass.split("@");
      var content1 ='<div id="p'+selId+'">';
// console.log(divs);
$('#p'+selId).remove();
$('#price'+random).append(content1);

content += '<hr/><div id="sizecls_'+id1+'_'+parseInt(k)+1+'"><div class="form-group row"><span class="label-text col-md-3 col-form-label">'
+'Price for '+forClassSymbole[1]+'('+sizeSymbole[1]+'): </span><div class="col-md-9">'
+'<input type="text" name="price['+random+']['+j+'][]"  maxlength="13"  onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" class="form-control productPriceList" id="amount_'+id1+'_'+k+'" '
+'placeholder="Only Enter Rs" required></div></div><div class="form-group row">'
+'<span class="label-text col-md-3 col-form-label">Discount Price: </span>'
+'<div class="col-md-9"><input type="text"   onkeypress="if ( isNaN(this.value + String.fromCharCode(event.keyCode) )) return false;" name="disc_price['+random+']['+j+'][]" onblur="check_amount('+id2+')"'
+' class="form-control" id="disamount_'+id1+'_'+k+'" placeholder="Only Enter Rs"><span class="help-block" '
+' id="disam_'+id1+'_'+k+'"></span></div></div>'

+'<div class="form-group row">'
+'<span class="label-text col-md-3 col-form-label">Stock: </span><div class="col-md-3">'
+'<select required name="stock['+random+']['+j+'][]" id="stock'+selId+random+j+'" class="form-control" onchange="setStock1('+random+','+j+',this);">'
+'<option value="">Select Stock</option><option value="Yes">Yes</option><option value="No">No</option>'
+'</select></div><div class="col-md-6" id="in_stock'+selId+random+j+'"></div></div>'

+'<div class="form-group row">'
+'<span class="label-text col-md-3 col-form-label">Min: </span><div class="col-md-3">'
+'<input type="number" name="min['+random+']['+j+'][]"'
+' class="form-control" min="1" placeholder="Please enter minimum quantity"></div>'
+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Max: </span><div class="col-md-6">'
+'<input type="number" name="max['+random+']['+j+'][]"'
+' class="form-control" min="0" placeholder="Please enter maximum quantity"></div></div></div>'
+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Length (in cm): </span><div class="col-md-6">'
+'<input type="number" name="length['+random+']['+j+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product length" required></div></div></div>'

+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Width (in cm): </span><div class="col-md-6">'
+'<input type="number" name="width['+random+']['+j+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product width" required></div></div></div>'

+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Height (in cm): </span><div class="col-md-6">'
+'<input type="number" name="height['+random+']['+j+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product height" required></div></div></div>'

+'<div class="col-md-6" id="">'
+'<div class="row"><span class="label-text col-md-6 col-form-label">Weight (in gm): </span><div class="col-md-6">'
+'<input type="number" name="weight['+random+']['+j+'][]"'
+' class="form-control no_arrows_numInp" min="0" placeholder="Please enter product weight" required></div></div></div></div></div>';
 
 
j++;
}

}

}
var ids='#sizecls_'+id1+'_'+parseInt(k);
console.log(ids);
// $('html, body').animate({
//         scrollTop: $('+ids+').offset().top
//     }, 1000);
$('#p'+selId).append(content);
//amount decimal
// let amount = document.querySelector('#amount'+i), preAmount = amount.value;
// amount.addEventListener('input', function(){
//     if(isNaN(Number(amount.value))){
//         amount.value = preAmount;
//         return;
//     }

//     let numberAfterDecimal = amount.value.split(".")[1];
//     if(numberAfterDecimal && numberAfterDecimal.length > 3){
//         amount.value = Number(amount.value).toFixed(3);
//     }
//     preAmount = amount.value;
// });
// //discount decimal
// let disamount = document.querySelector('#disamount'+i), preAmounts = disamount.value;
// disamount.addEventListener('input', function(){
//     if(isNaN(Number(disamount.value))){
//         disamount.value = preAmounts;
//         return;
//     }

//     let numberAfterDecimals = disamount.value.split(".")[1]; 
//     if(numberAfterDecimals && numberAfterDecimals.length > 3){
//         disamount.value = Number(disamount.value).toFixed(3);
//     }
//     preAmounts = disamount.value;
// });

}else{
// console.log(i);
$('#p'+selId).remove();
$('#topFeatured'+sizeSymbole[0]+'1').remove();
$('#newArrivals'+sizeSymbole[0]+'1').remove();
$('#hotDeals'+sizeSymbole[0]+'1').remove();
$('#codApplicable'+sizeSymbole[0]+'1').remove();
}

}




function setStock(random,q){

  status = q.value;
  id = q.id;

  var divs='<div id="nstock'+id+'"></div>';
  console.log(divs);
  $('#nstock'+id).remove();
  $('#in_'+id).append(divs);


  if (status=='Yes'){

   console.log("asas");
   var content = '<div class="row"><span class="label-text col-md-6 col-form-label">Quantity: </span><div class="col-md-6">'
   +'<input type="number" name="inStock['+random+'][]"'
   +' class="form-control" min="0" placeholder="No. of Item in Stock" required>'
   +'</div></div>';
   $('#nstock'+id).append(content);
 }else{
  $('#nstock'+id).remove();
}
}

function setStock1(random,p,q){

  status = q.value;
  id = q.id;

  var divs='<div id="nstock'+id+'"></div>';
  console.log(divs);
  $('#nstock'+id).remove();
  $('#in_'+id).append(divs);


  if (status=='Yes'){

   console.log("asas");
   var content = '<div class="row"><span class="label-text col-md-6 col-form-label">Quantity: </span><div class="col-md-6">'
   +'<input type="number" name="inStock['+random+']['+p+'][]"'
   +' class="form-control" min="0" placeholder="No. of Item in Stock" required>'
   +'</div></div>';
   $('#nstock'+id).append(content);
 }else{
  $('#nstock'+id).remove();
}
}

function check_amount(id)
{
  //alert("hi");
  var price=document.getElementById('amount_'+id).value;
  var discount=document.getElementById('disamount_'+id).value;
  console.log(price);
  console.log(discount);
 // console.log(discount > price);
 if(discount!=='')
 {
  if(parseFloat(discount) > parseFloat(price))
  {
  //alert(id);

    document.getElementById('disam_'+id).innerHTML='<font color="red">Discount price should be less than actual price</font>';
    
    if(($('.classtypeField').text()).includes('Please first add your class type'))
  {
      $('#sub').attr('disabled',true);
  }
  else
  {
          $('#sub').removeAttr('disabled');
    
  }
    setTimeout(fade_out, 4000);
    function fade_out() {
      $("#disam"+id).innerHTML='';
    }
  }
  else{
    document.getElementById('disam_'+id).innerHTML='';
    document.getElementById('sub').disabled=false;
  }
}
if(price===''){
  document.getElementById('disam_'+id).innerHTML='<font color="red">Please fill the price</font>'; 
  document.getElementById('disamount'+id).value=''; 
  setTimeout(fade_out, 4000);
  function fade_out() {
    $("#disam_"+id).innerHTML='';
  }
}
}

function check_dealamount(id)
{
  // alert("hlw");
  var price=document.getElementById('amount_'+id).value;
  console.log(price);
  console.log(discount);
 // console.log(discount > price);
 if(discount!=='')
 {
  if(parseFloat(discount) > parseFloat(price))
  {
  // alert('hi');
  // alert(id);

    document.getElementById('dealam'+id).innerHTML='<font color="red">Deal price should be less than actual price</font>';
    
    if(($('.classtypeField').text()).includes('Please first add your class type'))
  {
      $('#sub').attr('disabled',true);
  }
  else
  {
          $('#sub').removeAttr('disabled');
    
  }
    setTimeout(fade_out, 4000);
    function fade_out() {
      $("#dealam"+id).innerHTML='';
    }
  }
  else{
    document.getElementById('dealam'+id).innerHTML='';
    document.getElementById('sub').disabled=false;
  }
}
if(price===''){
  document.getElementById('dealam'+id).innerHTML='<font color="red">Please fill the price</font>'; 
  document.getElementById('dealamount'+id).value=''; 
  setTimeout(fade_out, 4000);
  function fade_out() {
    $("#dealam"+id).innerHTML='';
  }
}
}

</script>

<?php include('includes/footer.php');
?>
<script>

function prevImages(input) {
    var imageDiv = document.getElementById('imagePreview');
  imageDiv.innerHTML = "";

console.log('kd' + check(input.id))
  
  if (check(input.id)){
      if (input.files && input.files.length > 0) {
    for (var i = 0; i < input.files.length; i++) {
      var img = document.createElement("img");
      img.classList.add("preview-image");
      img.src = URL.createObjectURL(input.files[i]);
      imageDiv.appendChild(img);
    }
  }
  }
  
  if(($('.classtypeField').text()).includes('Please first add your class type'))
  {
      $('#sub').attr('disabled',true);
  }
  else
  {
          $('#sub').removeAttr('disabled');
    
  }
}

</script>
<script src="//cdn.ckeditor.com/4.13.1/full/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'editor', {
    toolbar: [
    { name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Preview',  '-', 'Templates' ] },
    { name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: [ 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo' ] },
    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', 'Replace', '-', 'SelectAll', '-', 'Scayt' ] },
    { name: 'forms', items: [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField' ] },
    '/',
    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock', '-', 'BidiLtr', 'BidiRtl', 'Language' ] },
    { name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
    { name: 'insert', items: ['Table', 'HorizontalRule', 'Smiley', 'SpecialChar', 'PageBreak', 'Iframe' ] },
    '/',
    { name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
    { name: 'colors', items: [ 'TextColor', 'BGColor' ] },
    { name: 'tools', items: [ 'Maximize', 'ShowBlocks' ] },
    { name: 'others', items: [ '-' ] },
    { name: 'about', items: [ 'About' ] }
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


 

  $category=$_POST['category'];
  $subcategory='';
  if(isset($_POST['subcategory']))
  {
    $subcategory=$_POST['subcategory'];
  }
  $product=addslashes($_POST['product']);
  $product_tax = (isset($_POST['product_tax'])) ? $_POST['product_tax'] : 0 ;

  {
    $classtype=json_decode($_POST['classtype_id']);

    $w=1;
    if(count($classtype)==2)
    { 
        
      foreach($_POST['productColor'] as  $key=>$color){
         $p_uniqu = uniqid();

    //   $key = array_search($color, $_POST['productColor']);

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

        $length  = $_POST['length'][$key][$i];
        $height = $_POST['height'][$key][$i];
        $width = $_POST['width'][$key][$i];
        $weigth = $_POST['weight'][$key][$i];

        $inStockQ = (isset($_POST['inStock'][$key][$i])) ? $_POST['inStock'][$key][$i] : 0;
        $stock = (isset($_POST['stock'][$key][$i])) ? $_POST['stock'][$key][$i] : NULL;

        $min = (isset($_POST['min'][$key][$i])) ? $_POST['min'][$key][$i] : 1;
        $max = (isset($_POST['max'][$key][$i])) ? $_POST['max'][$key][$i] : NULL;

        if($min == ""){
          $min = 1;
        }
          /// If Discount Is NULL
        if($disc_price==""){
          $disc_price =  0;
        }

        $mySqlQuery = "INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`tax`,`brand`,`class1`, `price`,`discount`, `length`,`height`,`width`, `weight`, `hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`in_stock`,`minimum`,`maximum`,`class0`,`product_code`,`group_code`,`date`,`time`) VALUES "
        . "('$category','$subcategory','$product','".$product_tax."',".addslashes($_POST['brand'])."','".$color."','".$price."','".$disc_price."','$length','$height','$width','$weigth', '$hot','$new','$top','$cod','$stock','$inStockQ','$min','$max','".$sizeInfo[0]."','".$p_uniqu."','".$groupCode."','$date','$time')";
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

          $todayDeal=$_POST['todayDeal'];
       if($todayDeal=='Yes')
       {
        if(!empty($_POST['sdate'][$key][$i]))
        {
               $dealquery=mysqli_query($conn,"INSERT INTO `today_deal`(`pid`, `startdate`, `starttime`, `enddate`,`endtime`, `stock`,`price`) VALUES ('$lastProductID','".$_POST['sdate'][$key][$i]."','".$_POST['stime'][$key][$i]."','".$_POST['edate'][$key][$i]."','".$_POST['etime'][$key][$i]."','".$_POST['dealstock'][$key][$i]."','".$_POST['deal_price'][$key][$i]."')")or die(mysqli_error());
        }

       }
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

          $metaKeywordQuery="INSERT INTO keywords(pid,seo_id,keyword,status) VALUES";

          foreach($keys as $val1)
          {
            $metaKeywordQuery.="('$lastProductID',".$pageid.",'".$val1."','Active'),";
          }
          $metaKeywordQuery=substr($metaKeywordQuery, 0,-1);
          $query1=mysqli_query($conn,$metaKeywordQuery);

        }

        $i++;

      }
      
      //images
    

    }


$image_name=($_FILES["image"]["name"][$key]);  
    $image_type=($_FILES["image"]["tmp_name"][$key]);  
    $ik=0;
    foreach ($image_name as $imageKey => $value)
    {

      $mul_img=$_FILES["image"]["tmp_name"][$key][$ik];

      $temp = explode(".", $value);
      $newfilename = round(microtime(true)). $ik . '.' . end($temp);

      move_uploaded_file($mul_img,"../asset/image/product/".$newfilename);
      
      $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('$category','$subcategory','$p_uniqu','$newfilename')")or die(mysqli_error());
      $ik++;
    }
   

  }
 
}
else if(count($classtype)==1 && $classtype[0]!=16)
{
  $i=0;
  $key=0;
   if($classtype[0]!=1)
   {
   $p_uniqu = uniqid();
   }
  foreach($_POST['productSizes'][$key] as $size){
   if($classtype[0]==1)
   {
   $p_uniqu = uniqid();
   }
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

    $length  = $_POST['length'][$key][$i];
    $height = $_POST['height'][$key][$i];
    $width = $_POST['width'][$key][$i];
    $weigth = $_POST['weight'][$key][$i];

    $inStockQ = (isset($_POST['inStock'][$key][$i])) ? $_POST['inStock'][$key][$i] : 0;
    $stock = (isset($_POST['stock'][$key][$i])) ? $_POST['stock'][$key][$i] : NULL;

    $min = (isset($_POST['min'][$key][$i])) ? $_POST['min'][$key][$i] : 1;
    $max = (isset($_POST['max'][$key][$i])) ? $_POST['max'][$key][$i] : NULL;

    if($min == ""){
      $min = 1;
    }
    /// If Discount Is NULL
    if($disc_price==""){
      $disc_price = 0;
    }
    $color="";
     $mySqlQuery = "INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`tax`,`brand`,`class1`, `price`,`discount`, `length`,`height`,`width`, `weight`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`in_stock`,`minimum`,`maximum`,`class0`,`product_code`,`group_code`,`date`,`time`) VALUES "
    . "('$category','$subcategory','$product','".$product_tax."','".addslashes($_POST['brand'])."','".$color."','".$price."','".$disc_price."','$length','$height','$width','$weigth', '$hot','$new','$top','$cod','$stock','$inStockQ','$min','$max','".$sizeInfo[0]."','".$p_uniqu."','".$groupCode."','$date','$time')";
   
   
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
      if(isset($_POST['todayDeal']))
      {
       $todayDeal=$_POST['todayDeal'];
     
       $todayDeal=$_POST['todayDeal'];
       if($todayDeal=='Yes')
       {
        if(!empty($_POST['sdate'][$key][$i]))
           $dealquery=mysqli_query($conn,"INSERT INTO `today_deal`(`pid`, `startdate`, `starttime`, `enddate`,`endtime`, `stock`,`price`) VALUES ('$lastProductID','".$_POST['sdate'][$key][$i]."','".$_POST['stime'][$key][$i]."','".$_POST['edate'][$key][$i]."','".$_POST['etime'][$key][$i]."','".$_POST['dealstock'][$key][$i]."','".$_POST['deal_price'][$key][$i]."')")or die(mysqli_error());

       }
      }
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

      $metaKeywordQuery="INSERT INTO keywords(pid,seo_id,keyword,status) VALUES";
   
      foreach($keys as $val1)
      {
        $metaKeywordQuery.="('$lastProductID',".$pageid.",'".$val1."','Active'),";
      }
      $metaKeywordQuery=substr($metaKeywordQuery, 0,-1);
      $query1=mysqli_query($conn,$metaKeywordQuery);

    }

    $i++;
    //images
    if(count($_FILES["image"]['name'][$key])==count($_POST['productSizes'][$key]))
    {
$image_name=($_FILES["image"]["name"][$key]);  
$image_type=($_FILES["image"]["tmp_name"][$key]);
}
else
{
$image_name=($_FILES["image"]["name"][0]);  
$image_type=($_FILES["image"]["tmp_name"][0]);
  
}

$ik=0;
foreach ($image_name as $imageKey => $value)
{

// print_r($value);
  $mul_img=$_FILES["image"]["tmp_name"][$key][$imageKey];
// print_r($_FILES["image"]["tmp_name"]);
// exit();

  $temp = explode(".", $value);
   $newfilename = round(microtime(true)). $imageKey . '.' . end($temp);

  move_uploaded_file($mul_img,"../asset/image/product/".$newfilename);

  $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('$category','$subcategory','$p_uniqu','$newfilename')")or die(mysqli_error());
  $ik++;
}

  }

}



}
elseif($classtype[0]==16)
{

  $i=0;
  $key=0;
  $p_uniqu = uniqid();

  $new='No'; $hot='No'; $top='No'; $cod='No';


  if(isset($_POST['new']))
    { $new = (isset($_POST['new'])) ? $_POST['new'] : "No"; }
  if(isset($_POST['hot']))
    { $hot = (isset($_POST['hot'])) ? $_POST['hot'] : "No"; }
  if(isset($_POST['top']))
    { $top = (isset($_POST['top'])) ? $_POST['top'] : "No"; }
  if(isset($_POST['cod']))
    { $cod = (isset($_POST['cod'])) ? $_POST['cod'] : "No"; }

  $price = $_POST['price'];
  $disc_price = $_POST['disc_price'];
  $length  = $_POST['length'];
  $height = $_POST['height'];
  $width = $_POST['width'];
  $weigth = $_POST['weight'];

  $inStockQ = (isset($_POST['inStock'][0][0])) ? $_POST['inStock'][0][0] : 0;
  $stock = (isset($_POST['stock'])) ? $_POST['stock'] : NULL;

  $min = (isset($_POST['min'])) ? $_POST['min'] : 1;
  $max = (isset($_POST['max'])) ? $_POST['max'] : NULL;

  if($min == ""){
    $min = 1;
  }
    /// If Discount Is NULL
  if($disc_price==""){
    $disc_price =  0;
  }
  $color="";
  $mySqlQuery = "INSERT INTO `products`(`cat_id`, `subcat_id`,`product_name`,`tax`,`brand`,`class1`, `price`,`discount`, `length`,`height`,`width`, `weight`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`in_stock`,`minimum`,`maximum`,`class0`,`product_code`,`group_code`,`date`,`time`) VALUES "
  . "('$category','$subcategory','$product','".$product_tax."','".addslashes($_POST['brand'])."','','".$price."','".$disc_price."','$length','$height','$width','$weigth','$hot','$new','$top','$cod','$stock','$inStockQ','$min','$max','','".$p_uniqu."','".$groupCode."','$date','$time')";
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

    $todayDeal=$_POST['todayDeal'];
         if($todayDeal=='Yes')
       {
        if(!empty($_POST['sdate']))
           $dealquery=mysqli_query($conn,"INSERT INTO `today_deal`(`pid`, `startdate`, `starttime`, `enddate`,`endtime`, `stock`,`price`) VALUES ('$lastProductID','".$_POST['sdate']."','".$_POST['stime']."','".$_POST['edate']."','".$_POST['etime']."','".$_POST['dealstock']."','".$_POST['deal_price']."')")or die(mysqli_error());

       }

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

    $metaKeywordQuery="INSERT INTO keywords(pid,seo_id,keyword,status) VALUES";
    foreach($keys as $val1)
    {
    
      $metaKeywordQuery.="('$lastProductID', ".$pageid.",'".$val1."','Active'),";
    };
    $metaKeywordQuery=substr($metaKeywordQuery, 0,-1);
    $query1=mysqli_query($conn,$metaKeywordQuery);

  }
  
  //images
$image_name=($_FILES["image"]["name"][$key]);  
$image_type=($_FILES["image"]["tmp_name"][$key]);  
$ik=0;
foreach ($image_name as $imageKey => $value)
{

// print_r($value);
  $mul_img=$_FILES["image"]["tmp_name"][$key][$ik];
// print_r($_FILES["image"]["tmp_name"]);
// exit();

  $temp = explode(".", $value);
  $newfilename = round(microtime(true)). $ik . '.' . end($temp);

  move_uploaded_file($mul_img,"../asset/image/product/".$newfilename);

  $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('$category','$subcategory','$p_uniqu','$newfilename')")or die(mysqli_error());
  $ik++;
}

  $i++;

}

}
else if(count($classtype)==3)
{
  foreach($_POST['productColor'] as $color){

   $key = array_search($color, $_POST['productColor']);
 $p_uniqu = uniqid();
     
   

   $i=0;
   $k=0;
   foreach($_POST['productSizes'][$key] as $v3=>$size)
   {

    foreach($_POST['productSizesClass'][$key] as $k1=>$class)
    {

      $new='No'; $hot='No'; $top='No'; $cod='No';

      $sizeInfo = explode("@",$size);
      $classInfo = explode("@",$class);

      if(isset($_POST['new']))
        { $new = (isset($_POST['newArrivals'][$key][$sizeInfo[0]][$classInfo[0]])) ? $_POST['newArrivals'][$key][$sizeInfo[0]][$classInfo[0]] : "No"; }
      if(isset($_POST['hot']))
        { $hot = (isset($_POST['hotDeals'][$key][$sizeInfo[0]][$classInfo[0]])) ? $_POST['hotDeals'][$key][$sizeInfo[0]][$classInfo[0]] : "No"; }
      if(isset($_POST['top']))
        { $top = (isset($_POST['topFeatured'][$key][$sizeInfo[0]][$classInfo[0]])) ? $_POST['topFeatured'][$key][$sizeInfo[0]][$classInfo[0]] : "No"; }
      if(isset($_POST['cod']))
        { $cod = (isset($_POST['codApplicable'][$key][$sizeInfo[0]][$classInfo[0]])) ? $_POST['codApplicable'][$key][$sizeInfo[0]][$classInfo[0]] : "No"; }
      $j=0;
                  // if(count($_POST['productSizes'][$key])>1)
                  // {
      $price = $_POST['price'][$key][$v3][$k1];
      $disc_price = $_POST['disc_price'][$key][$v3][$k1];

      $length  = $_POST['length'][$key][$v3][$k1];
        $height = $_POST['height'][$key][$v3][$k1];
        $width = $_POST['width'][$key][$v3][$k1];
        $weigth = $_POST['weight'][$key][$v3][$k1];


      $inStockQ = (isset($_POST['inStock'][$key][$v3][$k1])) ? $_POST['inStock'][$key][$v3][$k1] : 0;
      $stock = (isset($_POST['stock'][$key][$v3][$k1])) ? $_POST['stock'][$key][$v3][$k1] : NULL;

      $min = (isset($_POST['min'][$key][$v3][$k1])) ? $_POST['min'][$key][$v3][$k1] : 1;
      $max = (isset($_POST['max'][$key][$v3][$k1])) ? $_POST['max'][$key][$v3][$k1] : NULL;

      if($min == ""){
        $min = 1;
      }
      if($disc_price==""){
        $disc_price =  0;
      }

      $mySqlQuery = "INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`tax`,`brand`,`class1`, `price`,`discount`, `length`,`height`,`width`, `weight`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`in_stock`,`minimum`,`maximum`,`class0`,`class2`,`product_code`,`group_code`,`date`,`time`) VALUES "
      . "('$category','$subcategory','$product','".$product_tax."','".addslashes($_POST['brand'])."','".$color."','".$price."','".$disc_price."','$length','$height','$width','$weigth','$hot','$new','$top','$cod','$stock','$inStockQ','$min','$max','".$sizeInfo[0]."','".$classInfo[0]."','".$p_uniqu."','".$groupCode."','$date','$time')";
                // echo $mySqlQuery;
      $query=mysqli_query($conn,$mySqlQuery)or die(mysqli_error());


      $sel_query=mysqli_query($conn,"SELECT MAX(id) as id FROM `products`");
      if(mysqli_num_rows($sel_query)>0)
      {
        $vaar= mysqli_fetch_assoc($sel_query);
        $lastProductID=$vaar['id'];
                    // $lastProductID=1;
        $dquery=mysqli_query($conn,"INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`,`created_time`) VALUES ('$lastProductID','$inStockQ','Credit','$date','$time')")or die(mysqli_error());
        $description=$_POST['editor'];

        $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('$category','$subcategory','$lastProductID','$description')")or die(mysqli_error());

       $todayDeal=$_POST['todayDeal'];
       if($todayDeal=='Yes')
       {
        if(!empty($_POST['sdate'][$key][$v3][$k1]))
           $dealquery=mysqli_query($conn,"INSERT INTO `today_deal`(`pid`, `startdate`, `starttime`, `enddate`,`endtime`, `stock`,`price`) VALUES ('$lastProductID','".$_POST['sdate'][$key][$v3][$k1]."','".$_POST['stime'][$key][$v3][$k1]."','".$_POST['edate'][$key][$v3][$k1]."','".$_POST['etime'][$key][$v3][$k1]."','".$_POST['dealstock'][$key][$v3][$k1]."','".$_POST['deal_price'][$key][$v3][$k1]."')")or die(mysqli_error());

       }
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

        $metaKeywordQuery="INSERT INTO keywords(pid,seo_id,keyword,status) VALUES";"INSERT INTO keywords(pid,seo_id,keyword,status) VALUES";
        foreach($keys as $val1)
        { 
          $metaKeywordQuery.="('$lastProductID',".$pageid.",'".$val1."','Active'),";
        }
        $metaKeywordQuery=substr($metaKeywordQuery, 0,-1);
        $query1=mysqli_query($conn,$metaKeywordQuery);

      }
    }


    $j++;
  }
  $k++;
}

$image_name=($_FILES["image"]["name"][$key]);  
$image_type=($_FILES["image"]["tmp_name"][$key]);  
$ik=0;
foreach ($image_name as $imageKey => $value)
{

  $mul_img=$_FILES["image"]["tmp_name"][$key][$ik];

  $temp = explode(".", $value);
  $newfilename = round(microtime(true)). $ik . '.' . end($temp);
  move_uploaded_file($mul_img,"../asset/image/product/".$newfilename);

  $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('$category','$subcategory','$p_uniqu','$newfilename')")or die(mysqli_error());
  $ik++;
}

$i++;

}

}
echo '<div id="snackbar">Product Added Sucessfully...</div>';

if($query)
{
echo '<div id="snackbar">Product Added Sucessfully...</div>';
echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
 echo "var delay = 1000;setTimeout(function(){ window.location = 'view-products-list.php?product=".$groupCode."'; }, delay);";
echo "</script>";
}
else
{
   echo '<div id="snackbar">Your Product Not Added..</div>';
      echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
}
}

} ?>


