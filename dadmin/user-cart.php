<?php
error_reporting(0);
include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">

            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="VIEW USER'S CART DETAILS">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Products Name</th>
                                    <th>Products Image</th>
                                    <th>Products Quantity</th>
                                    <th>Products Price</th>
                                    <th>Products Size</th>
                                    <th>Stock Status</th>
									<th>Status</th>
                                    
                                    
                                </tr>
                            </thead>
                            <tbody>
<?php
    $id=$_GET['id'];
    $cart_query = mysqli_query($conn,"SELECT * FROM `add_cart` WHERE user_id=$id order by id desc");
    
    $sr = 1;
    while($cart_data = mysqli_fetch_array($cart_query))
    {
         $product_id = $cart_data['pid'];
        //  echo $product_id;
         $product_name = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM products WHERE id = '$product_id'"))['product_name'];
        //  print_r($product_name);
         
        $product_query=mysqli_query($conn,"SELECT * FROM products WHERE id= $product_id");
        $product_data=mysqli_fetch_array($product_query);
        $product_code=$product_data['product_code'];
        $img_query=mysqli_query($conn,"SELECT * FROM `image` WHERE p_id='$product_code' order by id limit 0,1");
        $img_data=mysqli_fetch_array($img_query);
		$stock_query=mysqli_query($conn,"SELECT * FROM `stock` WHERE p_id=$product_id");
        $stock_data=mysqli_fetch_array($stock_query);
    //   print_r($img_data);
     
?>
                                <tr>
                                    <td><?php echo $sr ?> <?= ' ' . $product_id;?></td>                            
                                    <td><?php echo $product_name; ?></td>
									<td> <img src="../asset/image/product/<?php echo $img_data['image']; ?>" alt="cart-image" style="width: 30px; height: 30px;" /></td>
                                     <td><?php echo $cart_data['quantity'];?></td>
                                    <td><?php echo $product_data['price']; ?></td>
                                    <td><?php if($product_data['size']=="No"){}else{echo $product_data['symbol'];} ?></td>
                                    <td><?php echo $stock_data['stock']; ?></td>
									<td> <?php
                                      if($cart_data['status']=='Active'){  ?>
                                        <button class="btn btn-success">Active</button>
                                      <?php
                                       }
                                       else
                                       {  ?>
                                       <button class="btn btn-danger">Deleted</button>
                                        <?php
                                        } ?>
                                    </td>
                                    
                                   
                                </tr>

<?php  $sr++; } ?>
                                   
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
