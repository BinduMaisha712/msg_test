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
                                    <th>Email</th>
                                    
                                    <th>Date n Time</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query($conn,"SELECT * FROM `newsletter` ORDER BY id DESC");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
      
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['email'];?></td>
									<td><?php echo $data['datentime'] ?></td>
                                </tr>

<?php  $sr++; } ?>
                                
                            </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
