

<?php
//error_reporting(0);
 $flag=$_REQUEST['flag'];
 switch($flag)
    {
         //---------------------------------------------case 1 start---------------------------------------------
        case 1:          
                            //----------------------------------------Warehouse add coding start-----------------
                         include('includes/header.php'); ?>

                        <!-- Main Container Start -->
                        <main class="main--container">
                            <!-- Main Content Start -->
                            <section class="main--content">                
                                <div class="panel">

                                    <!-- Edit Product Start -->
                                    <div class="records--body">
                                        <div class="title">
                                            <h6 class="h6">WAREHOUSE ADD</h6>
                                        </div>

                                        <!-- Tab Content Start -->
                                        <div class="tab-content">
                                            <!-- Tab Pane Start -->
                                            <div class="tab-pane fade show active" id="tab01">
                                                <div class="panel-content">
                                                <form action="" method="post" enctype="multipart/form-data" name="form">        
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Name: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="name" class="form-control" required placeholder="Enter Name.." value="<?php if(isset($_POST['name'])){ echo $_POST['name']; }?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Contact Person Name : </span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="cpname" class="form-control" required placeholder="Enter Contact Person Name.." value="<?php if(isset($_POST['cpname'])){ echo $_POST['cpname']; }?>">
                                                        </div>
                                                    </div>
                                                   <div class="form-group row field_wrapper">
                                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                                        <div class="col-md-7">
                                                            <input type="number" onKeyPress="if(this.value.length>=12) return false;"  name="mobile" class="form-control" placeholder="Enter Mobile No.." required value="<?php if(isset($_POST['number'])){ echo $_POST['number']; }?>">
                                                        </div>
                                                        <div class="col-md-2 input-group-append">
                                                            <a href="javascript:void(0);" class="add_button" title="Add field">&emsp;<span class="btn btn-success">ADD</span></a>
                                                        </div><br><br>
                                                    </div>
<script type="text/javascript">
$(document).ready(function(){
    var maxField = 10; //Input fields increment limitation
    var addButton = $('.add_button'); //Add button selector
    var wrapper = $('.field_wrapper'); //Input field wrapper
    var fieldHTML = "<div class='col-md-3'></div><div class='col-md-offset-3 col-md-9'><input type='number' onKeyPress='if(this.value.length>=12) return false;'  name='phone[]' class='form-control' placeholder='Enter Mobile No..' required></div><br><br>"; //New input field html 
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
        $(this).parent('div').remove(); //Remove field html
        x--; //Decrement field counter
    });
});
</script>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Email: </span>

                                                        <div class="col-md-9">
                                                            <input type="email" name="email" class="form-control" id="amount" placeholder="Enter Email Id.." required value="<?php if(isset($_POST['email'])){ echo $_POST['email']; }?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Country: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="country" class="form-control" required placeholder="Enter Country Name.." value="<?php if(isset($_POST['country'])){ echo $_POST['country']; }?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> City: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="city" class="form-control" required placeholder="Enter City Name.." value="<?php if(isset($_POST['city'])){ echo $_POST['city']; }?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Pin Code: *</span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="pincode" class="form-control" required placeholder="Enter pincode.." minlength="6" maxlength="6" value="<?php if(isset($_POST['pincode'])){ echo $_POST['pincode']; }?>">
                                                        </div>
                                                    </div>
                                                    <div class="input_wrap">
                                                        <div class="form-group row">
                                                            <span class="label-text col-md-3 col-form-label">Locality : </span>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="locality" required><?php if(isset($_POST['locality'])){ echo $_POST['locality']; }?></textarea>
                                                            </div>
                                                         </div>
                                                    </div>
                                                    <div class="input_wrap">
                                                        <div class="form-group row">
                                                            <span class="label-text col-md-3 col-form-label">Address: </span>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="address" required><?php if(isset($_POST['address'])){ echo $_POST['address']; }?></textarea>
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
                        $name=$_POST['name'];
                        $cpname=$_POST['cpname'];
                        $mobile=$_POST['mobile'];
                        $phone=$_POST['phone'];
                        $email=$_POST['email'];
                        $country=$_POST['country'];
                        $city=$_POST['city'];
                        $pincode=$_POST['pincode'];
                        $locality=$_POST['locality'];
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

                    $password=randomPassword();
                    $pass=split(" ", $name);
                    $passw=$pass[0];
                    $password=$passw.'@'.randomPassword();
                        $sel_query=mysqli_query($conn,"SELECT * FROM `warehouse` WHERE `mobile`='$mobile'");
                        if(mysqli_num_rows($sel_query) > 0){ 
                                   
                             echo '<div id="snackbar">Warehouse Already Added..</div>';
                             echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                            echo "</script>";
                            
                        }else{
                        $ins=mysqli_query($conn,"INSERT INTO `warehouse`(`name`, `cp_name`, `mobile`, `email`, `country`, `city`, `pincode`, `locality`, `address`, `password`,`date`,`time`) VALUES ('$name','$cpname','$mobile','$email','$country','$city','$pincode','$locality','$address','$password','$date','$time')");
                        $last=mysqli_insert_id($conn);
                        foreach($phone as $key => $value){
                            $mobile_query=mysqli_query($conn,"INSERT INTO `warehouse_mobile`(`warehouse_id`, `mobile`) VALUES ('$last','$value')");
                        }
                    }
                       
                    if($ins)
                    { 
                             echo '<div id="snackbar">Warehouse Added Successfully..</div>';
                            echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                echo"var delay = 1000;setTimeout(function(){ window.location = 'warehouse.php?flag=3&wid=".$last."'; }, delay);";
                            echo "</script>";
                        }
                }
                ?>



                <?php include('includes/footer.php');

                            //----------------------------------------Warehouse add coding End-----------------



        break;            
