<?php

include("config.php");
ini_set('display_errors', 0);
ini_set('log_errors', 0);
error_reporting(E_ALL);
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];

//$currentPage=explode('?',explode(BASE_URL,$url)[1])[0];
$currentPage = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);


if (isset($_SESSION['filter']['checked']['cat'])) {
    foreach ($_SESSION['filter']['checked']['cat'] as $key => $item) {
        if (false !== strrpos($item, 'p.subcat_id')) {

            unset($_SESSION['filter']['checked']['cat'][$key]);
            unset($_SESSION['filter']['checked']['class0']);
            unset($_SESSION['filter']['checked']['class1']);
            unset($_SESSION['filter']['checked']['class2']);
            unset($_SESSION['filter']['checked']['brand']);
            unset($_SESSION['filter']['max']);
            unset($_SESSION['filter']['min']);
            unset($_SESSION['classtype_id']);
        }
    }
    foreach ($_SESSION['filter']['checked']['cat'] as $key => $item) {
        if (false !== strrpos($item, 'p.cat_id')) {
            unset($_SESSION['filter']['checked']['cat'][$key]);
            unset($_SESSION['filter']['checked']['class0']);
            unset($_SESSION['filter']['checked']['class1']);
            unset($_SESSION['filter']['checked']['class2']);
            unset($_SESSION['filter']['checked']['brand']);
            unset($_SESSION['filter']['max']);
            unset($_SESSION['filter']['min']);
            unset($_SESSION['classtype_id']);
        }
    }
}

if (isset($_SESSION['agentLoginStatus']) && $_SESSION['agentLoginStatus']) {
    $agemail = $_SESSION['agent_email'];
    $row1 = mysqli_query($con, "SELECT * FROM user WHERE `email` = '$agemail'");

    if (mysqli_num_rows($row1) > 0) {
        $result1 = mysqli_fetch_array($row1);
        $_SESSION['loginid'] = $result1['id']; // Use $result1 instead of $row1
        $_SESSION['email'] = $result1['email']; // Use $result1 instead of $row1
        $_SESSION['mobile'] = $result1['phone']; // Use $result1 instead of $row1
        $_SESSION['userLoginStatus'] = true;
    }
}
//Fetch Currency
$currency = $homePage->currency();

// unset($_SESSION['filter']);
// unset($_SESSION['classtype_id']);

// session_destroy();
// echo "<pre>";
// print_r($_SESSION);

if (isset($_SESSION['loginid'])) {
    $loginId = $_SESSION['loginid'];
} else {
    $loginId = 0;
}

$resultt = mysqli_query($con, "SELECT * FROM user WHERE id = '$loginId' AND role='User'");
$login_count = mysqli_num_rows($resultt);

$_SESSION['login_count'] = $login_count;

