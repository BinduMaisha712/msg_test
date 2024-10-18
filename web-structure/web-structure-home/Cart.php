<?php

/* Home function */
class Cart extends HomePage
{
    protected $con;

    protected $userId;
    protected $tableName;
    protected $id;
    protected $columnSet;
    protected $valueSet;
    protected $record;
    protected $products = array();
    protected $sessionProducts = array();
    protected $sessionProductQty = array();

    public function __construct($con)
    {
        $this->con = $con;
        $this->setConnection($con);
        $this->setUserId();
    }

    //Check Item Exist IN Cart or NOT
    public function productExistInCart($productId)
    { ///return True || False
        $this->setSessionProducts();
        return (($this->productExistInCartSession($productId)) || ($this->productExistInCartTable($productId))) ? true : false;
    }

    /////// Check Product ID Exist In Session ////////
    public function productExistInCartSession($productId)
    { ///return True || False
        $result = (empty($this->sessionProducts)) ? false : in_array($productId, $this->sessionProducts);
        return (empty($this->sessionProducts)) ? false : $result;
    }
    /////// Check Product ID Exist In Session ////////

    /////// Check Product ID Exist In Cart ////////
    public function productExistInCartTable($productId)
    { ///return True || False
        $condition = 'pid="' . $productId . '" and user_id="' . $this->userId . '"';

        return ($this->userId = null) ? false : $this->count('add_cart', $condition);
    }
    /////// Check Product ID Exist In Cart ////////

    /////// Set Session Products Property Value ////////
    public function setSessionProducts()
    {
        if (isset($_SESSION['products'])) {
            $this->sessionProducts = $_SESSION['products']['id'];
            $this->sessionProductQty = $_SESSION['products']['qty'];
        }
        return true;
    }
    /////// Set Session Products Property Value ////////

    /////// Product Total Amount In Cart ///////
   
    public function productTotalAmount($productId, int $quantity)
    {
        $query = "SELECT discount,price FROM products WHERE status ='Active' and id='" . $productId . "'";

        $query = mysqli_query($this->con, $query);

        $result = mysqli_fetch_array($query);

        if (!empty($result)) {
            $isdeal = $this->isDealByProduct($productId);
            if (!empty($isdeal)) {
                if ($isdeal[0]['stock'] != 0) {
                    $price = $isdeal[0]['price'];
                } else {
                    if (($result['price'] == $result['discount']) || ($result['discount'] == 0)) {
                        $price = $result['price'];
                    } else {
                        $price = $result['discount'];
                    }
                }
            } else {
                if (($result['price'] == $result['discount']) || ($result['discount'] == 0)) {
                    $price = $result['price'];
                } else {
                    $price = $result['discount'];
                }
            }
            $total = $price * $quantity;
            return number_format((float) $total, 2, '.', '');
        }
        return false;
    }
    /////// Product Total Amount In Cart ///////


