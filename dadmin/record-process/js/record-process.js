

function showAlert(msg) {
    $("#snackbarDefaultNew").html(msg);
    var x = document.getElementById("snackbarDefaultNew");
    x.className = "show";
    setTimeout(function () {
        x.className = x.className.replace("show", "");
    }, 3000);
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


function checkStock() {
    $.ajax({
        url: "ajax/checkStock.php",
        type: "POST",
        success: function (res) {
            console.log(res.status)
            var data = JSON.parse(res);
            console.log(data.oostatus)
            if (data.oostatus == 'outOfStock') {

                if (Number(data.leftItem) == 0) {
                    $('#modalProceedBtn').hide();
                }
                $('#modalTitle').text('Oops! Following Items Ran Out Of Stock')
                $('#showItems').html(data.html)
                $('#productModal').click();
            }
            else {
                window.location.href = 'checkout.php';
            }

        },
    });
}
$(".agentLoginForm").on('submit', function (e){
   
        e.preventDefault();
        var frm = $(this);
        var form = $(this)[0];
        var data = new FormData(form);
       
        $.ajax({
          type: 'POST',
          url: "ajax/agent.php",
          processData: false,
          contentType: false,
          async: false,
          cache: false,
          data: data,
          beforeSend: function () {
       
            $('body').css('pointer-events', 'none');
       
          },
          success: function (data) {
              data = JSON.parse(data)
              console.log(data)
            if (data.status == true) {
                showAlert(data.result);
                setTimeout(() => {
                    window.location.href  = 'agent/index.php';
                }, 1000);
            }
            if (data.status == false) {
                showAlert(data.result);
            }
          },
       
          complete: function (data) {
            $('body').css('pointer-events', 'auto');
          }
        });
})

$("#agentLoginForm3").on('submit', function (e){
    e.preventDefault();
    var frm = $('#agentLoginForm');
    var form = $('#agentLoginForm')[0];
    var data = new FormData(form);
    console.log('fas djf')
    $.ajax({
        url: 'ajax/agent.php',
        type : 'POST',
        data: data,
        success: function(data){
            console.log(data)
        }
    })
})

//add wishlist
function addToWishList(productId, divId, url) {

    console.log(url)
    let actionUrl = 'ajax/add-to-wish-list.php';
    console.log('formData');
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: { action: 'add', productId: productId, divId: divId, url: url },
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            if (data.status == 'Not LogIn') {
                Swal.fire({
                    title: "You are not logged in!",
                    text: "Please log in to continue.",
                    icon: "warning",
                    buttons: ["Cancel", "Log in"],
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "account.php?" + randomString(20) + "=" + randomString(20) + "&url=" + data.url + "&" + randomString(20) + "=" + randomString(20);
                    }
                });

            } else {
                url = "'" + url + "'";
                var html = '<li><a onclick="removeFromWishList(' + productId + ',this.id,' + url + ')" id="' + divId + '" title="Already Added"><i class="fa fa-heart" aria-hidden="true" style="background-color: white;padding: 8px;color: red;border-radius: 17px;               border: 1px solid #e0e0e0;font-size: 16px;"></i></a></li>';
                // console.log(html);
                if (currentPage == 'index.php' || currentPage == "") {
                    $('#hotWish_' + productId).html(html);
                    $('#newWish_' + productId).html(html);
                    $('#bestWish_' + productId).html(html);
                } else if (currentPage == 'product-detail.php') {
                    var html1 = '<li><a onclick="removeFromWishList(' + productId + ',this.id,' + url + ')" id="' + divId + '" title="Already Added" ><i class="fa fa-heart" aria-hidden="true" style="color: red;font-size: 18px;"></i> Already Added</a></li>';
                    console.log(html1);
                    $('.addWish').html(html1);
                    $('.' + divId).html(html);
                } else {
                    $('.' + divId).html(html);

                }
                var x = document.getElementById("snackbar1");
                x.className = "show";
                setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
            }

        }

    })

}


////////// Generate random String //////////
function randomString(length) {
    var result = '';
    var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    var charactersLength = characters.length;
    for (var i = 0; i < length; i++) {
        result += characters.charAt(Math.floor(Math.random() * charactersLength));
    }
    return result;
}
////////// Generate random String //////////



// remove wishlist

function removeFromWishList(productId, divId, url) {

    console.log(divId);
    confirmDialog('Are You sure! You want to remove?', function () {
        $("#confirmModal").modal('hide');
        actionUrl = 'ajax/add-to-wish-list.php';
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: { action: 'remove', productId: productId },
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                console.log(currentPage);
                $('#wishlistTable').load('dashboard.php #example2');
                url = "'" + url + "'";
                var html = '<li><a onclick="addToWishList(' + productId + ',this.id,' + url + ')" id="' + divId + '" data-toggle="tooltip" title="Add to Wishlist"><i class="d-icon-heart" style="background-color: white;padding: 8px;color: red;border-radius: 17px; border: 1px solid #e0e0e0;font-size: 16px;"></i></a></li>';
                if (currentPage == 'index.php' || currentPage == "") {
                    $('#hotWish_' + productId).html(html);
                    $('#newWish_' + productId).html(html);
                    $('#bestWish_' + productId).html(html);
                } else if (currentPage == 'product-detail.php') {
                    var html1 = '<li><a onclick="addToWishList(' + productId + ',this.id,' + url + ')" id="' + divId + '" title="Add Wish List" class="wishlist">Add to Wish List</a></a></li>';
                    $('.addWish').html(html1);
                    $('.' + divId).html(html);
                } else {
                    $('.' + divId).html(html);
                }
                $('.wishList').load(currentPage + ' #updateWishlist');
                $('#snackbar').html(data.result);
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);

            }

        })
    });
}



function addToCart(formId, classType) {
    console.log("adding...");
    formData = $("#" + formId).serialize() + "&action=" + "add";
    let actionUrl = 'ajax/addToCart.php'; 
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        beforeSend: function () {
            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function () {
                    Swal.showLoading();
                },
            });

            $("body").css("pointer-events", "none");
        },
        // dataType: 'json',
        success: function (data) {
            console.log(classType)
            data = JSON.parse(data);
            console.log(data);
            if (data.productId == "") {
                $('#descrip').html("Please Select " + classType);
                $('#alertBox').modal('show');

            } else {
                var divId = "'" + data.divId + "'";
                var className = "'" + classType + "'";
                var html = '<a href="cart.php" class="ed-addToCart btn btn-cart"  data-toggle="tooltip" title="Already Added">Go To Cart</a><span class="sicker cart-text btn btn-cart"><i class="fa fa-trash" onclick="removeFromCart(' + data.productId + ',' + divId + ',' + className + ')"></i></span>';
                if (currentPage == 'index.php' || currentPage == "") {
                    $('#hot_' + data.productId).html(html);
                    $('#new_' + data.productId).html(html);
                    $('#top_' + data.productId).html(html);
                } else {
                    $('.' + data.divId).html(html);
                }
                $(".cart-total").html(currency + data.cartSubTotalAmount + '<i class="fa fa-angle-down"></i></span>');
                $(".cart-add").html(data.totalItemInCart);
                        
                var url = 'header.php';
                $('#headerCart').load(url + ' #cartDiv');
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
            }

        },
        complete: function () {
            $("body").css("pointer-events", "auto");
            Swal.close();
        },

    })
}

