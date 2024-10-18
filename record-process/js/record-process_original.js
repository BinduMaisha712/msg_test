//add wishlist
function addToWishList(productId, divId, url) {

    console.log(url)
    let actionUrl = 'ajax/add-to-wish-list.php';
    console.log('formData');
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: { action: 'add', productId: productId, divId: divId, url: url },
        success: function(data) {
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
                var html = '<li><a onclick="removeFromWishList(' + productId + ',this.id,' + url + ')" id="' + divId + '" title="Already Added"><i class="fa fa-heart" aria-hidden="true"></i></a></li>';
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
                setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);
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
    confirmDialog('Are You sure! You want to remove?', function() {
        $("#confirmModal").modal('hide');
        actionUrl = 'ajax/add-to-wish-list.php';
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: { action: 'remove', productId: productId },
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                console.log(currentPage);
                url = "'" + url + "'";
                var html = '<li><a onclick="addToWishList(' + productId + ',this.id,' + url + ')" id="' + divId + '" data-toggle="tooltip" title="Add to Wishlist"><i class="pe-7s-like"></i></a></li>';
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
                setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);

            }

        })
    });
}



function addToCart(formId, classType) {
    console.log("adding...");
    formData = $("#" + formId).serialize() + "&action=" + "add";
    let actionUrl = 'ajax/addToCart.php';
    console.log(formData);
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        beforeSend: function() {
            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function() {
                    Swal.showLoading();
                },
            });

            $("body").css("pointer-events", "none");
        },
        // dataType: 'json',
        success: function(data) {
            console.log(classType)
            data = JSON.parse(data);
            console.log(data);
            if (data.productId == "") {
                $('#descrip').html("Please Select " + classType);
                $('#alertBox').modal('show');

            } else {
                var divId = "'" + data.divId + "'";
                var className = "'" + classType + "'";
                var html = '<button class="ed-addToCart btn btn-cart"  data-toggle="tooltip" title="Already Added" style="margin-right:61px;">Already Added</button><span class="sicker"><i class="fa fa-trash" onclick="removeFromCart(' + data.productId + ',' + divId + ',' + className + ')"></i></span>';
                if (currentPage == 'index.php' || currentPage == "") {
                    $('#hot_' + data.productId).html(html);
                    $('#new_' + data.productId).html(html);
                    $('#top_' + data.productId).html(html);
                } else {
                    $('.' + data.divId).html(html);
                }
                $(".cart-total").html(currency + data.cartSubTotalAmount + '<i class="fa fa-angle-down"></i></span>');
                $(".cart-add").html(data.totalItemInCart);
                //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                var url = 'header.php';
                $('.cart-dropdown').load(url + ' #cartDiv');
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);
            }

        },
        complete: function() {
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
            beforeSend: function() {

                Swal.fire({
                    title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                    html: "Request under processing, please do not lock the screen or leave the page.",
                    showCancelButton: false,
                    showConfirmButton: false,
                    onOpen: function() {
                        Swal.showLoading()
                    }
                });

            },
            success: function(data) {
                $('body').css('pointer-events', 'auto');
                swal.close();
                data = JSON.parse(data);
                console.log(data);
                if (data.dis == 0) {
                    $('#modelPrice' + div).html('<span class="font-lg-bold color-brand-3 price-main">' + currency + data.price + '</span>');

                } else {
                    $('#modelPrice' + div).html('<span class="font-lg-bold color-brand-3 price-main">' + currency + (data.dis) + '</span><span class="price-old color-gray-500 price-line">' + currency + data.price + '</span>');
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
    confirmDialog('Are You sure! You want to remove?', function() {

        actionUrl = 'ajax/addToCart.php';
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: { action: 'remove', productId: productId },
            // dataType: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                $(".cart-total").html(currency + data.cartSubTotalAmount + '<i class="fa fa-angle-down"></i></span>');
                $(".cart-add").html(data.totalItemInCart);
                var url = 'header.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                $('.cart-dropdown').load(url + ' #cartDiv');
                var url = 'cart.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                $('.cartPage').load(url + ' #resetCart');
                $('.checkoutPage').load('checkout.php .innerCheckoutPage')
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

                // }
            }

        })
    });
}

