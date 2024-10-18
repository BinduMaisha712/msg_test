<?php
// Turn on error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

// Start or resume session
// session_start();

// Include necessary files
include('header.php');

// Initialize or reset session variables
$_SESSION['brand'] = null;
$_SESSION['weight'] = null;

// Check if 'id' parameter is set in URL
if (isset($_GET['id'])) {
    // Unset pagination limits if necessary
    unset($_SESSION['limitFrom']);
    unset($_SESSION['limitTo']);

    // Extract category and listing ID from URL
    $productDetail = explode("@", $_GET['id']);
    $categoryType = $productDetail[0];
    $listingId = $productDetail[1];

    // Initialize array for class types
    $classtype_id = array();

    // Construct condition based on category and listing ID
    $condition = "p." . $categoryType . "='" . $listingId . "'";

    // Fetch max price based on category type
    $maxPrice = $listing->getMax($categoryType, $listingId);

    // Fetch 'issubcategory' status from database
    if ($categoryType == 'cat_id') {
        $issubcategory = mysqli_fetch_assoc(mysqli_query($con, "SELECT c.issubcategory FROM category c WHERE c.id=" . $listingId . " AND c.status='active'"))['issubcategory'] ?? null;
    } else {
        $issubcategory = mysqli_fetch_assoc(mysqli_query($con, "SELECT c.issubcategory FROM category c WHERE c.id=(SELECT cat_id FROM subcategory WHERE id=$listingId) AND c.status='active'"))['issubcategory'] ?? null;
    }

    // Process based on 'issubcategory' status
    if ($issubcategory == 'Yes') {
        if ($categoryType == 'cat_id') {
            $query = "SELECT classtype_id FROM subcategory WHERE cat_id=" . $listingId;
            $result = $homePage->getDataArray($query);

            foreach ($result as $r) {
                $class4 = json_decode($r['classtype_id']);
                foreach ($class4 as $v4) {
                    if (!in_array($v4, $classtype_id))
                        $classtype_id[] = $v4;
                }
            }
        } else {
            $classtype_id = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM subcategory WHERE id=" . $listingId))['classtype_id']);
        }
    } elseif ($issubcategory == 'No') {
        $classtype_id = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM category WHERE id=" . $listingId . " AND status='active'"))['classtype_id']);
    }

    // Check if session filters need to be reset or retained
    if (isset($_SESSION['fill']['filter']['cat']) && isset($_SESSION['fill']['class'])) {
        if ($categoryType == 'cat_id') {
            foreach ($_SESSION['fill']['filter']['cat'] as $key1 => $class) {
                if (false !== strrpos($class, 'p.cat_id')) {
                    $cat = explode('p.cat_id=', $class)[1];
                    if (("'" . $listingId . "'") != $cat) {
                        unset($_SESSION['fill']);
                    } else {
                        $_SESSION['filter']['checked'] = $_SESSION['fill']['filter'];
                        $_SESSION['filter']['max'] = $_SESSION['fill']['max'];
                        $_SESSION['filter']['min'] = $_SESSION['fill']['min'];
                    }
                }
            }
        } else {
            foreach ($_SESSION['fill']['filter']['cat'] as $key1 => $class) {
                if (false !== strrpos($class, 'p.subcat_id')) {
                    $subcat = explode('p.subcat_id=', $class)[1];
                    if (("'" . $listingId . "'") != $subcat) {
                        unset($_SESSION['fill']);
                    } else {
                        $_SESSION['filter']['checked'] = $_SESSION['fill']['filter'];
                        $_SESSION['filter']['max'] = $_SESSION['fill']['max'];
                        $_SESSION['filter']['min'] = $_SESSION['fill']['min'];
                    }
                }
            }
        }
    }

    // Check and manage session filters and class types
    if (isset($_SESSION['filter']['checked']['cat']) && isset($_SESSION['classtype_id'])) {
        if ($categoryType == 'cat_id') {
            foreach ($_SESSION['filter']['checked']['cat'] as $key1 => $class) {
                if (false !== strrpos($class, 'p.cat_id')) {
                    $cat = explode('p.cat_id=', $class)[1];
                    if (("'" . $listingId . "'") != $cat) {
                        // Unset unnecessary session variables
                        unset($_SESSION['filter']['checked']['cat'][$key1]);
                        unset($_SESSION['filter']['checked']['class0']);
                        unset($_SESSION['filter']['checked']['class1']);
                        unset($_SESSION['filter']['checked']['class2']);
                        unset($_SESSION['filter']['checked']['discount']);
                        unset($_SESSION['filter']['max']);
                        unset($_SESSION['filter']['min']);
                        foreach ($classtype_id as $v) {
                            if (isset($_SESSION['classtype_id'])) {
                                foreach ($_SESSION['classtype_id'] as $k => $v1) {
                                    if ($v == $v1)
                                        unset($_SESSION['classtype_id']);
                                }
                            }
                        }
                    } else {
                        if (isset($_SESSION['fill'])) {
                            $_SESSION['filter']['checked'] = $_SESSION['fill']['filter'];
                        }
                    }
                }
            }
        } else {
            foreach ($_SESSION['filter']['checked']['cat'] as $key1 => $class) {
                if (false !== strrpos($class, 'p.subcat_id')) {
                    $subcat = explode('p.subcat_id=', $class)[1];
                    if (("'" . $listingId . "'") != $subcat) {
                        unset($_SESSION['filter']['checked']['cat'][$key1]);
                        unset($_SESSION['filter']['checked']['class0']);
                        unset($_SESSION['filter']['checked']['class1']);
                        unset($_SESSION['filter']['checked']['class2']);
                        unset($_SESSION['filter']['max']);
                        unset($_SESSION['filter']['min']);
                        foreach ($classtype_id as $v) {
                            if (isset($_SESSION['classtype_id'])) {
                                foreach ($_SESSION['classtype_id'] as $k => $v1) {
                                    if ($v == $v1)
                                        unset($_SESSION['classtype_id']);
                                }
                            }
                        }
                    } else {
                        if (isset($_SESSION['fill'])) {
                            $_SESSION['filter']['checked'] = $_SESSION['fill']['filter'];
                            $_SESSION['filter']['min'] = $_SESSION['fill']['min'];
                            $_SESSION['filter']['max'] = $_SESSION['fill']['max'];
                        }
                    }
                }
            }
        }
        unset($_SESSION['fill']);
    }

    // Check and update session class types
    if (isset($_SESSION['classtype_id'])) {
        $_SESSION['classtype_id'] = (array)$_SESSION['classtype_id'];
        foreach ($classtype_id as $value) {
            if (!in_array($value, $_SESSION['classtype_id'])) {
                $_SESSION['classtype_id'][] = $value;
            }
        }
    } else {
        $_SESSION['classtype_id'] = $classtype_id;
    }

    // Check and update session filters
    if (isset($_SESSION['filter']['checked']['cat'])) {
        if (!in_array($condition, $_SESSION['filter']['checked']['cat'])) {
            $_SESSION['filter']['checked']['cat'][] = $condition;
        }
    } else {
        $_SESSION['filter']['checked']['cat'][] = $condition;
    }

} else {
    // Handle default or fallback behavior if 'id' parameter is not set
    $categoryType = "";

    // Check if necessary session variables are set or fallback to previous filters
    if ((!isset($_SESSION['filter']['checked'])) || (!isset($_SESSION['classtype_id']))) {
        $_SESSION['filter']['checked'] = $_SESSION['fill']['filter'];
        $_SESSION['filter']['min'] = $_SESSION['fill']['min'] ?? 1;
        $_SESSION['filter']['max'] = $_SESSION['fill']['max'] ?? 1000000000000;
        $_SESSION['classtype_id'] = $_SESSION['fill']['class'] ?? '';
        // unset($_SESSION['fill']);
    }
}
?>

