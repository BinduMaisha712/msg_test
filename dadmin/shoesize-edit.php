    <?php include('includes/header.php'); ?>
    <style type="text/css">
        .steps{
            display: none;
        }
    </style>
    <?php 
    $sqlq=mysqli_query($conn,"select * from size_class where id='".$_REQUEST['eid']."'");
    $varq=mysqli_fetch_assoc($sqlq);?>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <div class="panel-content">
                        <!-- Form Wizard Start -->
                        <form action="" method="post" id="formWizard" class="form--wizard" enctype="multipart/form-data">
                        <input type="hidden" name="size_id" value="<?=$_REQUEST['eid'];?>">
                           
                            <h3>EDIT SHOE SIZE</h3>
                            <section>
                                <div class="row">
                                    <div class="col-md-8">
                                         
                                        
                                        <div class="form-group">
                                        <span class="label-text">SELECT CLASS TYPE: *</span>
                                        <select name="classtype" id="classtype" class="form-control" required>
                                          <option value="">-----Select Class Type-----</option> 
                                          <?php
                                          $sel_query=mysqli_query($conn,"SELECT * FROM `classtype` WHERE status='Active' AND id=4");

                                          while($data1=mysqli_fetch_assoc($sel_query))
                                          {
                                            ?> 
                                            <option value="<?php echo $data1['id']; ?>" <?php if($varq['classtype_id'] == $data1['id']) { ?> selected="selected" <?php } ?>> <?php echo $data1['name']; ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">SIZE: *</span>
                                                <input type="text" name="cat_symbol" placeholder="Enter Size .." class="form-control" value="<?php if(isset($_POST['cat_symbol'])){ echo $_POST['cat_symbol'];}else{ echo $varq['symbol'];}?>" required>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label><button class="btn btn-success btn-md" id="sub" name="submit">Submit</button></label>
                                        </div>
                                       
                                    </div>
                                </div>
                            </section>
                        </form>
                        <!-- Form Wizard End -->
                        <?php
//                        print_r($_POST);                            print_r($_FILES); 
                        if(isset($_POST['submit']))
                        {
                            $classtypeId=$_POST['classtype'];
                            $name='Shoe';
                            $symbol=$_POST['cat_symbol'];
                            $sizeId=$_POST['size_id'];
                         $sel_query=mysqli_query($conn,"SELECT * FROM `size_class` WHERE classtype_id=$classtypeId AND trash='No' AND symbol='".$symbol."' AND id=!'".$sizeId."'");
                            if(mysqli_num_rows($sel_query)>0)
                            {
                                //echo "<script>";
                                echo '<div id="snackbar">This Shoe Size Class is already added..</div>';
                                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                            }
                            else
                            {
                           $query = "UPDATE size_class
                                        SET classtype_id=$classtypeId, name='$name', symbol='$symbol'
                                        WHERE id='$sizeId'";

                               $query=mysqli_query($conn,$query);
                                if($query)
                                {
                                    $lastid = mysqli_insert_id($conn);

                                    echo '<div id="snackbar">Shoe Size Class Edited successfully..</div>';
                                    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                    echo"var delay = 1000;setTimeout(function(){ window.location = 'view-classtype-list.php?id=4'; }, delay);";
                                    echo "</script>";
                                }
                                else
                                {
                                    echo '<div id="snackbar">Your Shoe Size Class Not Edited..</div>';
                                    echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                                }
                        }
                    }

                        ?>
                    </div>
                </div>
            </section>
            <!-- Main Content End -->

            <!-- Main Footer Start -->
            <?php include('includes/footer.php'); ?>
           
            <!-- Main Footer End -->
        