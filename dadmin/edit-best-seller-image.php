    <?php include('includes/header.php'); 
    $id = $_GET['id'];
	
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
                            <h6 class="h6">Change Best Seller Image <?php echo $id; ?> </h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <div class="panel-content">
                                <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                  
                              
<?php
    $lquery=mysqli_query($conn,"SELECT * FROM `bestsellerimage` WHERE id='1' "); //products select query
    $ldata=mysqli_fetch_array($lquery);

    
?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Best Seller Image <?php echo $id; ?> </span>

                                        <div class="col-md-9">
                              <?php
							   if($id==1){
							   $image =  $ldata['image1'];
							   $link = $ldata['link1'];
							   }
							   if($id==2){
							   $image =  $ldata['image2'];
							     $link = $ldata['link2'];
							   }
							   if($id==3){
							   $image =  $ldata['image3'];
							     $link = $ldata['link3'];
							   }
							   if($id==4){
							   $image =  $ldata['image4'];
							     $link = $ldata['link4'];
							   }
							   
					?>
					                       
                   <img src="image/bestseller/<?php echo $image; ?>" width="200px" height="100px" class="img_reponsive"> 
                   
					            
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Image:</span>
                                        <div class="col-md-9"><input type="file"  name="image"   ></div>
                                    </div>
									
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Sub Category Link:</span>
                                        <div class="col-md-9">
										<select name="link" class="form-control"  required>
										
										<?php
										$bestsellersubcatquery=mysqli_query($conn,"SELECT DISTINCT subcat_id FROM `products` WHERE status='Active' And today_deal='Yes'  ");
										
										$sr = 1;
										while($bestsellersubcatdata = mysqli_fetch_array($bestsellersubcatquery)){
										$subcatquery =	mysqli_query($conn,"SELECT * FROM `subcategory` WHERE id='".$bestsellersubcatdata['subcat_id'] ."'");
										$subcatdata = mysqli_fetch_array($subcatquery);
										$catquery =	mysqli_query($conn,"SELECT * FROM `category` WHERE id='".$subcatdata['cat_id']."'");
										$catdata = mysqli_fetch_array($catquery);										?>
										
										 <option value="<?php  echo $bestsellersubcatdata['subcat_id']; ?>" <?php if($link==$bestsellersubcatdata['subcat_id']){ echo "selected";} ?> ><?php echo $subcatdata['sub_cat_name']." in ".$catdata['cat_name']  ; ?></option>
										<?php
										}
										?>
										</select>
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
      
           
         $image_name=$_FILES["image"]["name"];  
		 if(!empty($image_name)){
			
                                $mul_img = $_FILES["image"]["tmp_name"];
                                
                                   move_uploaded_file($mul_img, "image/bestseller/".$image_name);
                                  
                                    $test = getimagesize('image/bestseller/'.$image_name);
                                    $width = $test[0];
                                    $height = $test[1];

                                    if ($width > 380 || $width < 380 || $height > 200 || $height < 200  )
                                    {
										?>
									<script type="text/javascript">
									alert('Wrong Image Size, eight and Width has to be 300px ');
									</script>
										<?php
                                    //echo '<p style="color:red">Image Dimension is wrong, Height and Width has to be 300px </p>';
                                    unlink('image/bestseller/'.$image_name);

                                    }
									
									else{
										
										 $imagetmpname=$_FILES["image"]["tmp_name"];
         $link = $_POST['link'];
                $i=0;
                if($id==1){
					//unlink("image/bestseller/".$ldata['image1']);
					$iquery=mysqli_query($conn,"UPDATE `bestsellerimage` SET `image1`='$image_name',`link1`='$link' WHERE id='1'");
                        move_uploaded_file($imagetmpname,"image/bestseller/".$image_name);
        
				}
                  if($id==2){
					  // unlink("image/bestseller/".$ldata['image2']);
					   $iquery=mysqli_query($conn,"UPDATE `bestsellerimage` SET `image2`='$image_name',`link2`='$link' WHERE id='1'");
                        move_uploaded_file($imagetmpname,"image/bestseller/".$image_name);
        
				   } 
				   if($id==3){
					   //unlink("image/bestseller/".$ldata['image3']);
					   $iquery=mysqli_query($conn,"UPDATE `bestsellerimage` SET `image3`='$image_name',`link3`='$link' WHERE id='1'");
                        move_uploaded_file($imagetmpname,"image/bestseller/".$image_name);
        
				   } 
				   if($id==4){
					 //  unlink("image/bestseller/".$ldata['image4']);
					   $iquery=mysqli_query($conn,"UPDATE `bestsellerimage` SET `image4`='$image_name',`link4`='$link' WHERE id='1'");
                        move_uploaded_file($imagetmpname,"image/bestseller/".$image_name);
        
				   } 

        if($iquery)
            {

                ?>
                <script type="text/javascript">
                    alert('Image Updated To Website');
                    window.location.href="edit-best-seller-image.php?id=<?php echo $id ; ?>";

                </script>
            <?php }
        else
        {

            echo "not ok";
        }
										
									}
                            
							
		 }
		 else{
			  
			 
		$image_name = $image;
		  $imagetmpname=$_FILES["image"]["tmp_name"];
         $link = $_POST['link'];
                $i=0;
                if($id==1){
					//unlink("image/bestseller/".$ldata['image1']);
					$iquery=mysqli_query($conn,"UPDATE `bestsellerimage` SET `image1`='$image_name',`link1`='$link' WHERE id='1'");
                        move_uploaded_file($imagetmpname,"image/bestseller/".$image_name);
        
				}
                  if($id==2){
					  // unlink("image/bestseller/".$ldata['image2']);
					   $iquery=mysqli_query($conn,"UPDATE `bestsellerimage` SET `image2`='$image_name',`link2`='$link' WHERE id='1'");
                        move_uploaded_file($imagetmpname,"image/bestseller/".$image_name);
        
				   } 
				   if($id==3){
					   //unlink("image/bestseller/".$ldata['image3']);
					   $iquery=mysqli_query($conn,"UPDATE `bestsellerimage` SET `image3`='$image_name',`link3`='$link' WHERE id='1'");
                        move_uploaded_file($imagetmpname,"image/bestseller/".$image_name);
        
				   } 
				   if($id==4){
					 //  unlink("image/bestseller/".$ldata['image4']);
					   $iquery=mysqli_query($conn,"UPDATE `bestsellerimage` SET `image4`='$image_name',`link4`='$link' WHERE id='1'");
                        move_uploaded_file($imagetmpname,"image/bestseller/".$image_name);
        
				   } 

        if($iquery)
            {

                ?>
                <script type="text/javascript">
                    alert('Image Updated To Website');
                    window.location.href="edit-best-seller-image.php?id=<?php echo $id ; ?>";

                </script>
            <?php }
        else
        {

            echo "not ok";
        }
       
    }
	}


