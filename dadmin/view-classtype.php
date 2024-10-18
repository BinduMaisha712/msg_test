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
                                    <th>Class Type</th>
                                    <th>Count</th>
                                    <th>Status</th>
                                    <th>View</th>
                                    <th>Trash</th>
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

                              $query="SELECT c.*,count(s.id) as total FROM classtype as c 
                              LEFT JOIN size_class as s on c.id=s.classtype_id and s.status = 'Active' AND s.trash='No' 
                              WHERE  c.trash='No' AND c.id!='16'
                              group by c.id ORDER BY c.id ASC";
                              $query=mysqli_query($conn,$query);
                              $sr=1;
                              while($data=mysqli_fetch_array($query))
                              {  
                                


                                ?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                     <td><?php echo $data['name'];?></td>
                                     <td><?php echo $data['total'];?></td>
                                   <td><?php
                                    if( $data['status']=='Active' ){ ?>
                                        <a class="btn btn-success" href="classtype-status.php?aid=<?php echo $data['id'].'&Active=Inactive'; ?>" onClick="return confirm('are you sure you want to Inactive this classtype')">Active</a>  
                                    <?php
                                    }
                                    else
                                    {  ?>
                                        <a class="btn btn-danger" href="classtype-status.php?aid=<?php echo $data['id'].'&Active=Active'; ?>" onClick="return confirm('are you sure you want to Active this classtype')">Inactive</a>  
                                    <?php
                                    } ?>                                       
                                    </td>
                                      <td><a class="btn btn-success" href="view-classtype-list.php?id=<?=$data['id'];?>">View</a></td>
                                      <td>
                                     <a href="trash-classtype.php?eid=<?php echo $data['id'].'&Active=Inactive&trash=Yes'; ?>" onClick="return confirm('Are you sure you want to Delete this Class Type')"><i class="fa fa-trash" style="color:red; font-size: 30px;"></i></a>
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
           