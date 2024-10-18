<?php
session_start();
error_reporting(0);
	include('config/connection.php');
	$tracking_id=$_REQUEST['tracking_id'];
    if(!empty($_SESSION['proid']))
    {
        $proid=$_SESSION['proid'];
        $proids=$_SESSION['proid'];
        foreach($proids as $items)
        {
            $pro[]=$items[0];
        }
        if (in_array($tracking_id, $pro))
          {
            foreach ($proid as $k => $item) {
                if ($item[0] == $tracking_id) {
                        array_splice($proid,$k,1);
                }
            } 
            
          }
          else{
            $newproid = array($tracking_id);
            array_push($proid, $newproid);  
          }
    }else{
        $_SESSION['proid']=array($tracking_id);
        $proid=array($_SESSION['proid']);
    }
    $proid=$_SESSION['proid']=$proid;
    //print_r($_SESSION['proid']);
    $countproid=count($proid);
?>
    <option>--select vendor---</option>
    <?php
    foreach($proid as $tracking_id)
        {
                    $tracking_id=$tracking_id[0];
                    $sel=mysqli_query($conn,"SELECT * FROM `order_details` WHERE `tracking_id`='$tracking_id'");
                    $data=mysqli_fetch_array($sel);
                    $product_id=$data['productid'];
                    $qty=$data['quantity'];
                     $ven_query=mysqli_query($conn,"SELECT * FROM `vendor_approval_products` WHERE p_id='$product_id'");
                    while($ven_data=mysqli_fetch_array($ven_query))
                    {
                            
                            $vendor_product_id=$ven_data['vp_id'];
                            $vendor_stock_query=mysqli_query($conn,"SELECT * FROM `vendor_stock` WHERE `stock_no` >='$qty' AND vp_id='$vendor_product_id'");
                            if(mysqli_num_rows($vendor_stock_query) > 0)
                            {
                                $a[]=$ven_data['vendor_id'];
                            }
                           
                    }
        }
        $b=array_count_values($a);
        foreach($b as $c=>$d)
        {
            if($d==$countproid)
            {
             
                                 $vendor_query=mysqli_query($conn,"SELECT * FROM `vendor` WHERE id='$c'");
                                 $vendor_data=mysqli_fetch_array($vendor_query);
                                    ?>
                                 <option  value="<?php echo $c; ?>" ><?php echo $vendor_data['name']; ?></option>
                                    <?php
            }
                            
        }

?>