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
                                            <h6 class="h6">Promo Code ADD</h6>
                                        </div>

                                        <!-- Tab Content Start -->
                                        <div class="tab-content">
                                            <!-- Tab Pane Start -->
                                            <div class="tab-pane fade show active" id="tab01">
                                                <div class="panel-content">
                                                <form action="" method="post" enctype="multipart/form-data" name="form">        
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Code: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="code" id="promocodecheck" class="form-control" required placeholder="Enter Promo Code..">
                                                        <span class="promocodecheck_err"></span>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Title : </span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="title" class="form-control" required placeholder="Enter title..">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Price: </span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="price" class="form-control" placeholder="Enter Price.." required>
                                                        </div>
                                                    </div>
                                                    <!--<div class="form-group row">-->
                                                    <!--    <span class="label-text col-md-3 col-form-label">Type: </span>-->

                                                    <!--    <div class="col-md-9">-->
                                                    <!--        <select name="type" class="form-control" required="">-->
                                                    <!--        	<option value="">--- select promo code type---</option>-->
                                                    <!--        	<option value="individual">Individual</option>-->
                                                    <!--        	<option value="all">All</option>-->
                                                    <!--        </select>-->
                                                    <!--    </div>-->
                                                    <!--</div>-->
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Percentage: *</span>

                                                        <div class="col-md-9">
                                                            <select name="percentage" class="form-control" required="">
                                                            	<option value="">--- select Percentage type---</option>
                                                            	<option value="yes">Yes</option>
                                                            	<option value="no">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Use Quantity: *</span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="quantity" class="form-control" required placeholder="Enter Use Quantity..">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Date Of Expiry: *</span>

                                                        <div class="col-md-9">
                                                            <input type="date" name="doe" class="form-control" required >
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
                        $code=$_POST['code'];
                        $title=$_POST['title'];
                        $price=$_POST['price'];
                        // $type=$_POST['type'];
                        $percentage=$_POST['percentage'];
                        $quantity=$_POST['quantity'];
                        $doe=$_POST['doe'];
                        date_default_timezone_set("Asia/kolkata");
                        $date=date("Y-m-d");
                        $time=date("H:i:s");
                        $sel=mysqli_query($conn,"SELECT * FROM `promo_code` WHERE `code`='$code'");
                        if(mysqli_num_rows($sel) > 0){
                            ?>
                                <script type="text/javascript">
                                   alert("This promo code already exists");
                                    window.location.href="promo-code-add.php";
                                </script> 

                    <?php
                        }else{           
                        $ins=mysqli_query($conn,"INSERT INTO `promo_code`(`code`, `title`, `price`,  `percentage`, `use_quantity`, `date_of_expiry`,`date`,`time`) VALUES ('$code','$title','$price','$percentage','$quantity','$doe','$date','$time')");
                        $last=mysqli_insert_id($conn);
                    }
                       
                    if($ins)
                    { ?>
                                <script type="text/javascript">
                                   alert("Promo Code Add Successfully");
                                    window.location.href="promo-code-details.php?pid=<?php echo $last; ?>";
                                </script> 

                    <?php }
                }
                ?>



                <?php include('includes/footer.php');


?>

 <script type="text/javascript">
     $('#promocodecheck').on('keyup', function(){
         var coupon_code = $(this).val();         
       $.ajax({
        url: "add_promo_code_check.php",
            type: "POST",
            data: { coupon_code:coupon_code },
            dataType: 'json',
            success: function (data) {
               if(data.status == 0){
                   $('.promocodecheck_err').addClass('alert alert-warning').text('This promo code already exists');
                    //setTimeout(function(){ $('.promocodecheck_err').removeClass('alert alert-warning').text(''); }, 3000);
               }else{
                   $('.promocodecheck_err').removeClass('alert alert-warning').text('');
               }
            }
    });
     });
 </script>                                