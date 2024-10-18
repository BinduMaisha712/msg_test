<style>
    .new-hed-one {
    border: 1px solid #784e94;
    margin-bottom: 10px;
    border-radius: 4px;
}
</style>

<div class="card mb-3">
<div class="card-header">
<h5 class="h5">
    <button class="btn btn-link collapse-icon" data-toggle="collapse" data-target="#collapse06" style="color: #725d93;" aria-expanded="false">Assign Delivery </button>
</h5>
</div>

<div id="collapse06" class="collapse show" data-parent="#accordion06">
        <div class="card-body">
        <div class="row">
    <div class="m-3">

   
    <?php 

        $sel2 = mysqli_query($conn,"SELECT * FROM order_details WHERE order_id = '$order_id' AND shipment_id IS NULL AND order_status IS NULL");

        // echo $sel; echo '<h1> this </h1>';
     
            $i = 1;
            while($order_details=mysqli_fetch_array($sel2)) { 
               
                $pid = $order_details['productid'];
                $qty = $order_details['quantity'];
                $product = mysqli_fetch_assoc(mysqli_query($conn ,"SELECT * FROM products WHERE id = '$pid'")); 
                if($qty > 1){
                    $product['weight'] = $product['weight'] * $qty;
                }
                
                
                 $colorName = "";
            
                if(!empty($product['class0']) )
                {
                $colorName .= "(" . mysqli_fetch_assoc(mysqli_query($conn, "SELECT symbol FROM size_class WHERE id=" . $product['class0']))['symbol']. ')';
                }
                if(!empty($product['class1']) )
                {
                $colorName .= " (" . $product['class1'] . ')';
                }
               if ($product['class2'] != '')
                $colorName .= ' (' . $product['class2'] . ')' ;
                ?>

            <div class="d-flex m-1">
               <?php  if($order_details['order_status'] != 'Assigned Delivery'){?>
                <input type="checkbox" name="order<?= $i;?>" id="product<?= $i;?>" checked class="productToAssign d-none">
                <label  class="mx-2 border m-1 p-1" style="font-size: 1.1rem;" for=""><?= $product['product_name'] . $colorName;?></label>
                <div>
                    <input type="hidden" name="" id="heightInp<?= $i;?>" value = "<?= $product['height'];?>">
                    <input type="hidden" name="" id="breadthInp<?= $i;?>" value = "<?= $product['width'];?>">
                    <input type="hidden" name="" id="weightInp<?= $i;?>" value = "<?= $product['weight'] ;?>">
                    <input type="hidden" name="" id="lengthInp<?= $i;?>" value = "<?= $product['length'];?>">
                    <input type="hidden" id="productId<?= $i;?>" value ="<?= $product['id'];?>">
                </div>
              <?php  } ?>
                 
            </div>
        <?php  $i++ ;}

         $shippingAddress = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM shiping_address WHERE order_id = '$order_id'"));  
?>
    <input type="hidden" id="pinCodeInp" value= "<?= $ship_data['zip_code']; ?>">
    <input type="hidden" id="orderId" value ="<?= $order_id;?>">
    <button class="btn btn-success mt-3" id="assignDel">Assign Delivery</button>
     

    </div>
</div>

        </div>
</div>
</div>


<script>
                                        // assign delivaery bbtn 
                                        var productChecks = document.querySelectorAll('.productToAssign');
                                        var btn = document.getElementById('assignDel');

                                        btn.addEventListener('click', function(){
                                            $('#assignDel').attr('disabled', true)
                                             $('#overlay').show()
                                            var checkCount = 0;
                                            productChecks.forEach(element => {
                                                if(element.checked){
                                                    checkCount ++ ;
                                                }
                                            });

                                            // if(!checkCount){

                                            //     $("#snackbar").html('Please select products to assign delivery');
                                            //             var x = document.getElementById("snackbar");
                                            //             x.className = "show";
                                            //             setTimeout(function() {
                                            //                 x.className = x.className.replace("show", "");
                                            //             }, 3000);

                                            // }
                                            // else{
                                                var heightArr = [];
                                                var widthArr = [];
                                                var lengthArr = [];
                                                var productArr = [];
                                                var weight = 0;
                                                // console.log(productChecks)

                                                productChecks.forEach(element => {
                                                    if(element.checked){
                                                        var id= element.id. charAt(element.id. length - 1)
                                                        // console.log('id is '+ id)
                                                        heightArr.push($('#heightInp' + id).val());
                                                        widthArr.push($('#breadthInp' + id).val());
                                                        lengthArr.push($('#lengthInp' + id).val());
                                                        weight += Number($('#weightInp' + id).val());
                                                        productArr.push($('#productId' + id).val());
                                                    }else{
                                                        console.log('none is checked')
                                                    }
                                                })
                                                var maxHeight = Math.max.apply(Math, heightArr);

                                                var maxLength = Math.max.apply(Math, lengthArr);
                                                var maxwidth = Math.max.apply(Math, widthArr);
                                                var totalHeight = maxHeight + (maxHeight * 0.25);
                                                var totalWeight = weight;

                                                $.ajax({
                                                    url : '../ajax/bookDelhivery.php',
                                                    type: 'POST',
                                                    dataType: 'JSON',
                                                    data :{
                                                        action : 'bookShipping',
                                                        orderID : $('#orderId').val(),
                                                        height: totalHeight,
                                                        weight: totalWeight,
                                                        length: maxLength,
                                                        breadth: maxwidth,
                                                        products: productArr,
                                                        zipCode: $('#pinCodeInp').val(),
                                                    },
                                                    success: function (data){
                                                        // console.log(data)
                                                        $('#assignDel').removeAttr('disabled')
                                                         $('#overlay').hide()

                                                        $("#snackbar").html(data.msg);
                                                        var x = document.getElementById("snackbar");
                                                        x.className = "show";
                                                        setTimeout(function() {
                                                            x.className = x.className.replace("show", "");
                                                        }, 3000);
                                                        if(data.status){
                                                            setTimeout(() => {
                                                                // window.location.reload();
                                                            }, 1000);
                                                           
                                                        }
                                                    }
                                                })
                                            
                                            // }
                                        });

                                        // product checkboxes 

                                    </script>