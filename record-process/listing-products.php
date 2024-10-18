<?php
require('../config.php');

// Determine the URL
$url = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https://" : "http://";
$url .= $_SERVER['HTTP_HOST'] . '/listing.php';

// Initialize response data
$data = array();
$result = '';
// print_r($_POST);

   if(isset($_POST['catType']))
    {
    // Construct condition based on category and listing ID
     $condition = "p." . $_POST['catType'] . "='" . $_POST['listingId'] . "'";

     // Check and update session filters
    if (isset($_SESSION['filter']['checked']['cat'])) {
        if (!in_array($condition, $_SESSION['filter']['checked']['cat'])) {
            $_SESSION['filter']['checked']['cat'][] = $condition;
        }
    } else {
        $_SESSION['filter']['checked']['cat'][] = $condition;
    }
    }
// Handle pagination
if (isset($_POST['pageNo'])) {
    $pageNo = $_POST['pageNo'];
    $limitFrom = (($pageNo - 1) * $listing->recordPerPage());
    $listing->limitFrom($limitFrom);
    $limitTo = ($limitFrom + $listing->recordPerPage());
    $listing->limitTo($limitTo);

    $_SESSION['limitFrom'] = $limitFrom;
    $_SESSION['limitTo'] = $limitTo;

    $_SESSION['fill'] = array(
        'filter' => $_SESSION['filter']['checked'],
        'class' => $_SESSION['classtype_id']
    );
}

// Handle price range filter
if (isset($_POST['priceRange'])) {
    $_SESSION['filter']['max'] = $_POST['maxPrice'];
    $_SESSION['filter']['min'] = $_POST['minPrice'];
    $_SESSION['fill'] = array(
        'filter' => $_SESSION['filter']['checked'],
        'class' => $_SESSION['classtype_id'],
        'max' => $_POST['maxPrice'],
        'min' => $_POST['minPrice']
    );
}

// Handle sorting order
if (isset($_POST['orderByVal'])) {
    unset($_SESSION['filter']['orderBy']);
    if ($_POST['orderByVal'] != 'popularity') {
        $_SESSION['filter']['orderBy'] = $_POST['orderByVal'];
    }
    $_SESSION['fill'] = array(
        'filter' => $_SESSION['filter']['checked'],
        'class' => $_SESSION['classtype_id']
    );
}

// Handle adding/removing filters
if (isset($_POST['action'])) {
    $type = $_POST['type'];
    
 

    if ($_POST['action'] == 'addFilter') {
        $classtype_id = isset($_POST['classtypeId']) ? explode(",", $_POST['classtypeId']) : array();

        if (isset($_SESSION['classtype_id'])) {
            foreach ($classtype_id as $value) {
                if (!in_array($value, $_SESSION['classtype_id'])) {
                    $_SESSION['classtype_id'][] = $value;
                }
            }
        } else {
            $_SESSION['classtype_id'] = $classtype_id;
        }

        if (!isset($_SESSION['filter']['checked'][$type])) {
            $_SESSION['filter']['checked'][$type] = array();
        }

        if (!in_array($_POST['condition'], $_SESSION['filter']['checked'][$type])) {
            $_SESSION['filter']['checked'][$type][] = $_POST['condition'];
        }
    }

    if ($_POST['action'] == 'removeFilter') {
        $condition = array($_POST['condition']);
        $classtype_id = isset($_POST['classtypeId']) ? explode(",", $_POST['classtypeId']) : array();

        if (isset($_SESSION['filter']['checked'][$type])) {
            $keys = array_keys(array_intersect($_SESSION['filter']['checked'][$type], $condition));
            foreach ($keys as $key) {
                unset($_SESSION['filter']['checked'][$type][$key]);
            }
        }

        if ($type == 'cat' && isset($_SESSION['classtype_id'])) {
            foreach ($_SESSION['classtype_id'] as $key => $value) {
                if (in_array($value, $classtype_id)) {
                    unset($_SESSION['classtype_id'][$key]);
                }
            }
        }
    }

    // Handle adding/removing ratings
    if ($_POST['action'] == 'addRating') {
        if (!isset($_SESSION['filter']['rating'])) {
            $_SESSION['filter']['rating'] = array();
        }

        if (!in_array($_POST['value'], $_SESSION['filter']['rating'])) {
            $_SESSION['filter']['rating'][] = $_POST['value'];
        }
    }

    if ($_POST['action'] == 'removeRating') {
        if (isset($_SESSION['filter']['rating'])) {
            $key = array_search($_POST['value'], $_SESSION['filter']['rating']);
            unset($_SESSION['filter']['rating'][$key]);
        }
    }

    $_SESSION['fill'] = array(
        'filter' => $_SESSION['filter']['checked'],
        'class' => $_SESSION['classtype_id']
    );
}

