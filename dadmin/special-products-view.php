   
<?php include('includes/header.php'); ?>



 <main class="main--container">
     <section class="main--content">
                <div class="panel">
                    <div class="panel-heading">
                        <h3 class="panel-title">Special Specification Image</h3>
                    </div>

                    <div class="panel-content">
                        <div class="table-responsive">
                            <table class="table table-bordered table-cells-middle" style="border: hidden;">
                                <thead class="text-dark">
     
                                </thead>
                                <tbody>
                                   
<?php
$id = $_GET['id'];
        $query=mysqli_query($conn,"SELECT * FROM `special_image` where productid='$id' ");
        $sr=1;
        while($data=mysqli_fetch_array($query))
        {
           
                ?>                 
                            <tr>  
<td style="border: hidden;" > <?php echo $sr ; ?> </td>							
                                    <td style="border: hidden;"><img src="image/special/<?php echo $data['image']; ?>" width="150px" height="150px"><br><br>
                                      </td>	 	<td style="border: hidden;" > 
									  <?php

  if( $data['status']=='Active' ){
?>
  &emsp;&emsp;<a class="btn btn-success btn-md" href="special-status.php?pid=<?php echo $id."&"; ?>sid=<?php echo $data['id'].'&Active=Inactive'; ?>" onClick="return confirm('are you sure you want to Inactive this products')">Active</a> 
<?php
     }
     else
     { 
         ?>
 &emsp;&emsp;<a class="btn btn-danger" href="special-status.php?pid=<?php echo $id."&"; ?>sid=<?php echo $data['id'].'&Active=Active';?>" onClick="return confirm('are you sure you want to Active this products')">Inactive</a> 
  <?php
     } ?>
                                    </td>
								
                       </tr>         
            <?php $sr++;
			}                 

?>

                                   
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>

<?php include('includes/footer.php'); ?>