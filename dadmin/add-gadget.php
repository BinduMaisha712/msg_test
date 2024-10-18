    <?php include('includes/header.php');
    $where=$selected="";
    if(isset($_GET['id']))
    {
  $where="AND id=".$_GET['id'];
  $selected="selected";
    } ?>
    <style type="text/css">
        .steps{
            display: none;
        }
    </style>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">
                <div class="panel">
                    <div class="panel-content">
                        <!-- Form Wizard Start -->
                        <form action="" method="post" id="formWizard" class="form--wizard" enctype="multipart/form-data">
                            <h3>ADD GADGETS</h3>
                            <section>
                                <div class="row">
                                    <div class="col-md-8">
                                        
                                       
                                        <div class="form-group">
                                        <span class="label-text">SELECT CLASS TYPE: *</span>
                                        <select name="classtype" id="classtype" class="form-control" required>
                                          <option value="">-----Select Class Type-----</option> 
                                          <?php
                                          $sel_query=mysqli_query($conn,"SELECT * FROM `classtype` WHERE status='Active'".$where);

                                          while($data=mysqli_fetch_assoc($sel_query))
                                          {
                                            ?> 
                                            <option value="<?php echo $data['id']; ?>" <?=$selected;?>> <?php echo $data['name']; ?></option>
                                          <?php } ?>
                                        </select>
                                      </div>
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">STORAGE : *</span>
                                                <input type="text" name="cat_symbol" placeholder="Enter Storage .." class="form-control" value="<?php if(isset($_POST['cat_symbol'])){ echo $_POST['cat_symbol'];}?>" required>
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
                            $name=strtolower('Gadget');
                            $classtypeId=$_POST['classtype'];
                            $sel_query=mysqli_query($conn,"SELECT * FROM `size_class` WHERE classtype_id=$classtypeId AND symbol='".$_POST['cat_symbol']."' AND trash='No'");
                            if(mysqli_num_rows($sel_query)>0)
                            {
                                //echo "<script>";
                                echo '<div id="snackbar">This Storage is already added..</div>';
                                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                            }
                            else
                            {
                               $query=mysqli_query($conn,"INSERT INTO `size_class`(`classtype_id`,`name`,`symbol`) VALUES ('$classtypeId','$name','".$_POST['cat_symbol']."')");
                                if($query)
                                {
                                    $lastid = mysqli_insert_id($conn);

                                    echo '<div id="snackbar">Storage Class add successfully..</div>';
                                    echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                    echo"var delay = 1000;setTimeout(function(){ window.location = 'view-classtype-list.php?id=".$_GET['id']."'; }, delay);";
                                    echo "</script>";
                                }
                                else
                                {
                                    echo '<div id="snackbar">Your Storage Class Not Added..</div>';
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
        