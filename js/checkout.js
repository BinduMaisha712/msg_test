function uncheckShippingAddr() {
  $("#shippingAddrCheck").prop("checked", false);
  $("#newBillingAddressZipCod").removeAttr("readonly");
  if ($("label[href=#collapseAddress]").attr("aria-expanded") == "true") {
    $("#newDifferentShippingAddress").val("newDifferentShippingAddress");
    $("#recieverZipCode").val("");
    $(".shipad").prop("checked", false);
    // $("#shippingFee").html("Enter address to know shipping charge");
    $('.currencySign').hide();

    $("#paymentSeciton").hide();
  } else {
    $("#newDifferentShippingAddress").val("");
  }
}

function disabledeliver() {
  if ($("label[href=#collapseAddress3]").attr("aria-expanded") == "true") {
    $("#newShippingAddress").val("newShippingAddress");
    $("#recieverZipCode").val("");
    $(".shipad").prop("checked", false);
    // $("#shippingFee").html("Enter address to know shipping charge");

    $("#paymentSeciton").hide();
    $("#paymentType1").change();
  } else {
    $("#newShippingAddress").val("");
    $(".shippinad").each(function () {
      if ($(this).is(":checked")) {
        setVals(this);

        // alert('#shippingAddr_'+id);
      }
    });
  }
}

$('.shippinad').on('click', function(){
     $('.newAddrCheck').prop('checked', false)
     $('.different_address').hide()
})

// function not in use
function getEstimate(elem, id) {

  if ($("#" + elem.id).is(":checked")) {
    var billingZipcode = $("#newBillingAddressZipCod").val();
    var shippingingZipcode = $("#newDifferentShippingZipCod").val();
    var newShippingZipCode = $("#newShippingAddressZipCod").val();
    if (elem.id.includes("shippingAddr_")) {
   
      var id = elem.id.split("_")[1];
      var pincode = $("#shippingPinCode" + id).val();
      console.log(pincode)
      $("#recieverZipCode").val(pincode);
      
      var zipCodeRegex = /^[1-9][0-9]{5}$/;
      var validAddr =  zipCodeRegex.test(pincode);

    } else if (elem.id == "shippingAddrCheck") {
    
      var validAddr = checkBillingAddress();

      $("#recieverZipCode").val(billingZipcode);
      $("#saveAddr").prop("checked", false);
      $("#newShippingAddr").prop("checked", false);
    } else if (elem.id == "newShippingAddr") {
    
      var validAddr = checkNewShippingAddress();
      $("#recieverZipCode").val(newShippingZipCode);
      $("#shippingAddrCheck").prop("checked", false);
      $("#saveAddr").prop("checked", false);
    } else {
     
      var validAddr = checkShippingAddress();
      $("#recieverZipCode").val(shippingingZipcode);
      $("#shippingAddrCheck").prop("checked", false);
      $("#newShippingAddr").prop("checked", false);
    }

    if (validAddr) {
        
        $('.newAddrCheck').prop('checked', false)
      // fetchEstimate();
      $(".orderInfo").text("");
      $("#paymentSeciton").show();
      // $("#paymentType1").change();
      fetchEstimate();
      // show payment btns and input
    } else {
      console.log('not')
      $(elem).prop("checked", false);
    }
  } else {
    $("#recieverZipCode").val("");
    // $("#shippingFee").html("Enter address to know shipping charge");

    $("#paymentSeciton").hide();
  }
}

$(".shippinad").each(function () {
  if ($(this).is(":checked")) {
    setVals(this);

    // alert('#shippingAddr_'+id);
  }
  $(".orderInfo").hide();
});

function setVals(elem) {
  $(".shipad").prop("checked", false);
  $("#shippingAddr_" + elem.id.split("_")[1]).prop("checked", true);
  $("#recieverZipCode").val($(elem).next().val());
  var itemTotal = $("#item_total_amount").text();

  $("#paymentSeciton").show();
  $("#paymentType1").change();
}

var shippingSelect = document.getElementsByName("shippingAddress");
// console.log(shippingSelect.length);

