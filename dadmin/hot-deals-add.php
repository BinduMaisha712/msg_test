    <?php include('includes/header.php'); ?>

        <!-- Main Container Start -->
        <main class="main--container">
            <!-- Main Content Start -->
            <section class="main--content">                
                <div class="panel">

                    <!-- Edit Product Start -->
                    <div class="records--body">
                        <div class="title">
                            <h6 class="h6"> HOT DEALS - Product Add</h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <div class="panel-content">
                                <form action="" method="post" enctype="multipart/form-data" name="form">        
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Product Name: *</span>

                                        <div class="col-md-9">
                                            <input type="text" name="product" class="form-control" required placeholder="Enter Products Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Image: </span>

                                        <div class="col-md-9">
                                            <input type="file" name="image" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">price: </span>

                                        <div class="col-md-9">
                                            <input type="text" name="price" class="form-control" id="amount" placeholder="Only Enter Rs" required>
                                        </div>
                                    </div>
                                <div class="input_wrap">
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Description: </span>
                                        <div class="col-md-9">
                                            <div class="field_wrapper form-group">
                                        <div class="input-group">
                                            <textarea class="form-control" name="description[]" required></textarea>
                                            <div class="input-group-append"><a href="javascript:void(0);" class="add_button" title="Add field">&emsp;<span class=" btn btn-success">Add</span></a></div>
                                        </div><br>

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
<?php
    if(isset($_POST['submit']))
    {
        $product=$_POST['product'];
        $price=$_POST['price'];
        $image_name=($_FILES["image"]["name"]);  
        $image_type=($_FILES["image"]["tmp_name"]); 
        $description=$_POST['description'];
        $last_query=mysqli_query($conn,"SELECT * FROM `hot_deals_products` ORDER BY id desc limit 1");
         $last_data=mysqli_fetch_array($last_query);
         $code=$last_data['products_code'];
         $num_str=$code+1;
        $ins=("INSERT INTO `hot_deals_products`(`product_name`, `price`, `products_code`) VALUES ('$product','$price','$num_str')");
        $query=mysqli_query($conn,$ins);
        $last=mysqli_insert_id($conn);
                  
              
                    $iquery=mysqli_query($conn,"INSERT INTO `hot_deals_image`(`p_id`, `image`) VALUES ('$last','$image_name')");
                        move_uploaded_file($image_type,"image/".$image_name);
        
                   
              

                    foreach($description as $key => $value)
{
        
        $dquery=mysqli_query($conn,"INSERT INTO `hot_deals_descriptions`(`p_id`, `description`) VALUES ('$last','$value')");

}
    if($dquery)
    { ?>
                <script type="text/javascript">
                   alert("Product add successfully");
                    window.location.href="hot-deals-edit.php?pid=<?php echo $last; ?>";
                </script> 

    <?php }
}
?>


                                <!-------------price valildation------------->
            
<script type="text/javascript">
let amount = document.querySelector('#amount'), preAmount = amount.value;
        amount.addEventListener('input', function(){
            if(isNaN(Number(amount.value))){
                amount.value = preAmount;
                return;
            }

            let numberAfterDecimal = amount.value.split(".")[1];
            if(numberAfterDecimal && numberAfterDecimal.length > 3){
                amount.value = Number(amount.value).toFixed(3);;
            }
            preAmount = amount.value;
        })


                                       

</script>

            <?php include('includes/footer.php'); ?>
