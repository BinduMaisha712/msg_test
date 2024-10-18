<?php
class HomePage extends Model{
  protected $con;
  protected $query;
  protected $googleCode;
  protected $menuArr = array();
  protected $sliderArr = array();
  protected $meta = array();
  protected $metaTagKey = array();
  function __construct($con) {
    $this->con = $con;  
    $this->setConnection($con);
  }  



 //fetch meta by page            
  /***Get Menu Data Function****/
  public function meta($pageName,$pid){
    $query = 'SELECT * FROM seopages WHERE page_name="'.$pageName.'" AND pid="'.$pid.'" AND status="Active" ORDER BY id DESC';
    $query = mysqli_query($this->con,$query);
    $numResults = mysqli_num_rows($query);
    if($numResults>0)
    {
      $this->meta = mysqli_fetch_assoc($query);
      $this->meta['metaTags']=$this->metaTagsAndKeywords('metatags',$this->meta['id']);
      $this->meta['metaKeys']=$this->metaTagsAndKeywords('keywords',$this->meta['id']);

    } 
    else
    {
      $this->meta = null;
    }

    return $this->meta;
  }  



  public function metaTagsAndKeywords($tableName,$seo_id){
    $this->metaTagKey=array();
    $query = 'SELECT * FROM '.$tableName.' WHERE seo_id='.$seo_id.' AND status="Active"';
    $query = mysqli_query($this->con,$query);
    $numResults = mysqli_num_rows($query);
    for($i = 0; $i < $numResults; $i++)
    {
      $r = mysqli_fetch_assoc($query);
      $key = array_keys($r);
      if(mysqli_num_rows($query) >= 1)
      {
        $this->metaTagKey[$i] = $r;
      }
      else
      {
        $this->metaTagKey = null;
      }
    }
    return $this->metaTagKey;
  }

         //Fetch Social Icons
  public function socialMedia(){
    $result = array();

    $query = 'SELECT * FROM social_media WHERE status="Active" order by id ASC';
    
    $query1 = mysqli_query($this->con,$query);
    $numResults = mysqli_num_rows($query1);
    for($i = 0; $i < $numResults; $i++)
    {
      $r = mysqli_fetch_assoc($query1);
      if(mysqli_num_rows($query1) >= 1)
      {
        $result[$i] = $r;
      }

    }
    return $result;
  }

  function getProductsDimensions($items){
    $productsDimensions = [];
    $productsDimensions['height'] = 0;
    $productsDimensions['width'] = 0;
    $productsDimensions['length'] = 0;
    $productsDimensions['weight'] = 0;
    $heightArr = [];
    $widthArr = [];
    $lengthArr = [];
    $totalHeight=0;
  
    foreach ($items as $item) {
      if($item['quantity'] > 1){
       echo $item['weight'] =  $item['weight'] * $item['quantity'];
      }
      
       array_push($heightArr,$item['height']);
       array_push($lengthArr,$item['length'] ); 
       array_push($widthArr,$item['width'] ); 
       $totalHeight = max($heightArr) + (max($heightArr) * 0.25);
   
       $productsDimensions['length'] = max($lengthArr);
       $productsDimensions['height'] = $totalHeight;
       $productsDimensions['width'] = max($widthArr);
       $productsDimensions['weight'] += $item['weight'];
    }
    return $productsDimensions;
  }
  
  function lastuseraddress()
     {
                echo $query12="SELECT * FROM shipping_address WHERE user_id = '".$this->userId."' ORDER BY id DESC LIMIT 0,1 ";
                $query = mysqli_query($this->con,$query12);
                return $this->getDataArray($query);
                }

           //Fetch Fav Icon
  public function favIcon(){
    $result = array();

    $query = 'SELECT * FROM fav_icon WHERE id=1';
    
    $query1 = mysqli_query($this->con,$query);
    $result = mysqli_fetch_assoc($query1);

    return $result['icon'];
  }


  ////// Fetch Currency //////
  public function currency(){
    $result = array();

    $query = 'SELECT * FROM currency WHERE id=1';
    
    $query1 = mysqli_query($this->con,$query);
    $result = mysqli_fetch_assoc($query1);

    return $result['currency'];
  }

////// Fetch Home Configuration //////
  public function homeConfig($id){
    $result = array();

    $query = 'SELECT * FROM home WHERE id='.$id;
    $query1 = mysqli_query($this->con,$query);
    $result = mysqli_fetch_assoc($query1);

    return $result['name'];
  }

