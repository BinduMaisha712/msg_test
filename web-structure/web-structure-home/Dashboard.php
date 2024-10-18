<?php
 class Dashboard extends Model{

    protected $con;
	
    
    function __construct($con) {
		$this->con = $con;	
		$this->setConnection($con);
        $this->setUserId();
		   }

		   ///////// Get User Details /////////
    public function getUserDetail(){
        $query = "SELECT u.id,u.firstname,u.lastname,u.mobile,u.email,u.gender,u.flat,u.street,
        u.locality,u.city,u.zipcode,u.state,u.country,u.addr_type,u.subscribe 
        FROM user as u WHERE status='Active' AND id = '".$this->userId."'";
        
       
       $query = mysqli_query($this->con,$query);
       if(mysqli_num_rows($query)>0)
       {
       $result = mysqli_fetch_array($query);

        $address = ($result['flat'] != "")? $result['flat'].", ":"";
        $address .= ($result['street'] != "")? $result['street'].", ":"";
        $address .=  ($result['locality'] != "")? $result['locality'].", ":"" ;
        $address .= ($result['city'] != "")? $result['city'].", ":"" ;
        $address .= ($result['state'] != "")? $result['state'].", ":"" ;
        $address .= ($result['country'] != "")? $result['country']:"" ;
        $address .= ($result['zipcode'] != "")? " - ".$result['zipcode']:"";

       }
       else{
        $address = "";
       }
        $result['address'] = $address;

        return $result;
                }
function lastuseraddress()
     {
                 $query12="SELECT * FROM shiping_address WHERE user_id = '".$this->userId."' ORDER BY id DESC LIMIT 0,1 ";
                return $this->getDataArray($query12);
                }
	///////// Get User Details ///////// 
	
	function isAddr($arr)
	{
	     $query="SELECT * FROM user_shipping_addresses WHERE user_id= '".$arr['user_id']."' AND 
              first_name = '".$arr['first_name']."' AND 
              last_name ='".$arr['last_name']."' AND 
              flat = '".$arr['flat']."' AND 
              street= '".$arr['street']."' AND 
              locality= '".$arr['locality']."' AND 
              city= '".$arr['city']."' AND 
              zip_code= '".$arr['zip_code']."' AND 
              state= '".$arr['state']."' AND 
              country= '".$arr['country']."' AND 
              email= '".$arr['email']."' AND 
              phone= '".$arr['phone']."' AND 
              addr_type='".$arr['addr_type']."'";
               return $this->getDataArray($query);
	}
                ///////// User Addresses /////////
function userAddresses(){
    $result = array();
 $query = "SELECT sp.*,c.country_name,sl.state as state_name 
 FROM user_shipping_addresses as sp 
      INNER JOIN countries as c on c.id=sp.country
    INNER JOIN state_list as sl on sl.id=sp.state
  WHERE user_id = '".$this->userId."' and sp.status='Active' GROUP BY sp.flat,sp.street,sp.locality,sp.city,sp.zip_code,sp.state,sp.country,sp.addr_type ORDER BY sp.id DESC";

// $result[0] = $this->getUserDetail();

$query = mysqli_query($this->con,$query);
// If the query returns >= 1 assign the number of rows to numResults
$numResults = mysqli_num_rows($query);
// // Loop through the query results by the number of rows returned
for($i = 0; $i < $numResults; $i++){
$r = mysqli_fetch_array($query);
   $key = array_keys($r);
       // Sanitizes keys so only alphavalues are allowed
           if(mysqli_num_rows($query) >= 1){
               $result[$i] = $r;
              

               $address = ($r['flat'] != "")? $r['flat'].", ":"";
               $address .= ($r['street'] != "")? $r['street'].", ":"";
               $address .=  ($r['locality'] != "")? $r['locality'].", ":"" ;
               $address .= ($r['city'] != "")? $r['city'].", ":"" ;
               $address .= ($r['state_name'] != "")? $r['state_name'].", ":"" ;
               $address .= ($r['country_name'] != "")? $r['country_name']:"" ;
               $address .= ($r['zip_code'] != "")? " - ".$r['zip_code']:"";
       
                $result[$i]['address'] = $address;
        }else{
            $result[$i] = null;
        }

}

return $result; // Query was successful
}
///////// User Addresses /////////


////////////////// Order Products Detail By order Id /////////
public function orderProducts($orderId){
    $query = "SELECT ot.*,u.product_name, u.tax,sc.symbol as product_size,u.id as product_id
    FROM order_details as ot
    INNER JOIN products as u on ot.productid=u.id
    LEFT JOIN size_class as sc on sc.id=u.class0
    WHERE ot.order_id = '".$orderId."'";

return $this->getDataArray($query);
}
///////// Order Products Detail By order Id /////////

///////// Order Details /////////

public function orderDetails($orderId){
    $query = "SELECT ot.order_id,ot.gst, ot.payment_type,ot.payment_status,ot.payment_mode,
    u.first_name,u.last_name,u.phone,u.email, u.flat,u.street, u.locality,u.city,u.zip_code,
    sl.state,c.country_name,u.addr_type,ot.orderprice,occ.coupon_code,occ.discount_price
    FROM order_tbl as ot
    LEFT JOIN shiping_address as u on ot.order_id=u.order_id
    LEFT JOIN countries as c on c.id=u.country
    LEFT JOIN state_list as sl on sl.id=u.state
    LEFT JOIN order_coupon_code as occ on occ.order_id=ot.order_id
    WHERE ot.order_id = '".$orderId."'";

$query = mysqli_query($this->con,$query);
$result = mysqli_fetch_array($query);

if($this->fullAddress($result)){
    $result['address'] = $this->fullAddress($result);
}
return $result;
}

///////// Order Details /////////

 ///////// Invoice Token By Order Id /////////
    public function invoiceTokenByOrderId($orderId){  //////// Check User Billing Address Updated or Not 
        $query = "SELECT token from invoice_generate WHERE order_id = '".$orderId."'";

        $mysqliQuery = mysqli_query($this->con,$query);
        $num = mysqli_num_rows($mysqliQuery);
     
        if($num > 0){
            $result = mysqli_fetch_array($mysqliQuery);  
            return $result['token'];
        }else{
            return NULL;
        }
    }
    ///////// Invoice Token By Order Id /////////



    ///////// Track Order /////////
public function trackOrder($trackId){

    $r = array();

$query = "SELECT  od.*, ot.order_status, ot.invoice_generated
    FROM order_details as od
    INNER JOIN order_tbl as ot on ot.order_id=od.order_id
    WHERE od.tracking_id = '".$trackId."'";

$query = mysqli_query($this->con,$query);
// If the query returns >= 1 assign the number of rows to numResults
$numResults = mysqli_num_rows($query);
// // Loop through the query results by the number of rows returned
if($numResults > 0){
    $r = mysqli_fetch_array($query);


    $r['shipping_address'] = $this->shippingAddress($r['order_id']);
    $r['status'] = $this->orderStatus($r['tracking_id']);

    $HomePage = new HomePage($this->con);
    $r['product_detail'] = $HomePage->getProductById($r['productid']);
}
return $r;
}
    ///////// Track Order /////////

   ///////// Shipping Address By Order ID /////////
function shippingAddress($orderId){
    $result = array();
   $query = "SELECT u.id,u.order_id,u.first_name,u.last_name,u.phone,u.email, u.flat,u.street, u.locality,u.city,u.zip_code,sl.state,c.country_name, u.addr_type 
    FROM shiping_address as u 
    LEFT JOIN countries as c on c.id=u.country
    LEFT JOIN state_list as sl on sl.id=u.state
    WHERE u.order_id = '".$orderId."'";

// $result[0] = $this->getUserDetail();

$queryQ = mysqli_query($this->con,$query);
// If the query returns >= 1 assign the number of rows to numResults


 $r = mysqli_fetch_array($queryQ);

               $address = ($r['flat'] != "")? $r['flat'].", ":"";
               $address .= ($r['street'] != "")? $r['street'].", ":"";
               $address .=  ($r['locality'] != "")? $r['locality'].", ":"" ;
               $address .= ($r['city'] != "")? $r['city'].", ":"" ;
               $address .= ($r['state'] != "")? $r['state'].", ":"" ;
               $address .= ($r['country_name'] != "")? $r['country_name']:"" ;
               $address .= ($r['zip_code'] != "")? " - ".$r['zip_code']:"";
       
                $r['address'] = $address;

return $r; // Query was successful
}
///////// Shipping Address By Order ID /////////

  ///////// Order Status /////////
    public function orderStatus($trackingId){
        $query = "SELECT  os.*
        FROM order_status as os
        WHERE os.tracking_id = '".$trackingId."'";

        return $this->getDataArray($query);
}
    ///////// Order Status /////////
    //show Orderd Bar
    /////////// Order Determinate Progress Bar ///////////
public function orderProgressBar($orderStatus){

    switch ($orderStatus) {
        
        case 'Ordered and Approved':
            return 20;
            break;
        
        case 'Your Order has been placed':
            return 30;
            break;

        case 'Seller has processed your Order':
            return 40;
            break;


        case 'Packed':
            return 50;
            break;


        case 'Your item has been picked up by courier partner':
            return 60;
            break;


        case 'Your item has been received in the hub nearest to you':
            return 80;
            break;


        case 'your item out for delivery':
            return 90;
            break;


        case 'Delivered':
            return 100;
            break;
        
        case 'Cancelled':
            return 100;
            break;

        default:
        return 10;
            break;
    }
}
/////////// Order Determinate Progress Bar ///////////


    ///////// User Invoice Detail /////////
    public function userInvoiceByOrderId($orderId, $userId){
        $query = "SELECT ig.token,ig.invoice_date,u.firstname, ig.pdf
            FROM invoice_generate as ig
            INNER JOIN user as u on u.id=ig.user_id
            WHERE ig.order_id = '".$orderId."'  ORDER BY ig.id DESC";

             $queryQ = mysqli_query($this->con,$query);
             $result = mysqli_fetch_array($queryQ);  

             return $result;
    }
    ///////// User Invoice Detail /////////

}
?>