?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
    // For meta Content
    if ($currentPage == 'about.php' || $currentPage == 'contact.php') {
        $page = explode('.php', $currentPage)[0];
        $pid = "No";
    } elseif ($currentPage == 'product-detail.php') {
        $page = explode('.php', $currentPage)[0];
        $pid = $_GET['product_id'];
    } else {

        $page = "index";
        $pid = "No";
    }
    $meta = $homePage->meta($page, $pid);

    if (!empty($meta)) { ?>
        <title><?php if (!empty($meta['title'])) echo $meta['title'];
                else "MSG"; ?></title>
    <?php
    } else {
    ?>
        <title>MSG - Organic Food & Grocery Market Place</title>

    <?php
    } ?>
    <?php if (!empty($meta)) {
    ?>

        <?php
        if (!empty($meta['metaTags'])) {
            foreach ($meta['metaTags'] as $desc) { ?>
                <meta name="description" content="<?= $desc['meta'] ?>">
        <?php
            }
        } ?>
        <?php
        if (!empty($meta['metaKeys'])) {
            foreach ($meta['metaKeys'] as $key) { ?>
                <meta name="keywords" content="<?= $key['keyword'] ?>">
    <?php
            }
        }
    }
    //End Seo Content
    ?>
    <meta name="keywords" content="Ecommerce Demo">
    <meta name="description" content="Ecommerce Demo">

    <?php $logo = $homePage->logo(); ?>
    <meta name="google-site-verification" content="RWJwZkKaICLBilmM3CU_9j83CdwMBphutQJ7nui_NPw" />
    <link rel="shortcut icon" type="image/x-icon" href="asset/image/logo/<?= $logo['logo'] ?>">

    <!-- CSS here -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/animate.min.css">
    <link rel="stylesheet" href="assets/css/magnific-popup.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/flaticon.css">
    <link rel="stylesheet" href="assets/css/aos.css">
    <link rel="stylesheet" href="assets/css/slick.css">
    <link rel="stylesheet" href="assets/css/default.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/responsive.css">
    <link href="https://fonts.googleapis.com/css2?family=Architects+Daughter&family=Poppins:wght@200;300;400;500;600;700;800;900&family=Syne:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="assets/css/sweetalert2.min.css">
    <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
      <!-- Link Swiper's CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <style>
   .dropdown-toggle:hover~.dropdown-menu {
            opacity: 1;
            visibility: visible;
        }

        .SWLoader {
            border: 5px solid #f3f3f3;
            border-top: 5px solid #3498db;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            animation: spin 1s linear infinite;
            margin: auto;
            margin-top: 20px;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .hereanch {
            font-size: 18px;
            border-radius: 50%;
            background-color: #f8e3d1;
            padding: 9px 15px !important;
        }

        .hereanch:after {
            display: none;
        }

        .hereanch i {
            color: black;
            font-size: 14px;
        }

        .dropduser {
            min-width: 7rem !important;
            padding: 5px 0 !important;
        }

        .ditemuser {
            padding: 0px 8px !important;
        }

        .category-active .next-arrow {
            position: absolute;
            top: 33%;
            right: 0;
            background: #ddd;
            padding: 10px 13px;
            border-radius: 50%;
            z-index: 1;
        }

        .category-active .prev-arrow {
            position: absolute;
            top: 33%;
            left: 0;
            z-index: 1;
            background: #ddd;
            padding: 10px 13px;
            border-radius: 50%;
        }

        .best-deal-active .next-arrow {
            position: absolute;
            top: 20%;
            right: 0;
            background: #ddd;
            padding: 10px 13px;
            border-radius: 50%;
            z-index: 1;
        }

        .best-deal-active .prev-arrow {
            position: absolute;
            top: 20%;
            left: 0;
            z-index: 1;
            background: #ddd;
            padding: 10px 13px;
            border-radius: 50%;
        }

        .ulks1 {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
            overflow-y: hidden;
            justify-content: flex-start;
            padding-bottom: 10px;
            cursor:pointer;
        }

        .ulks1 li button {
            white-space: nowrap;
        }

        .ulks1::-webkit-scrollbar {
            width: 3px;
            height: 10px;
        }

        /* Track */
        .ulks1::-webkit-scrollbar-track {
            background: #888;
        }

        /* Handle */
        .ulks1::-webkit-scrollbar-thumb {
            background: #c50f13;
        }

        /* Handle on hover */
        .ulks1::-webkit-scrollbar-thumb:hover {
            background: #000;
        }
        
        .header-cart-wrap_hny12 {
    position: fixed; 
    top: 20px;        
    right: 90px;     
    z-index: 1;  
     transition: opacity 0.3s ease, transform 0.3s ease;
}

@media (max-width: 600px) {
    .header-cart-wrap_hny12 {
        top: 5px; 
        right: 50px;  
        padding: 5px;
    }

.goog-te-gadget .goog-te-combo {
    padding: 10px 3px !important;
    font-size: 11px;
}
}

.hidden {
    opacity: 0;  /* Makes the div invisible */
    transform: translateY(-10px);  /* Moves the div slightly up */
    pointer-events: none;  /* Disables interactions when hidden */
}
#showItems img{
    width:90px;
}
#pagination-blocks li{
    cursor:pointer;
}
@media (min-width: 1708px) and (max-width: 1920px) {
    .header-cart-wrap_hny12 {
           right: 350px !important;
}
    .header-action>ul>li {
        margin-left: 30px !important;
    }
}
@media (min-width: 1600px) and (max-width: 1707px) {
    .header-cart-wrap_hny12 {
           right: 145px !important;
}
    .header-action>ul>li {
        margin-left: 30px !important;
    }
}
@media (min-width: 1422px) and (max-width: 1599px) {
    .header-cart-wrap_hny12 {
           right: 125px !important;
}
    .header-action>ul>li {
        margin-left: 0px !important;
    }
}


    </style>
</head>