     //// fetch google-analytic-code //////
  public function getGoogleAnalyticCode(){
    $query="SELECT * FROM google_analytic WHERE id=1";
    $query=mysqli_query($this->con,$query);
    if(mysqli_num_rows($query)>0)
    {
      $row=mysqli_fetch_assoc($query);
      $this->googleCode=$row['code'];
    }
    return $this->googleCode;
  }

 //fetch menu            
  /***Get Menu Data Function****/
  public function menu(){
    $query = 'SELECT DISTINCT c.* from category as c INNER JOIN products as p ON c.id = p.cat_id AND c.status="Active"';
    $query = mysqli_query($this->con,$query);
    $numResults = mysqli_num_rows($query);
    for($i = 0; $i < $numResults; $i++)
    {
      $r = mysqli_fetch_array($query);
      $key = array_keys($r);
      if(mysqli_num_rows($query) >= 1)
      {
        $this->menuArr[$i] = $r;
        $this->menuArr[$i]['condition'] = "id=cat_id@".$r['id'];
        $submenu = $this->subMenu($this->menuArr[$i]['id']);
        if(!empty($submenu))
        {
          $this->menuArr[$i]['subMenu'] = $submenu;
        }
        else
        {
          $this->menuArr[$i]['subMenu'] = 0;
        }
      }
      else
      {
        $this->menuArr = null;
      }
    }
    return $this->menuArr;
  }  

  /***Get Sub Menu Data Function****/
  protected function subMenu($menuRowID){
    $subMenuResult = array();
    $query = 'SELECT DISTINCT sub.* from subcategory as sub INNER JOIN products as p ON p.subcat_id=sub.id AND sub.cat_id="'.$menuRowID.'" and sub.status="Active"';
    $query = mysqli_query($this->con,$query);
          // If the query returns >= 1 assign the number of rows to numResults
    $numResults = mysqli_num_rows($query);
          // // Loop through the query results by the number of rows returned
    for($i = 0; $i < $numResults; $i++)
    {
     $r = mysqli_fetch_array($query);
     $key = array_keys($r);
            // Sanitizes keys so only alphavalues are allowed
     if(mysqli_num_rows($query) >= 1)
     {
       $subMenuResult[$i] = $r;
       $subMenuResult[$i]['condition'] = "id=subcat_id@".$r['id'];
       $subSubmenu = $this->subSubMenu($subMenuResult[$i]['id']);
       if(!empty($subSubmenu))
       {
        $subMenuResult[$i]['subSubMenu'] = $subSubmenu;
      }
      else
      {
        $subMenuResult[$i]['subSubMenu'] = 0;
      }
    }else
    {
      $subMenuResult[$i] = null;
    }
  }
        return $subMenuResult; // Query was successful
      }
      /***Get Sub Sub Menu Data Function****/
      protected function subSubMenu($SubMenuRowID){
        $result = array();
        $query = 'SELECT DISTINCT subSub.* from sub_sub_category as subSub INNER JOIN subcategory as p ON subSub.sub_category_id = p.id AND subSub.sub_category_id="'.$SubMenuRowID.'" and subSub.status="Active"';
        $query = mysqli_query($this->con,$query);
      // If the query returns >= 1 assign the number of rows to numResults
        $numResults = mysqli_num_rows($query);
// // Loop through the query results by the number of rows returned
        for($i = 0; $i < $numResults; $i++)
        {
          $r = mysqli_fetch_array($query);
          $key = array_keys($r);
        // Sanitizes keys so only alphavalues are allowed
          if(mysqli_num_rows($query) >= 1)
          {
            $result[$i] = $r;

            $result[$i]['condition'] = "id=subSubCat_id@".$r['id'];
          }
          else
          {
           $result[$i] = null;
         }
       }
      return $result; // Query was successfully
    }

    ///// fetch is deal product by id //////

    function isDealByProduct($productId)
    {
     $query="SELECT * FROM `today_deal` WHERE (concat(startdate,' ',starttime)<= NOW()) AND (concat(enddate,' ',endtime)>=NOW()) AND pid=".$productId;
     return $this->getDataArray($query);
    }

