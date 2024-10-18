<?php
require('../config.php');
// Turn off error reporting
error_reporting(1);

// Disable displaying errors
ini_set('display_errors', 1);

$catidd=$_GET['listingId'];

$offset = $_GET['offset'];
$limit = $_GET['limit'];
$filter=$_GET['filter'];

// price filter
$maxprice = $_GET['maxPrice'];
$minprice = $_GET['minPrice'];
$category_type = $_GET['categorytype'];

if(isset($maxprice) && isset($minprice)){
    $price_filter_condition = 'AND discount >= ' . $minprice . ' AND discount <= ' . $maxprice . ' ';
    // echo $price_filter_condition."<br>";
}else{
    $price_filter_condition = null;
}

if($filter==''){
    
    $n = 0;
    if(isset($_SESSION['filter']['orderBy']) && ($_SESSION['filter']['orderBy'] == 'ASC' || $_SESSION['filter']['orderBy'] == 'DESC'))
	{  
	   if($category_type == 'subcat_id'){
	       $n =1;
	       $sql = "SELECT * from products WHERE status='Active' AND subcat_id = $catidd $price_filter_condition group by group_code ORDER BY CAST(price AS DECIMAL) ".$_SESSION['filter']['orderBy']." LIMIT $offset, $limit";
	   }
	   else{ 
	       $n =2;
	       $sql = "SELECT * from products WHERE status='Active' AND cat_id = $catidd ".$price_filter_condition." group by group_code ORDER BY CAST(price AS DECIMAL) ".$_SESSION['filter']['orderBy']." LIMIT $offset, $limit";
	   }
	}else{
	    if($category_type == 'subcat_id'){
	        $n =3;
	        $sql = "SELECT * from products WHERE status='Active' AND subcat_id = $catidd $price_filter_condition group by group_code order by id desc LIMIT $offset, $limit";
	    }
	    else{
	        $n =4;
	        $sql = "SELECT * from products WHERE status='Active' AND cat_id = $catidd $price_filter_condition group by group_code order by id desc LIMIT $offset, $limit";
	    }
	}
    $products = mysqli_query($con, $sql);
}

else{
$products=mysqli_query($con,'SELECT p.*,c.classtype_id,(SELECT price FROM `today_deal` WHERE (concat(startdate," ",starttime)<= NOW()) AND (concat(enddate," ",endtime)>=NOW()) AND pid=p.id) As dealPrice FROM products p,category c WHERE p.status="Active" AND c.id=p.cat_id group by p.group_code order by p.id desc LIMIT '.$offset.', '.$limit);
    
}

