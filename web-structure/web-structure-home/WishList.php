<?php

/* Wish List Class */
class WishList extends Model{

	protected $con;

	protected $userId;
	protected $tableName;
	protected $id;
	protected $columnSet;
	protected $valueSet;
	protected $record;
	protected $products = array();
	protected $sessionWishList = array();

	function __construct($con) {
		$this->con = $con;	
		$this->setConnection($con);
		$this->setUserId();
		   }
	



	//Check Item Exist IN Wish List or NOT
	public function productExistInWishList($productId){    ///return True || False
		$this->setSessionWishList();
	return ((!$this->productExistInWishListSession($productId)) && (!$this->productExistInWishListTable($productId))) ? false : true;
	}
	
	/////// Set Session Products Property Value ////////
	public function setSessionWishList(){
		if(isset($_SESSION['wishList'])){
			$this->sessionWishList = $_SESSION['wishList'];
		}
		return true;
	}
	/////// Set Session Products Property Value ////////

	/////// Check Product ID Exist In Wish List Session ////////
	public function productExistInWishListSession($productId){    ///return True || False
	$result = (empty($this->sessionWishList)) ? false : in_array($productId, $this->sessionWishList);	
	return (empty($this->sessionWishList)) ? false : $result;
	}
	/////// Check Product ID Exist In Wish List Session ////////
	
	/////// Check Product ID Exist In Wish List ////////
	public function productExistInWishListTable($productId){    ///return True || False
	$condition = 'product_id="'.$productId.'" and user_id="'.$this->userId.'"';
	
	return ($this->userId == NULL)? false : $this->count('wishlist',$condition);
	}
	/////// Check Product ID Exist In Wish List ////////

   //////// Remove Item From WishList ////////
	public function removeItemFromWishlist($productId){
		$this->setSessionWishList();

		if($this->userId == NULL){ ////// Remove Item From Session

			$key = array_search($productId, $_SESSION['wishList']);
			unset($_SESSION['wishList'][$key]);
			return true;
		}else{   ////// Remove Item From Table
			$this->count('wishlist',"product_id='".$productId."'");
			$recordArr = array(
				"user_id" => $_SESSION['loginid'],
				"product_id" => $productId,
				"status" => 'Deleted'
			);
			return $this->save('wishlist',$recordArr);	
		}
	}
	//////// Remove Item From Cart ////////
	
  /////// Total Item In Wish List Detail ///////
	public function wishListDetail(){
		$this->setSessionWishList();


		if($this->userId==NULL){
			$result = array();
			$count = $this->totalItemInWishList();

			if($count == 0){
				$result['wishListEmpty'] = true;
				$result['message'] = 'Oops! Your Wish List is empty!';      ////// Message Show If cart is Empty When session user Id is not SET
			}else{
				
				foreach($_SESSION['wishList'] as $productId){

					$query = "SELECT p.id,p.product_name,p.minimum,p.maximum,p.class0,p.price,
					p.discount,p.cod,p.product_code,p.vendor_product_id,p.avg_rating, 
					i.image,p.stock,p.in_stock
				FROM products as p 
				LEFT JOIN image as i on p.product_code=i.p_id and i.status='Active' 
				WHERE p.status='Active' and p.id='".$productId."' 
				GROUP BY i.p_id";
	
				$query = mysqli_query($this->con,$query);
				// If the query returns >= 1 assign the number of rows to numResults
				// $numResults = mysqli_num_rows($query);
			
				$result[] = mysqli_fetch_array($query);
			}
			}
		}else{
		$query = "SELECT p.id,p.product_name,p.minimum,p.maximum,p.class0,p.price,
		 				p.discount,p.cod,p.product_code,p.vendor_product_id,p.avg_rating, 
		 				i.image,p.stock,p.in_stock 
		 			FROM products as p 
		 			INNER JOIN wishlist as wl on p.id=wl.product_id 
		 			LEFT JOIN image as i on p.product_code=i.p_id and i.status='Active' 
		 			WHERE p.status='Active' and wl.status ='Active' and wl.user_id='".$this->userId."' 
		 			GROUP BY i.p_id";
		
		$count = mysqli_num_rows(mysqli_query($this->con,$query));
		if($count == 0){
			$result['wishListEmpty'] = true;
			$result['message'] = 'Oops! Your Wish List is empty!';      ////// Message Show If Wish List is Empty When session user Id is SET
		}else{
		 $result = $this->getDataArray($query);
		}
		}
		return $result;

	}
	/////// Total Item In Wish List Detail ///////

	/////// Total Item In Cart ////////
	public function totalItemInWishList(){
		$this->setSessionWishList();

		return ($this->userId == NULL) ? count($this->sessionWishList) : $this->count('wishlist','user_id = "'.$this->userId.'"');
		
	}
	/////// Total Item In Cart ////////


	//////// Add Item To Wishlist from Session ////////
	public function addToWishListFromSession(){
		$this->setSessionWishList();
		$tableName = "wishlist";
		
		$i=0;

		if(isset($_SESSION['wishList'])){
			foreach($_SESSION['wishList'] as $productId){
		
				$key = array_search($productId, $_SESSION['wishList']);
				
				$this->count($tableName,"product_id='".$productId."'");
     
                       $recordArr = array(
                          "user_id" => $_SESSION['loginid'],
                          "product_id" => $productId
                          );
				if($this->save($tableName,$recordArr)){
					$key = array_search($productId, $this->sessionWishList);
                      unset($_SESSION['wishlist'][$key]);
				}
			
			$i++;
		   }
		}

	}
	//////// Add Item To Wishlist from Session ////////
	

	}
	//Class End
	$wishList = new WishList($con);

	//  unset($_SESSION["products"]);  
	// $_SESSION["loginid"]= 2;  