// $(".addItemToCartModel").on("submit", function (e) {

//     e.preventDefault();

//     console.log("adding...");

// var formId=this.id;
// console.log(this.id);
//     formData = $("#"+formId).serialize() + "&action=" + "add";
//     let actionUrl = 'ajax/addToCart.php';
//      console.log(formData);
//     $.ajax({
//         url: actionUrl,
//         type: 'POST',
//         data: formData,
//         // dataType: 'json',
//         success: function (data) {
//             data = JSON.parse(data);
//             console.log(data);
//             if(data.productId=="")
//             {
//                 $('#descrip').html("Please Select Size");
//                  $('#alertBox').modal('show');

//             }
//             else
//             {
//             var divId="'"+data.divId+"'";
//             var html='<button class="button add-btn"  data-toggle="tooltip" title="Already Added" style="margin-right:61px;">Already Added</button><span class="sicker"><i class="fa fa-trash" onclick="removeFromCart('+data.productId+','+divId+')"></i></span>';
//             if(currentPage=='index.php' || currentPage=="")
//             {
//             $('#hot_'+data.productId).html(html);
//             $('#new_'+data.productId).html(html);
//             $('#top_'+data.productId).html(html);
//             }
//             else
//             {
//             $('.'+data.divId).html(html);
//             }
//             $(".cart-total").html('<i class="fa fa-rupee"></i>' + data.cartSubTotalAmount + '<i class="fa fa-angle-down"></i></span>');
//             $(".cart-add").html(data.totalItemInCart);
//              //please insert the url of the your current page here, we are assuming the url is 'index.php'          
//              var url = 'header.php';
//             $('.cart-dropdown').load(url+' #cartDiv');
//             var x = document.getElementById("snackbar");
//             x.className = "show";
//             setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
//            }

//         }

//     })

// });



/////////// Set Model Product Cart ID Value ///////////
function setModelProductId(id, div, type, classType) {
    console.log(type);
    console.log('addToCart' + div);
    console.log(id);
    $.ajax({
        url: 'ajax/checkIsCart.php',
        type: 'POST',
        data: { productId: id },
        beforeSend: function () {

            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function () {
                    Swal.showLoading()
                }
            });

        },
        success: function (data) {
            $('body').css('pointer-events', 'auto');
            swal.close();
            data = JSON.parse(data);
            console.log(data);
            console.log('#modelPrice' + div)
            if (data.dis == 0) {


                $('#modelPrice' + div).html('<span class="price-regular">' + currency + data.price + '</span>');

            } else {
                $('#modelPrice' + div).html('<span class="price-old">' + currency + data.price + '</span><span class="price-regular">' + currency + (data.dis) + '</span>');
            }
            $('#modelPer' + div).text(data.off + '% Off');
            var formId1 = "'addCart_" + div + "'";
            var className = "'" + classType + "'";


            if (!data.isCart) {
                var formId1 = "'addCart_" + div + "'";
                var className = "'" + classType + "'";
                var html = "";
                if (type != "") {
                    html += '<div id="' + type + '_' + id + '">';
                }
                html += '<button class="ed-addToCart btn btn-cart"  type="submit" data-toggle="tooltip" title="Add To Cart" onclick="addToCart(' + formId1 + ',' + className + ')">Add To Cart</button>';
                if (type != "") {
                    html += '</div>';
                }
                $('.addToCart' + div).html(html);

            } else {
                var divId = "'addToCart" + div + "'";
                var className = "'" + classType + "'";

                var html = "";
                if (type != "") {
                    html += '<div id="' + type + '_' + id + '">';
                }
                html += '<button class="ed-addToCart btn btn-cart"  data-toggle="tooltip" title="Already Added" style="margin-right:61px;">Already Added</button><span class="sicker"><i class="fa fa-trash" onclick="removeFromCart(' + id + ',' + divId + ',' + className + ')"></i></span>';
                if (type != "") {
                    html += '</div>';
                }
                $('.addToCart' + div).html(html);
            }

        }
    }),
        $("#modelProductId" + div).val(id);

}
/////////// Set Model Product Cart ID Value ///////////


// Remove Cart
function removeFromCart(productId, buttonClass, classType) {
    confirmDialog('Are You sure! You want to remove?', function () {

        actionUrl = 'ajax/addToCart.php';
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: { action: 'remove', productId: productId },
            // dataType: 'json',
            success: function (data) {
                data = JSON.parse(data);
                $(".cart-total").html(currency + data.cartSubTotalAmount + '<i class="fa fa-angle-down"></i></span>');
                $(".cart-add").html(data.totalItemInCart);
                var url = 'header.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                $('#headerCart').load(url + ' #cartDiv');
                var url = 'cart.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                $('.cartPage').load(url + ' #resetCart');
                $('.checkoutPage').load('checkout.php .innerCheckoutPage')


                var html = '<button class="ed-addToCart btn btn-cart"  data-toggle="tooltip" title="Add To Cart"  onclick="addToCart(' + formId1 + ',' + className + ');">Add To Cart</button>';


                if (window.location.href.includes('product-detail.php')) {
                    var proHtml = `<button class="quantity-button btn btn-cart2" type="submit" id="formId` + data.productId + `Button"><span>Add To Cart</span></button>`;

                    $(".btnDiv" + data.productId).html(proHtml);
                }
                else {

                    if (buttonClass != '')
                        var formId = buttonClass.split("addToCart")[1];
                    var formId1 = "'addCart_" + formId + "'";
                    var className = "'" + className + "'";

                    console.log(formId1);
                    var html = '<button class="ed-addToCart btn btn-cart"  data-toggle="tooltip" title="Add To Cart"  onclick="addToCart(' + formId1 + ',' + className + ');">Add To Cart</button>';
                    if (currentPage == 'index.php' || currentPage == "") {
                        $('#new_' + data.productId).html(html);
                        $('#hot_' + data.productId).html(html);
                        $('#top_' + data.productId).html(html);
                    } else {
                        $('.' + buttonClass).html(html);
                    }
                }

                // }
            }

        })
    });
}

//confirmBox

function confirmDialog(message, onConfirm) {
    var fClose = function () {
        $("#confirmModal").modal("hide");
    };
    $("#confirmMessage").empty().append(message);
    $("#confirmModal").modal('show');

    $("#confirmOk").unbind().one('click', onConfirm).one('click', fClose);
    $("#confirmCancel").unbind().one("click", fClose);
}
//search


// jquery searchbar function
$(document).ready(function($) {
    $("#search").keyup(function(e) {
        var key = e.keyCode;
        if (key == 40 || key == 38 || key == 13) {
            return false;
        }
        var str = $("#search").val();
        $.ajax({
            context: this,
            url: "ajax/search.php",
            type: "get",
            dataType: "html",
            data: "sid=" + str,
        }).done(function(response) {
            $("#autocomplete").html(response);
            $("#autocomplete").show();
        });
    });
});


