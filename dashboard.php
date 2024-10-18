<?php include 'header.php';
unset($_SESSION["checkf_data"]);
//check is logged in
if (!USER::isLoggedIn()) { ?>
    <script type="text/javascript">
        window.location.href = "index.php";
    </script>
<?php }
$dashboard = new Dashboard($con);
$userInfo = $dashboard->getUserDetail();

// $userInfo = $dashboard->getData('countries','country_code,country_name');
// echo '<pre>';
// print_r($userInfo);:
// exit();
$loginid = $_SESSION['loginid'];
?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" />
<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<link href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="assets/select2/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="assets/css/dashboard.css">

<style>
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #ced4da;
        border-radius: 4px;
        font-size: 14px;
        font-weight: 400;
        line-height: 1.5;
        color: #4b4c4c;
        height: 45px;
        display: block;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 45px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 45px;
    }

    .select2-container {
        box-sizing: border-box;
        display: inline-block;
        margin: 0 0 8px;
        position: relative;
        display: block;
    }

    span.select2-results ul li {
        width: 100%;
    }

    .col-lg-3.tab-box .nav {
        flex-direction: column !important;
    }

    .create-acc {
        background-color: #f7f7f7;
        border-top: 3px solid #ed3237;
        font-size: 15px;
        padding: 13px 18px;
        position: relative;
        text-transform: capitalize;
        margin-bottom: 15px;
        border-radius: 5px;
        margin-top: 0px;
    }

    .table-responsive {
        padding: 5px 10px !important;
    }

    ul.list {
        height: auto;
        max-height: 300px;
        overflow-y: scroll !important;
    }
    .trckbtn{
    font-size: 11px !important;
    padding: 5px 12px !important;
    }

</style>

