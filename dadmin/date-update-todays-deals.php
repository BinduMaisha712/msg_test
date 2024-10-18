    <?php include('includes/header.php'); 
    
    ?>
<style type="text/css">
    div.ex1 {
  width: 50%;
  height: 100px;
  overflow: auto;
}
</style>
        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                
                <div class="panel">

                    <!-- Edit Product Start -->
                    <div class="records--body">
                        <div class="title">
                            <h6 class="h6">Update Date Duration Of Today's Deal</h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <div class="panel-content">
                                <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                  
                              
<?php
$id = $_GET['id'];
    $lquery=mysqli_query($conn,"SELECT * FROM `today_deal` WHERE pid='$id' "); //products select query
	
    $lnum = mysqli_num_rows($lquery);
	if($lnum>0){
		$ldata=mysqli_fetch_array($lquery);
		echo "From ".$ldata['start']." to ".$ldata['end']."<br><br>";
		
	}
	else{
		echo "Doesn't Set Now";
	}

    
?>
                                   <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Start From: *</span>

                                        <div class="col-md-9">
                                            <input type="date" name="start" class="form-control"  value="<?php echo $ldata['start']; ?>" required>
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">End: *</span>

                                        <div class="col-md-9">
                                            <input type="date" name="end" class="form-control" value="<?php echo $ldata['end']; ?>" required>
                                        </div>
                                    </div>
									
									
                                    <div class="row mt-3">
                                        <div class="col-md-9 offset-md-3">
                                            <button class="btn btn-success" name="submit">Submit</button>

                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                            <!-- Tab Pane End -->
                        </div>
                        <!-- Tab Content End -->
                    </div>
                    <!-- Edit Product End -->
                </div>
            </section>
            <!-- Main Content End -->
<?php
    
    if(isset($_POST['submit']))
    {
		$start=$_POST['start']; 
		$end=$_POST['end']; 
        if($lnum>0){
		$iquery = mysqli_query($conn,"UPDATE `today_deal` SET `start`='$start',`end`='$end' WHERE pid='$id'");
            	
		}
		else{
        $iquery = mysqli_query($conn,"INSERT INTO `today_deal` (`pid`, `start`, `end`) VALUES ('$id','$start','$end')");
		}		
 ?>
                <script type="text/javascript">
                    alert('Duration Updated');
                    window.location.href='view-today-deal-products.php';

                </script>
            <?php 
    }


?>
           
            <?php include('includes/footer.php'); ?>
