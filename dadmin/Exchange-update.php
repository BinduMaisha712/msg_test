<?php include('includes/header.php'); 
    $tid=$_REQUEST['tid'];   ?>
    <main class="main--container">
        <section class="main--content">
            <div class="panel">
                <div class="records--body">
                    <div class="title">
                        <h6 class="h6">Privacy Policy Details</h6>
                    </div>
                    <div class="tab-content">
                        <!-- Tab Pane Start -->
                        <div class="tab-pane fade show active" id="tab01">
                            <form action="" method="post" enctype="multipart/form-data" name="form">  
                                <?php
                                $pquery=mysqli_query($conn,"SELECT * FROM `return_exchange_title` WHERE id=$tid"); //products select query
                                $pdata=mysqli_fetch_array($pquery);

                                $des_query=mysqli_query($conn,"SELECT * FROM `return_exchange_desc` WHERE title_id=$tid"); //description select query ?>
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Title : </span>

                                    <div class="col-md-9">
                                        <input type="text" name="title" class="form-control" required value="<?php echo $pdata['title']; ?>">
                                    </div>
                                </div>
                                <?php  
                                $i=0;
                                while($des_data=mysqli_fetch_array($des_query))
                                {    ?>
                                    <div class="form-group row" id="<?=$des_data['id'];?>">
                                        <span class="label-text col-md-3 col-form-label">Description: </span>
                                        <div class="col-md-6">
                                             <input type="hidden" name="t_id[]" value="<?=$des_data['id'];?>">
                                            <textarea class="form-control" rows="3" name="description[]"><?php echo $des_data['description']; ?></textarea>
                                        </div>
                                        <div class="col-md-3">
                                        <input type="button" onclick="remove('<?=$des_data['id'];?>')" value="Remove" class="btn btn-danger pull-right"/>
                                        </div>
                                    </div>
                                <?php $i++;} ?>
                                <script>
                                function remove(id)
                                {
                                    var x=confirm('Are you sure to delete this Content');
                                    if(x==true)
                                    {
                                        $.ajax({
                                            type: "POST",
                                            url: "remove_exchange.php",
                                            data:'id='+id,
                                            success: function(data){
                                                if(data==1)
                                                $("#"+id).hide();
                                                
                                            }
                                        });
                                    }
                                }
                                </script>
                                <?php 
//print_r($_POST);
                                if(isset($_POST['add_description']))
                                {
                                    for($j=0;$j<count($_POST['add_description']);$j++)
                                    { ?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Description: </span>
                                        <div class="col-md-6">
                                        <textarea class="form-control" name="add_description[]"><?php if(isset($_POST['add_description'][$j])){ echo $_POST['add_description'][$j]; }?></textarea>
                                        <a href="javascript:void(0);" class="remove_button">Remove</a><br/>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                }?>
                                <div class="input_wrap">        <!---- description add---->
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label"></span>
                                        <div class="col-md-9">
                                            <div class="field_wrapper form-group">
                                                <div class="input-group">
                                                    <div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field">&emsp;<span>ADD</span></a></div>
                                                </div>
                                                <script type="text/javascript">
                                                $(document).ready(function(){
                                                    var maxField = 10; //Input fields increment limitation
                                                    var addButton = $('.add_button'); //Add button selector
                                                    var wrapper = $('.field_wrapper'); //Input field wrapper
                                                    var fieldHTML = '<div><textarea class="form-control" name="add_description[]"></textarea><a href="javascript:void(0);" class="remove_button">Remove</a></div><br>'; //New input field html 
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
                </div>
            </div>
        </section>
            <!-- Main Content End -->
<?php
if(isset($_POST['submit']))
{
    $title=$_POST['title'];
    $up=mysqli_query($conn,"UPDATE `return_exchange_title` SET `title`='$title' WHERE id=$tid");
    $description=$_POST['description'];
    $rid=$_POST['t_id'];

    foreach($description as $key => $value)
    {
        $auid=$rid[$key];
        $value = mysqli_real_escape_string($conn, $value);
        $update=("UPDATE `return_exchange_desc` SET `description` = '$value' WHERE title_id=$tid AND id = $auid");
        $des_query=mysqli_query($conn,$update);
    }
    if(isset($_POST['add_description']))
    {
        $add_description=$_POST['add_description'];
        foreach($add_description as $key => $value)
        {
            $value = mysqli_real_escape_string($conn, $value);
            $query=mysqli_query($conn,"INSERT INTO `return_exchange_desc`(`title_id`, `description`) VALUES ('$tid','$value')");
        }
    }
    if($des_query)
    {  
        echo '<div id="snackbar">Content Updated successfully..</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo"var delay = 1000;setTimeout(function(){ window.location = 'Exchange-view.php'; }, delay);";
        echo "</script>";
    }
    else
    {

        echo "not ok";
    }
} 
include('includes/footer.php'); ?>