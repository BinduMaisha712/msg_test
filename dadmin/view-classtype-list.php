<?php
$classId=$_GET['id'];

include ('includes/header.php');
$name=mysqli_fetch_assoc(mysqli_query($conn,"SELECT name FROM classtype WHERE id =$classId"))['name'];
$url=strtolower(str_replace(" ","_",$name));
$title="LIST ".strtoupper($name);
?>
        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <!-- Records List Start -->
                    <div class="records--list" data-title="<?=$title;?>">
                        <?php
                               // if($classId==1)
                               //   {
                               //      $url="size";
                               //      $name="SIZE";
                               //     }
                               // if($classId==2)
                               //  {
                               //   $url="weight";
                               //      $name="WEIGHT";
                               //  }
                               // if($classId==3)
                               //   {
                               //      $url="gadget";
                               //      $name="STORAGE";
                               //   }
                               // if($classId==4)
                               //   {
                               //      $url="shoesize";
                               //      $name="SHOES SIZE";
                               //   }
                             ?>
                        
                         <a class="btn btn-success" href="add-class.php?id=<?=$classId?>" style="border-radius: 0px;margin-top: 21px;margin-left: 25px;">ADD <?=$name?></a>
                         
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
                            $query=mysqli_query($conn,"SELECT s.* FROM `size_class` as s LEFT JOIN classtype as ct on s.classtype_id=ct.id WHERE s.trash = 'No' AND s.classtype_id=".$classId." ORDER BY s.id DESC");
                            $sr=1;
                            while($data=mysqli_fetch_array($query))
                            { ?>
                                <tr>
                                    <td><?php echo $sr ?></td>                            
                                    <td><?php echo ucwords($data['name']);?></td>
                                    <td><?php echo ucwords($data['symbol']);?></td>
                                    <td><?php
                                    if( $data['status']=='Active' ){ ?>
                                        <a class="btn btn-success" href="class-status.php?aid=<?php echo $data['id'].'&Active=Inactive&classtype='.$classId ?>" onClick="return confirm('Are you sure you want to Inactive this <?=$url?>')">Active</a>  
                                    <?php
                                    }
                                    else
                                    {  ?>
                                        <a class="btn btn-danger" href="class-status.php?aid=<?php echo $data['id'].'&Active=Active&classtype='.$classId; ?>" onClick="return confirm('Are you sure you want to Active this <?=$url?>')">Inactive</a>  
                                    <?php
                                    } ?>                                       
                                    </td>
                                    <td><a href="class-edit.php?eid=<?php echo $data['id']; ?>"><span class="fa fa-edit" style="color:green; font-size: 30px;"></span></a></td>
                                    <td><a href="class-trash.php?eid=<?php echo $data['id'].'&Active=Inactive&trash=Yes&classtype='.$classId; ?>" onClick="return confirm('Are you sure you want to delete this <?=$url?>')"><i class="fa fa-trash" style=" font-size: 30px;"></i></a></td>
                                   
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
           