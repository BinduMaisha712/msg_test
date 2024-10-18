<?php

include('config/connection.php');
$pid=$_REQUEST['pid'];
$Active=$_REQUEST['Active'];
$trash=$_REQUEST['trash'];

	$query=mysqli_query($conn,"UPDATE `promo_code` SET `status`='$Active', `trash`='$trash' WHERE id=$pid");
if($query)
{
           if($trash == 'Yes'){ ?>
           <script>
   //alert("Your request successfully add");
  window.location.href="promo-code-view.php";
	</script>
               
          <?php }else{ ?>
              <script>
   //alert("Your request successfully add");
  window.location.href="promocode-trash-view.php";
	</script>
      <?php    }
    
	
	
}
?>