    /// get today deal products ////
    function getAllTodayDealsProduct()
    {
      $query='SELECT p.*,c.classtype_id FROM products p,category c,today_deal t WHERE p.status="Active" AND c.id=p.cat_id AND t.pId=p.id AND startdate= CURDATE() GROUP BY p.group_code';
     return $this->getDataArray($query);
    }

//fetch logo
// Get WebSite Logo
    public function logo(){
      $query = 'select * from `logo` where id="1"';
      $query = mysqli_query($this->con,$query);
      $results = mysqli_fetch_array($query);
      return $results;
    }

  //fetch sliders
  //banners
    public function slider(){
     $query = 'select * from slider where status="Active"';
     $query = mysqli_query($this->con,$query);
     $numResults = mysqli_num_rows($query);
     if($numResults > 0){
      for($i = 0; $i < $numResults; $i++){
        $r = mysqli_fetch_array($query);
        $key = array_keys($r);
          // Sanitizes keys so only alphavalues are allowed
        if(mysqli_num_rows($query) >= 1){
          $this->sliderArr[$i] = $r;

          $sliderContent = $this->sliderContent($this->sliderArr[$i]['id']);
          if(!empty($sliderContent)){
           $this->sliderArr[$i]['sliderContent'] = $sliderContent;
         }else{
           $this->sliderArr[$i]['sliderContent'] = 0;
         }

       } 
       else{
         $this->sliderArr = null;
       }

     }
   }
   return $this->sliderArr;
 }     

 protected function sliderContent($slider){
  $sliderContentArr = array();

  $query = 'SELECT sc.* from slider_content as sc INNER JOIN slider as s ON sc.slider_id = s.id AND sc.slider_id ='.$slider.' AND sc.status="Active"';
  $query = mysqli_query($this->con,$query);
  $numResults = mysqli_num_rows($query);
  if($numResults > 0){
    for($i = 0; $i < $numResults; $i++){
      $r = mysqli_fetch_array($query);
      $key = array_keys($r);
                // Sanitizes keys so only alphavalues are allowed
      if(mysqli_num_rows($query) >= 1){
        $sliderContentArr[$i] = $r;

      }else{
        $sliderContentArr = null;
      }

    }
  }
  return $sliderContentArr;
}

  //Fetch Categories As Per different Conditions
public function categories($filter,$catLimit = NULL){

  $limit = ($catLimit != 0)  ? ' LIMIT 0,' .$catLimit : "";  

  switch ($filter) {
   case "new_arrivals":
   $query = "SELECT c.id,c.cat_name,c.classtype_id FROM category as c INNER JOIN products as p ON c.id = p.cat_id where p.new_arrivals ='Yes' and p.status='Active' and c.status='Active' group by c.id order by rand()".$limit;
   return $this->getDataArray($query);
   break;

   case "hot_deals":
   $query = "SELECT c.id,c.cat_name,c.classtype_id FROM category as c INNER JOIN products as p ON c.id = p.cat_id where p.hot_deals ='Yes' and p.status='Active' and c.status='Active' group by c.id order by rand()".$limit;
   return $this->getDataArray($query);
   break;

   case "top":
   $query = "SELECT c.id,c.cat_name,c.classtype_id FROM category as c INNER JOIN products as p ON c.id = p.cat_id where p.top ='Yes' and p.status='Active' and c.status='Active' group by c.id order by rand()".$limit;
   return $this->getDataArray($query);
   break;

   default:
   $query = "SELECT c.id,c.cat_name,c.classtype_id FROM category as c INNER JOIN products as p ON c.id = p.cat_id AND c.status='Active' GROUP BY c.cat_name".$limit;
   return $this->getDataArray($query);
 }
}

    //Fetch Products As Per Categories And Type
public function productsByCategoryAndType($catId,$type,$limit=NULL){

  $limit = ($limit != 0)  ? ' LIMIT 0,' .$limit : "";

  $query = 'SELECT * from products WHERE cat_id="'.$catId.'" AND '.$type.'="Yes" AND status="Active" group by group_code order by id desc'.$limit;
  
  // echo $query;
  $result = $this->getDataArray($query);

    return $result; // Query was successful
  }