<style>
    li,
    a {
        font-family: 'Syne';
    }
      ul.subcat_list {
            display: none;
        }
    
        ul.subcat_list.show-subcategories {
            display: block;
        }
        .disinline{
            display:inline !important;
        }
        .mb--8{
            margin-bottom:8px;
        }
        .toggle-subcategories{
        float: right;
        background: none !important;
        font-size: 20px !important;
        margin-top: -5px;
        cursor: pointer;
        }
        .subcat_list{
            padding:5px 0 0 18px;
        }
        .priceatr{
            font-size: 13px;
            font-weight: 400;
            margin: 0;
        }
ul#pagination-blocks {
    display: flex;
    border: 1px solid #c50f13;
}

ul#pagination-blocks li {
    padding: 5px 10px;
    color: white ;
    background: #c50f13;
    border-right: 1px solid #ddd;
}
.shikam{
        padding: 5px 10px;
    font-weight: 500;
    font-size: 13px;
    border-radius: 6px;

}
.activact,.macactive{
    background:#fc9135 !important;
    color:#000 !important;
}
.inner__lenth input {
    width: 120px;
    border: 1px solid gray;
    padding: 0 9px;
    border-radius: 7px;
    background-color: transparent;
}
.inner__lenth {
    display: flex;
    flex-direction: column;
}
.min_max {
    display: flex;
    align-items: center;
    gap: 20px;
    justify-content: space-between;
    margin-bottom: 17px;
    background-color: #f2f4f7;
    padding: 12px 12px;
    border-radius: 10px;
}
.sp-product-item {
    height: 380px;
}
</style>

<!-- Main Start -->
<main class="main">
    <div class="breadcrumb-area breadcrumb-bg-two">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active"><a href="javascript:;">Products</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shop Top Filter Section Start -->
    <section class="shop--area mt-4 pb-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row">
                        <div class="col-lg-3">
                            <aside class="shop-sidebar">
                                <div class="sidebar-overlay"></div>
                                <a class="sidebar-close" href="#"><i class="fa fa-close"></i></a>
                                <div class="sidebar-content">
                                    <div class="sticky-sidebar" data-sticky-options="{'top': 10}">

                                        <?php
                                        $allProducts = $listing->filterProducts();
                                        $products = $allProducts;
                                        ?>

                                        <div class="shop-cat-list widget shop-widget">
                                            <div class="shop-widget-title">
                                                <h6 class="title">All Categories</h6>
                                            </div>