    /////// Total Amount In Cart ///////
    public function cartTaxSubTotalAmount(){
        $this->setSessionProducts();

        $result = 0;
        $count = $this->totalItemInCart();

        if($this->userId == NULL){
            if($count == 0){
                $result = 0;      ////// Total == 0 If Session Cart Is Empty 
            }else{
                $i=0;

                foreach($_SESSION['products']['id'] as $productId){
                     if(!empty($productId))  
                     {   
                    $key = array_search($productId, $_SESSION['products']['id']);
                    $quantity = ($_SESSION['products']['qty'][$key] == "") ? 1 : $_SESSION['products']['qty'][$key];
                    
                    $query = "SELECT p.discount,p.price,p.tax FROM products as p where p.status='Active' and p.trash='No' and p.id='".$productId."'";
                    $discount = $this->getDataArray($query)[0]['discount'];
                    $price = $this->getDataArray($query)[0]['price'];
                    $taxValue = !empty($this->getDataArray($query)[0]['tax']) ? $this->getDataArray($query)[0]['tax'] : '0';
                     $isdeal=$this->isDealByProduct($productId);
      if(!empty($isdeal))
      {
        if($isdeal[0]['stock']!=0)
        {
            $price1=$isdeal[0]['price'];
        }
        else
        {
            if(($price==$discount) || ($discount==0))
            {
                $price1=$price;
            }
            else
            {
                $price1=$discount;

            }
        }
      }else
      {
        if(($price==$discount) || ($discount==0))
        {
            $price1=$price;
        }
        else
        {
            $price1=$discount;

        }
      }
                                                $totalPriceProduct = $price1 * $quantity;
                                                $totalPriceProductTAX = $totalPriceProduct/100;
                                                $totalPriceProductTAX = $totalPriceProductTAX*$taxValue;
                                                
                    $result = $result +  $totalPriceProductTAX;
                    
                    // $result = $result +  ($discount * $quantity);
                    }
                    
                $i++;
                }
            }

        }else{
            if($count == 0){
                $result = 0;      ////// Total == 0 If Table Cart Is Empty
            }else{
                foreach($this->cartDetail() as $product){
                    
                    // $key = array_search($productId, $_SESSION['products']['id']);
                    $quantity = $product['quantity'];
                    
                    // $query = "SELECT p.discount,p.price FROM products as p where p.status='Active' and p.id='".$productId."'";
                    $discount = $product['discount'];
                    $price = $product['price'];
                    $taxValue = !empty($product['tax']) ? $product['tax'] : '0';
                                                
                    $isdeal=$this->isDealByProduct($product['id']);
      if(!empty($isdeal))
      {
        if($isdeal[0]['stock']!=0)
        {
            $price1=$isdeal[0]['price'];
        }
        else
        {
            if(($price==$discount) || ($discount==0))
            {
                $price1=$price;
            }
            else
            {
                $price1=$discount;

            }
        }
      }else
      {
        if(($price==$discount) || ($discount==0))
        {
            $price1=$price;
        }
        else
        {
            $price1=$discount;

        }
      }
                $totalPriceProduct = $price1 * $quantity;
                                                $totalPriceProductTAX = $totalPriceProduct/100;
                                                $totalPriceProductTAX = $totalPriceProductTAX*$taxValue;
                                                
                    $result = $result +  $totalPriceProductTAX;
                        
                // $query = "SELECT p.discount,p.price,ac.quantity FROM products as p INNER JOIN add_cart as ac on p.id=ac.pid WHERE p.status='Active' and ac.status ='Active' and ac.user_id='".$this->userId."'";
                // $quantity = $this->getDataArray($query)[0]['quantity'];
                // $discount = $this->getDataArray($query)[0]['discount'];
                // $price = $this->getDataArray($query)[0]['price'];
                //  if(($price==$discount) || ($discount==0))
                //                {
    //                                   $price1=$price;
    //                                   }
    //                                else
    //                                  {
    //                                  $price1=$discount;

    //                                }
                //  $result = $result +  ($price1 * $quantity);
            }
        }
            
        }
        // echo $result;
        return number_format((float)$result, 2, '.', '');
    }

    //////// Remove Item From Cart ////////
    public function removeItemFromCart($productId)
    {
        $this->setSessionProducts();

        if ($this->userId == null) { ////// Remove Item From Session
            $key = array_search($productId, $_SESSION['products']['id']);
            unset($_SESSION['products']['id'][$key]);
            unset($_SESSION['products']['qty'][$key]);
            unset($_SESSION['products']['colorId'][$key]);
            return true;
        } else { ////// Remove Item From Table
            $this->count('add_cart', "pid='" . $productId . "'");
            $recordArr = array(
                "user_id" => $_SESSION['loginid'],
                "pid" => $productId,
                "status" => 'Deleted',
            );
            return $this->save('add_cart', $recordArr);
        }
    }
    //////// Remove Item From Cart ////////