<main class="page-content">
    <!-- breadcrumb-area -->
    <div class="breadcrumb-area breadcrumb-bg-two mb-4">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->
    <!-- Begin FB's Account Page Area -->
    <div class="account-page-area">
        <div class="container">
            <div class="mydashboarddiv">
                <div class="row">
                    <div class="col-lg-3 tab-box">
                        <ul class="myaccount-tab-menu nav" id="account-page-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link clickmedash active" data-id="#account-dashboard" data-toggle="tab" href="javascript:void(0);" role="tab" aria-controls="account-dashboard" aria-selected="true"><i class="fas fa-chart-line"></i> &nbsp; Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link clickmedash" data-id="#account-profile" data-toggle="tab" href="javascript:void(0);" role="tab" aria-controls="account-profile" aria-selected="false"><i class="fa fa-user"></i> &nbsp; Edit Profile</a>
                            </li>
                            <li class="nav-item" id="my_order_tab_li">
                                <a id="my_order_tab" class="nav-link clickmedash" data-id="#account-orders" data-toggle="tab" href="javascript:void(0);" role="tab" aria-controls="account-orders" aria-selected="false"><i class="fa fa-cart-arrow-down"></i> &nbsp; Orders</a>
                            </li>
                            <!-- <li class="nav-item">
                                <a class="nav-link clickmedash" data-id="#account-wishlist" data-toggle="tab" href="javascript:void(0);" role="tab" aria-controls="account-wishlist" aria-selected="false">
                                    <i class="fa fa-heart"></i> &nbsp; My Favorites</a>
                            </li> -->
                            <li class="nav-item">
                                <a class="nav-link clickmedash" data-id="#account-address" data-toggle="tab" href="javascript:void(0);" role="tab" aria-controls="account-address" aria-selected="false"><i class="fa fa-map-marker"></i> &nbsp; Address
                                    Book</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link clickmedash" data-id="#account-details" data-toggle="tab" href="javascript:void(0);" role="tab" aria-controls="account-details" aria-selected="false"><i class="fa fa-lock"></i> &nbsp; Change Password</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="account-logout-tab" href="logout.php" role="tab" aria-selected="false"><i class="fas fa-sign-out-alt"></i> &nbsp; Logout</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-9">
                        <div class="tab-content myaccount-tab-content" id="account-page-tab-content">
                            <div class="tab-pane active" id="account-dashboard" role="tabpanel" aria-labelledby="account-dashboard-tab">
                                <div class="myaccount-dashboard">
                                    <h4 class="create-acc"><i class="fas fa-chart-line"></i> &nbsp; Dashboard</h4>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card_pro">
                                                        <div class="card-body flex-column text-center  d-flex justify-content-around align-items-center">
                                                            <img src="assets/img/profile-img.jpg" class="img-responsive" style="width: 184px;border-radius: 50%;">

                                                            <div class="user-info">
                                                                <h4 class="mb-1"> <?= $userInfo['firstname'] . " " . $userInfo['lastname']; ?></h4>
                                                                <p class="mb-1"><?= $userInfo['email']; ?><br>
                                                                    <?= $userInfo['mobile']; ?><br></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="row">
                                                <div class="col-md-6 mb-4">
                                                    <div class="card text-center">
                                                        <div class="card-header ">My Profile</div>
                                                        <div class="card-body">
                                                            <h5 class="card-title"><i class="fa fa-user"></i></h5>
                                                            <a id="editProfileButton" class="btn btn-primary btn-rounded clickmedash" data-id="#account-profile" data-toggle="tab" role="tab" aria-controls="account-profile" aria-selected="false">View</a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-4">
                                                    <div class="card text-center">
                                                        <div class="card-header">
                                                            My Orders
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title"><i class="fa fa-cart-arrow-down"></i></h5>
                                                            <a id="myOrderButton" class="btn btn-primary btn-rounded clickmedash" data-id="#account-orders" data-toggle="tab" role="tab" aria-controls="account-orders" aria-selected="false">View</a>

                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 mb-4">
                                                    <div class="card text-center">
                                                        <div class="card-header">
                                                            Change Password
                                                        </div>
                                                        <div class="card-body">
                                                            <h5 class="card-title"><i class="fa fa-unlock-alt"></i></h5>
                                                            <a id="changePasswordButton" class="btn btn-primary btn-rounded clickmedash" data-id="#account-details" data-toggle="tab" aria-controls="account-details" aria-selected="false">Change</a>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="account-profile" role="tabpanel" aria-labelledby="account-profile-tab">
                                <div class="myaccount-profile">
                                    <h4 class="create-acc"><i class="fa fa-user"></i> &nbsp; Edit Profile</h4>
                                    <form action="" method="POST" id="edit_profile_form" class="formSubmit">
                                        <input type="hidden" name="editProfile" value="editProfile">
                                        <input type="hidden" name="userId" value="<?= $_SESSION['loginid']; ?>">
                                        <div class="fb-form-inner">

                                            <div class="row">

                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-firstname">First Name</label>
                                                        <input type="text" name="firstName" value="<?= $userInfo['firstname']; ?>" class="form-control" placeholder="Enter Your First Name" required>
                                                        <div class="err_msg" id="firstNameErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-lastname">Last Name</label>
                                                        <input type="text" name="lastName" value="<?= $userInfo['lastname']; ?>" class="form-control" placeholder="Enter Your Last Name" required>
                                                        <div class="err_msg" id="lastNameErrMsg"></div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-gender">Gender</label>
                                                        <select class="form-control" name="gender" id="gender">
                                                            <option value="">Please Select gender</option>
                                                            <option value="Male" <?= ($userInfo['gender'] == 'Male') ? 'selected' : ''; ?>>
                                                                Male </option>
                                                            <option value="Female" <?= ($userInfo['gender'] == 'Female') ? 'selected' : ''; ?>>
                                                                Female </option>
                                                        </select>
                                                        <div class="err_msg" id="genderErrMsg"></div>
                                                    </div>
                                                </div>


                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-email">Email</label>
                                                        <input type="text" name="emailId" value="<?= $userInfo['email']; ?>" class="form-control" placeholder="Enter Your Email Address" disabled="">
                                                        <div class="err_msg" id="emailIdErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-mobile">Contact No</label>
                                                        <input type="text" name="mobileNumber" value="<?= $userInfo['mobile']; ?>" class="form-control" placeholder="Enter Your Contact No." disabled>
                                                        <div class="err_msg" id="mobileNumberErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-adressType">Address Type</label>
                                                        <select class="form-control" name="addressType" id="addressType">
                                                            <option value="">Please Select Type</option>
                                                            <option value="Home" <?= ($userInfo['addr_type'] == 'Home') ? 'selected' : ''; ?>>
                                                                Home</option>
                                                            <option value="Office" <?= ($userInfo['addr_type'] == 'Office') ? 'selected' : ''; ?>>
                                                                Office</option>
                                                            <option value="Other" <?= ($userInfo['addr_type'] == 'Other') ? 'selected' : ''; ?>>
                                                                Other</option>

                                                        </select>
                                                        <div class="err_msg" id="addressTypeErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-firstname">Street address</label>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <input type="text" name="addressFlat" placeholder="House number and Flat number" value="<?= $userInfo['flat']; ?>" class="form-control">
                                                                <div class="err_msg" id="addressFlatErrMsg"></div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <input type="text" name="addressStreet" placeholder="Street,Apartment etc" value="<?= $userInfo['street']; ?>" class="form-control">
                                                                <div class="err_msg" id="addressStreetErrMsg"></div>
                                                            </div>
                                                            <div class="col-md-12 mt-3">
                                                                <input type="text" name="addressLocality" placeholder="Locality, unit etc. (optional)" value="<?= $userInfo['locality']; ?>" class="form-control">
                                                                <div class="err_msg" id="addressLocalityErrMsg"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <select class="form-control" name="addressCountry" id="addressCountry" onchange="getStates(this.value);">
                                                        <option value="99">India</option>
                                                    </select>
                                                    <div class="err_msg" id="addressCountryErrMsg"></div>
                                                </div>

                                                <div class="col-md-6">
                                                    <select class="form-control" name="addressState" id="addressState">
                                                        <option value="">Please Select State</option>

                                                        <?php $getStates = mysqli_query($con, "SELECT * FROM state_list");
                                                        while ($state = mysqli_fetch_assoc($getStates)) { ?>
                                                            <option value="<?= $state['id']; ?>" <?= ($userInfo['state'] == $state['id']) ? 'selected' : ''; ?>>
                                                                <?= $state['state']; ?></option>
                                                        <?php   }

                                                        ?>
                                                    </select>
                                                    <div class="err_msg" id="addressStateErrMsg"></div>

                                                </div>

                                                <div class="col-md-8">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-address">Town / City
                                                            <span>*</span></label>
                                                        <input name="addressCity" class="form-control" placeholder="Please enter City Name" type="text" value="<?= $userInfo['city']; ?>">
                                                        <div class="err_msg" id="addressCityErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="single-input single-input-half">
                                                        <label for="account-details-zipCode">Zip Code
                                                            <span>*</span></label>
                                                        <input name="addressZipCode" class="form-control" type="text" value="<?= $userInfo['zipcode']; ?>" placeholder="Enter zip code">
                                                        <div class="err_msg" id="addressZipCodeErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 text-left single-input mt-2">
                                                    <div class="text-center" id="edit_profile_formMsg"></div>
                                                    <button type="submit" class="cart-checkout-btn btn btn-primary btn-rounded"><span>SAVE
                                                            CHANGES</span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane" id="account-orders" role="tabpanel" aria-labelledby="account-orders-tab">
                                <div class="myaccount-orders">
                                    <h4 class="create-acc"><i class="fa fa-cart-arrow-down"></i> &nbsp; My Orders</h4>
                                    <div class="table-responsive">
                                        <table id="example" class="display nowrap" cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Order ID</th>
                                                    <th>Payment Mode</th>
                                                    <th>Order Total</th>
                                                    <th>Shipping Charge</th>
                                                    <th>Order Date</th>
                                                    <!-- <th>Invoice</th> -->
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sqql = mysqli_query($con, "SELECT * FROM `order_tbl` WHERE ((`payment_type`='Online' && `payment_status`='Success') or ( `payment_type`='Cash On Delivery')) AND userid='$loginid' order by id desc");

                                                while ($row = mysqli_fetch_assoc($sqql)) {
                                                    $or = mysqli_query($con, "select * from order_status where user_id='$loginid' and order_id='" . $row['order_id'] . "'  order by id DESC");

                                                    $var_or = mysqli_fetch_assoc($or);
                                                    if ($row['payment_status'] == 'Success') {
                                                        $sta = "( <small><b><font color='green'>Success</font></b></small> )";
                                                    } elseif ($row['payment_status'] == 'Cancel') {
                                                        $sta = "( <small><b><font color='red'>Cancelled</font></b></small> )";
                                                    } else {
                                                        $sta = "( <small><b id='payment_status_" . $row['order_id'] . "'>" . $row['payment_status'] . "</b></small> )";
                                                    }
                                                ?>
                                                    <tr data-child-value="<?= $row['id']; ?>">
                                                        <td class="details-control"></td>
                                                        <td><?= $row['order_id']; ?>
                                                        </td>

                                                        <td><?php if ($row['payment_type'] == 'Online') {
                                                                echo "Online Payment" . $sta;
                                                            } else {
                                                                echo "Cash On Delivery " . $sta;
                                                            } ?>
                                                        </td>
                                                        <td><?= $currency; ?> <span data-id="<?= $row['orderprice']; ?>" id="totalPrice_<?= $var_or['order_id']; ?>"><?= number_format($row['orderprice'], 2); ?></span>
                                                        </td>
                                                        <td><?= $currency; ?> 100</td>
                                                        <td><?php echo date('d-m-Y', strtotime($row['date'])); ?></td>
                                                    </tr>

                                                <?php
                                                } ?>

                                            </tbody>
                                        </table>
                                        <?php
                                        $content = '';
                                        $sqqlq = mysqli_query($con, "select * from order_tbl where userid='$loginid' order by id desc");
                                        while ($row = mysqli_fetch_assoc($sqqlq)) {
                                            $content .= '<span style="display:none;" id="show' . $row['id'] . '"><table style="width: 100%;"><thead><tr><th>#</th><th>Product Name</th><th>Order Status</th><th>Quantity</th><th>Unit Price</th><th>Tax</th><th>Total</th></tr></thead><tbody>';
                                            $or = mysqli_query($con, "select * from order_details where order_id='" . $row['order_id'] . "'");
                                            $totalProductCount = mysqli_num_rows($or);
                                            $cancelledProductCount = 0;
                                            $deliveredProCount = 0;
                                            $order_coupon_details = mysqli_query($con, "select * from order_coupon_code where order_id='" . $row['order_id'] . "' AND user_id='" . $loginid . "'");
                                            $sr = 1;
                                            $cancelledProPrice = 0;
                                            $o = 1;
                                            while ($var_or = mysqli_fetch_assoc($or)) {

                                                $pr = mysqli_query($con, "select * from products where id='" . $var_or['productid'] . "'");
                                                $var_pr = mysqli_fetch_assoc($pr);

                                                $content .= '<tr ';

                                                $statusQuery = mysqli_query($con, "select * from order_status where user_id='$loginid' and tracking_id='" . $var_or['tracking_id'] . "'");
                                                $numStatusResult = mysqli_num_rows($statusQuery);
                                            
                                                $orderSrbFetch = mysqli_fetch_array(mysqli_query($con, "select od.*, os.tracking_status from order_details od, order_status os where od.order_id='" . $row['order_id'] . "' AND od.order_id = os.order_id AND od.tracking_id=os.tracking_id AND od.productid='" . $var_or['productid'] . "' ORDER BY os.id DESC LIMIT 1;"))['tracking_status'];

                                                $productTrackingId = $var_or['tracking_id'];

                                                if ($orderSrbFetch == 'Cancelled') {
                                                    $cancelledProPrice += $var_or['price'] + $var_or['gst'];
                                                    $cancelledProductCount++;
                                                } else if ($orderSrbFetch == 'Delivered') {
                                                    $deliveredProCount++;
                                                    $deliverydatetime=$orderSrbFetch['deldat'].' '.$orderSrbFetch['deltime'];
                                                      $delnewDateTime = date('Y-m-d H:i:s', strtotime($deliverydatetime) + 24 * 3600);
                                                }

                                                $content .= '>

                                                <td>' . $sr++ . '</td>
                                                <td>' . $var_pr['product_name'] . '</td>  <td>' . $orderSrbFetch . '</td>
                                                <td class="text-center">' . $var_or['quantity'] . '</td>
                                                <td class="text-center">' . $currency . ' ' . number_format(($var_or['price'] / $var_or['quantity']), 2) . '</td>
                                                <td class="text-center">' . $currency . number_format($var_or['gst'], 2) . '</td>
                                                <td class="text-center"> ' . $currency . ' ' . number_format($var_or['price'] + $var_or['gst'], 2) . '</td>
                                                
                                                <td class="text-center"><button class="btn dwnld-btn btn-primary trckbtn"';
                                                if ($numStatusResult > 0 && $row['payment_status'] != 'Failed') {
                                                    $content .= 'style="cursor: pointer;padding:0;" ';

                                                    if (($row['payment_type'] == 'Online') && ($row['payment_status'] != 'Success')) {
                                                        $content .= 'onclick="orderTrackingNotAvailable()"';
                                                    } else {
                                                        $content .= 'onclick="javascript:location.href=\'track-order.php?' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '&id=' . $var_or['tracking_id'] . '&' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '\'"';
                                                    }
                                                }
                                                $content.='>Track</button>
                                                
                                                </td>';
                                                
                                                 $orderSrbFetch1 = (mysqli_query($con, "select id from refund_order where od_p_id='" . $var_or['id'] . "' "));
                                            
                                            if ($orderSrbFetch == 'Delivered' &&  date('Y-m-d H:i:s')< $delnewDateTime && mysqli_num_rows($orderSrbFetch1)==0) {
                                         
                                                    $content .= '<td class="text-right" style="cursor: pointer;padding:0"
                                                    
                                                    ><button class="btn dwnld-btn btn-primary trckbtn refund" id="'.$var_or['id'].'">Refund</button></td></tr>';
                                                
                                            }
                                            else
                                            {
                                               $content .='<td></td></tr>'; 
                                            }
                                        
                                                $o++;
                                            }

                                        ?>
                                            <?php echo "<script>
                                            var totalProduct = " . $totalProductCount . "
                                            var cancelledProduct = " . $cancelledProductCount . "
                                            var deliveredPorducts = " . $deliveredProCount . "
                                            var paymentMode = '" . $row['payment_mode'] . "'
                                          
                                            if(totalProduct - cancelledProduct == 0){
                                               document.getElementById('payment_status_" . $row['order_id'] . "').innerText = 'Cancelled';
                                            }else if ((deliveredPorducts + cancelledProduct == totalProduct) && paymentMode == 'COD'){
                                                document.getElementById('payment_status_" . $row['order_id'] . "').innerText = 'Success';
                                            }
                                              var totalPrice = document.getElementById('totalPrice_" . $row['order_id'] . "').getAttribute('data-id');
                                              document.getElementById('totalPrice_" . $row['order_id'] . "').innerText = number_format_js(Number(totalPrice) - Number(" . $cancelledProPrice . "), 2) ;
                                            
                                            </script>";
                                            ?>
                                        <?php

                                            // $cancelledProPrice ;

                                            $getcuopondata = mysqli_fetch_assoc($order_coupon_details);
                                            if (!empty($getcuopondata)) {
                                                $content .= '<tr><td></td><td></td><td></td><td>Coupon Apply(' . $getcuopondata['coupon_code'] . ')</td><td> - ' . $currency . ' ' . $getcuopondata['discount_price'] . '</td></tr>';
                                                $content .= '<tr><td></td><td></td><td></td><td>Total</td><td> ' . $currency . ' ' . $getcuopondata['totalprice'] . '</td></tr>';
                                            }
                                            if ($row['invoice_generated'] == 1) {
                                                $invoiceToken = $dashboard->invoiceTokenByOrderId($row['order_id']);
                                                if ($invoiceToken != null) {
                                                    $content .= '<tr><td></td><td></td><td></td><td></td><td class="text-right" style="cursor: pointer;"
                                                    onclick="window.open(\'invoice.php?' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '&oid=' . $row['order_id'] . '&' . $homePage->generateToken(40) . '=' . $homePage->generateToken(40) . '\')"
                                                    ><button class="btn dwnld-btn btn-primary">Download Invoice</button></td></tr>';
                                                }
                                            }


                                            $content .= '</tbody></table></span>';
                                        }

                                        echo $content;

                                        ?>

                                    </div>
                                </div>
                            </div>