<ul class="widget-body filter-items search-ul">
    <?php
    // Show categories in filter sidebar
    foreach ($homePage->categories('all') as $category) {
        $disabled = ""; // Fetch New Products Category First "arg=$condition" Second "arg=Limit"
        
        $issubcategory = mysqli_fetch_assoc(mysqli_query($con, "SELECT c.issubcategory FROM category c WHERE c.id = " . $category['id'] . " AND c.status = 'active'"))['issubcategory'];

        if ($issubcategory == 'Yes') {
            $fetchSubcat = mysqli_query($con, "SELECT s.* FROM subcategory s, products p WHERE s.trash = 'No' AND s.status = 'Active' AND p.subcat_id = s.id AND s.cat_id = " . $category['id'] . " group by s.id");
            $classtype_id1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM subcategory WHERE cat_id=" . $category['id']))['classtype_id']);
        } elseif ($issubcategory == 'No') {
            $classtype_id1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM category WHERE id=" . $category['id'] . " AND status='active'"))['classtype_id']);
        }
        $classtype2 = implode(", ", $classtype_id1);

        // Check if the current category or subcategory is active based on the URL parameter
        $isActiveCategory = ($_GET['id'] == 'cat_id@'.$category['id']);
        $isActiveSubcat = false;
        $activeSubcatId = null;

        // Check if any subcategory is active
        if ($issubcategory == 'Yes') {
            while ($subcat = mysqli_fetch_assoc($fetchSubcat)) {
                if ($_GET['id'] == 'subcat_id@'.$subcat['id']) {
                    $isActiveSubcat = true;
                    $activeSubcatId = $subcat['id'];
                    break;
                }
            }
            // Reset the fetchSubcat pointer to use it again in the HTML part
            mysqli_data_seek($fetchSubcat, 0);
        }
    ?>
        <li class="arrowlist curreny-wrap <?= ($isActiveCategory) ? 'active' : ''; ?>">
            <a class="disinline" <?= $disabled; ?> href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&id=cat_id@<?= $category['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>" style="<?= ($isActiveCategory) ? 'color:red !important;' : ''; ?>">
                <?= $category['cat_name']; ?>
            </a>
            <?php if ($issubcategory == 'Yes') { ?>
                <span class="toggle-subcategories">+</span>
                <ul class="subcat_list dropdown-list curreny-list <?= ($isActiveSubcat) ? 'show-subcategories' : ''; ?>">
                    <?php while ($subcat = mysqli_fetch_assoc($fetchSubcat)) {
                        $isActiveSubcat = ($activeSubcatId == $subcat['id']);
                    ?>
                        <li class="mb--5">
                            <a <?= $disabled; ?> href="listing.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&id=subcat_id@<?= $subcat['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>" style="<?= $isActiveSubcat ? 'color:red !important;' : ''; ?>">
                                <?= $subcat['sub_cat_name']; ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            <?php } ?>
        </li>
    <?php
    }
    ?>
</ul>



                                        </div>
                                        
                                        <div class="filterSlider widget shop-widget">
                                            <div id="refreshSlider">
                                                <?php
// Show sizes in filter sidebar
$ids = array();
$ids = $_SESSION['filter']['checked']['cat'] ?? array(); // Ensure the 'cat' index exists in the session
$brands = $homePage->brands($ids); // Fetch the brands based on the selected categories

if (!empty($brands)) { ?>
    <div class="sidebar-border">
        <div class="widget widget-collapsible">
            <div class="shop-widget-title">
                <h6 class="title">BRANDS</h6>
            </div>
            <div>
                <ul class="brand-menu filter-items">
                    <?php
                    foreach ($brands as $brand) {
                        $brandName = $brand['brand'];
                        $isChecked = false;
                        $checkedBrands = $_SESSION['filter']['checked']['brand'] ?? array(); // Ensure the 'brand' index exists in the session

                        if (!empty($checkedBrands) && in_array("p.brand='" . $brandName . "'", $checkedBrands)) {
                            $isChecked = true;
                        }
                    ?>
                        <li>
                            <input type="checkbox" 
                                   catType="<?= $categoryType; ?>" 
                                   listingId="<?= $listingId; ?>" 
                                   class="filterCheckbox" 
                                   name="filterBrand<?= $brandName; ?>" 
                                   value="p.brand='<?= $brandName; ?>'" 
                                   onchange="checkboxFilter(this, 'brand', <?= $listingId; ?>);" 
                                   <?= $isChecked ? 'checked' : ''; ?>>&nbsp;
                            <?= $brandName; ?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
<?php }
?>
<?php
// Loop through each selected category in the session filter
foreach ($_SESSION['filter']['checked']['cat'] as $catId) {
    $productDetail = explode("=", $catId);
    $categoryId = $productDetail[1];
    $categoryType1 = $productDetail[0];
    $classtype_id2 = array();

    if ($categoryType1 == 'p.cat_id') {
        $issubcategory1 = mysqli_fetch_assoc(mysqli_query($con, "SELECT c.issubcategory FROM category c WHERE c.id = '$categoryId' AND c.status = 'active'"))['issubcategory'];

        if ($issubcategory1 == 'Yes') {
            $query = "SELECT classtype_id FROM subcategory WHERE cat_id=" . $categoryId;
            $result = $homePage->getDataArray($query);

            foreach ($result as $r) {
                $class4 = json_decode($r['classtype_id']);
                foreach ($class4 as $v4) {
                    if (!in_array($v4, $classtype_id2))
                        $classtype_id2[] = $v4;
                }
            }
        } elseif ($issubcategory1 == 'No') {
            $classtype_id2 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM category WHERE id = '$categoryId' AND status = 'active'"))['classtype_id']);
        }
    } else {
        $classtype_id2 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM subcategory WHERE id=" . $categoryId))['classtype_id']);
    }

    foreach ($classtype_id2 as $val) {
        foreach ($_SESSION['classtype_id'] as $class) {
            if ($class != 16 && $val == $class) {
                $classtypeNameQuery1 = mysqli_fetch_assoc(mysqli_query($con, "SELECT name FROM classtype WHERE id=$class"))['name'];
?>

                <!--Widget Brand Start-->
                <div class="sidebar-border mt-4">
                    <div class="widget shop-widget">
                        <?php if ($homePage->sizes1($class, $categoryType, $listingId)) { ?>
                            <div class="shop-widget-title">
                                <h6 class="title"><?= strtoupper($classtypeNameQuery1); ?></h6>
                            </div>
                        <?php } ?>

                        <div class="">
                            <ul class="brand-menu filter-items clatype" id="<?= strtolower($classtypeNameQuery1); ?>_ul">
                                <?php
                                // Show sizes in filter sidebar
                                foreach ($homePage->sizes1($class, $categoryType, $listingId) as $size) {
                                    $c = count($classtype_id2);
                                    if ($c == 3) {
                                        $type = 'class0';
                                        if ($classtype_id2[2] == $size['classtype_id'])
                                            $type = 'class2';
                                        $id = $size['id'];
                                        if ($size['classtype_id'] == $classtype_id2[0]) {
                                            $type = 'class1';
                                            $id = $size['symbol'];
                                        }
                                    } else if ($c == 2) {
                                        $type = 'class0';
                                        $id = $size['id'];
                                        if ($size['classtype_id'] == $classtype_id2[0]) {
                                            $type = 'class1';
                                            $id = $size['symbol'];
                                        }
                                    } else if ($c == 1 && $classtype_id2[0] != 16) {
                                        $id = $size['id'];
                                        $type = 'class0';
                                    }

                                    if ($size['classtype_id'] == $class) {
                                        $sizeingram = $size['symbol'];

                                        if (strtolower($classtypeNameQuery1) == 'weight') {
                                            if (strpos($size['symbol'], "GRAM") !== false) {
                                                $sizeingram = trim(explode("GRAM", $size['symbol'])[0]);
                                            }
                                            if (strpos($size['symbol'], "gram") !== false) {
                                                $sizeingram = trim(explode("gram", $size['symbol'])[0]);
                                            }
                                            if (strpos($size['symbol'], "G") !== false) {
                                                $sizeingram = trim(explode("G", $size['symbol'])[0]);
                                            }
                                            if (strpos($size['symbol'], "g") !== false) {
                                                $sizeingram = trim(explode("g", $size['symbol'])[0]);
                                            }
                                            if (strpos($size['symbol'], "kg") !== false) {
                                                $sizeingram = trim(explode("kg", $size['symbol'])[0]);
                                                if ($sizeingram !== '')
                                                    $sizeingram = $sizeingram * 1000;
                                                else
                                                    $sizeingram = 1000;
                                            }
                                            if (strpos($size['symbol'], "KG") !== false) {
                                                $sizeingram = trim(explode("KG", $size['symbol'])[0]);
                                                if ($sizeingram !== '')
                                                    $sizeingram = $sizeingram * 1000;
                                                else
                                                    $sizeingram = 1000;
                                            }
                                            if (strpos($size['symbol'], "Kg") !== false) {
                                                $sizeingram = trim(explode("Kg", $size['symbol'])[0]);
                                                if ($sizeingram !== '')
                                                    $sizeingram = $sizeingram * 1000;
                                                else
                                                    $sizeingram = 1000;
                                            }
                                            if (strpos($size['symbol'], "kG") !== false) {
                                                $sizeingram = trim(explode("kG", $size['symbol'])[0]);
                                                if ($sizeingram !== '')
                                                    $sizeingram = $sizeingram * 1000;
                                                else
                                                    $sizeingram = 1000;
                                            }
                                            if (strpos($size['symbol'], "kilogram") !== false) {
                                                $sizeingram = trim(explode("kilogram", $size['symbol'])[0]);
                                                if ($sizeingram !== '')
                                                    $sizeingram = $sizeingram * 1000;
                                                else
                                                    $sizeingram = 1000;
                                            }
                                            if (strpos($size['symbol'], "KILOGRAM") !== false) {
                                                $sizeingram = trim(explode("KILOGRAM", $size['symbol'])[0]);
                                                if ($sizeingram !== '')
                                                    $sizeingram = $sizeingram * 1000;
                                                else
                                                    $sizeingram = 1000;
                                            }
                                        }
                                        // Fetch New Products Category First "arg=$condition" Second "arg=Limit"
                                        if (array_key_exists($type, $_SESSION['filter']['checked'])) {
                                            if (!empty($_SESSION['filter']['checked'][$type])) {
                                                if (in_array("p." . $type . "='" . $id . "'", $_SESSION['filter']['checked'][$type])) {
                                ?>
                                                    <li><input type="checkbox" class="filterCheckbox" catType="<?= $categoryType; ?>" listingId="<?= $listingId ?>" sizegram="<?= $sizeingram; ?>" name="filterSize<?= $size['id']; ?>" value="p.<?= $type ?>='<?= $id ?>'" onchange="checkboxFilter(this,'<?= $type; ?>','<?= $class ?>');" checked>&nbsp; <?= $size['symbol']; ?> </li>
                                                <?php
                                                } else {
                                                ?>
                                                    <li><input type="checkbox" class="filterCheckbox" catType="<?= $categoryType; ?>" listingId="<?= $listingId ?>" sizegram="<?= $sizeingram; ?>" name="filterSize<?= $size['id']; ?>" value="p.<?= $type ?>='<?= $id; ?>'" onchange="checkboxFilter(this,'<?= $type; ?>',<?= $class ?>);">&nbsp;
                                                        <?= $size['symbol']; ?> </li>
                                                <?php
                                                }
                                            } else {
                                                ?>
                                                <li><input type="checkbox" class="filterCheckbox" catType="<?= $categoryType; ?>" listingId="<?= $listingId ?>" sizegram="<?= $sizeingram; ?>" name="filterSize<?= $size['id']; ?>" value="p.<?= $type ?>='<?= $id; ?>'" onchange="checkboxFilter(this,'<?= $type; ?>','<?= $class ?>');">&nbsp;
                                                    <?= $size['symbol']; ?> </li>
                                            <?php
                                            }
                                        } else {
                                            ?>

                                            <li><input type="checkbox" class="filterCheckbox" catType="<?= $categoryType; ?>" listingId="<?= $listingId ?>" sizegram="<?= $sizeingram; ?>" name="filterSize<?= $size['id']; ?>" value="p.<?= $type; ?>='<?= $id; ?>'" onchange="checkboxFilter(this,'<?= $type; ?>','<?= $class ?>');">&nbsp;
                                                <?= $size['symbol']; ?> </li>

                                <?php
                                        }
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </div>
<?php
            }
        }
    }
}
?>
<!--Widget Brand End-->
<!--Widget Manufacture Start-->

<?php
foreach ($_SESSION['filter']['checked']['cat'] as $c) {
    $catId = $c;
    $productDetail = explode("=", $catId);
    $categoryId = $productDetail[1];
    $categoryType1 = $productDetail[0];
}
$ratingFilter = $homePage->ratingFilter($categoryId, $categoryType1);
if ($ratingFilter[0]['max_rating'] != 0) {
?>

    
<?php
}
?>

                                        <div class="sidebar-border widget widget-collapsible">
                                            <div class="shop-widget-title">
                                                <h6 class="title">Discount</h6>
                                            </div>
                                            <div class="">
                                                <ul class="brand-menu filter-items</a>">
                                                    <li><input type="checkbox" class="filterCheckbox" name="filterDiscount<?= $product['id']; ?>" value="p.price!=p.discount " onchange="checkboxFilter(this,'discount', <?= $listingId ?>);" <?php echo (isset($_SESSION['filter']['checked']['discount']) && count($_SESSION['filter']['checked']['discount']))?'checked':''; ?>>&nbsp;Discounted Products</li>
                                                </ul>
                                            </div>
                                        </div>
                                        
                                        <!-- Price Slider -->
                                        <div class="sidebar-border widget widget-collapsible mt-4">
                                            <div class="shop-widget-title">
                                                <h6 class="title">Price Filter</h6>
                                            </div>
                                            <?php
                                                $minvalue=$listing->getMin($categoryType, $listingId);
                                                $maxvalue=$listing->getMax($categoryType, $listingId);
                                                // echo $minvalue." | ".$maxvalue;
                                            ?>
                                                <form action="javascript:void(0);" onsubmit="getVals();">
                                                    <input type="hidden" value="<?= $listingId ?>" name="listingId">
                                                    <input type='hidden' value="<?= $categoryType; ?>" id="category_type">
                                                   <div class="range-slider ">
                                                  <div class="min_max">
                                                      <div  class="inner__lenth">
                                                          <label>Min: <?= $minvalue ?></label>
                                                          <input class="input-min" type="number" value="<?= $minvalue ?>" min="<?= $minvalue ?>" max="<?= $maxvalue ?>" step="1" >
                                                             </div>
                                                             <div class="inner__lenth">
                                                              <label>Max: <?= $maxvalue ?></label>
                                                              <input class="input-max" type="number" value="<?= $maxvalue ?>" min="<?= $minvalue ?>" max="<?= $maxvalue ?>" step="1" >
                                                            </div>
                                                          
                                                  </div>
                                                    <button type="submit" class="btn hny_add shikam">Submit</button>
                                                  </div>
                                                  </form>
                                        </div>

                                    </div>
                                    
                                </div>
                            </aside>
                        </div>
                        <div class="col-lg-9">
                            <div class="shop-discount-area">
                                <div class="discount-content shop-discount-content">
                                    <span>healthy food</span>
                                    <h4 class="title"><a href="jvascript:;">Organic farm for MSG</a></h4>
                                </div>
                            </div>
                            <div class="shop-product">
                                <div class="top-header-wrap">
                                    <div class="row align-items-center">
                                        <div class="col-md-6 col-4 hny_disppy">
                                            <div class="listing-filter">
                                                <a href="javascript:;"><i class="fa fa-filter"></i> Filter</a>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-4">
                                            <div class="shop-top-left">
                                                <ul id="listing-stats">
                                                    <li>
                                                        <p>Showing <span id="recordFrom"><?= $listing->recordFrom(); ?></span>–<span id="recordTo"><?= $listing->recordTo(); ?></span> Of <span id="totalProducts"><?= $listing->totalProducts(); ?></span> Results</p>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-4">
                                            <div class="select-options shop-top-right">
                                                <div class="select-menu top-filter">
                                                    <form action="#">
                                                        <div class="toolbar-select">
                                                            <!-- Show Sort by dropdown-->
                                                            <select name="orderby" class="form-control order-by srb-dis p-2 ms-2" id="short" onchange="orderBy(this.value);" tabindex="1">
                                                                <option selected="" value="">Sort By (no filter)</option>
                                                                <option value="and p.top='Yes'" <?php echo (isset($_SESSION['filter']['orderBy']) && $_SESSION['filter']['orderBy'] == "and p.top='Yes'")?'selected=""':''; ?>>Sort by popularity</option>
                                                                <option value="and p.new_arrivals='Yes'" <?php echo (isset($_SESSION['filter']['orderBy']) && $_SESSION['filter']['orderBy'] == "and p.new_arrivals='Yes'")?'selected=""':''; ?>>Sort by newness</option>
                                                                <option value="ASC" <?php echo (isset($_SESSION['filter']['orderBy']) && $_SESSION['filter']['orderBy'] == "ASC")?'selected=""':''; ?>>Sort by price: low to high</option>
                                                                <option value="DESC" <?php echo (isset($_SESSION['filter']['orderBy']) && $_SESSION['filter']['orderBy'] == "DESC")?'selected=""':''; ?>>Sort by price: high to low</option>
                                                            </select>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="shop-products-wrap changeFilter">
                                    <div class="row justify-content-left" id="filterProductId">
                                        
                                        <?php
                                        // print_r($_SESSION);
                                        $allProducts = $listing->filterProducts();
                                        $products = $allProducts;
                                        if (empty($products)) { ?>
                                            <div class="col-md-12 col-12">
                                                <div class='pt-5' style='background-color:#f5f9ff; align-items: center; width:100%; height:350px;'>
                                                    <img class='rounded mx-auto my-auto d-block' src='asset/image/img.png' style='height:60%' alt=''>
                                                    <h1 class='h1 text-center'>We Coudn't find any matches!</h1>
                                                </div>
                                            </div>

                                            <?php } else {

                                            // if (isset($_SESSION['filter']['orderBy']) && ($_SESSION['filter']['orderBy'] != "")) {
                                                // if(isset($_SESSION['filter']['filter_by']) && $_SESSION['filter']['filter_by'] == 'price'){
                                                //     $priceLimit = $_SESSION['filter']['orderBy'];
                                                //     $products = $listing->getProductsInPriceRange($allProducts, $priceLimit);
                                                // }
                                                // if ((explode(' ', $_SESSION['filter']['orderBy'])[0]) != 'and') {
                                                //     $orderby = explode(' ', $_SESSION['filter']['orderBy'])[0];
                                                //     $products = $listing->getOrderByProducts($products, $orderby);
                                                // }
                                            // }
                                            
                                            $max_actual_price = 0;
                                            $min_actual_price = 0;
                                            if(isset($products[0]['actualPrice'])){
                                                $min_actual_price = $products[0]['actualPrice'];
                                            }
                                            
                                            //echo count($products)." | all: ".count($allProducts);
                                            $productCount = count($products);
                                            
                                            foreach($products as $product) {
                                                
                                                $max_actual_price = $max_actual_price < $product['actualPrice']? $product['actualPrice']: $max_actual_price;
                                                $min_actual_price = $min_actual_price > $product['actualPrice']? $product['actualPrice']: $min_actual_price;
                                                // $issubcategory = mysqli_fetch_assoc(mysqli_query($con, "SELECT c.issubcategory FROM category c  WHERE c.id=" . $product['cat_id']))['issubcategory'];
                                                $issubcategory = mysqli_fetch_assoc(mysqli_query($con, "SELECT c.issubcategory FROM category c WHERE c.id = " . $product['cat_id'] . " AND c.status = 'active'"))['issubcategory'];

                                                if ($issubcategory == 'Yes' && $product['subcat_id'] != '') {
                                                    $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM subcategory WHERE id=" . $product['subcat_id']))['classtype_id']);
                                                } else {
                                                    // $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM category WHERE id=" . $product['cat_id']))['classtype_id']);
                                                    $query1 = json_decode(mysqli_fetch_assoc(mysqli_query($con, "SELECT classtype_id FROM category WHERE id=" . $product['cat_id'] . " AND status='active'"))['classtype_id']);

                                                }
                                                $classtypeName = array();
                                                $primaryClassName = "";
                                                $classtype1 = implode(", ", $query1);
                                                // echo $classtype1;
                                                // echo "SELECT id,name FROM classtype WHERE id IN($classtype1) GROUP BY id";
                                                $classtypeNameQuery = mysqli_query($con, "SELECT id,name FROM classtype WHERE id IN($classtype1) GROUP BY id");
                                                while ($row = mysqli_fetch_array($classtypeNameQuery)) {
                                                    $classtypeName[] = array('id' => $row['id'], 'name' => $row['name']);
                                                    $classtypeId12[] = $row['id'];
                                                }

                                                if ((count($query1)) == 3) {
                                                    $k1 = array();
                                                    foreach ($classtypeName as $k => $value) {

                                                        if ($query1[0] != $value['id']) {
                                                            $k1[] = $k;
                                                        }
                                                    }
                                                    $primaryClassName = ucfirst($classtypeName[$k1[0]]['name']) . '+' . ucfirst($classtypeName[$k1[1]]['name']);

                                                    // $class="'".$query1[1]."','".$query1[2].",";
                                                } elseif (count($query1) == 2) {
                                                    $primaryClassName = ucfirst($classtypeName[0]['name']);
                                                    if ($query1[0] == $classtypeName[0]['id']) {
                                                        $primaryClassName = ucfirst($classtypeName[1]['name']);
                                                    }
                                                } elseif (count($query1) == 1 && $query1[0] != 16) {
                                                    $primaryClassName = ucfirst($classtypeName[0]['name']);
                                                }
                                                $randamValue = rand();
                                            ?>
                                                <div class="col-xl-3 col-md-4 col-6">
                                                    <div class="sp-product-item">
                                                        <div class="sp-product-thumb">
                                                            <?php
                                                            if (isset($product['price']) && isset($product['discount']) && $product['discount'] < $product['price']) {
                                                                $price = $product['price'];
                                                                $discountedPrice = $product['discount'];

                                                                $off = $homePage->calculateDiscountPercentage($price, $discountedPrice);
                                                            ?>
                                                                <span class="batch" id="modelPer<?= $randamValue . $product['id'] ?>"><?= $off; ?>%</span>
                                                            <?php } ?>
                                                            <a href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $product['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>">
                                                                <?php
                                                                $image = $homePage->image('product', $product['product_code']);
                                                                if (empty($image)) {
                                                                ?>
                                                                    <img src="asset/image/placeholder.png" class="img-fluid bg-img" onerror="this.onerror=null;this.src='<?= $ImgSrcError ?? '' ?>';">
                                                                <?php } else { ?>
                                                                    <img src="assets/img/medal.png" class="ansh-medal-detail">
                                                                    <img src="asset/image/product/<?= $image[0]['image']; ?>" class="img-fluid bg-img" onerror="this.onerror=null;this.src='<?= $ImgSrcError ?? '' ?>';">
                                                                <?php } ?>

                                                        </div>
                                                        <div class="sp-product-content">
                                                            <div class="rating d-flex justify-content-between">
                                                                <span><?= number_format($product['avg_rating'], 1); ?> <i class="fas fa-star"></i> </span>
                                                                <?php $catId = $product['cat_id'];
                                                                /*$catName = mysqli_fetch_assoc(mysqli_query($con, "SELECT cat_name FROM category WHERE id = '$catId'"))['cat_name']; */
                                                                $catName = mysqli_fetch_assoc(mysqli_query($con, "SELECT cat_name FROM category WHERE id = '$catId' AND status = 'active'"))['cat_name'];

                                                                ?>
                                                                <span><?= $catName; ?></span>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-9 col-10 wish_ans"><h6 class="title"><a href="product-detail.php?<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>&product_id=<?= $product['id']; ?>&<?= $homePage->generateToken(40); ?>=<?= $homePage->generateToken(40); ?>"><?= $product['product_name']; ?></a></h6>
                                                      </div>
                                                               
                                                                <div class="col-lg-5 col-md-6 col-6 msg_card" >
                                                 <div id="new_<?= $product['id'] ?>">
                                                     <form class="addItemToCartModel" id="addCart_<?php echo $randamValue . $product['id']; ?>" method="post" action="javascript:void(null)">
                      <input type="hidden" id="modelProductId<?php echo $randamValue . $product['id']; ?>" name="productId" value="<?php echo $product['id']; ?>" />
                      <input type="hidden" id="currentPageId<?php echo $randamValue . $product['id']; ?>" name="currentPage" value="<?php echo $currentPage; ?>">
                      <input type="hidden" id="addCartButtonDivId<?php echo $randamValue . $product['id']; ?>" name="divId" value="addToCart<?php echo $randamValue . $product['id']; ?>">

                    </form>
                      <?php
                      if ($product['stock'] == 'Yes') {

                        if ($cart->productExistInCart($product['pid'])) { ?>
                          <a href="cart.php" ><i class="fa-solid fa-cart-shopping" style="color: #c50f13;"></i></a>

                        <?php } else { ?>

                          <a href="javascript:void(0)"  onclick="addToCart('addCart_<?= $randamValue . $product['id'] ?>','<?= $primaryClassName ?>');"><i class="fa-solid fa-cart-shopping" style="color: #c50f13;"></i></a>

                        <?php }
                      }  ?>
                      </div>
                                                 <!--<a><i class="fa-solid fa-cart-shopping" style="color: #c50f13;"></i></a>-->
                                                 <div class="mywishlistdiv addToWishList<?= $randamValue . $product['id'] ?>">
                                                     <div id="newWish_<?= $product['id'] ?>">
                                                        <?php if (!$wishList->productExistInWishList($product['id'])) { ?>
                                                            <span class="ans-wish"><a href="javascript:;" onclick="addToWishList(<?= $product['id']; ?>,this.id,'<?= $url; ?>')" id="addToWishList<?= $randamValue . $product['id'] ?>"><i class="fa-regular fa-heart"></i></a></span>
                                                        <?php } else { ?>
                                                            <span class="ans-wish"><a onclick="removeFromWishList(<?= $product['id']; ?>,this.id,'<?= $url; ?>')" id="addToWishList<?= $randamValue . $product['id'] ?>" href="javascript:;"><i class="fa fa-heart" aria-hidden="true" style="background-color: white;padding: 8px;color: red;border-radius: 17px;               border: 1px solid #e0e0e0;font-size: 16px;"></i></a></span>
                                                        <?php } ?>
                                                     </div>
                                                 </div>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="price" style="display: flex;justify-content: space-between;">
                                                                <h5 class="price">
                                                                    <span class="theme-color">
                                                                    <?php
                                                                        $isdeal = $homePage->isDealByProduct($product['id']);
                                                                        if (!empty($isdeal)) {
                                                                            if ($isdeal[0]['stock'] != 0) {
                                                                        ?>
                                                                                <span class="price-new"><?= $currency; ?><?= $isdeal[0]['price']; ?></span>
                                                                                <span class="price-old"> <del>
                                                                                        <?= $currency; ?><?= $product['price']; ?></span>
                                                                                <?php } else {
                                                                                if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { ?>
                                                                                    <span class="price-new"><?= $currency; ?><?= $product['price']; ?></span>
                                                                                <?php } else { ?>
                                                                                    <span class="price-new"><?= $currency; ?><?= $product['discount']; ?></span>
                                                                                    <span class="price-old"> <del>
                                                                                            <?= $currency; ?><?= $product['price']; ?></span>
                                                                                <?php }
                                                                            }
                                                                        } else {
                                                                            if (($product['price'] == $product['discount']) || ($product['discount'] == 0)) { ?>
                                                                                <span class="price-new"><?= $currency; ?><?= $product['price']; ?></span>
                                                                            <?php } else { ?>
                                                                                <span class="price-new"><?= $currency; ?><?= $product['discount']; ?></span>
                                                                                <span class="price-old"> <del>
                                                                                        <?= $currency; ?><?= $product['price']; ?></span>
                                                                        <?php }
                                                                        } ?>

                                                                </h5>
                                                                <!--<div class="rating-mob">  <span class="wish-list d-block d-lg-none"><a href="javascript:;"><i class="fa-regular fa-heart"></i></a></span></div>-->
                                                               
                                                                <form class="addItemToCartModel" id="addCart_<?= $randamValue . $product['id'] ?>" method="post" action="javascript:void(null)">

                                            <input type="hidden" name="productId" value="<?php echo $product['id'];?>" />
                                            <input type="hidden" name="currentPage" value="<?= $currentPage; ?>">
                                            <input type="hidden" name="divId" value="addToCart<?= $randamValue . $product['id'] ?>" />
                                            <input type="hidden" name="productSize" value="<?php echo $product['id'];?>">
                                            
                                            <div class="button-left">
                                
                                                <?php
                                                // check product has stock
                                                if ($product['stock'] == 'Yes') {
                                                    //check product is exist in cart
                                                    if ($cart->productExistInCart($product['id'])) { ?>
                                                    
                                                <a class="btn hny_add buy_direct" href="checkout.php"><span class="text">Buy
                                                    Now</span></a>
                       
                                                <?php } else { ?>

                                                <a class="btn hny_add buy_direct" href="javascript:void(0);"
                                                    onclick="addToCart('addCart_<?= $randamValue . $product['id'] ?>','<?= $primaryClassName ?>' , 'buy_direct');"><span class="text">Buy
                                                    Now</span></a>

                                                <?php  }
                                                } else { ?>

                                                <a class="btn hny_add" href="javascript:void(0);"><span class="text">Out Of
                                                    Stock</span></a>
                                                <?php } ?>
                                                
                                                
                                                <!--End Cart Button-->
                                            </div>
                                            
                                            </form>
                                                            </div>
                                                           
                                                        </div>
                                                    </div>
                                                </div>

                                        <?php }
                                        } ?>
                                        <input type="hidden" id="maxPrice" value="<?php echo $max_actual_price; ?>">
                                        <input type="hidden" id="minPrice" value="<?php echo $min_actual_price; ?>">

                                    </div>
                                
                                </div>
                                    <?php if ($productCount >= 12) { ?>
                                        <div align="center">
                                            <button type="button" id="viewMorelistbtn" class="btn btn-success" style="padding: 7px 15px;">View More...</button>
                                        </div>
                                    <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Top Filter Section End -->
</main>
<!-- Main End -->
<?php include('include/footer.php') ?>

  <script>
        $(document).ready(function () {
            $('.toggle-subcategories').on('click', function () {
                var subcatList = $(this).next('ul.subcat_list');
                subcatList.toggleClass('show-subcategories');
                
                $(this).text(function (_, text) {
                    return text === '+' ? '-' : '+';
                });
            });
        });
        
        
    </script>
    
<script>
   var limit = 12;
   var offset = 12;
    // Store listingId in localStorage
    var listingId = "<?php echo $listingId; ?>";
    localStorage.setItem("listingId", listingId);
    
    function loadMoreProducts() {
        // Retrieve listingId from localStorage
        var listingId = localStorage.getItem("listingId");
        console.log(listingId);
        console.log(offset);
        console.log(limit);
        console.log('ghfgh');
        
        $.ajax({
            url: 'ajax/load-listing-products.php',
            type: 'GET',
            data: { 
                limit: limit,
                offset: offset,
                listingId: listingId,
                filter: '<?php echo (isset($_GET['filter_type'])) ? ($_GET["filter_type"]) : (''); ?>'
            },
            success: function(response) {
                console.log(response);
                if (response.trim() !== '') {
                    $('#filterProductId').append(response);
                    offset += limit; 
                    if(offset < parseInt($("#totalProducts").text())){
                        $("#recordTo").html(offset);
                    }else{
                        $("#recordTo").html($("#totalProducts").text());
                    }

                } else {
                    $('#viewMorelistbtn').hide();
                }
            },
        });
    }

    $(document).ready(function() {
        $('#viewMorelistbtn').click(function(event) {
            event.preventDefault();
            loadMoreProducts();
        });

    });
</script>


