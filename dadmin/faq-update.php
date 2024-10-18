
    <?php include('includes/header.php'); 
    $tid=$_REQUEST['tid'];
    ?>

        <!-- Main Container Start -->
        <main class="main--container">

            <!-- Main Content Start -->
            <section class="main--content">
                
                <div class="panel">

                    <!-- Edit Product Start -->
                    <div class="records--body">
                        <div class="title">
                            <h6 class="h6">FAQ Details</h6>
                        </div>

                        <!-- Tab Content Start -->
                        <div class="tab-content">
                            <!-- Tab Pane Start -->
                            <div class="tab-pane fade show active" id="tab01">
                                <form action="" method="post" enctype="multipart/form-data" name="form">  
                                <?php
                                    $pquery=mysqli_query($conn,"SELECT * FROM `faq_title` WHERE id=$tid"); //products select query
                                    $pdata=mysqli_fetch_array($pquery);

                                    $des_query=mysqli_query($conn,"SELECT * FROM `faq` WHERE title_id=$tid"); //description select query
                                ?>
                                    <div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Question: </span>

                                        <div class="col-md-9">
                                            <input type="text" name="title" class="form-control" required value="<?php echo $pdata['title']; ?>">
                                        </div>
                                    </div>
                                    <?php  
                                    $i=0;
                                    while($des_data=mysqli_fetch_array($des_query))
                                    {                               ?>
                                    <div class="form-group row" id="<?=$des_data['id'];?>">
                                        <span class="label-text col-md-3 col-form-label">Description: </span>
                                        <div class="col-md-6">
                                            <textarea class="form-control" rows="3" name="description[]"><?php echo $des_data['description']; ?></textarea>
                                        </div>
                                        <div class="col-md-3">
                                        <input type="button" onclick="remove('<?=$des_data['id'];?>')" value="Remove" class="btn btn-danger pull-right"/>
                                        </div>
                                    </div>
                                    <?php $i++; }
                                    ?>
                                    <script>
                                    function remove(id)
                                    {
                                        var x=confirm('Are you sure to delete this Content');
                                        if(x==true)
                                        {
                                            $.ajax({
                                                type: "POST",
                                                url: "remove_faq.php",
                                                data:'id='+id,
                                                success: function(data){
                                                    if(data==1)
                                                    $("#"+id).hide();

                                                }
                                            });
                                        }
                                    }
                                </script>
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
        $up=mysqli_query($conn,"UPDATE `faq_title` SET `title`='$title' WHERE id=$tid");
            $description=$_POST['description'];
            $des_sel_query=mysqli_query($conn,"SELECT * FROM `faq` WHERE title_id=$tid");
            $sdata=mysqli_fetch_array($des_sel_query);
                $sdata=$sdata['id'];
                $sdata=$sdata-1;

                    foreach($description as $key => $value)
                    {
                        $sdata++ ;
                
                        $update=("UPDATE `faq` SET `description` = '$value' WHERE title_id=$tid AND id = $sdata");
                        $des_query=mysqli_query($conn,$update);
                    }

                    $add_description=$_POST['add_description'];
                    foreach($add_description as $key => $value)
                        {
                            $query=mysqli_query($conn,"INSERT INTO `faq`(`title_id`, `description`) VALUES ('$tid','$value')");
                        }
                          
        if($des_query)
            {

                ?>
                <script type="text/javascript">
                    alert('faq updated..');
                    window.location.href='faq-view.php';
                </script>
            <?php }
        else
        {

            echo "not ok";
        }
    }


?>
            <!-- Main Footer Start -->
 <script type="text/javascript">
                                        // ajax code==================================   

$(document).ready(function(){

    $('#country').on("change",function () {
        var countryId = $(this).find('option:selected').val();
        $.ajax({
            url: "city_ajax.php",
            type: "POST",
            data: "countryId="+countryId,
            success: function (response) {
               //alert(response);
                //console.log(response);
                $("#city").html(response);
            },
        });
    }); 

});

                                            //----------------- zip code ajax code------------

$(document).ready(function(){

    $('#city').on("change",function () {
        var cityId = $(this).find('option:selected').val();
        
        $.ajax({
            url: "products-zip-code-ajax.php?pid=<?php echo $pid;?>",
            type: "POST",
            data: "cityId="+cityId,
            success: function (response) {
               //alert(response);
                //console.log(response);
               $("#sell").html(response);
            },
        });
    }); 

});

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
<script type="text/javascript">                         //---------zip code insert--------
    function addalldat(zipid,cityid,pid)
    {
        $.ajax({
            url: "products-zip-code-insert-ajax.php",
            type: "POST",
            data: {"cityid": cityid,"zipid": zipid,"pid": pid},
            success: function (response) {
               //alert(response);
                //console.log(response);
               //$("#").html(response);
            },
        });
    }
</script> 


            <?php include('includes/footer.php'); ?>