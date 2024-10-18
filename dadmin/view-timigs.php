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
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query=mysqli_query($conn,"SELECT * FROM `del_time` ORDER BY id DESC");
                            $sr=1;
                            while($data=mysqli_fetch_array($query))
                            { ?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo ucwords($data['stime'])."-".ucwords($data['etime']);?></td>
                                    <td><?php
                                    if( $data['status']=='Active' ){ ?>
                                        <a class="btn btn-success" href="timig-status.php?aid=<?php echo $data['id'].'&Active=Inactive'; ?>" onClick="return confirm('Are you sure you want to Inactive this Time Slot')">Active</a>  
                                    <?php
                                    }
                                    else
                                    {  ?>
                                        <a class="btn btn-danger" href="timig-status.php?aid=<?php echo $data['id'].'&Active=Active'; ?>" onClick="return confirm('Are you sure you want to Active this Time Slot')">Inactive</a>  
                                    <?php
                                    } ?>                                       
                                    </td>
                                   <td><a href="edit_timigs.php?id=<?=$data['id'];?>"><span class="fa fa-edit" style="color:green; font-size: 30px;"></span></a></td>
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
           