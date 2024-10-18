<?php 
include "../web-structure/common_helper/core_query.php";
?>
<!-- Card Start -->
 <div id="snackbar"></div>
 <div class="card">
    <div class="card-header">
        <h5 class="h5">
            <button class="btn btn-link collapse-icon" data-toggle="collapse" data-target="#collapse05" style="color: #725d93;">Update Products Status </button>
        </h5>
    </div>

    <div id="collapse05" class="collapse show" data-parent="#accordion01">
        <div class="card-body">
<?php 
//include('../web-structure/web-structure-home/HomePage.php');
 // echo '<a href="product-detail.php?'.$homePage->generateToken(40).'='.$homePage->generateToken(40).'&'.$homePage->generateToken(40).'='.$homePage->generateToken(40).'" > '.$product_name.'</a>';

    $sel=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
   
    $sr=1;
    while($order_data=mysqli_fetch_array($sel)) {
            $product_id=$order_data['productid'];
            $tracking_id=$order_data['tracking_id'];
            $product_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$product_id");
            $product_data=mysqli_fetch_array($product_query);
            $status_query3=mysqli_query($conn,"SELECT * FROM `order_status` WHERE `tracking_id`='$tracking_id' ORDER BY id DESC");
            
                $colorName = "";
                        
                            if(!empty($product_data['class0']) )
                            {
                            $colorName .= "(" . mysqli_fetch_assoc(mysqli_query($conn, "SELECT symbol FROM size_class WHERE id=" . $product_data['class0']))['symbol']. ')';
                            }
                            if(!empty($product_data['class1']) )
                            {
                            $colorName .= " (" . $product_data['class1'] . ')';
                            }
                           if ($product_data['class2'] != '')
                            $colorName .= ' (' . $product_data['class2'] . ')' ;


            
 ?>
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="h5">
                                                            <button class="btn btn-link collapse-icon" data-toggle="collapse" data-target="#demo<?php echo $sr; ?>" style="color: ; font-size: 13px;">(<?php echo $sr; ?>)&nbsp;<?php echo $product_data['product_name']. ' ' . $colorName ."&emsp;";
                                                            if(mysqli_num_rows($status_query3)>0)
                                                            { 
                                                                $status_data3=mysqli_fetch_array($status_query3);
                                                                if($status_data3['tracking_status']=="Cancelled"){
                                                                    echo "<span style='color: red;'>".$status_data3['tracking_status']."</span>";
                                                                }else{

                                                                    echo "<span style='color: green;'>".$status_data3['tracking_status']."</span>";
                                                                }

                                                            }
                                                            else{
                                                                echo "<span style='color: #007bff;'>Pending</span>";
                                                            }
                                                            ?>
                                                                
                                                            </button>
                                                        </h5>
                                                    </div>
                                                    <div id="demo<?php echo $sr; ?>" class="collapse">
                                                      <div class="container">
                                                          <div class="row">
                                                    <div class="col-md-2">Status History : </div>
                                                    <div class="col-md-10">
                                                           <?php
                                            $status_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id'");
                                            if(mysqli_num_rows($status_query) > 0)
                                            {
                                                     while($status_data=mysqli_fetch_array($status_query))
                                                {
                                                    ?>
                                                    <ul>
                                                        <li <?php if($status_data['tracking_status']=="Cancelled"){ ?> style="color: #ff4040;" <?php }else{ ?> style="color: #20c997;" <?php } ?> ><?php  echo $status_data['tracking_status']; ?> <p style="color: green; display: inline;">(<?php  echo $status_data['date']; ?>&nbsp;<?php  echo $status_data['time']; ?>)</p>
<?php
                                                    if($status_data['tracking_status']=="Cancelled"){
                                                        echo "<br>By : ".$status_data['by']; 
                                                        echo "<br>Reason : ".$status_data['reason']; 
                                                    } ?>
                                                        </li>
                                                    </ul>
                                                   
                                                    <?php
                                                   

                                                }
                                            }else{
                                                ?>
                                                <p style="color: #007bff;">Pending</p>
                                                <?php
                                            }
                                           
                                            ?>
                                                    </div>
                                                </div>
                                         <br>
                                         <?php 
                                            $status_query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE tracking_id='$tracking_id' ORDER BY id DESC");
                                            $status_data=mysqli_fetch_array($status_query);
                                            if($status_data['tracking_status']=='Cancelled' || $status_data['tracking_status']=='Delivered' ){

                                            }else{
                                         ?>
                                                <div class="row">
                                                    <div class="col-md-2">Products Status</div>
                                                    <div class="col-md-10">
                        <form method="post" action="">
                            <div class="form-group row">
                                <div class="col-md-10">
                                     <select class="form-control" name="status" onchange="updateshow<?php echo $sr; ?>()" id="updatebox<?php echo $sr; ?>" required>
<?php
     
    if($status_data==''){ ?>
                                        <option value="">---select status---</option>

                                        <option value="Ordered and Approved" <?php  if($status_data['tracking_status']=='Ordered and Approved'){ ?> selected <?php }?> >Ordered and Approved</option>
                                  
                                        
                                        <option value="Cancelled" >Cancelled</option>

    <?php }else{ 

?>
                                        <option value="">---select status---</option>
<?php

 if($status_data['tracking_status']=='Ordered and Approved'){ ?>
                                        <option value="Your Order has been placed" <?php  if($status_data['tracking_status']=='Your Order has been placed'){ ?> selected <?php }?> >Your Order has been placed</option>
                                        <option value="Seller has processed your Order" <?php  if($status_data['tracking_status']=='Seller has processed your Order'){ ?> selected <?php }?>>Seller has processed your Order</option>
                                        <option value="Packed" <?php  if($status_data['tracking_status']=='Packed'){ ?> selected <?php }?> >Packed</option>
                                        <option value="Your item has been picked up by courier partner" <?php  if($status_data['tracking_status']=='Your item has been picked up by courier partner'){ ?> selected <?php }?> >Your item has been picked up by courier partner</option>

                                        <option value="Your item has been received in the hub nearest to you" <?php  if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?> selected <?php }?> >Your item has been received in the hub nearest to you</option>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                        
                                        <option value="Cancelled" >Cancelled</option>

<?php } if($status_data['tracking_status']=='Your Order has been placed'){ ?> 
                                        <option value="Seller has processed your Order" <?php  if($status_data['tracking_status']=='Seller has processed your Order'){ ?> selected <?php }?>>Seller has processed your Order</option>
                                        <option value="Packed" <?php  if($status_data['tracking_status']=='Packed'){ ?> selected <?php }?> >Packed</option>
                                        <option value="Your item has been picked up by courier partner" <?php  if($status_data['tracking_status']=='Your item has been picked up by courier partner'){ ?> selected <?php }?> >Your item has been picked up by courier partner</option>

                                        <option value="Your item has been received in the hub nearest to you" <?php  if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?> selected <?php }?> >Your item has been received in the hub nearest to you</option>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                       
                                        <option value="Cancelled" >Cancelled</option>
<?php } if($status_data['tracking_status']=='Seller has processed your Order'){ ?> 
                                        <option value="Packed" <?php  if($status_data['tracking_status']=='Packed'){ ?> selected <?php }?> >Packed</option>
                                        <option value="Your item has been picked up by courier partner" <?php  if($status_data['tracking_status']=='Your item has been picked up by courier partner'){ ?> selected <?php }?> >Your item has been picked up by courier partner</option>

                                        <option value="Your item has been received in the hub nearest to you" <?php  if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?> selected <?php }?> >Your item has been received in the hub nearest to you</option>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                        
                                        <option value="Cancelled" >Cancelled</option>
<?php } if($status_data['tracking_status']=='Packed'){ ?> 
                                        <option value="Your item has been picked up by courier partner" <?php  if($status_data['tracking_status']=='Your item has been picked up by courier partner'){ ?> selected <?php }?> >Your item has been picked up by courier partner</option>

                                        <option value="Your item has been received in the hub nearest to you" <?php  if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?> selected <?php }?> >Your item has been received in the hub nearest to you</option>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                        
                                        <option value="Cancelled" >Cancelled</option>

