<?php

include ('includes/header.php');
?>
<style>
.table-hover tr:hover {
  cursor: pointer;
}
</style>
        <!-- Main Container Start -->
        <main class="main--container">
                <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" >
                        <table id="recordsListView" class="table-hover">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Product</th>
                                    <th>Count</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            //print_r($_SESSION);
                            if(isset($_SESSION['alert']))
                            {
                                if($_SESSION['alert']=='updated')
                                {
                                  echo '<div id="snackbar">Updated Succcessfully...</div>';
                                  echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                  
                                  // echo"var delay = 1000;setTimeout(function(){ window.location = 'add-products.php'; }, delay);";
                                  echo "</script>";
                                  unset($_SESSION['alert']);
                                }
                              }

                              $query="SELECT p.id,p.product_name,p.group_code,p.date,p.time,c.cat_name,sc.sub_cat_name,count(p.id) as total FROM products as p 
                              LEFT JOIN category as c on c.id=p.cat_id
                              LEFT JOIN subcategory as sc on sc.id=p.subcat_id
                               WHERE p.trash = 'No' group by p.group_code ORDER BY p.id DESC";
                              $query=mysqli_query($conn,$query);
                              $sr=1;
                              while($data=mysqli_fetch_array($query))
                              {  




                                ?>
                                <tr onclick="window.location.assign('view-products-list.php?product=<?=$data['group_code'];?>');">
                                    <td><?php echo $sr ?></td>                            
                                     <td><?php echo $data['cat_name'];?></td>
                                    <td><?php echo $data['sub_cat_name'];?></td>
                                    <td><?php echo $data['product_name'];?></td>
                                    <td><?php echo $data['total'];?></td>
                                      <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td>
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
           