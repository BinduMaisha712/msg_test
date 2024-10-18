<style>
    .quantity-button span i{
        font-size:20px
    }
/*    @media (max-width:767px){*/
/*.est-sellers-products{*/
/*.sp-product-content {*/
/*        padding: 26px 5px 7px;*/
/*    }*/
/*}*/

/*}*/
#socialShareContainer{
    position: relative;
}

#socialShare{
    display: none;
    position: absolute;
    position: absolute;
    top:109%;
    right: 18.125%;
    font-size: x-large;
    background: var(--color-primary) none repeat scroll 0 0;
    padding: 0.5rem 1.35rem;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 4px;
}

#socialShare a{
    color:white;
    text-decoration:none;
}

#socialShare a:hover{
    color:#bbb;
}


</style>

<?php



if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
    $url = "https://";
else
    $url = "http://";
// Append the host(domain name, ip) to the URL.   
$url .= $_SERVER['HTTP_HOST'];

// Append the requested resource location to the URL   
$url .= $_SERVER['REQUEST_URI'];

// echo $url;
// exit();
include('header.php');

//Show Product Details
if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $product = $homePage->getProductById($productId);
    $isdeal = $homePage->isDealByProduct($productId);
    // echo '<pre>';
} else {
?>
    <script type="text/javascript">
        window.location.href = "index.php";
    </script>
<?php
}
?>
<style>
    .discription {
        max-height: 160px;
        overflow: auto;
        height: auto;
    }

    .discription::-webkit-scrollbar {
        width: 5px;
    }

    span.new-price {
        margin-bottom: 1.1rem;
        color: #c50f13;
        font-size: 2rem;
        font-weight: 600;
        letter-spacing: -0.025em;
        line-height: 1;
        font-family: 'Syne';
    }

    .quantity3 label {
        font-family: 'Syne';
        font-size: 18px;
        font-weight: 700;
    }

    select.srb-dis {
        width: 200px;
        height: 37px;
        text-align: center;
        border: 1px solid gray;
        border-radius: 35px;
        margin-left: 15px;
        font-family: 'Syne';
        font-size: 16px;
    }

    .quantity3 {
        margin-bottom: 20px;
    }

    span.old-price {
        color: #999;
        padding-left: 5px;
        font-weight: 300;
        text-decoration: line-through;
    }

    .pro_discrptio {
        height: auto;
        overflow-y: auto;
        max-height: 150px;
    }

    .single-product-quantity {
        padding-top: 20px;
    }

    .pro_discrptio ul {
        padding-left: 0px !important;
    }

    .product-comment-content p {
        margin-bottom: 0px;
    }

    .product-comment {
        border-top: 1px solid;
    }

    .comment-rating.ratings-container i {
        color: #e03027;
    }

    .comment figure {
        margin-top: 16px;
    }

    span.comment-reply-title {
        font-size: 20px;
        text-transform: capitalize;
        font-weight: 800;
    }

    p.comment-notes {
        margin-bottom: 0px;
    }

    .ratings-container i {
        color: #e03027;
    }

    .slider {
        padding: 4px;
        color: #fff;
    }

    .slider .swiper-container {
        width: 100%;
        height: 100%;
        overflow: hidden;
    }

    .slider__flex {
        display: flex;
        align-items: flex-start;
    }

    .slider__col {
        display: flex;
        flex-direction: column;
        width: 150px;
        margin-right: 32px;
    }

    .slider__prev,
    .slider__next {
        cursor: pointer;
        text-align: center;
        font-size: 14px;
        height: 25px;
        display: flex;
        align-items: center;
        justify-content: center;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
        background-color: black;
        /*margin: 10px;*/
        border-radius: 6px;
    }

    .slider__prev:focus,
    .slider__next:focus {
        outline: none;
    }

    .slider__thumbs {
        height: calc(440px - 4px);
    }

    .slider__thumbs .slider__image {
        transition: 0.25s;
        -webkit-filter: grayscale(100%);
        filter: grayscale(100%);
        opacity: 0.5;
    }

    .slider__thumbs .slider__image:hover {
        opacity: 1;
    }

    .slider__thumbs .swiper-slide-thumb-active .slider__image {
        -webkit-filter: grayscale(0%);
        filter: grayscale(0%);
        opacity: 1;
    }

    .slider__images {
        height: 500px;
    }

    .slider__images .slider__image img {
        transition: 3s;
    }

    .slider__images .slider__image:hover img {
        transform: scale(1.1);
    }

    .slider__image {
        width: 100%;
        height: 100%;
        border-radius: 30px;
        overflow: hidden;
    }

    .slider__image img {
        display: block;
        width: 100%;
        height: 100%;
        -o-object-fit: cover;
        object-fit: cover;
    }

    @media (max-width: 767.98px) {
        .slider__flex {
            flex-direction: column-reverse;
        }

        .slider__col {
            flex-direction: row;
            align-items: center;
            margin-right: 0;
            margin-top: 24px;
            width: 100%;
        }

        .slider__images {
            width: 100%;
        }

        .slider__thumbs {
            height: 100px;
            width: calc(100% - 96px);
            margin: 0 16px;
        }

        .slider__prev,
        .slider__next {
            height: auto;
            width: 54px;
        }
        
        #socialShare{
            margin-top:4px;
            position: static !important;
        }
        
        #socialShareContainer{
            margin-top:4px;
        }
    }

    a#showReview {
        font-size: 13px;
    }
    .hereanch {
    font-size: 18px;
    border-radius: 50%;
    background-color: #f8e3d1;
    padding: 15px 15px !important;
}
.discription p, .discription span {
    color: black !important;
    font-size: 20px !important;
}
.description1 p, .description1 span {
    color: black !important;
    font-size: 20px !important;
}
</style>
<main class="main mt-6 single-product">
    <!-- breadcrumb-area -->
    <div class="breadcrumb-area breadcrumb-bg-two">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Shop Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->
    <div class="page-content" style=" background-color: #f6f4f5;">
        <div class="container">
            <div class="product product-single row mb-2">
                <div class="col-md-7">
                    <section class="slider">
                        <div class="slider__flex">
                            <div class="slider__col">

                                <div class="slider__prev">Prev</div>

                                <div class="slider__thumbs">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?php
                                            // echo '<pre>';
                                            // print_r($product);
                                            // exit();
                                            $a = 1;

                                            if ($product['images'] != 0) {
                                                // print_r($product['images']);
                                                foreach ($product['images'] as $image) {
                                                    $a++;
                                            ?>
                                                    <div class="swiper-slide">
                                                        <div class="slider__image "><img src="asset/image/product/<?= $image['image']; ?>" alt="" class="img-fluid" /></div>
                                                    </div>
                                                <?php }
                                            } else { ?>
                                                <figure class="product-image classfig">
                                                    <img src="asset/image/logo/logo-square.png" alt="product image" width="800" height="900" style="background-color: #f2f3f5;" />
                                                </figure>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="slider__next">Next</div>

                            </div>

                            <div class="slider__images">
                       
                                <div class="swiper-container">
                                    <div class="swiper-wrapper">
                                        <?php
                                        //SHow Single image
                                        if ($product['images'] != 0) {
                                            foreach ($product['images'] as $image) {
                                        ?>
                                                <div class="swiper-slide">
                                                    <div class="slider__image">      <img src="assets/img/medal.png" class="ansh-medal-detail"> <img src="asset/image/product/<?= $image['image']; ?>" alt="" /></div>
                                                </div>
                                            <?php }
                                        } else { ?>
                                            <div><img class="product-thumb active" src="asset/image/logo/logo-square.png" alt="product image" width="109" height="122" style="background-color: #f2f3f5;" /></div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </section>

                </div>
                <div class="col-md-5">
                    <div class="shop-details-content">
                        <?php

                        $catInfo = ($product['subcat_id'] == "") ? "cat_" . $product['cat_id'] : "subcat_" . $product['subcat_id'];

                        if ($product['issubcategory'] == 'Yes' && $product['subcat_id'] != '') {
                            $classtype_id = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM subcategory WHERE id=" . $product['subcat_id']))['classtype_id']);
                        } else {
                            $classtype_id = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM category WHERE id=" . $product['cat_id']))['classtype_id']);
                        }
                        $classtypeName = array();
                        $primaryClassName = "";
                        $classtype1 = implode(", ", $classtype_id);
                        $classtypeNameQuery = mysqli_query($con, "SELECT id,name FROM classtype WHERE id IN($classtype1) GROUP BY id");
                        while ($row = mysqli_fetch_array($classtypeNameQuery)) {
                            $classtypeName[] = array('id' => $row['id'], 'name' => $row['name']);
                            $classtypeId12[] = $row['id'];
                        }

                        if ((count($classtype_id)) == 3) {
                            $k1 = array();
                            foreach ($classtypeName as $k => $value) {

                                if ($classtype_id[0] != $value['id']) {
                                    $k1[] = $k;
                                } else {
                                    $secondId = $k;
                                }
                            }
                            $secondaryClassName = $classtypeName[$secondId]['name'];

                            $primaryClassName = ucfirst($classtypeName[$k1[0]]['name']) . '+' . ucfirst($classtypeName[$k1[1]]['name']);

                            // $class="'".$query1[1]."','".$query1[2].",";
                        } elseif (count($classtype_id) == 2) {

                            $secondaryClassName = $classtypeName[1]['name'];
                            $primaryClassName = $classtypeName[0]['name'];
                            if ($classtype_id[0] == $classtypeName[0]['id']) {
                                $primaryClassName = $classtypeName[1]['name'];
                                $secondaryClassName = $classtypeName[0]['name'];
                            }
                        } elseif (count($classtype_id) == 1 || $classtype_id[0] != 16) {
                            $primaryClassName = $classtypeName[0]['name'];
                        }


                        $colorName = "";
                        if (count($classtype_id) > 1)
                            $colorName = ", " . $product['class1'];
                        if ($product['class2'] != '')
                            $colorName .= ', ' . mysqli_fetch_assoc(mysqli_query($con, "SELECT symbol FROM size_class WHERE id=" . $product['class2']))['symbol'] . ', ' . mysqli_fetch_assoc(mysqli_query($con, "SELECT symbol FROM size_class WHERE id=" . $product['class0']))['symbol'];

                        ?>

                        <h4 class="title"><?= $product['product_name'] . $colorName ?></h4>
                        <div class="shop-details-meta">
                            <ul>
                                <li>Category : <a href="javascript:;"><?= $homePage->getCatName($catInfo); ?></a></li>
                                <li class="shop-details-review">
                                    <div class="rating">
                                        <?php
                                        $n = $product['avg_rating'];
                                        $whole = floor($n);
                                        $fraction = $n - $whole;

                                        for ($i = 0; $i < $whole; $i++) {
                                        ?>
                                            <i class="fas fa-star"></i>
                                        <?php
                                        }
                                        if ($fraction > 0.25) {
                                        ?>
                                            <i class="fas fa-star on-color"></i>
                                        <?php
                                        }
                                        ?>
                                        <a class="link-to-tab rating-reviews" id="showReview">( <?= $product['totalReview']; ?> Reviews )</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="shop-details-price">
                            <div class="product-price">

                                <?php if (!empty($isdeal)) {
                                    if ($isdeal[0]['stock'] != 0) {
                                        $datetime1 = date('Y-m-d H:i:s');
                                        $datetime2 = $isdeal[0]['enddate'] . ' ' . $isdeal[0]['endtime'];

                                        $origin = new DateTime($datetime1);
                                        $target = new DateTime($datetime2);
                                        $interval = $origin->diff($target);

                                        $second = ($interval->y * 365 * 24 * 3600) + ($interval->m * 30 * 24 * 3600) + ($interval->d * 24 * 3600) + $interval->h * 3600 + $interval->i * 60 + $interval->s;

                                ?>


                                        <span class="old-price"><?= $currency; ?><?= $product['price']; ?></span>
                                        <span class="new-price"><?= $currency; ?><?= $isdeal[0]['price']; ?></span>
                                        <p style="color: #ff0000; font-size: 12px; font-weight: 600; "> Hurry, Only <span style="background-color: #bb3874; color: #fff; padding: 2px 5px; margin: 0 5px;"><?= $isdeal[0]['stock']; ?> ITEMS</span> Left ! </p>
                                        <div class="deal_count">
                                            <p><span id="countdown"></span> Left for this Deal</p>
                                        </div>


                                        <?php
                                    } else {
                                        if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { ?>
                                            <span class="new-price"><?= $currency; ?><?= $product['price']; ?></span>
                                        <?php
                                        } else { ?>
                                            <span class="new-price"><?= $currency; ?><?= $product['discount']; ?></span>
                                            <span class="old-price"><?= $currency; ?><?= $product['price']; ?></span>

                                        <?php
                                        } ?>

                                    <?php
                                    }
                                } else {
                                    if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { ?>
                                        <span class="new-price"><?= $currency; ?><?= $product['price']; ?></span>
                                    <?php
                                    } else { ?>
                                        <span class="new-price"><?= $currency; ?><?= $product['discount']; ?></span>
                                        <span class="old-price"><?= $currency; ?><?= $product['price']; ?></span>

                                    <?php
                                    } ?>

                                <?php
                                } ?>

                            </div>
                            <!--<h5 class="stock-status">- IN Stock</h5>-->
                        </div>
                        <div class="discription">
                            <p> <?= $product['specification']; ?></p>
                        </div>
                        <div class="discription">
                            <p> <?= $product['description']; ?></p>
                        </div>

                        <form method="POST" class="addProductToCart" id="formId<?= $product['id']; ?>">

                            <input type="hidden" name="currentPage" value="<?= $currentPage; ?>">

                            <input type="hidden" id="cartProductId" name="productId" value="<?= $product['id']; ?>">

                            <div class="single-product-quantity">

                                <?php
                                if (count($classtype_id) > 1) {

                                    // echo '<pre>';

                                    // print_r($homePage->getProductSizes($product['product_code']));exit();


                                    $productColors = $homePage->getProductColors($product['group_code']);


                                ?>
                                    <div class="quantity3">
                                        <label class="newss"><?= ucfirst($secondaryClassName) ?></label>
                                        <select id="productColor" name="productColor" onchange="setCartId(this.value);getProductById();changeurlbyclass(this.value);">
                                            <option value="0" disabled>Select <?= ucfirst($secondaryClassName); ?></option>
                                            <?php
                                            foreach ($productColors as $color) {
                                                echo '<option value="' . $color['id'] . '"';

                                                if ($color['class1'] == $product['class1']) {
                                                    echo "selected";
                                                    $spclass = $color['class1'];
                                                }
                                                echo '>' . $color['class1'] . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                <?php
                                }

                                // echo 'cid is ';
                                // print_r($classtype_id);
                                if (($classtype_id[0] != 16) && (count($classtype_id) < 3)) { ?>
                                    <div class="quantity3">
                                        <label><?= ucfirst($primaryClassName); ?></label>
                                        <?php

                                        $productSizes = $homePage->productSizesByGroup($product['group_code']);

                                        ?>
                                        <select name="productSize" onchange="setCartId(this.value);getProductById();" class="srb-dis" required>
                                            <option value="0" disabled>Select <?= ucfirst($primaryClassName); ?></option>
                                            <?php
                                            if (count($classtype_id) == 2)
                                                $sizes = $homePage->sizesByClassType($classtype_id[1]);
                                            elseif (count($classtype_id) == 1 || $classtype_id[0] != 16)
                                                $sizes = $homePage->sizesByClassType($classtype_id[0]);

                                            // print_r($sizes);

                                            foreach ($sizes as $size) {
                                                if (count($classtype_id) > 1) {
                                                    echo $productsSizes = $homePage->productsSizesByGroup($product['group_code'], $size['id'], $spclass);

                                                    if (in_array($size['id'], $productSizes) && $spclass == $productsSizes) {
                                                        $pId = $homePage->productIdsByProductSize($product['group_code'], $size['id'], $spclass);
                                            ?>
                                                        <option id="productSize<?= $size['id'] ?>" value="<?= $pId; ?>" <?php
                                                                                                                        if ($size['id'] == $product['class0']) {
                                                                                                                            $spid = $pId;
                                                                                                                            echo 'selected';
                                                                                                                        } ?>>
                                                            <?= $size['symbol'] ?></option>
                                                    <?php
                                                    } else {
                                                    ?>
                                                    <?php
                                                    }
                                                } else {
                                                    if (in_array($size['id'], $productSizes)) {
                                                        $pId = $homePage->productIdByProductSize($product['group_code'], $size['id']);
                                                    ?>
                                                        <option id="productSize<?= $size['id'] ?>" value="<?= $pId; ?>" <?php
                                                                                                                        if ($size['id'] == $product['class0']) {
                                                                                                                            $spid = $pId;
                                                                                                                            echo 'selected';
                                                                                                                        } ?>>
                                                            <?= $size['symbol'] ?></option>
                                                    <?php
                                                    } 
                                                    ?>
                                                <?php
                                                    
                                                }
                                                ?>
                                            <?php

                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php
                                } elseif (count($classtype_id) == 3) {
                                ?>
                                    <div class="quantity3">
                                        <label><?= ucfirst($primaryClassName); ?></label>
                                        <?php

                                        $productSizes = $homePage->productSizesByGroup($product['group_code']);
                                        ?>
                                        <select name="productSize" onchange="setCartId(this.value);getProductById();" class="srb-dis" required>
                                            <option value="0" disabled>Select <?= ucfirst($primaryClassName); ?></option>
                                            <?php $sizes1 = $homePage->sizesByClassType($classtype_id[1]);
                                            $sizes = $homePage->sizesByClassType($classtype_id[2]);

                                            // print_r($sizes);
                                            foreach ($sizes1 as $v) {
                                                foreach ($sizes as $size) {
                                                    $people = array('0' => $v['id'], '1' => $size['id']);
                                                    $bFound = (count(array_intersect($productSizes, $people))) ? true : false;


                                                    $condition = 'class0=' . $v['id'] . ' AND class2=' . $size['id'];
                                                    $pId = $homePage->productIdByProductSizes($product['group_code'], $condition);
                                                    $c = '';
                                                    if (empty($pId))
                                                        $c = 'disabled style="background: #f5f5f5;color: red;"';
                                            ?>
                                                    <option id="productSize<?= $v['id'] . '_' . $size['id'] ?>" value="<?= $pId; ?>" <?= $c; ?> <?php if (($size['id'] == $product['class2']) && ($v['id'] == $product['class0'])) {
                                                                                                                                                    echo 'selected';
                                                                                                                                                } ?>><?= $v['symbol'] . '+' . $size['symbol'] ?></option>
                                            <?php

                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                <?php
                                } ?>
                                <?php
                                $randamValue = rand();
                                if ($cart->productExistInCart($product['id'])) { ?>
                                    <div class="btnDiv<?= $productId; ?>">
                                        <a href="cart.php" class="quantity-button btn btn-cart2" type="button" id="formId<?= $productId; ?>Button"><span>Go To Cart</span></a>
                                     

  
                                        <button type="button" class="quantity-button btn btn-cart2" onclick="removeFromCart(<?= $product['id']; ?>,'addToCart<?= $randamValue . $product['id'] ?>','<?= $primaryClassName; ?>')"><i class="fa fa-trash"></i></button>
                                    </div>
                                    <?php } else {
                                    if ($product['stock'] == 'Yes' && ($product['minimum'] <= $product['in_stock'])) {
                                    ?>
                                        <div class="btnDiv<?= $productId; ?>" id="socialShareContainer">
                                            <button class="quantity-button btn btn-cart2" type="submit" id="formId<?= $productId; ?>Button"><span>Add To Cart</span></button>
                                            <a href="contact.php" class="quantity-button btn btn-cart2" type="submit"><span>Ask Question</span></a>
                                            <!--<a href="javascript:;" class="quantity-button btn btn-cart2 cart-space" type="submit"><span><i class="fa-regular fa-heart"></i></span></a>-->
                                            
                                            
                                            <div class="btn" onclick="toggleDisplay()">share <i class="fa fa-share-nodes"></i></div>
                                            <div id="socialShare">
                                                <?php
                                                    $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
                                                    $host = $_SERVER['HTTP_HOST'];
                                                    $requestUri = $_SERVER['REQUEST_URI'];
                                                    // echo "Request Uri: $requestUri";
                                                    $productUrl = $protocol . $host . $requestUri;
                                                    $productTitle = "Hey! I found this amazing product, you please try once this : ".$product['product_name'].$colorName." | ".$homePage->getCatName($catInfo)." | ";
                                                    $whatsappMessage = $productTitle." ".$productUrl;
                                                    // echo "$productUrl";
                                                ?>
                                                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode($productUrl); ?>" target="__blank"><i class="fa-brands fa-square-facebook"></i></a>
                                                <a href="https://api.whatsapp.com/send?text=<?php echo urlencode($whatsappMessage); ?>" class="whatsapp mx-3" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                <a href="https://twitter.com/intent/tweet?url=<?php echo urlencode($productUrl); ?>&text=<?php echo urlencode($productTitle); ?>" target="__blank"><i class="fa-brands fa-square-twitter"></i></a>
                                                <!--<a href="#"><i class="fa-brands fa-square-instagram"></i></a>-->
                                                  
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>

                                        <button class="quantity-button btn btn-cart2" type="button" id="formId<?= $productId; ?>Button"><span>Out Of Stock</span></button>

                                    <?php
                                    }
                                    ?>
                                <?php } ?>



                            </div>
                        </form>
                        <div class="wislist-compare-btn">

                        </div>
                        <hr class="product-divider mb-3">

                    </div>


                </div>
            </div>


            <div class="row">
                <div class="col-12">
                    <div class="product-desc-wrap">
                        <ul class="nav nav-tabs" id="myTabTwo" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">Product Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="val-tab" data-toggle="tab" href="#val" role="tab" aria-controls="val" aria-selected="false">Reviews (<?= $product['totalReview']; ?>)</a>
                            </li>

                        </ul>
                        <div class="tab-content" id="myTabContentTwo">
                            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
                                <div class="product-desc-content">
                                    <div class="row">

                                        <div class="col-xl-9 col-md-7 description1">
                                            <p> <?= $product['description']; ?></p>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="val" role="tabpanel" aria-labelledby="val-tab">
                                <div class="tab-pane" id="product-tab-reviews">
                                    <div class="row" id="setReview">
                                        <div class="col-md-12">
                                            <div class="review-page-comment">
                                                <div class="review-comment">
                                                    <h5 class="description-title mb-3 font-weight-semi-bold ls-m">(<?= $product['totalReview']; ?>) review <br> <?= $product['product_name'] ?></h5>
                                                    <ul class="mb-5">

                                                        <?php
                                                        if ($product['reviews'] != '') {
                                                            foreach ($product['reviews'] as $review) {
                                                        ?>
                                                                <li>
                                                                    <div class="comment">
                                                                        <figure class="comment-media">
                                                                            <img src='assets/img/profile-img.jpg' width="100px" style="border:1px solid #d7d7d7; border-radius: 30px;">
                                                                        </figure>
                                                                        <div class="comment-body">
                                                                            <div class="comment-rating ratings-container">
                                                                                <?php
                                                                                $n = $review['star'];
                                                                                if ($n != "") {

                                                                                    $whole = floor($n);

                                                                                    $fraction = $n - $whole;

                                                                                    for ($i = 0; $i < $whole; $i++) {
                                                                                ?>
                                                                                        <i class="fa fa-star"></i>
                                                                                    <?php
                                                                                    }
                                                                                    if ($fraction > 0.25) {
                                                                                    ?>
                                                                                        <i class="fa fa-star-half-o"></i>
                                                                                <?php
                                                                                    }
                                                                                }
                                                                                ?>

                                                                            </div>
                                                                            <div class="comment-user">
                                                                                <span class="comment-date">by <span class="font-weight-semi-bold text-uppercase text-dark"><?= $review['firstname']; ?></span> on
                                                                                    <span class="font-weight-semi-bold text-dark"><?= $review['datentime']; ?></span></span>
                                                                            </div>
                                                                            <div class="comment-content">
                                                                                <p><?= $review['review']; ?></p>
                                                                                <strong><?= $review['review_title']; ?></strong>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </li>

                                                        <?php
                                                            }
                                                        } ?>
                                                    </ul>
                                                    <div class="review-form-wrapper">
                                                        <div class="review-form">
                                                            <span class="comment-reply-title">Add a review </span>
                                                            <form method="POST" action="javascript:;" class="addReview" id="addReview">
                                                                <input type="hidden" name="currentPage" value="<?= $currentPage; ?>">
                                                                <input type="hidden" name="productId" id="reviewProductId" value="<?= $product['id']; ?>">
                                                                <input type="hidden" name="url" id="pageUrl" value="<?= $url; ?>">
                                                                <p class="comment-notes">
                                                                    <span id="email-notes">Your email address will not be published.</span>
                                                                    Required fields are marked
                                                                    <span class="required">*</span>
                                                                </p>
                                                                <div class="comment-form-rating">
                                                                    <div class="star" style="float:left">
                                                                        <input class="star star-5" id="star-5" type="radio" name="starRating" value="5" />
                                                                        <label class="star star-5" for="star-5"></label>
                                                                        <input class="star star-4" id="star-4" type="radio" name="starRating" value="4" />
                                                                        <label class="star star-4" for="star-4"></label>
                                                                        <input class="star star-3" id="star-3" type="radio" name="starRating" value="3" />
                                                                        <label class="star star-3" for="star-3"></label>
                                                                        <input class="star star-2" id="star-2" type="radio" name="starRating" value="2" />
                                                                        <label class="star star-2" for="star-2"></label>
                                                                        <input class="star star-1" id="star-1" type="radio" name="starRating" value="1" />
                                                                        <label class="star star-1" for="star-1"></label>
                                                                    </div>

                                                                </div>

                                                                <div class="input-element">
                                                                    <div class="comment-form-comment">
                                                                        </br>
                                                                        </br>
                                                                        <div>

                                                                            <textarea name="comment" placeholder="Write a product review" id="review_comment" maxlength="500" cols="40" rows="8"></textarea>
                                                                        </div>

                                                                    </div>
                                                                </div>


                                                                <div class="comment-submit">
                                                                    <button type="submit" class="form-button btn btn-cart2" <?php if (!USER::isLoggedIn()) { ?> <?php } ?>>Submit</button>
                                                                </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- shop-details-area-end -->

        <?php
        //Show Related Products

        if ($product['subSubCat_id'] != "") {
            $getRelatedId = 'p.subSubCat_id="' . $product['subSubCat_id'] . '"';
        } else if ($product['subcat_id'] != "") {
            $getRelatedId = 'p.subcat_id="' . $product['subcat_id'] . '"';
        } else {
            $getRelatedId = 'p.cat_id="' . $product['cat_id'] . '"';
        }

        $relatedCondition = $getRelatedId . " AND p.product_code <> '" . $product['product_code'] . "'";

        ?>
        <!-- best-sellers-area -->
        <section class="best-sellers-area pt-85 pb-70">
            <div class="container">
                <div class="row align-items-end mb-40">
                    <div class="col-md-8 col-sm-9">
                        <div class="section-title">
                            <span class="sub-title">Related Products</span>
                            <h2 class="title">From this Collection</h2>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-12">
                        <?php
                        $relatedProducts = $homePage->products('related', $relatedCondition);
                        if (empty($relatedProducts)) {
                            echo "<div class='pt-5' style='background-color:#f5f9ff; align-items: center; width:100%; height:250px;'>";
                            echo "<img  class='rounded mx-auto my-auto d-block' src='asset/image/empty-product.png' style='height:50%' alt=''>";
                            echo "<h1 class='h1 text-center'>No Product Found!</h1>";
                            echo "</div>";
                        }
                        ?>
                    </div>
                </div>
                <div class="best-sellers-products">
                    <div class="row justify-content-center">
                        <?php

                        foreach ($relatedProducts as $product) {
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
                            <div class="col-3">
                                <div class="sp-product-item mb-20">
                                    <div class="sp-product-thumb">
                                        <?php
                                        if (isset($product['price']) && isset($product['discount']) && $product['discount'] < $product['price']) {
                                            $price = $product['price'];
                                            $discountedPrice = $product['discount'];

                                            $off = $homePage->calculateDiscountPercentage($price, $discountedPrice);
                                        ?>
                                            <span class="batch" id="modelPer<?= $randamValue . $product['id'] ?>"><?= $off; ?>%</span>
                                        <?php } ?>
                                        <a href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $product['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>">
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
                                        <img src="assets/img/medal.png" class="ansh-medal-detail">
                                        <img src="asset/image/product/<?= $images[0]['image']; ?>" alt=""></a>
                                    <?php
                                            }

                                    ?>
                                    </div>
                                    <div class="sp-product-content">
                                        <div class="rating">
                                                     <div class="row">
                                            <div class="col-lg-6 col-8">
                                                       <?php $catq = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM category WHERE id = " . $product['cat_id']));
                                            if (!empty($catq)) {
                                                $catName = $catq['cat_name'];
                                            } else {
                                                $catName = '';
                                            } ?>
                                            <span><?= $catName; ?></span>                                 
                                            </div>
                                             <div class="col-lg-6 col-4">
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
                                   
                                        <h6 class="title"><a href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $product['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $product['product_name']; ?></a></h6>

                                        <div class="price-add_crt">
                                            <!-- Product Price -->
                                            <div class="product-price m-0">
                                                <!-- <span class="price old-price">₹99.00</span><span class="price">₹85.00</span> -->
                                                <div class="product-price" id="modelPrice<?= $randamValue . $product['id'] ?>">
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
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- best-sellers-area-end -->
    </div>
    </div>
</main>

<?php include('include/footer.php') ?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/igorlino/elevatezoom-plus/1.1.6/src/jquery.ez-plus.js"></script>
<!-- Initialize Swiper -->
<script>
    const sliderThumbs = new Swiper('.slider__thumbs .swiper-container', {
        direction: 'vertical',
        slidesPerView: 3,
        spaceBetween: 24,
        navigation: {
            nextEl: '.slider__next',
            prevEl: '.slider__prev'
        },
        freeMode: true,
        breakpoints: {
            0: {
                direction: 'horizontal',
            },
            768: {
                direction: 'vertical',
            }
        }
    });
    const sliderImages = new Swiper('.slider__images .swiper-container', {
    direction: 'vertical',
    slidesPerView: 1,
    spaceBetween: 32,
    mousewheel: true,
    navigation: {
        nextEl: '.slider__next',
        prevEl: '.slider__prev'
    },
    grabCursor: true,
    thumbs: {
        swiper: sliderThumbs
    },
    breakpoints: {
        0: {
            direction: 'horizontal',
            slidesPerView: 1, // For widths below 768px, display only one slide
        },
        768: {
            direction: 'vertical',
            slidesPerView: 1, // For widths above or equal to 768px, display one slide as well
        }
    }
});

</script>
<script type="text/javascript">
    $(document).ready(function() {
        $("#zoom_03").ezPlus({
            gallery: 'gallery_01',
            cursor: 'pointer',
            galleryActiveClass: "active",
            imageCrossfade: true,
            loadingIcon: "http://www.elevateweb.co.uk/spinner.gif"
        });

        $("#zoom_03").bind("click", function(e) {
            var ez = $('#zoom_03').data('ezPlus');
            ez.closeAll(); //NEW: This function force hides the lens, tint and window
            $.fancyboxPlus(ez.getGalleryList());
            return false;
        });

    });
</script>
<script>
    function changeurlbyclass(value) {
        var pv = window.location.href.split("product_id=")[1].split("&")[0];
        var url = window.location.href.replace("product_id=" + pv, "product_id=" + value);
        $('.productdetails').load('product-detail.php?product_id=' + value + ' #sectionhtml');
        history.pushState(null, null, url);

        Swal.fire({
            title: "<span>Please Wait... <br> <div class='SWLoader'></div></span>",
            html: "Request under processing, please do not lock the screen or leave the page.",
            showCancelButton: false,
            showConfirmButton: false,
            allowOutsideClick: false,
            allowEscapeKey: false,
            timer: 2500,
        }).then(function() {
            reloadPageAssets('assets/js/slick/slick.js', 'assets/js/slick/custom_slick.js', 'js/easyzoom.min.js', 'assets/css/dist/easyzoom.js');
            reloadPageAssets('assets/js/shareButtons.min.js');
            var swiper = new Swiper(".mySwiper", {
                zoom: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
            easyzoomInit();

            shareSocialButtonInit();

        });

        setTimeout(function() {
            reloadPageAssets('assets/js/slick/slick.js', 'assets/js/slick/custom_slick.js', 'js/easyzoom.min.js', 'assets/css/dist/easyzoom.js');
            reloadPageAssets('assets/js/shareButtons.min.js');
            var swiper = new Swiper(".mySwiper", {
                zoom: true,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
            easyzoomInit();
        }, 1500);

        shareSocialButtonInit();

    }

    function openCartPage() {
        window.open("./cart.php", "_self")
    }
    
    function toggleDisplay(){
        let shareBtns = $('#socialShare');
        shareBtns.toggle();
    }
</script>