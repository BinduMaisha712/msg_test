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
                            <h6 class="h6">Change Bottom Image <?php echo $id; ?> </h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <div class="panel-content">
                                <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                  
                              
<?php
    $lquery=mysqli_query($conn,"SELECT * FROM `footerbottomimage` WHERE id='1' "); //products select query
    $ldata=mysqli_fetch_array($lquery);

    
?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Best Bottom Image <?php echo $id; ?> </span>

                                        <div class="col-md-9">
                              <?php
							   if($id==1){
					?>
					                       
                   <img src="image/bottomimage/<?php echo $ldata['image1']; ?>" width="200px" height="100px" class="img_reponsive"> 
                   
					<?php
        
				}
                   else{
					   ?>
					                          
                   <img src="image/bottomimage/<?php echo $ldata['image2']; ?>" width="200px" height="100px" class="img_reponsive"> 
                   
					   
					<?php
				   } 
							  ?>              
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Image:</span>
                                        <div class="col-md-9"><input type="file"  name="image"   required></div>
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
        $imagetmpname=$_FILES["image"]["tmp_name"];

                $i=0;
                if($id==1){
					unlink("image/bottomimage/".$ldata['image1']);
					$iquery=mysqli_query($conn,"UPDATE `footerbottomimage` SET `image1`='$image_name' WHERE id='1'");
                        move_uploaded_file($imagetmpname,"image/bottomimage/".$image_name);
        
				}
                   else{
					   unlink("image/bottomimage/".$ldata['image2']);
					   $iquery=mysqli_query($conn,"UPDATE `footerbottomimage` SET `image2`='$image_name' WHERE id='1'");
                        move_uploaded_file($imagetmpname,"image/bottomimage/".$image_name);
        
				   } 

        if($iquery)
            {

                ?>
                <script type="text/javascript">
                    alert('Image Updated To Website');
                    window.location.href="edit-bottom-image.php?id=<?php echo $id ; ?>";

                </script>
            <?php }
        else
        {

            echo "not ok";
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
