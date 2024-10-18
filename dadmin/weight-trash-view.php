<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="LIST WEIGHT">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Weight</th>                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query=mysqli_query($conn,"SELECT * FROM `weight` WHERE trash = 'Yes' ORDER BY id DESC");
                            $sr=1;
                            while($data=mysqli_fetch_array($query))
                            { 
                                $query1=mysqli_query($conn,"SELECT * FROM `weight_class` where id='".$data['class']."'");
                                $fet=mysqli_fetch_assoc($query1); ?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['name']." ".ucwords($fet['name']);?></td>                                   
                                    <td><a href="weightm-trash.php?aid=<?php echo $data['id'].'&Active=Active&trash=No'; ?>" onClick="return confirm('Are you sure you want to Restore this Weight')" class="btn btn-success">Move to Live</a></td>
                                   
                                   
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
           