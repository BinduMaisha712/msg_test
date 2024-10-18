<?php 
	include('config/connection.php');

	 $img_id=$_REQUEST['img_id'];
	 $pid=$_REQUEST['pid'];
	 $sel_query=mysqli_query($conn,"SELECT * FROM `image` WHERE id=$img_id");
	 $sel_data=mysqli_fetch_array($sel_query);
	 $img="image/".$sel_data['image'];

	$query=mysqli_query($conn,"DELETE FROM `image` WHERE id=$img_id");
		//unlink($img);
	 //$query=mysqli_query($conn,"UPDATE `image` SET status='Inactive' WHERE id=$img_id");
	?>
		 <script type="text/javascript">
                    
                    window.location.href='products-detail.php?pid=<?php echo $pid; ?>';

                </script>
	<?php

?>