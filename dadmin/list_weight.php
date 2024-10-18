<?php

include ('includes/header.php');
?>
        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="LIST SIZE">
                        <table id="recordsListView">
                            <thead>
                                <tr>
                                    <th>Sr.No</th>
                                    <th>Name</th>
                                    <th>Symbol</th>
                                    <th>Status</th>
                                    <th>View / Edit</th>
                                    <th>Trash</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                            $query=mysqli_query($conn,"SELECT s.* FROM `size_class` as s LEFT JOIN classtype as ct on s.classtype_id=ct.id WHERE s.trash = 'No' AND classtype_id=2 ORDER BY s.id DESC");
                            $sr=1;
                            while($data=mysqli_fetch_array($query))
                            { ?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo ucwords($data['name']);?></td>
                                    <td><?php echo ucwords($data['symbol']);?></td>
                                    <td><?php
                                    if( $data['status']=='Active' ){ ?>
                                        <a class="btn btn-success" href="size-status.php?aid=<?php echo $data['id'].'&Active=Inactive'; ?>" onClick="return confirm('Are you sure you want to Inactive this Size')">Active</a>  
                                    <?php
                                    }
                                    else
                                    {  ?>
                                        <a class="btn btn-danger" href="size-status.php?aid=<?php echo $data['id'].'&Active=Active'; ?>" onClick="return confirm('Are you sure you want to Active this Size')">Inactive</a>  
                                    <?php
                                    } ?>                                       
                                    </td>
                                    <td><a href="size-edit.php?eid=<?php echo $data['id']; ?>"><span class="fa fa-edit" style="color:green; font-size: 30px;"></span></a></td>
                                    <td><a href="size-trash.php?eid=<?php echo $data['id'].'&Active=Inactive&trash=Yes'; ?>" onClick="return confirm('Are you sure you want to Delete this Size')"><i class="fa fa-trash" style=" font-size: 30px;"></i></a></td>
                                   
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
           