<!-- 
                            <div class="tab-pane" id="account-wishlist" role="tabpanel" aria-labelledby="account-wishlist-tab">
                                <div class="myaccount-orders wishlist">
                                    <div id="updateWishlist">
                                        <div class="desh_wish">
                                            <h4 class="create-acc"><i class="fa fa-heart"></i> My Wishlist</h4>
                                        </div>

                                        <div class="table-responsive" id="wishlistTable">

                                            <table id="example2" class="display " cellspacing="0" width="100%">

                                                <thead>
                                                    <tr>
                                                        <th style="padding: 13px 0;">Products</th>
                                                        <th>Product&nbsp;Name</th>
                                                        <th>Price</th>
                                                        <th class="none">Availability</th>
                                                        <th class="none">Action</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <?php
                                                    //Show User Wishlist
                                                    $wProducts = $wishList->wishListDetail();
                                                    if (isset($wProducts['wishListEmpty'])) {
                                                    ?>
                                                        <tr>
                                                            <td class="" colspan="5">
                                                                <h1 class="text-center"> <img src="assets/img/wishlist-empty.png" alt="" style="width: 400px;"> </h1>
                                                                <br>
                                                                <div class="text-center cart_submit">
                                                                    <a href="index.php" class="btn btn-primary btn-rounded w-auto ">Wish
                                                                        Now</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    } else {
                                                        foreach ($wProducts as $wproduct) {
                                                        ?>

                                                            <tr>
                                                                <td style="width:100px; padding: 15px;">
                                                                    <a href="product-detail.php?product_id=<?= $wproduct['id']; ?>">
                                                                        <img src="asset/image/product/<?= $wproduct['image']; ?>" width="100" height="100" alt="product">
                                                                    </a>
                                                                </td>
                                                                <td>
                                                                    <a href="product-detail.php?product_id=<?= $wproduct['id']; ?>"><?= $wproduct['product_name']; ?></a>
                                                                </td>
                                                                <td><?= $currency; ?>
                                                                    <?php
                                                                    $isdeal = $homePage->isDealByProduct($wproduct['id']);
                                                                    if (!empty($isdeal)) {
                                                                        if ($isdeal[0]['stock'] != 0) {


                                                                            $price = $isdeal[0]['price'];
                                                                        } else {
                                                                            if (($wproduct['price'] == $wproduct['discount']) || ($wproduct['discount'] == 0)) {

                                                                                $price = $wproduct['price'];
                                                                            } else {
                                                                                $price = $wproduct['discount'];
                                                                            }
                                                                        }
                                                                    } else {
                                                                        if (($wproduct['price'] == $wproduct['discount']) || ($wproduct['discount'] == 0)) {

                                                                            $price = $wproduct['price'];
                                                                        } else {
                                                                            $price = $wproduct['discount'];
                                                                        }
                                                                    }
                                                                    echo $price; ?> </td>

                                                                <?php if ($wproduct['stock'] == "Yes") {    ?>
                                                                    <td style="color: green;">In Stock</td>
                                                                <?php } else { ?>
                                                                    <td style="color: red;">Out of Stock</td>
                                                                <?php  } ?>


                                                                <td style="text-align: center;color: red;">
                                                                    <a onclick="removeFromWishList(<?= $wproduct['id']; ?>,this.id,'<?= $url; ?>')" id="wishlist<?= $wproduct['id']; ?>" class="btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                                                                </td>
                                                            </tr>

                                                    <?php
                                                        }
                                                    }
                                                    ?>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> -->


                            <div class="tab-pane" id="account-address" role="tabpanel" aria-labelledby="account-address-tab">
                                <div class="addaddress pb-5">
                                    <div class="myaccount-address">
                                        <div id="changeAddress">
                                            <h4 class="create-acc"><i class="fa fa-map-marker"></i> &nbsp; My
                                                Address book</h4>
                                            <div class="row pt-3 pb-3">
                                                <?php
                                                // Show User Address
                                                $addresses = $dashboard->userAddresses();

                                                if (!empty($addresses)) {
                                                    foreach ($addresses as $address) {
                                                ?>

                                                        <div class="col-lg-6 col-md-12">
                                                            <div class="card">
                                                                <!-- <div class="card-header px-lg-3">Your Delivery Address</div> -->
                                                                <div class="card-body">
                                                                    <div class="add-type">
                                                                        <h4 class="p-0 m-0"><?= $address['first_name'] ?? '' ?>
                                                                            <?= $address['last_name'] ?? '' ?></h4>
                                                                        <h3 class="m-0"><?= $address['addr_type']; ?></h3>
                                                                    </div>
                                                                    <p><?= $address['address'] ?></p>

                                                                    <span class="" style="cursor:pointer; background-color: antiquewhite;
                                                            padding: 3px 8px; border-radius: 15px; line-height: 1.5; color: #ed3237;" data-effect="fadeOut" onclick="editAddress(<?= $address['id']; ?>);"><i class="fa fa-edit"></i></span>
                                                                    <span class="pull-right mytrash clickable close-icon" style="cursor:pointer;" data-effect="fadeOut" onclick="removeAddress(<?= $address['id']; ?>);"><i class="fa fa-times"></i></span>
                                                                    <!-- <a href="#" class="card-link" onclick="editAddress(<?= $address['id']; ?>);">Edit Address</a> -->
                                                                </div>
                                                            </div>
                                                        </div>

                                                <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12 text-left d-flex flex-row-reverse" style="margin-top:0; width:fit-content;" id="addrBtns"><a href="javascript:;" onclick="addNewAddr()" id="addNewAddressButton" class="btn btn-primary btn-rounded mx-1"> + Add Address</a></div>
                                        <!-- edit address -->
                                    </div>

                                    <form id="new_address_form" class="checkout_form">

                                        <input type="hidden" name="updateAddress">
                                        <input type="hidden" name="shippingAddress" id="shippingAddress" value="add">
                                        <input type="hidden" name="shippingAddressId" id="shippingAddressId" value="">

                                        <div class="edit_address" id="add_address">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="product-radio">
                                                            <ul class="product-now">
                                                                <li>
                                                                    <input type="radio" id="newAddress1" name="newAddressType" value="Home">
                                                                    <label for="newAddress1">Home</label>
                                                                </li>
                                                                <li>
                                                                    <input type="radio" id="newAddress2" name="newAddressType" value="Office">
                                                                    <label for="newAddress2">Office</label>
                                                                </li>
                                                                <li>
                                                                    <input type="radio" id="newAddress3" name="newAddressType" value="Other">
                                                                    <label for="newAddress3">Other</label>
                                                                </li>
                                                                <div class="err_msg" id="newAddressTypeErrMsg"></div>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="ceckout-form">
                                                <!--Billing Fields Start-->
                                                <div class="billing-fields">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-fild first-name">
                                                                <label>First name<span class="required">*</span></label>
                                                                <input class="form-control" class="form-control" type="text" name="newAddressFirstName" id="newAddressFirstName" placeholder="Enter First Name">
                                                                <div class="err_msg" id="newAddressFirstNameErrMsg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-fild last-name">
                                                                <label>Last name<span class="required">*</span></label>
                                                                <input class="form-control" type="text" name="newAddressLastName" id="newAddressLastName" placeholder="Enter Last Name">
                                                                <div class="err_msg" id="newAddressLastNameErrMsg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-fild billing_phone">
                                                                <label>Mobile<span class="required">*</span></label>
                                                                <input class="form-control" name="newAddressMobile" type="text" id="newAddressMobile" placeholder="Mobile Number">
                                                                <div class="err_msg" id="newAddressMobileErrMsg"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-fild email">
                                                                <label>Email<span class="required">*</span></label>
                                                                <input class="form-control" name="newAddressEmail" type="text" id="newAddressEmail" placeholder="Enter Email Address">
                                                                <div class="err_msg" id="newAddressEmailErrMsg"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label>Full address<span class="required">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-fild billing_address_1">
                                                                <input class="form-control" name="newAddressFlat" placeholder="House number and Flat number" type="text" id="newAddressFlat">
                                                                <div class="err_msg" id="newAddressFlatErrMsg"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-fild">
                                                                <input class="form-control" name="newAddressStreet" placeholder="Street,Apartment etc" type="text" id="newAddressStreet">
                                                                <div class="err_msg" id="newAddressStreetErrMsg"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mt-3">
                                                            <div class="form-fild">
                                                                <input class="form-control" name="newAddressLocality" placeholder="Locality, unit etc. (optional)" type="text" id="newAddressLocality">
                                                                <div class="err_msg" id="newAddressLocalityErrMsg">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-fild country">
                                                                <label for="country">Country <span>*</span></label>
                                                                <input name="newAddressCountry" value="99" id="newAddressCountry" type="hidden">
                                                                <input type="text" readonly value="India" class="form-control">

                                                                <div class="err_msg" id="newAddressCountryErrMsg"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-fild state">
                                                                <label>State<span>*</span></label>
                                                                <select class="form-control select2drop1" name="newAddressState" id="newAddressState">
                                                                    <option></option>
                                                                    <?php
                                                                    foreach ($dashboard->getData('state_list', 'id,state', 'country_id=99') as $state) {
                                                                    ?>
                                                                        <option value="<?= $state['id']; ?>">
                                                                            <?= $state['state']; ?></option>

                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select>
                                                                <div class="err_msg" id="newAddressStateErrMsg"></div>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-8">
                                                            <div class="form-fild billing_city">
                                                                <label>Town / City<span class="required">*</span></label>
                                                                <input class="form-control" name="newAddressCity" type="text" id="newAddressCity" placeholder="Enter City Name">
                                                                <div class="err_msg" id="newAddressCityErrMsg"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-fild billing_postcode">
                                                                <label>Postcode / ZIP<span class="required">*</span></label>
                                                                <input class="form-control" name="newAddressZipCode" type="text" id="newAddressZipCode" placeholder="Enter Zip Code">
                                                                <div class="err_msg" id="newAddressZipCodeErrMsg"></div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12 mb-3">
                                                            <div class="login-submit">
                                                                <button type="submit" class="btn btn-primary btn-rounded form-button">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="tab-pane" id="account-details" role="tabpanel" aria-labelledby="account-details-tab">
                                <div class="myaccount-details">
                                    <h4 class="create-acc"><i class="fa fa-lock"></i> &nbsp; Change Password</h4>
                                    <form action="" method="POST" id="changePass" class="formSubmit" onsubmit="return checkPasswordMatch()">
                                        <input type="hidden" name="userInfo" id="userInfo1" value="<?= $userInfo['email'] ?>">

                                        <div class="fb-form-inner">
                                            <input type="hidden" name="changePassword" id="changePassword" value="changePassword">
                                            <div class="single-input">
                                                <label for="currentPassword">Current Password</label>
                                                <input type="password" name="currentPassword" id="currentPassword" value="" class="currentpassword form-control" placeholder="Type Current Password">
                                                <div class="err_msg" id="currentPasswordErrMsg"></div>
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-newpass">New Password</label>
                                                <input type="password" name="newPassword" id="newPassword" class="password form-control" placeholder="Type New Password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" oninput="if (this.validity.patternMismatch) { this.classList.add('border-danger'); } else { this.classList.remove('border-danger'); } if (typeof this.reportValidity === 'function') { this.reportValidity(); }" readonly onfocus="this.removeAttribute('readonly');">
                                                <div class="err_msg" id="newPasswordErrMsg"></div>
                                            </div>
                                            <div class="single-input">
                                                <label for="account-details-confpass">Confirm Password</label>
                                                <input type="password" name="confirmNewPassword" id="confirmNewPassword" class="confirmPassword form-control" placeholder="Type Confirm Password" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" oninput="if (this.validity.patternMismatch) { this.classList.add('border-danger'); } else { this.classList.remove('border-danger'); } if (typeof this.reportValidity === 'function') { this.reportValidity(); }" readonly onfocus="this.removeAttribute('readonly');">
                                                <div class="err_msg" id="confirmNewPasswordErrMsg"></div>
                                            </div>
                                            <!-- <div class="col-md-12"></div> -->
                                            <div class="col-sm-12 text-left single-input">
                                                <div class="text-center" id="changePassMsg"></div>
                                                <button type="submit" id="changePAsswordButton" class="btn btn-primary btn-rounded mt-sm-3 mt-1 mend-auto form-button"><span>Change
                                                        Password</span></button>
                                            </div>
                                        </div>
                                    </form>

                                    <!-- otp verification section -->
                                    <div class=" user-area otpVerify" style="display:none;">
                                        <div class="user-item">
                                            <div class="form-container text-center">
                                                <h2>OTP Verification</h2>
                                                <div class="form-inner">
                                                    <form method="post" id="verifyOtpFormDash" class="otp-form">
                                                        <input type="hidden" name="userInfo" id="userInfoS" value="<?= $userInfo['email'] ?>">
                                                        <input type="hidden" name="password" id="passInp">
                                                        <input type="hidden" name="newPassword" id="cPassInp">
                                                        <input type="hidden" name="otp" id="otpInp">
                                                        <div class="customer-login-register">
                                                            <div class="login-form">
                                                                <p>Verify your email,
                                                                    An OTP has been sent to email</p>
                                                                <div class="form-fild">
                                                                    <?php
                                                                    if (isset($_GET['url'])) {
                                                                        echo '<input type="hidden" name="url" value="' . $url . '">';
                                                                    }
                                                                    ?>
                                                                    <p><label>Enter OTP<span class="required">*</span></label></p>
                                                                    <input id="codeBox1" class="codeBox no_arrows_numInp" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)" />
                                                                    <input id="codeBox2" class="codeBox no_arrows_numInp" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)" />
                                                                    <input id="codeBox3" class="codeBox no_arrows_numInp" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)" />
                                                                    <input id="codeBox4" class="codeBox no_arrows_numInp" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)" />
                                                                </div>
                                                                <div class="register-submit">
                                                                    <button type="submit" class="btn btn-primary btn-rounded mt-sm-3 mt-1 mend-auto form-button" id="otpsubmit" name="submit">Verify</button>
                                                                </div>
                                                                <div class="text-center" id="verifyOtpFormMsg"></div>
                                                                <div class="timerdiv"><span id="timer"></span></div>


                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end here -->

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FB's Account Page Area End Here -->
</main>
<!-- end here -->

