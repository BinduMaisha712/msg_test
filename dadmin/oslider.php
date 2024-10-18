<?php include ('includes/header.php'); ?>
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
                                    <th>Slider</th>
                                    <th>Status</th>
                                    <th>View / Edit</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query=mysqli_query($conn,"SELECT * FROM `offer_slider` ORDER BY id DESC");
                            $sr=1;
                            while($data=mysqli_fetch_array($query))
                            { ?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['text_image'];?></td>
                                    <td><?php
                                        if( $data['status']=='Active' ){ ?>
                                            <a class="btn btn-success" href="oslider-status.php?aid=<?php echo $data['id'].'&Active=Inactive'; ?>" onClick="return confirm('Are you sure you want to Inactive this slider')">Active</a>  
                                        <?php
                                        }
                                        else
                                        {  ?>
                                            <a class="btn btn-danger" href="oslider-status.php?aid=<?php echo $data['id'].'&Active=Active'; ?>" onClick="return confirm('Are you sure you want to Active this slider')">Inactive</a>  
                                        <?php
                                        } ?>                                       
                                    </td>
                                    <td><a class="btn btn-success" href="oslider-view.php?id=<?php echo $data['id']; ?>">View</a></td>
                                    <td><?php echo $data['ad_date']; ?>&nbsp;<?php echo $data['ad_timer']; ?></td>
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
           