  // newone
  //Fetch Products As Per Categories And Type
public function productsByType1($type,$limit=NULL){

  $limit = ($limit != 0)  ? ' LIMIT 0,' .$limit : "";

  $query = 'SELECT * from products WHERE '.$type.'="Yes" AND status="Active" order by rand() desc'.$limit;
  
  // echo $query;
  $result = $this->getDataArray($query);

    return $result; // Query was successful
  }


  public function recentlyBoughtProducts($limit = NULL){
    $limit = ($limit != 0)  ? ' LIMIT 0,' .$limit : "";

    $query = 'SELECT p.* FROM products p, order_details od WHERE od.productid = p.id AND p.trash ="No"  GROUP BY od.productid ORDER BY od.id DESC'.$limit;
    
    // echo $query;
    $result = $this->getDataArray($query);
  
      return $result; // Query was successful
  }

 //Fetch Product Image
  // Get Images
  public function image($category,$arg2=NULL,$limit=NULL){
    
    if($category != 'header'){
      $productId = $arg2;
    }else{
      $headerType = $arg2;
    }

    switch ($category) {
      // case "header":
      //  return $this->getHeaderImage($headerType,$limit);
      //  // echo $headerType;

      //  break;
      case "product":
        // echo $productId;
      return $this->productImage($productId,$limit);
      break;

      case "products":
      return $this->productAllImages($productId,$limit);
      break;
      // default:
      // $condition = " and top='Yes' order by id desc".$limit;
      // return $this->getProducts($condition);
    }
  }

  //Get Product Single Image By of Product
  public function productImage($productCode,$limit=NULL){
    $limit = ($limit != 0)  ? ' LIMIT 0,' .$limit : "";

    // $query = "SELECT image from image where status='Active' AND p_id = '".$productCode."'".$limit;

    $sql_imck= "select * from image where p_id='".$productCode."' and set_seq='1' and status='Active'";

    $numrrow = mysqli_query($this->con,$sql_imck);

    if(mysqli_num_rows($numrrow)>0)
    {
      $query= "select * from image where p_id='".$productCode."' and set_seq='1' and status='Active'";
    }
    else{
      $query= "select * from image where p_id='".$productCode."' and status='Active'";
    }

    $result = mysqli_query($this->con,$query);
    // $data = mysqli_fetch_assoc($result);

    $numResults = mysqli_num_rows($result);
    if($numResults == 0){
     return NULL; 
   }
   return ($limit == NULL) ? $this->getDataArray($query) : mysqli_fetch_assoc($result)['image'] ;
    // return $data;
    // return $data['image'];
 }

      //Fetch all Images Of Product By Product ID
 protected function productAllImages($productId){
   $result = array();
   $query = 'SELECT id,image FROM image WHERE status="Active" AND p_id="'.$productId.'" ORDER BY set_seq ASC';
   $result = $this->getDataArray($query);

      return $result; // Query was successful
    }

    ///////// Get Product All Details By Product Id /////////
   public function getProductById($id){

    $result = array();
    $query = "SELECT p.*,d.description,s.specification,p.brand,c.issubcategory 
    FROM products as p 
    LEFT JOIN description as d on p.id=d.p_id and d.status='Active' 
    LEFT JOIN specification as s on p.id=d.p_id and d.status='Active' 
    LEFT JOIN category as c on p.cat_id=c.id
    WHERE p.id='".$id."' "; 


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

               /////// Images ////////
       $images = $this->productAllImages($r['product_code']);
       if(!empty($images)){
        $result[$i]['images'] = $images;
      }else{
        $result[$i]['images'] = 0;
      }
               /////// Images ////////

             ///////// Reviews /////////
      $reviews = $this->getReviews($r['id']);
      if(!empty($images)){
        $result[$i]['reviews'] = $reviews;
      }else{
        $result[$i]['reviews'] = 0;
      }
             ///////// Reviews /////////

               ///////// AvgRating /////////
              //   $result[$i]['rating'] = $this->getAvgReviewStar($r['id']);
      $result[$i]['totalReview'] = count($reviews);
              ///////// AvgRating /////////

    }else{
      $result[$i] = null;
    }

  }
    return $result[0]; // Query was successful

  }
  ///////// Get Product All Details By Product Id /////////

  public function getReviews($productId){
    $result = array();

    $query = 'SELECT r.id,r.star,r.review_title,r.review,r.userid,r.datentime,u.firstname 
    FROM review as r
    LEFT JOIN user as u on u.id=r.userid and u.status="Active"
    WHERE r.status="Active" AND r.pid="'.$productId.'"';


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

      $result[$i]['images'] = $this->getData('review_image','image','reviewid="'.$r['id'].'"');
    }else{
     $result[$i] = null;
   }

 }

     return $result; // Query was successful
   }
  ///////// Get Reviews By Product Id /////////