// select suggested results using key up and down
$(".productSearch2").on("keydown", "#search", function(e) {
    var listItems = $(".autocomplete a");
    var key = e.keyCode,
        selected = listItems.filter(".selected"),
        current;

    if (key != 40 && key != 38 && key != 13) return;

    if (key == 40) {
        // Down key
        listItems.removeClass("selected");
        if (!selected.length || selected.is(":last-child")) {
            current = listItems.eq(0);
        } else {
            current = selected.next();
        }
        // console.log("Current : " + current);
    } else if (key == 38) {
        // Up key
        listItems.removeClass("selected");
        if (!selected.length || selected.is(":first-child")) {
            current = listItems.last();
        } else {
            current = selected.prev();
        }
    } else if (key == 13) {
        // Enter key
        current = listItems.filter(".selected");
        current[0].click();
        return false;
    }
    current.addClass("selected");
    // console.log(current);
    //    $('a.selected').scrollIntoView();
    $(".selected")[0].scrollIntoView({
        block: "end",
    });
});

function hidesearchdiv() {
    var x = document.getElementById("autocomplete");
    // var x = document.getElementById("autocomplete1");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function hidesearchdiva() {
    var x = document.getElementById("autocomplete");
    // var x = document.getElementById("autocomplete1");

    x.style.display = "block";
}

// for mobile
function searchbar1(str) {
    var xhttp = new XMLHttpRequest();
    // document.getElementById("autocomplete11").style.display = 'block';
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("autocomplete11").style.display = "block";
            document.getElementById("autocomplete11").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "ajax/search.php?sid=" + str, true);
    xhttp.send();
}

function hidesearchdiv1() {
    var x = document.getElementById("autocomplete11");
    // var x = document.getElementById("autocomplete1");
    if (x.style.display === "none") {
        x.style.display = "block";
    } else {
        x.style.display = "none";
    }
}

function hidesearchdiva1() {
    var x = document.getElementById("autocomplete11");
    // var x = document.getElementById("autocomplete1");

    x.style.display = "block";
}
/////// Product Search Functions ////////

//Fetch Price Range
/*----------------------------
    slider-range here
------------------------------ */
// $("#slider-range").slider({
//     range: true,
//     min: 0,
//     max: max,
//     values: [0, max],
//     slide: function(event, ui) {
//         $("#amount").val(currency + ui.values[0] + " - " + currency + ui.values[1]);

//         maxPrice = ui.values[1];
//         minPrice = ui.values[0];
//         pageNo = 1;

//         // event.preventDefault();
//         actionUrl = 'record-process/listing-products.php';
//         formData = $(this).serialize();
//         console.log(formData);
//         $.ajax({
//             url: actionUrl,
//             type: 'POST',
//             data: { priceRange: 'priceRange', maxPrice: maxPrice, minPrice: minPrice, pageNo: pageNo },
//             // dataType: 'json',
//             success: function(data) {
//                 data = JSON.parse(data);

//                 console.log(data);
//                 var url = 'listing.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
//                 $('.changeFilter').load(url + ' #filterProductId');
//                 $('#currentPage').val(pageNo);
//                 // $("#listingProducts").html(data.result);
//                 $('#totalPages').val(data.totalPages);
//                 $("#totalProducts").html(data.totalProducts);
//                 $("#recordFrom").html(data.recordFrom);
//                 $("#recordTo").html(data.recordTo);
//                 paginationBlocks(pageNo);

//             }

//         })


//     }
// });
// $("#amount").val(currency + ' ' + $("#slider-range").slider("values", 0) +
//     " - " + currency + ' ' + $("#slider-range").slider("values", 1));

/*----------------------------
    slider-range here
------------------------------ */

//////////// Order BY Listing Products /////////////
function orderBy(val) {
    pageNo = 1;
    console.log(val);
    actionUrl = 'record-process/listing-products.php';
    // formData = $(this).serialize();
    console.log('formData');
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: { orderByVal: val, pageNo: pageNo },
        // dataType: 'json',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            var url = window.location.href; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
            $('.changeFilter').load(url + ' #filterProductId');
            $('#currentPage').val(pageNo);
            // $("#listingProducts").html(data.result);
            $('#totalPages').val(data.totalPages);
            $("#totalProducts").html(data.totalProducts);
            $("#recordFrom").html(data.recordFrom);
            $("#recordTo").html(data.recordTo);
            paginationBlocks(pageNo);
        }

    })
}
//////////// Order BY Listing Products /////////////

//Fetch filter Producta
//////////// Filter Listing Products /////////////
function checkboxFilter(element, type, classtypeId) {
    pageNo = 1;
    condition = element.value;
    if(type== 'rating'){
        var value = $(element).attr('name').slice(12)
        if (element.checked) {
            action = 'addRating';
            
        } else {
            action = 'removeRating';
        }
    }
    else{
        value = '';
        if (element.checked) {
            action = 'addFilter';
        } else {
            action = 'removeFilter';
        }
    }
 

    // console.log(condition);
    console.log(action)

    console.log(condition);
    console.log(classtypeId);

    $.ajax({
        url: 'record-process/listing-products.php',
        type: 'POST',
        data: { action: action, type: type, condition: condition, pageNo: pageNo, classtypeId: classtypeId, value : value },
        // dataType: 'json',
        success: function (data) {
            // alert(data);
            data = JSON.parse(data);
            console.log(data);
            $('#currentPage').val(pageNo);
            // $("#listingProducts").html(data.result);
            $('#totalPages').val(data.totalPages);
            $("#totalProducts").html(data.totalProducts);
            $("#recordFrom").html(data.recordFrom);
            $("#recordTo").html(data.recordTo);
            var url = 'listing.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
            $('.changeFilter').load(url + ' #filterProductId');
            $('.filterSlider').load(url + ' #refreshSlider');
            paginationBlocks(pageNo);
        }

    })

};
//////////// Filter Listing Products /////////////

//Fetch pagination
////////// Pagination //////////
function paginationBlocks(block) {
    var list = "";
    var totalPage = $('#totalPages').val();
    var currentPage = $('#currentPage').val();

    // totalPage=10;
    // block=3

    if (totalPage < 6) {
        block = 3
    }
    block = parseInt(block);
    block_2 = block - 2;
    block_1 = block - 1;
    block1 = block + 1;
    block2 = block + 2;

    if (totalPage > 5) {

        if (block > 3) {
            list += '<li';
            list += ' class="previous" onclick="paginationBlocks(' + block_1 + ')"';
            list += '><a><<</a></li>';
        }

        if (block != 1) {

            if (block != 2) {
                list += '<li';
                list += (block_2 == currentPage) ? ' class="current"' : ' onclick="loadPage(' + block_2 + ')"';
                list += '><a>' + block_2 + '</a></li>';
            }


            list += '<li';
            list += (block_1 == currentPage) ? ' class="current"' : ' onclick="loadPage(' + block_1 + ')"';
            list += '><a>' + block_1 + '</a></li>';
        }




        list += '<li';
        list += (block == currentPage) ? ' class="current"' : ' onclick="loadPage(' + block + ')"';
        list += '><a>' + block + '</a></li>';

        if (block != totalPage) {

            list += '<li';
            list += (block1 == currentPage) ? ' class="current"' : ' onclick="loadPage(' + block1 + ')"';
            list += '><a>' + block1 + '</a></li>';

            if ((block + 1) != totalPage) {
                list += '<li';
                list += (block2 == currentPage) ? ' class="current"' : ' onclick="loadPage(' + block2 + ')"';
                list += '><a>' + block2 + '</a></li>';
            }
        }

        if ((block + 2) < totalPage) {
            list += '<li';
            list += ' class="next" onclick="paginationBlocks(' + block1 + ')"';
            list += '><a>>></a></li>';
        }
    } else {
        for (i = 1; i <= totalPage; i++) {
            list += '<li';
            list += (i == currentPage) ? ' class="current"' : ' onclick="loadPage(' + i + ')"';
            list += '><a>' + i + '</a></li>';
        }
    }


    $('#pagination-blocks').html(list);
}


