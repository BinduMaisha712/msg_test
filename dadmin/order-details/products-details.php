                                    <!-- Card Start -->
                                    <div class="card">
                                        <div class="card-header">
                                            <h5 class="h5">
                                                <button class="btn btn-link collapse-icon collapsed" data-toggle="collapse" data-target="#collapse02" style="color: #725d93;">Products Details</button>
                                            </h5>
                                        </div>
                                       

                                        <div id="collapse02" class="collapse" data-parent="#accordion01">
                                            <div class="card-body">
                                                <p><b>Shipping Charge: </b><?= $currency ?? '' ?>100</p>
                                                <table class="table table-responsive table-simple">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Products Name</th>
                                    <th>Tracking Id</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Tax</th>
                                    <th>Total</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
<?php
    $sr=1;
     $status_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE order_id='$order_id' ORDER BY id DESC");
    $status_data=mysqli_fetch_array($status_query);
    while($data=mysqli_fetch_array($query))
    {
        $product_id=$data['productid'];
        $product_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$product_id");
        $product_data=mysqli_fetch_array($product_query);
        
        $grom34=$product_data['class1'];

        $prodcolor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT symbol FROM size_class WHERE id=" . $product_data['class0']));
        
        $img_query=mysqli_query($conn,"SELECT * FROM `image` WHERE p_id='".$product_data['product_code']."'");
        $img_data=mysqli_fetch_array($img_query);


        $productUnitPrice = $data['price']/$data['quantity'];
        $product_tax = (isset($product_data['tax'])) ? $product_data['tax'] : 0 ;
        $totalPriceProduct = $productUnitPrice * $data['quantity'];
        $totalPriceProductTAX = $totalPriceProduct/100;
        $totalPriceProductTAX = $totalPriceProductTAX*$product_tax;
        $ProductTAX = $totalPriceProductTAX. ' ('.$product_tax.'%'.')';

?>

    <tr>
        <td><?php echo $sr ?></td>                            
        <td>
            <a href="edit_product.php?id=<?php echo $product_data['id']; ?>" target="_blank">
                <?php echo $product_data['product_name']; ?>
                <?php 
                    echo "<br/><small>";
                    if ($grom34 != '') { 
                        echo $grom34 .','; 
                    }
                    if ($prodcolor['symbol'] != '') {
                        echo $prodcolor['symbol']; 
                    }
                    echo "</small>";
                ?>
            </a>
        </td>

        <td><b><?php echo $data['tracking_id']; ?></b></td>
        <td><?php echo $data['quantity'];?></td>
        <td><?= $currency ?? '' ?><?php echo $data['price']/$data['quantity']; ?></td>
        <td><?= $currency ?? '' ?><?php echo $ProductTAX; ?></td>
        <td><?= $currency ?? '' ?><?php echo $data['price']+$totalPriceProductTAX; ?></td>
    </tr>

<?php  $sr++; } ?>
        <?php
        $order_coupon_details=mysqli_query($conn,"select * from order_coupon_code where order_id='".$order_id."'");					    		
        $getcuopondata = mysqli_fetch_assoc($order_coupon_details);
        if(!empty($getcuopondata)){ ?>

        <tr><td></td><td></td><td colspan="2">Subtotal</td><td></td><td colspan="2"><?= $currency ?? '' ?>&nbsp;<?php echo $getcuopondata['totalprice'] + $getcuopondata['discount_price']?></td></tr>
        <tr><td></td><td></td><td colspan="2">Discount</td><td></td><td colspan="2"><?= $currency ?? '' ?>&nbsp;<?php echo $getcuopondata['discount_price'];?></td></tr>
        <tr><td></td><td></td><td colspan="2">Shipping Charges</td><td></td><td colspan="2"><?= $currency ?? '' ?>&nbsp;<?php echo $tracking_data['shipping'];?></td></tr>        
        <tr><td></td><td></td><td colspan="2">Total</td><td></td><td colspan="2"><?= $currency ?? '' ?>&nbsp;<?php echo $getcuopondata['totalprice'];?></td></tr>

      <?php } ?>                             
                                
                            </tbody>
                        </table>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card End -->