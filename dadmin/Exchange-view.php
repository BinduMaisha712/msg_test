<?php
include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
                <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Title</th>
                                    <th>Status</th>
                                    <!--<th>Descriptions</th>-->
                                    <th>View / Edit</th>
                                    <th>Created Date</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
if(!empty($_GET['tid']) && !empty($_GET['Active'])){
    $id = $_GET['tid'];

    $status = $_GET['Active'];
    if($status == 'Inactive'){
      $updatequer = "UPDATE return_exchange_title SET status ='Inactive' WHERE id ='$id' ";
    }
    if($status == 'Active'){
      $updatequer = "UPDATE return_exchange_title SET status ='Active' WHERE id ='$id' ";
    }
    $check = 0;
   if(mysqli_query($conn,$updatequer)){
     $check =1;
   }
}
    $query=mysqli_query($conn,"SELECT * FROM `return_exchange_title`");
    $sr=1;
    while($data=mysqli_fetch_array($query))
    {
?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo $data['title'];?></td>
                                  <td>
 <?php

  if( $data['status']=='Active' ){
?>
  <a class="btn btn-success" href="Exchange-view.php?tid=<?php echo $data['id'].'&Active=Inactive'; ?>" onClick="return confirm('Are you sure you want to Inactive this title')">Active</a>  
<?php
     }
     else
     { 
         ?>
  <a class="btn btn-danger" href="Exchange-view.php?tid=<?php echo $data['id'].'&Active=Active'; ?>" onClick="return confirm('Are you sure you want to Active this title')">Inactive</a>  
  <?php
     }


     ?>                                       
                                    </td>
<!--                                    <td>
                                        <a class="btn btn-success" href="privacy-policy-details.php?tid=<?php //echo $data['id']; ?>">View</a>
                                    </td>-->
                                    <td><a class="btn btn-success" href="Exchange-update.php?tid=<?php echo $data['id']; ?>">View / Edit</a></td>
                                    <td><?php echo $data['date'] ?></td> 
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
            <?php
 if(isset($check) && $check==1){
      echo '<div id="snackbar">Content Added successfully..</div>';
                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
    }

            ?>