    /////// Total Item In Cart ///////
    public function cartDetail()
    {
        $this->setSessionProducts();

        if ($this->userId == null) {
            $result = array();
            $count = $this->totalItemInCart();

            if ($count == 0) {
                $result['cartEmpty'] = true;
                $result['message'] = 'Oops! Your cart is empty!'; ////// Message Show If cart is Empty When session user Id is not SET
            } else {
                $i = 0;
                foreach ($_SESSION['products']['id'] as $productId) {
                    // $quantity = ($_SESSION['products']['qty'][$i] == "") ? 1 : $_SESSION['products']['qty'][$i];

                    $query = "SELECT p.id, p.cat_id, p.subcat_id, p.product_name,p.minimum,p.maximum,p.class0,p.class1,p.class2,p.class3,p.price,
                    p.discount,p.userdisc,p.cod,p.product_code,p.vendor_product_id,p.avg_rating,
                    i.image,p.stock,p.in_stock,s.symbol, p.tax,p.length,p.width,p.weight,p.height 
                FROM products as p
                LEFT JOIN image as i on p.product_code=i.p_id and i.status='Active'
                LEFT JOIN size_class as s on p.class0=s.id
                WHERE p.status='Active' and p.id='" . $productId . "'
                GROUP BY p.id";

                    $query = mysqli_query($this->con, $query);
                    // If the query returns >= 1 assign the number of rows to numResults
                    // $numResults = mysqli_num_rows($query);

                    $result[$i] = mysqli_fetch_array($query);

                    $key = array_search($productId, $_SESSION['products']['id']);
                    $result[$i]['quantity'] = ($_SESSION['products']['qty'][$key] == "") ? 1 : $_SESSION['products']['qty'][$key];

                    $i++;
                }
            }
        } else {
            $query = "SELECT p.id, p.cat_id, p.subcat_id,p.product_name,p.minimum,p.maximum,p.class0,p.class1,p.class2,p.class3,p.price,
                        p.discount,p.userdisc,p.cod,p.product_code,p.vendor_product_id,p.avg_rating,
                        ac.quantity,i.image,p.stock,p.in_stock,s.symbol,p.tax,p.length,p.width,p.weight,p.height
                    FROM products as p
                    INNER JOIN add_cart as ac on p.id=ac.pid
                    LEFT JOIN image as i on p.product_code=i.p_id and i.status='Active'
                    LEFT JOIN size_class as s on p.class0=s.id
                    WHERE p.status='Active' and ac.status ='Active' and ac.user_id='" . $this->userId . "'
                    GROUP BY p.id";

            $count = mysqli_num_rows(mysqli_query($this->con, $query));
            if ($count == 0) {
                $result['cartEmpty'] = true;
                $result['message'] = 'Oops! Your cart is empty!'; ////// Message Show If cart is Empty When session user Id is SET
            } else {
                $result = $this->getDataArray($query);
            }
        }
        return $result;
    }
    /////// Total Item In Cart ///////

