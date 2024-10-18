<?php include('includes/header.php'); ?>
    <style type="text/css">
        .steps{
            display: none;
        }
    </style>

      <main class="main--container">
        <section class="main--content">
            <div class="panel">
                <div class="panel-content">
                    <!-- Form Wizard Start -->
                    <form method="post" class="form--wizard">
                      <!-- action="" method="post" id="formWizard" class="form--wizard" -->
                        <section>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>
                                            <span class="label-text">SELECT CATEGORY: *</span>
                                            <br>
                                            <select name="catid" class="form-control" required>
                                               <option>-----select category-----</option> 
                                                  <?php
                                                  $last=$_GET['$lastid'];
                                                    $sel_query=mysqli_query($conn,"SELECT * FROM `category` WHERE trash = 'No' ");

                                                    while($data=mysqli_fetch_assoc($sel_query))
                                                    {
                                                    ?> 
                                                <option value="<?php echo $data['id']; ?>" selected='<?php echo $last; ?>' > <?php echo $data['cat_name']; ?></option>
                                            <?php } ?>
                                            </select>
                                        </label>
                                    </div>
                                    <br>
                                    <div class="card card-outline-danger p-2" id="div_0">
                    <div class="form-group">
                      <label>
                        <span class="label-text">SUBCATEGORY NAME:</span>
                        <div class="field_wrapper form-group">
                          <div class="input-group">
                            <input type="text" name="sub_cat_name[]" value="<?php if(isset($_POST['sub_cat_name']['0'])){ echo $_POST['sub_cat_name']['0']; }?>" class="form-control" required=""/>

                            </div>
                            <br>

                          </div>  
                        </div>
                        <div class="form-group"><span class="label-text">SELECT CLASS TYPE: *</span>
                          <div class="field_wrapper form-group">
                            <div class="input-group">
                              <select data-maximum-selection-length="3" name="classtype[0][]" id="classtype0" class="js-example-basic-multiple" multiple required><?php $sel_query=mysqli_query($conn,"SELECT * FROM `classtype` WHERE status='Active'"); while($data=mysqli_fetch_assoc($sel_query)){ ?>
                                <option value="<?php echo $data['id']; ?>"> <?php echo $data['name']; ?></option>
                              <?php } ?>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    
                  <!-- Add Color --><div class="row pt-2"> <div class="col-12 text-right"> <a href="javascript:void(0);" class="add_button" title="Add field" onclick="getSubWithClassType();">&emsp;<span class="btn btn-success">ADD</span></a></div>
                  
               
                                
                                        <?php
                                        if(isset($_POST['sub_cat_name']['1']))
                                        {
                                            for($i=1;$i<count($_POST['sub_cat_name']);$i++)
                                            { ?>

                                            <div>
                                                <input type="text" name="sub_cat_name[]" value="<?php if(isset($_POST['sub_cat_name'][$i])){ echo $_POST['sub_cat_name'][$i]; }?>" class="form-control" required=""/>
                                                <a href="javascript:void(0);" class="remove_button">Remove</a><br/>
                                            </div>
                                            <?php
                                            }
                                        }?>
                                        </div>
                                        <script>
  $(document).ready(function() {
   $(".js-example-basic-multiple").select2({
    maximumSelectionLength: 10,
    placeholder: 'Select Class Type'
  });

  });
</script>



<script type="text/javascript">
   function getSubWithClassType()
                                                  {
                                          // Finding total number of elements added
                                          var total_element = $(".card").length;
                                          
  // last <div> with element class id
  var lastid = $(".card:last").attr("id");
  var split_id = lastid.split("_");
  var nextindex = Number(split_id[1]) + 1;

  var max = 10;
  // Check total number elements
  if(total_element < max ){
   // Adding new div container after last occurance of element class
   $(".card:last").after('<div class="card card-outline-danger p-2" id="div_'+nextindex+'"> <span class="text-right clickable close-icon removeColorDiv p-2" id="remove_' + nextindex + '" title="Remove" onclick="remove(this.id);" ><i class="fa fa-times"></i></span><div class="form-group"><label><span class="label-text">SUBCATEGORY NAME:</span><div class="field_wrapper  form-group"><div class="input-group"><input type="text" name="sub_cat_name[]" value="" class="form-control"/><div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field"></div><br></div></div><div class="form-group"><span class="label-text">SELECT CLASS TYPE: *</span><div class="field_wrapper form-group"><div class="input-group"><select data-maximum-selection-length="3" name="classtype['+nextindex+'][]" id="classtype'+nextindex+'" class="js-example-basic-multiple" multiple required><?php $sel_query=mysqli_query($conn,"SELECT * FROM `classtype` WHERE status='Active'"); while($data=mysqli_fetch_assoc($sel_query)){ ?><option value="<?php echo $data['id']; ?>" > <?php echo $data['name']; ?></option><?php } ?></select></div></div></div></div></div>');
   
   // Adding element to <div>
   //$("#div_" + nextindex).append("<input type='text' placeholder='Enter your skill' id='txt_"+ nextindex +"'>&nbsp;<span id='remove_" + nextindex + "' class='remove'>X</span>");
   
 }
 $(".js-example-basic-multiple").select2({
  maximumSelectionLength: 10,
  placeholder: 'Select Class Type'
});
}

function remove(id)
{
  var split_id = id.split("_");
  var deleteindex = split_id[1];

  // Remove <div> with id
  $("#div_" + deleteindex).remove();
}



</script>
                              
                                    <div class="form-group">
                                        <label><button class="btn btn-success btn-md pull-right" name="submit" style="float: left;">Submit</button></label>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </form>
                    <!-- Form Wizard End -->
                    <?php
                    if(isset($_POST['submit']))
                    { 
                        $cat_id=$_POST['catid'];
                        date_default_timezone_set("Asia/kolkata");
                        $date=date("Y-m-d");
                        $time=date("H:i:s");
                        $subname=($_POST['sub_cat_name']);
                        $sub_cat_name1 = count($subname);
                        $subcategoryQuery="";
                        $subcategoryQuery="INSERT INTO `subcategory`(`classtype_id`,`cat_id`, `sub_cat_name`,`date`,`time`) VALUES";
                           $subcategoryQuery1='';
                        for($i=0;$i<$sub_cat_name1;$i++)
                        {
                            $sub_cat_name = addslashes($subname[$i]);
                             $clastypeId=json_encode($_POST['classtype'][$i]);
                            $subcategoryQuery1.="('".$clastypeId."','".$cat_id."','".$sub_cat_name."','".$date."','".$time."'),";
             
                          }
                            $subcategoryQuery.=rtrim($subcategoryQuery1,',');
                            $query=mysqli_query($conn,$subcategoryQuery);
                            // $query=mysqli_query($conn,"INSERT INTO `subcategory`(`cat_id`, `sub_cat_name`,`date`,`time`) VALUES ('$cat_id','$sub_cat_name','$date','$time')");
                            if($query)
                            {
                                echo '<div id="snackbar">Sub-category add successfully..</div>';
                                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');
                                         x.className = 'show';setTimeout(function(){ 
                                          x.className = x.className.replace('show', ''); }, 3000);";
                                echo"var delay = 2000;setTimeout(function(){ window.location = 'view.php'; }, delay);";
                                echo "</script>";
                            }
                            else
                            {
                                echo '<div id="snackbar">Your Sub-Category Not Added..</div>';
                                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                            }
                        
                    } ?>
                </div>
            </div>
        </section>
            <?php include('includes/footer.php'); ?>
           
            <!-- Main Footer End -->
