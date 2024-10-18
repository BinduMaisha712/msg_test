<?php
   include('includes/header.php'); ?>
                    <?php
                        
                        $did=$_REQUEST['did'];
                        $query=mysqli_query($conn,"SELECT * FROM `deliverymen` WHERE id=$did");
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
                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#first" style="color: #ffa500;">DELIVERY MEN DETAILS</button>
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
                                                            <th>Mobile</th>
                                                            <td>
                                                               <?php echo $data['mobile']; ?>
                                                               <?php 
                                                                $mobile_query=mysqli_query($conn,"SELECT * FROM `deliverymen_mobile` WHERE `deliverymen_id`=$did");
                                                                while($mobile_data=mysqli_fetch_array($mobile_query))
                                                                {
                                                                    echo " , ".$mobile_data['mobile']."<br>";
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>

                                                        <tr>
                                                            
                                                            <th>Email</th>
                                                            <td>
                                                               <?php echo $data['email']; ?>
                                                            </td>
                                                            <th>Password</th>
                                                            <td><?php echo $data['password'];?></td>
                                                        </tr>
                                                        <tr>
                                                            <th>Address</th>
                                                            <td><?php echo $data['address'];?></td>
                                                                <th>Status</th>  
                                                                <td>
                                                                    <?php echo $data['status']; ?>
                                                                </td>
                                                            </tr>
                                                            
                                                               
                                                            </tr>
                                                            
                                                    </tbody>
                                                </table>
                                                        </div>
                                                    </div>
                                                </div><br>
                                                <div class="header">
                                                    <button type="button" class="btn btn-link" data-toggle="collapse" data-target="#second" style="color: #ffa500;">DELIVERYMEN UPDATE</button>
                                                </div>
                                                
                            <!-- Tab Pane Start -->
                            <div class="collapse panel-content" id="second" style="border: 1px solid #725d93;"><br>
                                <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                  
<?php
    $sel_query=mysqli_query($conn,"select * from deliverymen where id=$did");
    $sel_data=mysqli_fetch_array($sel_query);

?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label"> Name: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="name" class="form-control" required value="<?php echo $sel_data['name']; ?>">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                        <div class="col-md-9">
                                            <input type="number" name="mobile" class="form-control" value="<?php echo $sel_data['mobile']; ?>" id="amount">
                                        </div>
                                    </div>
                                      <?php
                                        $mobile_query=mysqli_query($conn,"SELECT * FROM `deliverymen_mobile` WHERE deliverymen_id=$did");
                                        if(mysqli_num_rows($mobile_query) > 0){
                                            while($mobile_data=mysqli_fetch_array($mobile_query)){
                                         ?>
                                            <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Mobile: </span>

                                        <div class="col-md-9">
                                            <input type="hidden" name="mobileid[]" value="<?php echo $mobile_data['id']; ?>">
                                            <input type="number" name="phone[]" class="form-control" value="<?php echo $mobile_data['mobile']; ?>" id="amount">
                                        </div>
                                    </div>
                                    <?php   } } ?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Email: </span>

                                        <div class="col-md-9">
                                            <input type="email" name="email" class="form-control" value="<?php echo $sel_data['email']; ?>" id="amount">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Password: </span>

                                        <div class="col-md-9">
                                            <input type="text" name="password" class="form-control" value="<?php echo $sel_data['password']; ?>" id="amount">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Address: </span>
                                        <div class="col-md-9">
                                            <textarea class="form-control" rows="3" name="address"><?php echo $sel_data['address']; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-md-9 offset-md-3">
                                            <button class="btn btn-success" name="submit">update</button>

                                        </div>
                                    </div>
                                </form>
                             
                            </div>
                            <!-- Tab Pane End -->
                        
                                            </div>
                                        </div>
                                </section>

                    <?php include('includes/footer.php'); 

?>
   <?php
    
    if(isset($_POST['submit']))
    {
        
         $name=$_POST['name'];
         $mobile=$_POST['mobile'];
         $phone=$_POST['phone'];
         $mobileid=$_POST['mobileid'];
         $email=$_POST['email'];
         $password=$_POST['password'];
         $address=$_POST['address'];
       $query=mysqli_query($conn,"UPDATE `deliverymen` SET `name`='$name',`mobile`='$mobile',`email`='$email',`password`='$password',`address`='$address' WHERE id=$did");
       foreach(array_combine($phone, $mobileid) as $phone => $mobileid)
       {
            $moile_update=mysqli_query($conn,"UPDATE `deliverymen_mobile` SET `mobile`='$phone' WHERE id=$mobileid");
       }
        if($query)
            {
                echo '<div id="snackbar">Deliverymen Successfully Updated...</div>';
                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                echo"var delay = 1000;setTimeout(function(){ window.location = 'delivery-men-details.php?did=".$did."'; }, delay);";
                echo "</script>";
            }
        else
        {

            echo "not ok";
        }
    }


?>