function loadPage(pageNo) {
    console.log(pageNo);
    let actionUrl = 'record-process/listing-products.php';
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: { pageNo: pageNo },
        success: function (data) {
            console.log(data);
            data = JSON.parse(data);
            $('#currentPage').val(pageNo);
            // $("#listingProducts").html(data.result);
            $('#totalPages').val(data.totalPages);
            $("#totalProducts").html(data.totalProducts);
            $("#recordFrom").html(data.recordFrom);
            $("#recordTo").html(data.recordTo);
            var url = 'listing.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
            $('.changeFilter').load(url + ' #filterProductId');
            $('.filterSlider').load(url + ' #refreshSlider');
            paginationBlocks(pageNo);

        }
    })
}


$(document).ready(function () {
    paginationBlocks(3);
});


/////////// Set Product Cart ID Value ///////////
function setCartId(id) {
    $("#cartProductId").val(id);
}
/////////// Set Product Cart ID Value ///////////

/////////// Get Product By ID Value ///////////
function getProductById() {
    // console.log(randomString(15));
    productId = $("#cartProductId").val();
    window.location.href = "product-detail.php?" + randomString(20) + "=" + randomString(20) + "&product_id=" + productId + "&" + randomString(20) + "=" + randomString(20);
}
/////////// Set Product Cart ID Value ///////////

//Submit Review
$("#addReview").on("submit", function (e) {
    e.preventDefault();


    var productId = $('#reviewProductId').val();
    var formData = new FormData(this);

    let actionUrl = 'ajax/add-review.php';
    console.log(formData);
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function (data) {
            data = JSON.parse(data);
            if (data.status == 'logInErr') {
                window.location.href = "account.php?" + randomString(20) + "=" + randomString(20) + "&url=" + data.url + "&" + randomString(20) + "=" + randomString(20);
            } else {
                var url = data.url //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                console.log(url)
                $('.reviewDiv').load(url + ' #setReview');
                $('#addReview')[0].reset();
                $('#snackbar').html(data.result);
                $('#pageUrl').val(data.url)
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function () { x.className = x.className.replace("show", ""); window.location.reload() }, 3000);
                //  }
                $('#review_comment').val('');
            }
        }


    })

});


// ////////// Get Reviews Products ////////////
// function getReviews(productId) {

//     console.log(productId);
//     let actionUrl = 'record-process/get-reviews.php';
//     $.ajax({
//         url: actionUrl,
//         type: 'POST',
//         data: { productId: productId },
//         success: function (data) {
//             //  console.log(data);
//             $("#reviewsDiv").html(data);
//         }
//     })
// }
// ////////// Get Reviews Products ////////////

