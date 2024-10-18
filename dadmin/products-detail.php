   
<?php include('includes/header.php'); ?>
<?php
    
    $pid=$_REQUEST['pid'];
    $id_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$pid");
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
    $pro_query=mysqli_query($conn,"select * from products where id=$pid");
        $pro_data=mysqli_fetch_array($pro_query);

                                                        /* -----Image selects------*/

    $img_query=  mysqli_query($conn,"select * from image where p_id=$pid and status='Active'");
        $conunt = mysqli_num_rows($img_query);
                                                     /* -----Descriptions selects------*/

    $des_query=mysqli_query($conn,"SELECT * FROM `description` WHERE p_id=$pid");
                                                        /* ----state  selects------*/

    $state_query1=mysqli_query($conn,"SELECT * FROM `available_place` WHERE p_id=$pid");
        $state_data=mysqli_fetch_array($state_query1);
          
            $country_id=$state_data['country'];

             $country_query=mysqli_query($conn,"SELECT * FROM `countries` WHERE id=$country_id");      
   
                                                /* ----Specifications  selects------*/

    $squery=mysqli_query($conn,"SELECT * FROM `specifications` WHERE p_id=$pid");

                                                    /* ----stock  selects------*/

    $stock_query=mysqli_query($conn,"SELECT * FROM `stock` WHERE p_id=$pid");
    $stock_data=mysqli_fetch_array($stock_query);
       