<!-- footer start -->
<?php include('include/footer.php'); ?>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script src="assets/select2/select2.min.js"></script>

<script>
    $(document).ready(function() {
        $('.select2drop1').select2({
            placeholder: 'Please Select State',
        });
    });
</script>

<script>
    function format(value) {
        var firstDivContent = document.getElementById('show' + value);
        var fet = "select * from order_tbl where userid='$loginid' and id='" + value + "' order by id desc";
        var sh = "<div id='p_" + value + "'>" + firstDivContent.innerHTML + "</div>";

        return sh;
    }
    $(document).ready(function() {
        var table = $('#example').DataTable({
            // "lengthMenu": [[1], [1, "All"]],
            language: {
                paginate: {
                    next: '>>',
                    previous: '<<'
                }
            }
        });

        // Add event listener for opening and closing details
        $('#example').on('click', 'td.details-control', function() {
            var tr = $(this).closest('tr');
            console.log(tr);
            var row = table.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                tr.removeClass('shown');
            } else {
                // Open this row
                row.child(format(tr.data('child-value'))).show();
                tr.addClass('shown');
            }
        });
    });
</script>

<script>
    function getCodeBoxElement(index) {
        return document.getElementById('codeBox' + index);
    }

    function onKeyUpEvent(index, event) {
        const eventCode = event.which || event.keyCode;
        if (getCodeBoxElement(index).value.length === 1) {
            if (index !== 4) {
                getCodeBoxElement(index + 1).focus();
            } else {
                getCodeBoxElement(index).blur();
                // Submit code
                console.log('submit code ');
            }
        }
        if (eventCode === 8 && index !== 1) {
            getCodeBoxElement(index - 1).focus();
        }
    }

    function onFocusEvent(index) {
        for (item = 1; item < index; item++) {
            const currentElement = getCodeBoxElement(item);
            if (!currentElement.value) {
                currentElement.focus();
                break;
            }
        }
    }