$(".addProductToCart").on("submit", function (e) {
    e.preventDefault();

    console.log("adding...");

    var fromId = this.id;

    formData = $("#" + fromId).serialize() + "&action=" + "add";
    console.log(formData);

    let actionUrl = 'ajax/addToCart.php';
    console.log('formData');
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        // dataType: 'json',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            var proHtml = `<div class="btnDiv` + data.productId + `">
                    <a href="cart.php" class="quantity-button btn btn-cart2" id="formId`+ data.productId + `Button"><span>Go To Cart</span></a>
                     <button type="button" class="quantity-button btn btn-cart2" onclick="removeFromCart(` + data.productId + `)"><i class="fa fa-trash"></i></button>
                    </div>`;



            $(".btnDiv" + data.productId).html(proHtml);


            // $("#" + fromId + "Button").html('Already Added');
            $(".cart-total").html(currency + data.cartSubTotalAmount + '<i class="fa fa-angle-down"></i></span>');
            $(".cart-add").html(data.totalItemInCart);
            var url = 'header.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
            $('#headerCart').load(url + ' #cartDiv');
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);

        }

    })

});

// Change cart quantity
/////////// On Change Item Quantity ///////////////
function changeItemQuantity(productId, quantity, size) {
    // console.log(productId);
    console.log(quantity);
    divId = "";
    let actionUrl = 'ajax/addToCart.php';
    // console.log('formData');
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: { action: 'add', productId: productId, quantity: quantity, productSize: size },
        beforeSend: function () {
            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function () {
                    Swal.showLoading();
                },
            });

            $("body").css("pointer-events", "none");
        },
        // dataType: 'json',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            var url = 'cart.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
            $('.cartPage').load(url + ' #resetCart');

            $(".cart-total").html(currency + data.cartSubTotalAmount + '<i class="fa fa-angle-down"></i></span>');
            $(".cart-add").html(data.totalItemInCart);
            var url = 'header.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
            $('#headerCart').load(url + ' #cartDiv');
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);

        },
        complete: function () {
            $("body").css("pointer-events", "auto");
            Swal.close();
        },

    })

}
/////////// On Change Item Quantity ///////////////


///////// Clear Cart //////////
function clearCart() {

    confirmDialog('Are You sure! You want to clear cart?', function () {
        let actionUrl = 'ajax/clearCart.php';
        $.ajax({
            url: actionUrl,

            success: function (data) {
                data = JSON.parse(data);

                console.log(data);
                 $('#cartCount').text('0')
                 console.log( $('#cartCount'))
                 console.log('jjjjjj')
                var url = 'cart.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                $('.cartPage').load(url + ' #resetCart');
                url = 'header.php';
                 $('#headerCart').load(url + ' #cartDiv');
                
                // $(".cart-total").html('<i class="fa fa-rupee"></i>' + data.cartSubTotalAmount + '<i class="fa fa-angle-down"></i></span>');
                // $(".cart-add").html(data.totalItemInCart);
                var url1 = 'header.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                $('.refreshDiv').load(url1 + ' #cartItemList');
                $('#snackbarDefault').html(data.result);
                var x = document.getElementById("snackbarDefault");
                x.className = "show";
                setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
            }
        })
    });
}
///////// Clear Cart //////////

//input validation For registration

$("input").keyup(function () {
    $("#" + this.name + "ErrMsg").html("<div class='err_msg' id='" + this.name + "ErrMsg'></div>");
});

$(".phone").on("keyup", function (e) {
    var phno = $(this).val();
    var regexPattern = /^[0-9]+$/; // regular expression pattern
    $text = regexPattern.test(phno);
    if (!$text || (phno.length < 10)) {
        $("#" + this.id + "ErrMsg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Please Enter only 10 digit number</div>");
        $('.userRegBtn').hide();
    } else {
        $('.userRegBtn').show();

    }

});


// $(".password").on("keyup", function (e) {
//     $(this).prop('type', 'password');
//     var value = $(this).val();
//     if (value != '') {
//         var regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
//         var isValid = regex.test(value);
//         if (!isValid) {
//             $('.userRegBtn').hide();
//             $("#" + this.id + "ErrMsg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Password must between 8 to 15 characters which contain at least one numeric digit,one special character, one uppercase and one lowercase letter</div>");
//         } else {
//             $('.userRegBtn').show();

//         }
//     }
// });
$(".password").on("keyup", function (e) {
    $(this).prop('type', 'password');
    var value = $(this).val();
    if (value != '') {
        var regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
        var isValid = regex.test(value);
        if (!isValid) {
            $('.userRegBtn').prop('disabled', true);
            $("#" + this.id + "ErrMsg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Password must be between 8 to 15 characters and contain at least one numeric digit, one special character, one uppercase, and one lowercase letter</div>");
        } else {
            $('.userRegBtn').prop('disabled', false);
            $("#" + this.id + "ErrMsg").empty();
        }
    }
});



$(".password").on("keyup", function (e) {
    confirmPasswordValidationFn();
});

$(".confirmPassword").on("keyup", function (e) {
    confirmPasswordValidationFn();
});
////////// Confirm Password Validation //////////
function confirmPasswordValidationFn() { // function START
    let password = $('.password').val();
    let rePassword = $('.confirmPassword').val();
    if (rePassword != '') {

        if (password == rePassword) {
            $('#confirmNewPasswordErrMsg').html('<span class="err_msg" id="confirmNewPasswordErrMsg"></span>');
        } else {
            $('#confirmNewPasswordErrMsg').html('<div class="err_msg" id="confirmNewPasswordErrMsg" style="color: tomato;">Password and confirm password fields do not match</div>');
        }
    }
} // function END




//Login/Register Submit from
//Edit Profile
//Change Password
var spinner = $("#loader");
$(".formSubmit").on("submit", function (e) {
    var fromId = this.id;
    e.preventDefault();
    spinner.show();
    actionUrl = "ajax/user.php";
    formData = $("#" + fromId).serialize();
    $.ajax({
        url: actionUrl,
        type: "POST",
        data: formData,
        beforeSend: function () {
            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function () {
                    Swal.showLoading();
                },
            });

            $("body").css("pointer-events", "none");
        },
        complete: function () {
            $("body").css("pointer-events", "auto");
            Swal.close();
        },
        success: function (data) {
            spinner.hide();
            data = JSON.parse(data);
            if (data.status == "failed") {
                for (var key in data.errMessage) {
                    $("#" + key + "ErrMsg").html("<div class='err_msg' id='" + key + "ErrMsg'>" + data.errMessage[key] + "</div>");

                }

                if (data.single_error_msg) {
                    title = data.single_error_msg;
                } else {
                    title = "Oops! Something went wrong and we couldn't process your request.";
                }

                // msg = data.result ? '' : "";
                // type = "info";
                // showAlert(title, msg, type);

                $(document).ready(function () {
                    try {
                        $("div[class='err_msg']")
                            .filter(function () {
                                return $(this).html().trim().length > 0;
                            })
                            .eq(0)
                            .each(function () {
                                $(this).scrollToCenter();
                            });
                    } catch (e) {
                        console.log("An error occurred: " + e.message);
                    }
                });
            } else {

                color = data.status == "formMsg" ? "#f00" : "#008000";
                $("#" + fromId + "Msg").html("<div style='color:" + color + ";' id='" + fromId + "Msg'>" + data.result + "</div>");

                if (data.status == "registered" || data.status == "notVerified") {
                    $(".account1").hide();

                    if ($("#" + fromId).serialize().includes('changePassword')) {
                        $("#userInfo1").val(data.emailId);
                    }


                    if ('emailId' in data && data.emailId !== undefined) {
                        $("#userInfo").val(data.emailId);
                    } else if ('mobileNumber' in data && data.mobileNumber !== undefined) {
                        $("#userInfo").val(data.mobileNumber);
                    } else {
                        alert("User Info not found");
                    }


                    $("#checkout-login").attr("style", "display:none");
                    $("#checkout_signup").attr("style", "display:none");
                    if (document.getElementById("checkout_login")) {
                        $("#checkout_login").attr("style", "display:none");
                    }
                    if (document.getElementById("you_are_not_login_section")) {
                        $("#you_are_not_login_section").attr("style", "display:none");
                    }
                    $(".otpVerify").attr("style", "display:block");
                    timer(60);

                    Swal.fire({
                        title: "Verify you Email",
                        html: "We've sent and email to verify your email address and activate your account. The link in the email will expire in 24 hours.",
                        showCancelButton: true,
                        type: "info",
                        icon: "info",
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        showCancelButton: false,
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            $("#otpform").scrollToCenter();
                        }
                    });

                    // $('#checkout_login').hide();
                    // $('#checkout_signup').hide();
                }

                if (data.status == "otpSent") {
                    $("body").css("pointer-events", "auto");
                    Swal.close();
                    $("#userInfo").val(data.emailId);
                    $(".otpVerify").css("display", "block");
                    $('#changePass').css('dispaly', 'none')
                    timer(60);
                    $("html, body").animate({
                        scrollTop: $(".otpVerify").offset().top,
                    },
                        1000
                    );
                    $('#changePassMsg').html('')
                }
                  if(data.status == 'otpNotSent'){
                    $('#confirmNewPasswordErrMsg').html(data.result);
                }

                if (data.status == "logIn") {
                    if (data.url == "reload") {
                        location.reload();
                    } else {

                        window.location.href = data.url;
                    }
                }



            }
        },

    });
});

///////// Update Address Book //////////
function updateAddressBook() {
    console.log("asasas");

    let actionUrl = 'record-process/address-book.php';
    $.ajax({
        url: actionUrl,

        success: function (data) {
            console.log(data);
            $("#shippingAddresses").html(data);
        }
    })
}
///////// Update Address Book //////////

$(document).on('click', '#changePAsswordButton', function () {
    $('#verifyOtpFormMsg').text('')
})

$("#verifyOtpFormDash").on("submit", function (e) {
    e.preventDefault();

    $('#passInp').val($('#newPassword').val());
    $("#cPassInp").val($('#confirmNewPassword').val());

    actionUrl = "ajax/newPassword.php";
    formData = $("#verifyOtpFormDash").serialize();
    console.log(formData);
    $.ajax({
        url: actionUrl,
        type: "POST",
        data: formData,
        // dataType: 'json',
        beforeSend: function () {

            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function () {
                    Swal.showLoading()
                }
            });

            $('body').css('pointer-events', 'none');

        },
        success: function (data) {
            data = JSON.parse(data);
            console.log('sjgoisa')
            $('#changePassMsg').html('')

            color = data.status == "failed" ? "#f00" : "#008000";
            $("#verifyOtpFormMsg").html(
                "<div style='color:" +
                color +
                ";' id='verifyOtpFormMsg'>" +
                data.message +
                "</div>"
            );

            if (data.status) {

                $('.passMsg').html('')
                $('.otpVerify').hide();
                $('#changePass').trigger('reset')
                $('#changePass').css('display', 'block')
            }
            // $('#verifyOtpForm')[0].reset();

            $(".codeBox").val("");

            if (data.message == "") {
                data.message = "Error Occur please try again!";
            }
            //  $('#dashboardBtn').click();
            $('.clickmedash').removeClass('active')
            $('a[aria-controls=account-details]').addClass('active');
            $('.tab-content').removeClass('active');
            $('#account-details').addClass('active');

            $("#snackbarDefault").html(data.message);
            var x = document.getElementById("snackbarDefault");
            x.className = "show";
            setTimeout(function () {
                x.className = x.className.replace("show", "");
            }, 3000);

        },
        complete: function () {

            $('body').css('pointer-events', 'auto');
            swal.close();

        },
    });
});


////////// Timer Count Down ////////////
let timerOn = true;

function timer(remaining) {
    var m = Math.floor(remaining / 60);
    var s = remaining % 60;

    m = m < 10 ? '0' + m : m;
    s = s < 10 ? '0' + s : s;
    document.getElementById('timer').innerHTML = m + ':' + s;
    remaining -= 1;

    if (remaining >= 0 && timerOn) {
        setTimeout(function () {
            timer(remaining);
        }, 1000);
        return;
    }

    if (!timerOn) {
        // Do validate stuff here
        return;
    }

    // Do timeout stuff here


    $('#timer').html('<a onClick="resendOTP();">Resend OTP</a>');


}
////////// Timer Count Down ////////////

$("#verifyOtpForm").on("submit", function (e) {

    e.preventDefault();
    actionUrl = 'ajax/verify-otp.php';
    formData = $("#verifyOtpForm").serialize();
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        // dataType: 'json',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);

            color = (data.status == 'failed') ? '#f00' : '#008000';

            $("#verifyOtpFormMsg").html("<div style='color:" + color + ";' id='verifyOtpFormMsg'>" + data.message + "</div>");

            $('.codeBox').val('');

            if (data.message == "") {
                data.message = 'Error Occur please try again!'
            }
            $('#snackbarDefault').html(data.message);
            var x = document.getElementById("snackbarDefault");
            x.className = "show";
            setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);

            if (data.status == 'success') {

                $('.account1').show();
                $('.otpVerify').hide();
                if (data.redirect == 1) {
                    window.location.href = data.url;
                } else {
                    window.location.reload();
                }

            }
        }
    })
});

function resendOTP() {
    userInfo = $('#userInfo').val();
    let actionUrl = 'ajax/re-send-otp.php';
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: { userInfo: userInfo },
        success: function (data) {
            timer(60);
        }
    })

}




function removeCoupan(value) {
    actionUrl = "ajax/remove-coupan.php";
    $.ajax({
        url: actionUrl,
        type: "POST",
        // dataType: 'json',
        beforeSend: function () {

            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function () {
                    Swal.showLoading()
                }
            });

            $('body').css('pointer-events', 'none');

        },
        success: function (data) {
            data = JSON.parse(data);
            console.log(data)

            $("#coupanAppliedDiv").attr('style', 'display: none!important;');
            $(".coupanCodeInput").prop("readonly", false);
            $("#coupanCodeButton").prop("disabled", false);
            $("#ErrMsg").html('');
            $("#ErrMsg").removeAttr('style');
            $('#coupanForm')[0].reset();
            // var CheckoutTaxSection = $('#CheckoutTaxSection').text();
            $('#CheckoutTaxSection').text(data.gst);
            var totalPriceVar = parseFloat(data.totalPrice) + parseFloat(data.gst);
            $("#totalAmount").html(currency + totalPriceVar);

        },
        complete: function () {

            $('body').css('pointer-events', 'auto');
            swal.close();

        },
    });

}

$("#coupanForm").on("submit", function (e) {
    e.preventDefault();
    actionUrl = "ajax/apply-coupan.php";
    formData = $("#coupanForm").serialize();
    $.ajax({
        url: actionUrl,
        type: "POST",
        data: formData,
        beforeSend: function () {
            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function () {
                    Swal.showLoading();
                },
            });

            $("body").css("pointer-events", "none");
        },
        success: function (data) {
            data = JSON.parse(data);
            color = data.status == "failed" ? "#f00" : "#008000";
            $("#ErrMsg").html("<div class='err_msg' style='color:" + color + ";' id='formMsg'>" + data.message + "</div>");

            if (data.status == "success") {
                $("#ErrMsg").attr('style', 'border: 1px solid #eed177!important;background: #eee3c0!important;padding: 10px;');
                $("#ErrMsg").html('Coupon Applied <b>' + $('input[name=coupanCode]').val() + '</b>   <span style="text-align: right;font-weight: 500;cursor: pointer; color: #ffffff;   background-color: #ed3237;font-size: 13px;padding: 4px 10px;border-radius: 12px;" onclick="removeCoupan(' + data.savePrice + ')">Remove</a>');
                $(".coupanCodeInput").prop("readonly", true);
                $("#coupanCodeButton").prop("disabled", true);
                $("#coupanAppliedDiv").show();
                $("#coupanAppliedDiv").html("<h4>Coupon Applied <b>(Save)</b></h4> <h4 id='cprice' class='price'>- " + currency + number_format_js(data.savePrice, 2) + "</h4>");
                $('#couponAmount').val(number_format_js(data.gst,2));
                var CheckoutTaxSection = $('#CheckoutTaxSection').text(number_format_js(data.gst, 2));
                var totalPriceVar = number_format_js(data.totalPrice + 100, 2)  ;
                $("#totalAmount").html(currency + totalPriceVar );
            }
        },
        complete: function () {
            $("body").css("pointer-events", "auto");
            Swal.close();
        },
    });
});

// temperary data session

$("#loginbtnmdl").on("click", function (e) {
    e.preventDefault();
    actionUrl = "ajax/temp_data.php";
    formData = $("#placeOrder,#addressDetailsForm,#coupanForm").serialize();
    $.ajax({
        url: actionUrl,
        type: "POST",
        data: formData,
        // dataType: 'json',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
        },
    });
});

// payment method
$("input[name=paymentmethod]").on("change", function () {
    console.log("changed");
    var payMethod = $(this).val();
    $("#paymentMethodInp").val(payMethod);
});


function clickPaybutton() {
    console.log("thisfd ");

    console.log($("#buyAsGuest").val());
    if ($("#buyAsGuest").val() == "true") {
        console.log("checked");
        if ($("input[name=newDifferentShippingFirstName]").val() == "") {
            $("input[name=newDifferentShippingFirstName]").val($("input[name=newBillingAddressFirstName]").val());
        }
        if ($("input[name=newDifferentShippingLastName]").val() == "") {
            $("input[name=newDifferentShippingLastName]").val($("input[name=newBillingAddressLastName]").val());
        }
        if ($("input[name=newDifferentShippingPhone]").val() == "") {
            $("input[name=newDifferentShippingPhone]").val($("input[name=newBillingAddressPhone]").val());
        }
        if ($("input[name=newDifferentShippingEmail]").val() == "") {
            $("input[name=newDifferentShippingEmail]").val($("input[name=newBillingAddressEmail]").val());
        }
    }

    $("#pymentMethodForm").submit();
}


//Order Placed
$("#paySubmitButton").on("click", function () {

    var radioInps = document.getElementsByName('shippingAddress');
    var addrcount = 0;
    radioInps.forEach(element => {
        if (element.checked) {
            addrcount++;
        }
    });

    var newAddrCheck = document.querySelector('.newAddrCheck ');
    console.log(newAddrCheck)
    if (newAddrCheck != null) {
        if (newAddrCheck.checked) {
            addrcount++;
        }

        if (addrcount > 0) {
            $("#testbtn").click();
        }
        else {
            showAlert("Please select an address");
        }

    }
    else {
        $("#testbtn").click();
    }

});




function checkStock() {
  $.ajax({
    url: "ajax/checkStock.php",
    type: "POST",
    success: function (res) {
      // // console.log(res.status)
      var data = JSON.parse(res);
      //   // console.log(data.oostatus)
      if (data.oostatus == "outOfStock") {
        if (Number(data.leftItem) == 0) {
          $("#modalProceedBtn").hide();
        }
        $("#modalTitle").text("Oops! Following Items Ran Out Of Stock");
        $("#showItems").html(data.html);
        $("#productModal").click();
      } else {
        window.location.href = "checkout.php";
      }
    },
  });
}




$(document).on("click", "#testbtn", function (e) {
    console.log('clicked')
    e.preventDefault();

    $("#paySubmitButton").attr("disabled", true);
    actionUrl = "ajax/checkout-cb.php";
    formData = $("#placeOrder,#addressDetailsForm,#coupanForm,#pymentMethodForm, #shippingDetails").serialize();
    console.log(formData)

    // return false;
    $.ajax({
        url: actionUrl,
        type: "POST",
        data: formData,
        // dataType: 'json',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data)
            $("#paySubmitButton").removeAttr("disabled");
            // console.log(data);

            if (data.status == "inputErr") {
                var r = 0;
                for (var key in data.errMessage) {
                    if (key == "newBillingAddressType") {
                        title = "";
                        msg = data.errMessage[key];
                        type = "info";
                        // showAlert(title, msg, type);
                    } else {
                        $("#" + key + "ErrMsg").html("<div class='err_msg' id='" + key + "ErrMsg'>" + data.errMessage[key] + "</div>");
                    }
                    if(r==0){
                        scrollToElement(key + "ErrMsg");
                    }
                    r++;
                }

                $(document).ready(function () {
                    try {
                        $("div[class='err_msg']")
                            .filter(function () {
                                return $(this).html().trim().length > 0;
                            })
                            .eq(0)
                            .each(function () {
                                $(this).scrollToCenter();
                            });
                    } catch (e) {
                        console.log("An error occurred: " + e.message);
                    }
                });
            } else if (data.status == "failed") {
                title = "";
                msg = data.result;
                type = "info";
                showAlert(msg);
            } else {
                if (data.oostatus == '') {
                    if (data.status == "cod") {
                        title = "Success";
                        msg = data.result;
                        type = "info";
                        // showAlert(title, msg, type);

                        setTimeout(() => {
                            window.location.href = "order-completed.php?" + randomString(20) + "=" + randomString(20) + "&id=" + data.orderId + "&" + randomString(20) + "=" + randomString(20);
                        }, 1000);
                    }
                      else if (data.status == "razorpay") {
                        var amount = Math.ceil(data.razorpayData.TXN_AMOUNT);
              
                        var options = {
                          key: "rzp_test_A5lbfSFdrwylFL",
                          amount: amount * 100 ,
                          currency: "INR",
                          name: "MSG",
                          description: "Order Transaction",
                          image: "https://micodetest.com/gogo-shoppers/asset/image/logo/logo.png",
                          handler: function (response) {
                            // console.log(response);
                            // return false;
                            jQuery.ajax({
                              type: "post",
                              url: "ajax/update_order.php",
                              data: {
                                orderId: data.orderId,
                                txn_id: response.razorpay_payment_id,
                                action: "updateTxn",
                              },
                              beforeSend: function () {
                                $("#loader").fadeIn(300);
                              },
                              complete: function () {
                                $("#loader").fadeOut(300);
                              },
                              success: function (data2) {
                                data2 = JSON.parse(data2);
              
                                console.log(data2);
                                if (data2.status) {
                                  window.location.href =
                                    "order-completed.php?" +
                                    randomString(20) +
                                    "=" +
                                    randomString(20) +
                                    "&id=" +
                                    data.orderId +
                                    "&" +
                                    randomString(20) +
                                    "=" +
                                    randomString(20);
                                } else {
                                  swicon = "warning";
                                  msg = data.message;
                                  srbSweetAlret(msg, swicon);
                                }
                              },
                            });
                          },
                          prefill: {
                            name: data.vendorName,
                            email: data.vendorEmailId,
                            contact: data.vendorMob,
                          },
                          theme: {
                            color: "#3399cc",
                          },
                        };
                        var rzp1 = new Razorpay(options);
                        rzp1.open();
                      }
                } else {
                    if (Number(data.leftItem) == 0) {
                        $('#modalProceedBtn').hide();
                    }
                    $('#modalTitle').text('Oops! Following Items Ran Out Of Stock')
                    $('#showItems').html(data.html)
                    $('#productModal').click();
                }

            }
        }
    });


});

function loginWithOtp() {

    mobileNumber = $('#logInMobileNumber').val();
    if (mobileNumber != "") {
        $('#logInPassword').val('LogInWithOTP');
        $('#lg_btn').click();
    } else {
        $('#logInMobileNumberErrMsg').html('Please Enter Mobile Number!');
    }

}

//address
function removeAddress(addressId) {

    confirmDialog('Are You sure! You want to remove?', function () {
        // var x = confirm('Are you sure?');
        // if (x == true) {
        $("#confirmModal").modal('hide');
        actionUrl = 'ajax/address.php';
        // console.log('formData');
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: { action: 'remove', addressId: addressId },
            // dataType: 'json',
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);
                $('#snackbarDefault').html(data.result);
                var x = document.getElementById("snackbarDefault");
                x.className = "show";
                setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
                $('.myaccount-address').load('dashboard.php  #changeAddress');
                //updateAddressBook();
            }
        })
    });
}



function editAddress(addressId) {
    actionUrl = 'ajax/address.php';

    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: { action: 'edit', addressId: addressId },
        // dataType: 'json',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            $("#new_address_form").attr("style", "display:block");
            $("#shippingAddress").val('edit');
            $("#shippingAddressId").val(data.id);
            $("#newAddressType").val(data.type);
            $("#newAddressFirstName").val(data.firstName);
            $("#newAddressLastName").val(data.lastName);
            $("#newAddressFlat").val(data.flat);
            $("#newAddressStreet").val(data.street);
            $("#newAddressLocality").val(data.locality);
            $('input[type="radio"][value="' + data.type + '"]').prop('checked', true);
            //  $('#addNewAddressButton').text('Edit Address')
            $('.editBtn').remove();
            $('#addrBtns').append('<a href="javascript:;" id="addNewAddressButton" class="btn btn-sqr editBtn">Edit Address</a>')
            $('input[type="radio"][value="' + data.type + '"]').prop('checked', true);


            $("#newAddressState").val(data.state);
            $("#newAddressState").trigger('change');
            $("#newAddressCity").val(data.city);
            $("#newAddressZipCode").val(data.zipCode);
            $("#newAddressMobile").val(data.phone);
            $("#newAddressEmail").val(data.email);

            //$("#addNewAddressButton").click();
            scrollToElement('new_address_form') 

        }
    })
}


function scrollToElement(id) {
    // Get the reference to the element you want to scroll to
    const targetElement = document.getElementById(id);
  
    // Scroll the element into view
    targetElement.scrollIntoView({
      behavior: "smooth", // You can set this to 'auto' for instant scrolling
      block: "start", // Scroll to the top of the element
      inline: "nearest", // Scroll to the nearest edge of the element
    });
  }

$("#new_address_form").on("submit", function (e) {
    e.preventDefault();
    actionUrl = 'ajax/user.php';
    formData = $("#new_address_form").serialize();
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        // dataType: 'json',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            if (data.status == 'failed') {

                for (var key in data.errMessage) {
                    $("#" + key + "ErrMsg").html("<div class='err_msg' id='" + key + "ErrMsg'>" + data.errMessage[key] + "</div>");
                    console.log(key);

                }
            } else {
                color = (data.status == 'formMsg') ? '#f00' : '#008000';
                $("#new_address_formMsg").html("<div style='color:" + color + ";' id='new_address_formMsg'>" + data.result + "</div>");

                $('#snackbarDefault').html(data.result);
                var x = document.getElementById("snackbarDefault");
                x.className = "show";
                setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
                $('.myaccount-address').load('dashboard.php  #changeAddress');

                $("#new_address_form")[0].reset();
                if (data.status == 'success') {
                    $("#new_address_form").attr("style", "display:none");
                    $('.myaccount-address').scrollToCenter();
                    $('.editBtn').css('display', 'block')
                }

            }
        }

    })
});


$("#cancelOrder").on("submit", function (e) {

    e.preventDefault();
    
     $.ajax({
      url : 'ajax/cancel-order.php',
    //   dataType : "JSON",
      type: 'POST',
      data : {
          orderId :$('#orderid').val(),
          action : 'fetchOD',
      },
      success : function (data){
          data = JSON.parse(data)
          html = data.html;
    

    confirmDialog('Are You sure! You want to cancel order?' + html, function () {
        actionUrl = 'ajax/cancel-order.php';
        formData = $("#cancelOrder").serialize();
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            // dataType: 'json',
            success: function (data) {
                data = JSON.parse(data);
                console.log(data);

                location.reload();
            }

        })
    });
  }
 });
});
////////// Cancel Order ///////////

//Contact Form Submit

$("#contactFormSubmit").on("submit", function (e) {
    e.preventDefault();
    actionUrl = 'ajax/contact-form.php';
    formData = $(this).serialize();

    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        // dataType: 'json',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);
            if (data.status == 'inputErr') {

                for (var key in data.errMessage) {
                    $("#" + key + "ErrMsg").html("<div class='err_msg' id='" + key + "ErrMsg'>" + data.errMessage[key] + "</div>");

                }
            } else {
                $('#snackbarDefault').html(data.result);
                var x = document.getElementById("snackbarDefault");
                x.className = "show";
                setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
                $("#contactFormSubmit")[0].reset();

            }
        }

    })
});

//For subscribe
$("#subscribeForm").on("submit", function (e) {
    e.preventDefault();

    formData = $(this).serialize();

    let actionUrl = 'ajax/add-subscribe.php';
    console.log('formData');
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        // dataType: 'json',
        success: function (data) {
            data = JSON.parse(data);
            console.log(data);

            $('#snackbar').html(data.result);
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
            //  }
            $('#mc-email').val('');
        }


    })

});

$('input[name=jack]').on('click', function () {

    if ($('.newAddrCheck').is(":checked")) {
        $('.newAddrCheck').click();
        $(this).click()
    }
});
function checkNewAddr(elem){
    console.log('afd')
    var radios = document.querySelectorAll('.shipad');
   
    radios.forEach(element => {
        element.checked = false
    });
    
    $(".different_address").removeAttr("style");
    
    if($(elem).is(":checked")) {
        $(".different_address").show(300);
       
    } else {
        $(".different_address").hide(200);
    }

}
// $(document).on('click', 'newAddrCheck',function () {
//     // $('input[name=jack]').uncheck

// consol.log('afd')
//     var radios = document.getElementsByName('shipad');
   
//     radios.forEach(element => {
//         element.checked = false
//     });



// })

$('#newShippingAddressState').on('change', function () {
    console.log($('#newShippingAddressStateErrMsg').val());

    if ($('#newShippingAddressStateErrMsg').val() != '') {
        $('.stt_err').html('')
    }

})

// $('.difadre').on('click', function(){
//     $('.newAddrCheck').click()
// })

$(document).ready(function () {
    var txtArea = $('#message');
    var chars = $('#charsrb');
    var textMax = txtArea.attr('maxlength');

    chars.html(textMax + ' /3600');

    txtArea.on('keyup', countChar);

    function countChar() {
        var textLength = txtArea.val().length;
        var textRemaining = textMax - textLength;
        chars.html(textRemaining + ' / 3600');
    };
});

$("#newBillingAddressState").on('change', function () {
    $("#newBillingAddressStateErrMsg").html('')
})

$('#newShippingAddressState').on('change', function () {
    $('#newShippingAddressStateErrMsg').html('')
})
$(document).on('change', '#newAddressState', function () {
    if ($('#newAddressState').val() != '') {
        $('#newAddressStateErrMsg').html('')
    }
})
$(document).on('click', '.addnewadres', function () {

    $("#newAddressFirstName").scrollToCenter();

    //  $('[class*="ErrMsg"]').html('');

    if ($('.addressfrm').css('display') == 'none') {
        //   window.scrollTo(0, document.body.scrollHeight);
    }

})
$(document).on('change', 'input[name="newAddressType"]', function () {
    $('#newAddressTypeErrMsg').html('')
})

$(document).on('keydown', '.itemQuantity', function (e) {
    if (e.which != 38 || e.which != 40) {
        return false;
    } //Forward slash /
})
function addNewAddr() {
    $('#new_address_form').trigger('reset')
    $('.editBtn').css('display', 'none')
}

$(function()
{
    $("input[name=itemQuantity]").on('keydown',function(e) {
           
            e.preventDefault();
            return false; 
      
    });
});



function increaseQuantity(button) {
    let quantity = Number($(button).prev().val());
    let max = Number($(button).prev().attr('max'));
    console.log('max is ' + max)
    console.log('quantity is ' + quantity)
    if (max > quantity) {
        quantity++;
        $(button).prev().val(quantity);
        $(button).prev().change();
    }
    else {
        $('#alertMessage').html("Can't add more than " + max + " items.");
        $("#alertModal").addClass("show").show();
    }
}

function decreaseQuantity(button) {
    let quantity = Number($(button).next().val());
    let min = $(button).next().attr('min');
    if (min < quantity) {
        let n = quantity - 1;
        $(button).next().val(n);
        $(button).next().change();
    }
    else {
        $('#alertMessage').html("Can't add less than " + min + " items.");
        $("#alertModal").addClass("show").show();
    }
}