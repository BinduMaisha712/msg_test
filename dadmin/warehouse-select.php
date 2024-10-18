<?php
	include('config/connection.php');
	session_start();
	error_reporting();
	$tracking_id=$_REQUEST['tracking_id'];
	if(!empty($_SESSION['trackid']))
	{
		$trackid=$_SESSION['trackid'];
		foreach($trackid as $newtrackid)
		{
			$trac[]=$newtrackid[0];
		}
		if(in_array($tracking_id, $trac))
		{
			foreach ($trackid as $k => $item) 
			{
                if ($item[0] == $tracking_id)
                {
                    array_splice($trackid,$k,1);
                } 
            }
		}else{
			$newtrackid=array($tracking_id);
			array_push($trackid, $newtrackid);
		}
	}else{
		$_SESSION['trackid']=array($tracking_id);
		$trackid=array($_SESSION['trackid']);
	}
	
	$trackid=$_SESSION['trackid']=$trackid;
	//print_r($trackid);
	//unset($_SESSION['trackid']);
	$counttrackid=count($trackid);
	?>
<option>---select warehouse---</option>
	<?php
	foreach($trackid as $trackid)
	{
		$trackid=$trackid[0];
		$order_query=mysqli_query($conn,"SELECT * FROM `order_details` WHERE `tracking_id`='$trackid'");
		$order_data=mysqli_fetch_array($order_query);
		$product_id=$order_data['productid'];
		$qty=$order_data['quantity'];
		$ware_query=mysqli_query($conn,"SELECT * FROM `warehouse_stock` WHERE `stock_no`>='$qty' AND p_id IN (SELECT productid FROM `order_details` WHERE `tracking_id`='$trackid')");
            while($data=mysqli_fetch_array($ware_query))
                {
                    $a[] =$data['warehouse_id']; 
                }
	
}
		$b=array_count_values($a);
		foreach($b as $c=>$d)
		{
			if($counttrackid==$d)
			{
				
				$sel_ware=mysqli_query($conn,"SELECT * FROM `warehouse` WHERE id=$c");
        	   	if(mysqli_num_rows($sel_ware) > 0){
            	      $sel_ware_data=mysqli_fetch_array($sel_ware); ?>
            	      <option value="<?php echo $sel_ware_data['id']; ?>"><?php echo $sel_ware_data['name']. " ,".$sel_ware_data['locality']." ," .$sel_ware_data['address'].",".$sel_ware_data['city']; ?>
                        </option>                                   
                  <?php
                        }
			}
		}



?>