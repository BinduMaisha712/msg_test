<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
                <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="today Deal PRODUCTS DETAILS">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Product</th>
                                    <th>View</th>
                                   
                                    
                                </tr>
                            </thead>
                            <tbody>
<?php

    $query=mysqli_query($conn,"SELECT * FROM `products` where status='Active' And today_deal='Yes' ORDER BY id DESC");

    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['product_name'];?></td>
                                    <td>

  <a class="btn btn-success" href="date-update-todays-deals.php?id=<?php echo $data['id']; ?>" >View</a>  
                                        
                                    </td>
                                  
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
           