function fetchEstimate() {
    console.log('adf')
  if ($("#recieverZipCode").val() != "") {
    var shippingSelect = document.getElementsByName("shippingAddress");

    // get estimate
    $.ajax({
      url: "ajax/get_shipping_charge.php",
      type: "POST",
      data: {
        action: "getEstimate",
        destination_pincode: Number($("#recieverZipCode").val()),
        length: Number($("#productLengthInp").val()),
        breadth: Number($("#productWidthInp").val()),
        height: Number($("#productHeightInp").val()),
        weight: Number($("#productWeightInp").val()),
        shipment_type: $("#shipmentType").val(),
        shipment_mode: $("#shipmentMode").val(),
        shipment_value: $("#shipment_value").val(),
        destination_country_code: "IN",
        origin_country_code: "IN",
      },
      beforeSend: function () {
        $("#shippingFee").html(
          "<img src='asset/image/Loading_icon.gif' width='50px'/>"
        );
        $('.currencySign').hide();
      },
      success: function (data) {
          console.log(data)
        var res = JSON.parse(data);
        // SWLoader.close();
        $(".checkoutcartbtn").attr("disabled", false);
      
        
        html = "";
        var count = 1;

        if (res['err'] == "") {
        

          $("#shippingFee").html(res['price']);
          $('#shippingFeeInp').val(res['price']);
          $('.currencySign').show();

          // get minimum price

          var itemTotal = $("#item_total_amount").text();

          var tax = Number($("#CheckoutTaxSection").text());
          var discountprice = 0;
          if ($("#cprice").length) {
            var discountprice = parseFloat($("#cprice").text());
          }
          var totalAmount1 = Number(itemTotal) + tax - discountprice;

        } else {
          $("#shippingAddrCheck").prop("checked", false);
          $("#newShippingAddr").prop("checked", false);
          $("#saveAddr").prop("checked", false);
          $(".checkoutcartbtn").attr("disabled", true);
        //   $("#shippingFee").html("Enter address to know shipping charge");
          $('.currencySign').hide();
          showSnackbar("Delivery is not available for this pin code");
          $("#paymentSeciton").hide();
        }
      },
    });
  }
}
function number_format_js(number, decimals) {
    // Strip all characters but numerical ones.
    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
    var n = !isFinite(+number) ? 0 : +number,
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = ',',
        dec = '.',
        s = '',
        toFixedFix = function(n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
}


$(document).on("change", ".shipad", function () {
  if ($(this).attr("checked") == undefined) {
    var id = $(this).attr("id").split("_")[1];
    $(".shippinad").removeAttr("checked");

    $(".shippinad").each(function () {
      if (this.id == "shippingAddress_" + id) {
        $(this).prop("checked", true);

        setVals(this);
      }
    });
    // alert('#shippingAddr_'+id);
  } else {
    $(".shipad").removeAttr("checked");
    $("#recieverZipCode").val("");
    // $("#shippingFee").html("Enter address to know shipping charge");
    $('.currencySign').hide();

    $("#paymentSeciton").hide();
    $("#paymentType1").change();
  }
});
function showSnackbar(msg) {
  var x = document.getElementById("snackbar");
  x.innerHTML = msg;
  x.className = "show";
  setTimeout(function () {
    x.className = x.className.replace("show", "");
  }, 3000);
}

function checkBillingAddress() {
  var zipCodeRegex = /^[1-9][0-9]{5}$/;

  var elements = document.getElementsByName("newBillingAddressType");
  var isChecked = false;
  for (var i = 0; i < elements.length; i++) {
    if (elements[i].checked) {
      isChecked = true;
      break;
    }
  }

  if ($("input[name=newBillingAddressFirstName]").val() == "") {
    showSnackbar("please enter first name");
  } else if ($("input[name=newBillingAddressLastName]").val() == "") {
    showSnackbar("please enter last name");
  } else if ($("input[name=newBillingAddressPhone]").val() == "") {
    showSnackbar("please enter phone ");
  } else if ($("input[name=newBillingAddressEmail]").val() == "") {
    showSnackbar("please enter email ");
  } else if ($("input[name=newBillingAddressFlat]").val() == "") {
    showSnackbar("please enter flat ");
  } else if ($("input[name=newBillingAddressStreet]").val() == "") {
    showSnackbar("please enter street ");
  } else if ($("#newBillingAddressState").val() == "") {
    showSnackbar("please enter state ");
  } else if ($("input[name=newBillingAddressCity]").val() == "") {
    showSnackbar("please enter city 2");
  } else if ($("input[name=newBillingAddressZipCode]").val() == "") {
    showSnackbar("please enter zip ");
  } else if (!isChecked) {
    showSnackbar("please select address type");
  } else if (
    !zipCodeRegex.test($("input[name=newBillingAddressZipCode]").val())
  ) {
    showSnackbar("Please enter valid zip code");
  } else {
    return true;
  }
}

function checkShippingAddress() {
  var zipCodeRegex = /^[1-9][0-9]{5}$/;

  var elements = document.getElementsByName("newDifferentShippingType");
  var isChecked = false;
  for (var i = 0; i < elements.length; i++) {
    if (elements[i].checked) {
      isChecked = true;
      break;
    }
  }

  if ($("input[name=newDifferentShippingFirstName]").val() == "") {
    showSnackbar("Please enter first name");
  } else if ($("input[name=newDifferentShippingLastName]").val() == "") {
    showSnackbar("Please enter last name");
  } else if ($("input[name=newDifferentShippingPhone]").val() == "") {
    showSnackbar("Please enter mobile");
  } else if ($("input[name=newDifferentShippingEmail]").val() == "") {
    showSnackbar("Please enter email");
  } else if ($("input[name=newDifferentShippingFlat]").val() == "") {
    showSnackbar("please enter flat");
  } else if ($("input[name=newDifferentShippingStreet]").val() == "") {
    showSnackbar("Please enter street");
  } else if ($("#newDifferentShippingState").val() == "") {
    showSnackbar("Please enter state");
  } else if ($("input[name=newDifferentShippingCity]").val() == "") {
    showSnackbar("Please enter city");
  } else if (
    !zipCodeRegex.test($("input[name=newDifferentShippingZipCode]").val())
  ) {
    showSnackbar("Please enter valid zip code");
  } else if (!isChecked) {
    showSnackbar("please select address type");
  } else {
    var elem = document.getElementById("shippingAddress");
    if (elem == null) {
      if (checkBillingAddress() != true) {
        showSnackbar("Please fill all the fields in billing address");
      } else {
        return true;
      }
    } else {
      // check if address us chwecked
      if ($("input[name=shippingAddress]:checked").length == 0) {
        showSnackbar("Please select a billing address");
      }
    }
  }
}

function checkNewShippingAddress() {
  var zipCodeRegex = /^[1-9][0-9]{5}$/;

  var elements = document.getElementsByName("newShippingAddressType");
  var isChecked = false;
  for (var i = 0; i < elements.length; i++) {
    if (elements[i].checked) {
      isChecked = true;
      break;
    }
  }

  if ($("input[name=newShippingAddressFirstName]").val() == "") {
    showSnackbar("Please enter first name");
  } else if ($("input[name=newShippingAddressLastName]").val() == "") {
    showSnackbar("Please enter last name");
  } else if ($("input[name=newShippingAddressPhone]").val() == "") {
    showSnackbar("Please enter mobile");
  } else if ($("input[name=newShippingAddressEmail]").val() == "") {
    showSnackbar("Please enter email");
  } else if ($("input[name=newShippingAddressFlat]").val() == "") {
    showSnackbar("please enter flat");
  } else if ($("input[name=newShippingAddressStreet]").val() == "") {
    showSnackbar("Please enter street");
  } else if ($("#newShippingAddressState").val() == "") {
    showSnackbar("Please enter state");
  } else if ($("input[name=newShippingAddressCity]").val() == "") {
    showSnackbar("Please enter city");
  } else if (
    !zipCodeRegex.test($("input[name=newShippingAddressZipCode]").val())
  ) {
    showSnackbar("Please enter valid zip code");
  } else if (!isChecked) {
    showSnackbar("please select address type");
  } else {
      return true;
    // var elem = document.getElementById("shippingAddress");
    // console.log(elem);

    // var elem = document.getElementById("shippingAddress");
    // if (elem == null) {
    //   var t = 0;
    //   $(".shippinad").each(function () {
    //     if ($(this).is(":checked")) {
    //       t++;
    //       // alert('#shippingAddr_'+id);
    //     }
    //   });
    //   if (t == 0) {
    //     showSnackbar("Please fill all the fields in billing address");
    //   } else {
    //     return true;
    //   }
    // } else {
    //   if ($("input[name=shippingAddress]:checked").length == 0) {
    //     showSnackbar("Please select a billing address");
    //   } else {
    //     return true;
    //   }
    // }
  }
}

function selectPaymentType(elem) {
  $("#formMsg").html("");
  if (elem.value == "cod") {
    $(".cod").show();
    $(".pwc").hide();
    $("#paymen").hide();
    $("#coupanAppliedDiv").attr("style", "display: none!important;");
    $(".coupanCodeInput").prop("readonly", false);
    $("#coupanCodeButton").prop("disabled", false);
    $("#ErrMsg").html("");
    $("#ErrMsg").removeAttr("style");
    $("#coupanForm")[0].reset();
    var tax = Number($("#taxFee").text());
    var subtotal = Number($("#item_total_amount").text());
    if ($("#shippingAmount").text() != "") {
      var totalCost =
        Number($("#shippingAmount").text()) + Number(subtotal) + tax;
      $("#totalAmount").html(currency + parseFloat(totalCost).toFixed(2));
      $("#spanNew").text(parseFloat(totalCost).toFixed(2));
    }
    $("#shipmentType").val("C");
  } else if (elem.value == "pwc") {
    $(".pwc").show();
    $(".cod").hide();
    $("#paymen").show();

    $("#shipmentType").val("P");
  }
}

function selectPaymentMode(elem) {
  if (elem.value == "expressMode") {
    $("#shipmentMode").val("E");
  } else {
    $("#shipmentMode").val("S");
  }
}

$("input[name=courierCost]").on("change", function () {
  console.log("fasf");
  $("#shippingFee").text($("input[name=courierCost]:checked").val());
});

// function selectCourier(elem){

//     var itemTotal = $('#item_total_amount').text();
//     var shippingAmount = $(elem).val();
//     var totalAmount = Number(itemTotal) + Number(shippingAmount.replace(',', ''));

//     $('#shippingFee').html( '&#8377; <span id="shippingAmount">' + shippingAmount + '</span>');
//     $('#totalAmount').html('&#8377;'+totalAmount);
// }
//  keep radios checked by default
// document.getElementById("standardMode").defaultChecked;

$("#checkoutLoginOpen").on("click", function () {
  $(".toggleForm").hide();
});
