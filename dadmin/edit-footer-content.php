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
                            <h6 class="h6">Change Footer Content</h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <div class="panel-content">
                                <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                  
                              
<?php
    $lquery=mysqli_query($conn,"SELECT * FROM `footercontent` WHERE id='1' "); //products select query
    $ldata=mysqli_fetch_array($lquery);

    
?>
                                   <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Heading 1: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="head1" class="form-control" required value="<?php echo $ldata['head1']; ?>">
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Content 1: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="con1" class="form-control" required value="<?php echo $ldata['con1']; ?>">
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Heading 2: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="head2" class="form-control" required value="<?php echo $ldata['head2']; ?>">
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Content 2: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="con2" class="form-control" required value="<?php echo $ldata['con2']; ?>">
                                        </div>
                                    </div>
									
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Heading 3: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="head3" class="form-control" required value="<?php echo $ldata['head3']; ?>">
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Content 3: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="con3" class="form-control" required value="<?php echo $ldata['con3']; ?>">
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Heading 4: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="head4" class="form-control" required value="<?php echo $ldata['head4']; ?>">
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Content 4: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="con4" class="form-control" required value="<?php echo $ldata['con4']; ?>">
                                        </div>
                                    </div>
									
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Heading 5: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="head5" class="form-control" required value="<?php echo $ldata['head5']; ?>">
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Content 5: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="con5" class="form-control" required value="<?php echo $ldata['con5']; ?>">
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
      

			$head1 = $_POST["head1"]; 
			$con1 = $_POST["con1"]; 
			$head2 = $_POST["head2"]; 
			$con2 = $_POST["con2"];  
			$head3 = $_POST["head3"]; 
			$con3 = $_POST["con3"]; 
			$head4 = $_POST["head4"]; 
			$con4 = $_POST["con4"]; 
			$head5 = $_POST["head5"]; 
			$con5 = $_POST["con5"]; 			
		 
           $i=0;
                
            $iquery=mysqli_query($conn,"UPDATE `footercontent` SET `head1`='$head1',`con1`='$con1',`head2`='$head2',`con2`='$con2',`head3`='$head3',`con3`='$con3',`head4`='$head4',`con4`='$con4',`head5`='$head5',`con5`='$con5' WHERE  id=1");
                     
        if($iquery)
            {

                ?>
                <script type="text/javascript">
                    alert('Content Updated');
                    window.location.href='edit-footer-content.php';

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