    /////// Total Amount In Cart ///////
    public function cartTotalAmount()
    {
        $this->setSessionProducts();

        $result = 0;
        $count = $this->totalItemInCart();

        if ($this->userId == null) {
            if ($count == 0) {
                $result = 0; ////// Total == 0 If Session Cart Is Empty
            } else {
                $i = 0;
                foreach ($_SESSION['products']['id'] as $productId) {
                    // print_r($_SESSION['products']['id']);die();
                    $key = array_search($productId, $_SESSION['products']['id']);
                    $quantity = ($_SESSION['products']['qty'][$key] == "") ? 1 : $_SESSION['products']['qty'][$key];

                    $query = "SELECT p.discount,p.price FROM products as p where p.status='Active' and p.id='" . $productId . "'";

                    $discount = $this->getDataArray($query)[0]['discount'];
                    $price = $this->getDataArray($query)[0]['price'];
                    $isdeal = $this->isDealByProduct($productId);
                    if (!empty($isdeal)) {
                        if ($isdeal[0]['stock'] != 0) {
                            $price1 = $isdeal[0]['price'];
                        } else {
                            if (($price == $discount) || ($discount == 0)) {
                                $price1 = $price;
                            } else {
                                $price1 = $discount;
                            }
                        }
                    } else {
                        if (($price == $discount) || ($discount == 0)) {
                            $price1 = $price;
                        } else {
                            $price1 = $discount;
                        }
                    }
                    $result = $result + ($price1 * $quantity);

                    $i++;
                }
            }
        } else {
            if ($count == 0) {
                $result = 0; ////// Total == 0 If Table Cart Is Empty
            } else {
                foreach ($this->cartDetail() as $product) {
                    // $key = array_search($productId, $_SESSION['products']['id']);
                    $quantity = $product['quantity'];

                    // $query = "SELECT p.discount,p.price FROM products as p where p.status='Active' and p.id='".$productId."'";
                    $discount = $product['discount'];
                    $price = $product['price'];
                    $isdeal = $this->isDealByProduct($product['id']);
                    if (!empty($isdeal)) {
                        if ($isdeal[0]['stock'] != 0) {
                            $price1 = $isdeal[0]['price'];
                        } else {
                            if (($price == $discount) || ($discount == 0)) {
                                $price1 = $price;
                            } else {
                                $price1 = $discount;
                            }
                        }
                    } else {
                        if (($price == $discount) || ($discount == 0)) {
                            $price1 = $price;
                        } else {
                            $price1 = $discount;
                        }
                    }
                    $result = $result + ($price1 * $quantity);

                    // $i++;
                }
            }
        }
        $shipping = 0;
        $result = $result + $shipping;
        return number_format((float) $result, 2, '.', '');
    }
    /////// Total Amount In Cart ///////


    
    /////// GST ///////
    public function cartGstTotalAmount()
    {
        $this->setSessionProducts();

        $result = 0;
        $count = $this->totalItemInCart();

        if ($this->userId == null) {
            if ($count == 0) {
                $result = 0; ////// Total == 0 If Session Cart Is Empty
            } else {
                $i = 0;
                foreach ($_SESSION['products']['id'] as $productId) {
                    // print_r($_SESSION['products']['id']);die();
                    $key = array_search($productId, $_SESSION['products']['id']);
                    $quantity = ($_SESSION['products']['qty'][$key] == "") ? 1 : $_SESSION['products']['qty'][$key];

                    $query = "SELECT p.discount,p.price,p.tax FROM products as p where p.status='Active' and p.id='" . $productId . "'";

                    $discount = $this->getDataArray($query)[0]['discount'];
                    $price = $this->getDataArray($query)[0]['price'];
                    $tax = $this->getDataArray($query)[0]['tax'];
                        //  echo  $tax ;
                        //  die();
                    
                    $isdeal = $this->isDealByProduct($productId);
                    if (!empty($isdeal)) {
                        if ($isdeal[0]['stock'] != 0) {
                            $price1 = $isdeal[0]['price'];
                        } else {
                            if (($price == $discount) || ($discount == 0)) {
                                $price1 = $price;
                            } else {
                                $price1 = $discount;
                            }
                        }
                    } else {
                        if (($price == $discount) || ($discount == 0)) {
                            $price1 = $price;
                        } else {
                            $price1 = $discount;
                        }
                    }
                    $taxValue = $tax ?? 0;
                    $totalPriceProductTAX = (floatval($price1) * floatval($quantity))/100;
                    // echo $totalPriceProductTAX;
                    $totalPriceProductTAX = floatval($totalPriceProductTAX)* floatval($taxValue);
                   $result = floatval($result)+ floatval($totalPriceProductTAX);

                    $i++;
                }
            }
        } else {
            if ($count == 0) {
                $result = 0; ////// Total == 0 If Table Cart Is Empty
            } else {
                foreach ($this->cartDetail() as $product) {
                    // $key = array_search($productId, $_SESSION['products']['id']);
                    $quantity = $product['quantity'];

                    // $query = "SELECT p.discount,p.price FROM products as p where p.status='Active' and p.id='".$productId."'";
                    $discount = $product['discount'];
                    $price = $product['price'];
                    $tax = $product['tax'];
                    $isdeal = $this->isDealByProduct($product['id']);
                    if (!empty($isdeal)) {
                        if ($isdeal[0]['stock'] != 0) {
                            $price1 = $isdeal[0]['price'];
                        } else {
                            if (($price == $discount) || ($discount == 0)) {
                                $price1 = $price;
                            } else {
                                $price1 = $discount;
                            }
                        }
                    } else {
                        if (($price == $discount) || ($discount == 0)) {
                            $price1 = $price;
                        } else {
                            $price1 = $discount;
                        }
                    }
                    
                    $taxValue = $tax ?? 0;
                    $totalPriceProductTAX = ($price1 * $quantity)/100;
                    $totalPriceProductTAX = floatval($totalPriceProductTAX) * floatval($taxValue);
                   $result=$result+$totalPriceProductTAX;

                    // $i++;
                }
            }
        }
        $shipping = 0;
        $result = $result + $shipping;
        return number_format((float) $result, 2, '.', '');
    }
    /////// GST ///////



