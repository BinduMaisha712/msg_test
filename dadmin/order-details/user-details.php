   <!-- Card Start -->
   <div class="card">
       <div class="card-header">
           <h5 class="h5">
               <button class="btn btn-link collapse-icon" data-toggle="collapse" data-target="#collapse01" style="color: #725d93;">User Details</button>
           </h5>
       </div>

       <div id="collapse01" class="collapse show" data-parent="#accordion01">
           <div class="card-body">
               <div class="row">
                   <div class="col-md-6">
                       <table class="table table-responsive table-simple" width="100%">
                           <h5 style="color: #725d93;">Shipping Address :--</h5>
                           <tr>
                               <th>User</th>
                               <td>: <?php echo $ship_data['first_name']; ?>&nbsp;<?php echo $ship_data['last_name']; ?></td>
                           </tr>
                           <tr>
                               <th>Mobile</th>
                               <td>: <?php echo $ship_data['phone']; ?></td>
                           </tr>
                           <tr>
                               <th>Email</th>
                               <td>: <?php echo $ship_data['email']; ?></td>
                           </tr>
                           <tr>

                               <?php
                                $gteCountrycoe = $ship_data['country'];
                                $getCountrrName = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `countries` WHERE `id` ='$gteCountrycoe' "));

                                $stateid = $ship_data['state'];
                                $getstateidName = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `state_list` WHERE `id` ='$stateid' "));
                                ?>


                               <th>Address</th>
                               <td> <b>Flat :</b> <?php echo $ship_data['flat']; ?>, <b>Street :</b><?php echo $ship_data['street']; ?>, <b>locality :</b><?php echo $ship_data['locality']; ?>, <b>city :</b><?php echo $ship_data['city']; ?>, <b>Pin code :</b><?php echo $ship_data['zip_code']; ?>, <b>state :</b><?php echo $getstateidName['state']; ?>, <b>country :</b><?php echo $getCountrrName['country_name']; ?>
                               </td>
                           </tr>
                       </table>
                   </div>
                   <div class="col-md-6">
                       <table class="table table-responsive table-simple" width="100%">
                           <h5 style="color: #725d93;">Billing Address :--</h5>
                           <?php
                                $gteCountrycoe1 = $user_data['country'];
                                $getCountrrName1 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `countries` WHERE `id` ='$gteCountrycoe' "));

                                $stateid1 = $user_data['state'];
                                $getstateidName1 = mysqli_fetch_array(mysqli_query($conn, "SELECT * FROM `state_list` WHERE `id` ='$stateid1' "));
                                ?>
                           <tr>

                               <th>Name</th>
                               <td>: <?php echo $user_data['firstname']; ?>&nbsp;<?php echo $user_data['lastname']; ?></td>
                           </tr>
                           <tr>
                               <th>Mobile</th>
                               <td>: <?php echo $user_data['mobile']; ?></td>
                           </tr>
                           <tr>
                               <th>Email</th>
                               <td>: <?php echo $user_data['email']; ?></td>
                           </tr>
                           <tr>
                               <th>Address</th>
                               <td> <b>Flat :</b> <?php echo $user_data['flat']; ?>, <b>Street :</b><?php echo $user_data['street']; ?>, <b>locality :</b><?php echo $user_data['locality']; ?>, <b>city :</b><?php echo $user_data['city']; ?>, <b>Pin code :</b><?php echo $user_data['zipcode']; ?>, <b>state :</b><?php echo $getstateidName1['state']; ?>, <b>country :</b><?php echo $getCountrrName1['country_name']; ?>
                               </td>
                           </tr>
                       </table>
                   </div>

               </div>

           </div>
       </div>
   </div>
   <!-- Card End -->