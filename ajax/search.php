<?php

require('../config.php');
unset($_SESSION['filter']);

$sid = mysqli_real_escape_string($con, $_GET['sid']);

$svar = "%" . $sid . "%";
$catCount = false;
$subcat_count = false;
$productCount = false ;

$catnamequery = mysqli_query($con, "SELECT c.* FROM category c, products p where c.cat_name LIKE '".$svar."' AND c.status ='Active' AND c.trash = 'No' AND p.status = 'Active' AND p.trash='No' AND p.cat_id = c.id GROUP BY c.id");

$mysrcnt = mysqli_num_rows($catnamequery);


    echo '<div class="autocomplete notfndp">';

    while ($catnamequeryD = mysqli_fetch_array($catnamequery)) {
        $catCount = true;
        echo  "<a href='listing.php?" . $homePage->generateToken(40) . "=" . $homePage->generateToken(40) . "&id=cat_id@" . $catnamequeryD['id'] . "&" . $homePage->generateToken(40) . "=" . $homePage->generateToken(40) . "'><div>" . $catnamequeryD['cat_name'];

        echo "</div></a>";
    }


    $scnamequery = mysqli_query($con, "SELECT s.* FROM subcategory s, products p where s.sub_cat_name LIKE '$svar' AND s.status = 'Active' AND s.trash = 'No' AND s.id = p.subcat_id GROUP BY s.id");
    while ($scnamedata = mysqli_fetch_array($scnamequery)) {
        $subcat_count = true;
        // $catquery = mysqli_query($con, "SELECT * FROM `category` where id='" . $scnamedata['cat_id'] . "'");
        $catquery = mysqli_query($con, "SELECT * FROM `category` WHERE id='" . $scnamedata['cat_id'] . "' AND status='active'");

        echo  "<a href='listing.php?" . $homePage->generateToken(40) . "=" . $homePage->generateToken(40) . "&id=subcat_id@" . $scnamedata['id'] . "&" . $homePage->generateToken(40) . "=" . $homePage->generateToken(40) . "'><div>" . $scnamedata['sub_cat_name'];

        if (mysqli_num_rows($catquery) > 0) {
            $catdata = mysqli_fetch_array($catquery);
            echo "<span>in " . $catdata['cat_name'] . "</span></div></a>";
        } else {
            echo "</div></a>";
        }
    }
    // $productnamequery = mysqli_query($con, "SELECT * FROM `products` where product_name LIKE '$svar' AND status = 'Active' AND trash = 'No' GROUP BY product_name");
    $productnamequery = mysqli_query($con, "SELECT p.* FROM `products` p
    JOIN `category` c ON p.cat_id = c.id
    WHERE p.product_name LIKE '$svar'
    AND p.status = 'Active'
    AND p.trash = 'No'
    AND c.status = 'Active'
    AND c.trash = 'No'
    GROUP BY p.product_name");

    while ($productnamedata = mysqli_fetch_array($productnamequery)) {
        $productCount = true;
        $scnamequery = mysqli_query($con, "SELECT * FROM `subcategory` where id='" . $productnamedata['subcat_id'] . "' AND status = 'Active' AND trash = 'No'");
        $catnamequery = mysqli_query($con, "SELECT * FROM `category` where id='" . $productnamedata['cat_id'] . "' AND status = 'Active' AND trash = 'No' ");

        echo  "<a href='product-detail.php?" . $homePage->generateToken(40) . "=" . $homePage->generateToken(40) . "&product_id=" . $productnamedata['id'] . "&" . $homePage->generateToken(40) . "=" . $homePage->generateToken(40) . "'><div>" . $productnamedata['product_name'];
        if (mysqli_num_rows($scnamequery) > 0) {
            $scnamedata = mysqli_fetch_array($scnamequery);
            echo "<span>in " . $scnamedata['sub_cat_name'] . "</span></div></a>";
        } else if (mysqli_num_rows($catnamequery) > 0) {
            $catnamedata = mysqli_fetch_array($catnamequery);
            echo "<span>in " . $catnamedata['cat_name'] . "</span></div></a>";
        } else {
            echo "</div></a>";
        }
    }

    // echo "</div>";

    if(!$catCount && !$subcat_count && !$productCount){
        echo "<img src='assets/img/no-product-found.png'>";

    }


