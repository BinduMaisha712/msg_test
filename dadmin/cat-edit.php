<?php include('includes/header.php'); ?>
<style type="text/css">
    .steps{
        display: none;
    }
    .select2-container--default.select2-container--focus .select2-selection--multiple {
 
    width: 670px !important;
}
.select2-container .select2-selection--multiple {
    width: 667px !important;
}
</style>
<?php
$eid=$_REQUEST['eid'];
$query=mysqli_query($conn,"SELECT * FROM `category` WHERE id=$eid");
$data=mysqli_fetch_array($query); 
 ?>
<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <div class="panel-content">
                <!-- Form Wizard Start -->
                <form action="" method="post" id="formWizard" class="form--wizard" enctype="multipart/form-data">
                    <h3>Edit category</h3>
                    <section>
                        <div class="row">
                            <div class="col-md-10">

                                <div class="form-group">
                                    <label>
                                        <span class="label-text">CATEGORY NAME: *</span>

                                        <input type="text" name="cat_name"  class="form-control" required value="<?php if(isset($_POST['cat_name'])){ echo $_POST['cat_name'];}else{ echo $data['cat_name']; }?>">
                                    </label>                                    
                                </div>
                              
                                <div class="form-group">
                                    <label>
                                        <span class="label-text">CATEGORY ICON:</span><br/>
                                        <span style="display: -webkit-box;">
                                            <input type="file" name="image" class="form-control" id="image" onchange="check()" value="" style="margin-right: 12px;">
                                            <?php if($data['cat_image']!=''){ ?>
                                                <a href="../asset/image/category/<?=$data['cat_image'];?>" target="_blank">Click to View</a>
                                            <?php } ?>
                                        </span>
                                    </label>
                                    <span class="help-block" id="er">Image Dimensions 200*200 & (png, jpg ,jpeg)</span>
                                    
                                </div>
                                <?php if($data['issubcategory']=='No')
                                {?>
                                    <div class="form-group">
                                      <label>
                                        <span class="label-text">WILL HAVE SUBCATEGORIES: </span>


                                        <div class="col-md-9">

                                           <input type="radio" name="isSubcategory" class="" id="isSubcategory1" value="Yes"  onclick="getSubcategory();">  Yes
                                           <input type="radio" name="isSubcategory" class="" id="isSubcategory2" value="No" checked onclick="getClassType();">  No

                                           <!-- <div id="metaList"></div> -->



                                       </div>
                                   </label>
                               </div>
                               <div class="isCategoryHtmlNo" style="display:block;">
                                   <div class="form-group"><span class="label-text">SELECT CLASS TYPE: *</span>
                                      <div class="field_wrapper form-group">
                                        <div class="input-group">
                                          <select  name="classtype1[]" id="classtype<?=$data['id'];?>" class="js-example-basic-multiple classtypesubCat" multiple required><?php $sel_query=mysqli_query($conn,"SELECT * FROM `classtype` WHERE status='Active'"); while($data2=mysqli_fetch_assoc($sel_query)){ ?><option value="<?php echo $data2['id']; ?>"> <?php echo $data2['name']; ?></option><?php } ?></select>
                                      </div>
                                  </div>
                              </div>
                              <script>
        var classtype<?=$data['id'];?>=<?= $data['classtype_id'];?>;
        
    </script>
                          </div>
                          <div class="isCategoryHtmlYes" style="display:none;">
                             <div class="card card-outline-danger p-2 sub" id="div_0">
                                <div class="form-group">
                                  <label>
                                    <span class="label-text">SUBCATEGORY NAME:</span>
                                    <div class="field_wrapper form-group">
                                      <div class="input-group">
                                        <input type="text" name="sub_cat_name[]" value="<?php if(isset($_POST['sub_cat_name']['0'])){ echo $_POST['sub_cat_name']['0']; }?>" class="form-control"/>
                                        <br>

                                    </div>  
                                </div>
                                <div class="form-group"><span class="label-text">SELECT CLASS TYPE: *</span>
                                  <div class="field_wrapper form-group">
                                    <div class="input-group">
                                      <select  name="classtype[0][]" id="classtype0" class="js-example-basic-multiple classtypesubCat" multiple required><?php $sel_query=mysqli_query($conn,"SELECT * FROM `classtype` WHERE status='Active'"); while($data=mysqli_fetch_assoc($sel_query)){ ?>
                                        <option value="<?php echo $data['id']; ?>"> <?php echo $data['name']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Add Color --><div class="row pt-2"> <div class="col-12 text-right"> <a href="javascript:void(0);" class="add" title="Add" onclick="getSubWithClassType();">&emsp;<span class="btn btn-success">ADD</span></a></div></div>
        </div>
        <?php
    }else
    {?>

        <?php
        $cn=1; $i=0;
        $query1=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE cat_id=$eid");
        if(mysqli_num_rows($query1)>0)
            { ?>

                <?php
                while($data1=mysqli_fetch_array($query1))
                    { ?>
                      <div class="card card-outline-danger p-2 ex_sub mb-2" id="div_<?=$data1['id']?>">
                        <span class="text-right clickable close-icon removeColorDiv p-2" id="remove_<?=$data1['id']?>" title="Remove" onclick="rem('<?=$data1['id'];?>');" ><i class="fa fa-times"></i></span>
                        <div class="form-group">
                          <label>
                            <span class="label-text">SUBCATEGORY NAME:</span>
                            <div class="field_wrapper form-group">
                              <div class="input-group">
                               <input type="text" id="in<?=$data1['id'];?>" name="ex_sub_cat_name[<?=$data1['id'];?>]" value="<?php if(isset($_POST['sub_cat_name'][$i])){ echo $_POST['sub_cat_name'][$i]; }else{ echo $data1['sub_cat_name'];}?>" class="form-control"/>
                               <br>

                           </div>  
                       </div>
                       <div class="form-group"><span class="label-text">SELECT CLASS TYPE: *</span>
                          <div class="field_wrapper form-group">
                            <div class="input-group">
                              <select  name="ex_classtype[<?=$data1['id'];?>][]" id="classtype<?=$data1['id'];?>" class="js-example-basic-multiple classtypesubCat" multiple required><?php $sel_query=mysqli_query($conn,"SELECT * FROM `classtype` WHERE status='Active'"); while($data=mysqli_fetch_assoc($sel_query)){ ?>
                                <option value="<?php echo $data['id']; ?>"> <?php echo $data['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        var classtype<?=$data1['id'];?>=<?= $data1['classtype_id'];?>;
        
    </script>

    <?php
    if($cn==mysqli_num_rows($query1))
        { ?>
            <div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field" onclick="getSubWithClassType();">&emsp;<span class="btn btn-success">ADD</span></a></div>
            <?php
        }
        else{
       // echo'</div>';
        }
        $cn++;
        $i++;
    } 
    ?>
    <br/>



    <?php
}
else{ ?>
 <div class="card card-outline-danger p-2 sub" id="div_0">
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
      <select name="classtype[0][]" id="classtype0"  class="js-example-basic-multiple classtypesubCat" multiple required><?php $sel_query=mysqli_query($conn,"SELECT * FROM `classtype` WHERE status='Active'"); while($data=mysqli_fetch_assoc($sel_query)){ ?>
        <option value="<?php echo $data['id']; ?>"> <?php echo $data['name']; ?></option>
    <?php } ?>
</select>
</div>
</div>
</div>
</div>

<!-- Add Color --><div class="row pt-2"> <div class="col-12 text-right"> <a href="javascript:void(0);" class="add_button" title="Add field" onclick="getSubWithClassType();">&emsp;<span class="btn btn-success">ADD</span></a></div>

<?php
} 
}?>

<label><button class="btn btn-success btn-md" id="sub" name="submit">Update</button></label>
</div>
</div>
</section>
</form>
<!-- Form Wizard End -->

<script type="text/javascript">
  function getSubWithClassType()
  {
 // Finding total number of elements added
 var total_element = $(".sub").length;
 console.log(total_element);
 if(total_element!=0)
 {
  // last <div> with element class id
  var lastid = $(".sub:last").attr("id");
  var split_id = lastid.split("_");
  var nextindex = Number(split_id[1]) + 1;
}
else
{
  var nextindex = 0;

}
var max = 10;
  // Check total number elements
  if(total_element < max ){
   // Adding new div container after last occurance of element class
   $(".card:last").after('<div class="card card-outline-danger p-2 sub" id="div_'+nextindex+'"> <span class="text-right clickable close-icon removeColorDiv p-2" id="remove_' + nextindex + '" title="Remove" onclick="remove(this.id);" ><i class="fa fa-times"></i></span><div class="form-group"><label><span class="label-text">SUBCATEGORY NAME:</span><div class="field_wrapper  form-group"><div class="input-group"><input type="text" name="sub_cat_name[]" value="" class="form-control"/><div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field"></div><br></div></div><div class="form-group"><span class="label-text">SELECT CLASS TYPE: *</span><div class="field_wrapper form-group"><div class="input-group"><select name="classtype['+nextindex+'][]" id="classtype'+nextindex+'"  class="js-example-basic-multiple classtypesubCat" multiple required><?php $sel_query=mysqli_query($conn,"SELECT * FROM `classtype` WHERE status='Active'"); while($data=mysqli_fetch_assoc($sel_query)){ ?><option value="<?php echo $data['id']; ?>" > <?php echo $data['name']; ?></option><?php } ?></select></div></div></div></div></div>');
   
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

function getClassType()
{
    $('.isCategoryHtmlNo').css('display','block');
    $('.isCategoryHtmlYes').css('display','none');
}

function getSubcategory()
{
    $('.isCategoryHtmlYes').css('display','block');
    $('.isCategoryHtmlNo').css('display','none');

}
function rem(val)
{
    var x=confirm('Are you sure to delete this sub category');
    if(x==true)
    {
        $.ajax({
            type: "POST",
            url: "remove_sub.php",
            data:'id='+val,
            success: function(data){
                if(data==1)
                    $("#div_"+val).remove();
                                                                //$("#btn"+val).hide();
                                                            }
                                                        });
    }
}
</script>

<script>
    function check() {
        var fileUpload = $("#image")[0];
        var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(.jpg|.png|.jpeg)$");
        if (regex.test(fileUpload.value.toLowerCase())) 
        {
            if (typeof (fileUpload.files) !== "undefined") 
            {
                                            //Initiate the FileReader object.
                                            var reader = new FileReader();
                                            //Read the contents of Image File.
                                            reader.readAsDataURL(fileUpload.files[0]);
                                            reader.onload = function (e) 
                                            {
                                                //Initiate the JavaScript Image object.
                                                var image = new Image();
                                                //Set the Base64 string return from FileReader as source.
                                                image.src = e.target.result;
                                                image.onload = function () 
                                                {
                                                    //Determine the Height and Width.
                                                    var height = this.height;
                                                    var width = this.width;
                                                    if (height > 200 || width > 200) {
                                                        document.getElementById('er').innerHTML='<font color="red">Height and Width must be 200px.</font>';
                                                        document.getElementById('sub').disabled=true;
                                                    }
                                                    else if (height < 200 || width < 200) {
                                                      document.getElementById('er').innerHTML = '<font color="red">Height and Width must be 200px.</font>';
                                                      document.getElementById('sub').disabled = true;
                                                    }
                                                    else{
                                                        document.getElementById('er').innerHTML='Image Dimensions 200*200';
                                                        document.getElementById('sub').disabled=false;
                                                    }
                                                };
                                            }
                                        } 
                                    }
                                    else {
                                        document.getElementById('er').innerHTML='<font color="red">Please select a valid Image file.</font>';
                                        document.getElementById('sub').disabled=true;
                                    }
                                }
                            </script>

                            <?php
                            if(isset($_POST['submit']))
                            {
                                // echo '<pre>';
                                // print_r($_FILES);
                                // print_r($_POST);
                   //exit();
                                $cat_name=addslashes($_POST['cat_name']);
                                $cat_gst = '';

                                if(($_FILES['image']['name'])!==''){
                                    $file_name = $_FILES['image']['name'];
                                    $file_size =$_FILES['image']['size'];
                                    $file_tmp =$_FILES['image']['tmp_name'];
                                    $file_type=$_FILES['image']['type'];
                                    $file_a = end(explode('.',$_FILES['image']['name']));
                                    $file_ext=strtolower($file_a);

                                    $extensions= array("jpeg","jpg","png");

                                    if(in_array($file_ext,$extensions)=== false){
                                        echo '<div id="snackbar">Extension not allowed, please choose a JPG or JPEG or PNG file...</div>';
                                        echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                                    }
                                    else{
                                        $sel_query=mysqli_query($conn,"SELECT * FROM `category` WHERE  cat_name='$cat_name' AND trash='No' AND id!=$eid");
                                        if(mysqli_num_rows($sel_query)>0)
                                        {
                                       //echo "<script>";
                                         echo '<div id="snackbar">This Category is already added..</div>';
                                         echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                                     }
                                     else{ 
                                        $var=mysqli_fetch_assoc($sel_query);
                                        if(!empty($var['cat_image']))
                                        unlink("../asset/image/category/".$var['cat_image']);
                                        
                                        if(move_uploaded_file($file_tmp,"../asset/image/category/".$file_name))
                                        {

                                            date_default_timezone_set("Asia/kolkata");
                                            $date=date("Y-m-d");
                                            $time=date("H:i:s");
                                            if(!isset($_POST['isSubcategory']))
                                            {
                                                $query=mysqli_query($conn,"UPDATE `category` SET `cat_name`='$cat_name', `cat_image`='$file_name' WHERE id='$eid'")or die(mysqli_error());
                                                if($query)
                                                { 
                                                    date_default_timezone_set("Asia/kolkata");
                                                    $date=date("Y-m-d");
                                                    $time=date("H:i:s");

                                                    if((isset($_POST['sub_cat_name']))&&(!empty($_POST['sub_cat_name']))){
                                                        $subname=$_POST['sub_cat_name'];
                                                        $sub_cat_name1 = sizeof($subname);

                                                        for($i=0;$i<$sub_cat_name1;$i++)
                                                        {
                                                            $sub_cat_name = addslashes($subname[$i]);
                                                            $classtypeId=json_encode($_POST['classtype'][$i]);
                                                            $query1=mysqli_query($conn,"INSERT INTO `subcategory`(`classtype_id`,`cat_id`, `sub_cat_name`,`date`,`time`) VALUES ('$classtypeId','$eid','$sub_cat_name','$date','$time')");
                                                        }
                                                    }

                                                    if((isset($_POST['ex_sub_cat_name']))&&(!empty($_POST['ex_sub_cat_name']))){
                                                        $subname=$_POST['ex_sub_cat_name'];
                                                        foreach($subname as $key => $name)
                                                        {
                                                            $sub_cat_name = addslashes($name);

                                                            $classtypeId=json_encode($_POST['ex_classtype'][$key]);
                                                            $query=mysqli_query($conn,"UPDATE `subcategory` SET `sub_cat_name`='$sub_cat_name',classtype_id='$classtypeId' WHERE id=$key");
                                                        }
                                                    }


                                                    echo '<div id="snackbar">Category Updated...</div>';
                                                    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                                    echo"var delay = 2000;setTimeout(function(){ window.location = 'view.php'; }, delay);";
                                                    echo "</script>";

                                                }
                                                else
                                                {
                                                    echo '<div id="snackbar">Your Category Not Updated..</div>';
                                                    echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                                                }
                                            }
                                            else
                                            {
                                              $isSubcategory=$_POST['isSubcategory'];
                                                if($isSubcategory=='Yes')
                                                {
                                                   $query=mysqli_query($conn,"UPDATE `category` SET `cat_name`='$cat_name',`cat_image`='$file_name',`isSubcategory`= '$isSubcategory' WHERE id='$eid'")or die(mysqli_error());

                                               }
                                               else
                                               {
                                                  $categoryQuery="";

                                                  $classtypeIds=json_encode($_POST['classtype1']);
                                                  $query=mysqli_query($conn,"UPDATE `category` SET `cat_name`='$cat_name',`cat_image`='$file_name',`isSubcategory`= '$isSubcategory',classtype_id='$classtypeIds' WHERE id='$eid'")or die(mysqli_error());


                                              }
                                              if($query)
                                              {
                                                  if($isSubcategory=='Yes')
                                                  {
                                                    $subcategoryQuery="";
                                                    $subcategoryQuery="INSERT INTO `subcategory`(`classtype_id`,`cat_id`, `sub_cat_name`,`date`,`time`) VALUES";

                                                    foreach ($_POST['sub_cat_name'] as $key => $value) 
                                                    {
                                                     $classtypeIds=json_encode($_POST['classtype'][$key]);

                                                     $subcategoryQuery.="('".$classtypeIds."','".$eid."','".$value."','".$date."','".$time."'),";
                                                 }
                                                 $subcategoryQuery=rtrim($subcategoryQuery,',');
                                                 $query1=mysqli_query($conn,$subcategoryQuery);

                                             }

                                             echo '<div id="snackbar">Category Updated...</div>';
                                             echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                      // echo"var delay = 2000;setTimeout(function(){ window.location = 'view.php'; }, delay);";
                                             echo "</script>";

                                         }
                                         else
                                         {
                                            echo '<div id="snackbar">Your Category Not Updated..</div>';
                                            echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                                        }  
                                    }
                                }
                                else{
                                    echo '<div id="snackbar">Image Not Uploaded..</div>';
                                    echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                                }
                            }
                        }
                    }
                    else
                    {  
                        $sel_query=mysqli_query($conn,"SELECT * FROM `category` WHERE cat_name='$cat_name' AND trash='No' AND id!=$eid");
                        if(mysqli_num_rows($sel_query)>0)
                        {
                                       //echo "<script>";
                            echo '<div id="snackbar">This Category is already added..</div>';
                            echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                        }
                        else{ 
                         

                           if(!isset($_POST['isSubcategory']))
                           {
                            $query=mysqli_query($conn,"UPDATE `category` SET `cat_name`='$cat_name'  WHERE id='$eid'")or die(mysqli_error());
                            if($query)
                            { 
                                date_default_timezone_set("Asia/kolkata");
                                $date=date("Y-m-d");
                                $time=date("H:i:s");

                                if((isset($_POST['sub_cat_name']))&&(!empty($_POST['sub_cat_name']))){
                                    $subname=$_POST['sub_cat_name'];
                                    $sub_cat_name1 = sizeof($subname);

                                    for($i=0;$i<$sub_cat_name1;$i++)
                                    {
                                        $sub_cat_name = addslashes($subname[$i]);
                                        $classtypeId=json_encode($_POST['classtype'][$i]);
                                        $query1=mysqli_query($conn,"INSERT INTO `subcategory`(`classtype_id`,`cat_id`, `sub_cat_name`,`date`,`time`) VALUES ('$classtypeId','$eid','$sub_cat_name','$date','$time')");
                                    }
                                }

                                if((isset($_POST['ex_sub_cat_name']))&&(!empty($_POST['ex_sub_cat_name']))){
                                    $subname=$_POST['ex_sub_cat_name'];
                                    foreach($subname as $key => $name)
                                    {
                                        $sub_cat_name = addslashes($name);

                                        $classtypeId=json_encode($_POST['ex_classtype'][$key]);
                                        $query=mysqli_query($conn,"UPDATE `subcategory` SET `sub_cat_name`='$sub_cat_name',classtype_id='$classtypeId' WHERE id=$key");
                                    }
                                }

                                echo '<div id="snackbar">Category Updated...</div>';
                                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                echo"var delay = 2000;setTimeout(function(){ window.location = 'view.php'; }, delay);";
                                echo "</script>";

                            }
                            else
                            {
                                echo '<div id="snackbar">Your Category Not Updated..</div>';
                                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                            }
                        }
                        else
                        {
                                    
                                    date_default_timezone_set("Asia/kolkata");
                                $date=date("Y-m-d");
                                $time=date("H:i:s");
                                $isSubcategory=$_POST['isSubcategory'];
                            if($isSubcategory=='Yes')
                            {
                               $query=mysqli_query($conn,"UPDATE `category` SET `cat_name`='$cat_name', `isSubcategory`= '$isSubcategory' WHERE id='$eid'")or die(mysqli_error());

                           }
                           else
                           {
                              $categoryQuery="";

                              $classtypeIds=json_encode($_POST['classtype1']);
                              $query=mysqli_query($conn,"UPDATE `category` SET `cat_name`='$cat_name',  `isSubcategory`= '$isSubcategory',classtype_id='$classtypeIds' WHERE id='$eid'")or die(mysqli_error());

                              
                          }
                          if($query)
                          {
                              if($isSubcategory=='Yes')
                              {
                                $subcategoryQuery="";
                                $subcategoryQuery="INSERT INTO `subcategory`(`classtype_id`,`cat_id`, `sub_cat_name`,`date`,`time`) VALUES";
                                
                                foreach ($_POST['sub_cat_name'] as $key => $value) 
                                {
                                 $classtypeIds=json_encode($_POST['classtype'][$key]);

                                 $subcategoryQuery.="('".$classtypeIds."','".$eid."','".$value."','".$date."','".$time."'),";
                             }
                             $subcategoryQuery=rtrim($subcategoryQuery,',');
                             $query1=mysqli_query($conn,$subcategoryQuery);
                             
                         }

                         echo '<div id="snackbar">Category Updated...</div>';
                         echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                      echo"var delay = 2000;setTimeout(function(){ window.location = 'view.php'; }, delay);";
                         echo "</script>";

                     }
                     else
                     {
                        echo '<div id="snackbar">Your Category Not Updated..</div>';
                        echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                    }  
                }
            }

        }
    }  ?>
</div>
</div>
</section>
<?php include('includes/footer.php'); ?>
<script>
// $(document).on('keyup keydown change keypress','input[name=cat_gst]',function(){
          
      
//     if (Number($(this).val()) < 0) $(this).val(0);
//     if (Number($(this).val()) > 100) $(this).val(100);
//   });
  
  $(document).on('change','.classtypesubCat',function(){
     var value=($(this).val());
     if(value==null)
     {
         
        $('#'+$(this).attr('id')+' >option').each(function(){
            
               $(this).removeAttr('disabled');  
             
         })
    
     $(".js-example-basic-multiple").select2({
          
            placeholder: 'Select Class Type'
          });
     }
     else
     {
     if(value.length>0)
     {
     if(Number(value[0])==16)
     {
         $('#'+$(this).attr('id')+' >option').each(function(){
             if(Number(this.value)!=Number(value[0]))
             {
               $(this).attr('disabled',true);  
             }
         })
     }
     else if(Number(value[0])!=16)
     {
         $('#'+$(this).attr('id')+' >option').each(function(){
             if(Number(this.value)==16)
             {
              $(this).attr('disabled',true);  
             }
         })
     }
     else
     {
        // alert();
         $('#'+$(this).attr('id')+' >option').each(function(){
            
               $(this).removeAttr('disabled');  
             
         })
     }
     $(".js-example-basic-multiple").select2({
          
            placeholder: 'Select Class Type'
          });
     }
     }
     
  });
  $(document).ready(function() {
     $(".js-example-basic-multiple").select2({
        maximumSelectionLength: 10,
        placeholder: 'Select Class Type'
    });
     $('.js-example-basic-multiple').each(function(){
        var id=eval(this.id);
        $('#'+this.id).select2().val(id).trigger('change')

    //$('#'+this.id).select2('val',id);

});

 });
</script>  