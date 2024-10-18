<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">

            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="Home Middle Images">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                     <th>Sr.No</th>
                                    <th>Image</th>
                                    
									<th>Category</th>
									<th>Change Image</th>
                                </tr>
                            </thead>
                            <tbody>
						<?php
						$query=mysqli_query($conn,"SELECT * FROM `homemiddle`");
						$sr=1;
						while($data=mysqli_fetch_array($query))
						{
						?>
						<tr>
						<td><?php echo $sr ?></td>                            
						<td><img src="image/homemiddle/<?php echo $data['image']; ?>" width="150px" height="150px"></td>

                          <td>
						  
						  <?php
						  $cquery = mysqli_query($conn,"SELECT * FROM `subcategory` where id='$data[catid]' ");
						  $cdata = mysqli_fetch_array( $cquery);
						  
						  $squery = mysqli_query($conn,"SELECT * FROM `category` where id='$cdata[cat_id]' ");
						  $sdata = mysqli_fetch_array( $squery);
						   echo $sdata['cat_name']." > ". $cdata['sub_cat_name'];
						  ?>
						  
						  </td>

						<td>
						<a href="edit-home-middle-image.php?id=<?php echo $data['id']; ?>"><span class="fa fa-edit" style="color:green; font-size: 30px;"></span>
                                        </a>
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
