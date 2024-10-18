<?php include('includes/header.php'); ?>
<?php
    
    $pid=$_REQUEST['pid'];
?>

<?php  

                                                            /* -----Products selects------*/
    $pro_query=mysqli_query($conn,"select * from hot_deals_products where id=$pid");
        $pro_data=mysqli_fetch_array($pro_query);

                                                        /* -----Descriptions selects------*/

    $des_query=mysqli_query($conn,"SELECT * FROM `hot_deals_descriptions` WHERE p_id=$pid");
           
                                                            /* ----state  selects------*/


            $state_query1=mysqli_query($conn,"SELECT * FROM `hot_deals_available_place` WHERE p_id=$pid");
            $state_data=mysqli_fetch_array($state_query1);
             
             $country_id=$state_data['country'];

             $country_query=mysqli_query($conn,"SELECT * FROM `countries` WHERE id=$country_id");
          
   
                                                    /* ----Specifications  selects------*/

    $squery=mysqli_query($conn,"SELECT * FROM `hot_deals_specifications` WHERE p_id=$pid");

                                                                /* ----stock  selects------*/

    $stock_query=mysqli_query($conn,"SELECT * FROM `hot_deals_stock` WHERE p_id=$pid");
    $stock_data=mysqli_fetch_array($stock_query);
       
