<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
                <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="PRODUCTS DETAILS">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Product</th>
                                    <th>Userid</th>
                                   
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query($conn,"SELECT * FROM `notifyme` ORDER BY id DESC");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['pid'];?></td>
                                     <td><?php echo $data['userid'] ?></td> 
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
           