    /////// Total Amount In Cart ///////
    public function cartSubTotalAmount()
    {
        $this->setSessionProducts();

        $result = 0;
        $count = $this->totalItemInCart();

        if ($this->userId == null) {
            if ($count == 0) {
                $result = 0; ////// Total == 0 If Session Cart Is Empty
            } else {
                $i = 0;

                foreach ($_SESSION['products']['id'] as $productId) {
                    if (!empty($productId)) {
                        $key = array_search($productId, $_SESSION['products']['id']);
                        $quantity = ($_SESSION['products']['qty'][$key] == "") ? 1 : $_SESSION['products']['qty'][$key];

                        $query = "SELECT p.discount,p.price FROM products as p where p.status='Active' and p.id='" . $productId . "'";
                        $discount = $this->getDataArray($query)[0]['discount'];
                        $price = $this->getDataArray($query)[0]['price'];
                        $isdeal = $this->isDealByProduct($productId);
                        if (!empty($isdeal)) {
                        
                            if ($isdeal[0]['stock'] != 0 ) {
                               
                                  $price1 = $isdeal[0]['price'];
                               
                            } else {
                                if (($price == $discount) || ($discount == 0)) {
                                    $price1 = $price;
                                } else {
                                    $price1 = $discount;
                                }
                            }
                        } else {
                            if (($price == $discount) || ($discount == 0)) {
                                $price1 = $price;
                            } else {
                                $price1 = $discount;
                            }
                        }
                        $result = $result + ($price1 * $quantity);

                        // $result = $result +  ($discount * $quantity);
                    }

                    $i++;
                }
            }
        } else {
            if ($count == 0) {
                $result = 0; ////// Total == 0 If Table Cart Is Empty
            } else {
                foreach ($this->cartDetail() as $product) {
                    // $key = array_search($productId, $_SESSION['products']['id']);
                    $quantity = $product['quantity'];

                    // $query = "SELECT p.discount,p.price FROM products as p where p.status='Active' and p.id='".$productId."'";
                    $discount = $product['discount'];
                    $price = $product['price'];
                    $isdeal = $this->isDealByProduct($product['id']);
                    if (!empty($isdeal)) {
                        if ($isdeal[0]['stock'] != 0) {
                            $price1 = $isdeal[0]['price'];
                        } else {
                            if (($price == $discount) || ($discount == 0)) {
                                $price1 = $price;
                            } else {
                                $price1 = $discount;
                            }
                        }
                    } else {
                        if (($price == $discount) || ($discount == 0)) {
                            $price1 = $price;
                        } else {
                            $price1 = $discount;
                        }
                    }
                    $result = $result + ($price1 * $quantity);

                    // $query = "SELECT p.discount,p.price,ac.quantity FROM products as p INNER JOIN add_cart as ac on p.id=ac.pid WHERE p.status='Active' and ac.status ='Active' and ac.user_id='".$this->userId."'";
                    // $quantity = $this->getDataArray($query)[0]['quantity'];
                    // $discount = $this->getDataArray($query)[0]['discount'];
                    // $price = $this->getDataArray($query)[0]['price'];
                    //  if(($price==$discount) || ($discount==0))
                    //                   {
                    //                                   $price1=$price;
                    //                                   }
                    //                                else
                    //                                  {
                    //                                  $price1=$discount;

                    //                                }
                    //     $result = $result +  ($price1 * $quantity);
                }
            }
        }
        // echo $result;
        return number_format((float) $result, 2, '.', '');
    }
    /////// Total Amount In Cart ///////

    /////// Total Item In Cart ////////
public function totalItemInCart(){
  $this->setSessionProducts();
  $count=0;
  if($this->userId == NULL)
  {
      if(isset($_SESSION['products']))
      {
    foreach($_SESSION['products']['id'] as $key=>$productId){
      $query = mysqli_query($this->con,"SELECT * FROM products as p where p.status='Active' and p.trash='No' and p.id='".$productId."'");
  if(mysqli_num_rows($query)==0)
  {
      unset($_SESSION['products']['id'][$key]);
  unset($_SESSION['products']['qty'][$key]);
  unset($_SESSION['products']['colorId'][$key]);
  }
  
    }
  
      
    $count=count($_SESSION['products']['id']);
      }
      else
      {
          $count=0;
      }
  }
  else
  {
  $query = mysqli_query($this->con,"SELECT a.* FROM products as p,add_cart a where p.status='Active' and p.trash='No' and p.id=a.pid AND a.user_id='".$this->userId."' and a.status!='Deleted'");
  $count=mysqli_num_rows($query);
  
  }
return $count;

}
/////// Total Item In Cart ////////
  
  

    //////// Add Item To Cart from Session ////////