if (empty($products)) {
    echo '
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

       echo '
<div class="col-xl-3 col-md-4 col-6">
    <div class="sp-product-item">
        <div class="sp-product-thumb">';
        if (isset($product['price']) && isset($product['discount']) && $product['discount'] < $product['price']) {
            $price = $product['price'];
            $discountedPrice = $product['discount'];
            $off = $homePage->calculateDiscountPercentage($price, $discountedPrice);
            echo '<span class="batch" id="modelPer' . $randamValue . $product['id'] . '">' . $off . '%</span>';
        }
        echo '<a href="product-detail.php?' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '&product_id=' . $product['id'] . '&' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '">';
            $image = $homePage->image('product', $product['product_code']);
            if (empty($image)) {
                echo '<img src="asset/image/placeholder.png" class="img-fluid bg-img" onerror="this.onerror=null;this.src=\'' . ($ImgSrcError ?? '') . '\';">';
            } else {
                echo '<img src="assets/img/medal.png" class="ansh-medal-detail">';
                echo '<img src="asset/image/product/' . $image[0]['image'] . '" class="img-fluid bg-img" onerror="this.onerror=null;this.src=\'' . ($ImgSrcError ?? '') . '\';">';
            }
        echo '</a></div>
        <div class="sp-product-content">
            <div class="rating d-flex justify-content-between">
                <span>' . number_format($product['avg_rating'], 1) . ' <i class="fas fa-star"></i> </span>';
                $catId = $product['cat_id'];
                $catName = mysqli_fetch_assoc(mysqli_query($con, "SELECT cat_name FROM category WHERE id = '$catId' AND status = 'active'"))['cat_name'];
                echo '<span>' . $catName . '</span>
            </div>
            <div class="row">
                <div class="col-lg-9 col-10 wish_ans">
                    <h6 class="title"><a href="product-detail.php?' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '&product_id=' . $product['id'] . '&' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '">' . $product['product_name'] . '</a></h6>
                </div>
                <div class="col-lg-3 col-2">
                    <div class="mywishlistdiv addToWishList' . $randamValue . $product['id'] . '">
                        <div id="newWish_' . $product['id'] . '">';
                            if (!$wishList->productExistInWishList($product['id'])) {
                                echo '<span class="ans-wish"><a href="javascript:;" onclick="addToWishList(' . $product['id'] . ',this.id,\'' . $url . '\')" id="addToWishList' . $randamValue . $product['id'] . '"><i class="fa-regular fa-heart"></i></a></span>';
                            } else {
                                echo '<span class="ans-wish"><a onclick="removeFromWishList(' . $product['id'] . ',this.id,\'' . $url . '\')" id="addToWishList' . $randamValue . $product['id'] . '" href="javascript:;"><i class="fa fa-heart" aria-hidden="true" style="background-color: white;padding: 8px;color: red;border-radius: 17px; border: 1px solid #e0e0e0;font-size: 16px;"></i></a></span>';
                            }
                        echo '</div>
                    </div>
                </div>
            </div>
            <div class="price" style="display: flex;justify-content: space-between;">
                <h5 class="price"><span class="theme-color">';
                $isdeal = $homePage->isDealByProduct($product['id']);
                if (!empty($isdeal)) {
                    if ($isdeal[0]['stock'] != 0) {
                        echo '<span class="price-new">' . $currency . $isdeal[0]['price'] . '</span>';
                        echo '<span class="price-old"><del>' . $currency . $product['price'] . '</del></span>';
                    } else {
                        if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) {
                            echo '<span class="price-new">' . $currency . $product['price'] . '</span>';
                        } else {
                            echo '<span class="price-new">' . $currency . $product['discount'] . '</span>';
                            echo '<span class="price-old"><del>' . $currency . $product['price'] . '</del></span>';
                        }
                    }
                } else {
                    if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) {
                        echo '<span class="price-new">' . $currency . $product['price'] . '</span>';
                    } else {
                        echo '<span class="price-new">' . $currency . $product['discount'] . '</span>';
                        echo '<span class="price-old"><del>' . $currency . $product['price'] . '</del></span>';
                    }
                }
                echo '</span></h5>
                <form class="addItemToCartModel" id="addCart_' . $randamValue . $product['id'] . '" method="post" action="javascript:void(null)">
                    <input type="hidden" name="productId" value="' . $product['id'] . '" />
                    <input type="hidden" name="currentPage" value="' . $currentPage . '">
                    <input type="hidden" name="divId" value="addToCart' . $randamValue . $product['id'] . '" />
                    <input type="hidden" name="productSize" value="' . $product['id'] . '">
                    <div class="button-left">';
                    if ($product['stock'] == 'Yes') {
                        if ($cart->productExistInCart($product['id'])) {
                            echo '<a class="btn hny_add buy_direct" href="checkout.php"><span class="text">Buy Now</span></a>';
                        } else {
                            echo '<a class="btn hny_add buy_direct" href="javascript:void(0);" onclick="addToCart(\'addCart_' . $randamValue . $product['id'] . '\',\'' . $primaryClassName . '\' , \'buy_direct\');"><span class="text">Buy Now</span></a>';
                        }
                    } else {
                        echo '<a class="btn hny_add" href="javascript:void(0);"><span class="text">Out Of Stock</span></a>';
                    }
                    echo '</div>
                </form>
            </div>
        </div>
    </div>
</div>';


    }
} 
?>


<?php
// require('../config.php');
// // Turn off error reporting
// error_reporting(0);

// // Disable displaying errors
// ini_set('display_errors', 0);

//  $maxprice = $_GET['maxPrice'];
//  $minprice = $_GET['minPrice'];
//  $filter = $_GET['priceRange'];
//  $catid = $_GET['listid'];

// if ($filter != '') {