///////////// Get Size Of Product by Product Code /////////////
   public function productSizes($productCode){
    $r = array();
    $query = "SELECT s.id FROM size_class as s INNER JOIN products as p on p.class0=s.id AND p.status='Active' AND p.stock='Yes' where s.status='Active' AND p.product_code='".$productCode."'";
    $queryData = mysqli_query($this->con,$query);

    $numResults = mysqli_num_rows($queryData);
    if($numResults > 0){
      while ($row = mysqli_fetch_array($queryData)) {
        $r[] = $row['id'];        
      }
    }

    return $r;
  }
  public function productSizesByGroup($groupCode){
    $r = array();
     $query = "SELECT p.class0 as id FROM size_class as s INNER JOIN products as p on p.class0=s.id AND p.status='Active' AND p.stock='Yes' where s.status='Active' AND p.group_code='".$groupCode."'";
    // $query = "SELECT s.id FROM size_class as s INNER JOIN products as p on p.class0=s.id AND p.status='Active' AND p.stock='Yes' where s.status='Active' AND p.product_code='".$productCode."'";
    $queryData = mysqli_query($this->con,$query);

    $numResults = mysqli_num_rows($queryData);
    if($numResults > 0){
      while ($row = mysqli_fetch_array($queryData)) {
        $r[] = $row['id'];        
      }
    }

    return $r;
  }
  
  public function productsSizesByGroup($groupCode,$class,$class1){
    $r = '';
     $query = "SELECT p.class1 as class1 FROM size_class as s INNER JOIN products as p on p.class0=s.id AND p.status='Active' AND p.stock='Yes' where s.status='Active' AND p.class0='$class' AND p.class1='$class1' AND p.group_code='".$groupCode."'";
    // $query = "SELECT s.id FROM size_class as s INNER JOIN products as p on p.class0=s.id AND p.status='Active' AND p.stock='Yes' where s.status='Active' AND p.product_code='".$productCode."'";
    $queryData = mysqli_query($this->con,$query);

    $numResults = mysqli_num_rows($queryData);
    if($numResults > 0){
      while ($row = mysqli_fetch_array($queryData)) {
        $r = $row['class1'];        
      }
    }

    return $r;
  }
   
    ///////////// Get Size Of Product by Product Code /////////////

      //Fetch Sizes As Per different Conditions
   public function sizes1($id,$type,$cid){
    if($type='cat_id')
    {
    $query = "SELECT sc.id,sc.name,sc.symbol,sc.classtype_id FROM size_class sc,products p where p.cat_id=$cid AND sc.status='Active' AND sc.classtype_id=$id AND (p.class1=sc.symbol OR p.class0=sc.id OR p.class2=sc.id OR p.class3=sc.id) GROUP BY sc.id";
    }
    else
    {
     $query = "SELECT sc.id,sc.name,sc.symbol,sc.classtype_id FROM size_class sc,products p where p.subcat_id=$cid AND sc.status='Active' AND sc.classtype_id=$id AND (p.class1=sc.symbol OR p.class0=sc.id OR p.class2=sc.id OR p.class3=sc.id) GROUP BY sc.id";
       
    }
    return $this->getDataArray($query);

  }

  public function ratingFilter($cat, $type){
    if($type='p.cat_id')
    {
    $query = "SELECT MAX(avg_rating) AS max_rating FROM products  WHERE cat_id = $cat";
    }
    else
    {
      $query = "SELECT MAX(avg_rating) AS max_rating FROM products  WHERE subcat_id = $cat"; 

    }
    // echo "SELECT MAX(avg_rating) AS max_rating FROM products  WHERE subcat_id = $cat";
    return $this->getDataArray($query);
  }
  


    //Fetch Sizes As Per different Conditions
  public function sizes($limit = NULL){

    $limit = ($limit != 0)  ? ' LIMIT 0,' .$limit : "";  
    

    $query = "SELECT id,name,symbol,classtype_id FROM size_class where status='Active'  order by id".$limit;
    return $this->getDataArray($query);

  }
  
  
    //Fetch Sizes As Per different Conditions
  public function sizesbycategory($id,$type){
     $query = "SELECT s.id,s.name,s.symbol,s.classtype_id FROM size_class s where s.status='Active' AND s.classtype_id!=1  AND s.classtype_id IN($id) order by s.id";
    return $this->getDataArray($query);

  }

  public function brands($ids)
  {
    $catIds="";
    $subcatIds="";
    foreach($ids as $value)
    {
      if(strpos($value, 'p.cat_id=')!== false)
      {
        $catIds.=explode('p.cat_id=',$value)[1].',';
      }
      if(strpos($value, 'p.subcat_id=')!== false)
      {
        $subcatIds.=explode('p.subcat_id=',$value)[1].',';
      }

    }

    $catIds=rtrim($catIds,',');
    $subcatIds=rtrim($subcatIds,',');
    $where="brand!='' AND ";
    if(!empty($catIds))
    {
     $where.=' cat_id IN ('.$catIds.')'; 
    }
    if(!empty($subcatIds))
    {
      if(!empty($catIds))
        $where.='OR';
     $where.=' subcat_id IN ('.$subcatIds.')'; 
    }
    $query="SELECT DISTINCT brand FROM products WHERE $where AND trash = 'No' AND status = 'Active' order by brand asc";
    // echo $query;

    return $this->getDataArray($query);


  }

  public function sizesByClassType($classtypeId){
    
    $query = "SELECT id,name,symbol FROM size_class where status='Active' and classtype_id IN ($classtypeId) order by id asc";
    return $this->getDataArray($query);
  }

   ///////////// Product Id By Product Code and Product Size Id ////////////
  public function productIdByProductSize($productCode,$productSize){
     $query = "SELECT id FROM products where status='Active' AND class0='".$productSize."' AND group_code='".$productCode."'";
    $queryData = mysqli_query($this->con,$query);
    $r = mysqli_fetch_array($queryData);

    return $r['id'];
  }
   public function productIdsByProductSize($productCode,$productSize,$class1){
     $query = "SELECT id FROM products where status='Active' AND class0='".$productSize."' AND class1='".$class1."' AND group_code='".$productCode."'";
    $queryData = mysqli_query($this->con,$query);
    $r = mysqli_fetch_array($queryData);

    return $r['id'];
  }