?>

 <main class="main--container">
     <section class="main--content">
                <div class="panel">
                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <h4 class="subtitle">Products Details</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-cells-middle">
                                    <thead class="text-dark">
                                    <th width="15%">Status</th>
                                    <th width="30%"><?php

  if( $stock_data['stock']=='Instock' ){
?>
 <a class="btn btn-success btn-md" href="stock-status.php?pid=<?php echo $stock_data['p_id'].'&Instock=OutOfStock'; ?>" onClick="return confirm('are you sure you want to OutOfStock this products')">Instock</a> 
<?php
     }
     else
     { 
         ?>
<a class="btn btn-danger" href="stock-status.php?pid=<?php echo $stock_data['p_id'].'&Instock=Instock';?>" onClick="return confirm('are you sure you want to Instock this products')">OutOfStock</a>
  <?php
     } ?>                           </th>
                                    <th width="15%"><a href="products-update.php?pid=<?php echo $pro_data['id']; ?>"><span class="fa fa-edit btn btn-success">UPDATE</span>
                                        </a>
                                    </th>
                                    <th width="40%"><?php echo $pro_data['date']; ?>&nbsp;<?php echo $pro_data['time']; ?></th>     
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
                                        <th>Products Code</th>
                                        <td>
                                           <?php echo $pro_data['product_code']; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Price</th>
                                        <td>
                                            $&nbsp;<?php echo $pro_data['price']; ?>
                                        </td>
                                        <th>Product Available - Vendor</th>
                                        <th><?php
                                            if($pro_data['vendor_id']==0){ echo 'No' ;}else{
                                                $vp_id=$pro_data['id'];
                                                $vp_query=mysqli_query($conn,"SELECT * FROM `vendor_approval_products` WHERE p_id=$vp_id");
                                                while($vp_data=mysqli_fetch_array($vp_query)){
                                                    $v_id=$vp_data['vendor_id'];
                                                    $vendor_query=mysqli_query($conn,"SELECT * FROM `vendor` WHERE id=$v_id");
                                                    $vendor_data=mysqli_fetch_array($vendor_query);
                                                    ?>
                                                    <a href="vendor-products-detail.php?pid=<?php echo $vp_data['vp_id']; ?>" target="_blank"><?php echo $vendor_data['name']; ?></a><br>
                                                    <?php
                                                    
                                                }

                                            }
                                        ?>
                                            

                                        </th>
                                           <!-- <th>Country</th>  
                                            <td>
                                        <?php 
                                            while($country_data=mysqli_fetch_array($country_query)){ ?>
                                            
                                                <?php echo $country_data['country_name']; ?>
                                            
                                        <?php } ?>
                                                </td>
                                        </tr>
                                        <tr>
                                            <th>City</th>
                                            <td> 
                                                <ul>
                                            <?php  
                                            $city_query=mysqli_query($conn,"SELECT * FROM `available_place` WHERE p_id=$pid");
                                            while($city_data=mysqli_fetch_array($city_query))
                                            {
                                                $city_id=$city_data['city'];
                                                $city_query1=mysqli_query($conn,"SELECT * FROM `city_list` WHERE id=$city_id"); 
                                                $city_data1=mysqli_fetch_array($city_query1);
                                                ?>
                                                
                                                    <li>
                                                        <?php echo $city_data1['city_name']; ?>
                                                    <div style="float: right;"><?php
if( $city_data['status']=='Active' ){ ?>
  <a style="color: green;"  href="products-city-status.php?id=<?php echo $city_data['id'].'&Active=Inactive'; ?>&pid=<?php echo $pid; ?>">Active</a>  
<?php } else {  ?>
                 <a  href="products-city-status.php?id=<?php echo $city_data['id'].'&Active=Active'; ?>&pid=<?php echo $pid; ?>">Inactive</a>  <?php } ?></div></li>
                                                
                                                <?php } ?>
                                                    </ol>
                                                </td>
                                        <th>Area</th> 
                                        <td><ul>
                                    <?php

                                     $available_query=mysqli_query($conn,"SELECT * FROM `available_place_code` WHERE p_id=$pid");

                                     while($available_data=mysqli_fetch_array($available_query))
                                     {
                                        $available_id=$available_data['z_id'];
                                            $sel="SELECT * FROM `zip_list` WHERE id=$available_id";
                                        $available_query1=mysqli_query($conn,$sel);

                                        $available_data1=mysqli_fetch_array($available_query1); ?>
                                        
                                        <li><?php echo $available_data1['area_name'];?>
                                            <?php echo "($available_data1[zip_code])";?><div style="float: right;"><?php
if( $available_data['status']=='Active' ){ ?>
  <a style="color: green;"  href="products-zip-code-status.php?id=<?php echo $available_data['id'].'&Active=Inactive'; ?>&pid=<?php echo $pid; ?>">Active</a>  
<?php } else {  ?>
                 <a  href="products-zip-code-status.php?id=<?php echo $available_data['id'].'&Active=Active'; ?>&pid=<?php echo $pid; ?>">Inactive</a>  <?php } ?></div></li>
                                          <?php  } ?></ol></td>-->
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
                                            <a href="products-img-delete.php?img_id=<?php echo $img_data['id']; ?>&pid=<?php echo $pid; ?>"><span class="close" style="position:absolute;right: 0px;z-index: 100;" onClick="return confirm('are you sure you want to delete this products')">&times;</span> </a>
                                            <img src="image/<?php echo $img_data['image']; ?>"width="75px" height="75px"></div>
                                    <?php  } ?></td>
                                    </tr>

                                    
                                    <tr>
                                        <th>Descriptions</th>
                                        <td colspan="3"> <ul>
                                        <?php while($des_data=mysqli_fetch_array($des_query))
                                                { ?>                               
                                        
                                        <li><?php echo $des_data['description']; ?><div style="float: right;"><?php
if( $des_data['status']=='Active' ){ ?>
  <a style="color: green;"  href="products-des-status.php?id=<?php echo $des_data['id'].'&Active=Inactive'; ?>&pid=<?php echo $pid; ?>">Active</a>  
<?php } else {  ?>
                 <a  href="products-des-status.php?id=<?php echo $des_data['id'].'&Active=Active'; ?>&pid=<?php echo $pid; ?>">Inactive</a>  <?php } ?></div></li>
                                        <?php  } ?>
                                        </ol></td>
                                        </tr>
                                       
                                        
                                         <tr>
                                            <th>Specifications</th>
                                            <td colspan="3"><ul>
                                            <?php while($sdata=mysqli_fetch_array($squery))
                                                    { ?> <li> <?php echo $sdata['specifications']; ?><div style="float: right;"><?php
if( $sdata['status']=='Active' ){ ?>
  <a style="color: green;"  href="products-spec-status.php?id=<?php echo $sdata['id'].'&Active=Inactive'; ?>&pid=<?php echo $pid; ?>">Active</a>  
<?php } else {  ?>
                 <a  href="products-spec-status.php?id=<?php echo $sdata['id'].'&Active=Active'; ?>&pid=<?php echo $pid; ?>">Inactive</a>  <?php } ?></div></li>
                                                    <?php  } ?>
                                        </ol></td>
                                        </tr>
                                        
                                </tbody>
                            </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>

<?php include('includes/footer.php'); ?>