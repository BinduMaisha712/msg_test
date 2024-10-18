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
					<th>Name</th>
					<th>Email</th>
					<th>Phone</th>
					<th>Subject</th>
					<th>Message</th>
					<th>Date n Time</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
    $query=mysqli_query($conn,"SELECT * FROM `contact_form` ORDER BY id DESC");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
      
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['name'];?></td>
									<td><?php echo $data['email'];?></td>
									<td><?php echo $data['phone'];?></td>
									<td><?php echo $data['subject'];?></td>
									<td><?php echo substr($data['message'], 0, 150);?>...<a href="view-message.php?id=<?=$data['id'] ;?>">Read More</a></td>
									
									
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
