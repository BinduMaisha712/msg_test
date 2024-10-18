   
<?php include('includes/header.php'); ?>
<?php
    
    $pid=$_REQUEST['pid'];
    $id_query=mysqli_query($conn,"SELECT * FROM `vendor_products` WHERE id=$pid");
    $id_data=mysqli_fetch_array($id_query);
    $cid=$id_data['cat_id'];
     $sid=$id_data['subcat_id'];
?>
<?php  
                                                        /* -----Category selects------*/
    $cat_query=mysqli_query($conn,"SELECT * FROM `category` WHERE id=$cid");
     $cat_data=mysqli_fetch_array($cat_query);

                                                    /* -----Subcategory selects------*/

    $sub_query=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE id=$sid"); 
    $sub_data=mysqli_fetch_array($sub_query);

                                                     /* -----Products selects------*/
    $pro_query=mysqli_query($conn,"select * from vendor_products where id=$pid");
        $pro_data=mysqli_fetch_array($pro_query);
    $product_query=
mysqli_query($conn,"select * from products where vendor_product_id=$pid");
    $product_data=mysqli_fetch_array($product_query);
    $product_id=$product_data['id'];

                                                        /* -----Image selects------*/

    $img_query= mysqli_query($conn,"select * from vendor_image where vp_id=$pid and status='Active'");
        $conunt = mysqli_num_rows($img_query);
                                                     /* -----Descriptions selects------*/

    $des_query=mysqli_query($conn,"SELECT * FROM `vendor_description` WHERE vp_id=$pid");
       
   
                                                /* ----Specifications  selects------*/

    $squery=mysqli_query($conn,"SELECT * FROM `vendor_specifications` WHERE vp_id=$pid");

                                                    /* ----stock  selects------*/

    $stock_query=mysqli_query($conn,"SELECT * FROM `vendor_stock` WHERE vp_id=$pid");
    $stock_data=mysqli_fetch_array($stock_query);
    $product_stock_query=mysqli_query($conn,"SELECT * FROM `stock` WHERE p_id=$product_id");
    $product_stock_data=mysqli_fetch_array($product_stock_query);
       
