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
                                    <!-- <th>Class Type</th> -->
                                    <th>Category</th>
                                    <th>Created Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query=mysqli_query($conn,"SELECT c.*,ct.name as classtype FROM `category` as c LEFT JOIN classtype as ct on c.classtype_id=ct.id WHERE c.trash='No' ORDER BY c.id DESC ");
                            $sr=1;
                            while($data=mysqli_fetch_array($query))
                            { ?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <!-- <td><?php echo $data['classtype'];?></td> -->
                                    <td><?php echo $data['cat_name'];?></td>
                                     <td><?php echo $data['date']; ?>&nbsp;<?php echo $data['time']; ?></td>
                                    <td><?php
                                    if( $data['status']=='Active' ){ ?>
                                        <a class="btn btn-success" href="cat-status.php?aid=<?php echo $data['id'].'&Active=Inactive'; ?>" onClick="return confirm('are you sure you want to Inactive this products')">Active</a>  
                                    <?php
                                    }
                                    else
                                    {  ?>
                                        <a class="btn btn-danger" href="cat-status.php?aid=<?php echo $data['id'].'&Active=Active'; ?>" onClick="return confirm('are you sure you want to Active this products')">Inactive</a>  
                                    <?php
                                    } ?>                                       
                                    </td>
                                    <td><a href="cat-edit.php?eid=<?php echo $data['id']; ?>"><span class="fa fa-edit" style="color:green; font-size: 30px;"></span></a>&nbsp;&nbsp;&nbsp;
                                     <a href="trash-category.php?eid=<?php echo $data['id'].'&Active=Inactive&trash=Yes'; ?>" onClick="return confirm('Are you sure you want to Delete this Category')"><i class="fa fa-trash" style="color:red; font-size: 30px;"></i></a>
                                      </td></td>
                                   
                                </tr>
                                <?php  $sr++; 
                            } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- Records List End -->
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
           