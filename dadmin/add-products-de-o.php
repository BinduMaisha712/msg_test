<?php include('includes/header.php'); ?>
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">                
        <div class="panel">
            <!-- Edit Product Start -->
            <div class="records--body">
                <div class="title">
                    <h6 class="h6">Product Add</h6>
                </div>
                <!-- Tab Content Start -->
                <div class="tab-content">
                    <!-- Tab Pane Start -->
                    <div class="tab-pane fade show active" id="tab01">
                        <div class="panel-content">
                            <form action="" method="post" enctype="multipart/form-data" name="form">                                
                                <div class="form-group row">
                                    <span class="label-text col-md-3 col-form-label">Select Category: *</span>
                                        <div class="col-md-9">
                                            <select name="category" id="category" class="form-control" required>
                                                <option value="">-----select category-----</option> 
                                                    <?php
                                                      $sel_query=mysqli_query($conn,"SELECT * FROM `category`");

                                                      while($data=mysqli_fetch_assoc($sel_query))
                                                      {
                                                      ?> 
                                                  <option value="<?php echo $data['id']; ?>" > <?php echo $data['cat_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row" id="subcategory"></div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Product Name: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="product" class="form-control" required placeholder="Please enter product name">
                                        </div>
                                    </div>

                                    

                                    <div class="input_wrap">
                                        <div class="form-group row">
                                            <span class="label-text col-md-3 col-form-label">Description: </span>
                                                <div class="col-md-9">
                                                    <div class="field_wrapper form-group">
                                        <div class="input-group">
                                            <textarea class="form-control" name="description[]" required=""></textarea>
                                            <div class="input-group-append">
                                            <a href="javascript:void(0);" class="add_button" title="Add field">&emsp;<span class="btn btn-success">ADD</span></a>
                                            </div>
                                        </div>
                                        <br>
                                        <script type="text/javascript">
                                        $(document).ready(function(){
                                            var maxField = 10; //Input fields increment limitation
                                            var addButton = $('.add_button'); //Add button selector
                                            var wrapper = $('.field_wrapper'); //Input field wrapper
                                            var fieldHTML = '<div><textarea class="form-control" name="description[]"></textarea><a href="javascript:void(0);" class="remove_button">Remove</a></div><br>'; //New input field html 
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
                                <button class="btn btn-success" name="submit" id="sub">Submit</button>
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


<script type="text/javascript">
$(document).ready(function(){
    $('#category').on("change",function () {
        if($(this).val() != '') {
            var categoryId = $(this).find('option:selected').val();
            $.ajax({
                url: "ajax.php",
                type: "POST",
                data: "categoryId="+categoryId,
                success: function (response) {
                    $("#subcategory").html(response);
                }
            });
        } else {
            $("#subcategory").html('');
        }
    }); 

});
</script>

<?php include('includes/footer.php');
if(isset($_POST['submit']))
{
    //print_r($_POST);//print_r($_FILES);
    date_default_timezone_set("Asia/kolkata");
    $date=date("Y-m-d");
    $time=date("H:i:s");
    $new='No'; $hot='No'; $top='No'; $cod='No';
    
    $category=$_POST['category'];
    $subcategory='';
    if(isset($_POST['subcategory']))
    {
        $subcategory=$_POST['subcategory'];
    }
    $product=$_POST['product'];
    $sel_query=mysqli_query($conn,"SELECT * FROM `products` WHERE product_name='$_POST[product]'");
    if(mysqli_num_rows($sel_query)>0)
    {
        echo '<div id="snackbar">This product is already added...</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo"var delay = 1000;setTimeout(function(){ window.location = 'add-products.php'; }, delay);";
        echo "</script>";
            
    }
    else
    {
        $sel_query=mysqli_query($conn,"SELECT * FROM `products` order by id desc");
        if(mysqli_num_rows($sel_query)>0)
        {
            $vaar= mysqli_fetch_assoc($sel_query);
            $p_uniqu=$vaar['product_code']+1;
        }
        else{
            $p_uniqu=rand(1000,999);
        }
 
            $query=mysqli_query($conn,"INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`product_code`,`date`,`time`,`status`) VALUES "
                    . "('$category','$subcategory','$product','".$p_uniqu."','$date','$time','temp')")or die(mysqli_error());
 
                    
                       //description
        $description=$_POST['description'];
        if(!empty($description[0])){
            foreach($description as $key => $value)
             {
                 $value=mysqli_real_escape_string($conn,$value);
                 $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('$category','$subcategory','$p_uniqu','$value')")or die(mysqli_error());
             }
         }
        echo '<div id="snackbar">Product Added Sucessfully...</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo"var delay = 1000;setTimeout(function(){ window.location = 'view-all-products.php'; }, delay);";
        echo "</script>";
    }

}

 ?>