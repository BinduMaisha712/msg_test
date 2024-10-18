<?php

include('config/connection.php');

$pid=$_REQUEST['pid'];
$acid=$_REQUEST['Approved'];

	$query=mysqli_query($conn,"UPDATE `vendor_products` SET `admin_approval`='$acid' WHERE id=$pid");
	if($acid=='Unapproved'){
		$products_query=mysqli_query($conn,"SELECT * FROM `vendor_products` WHERE id=$pid");
		$products_data=mysqli_fetch_array($products_query);
		$cat_id=$products_data['cat_id'];
		$subcat_id=$products_data['subcat_id'];
		$vendor_id=$products_data['vendor_id'];
		$product_name=$products_data['product_name'];
		$stock_query=mysqli_query($conn,"SELECT * FROM `vendor_stock` WHERE vp_id=$pid");
    	$stock_data=mysqli_fetch_array($stock_query);
    	$vstock=$stock_data['stock_no'];

		$pro_query=mysqli_query($conn,"SELECT * FROM `products` WHERE `cat_id`='$cat_id' AND `subcat_id`='$subcat_id' AND `product_name`='$product_name'");
		$pro_data=mysqli_fetch_array($pro_query);
		$pro_id=$pro_data['id'];
		$sel_query=mysqli_query($conn,"SELECT * FROM `stock` WHERE p_id=$pro_id");
		$sel_data=mysqli_fetch_array($sel_query);
		$stock=$sel_data['stock_no'];
		if($vstock==$stock)
		{
			//$pro_update=mysqli_query($conn,"UPDATE `products` SET `status`='Inactive' WHERE id=$pro_id");
			$del_query=mysqli_query($conn,"DELETE FROM `vendor_approval_products` WHERE vendor_id='$vendor_id' AND p_id='$pro_id' AND vp_id='$pid'");
			$stock=$stock-$vstock;
			$update_query=mysqli_query($conn,"UPDATE `stock` SET `stock`='OutOfStock' ,`stock_no`='$stock' WHERE p_id=$pro_id");
		}else
		{
			$stock=$stock-$vstock;
			$update_query=mysqli_query($conn,"UPDATE `stock` SET stock_no='$stock' WHERE p_id=$pro_id");
			$del_query=mysqli_query($conn,"DELETE FROM `vendor_approval_products` WHERE `vendor_id`='$vendor_id' AND `p_id`='$pro_id' AND `vp_id`='$pid'");
		}
	}
	if($acid=='Approved'){
		$products_query=mysqli_query($conn,"SELECT * FROM `vendor_products` WHERE id=$pid");
		$products_data=mysqli_fetch_array($products_query);
		
			$cat_id=$products_data['cat_id'];
			$subcat_id=$products_data['subcat_id'];
			$vendor_id=$products_data['vendor_id'];
			$product_name=$products_data['product_name'];
			$price=$products_data['price'];
			$discount=$products_data['discount'];
			$size=$products_data['size'];
			$color=$products_data['color'];
			$similar_products_id=$products_data['similar_products_id'];
			date_default_timezone_set("Asia/kolkata");
	        $date=date("Y-m-d");
	        $time=date("H:i:s");
			$last_query=mysqli_query($conn,"SELECT * FROM `products` order by id desc limit 1");
	        $last_data=mysqli_fetch_array($last_query);
	        $code=$last_data['product_code'];
	        $num_str=$code+1;

	        $pquery=mysqli_query($conn,"INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`, `price`,`size`,`color`,`similar_products_id`,`product_code`,`vendor_id`,`vendor_product_id`,`date`,`time`) VALUES ('$cat_id','$subcat_id','$product_name','$price','$size','$color','$similar_products_id','$num_str','$vendor_id','$pid','$date','$time')");
	        	$last=mysqli_insert_id($conn);
	        	$pro_query=mysqli_query($conn,"SELECT * FROM `products` WHERE id=$last");
				$pro_data=mysqli_fetch_array($pro_query);
				$product_code=$pro_data['product_code'];
	        	$app_query=mysqli_query($conn,"INSERT INTO `vendor_approval_products`(`vendor_id`, `p_id`, `vp_id`,`product_code`, `date`, `time`) VALUES ('$vendor_id','$last','$pid','$product_code','$date','$time')");

	        $image_query=mysqli_query($conn,"SELECT * FROM `vendor_image` WHERE vp_id=$pid AND status='Active'");
	        while($image_data=mysqli_fetch_array($image_query))
	        {
	        	$image=$image_data['image'];
		        $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('$cat_id','$subcat_id','$last','$image')");
		        
			}

			$desc_query=mysqli_query($conn,"SELECT * FROM `vendor_description` WHERE vp_id=$pid AND status='Active'");
			while($desc_data=mysqli_fetch_array($desc_query))
			{
				$description=mysqli_real_escape_string($desc_data['description']);
				 $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('$cat_id','$subcat_id','$last','$description')");
			}

			$spec_query=mysqli_query($conn,"SELECT * FROM `vendor_specifications` WHERE vp_id=$pid AND status='Active'");
			while($spec_data=mysqli_fetch_array($spec_query))
			{

					$specifications=mysqli_real_escape_string($spec_data['specifications']);
                    $ins=mysqli_query($conn,"INSERT INTO `specifications`(`c_id`, `s_id`, `p_id`, `specifications`) VALUES ('$cat_id','$subcat_id','$last','$specifications')");
			}

			$stock_query=mysqli_query($conn,"SELECT * FROM `vendor_stock` WHERE vp_id=$pid ");
			$stokc_data=mysqli_fetch_array($stock_query);
			$cod=$stokc_data['cod'];
			$online=$stokc_data['online'];
			$stock=$stokc_data['stock'];
			$stock_no=$stokc_data['stock_no'];
			$delivery_charges=$stokc_data['delivery_charges'];
			$stock_ins=mysqli_query($conn,"INSERT INTO `stock`(`c_id`, `s_id`, `p_id`, `cod`,`online`,`stock_no`,`delivery_charges`) VALUES ('$cat_id','$subcat_id','$last','$cod','$online','$stock_no','$delivery_charges')");
                     

                        
		
	}
	if($query)
	{ ?>

		<script>
	   //alert("Your request successfully add");
	  window.location.href="vendor-products-detail.php?pid=<?php echo $pid; ?>"
		</script>
		<?php
	}

?>