///////////// Product Id By Product Code and Product Size Id ////////////
  public function productIdByProductSizes($groupCode,$condition){
    $query = "SELECT id FROM products where status='Active' AND $condition AND group_code='".$groupCode."'";
    $queryData = mysqli_query($this->con,$query);
    $r = mysqli_fetch_array($queryData);

    return $r['id'];
  }
///////////// Product Id By Product Code and Product Size Id ////////////

//Fetch offer Image

////Get Offer Image
  public function getOfferImage($limit=NULL,$condition=NULL){
    $limit = ($limit != NULL)  ? ' LIMIT 0,' .$limit : "";

    $condition = ($condition!=NULL) ? " and ".$headerType: "";

    $query = "SELECT * from offer_slider where status='Active' $condition order by id desc".$limit;
    $result = mysqli_query($this->con,$query);

    return $this->getDataArray($query);
      // $data = mysqli_fetch_assoc($result);

      // return $condition;
      // return $data['header'];
  }

    // fetch Category Name
    public function getCatName($catInfo){      ///// Get Cat Name By Category Type And Category Id
      $catInfo=explode("_",$catInfo);
      $catType=$catInfo[0]."_id";
      $id=$catInfo[1];

      switch ($catInfo[0]) {
        case "cat":
        $tableName="category";
        $column = "cat_name";
        
        break;
        case "subcat":
        $tableName="subcategory";
        $column = "sub_cat_name";

        break;

        case "subSubCat":
        $tableName="sub_sub_category";
        $column = "sub_sub_category_name";

        break;

      }

      $query = 'SELECT '.$column.' from '.$tableName.' WHERE id="'.$id.'" AND status="Active"';
      $data = $this->getDataArray($query);

      if(isset($data[0][$column])){
      return $data[0][$column]; // Query was successful
    }

  }

