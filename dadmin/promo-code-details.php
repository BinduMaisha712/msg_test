<?php

include('includes/header.php'); ?>
                    <?php
                        
                        $pid=$_REQUEST['pid'];
                        $query=mysqli_query($conn,"SELECT * FROM `promo_code` WHERE id=$pid");
                        $data=mysqli_fetch_array($query);
                        
                    ?>

                     <main class="main--container">
<style type="text/css">
    .header{
    border-top-left-radius: calc(0.25rem - 1px);                    
    border-top-right-radius: calc(0.25rem - 1px);
    border-bottom-right-radius: 0px;
    border-bottom-left-radius: 0px;
    border: 1px solid #725d93;
}
</style>
                         <section class="main--content">
                                    <div class="panel">
                                            <!-- Tab Content Start -->
                                            <div class="tab-content">
                                                <!-- Tab Pane Start -->
                                                <div class="header">
                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#first" style="color: #ffa500;">PROMO CODE DETAILS</button>
                                                </div>
                                                <div class="collapse show" id="first" style="border: 1px solid #725d93;">
                                                    <h4 class="subtitle"></h4>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <table class="table table-bordered table-cells-middle">
                                                      
                                                    <tbody>
                                                        <tr>
                                                            <th>Code</th>
                                                            <td>
                                                               <?php echo $data['code']; ?> 
                                                            </td>
                                                            <th>Title</th>
                                                            <td>
                                                                <?php  echo $data['title']; ?>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            <th>Price</th>
                                                            <td>
                                                                <?php if($data['percentage']=='no'){
                                                                    ?>
                                                                        <?php echo $data['price']; ?>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                        <?php echo $data['price']; ?>%
                                                                    <?php
                                                                } ?>
                                                               
                                                            </td>
                                                            <th>Date of Create</th> 
                                                                <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td>
                                                            <!--<th>Type</th>-->
                                                            <!--<td>-->
                                                            <!--   <?php echo $data['type']; ?>-->
                                                            <!--</td>-->
                                                        </tr>
                                                        <tr>
                                                            <th>Percentage</th>
                                                            <td>
                                                                <?php echo $data['percentage']; ?>
                                                            </td>
                                                                <th>Use Quantity</th>  
                                                                <td>
                                                                    <?php echo $data['use_quantity']; ?>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th>Date Of Expiry</th>
                                                                <td> 
                                                                    <?php echo $data['date_of_expiry'] ?>
                                                                </td>
                                                            
                                                                
                                                            </tr>
                                                           
                                                               
                                                            </tr>
                                                            
                                                    </tbody>
                                                </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                 <div class="header">
                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#second" style="color: #ffa500;">PROMO CODE UPDATE</button>
                                                </div>
                                                <div class="panel-content collapse" id="second" style="border: 1px solid #725d93;"><br>
                                                <?php
                                                $eid=$_REQUEST['pid'];
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
                                                </form><br>
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
                                   

           
                       
                        $ins=mysqli_query($conn,"UPDATE `promo_code` SET `code`='$code',`title`='$title',`price`='$price',`type`='$type',`percentage`='$percentage',`use_quantity`=$quantity,`date_of_expiry`='$doe' WHERE `id`=$eid");
                       
                    if($ins)
                    { ?>
                                <script type="text/javascript">
                                   alert("Promo Code Update Successfully");
                                    window.location.href="promo-code-details.php?pid=<?php echo $eid; ?>";
                                </script> 

                    <?php }
                }
                ?>
                                                </div>
                                            </div>
                                                   
                                        </div>
                                            </div>

                                         </div>
                                </section>

                    <?php include('includes/footer.php'); 

?>