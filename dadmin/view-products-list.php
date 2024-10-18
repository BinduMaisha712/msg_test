<?php

include('includes/header.php');

if (isset($_GET['product'])) {
  if ($_GET['product'] == "") {
?>
<script type="text/javascript">
window.location.href = "view-all-products.php";
</script>
<?php
  } else {
    $groupCode = $_GET['product'];

    $issubcategory = mysqli_fetch_assoc(mysqli_query($conn, "SELECT c.issubcategory FROM category c  WHERE c.id=(SELECT cat_id FROM products WHERE group_code='" . $groupCode . "' GROUP BY group_code)"))['issubcategory'];
    if ($issubcategory == 'Yes') {
      $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($conn, "SELECT classtype_id FROM subcategory WHERE id=(SELECT subcat_id FROM products WHERE group_code='" . $groupCode . "' GROUP BY group_code)"))['classtype_id']);
    } elseif ($issubcategory == 'No') {
      $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($conn, "SELECT classtype_id FROM category WHERE id=(SELECT cat_id FROM products WHERE group_code='" . $groupCode . "' GROUP BY group_code)"))['classtype_id']);
    }
    $classtype1 = implode(", ", $query1);
    $query = "SELECT p.*,c.cat_name,sc.sub_cat_name FROM products as p 
 LEFT JOIN category as c on c.id=p.cat_id and c.status = 'Active'
 LEFT JOIN subcategory as sc on sc.id=p.subcat_id and sc.status = 'Active'
 WHERE p.trash = 'No'  and p.group_code='" . $_GET['product'] . "' GROUP BY p.group_code";
    $sql1 = mysqli_query($conn, $query);
    $roww = mysqli_fetch_assoc($sql1);
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
      if ($query1[0] == $classtypeName[0]['id']) {
        $primaryClassName = $classtypeName[0]['name'];
        $secondaryClassName = $classtypeName[1]['name'];
      }
    } elseif ($c == 1 && $query1[0] != 16) {
      $primaryClassName = $classtypeName[0]['name'];
    } elseif ($c == 3) {
      $classtype1 = implode(", ", $query1);
      $classtypeNameQuery = mysqli_query($conn, "SELECT id,name FROM classtype WHERE id IN($classtype1)");
      while ($row = mysqli_fetch_array($classtypeNameQuery)) {
        $classtypeName[] = array('id' => $row['id'], 'name' => $row['name']);
      }

      foreach ($classtypeName as $value) {
        if ($query1[0] == $value['id']) {
          $primaryClassName = $value['name'];
        }
        if ($query1[1] == $value['id']) {
          $secondaryClassName = $value['name'];
        }
        if ($query1[2] == $value['id']) {
          $thirdClassName = $value['name'];
        }
      }
    }
  }
}
?>
<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <!-- Records List Start -->
                                <?php if($c==2)
{
                        ?>
                    
                       <a href="productbyclassadd.php?product=<?= $_GET['product'] ?>" style=""><button class="btn btn-success ad">Add More Product</button></a>
                          <?php
                    }elseif($c==1 && $query1[0]!=16)
{
 $sel_query = mysqli_query($conn, "SELECT id,name,symbol FROM `size_class` where status='Active' AND classtype_id=$query1[0]");
?>
                    
                       <a href="productbyclassadd.php?product=<?= $_GET['product'] ?>" style=""><button class="btn btn-success ad">Add More Product</button></a>
                       <script>var activesize='<?= mysqli_num_rows($sel_query); ?>';</script>
                          <?php
}elseif($c==3)
{ ?>
                    
                       <a href="productbyclassadd.php?product=<?= $_GET['product'] ?>" style=""><button class="btn btn-success ad">Add More Product</button></a>
                          <?php
}
                    ?>
            <div class="records--list" data-title="PRODUCTS DETAILS">

                <table id="recordsListView">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Product</th>
                            <?php
              if ($c == 3) {
              ?>
                            <th><?php echo $primaryClassName; ?></th>
                            <th><?php echo $secondaryClassName; ?></th>
                            <th><?php echo $thirdClassName; ?></th>
                            <?php
              } elseif ($c == 2) {
              ?>
                            <th><?php echo $primaryClassName; ?></th>
                            <th><?php echo $secondaryClassName; ?></th>
                            <?php
              } elseif ($c == 1 && $query1[0] != 16) {
              ?>
                            <th><?php echo $primaryClassName; ?></th>
                            <?php
              }
              ?>
                            <th>Price</th>
                            <th>In Stock</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
            //print_r($_SESSION);
            if (isset($_SESSION['alert'])) {

              echo '<div id="snackbar">' . $_SESSION['alert'] . '</div>';
              echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";

              // echo"var delay = 1000;setTimeout(function(){ window.location = 'add-products.php'; }, delay);";
              echo "</script>";
              unset($_SESSION['alert']);
            }
            $query = "SELECT p.*,symbol as size_symbol FROM products as p 
                              LEFT JOIN size_class as sc on p.class0=sc.id and sc.status='Active'
                              WHERE p.trash = 'No' and p.group_code='" . $groupCode . "' ORDER BY p.id DESC";
            $query = mysqli_query($conn, $query);
            $sr = 1;
            while ($data = mysqli_fetch_array($query)) {

            ?>
                        <tr id="row<?= $data['id']; ?>">
                            <td><?php echo $sr ?></td>
                            <td><?php echo $data['product_name']; ?></td>
                            <?php
                if ($c == 3) {
                  $thirdSize = mysqli_fetch_assoc(mysqli_query($conn, "SELECT symbol FROM size_class WHERE id=" . $data['class2']))['symbol'];

                ?>
                            <td><?php echo $data['class1']; ?></td>
                            <td><?php echo $data['size_symbol']; ?></td>
                            <td><?php echo $thirdSize; ?></td>
                            <?php
                } elseif ($c == 2) {
                ?>
                            <td><?php echo $data['class1']; ?></td>
                            <td><?php echo $data['size_symbol']; ?></td>
                            <?php
                } elseif ($c == 1 && $query1[0] != 16) {
                ?>
                            <td><?php echo $data['size_symbol']; ?></td>
                            <?php
                }
                ?>

                            <?php if ($data['discount'] == '0' || $data['discount'] == '') { ?>
                            <td><i class="fa fa-inr"></i><?php echo $data['price']; ?></td>
                            <?php } else { ?>
                            <td><i class="fa fa-inr"></i><?php echo $data['discount']; ?></td>
                            <?php
                } ?>
                            <td><?php
                    if ($data['in_stock'] == 0) {
                      echo 'Out of Stock';
                    } else {
                      echo $data['in_stock'];
                    }
                    ?></td>
                            <td>
                                <?php
                  if ($data['status'] == 'Active') {  ?>
                                <a
                                    href="change_pdec.php?hid=<?= $data['id'] . '&type=status'; ?>&product=<?= $data['group_code']; ?>"><button
                                        class="btn btn-success"
                                        onClick="return confirm('Are you sure you want to Inactive this products')">Active</button></a>
                                <?php
                  } else {  ?>
                                <a
                                    href="change_pdec.php?hid=<?= $data['id'] . '&type=status'; ?>&product=<?= $data['group_code']; ?>"><button
                                        class="btn btn-danger"
                                        onClick="return confirm('Are you sure you want to Active this products')">Inactive</button>
                                </a>
                                <?php
                  } ?>
                            </td>
                            <td>
                                <a data-toggle="modal" data-target="#manageStock" style="cursor: pointer;"
                                    onclick="manageStock(<?= $data['id']; ?>,<?= $sr ?>);"><span class="fa fa-cart-plus"
                                        title="Manage Stock"></span></a>&nbsp;&nbsp;&nbsp;
                                <a href="edit_product.php?id=<?= $data['id']; ?>"><span class="fa fa-edit"
                                        title="Edit Details"></span></a>&nbsp;&nbsp;&nbsp;
                                <a href="trash-product.php?eid=<?php echo $data['id'] . '&Active=Inactive&trash=Yes'; ?>&product=<?= $data['group_code']; ?>"
                                    onClick="return confirm('Are you sure you want to Delete this Product')"><i
                                        class="fa fa-trash" style=" "></i></a>
                            </td>
                        </tr>

                        <?php $sr++;
            } ?>

                    </tbody>
                </table>
            </div>
            <!-- Records List End -->
        </div>
    </section>
    <!-- Main Content End -->
    <!-- Modal -->
    <div class="modal fade" id="manageStock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Add Stock</h5>
                    <button type="button" id="closeModel" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="addStock">
                        <input type="hidden" name="productId" id="modelProductId" value="">
                        <input type="hidden" name="rowNo" id="modelSr" value="">
                        <div class="form-group row">
                            <span class="label-text col-md-3 col-form-label">In Stock: </span>

                            <div class="col-md-9">
                                <input type="number" class="form-control" name="inStock" id="inStock"
                                    placeholder="No. of Items" value="" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <div id="alertStatus"></div>
    <script>
    function manageStock(productId, sr) {
        $("#modelProductId").val(productId);
        $("#modelSr").val(sr);
    }


    $("#addStock").on("submit", function(e) {
        e.preventDefault();
        actionUrl = 'ajax/add-stock.php';
        formData = $(this).serialize();
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            // dataType: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                if (data.status == 'success') {

                    $('#row' + data.productId).html(data.updatedRow);
                }
                $("#alertStatus").html(data.result);

                $('#closeModel').click();
            }

        })
    });
    </script>
    <!-- Main Footer Start -->
    <?php include('includes/footer.php'); ?>