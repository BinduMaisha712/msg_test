<?php
include('config/connection.php');

date_default_timezone_set("Asia/kolkata");
$date=date("Y-m-d");
$time=date("H:i:s");



require 'vendor/autoload.php';
$upload_dir = '../asset/image/product';

use PhpOffice\PhpSpreadsheet\Spreadsheet;

$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
$spreadsheet = new Spreadsheet();

if (isset($_POST)) {

 $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

// $classtype = json_decode($_POST['classtype_id']);
 if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

  $spreadsheet = $reader->load($_FILES['file']['tmp_name']);
  $sheetData = $spreadsheet->getActiveSheet()->toArray();
  $Msg = "";
  $final_result = true;
  

  if (!empty($sheetData)) {
    $import_data = array();
    if (count($sheetData) > 1) {
      for ($i = 1; $i < count($sheetData); $i++) {
                    // triming
        for ($j = 0; $j <= 5; $j++) {
          $sheetData[$i][$j] = trim($sheetData[$i][$j]);
        }
                    // end
                    // check condition
                    // echo $sheetData[$i][0];
                    // echo $sheetData[$i][2];
                    // echo $sheetData[$i][5];
                    // if (
                    //     empty($sheetData[$i][0]) ||
                    //     empty($sheetData[$i][2]) ||
                    //     empty($sheetData[$i][5]) 

                    // ) {

                    //     $final_result = false;
                    //     $Msg = "Please fill mandatory fields at row no. " . $i;
                    //     break;
                    // }

        $productName = addslashes($sheetData[$i][2]);
        $query = mysqli_query($conn,"SELECT * FROM category WHERE status='Active' AND LOWER(cat_name)=LOWER('" . addslashes($sheetData[$i][0]) . "')");
        $numResults = mysqli_num_rows($query);
        if($numResults>0)
        {
          $result1=mysqli_fetch_assoc($query);
          $categoryId=$result1['id'];
          $issubcategory=$result1['issubcategory'];
          if($issubcategory=='No')
            $classtype_id=$result1['classtype_id'];

        }
        
        if ($categoryId) {
                        // $categoryId = $categoryId[0]['id'];
          $query1 = mysqli_query($conn,"SELECT * FROM subcategory WHERE status='Active' AND LOWER(sub_cat_name)=LOWER('" . addslashes($sheetData[$i][1]) . "')");
          $numResults1 = mysqli_num_rows($query1);
          if($numResults1>0)
          {
            $result=mysqli_fetch_assoc($query1);
            $subCatId=$result['id'];
            $classtype_id=$result['classtype_id'];
            
          }
          if ($subCatId) {

            $pQuerY = "SELECT id FROM products WHERE subcat_id ='$subCatId' && cat_id = '$categoryId' && product_name='$productName' && status ='Active'";
            $chelk = mysqli_query($conn, $pQuerY);

            if ($chelk && mysqli_num_rows($chelk) >= 1) {
              $final_result = false;
              $Msg = "Product " . $productName . " already exist at category <b>" . $sheetData[$i][0] . "</b> and sub-category <b>" . $sheetData[$i][1] . "</b>";
              break;
            }
          } else {

            $pQuerY = "SELECT id FROM products WHERE cat_id = '$categoryId' && product_name='$productName'  && status ='Active'";
            $chelk = mysqli_query($conn, $pQuerY);
            if (mysqli_num_rows($chelk) >= 1) {
              $final_result = false;
              $Msg = "Product " . $productName . " already exist at category " . $sheetData[$i][0] . "";
              break;
            }
          }
          
                        // other case
                        // if ($sheetData[$i][2] == '') {

                        //     $q = "select id,sub_cat_name from subcategory where cat_id = '{$categoryId}'";
                        //     $r = mysqli_query($conn, $q);
                        //     $rows = mysqli_num_rows($r);
                        //     $arr = mysqli_fetch_all($r);

                        //     if ($rows > 0) {
                        //         $qw = "select id,sub_cat_name from sub_categories where cat_id = '{$categoryId}' and sub_cat_name = 'Others'";
                        //         $qwq = mysqli_query($conn, $qw);
                        //         $rw = mysqli_num_rows($qwq);
                        //         $arrr = mysqli_fetch_assoc($qwq);
                        //         if ($rw > 0) {
                        //             $s_id = $arrr['id'];
                        //             $sheetData[$i][2] = 'Others';
                        //             $up = "UPDATE product_details SET sub_cat_id = '{$s_id}' WHERE cat_id ='{$categoryId}' AND sub_cat_id=' '";
                        //             mysqli_query($conn, $up);
                        //         } else {
                        //             $aee = array(
                        //                 'cat_id' => $categoryId,
                        //                 'sub_cat_name' => 'Others'
                        //             );
                        //             $database->save('sub_categories', $aee);
                        //             $s_id = mysqli_insert_id($conn);
                        //             $sheetData[$i][2] = 'Others';
                        //             $up = "UPDATE product_details SET sub_cat_id = '{$s_id}' WHERE cat_id ='{$categoryId}' AND sub_cat_id=' '";
                        //             mysqli_query($conn, $up);
                        //         }
                        //     }
                        // }
                        // end
        }

        $class=json_decode($classtype_id);
        $groupCode = uniqid();

                    // end


                    // token
                    //$import_data['token'] = round(microtime(true)) . $database->generateToken(8);
                   // end

                    // product name
        if ($sheetData[$i][0] != '') {
          $import_data['product_name'] = $sheetData[$i][2];
        } else {
          $import_data['product_name'] = '';
        }
                    // end

                    // category
        if ($sheetData[$i][0] != '') {
          $sheetData[$i][0] = $sheetData[$i][0];
          $cat_id =mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM category WHERE status='Active' AND LOWER(cat_name)=LOWER('" . addslashes($sheetData[$i][0]) . "')"))['id'];

          if ($cat_id) {
            $import_data['cat_id'] = $cat_id;
          }
          else
          {
            $import_data['cat_id'] = '';

          }
        } else {
          $import_data['cat_id'] = '';
        }

                    // end

                    // sub-category
        if ($sheetData[$i][2] != '') {
          $sheetData[$i][2] = $sheetData[$i][2];
          $sub_cat_id = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id FROM subcategory WHERE status='Active' AND LOWER(sub_cat_name)=LOWER('" . addslashes($sheetData[$i][1]) . "') AND cat_id ='" . $import_data['cat_id'] . "'"))['id'];

          if ($sub_cat_id) {
            $import_data['subcat_id'] = $sub_cat_id;
          } else {
            $import_data['subcat_id'] = '';

          }
        } else {
          $import_data['subcat_id'] = '';
        }
                    // end
        if($class[0]==16)
        {
          $p_uniqu = uniqid();
          
          if ($sheetData[$i][5] != '') {
            $data=stripslashes($sheetData[$i][5]);
            $product_details = json_decode($data,true);
          }
          if($product_details['min'] == ""){
            $product_details['min'] = 1;
          }
    /// If Discount Is NULL
          if($product_details['discount']==""){
            $product_details['discount'] =  0;
          }
  // echo $product_details['in_stock'];
          $mySqlQuery = "INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`brand`,`class1`, `price`,`discount`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`in_stock`,`minimum`,`maximum`,`class0`,`product_code`,`group_code`,`date`,`time`) VALUES "
          . "('".$import_data['cat_id']."','".$import_data['subcat_id']."','".addslashes($import_data['product_name'])."','".addslashes($sheetData[$i][3])."','','".$product_details['price']."','".$product_details['discount']."','".$product_details['hot_deals']."','".$product_details['new_arrivals']."','".$product_details['top']."','".$product_details['cod']."','".$product_details['stock']."','".$product_details['in_stock']."','".$product_details['min']."','".$product_details['max']."','','".$p_uniqu."','".$groupCode."','$date','$time')";

  // echo $mySqlQuery;
          $query=mysqli_query($conn,$mySqlQuery)or die(mysqli_error());


          $sel_query=mysqli_query($conn,"SELECT MAX(id) as id FROM `products`");
          if(mysqli_num_rows($sel_query)>0)
          {
            $vaar= mysqli_fetch_assoc($sel_query);
            $lastProductID=$vaar['id'];

        /// Update Stock Record ///
            $dquery=mysqli_query($conn,"INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`,`created_time`) VALUES ('$lastProductID','".$product_details['in_stock']."','Credit','$date','$time')")or die(mysqli_error());
        /// Update Stock Record ///
        //description
    // echo "INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$lastProductID','".htmlentities($sheetData[$i][4])."')";
            $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$lastProductID','".addslashes($sheetData[$i][4])."')")or die(mysqli_error());

            foreach(explode(',',$product_details['image']) as $value)
            {
              $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$p_uniqu','$value')")or die(mysqli_error());

              
            }


            $final_result = true;
            $Msg = "Products Added successfully";
          } else {
            $final_result = false;
            $Msg = "Error in Adding Products";
          }
        }
        
        else if(count($class)==1 && $class[0]!=16)
        {
          if ($sheetData[$i][5] != '') {
           $data=stripslashes($sheetData[$i][5]);
           $product_details = json_decode($data,true);
         }
         if($class[0]==1 || $class[0]==2 || $class[0]==3 || $class[0]==4 || $class[0]==5 || $class[0]==6)
         {
          

          foreach($product_details as $pro){
            $p_uniqu = uniqid();

            $classQuery="SELECT name FROM classtype WHERE id=".$class[0];
            $className=mysqli_fetch_assoc(mysqli_query($conn,$classQuery))['name'];
            $sizeQuery= "SELECT id FROM size_class WHERE status='Active' AND LOWER(symbol)=LOWER('".$pro[strtolower($className)]."')";
    // $new='No'; $hot='No'; $top='No'; $cod='No';
            $sizeResult=mysqli_query($conn,$sizeQuery);
            $sizeId = mysqli_fetch_assoc($sizeResult)['id'];
            $color="";


            if($pro['min'] == ""){
              $pro['min'] = 1;
            }
    /// If Discount Is NULL
            if($pro['discount']==""){
              $pro['discount'] =  0;
            }
  // echo $product_details['in_stock'];
            $mySqlQuery = "INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`brand`,`class1`, `price`,`discount`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`in_stock`,`minimum`,`maximum`,`class0`,`product_code`,`group_code`,`date`,`time`) VALUES "
            . "('".$import_data['cat_id']."','".$import_data['subcat_id']."','".addslashes($import_data['product_name'])."','".addslashes($sheetData[$i][3])."','".$color."','".$pro['price']."','".$pro['discount']."','".$pro['hot_deals']."','".$pro['new_arrivals']."','".$pro['top']."','".$pro['cod']."','".$pro['stock']."','".$pro['in_stock']."','".$pro['min']."','".$pro['max']."','".$sizeId."','".$p_uniqu."','".$groupCode."','$date','$time')";

            $query=mysqli_query($conn,$mySqlQuery)or die(mysqli_error());


            $sel_query=mysqli_query($conn,"SELECT MAX(id) as id FROM `products`");
            if(mysqli_num_rows($sel_query)>0)
            {
              $vaar= mysqli_fetch_assoc($sel_query);
              $lastProductID=$vaar['id'];

        /// Update Stock Record ///
              $dquery=mysqli_query($conn,"INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`,`created_time`) VALUES ('$lastProductID','".$pro['in_stock']."','Credit','$date','$time')")or die(mysqli_error());
        /// Update Stock Record ///
        //description
    // echo "INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$lastProductID','".htmlentities($sheetData[$i][4])."')";
              $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$lastProductID','".addslashes($sheetData[$i][4])."')")or die(mysqli_error());

              foreach(explode(',',$pro['image']) as $value)
              {
                $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$p_uniqu','$value')")or die(mysqli_error());

                
              }
              $final_result = true;
              $Msg = "Products Added successfully";
            } else {
              $final_result = false;
              $Msg = "Error in Adding Products";
            }
          }

        }
        else
        {
          foreach($product_details['class'] as $pro){
           $p_uniqu = uniqid();

           $classQuery="SELECT name FROM classtype WHERE id=".$class[0];
           $className=mysqli_fetch_assoc(mysqli_query($conn,$classQuery))['name'];
           $sizeQuery= "SELECT id FROM size_class WHERE status='Active' AND LOWER(symbol)=LOWER('".$pro[strtolower($className)]."')";
    // $new='No'; $hot='No'; $top='No'; $cod='No';
           $sizeResult=mysqli_query($conn,$sizeQuery);
           $sizeId = mysqli_fetch_assoc($sizeResult)['id'];

           $color="";


           if($pro['min'] == ""){
            $pro['min'] = 1;
          }
    /// If Discount Is NULL
          if($pro['discount']==""){
            $pro['discount'] =  0;
          }
  // echo $product_details['in_stock'];
          $mySqlQuery = "INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`brand`,`class1`, `price`,`discount`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`in_stock`,`minimum`,`maximum`,`class0`,`product_code`,`group_code`,`date`,`time`) VALUES "
          . "('".$import_data['cat_id']."','".$import_data['subcat_id']."','".addslashes($import_data['product_name'])."','".addslashes($sheetData[$i][3])."','".$color."','".$pro['price']."','".$pro['discount']."','".$pro['hot_deals']."','".$pro['new_arrivals']."','".$pro['top']."','".$pro['cod']."','".$pro['stock']."','".$pro['in_stock']."','".$pro['min']."','".$pro['max']."','".$sizeId."','".$p_uniqu."','".$groupCode."','$date','$time')";

 // echo $mySqlQuery;
          $query=mysqli_query($conn,$mySqlQuery)or die(mysqli_error());


          $sel_query=mysqli_query($conn,"SELECT MAX(id) as id FROM `products`");
          if(mysqli_num_rows($sel_query)>0)
          {
            $vaar= mysqli_fetch_assoc($sel_query);
            $lastProductID=$vaar['id'];

        /// Update Stock Record ///
            $dquery=mysqli_query($conn,"INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`,`created_time`) VALUES ('$lastProductID','".$pro['in_stock']."','Credit','$date','$time')")or die(mysqli_error());
        /// Update Stock Record ///
        //description
    // echo "INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$lastProductID','".htmlentities($sheetData[$i][4])."')";
            $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$lastProductID','".addslashes($sheetData[$i][4])."')")or die(mysqli_error());

            foreach(explode(',',$product_details['image']) as $value)
            {
              $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$p_uniqu','$value')")or die(mysqli_error());

              
            }
            $final_result = true;
            $Msg = "Products Added successfully";
          } else {
            $final_result = false;
            $Msg = "Error in Adding Products";
          }
        }  
      }
    }
    else if(count($class)==2)
    {
      if ($sheetData[$i][5] != '') {
       $data=stripslashes($sheetData[$i][5]);
       $product_details = json_decode($data,true);
     }
     foreach($product_details as $pro){

       $p_uniqu = uniqid();
       $classQuery2="SELECT name FROM classtype WHERE id=".$class[0];
       $classResult2=mysqli_query($conn,$classQuery2);
       $className2=mysqli_fetch_assoc($classResult2)['name'];
       $colorQuery= "SELECT name FROM size_class WHERE status='Active' AND LOWER(symbol)=LOWER('".$pro[strtolower($className2)]."')";
    // $new='No'; $hot='No'; $top='No'; $cod='No';
       $colorResult=mysqli_query($conn,$colorQuery);
       $color = mysqli_fetch_assoc($colorResult)['name'];


       foreach ($pro['class'] as $value) {
         
        
        $classQuery1="SELECT name FROM classtype WHERE id=".$class[1];
        $className1=mysqli_fetch_assoc(mysqli_query($conn,$classQuery1))['name'];

        $sizeQuery1= "SELECT id FROM size_class WHERE status='Active' AND LOWER(symbol)=LOWER('".$value[strtolower($className1)]."')";
    // $new='No'; $hot='No'; $top='No'; $cod='No';
        $sizeResult=mysqli_query($conn,$sizeQuery1);
        $sizeId = mysqli_fetch_assoc($sizeResult)['id'];
        
    // $className=mysqli_fetch_assoc(mysqli_query($conn,"SELECT name form classtype WHERE id=$class[0]"))['name'];
        
        


        if($value['min'] == ""){
          $value['min'] = 1;
        }
    /// If Discount Is NULL
        if($value['discount']==""){
          $value['discount'] =  0;
        }
  // echo $product_details['in_stock'];
        $mySqlQuery = "INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`brand`,`class1`, `price`,`discount`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`in_stock`,`minimum`,`maximum`,`class0`,`product_code`,`group_code`,`date`,`time`) VALUES "
        . "('".$import_data['cat_id']."','".$import_data['subcat_id']."','".addslashes($import_data['product_name'])."','".addslashes($sheetData[$i][3])."','".$color."','".$value['price']."','".$value['discount']."','".$value['hot_deals']."','".$value['new_arrivals']."','".$value['top']."','".$value['cod']."','".$value['stock']."','".$value['in_stock']."','".$value['min']."','".$value['max']."','".$sizeId."','".$p_uniqu."','".$groupCode."','$date','$time')";

        $query=mysqli_query($conn,$mySqlQuery)or die(mysqli_error());


        $sel_query=mysqli_query($conn,"SELECT MAX(id) as id FROM `products`");
        if(mysqli_num_rows($sel_query)>0)
        {
          $vaar= mysqli_fetch_assoc($sel_query);
          $lastProductID=$vaar['id'];

        /// Update Stock Record ///
          $dquery=mysqli_query($conn,"INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`,`created_time`) VALUES ('$lastProductID','".$value['in_stock']."','Credit','$date','$time')")or die(mysqli_error());
        /// Update Stock Record ///
        //description
          $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$lastProductID','".addslashes($sheetData[$i][4])."')")or die(mysqli_error());

          foreach(explode(',',$pro['image']) as $value1)
          {
            $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$p_uniqu','$value1')")or die(mysqli_error());

            
          }
          $final_result = true;
          $Msg = "Products Added successfully";
        } else {
          $final_result = false;
          $Msg = "Error in Adding Products";
        }
      }
    }  
  }  
  
  else if(count($class)==3)
  {

    if ($sheetData[$i][5] != '') {
     $data=stripslashes($sheetData[$i][5]);
     $product_details = json_decode($data,true);
   }
   foreach($product_details as $pro){

    $p_uniqu = uniqid();

    foreach ($pro['class1'] as $value) {


     foreach ($value['class'] as $value1) {

      $classQuery="SELECT name FROM classtype WHERE id=".$class[0];
      $className=mysqli_fetch_assoc(mysqli_query($conn,$classQuery))['name'];
      $colorQuery= "SELECT name FROM size_class WHERE status='Active' AND LOWER(symbol)=LOWER('".$pro[strtolower($className)]."')";
    // $new='No'; $hot='No'; $top='No'; $cod='No';
      $colorResult=mysqli_query($conn,$colorQuery);
      $color = mysqli_fetch_assoc($colorResult)['name'];
      
      $classQuery1="SELECT name FROM classtype WHERE id=".$class[1];
      $className1=mysqli_fetch_assoc(mysqli_query($conn,$classQuery1))['name'];

      $sizeQuery= "SELECT id FROM size_class WHERE status='Active' AND LOWER(symbol)=LOWER('".$value[strtolower($className1)]."')";
    // $new='No'; $hot='No'; $top='No'; $cod='No';
      $sizeResult=mysqli_query($conn,$sizeQuery);
      $sizeId = mysqli_fetch_assoc($sizeResult)['id'];
      
      $classQuery2="SELECT name FROM classtype WHERE id=".$class[2];
      $className2=mysqli_fetch_assoc(mysqli_query($conn,$classQuery2))['name'];

      $sizeQuery2= "SELECT id FROM size_class WHERE status='Active' AND LOWER(symbol)=LOWER('".$value1[strtolower($className2)]."')";
    // $new='No'; $hot='No'; $top='No'; $cod='No';
      $sizeResult2=mysqli_query($conn,$sizeQuery2);
      $class2 = mysqli_fetch_assoc($sizeResult2)['id'];
      
      


      if($value1['min'] == ""){
        $value1['min'] = 1;
      }
    /// If Discount Is NULL
      if($value1['discount']==""){
        $value1['discount'] =  0;
      }
  // echo $product_details['in_stock'];
      $mySqlQuery = "INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`brand`,`class1`, `price`,`discount`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`in_stock`,`minimum`,`maximum`,`class0`,`class2`,`product_code`,`group_code`,`date`,`time`) VALUES "
      . "('".$import_data['cat_id']."','".$import_data['subcat_id']."','".addslashes($import_data['product_name'])."','".addslashes($sheetData[$i][3])."','".$color."','".$value1['price']."','".$value1['discount']."','".$value1['hot_deals']."','".$value1['new_arrivals']."','".$value1['top']."','".$value1['cod']."','".$value1['stock']."','".$value1['in_stock']."','".$value1['min']."','".$value1['max']."','".$sizeId."','".$class2."','".$p_uniqu."','".$groupCode."','$date','$time')";

      $query=mysqli_query($conn,$mySqlQuery)or die(mysqli_error());


      $sel_query=mysqli_query($conn,"SELECT MAX(id) as id FROM `products`");
      if(mysqli_num_rows($sel_query)>0)
      {
        $vaar= mysqli_fetch_assoc($sel_query);
        $lastProductID=$vaar['id'];

        /// Update Stock Record ///
        $dquery=mysqli_query($conn,"INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`,`created_time`) VALUES ('$lastProductID','".$value1['in_stock']."','Credit','$date','$time')")or die(mysqli_error());
        /// Update Stock Record ///
        //description
    // echo "INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$lastProductID','".htmlentities($sheetData[$i][4])."')";
        $dquery=mysqli_query($conn,"INSERT INTO `description`(`cat_id`, `subcat_id`, `p_id`, `description`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$lastProductID','".addslashes($sheetData[$i][4])."')")or die(mysqli_error());

        foreach(explode(',',$pro['image']) as $image)
        {
          $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('".$import_data['cat_id']."','".$import_data['subcat_id']."','$p_uniqu','$image')")or die(mysqli_error());

          
        }
        $final_result = true;
        $Msg = "Products Added successfully";
      } else {
        $final_result = false;
        $Msg = "Error in Adding Products";
      }
    }
  }  
}
}
}
} else {
  $final_result = false;
  $Msg = "Please enter atleast one product!";
}
} else {
  $final_result = false;
  $Msg = "Excel sheet is empty!";
}
if ($final_result) {
  echo json_encode(['status' => 1]);
  mysqli_commit($conn);
} else {
  echo json_encode(['status' => 0, 'msg' => $Msg]);
  mysqli_rollback($conn);
}

}

}