?>
        <!-- Main Container Start -->
        <main class="main--container">          

            <!-- Main Content Start -->
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
  <a class="btn btn-success btn-md" href="hot-deals-stock-status.php?pid=<?php echo $stock_data['p_id'].'&Instock=OutOfStock'; ?>" onClick="return confirm('are you sure you want to OutOfStock this products')">Instock</a> 
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="hot-deals-stock-status.php?pid=<?php echo $stock_data['p_id'].'&Instock=Instock';?>" onClick="return confirm('are you sure you want to Instock this products')">OutOfStock</a>
  <?php
     } ?>
                                       
                                    </th>
                                     <th width="15%">
                                                    <a href="hot-deals-update.php?pid=<?php echo $pro_data['id']; ?>"><span  class="fa fa-edit btn btn-success">UPDATE</span>
                                                    </a>
                                                </th>
                                                <th width="40%"><?php echo $pro_data['datetime']; ?>
                                                </th>
                                </thead>
                                            <tbody>
                                                <tr>
                                                    <th>Products Name</th>
                                                    <td>
                                                       <?php echo $pro_data['product_name']; ?>
                                                    </td>
                                                    <th>Products Code</th>
                                                    <td><?php echo $pro_data['products_code']; ?></td>
                                                </tr>
                                                <tr>
                                                    <th>Price</th>
                                                    <td>
                                                        <?php echo $pro_data['price']; ?>
                                                    </td>
                                                    <th>Country</th>  
                                                    <td>
                                                        
                                                        <?php 
                                                        while($country_data=mysqli_fetch_array($country_query)){ ?>
                                                            <?php echo $country_data['country_name']; ?><?php } ?>
                                                    </td>
                                                </tr>
                                                 <tr>
                                                    <th>City</th>
                                                    <td><ul>
                                                    <?php  
                                                    $city_query=mysqli_query($conn,"SELECT * FROM `hot_deals_available_place` WHERE p_id=$pid");
                                                    while($city_data=mysqli_fetch_array($city_query)) {
                                                        $city_id=$city_data['city'];
                                                        $city_query1=mysqli_query($conn,"SELECT * FROM `city_list` WHERE id=$city_id");
                                                        $city_data1=mysqli_fetch_array($city_query1);
                                                     ?>
                                                        <li>
                                                        <?php echo $city_data1['city_name']; ?><div style="float: right;"><?php
if( $city_data['status']=='Active' ){ ?>
  <a style="color: green;"  href="hot-deals-city-status.php?id=<?php echo $city_data['id'].'&Active=Inactive'; ?>&pid=<?php echo $pid; ?>">Active</a>  
<?php } else {  ?>
                 <a  href="hot-deals-city-status.php?id=<?php echo $city_data['id'].'&Active=Active'; ?>&pid=<?php echo $pid; ?>">Inactive</a>  <?php } ?></div>
                                                        </li>
                                                        
                                                        <?php } ?>
                                                        </ul>
                                                        </td>
                                                        <th>Area & Area Code</th>
                                                    <td><ul>
                                                    <?php

                                                      $available_query1=("SELECT * FROM `hot_deals_place_code` WHERE p_id=$pid");
                                                        $available_query=mysqli_query($conn,$available_query1);
                                                            
                                                        while($available_data=mysqli_fetch_array($available_query)){

                                                        $zone_id=$available_data['z_id']; 
                                                     
                                                        $available_query1="SELECT * FROM `zip_list` WHERE id=$zone_id";
                                                        $availabl=mysqli_query($conn,$available_query1);
                                                        $available_data1=mysqli_fetch_array($availabl);
                                                        ?>
                                                     <li><?php echo $available_data1['area_name'];?>
                                                    <?php echo "($available_data1[zip_code])";?><div style="float: right;"><?php
if( $available_data['status']=='Active' ){ ?>
  <a style="color: green;"  href="hot-deals-zip-code-status.php?id=<?php echo $available_data['id'].'&Active=Inactive'; ?>&pid=<?php echo $pid; ?>">Active</a>  
<?php } else {  ?>
                 <a  href="hot-deals-zip-code-status.php?id=<?php echo $available_data['id'].'&Active=Active'; ?>&pid=<?php echo $pid; ?>">Inactive</a>  <?php } ?></div></li><?php  } ?></ul></td>
                                                </tr>
                                                <tr>
                                                    <th>Available</th>
                                                    <td><?php  echo $stock_data['cod']; ?>&emsp;&emsp;<?php  echo $stock_data['online']; ?></td>
                                                    <th>Available Stock</th>
                                                    <td><?php  echo $stock_data['stock_no']; ?></td>
                                                </tr>
                                                 <tr>
                                                    <th>Descriptions</th>
                                                    <td colspan="3"><ul>
                                                    <?php 
                                                    while($des_data=mysqli_fetch_array($des_query)){ ?>                             
                                                        <li><?php   echo $des_data['description']; ?><div style="float: right;"><?php
if( $des_data['status']=='Active' ){ ?>
  <a style="color: green;"  href="hot-deals-des-status.php?id=<?php echo $des_data['id'].'&Active=Inactive'; ?>&pid=<?php echo $pid; ?>">Active</a>  
<?php } else {  ?>
                 <a  href="hot-deals-des-status.php?id=<?php echo $des_data['id'].'&Active=Active'; ?>&pid=<?php echo $pid; ?>">Inactive</a>  <?php } ?></div> 
                                                            
                                                        </li>
                                                        <?php  } ?>
                                                        </ol>
                                                    </td>
                                                   
                                                </tr>
                                                 <tr>
                                                    <th>Specifications</th>
                                                    <td colspan="3"><ul>
                                                    <?php while($sdata=mysqli_fetch_array($squery))
                                                    { ?>                           
                                                    <li><?php echo $sdata['specifications']; ?><div style="float: right;"><?php
if( $sdata['status']=='Active' ){ ?>
  <a style="color: green;"  href="hot-deals-spec-status.php?id=<?php echo $sdata['id'].'&Active=Inactive'; ?>&pid=<?php echo $pid; ?>">Active</a>  
<?php } else {  ?>
                 <a  href="hot-deals-spec-status.php?id=<?php echo $sdata['id'].'&Active=Active'; ?>&pid=<?php echo $pid; ?>">Inactive</a>  <?php } ?></div></li><?php  } ?>
                                                    </ol></td>
                                                </tr>
                                                <tr>
                                                    <th>Image</th>
                                                        <td colspan="3">
                                                        <?php 
                                                        $img_query=  mysqli_query($conn,"select * from hot_deals_image where p_id=$pid");

                                                        while($img_data=mysqli_fetch_array($img_query))
                                                        { ?>
                                                         <div class="img-wrap" style="float: left;position: relative;">   
                                                      <a href="hot-deals-img-delete.php?img_id=<?php echo $img_data['id']; ?>&pid=<?php echo $pid; ?>" onClick="return confirm('are you sure you want to delete this products')"><span class="close" style="position:absolute;right: 0px;z-index: 100;" >&times;</span> </a> 
                                                        <img src="image/<?php echo $img_data['image']; ?>"width="100px" height="100px">
                                                        </div>
                                                        <?php  } ?>

                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>                          
                        </div>
                        <!-- Tab Content End -->
                    </div>
            </section>
            <!-- Main Content End -->

<?php include('includes/footer.php'); ?>