//---------------------------------------------case 1 end-------------------------------------------------------


//---------------------------------------------case 2 start---------------------------------------------------
        case 2:         

                            //----------------------------------------Warehouse show coding start-----------------


                    include ('includes/header.php');
                    ?>
                            <!-- Main Container Start -->
                            <main class="main--container">
                                <!-- Main Content Start -->
                                <section class="main--content">
                                    <div class="panel">
                                        <!-- Records List Start -->
                                        <div class="records--list" data-title="WAREHOUSE VIEWS">
                                            <table id="recordsListView">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No</th>
                                                        <th>Warehouse Name</th>                                                    
                                                        <th>Mobile</th>
                                                       
                                                        <th>Address</th>
                                                        <th>View Warehouse</th>
                                                        
                                                        <th>Add Products</th>
                                                        <th>View Products</th>
                                                      
                                                    </tr>
                                                </thead>
                                                <tbody>
                    <?php
                        $query=mysqli_query($conn,"SELECT * FROM `warehouse` ORDER BY id DESC");
                        $sr=1;
                        while($data=mysqli_fetch_array($query))
                        {
                    ?>
                                                    <tr>
                                                        <td><?php echo $sr ?></td>                            
                                                        <td><?php echo $data['name'];?></td>
                                                        
                                                        <td><?php echo $data['mobile'];?></td>
                                                        
                                                        <td><?php echo $data['address'];?></td>
                                                                                                           
                                                        <td><a class="btn btn-success" href="warehouse.php?flag=3&wid=<?php echo $data['id']; ?>">View</a></td>
                                                        

                                                        <td><a class="btn btn-success" href="warehouse.php?flag=5&pid=<?php echo $data['id']; ?>">Add</a></td>
                                                        <td><a class="btn btn-success" href="warehouse.php?flag=8&pid=<?php echo $data['id']; ?>">View</a></td>
                                                        
                                                    </tr>

                    <?php  $sr++; } ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Records List End -->
                                    </div>
                                </section>
                                <!-- Main Content End -->

                                <!-- Main Footer Start -->
                                <?php include('includes/footer.php'); 
                               
                            //----------------------------------------Warehouse show coding end-----------------

        break;          
 //---------------------------------------------case 2 end--------------------------------------------------

 //---------------------------------------------case 3 start------------------------------------------------
        case 3:         
                     //----------------------------------------Warehouse details coding start-----------------


                    include('includes/header.php'); ?>
                    <?php
                        
                        $wid=$_REQUEST['wid'];
                        $query=mysqli_query($conn,"SELECT * FROM `warehouse` WHERE id=$wid");
                        $data=mysqli_fetch_array($query);
                        
                    ?>
