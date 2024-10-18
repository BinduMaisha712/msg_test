<?php include('header.php') ?>

<style>
    
    .offer-slider .prev-arrow {
    position: absolute;
    top: 33%;
    left: 0;
    z-index: 1;
    background: #ddd;
    padding: 10px 13px;
    border-radius: 50%;
}
.offer-slider .next-arrow {
    position: absolute;
    top: 33%;
    right: 0;
    background: #ddd;
    padding: 10px 13px;
    border-radius: 50%;
    z-index: 1;
}
</style>
<style>
    .swiper {
      width: 100%;
      height: 100%;
    }

    .swiper-slide {
      text-align: center;
      font-size: 18px;
      background: #fff;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .swiper-slide img {
      display: block;
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .ulks1 li a {
    white-space: nowrap;
}
.slick-slide{
    padding:10px !important;
}
  </style>

<style>
    .slick-prev, .slick-next {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: #c50f13;
    border: none;
    cursor: pointer;
    font-size: 16px;
    color: #fff;
    padding: 5px 12px;
    z-index: 1;
    border-radius: 100%;
    margin: 2px;
}

    .slick-prev {
        left: 10px; /* Adjust position */
    }

    .slick-next {
        right: 10px; /* Adjust position */
    }
    .fa-solid, .fas {
    font-weight: 900;
    font-size: 18px;
}
.msg_card{
    display: flex;
    align-items: center;
    justify-content: space-between;
}

@media only screen and (min-width: 576px) and (max-width: 767px) {
    .sp-product-content {
        padding: 20px 5px 20px;
    }
}
@media (max-width: 1199.98px) {
    .sp-product-content {
        padding: 25px 15px 25px;
    }
}

</style>

<!-- main-area -->
<main>
    <!-- slider-area -->
    <section class="slider-area">
        <div class="container-fluid custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="slider-active">
                        <?php
                        foreach ($homePage->slider() as $slider) {
                            if ($slider['click'] == 'yes') {
                                $catInfo = explode("_", $slider['subcat_id']);
                        ?>
                        <div class="single-slider slider-bg">
                            <a href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&id=<?= $catInfo[0]; ?>_id@<?= $catInfo[1]; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>">
                                <img src="asset/image/banners/<?= $slider['image'] ?>" alt="banner" width="100%">
                            </a>
                        </div>
                        <?php } else { ?>
                        <div class="single-slider slider-bg">
                            <img src="asset/image/banners/<?= $slider['image']; ?>" alt="banner" width="100%">
                        </div>
                        <?php }
                        } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- discount-area -->
        <section class="discount-area mt-4">
            <div class="container">
                <div class="row justify-content-center offer-slider">
                    <?php $offerImg = $homePage->getOfferImage();
                    if (empty($offerImg)) {
                        echo "<img  class='mx-auto my-auto d-block' src='asset/image/not-found.png' style='width: 300px;' alt=''>";
                    }
                    foreach ($offerImg as $offImg) { ?>
                    <div class="col-xl-3 col-lg-6 col-md-8 col-6 ">
                        <div class="discount-item mb-20">
                            <div class="discount-thumb">
                                <?php $catInfo = explode("_", $offImg['cat_id']);
                                    if ($offImg['click'] == 'yes') {
                                        $url = "listing.php?" . $homePage->generateToken(40) . "=" . $homePage->generateToken(40) . "&id=" . $catInfo[0] . "_id@" . $catInfo[1] . "&" . $homePage->generateToken(40) . "=" . $homePage->generateToken(40);
                                    } else {
                                        $url = 'javascript:void(0);';
                                    } ?>
                                <a href="<?= $url; ?>"><img src="asset/image/offer/<?= $offImg['image']; ?>" alt=""></a>
                            </div>

                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </section>
        <!-- discount-area-end -->
        <!-- category-area -->
        <div class="container custom-container">
            <div class="slider-category-wrap mt-0">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $i = 1;
                        $newArrivalCatId = $homePage->categories('');
                        if (empty($newArrivalCatId)) {
                            echo "<img  class='mx-auto my-auto d-block' src='asset/image/not-found.png' style='width: 300px;' alt=''>";
                        }
                        ?>
                    </div>
                </div>
                <div class="row category-active">
                    <!--<?php $allCats = $homePage->categories(''); ?>-->
                    <?php
                    //show New Arrival category

                    foreach ($homePage->menu() as $categories) { //Fetch New Products Category
                        $catid = $categories['id'];

                    ?>
                    <div class="col-lg-2">
                        <div class="category-item">
                            <a href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&id=cat_id@<?= $categories['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"
                                class="category-link"></a>
                            <div class="category-thumb">
                                <img src="asset/image/category/<?= $categories['cat_image']; ?>" alt="">
                            </div>
                            <div class="category-content">
                                <h6 class="title"> <?= $categories['cat_name']; ?></h6>
                            </div>
                        </div>
                    </div>
                    <?php
                    } ?>
                </div>
            </div>
        </div>
        <!-- category-area-end -->

    </section>
    <!-- slider-area-end -->
    

<!-- best-sellers-area -->
<section class="best-sellers-area">
    <div class="container">
        <div class="row align-items-end mb-50">
            <div class="col-md-7 col-sm-8">
             <div class="bd-section-title">
                        <h3 class="title"><?php
                            $homeconfig2 = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `home` WHERE id = 3"));
                            echo $homeconfig2['name'];
                        ?> <span>of this Week!</span></h3>
                        <!--<p>A virtual assistant collects the products from your list</p>-->
                        <?php
                        $allCats = $homePage->categories('top'); ?>
                    </div>
            </div>
            <div class="col-md-5 col-sm-4">
                <div class="section-btn text-left text-md-right">
                    <ul class="nav nav-tabs ulks1" id="myTab" role="tablist">
                        <?php
                            $j = 1;
                            foreach ($allCats as $cat) {
                                $active = '';
                                if ($j == 1)
                                    $active = 'active';
                                $string = preg_replace('/\s+/', '', $cat['cat_name']); // Replaces all spaces with hyphens.

                                $catSlug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                                $j++;
                            ?>
                        <li class="nav-item" role="presentation">
                             <a class="nav-link <?= $active ?>" id="<?= $catSlug; ?>-tab" data-toggle="tab" href="#<?= $catSlug; ?>-home" role="tab" aria-controls="<?= $catSlug; ?>home" aria-selected="true"><?= $cat['cat_name']; ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="best-sellers-products">
            <div class="tab-content" id="myTabContent">
                <?php if (empty($allCats)) {
                        echo "<img  class='mx-auto my-auto d-block' src='asset/image/not-found.png' style='width: 300px;' alt=''>";
                    } ?>
                <!-- tab foreach  -->
                <?php
                    $i = 1;
                    foreach ($allCats as $cat) {
                        $string = preg_replace('/\s+/', '', $cat['cat_name']); // Replaces all spaces with hyphens.

                        $catSlug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                        ($i == 1) ? $class = 'active show' : $class = '';
                    ?>
                <div class="tab-pane fade show <?= $class; ?>" id="<?= $catSlug; ?>-home" role="tabpanel" aria-labelledby="<?= $catSlug; ?>-tab">
                    <div class="your-class">
                        <?php
                                $i2 = 1;
                                foreach ($homePage->productsByCategoryAndType($cat['id'], 'top') as $product) {
                                    $issubcategory = mysqli_fetch_assoc(mysqli_query($con, "SELECT c.issubcategory FROM category c  WHERE c.id=" . $product['cat_id']))['issubcategory'];


                                    if ($issubcategory == 'Yes' && $product['subcat_id'] != '') {
                                        // echo "SELECT classtype_id FROM subcategory WHERE id=".$product['subcat_id'];
                                        $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM subcategory WHERE id=" . $product['subcat_id']))['classtype_id']);
                                    } else {
                                        $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM category WHERE id=" . $product['cat_id']))['classtype_id']);
                                    }
                                    $classtypeName = array();
                                    $primaryClassName = "";

                                    $classtype1 = implode(", ", $query1);
                                    // echo $classtype1;
                                    // echo "SELECT id,name FROM classtype WHERE id IN($classtype1) GROUP BY id";
                                    $classtypeNameQuery = mysqli_query($con, "SELECT id,name FROM classtype WHERE id IN($classtype1) GROUP BY id");
                                    while ($row = mysqli_fetch_array($classtypeNameQuery)) {
                                        $classtypeName[] = array('id' => $row['id'], 'name' => $row['name']);
                                        $classtypeId12[] = $row['id'];
                                    }

                                    if ((count($query1)) == 3) {
                                        $k1 = array();
                                        foreach ($classtypeName as $k => $value) {
                                            if ($query1[0] != $value['id']) {
                                                $k1[] = $k;
                                            }
                                        }
                                        $primaryClassName = ucfirst($classtypeName[$k1[0]]['name']) . '+' . ucfirst($classtypeName[$k1[1]]['name']);

                                        // $class="'".$query1[1]."','".$query1[2].",";
                                    } elseif (count($query1) == 2) {
                                        $primaryClassName = ucfirst($classtypeName[0]['name']);
                                        if ($query1[0] == $classtypeName[0]['id']) {
                                            $primaryClassName = ucfirst($classtypeName[1]['name']);
                                        }
                                    } elseif (count($query1) == 1 && $query1[0] != 16) {
                                        $primaryClassName = ucfirst($classtypeName[0]['name']);
                                    }

                                    $randamValue = rand();

                                ?>
                        <div class="">
                            <div class="sp-product-item mb-20">
                                <div class="sp-product-thumb">
                                    <img src="assets/img/medal.png" class="ansh-medal">
                                    <?php
                                                if (isset($product['price']) && isset($product['discount']) && $product['discount'] < $product['price']) {
                                                    $price = $product['price'];
                                                    $discountedPrice = $product['discount'];

                                                    $off = $homePage->calculateDiscountPercentage($price, $discountedPrice);
                                                ?>
                                    <span class="batch"
                                        id="modelPer<?= $randamValue . $product['id'] ?>"><?= $off; ?>%</span>
                                    <?php } ?>
                                    <a
                                        href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $product['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>">
                                        <?php
                                                    //show Product Image
                                                    $images = $homePage->image('product', $product['product_code']);

                                                    if ($images == "") {
                                                    ?>
                                        <img src="assets/img/product/pr-1.jpeg" alt=""></a>

                                    <?php
                                                    } else {
                                                        $imageCount = count($images);
                                            ?>
                                    <img src="asset/image/product/<?= $images[0]['image']; ?>" alt=""></a>
                                    <?php
                                                    }

                                            ?>
                                </div>
                                <div class="sp-product-content">
                                    <div class="rating">
                                        <div class="row">
                                            <div class="col-lg-7 col-md-6 col-6">
                                                  <?php $catq = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM category WHERE id = " . $product['cat_id']));
                                                    if (!empty($catq)) {
                                                        $catName = $catq['cat_name'];
                                                    } else {
                                                        $catName = '';
                                                    } ?>
                                        <span><?= $catName; ?></span>
                                            </div>
                                            
                                             <div class="col-lg-5 col-md-6 col-6 msg_card" >
                                                 <div id="new_<?= $product['id'] ?>">
                                                     <form class="addItemToCartModel" id="addCart_<?php echo $randamValue . $product['id']; ?>" method="post" action="javascript:void(null)">
                      <input type="hidden" id="modelProductId<?php echo $randamValue . $product['id']; ?>" name="productId" value="<?php echo $product['id']; ?>" />
                      <input type="hidden" id="currentPageId<?php echo $randamValue . $product['id']; ?>" name="currentPage" value="<?php echo $currentPage; ?>">
                      <input type="hidden" id="addCartButtonDivId<?php echo $randamValue . $product['id']; ?>" name="divId" value="addToCart<?php echo $randamValue . $product['id']; ?>">

                    </form>
                      <?php
                      if ($product['stock'] == 'Yes') {

                        if ($cart->productExistInCart($product['pid'])) { ?>
                          <a href="cart.php" ><i class="fa-solid fa-cart-shopping" style="color: #c50f13;"></i></a>

                        <?php } else { ?>

                          <a href="javascript:void(0)"  onclick="addToCart('addCart_<?= $randamValue . $product['id'] ?>','<?= $primaryClassName ?>');"><i class="fa-solid fa-cart-shopping" style="color: #c50f13;"></i></a>

                        <?php }
                      }  ?>
                      </div>
                                                 <!--<a><i class="fa-solid fa-cart-shopping" style="color: #c50f13;"></i></a>-->
                                                 <div class="mywishlistdiv addToWishList<?= $randamValue . $product['id'] ?>">
                                                     <div id="newWish_<?= $product['id'] ?>">
                                                        <?php if (!$wishList->productExistInWishList($product['id'])) { ?>
                                                            <span class="ans-wish"><a href="javascript:;" onclick="addToWishList(<?= $product['id']; ?>,this.id,'<?= $url; ?>')" id="addToWishList<?= $randamValue . $product['id'] ?>"><i class="fa-regular fa-heart"></i></a></span>
                                                        <?php } else { ?>
                                                            <span class="ans-wish"><a onclick="removeFromWishList(<?= $product['id']; ?>,this.id,'<?= $url; ?>')" id="addToWishList<?= $randamValue . $product['id'] ?>" href="javascript:;"><i class="fa fa-heart" aria-hidden="true" style="background-color: white;padding: 8px;color: red;border-radius: 17px;               border: 1px solid #e0e0e0;font-size: 16px;"></i></a></span>
                                                        <?php } ?>
                                                     </div>
                                                 </div>
                                             </div>
                                        </div>
                                      
                                        
                                    </div>
                                    <h6 class="title"><a
                                            href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $product['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $product['product_name']; ?></a>
                                    </h6>

                                    <div class="price-add_crt">
                                        <!-- Product Price -->
                                        <div class="product-price m-0">
                                            <!-- <span class="price old-price">₹99.00</span><span class="price">₹85.00</span> -->
                                            <div class="product-price"
                                                id="modelPrice<?= $randamValue . $product['id'] ?>">
                                                <?php
                                            $isdeal = $homePage->isDealByProduct($product['id']);
                                            if (!empty($isdeal)) {
                                                if ($isdeal[0]['stock'] != 0) {
                                            ?>
                                                    <span class="price"><?= $currency; ?><?= $isdeal[0]['price']; ?></span>
                                                    <span class="price old-price"><?= $currency; ?><?= $product['price']; ?></span>

                                                    <?php
                                                } else {
                                                    if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { ?>
                                                        <span class="price"><?= $currency; ?><?= $product['price']; ?></span>
                                                    <?php
                                                    } else { ?>
                                                        <span class="price"><?= $currency; ?><?= $product['discount']; ?></span>
                                                        <span class="price old-price"><?= $currency; ?><?= $product['price']; ?></span>

                                                    <?php
                                                    }
                                                }
                                            } else {
                                                if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { ?>
                                                    <span class="price"><?= $currency; ?><?= $product['price']; ?></span>
                                                <?php
                                                } else { ?>
                                                    <span class="price"><?= $currency; ?><?= $product['discount']; ?></span>
                                                    <span class="price old-price"><?= $currency; ?><?= $product['price']; ?></span>

                                            <?php
                                                }
                                            } ?>

                                            </div>
                                        </div>
                                        <!-- End Product Price -->
                                        
                                        <!--Added Cart Icon-->
                                            <!--<div>-->
                                            <!--    <a><i class="fa-solid fa-cart-shopping" style="color: #c50f13;"></i></a>-->
                                            <!--</div>-->
                                        <!--++++++++++++++++++++++-->
                                        
                                        <form class="addItemToCartModel" id="addCart_<?= $randamValue . $product['id'] ?>" method="post" action="javascript:void(null)">

                                            <input type="hidden" name="productId" value="<?php echo $product['id'];?>" />
                                            <input type="hidden" name="currentPage" value="<?= $currentPage; ?>">
                                            <input type="hidden" name="divId" value="addToCart<?= $randamValue . $product['id'] ?>" />
                                            <input type="hidden" name="productSize" value="<?php echo $product['id'];?>">
                                            
                                            <div class="button-left">
                                
                                                <?php
                                                // check product has stock
                                                if ($product['stock'] == 'Yes') {
                                                    //check product is exist in cart
                                                    if ($cart->productExistInCart($product['id'])) { ?>
                                                    
                                                <a class="btn hny_add buy_direct" href="checkout.php"><span class="text">Buy
                                                    Now</span></a>
                       
                                                <?php } else { ?>

                                                <a class="btn hny_add buy_direct" href="javascript:void(0);"
                                                    onclick="addToCart('addCart_<?= $randamValue . $product['id'] ?>','<?= $primaryClassName ?>' , 'buy_direct');"><span class="text">Buy
                                                    Now</span></a>

                                                <?php  }
                                                } else { ?>

                                                <a class="btn hny_add" href="javascript:void(0);"><span class="text">Out Of
                                                    Stock</span></a>
                                                <?php } ?>
                                                
                                                
                                                <!--End Cart Button-->
                                            </div>
                                            
                                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php $i2++;
                                } ?>
                       </div>
                </div>
                <?php $i++;
                    } ?>
            </div>
        </div>
    </div>
</section>
<!-- best-sellers-area-end -->


    <!-- special-products-area -->
    <section class="special-products-area gray-bg pt-30 pb-60">
        <div class="container">
            <div class="row align-items-end mb-50">
                <div class="col-md-7 col-sm-8">
                      <div class="bd-section-title">
                        <h3 class="title"> <?php
                                    $homeconfig = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `home` WHERE id = 1"));
                                    echo $homeconfig['name'];
                                ?> <span>be the first to see!</span></h3>
                        <!--<p>A virtual assistant collects the products from your list</p>-->
                    </div>

                </div>
                <div class="col-md-5 col-sm-4">
                    <div class="section-btn text-left text-md-right">
                        <ul class="nav nav-tabs ulks1" id="myTab" role="tablist">
                            <?php $allCats = $homePage->categories('new_arrivals');
                            $j = 1;
                            foreach ($allCats as $cat) {
                                $active = '';
                                if ($j == 1)
                                    $active = ' active';
                                $string = preg_replace('/\s+/', '', $cat['cat_name']); // Replaces all spaces with hyphens.

                                $catSlug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                                $j++;
                            ?>
                            <li class="nav-item" role="presentation">
                               
                                <a style="text-transform: uppercase;" class="nav-link <?= $active ?>" id="<?= $catSlug; ?>-tab3" data-toggle="tab" href="#<?= $catSlug; ?>-home3" role="tab" 
                                    aria-controls="<?= $catSlug; ?>home3" aria-selected="true"><?= $cat['cat_name']; ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="special-products-wrap">
                <div class="row">
                    <div class="col-3 d-none d-lg-block">
                        <div class="special-products-add">
                            <div class="sp-add-thumb">
                                <img src="assets/img/product/shop_discount_bg.jpg" alt="">
                            </div>
                            <div class="sp-add-content">
                                <span class="sub-title">healthy food</span>
                                <h4 class="title">baby favorite <b>Product</b></h4>
                            </div>
                        </div>
                    </div>

                    <div class="col-9">

                        <div class="tab-content" id="myTabContent">
                            <?php if (empty($allCats)) {
                                echo "<img  class='mx-auto my-auto d-block' src='asset/image/not-found.png' style='width: 300px;' alt=''>";
                            } ?>
                            <!-- tab foreach  -->
                            <?php
                            $i = 1;
                            foreach ($allCats as $cat) {
                                $string = preg_replace('/\s+/', '', $cat['cat_name']); // Replaces all spaces with hyphens.

                                $catSlug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                                ($i == 1) ? $class = 'active show' : $class = '';
                            ?>
                            <div class="tab-pane fade show <?= $class; ?>" id="<?= $catSlug; ?>-home3" role="tabpanel" aria-labelledby="<?= $catSlug; ?>-tab3">
                                <div class="your-class">


                                    <?php
                                        // print_r($homePage->productsByCategoryAndType($categories['id'], 'new_arrivals'));die();
                                        //show New Arrival Products
                                        $i2 = 1;
                                        foreach ($homePage->productsByCategoryAndType($cat['id'], 'new_arrivals') as $product) {
                                            $issubcategory = mysqli_fetch_assoc(mysqli_query($con, "SELECT c.issubcategory FROM category c  WHERE c.id=" . $product['cat_id']))['issubcategory'];


                                            if ($issubcategory == 'Yes') {
                                                // echo "SELECT classtype_id FROM subcategory WHERE id=".$product['subcat_id'];
                                                $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM subcategory WHERE id=" . $product['subcat_id']))['classtype_id']);
                                            } elseif ($issubcategory == 'No') {
                                                $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM category WHERE id=" . $product['cat_id']))['classtype_id']);
                                            }
                                            // print_r($issubcategory);
                                            // print_r( $product['cat_id']);
                                            // die();
                                            // print_r($product['subcat_id']);
                                            // print_r($query1);
                                            $classtypeName = array();
                                            $primaryClassName = "";

                                            $classtype1 = implode(", ", $query1);
                                            // echo $classtype1;
                                            // echo "SELECT id,name FROM classtype WHERE id IN($classtype1) GROUP BY id";
                                            $classtypeNameQuery = mysqli_query($con, "SELECT id,name FROM classtype WHERE id IN($classtype1) GROUP BY id");
                                            while ($row = mysqli_fetch_array($classtypeNameQuery)) {
                                                $classtypeName[] = array('id' => $row['id'], 'name' => $row['name']);
                                                $classtypeId12[] = $row['id'];
                                            }

                                            if ((count($query1)) == 3) {
                                                $k1 = array();
                                                foreach ($classtypeName as $k => $value) {
                                                    if ($query1[0] != $value['id']) {
                                                        $k1[] = $k;
                                                    }
                                                }
                                                $primaryClassName = ucfirst($classtypeName[$k1[0]]['name']) . '+' . ucfirst($classtypeName[$k1[1]]['name']);

                                                // $class="'".$query1[1]."','".$query1[2].",";
                                            } elseif (count($query1) == 2) {
                                                $primaryClassName = ucfirst($classtypeName[0]['name']);
                                                if ($query1[0] == $classtypeName[0]['id']) {
                                                    $primaryClassName = ucfirst($classtypeName[1]['name']);
                                                }
                                            } elseif (count($query1) == 1 && $query1[0] != 16) {
                                                $primaryClassName = ucfirst($classtypeName[0]['name']);
                                            }

                                            $randamValue = rand();

                                        ?>
                                    <div class="">
                                        <div class="sp-product-item mb-20">
                                            <div class="sp-product-thumb">
                                                 <img src="assets/img/medal.png" class="ansh-medal">
                                                <?php
                                                        if (isset($product['price']) && isset($product['discount']) && $product['discount'] < $product['price']) {
                                                            $price = $product['price'];
                                                            $discountedPrice = $product['discount'];

                                                            $off = $homePage->calculateDiscountPercentage($price, $discountedPrice);
                                                        ?>
                                                <span class="batch"
                                                    id="modelPer<?= $randamValue . $product['id'] ?>"><?= $off; ?>%</span>
                                                <?php } ?>
                                                <a
                                                    href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $product['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>">
                                                    <?php
                                                            //show Product Image
                                                            $images = $homePage->image('product', $product['product_code']);

                                                            if ($images == "") {
                                                            ?>
                                                    <img src="assets/img/product/pr-1.jpeg" alt=""></a>

                                                <?php
                                                            } else {
                                                                $imageCount = count($images);
                                                    ?>
                                                <img src="asset/image/product/<?= $images[0]['image']; ?>" alt=""></a>
                                                <?php
                                                            }

                                                    ?>
                                            </div>
                                            <div class="sp-product-content">
                                                <div class="rating">
                                                     <div class="row">
                                            <div class="col-lg-7 col-md-6 col-6">
                                                  <?php $catq = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM category WHERE id = " . $product['cat_id']));
                                                    if (!empty($catq)) {
                                                        $catName = $catq['cat_name'];
                                                    } else {
                                                        $catName = '';
                                                    } ?>
                                        <span><?= $catName; ?></span>
                                            </div>
                                             <div class="col-lg-5 col-md-6 col-6 msg_card">
                                                 <div id="top_<?= $product['id'] ?>">
                                                     <form class="addItemToCartModel" id="addCart_<?php echo $randamValue . $product['id']; ?>" method="post" action="javascript:void(null)">
                      <input type="hidden" id="modelProductId<?php echo $randamValue . $product['id']; ?>" name="productId" value="<?php echo $product['id']; ?>" />
                      <input type="hidden" id="currentPageId<?php echo $randamValue . $product['id']; ?>" name="currentPage" value="<?php echo $currentPage; ?>">
                      <input type="hidden" id="addCartButtonDivId<?php echo $randamValue . $product['id']; ?>" name="divId" value="addToCart<?php echo $randamValue . $product['id']; ?>">

                    </form>
                      <?php
                      if ($product['stock'] == 'Yes') {

                        if ($cart->productExistInCart($product['pid'])) { ?>
                          <a href="cart.php" ><i class="fa-solid fa-cart-shopping" style="color: #c50f13;"></i></a>

                        <?php } else { ?>

                          <a href="javascript:void(0)"  onclick="addToCart('addCart_<?= $randamValue . $product['id'] ?>','<?= $primaryClassName ?>');"><i class="fa-solid fa-cart-shopping" style="color: #c50f13;"></i></a>

                        <?php }
                      }  ?>
                      </div>
                                                 <div class="mywishlistdiv addToWishList<?= $randamValue . $product['id'] ?>">
                                                     <div id="topWish_<?= $product['id'] ?>">
                                                        <?php if (!$wishList->productExistInWishList($product['id'])) { ?>
                                                            <span class="ans-wish"><a href="javascript:;" onclick="addToWishList(<?= $product['id']; ?>,this.id,'<?= $url; ?>')" id="addToWishList<?= $randamValue . $product['id'] ?>"><i class="fa-regular fa-heart"></i></a></span>
                                                        <?php } else { ?>
                                                            <span class="ans-wish"><a onclick="removeFromWishList(<?= $product['id']; ?>,this.id,'<?= $url; ?>')" id="addToWishList<?= $randamValue . $product['id'] ?>" href="javascript:;"><i class="fa fa-heart" aria-hidden="true" style="background-color: white;padding: 8px;color: red;border-radius: 17px;               border: 1px solid #e0e0e0;font-size: 16px;"></i></a></span>
                                                        <?php } ?>
                                                     </div>
                                                 </div>
                                             </div>
                                             
                                        </div>
                                                </div>
                                                <h6 class="title"><a
                                                        href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $product['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $product['product_name']; ?></a>
                                                </h6>

                                                <div class="price-add_crt">
                                                    <!-- Product Price -->
                                                    <div class="product-price m-0">
                                                        <!-- <span class="price old-price">₹99.00</span><span class="price">₹85.00</span> -->
                                                        <div class="product-price"
                                                            id="modelPrice<?= $randamValue . $product['id'] ?>">
                                                            <?php
                                            $isdeal = $homePage->isDealByProduct($product['id']);
                                            if (!empty($isdeal)) {
                                                if ($isdeal[0]['stock'] != 0) {
                                            ?>
                                                    <span class="price"><?= $currency; ?><?= $isdeal[0]['price']; ?></span>
                                                    <span class="price old-price"><?= $currency; ?><?= $product['price']; ?></span>

                                                    <?php
                                                } else {
                                                    if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { ?>
                                                        <span class="price"><?= $currency; ?><?= $product['price']; ?></span>
                                                    <?php
                                                    } else { ?>
                                                        <span class="price"><?= $currency; ?><?= $product['discount']; ?></span>
                                                        <span class="price old-price"><?= $currency; ?><?= $product['price']; ?></span>

                                                    <?php
                                                    }
                                                }
                                            } else {
                                                if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { ?>
                                                    <span class="price"><?= $currency; ?><?= $product['price']; ?></span>
                                                <?php
                                                } else { ?>
                                                    <span class="price"><?= $currency; ?><?= $product['discount']; ?></span>
                                                    <span class="price old-price"><?= $currency; ?><?= $product['price']; ?></span>

                                            <?php
                                                }
                                            } ?>

                                                        </div>
                                                    </div>
                                                    <!-- End Product Price -->
                                                 <form class="addItemToCartModel" id="addCart_<?= $randamValue . $product['id'] ?>" method="post" action="javascript:void(null)">

                                            <input type="hidden" name="productId" value="<?php echo $product['id'];?>" />
                                            <input type="hidden" name="currentPage" value="<?= $currentPage; ?>">
                                            <input type="hidden" name="divId" value="addToCart<?= $randamValue . $product['id'] ?>" />
                                            <input type="hidden" name="productSize" value="<?php echo $product['id'];?>">
                                            
                                            <div class="button-left">
                                
                                                <?php
                                                // check product has stock
                                                if ($product['stock'] == 'Yes') {
                                                    //check product is exist in cart
                                                    if ($cart->productExistInCart($product['id'])) { ?>
                                                    
                                                <a class="btn hny_add buy_direct" href="checkout.php"><span class="text">Buy
                                                    Now</span></a>
                       
                                                <?php } else { ?>

                                                <a class="btn hny_add buy_direct" href="javascript:void(0);"
                                                    onclick="addToCart('addCart_<?= $randamValue . $product['id'] ?>','<?= $primaryClassName ?>' , 'buy_direct');"><span class="text">Buy
                                                    Now</span></a>

                                                <?php  }
                                                } else { ?>

                                                <a class="btn hny_add" href="javascript:void(0);"><span class="text">Out Of
                                                    Stock</span></a>
                                                <?php } ?>
                                                
                                                
                                                <!--End Cart Button-->
                                            </div>
                                            
                                            </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php $i2++;
                                        } ?>

                                </div>
                            </div>
                            <?php $i++;
                            } ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- special-products-area-end -->

    <!-- coupon-area -->
    <div class="coupon-area gray-bg pb-30">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="coupon-bg">
                        <div class="coupon-title">
                            <span>Use coupon Code</span>
                            <h3 class="title">Get &#8377;3 Discount Code</h3>
                        </div>
                        <div class="coupon-code-wrap">
                            <h5 class="code">ganic21abs</h5>
                            <img src="assets/img/images/coupon_code.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- coupon-area-end -->


    <!-- best-sellers-area -->
    <section class="best-sellers-area pt-30">
        <div class="container">
            <div class="row align-items-end mb-50">
                <div class="col-md-7 col-sm-8">
                    <div class="bd-section-title">
                        <h3 class="title"><?php
                            $homeconfig2 = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM `home` WHERE id = 2"));
                            echo $homeconfig2['name'];
                        ?> <span>of this Week!</span></h3>
                        <!--<p>A virtual assistant collects the products from your list</p>-->
                        <?php
                        $allCats = $homePage->categories('hot_deals'); ?>
                    </div>
                </div>
                <div class="col-md-5 col-sm-4">
                    <div class="section-btn text-left text-md-right">
                        <ul class="nav nav-tabs ulks1" id="myTab" role="tablist">
                            <?php
                            $j = 1;
                            foreach ($allCats as $cat) {
                                $active = '';
                                if ($j == 1)
                                    $active = 'active';
                                $string = preg_replace('/\s+/', '', $cat['cat_name']); // Replaces all spaces with hyphens.

                                $catSlug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                                $j++;
                            ?>
                            <li class="nav-item" role="presentation">
                                <a style="text-transform: uppercase;" class="nav-link <?= $active ?>" id="<?= $catSlug; ?>-tab2" data-toggle="tab" href="#<?= $catSlug; ?>-home2" role="tab" 
                                    aria-controls="<?= $catSlug; ?>home2" aria-selected="true"><?= $cat['cat_name']; ?></a>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="best-sellers-products">
                <div class="tab-content" id="myTabContent">
                    <?php if (empty($allCats)) {
                        echo "<img  class='mx-auto my-auto d-block' src='asset/image/not-found.png' style='width: 300px;' alt=''>";
                    } ?>
                    <!-- tab foreach  -->
                    <?php
                    $i = 1;
                    foreach ($allCats as $cat) {
                        $string = preg_replace('/\s+/', '', $cat['cat_name']); // Replaces all spaces with hyphens.

                        $catSlug = preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
                        ($i == 1) ? $class = 'active show' : $class = '';
                    ?>
                    <div class="tab-pane fade show <?= $class; ?>" id="<?= $catSlug; ?>-home2" role="tabpanel" aria-labelledby="<?= $catSlug; ?>-tab2">
                        <div class="your-class">
                            <?php
                                // print_r($homePage->productsByCategoryAndType($categories['id'], 'new_arrivals'));die();
                                //show New Arrival Products
                                $i2 = 1;
                                foreach ($homePage->productsByCategoryAndType($cat['id'], 'hot_deals') as $product) {
                                    $issubcategory = mysqli_fetch_assoc(mysqli_query($con, "SELECT c.issubcategory FROM category c  WHERE c.id=" . $product['cat_id']))['issubcategory'];


                                    if ($issubcategory == 'Yes' && $product['subcat_id'] != '') {
                                        // echo "SELECT classtype_id FROM subcategory WHERE id=".$product['subcat_id'];
                                        $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM subcategory WHERE id=" . $product['subcat_id']))['classtype_id']);
                                    } else {
                                        $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM category WHERE id=" . $product['cat_id']))['classtype_id']);
                                    }
                                    // print_r($issubcategory);
                                    // print_r( $product['cat_id']);
                                    // die();
                                    // print_r($product['subcat_id']);
                                    // print_r($query1);
                                    $classtypeName = array();
                                    $primaryClassName = "";

                                    $classtype1 = implode(", ", $query1);
                                    // echo $classtype1;
                                    // echo "SELECT id,name FROM classtype WHERE id IN($classtype1) GROUP BY id";
                                    $classtypeNameQuery = mysqli_query($con, "SELECT id,name FROM classtype WHERE id IN($classtype1) GROUP BY id");
                                    while ($row = mysqli_fetch_array($classtypeNameQuery)) {
                                        $classtypeName[] = array('id' => $row['id'], 'name' => $row['name']);
                                        $classtypeId12[] = $row['id'];
                                    }

                                    if ((count($query1)) == 3) {
                                        $k1 = array();
                                        foreach ($classtypeName as $k => $value) {
                                            if ($query1[0] != $value['id']) {
                                                $k1[] = $k;
                                            }
                                        }
                                        $primaryClassName = ucfirst($classtypeName[$k1[0]]['name']) . '+' . ucfirst($classtypeName[$k1[1]]['name']);

                                        // $class="'".$query1[1]."','".$query1[2].",";
                                    } elseif (count($query1) == 2) {
                                        $primaryClassName = ucfirst($classtypeName[0]['name']);
                                        if ($query1[0] == $classtypeName[0]['id']) {
                                            $primaryClassName = ucfirst($classtypeName[1]['name']);
                                        }
                                    } elseif (count($query1) == 1 && $query1[0] != 16) {
                                        $primaryClassName = ucfirst($classtypeName[0]['name']);
                                    }

                                    $randamValue = rand();

                                ?>
                            <div class="">
                                <div class="sp-product-item mb-20">
                                    <div class="sp-product-thumb">
                                         <img src="assets/img/medal.png" class="ansh-medal">
                                        <?php
                                                if (isset($product['price']) && isset($product['discount']) && $product['discount'] < $product['price']) {
                                                    $price = $product['price'];
                                                    $discountedPrice = $product['discount'];

                                                    $off = $homePage->calculateDiscountPercentage($price, $discountedPrice);
                                                ?>
                                        <span class="batch"
                                            id="modelPer<?= $randamValue . $product['id'] ?>"><?= $off; ?>%</span>
                                        <?php } ?>
                                        <a
                                            href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $product['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>">
                                            <?php
                                                    //show Product Image
                                                    $images = $homePage->image('product', $product['product_code']);

                                                    if ($images == "") {
                                                    ?>
                                            <img src="assets/img/product/pr-1.jpeg" alt=""></a>

                                        <?php
                                                    } else {
                                                        $imageCount = count($images);
                                            ?>
                                        <img src="asset/image/product/<?= $images[0]['image']; ?>" alt=""></a>
                                        <?php
                                                    }

                                            ?>
                                    </div>
                                    <div class="sp-product-content">
                                        <div class="rating">
                                           <div class="row">
                                            <div class="col-lg-7 col-md-6 col-6">
                                                  <?php $catq = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM category WHERE id = " . $product['cat_id']));
                                                    if (!empty($catq)) {
                                                        $catName = $catq['cat_name'];
                                                    } else {
                                                        $catName = '';
                                                    } ?>
                                        <span><?= $catName; ?></span>
                                            </div>
                                             <div class="col-lg-5 col-md-6 col-6 msg_card">
                                                 <div id="best_<?= $product['id'] ?>">
                                                     <form class="addItemToCartModel" id="addCart_<?php echo $randamValue . $product['id']; ?>" method="post" action="javascript:void(null)">
                      <input type="hidden" id="modelProductId<?php echo $randamValue . $product['id']; ?>" name="productId" value="<?php echo $product['id']; ?>" />
                      <input type="hidden" id="currentPageId<?php echo $randamValue . $product['id']; ?>" name="currentPage" value="<?php echo $currentPage; ?>">
                      <input type="hidden" id="addCartButtonDivId<?php echo $randamValue . $product['id']; ?>" name="divId" value="addToCart<?php echo $randamValue . $product['id']; ?>">

                    </form>
                      <?php
                      if ($product['stock'] == 'Yes') {

                        if ($cart->productExistInCart($product['pid'])) { ?>
                          <a href="cart.php" ><i class="fa-solid fa-cart-shopping" style="color: #c50f13;"></i></a>

                        <?php } else { ?>

                          <a href="javascript:void(0)"  onclick="addToCart('addCart_<?= $randamValue . $product['id'] ?>','<?= $primaryClassName ?>');"><i class="fa-solid fa-cart-shopping" style="color: #c50f13;"></i></a>

                        <?php }
                      }  ?>
                      </div>
                                                 <div class="mywishlistdiv addToWishList<?= $randamValue . $product['id'] ?>">
                                                     <div id="bestWish_<?= $product['id'] ?>">
                                                        <?php if (!$wishList->productExistInWishList($product['id'])) { ?>
                                                            <span class="ans-wish"><a href="javascript:;" onclick="addToWishList(<?= $product['id']; ?>,this.id,'<?= $url; ?>')" id="addToWishList<?= $randamValue . $product['id'] ?>"><i class="fa-regular fa-heart"></i></a></span>
                                                        <?php } else { ?>
                                                            <span class="ans-wish"><a onclick="removeFromWishList(<?= $product['id']; ?>,this.id,'<?= $url; ?>')" id="addToWishList<?= $randamValue . $product['id'] ?>" href="javascript:;"><i class="fa fa-heart" aria-hidden="true" style="background-color: white;padding: 8px;color: red;border-radius: 17px;               border: 1px solid #e0e0e0;font-size: 16px;"></i></a></span>
                                                        <?php } ?>
                                                     </div>
                                                 </div>
                                             </div>
                                        </div>
                                        </div>
                                        <h6 class="title"><a
                                                href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $product['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $product['product_name']; ?></a>
                                        </h6>

                                        <div class="price-add_crt">
                                            <!-- Product Price -->
                                            <div class="product-price m-0">
                                                <!-- <span class="price old-price">₹99.00</span><span class="price">₹85.00</span> -->
                                                <div class="product-price"
                                                    id="modelPrice<?= $randamValue . $product['id'] ?>">
                                                    <?php
                                            $isdeal = $homePage->isDealByProduct($product['id']);
                                            if (!empty($isdeal)) {
                                                if ($isdeal[0]['stock'] != 0) {
                                            ?>
                                                    <span class="price"><?= $currency; ?><?= $isdeal[0]['price']; ?></span>
                                                    <span class="price old-price"><?= $currency; ?><?= $product['price']; ?></span>

                                                    <?php
                                                } else {
                                                    if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { ?>
                                                        <span class="price"><?= $currency; ?><?= $product['price']; ?></span>
                                                    <?php
                                                    } else { ?>
                                                        <span class="price"><?= $currency; ?><?= $product['discount']; ?></span>
                                                        <span class="price old-price"><?= $currency; ?><?= $product['price']; ?></span>

                                                    <?php
                                                    }
                                                }
                                            } else {
                                                if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { ?>
                                                    <span class="price"><?= $currency; ?><?= $product['price']; ?></span>
                                                <?php
                                                } else { ?>
                                                    <span class="price"><?= $currency; ?><?= $product['discount']; ?></span>
                                                    <span class="price old-price"><?= $currency; ?><?= $product['price']; ?></span>

                                            <?php
                                                }
                                            } ?>

                                                </div>
                                            </div>
                                            <!-- End Product Price -->
                                       <form class="addItemToCartModel" id="addCart_<?= $randamValue . $product['id'] ?>" method="post" action="javascript:void(null)">

                                            <input type="hidden" name="productId" value="<?php echo $product['id'];?>" />
                                            <input type="hidden" name="currentPage" value="<?= $currentPage; ?>">
                                            <input type="hidden" name="divId" value="addToCart<?= $randamValue . $product['id'] ?>" />
                                            <input type="hidden" name="productSize" value="<?php echo $product['id'];?>">
                                            
                                            <div class="button-left">
                                
                                                <?php
                                                // check product has stock
                                                if ($product['stock'] == 'Yes') {
                                                    //check product is exist in cart
                                                    if ($cart->productExistInCart($product['id'])) { ?>
                                                    
                                                <a class="btn hny_add buy_direct" href="checkout.php"><span class="text">Buy
                                                    Now</span></a>
                       
                                                <?php } else { ?>

                                                <a class="btn hny_add buy_direct" href="javascript:void(0);"
                                                    onclick="addToCart('addCart_<?= $randamValue . $product['id'] ?>','<?= $primaryClassName ?>' , 'buy_direct');"><span class="text">Buy
                                                    Now</span></a>

                                                <?php  }
                                                } else { ?>

                                                <a class="btn hny_add" href="javascript:void(0);"><span class="text">Out Of
                                                    Stock</span></a>
                                                <?php } ?>
                                                
                                                
                                                <!--End Cart Button-->
                                            </div>
                                            
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php $i2++;
                                } ?>
                        </div>
                    </div>
                    <?php $i++;
                    } ?>
                </div>
            </div>
        </div>
    </section>
    <!-- best-sellers-area-end -->
    
    
    
            <!-- slider-area -->
            <section class="slider-area advert_sec" >
                <div class="container custom-container">
                    <div class="row">
                          <div class="col-md-12 col-sm-8 mb-4">
                                <div class="bd-section-title">
                                    <h3 class="title">Advertising Offer <span>of this Week!</span></h3>
                                    <p>A virtual assistant collects the products from your list</p>
                                   
                                </div>
                            </div>
                            <?php
                            $query=mysqli_query($con,"SELECT * FROM `headerimage` WHERE `status` = 'Active' ORDER BY id DESC limit 3;"); 
                            
                            $count = 0; // Variable to track the loop iteration
                            
                            while($data=mysqli_fetch_array($query))
                            { 
                                if($count == 0) { // First row
                                    ?>
                                    <div class="col-lg-4 col-12">
                                        <div class="slider-banner-img mb-20">
                                            <?php if($data['click'] == 'Yes') { ?>
                                                <a href="javascript:void(0);"><img src="asset/image/header/<?php echo $data['header'];?>" alt=""></a>
                                            <?php } else { ?>
                                                <a href="javascript:void(0);"><img src="asset/image/header/<?php echo $data['header'];?>" alt=""></a>
                                            <?php }?>
                                        </div>
                                    </div>
                                <?php 
                                } elseif($count == 1) { // Second row, first col-3
                                    ?>
                                    <div class="col-lg-4 col-12">
                                        <div class="slider-banner-img mb-20">
                                            <?php if($data['click'] == 'Yes') { ?>
                                                <a href="javascript:void(0);"><img src="asset/image/header/<?php echo $data['header'];?>" alt=""></a>
                                            <?php } else { ?>
                                                <a href="javascript:void(0);"><img src="asset/image/header/<?php echo $data['header'];?>" alt=""></a>
                                            <?php }?>
                                        </div>
                                    </div>
                            
                                <?php }
                                 else { // Third row, last col-3
                                    ?>
                                    <div class="col-lg-4 col-12">
                                        <div class="slider-banner-img mb-20">
                                            <?php if($data['click'] == 'Yes') { ?>
                                                <a href="javascript:void(0);"><img src="asset/image/header/<?php echo $data['header'];?>" alt=""></a>
                                            <?php } else { ?>
                                                <a href="javascript:void(0);"><img src="asset/image/header/<?php echo $data['header'];?>" alt=""></a>
                                            <?php }?>
                                        </div>
                                    </div>
                                <?php 
                                }
                                $count++; // Increment the count
                            } 
                            ?>

                        
                    </div>
                </div>

             

            </section>
            <!-- slider-area-end -->
            
            <!--Testimonial Section-->

  <section class="testimonial">
        <div class="container">
              <div class="bd-section-title">
            <h3 class="title">A Testimonial of <span> Remarkable Support</span></h3>
            </div>
            <div class="row ">
                <div class="col-lg-12">
                    <div class="row p-5 bg-white ">
                        <div class="col-lg-12 d-flex justify-content-center align-items-center">
                            <div class="swiper mySwiper1">
                                <div class="swiper-wrapper" >
                                    
                                      <?php
            $gettesti = mysqli_query($con, "SELECT * FROM `testimonial` WHERE `trash`='0' and status='1' ORDER BY `id` DESC");
            while ($gettestiData = mysqli_fetch_array($gettesti)) {

            ?>
                                  <div class="swiper-slide"style="border:2px solid gray; padding:20px;border-radius: 10px;">
                                        <div class="quote-wrapper">
                                            <p class="text-justify"><?php echo $gettestiData['content'];?></p>
                                            <h3><?php echo $gettestiData['name'];?></h3>
                                        </div>
                                    </div>
                                    
                                    <?php }?>
                                    
                                   
                                </div>
                                <!--<div class="swiper-pagination"></div>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!--Blog Section-->
    
<!--<section class="blog_msg">-->
<!--    <div class="container">-->
<!--        <div class="row">-->
<!--            <div class="col-12">-->
<!--                 <div class="bd-section-title">-->
<!--                       <h3 class="title">Explore <span>Our Latest Blog's</span></h3>-->
<!--                   </div>-->
<!--            </div>-->
<!--        </div>-->

   
<!-- <div class="ans_blog">-->
<!--   <div class="swiper mySwiper">-->
<!--    <div class="swiper-wrapper">-->
<!--      <div class="swiper-slide">-->
<!--          <div class="post">-->
<!--												<div class="thumb rounded">-->
<!--													<a href="javascript:;" class="category-badge position-absolute">Giselle Fernandez category</a>-->
<!--													<span class="post-format">-->
<!--														<i class="fa fa-image"></i>-->
<!--													</span>-->
<!--													<a href="javascript;;">-->
<!--														<div class="inner">-->
<!--															 <img src="https://micodetest.com/msg_updated/blog/upload/blog_cover/blog70298.jpg" alt="post-title" /> -->
<!--														</div>-->
<!--													</a>-->
<!--												</div>-->
<!--												<ul class="meta list-inline mt-4 mb-0">-->
<!--													<li class="list-inline-item">-->
<!--													    <img src="https://micodetest.com/msg_updated/blog/images/logo_big.png" width="40" class="author authorsrb" alt="author" /> Maisha Infotech</li>-->
<!--													<li class="list-inline-item">2023-07-17</li>-->
<!--												</ul>-->
<!--												<h5 class="post-title mb-3 mt-3"><a href="javascript;;">Four Impactful Tips for Designing an Effective Landing Page</a></h5>-->
<!--												<div class="excerpt mb-0 srb-hom-dec">-->
<!--												    <p>Maisha Infotech is the most <a href="https://maishainfotech.com/" target="_blank">-->
<!--												        Leading Website Designing Company in Delhi </a>offers the web design strategies,</div>-->
<!--											</div>-->
<!--      </div>-->
<!--      <div class="swiper-slide">-->
<!--           <div class="post">-->
<!--												<div class="thumb rounded">-->
<!--													<a href="javascript:;" class="category-badge position-absolute">Giselle Fernandez category</a>-->
<!--													<span class="post-format">-->
<!--														<i class="fa fa-image"></i>-->
<!--													</span>-->
<!--													<a href="javascript;;">-->
<!--														<div class="inner">-->
<!--															 <img src="https://micodetest.com/msg_updated/blog/upload/blog_cover/blog70298.jpg" alt="post-title" /> -->
<!--														</div>-->
<!--													</a>-->
<!--												</div>-->
<!--												<ul class="meta list-inline mt-4 mb-0">-->
<!--													<li class="list-inline-item">-->
<!--													    <img src="https://micodetest.com/msg_updated/blog/images/logo_big.png" width="40" class="author authorsrb" alt="author" /> Maisha Infotech</li>-->
<!--													<li class="list-inline-item">2023-07-17</li>-->
<!--												</ul>-->
<!--												<h5 class="post-title mb-3 mt-3"><a href="javascript;;">Four Impactful Tips for Designing an Effective Landing Page</a></h5>-->
<!--												<div class="excerpt mb-0 srb-hom-dec">-->
<!--												    <p>Maisha Infotech is the most <a href="https://maishainfotech.com/" target="_blank">-->
<!--												        Leading Website Designing Company in Delhi </a>offers the web design strategies,</div>-->
<!--											</div>-->
<!--      </div>-->
<!--      <div class="swiper-slide">-->
<!--           <div class="post">-->
<!--												<div class="thumb rounded">-->
<!--													<a href="javascript:;" class="category-badge position-absolute">Giselle Fernandez category</a>-->
<!--													<span class="post-format">-->
<!--														<i class="fa fa-image"></i>-->
<!--													</span>-->
<!--													<a href="javascript;;">-->
<!--														<div class="inner">-->
<!--															 <img src="https://micodetest.com/msg_updated/blog/upload/blog_cover/blog70298.jpg" alt="post-title" /> -->
<!--														</div>-->
<!--													</a>-->
<!--												</div>-->
<!--												<ul class="meta list-inline mt-4 mb-0">-->
<!--													<li class="list-inline-item">-->
<!--													    <img src="https://micodetest.com/msg_updated/blog/images/logo_big.png" width="40" class="author authorsrb" alt="author" /> Maisha Infotech</li>-->
<!--													<li class="list-inline-item">2023-07-17</li>-->
<!--												</ul>-->
<!--												<h5 class="post-title mb-3 mt-3"><a href="javascript;;">Four Impactful Tips for Designing an Effective Landing Page</a></h5>-->
<!--												<div class="excerpt mb-0 srb-hom-dec">-->
<!--												    <p>Maisha Infotech is the most <a href="https://maishainfotech.com/" target="_blank">-->
<!--												        Leading Website Designing Company in Delhi </a>offers the web design strategies,</div>-->
<!--											</div>-->
<!--      </div>-->
<!--      <div class="swiper-slide">-->
<!--           <div class="post">-->
<!--												<div class="thumb rounded">-->
<!--													<a href="javascript:;" class="category-badge position-absolute">Giselle Fernandez category</a>-->
<!--													<span class="post-format">-->
<!--														<i class="fa fa-image"></i>-->
<!--													</span>-->
<!--													<a href="javascript;;">-->
<!--														<div class="inner">-->
<!--															 <img src="https://micodetest.com/msg_updated/blog/upload/blog_cover/blog70298.jpg" alt="post-title" /> -->
<!--														</div>-->
<!--													</a>-->
<!--												</div>-->
<!--												<ul class="meta list-inline mt-4 mb-0">-->
<!--													<li class="list-inline-item">-->
<!--													    <img src="https://micodetest.com/msg_updated/blog/images/logo_big.png" width="40" class="author authorsrb" alt="author" /> Maisha Infotech</li>-->
<!--													<li class="list-inline-item">2023-07-17</li>-->
<!--												</ul>-->
<!--												<h5 class="post-title mb-3 mt-3"><a href="javascript;;">Four Impactful Tips for Designing an Effective Landing Page</a></h5>-->
<!--												<div class="excerpt mb-0 srb-hom-dec">-->
<!--												    <p>Maisha Infotech is the most <a href="https://maishainfotech.com/" target="_blank">-->
<!--												        Leading Website Designing Company in Delhi </a>offers the web design strategies,</div>-->
<!--											</div>-->
<!--      </div>-->
<!--      <div class="swiper-slide">-->
<!--           <div class="post">-->
<!--												<div class="thumb rounded">-->
<!--													<a href="javascript:;" class="category-badge position-absolute">Giselle Fernandez category</a>-->
<!--													<span class="post-format">-->
<!--														<i class="fa fa-image"></i>-->
<!--													</span>-->
<!--													<a href="javascript;;">-->
<!--														<div class="inner">-->
<!--															 <img src="https://micodetest.com/msg_updated/blog/upload/blog_cover/blog70298.jpg" alt="post-title" /> -->
<!--														</div>-->
<!--													</a>-->
<!--												</div>-->
<!--												<ul class="meta list-inline mt-4 mb-0">-->
<!--													<li class="list-inline-item">-->
<!--													    <img src="https://micodetest.com/msg_updated/blog/images/logo_big.png" width="40" class="author authorsrb" alt="author" /> Maisha Infotech</li>-->
<!--													<li class="list-inline-item">2023-07-17</li>-->
<!--												</ul>-->
<!--												<h5 class="post-title mb-3 mt-3"><a href="javascript;;">Four Impactful Tips for Designing an Effective Landing Page</a></h5>-->
<!--												<div class="excerpt mb-0 srb-hom-dec">-->
<!--												    <p>Maisha Infotech is the most <a href="https://maishainfotech.com/" target="_blank">-->
<!--												        Leading Website Designing Company in Delhi </a>offers the web design strategies,</div>-->
<!--											</div>-->
<!--      </div>-->
<!--      <div class="swiper-slide">-->
<!--           <div class="post">-->
<!--												<div class="thumb rounded">-->
<!--													<a href="javascript:;" class="category-badge position-absolute">Giselle Fernandez category</a>-->
<!--													<span class="post-format">-->
<!--														<i class="fa fa-image"></i>-->
<!--													</span>-->
<!--													<a href="javascript;;">-->
<!--														<div class="inner">-->
<!--															 <img src="https://micodetest.com/msg_updated/blog/upload/blog_cover/blog70298.jpg" alt="post-title" /> -->
<!--														</div>-->
<!--													</a>-->
<!--												</div>-->
<!--												<ul class="meta list-inline mt-4 mb-0">-->
<!--													<li class="list-inline-item">-->
<!--													    <img src="https://micodetest.com/msg_updated/blog/images/logo_big.png" width="40" class="author authorsrb" alt="author" /> Maisha Infotech</li>-->
<!--													<li class="list-inline-item">2023-07-17</li>-->
<!--												</ul>-->
<!--												<h5 class="post-title mb-3 mt-3"><a href="javascript;;">Four Impactful Tips for Designing an Effective Landing Page</a></h5>-->
<!--												<div class="excerpt mb-0 srb-hom-dec">-->
<!--												    <p>Maisha Infotech is the most <a href="https://maishainfotech.com/" target="_blank">-->
<!--												        Leading Website Designing Company in Delhi </a>offers the web design strategies,</div>-->
<!--											</div>-->
<!--      </div>-->
<!--      <div class="swiper-slide">-->
<!--           <div class="post">-->
<!--												<div class="thumb rounded">-->
<!--													<a href="javascript:;" class="category-badge position-absolute">Giselle Fernandez category</a>-->
<!--													<span class="post-format">-->
<!--														<i class="fa fa-image"></i>-->
<!--													</span>-->
<!--													<a href="javascript;;">-->
<!--														<div class="inner">-->
<!--															 <img src="https://micodetest.com/msg_updated/blog/upload/blog_cover/blog70298.jpg" alt="post-title" /> -->
<!--														</div>-->
<!--													</a>-->
<!--												</div>-->
<!--												<ul class="meta list-inline mt-4 mb-0">-->
<!--													<li class="list-inline-item">-->
<!--													    <img src="https://micodetest.com/msg_updated/blog/images/logo_big.png" width="40" class="author authorsrb" alt="author" /> Maisha Infotech</li>-->
<!--													<li class="list-inline-item">2023-07-17</li>-->
<!--												</ul>-->
<!--												<h5 class="post-title mb-3 mt-3"><a href="javascript;;">Four Impactful Tips for Designing an Effective Landing Page</a></h5>-->
<!--												<div class="excerpt mb-0 srb-hom-dec">-->
<!--												    <p>Maisha Infotech is the most <a href="https://maishainfotech.com/" target="_blank">-->
<!--												        Leading Website Designing Company in Delhi </a>offers the web design strategies,</div>-->
<!--											</div>-->
<!--      </div>-->
<!--      <div class="swiper-slide">-->
<!--           <div class="post">-->
<!--												<div class="thumb rounded">-->
<!--													<a href="javascript:;" class="category-badge position-absolute">Giselle Fernandez category</a>-->
<!--													<span class="post-format">-->
<!--														<i class="fa fa-image"></i>-->
<!--													</span>-->
<!--													<a href="javascript;;">-->
<!--														<div class="inner">-->
<!--															 <img src="https://micodetest.com/msg_updated/blog/upload/blog_cover/blog70298.jpg" alt="post-title" /> -->
<!--														</div>-->
<!--													</a>-->
<!--												</div>-->
<!--												<ul class="meta list-inline mt-4 mb-0">-->
<!--													<li class="list-inline-item">-->
<!--													    <img src="https://micodetest.com/msg_updated/blog/images/logo_big.png" width="40" class="author authorsrb" alt="author" /> Maisha Infotech</li>-->
<!--													<li class="list-inline-item">2023-07-17</li>-->
<!--												</ul>-->
<!--												<h5 class="post-title mb-3 mt-3"><a href="javascript;;">Four Impactful Tips for Designing an Effective Landing Page</a></h5>-->
<!--												<div class="excerpt mb-0 srb-hom-dec">-->
<!--												    <p>Maisha Infotech is the most <a href="https://maishainfotech.com/" target="_blank">-->
<!--												        Leading Website Designing Company in Delhi </a>offers the web design strategies,</div>-->
<!--											</div>-->
<!--      </div>-->
<!--      <div class="swiper-slide">-->
<!--           <div class="post">-->
<!--												<div class="thumb rounded">-->
<!--													<a href="javascript:;" class="category-badge position-absolute">Giselle Fernandez category</a>-->
<!--													<span class="post-format">-->
<!--														<i class="fa fa-image"></i>-->
<!--													</span>-->
<!--													<a href="javascript;;">-->
<!--														<div class="inner">-->
<!--															 <img src="https://micodetest.com/msg_updated/blog/upload/blog_cover/blog70298.jpg" alt="post-title" /> -->
<!--														</div>-->
<!--													</a>-->
<!--												</div>-->
<!--												<ul class="meta list-inline mt-4 mb-0">-->
<!--													<li class="list-inline-item">-->
<!--													    <img src="https://micodetest.com/msg_updated/blog/images/logo_big.png" width="40" class="author authorsrb" alt="author" /> Maisha Infotech</li>-->
<!--													<li class="list-inline-item">2023-07-17</li>-->
<!--												</ul>-->
<!--												<h5 class="post-title mb-3 mt-3"><a href="javascript;;">Four Impactful Tips for Designing an Effective Landing Page</a></h5>-->
<!--												<div class="excerpt mb-0 srb-hom-dec">-->
<!--												    <p>Maisha Infotech is the most <a href="https://maishainfotech.com/" target="_blank">-->
<!--												        Leading Website Designing Company in Delhi </a>offers the web design strategies,</div>-->
<!--											</div>-->
<!--      </div>-->
<!--    </div>-->
<!--    <div class="swiper-pagination"></div>-->
<!--  </div>-->
<!--  </div>   -->
<!--  </div>-->
<!--</section>-->

</main>
<!-- main-area-end -->

<?php include('include/footer.php') ?>

<script>
    $(document).ready(function(){
  $(".testimonial .indicators li").click(function(){
    var i = $(this).index();
    var targetElement = $(".testimonial .tabs li");
    targetElement.eq(i).addClass('active');
    targetElement.not(targetElement[i]).removeClass('active');
            });
            $(".testimonial .tabs li").click(function(){
                var targetElement = $(".testimonial .tabs li");
                targetElement.addClass('active');
                targetElement.not($(this)).removeClass('active');
            });
        });
$(document).ready(function(){
    $(".slider .swiper-pagination span").each(function(i){
        $(this).text(i+1).prepend("0");
    });
});
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script>
    $(document).ready(function(){
        $('.your-class').slick({
 infinite: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>',
            prevArrow: '<button type="button" class="slick-prev"><i class="fa fa-chevron-left"></i></button>',
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    }
    
  ]
});
    });
  

    // Adjust slick position on tab change
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        $('.your-class').slick('setPosition');
    });
</script>