?>

 <main class="main--container">
     <section class="main--content">
                <div class="panel">
                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <h4 class="subtitle">Vendor Products Details</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-cells-middle">
                                    <thead class="text-dark">
                                    <th width="15%">Status</th>
                                    <th width="35%"><?php

  if( $stock_data['stock']=='Instock' ){
?>
 <!--<a class="btn btn-success btn-md" href="stock-status.php?pid=<?php echo $product_stock_data['p_id'].'&Instock=OutOfStock'; ?>&vpid=<?php echo $pid; ?>" onClick="return confirm('are you sure you want to OutOfStock this products')">Instock</a> -->
 <a class="btn btn-success btn-md" href="javascript:;" >Instock</a>
<?php
     }
     else
     { 
         ?>
<!--<a class="btn btn-danger" href="stock-status.php?pid=<?php echo $product_stock_data['p_id'].'&Instock=Instock';?>&vpid=<?php echo $pid; ?>" onClick="return confirm('are you sure you want to Instock this products')">OutOfStock</a>-->
<a href="javascript:;" class="btn btn-danger">OutOfStock</a>
  <?php
     } ?> &nbsp;
     <?php

  if( $pro_data['admin_approval']=='Approved' ){
?>
  <a href="vendor-products-approval.php?pid=<?php echo $pro_data['id'].'&Approved=Unapproved'; ?>" class="btn btn-success" onClick="return confirm('are you sure you want to unapproved this products')">approved</a>  
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="javascript:;">Unapproved</a>  
  <?php
     }


     ?>
                                        </th>
                                        <td width="15%">
 <?php

  if( $pro_data['status']=='Active' ){
?>
  <!--<a class="btn btn-success" href="products-status.php?pid=<?php echo $product_data['id'].'&Active=Inactive'; ?>&vpid=<?php echo  $pid; ?>" onClick="return confirm('are you sure you want to Inactive this products')">Active</a>-->
  <a class="btn btn-success" href="javascript:;">Active</a>  
<?php
     }
     else
     { 
         ?>
  <!--<a class="btn btn-danger" href="products-status.php?pid=<?php echo $product_data['id'].'&Active=Active'; ?>&vpid=<?php echo $pid; ?>" onClick="return confirm('are you sure you want to Active this products')">Inactive</a>  -->
  <a href="javascript:;" class="btn btn-danger">Inactive</a>
  <?php
     }


     ?>                                     </td>                     
                                                          
                                   
                                    <th width="35%">
                                       <!-- <?php if($pro_data['admin_approval']=='Approved'){ ?>
                                        <a href="products-update.php?pid=<?php echo $product_data['id']; ?>&vpid=<?php echo $pid; ?>"><span class="fa fa-edit btn btn-success">UPDATE</span>
                                        </a>
                                    <?php }else{ ?>
                                            <a href="javascript:;"><span class="fa fa-edit btn btn-success">UPDATE</span>
                                                <?php } ?>&nbsp;&nbsp;-->
                                        <?php echo $pro_data['date']; ?>&nbsp;<?php echo $pro_data['time']; ?></th>     
                                </thead>
                                <tbody>
                                    <tr>
                                        <th>Category</th>
                                        <td>
                                           <?php echo $cat_data['cat_name']; ?> 
                                        </td>
                                        <th>Subcategory</th>
                                        <td>
                                            <?php  echo $sub_data['sub_cat_name']; ?>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Products Name</th>
                                        <td>
                                           <?php echo $pro_data['product_name']; ?>
                                        </td>
                                   
                                        <th>Price</th>
                                        <td>
                                            $&nbsp;<?php echo $pro_data['price']; ?>
                                        </td>
                                       
                                    </tr>
                                    <tr>
                                    <tr>
                                            <th>Available</th>
                                            <td><?php  echo $stock_data['cod']; ?>&emsp;&emsp;<?php  echo $stock_data['online']; ?></td>
                                            <th>Available Stock</th>
                                            <td><?php  echo $stock_data['stock_no']; ?></td>
                                        </tr>
                                        <tr>
                                            <th>Delivery Charges</th>
                                            <td><?php  echo $stock_data['delivery_charges']; ?></td>
                                            <th>Show Discount</th>
                                            <td><?php  echo $pro_data['discount']; ?> %</td>
                                            
                                        </tr>
                                        <th>Image</th>
                                            <td colspan="3">
                                    <?php   
                                        while($img_data=mysqli_fetch_array($img_query))
                                            { ?>
                                                <div class="img-wrap" style="float: left;position: relative;">   
                                            <a href="products-img-delete.php?img_id=<?php echo $img_data['id']; ?>&pid=<?php echo $pid; ?>"><span class="close" style="position:absolute;right: 0px;z-index: 100;" onClick="return confirm('are you sure you want to delete this products')"></span> </a>
                                            <img src="image/<?php echo $img_data['image']; ?>"width="75px" height="75px"></div>
                                    <?php  } ?></td>
                                    </tr>

                                    <?php if(mysqli_num_rows($des_query) >0 ){ ?>
                                    <tr>
                                        <th>Descriptions</th>
                                        <td colspan="3"> <ul>
                                        <?php while($des_data=mysqli_fetch_array($des_query))
                                                { ?>                               
                                        
                                        <li><?php echo $des_data['description']; ?><div style="float: right;"><?php
if( $des_data['status']=='Active' ){ ?>
  <!--<a style="color: green;"  href="products-des-status.php?id=<?php echo $des_data['id'].'&Active=Inactive'; ?>&pid=<?php echo $pid; ?>">Active</a>-->  
  <a style="color: green;"  href="javascript:;">Active</a>
<?php } else {  ?>
    <!--<a  href="products-des-status.php?id=<?php echo $des_data['id'].'&Active=Active'; ?>&pid=<?php echo $pid; ?>">Inactive</a>-->
    <a  href="javascript:;">Inactive</a>
      <?php } ?></div></li>
                                        <?php  } ?>
                                        </ol></td>
                                        </tr>
                                    <?php } ?>
                                       
                                        <?php if(mysqli_num_rows($squery) > 0 ){ ?>
                                         <tr> 
                                            <th>Specifications</th>
                                            <td colspan="3"><ul>
                                            <?php while($sdata=mysqli_fetch_array($squery))
                                                    { ?> <li> <?php echo $sdata['specifications']; ?><div style="float: right;"><?php
if( $sdata['status']=='Active' ){ ?>
  <!--<a style="color: green;"  href="products-spec-status.php?id=<?php echo $sdata['id'].'&Active=Inactive'; ?>&pid=<?php echo $pid; ?>">Active</a>  -->
  <a style="color: green;"  href="javascript:;">Active</a>
<?php } else {  ?>
<!---<a  href="products-spec-status.php?id=<?php echo $sdata['id'].'&Active=Active'; ?>&pid=<?php echo $pid; ?>">Inactive</a>-->
<a  href="javascript:;">Inactive</a>
  <?php } ?></div></li>
                                                    <?php  } ?>
                                        </ol></td>
                                        </tr>
                                    <?php } ?>
                                    
                                <tr>
                                    <th colspan="4">Similar Products</th>
                                </tr>
                                
                                        <?php 
                                             $product_name= substr($pro_data['product_name'],0,3);
                                             $sel_query=
mysqli_query($conn,"SELECT * FROM `products` WHERE status LIKE 'Active' AND product_name LIKE '%$product_name%' ORDER BY id DESC");
                                             while($sel_data=mysqli_fetch_array($sel_query))
                                             { ?>
                                                <tr>
                                    
                                    <td colspan="3">
                                        <?php
                                                echo $sel_data['product_name'];
                                                ?>
                                                <td>&emsp;
                                                    <a href="products-detail.php?pid=<?php echo $sel_data['id']; ?>" class=" btn btn-success" target="_blank">View</a>
                                                    &emsp;
                                                    <?php if($pro_data['admin_approval']!=='Approved'){ ?>
                                                    <a href="vendor-products-add.php?pid=<?php echo $sel_data['id']; ?>&stock=<?php  echo $stock_data['stock_no']; ?>&vpid=<?php echo $pid; ?>&vid=<?php echo $pro_data['vendor_id']; ?>" class="btn btn-success">Add</a>
                                                <?php } ?>
                                                </td>
                                                     </td>
                                                </tr>
                                                <?php 
                                             }
                                        ?>
                                        <?php if($pro_data['admin_approval']!=='Approved'){ ?>
                                    <tr>
                                        <td colspan="4" align="right">
                                            <a href="vendor-products-approval.php?pid=<?php echo $pro_data['id'].'&Approved=Approved'; ?>" class="btn btn-success" onClick="return confirm('are you sure you want to Approved this products')">Approved</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                   
                                        
                                </tbody>
                            </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>

<?php include('includes/footer.php'); ?>