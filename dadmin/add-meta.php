    <?php include('includes/header.php');
    $sql1=mysqli_query($conn,"select * from seopages where id='".$_REQUEST['id']."' order by id desc");
$roww=mysqli_fetch_assoc($sql1);
$pageid=$_REQUEST['id'];
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
                            <h3>ADD META</h3>
                            <section>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">PAGE NAME: *</span>
                                                <input type="text" name="page_name" placeholder="Enter Page Name.." class="form-control" value="<?=$roww['page_name'];?>" readonly>
                                            </label>
                                        </div>
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">PAGE TITLE</span>
                                                <input type="text" name="title" placeholder="Enter Page Title" class="form-control" value="<?=$roww['title'];?>">
                                            </label>
                                        </div>
                                       <hr>

                                        <?php
                                $cn=1; $i=0;
                                $query1=mysqli_query($conn,"SELECT * FROM `metatags` WHERE seo_id=$pageid");
                                if(mysqli_num_rows($query1)>0)
                                { ?>
                                    <div class="form-group">
                                        <label>
                                        <span class="label-text">META TAGS:</span>
                                        <div class="field_wrapper form-group">
                                        
                                        <?php
                                        while($data1=mysqli_fetch_array($query1))
                                        { ?>
                                            <div class="input-group">
                                                <input type="text" id="in<?=$data1['id'];?>" name="ex_meta[<?=$data1['id'];?>]" value="<?php if(isset($_POST['meta'][$i])){ echo $_POST['meta'][$i]; }else{ echo $data1['meta'];}?>" class="form-control"/>
                                                <div class="input-group-append" id="btn<?=$data1['id'];?>"><span class="btn btn-danger" onclick="remove('<?=$data1['id'];?>')">Remove</span></div>
                                                <script>
                                                function remove(val)
                                                {
                                                    var x=confirm('Are you sure to delete this Meta Tags');
                                                    if(x==true)
                                                    { 
                                                      $.ajax({
                                                            type: "POST",
                                                            url: "remove-metatags.php",
                                                            data:'id='+val,
                                                            success: function(data){
                                                                if(data==1)
                                                      
                                                                $("#in"+val).remove();
                                                                $("#btn"+val).remove();
                                                              }
                                                            })
                                                            
                                                    }
                                                }
                                                </script>
                                                
                                        <?php
                                        if($cn==mysqli_num_rows($query1))
                                        { ?>
                                                <div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field">&emsp;<span class="btn btn-success">ADD</span></a></div></div>
                                        <?php
                                        }
                                        else{
                                            echo'</div>';
                                        }
                                        $cn++; $i++;
                                        } 
                                        ?>
                                        <br/>

                                        
                                        </div>
                                        </label>                                    
                                    </div>
                                <?php
                                }
                                else{ ?>
                                <span class="label-text">META TAGS: </span>
                                       <div class="field_wrapper form-group">
                                        <div class="input-group">
                                            <input type="text" name="meta[]" value="<?php if(isset($_POST['meta']['0'])){ echo $_POST['meta']['0']; }?>" class="form-control"/>
                                            <div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field">&emsp;<span class="btn btn-success">ADD</span></a></div>
                                        </div>
                                        <br>

                                        </div>    
                                <?php
                                } ?>
                               
                                <script type="text/javascript">
                                   $(document).ready(function(){
                                       var maxField = 10; //Input fields increment limitation
                                       var addButton = $('.add_button'); //Add button selector
                                       var wrapper = $('.field_wrapper'); //Input field wrapper
                                       var fieldHTML = '<div><input type="text" name="meta[]" value="" class="form-control"/><a href="javascript:void(0);" class="remove_button">Remove</a><br></div>'; //New input field html 
                                       var x = 1; //Initial field counter is 1

                                       //Once add button is clicked
                                       $(addButton).click(function(){
                                           //Check maximum number of input fields
                                           if(x < maxField){ 
                                               x++; //Increment field counter
                                               $(wrapper).append(fieldHTML); //Add field html
                                           }
                                       });

                                       //Once remove button is clicked
                                       $(wrapper).on('click', '.remove_button', function(e){
                                           e.preventDefault();
                                           $(this).parent('div').remove(); //Remove field html
                                           x--; //Decrement field counter
                                       });
                                   });
                                </script>
                                <hr>
                                 <?php
                                $cn=1; $i=0;
                                $query2=mysqli_query($conn,"SELECT * FROM `keywords` WHERE seo_id=$pageid");
                                if(mysqli_num_rows($query2)>0)
                                { ?>
                                    <div class="form-group">
                                        <label>
                                        <span class="label-text">META KEYWORDS:</span>
                                        <div class="field_wrapper1 form-group">
                                        
                                        <?php
                                        while($data2=mysqli_fetch_array($query2))
                                        { ?>
                                            <div class="input-group">
                                                <input type="text" id="key<?=$data2['id'];?>" name="ex_key[<?=$data2['id'];?>]" value="<?php if(isset($_POST['key'][$i])){ echo $_POST['key'][$i]; }else{ echo $data2['keyword'];}?>" class="form-control"/>
                                                <div class="input-group-append" id="btnKey<?=$data2['id'];?>"><span class="btn btn-danger" onclick="rem('<?=$data2['id'];?>')">Remove</span></div>
                                                <script>
                                                function rem(val)
                                                {
                                                    var x=confirm('Are you sure to delete this Meta Keywords');
                                                    if(x==true)
                                                    {
                                                       $.ajax({
                                                            type: "POST",
                                                            url: "remove-metakey.php",
                                                            data:'id='+val,
                                                            success: function(data){
                                                                if(data==1)
                                                      
                                                                $("#key"+val).remove();
                                                                $("#btnKey"+val).remove();
                                                              }
                                                            })
                                                            
                                                    }
                                                }
                                                </script>
                                                
                                        <?php
                                        if($cn==mysqli_num_rows($query2))
                                        { ?>
                                                <div class="input-group-append"><a href="javascript:void(0);" class="add_button1" title="Add field">&emsp;<span class="btn btn-success">ADD</span></a></div></div>
                                        <?php
                                        }
                                        else{
                                            echo'</div>';
                                        }
                                        $cn++; $i++;
                                        } 
                                        ?>
                                        <br/>

                                        
                                        </div>
                                        </label>                                    
                                    </div>
                                <?php
                                }
                                else{ ?>
                                <span class="label-text">META KEYWORDS:* </span>
                                       <div class="field_wrapper1 form-group">
                                        <div class="input-group">
                                            <input type="text" name="key[]" value="<?php if(isset($_POST['key']['0'])){ echo $_POST['key']['0']; }?>" placeholder="Enter Meta Keywords" class="form-control" required=""/>
                                            <div class="input-group-append"><a href="javascript:void(0);" class="add_button1" title="Add field">&emsp;<span class="btn btn-success">ADD</span></a></div>
                                        </div>
                                        <br>

                                        </div>    
                                <?php
                                } ?>
                                <script type="text/javascript">
                                   $(document).ready(function(){
                                       var maxField = 10; //Input fields increment limitation
                                       var addButton = $('.add_button1'); //Add button selector
                                       var wrapper = $('.field_wrapper1'); //Input field wrapper
                                       var fieldHTML = '<div><input type="text" name="key[]" value="" class="form-control"/><a href="javascript:void(0);" class="remove_button1">Remove</a><br></div>'; //New input field html 
                                       var x = 1; //Initial field counter is 1

                                       //Once add button is clicked
                                       $(addButton).click(function(){
                                           //Check maximum number of input fields
                                           if(x < maxField){ 
                                               x++; //Increment field counter
                                               $(wrapper).append(fieldHTML); //Add field html
                                           }
                                       });

                                       //Once remove button is clicked
                                       $(wrapper).on('click', '.remove_button1', function(e){
                                           e.preventDefault();
                                           $(this).parent('div').remove(); //Remove field html
                                           x--; //Decrement field counter
                                       });
                                   });
                                </script>
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
                            $title=$_POST['title'];
                            
                                   date_default_timezone_set("Asia/kolkata");
                                            $date=date("Y-m-d");
                                            $time=date("H:i:s");
                                            $query=mysqli_query($conn,"UPDATE  `seopages` SET title='$title' WHERE id=$pageid");
                                            if($query)
                                            {

                                                  
                                                  
                                                 if(isset($_POST['meta']) && !empty($_POST['meta']))
                                                 {
                                                  $meta=$_POST['meta'];
                                                   $metaTagQuery="INSERT INTO metatags(seo_id,meta,status) VALUES";
                                                   foreach($meta as $val)
                                                   {
                                                    $metaTagQuery.="(".$pageid.",'".$val."','Active'),";
                                                   }
                                                   $metaTagQuery=substr($metaTagQuery, 0,-1);
                                                   $query1=mysqli_query($conn,$metaTagQuery);
                                                   
                                                  }
                                                  if(isset($_POST['ex_meta']) && !empty($_POST['ex_meta']))
                                                  {
                                                    $UpdateMeta=$_POST['ex_meta'];
                                                    foreach($UpdateMeta as $key=>$update)
                                                    {
                                                      $updateMetaQuery=mysqli_query($conn,"UPDATE metatags SET meta='$update' WHERE id='$key' AND seo_id='$pageid'");
                                                    }

                                                  }
                                                  
                                                   if(isset($_POST['key']) && !empty($_POST['key']))
                                                   {
                                                    $keys=$_POST['key'];
                                                   $metaKeywordQuery="INSERT INTO keywords(seo_id,keyword,status) VALUES";
                                                   foreach($keys as $val1)
                                                   {
                                                    $metaKeywordQuery.="(".$pageid.",'".$val1."','Active'),";
                                                   }
                                                   $metaKeywordQuery=substr($metaKeywordQuery, 0,-1);
                                                   $query1=mysqli_query($conn,$metaKeywordQuery);
                                                  }

                                                 if(isset($_POST['ex_key']) && !empty($_POST['ex_key']))
                                                  {
                                                    $UpdateMetaKey=$_POST['ex_key'];
                                                    foreach($UpdateMetaKey as $key1=>$update1)
                                                    {
                                                      $updateMetaQuery=mysqli_query($conn,"UPDATE keywords SET keyword='$update1' WHERE id='$key1' AND seo_id='$pageid'");
                                                    }

                                                  }

                                                echo '<div id="snackbar">Meta add successfully..</div>';
                                                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                                                echo"var delay = 2000;setTimeout(function(){ window.location = 'view-seopage.php'; }, delay);";
                                                echo "</script>";
                                            }
                                            else
                                            {
                                                echo '<div id="snackbar">Your Meta Not Added..</div>';
                                                echo "<script> var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);</script>";
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
        