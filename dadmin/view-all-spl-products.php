<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
                <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="special PRODUCTS DETAILS">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Product Name</th>
                                    
                                    <th>View</th>
                                    <th>Add</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query("SELECT * FROM `products` where special='Yes' ");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['product_name'];?></td>
                                    
									
									<td>
 <a class="btn btn-success" href="special-products-view.php?id=<?php echo $data['id'];?>" >View</a>  
                             </td>
									
                                     <td>
 
  <a class="btn btn-success" href="special-image-add.php?id=<?php echo $data['id'];?>">Add</a> 
                                    
                                    </td>
                                   

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
           