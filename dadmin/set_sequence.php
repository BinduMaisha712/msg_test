<?php
include ('includes/header.php');
?>
<style>
.mysetimg .dataTable {
    padding: 0 0 !important;
    overflow: auto;
}
.mysetimg #recordsListView.dataTable thead .sorting {
    background-image: none !important;
}
.mysetimg #recordsListView_paginate {
    display: none;
}
.mysetimg .right {
    display: none !important;
}
.setimghd{
    padding: 15px;
    font-size: 20px;
    font-weight: 600;
    color: #d78c06;
}
.topbar {
    display: none !important;
}

</style>

<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <div class="row">
                <div class="col-md-12">
                    <h3 class="setimghd">Set Product Image Sequence</h3>
                </div>
            </div>
            <form action="imgsequence.php" method="post" enctype="multipart/form-data">  
            <!-- Records List Start -->
            <div class="records--list mysetimg">
                
                <table id="recordsListView">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <!-- <th>Sequence</th> -->
                            <th>Change Sequence</th>
                        </tr>
                    </thead>
                    <tbody>
                      
                        <?php
                            $sq_im=mysqli_query($conn,"select * from image where p_id='".$_GET['pid']."'");
                            $sno=1;
                            while($ro_im=mysqli_fetch_assoc($sq_im))
                            {
                        ?>
                        <tr>                      
                            <td>
                                <img src='../asset/image/product/<?=$ro_im['image'];?>' style="width:200px;">
                            </td>
                            
                            <td>
                                <input type="hidden" value="<?php echo $ro_im['id'];?>" name="imgid[]">
                                <?php
                                if($ro_im['set_seq']=='')
                                {
                                ?>
                                <input type="text" name="setseq[]" style="width:65px;" value="<?php echo $sno++;['set_seq'];?>">
                                <?php } else { ?>
                                <input type="text" name="setseq[]" style="width:65px;" value="<?php echo $ro_im['set_seq'];?>">
                                <?php } ?>
                            </td>
                        </tr>

                        <?php } ?>

                        <tr>
                            <td></td>
                            <!-- <td></td> -->
                            <td>
                               <input type="hidden" value="<?php echo $_GET['pid'];?>" name="proid">
                                <input type="submit" name="submit" class="setimgseqbtn" value="Save">
                            </td>
                        </tr>
               
                        

                        
                    </tbody>
                </table>

            </div>
            </form>
            <!-- Records List End -->
        </div>
    </section>
    <!-- Main Content End -->

    <!-- Main Footer Start -->
    <?php include('includes/footer.php'); ?>
           