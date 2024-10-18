    <?php include('includes/header.php'); ?>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">                
                <div class="panel">

                    <!-- Edit Product Start -->
                    <div class="records--body">
                        <div class="title">
                            <h6 class="h6">Return & Exchange</h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                    <div class="panel-content">
                                <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                  
								
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Title:</span>

                                        <div class="col-md-9">
                                            <input type="text" name="title" class="form-control" required placeholder="Enter title..">
                                        </div>
                                    </div>
                                <div class="input_wrap">
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Description: </span>
                                        <div class="col-md-9">
                                            <div class="field_wrapper form-group">
                                        <div class="input-group">
                                            <textarea class="form-control" name="description[]"></textarea>
                                            <div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field">&emsp;<span class="btn btn-success">ADD</span></a></div>
                                        </div><br>

                                        <script type="text/javascript">
                                        $(document).ready(function(){
                                            var maxField = 10; //Input fields increment limitation
                                            var addButton = $('.add_button'); //Add button selector
                                            var wrapper = $('.field_wrapper'); //Input field wrapper
                                            var fieldHTML = '<div><textarea class="form-control" name="description[]"></textarea><a href="javascript:void(0);" class="remove_button">Remove</a></div>'; //New input field html 
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

          
                                     </div>
                                        </div>
                                    </div>
                                </div>
                                    <div class="row mt-3">
                                        <div class="col-md-9 offset-md-3">
                                            <button class="btn btn-success" name="submit">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                            <!-- Tab Pane End -->
                        </div>
                        <!-- Tab Content End -->
                    </div>
                    <!-- Edit Product End -->
                </div>
            </section>
            <!-- Main Content End -->
<?php
    
    if(isset($_POST['submit']))
    {
     $title=$_POST['title'];
     $ins=mysqli_query($conn,"INSERT INTO `privacy&policy_title`(`title`) VALUES ('$title')");
    
    $last=mysqli_insert_id($conn);

    $description=$_POST['description'];
    foreach($description as $key => $value)
        {
            $query=mysqli_query($conn,"INSERT INTO `privacy&policy`(`title_id`, `description`) VALUES ('$last','$value')");
             }
             if($query){
                 echo '<div id="snackbar">Content Added successfully..</div>';
                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                echo"var delay = 1000;setTimeout(function(){ window.location = 'privacy-policy-view.php'; }, delay);";
                echo "</script>";
             }
     } ?>

            <?php include('includes/footer.php'); ?>