//confirmBox

function confirmDialog(message, onConfirm) {
    var fClose = function() {
        $("#confirmModal").modal("hide");
    };
    $("#confirmMessage").empty().append(message);
    $("#confirmModal").modal('show');

    $("#confirmOk").unbind().one('click', onConfirm).one('click', fClose);
    $("#confirmCancel").unbind().one("click", fClose);
}
//search

/////// Product Search Functions ////////
function searchbar(str) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("autocomplete").innerHTML =
                this.responseText;
        }
    };
    xhttp.open("GET", "ajax/search.php?sid=" + str, true);
    xhttp.send();
}



function hidesearchdiv() {
    var x = document.getElementById("autocomplete");
    if (x.style.display === "none") {

        x.style.display = "block";

    } else {
        x.style.display = "none";
    }
}



function hidesearchdiva() {
    var x = document.getElementById("autocomplete");

    x.style.display = "block";
}
/////// Product Search Functions ////////

//Fetch Price Range
/*----------------------------
    slider-range here
------------------------------ */
$("#slider-range").slider({
    range: true,
    min: 0,
    max: max,
    values: [0, max],
    slide: function(event, ui) {
        $("#amount").val(currency + ui.values[0] + " - " + currency + ui.values[1]);

        maxPrice = ui.values[1];
        minPrice = ui.values[0];
        pageNo = 1;

        // event.preventDefault();
        actionUrl = 'record-process/listing-products.php';
        formData = $(this).serialize();
        console.log(formData);
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: { priceRange: 'priceRange', maxPrice: maxPrice, minPrice: minPrice, pageNo: pageNo },
            // dataType: 'json',
            success: function(data) {
                data = JSON.parse(data);

                console.log(data);
                var url = 'listing.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
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
});
$("#amount").val(currency + ' ' + $("#slider-range").slider("values", 0) +
    " - " + currency + ' ' + $("#slider-range").slider("values", 1));

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
        success: function(data) {
            data = JSON.parse(data);
            console.log(data);
            var url = 'listing.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
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
    if (element.checked) {
        action = 'addFilter';

    } else {
        action = 'removeFilter';
    }

    console.log(condition);
    console.log(classtypeId);

    $.ajax({
        url: 'record-process/listing-products.php',
        type: 'POST',
        data: { action: action, type: type, condition: condition, pageNo: pageNo, classtypeId: classtypeId },
        // dataType: 'json',
        success: function(data) {
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
        success: function(data) {
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


$(document).ready(function() {
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
$("#addReview").on("submit", function(e) {
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
        cache: false,
        // dataType: 'json',
        success: function(data) {
            data = JSON.parse(data);
            console.log(data);

            if (data.status == 'logInErr') {
                window.location.href = "account.php?" + randomString(20) + "=" + randomString(20) + "&url=" + data.url + "&" + randomString(20) + "=" + randomString(20);
            } else {
                var url = data.url //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                $('.reviewDiv').load(url + ' #setReview');
                $('#addReview')[0].reset();
                $('#snackbar').html(data.result);
                var x = document.getElementById("snackbar");
                x.className = "show";
                setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);
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

$(".addProductToCart").on("submit", function(e) {
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
        success: function(data) {
            data = JSON.parse(data);
            console.log(data);

            $("#" + fromId + "Button").html('Already Added');
            $(".cart-total").html(currency + data.cartSubTotalAmount + '<i class="fa fa-angle-down"></i></span>');
            $(".cart-add").html(data.totalItemInCart);
            var url = 'header.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
            $('.cart-dropdown').load(url + ' #cartDiv');
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);

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
        beforeSend: function() {
            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function() {
                    Swal.showLoading();
                },
            });

            $("body").css("pointer-events", "none");
        },
        // dataType: 'json',
        success: function(data) {
            data = JSON.parse(data);
            console.log(data);
            var url = 'cart.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
            $('.cartPage').load(url + ' #resetCart');

            $(".cart-total").html(currency + data.cartSubTotalAmount + '<i class="fa fa-angle-down"></i></span>');
            $(".cart-add").html(data.totalItemInCart);
            var url = 'header.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
            $('.cart-dropdown').load(url + ' #cartDiv');
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);

        },
        complete: function() {
            $("body").css("pointer-events", "auto");
            Swal.close();
        },

    })

}
/////////// On Change Item Quantity ///////////////


///////// Clear Cart //////////
function clearCart() {

    confirmDialog('Are You sure! You want to clear cart?', function() {
        let actionUrl = 'ajax/clearCart.php';
        $.ajax({
            url: actionUrl,

            success: function(data) {
                data = JSON.parse(data);

                console.log(data);
                var url = 'cart.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                $('.cartPage').load(url + ' #resetCart');

                // $(".cart-total").html('<i class="fa fa-rupee"></i>' + data.cartSubTotalAmount + '<i class="fa fa-angle-down"></i></span>');
                // $(".cart-add").html(data.totalItemInCart);
                var url1 = 'header.php'; //please insert the url of the your current page here, we are assuming the url is 'index.php'          
                $('.refreshDiv').load(url1 + ' #cartItemList');
                $('#snackbarDefault').html(data.result);
                var x = document.getElementById("snackbarDefault");
                x.className = "show";
                setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);
            }
        })
    });
}
///////// Clear Cart //////////

//input validation For registration

$("input").keyup(function() {
    $("#" + this.name + "ErrMsg").html("<div class='err_msg' id='" + this.name + "ErrMsg'></div>");
});

$(".phone").on("keyup", function(e) {
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


$(".password").on("keyup", function(e) {
    $(this).prop('type', 'password');
    var value = $(this).val();
    if (value != '') {
        var regex = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,15}$/;
        var isValid = regex.test(value);
        if (!isValid) {
            $('.userRegBtn').hide();
            $("#" + this.id + "ErrMsg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Password must between 6 to 15 characters which contain at least one numeric digit, one uppercase and one lowercase letter</div>");
        } else {
            $('.userRegBtn').show();

        }
    }
});


$(".password").on("keyup", function(e) {
    confirmPasswordValidationFn();
});

$(".confirmPassword").on("keyup", function(e) {
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
$(".formSubmit").on("submit", function(e) {
    var fromId = this.id;
    e.preventDefault();
    spinner.show();
    actionUrl = "ajax/user.php";
    formData = $("#" + fromId).serialize();
    $.ajax({
        url: actionUrl,
        type: "POST",
        data: formData,
        beforeSend: function() {
            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function() {
                    Swal.showLoading();
                },
            });

            $("body").css("pointer-events", "none");
        },
        complete: function() {
            $("body").css("pointer-events", "auto");
            Swal.close();
        },
        success: function(data) {
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

                $(document).ready(function() {
                    try {
                        $("div[class='err_msg']")
                            .filter(function() {
                                return $(this).html().trim().length > 0;
                            })
                            .eq(0)
                            .each(function() {
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
                    timer(60);
                    $("html, body").animate({
                            scrollTop: $(".otpVerify").offset().top,
                        },
                        1000
                    );
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

        success: function(data) {
            console.log(data);
            $("#shippingAddresses").html(data);
        }
    })
}
///////// Update Address Book //////////



$("#verifyOtpFormDash").on("submit", function(e) {
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
        beforeSend: function() {

            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function() {
                    Swal.showLoading()
                }
            });

            $('body').css('pointer-events', 'none');

        },
        success: function(data) {
            data = JSON.parse(data);


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
            setTimeout(function() {
                x.className = x.className.replace("show", "");
            }, 3000);

        },
        complete: function() {

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
        setTimeout(function() {
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

$("#verifyOtpForm").on("submit", function(e) {

    e.preventDefault();
    actionUrl = 'ajax/verify-otp.php';
    formData = $("#verifyOtpForm").serialize();
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        // dataType: 'json',
        success: function(data) {
            data = JSON.parse(data);
            console.log(data);

            color = (data.status == 'failed') ? '#f00' : '#008000';
            $("#verifyOtpFormMsg").html("<div style='color:" + color + ";' id='verifyOtpFormMsg'>" + data.message + "</div>");

            // $('#verifyOtpForm')[0].reset();

            $('.codeBox').val('');

            if (data.message == "") {
                data.message = 'Error Occur please try again!'
            }
            $('#snackbarDefault').html(data.message);
            var x = document.getElementById("snackbarDefault");
            x.className = "show";
            setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);

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
        success: function(data) {
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
        beforeSend: function() {

            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function() {
                    Swal.showLoading()
                }
            });

            $('body').css('pointer-events', 'none');

        },
        success: function(data) {
            data = JSON.parse(data);

            $("#coupanAppliedDiv").attr('style', 'display: none!important;');
            $(".coupanCodeInput").prop("readonly", false);
            $("#coupanCodeButton").prop("disabled", false);
            $("#ErrMsg").html('');
            $("#ErrMsg").removeAttr('style');
            $('#coupanForm')[0].reset();
            var CheckoutTaxSection = $('#CheckoutTaxSection').text();
            var totalPriceVar = Number(CheckoutTaxSection) + data;
            $("#totalAmount").html(currency + totalPriceVar);

        },
        complete: function() {

            $('body').css('pointer-events', 'auto');
            swal.close();

        },
    });

}

$("#coupanForm").on("submit", function(e) {
    e.preventDefault();
    actionUrl = "ajax/apply-coupan.php";
    formData = $("#coupanForm").serialize();
    $.ajax({
        url: actionUrl,
        type: "POST",
        data: formData,
        beforeSend: function() {
            Swal.fire({
                title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
                html: "Request under processing, please do not lock the screen or leave the page.",
                showCancelButton: false,
                showConfirmButton: false,
                onOpen: function() {
                    Swal.showLoading();
                },
            });

            $("body").css("pointer-events", "none");
        },
        success: function(data) {
            data = JSON.parse(data);
            color = data.status == "failed" ? "#f00" : "#008000";
            $("#ErrMsg").html("<div class='err_msg' style='color:" + color + ";' id='formMsg'>" + data.message + "</div>");

            if (data.status == "success") {
                $("#ErrMsg").attr('style', 'border: 1px solid #eed177!important;background: #eee3c0!important;padding: 10px;');
                $("#ErrMsg").html('Coupon Applied <b>' + $('input[name=coupanCode]').val() + '</b>   <span style="text-align: right; margin-left: 287px;font-weight: 500;cursor: pointer; color: #ffffff;   background-color: #ed3237;font-size: 13px;padding: 4px 10px;border-radius: 12px;" onclick="removeCoupan(' + data.savePrice + ')">Remove</a>');
                $(".coupanCodeInput").prop("readonly", true);
                $("#coupanCodeButton").prop("disabled", true);
                $("#coupanAppliedDiv").show();
                $("#coupanAppliedDiv").html("<h4>Coupon Applied <b>(Save)</b></h4> <h4 class='price'>- " + currency + data.savePrice + "</h4>");
                var CheckoutTaxSection = $('#CheckoutTaxSection').text();
                var totalPriceVar = Number(CheckoutTaxSection) + data.totalPrice;
                $("#totalAmount").html(currency + totalPriceVar);
            }
        },
        complete: function() {
            $("body").css("pointer-events", "auto");
            Swal.close();
        },
    });
});

// temperary data session

$("#loginbtnmdl").on("click", function(e) {
    e.preventDefault();
    actionUrl = "ajax/temp_data.php";
    formData = $("#placeOrder,#addressDetailsForm,#coupanForm").serialize();
    $.ajax({
        url: actionUrl,
        type: "POST",
        data: formData,
        // dataType: 'json',
        success: function(data) {
            data = JSON.parse(data);
            console.log(data);
        },
    });
});

// payment method
$("input[name=paymentmethod]").on("change", function() {
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


$(document).on("click", "#paySubmitButton", function(e) {
    e.preventDefault();

    $("#paySubmitButton").attr("disabled", true);
    actionUrl = "ajax/checkout-cb.php";
    formData = $("#placeOrder,#addressDetailsForm,#coupanForm,#pymentMethodForm").serialize();
    $.ajax({
        url: actionUrl,
        type: "POST",
        data: formData,
        // dataType: 'json',
        success: function(data) {
            data = JSON.parse(data);
            console.log(data);

            if (data.status == "inputErr") {
                for (var key in data.errMessage) {
                    if (key == "newBillingAddressType") {
                        title = "";
                        msg = data.errMessage[key];
                        type = "info";
                        // showAlert(title, msg, type);
                    } else {
                        $("#" + key + "ErrMsg").html("<div class='err_msg' id='" + key + "ErrMsg'>" + data.errMessage[key] + "</div>");
                    }
                }

                $(document).ready(function() {
                    try {
                        $("div[class='err_msg']")
                            .filter(function() {
                                return $(this).html().trim().length > 0;
                            })
                            .eq(0)
                            .each(function() {
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
                // showAlert(title, msg, type);
            } else {
                if (data.status == "cod") {
                    title = "Success";
                    msg = data.result;
                    type = "info";
                    // showAlert(title, msg, type);

                    setTimeout(() => {
                        window.location.href = "order-completed.php?" + randomString(20) + "=" + randomString(20) + "&id=" + data.orderId + "&" + randomString(20) + "=" + randomString(20);
                    }, 1000);
                }

                $("#paySubmitButton").attr("disabled", false);
            }
        }
    });

    // }
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

    confirmDialog('Are You sure! You want to remove?', function() {
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
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);
                $('#snackbarDefault').html(data.result);
                var x = document.getElementById("snackbarDefault");
                x.className = "show";
                setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);
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
        success: function(data) {
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
            // $('#newAddressCountry option[value="'+data.country+'"]');
            // $('#newAddressState option[value="'+data.state+'"]').select();
            // $('#id option[value=theOptionValue]').prop('selected', 'selected').change();
            // $('#newAddressState option[value='+data.state+']').prop("selected", "selected").change();
            // $("#newAddressCountry").val(data.country);
            // $('#meetingDay').val('no-data');
            // $('#meetingDay').trigger('change');

            $("#newAddressState").val(data.state);
            $("#newAddressState").trigger('change');
            $("#newAddressCity").val(data.city);
            $("#newAddressZipCode").val(data.zipCode);
            $("#newAddressMobile").val(data.phone);
            $("#newAddressEmail").val(data.email);

            //$("#addNewAddressButton").click();

        }
    })
}

$("#new_address_form").on("submit", function(e) {
    e.preventDefault();
    actionUrl = 'ajax/user.php';
    formData = $("#new_address_form").serialize();
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        // dataType: 'json',
        success: function(data) {
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
                setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);
                $('.myaccount-address').load('dashboard.php  #changeAddress');


                $("#contactFormSubmit")[0].reset();
                if (data.status == 'success') {
                    $("#new_address_form").attr("style", "display:none");
                }

            }
        }

    })
});


$("#cancelOrder").on("submit", function(e) {

    e.preventDefault();

    confirmDialog('Are You sure! You want to cancel order?', function() {
        actionUrl = 'ajax/cancel-order.php';
        formData = $("#cancelOrder").serialize();
        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            // dataType: 'json',
            success: function(data) {
                data = JSON.parse(data);
                console.log(data);

                location.reload();
            }

        })
    });
});
////////// Cancel Order ///////////

//Contact Form Submit

$("#contactFormSubmit").on("submit", function(e) {
    e.preventDefault();
    actionUrl = 'ajax/contact-form.php';
    formData = $(this).serialize();

    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        // dataType: 'json',
        success: function(data) {
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
                setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);
                $("#contactFormSubmit")[0].reset();

            }
        }

    })
});

//For subscribe
$("#subscribeForm").on("submit", function(e) {
    e.preventDefault();

    formData = $(this).serialize();

    let actionUrl = 'ajax/add-subscribe.php';
    console.log('formData');
    $.ajax({
        url: actionUrl,
        type: 'POST',
        data: formData,
        // dataType: 'json',
        success: function(data) {
            data = JSON.parse(data);
            console.log(data);

            $('#snackbar').html(data.result);
            var x = document.getElementById("snackbar");
            x.className = "show";
            setTimeout(function() { x.className = x.className.replace("show", ""); }, 3000);
            //  }
            $('#mc-email').val('');
        }


    })

});