<?php } if($status_data['tracking_status']=='Your item has been picked up by courier partner'){ ?>                            
                                        <option value="Your item has been received in the hub nearest to you" <?php  if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?> selected <?php }?> >Your item has been received in the hub nearest to you</option>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                       
                                        <option value="Cancelled" >Cancelled</option>
<?php }   if($status_data['tracking_status']=='Your item has been received in the hub nearest to you'){ ?>
                                        <option value="your item out for delivery" <?php  if($status_data['tracking_status']=='your item out for delivery'){ ?> selected <?php }?> >your item out for delivery</option>

                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                        
                                        <option value="Cancelled" >Cancelled</option>
<?php } if($status_data['tracking_status']=='your item out for delivery'){ ?>
                                        <option value="Delivered" <?php  if($status_data['tracking_status']=='Delivered'){ ?> selected <?php }?> >Delivered</option>
                                        
                                        <option value="Cancelled" >Cancelled</option>
<?php } if($status_data['tracking_status']=='Delivered'){ ?>
                                         
<?php } } ?>
                                    </select>
                                    <input type="hidden" name="tracking_id" value="<?php echo $tracking_id; ?>">
                                    <br>
                                    <div class="form-group" id="update<?php echo $sr; ?>" style="display:none;">
                                        
                                        <textarea class="form-control" name="reason" rows="5" placeholder="Reason For Cancellation"></textarea>
                                         
                                        </div>


                                        <div class="form-group" id="deliveryDateTime<?php echo $sr; ?>" style="display:none;">
                                        
                                        <input type="date" id="deliveryDate<?php echo $sr; ?>" name="deliveryDate" class="form-control" value="<?=date("Y-m-d");?>" required>&nbsp;&nbsp;
                                        <input type="time" id="deliveryTime<?php echo $sr; ?>" name="deliveryTime"  placeholder="Time" class="form-control" value="<?=date("H:i:s");?>" autocomplete="off" required><br>

                                        </div>


<script>
function updateshow<?php echo $sr; ?>() {
  var x = document.getElementById("updatebox<?php echo $sr; ?>").value;
   var y = document.getElementById("update<?php echo $sr; ?>");
   var z = document.getElementById("deliveryDateTime<?php echo $sr; ?>");
   var dateImput = document.getElementById("deliveryDate<?php echo $sr; ?>");
   var timeInput = document.getElementById("deliveryTime<?php echo $sr; ?>");

  if (x == "Cancelled") {
    y.style.display = "flex";
  } else {
    y.style.display = "none";
  }
  if (x == "Delivered") {
    z.style.display = "flex";
    dateImput.required = true;
    timeInput.required = true;
  } else {
    z.style.display = "none";
    dateImput.required = false;
    timeInput.required = false;
  }
}
</script>
                                    </div>
                                    <div class="col-md-2">
                                    <button class="btn btn-success" name="order-submit" onclick="return confirm(' Are you sure you want to status update this order ?...');">update</button>
                                    </div>
                                </div>
                                </form>

                    </div>
                                                </div><?php } ?> <!----else products deliverd-->
                                                      </div>  
                                                    </div>
                                                   
                                                </div> 
<?php $sr++; } 
//----while loop end--- ?>


<?php 

    //////// Create Invoice ////////
    function gnerateInvoiceNo(){
        $sel_query=mysqli_query($conn, "SELECT * FROM `invoice_generate` order by id desc");
        if(mysqli_num_rows($sel_query)>0)
        {
            $vaar= mysqli_fetch_assoc($sel_query);
            return $vaar['invoice_no']+1;
        }
        else{
            return 10000;
        }
     }
     //////// Create Invoice ///////
    ///////// Generate Token /////////
    function generateToken($length){
    $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    $token = substr(str_shuffle($str), 0, $length);
    return $token;
    }
    
    ///////// Generate Token /////////
  
