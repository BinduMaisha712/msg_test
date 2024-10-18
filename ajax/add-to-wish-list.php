<?php
require('../config.php');

$data = array();

// session_start();

$productId = (isset($_POST['productId'])) ? $_POST['productId'] : NULL;
$divId = (isset($_POST['divId'])) ? $_POST['divId'] : NULL;

// Add Wishlist

if($_POST['action']=='add'){

if(isset($_SESSION['loginid'])){

     $tableName = "wishlist";
     $wishList->count($tableName,"product_id='".$productId."'");
     
     $recordArr = array(
            "user_id" => $_SESSION['loginid'],
            "product_id" => $productId
        );

     $data['result'] = ($wishList->save($tableName,$recordArr)) ? true : false;
    $data['divId'] = $divId;

}else{
    if(isset($_SESSION['wishList'])){
        if (in_array($productId, $_SESSION["wishList"])){
            ///// If Product ID already Present In array
        }else{
          $_SESSION["wishList"][] = $productId;  
        }
    }else{
        $_SESSION["wishList"][] = $productId;  
    }
    
// session_unset();
    $data['divId'] = $divId;


if(isset($_POST['url'])){
    $data['url'] = urlencode($_POST['url']);
}
$data['status'] = "Not LogIn";

}


}  ////END if Action

//Remove Cart Action

//////// Remove Item From Cart ////////
if($_POST['action']=='remove'){
$data['result'] = ($wishList->removeItemFromWishlist($productId))?"Removed from WishList":"Removed From Wishlist";
$data['productButtonId'] = '#addWishList'.$productId;        /////// WishList Button in Product_detail Page
}
//////// Remove Item From Cart ////////


echo json_encode($data);

?>