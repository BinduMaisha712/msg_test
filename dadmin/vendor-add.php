<?php
	 include('includes/header.php'); ?>

                        <!-- Main Container Start -->
                        <main class="main--container">
                            <!-- Main Content Start -->
                            <section class="main--content">                
                                <div class="panel">

                                    <!-- Edit Product Start -->
                                    <div class="records--body">
                                        <div class="title">
                                            <h6 class="h6">VENDOR ADD</h6>
                                        </div>

                                        <!-- Tab Content Start -->
                                        <div class="tab-content">
                                            <!-- Tab Pane Start -->
                                            <div class="tab-pane fade show active" id="tab01">
                                                <div class="panel-content">
                                                <form action="" method="post" enctype="multipart/form-data" name="form">        
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Company Name: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="name" class="form-control" required placeholder="Enter Name.." value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Contact Person Name: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="cpname" class="form-control" required placeholder="Enter Contact Person Name.."  value="<?php if(isset($_POST['cpname'])){ echo $_POST['cpname'];}?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row field_wrapper">
                                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                                        <div class="col-md-7">
                                                            <input type="number" onKeyPress="if(this.value.length>=12) return false;"  name="mobile" class="form-control" placeholder="Enter Mobile No.." required value="<?php if(isset($_POST['mobile'])){ echo $_POST['mobile'];}?>">
                                                        </div>
                                                        <div class="col-md-2 input-group-append">
                                                            <a href="javascript:void(0);" class="add_button" title="Add field">&emsp;<span class="btn btn-success">ADD</span></a>
                                                        </div><br><br>
                                                   
                                                     <?php
                                                        if(isset($_POST['phone']))
                                                        {
                                                            foreach ($_POST['phone'] as $key => $value) { ?>
                                                                <div class="input-group"><div class='col-md-3'></div>
                                                                <div class='col-md-offset-3 col-md-7'><input type='number' onKeyPress='if(this.value.length>=12) return false;'  name='phone[]' value="<?=$value;?>" class='form-control' placeholder='Enter Mobile No..' required></div><a href='javascript:void(0);' class='remove_button1'>Remove</a><br><br></div>
                                                            <?php 
                                                            }
                                                        } ?>
                                                         </div>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = "<div class='input-group'><div class='col-md-3'></div><div class='col-md-offset-3 col-md-9'><input type='number' onKeyPress='if(this.value.length>=12) return false;'  name='phone[]' class='form-control' placeholder='Enter Mobile No..' required><a href='javascript:void(0);' class='remove_button'>Remove</a></div><br><br></div>"; //New input field html 
    var x = 1; //Initial field counter is 1
    
    //Once add button is clicked
    $(addButton).click(function(){
        //Check maximum number of input fields
        if(x < maxField){ 
            x++; //Increment field counter
            $(wrapper).append(fieldHTML); //Add field html
        }
    });
    
    //Once remove button is clicked
    $(wrapper).on('click', '.remove_button', function(e){
        e.preventDefault();
        $(this).parent('div').parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
    $(wrapper).on('click', '.remove_button1', function(e){
        e.preventDefault();
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Email: </span>

                                                        <div class="col-md-9">
                                                            <input type="email" name="email" class="form-control" id="amount" placeholder="Enter Email Id.." value="<?php if(isset($_POST['email'])){ echo $_POST['email'];}?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Country: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="country" class="form-control" required placeholder="Enter Country Name.." value="<?php if(isset($_POST['country'])){ echo $_POST['country'];}?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> City: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="city" class="form-control" required placeholder="Enter City Name.." value="<?php if(isset($_POST['city'])){ echo $_POST['city'];}?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Pin Code: *</span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="pincode" class="form-control" required placeholder="Enter pincode.." minlength="6" maxlength="6" value="<?php if(isset($_POST['pincode'])){ echo $_POST['pincode'];}?>">
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="input_wrap">
                                                        <div class="form-group row">
                                                            <span class="label-text col-md-3 col-form-label">Address: </span>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="address" required><?php if(isset($_POST['address'])){ echo $_POST['address'];}?></textarea>
                                                            </div>
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
                                                   
                                        </div>
                                    </div>
                                            <!-- Tab Pane End -->
                                </div>
                                        <!-- Tab Content End -->
                                    
                            </section>
                <?php
                    if(isset($_POST['submit']))
                    {
                       //print_r($_POST);
                        $name=$_POST['name'];
                        echo $name;
                        $cpname=$_POST['cpname'];
                        $mobile=$_POST['mobile'];
                        $phone='';
                        if(isset($_POST['phone']))
                        {
                            $phone=$_POST['phone'];
                        }
                        $email=$_POST['email'];
                        $country=$_POST['country'];
                        $city=$_POST['city'];
                        $pincode=$_POST['pincode'];
                        $address=$_POST['address'];
                        date_default_timezone_set("Asia/kolkata");
                          $date=date("Y-m-d");
                          $time=date("H:i:s");

                        function randomPassword() {
                    $alphabet = "0123456789";
                    $pass = array(); //remember to declare $pass as an array
                    $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                    for ($i = 0; $i < 5; $i++) {
                        $n = rand(0, $alphaLength);
                        $pass[] = $alphabet[$n];
                    }
                    return implode($pass); //turn the array into a string
                }
                        $pass=split(" ", $name);
                        $passw=$pass[0];
                        $password=$passw.'@'.randomPassword();
                    $sel_query=mysqli_query($conn,"SELECT * FROM `vendor` WHERE mobile='$mobile'");
                    if(mysqli_num_rows($sel_query) > 0)
                    {  
                        echo '<div id="snackbar">Mobile no already used..</div>';
                        echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                    }
                    else{
                        $ins=mysqli_query($conn,"INSERT INTO `vendor`(`name`,`cp_name`, `mobile`, `email`, `country`, `city`, `pincode`, `address`, `password`,`date`,`time`) VALUES ('$name','$cpname','$mobile','$email','$country','$city','$pincode','$address','$password','$date','$time')");
                        $last=mysqli_insert_id($conn);
                        if(!empty($phone[0])){
                            foreach($phone as $key => $value){
                                $mobile_insert=mysqli_query($conn,"INSERT INTO `vendor_mobile`(`vendor_id`, `mobile`) VALUES ('$last','$value')");
                            }
                        }
                        echo '<div id="snackbar">Vendor Add Successfully..</div>';
                        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                        echo"var delay = 1000;setTimeout(function(){ window.location = 'vendor-edit.php?eid=".$last."'; }, delay);";
                        echo "</script>";
                    }
                    
                }
                include('includes/footer.php');

?>