</script>

<script>
    $("#editProfileButton").click(function() {
        $("#account-profile-tab").click();
    });

    $("#myOrderButton").click(function() {
        $("#account-orders-tab").click();
    });

    $("#changePasswordButton").click(function() {
        $("#account-details-tab").click();
    });

    $("#new_address_form").hide();

    $('#addNewAddressButton').click(function() {
        $("#new_address_form").toggle();
        $('#newAddressFirstName').scrollToCenter();
        $('#new_address_form').trigger("reset");
    });
</script>

<script>
    $(document).ready(function() {
        $(document).on("click", ".clickmedash", function() {

            var mydsid = $(this).attr("data-id");

            $(".clickmedash").removeClass("active");
            $(this).addClass("active");

            $(".tab-pane").removeClass("active");
            $(mydsid).addClass("active");

        });
    });

    function orderTrackingNotAvailable() {
        Swal.fire({
            title: 'Order tracking not available',
            html: "Order tracking is not accessible for pending or cancelled payments. This option becomes available only after payment has been completed, or for cash on delivery transactions.",
            showCancelButton: true,
            type: 'info',
            icon: "info",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showCancelButton: false,
            confirmButtonText: 'OK'
        });
    }
</script>

<script>
    function checkPasswordMatch() {
        var newPassword = document.getElementById("newPassword").value;
        var confirmNewPassword = document.getElementById("confirmNewPassword").value;
        if (newPassword !== confirmNewPassword) {
            return false;
        } else {
            return true; // Allow form submission
        }
    }
</script>
<script>
var currentUrl = window.location.href;

if (currentUrl.indexOf('dashboard.php?order') !== -1) {
    var activeElement = document.querySelector('.nav-item .nav-link.active');
    if (activeElement) {
        activeElement.classList.remove('active');
    }
    
    var activeTabPane = document.querySelector('.tab-pane.active');
    if (activeTabPane) {
        activeTabPane.classList.remove('active');
    }
    
    document.getElementById('my_order_tab').classList.add('active');
    document.getElementById('account-orders').classList.add('active');
}

</script>