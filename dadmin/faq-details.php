   
<?php include('includes/header.php'); ?>
<?php
    
    $tid=$_REQUEST['tid'];
?>
<?php  

    $des_query=mysqli_query($conn,"SELECT * FROM `faq` WHERE title_id=$tid");
       
?>

 <main class="main--container">
     <section class="main--content">
                <div class="panel">
                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <h4 class="subtitle">description</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered table-cells-middle">
                                    <thead class="text-dark"> 

                                </thead>
                                <tbody>        
                                    <?php while($des_data=mysqli_fetch_array($des_query))
                                                { ?> 
                                    <tr>
                                        <td><?php echo $des_data['description']; ?></td>
                                        <td width="10%">
                                            <?php
                                                if( $des_data['status']=='Active' ){ ?>
                                                  <a style="color: green;"  href="faq-des-status.php?did=<?php echo $des_data['id'].'&Active=Inactive'; ?>&tid=<?php echo $tid; ?>">Active</a>  
                                            <?php } else {  ?>
                                                                 <a  href="faq-des-status.php?did=<?php echo $des_data['id'].'&Active=Active'; ?>&tid=<?php echo $tid; ?>">Inactive</a>  
                                            <?php }  ?>
                                        </td>
                                        
                                    </tr> <?php } ?>                                       
                                </tbody>
                            </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>

<?php include('includes/footer.php'); ?>