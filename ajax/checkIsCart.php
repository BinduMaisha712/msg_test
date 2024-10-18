<?php
include "../config.php";
$productId = (isset($_POST['productId'])) ? $_POST['productId'] : NULL;

$data = array();
$productArray=array();
$isCart=false;
if(isset($_SESSION['loginid']))
   {
     $tableName = "add_cart";
     if($cart->count($tableName,"pid='".$productId."'"))
     	{
     		$productArray[]=$productId;
              	$isCart=true;
         }
	}
	else
	{
     if(isset($_SESSION['products']))
         {
    	$productArray=$_SESSION['products']['id'];
      if(in_array($productId,$_SESSION['products']['id']))
      	$isCart=true;
         }
     }
$data['catProductIds']=$productArray;
$data['isCart']=$isCart;
$product = $homePage->getProductById($productId);

                                        $isdeal = $homePage->isDealByProduct($product['id']);
                    if (!empty($isdeal)) {
                        if ($isdeal[0]['stock'] != 0) {
                            
                                       $data['dis']=$isdeal[0]['price']; 
                                       $data['price']=$product['price'];
                                         } else {
                                            if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { 
                                                $data['dis']=0;
                                                $data['price']=$product['price'];
                                       
                                        } else { 
                                            $data['dis']=$product['discount']; 
                                           $data['price']=$product['price'];
                                       
                                       }
                                        }
                    } else {
                                      if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { 
                                                $data['dis']=0;
                                                $data['price']=$product['price'];
                                       
                                        } else { 
                                            $data['dis']=$product['discount']; 
                                          $data['price']=$product['price'];
                                       
                                       }
                                        
                    }
                    
                    if(isset($product['price']) && isset($product['discount']) && $product['discount'] <  $product['price'] ){
                                    $price = $product['price'];
                                    $discountedPrice = $product['discount'];

                                    $data['off'] = $homePage->calculateDiscountPercentage($price, $discountedPrice);
                    }
                                   

echo json_encode($data);
?>