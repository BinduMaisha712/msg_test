<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <!--<th>Header</th>-->
                                    <th>Status</th>
                                    <th>View / Edit</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query=mysqli_query($conn,"SELECT * FROM `headerimage` ORDER BY id DESC");
                            $sr=1;
                            while($data=mysqli_fetch_array($query))
                            { ?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <!--<td><?php echo $data['heading'];?></td>-->
                                    <td><?php
                                    if( $data['status']=='Active' ){ ?>
                                        <a class="btn btn-success" href="header-status.php?sldksdhjfisdfsdflsjdfifrIOHOUU9a7asuaaf=aff9asf0sdIUjyuyyGD7d&id=<?php echo $data['id'].'&status=Inactive'; ?>&dsjhoOIUIdd9DVDdd=dsvsvwkefj8vddDvs" onClick="return confirm('are you sure you want to Inactive this products')">Active</a>  
                                    <?php
                                    }
                                    else
                                    {  ?>
                                        <a class="btn btn-danger" href="header-status.php?sldksdhjfisdfsdflsjdfifrIOHOUU9a7asuaaf=aff9asf0sdIUjyuyyGD7d&id=<?php echo $data['id'].'&status=Active'; ?>&dsjhoOIUIdd9DVDdd=dsvsvwkefj8vddDvs" onClick="return confirm('are you sure you want to Active this products')">Inactive</a>  
                                    <?php
                                    } ?>                                       
                                    </td>
                                    <td><a href="header-image.php?sldksdhjfisdfsdflsjdfifrIOHOUU9a7asuaaf=aff9asf0sdIUjyuyyGD7d&id=<?php echo $data['id']; ?>&dsjhoOIUIdd9DVDdd=dsvsvwkefj8vddDvs"><span class="fa fa-edit" style="color:green; font-size: 30px;"></span></a></td>
                                    <td><?php echo $data['timeStamp']; ?></td>
                                </tr>
                                <?php  $sr++; 
                            } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
           