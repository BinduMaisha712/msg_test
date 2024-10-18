    <?php include('includes/header.php');
     $id=$_REQUEST['id'];
     if(!empty($id))
     {
    $query=mysqli_query($conn,"SELECT * FROM `social_media` WHERE id=$id");
    $data=mysqli_fetch_assoc($query);
    $name=$data['name'];
    $icon=$data['icon'];
    $url=$data['url'];
    }
    else
    {
      $name=$icon=$url="";
    }
 ?>
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
                            <h3>ADD SOCIAL MEDIA</h3>
                            <section>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Social Media Name: *</span>
                                                <input type="text" name="mediaName" placeholder="Enter Social Media Name.." value="<?=$name;?>" class="form-control" required>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text"> Social Media  Icons</span>
                                                <input type="text" name="icons" placeholder="Enter Media Icon " class="form-control" value="<?=$icon;?>" required>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text"> Social Media  Url</span>
                                                <input type="text" name="url" placeholder="Enter Social Media Url " class="form-control" value="<?=$url;?>" required>
                                            </label>
                                        </div>
                                       <hr>

                                    <div class="form-group">
                                        <label><button class="btn btn-success btn-md pull-right" name="submit">Submit</button></label>
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
                                      $mediaName=$_POST['mediaName'];
                                      $icons=$_POST['icons'];
                                      $url=$_POST['url'];
                            
                                       date_default_timezone_set("Asia/kolkata");
                                            $date=date("Y-m-d");
                                            $time=date("H:i:s");
                                            if(empty($id))
                                            {
                                            $query=mysqli_query($conn,"SELECT id FROM  `social_media` WHERE  name='$mediaName'");
                                            if(mysqli_num_rows($query)<=0)
                                            {

                                                   $query1="INSERT INTO social_media(name,icon,url,status) VALUES('$mediaName','$icons','$url','Active')";
                                                  
                                                   $query1=mysqli_query($conn,$query1);
                                                if($query1) 
                                               {
                                                echo '<div id="snackbar">Social Media add successfully..</div>';
                                                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                                echo"var delay = 2000;setTimeout(function(){ window.location = 'view-socialMedia.php'; }, delay);";
                                                echo "</script>";
                                            }
                                            else
                                            {
                                                echo '<div id="snackbar">Your Social Media Not Added..</div>';
                                                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                                            }
                                          }
                                          else
                                          {
                                            echo '<div id="snackbar"Social Media Already Added..</div>';
                                                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                                          }
                                        }
                                        else
                                        {
                                         $query=mysqli_query($conn,"SELECT id FROM  `social_media` WHERE  name='$mediaName' AND id!=$id");
                                            if(mysqli_num_rows($query)<=0)
                                            {

                                                   $query1="UPDATE social_media  SET name= '$mediaName',icon='$icons' ,url= '$url' WHERE id=$id";
                                                  
                                                   $query1=mysqli_query($conn,$query1);
                                                if($query1) 
                                               {
                                                echo '<div id="snackbar">Social Media update successfully..</div>';
                                                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                                echo"var delay = 2000;setTimeout(function(){ window.location = 'view-socialMedia.php'; }, delay);";
                                                echo "</script>";
                                            }
                                            else
                                            {
                                                echo '<div id="snackbar">Your Social Media Not Update..</div>';
                                                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
                                            }
                                          }
                                          else
                                          {
                                            echo '<div id="snackbar"Social Media Already Added..</div>';
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
        