<style type="text/css">
    .header{
    border-top-left-radius: calc(0.25rem - 1px);                    
    border-top-right-radius: calc(0.25rem - 1px);
    border-bottom-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border: 1px solid #725d93;
}
</style>
                     <main class="main--container">
                         <section class="main--content">
                                    <div class="panel">
                                            <!-- Tab Content Start -->
                                            <div class="tab-content">
                                                <!-- Tab Pane Start -->
                                                <div class="header">
                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#first" style="color: #ffa500;">WAREHOUSE DETAILS</button>
                                                </div>
                                                <div class="collapse show" id="first" style="border: 1px solid #725d93;">
                                                    
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table table-bordered table-cells-middle">
                                                      
                                                    <tbody>
                                                        <tr>
                                                            <th>Name</th>
                                                            <td>
                                                               <?php echo $data['name']; ?> 
                                                            </td>
                                                            <th>Contate Parsone Name</th>
                                                            <td>
                                                                <?php  echo $data['cp_name']; ?>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th>Mobile</th>
                                                            <td>
                                                               <?php echo $data['mobile']; ?>
                                                               <?php
                                                                $mobile_query=mysqli_query($conn,"SELECT * FROM `warehouse_mobile` WHERE warehouse_id=$wid");
                                                                while($mobile_data=mysqli_fetch_array($mobile_query))
                                                                        {
                                                                            echo " , ".$mobile_data['mobile']."<br>";
                                                                        }
                                                                ?>
                                                            </td>
                                                            <th>Email</th>
                                                            <td>
                                                               <?php echo $data['email']; ?>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <th>Password</th>
                                                            <td>
                                                                <?php echo $data['password']; ?>
                                                            </td>
                                                                <th>City</th>  
                                                                <td>
                                                                    <?php echo $data['city']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Pin Code</th>
                                                                <td > 
                                                                    <?php echo $data['pincode'] ?>
                                                                </td>
                                                            
                                                                <th>Locality</th> 
                                                                <td><?php echo $data['locality']; ?></td>
                                                            </tr>
                                                            <tr>
                                                                <th>Address</th>
                                                                <td><?php echo $data['address']." , ".$data['country']; ?></td>
                                                            </tr>
                                                               
                                                            </tr>
                                                            
                                                    </tbody>
                                                </table>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="header">
                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#second" style="color: #ffa500;">WAREHOUSE UPDATE</button>
                                                </div>
                                                 <div class="collapse panel-content" id="second" style="border: 1px solid #725d93;"><br>
                                            <form action="" method="post" enctype="multipart/form-data">                                
                                              
                                    <?php
                                        $eid=$_REQUEST['wid']; 
                                        $sel_query=mysqli_query($conn,"select * from warehouse where id=$eid");
                                        $sel_data=mysqli_fetch_array($sel_query);

                                    ?>
                                                 <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Name: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="name" class="form-control" required placeholder="Enter Name.." value="<?php echo $sel_data['name'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Contact Person Name : </span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="cpname" class="form-control" required placeholder="Enter Contact Person Name.." value="<?php echo $sel_data['cp_name'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="mobile" class="form-control" placeholder="Enter Mobile No.." value="<?php echo $sel_data['mobile'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                        $mobile_query1=mysqli_query($conn,"SELECT * FROM `warehouse_mobile` WHERE warehouse_id=$eid");
                                                        if(mysqli_num_rows($mobile_query1) > 0)
                                                        {
                                                            while($mobile_data1=mysqli_fetch_array($mobile_query1)){
                                                         ?>
                                                             <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                                        <div class="col-md-9">
                                                            <input type="hidden" name="phoneid[]" value="<?php echo $mobile_data1['id']; ?>">
                                                            <input type="number" name="phone[]" class="form-control" placeholder="Enter Mobile No.." value="<?php echo $mobile_data1['mobile']; ?>" required>
                                                        </div>
                                                    </div>
                                                       <?php  } } 

                                                     ?>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Email: </span>

                                                        <div class="col-md-9">
                                                            <input type="email" name="email" required class="form-control" id="amount" value="<?php echo $sel_data['email'] ?>" placeholder="Enter Email Id..">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Country: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="country" class="form-control" required placeholder="Enter Country Name.." value="<?php echo $sel_data['country'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> City: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="city" class="form-control" required placeholder="Enter City Name.." value="<?php echo $sel_data['city'] ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Pin Code: *</span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="pincode" class="form-control" required placeholder="Enter pincode.." value="<?php echo $sel_data['pincode'] ?>" >
                                                        </div>
                                                    </div>
                                                        <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Password : *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="password" class="form-control" required placeholder="Enter password.." value="<?php echo $sel_data['password'] ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="input_wrap">
                                                        <div class="form-group row">
                                                            <span class="label-text col-md-3 col-form-label">Locality : </span>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="locality" required><?php echo $sel_data['locality']; ?></textarea>
                                                            </div>
                                                         </div>
                                                    </div>
                                                    <div class="input_wrap">
                                                        <div class="form-group row">
                                                            <span class="label-text col-md-3 col-form-label">Address: </span>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="address" required><?php echo $sel_data['address']; ?></textarea>
                                                            </div>
                                                         </div>
                                                    </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-9 offset-md-3">
                                                        <button class="btn btn-success" name="update">update</button>

                                                    </div>
                                                </div>
                                            </form><br>
               
                                        </div>

                                            </div>
                                        </div>
                                </section>
                                 <?php
                
                if(isset($_POST['update']))
                {
                     print_r($_POST);
                     $phone=''; $phoneid='';
                        $name=$_POST['name'];
                        $cpname=$_POST['cpname'];
                        $mobile=$_POST['mobile'];
                        if(isset($_POST['phone']))
                        {
                            $phone=$_POST['phone'];
                            $phoneid=$_POST['phoneid'];
                        }
                        $email=$_POST['email'];
                        $country=$_POST['country'];
                        $city=$_POST['city'];
                        $pincode=$_POST['pincode'];
                        $locality=$_POST['locality'];
                        $address=$_POST['address'];
                        $password=$_POST['password'];
                        $query=mysqli_query($conn,"UPDATE `warehouse` SET `name`='$name',`cp_name`='$cpname',`mobile`='$mobile',`email`='$email',`country`='$country',`city`='$city',`pincode`=$pincode,`locality`='$locality',`address`='$address',`password`='$password' WHERE id=$eid");
                        
                         if(isset($_POST['phone']))
                        {
                            foreach(array_combine($phone, $phoneid) as $phone => $phoneid )
                            {
                                
                                $mobile_update=mysqli_query($conn,"UPDATE `warehouse_mobile` SET mobile='$phone' WHERE warehouse_id=$phoneid");
                            }
                        }
                       if($query)
                        {
                                 echo '<div id="snackbar">Warehouse Successfully Updated....</div>';
                                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                echo"var delay = 1000;setTimeout(function(){ window.location = 'warehouse.php?flag=3&wid=".$eid."'; }, delay);";
                                echo "</script>";
                           }
                    else
                    {

                        echo "not ok";
                    }
                }


                ?>
                    <?php include('includes/footer.php'); 
                     //----------------------------------------Warehouse details coding end-----------------

        break;          

 //---------------------------------------------case 3 end-----------------------------------------------


    //---------------------------------------------case 4 start-----------------------------------------------

        case 4:
                    //----------------------------------------Warehouse update coding start-----------------


                 include('includes/header.php'); 
                 $eid=$_REQUEST['eid']; ?>

                    <!-- Main Container Start -->
                    <main class="main--container">

                        <!-- Main Content Start -->
                        <section class="main--content">
                            
                            <div class="panel">

                                <!-- Edit Product Start -->
                                <div class="records--body">
                                    <div class="title">
                                        <h6 class="h6">WAREHOUSE UPDATE DETAILS</h6>
                                    </div>

                                    <!-- Tab Content Start -->
                                    <div class="tab-content">
                                        <!-- Tab Pane Start -->
                                        <div class="tab-pane fade show active" id="tab01">
                                            <form action="" method="post" enctype="multipart/form-data">                                
                                              
                                    <?php
                                        $sel_query=mysqli_query($conn,"select * from warehouse where id=$eid");
                                        $sel_data=mysqli_fetch_array($sel_query);

                                    ?>
                                                 <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Name: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="name" class="form-control" required placeholder="Enter Name.." value="<?php echo $sel_data['name'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Contact Person Name : </span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="cpname" class="form-control" required placeholder="Enter Contact Person Name.." value="<?php echo $sel_data['cp_name'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="mobile" class="form-control" placeholder="Enter Mobile No.." value="<?php echo $sel_data['mobile'] ?>" required>
                                                        </div>
                                                    </div>
                                                    <?php 
                                                        $mobile_query1=mysqli_query($conn,"SELECT * FROM `warehouse_mobile` WHERE warehouse_id=$eid");
                                                        if(mysqli_num_rows($mobile_query1) > 0)
                                                        {
                                                            while($mobile_data1=mysqli_fetch_array($mobile_query1)){
                                                         ?>
                                                             <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                                        <div class="col-md-9">
                                                            <input type="hidden" name="phoneid[]" value="<?php echo $mobile_data1['id']; ?>">
                                                            <input type="number" name="phone[]" class="form-control" placeholder="Enter Mobile No.." value="<?php echo $mobile_data1['mobile']; ?>" required>
                                                        </div>
                                                    </div>
                                                       <?php  } } 

                                                     ?>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Email: </span>

                                                        <div class="col-md-9">
                                                            <input type="email" name="email" required class="form-control" id="amount" value="<?php echo $sel_data['email'] ?>" placeholder="Enter Email Id..">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Country: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="country" class="form-control" required placeholder="Enter Country Name.." value="<?php echo $sel_data['country'] ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> City: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="city" class="form-control" required placeholder="Enter City Name.." value="<?php echo $sel_data['city'] ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Pin Code: *</span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="pincode" class="form-control" required placeholder="Enter pincode.." value="<?php echo $sel_data['pincode'] ?>" >
                                                        </div>
                                                    </div>
                                                        <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Password : *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="password" class="form-control" required placeholder="Enter password.." value="<?php echo $sel_data['password'] ?>" >
                                                        </div>
                                                    </div>
                                                    <div class="input_wrap">
                                                        <div class="form-group row">
                                                            <span class="label-text col-md-3 col-form-label">Locality : </span>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="locality" required><?php echo $sel_data['locality']; ?></textarea>
                                                            </div>
                                                         </div>
                                                    </div>
                                                    <div class="input_wrap">
                                                        <div class="form-group row">
                                                            <span class="label-text col-md-3 col-form-label">Address: </span>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" name="address" required><?php echo $sel_data['address']; ?></textarea>
                                                            </div>
                                                         </div>
                                                    </div>
                                                <div class="row mt-3">
                                                    <div class="col-md-9 offset-md-3">
                                                        <button class="btn btn-success" name="update">update</button>

                                                    </div>
                                                </div>
                                            </form>
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
                
                if(isset($_POST['update']))
                {
                    
                        $name=$_POST['name'];
                        $cpname=$_POST['cpname'];
                        $mobile=$_POST['mobile'];
                        $phone=$_POST['phone'];
                        $phoneid=$_POST['phoneid'];
                        $email=$_POST['email'];
                        $country=$_POST['country'];
                        $city=$_POST['city'];
                        $pincode=$_POST['pincode'];
                        $locality=$_POST['locality'];
                        $address=$_POST['address'];
                        $password=$_POST['password'];
                        $query=mysqli_query($conn,"UPDATE `warehouse` SET `name`='$name',`cp_name`='$cpname',`mobile`='$mobile',`email`='$email',`country`='$country',`city`='$city',`pincode`=$pincode,`locality`='$locality',`address`='$address',`password`='$password' WHERE id=$eid");
                        foreach(array_combine($phone, $phoneid) as $phone => $phoneid )
                        {
                            
                            $mobile_update=mysqli_query($conn,"UPDATE `warehouse_mobile` SET mobile='$phone' WHERE warehouse_id=$phoneid");
                        }
                       if($query)
                        {
                             echo '<div id="snackbar">Warehouse Successfully Updated....</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo"var delay = 1000;setTimeout(function(){ window.location = 'warehouse.php?flag=3&wid=".$eid."'; }, delay);";
        echo "</script>";

                           }
                    else
                    {

                        echo "not ok";
                    }
                }


                ?>
                       
                        <?php include('includes/footer.php'); 
                    //----------------------------------------Warehouse update coding end-----------------



        break;

         //---------------------------------------------case 4 end-----------------------------------------------


    //---------------------------------------------case 5 start-----------------------------------------------
        case 5:
                            //--------------------------------Warehouse products add coding start-----------------

                        include('includes/header.php');
                        $pid=$_REQUEST['pid'];
                         ?>

                        <!-- Main Container Start -->
                        <main class="main--container">
                            <!-- Main Content Start -->
                            <section class="main--content">                
                                <div class="panel">

                                    <!-- Edit Product Start -->
                                    <div class="records--body">
                                        <div class="title">
                                            <h6 class="h6"> Add Warehouse Product Stock</h6>
                                        </div>

                                        <!-- Tab Content Start -->
                                        <div class="tab-content">
                                            <!-- Tab Pane Start -->
                                            <div class="tab-pane fade show active" id="tab01">
                                    <div class="panel-content">
                                                <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Select Category: *</span>

                                                        <div class="col-md-9">
                                                            <select name="category" id="category" class="form-control" required>
                                                                   <option value="">-----select category-----</option> 
                                                                      <?php
                                                                        $sel_query=mysqli_query($conn,"SELECT * FROM `category`");

                                                                        while($data=mysqli_fetch_assoc($sel_query))
                                                                        {
                                                                        ?> 
                                                                    <option value="<?php echo $data['id']; ?>" > <?php echo $data['cat_name']; ?></option>
                                                                <?php } ?>
                                                                </select>
                                                        </div>
                                                    </div>
                                                           <div class="form-group row" id="subcategory">
                                                        <!-- <span class="label-text col-md-3 col-form-label">Select Sub-Category: *</span>

                                                        <div class="col-md-9">
                                                            <select name="subcategory" id="subcategory" class="form-control" required>
                                                               <option value="" selected>----select subcategory-----</option>       
                                                                </select>
                                                        </div> -->
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Product Name: *</span>

                                                        <div class="col-md-9">
                                                             <select name="product" id="product" class="form-control" required>
                                                               <option value="" selected>----select product-----</option>       
                                                                </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Stock : *</span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="stock" id="stock" onChange="stockcheck();" class="form-control"  required placeholder="Enter stock ....."><br>
                                                        <div id="tblstock"></div>
                                                        </div>
                                                    </div>
                                              
                                                    <div class="row mt-3">
                                                        <div class="col-md-9 offset-md-3">
                                                            <button class="btn btn-success" name="submit" id="submit">Submit</button>
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
                       $category=$_POST['category'];
                       $subcategory=$_POST['subcategory'];
                       $product=$_POST['product'];
                       $stock=$_POST['stock'];
                       date_default_timezone_set("Asia/kolkata");
                       $date=date("Y-m-d");
                       $time=date("H:i:s");
                       $sel_wer=mysqli_query($conn,"SELECT * FROM `warehouse_stock` WHERE `c_id`='$category' AND `s_id`='$subcategory' AND `p_id`='$product' AND `warehouse_id`='$_GET[pid]'");
                       if(mysqli_num_rows($sel_wer) > 0){
                        $w_id=mysqli_fetch_array($sel_wer);
                        $wids=$w_id['id'];
                            $query=mysqli_query($conn,"UPDATE `warehouse_stock` SET `warehouse_id`='$pid',`c_id`=$category,`s_id`='$subcategory',`p_id`='$product',`stock_no`='$stock' WHERE id='$wids'");
                       }else{

                           $query=mysqli_query($conn,"INSERT INTO `warehouse_stock`(`warehouse_id`, `c_id`, `s_id`, `p_id`, `stock_no`,`date`,`time`) VALUES ('$pid','$category','$subcategory','$product','$stock','$date','$time')");
                           $last=mysqli_insert_id($conn);
                       }


                       if($query){
                         echo '<div id="snackbar">Added successfully..</div>';
                        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                         echo"var delay = 1000;setTimeout(function(){ window.location = 'warehouse.php?flag=8&pid=".$pid."'; }, delay);";
                        echo "</script>";
                       
                       }
                    }

                ?>
                            <!-- Main Footer Start -->

                            <!--         ==== Ajax code  ===        -->
                <script type="text/javascript">
                    $(document).ready(function(){

                        $('#category').on("change",function () {
                            var categoryId = $(this).find('option:selected').val();
                            $.ajax({
                                url: "ajax.php",
                                type: "POST",
                                data: "categoryId="+categoryId,
                                success: function (response) {
                                   //alert(response);
                                    //console.log(response);
                                    $("#subcategory").html(response);
                                    if(response=='')
                                    {
                                        $.ajax({
                                            url: "warehouse.php?flag=6",
                                            type: "POST",
                                            data: "cat="+categoryId,
                                            success: function (response) {
                                                //alert(response);
                                                //console.log(response);
                                                $("#product").html(response);
                                            },
                                        });
                                    }
                                },
                            });
                        }); 

                    });

                    $(document).ready(function(){

                        $('#subcategory').on("change",function () {
                            var subcategory = $(this).find('option:selected').val();
                            $.ajax({
                                url: "warehouse.php?flag=6",
                                type: "POST",
                                data: "subcategory="+subcategory,
                                success: function (response) {
                                    //alert(response);
                                    //console.log(response);
                                    $("#product").html(response);
                                },
                            });
                        }); 

                    });
                      $(document).ready(function(){

                        // $('#product').on("change",function () {
                        //     var stock = $(this).find('option:selected').val();
                        //     $.ajax({
                        //         url: "warehouse.php?flag=7",
                        //         type: "POST",
                        //         data: "stock="+stock,
                        //         success: function (response) {
                        //             //alert(response);
                        //             //console.log(response);
                        //             $("#tblstock").html(response);
                        //         },
                        //     });
                        // }); 

                    });

                
                </script>
                <script type="text/javascript">
                function stockcheck() {
                                        var stock = $("#stock").val();
                                        var stock_no = $("#stock_no").val();
                                      
                                        a = parseInt(stock); 
                                        //b = parseInt(stock_no); 
                                        //alert(a);
                                        //alert(stock_no);

                                        if (a > stock_no)
                                            { 
                                                $("#stock").css("border-color", "red");
                                                $("#submit").attr("disabled", true);
                                                return false;
                                            }else{
                                                $("#stock").css("border-color", "green");
                                                $("#submit").attr("disabled", false);
                                            }
                                          
                                    }

                                    $(document).ready(function () {
                                        $("#stock").keyup(stockcheck);
                                        
                                    });

                                   


    </script>

                <?php include('includes/footer.php');

                            //----------------------------Warehouse products add coding end-----------------

        break;

     //---------------------------------------------case 5 end-----------------------------------------------


     //---------------------------------------------case 6 start-----------------------------------------------
        case 6:
                    //-----------------------------------Warehouse ajax products coding start-----------------

                 
                    include('config/connection.php');
                    if(isset($_POST['subcategory']))
                    {
                        $subcategory = $_POST['subcategory'];

                        $query=mysqli_query($conn,"SELECT distinct(product_code) FROM `products` WHERE subcat_id = $subcategory order by id asc"); 
                        if(mysqli_num_rows($query)>0)
                        {
                            echo "<option value='1'>----select Product----</option>";
                            while($gt=mysqli_fetch_array($query))
                            {
                                // echo $gt['product_code']."<br/>";
                                $sqqq=mysqli_query($conn,"select * from products where product_code='".$gt['product_code']."'");
                                $data=mysqli_fetch_array($sqqq);

                                echo "<option value='".$data['product_code']."'>" .$data['product_name']."</option>";
                            }
                        }
                    }
                    if(isset($_POST['cat']))
                    {
                        $subcategory = $_POST['cat'];
                        $query=mysqli_query($conn,"SELECT distinct(product_code) FROM `products` WHERE cat_id = $subcategory order by id asc"); 
                        echo "<option value=''>----select Product----</option>";

                        while($gt=mysqli_fetch_array($query))
                        {
                            $qqq=mysqli_query($conn,"select * from products where product_code='".$gt['product_code']."'");
                            $data=mysqli_fetch_array($qqq);
                           // echo $gt['product_code']."<br/>";
                            echo "<option value='".$data['product_code']."'>" .$data['product_name']."</option>";
                        }
                    }
                    //-----------------------------------Warehouse ajax products coding end-----------------


        break;
     //---------------------------------------------case 6 end-----------------------------------------------

    //---------------------------------------------case 7 start-----------------------------------------------
        case 7:
                    //-----------------------------------Warehouse ajax stock coding start-----------------

                 
                    include('config/connection.php');
                    $stock = $_POST['stock'];

                    $query=mysqli_query($conn,"SELECT * FROM `stock` WHERE p_id = $stock"); 

                        $data=mysqli_fetch_array($query);
                        $stock=$data['stock_no'];
                        
                        ?>
                            <div style="color: red;">Maximum Stock Quantity <?php echo $data['stock_no']; ?></div>
                            <input type="hidden" name="stock_no" id="stock_no" value="<?php echo $data['stock_no']; ?>">
                        <?php

                       
                    //-----------------------------------Warehouse ajax stock coding start-----------------

        break;
     //---------------------------------------------case 7 end-----------------------------------------------

     //---------------------------------------------case 8 start-----------------------------------------------

        case 8:
                    //-----------------------------------Warehouse products view coding start-----------------

                    include ('includes/header.php');
                    ?>
                            <!-- Main Container Start -->
                            <main class="main--container">
                                <!-- Main Content Start -->
                                <section class="main--content">
                                    <div class="panel">
                                        <!-- Records List Start -->
                                        <div class="records--list" data-title="WAREHOUSE PRODUCTS VIEWS">
                                            <table id="recordsListView">
                                                <thead>
                                                    <tr>
                                                        <th>Sr.No</th>
                                                        <th>Products Name</th>                                                    
                                                        <th>Category</th>
                                                       
                                                        <th>SubCategory</th>
                                                        <th>Stock</th>
                                                        <th>Edit Stock</th>
                                                        <th>Datetime</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                    <?php
                        $pid=$_REQUEST['pid'];
                        $query=mysqli_query($conn,"SELECT * FROM `warehouse_stock` WHERE warehouse_id=$pid ORDER BY id DESC");
                        $sr=1;
                        while($data=mysqli_fetch_array($query))
                        {
                            $p_id=$data['p_id'];
                            $c_id=$data['c_id'];
                            $s_id=$data['s_id'];
                            $p_sel=mysqli_query($conn,"SELECT * FROM `Products` WHERE product_code=$p_id");
                            $p_data=mysqli_fetch_array($p_sel);
                            $c_sel=mysqli_query($conn,"SELECT * FROM `category` WHERE id=$c_id");
                            $c_data=mysqli_fetch_array($c_sel);
                            $s_sel=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE id=$s_id");
                            $s_data=mysqli_fetch_array($s_sel);
                    ?>
                                                    <tr>
                                                        <td><?php echo $sr; ?></td>                            
                                                        <td><?php echo $p_data['product_name'];?></td>
                                                        
                                                        <td><?php echo $c_data['cat_name'];?></td>
                                                        
                                                        <td><?php echo $s_data['sub_cat_name'];?></td>
                                                                                                           
                                                        <td><?php  echo $data['stock_no'] ?></td>
                                                        <td><a class="btn btn-success" href="warehouse.php?flag=9&stockid=<?php echo $data['id']; ?>&pid=<?php echo $pid; ?>">Edit</a></td>

                                                        <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></a></td>
                                                        
                                                        
                                                    </tr>

                    <?php  $sr++; } ?>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- Records List End -->
                                    </div>
                                </section>
                                <!-- Main Content End -->

                                <!-- Main Footer Start -->
                                <?php include('includes/footer.php');

                    //-----------------------------------Warehouse products view coding end-----------------

        break;
     //---------------------------------------------case 8 end-----------------------------------------------


     //---------------------------------------------case 9 start-----------------------------------------------

        case 9:

            //-----------------------------------Warehouse products stock update coding start-----------------

                    include('includes/header.php');
                        $stockid=$_REQUEST['stockid'];
                        $pid=$_REQUEST['pid'];
                        $query=mysqli_query($conn,"SELECT * FROM `warehouse_stock` WHERE id=$stockid");
                        $data=mysqli_fetch_array($query);
                        
                            $p_id=$data['p_id'];
                            $c_id=$data['c_id'];
                            $s_id=$data['s_id'];
                            $p_sel=mysqli_query($conn,"SELECT * FROM `Products` WHERE product_code=$p_id");
                            $p_data=mysqli_fetch_array($p_sel);

                            $stock_sel=mysqli_query($conn,"SELECT * FROM `stock` WHERE `p_id`=$p_id");
                            $stock_data=mysqli_fetch_array($stock_sel);
                            $c_sel=mysqli_query($conn,"SELECT * FROM `category` WHERE id=$c_id");
                            $c_data=mysqli_fetch_array($c_sel);
                            $s_sel=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE id=$s_id");
                            $s_data=mysqli_fetch_array($s_sel);
                         ?>

                        <!-- Main Container Start -->
                        <main class="main--container">
                            <!-- Main Content Start -->
                            <section class="main--content">                
                                <div class="panel">

                                    <!-- Edit Product Start -->
                                    <div class="records--body">
                                        <div class="title">
                                            <h6 class="h6"> Warehouse Product Stock Update</h6>
                                        </div>

                                        <!-- Tab Content Start -->
                                        <div class="tab-content">
                                            <!-- Tab Pane Start -->
                                            <div class="tab-pane fade show active" id="tab01">
                                    <div class="panel-content">
                                                <form action="" method="post" enctype="multipart/form-data" name="form">     
                                                <input type="hidden" name="" id="stock_no" value="<?php echo $stock_data['stock_no'] ?>">    
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Category: *</span>

                                                        <div class="col-md-9">
                                                           <input type="text" name="" class="form-control" readonly="" value="<?php echo $c_data['cat_name'];?>">
                                                        </div>
                                                    </div>
                                                           <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Sub-Category: *</span>

                                                        <div class="col-md-9">
                                                          <input type="text" name="" class="form-control" readonly value="<?php echo $s_data['sub_cat_name'];?>">
                                                        </div>
                                                    </div>
                                                    
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Product Name: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="" class="form-control" readonly value="<?php echo $p_data['product_name'];?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Stock : *</span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="stock" id="stock"  class="form-control"  required placeholder="Enter stock ....." value="<?php echo $data['stock_no']; ?>"><br>
                                                        <!-- <div id="tblstock" style="display: none;">maximum Stock <?php echo  $stock_data['stock_no']; ?></div> -->
                                                        </div>
                                                    </div>
                                              
                                                    <div class="row mt-3">
                                                        <div class="col-md-9 offset-md-3">
                                                            <button class="btn btn-success" name="submit" id="submit">Submit</button>
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
                             <!--         ==== Ajax code  ===        -->
                
                <script type="text/javascript">
                function stockcheck() {
                    var stock = $("#stock").val();
                    var stock_no = $("#stock_no").val();
                    a = parseInt(stock);
                    if (a > stock_no)
                        { 
                            $("#stock").css("border-color", "red");
                            $("#tblstock").css("display", "block");
                            $("#tblstock").css("color", "red");
                            $("#submit").attr("disabled", true);
                            return false;
                        }else{
                            $("#stock").css("border-color", "green");
                            $("#submit").attr("disabled", false);
                        }
                      
                }

                $(document).ready(function () {
                   // $("#stock").keyup(stockcheck);
                    
                });

                    </script>
                <?php
                    
                    if(isset($_POST['submit']))
                    {
                       
                       $stock=$_POST['stock'];
                       $update=mysqli_query($conn,"UPDATE `warehouse_stock` SET `stock_no`='$stock' WHERE id=$stockid");
                       if($update){
                         echo '<div id="snackbar">Product Stock Successfully Updated...</div>';
                        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                        echo"var delay = 1000;setTimeout(function(){ window.location = 'warehouse.php?flag=8&pid=".$pid."'; }, delay);";
                        echo "</script>";
                       
                       }
                    }

                ?>
                            <!-- Main Footer Start -->

                           

                <?php include('includes/footer.php');

                    //-----------------------------------Warehouse products update coding end-----------------



        break;
     //---------------------------------------------case 9 end-----------------------------------------------


    }   //-----------------------------switch case end---------------------------------------------
?>

    
