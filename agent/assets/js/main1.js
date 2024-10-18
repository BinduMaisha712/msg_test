
// ================= start price valildation================================

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


// =================price end price valildation================================


                                        // ajax code==================================   

$(document).ready(function(){

    $('#state').on("change",function () {
        var stateId = $(this).find('option:selected').val();
        $.ajax({
            url: "state_ajax.php",
            type: "POST",
            data: "stateId="+stateId,
            success: function (response) {
               //alert(response);
                //console.log(response);
                $("#city").html(response);
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


                            
 