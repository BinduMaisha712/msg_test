    <?php include('includes/header.php'); ?>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">                
                <div class="panel">

                    <!-- Edit Product Start -->
                    <div class="records--body">
                        <div class="title">
                            <h6 class="h6"> DELIVERYMEN Add</h6>
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
                                            <input type="text" name="name" class="form-control" required placeholder="Enter Name.." value="<?php if(isset($_POST['name'])){ echo $_POST['name'];}?>">
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
                                                        var fieldHTML = "<div class='input-group'><div class='col-md-3'></div><div class='col-md-offset-3 col-md-9'><input type='number' onKeyPress='if(this.value.length>=12) return false;'  name='phone[]' class='form-control' placeholder='Enter Mobile No..' required><a href='javascript:void(0);' class='remove_button'>Remove</a></div><br><br></div>";
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
                                <div class="input_wrap">
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Address: </span>
                                        <div class="col-md-9">
                                            <textarea class="form-control" name="address" required><?php if(isset($_POST['address'])){ echo $_POST['address'];}?></textarea>
                                        </div>
                                     </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row mt-3">
                                        <div class="col-md-9 offset-md-3">
                                            <button class="btn btn-success" name="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                if(isset($_POST['submit']))
                                {
                                    //print_r($_POST);
                                    $name=$_POST['name'];
                                    $mobile=$_POST['mobile'];
                                    if(isset($_POST['phone'])) {
                                        $phone=$_POST['phone'];
                                    } else {
                                        $phone='';
                                    }
                                    $email=$_POST['email'];
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
                                $pas=explode(" ", $name);
                                $pas=$pas[0];
                                $password=$pas."@".$password;

                                $sel_query=mysqli_query($conn,"SELECT * FROM `deliverymen` WHERE mobile='$mobile'");
                                if(mysqli_num_rows($sel_query) > 0){ 
                                   echo '<div id="snackbar">This mobile no already exists..</div>';
                                   echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>"; 
                                }else{
                                    $ins=mysqli_query($conn,"INSERT INTO `deliverymen`(`name`, `mobile`, `email`,`password`, `address`,`date`,`time`) VALUES ('$name','$mobile','$email','$password','$address','$date','$time')");
                                    $last=mysqli_insert_id($conn);
                                    if(!empty($phone)) {
                                        foreach($phone as $key => $value)
                                        {
                                            $mobile=mysqli_query($conn,"INSERT INTO `deliverymen_mobile`(`deliverymen_id`, `mobile`) VALUES ('$last','$value')");
                                        }
                                    }
                                    echo '<div id="snackbar">Deliverymen Successfully added...</div>';
                                    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                    echo"var delay = 1000;setTimeout(function(){ window.location = 'delivery-men-details.php?did=".$last."'; }, delay);";
                                    echo "</script>";
                                }
                                
                            }
                            ?>
                            </div>
                            </div>
                            <!-- Tab Pane End -->
                        </div>
                        <!-- Tab Content End -->
                    </div>
                    <!-- Edit Product End -->
                </div>
            </section>




            <?php include('includes/footer.php'); ?>