?>
            <!-- Main Footer Start -->
 <script type="text/javascript">

                                            //-----Country Ajax code-----

    $(document).ready(function(){

    $('#country').on("change",function () {
        var countryId = $(this).find('option:selected').val();
        $.ajax({
            url: "country-ajax.php",
            type: "POST",
            data: "countryId="+countryId,
            success: function (response) {
               //alert(response);
                //console.log(response);
                $("#state").html(response);
            },
        });
    }); 

});

                                        // ajax code==================================   

$(document).ready(function(){

    $('#state').on("change",function () {
        var stateId = $(this).find('option:selected').val();
        $.ajax({
            url: "state_ajax.php",
            type: "POST",
            data: "stateId="+stateId,
            success: function (response) {
               //alert(response);
                //console.log(response);
                $("#city").html(response);
            },
        });
    }); 

});

            /*---+++++================check box ajax code===========*/

$(document).ready(function(){

    $('#city').on("change",function () {
        var stateId = $(this).find('option:selected').val();
        $.ajax({
            url: "checkbox-ajax.php",
            type: "POST",
            data: "stateId="+stateId,
            success: function (response) {
              // alert(response);
                //console.log(response);
               $("#sell").html(response);
            },
        });
    }); 

});

let amount = document.querySelector('#amount'), preAmount = amount.value;
        amount.addEventListener('input', function(){
            if(isNaN(Number(amount.value))){
                amount.value = preAmount;
                return;
            }

            let numberAfterDecimal = amount.value.split(".")[1];
            if(numberAfterDecimal && numberAfterDecimal.length > 3){
                amount.value = Number(amount.value).toFixed(3);;
            }
            preAmount = amount.value;
        })
                    /* ------ multiple chackbox----------*/
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}

</script> 


            <?php include('includes/footer.php'); ?>
