

<?php

require('../config/connection.php');


    date_default_timezone_set("Asia/kolkata");
    $date=date("Y-m-d");
    $time=date("H:i:s");
    $new='No'; $hot='No'; $top='No'; $cod='No';
    
    $category=$_POST['category'];
    $subcategory='';
    if(isset($_POST['subcategory']))
    {
        $subcategory=$_POST['subcategory'];
    }


    $w = 0;
        foreach($_POST['productSizes'] as $size)
        {

            if(isset($_POST['new']))
            { $new=$_POST['new']; }
            if(isset($_POST['hot']))
            { $hot=$_POST['hot']; }
            if(isset($_POST['top']))
            { $top=$_POST['top']; }
            if(isset($_POST['cod']))
            { $cod=$_POST['cod']; }
            if(empty($_POST['disc_price'][$w])) {
                $disc_price = '0';
            } else {
                $disc_price = $_POST['disc_price'][$w];
            }
            //insert query

$query="SELECT status FROM `products` where group_code='".$_POST['groupCode']."'";

$productStatusQ=mysqli_query($conn,$query);
            $productStatus= mysqli_fetch_assoc($productStatusQ);
        
            if($productStatus['status']=='temp')
            {
                $query="UPDATE products
                SET cat_id = '$category',
                subcat_id= '$subcategory',
                product_name= '".$_POST['product']."',
                color_name= '".$_POST['productColor']."',
                price= '".$_POST['price'][$w]."',
                discount= '".$disc_price."',
                hot_deals= '$hot',
                new_arrivals= '$new',
                top= '$top',
                cod= '$cod',
                stock= '".$_POST['stock']."',
                product_code= '".$_POST['productCode']."',
                group_code= '".$_POST['groupCode']."',
                date= '$date',
                time= '$time',
                status= 'Active'
                WHERE group_code = '".$_POST['groupCode']."';";

// print_r($query);exit();
                
$query=mysqli_query($conn,$query)or die(mysqli_error());


            }else{
                $query=mysqli_query($conn,"INSERT INTO `products`(`cat_id`, `subcat_id`, `product_name`,`color_name`, `price`,`discount`,`hot_deals`,`new_arrivals`,`top`,`cod`,`stock`,`product_code`,`group_code`,`date`,`time`) VALUES "
                . "('$category','$subcategory','".$_POST['product']."','".$_POST['productColor']."',
                '".$_POST['price'][$w]."','".$disc_price."','$hot','$new','$top','$cod',
                '".$_POST['stock']."','".$_POST['productCode']."','".$_POST['groupCode']."',
                '$date','$time')")or die(mysqli_error());
            }
          
$w++;
        
                }
        //images
        $image_name=($_FILES["image"]["name"]);  
        $image_type=($_FILES["image"]["tmp_name"]);  
        $i=0;
        foreach ($image_name as $key => $value)
        {
            $sn = $i++;
            $mul_img=$_FILES["image"]["tmp_name"][$sn];
            move_uploaded_file($mul_img,"../asset/image/product/".$value);
            $test = getimagesize('../asset/image/product/'.$value);
            $width = $test[0];
            $height = $test[1];
            $iquery=mysqli_query($conn,"INSERT INTO `image`(`cat_id`, `sub_cat_id`,`p_id`, `image`) VALUES ('$category','$subcategory',''".$_POST['productCode']."'','$value')")or die(mysqli_error());
        }

        echo '<div id="snackbar">Product Added Sucessfully...</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo"var delay = 1000;setTimeout(function(){ window.location = 'view-all-products.php'; }, delay);";
        echo "</script>";
    ?>