<body>

    <!-- preloader -->
    <div id="preloader">
        <div id="loading-center">
            <div class="loader_hny">
                <?php
                //show logo
                $logo = $homePage->logo();
                ?>
                <img src="asset/image/logo/<?= $logo['logo'] ?>" alt="" width="100px">
                <div class="d-flex">
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                    <div class="dot"></div>
                </div>
            </div>
        </div>
    </div>
    <!-- preloader-end -->

    <!--whats-app--> 
   
        <button class="scroll-top scroll-to-target" data-target="html"><a href="https://api.whatsapp.com/send?phone=919520400050" class="float scroll-top scroll-to-target open" target="_blank" data-target="html">
<i class="fa-brands fa-whatsapp my-float"></i>
</a> </button>
   
    <!--whats-app-ends--> 

    <!-- Scroll-top -->
    <button class="scroll-top scroll-to-target" data-target="html">
        <i class="fas fa-angle-up"></i>
    </button>
    <!-- Scroll-top-end-->

    <!-- header-area -->
    <header>

        <!-- header-search-area -->
        <div class="header-search-area">
            <div class="container custom-container d-none d-lg-block">
                <div class="row align-items-center">
                    <div class="col-xl-2 col-lg-3 d-none d-lg-block">
                        <div class="logo">
                            <?php
                            //show logo
                            $logo = $homePage->logo();
                            ?>
                            <a href="index.php"><img src="asset/image/logo/<?= $logo['logo'] ?>" alt="Logo" width="80px"></a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-9">
                        <div class="d-block d-sm-flex align-items-center justify-content-start">
                            <div class="header-search-wrap">

                                <form action="javascript:void(0);" class="search-bar productSearch2" method="get">
                                    <input type="text" class="form-control search-type" id="search" autocomplete="on" name="search" onfocusout="hidesearchdiv()" placeholder="Search For Product...">
                                    <input type="hidden" name="route" value="product/search" />
                                    <div id="autocomplete" class="mysrcdiv" onmouseleave="hidesearchdiva()" onmouseleave="hidesearchdiv()"></div>
                                    
                                </form>
                            </div>
                            <div class="header-action">
                                <ul>
                                    <li class="header-phone">
                                        <div class="icon"><i class="flaticon-telephone"></i></div>
                                        <a href="tel:<?= $homePage->contactInfo('phone'); ?>"><span>Call Us Now</span><?= $homePage->contactInfo('phone'); ?></a>
                                    </li>



                                    <ul class="navbar-nav">
                                        <li class=" nav-item dropdown">
                                            <a class="nav-link dropdown-toggle hereanch" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="flaticon-user"></i>
                                            </a>
                                            <div class="dropdown-menu dropduser" aria-labelledby="navbarDropdown" style="left:-50px;">
                                                <?php if (USER::isLoggedIn()) { ?>
                                                    <?php
                                                    if (isset($_SESSION['loginid'])) {
                                                        $loginId = $_SESSION['loginid'];
                                                    } else {
                                                        $loginId = 0;
                                                    }
                                                    $result = mysqli_query($con, "SELECT * FROM user WHERE id = '$loginId' AND role='User'");
                                                    $row_count = mysqli_num_rows($result);

                                                    if ($row_count > 0) {
                                                    ?>
                                                        <a class="dropdown-item ditemuser" href="dashboard.php">User</a>
                                                    <?php } else {
                                                    ?>
                                                        <a class="dropdown-item ditemuser" href="agent/index.php">Agent</a>
                                                    <?php } ?>

                                                <?php } else { ?>
                                                    <a class="dropdown-item ditemuser" href="account.php">User</a>
                                                    <a class="dropdown-item ditemuser" href="agent-account.php">Agent</a>
                                                <?php } ?>
                                            </div>

                                        </li>
                                    </ul>



                                    <li class="header-cart-hny" id="maindin">
    <div class="header-cart-wrap_hny" id="secndin">
        <div class="mini-cart-wrap">
            <a href="javascript:;"><i class="flaticon-shopping-basket" id="buttonkscart"></i></a>
            <span class="item-count cart-add"><?php echo $cart->totalItemInCart(); ?></span>
        </div>
        <div class="newhidds">
            <ul class="minicart">
                <div class="top_cart_tit">
                    <h3>SHOPPING CART</h3>
                    <div class="hny_close_cart"><i class="fa fa-close"></i></div>
                </div>
                <div id="headerCart">
                    <div id="cartDiv">
                        <div class="products scrollable">
                            <?php
                            $items = $cart->cartDetail();
                            if (isset($items['cartEmpty'])) { ?>
                                <div class="cart-list">
                                    <div class="cart-content" style="color:#000;">
                                        <div class="no-blog">
                                            <img src="assets/img/empty_cart.jpg" width="300px" alt="">
                                        </div>
                                    </div>
                                </div>
                            <?php  } else { ?>
                                <div class="cart-list">
                                    <?php foreach ($items as $item) {
                                        if (array_key_exists('product_name', $item)) { ?>
                                            <li class="cart-item product product-cart">
                                                <div class="cart-media ">
                                                    <figure class="product-media">
                                                        <a href="javascript:;">
                                                            <img src="asset/image/product/<?= $item['image']; ?>" alt="product" width="80" height="88">
                                                        </a>
                                                    </figure>
                                                </div>
                                                <div class="cart-info-group">
                                                    <div class="cart-info">
                                                        <div class="product-detail">
                                                            <a href="javascript:;" class="product-name"><?= $item['product_name']; ?></a>
                                                        </div>
                                                        <?php
                                                        $isdeal = $homePage->isDealByProduct($item['id']);
                                                        if (!empty($isdeal)) {
                                                            if ($isdeal[0]['stock'] != 0) {
                                                                $price = $isdeal[0]['price'];
                                                            } else {
                                                                if (($item['price'] == $item['discount']) || ($item['discount'] == 0)) {
                                                                    $price = $item['price'];
                                                                } else {
                                                                    $price = $item['discount'];
                                                                }
                                                            }
                                                        } else {
                                                            if (($item['price'] == $item['discount']) || ($item['discount'] == 0)) {
                                                                $price = $item['price'];
                                                            } else {
                                                                $price = $item['discount'];
                                                            }
                                                        }
                                                        ?>
                                                        <p class="mb-1">Unit Price - <?= $currency; ?> <?= $price; ?></p>
                                                        <div class="cart-action-group">
                                                            <div class="product-action">
                                                                <button class="action-minus qty" title="Quantity Minus">
                                                                    Qty.
                                                                </button>
                                                                <div class="input-group hny-crt">
                                                                    <button onclick="decreaseQuantity(this)" class="quantity-minus"><i class="fas fa-minus"></i></button>
                                                                    <input class="action-input itemQuantity" title="Quantity Number" type="number" min="<?= $item['minimum']; ?>" max="<?= $item['maximum']; ?>" value="<?= $item['quantity']; ?>" name="itemQuantity" onchange="changeItemQuantity(<?= $item['id']; ?>,this.value,<?= $item['class0']; ?>);" disabled>
                                                                    <button onclick="increaseQuantity(this)" class="quantity-plus"><i class="fab fa-plus"></i></button>
                                                                </div>
                                                            </div>
                                                            <h6 class="mb-2">
                                                                <?php
                                                                $totalcrt = $price * $item['quantity'];
                                                                ?>
                                                                <?= $currency; ?> <?= $totalcrt; ?>
                                                            </h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                    <?php }
                                    } ?>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="cart-action mt-5">
                            <?php
                            if (isset($items['cartEmpty'])) {
                            ?>
                                <a href="index.php" class="btn btn-dark w-48"><span>Shop Now</span></a>
                            <?php } else { ?>
                                <div class="bub_tot d-flex">
                                    <p>Subtotal</p>
                                    <p><strong class="cartttl"><?= $currency; ?><?= $cart->cartSubTotalAmount(); ?></strong></p>
                                </div>
                                <a class="cart-checkout-btn gocheckout btn btn-dark w-48" onclick="checkStock()"><span class="checkout-label">Checkout</span></a>
                                <!-- Button trigger modal -->
                                <button style="display:none;" type="button" class="btn btn-primary" id="productModal" data-toggle="modal" data-target="#exampleModal2">
                                    Demo modal
                                </button>
                            <?php } ?>
                            <a href="cart.php" class="btn btn-primary btn-rounded btn-md w-50"><i class="d-icon-bag"></i> View Cart</a>
                        </div>
                    </div>
                </div>
            </ul>
        </div>
    </div>
</li>



                                    
                                    <li class="header-cart-hny">
                                        <div class="header-cart-wrap_hny">
                                           <div class="mini-cart-ans">
                                            <?php
                                            if (USER::isLoggedIn()) {
                                                $wishListUrl = 'wishlist.php';
                                                $onClickFunction = '';
                                            } else {
                                                $wishListUrl = 'javascript:void(0);';
                                                $onClickFunction = 'onClick="userNotLoginAlert()"';
                                            }
                                            ?>
                                            <a href="<?= $wishListUrl ?? '' ?>" <?= $onClickFunction ?>><i class="fa-regular fa-heart"></i></a>
                                           </div>
                                      
                                        </div>
                                        <!-- <div class="cart-amount">&#8377;0.00</div> -->
                                    </li>
                                    
                                      <li class="header-cart-hny">
                                        <!--<div class="header-cart-wrap_hny">-->
                                         
                                        <!--       <div id='google_translate_element'></div>-->
                                          
                                         
                                        <!--</div>-->
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
               
                </div>
                                </div>
                
                <div class="container custom-container d-lg-none">
                <div class="row align-items-center">
                       <div class="col-xl-10 col-lg-9 col-8">
                        <div class="d-block d-sm-flex align-items-center justify-content-start">
                            <div class="header-search-wrap">

                                <form action="javascript:void(0);" class="search-bar productSearch2" method="get">
                                    <input type="text" class="form-control search-type" id="search2" autocomplete="on" name="search" onfocusout="hidesearchdiv2()" placeholder="Search For Product...">
                                    <input type="hidden" name="route" value="product/search" />
                                    <div id="autocomplete2" class="mysrcdiv" onmouseleave="hidesearchdiva2()" onmouseleave="hidesearchdiv2()"></div>
                                    <button><i class="flaticon-loupe-1"></i></button>
                                </form>
                            </div>
                            <div class="header-action">
                                <ul>
                                    <li class="header-phone">
                                        <div class="icon"><i class="flaticon-telephone"></i></div>
                                        <a href="tel:<?= $homePage->contactInfo('phone'); ?>"><span>Call Us Now</span><?= $homePage->contactInfo('phone'); ?></a>
                                    </li>



                                    <ul class="navbar-nav">
                                        <li class=" nav-item dropdown">
                                            <a class="nav-link dropdown-toggle hereanch" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="flaticon-user"></i>
                                            </a>
                                            <div class="dropdown-menu dropduser" aria-labelledby="navbarDropdown" style="left:-50px;">
                                                <?php if (USER::isLoggedIn()) { ?>
                                                    <?php
                                                    if (isset($_SESSION['loginid'])) {
                                                        $loginId = $_SESSION['loginid'];
                                                    } else {
                                                        $loginId = 0;
                                                    }
                                                    $result = mysqli_query($con, "SELECT * FROM user WHERE id = '$loginId' AND role='User'");
                                                    $row_count = mysqli_num_rows($result);

                                                    if ($row_count > 0) {
                                                    ?>
                                                        <a class="dropdown-item ditemuser" href="dashboard.php">User</a>
                                                    <?php } else {
                                                    ?>
                                                        <a class="dropdown-item ditemuser" href="agent/index.php">Agent</a>
                                                    <?php } ?>

                                                <?php } else { ?>
                                                    <a class="dropdown-item ditemuser" href="account.php">User</a>
                                                    <a class="dropdown-item ditemuser" href="agent-account.php">Agent</a>
                                                <?php } ?>
                                            </div>

                                        </li>
                                    </ul>
                                    
                                    <li class="header-cart-hny">
                                        <div class="header-cart-wrap_hny">
                                           <div class="mini-cart-ans">
                                                                                        <?php
                                            if (USER::isLoggedIn()) {
                                                $wishListUrl = 'wishlist.php';
                                                $onClickFunction = '';
                                            } else {
                                                $wishListUrl = 'javascript:void(0);';
                                                $onClickFunction = 'onClick="userNotLoginAlert()"';
                                            }
                                            ?>
                                            <a href="<?= $wishListUrl ?? '' ?>" <?= $onClickFunction ?>><i class="fa-regular fa-heart"></i></a>

                                       
                                           </div>
                                      
                                        </div>
                                        <!-- <div class="cart-amount">&#8377;0.00</div> -->
                                    </li>
                                    
                                    <!--  <li class="header-cart-hny">-->
                                    <!--    <div class="header-cart-wrap_hny">-->
                                         
                                    <!--           <div id='google_translate_element'></div>-->
                                          
                                         
                                    <!--    </div>-->
                                    <!--</li>-->
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!--     <div class="col-4">-->
                      
                    <!--       <div class="lang-ansh-icon">-->
                    <!--           <span>-->
                    <!--            <i class="fa-solid fa-language"></i>-->
                    <!--           </span>-->
                    <!--            <span>-->
                    <!--            <i class="fa-solid fa-language"></i>-->
                    <!--           </span>-->
                    <!--       </div>-->
                      
                    <!--</div>-->
                </div>
            </div>
        </div>
        <!-- header-search-area-end -->

        <div id="sticky-header" class="menu-area">
            <div class="container custom-container">
                <div class="row">
                    <div class="col-12">
                        <div class="mobile-nav-toggler"><i class="fas fa-bars"></i></div>
                        <div class="menu-wrap">
                            <nav class="menu-nav">
                                <div class="logo d-block d-lg-none">
                                    <?php
                                    //show logo
                                    $logo = $homePage->logo();
                                    ?>
                                    <a href="index.php"><img src="asset/image/logo/<?= $logo['logo'] ?>" alt="" width="100px"></a>
                                </div>
                                <div class="header-category d-none d-lg-block">
                                    <a href="javascript:;" class="cat-toggle"><i class="fas fa-bars"></i>ALL CATEGORIES<i class="fas fa-angle-down"></i></a>
                                    <ul class="category-menu">

                                        <?php
                                        // show menu
                                        // print_r($homePage->menu());
                                        $ab = 1;
                                        foreach ($homePage->menu() as $mainMenu) {
                                            if ($mainMenu['subMenu'] == 0) {
                                        ?>
                                                <li><a href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&<?= $mainMenu['condition']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $mainMenu['cat_name']; ?></a></li>
                                            <?php } else { ?>
                                                <li class="menu-item-has-children"><a href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&<?= $mainMenu['condition']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"> <?= $mainMenu['cat_name']; ?></a>
                                                    <ul class="megamenu">
                                                        <li class="sub-column-item"><a href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&<?= $mainMenu['condition']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $mainMenu['cat_name']; ?></a>
                                                            <ul>
                                                                <?php
                                                                foreach ($mainMenu['subMenu'] as $subMenu) {
                                                                ?>
                                                                    <li><a href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&id=subcat_id@<?= $subMenu['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $subMenu['sub_cat_name']; ?></a></li>
                                                                <?php } ?>
                                                            </ul>
                                                        </li>

                                                    </ul>
                                                </li>
                                        <?php }
                                            $ab++;
                                        } ?>
                                    </ul>
                                </div>
                                <div class="navbar-wrap main-menu d-none d-lg-flex">
                                    <ul class="navigation">
                                        <?php
                                        $count = 0;
                                        foreach ($homePage->menu() as $mainMenu) {
                                            if ($count < 8) {
                                        ?>
                                                <li><a href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&<?= $mainMenu['condition']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $mainMenu['cat_name']; ?></a></li>
                                            <?php
                                            } else {
                                            ?>
                                                <li><a href="listing.php">View More</a></li>
                                        <?php
                                                break;
                                            }
                                            $count++;
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <!-- Mobile Menu  -->
                        <div class="mobile-menu">
                            <nav class="menu-box">
                                <div class="close-btn"><i class="fas fa-times"></i></div>
                                <div class="nav-logo">
                                    <?php
                                    //show logo
                                    $logo = $homePage->logo();
                                    ?>
                                    <a href="index.php"><img src="asset/image/logo/<?= $logo['logo'] ?>" alt="" width="100px">
                                    </a>
                                </div>
                                <div class="menu-outer">
                                    <!--Here Menu Will Come Automatically Via Javascript / Same Menu as in Header-->
                                </div>
                                <div class="social-links">
                                    <ul class="clearfix">
                                        <?php
                                        // Show social media
                                        $social = $homePage->socialMedia();
                                        if (!empty($social)) {
                                            foreach ($social as $value) {
                                        ?>
                                                <li><a href="<?= $value['url'] ?>" title="<?= $value['name'] ?>" target="_blank"><span class="<?= $value['icon'] ?>"></span></a></li>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </nav>
                        </div>
                        <div class="menu-backdrop"></div>
                        <!-- End Mobile Menu -->
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header-area-end -->