// Fetch Header Image
  //Get Header Image
  public function getHeaderImage($limit=NULL){
    $limit = ($limit != NULL)  ? ' LIMIT 0,' .$limit : "";

    $query = "SELECT cat_type_id,header,heading,click,content,button_name from headerimage where status='Active' order by id desc".$limit;
    $result = mysqli_query($this->con,$query);
    
    return ($limit != NULL) ? $this->getDataArray($query) : mysqli_fetch_assoc($result);
    // $data = mysqli_fetch_assoc($result);

    // return $condition;
    // return $data['header'];
  }

//Fetch contact info
  // Get Contact Info
  public function contactInfo($column){
    $result = array();

    $query = 'SELECT '.$column.' FROM footer WHERE status="Active" order by id DESC LIMIT 0,1';
    
    $query1 = mysqli_query($this->con,$query);
    
    if(mysqli_num_rows($query1)>0){
      $result = mysqli_fetch_array($query1);

    return $result[$column]; // Query was successful
  }else{
    return false;
  }

}

//Fetch Color
  //Fetch Colors As Per different Conditions
public function colors($limit = NULL){

  $limit = ($limit != 0)  ? ' LIMIT 0,' .$limit : "";  

  $query = "SELECT id,color_name,color_code FROM color_info where status='Active' order by color_name".$limit;
  return $this->getDataArray($query);
  
}

// fetch Product Rating
  // Get Product Rating Info
public function productRating($groupCode){
  $result = array();
   $query = 'SELECT AVG(star) as rating FROM review WHERE status="Active" AND pid="'.$groupCode.'"';

  $result = $this->getDataArray($query);
    return $result[0]['rating']; // Query was successful
  }

  ///////////// Get All Size Of Product by Product Code /////////////
  public function getProductColors($groupCode){
    $query = "SELECT id,class1 FROM products where status='Active' AND group_code='".$groupCode."' group by class1";
    return $result = $this->getDataArray($query);
  }
  ///////////// Get All Size Of Product by Product Code /////////////
 ///////////// Get All Size Of Product by Product Code /////////////
  public function getSelectColors($spid){
    $query = "SELECT id,class1 FROM products where status='Active' AND id='".$spid."'";
    return $result = $this->getDataArray($query);
  }
  ///////////// Get All Size Of Product by Product Code /////////////


//Fetch Related Products
//Fetch Products As Per different Conditions
  public function products($filter,$arg2 = NULL){
    $productLimit = 0;
    ($filter != "related")? $productLimit = $arg2 : $relatedCondition = $arg2;
    $limit = ($productLimit != 0)  ? ' LIMIT 0,' .$productLimit : "";  

    switch ($filter) {
      case "featured_products":
      $condition = " and p.top='Yes' group by p.group_code order by p.id desc".$limit;
      return ($productLimit != 1)  ? $this->getProducts($condition) : $this->getProducts($condition)[0];
      break;
      case "hot_deals":
      $condition = " and p.hot_deals ='Yes' group by p.group_code order by p.id desc".$limit;
      return ($productLimit != 1)  ? $this->getProducts($condition) : $this->getProducts($condition)[0];
      break;
      case "new_arrivals":
      $condition = " and p.new_arrivals='Yes' group by p.group_code order by p.id desc".$limit;
      return ($productLimit != 1)  ? $this->getProducts($condition) : $this->getProducts($condition)[0];
      break;
      // case "best_sellers":
      //  $query = "SELECT p.*,COUNT(od.productid) as occurrences FROM order_details as od INNER JOIN products as p ON od.productid=p.id GROUP BY od.productid,p.group_code ORDER BY occurrences DESC".$limit;
      //  return ($productLimit != 1)  ? $this->getDataArray($query) : $this->getDataArray($query)[0];
      // break;
      case "all":
      $condition = " group by p.group_code order by p.id desc".$limit;
      return ($productLimit != 1)  ? $this->getProducts($condition) : $this->getProducts($condition)[0];
      break;
      case "related":

      $condition = " and ".$relatedCondition." group by p.group_code order by p.id desc";
      return ($productLimit != 1)  ? $this->getProducts($condition) : $this->getProducts($condition)[0];
      break;
      default:
      $condition = " and group by p.group_code order by p.id desc".$limit;
      return ($productLimit != 1)  ? $this->getDataArray($query) : $this->getDataArray($query)[0];
    }
  }

  protected function getProducts($condition){
    $result = array();
    
    $this->query = 'SELECT p.*,c.classtype_id FROM products p,category c WHERE p.cat_id=c.id AND p.status="Active" '.$condition;
    
    $result = $this->getDataArray($this->query);
    return $result; // Query was successfully
  }

  public function totalItems(){
    $result = array();
    
    if($this->query != ""){
      $query = mysqli_query($this->con,$this->query);

      return mysqli_num_rows($query); // Query was successfully
    }

  }

  
   ///////// Get Avg Review Star By Product Id /////////
  public function getAvgReviewStar($productId){
    $result = array();

    $query = 'SELECT AVG(star) as avgStar FROM review WHERE status="Active" AND pid="'.$productId.'"';

    $result = $this->getDataArray($query);
     return $result[0]['avgStar']; // Query was successfully
   }
  ///////// Get Avg Review Star By Product Id /////////