if(isset($_POST['order-submit'])){

     $status=$_POST['status'];
     $reason=$_POST['reason'];
    
     if(isset($_POST['deliveryDate'])){
        $deliveryDate = $_POST['deliveryDate'];
     }else{
        $deliveryDate = "";
     }
     if(isset($_POST['deliveryTime'])){
        $deliveryTime = $_POST['deliveryTime'];
    }else{
        $deliveryTime = "";
     }
    
    $tracking_id=$_POST['tracking_id'];
     if($_POST['status']=='Cancelled'){

        $by="admin";
          $allPros = mysqli_query($conn, "SELECT * FROM order_details WHERE order_id = '$order_id'");
        $deliveredArr = [];
        while($prRow = mysqli_fetch_assoc($allPros)){
            
             $tr_id = $prRow['tracking_id'];
            
            $current_status = mysqli_fetch_assoc(mysqli_query($conn, "SELECT tracking_status FROM order_status WHERE tracking_id = '".$prRow['tracking_id']."' ORDER BY id DESC LIMIT 1"))['tracking_status'];

           if($current_status != 'Delivered'){
               if ($tracking_id==$tr_id){
                $query2="INSERT INTO `order_status`(`user_id`,`order_tbl_id`,`order_id`,`tracking_id`, `tracking_status`,`by`,`reason`,`date`,`time`,`delivery_date`,`delivery_time`) VALUES ('$userid','$order_tbl_id','$order_id','".$prRow['tracking_id']."','$status','$by','$reason','$date','$time','$deliveryDate','$deliveryTime')";
                $runQ = mysqli_query($conn, $query2);
               }
           }
           else{
               array_push($deliveredArr, '"'.$prRow['tracking_id']. '"' );
           }
            
           
            $order_query ="SELECT * FROM order_tbl WHERE order_id = '$order_id'";
            $oeder_run = mysqli_query($conn,$order_query);
            $order_get = mysqli_fetch_array($oeder_run);
            $shipping = $order_get['shipping']; 
            $orderprice = $order_get['orderprice'];
            $order_date  = $order_get['date'];
            $payment_mode  = $order_get['payment_mode'];
            $userid = $order_get['userid'];
        
            $user_query = "SELECT * FROM user WHERE id ='$userid'";
            $run_query = mysqli_query($conn,$user_query);
            $user_gat = mysqli_fetch_array($run_query);
            $username = $user_gat['firstname'] . ' '. $user_gat['lastname'];
            $usermobile = $user_gat['mobile'];
            $email = $user_gat['email'];
        
            $orderdet_query ="SELECT * FROM order_details WHERE order_id = '$order_id' AND tracking_id = '".$_POST['tracking_id']."'";
            $oederset_run = mysqli_query($conn,$orderdet_query);
        }
        
     }else{
        $by=" ";
     }
    $query="INSERT INTO `order_status`(`user_id`,`order_tbl_id`,`order_id`,`tracking_id`, `tracking_status`,`by`,`reason`,`date`,`time`,`delivery_date`,`delivery_time`) VALUES ('$userid','$order_tbl_id','$order_id','$tracking_id','$status','$by','$reason','$date','$time','$deliveryDate','$deliveryTime')";
    $order_query ="SELECT * FROM order_tbl WHERE order_id = '$order_id'";
    $oeder_run = mysqli_query($conn,$order_query);
    $order_get = mysqli_fetch_array($oeder_run);
    $shipping = $order_get['shipping']; 
    $orderprice = $order_get['orderprice'];
    $order_date  = $order_get['date'];
    $payment_mode  = $order_get['payment_mode'];
    $userid = $order_get['userid'];

    $user_query = "SELECT * FROM user WHERE id ='$userid'";
    $run_query = mysqli_query($conn,$user_query);
    $user_gat = mysqli_fetch_array($run_query);
    $username = $user_gat['firstname'] . ' '. $user_gat['lastname'];
    $usermobile = $user_gat['mobile'];
    $email = $user_gat['email'];

    $orderdet_query ="SELECT * FROM order_details WHERE order_id = '$order_id' AND tracking_id = '".$_POST['tracking_id']."'";
    $oederset_run = mysqli_query($conn,$orderdet_query);
   


      if(!empty($status)){
          if($status == "Delivered"){
                    $product ="";
                while( $orderdet_get = mysqli_fetch_array($oederset_run)){
                    
                    $shipPrice = mysqli_fetch_assoc(mysqli_query($conn,'select * from `order_tbl` where `order_id` = "'.$orderdet_get['order_id'].'"'))['shipping'];
                  
                    $productid = $orderdet_get['productid'];
                    $quantity = $orderdet_get['quantity'];
                    $price_with_qty  = $orderdet_get['price'] + $orderdet_get['gst'] ;
                    $prod_qry = "SELECT * FROM `products` where id = '$productid' ";
                    $prod_run =  mysqli_query($conn,$prod_qry);
                    $get_datae = mysqli_fetch_array($prod_run);
                    $imid = $get_datae['product_code'];
                   
                     $img_query = "select * from image where p_id='".$imid."' and status='Active' order by set_seq asc";
                    $run_img  = mysqli_query($conn,$img_query);
                    $get_img = mysqli_fetch_array($run_img);
                    $link = 'https://micodetest.com/msg_updated/asset/image/product/' . $get_img['image'];
                     
                     $colorName = "";
                        
                    if($get_datae['class0'] != '' )
                    {
                    $colorName .= "(" . mysqli_fetch_assoc(mysqli_query($conn, "SELECT symbol FROM size_class WHERE id=" . $get_datae['class0']))['symbol']. ')';
                    }
                    if($get_datae['class1'] != '')
                    {
                    $colorName .= " (" . $get_datae['class1'] . ')';
                    }
                    
                   if ($get_datae['class2'] != ''){
                    $colorName .= ' (' . $get_datae['class2'] . ')' ;
                   }
                
                
                   if ($get_datae['class3'] != ''){
                    $colorName .= ' (' . $get_datae['class3'] . ')' ;
                   }
 
                    $product.='
                       
                        <tr align="center" class="order-mail" style="text-align:center;border-collapse:collapse;outline: 1px solid #bfbbbb;">
                            <td style=" padding:10px 5px;border-right: 1px solid #000"><img src="'.$link.'" style="width:100px"></td>
                            <td style="padding-left: 10px">'.$get_datae['product_name'].$colorName.'</td>
                            <td style=" padding:5px;text-align: center;border-right: 1px solid #000">'. $quantity.'</td>
                            <td style="padding:5px;"> '.$price_with_qty.'</td>
                        </tr>';
                    }
                   
                    
               
// $deliverdstatus = $deliverdstatus.$product.$header;
// plmail($email,"Order Delivered",$deliverdstatus);



////////////////////// feedback

   $orderdet_query ="SELECT * FROM order_details WHERE order_id = '$order_id'";
    $oederset_run = mysqli_query($conn,$orderdet_query);
   

                   $orderdet_get = mysqli_fetch_array($oederset_run);

                    $productid = $orderdet_get['productid'];
                    $quantity = $orderdet_get['quantity'];
                    $price_with_qty  = $orderdet_get['price'];
                    $prod_qry = "SELECT * FROM `products` where id = '$productid' ";
                    $prod_run =  mysqli_query($conn,$prod_qry);
                    $get_datae = mysqli_fetch_array($prod_run);
                    $imid = $get_datae['product_code']; 
                    $product_name = $get_datae['product_name'];
                    // $productid = $get_datae['id'];
                     $img_query = "SELECT * FROM `image` WHERE `p_id` = '$imid' and status='Active' order by set_seq asc";
                    $run_img  = mysqli_query($conn,$img_query);
                    $get_img = mysqli_fetch_array($run_img);
                     $link ='../asset/image/product/'.$get_img['image'];

              if(file_exists('../emailer_html/order-delivered.html')){
                    $EmailOTP_HTML = file_get_contents('../emailer_html/order-delivered.html');
                }elseif(file_exists('../../emailer_html/order-delivered.html')){
                    $EmailOTP_HTML = file_get_contents('../../emailer_html/order-delivered.html');
                }elseif(file_exists('../../../emailer_html/order-delivered.html')){
                     $EmailOTP_HTML = file_get_contents('../../../emailer_html/order-delivered.html');
                }elseif(file_exists('emailer_html/order-delivered.html')){
                     $EmailOTP_HTML = file_get_contents('emailer_html/order-delivered.html');
                }else{
                    $EmailOTP_HTML = ' __LOGO__';
                }
                $queryl = 'select * from `logo` where id="1"';
               $queryll = mysqli_query($conn,$queryl);
                 $results = mysqli_fetch_array($queryll);
                $logo=BASE_URL.'asset/image/logo/'.$results['logo']; 
                 $email;
                $EmailOTP_HTML = str_replace('__LOGO__', $logo, $EmailOTP_HTML);
                 $EmailOTP_HTML = str_replace('__ORDERID__', $order_id, $EmailOTP_HTML);
                $EmailOTP_HTML = str_replace('__STATUS__', 'DELIVERED', $EmailOTP_HTML);
                 $EmailOTP_HTML = str_replace('__OSTATUS__', 'delivered', $EmailOTP_HTML);
                $EmailOTP_HTML = str_replace('__product_row__', $product, $EmailOTP_HTML);
                 
               sendEmail($email, "Your Order Delivered", $EmailOTP_HTML);

        }

       if($status == "Cancelled"){
    
                    $cenproduct ="";
                    $deliveredString = implode(',' , $deliveredArr);
                    // echo '<script> alert("'.$deliveredString.'")</script>';
              $orderdet_query ="SELECT * FROM order_details WHERE order_id = '$order_id' AND tracking_id NOT IN ($deliveredString)";
              $oederset_run = mysqli_query($conn,$orderdet_query);
                while( $orderdet_get = mysqli_fetch_array($oederset_run)){

                    $productid = $orderdet_get['productid'];
                    $quantity = $orderdet_get['quantity'];
                    $price_with_qty  = $orderdet_get['price'] + $orderdet_get['gst'];
                    $prod_qry = "SELECT * FROM `products` where id = '$productid' ";
                    $prod_run =  mysqli_query($conn,$prod_qry);
                    $get_datae = mysqli_fetch_array($prod_run);
                    $imid = $get_datae['product_code'];
                     $img_query = "SELECT * FROM `image` WHERE `p_id` = '$imid' and status='Active' order by set_seq asc";
                    $run_img  = mysqli_query($conn,$img_query);
                    $get_img = mysqli_fetch_array($run_img);
                     $link = BASE_URL . 'asset/image/product/'.$get_img['image'];
                     
                      $colorName = "";
                        
                    if($get_datae['class0'] != '' )
                    {
                    $colorName .= "(" . mysqli_fetch_assoc(mysqli_query($conn, "SELECT symbol FROM size_class WHERE id=" . $get_datae['class0']))['symbol']. ')';
                    }
                    if($get_datae['class1'] != '')
                    {
                    $colorName .= " (" . $get_datae['class1'] . ')';
                    }
                    
                   if ($get_datae['class2'] != ''){
                    $colorName .= ' (' . $get_datae['class2'] . ')' ;
                   }
                
                
                   if ($get_datae['class3'] != ''){
                    $colorName .= ' (' . $get_datae['class3'] . ')' ;
                   }
                 
                    $cenproduct.='
                        <tr style="text-align:center; border-collapse:collapse; outline:1px solid #bfbbbb">
                            <td style=" padding:10px 5px;border-right: 1px solid #000"><img src="'.$link.'" style="width: 50px;"></td>
                            <td style=" padding:5px;border-right: 1px solid #000">'.$get_datae['product_name'].$colorName.'</td>
                            <td style=" padding:5px;text-align: center;border-right: 1px solid #000">'. $quantity.'</td>
                            <td style=" padding:5px;">'.$price_with_qty.'</td>
                        </tr>';
                    }
         
                if(file_exists('../emailer_html/order-delivered.html')){
                    $EmailOTP_HTML = file_get_contents('../emailer_html/order-delivered.html');
                }elseif(file_exists('../../emailer_html/order-delivered.html')){
                    $EmailOTP_HTML = file_get_contents('../../emailer_html/order-delivered.html');
                }elseif(file_exists('../../../emailer_html/order-delivered.html')){
                     $EmailOTP_HTML = file_get_contents('../../../emailer_html/order-delivered.html');
                }elseif(file_exists('emailer_html/order-delivered.html')){
                     $EmailOTP_HTML = file_get_contents('emailer_html/order-delivered.html');
                }else{
                    $EmailOTP_HTML = ' __LOGO__';
                }
                $queryl = 'select * from `logo` where id="1"';
               $queryll = mysqli_query($conn,$queryl);
                 $results = mysqli_fetch_array($queryll);
                $logo=BASE_URL.'asset/image/logo/'.$results['logo']; 
                 $email;
                $EmailOTP_HTML = str_replace('__LOGO__', $logo, $EmailOTP_HTML);
                 $EmailOTP_HTML = str_replace('__ORDERID__', $order_id, $EmailOTP_HTML);
                $EmailOTP_HTML = str_replace('__STATUS__', 'CANCELLED', $EmailOTP_HTML);
                 $EmailOTP_HTML = str_replace('__OSTATUS__', 'cancelled', $EmailOTP_HTML);
                    $EmailOTP_HTML = str_replace('__product_row__', $cenproduct, $EmailOTP_HTML);
                  sendEmail($email, "Your Order Cancelled", $EmailOTP_HTML);


        }
       elseif ($status == "Ordered and Approved"){

        $orderconform = '<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="margin: 0;padding:0;color: #424242;font-family: '.'Raleway'.';">

    <div style="width: 650px; margin: auto; padding:0px;background-color:#f7f7f7">
        <div style="text-align: center; padding-top: 30px; margin-bottom: 30px">
            <img style="width: 100px;" src="../emailimages/logo-new.png">
        </div>
        <div style="width: 600px;height: auto;margin: auto;background: #fff;box-shadow: 1px 1px 9px #bbbbbb;">
            <div style="background: #FAD7A0;color: #000;width: 100%;height:200px;margin-bottom: 30px;text-align: center;">
                <h1 style="padding: 10px 10px 0px 10px;">Your order is confirmed.</h1>
                <p style="padding:  0px 15px 20px 15px;font-size: 17px;">Hello '.$username.', we have recieved <strong>order id '.$order_id.'</strong> and we are working on it now. We will email you an update when we have shipped it.</p>
                <a href="#" style="background: #000; padding: 10px;color: #fff;text-decoration: none;border-radius: 20px;">View your order details</a>
            </div>
            <div style="width: 100%;text-align: center;">
                <h2 style="font-size: 35px;">Your order is on its way.</h2>
                <img src="../emailimages/gif.gif">
            </div>
            <div style="text-align: center;margin-top: 20px; margin-bottom: 40px;">
                <a href="#" style="background: #ffbb4f; padding: 10px;color: #fff;text-decoration: none;border-radius: 2px;">Track order</a>
            </div>
            <div style="width: 100%;margin-bottom: 30px;text-align: center;">
                <h2>'.$username.'</h2>
                <p>'.$usermobile.'</p>
                <p>'.$email.'</p>
            </div>
            <div style="background: #f3efea;color: #000;width: 100%;height:150px;margin-bottom: 30px;text-align: center;">
                <div style="width: 50%;float: left;">
                    <h2>Shipping Address</h2>
                    <p>Vandana Apts, Navghar Road, Bhayander(e)</p>
                    <p>Bangalore, Karnataka</p>           
                </div>
                <div style="width: 50%;float: right;">
                    <h2>Billing Address</h2>
                    <p>Vandana Apts, Navghar Road, Bhayander(e)</p>
                    <p>Bangalore, Karnataka</p>   
                </div>
            </div>
            <div style="width: 400px;margin: auto;margin-bottom: 20px;margin-top: 40px;">
            <table style="width: 100%;border-collapse: collapse;border:1px solid #000">
                <thead style="width: 100%; color:#fff; font-weight: bold; background: #5f5f5f">
                    <tr style="border-collapse: collapse;">
                        <th style=" padding:10px 5px">Image</th>
                        <th style=" padding:10px 5px">Product</th>
                        <th style=" padding:10px 5px">Quantity</th>
                        <th style=" padding:10px 5px">Price</th>
                    </tr>
                </thead>
                <tbody style="width: 100%; font-size: 14px;padding: 5px;">';
                     $confproduct ="";
                while( $orderdet_get = mysqli_fetch_array($oederset_run)){

                    $productid = $orderdet_get['productid'];
                    $quantity = $orderdet_get['quantity'];
                    $price_with_qty  = $orderdet_get['price'] + $orderdet_get['gst'];
                    $prod_qry = "SELECT * FROM `products` where id = '$productid' ";
                    $prod_run =  mysqli_query($conn,$prod_qry);
                    $get_datae = mysqli_fetch_array($prod_run);
                    $imid = $get_datae['product_code'];
                     $img_query = "SELECT * FROM `image` WHERE `p_id` = '$imid' and status='Active' order by set_seq asc";
                    $run_img  = mysqli_query($conn,$img_query);
                    $get_img = mysqli_fetch_array($run_img);
                    $link = BASE_URL . 'asset/image/product/'.$get_img['image'];
                 
                    $confproduct.='
                        <tr style="border-collapse: collapse;border-bottom: 1px solid #000">
                            <td style=" padding:10px 5px;border-right: 1px solid #000"><img src="'.$link.'" style="width: 50px;"></td>
                            <td style=" padding:5px;border-right: 1px solid #000">'.$get_datae['product_name'].'</td>
                            <td style=" padding:5px;text-align: center;border-right: 1px solid #000">'. $quantity.'</td>
                            <td style=" padding:5px;">'.$price_with_qty.'</td>
                        </tr>';
                    }
              

//                 $conform_orderemail = '</tbody>
//             </table>
//             </div>
//             <div style="color: #000;width: 100%;height:100px;margin-bottom: 30px;text-align: left;">
//                 <div style="width: 50%;float: right;background:#eaeaea;">
//                     <p style="margin-left:20px;"><strong>Shipping : </strong>'.$shipping.'</p> 
//                      <p style="margin-left:20px;"><strong>Total : </strong>'.$orderprice.'</p>  
//                 </div>
//             </div>
//             <div style="background: #000;color: #E5E5E5;padding: 2px;text-align: center;width: 100%;">
//                 <p>Consider rating other past items! <strong>See more</strong></p>
//             </div>
//         </div>
//         <div style="text-align: center;margin-top: 20px;padding-top: 10px;height: 300px; text-align: center;">
//             <h1 style="font-weight: bold;color: #53599c">Stay in Touch</h1>
//             <img src="../emailimages/facebook.png" style="float: left;padding-left: 200px;width: 35px;">
//             <img src="../emailimages/insta.png" style="float: left;padding-left: 20px;width: 35px;">
//             <img src="../emailimages/twit.png" style="float: left;padding-left: 20px;width: 35px;">
//             <img src="../emailimages/youtube.png" style="float: left;padding-left: 20px;width: 35px;">
//             <img src="../emailimages/whats-app.png" style="float: left;padding-left: 20px;width: 35px;">
//             <br><br>
//             <p style="font-size: 13px;margin-top: 35px;">Email sent by Hayaa</p>
//             <p style="font-size: 13px;line-height: 1px;">© 2021 Hayaa. All Right Reserved.</p>
//             <p style="font-size: 13px;float: left;padding-left:180px"><a href="#" style=";color: #808B96">About</a></p>
//             <P style="font-size: 13px;float: left;padding-left: 20px;"><a href="#" style=";color: #808B96">Terms & condition</a></P>
//             <p style="font-size: 13px;float: left;padding-left: 20px;"><a href="#" style=";color: #808B96">Privacy Policy</a></p>
//             <p style="font-size: 13px;float: left;padding-left: 20px;"><a href="#" style=";color: #808B96">Contact</a></p>
//         </div>
//     </div>
// </body>
// </html>';

// include('../mail-send.php');
// $orderconform = $orderconform.$confproduct.$conform_orderemail;
// plmail($email,"Order confirmed",$orderconform);   
if(file_exists('../emailer_html/order-delivered.html')){
                    $EmailOTP_HTML = file_get_contents('../emailer_html/order-delivered.html');
                }elseif(file_exists('../../emailer_html/order-delivered.html')){
                    $EmailOTP_HTML = file_get_contents('../../emailer_html/order-delivered.html');
                }elseif(file_exists('../../../emailer_html/order-delivered.html')){
                     $EmailOTP_HTML = file_get_contents('../../../emailer_html/order-delivered.html');
                }elseif(file_exists('emailer_html/order-delivered.html')){
                     $EmailOTP_HTML = file_get_contents('emailer_html/order-delivered.html');
                }else{
                    $EmailOTP_HTML = ' __LOGO__';
                }
                $queryl = 'select * from `logo` where id="1"';
               $queryll = mysqli_query($conn,$queryl);
                 $results = mysqli_fetch_array($queryll);
                $logo=BASE_URL.'asset/image/logo/'.$results['logo']; 
                 $email;
                $EmailOTP_HTML = str_replace('__LOGO__', $logo, $EmailOTP_HTML);
                 $EmailOTP_HTML = str_replace('__ORDERID__', $order_id, $EmailOTP_HTML);
                $EmailOTP_HTML = str_replace('__STATUS__', 'ORDERED AND APPROVED', $EmailOTP_HTML);
                 $EmailOTP_HTML = str_replace('__OSTATUS__', 'ordered and approved', $EmailOTP_HTML);
                       $EmailOTP_HTML = str_replace('__product_row__', $confproduct, $EmailOTP_HTML);
                  sendEmail($email, "Your Order ordered and approved", $EmailOTP_HTML);

       }
       elseif($status == 'your item out for delivery'){
           
                 $FDproduct ="";
                while( $orderdet_get = mysqli_fetch_array($oederset_run)){
                    $orderid = $orderdet_get['order_id'];
                    $queryship = 'select * from `order_tbl` where `order_id` = "'.$orderid.'"';
                    $shipresult = mysqli_query($conn, $queryship);
                    while( $shippa = mysqli_fetch_assoc($shipresult)) {
                        $shipprice = $shippa['shipping'];
                    }
                    $productid = $orderdet_get['productid'];
                    $quantity = $orderdet_get['quantity'];
                    $price_with_qty  = $orderdet_get['price'] +  $orderdet_get['gst']  + ' + shipping charge';
                    $prod_qry = "SELECT * FROM `products` where id = '$productid' ";
                    $prod_run =  mysqli_query($conn,$prod_qry);
                    $get_datae = mysqli_fetch_array($prod_run);
                    $imid = $get_datae['product_code'];
                     $img_query = "SELECT * FROM `image` WHERE `p_id` = '$imid' and status='Active' order by set_seq asc";
                    $run_img  = mysqli_query($conn,$img_query);
                    $get_img = mysqli_fetch_array($run_img);
                    $link = 'https://micodetest.com/msg_updated/asset/image/product/' . $get_img['image'];

                    $FDproduct.='
                        <tr style="border-collapse: collapse;border-bottom: 1px solid #000">
                            <td style=" padding:10px 5px;border-right: 1px solid #000"><img src="'.$link.'" style="width: 50px;"></td>
                            <td style=" padding:5px;border-right: 1px solid #000">'.$get_datae['product_name'].'</td>
                            <td style=" padding:5px;text-align: center;border-right: 1px solid #000">'. $quantity.'</td>
                            <td style=" padding:5px;">'.$price_with_qty.'</td>
                        </tr>';
                    }
              
              
              

        if(file_exists('../emailer_html/order-delivered.html')){
                    $EmailOTP_HTML = file_get_contents('../emailer_html/order-delivered.html');
                }elseif(file_exists('../../emailer_html/order-delivered.html')){
                    $EmailOTP_HTML = file_get_contents('../../emailer_html/order-delivered.html');
                }elseif(file_exists('../../../emailer_html/order-delivered.html')){
                     $EmailOTP_HTML = file_get_contents('../../../emailer_html/order-delivered.html');
                }elseif(file_exists('emailer_html/order-delivered.html')){
                     $EmailOTP_HTML = file_get_contents('emailer_html/order-delivered.html');
                }else{
                    $EmailOTP_HTML = ' __LOGO__';
                }
                $queryl = 'select * from `logo` where id="1"';
               $queryll = mysqli_query($conn,$queryl);
                 $results = mysqli_fetch_array($queryll);
                $logo=BASE_URL.'asset/image/logo/'.$results['logo']; 
                 $email;
                $EmailOTP_HTML = str_replace('__LOGO__', $logo, $EmailOTP_HTML);
                 $EmailOTP_HTML = str_replace('__ORDERID__', $order_id, $EmailOTP_HTML);
                $EmailOTP_HTML = str_replace('__STATUS__', 'OUT FOR DELIVERY', $EmailOTP_HTML);
                 $EmailOTP_HTML = str_replace('__OSTATUS__', 'out for delivery', $EmailOTP_HTML);
                   $EmailOTP_HTML = str_replace('__product_row__', $FDproduct, $EmailOTP_HTML);
                  sendEmail($email, "Your Order Out for delivery", $EmailOTP_HTML);

 
    $deliverman = "SELECT * FROM delivery_schedule WHERE order_id ='$order_id' ";
$run_delman = mysqli_query($conn,$deliverman);
if(mysqli_num_rows($run_delman)>0){
    $getdelive = mysqli_fetch_array($run_delman);
    $deliverymen_id = $getdelive['deliverymen_id'];
    $tracking_id = $getdelive['tracking_id'];
      $detaild_man = "SELECT * FROM deliverymen WHERE id = '$deliverymen_id' ";
   
    $run_detaild_man =  mysqli_query($conn,$detaild_man);
    $get_detaild_man = mysqli_fetch_array($run_detaild_man);
    $deliverd_name = $get_detaild_man['name'];
    
    $deliver_mobile = $get_detaild_man['mobile'];
     
// $delivermain =' <!DOCTYPE html>
// <html>
// <head>
//     <meta charset="UTF-8">
//     <meta http-equiv="X-UA-Compatible" content="IE=edge">
//     <meta name="viewport" content="width=device-width, initial-scale=1.0">
//     <title>Document</title>
// </head>
// <body style="margin: 0;padding:0;color: #424242;font-family: '.'Raleway'.';">

//     <div style="width: 650px; margin: auto; padding:0px;background-color:#f7f7f7">
//         <div style="text-align: center; padding-top: 30px; margin-bottom: 30px;">
//             <img style="width: 100px;" src="../emailimages/logo-new.png">
//         </div>
//         <div style="width: 600px;height: auto;margin: auto;background: #fff;box-shadow: 1px 1px 9px #bbbbbb;">
//         <div style="height: 150px;">
//             <img src="../emailimages/banner6.png">
//         </div>
//         <div style="text-align: center; padding-top: 30px; margin-bottom: 10px">
//             <h1>Track your order</h1>
//             <img style="width: 400px;" src="../emailimages/shipped.png">
//         </div>
//         <div style="text-align: center;margin: 20px 0px 40px 0px;">
           
//         </div>
//         <div style=" padding: 0px 20px 0px 20px;width: 100%">
//             <p style="font-size: 16px;font-weight: bold;margin-bottom:30px; padding: 0px 30px;">Hello '.$username.',</p>
//             <p style="font-size: 16px; padding: 0px 30px;">We thought you did like to know that ocean resource dispatched your items. Your order is on the way.</p>
//             <p style="font-size: 16px; padding: 0px 30px;">Your items are sent by ATS. Your <strong>tracking number is '.$tracking_id.'</strong>. Please note that a signature may be required for delivery of the package.</p>
//         </div>
//         <div style="width: 100%">
//             <p style="font-size: 16px; padding: 0px 30px 0px 50px;">Below are the details of the delivery boy.</p>
//         </div>
//         <div style="color: #000;width: 100%;height:100px;text-align: left;">
//             <div style="width: 50%;float: left;padding:0px 10px 0px 50px;">
//                 <p><strong>Name : </strong>'.$deliverd_name.'</p>
//                 <p><strong>Phone Number : </strong>'.$deliver_mobile.'</p>
//                 <p><strong>Delivery Status : </strong>'.$status.'</p>        
//             </div>
//         </div>
//         <div style="width: 400px;margin: auto;margin-bottom: 20px;margin-top: 30px;">
//             <table style="width: 100%;border-collapse: collapse;border:1px solid #000">
//                 <thead style="width: 100%; color:#fff; font-weight: bold; background: #5f5f5f">
//                     <tr style="border-collapse: collapse;">
//                         <th style=" padding:10px 5px">Image</th>
//                         <th style=" padding:10px 5px">Product</th>
//                         <th style=" padding:10px 5px">Quantity</th>
//                         <th style=" padding:10px 5px">Price</th>
//                     </tr>
//                 </thead>
//                 <tbody style="width: 100%; font-size: 14px;padding: 5px;">';
//                          $delpro ="";
//                 while( $orderdet_get = mysqli_fetch_array($oederset_run)){

//                     $productid = $orderdet_get['productid'];
//                     $quantity = $orderdet_get['quantity'];
//                     $price_with_qty  = $orderdet_get['price'];
//                     $prod_qry = "SELECT * FROM `products` where id = '$productid' ";
//                     $prod_run =  mysqli_query($conn,$prod_qry);
//                     $get_datae = mysqli_fetch_array($prod_run);
//                     $imid = $get_datae['product_code'];
//                      $img_query = "SELECT * FROM `image` WHERE `p_id` = '$imid' ";
//                     $run_img  = mysqli_query($conn,$img_query);
//                     $get_img = mysqli_fetch_array($run_img);
//                      $link ='../asset/image/product/'.$get_img['image'];
                 
//                     $delpro.='
//                         <tr style="border-collapse: collapse;border-bottom: 1px solid #000">
//                             <td style=" padding:10px 5px;border-right: 1px solid #000"><img src="'.$link.'" style="width: 50px;"></td>
//                             <td style=" padding:5px;border-right: 1px solid #000">'.$get_datae['product_name'].'</td>
//                             <td style=" padding:5px;text-align: center;border-right: 1px solid #000">'. $quantity.'</td>
//                             <td style=" padding:5px;">'.$price_with_qty.'</td>
//                         </tr>';
//                     }
              

                    
//                 $delivermainfooter ='</tbody>
//             </table>
//         </div>
//         <div style="background: #f3efea;color: #000;width: 100%;height:200px;text-align: left;">
//             <h3 style="padding: 10px 30px 0px 40px;">Order Summary</h3>
//             <div style="width: 50%;float: left;padding:0px 10px 0px 40px;">
//                 <p><strong>Order Id : </strong>'.$order_id.'</p>
//                 <p><strong>Order date : </strong>'.$order_date.'</p>
//                 <p><strong>Order total : </strong>'.$orderprice.'</p> 
//                 <p><strong>Payment mode : </strong>'.$payment_mode.'</p>           
//             </div>
//             <div style="width: 40%;float: right;padding-top: 10px;">
//                 <p style="margin-left:20px;"><strong>Shipping : </strong>'.$shipping.'</p> 
//                 <p style="margin-left:20px;"><strong>Total : </strong>'.$orderprice.'</p> 
//             </div>
//         </div>
//         <div style="padding: 20px;width: 100%;margin-top: 20px;">
//             <p style="font-size: 16px; font-weight: bold; padding: 0px 30px;">Thanks,</p>
//             <p style="font-size: 16px; line-height: 1px; font-weight: bold; padding: 0px 30px;">The Hayaa account team</p>
//         </div>
//         <div style="background: #32A375;color: #E5E5E5;width: 100%;height: 10px;">
//         </div>
//         </div>
//         <div style="text-align: center;padding-top: 10px;height: 300px; text-align: center;width: 100%;">
//             <h1 style="font-weight: bold;color: #53599c">Stay in Touch</h1>
//             <img src="../emailimages/facebook.png" style="float: left;padding-left: 200px;width: 35px;">
//             <img src="../emailimages/insta.png" style="float: left;padding-left: 20px;width: 35px;">
//             <img src="../emailimages/twit.png" style="float: left;padding-left: 20px;width: 35px;">
//             <img src="../emailimages/youtube.png" style="float: left;padding-left: 20px;width: 35px;">
//             <img src="../emailimages/whats-app.png" style="float: left;padding-left: 20px;width: 35px;">
//             <br><br>
//             <p style="font-size: 13px;margin-top: 35px;">Email sent by Hayaa</p>
//             <p style="font-size: 13px;line-height: 1px;">© 2021 Hayaa. All Right Reserved.</p>
//             <p style="font-size: 13px;float: left;padding-left:180px"><a href="#" style=";color: #808B96">About</a></p>
//             <P style="font-size: 13px;float: left;padding-left: 20px;"><a href="#" style=";color: #808B96">Terms & condition</a></P>
//             <p style="font-size: 13px;float: left;padding-left: 20px;"><a href="#" style=";color: #808B96">Privacy Policy</a></p>
//             <p style="font-size: 13px;float: left;padding-left: 20px;"><a href="#" style=";color: #808B96">Contact</a></p>
//         </div>
//     </div>
// </body>
// </html>';
    // include('../mail-send.php');
    $deliverdstatus = $delivermain.$delpro.$delivermainfooter;
    // plmail($email,"Order Deliverd",$deliverdstatus);
        }
}
    }
    
    if($_POST['status']=='Seller has processed your Order'){
        $update_order_status_sql = $query;
        include('express-bees.php');
        if($data['msg'] == null) $data['msg'] = "Unexpected Error Encountered while Processing Order For Shipment";
        
        if($data['shipping_status']){
            $ins=mysqli_query($conn,$update_order_status_sql);
        }
        
        ?> <script>alert("<?= $data['msg'] ?>");</script> <?php
        
    }
    else if($_POST['status'] != 'Cancelled'){
        $ins=mysqli_query($conn,$query);
    }
    if($_POST['status']=='Ordered and Approved')
    {
        $select_query=mysqli_query($conn,"SELECT * FROM `order_details` WHERE `tracking_id`='$tracking_id'");
        $select_data=mysqli_fetch_array($select_query);
        $product_id=$select_data['productid'];
        $quantity=$select_data['quantity'];
        $stock_query=mysqli_query($conn,"SELECT in_stock FROM `products` WHERE id = $product_id");
        $stock_data=mysqli_fetch_array($stock_query);
        $stock_no=$stock_data['in_stock'];
        $newstock=$stock_no-$quantity;
            if($newstock==0){
                $stockStatus = "No";
                }else{
                $stockStatus = "Yes";
                }
                $query="INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`, `created_time`) 
                VALUES ('$product_id','$quantity','Debit','$date','$time')";
                $ins=mysqli_query($conn,$query);
                
                $stock_update_query = mysqli_query($conn,"UPDATE `products` SET 
                `stock` = '$stockStatus',
                `in_stock` = '$newstock'
                 WHERE id='$product_id'");           
    
}

if($_POST['status']=='Delivered')
{
    //////// Update Payment Status ////////
    $paymentModeQuery=mysqli_query($conn,"SELECT * FROM `order_tbl` WHERE order_id='$order_id'");
    $paymentModeData=mysqli_fetch_array($paymentModeQuery);
 
 
    if($paymentModeData['payment_mode']=='COD')
    {
        $update = mysqli_query($conn,"UPDATE `order_details` SET 
        `payment_status` = 'Success'
         WHERE 	tracking_id='$tracking_id'");
    }

    $resultCount[]="";

    //////// Update Order Table Payment Status ////////
    $orderPaymentStatus = true;
    $orderPaymentDetailsQuery=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
    // $orderTableStatus = $orderDetailsData=mysqli_fetch_array($orderDetailsQuery);
    while($orderPaymentDetailsRow = mysqli_fetch_array($orderPaymentDetailsQuery))
    {

   if($orderPaymentDetailsRow['payment_status'] == 'Pending'){
    $orderPaymentStatus = false;
  
    break;
   }
   
    }
    // echo '<pre>';
    // print_r($resultCount);
    // exit();

    if($orderPaymentStatus){
        $update = mysqli_query($conn,"UPDATE `order_tbl` SET 
        `payment_status` = 'Success'
         WHERE order_id='$order_id'");
    }
    //////// Update Order Table Payment Status ////////

    //////// Update Payment Status ////////
  
  
  
    //////// Update Order Table Status ////////
  $orderTableStatus = true;
  $orderDetailsQuery=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
  // $orderTableStatus = $orderDetailsData=mysqli_fetch_array($orderDetailsQuery);
  while($orderDetailsRow = mysqli_fetch_array($orderDetailsQuery))
  {
  $orderStatusQuery="SELECT id FROM `order_status` WHERE `tracking_id`='".$orderDetailsRow['tracking_id']."' AND (`tracking_status`='Cancelled' OR `tracking_status`='Delivered') ORDER BY id DESC LIMIT 1";
  $orderDetailsData=mysqli_query($conn,$orderStatusQuery);
  $count = mysqli_num_rows($orderDetailsData);

 if($count == 0){
  $orderTableStatus = false;

  break;
 }
 
  }
  
  if($orderTableStatus){
      $update = mysqli_query($conn,"UPDATE `order_tbl` SET 
      `order_status` = 'Completed'
       WHERE order_id='$order_id'");
  }
  //////// Update Order Table Status ////////
}


    if($_POST['status']=='Cancelled'){
        $status=$_POST['status'];
        $by="admin";
        $reason=$_POST['reason'];
        //$update=mysqli_query($conn,"UPDATE `order_tbl` SET `order_status`='$status',`reason`='$reason' WHERE id='$order_id'" );
        $pquery=mysqli_query($conn,"SELECT * FROM `order_tbl` WHERE order_id='$order_id'");
        $pdata=mysqli_fetch_array($pquery);
        if($pdata['promo_code_id']!=0)
        {
            $promo_id=$pdata['promo_code_id'];
            $promo_sel=mysqli_query($conn,"SELECT * FROM `promo_code` WHERE id=$promo_id");
            $promo_data=mysqli_fetch_array($promo_sel);
            $promo_qty=$promo_data['use_quantity']+1;
            $promo_up=mysqli_query($conn,"UPDATE `promo_code` SET `use_quantity`='$promo_qty' WHERE id=$promo_id");
        }

        //////// Update Order Table Status ////////
        $orderTableStatus = true;
        $orderDetailsQuery=mysqli_query($conn,"SELECT * FROM `order_details` WHERE order_id='$order_id'");
        // $orderTableStatus = $orderDetailsData=mysqli_fetch_array($orderDetailsQuery);
        while($orderDetailsRow = mysqli_fetch_array($orderDetailsQuery))
        {
        $orderStatusQuery="SELECT id FROM `order_status` WHERE `tracking_id`='".$orderDetailsRow['tracking_id']."' AND (`tracking_status`='Cancelled' OR `tracking_status`='Delivered') ORDER BY id DESC LIMIT 1";
        $orderDetailsData=mysqli_query($conn,$orderStatusQuery);
        $count = mysqli_num_rows($orderDetailsData);

       if($count == 0){
        $orderTableStatus = false;

        break;
       }
       
        }
        
        if($orderTableStatus){
            $update = mysqli_query($conn,"UPDATE `order_tbl` SET 
            `order_status` = 'Completed'
             WHERE order_id='$order_id'");
        }
        //////// Update Order Table Status ////////


        $status_query1=mysqli_query($conn,"SELECT * FROM `order_status` WHERE `tracking_id`='$tracking_id' AND `tracking_status`='Cancelled' ORDER BY id DESC");
        if(mysqli_num_rows($status_query1) > 0)
        {
            $select_query=mysqli_query($conn,"SELECT * FROM `order_details` WHERE `tracking_id`='$tracking_id'");
            $select_data=mysqli_fetch_array($select_query);
            

                $product_id=$select_data['productid'];
                $quantity=$select_data['quantity'];
                
                $orderStatusQuery=mysqli_query($conn,"SELECT count(*) as in_count FROM `order_status` WHERE `tracking_id`='$tracking_id' AND `tracking_status`='Ordered and Approved'");
                $orderStatusData=mysqli_fetch_array($orderStatusQuery);

                if($orderStatusData['in_count']!=0){
                    $stock_query=mysqli_query($conn,"SELECT in_stock FROM `products` WHERE id = $product_id");
                    $stock_data=mysqli_fetch_array($stock_query);
                    $stock_no=$stock_data['in_stock'];
                    $newstock=$stock_no+$quantity;
                        if($newstock==0){
                            $stockStatus = "No";
                            }else{
                            $stockStatus = "Yes";
                            }
                            $query="INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`, `created_time`) 
                            VALUES ('$product_id','$quantity','Credit','$date','$time')";
                            $ins=mysqli_query($conn,$query);
                            
                            $query="UPDATE products SET 
                            stock = '$stockStatus',
                            in_stock = $newstock
                             WHERE id='$product_id'";
                            //  print_r($query);
                            //  exit();
                            $stock_update_query = mysqli_query($conn,$query);          
                }

            $vendor_sel1=mysqli_query($conn,"SELECT * FROM `vendor_order_tbl` WHERE `order_id`='$order_id' AND p_id='$product_id'");
            $vendor_data=mysqli_fetch_array($vendor_sel1);
            $vp_id=$vendor_data['vp_id'];
            $vquantity=$vendor_data['quantity'];
            $vendor_psel=mysqli_query($conn,"SELECT * FROM `vendor_stock` WHERE `vp_id`='$vp_id'");
            $vendor_psel_data=mysqli_fetch_array($vendor_psel);
            $newvpstock=$vendor_psel_data['stock_no']+$vquantity;
            if($vendor_psel_data['stock_no']==0)
            {
                $vendor_stock_up=mysqli_query($conn,"UPDATE `vendor_stock` SET `stock`='Instock',`stock_no`='$newvpstock' WHERE vp_id=$vp_id");
            }else
            {
                $vendor_stock_up=mysqli_query($conn,"UPDATE `vendor_stock` SET `stock_no`='$newvpstock' WHERE vp_id=$vp_id");
            }
            $vendor_up=mysqli_query($conn,"UPDATE `vendor_order_tbl` SET `order_status`='$status',`order_status_by`='$by',`reason`='$reason' WHERE order_id='$order_id' AND p_id='$product_id'");
            
        }
    }
    if($_POST['status']=='Cancelled'){
        $status=$_POST['status'];
        $by="admin";
        $reason=$_POST['reason'];
        $update=mysqli_query($conn,"UPDATE `delivery_schedule` SET `delivery_status`='$status',`delivery_status_by`='$by',`reason`='$reason',`dmen_date`='$date',`dmen_time`='$time' WHERE tracking_id='$tracking_id' And delivery_status=' ' " );
        $updates=mysqli_query($conn,"UPDATE `warehouse_schedule` SET `order_status`='$status',`order_status_by`='$by',`reason`='$reason',`war_date`='$date',`war_time`='$time' WHERE `tracking_id`='$tracking_id'" );
    }


//////// Create Invoice //////// 
$orderStatusQuery=mysqli_query($conn,"SELECT * FROM `order_tbl` WHERE order_id='$order_id'");
    $orderStatusData=mysqli_fetch_array($orderStatusQuery);

    if($orderStatusData['order_status'] == 'Completed'){



        // $invoiceNo = gnerateInvoiceNo();

        // $token = generateToken(24);
        // $userId = $orderStatusData['userid'];
        // $sel_query=mysqli_query($conn,"SELECT * FROM `invoice_generate` WHERE invoice_no='$invoiceNo'");
        // if(mysqli_num_rows($sel_query)==0)
        // {
        //     $invoice_query="INSERT INTO `invoice_generate`(`user_id`,`order_id`,`invoice_no`, `invoice_date`,`invoice_time`,`token`) VALUES ('$userId','$order_id','$invoiceNo','$date','$time','$token')";

        //     // print_r($invoice_query);
        //     // exit();
        //     $invQ=mysqli_query($conn,$invoice_query);
        // }else{
        // $invoiceNo = rand(10000,99999);
        
        //     $invoice_query="INSERT INTO `invoice_generate`(`user_id`,`order_id`,`invoice_no`, `invoice_date`,`invoice_time`,`token`) VALUES ('$userId','$order_id','$invoiceNo','$date','$time','$token')";
        //     $invQ=mysqli_query($conn,$invoice_query);
        // }
    }
//////// Create Invoice ////////



    ?>
    <script type="text/javascript">
            window.location.href="order-details.php?order_id=<?php echo $order_id; ?>";
    </script>
    <?php  
}
?>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Card End -->
                                    <br>
                                    <!-- Card End -->

                               