//     $products = mysqli_query($con, 'SELECT *
//         FROM products
//         WHERE status = "Active" 
//           AND cat_id = '.$catid.'  
//           AND discount >= ' . $minprice . ' 
//           AND discount <= ' . $maxprice . ' 
//         GROUP BY group_code 
//         ORDER BY id DESC');
// } else {
//     $products = mysqli_query($con, 'SELECT p.*, c.classtype_id, 
//             (SELECT price FROM `today_deal` 
//              WHERE (concat(startdate, " ", starttime) <= NOW()) 
//               AND (concat(enddate, " ", endtime) >= NOW()) 
//               AND pid = p.id) AS dealPrice 
//         FROM products p, category c 
//         WHERE p.status = "Active" 
//           AND c.id = p.cat_id 
//           AND c.status = "active" 
//           AND p.discount >= 0 
//         GROUP BY p.group_code 
//         ORDER BY p.id DESC');
// }

// if (empty($products)) {
//     echo '
//     <div class="col-md-12">
//         <div class="pt-5" style="background-color:#f5f9ff; align-items: center; width:100%; height:250px;">
//             <img class="rounded mx-auto my-auto d-block" src="asset/image/empty-product.png" style="height:50%" alt="">
//             <h1 class="h1 text-center">No Product Found!</h1>
//         </div>
//     </div>';
// } else {

//     $productCount = count($products);
//     $productsPriceArr = [];
//     foreach ($products as $product) {
//         $issubcategory = mysqli_fetch_assoc(mysqli_query($con, "SELECT c.issubcategory FROM category c  WHERE c.id=" . $product['cat_id']))['issubcategory'];
//         if ($issubcategory == 'Yes' &&  $product['subcat_id']!= '') {
//             $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM subcategory WHERE id=" . $product['subcat_id']))['classtype_id']);
//         } elseif ($issubcategory == 'No') {
//             $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM category WHERE id=" . $product['cat_id']))['classtype_id']);
//         }
//         $classtypeName = array();
//         $primaryClassName = "";
//         $classtype1 = implode(", ", $query1);
//         $classtypeNameQuery = mysqli_query($con, "SELECT id,name FROM classtype WHERE id IN($classtype1) GROUP BY id");
//         while ($row = mysqli_fetch_array($classtypeNameQuery)) {
//             $classtypeName[] = array('id' => $row['id'], 'name' => $row['name']);
//             $classtypeId12[] = $row['id'];
//         }

//         if ((count($query1)) == 3) {
//             $k1 = array();
//             foreach ($classtypeName as $k => $value) {
//                 if ($query1[0] != $value['id']) {
//                     $k1[] = $k;
//                 }
//             }
//             $primaryClassName = ucfirst($classtypeName[$k1[0]]['name']) . '+' . ucfirst($classtypeName[$k1[1]]['name']);
//         } elseif (count($query1) == 2) {
//             $primaryClassName = ucfirst($classtypeName[0]['name']);
//             if ($query1[0] == $classtypeName[0]['id']) {
//                 $primaryClassName = ucfirst($classtypeName[1]['name']);
//             }
//         } elseif (count($query1) == 1 && $query1[0] != 16) {
//             $primaryClassName = ucfirst($classtypeName[0]['name']);
//         }
//         $randamValue = rand();

// echo '<div class="col-xl-3 col-md-4 col-6">';
// echo '    <div class="sp-product-item">';
// echo '        <div class="sp-product-thumb">';

// if (isset($product['price']) && isset($product['discount']) && $product['discount'] < $product['price']) {
//     $price = $product['price'];
//     $discountedPrice = $product['discount'];
//     $off = $homePage->calculateDiscountPercentage($price, $discountedPrice);

//     echo '            <span class="batch" id="modelPer' . $randamValue . $product['id'] . '">' . $off . '%</span>';
// }

// echo '            <a href="product-detail.php?' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '&product_id=' . $product['id'] . '&' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '">';
// $image = $homePage->image('product', $product['product_code']);
// if (empty($image)) {
//     echo '                <img src="asset/image/placeholder.png" class="img-fluid bg-img" onerror="this.onerror=null;this.src=\'' . ($ImgSrcError ?? '') . '\';">';
// } else {
//     echo '                <img src="assets/img/medal.png" class="ansh-medal-detail">';
//     echo '                <img src="asset/image/product/' . $image[0]['image'] . '" class="img-fluid bg-img" onerror="this.onerror=null;this.src=\'' . ($ImgSrcError ?? '') . '\';">';
// }
// echo '            </a>';
// echo '        </div>';
// echo '        <div class="sp-product-content">';
// echo '            <div class="rating d-flex justify-content-between">';
// echo '                <span>' . number_format($product['avg_rating'], 1) . ' <i class="fas fa-star"></i></span>';