// Fetch filtered products
if (!empty($_POST['filtertype'])) {
    $products = $listing->filterProductsType($_POST['filtertype']);
} else {
    $products = $listing->filterProducts();
}

// print_r($products);
$html='';
if (empty($products)) {
    $html= '
    <div class="col-md-12 col-12">
        <div class="pt-5" style="background-color:#f5f9ff; align-items: center; width:100%; height:350px;">
            <img class="rounded mx-auto my-auto d-block" src="asset/image/img.png" style="height:60%" alt="">
            <h1 class="h1 text-center">We Couldn\'t find any matches!</h1>
        </div>
    </div>';

} else {
    
    $productCount = count($products);
    $productsPriceArr = [];
    foreach ($products as $product) {
        $issubcategory = mysqli_fetch_assoc(mysqli_query($con, "SELECT c.issubcategory FROM category c  WHERE c.id=" . $product['cat_id']))['issubcategory'];
        if ($issubcategory == 'Yes' &&  $product['subcat_id']!= '') {
            $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM subcategory WHERE id=" . $product['subcat_id']))['classtype_id']);
        } elseif ($issubcategory == 'No') {
            $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM category WHERE id=" . $product['cat_id']))['classtype_id']);
        }
        
        $classtypeName = array();
        $primaryClassName = "";
        $classtype1 = implode(", ", $query1);
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
        } elseif (count($query1) == 2) {
            $primaryClassName = ucfirst($classtypeName[0]['name']);
            if ($query1[0] == $classtypeName[0]['id']) {
                $primaryClassName = ucfirst($classtypeName[1]['name']);
            }
        } elseif (count($query1) == 1 && $query1[0] != 16) {
            $primaryClassName = ucfirst($classtypeName[0]['name']);
        }
        $randamValue = rand();

       $html=$html.'
<div class="col-xl-3 col-md-4 col-6">
    <div class="sp-product-item">
        <div class="sp-product-thumb">';
        if (isset($product['price']) && isset($product['discount']) && $product['discount'] < $product['price']) {
            $price = $product['price'];
            $discountedPrice = $product['discount'];
            $off = $homePage->calculateDiscountPercentage($price, $discountedPrice);
            $html=$html.'<span class="batch" id="modelPer' . $randamValue . $product['id'] . '">' . $off . '%</span>';
        }
        $html=$html.'<a href="product-detail.php?' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '&product_id=' . $product['id'] . '&' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '">';
            $image = $homePage->image('product', $product['product_code']);
            if (empty($image)) {
                $html=$html.'<img src="asset/image/placeholder.png" class="img-fluid bg-img" onerror="this.onerror=null;this.src=\'' . ($ImgSrcError ?? '') . '\';">';
            } else {
                $html=$html.'<img src="assets/img/medal.png" class="ansh-medal-detail">';
                $html=$html.'<img src="asset/image/product/' . $image[0]['image'] . '" class="img-fluid bg-img" onerror="this.onerror=null;this.src=\'' . ($ImgSrcError ?? '') . '\';">';
            }
        $html=$html.'</a></div>
        <div class="sp-product-content">
            <div class="rating d-flex justify-content-between">
                <span>' . number_format($product['avg_rating'], 1) . ' <i class="fas fa-star"></i> </span>';
                $catId = $product['cat_id'];
                $catName = mysqli_fetch_assoc(mysqli_query($con, "SELECT cat_name FROM category WHERE id = '$catId' AND status = 'active'"))['cat_name'];
                $html=$html.'<span>' . $catName . '</span>
            </div>
            <div class="row">
                <div class="col-lg-9 col-10 wish_ans">
                    <h6 class="title"><a href="product-detail.php?' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '&product_id=' . $product['id'] . '&' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '">' . $product['product_name'] . '</a></h6>
                </div>
                <div class="col-lg-3 col-2">
                    <div class="mywishlistdiv addToWishList' . $randamValue . $product['id'] . '">
                        <div id="newWish_' . $product['id'] . '">';
                            if (!$wishList->productExistInWishList($product['id'])) {
                                $html=$html.'<span class="ans-wish"><a href="javascript:;" onclick="addToWishList(' . $product['id'] . ',this.id,\'' . $url . '\')" id="addToWishList' . $randamValue . $product['id'] . '"><i class="fa-regular fa-heart"></i></a></span>';
                            } else {
                                $html=$html.'<span class="ans-wish"><a onclick="removeFromWishList(' . $product['id'] . ',this.id,\'' . $url . '\')" id="addToWishList' . $randamValue . $product['id'] . '" href="javascript:;"><i class="fa fa-heart" aria-hidden="true" style="background-color: white;padding: 8px;color: red;border-radius: 17px; border: 1px solid #e0e0e0;font-size: 16px;"></i></a></span>';
                            }
                        $html=$html.'</div>
                    </div>
                </div>
            </div>
            <div class="price" style="display: flex;justify-content: space-between;">
                <h5 class="price"><span class="theme-color">';
                $isdeal = $homePage->isDealByProduct($product['id']);
                if (!empty($isdeal)) {
                    if ($isdeal[0]['stock'] != 0) {
                        $html=$html.'<span class="price-new">' . $currency . $isdeal[0]['price'] . '</span>';
                        $html=$html.'<span class="price-old"><del>' . $currency . $product['price'] . '</del></span>';
                    } else {
                        if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) {
                            $html=$html.'<span class="price-new">' . $currency . $product['price'] . '</span>';
                        } else {
                            $html=$html.'<span class="price-new">' . $currency . $product['discount'] . '</span>';
                            $html=$html.'<span class="price-old"><del>' . $currency . $product['price'] . '</del></span>';
                        }
                    }
                } else {
                    if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) {
                        $html=$html.'<span class="price-new">' . $currency . $product['price'] . '</span>';
                    } else {
                        $html=$html.'<span class="price-new">' . $currency . $product['discount'] . '</span>';
                        $html=$html.'<span class="price-old"><del>' . $currency . $product['price'] . '</del></span>';
                    }
                }
                $html=$html.'</span></h5>
                <form class="addItemToCartModel" id="addCart_' . $randamValue . $product['id'] . '" method="post" action="javascript:void(null)">
                    <input type="hidden" name="productId" value="' . $product['id'] . '" />
                    <input type="hidden" name="currentPage" value="' . $currentPage . '">
                    <input type="hidden" name="divId" value="addToCart' . $randamValue . $product['id'] . '" />
                    <input type="hidden" name="productSize" value="' . $product['id'] . '">
                    <div class="button-left">';
                    if ($product['stock'] == 'Yes') {
                        if ($cart->productExistInCart($product['id'])) {
                            $html=$html.'<a class="btn hny_add buy_direct" href="checkout.php"><span class="text">Buy Now</span></a>';
                        } else {
                            $html=$html.'<a class="btn hny_add buy_direct" href="javascript:void(0);" onclick="addToCart(\'addCart_' . $randamValue . $product['id'] . '\',\'' . $primaryClassName . '\' , \'buy_direct\');"><span class="text">Buy Now</span></a>';
                        }
                    } else {
                        $html=$html.'<a class="btn hny_add" href="javascript:void(0);"><span class="text">Out Of Stock</span></a>';
                    }
                    $html=$html.'</div>
                </form>
            </div>
        </div>
    </div>
</div>';

    }
} 

// Prepare response data
$data['totalProducts'] = $listing->totalProducts();
$data['totalPages'] = $listing->totalPages();
$data['recordFrom'] = $listing->recordFrom();
$data['recordTo'] = $listing->recordTo();
$data['query'] = $listing->listingQuery;
$data['session'] = $_SESSION;
$data['html']=$html;

// Return response as JSON
echo json_encode($data);
?>