    public function productCodeByProductId($productId)
    {
        if ($productId != '') {
            $query = "SELECT product_code
                FROM products where id='" . $productId . "'";
            $queryData = mysqli_query($this->con, $query);

            $result = mysqli_fetch_array($queryData);
            return $result['product_code'];
        }
    }

/////// Clear Cart ///////
    public function clearCart()
    {
        $result = false;
        if (isset($_SESSION['products'])) {
            unset($_SESSION['products']);
            $result = true;
        }

        if ($this->userId != null) {
            $query = "UPDATE add_cart SET status = 'Deleted' WHERE user_id='" . $this->userId . "'";
            if (mysqli_query($this->con, $query)) {
                $result = true;
            } else {
                $result = false;
            }
        }
        return $result;
    }
/////// Clear Cart ///////

    //////// Add Item To Cart from Session ////////
    public function addToCartFromSession()
    {
        $this->setSessionProducts();
        // count($this->sessionProducts);
        $tableName = "add_cart";

        $i = 0;

        if (isset($_SESSION['products']['id'])) {
            foreach ($_SESSION['products']['id'] as $productId) {
                $key = array_search($productId, $_SESSION['products']['id']);
                $this->count($tableName, "pid='" . $productId . "'");

                $recordArr = array(
                    "user_id" => $_SESSION['loginid'],
                    "quantity" => ($this->sessionProductQty[$key] == "") ? 1 : $this->sessionProductQty[$key],
                    "pid" => $productId,
                    "color_id" => $_SESSION['products']['colorId'][$key],
                );

                if ($this->save($tableName, $recordArr)) {
                    unset($_SESSION['products']['id'][$key]);
                    unset($_SESSION['products']['qty'][$key]);
                    unset($_SESSION['products']['colorId'][$key]);
                }

                $i++;
            }
        }
    }
    //////// Add Item To Cart from Session ////////

/////// Total Item In Cart ///////
    public function codStatus()
    {
        $this->setSessionProducts();

        if ($this->userId == null) {
            $result = array();
            $count = $this->totalItemInCart();

            if ($count == 0) {
                $result = null;
            } else {
                $i = 0;
                foreach ($_SESSION['products']['id'] as $productId) {
                    // $quantity = ($_SESSION['products']['qty'][$i] == "") ? 1 : $_SESSION['products']['qty'][$i];

                    $query = "SELECT p.id,p.product_name,p.minimum,p.maximum,p.class0,p.price,
                    p.discount,p.userdisc,p.cod,p.product_code,p.vendor_product_id,p.avg_rating,
                    i.image,p.stock
                FROM products as p
                LEFT JOIN image as i on p.product_code=i.p_id and i.status='Active'
                WHERE p.status='Active' and p.id='" . $productId . "' AND p.cod!='Yes'
                GROUP BY p.id";
                
            

                    $query = mysqli_query($this->con, $query);

                    $count = mysqli_num_rows($query);
                    
                    if ($count == 0) {
                        $result = null;
                    } else {
                        // If the query returns >= 1 assign the number of rows to numResults
                        // $numResults = mysqli_num_rows($query);

                        $result[$i] = mysqli_fetch_array($query);

                        $key = array_search($productId, $_SESSION['products']['id']);
                        $result[$i]['quantity'] = ($_SESSION['products']['qty'][$key] == "") ? 1 : $_SESSION['products']['qty'][$key];
                    }
                    $i++;
                }
            }
        } else {
            $query = "SELECT p.id,p.product_name,p.minimum,p.maximum,p.class0,p.price,
                        p.discount,p.userdisc,p.cod,p.product_code,p.vendor_product_id,p.avg_rating,
                        ac.quantity,i.image,p.stock
                    FROM products as p
                    INNER JOIN add_cart as ac on p.id=ac.pid
                    LEFT JOIN image as i on p.product_code=i.p_id and i.status='Active'
                    WHERE p.status='Active' and ac.status ='Active' AND p.cod!='Yes' AND ac.user_id='" . $this->userId . "'
                    GROUP BY p.id";

            $count = mysqli_num_rows(mysqli_query($this->con, $query));
            if ($count == 0) {
                $result = null;
            } else {
                $result = $this->getDataArray($query);
            }
        }
        return $result;
    }
    /////// Total Item In Cart ///////
}
//Class End
$cart = new Cart($con);
