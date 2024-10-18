<?php
 class Checkout extends Cart{

    protected $con;
    private $coupan;
    
    function __construct($con) {
        $this->con = $con;  
        $this->setConnection($con);
        $this->setUserId();
           }


////////// Shipping Address By Order Id //////////
public function shippingAddressById($Id){
    $r = array();
    $query = "SELECT u.id,u.first_name,u.last_name,u.phone,u.email, u.flat,u.street, u.locality,u.city,u.zip_code,u.country,u.state,sl.state as state_name,c.country_name, u.addr_type 
    FROM user_shipping_addresses as u 
    INNER JOIN countries as c on c.id=u.country
    INNER JOIN state_list as sl on sl.id=u.state
    WHERE u.id = '".$Id."'";

    $query = mysqli_query($this->con,$query);
    $r = mysqli_fetch_array($query);

    if($this->fullAddress($r)){
        $r['address'] = $this->fullAddress($r);
    }
        return $r;
    }
////////// Shipping Address By Order Id //////////

    

 ////////// Generate Order Id //////////
public function generateOrderId(){
    return $travk_id='BL'.rand(10000000000,999999999999);
 }
////////// Generate Order Id //////////

////////// Set Coupan //////////          
public function setCoupan($coupan){
$this->coupan = $coupan;
}
////////// Set Coupan //////////
   
////////// Generate Tracking Id //////////
public function generateTrackingId(){
   return $travk_id='TDI'.rand(1000000,9999999);
}
////////// Generate Tracking Id //////////

public function removecoupon()
{
    $data['totalPrice'] = $this->cartTotalAmount();
    $data['gst'] = $this->cartGstTotalAmount();
      return $data;
}
////////// Order Config //////////
public function orderConfig(){
    $sel_query1=mysqli_query($this->con,"SELECT config_type FROM `order_config` WHERE id = 1");
    $sel_data1=mysqli_fetch_array($sel_query1);
    return $sel_data1['config_type'];
}
////////// Order Config //////////

////////// Get Current GST by product Id //////////
public function currentGstOnProduct($productId){
    $query = "SELECT tax 
    FROM products as p
    WHERE p.id = '".$productId."'";

    $query = mysqli_query($this->con,$query);
    $r = mysqli_fetch_array($query);

    if(!empty($r)){
        return $r['tax'];
    }else{
        return NULL;
    }
}
////////// Get Current GST by product Id //////////

//Fetch Coupon
////////// Check Coupan Expired Or Not //////////
public function coupan(){

    $result = array();
    $query = "select * from promo_code WHERE code = '".$this->coupan."' AND status = 'Active' AND trash = 'No' AND type='all'";
    
    $query = mysqli_query($this->con, $query);
    
    $coupon = mysqli_fetch_array($query);
    
    if(!empty($coupon)){

        if((strtotime($coupon['date_of_expiry']))>(strtotime("now"))){

            // if((strtotime($coupon['offer_from_timeStamp']))<(strtotime("now"))){
         
                if($this->userCoupanCount()<$coupon['use_quantity']){

                  
                      $amount = $this->cartTotalAmount();
                      $cartGstTotalAmount = $this->cartGstTotalAmount();
                      
                      $totalPrice = $amount;
                      
                    if($coupon['percentage'] == 'yes'){
                        $couponcodeprice = $coupon['price'] / 100;
                        $discountprice = $totalPrice * $couponcodeprice;
                        
                        // echo $discountprice;
                       
                       if($totalPrice < $discountprice){
                            $result['savePrice'] = $discountprice;
                            $result['totalPrice'] = 0 ;
                            
                            $result['status']="success";
                            $result['message']="Coupan applied!";    
                       }
                       else{
                            $taxpercentage = $cartGstTotalAmount / $totalPrice * 100;
                            $discountedPrice = $totalPrice - $discountprice;
                            $discountedPriceWGST =  $discountedPrice + ($taxpercentage / 100 * $discountedPrice);
                            
                            $result['gst'] = ($taxpercentage / 100 * $discountedPrice);
                            $result['savePrice'] = $discountprice;
                            $result['totalPrice'] = $discountedPriceWGST ;
                        
                            $result['status']="success";
                            $result['message']="Coupan applied!";    
                       }
                       
                    }else{
                        
                         if($totalPrice < $coupon['price']){
                            $result['savePrice'] = $coupon['price'];
                            $result['totalPrice'] = 0 ;
                            
                            $result['status']="success";
                            $result['message']="Coupan applied!";    
                       }
                       else{ 

                            $finalPrice =  $totalPrice -  $coupon['price']; // Price after discount
                            $discountAmount = $totalPrice - $finalPrice; // Calculate the discount amount
                            
                            $taxpercentage = $cartGstTotalAmount / $totalPrice * 100;
                            $discountedPrice = $totalPrice - $coupon['price'];
                            
                            $discountedPriceWGST =  $discountedPrice + ($taxpercentage / 100 * $discountedPrice);
                            $result['gst']= $taxpercentage / 100 * $discountedPrice ; 
                            $result['totalPrice'] = $discountedPriceWGST;
                           
                            $result['savePrice'] = $coupon['price'];
                      
                            $result['status']="success";
                            $result['message']="Coupan applied!";    
                       }
                    }
                }else{
                    $result['status']="failed";
                    $result['message']="Already Used this Coupan!";                    
                }

            // }else{
            //     $result['status']="failed";
            //     $result['message']="Coupan is valid from ".$coupon['offer_from_timeStamp'];                    
            // }

        }else{
            $result['status']="failed";
            $result['message']="Coupan is expired!";    
        }
    }else{
        $result['status']="failed";
        $result['message']="Coupan is Invalid!";
    }
    // print_r($result); 
    // die();
return $result;
}
////////// Check Coupan Expired Or Not //////////

////////// Coupan Status In Order Table //////////
protected function userCoupanCount(){           // true If Not User False If Used
    $query = "select id from order_tbl WHERE coupan_code = '".$this->coupan."' AND userid = '".$this->userId."' AND (payment_status = 'Pending' or payment_status = 'Success')";
    $mysqliQuery = mysqli_query($this->con,$query);
        $num = mysqli_num_rows($mysqliQuery);
    return $num;
}
////////// Coupan Status In Order Table //////////


////////// Coupan Used In Order Table //////////
protected function coupanNotUsed(){           // true If Not User False If Used
    $query = "select id from order_tbl WHERE coupan_code = '".$this->coupan."' AND (payment_status = 'Pending' or payment_status = 'Success')";

        $mysqliQuery = mysqli_query($this->con,$query);
        $num = mysqli_num_rows($mysqliQuery);

        if($num==0){
            return true;
        }else{
            return false;
        }
}
////////// Coupan Status In Order Table //////////

}
?>