// Fetch faq
    ////////// Get FAQ /////////
   public function getFAQ(){

    $result = array();
    $query = 'SELECT id,title 
    FROM `faq_title` WHERE status="Active"';

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

       $dQuery = 'SELECT description 
       FROM `faq` WHERE status="Active" and title_id = "'.$r['id'].'"';

       $result[$i]['description'] = $this->getDataArray($dQuery);
     }else{
      $result[$i] = null;
    }

  }

      return $result; // Query was successfully
      
    }
      ////////// Get FAQ /////////

      //Fetch privacy policy
      ////////// Get Privacy And Policy /////////
    public function getPrivacyAndPolicy(){

      $result = array();
      $query = 'SELECT id,title 
      FROM `privacy&policy_title` WHERE status="Active"';

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

         $dQuery = 'SELECT description 
         FROM `privacy&policy` WHERE status="Active" and title_id = "'.$r['id'].'"';

         $result[$i]['description'] = $this->getDataArray($dQuery);
       }else{
        $result[$i] = null;
      }

    }
    return $result; // Query was successfully

  }
  ////////// Get Privacy And Policy /////////

   //Fetch Terms And condition
   ////////// Get Terms And Conditions /////////
  public function getTermsAndConditions(){

    $result = array();
    $query = 'SELECT id,title 
    FROM `terms&conditions_title` WHERE status="Active"';

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

       $dQuery = 'SELECT description 
       FROM `terms&condition` WHERE status="Active" and title_id = "'.$r['id'].'"';

       $result[$i]['description'] = $this->getDataArray($dQuery);
     }else{
      $result[$i] = null;
    }

  }
      return $result; // Query was successfully

    }
  ////////// Get Terms And Conditions /////////



 public function calculateDiscountPercentage($originalPrice, $discountedPrice) {
    $discount = $originalPrice - $discountedPrice;
    $discountPercentage = ($discount / $originalPrice) * 100;
    return floor($discountPercentage);
}

public function getBrands($limit){
$limit = ' ORDER BY id DESC LIMIT ' . $limit;
  $query = "SELECT * FROM products WHERE stock = 'Yes' AND status = 'Active' AND trash = 'No'".$limit;
  return $this->getDataArray($query);

}

function encrypt_decrypt( $string, $action = 'encrypt' )
{
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'KI3cC0D0oON30OoHO'; // user define private key
    $secret_iv = '0O0o0oo0o0O0oOoOoO00oo0o'; // user define secret key
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 ); // sha256 is hash_hmac_algo
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt( json_encode( $string ), $encrypt_method, $key, 0, $iv );
        $output = base64_encode( $output );
    } else if ( $action == 'decrypt' ) {
        $output = json_decode( openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv ) );
    }
    return $output;
}


  }
  $homePage= new HomePage($con);
  ?>