// $catId = $product['cat_id'];
// $catName = mysqli_fetch_assoc(mysqli_query($con, "SELECT cat_name FROM category WHERE id = '$catId' AND status = 'active'"))['cat_name'];

// echo '                <span>' . $catName . '</span>';
// echo '            </div>';
// echo '            <div class="row">';
// echo '                <div class="col-lg-9 col-10 wish_ans">';
// echo '                    <h6 class="title"><a href="product-detail.php?' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '&product_id=' . $product['id'] . '&' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '">' . $product['product_name'] . '</a></h6>';
// echo '                </div>';
// echo '                <div class="col-lg-3 col-2">';
// echo '                    <div class="mywishlistdiv addToWishList' . $randamValue . $product['id'] . '">';
// echo '                        <div id="newWish_' . $product['id'] . '">';
// if (!$wishList->productExistInWishList($product['id'])) {
//     echo '                            <span class="ans-wish"><a href="javascript:;" onclick="addToWishList(' . $product['id'] . ',this.id,\'' . $url . '\')" id="addToWishList' . $randamValue . $product['id'] . '"><i class="fa-regular fa-heart"></i></a></span>';
// } else {
//     echo '                            <span class="ans-wish"><a onclick="removeFromWishList(' . $product['id'] . ',this.id,\'' . $url . '\')" id="addToWishList' . $randamValue . $product['id'] . '" href="javascript:;"><i class="fa fa-heart" aria-hidden="true" style="background-color: white;padding: 8px;color: red;border-radius: 17px; border: 1px solid #e0e0e0;font-size: 16px;"></i></a></span>';
// }
// echo '                        </div>';
// echo '                    </div>';
// echo '                </div>';
// echo '            </div>';
// echo '            <div class="price" style="display: flex;justify-content: space-between;">';
// echo '                <h5 class="price">';
// echo '                    <span class="theme-color">';
// $isdeal = $homePage->isDealByProduct($product['id']);
// if (!empty($isdeal)) {
//     if ($isdeal[0]['stock'] != 0) {
//         echo '                        <span class="price-new">' . $currency . $isdeal[0]['price'] . '</span>';
//         echo '                        <span class="price-old"><del>' . $currency . $product['price'] . '</del></span>';
//     } else {
//         if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) {
//             echo '                        <span class="price-new">' . $currency . $product['price'] . '</span>';
//         } else {
//             echo '                        <span class="price-new">' . $currency . $product['discount'] . '</span>';
//             echo '                        <span class="price-old"><del>' . $currency . $product['price'] . '</del></span>';
//         }
//     }
// } else {
//     if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) {
//         echo '                        <span class="price-new">' . $currency . $product['price'] . '</span>';
//     } else {
//         echo '                        <span class="price-new">' . $currency . $product['discount'] . '</span>';
//         echo '                        <span class="price-old"><del>' . $currency . $product['price'] . '</del></span>';
//     }
// }
// echo '                    </span>';
// echo '                </h5>';
// echo '                <form class="addItemToCartModel" id="addCart_' . $randamValue . $product['id'] . '" method="post" action="javascript:void(null)">';
// echo '                    <input type="hidden" name="productId" value="' . $product['id'] . '" />';
// echo '                    <input type="hidden" name="currentPage" value="' . $currentPage . '">';
// echo '                    <input type="hidden" name="divId" value="addToCart' . $randamValue . $product['id'] . '" />';
// echo '                    <input type="hidden" name="productSize" value="' . $product['id'] . '">';
// echo '                    <div class="button-left">';
// if ($product['stock'] == 'Yes') {
//     if ($cart->productExistInCart($product['id'])) {
//         echo '                        <a class="btn hny_add buy_direct" href="checkout.php"><span class="text">Buy Now</span></a>';
//     } else {
//         echo '                        <a class="btn hny_add buy_direct" href="javascript:void(0);" onclick="addToCart(\'addCart_' . $randamValue . $product['id'] . '\',\'' . $primaryClassName . '\' , \'buy_direct\');"><span class="text">Buy Now</span></a>';
//     }
// } else {
//     echo '                        <a class="btn hny_add" href="javascript:void(0);"><span class="text">Out Of Stock</span></a>';
// }
// echo '                    </div>';
// echo '                </form>';
// echo '            </div>';
// echo '        </div>';
// echo '    </div>';
// echo '</div>';

//     }
// } 
// ?>


