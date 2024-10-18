<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">

            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="CATEGORY VIEWS">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Logo</th>
                                    <th>Brand Name</th>
									<th>Status</th>
									<th>delete</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query("SELECT * FROM `brandslogo`");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><img src="image/brandlogo/<?php echo $data['logo']; ?>" width="150px" height="150px"></td>
									
									 
                                    <td><?php echo $data['brandname'] ?></td>
									<td>
									<?php

									if( $data['status']=='Active' ){
									?>
									<a class="btn btn-success" href="brandlogo-status.php?id=<?php echo $data['id'].'&status=Inactive'; ?>">Active</a>  
									<?php
									}
									else
									{ 
									?>
									<a class="btn btn-danger" href="brandlogo-status.php?id=<?php echo $data['id'].'&status=Active'; ?>">Inactive</a>  
									<?php
									}


									?>                                       
									</td>

									<td><a href="delete.php?id=<?php echo $data['id']; ?>" ><button type="button" class="btn btn-danger">Delete</button></a></td>
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
