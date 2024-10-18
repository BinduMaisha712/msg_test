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
                                            <h6 class="h6">Promo Code Edit</h6>
                                        </div>

                                        <!-- Tab Content Start -->
                                        <div class="tab-content">
                                            <!-- Tab Pane Start -->
                                            <div class="tab-pane fade show active" id="tab01">
                                                <div class="panel-content">
                                                <?php
                                                $eid=$_REQUEST['eid'];
                                                    $sel_query=mysqli_query($conn,"SELECT * FROM `promo_code` WHERE `id`=$eid");
                                                    $data=mysqli_fetch_array($sel_query);

                                                ?>
                                                <form action="" method="post" enctype="multipart/form-data" name="form">        
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Code: *</span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="code" class="form-control" required placeholder="Enter Promo Code.." value="<?php echo $data['code']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Title : </span>

                                                        <div class="col-md-9">
                                                            <input type="text" name="title" class="form-control" required placeholder="Enter title.." value="<?php echo $data['title']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Price: </span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="price" class="form-control" placeholder="Enter Price.." required value="<?php echo $data['price']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label">Type: </span>

                                                        <div class="col-md-9">
                                                            <select name="type" class="form-control" required="">
                                                            	<option value="">--- select promo code type---</option>
                                                            	<option value="individual" <?php if($data['type']=="individual"){ echo "selected"; } ?>>Individual</option>
                                                            	<option value="all" <?php if($data['type']=="all"){ echo "selected"; } ?> >All</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Percentage: *</span>

                                                        <div class="col-md-9">
                                                            <select name="percentage" class="form-control" required="">
                                                            	<option value="">--- select Percentage type---</option>
                                                            	<option value="yes" <?php if($data['percentage']=="yes"){ echo "selected"; } ?> >Yes</option>
                                                            	<option value="no" <?php if($data['percentage']=="no"){ echo "selected"; } ?> >No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Use Quantity: *</span>

                                                        <div class="col-md-9">
                                                            <input type="number" name="quantity" class="form-control" required placeholder="Enter Use Quantity.." value="<?php echo $data['use_quantity']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <span class="label-text col-md-3 col-form-label"> Date Of Expiry: *</span>

                                                        <div class="col-md-9">
                                                            <input type="date" name="doe" class="form-control" required value="<?php echo $data['date_of_expiry']; ?>">
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
                        $code=$_POST['code'];
                        $title=$_POST['title'];
                        $price=$_POST['price'];
                        $type=$_POST['type'];
                        $percentage=$_POST['percentage'];
                        $quantity=$_POST['quantity'];
                        $doe=$_POST['doe'];
                                   
                        $sel=mysqli_query($conn,"SELECT * FROM `promo_code` WHERE `code`='$code' AND id!=$eid");
                        if(mysqli_num_rows($sel) > 0){
                            ?>
                                <script type="text/javascript">
                                   alert("This promo code already exists");
                                    window.location.href="promo-code-edit.php";
                                </script> 

                    <?php
                        }else{
           
                       
                        $ins=mysqli_query($conn,"UPDATE `promo_code` SET `code`='$code',`title`='$title',`price`='$price',`type`='$type',`percentage`='$percentage',`use_quantity`=$quantity,`date_of_expiry`='$doe' WHERE `id`=$eid");
                       
                    if($ins)
                    { ?>
                                <script type="text/javascript">
                                   alert("Promo Code Update Successfully");
                                    window.location.href="promo-code-details.php?pid=<?php echo $eid; ?>";
                                </script> 

                    <?php }
                }
            }
                ?>
                                                </div>
                                            </div>
                                                   
                                        </div>
                                    </div>
                                            <!-- Tab Pane End -->
                                </div>
                                        <!-- Tab Content End -->
                                    
                            </section>
               



                <?php include('includes/footer.php');


?>