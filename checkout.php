<?php include('header.php');

$total_TAX = 0;

if (isset($_SESSION['checkf_data'])) {
    $addr_type1 = $_SESSION['checkf_data']['addr_type'];
    $flat = $_SESSION['checkf_data']['flat'];
    $street = $_SESSION['checkf_data']['street'];
    $locality = $_SESSION['checkf_data']['locality'];

    $state11 = $_SESSION['checkf_data']['state'];

    $city = $_SESSION['checkf_data']['city'];
    $zip_code = $_SESSION['checkf_data']['zip_code'];
}

$buyAsGuest = false;
?>

<link rel="stylesheet" href="assets/css/checkout.css">
<style>
    .checkout-section-2 .left-sidebar-checkout .checkout-detail-box>ul>li .checkout-box .checkout-detail .custom-accordion .accordion-item .accordion-header .accordion-button::before {
        content: "";
    }

    span.toggle-password {
        position: absolute;
        top: 17px;
        right: 10px;
    }

    span.toggle-passwordtwo {
        position: absolute;
        top: 17px;
        right: 10px;
    }

    .buys-gestt {
        background-color: #f7f7f7;
        border-top: 3px solid #ed3237;
        font-size: 15px;
        padding: 13px 18px;
        position: relative;
        text-transform: capitalize;
        margin-bottom: 15px;
        border-radius: 5px;
    }

    .create-acc {
        background-color: #f7f7f7;
        font-size: 15px;
        padding: 13px 18px;
        position: relative;
        text-transform: capitalize;
        border-radius: 5px;
        margin-bottom: 15px;
        width: 100%;
    }

    .otpVerify {
        width: 50%;
        margin: 20px auto;
        border-radius: 13px;
    }

    .select2-container--default .select2-selection--single {
        border: none;
    }

    ul.delivery-address-detail h4,
    p,
    h6 {
        margin-bottom: 0.5rem;
    }

    .cart-box-item-title {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    p.hny_p {
        font-size: 13px;
        width: 98px;
        margin: 0;
    }

    .cart-box-item-price {
        padding-right: 9px;
    }

    .mb-3.border-bottom,
    .odr-summry,
    .payment-title-sec {
        background-color: #f7f7f7;
        font-size: 15px;
        padding: 6px 10px;
        border-radius: 5px;
    }

    p.mb-0.text-capitalize {
        line-height: 1;
        font-weight: 700;
        font-family: 'Syne';
        font-size: 12px;
    }

    .text-success {
        color: #c50f13 !important;
        font-size: 16px;
        font-family: 'Syne';
    }

    .accordion-body.pb-3.pt-3.cartitemdiv {
        background-color: white;
    }

    @media (max-width:600px) {
        .otpVerify {
            width: 100%;
        }
    }

    .form-group.input-group.bg-white.rounded.mb-0.p-2.d-flex {
        gap: 10px;
    }

    .agentsign {
        color: #1696e7 !important;
    }

    .agentsign:hover {
        color: #fc9135 !important;
    }
    
    .form-check-input {
    position: static;

}
</style>

<!-- Checkout section Start -->
<section class="checkout-section-2 section-b-space">

    <!-- breadcrumb-area -->
    <div class="breadcrumb-area breadcrumb-bg-two">
        <div class="container custom-container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-content">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- breadcrumb-area-end -->
    <button id="testbtn"></button>
    <div class="container my-3 main">
        <!-- login/signup section -->
        <div class="row" id="log-fides">
            <div class="col-lg-12">
                <?php if (!USER::isLoggedin()) { ?>
                    <div id="showlogin">
                        <div class="panel-collapse mb-3 ckloginregisterdiv collapse<?= (USER::isLoggedIn()) ? '' : ''; ?>" id="cklgregfrm">
                            <div class="row">
                                <div class="col-lg-6 mb-sm-15 mb-md-3">
                                    <div class="login_form" id="checkout_login">
                                        <div class="panel-body">
                                            <h5 class="mb-30 font-sm" style="font-weight:600!important;">LogIn Your Account
                                            </h5>
                                            <p class="mb-30 font-sm">If you have shopped with us before, please enter your
                                                details below. If you are a new customer, please first create account with
                                                us.</p>
                                            <form action="#" method="post" class="login-main formSubmit" id="login_form">
                                                <input type="hidden" name="logIn" value="logIn">
                                                <div class="form-group mb-3">
                                                    <input type="text" class="form-control" name="logInMobileNumber" id="logInMobileNumber" value="" autocomplete="off" placeholder="Email-Id" readonly onfocus="this.removeAttribute('readonly');">
                                                    <div class="err_msg" id="logInMobileNumberErrMsg"></div>
                                                </div>
                                                <div class="form-group mb-2" style="position: relative;">
                                                    <input type="password" class="form-control" name="logInPassword" id="logInPassword" value="" placeholder="Password" readonly onfocus="this.removeAttribute('readonly');">
                                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                                    <div class="err_msg" id="logInPasswordErrMsg"></div>
                                                </div>
                                                <div class="login_footer text-right form-group mb-2">
                                                    <a href="forgot-password.php"> <i class="fa fa-lock"></i> Forgot password?</a>
                                                </div>
                                                <div class="form-group my-3">
                                                    <button class="btn btn-primary btn-rounded btn-icon-right user_login" id="lg_btn" type="submit">Log in</button>
                                                </div>
                                                <div class="form-group">
                                                    <div class="text-center errmsg" id="login_formMsg"></div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 mb-sm-15 mb-md-3">
                                    <div class="register_form" id="checkout_signup">
                                        <div class="panel-body">
                                            <h5 class="mb-30 font-sm" style="font-weight:600!important;">Create Your Account
                                            </h5>
                                            <form id="registrationForm" action="#" method="post" class="formSubmit">
                                                <input type="hidden" name="register" value="register">
                                                <div class="myregfrmdiv">
                                                    <div class="form-group mb-3">
                                                        <input type="text" name="firstName" id="firstName" value="" placeholder="First Name" autocomplete="off" required readonly onfocus="this.removeAttribute('readonly');" pattern="[a-zA-Z ]*" title="Only Alphabet with Space Allow" placeholder="Full Name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                                        <div class="err_msg" id="firstNameErrMsg"></div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <input type="text" name="lastName" id="lastName" value="" placeholder="Last Name" autocomplete="off" required readonly onfocus="this.removeAttribute('readonly');" pattern="[a-zA-Z ]*" title="Only Alphabet with Space Allow" placeholder="Full Name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)">
                                                        <div class="err_msg" id="lastNameErrMsg"></div>
                                                    </div>
                                                </div>
                                                <div class="myregfrmdiv">
                                                    <div class="form-group mb-3">
                                                        <input type="text" class="phone" name="mobileNumber" id="mobileNumber" placeholder="Mobile Number" autocomplete="off" required readonly onfocus="this.removeAttribute('readonly');" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10">
                                                        <div class="err_msg" id="mobileNumberErrMsg"></div>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <input type="email" name="emailId" value="" id="emailId" autocomplete="off" placeholder="Email-Id" required readonly onfocus="this.removeAttribute('readonly');">
                                                        <div class="err_msg" id="emailIdErrMsg"></div>
                                                    </div>
                                                </div>

                                                <div class="form-group" style="position: relative;">
                                                    <input type="password" class="password" name="userPassword" value="" id="userPassword" placeholder="Password" required readonly onfocus="this.removeAttribute('readonly');" title="lowercase, uppercase, numeric, special character, 8 characters or longer." pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$">
                                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-passwordtwo"></span>
                                                    <div class="err_msg mt-2" id="userPasswordErrMsg"></div>
                                                </div>

                                                <div class="form-group mt-3">
                                                    <button class="btn btn-primary btn-rounded btn-icon-right" type="submit" name="submit" id="submit">Register</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="toggle_info text-center create-acc">
                                        <a id="agent-register" style="font-weight: 500;cursor:pointer;">
                                            <span class="agentsign"> <i class="fas fa-user mr-10 "></i> Agent Login/Sign Up </span>

                                        </a>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="toggle_info text-center create-acc" id="you_are_not_login_section">
                        <span>
                            <i class="fas fa-user mr-10 text-muted"></i>
                            <span class="text-muted">Already have an account? or Are you new customer?</span>
                            <a href="#cklgregfrm" id="cllick-to" style="font-weight: 500;">Click here</a>
                        </span>
                    </div>
                <?php } ?>
                <div class="otpVerify" style="display:none;">
                    <div class="row justify-content-center">
                        <div class="col-lg-12 mb-sm-15 mb-md-3">
                            <div class="otp_form" id="otpform">
                                <div class="panel-body">
                                    <h2 class="mb-15 text-center mb-2">Veriy Email Address</h2>
                                    <p class="mb-15 font-sm text-center">An OTP has been sent to your Email ID</p>
                                    <form method="POST" id="verifyOtpForm" class="otp-form login_main">
                                        <input type="hidden" name="userInfo" id="userInfo" value="">
                                        <div class="form-group">
                                            <input id="codeBox1" class="codeBox" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)" />
                                            <input id="codeBox2" class="codeBox" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)" />
                                            <input id="codeBox3" class="codeBox" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)" />
                                            <input id="codeBox4" class="codeBox" type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)">
                                            <div class="errrmsg">
                                                <div class="text-center" id="verifyOtpFormMsg"></div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary btn-rounded btn-icon-right" id="otpsubmit" name="submit">Verify</button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="timerdiv mt-3"><span id="timer"></span></div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8">
                <div class="left-sidebar-checkout">
                    <div class="checkout-detail-box">
                        <ul>
                            <li>
                                <div class="checkout-box">
                                    <div class="checkout-detail">
                                        <div class="row g-4">
                                            <form id="addressDetailsForm">
                                                <?php
                                                //Check User Address
                                                $dashboard = new Dashboard($con);
                                                $userData = $dashboard->getUserDetail();
                                                if (
                                                    empty($userData['flat']) && empty($userData['street']) && empty($userData['locality']) && empty($userData['city']) &&
                                                    empty($userData['zipcode']) && empty($userData['state']) && empty($userData['country'])
                                                ) { ?>
                                                    <div class="accordion-item accordion-item-line1  position-relative">
                                                        <h4 class="accordion-header" id="flush-headingOne">Delivery Address
                                                        </h4>
                                                        <?php if (!USER::isLoggedIn()) { ?>
                                                            <style>
                                                                .shippingForm:before {
                                                                    content: "Please Login To Place Order";
                                                                    background-color: #c8c4c42b;
                                                                    width: 100%;
                                                                    height: 100%;
                                                                    position: absolute;
                                                                    z-index: 1;
                                                                    top: -6px;
                                                                    left: 0;
                                                                    color: #505050;
                                                                    font-size: 24px;
                                                                    font-weight: bold;
                                                                    text-align: center;
                                                                    display: flex;
                                                                    align-items: center;
                                                                    justify-content: center;
                                                                    backdrop-filter: blur(1px);
                                                                }
                                                            </style>
                                                        <?php } ?>
                                                        <div id="flush-collapseOne" class="accordion-collapse collapse show">
                                                            <div class="accordion-body pb-4 pt-3">
                                                                <div class="checkout-billing shippingForm" id="newBillingAddress">
                                                                    <!-- Multiple Radios (inline) -->
                                                                    <input type="hidden" name="newBillingAddress" value="newBillingAddress">
                                                                    <?php if (!USER::isLoggedIn()) { ?> <a href="javascript:void(0)" class="btn btn-primary btn-rounded btn-icon-right mt-3 zlogin-btn" id="loginbtnmdl" data-bs-toggle="modal" data-bs-target="#modal-checkout" data-bs-whatever="@mdo" type="button">Login</a>
                                                                    <?php } ?>
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group">
                                                                            <div class="product-radio">
                                                                                <ul class="product-now d-flex mb-3 pl-0">
                                                                                    <li>
                                                                                        <input type="radio" class="custom-radio" id="newBillingAddress1" name="newBillingAddressType" value="Home" <?php if (isset($_SESSION['checkf_data']['addr_type'])) {
                                                                                                                                                                                                        if ($addr_type1 == "Home") { ?> checked <?php }
                                                                                                                                                                                                                                        } ?>>
                                                                                        <label for="newBillingAddress1"></i>
                                                                                            Home</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input type="radio" class="custom-radio" id="newBillingAddress2" name="newBillingAddressType" value="Office" <?php if (isset($_SESSION['checkf_data']['addr_type'])) {
                                                                                                                                                                                                            if ($addr_type1 == "Office") { ?> checked <?php }
                                                                                                                                                                                                                                                } ?>>
                                                                                        <label for="newBillingAddress2">
                                                                                            Office</label>
                                                                                    </li>
                                                                                    <li>
                                                                                        <input type="radio" class="custom-radio" id="newBillingAddress3" name="newBillingAddressType" value="Other" <?php if (isset($_SESSION['checkf_data']['addr_type'])) {
                                                                                                                                                                                                        if ($addr_type1 == "Other") { ?> checked <?php }
                                                                                                                                                                                                                                            } ?>>
                                                                                        <label for="newBillingAddress3">Other</label>
                                                                                    </li>
                                                                                    <div class="err_msg" id="newBillingAddressTypeErrMsg">
                                                                                    </div>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="ceckout-form">
                                                                        <!--Billing Fields Start-->
                                                                        <div class="billing-fields">
                                                                            <input type="hidden" name="newDifferentShippingAddress" id="newDifferentShippingAddress">
                                                                            <div class="row">
                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                    <input class="form-control" placeholder="First name *" type="text" name="newBillingAddressFirstName" <?= (USER::isLoggedIn()) ? "value='" . $userData['firstname'] . "' readonly" : ""; ?>>
                                                                                    <div class="err_msg" id="newBillingAddressFirstNameErrMsg">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                    <input class="form-control" type="text" placeholder="Last name *" name="newBillingAddressLastName" <?= (USER::isLoggedIn()) ? "value='" . $userData['lastname'] . "' readonly" : ""; ?>>
                                                                                    <div class="err_msg" id="newBillingAddressLastNameErrMsg">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                    <input pattern="[1-9]{1}[0-9]{9}" placeholder="Mobile Number *" title="Please enter exactly 10 digits" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10" class="form-control" name="newBillingAddressPhone" type="text" <?= (USER::isLoggedIn()) ? " value='" . $userData['mobile'] . "' readonly" : ""; ?>>
                                                                                    <div class="err_msg" id="newBillingAddressPhoneErrMsg">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                    <input class="form-control" name="newBillingAddressEmail" placeholder="Email Address *" type="text" <?= (USER::isLoggedIn()) ? "value='" . $userData['email'] . "' readonly" : ""; ?>>
                                                                                    <div class="err_msg" id="newBillingAddressEmailErrMsg">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-lg-12 mb-3">
                                                                                    <input class="form-control" placeholder="House number and Flat number *" value="<?php if (isset($flat)) {
                                                                                                                                                                        echo $flat;
                                                                                                                                                                    } ?>" name="newBillingAddressFlat" type="text">
                                                                                    <div class="err_msg" id="newBillingAddressFlatErrMsg">
                                                                                    </div>

                                                                                </div>
                                                                                <div class="form-group col-lg-12 mb-3">
                                                                                    <input class="form-control" placeholder="Street,Apartment etc *" name="newBillingAddressStreet" value="<?php if (isset($street)) {
                                                                                                                                                                                                echo $street;
                                                                                                                                                                                            } ?>" type="text">
                                                                                    <div class="err_msg" id="newBillingAddressStreetErrMsg">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-lg-12 mb-3">
                                                                                    <input class="form-control" placeholder="Locality, unit etc. (optional)" name="newBillingAddressLocality" value="<?php if (isset($locality)) {
                                                                                                                                                                                                            echo $locality;
                                                                                                                                                                                                        } ?>" type="text">
                                                                                    <div class="err_msg" id="newBillingAddressLocalityErrMsg">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                    <input class="form-control" placeholder="Country *" readonly value="India" type="text">
                                                                                    <input type="hidden" name="newBillingAddressCountry" value="99" id="newBillingAddressCountry">
                                                                                    <!-- <select class="form-control select2drop1" name="newBillingAddressCountry" id="newBillingAddressCountry" onchange="getStates(this.value);">
                                                                                <option value="">Please Select Country
                                                                                </option>

                                                                                <?php
                                                                                foreach ($dashboard->getData('countries', 'id,country_name') as $country) {
                                                                                ?>
                                                                                    <option value="<?= $country['id']; ?>" <?= ($country['country_name'] == 'India') ? 'selected' : 'disabled'; ?>>
                                                                                        <?= $country['country_name']; ?>
                                                                                    </option>

                                                                                <?php } ?>

                                                                            </select> -->
                                                                                    <div class="err_msg" id="newBillingAddressCountryErrMsg">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                    <select class="form-control select2drop1" name="newBillingAddressState" id="newBillingAddressState">
                                                                                        <?php
                                                                                        if (isset($_SESSION['checkf_data']['state']) && $_SESSION['checkf_data']['state'] != "") {
                                                                                            $stdid = $_SESSION['checkf_data']['state'];

                                                                                            $mysqlistsq = mysqli_query($con, "SELECT * FROM `state_list` WHERE `id`='$stdid'");
                                                                                            $mystsrow = mysqli_fetch_array($mysqlistsq);
                                                                                        ?>
                                                                                            <option value='<?= $stdid; ?>'>
                                                                                                <?= $mystsrow['state']; ?>
                                                                                            </option>

                                                                                            <?php
                                                                                            foreach ($dashboard->getData('state_list', 'id,state', 'country_id=99') as $state) {
                                                                                            ?>
                                                                                                <option value="<?= $state['id']; ?>">
                                                                                                    <?= $state['state']; ?></option>
                                                                                            <?php } ?>

                                                                                        <?php } else { ?>
                                                                                            <option value=''>Please Select State
                                                                                            </option>
                                                                                            <?php
                                                                                            foreach ($dashboard->getData('state_list', 'id,state', 'country_id=99') as $state) {
                                                                                            ?>
                                                                                                <option value="<?= $state['id']; ?>">
                                                                                                    <?= $state['state']; ?></option>

                                                                                            <?php } ?>
                                                                                        <?php } ?>

                                                                                    </select>
                                                                                    <div class="err_msg" id="newBillingAddressStateErrMsg">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                    <input class="form-control" placeholder="City *" name="newBillingAddressCity" type="text" value="<?php if (isset($city)) {
                                                                                                                                                                                            echo $city;
                                                                                                                                                                                        } ?>">
                                                                                    <div class="err_msg" id="newBillingAddressCityErrMsg">
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group col-lg-6">

                                                                                    <input class="form-control" placeholder="Postcode / ZIP " name="newBillingAddressZipCode" type="text" value="<?php if (isset($zip_code)) {
                                                                                                                                                                                                        echo $zip_code;
                                                                                                                                                                                                    } ?>">
                                                                                    <div class="err_msg" id="newBillingAddressZipCodeErrMsg">
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                        </div>
                                                                    </div>

                                                                    <div class="account-fields mt-3">
                                                                        <div class="create-acc">
                                                                            <label>
                                                                                <input id="cbox" class="custom-radio" type="radio">
                                                                                Ship to a different address?</label>
                                                                        </div>
                                                                        <div id="cbox_info" class="create-account">
                                                                            <div class="coupon-accordion">
                                                                                <div id="checkout_coupon" class="coupon-content">
                                                                                    <div class="col-lg-12">
                                                                                        <div class="form-group">
                                                                                            <div class="product-radio">
                                                                                                <ul class="product-now d-flex mb-3 pl-0">
                                                                                                    <li>
                                                                                                        <input type="radio" class="custom-radio" id="newDifferentShipping1" name="newDifferentShippingType" value="Home" checked>
                                                                                                        <label for="newDifferentShipping1">Home</label>
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        <input type="radio" class="custom-radio" id="newDifferentShipping2" name="newDifferentShippingType" value="Office">
                                                                                                        <label for="newDifferentShipping2">Office</label>
                                                                                                    </li>
                                                                                                    <li>
                                                                                                        <input type="radio" class="custom-radio" id="newDifferentShipping3" name="newDifferentShippingType" value="Other">
                                                                                                        <label for="newDifferentShipping3">Other</label>
                                                                                                    </li>
                                                                                                </ul>
                                                                                                <div class="err_msg" id="newDifferentShippingTypeErrMsg">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="ceckout-form">
                                                                                        <div class="billing-fields">
                                                                                            <div class="row">
                                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                                    <input class="form-control" type="text" placeholder="First Name *" name="newDifferentShippingFirstName" <?= (USER::isLoggedIn()) ? "value='" . $userData['firstname'] . "' readonly" : ""; ?>>
                                                                                                    <div class="err_msg" id="newDifferentShippingFirstNameErrMsg">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                                    <input class="form-control" placeholder="Last Name *" type="text" name="newDifferentShippingLastName" <?= (USER::isLoggedIn()) ? "value='" . $userData['lastname'] . "' readonly" : ""; ?>>
                                                                                                    <div class="err_msg" id="newDifferentShippingLastNameErrMsg">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                                    <input pattern="[1-9]{1}[0-9]{9}" placeholder="Phone Number *" title="Please enter exactly 10 digits" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10" class="form-control" name="newDifferentShippingPhone" type="text" <?= (USER::isLoggedIn()) ? " value='" . $userData['mobile'] . "' readonly" : ""; ?>>
                                                                                                    <div class="err_msg" id="newDifferentShippingPhoneErrMsg">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                                    <input class="form-control" name="newDifferentShippingEmail" placeholder="Email Address *" type="text" <?= (USER::isLoggedIn()) ? "value='" . $userData['email'] . "' readonly" : ""; ?>>
                                                                                                    <div class="err_msg" id="newDifferentShippingEmailErrMsg">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                                    <input class="form-control" name="newDifferentShippingFlat" placeholder="House number and Flat number" type="text">
                                                                                                    <div class="err_msg" id="newDifferentShippingFlatErrMsg">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                                    <input class="form-control" name="newDifferentShippingStreet" placeholder="Street,Apartment etc" type="text">
                                                                                                    <div class="err_msg" id="newDifferentShippingStreetErrMsg">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-lg-12 mb-3">
                                                                                                    <input class="form-control" name="newDifferentShippingLocality" placeholder="Locality, unit etc. (optional)" type="text">
                                                                                                    <div class="err_msg" id="newDifferentShippingLocalityErrMsg">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                                    <select class="form-control select2drop1" name="newDifferentShippingState" id="newDifferentShippingState">
                                                                                                        <option value="">
                                                                                                            Please
                                                                                                            Select State
                                                                                                        </option>
                                                                                                        <?php


                                                                                                        foreach ($dashboard->getData('state_list', 'id,state', 'country_id=99') as $state) {
                                                                                                        ?>
                                                                                                            <option value="<?= $state['id']; ?>">
                                                                                                                <?= $state['state']; ?>
                                                                                                            </option>

                                                                                                        <?php
                                                                                                        }
                                                                                                        ?>
                                                                                                    </select>
                                                                                                    <div class="err_msg" id="newDifferentShippingStateErrMsg">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                                    <input type="hidden" name="newDifferentShippingCountry" id="newDifferentShippingCountry" value="99">
                                                                                                    <input type="text" value="India" class="form-control" readonly>
                                                                                                    <div class="err_msg" id="newDifferentShippingCountryErrMsg">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                                    <input class="form-control" name="newDifferentShippingCity" placeholder="Town / City" type="text">
                                                                                                    <div class="err_msg" id="newDifferentShippingCityErrMsg">
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div class="form-group col-lg-6 mb-3">
                                                                                                    <input class="form-control" name="newDifferentShippingZipCode" placeholder="Postcode / ZIP" type="text">
                                                                                                    <div class="err_msg" id="newDifferentShippingZipCodeErrMsg">
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!--Accrodion End-->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php } else { ?>
                                                    <?php
                                                    //Show Usar address
                                                    // exit();
                                                    if (!empty($dashboard->userAddresses())) {
                                                        $lastorderaddress = $dashboard->lastuseraddress();
                                                        $i = 1; ?>
                                                        <div class="accordion-item accordion-item-line2   position-relative mb-3">
                                                            <div class="create-acc ">
                                                                <h4>Delivery Address</h4>
                                                            </div>
                                                            <div class="accordion-collapse show">
                                                                <?php
                                                                foreach ($dashboard->userAddresses() as $address) {
                                                                    $c = '';
                                                                    if ($lastorderaddress[0]['zip_code'] == $address['zip_code'] && $lastorderaddress[0]['addr_type'] == $address['addr_type']) {
                                                                        $c = 'checked';
                                                                    }
                                                                ?>
                                                                    <div class="col-xxl-6 col-lg-12 col-md-6">
                                                                        <div class="delivery-address-box prciiiii mb-3" style="padding :3px 18px;border-bottom: 1px solid #eee;">
                                                                            <div>
                                                                                <div class="form-group">

                                                                                    <input type="hidden" name="selectShippingAddress" value="selectShippingAddress">
                                                                                    <input class="form-check-input shipad custom-radio" value="<?= $address['id']; ?>" <?= $c; ?> type="radio" name="shippingAddress" id="flexRadioDefault1<?= $i; ?>" checked>
                                                                                    <label for="selected-item-<?= $i; ?>"><?= $address['addr_type']; ?></label>
                                                                                </div>

                                                                                <ul class="delivery-address-detail mb-4 mt-3">
                                                                                    <li>
                                                                                        <h4 class="fw-500 text-capitalize">
                                                                                            <?= $address['first_name']; ?>&nbsp;<?= $address['last_name']; ?>
                                                                                        </h4>
                                                                                    </li>

                                                                                    <li>
                                                                                        <p class="text-content fw-normal"><span class="text-title fw-bold">Address
                                                                                                : </span><?= $address['address']; ?>
                                                                                        </p>
                                                                                    </li>

                                                                                    <li>
                                                                                        <h6 class="text-content fw-normal"><span class="text-title fw-bold">Email
                                                                                                :</span> <?= $address['email']; ?>
                                                                                        </h6>
                                                                                    </li>

                                                                                    <li>
                                                                                        <h6 class="text-content mb-0 fw-normal">
                                                                                            <span class="text-title fw-bold">Phone
                                                                                                :</span> <?= $address['phone']; ?>
                                                                                        </h6>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                <?php $i++;
                                                                } ?>
                                                            </div>
                                                        </div>
                                                        <!-- end foreach  -->
                                                        <div class="err_msg" id="selectShippingAddressErrMsg"></div>
                                                        <!-- ship to new address -->
                                                        <div class="ship_detail newadr" style="top:10px !important;">

                                                            <div class="form-group">
                                                                <div class="chek-form">
                                                                    <div class="custome-checkbox difadre">
                                                                        <span class="d-flex align-items-center create-acc w-100" id="addrCheck"><label data-bs-toggle="collapse" id="cl" data-target="#collapseAddress3" href="#collapseAddress3" aria-controls="collapseAddress3" for="differentaddress"><input type="checkbox" class="newAddrCheck form-label form-check-input " onclick="showDffAddrForm(this)"></label>
                                                                            Deliver to a new address</span>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                            <div id="collapseAddress3" class="different_address collapse in mt-5" style="display: none">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="form-group myaddresstype">
                                                                            <div class="chek-form">
                                                                                <div class="custome-checkbox">
                                                                                    <input class="myckbx custom-radio" type="radio" id="newShippingAddress1" name="newShippingAddressType" value="Home" checked>
                                                                                    <label class="form-check-label" for="type11"><span> Home</span></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="chek-form">
                                                                                <div class="custome-checkbox">
                                                                                    <input class="myckbx custom-radio" type="radio" id="newShippingAddress2" name="newShippingAddressType" value="Office">
                                                                                    <label class="form-check-label" for="type22"><span>
                                                                                            Office</span></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="chek-form">
                                                                                <div class="custome-checkbox">
                                                                                    <input class="myckbx custom-radio" type="radio" id="newDifferentShipping3" name="newShippingAddressType" value="Other">
                                                                                    <label class="form-check-label" for="type33"><span>Other</span></label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="err_msg" id="newShippingAddressTypeErrMsg">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <input type="hidden" name="newShippingAddress" id="newShippingAddress" value="">

                                                                <div class="row mt-4 mb-3">
                                                                    <div class="form-group col-lg-6">
                                                                        <input type="text" class="form-control" placeholder="First name *" name="newShippingAddressFirstName">
                                                                        <div class="err_msg" id="newShippingAddressFirstNameErrMsg"></div>
                                                                    </div>
                                                                    <div class="form-group col-lg-6">
                                                                        <input type="text" class="form-control" placeholder="Last name *" name="newShippingAddressLastName">
                                                                        <div class="err_msg" id="newShippingAddressLastNameErrMsg"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="form-group col-lg-6">
                                                                        <input type="number" placeholder="Mobile Number *" class="no_arrows_numInp phoneInp form-control" pattern="[1-9]{1}[0-9]{9}" title="Please enter exactly 10 digits" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10" name="newShippingAddressPhone">
                                                                        <div class="err_msg" id="newShippingAddressPhoneErrMsg">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group col-lg-6">
                                                                        <input type="text" class="form-control" placeholder="Email Address *" name="newShippingAddressEmail">
                                                                        <div class="err_msg" id="newShippingAddressEmailErrMsg">
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="form-group col-lg-6">
                                                                        <input name="newShippingAddressFlat" class="form-control" placeholder="House number and Flat number *" type="text">
                                                                        <div class="err_msg" id="newShippingAddressFlatErrMsg">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-lg-6">
                                                                        <input name="newShippingAddressStreet" placeholder="Street,Apartment etc *" class="form-control" type="text">
                                                                        <div class="err_msg" id="newShippingAddressStreetErrMsg"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="row mb-3">
                                                                    <div class="form-group col-lg-12">
                                                                        <input name="newShippingAddressLocality" placeholder="" class="form-control" placeholder="Locality, unit etc. (optional)" type="text">
                                                                        <div class="err_msg" id="newShippingAddressLocalityErrMsg"></div>
                                                                    </div>
                                                                </div>

                                                                <div class="row">
                                                                    <div class="form-group col-lg-6">
                                                                        <input type="hidden" value="99" name='newShippingAddressCountry'>
                                                                        <input type="text" value="India" readonly class="form-control">
                                                                        <!-- <select class="form-control" name="newShippingAddressCountry" id="newShippingAddressCountry" onchange="getStates(this.value);">
                                                                                <option value="">Please Select Country</option>
                                                                                <?php
                                                                                foreach ($dashboard->getData('countries', 'id,country_name') as $country) {
                                                                                ?>
                                                                                    <option value="<?= $country['id']; ?>" <?= ($country['country_name'] == 'India') ? 'selected' : ''; ?>>
                                                                                        <?= $country['country_name']; ?></option>
                                                                                <?php } ?>
                                                                            </select> -->
                                                                        <div class="err_msg" id="newShippingAddressCountryErrMsg"></div>
                                                                    </div>

                                                                    <div class="form-group col-lg-6">
                                                                        <select class="form-control" name="newShippingAddressState" id="newShippingAddressState">
                                                                            <option value="">Please Select State</option>
                                                                            <?php
                                                                            foreach ($dashboard->getData('state_list', 'id,state', 'country_id=99') as $state) {
                                                                            ?>
                                                                                <option value="<?= $state['id']; ?>">
                                                                                    <?= $state['state']; ?>
                                                                                </option>
                                                                            <?php } ?>
                                                                        </select>
                                                                        <div class="err_msg" id="newShippingAddressStateErrMsg">
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="form-group col-lg-6">
                                                                        <input name="newShippingAddressCity" type="text" placeholder="City *" class="form-control">
                                                                        <div class="err_msg" id="newShippingAddressCityErrMsg">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group col-lg-6">
                                                                        <input name="newShippingAddressZipCode" placeholder="Postcode / ZIP *" id="newShippingAddressZipCod" type="number" class="form-control" pattern="[1-9]{1}[0-9]{9}" title="Please enter exactly 10 digits" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="6" class="no_arrows_numInp phoneInp">
                                                                        <div class="err_msg" id="newShippingAddressZipCodeErrMsg"></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php } else { ?>

                                                        <div id="newBillingAddress">
                                                            <!-- Multiple Radios (inline) -->
                                                            <input type="hidden" name="newBillingAddress" value="newBillingAddress">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <div class="product-radio">
                                                                        <ul class="product-now">
                                                                            <li>
                                                                                <input type="radio" class="custom-radio" id="newBillingAddress1" name="newBillingAddressType" value="Home">
                                                                                <label for="newBillingAddress1">Home</label>
                                                                            </li>
                                                                            <li>
                                                                                <input type="radio" class="custom-radio" id="newBillingAddress2" name="newBillingAddressType" value="Office">
                                                                                <label for="newBillingAddress2">Office</label>
                                                                            </li>
                                                                            <li>
                                                                                <input type="radio" class="custom-radio" id="newBillingAddress3" name="newBillingAddressType" value="Other">
                                                                                <label for="newBillingAddress3">Other</label>
                                                                            </li>
                                                                            <div class="err_msg" id="newBillingAddressTypeErrMsg"></div>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="ceckout-form">
                                                                <!--Billing Fields Start-->
                                                                <div class="billing-fields">

                                                                    <div class="row">
                                                                        <div class="form-group col-lg-6">
                                                                            <input type="text" class="form-control" placeholder="First name *" name="newBillingAddressFirstName" <?= (USER::isLoggedIn()) ? "value='" . $userData['firstname'] . "' readonly" : ""; ?>>
                                                                            <div class="err_msg" id="newBillingAddressFirstNameErrMsg"></div>
                                                                        </div>
                                                                        <div class="form-group col-lg-6">
                                                                            <input class="form-control" type="text" placeholder="Last name *" name="newBillingAddressLastName" <?= (USER::isLoggedIn()) ? "value='" . $userData['lastname'] . "' readonly" : ""; ?>>
                                                                            <div class="err_msg" id="newBillingAddressLastNameErrMsg"></div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="form-group col-lg-6">
                                                                            <input pattern="[1-9]{1}[0-9]{9}" placeholder="Phone *" title="Please enter exactly 10 digits" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10" class="form-control" name="newBillingAddressPhone" type="text" <?= (USER::isLoggedIn()) ? " value='" . $userData['mobile'] .
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                "' readonly" : ""; ?>>
                                                                            <div class="err_msg" id="newBillingAddressPhoneErrMsg">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-lg-6">
                                                                            <input class="form-control" placeholder="Email Address *" name="newBillingAddressEmail" type="text" <?= (USER::isLoggedIn()) ? "value='" . $userData['email'] .
                                                                                                                                                                                    "' readonly" : ""; ?>>
                                                                            <div class="err_msg" id="newBillingAddressEmailErrMsg">
                                                                            </div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="form-group col-lg-6">
                                                                            <input class="form-control" name="newBillingAddressFlat" placeholder="House number and Flat number " type="text">
                                                                            <div class="err_msg" id="newBillingAddressFlatErrMsg">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-lg-6">
                                                                            <input class="form-control" name="newBillingAddressStreet" placeholder="Street,Apartment etc" type="text">
                                                                            <div class="err_msg" id="newBillingAddressStreetErrMsg">
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="form-group col-lg-6">
                                                                            <input class="form-control" name="newBillingAddressLocality" placeholder="Locality, unit etc. (optional)" type="text">
                                                                            <div class="err_msg" id="newBillingAddressLocalityErrMsg"></div>
                                                                        </div>
                                                                        <div class="form-group col-lg-6">
                                                                            <input name="newBillingAddressCountry" type="hidden" value="99" id="newBillingAddressCountry">
                                                                            <input class="form-control" type="text" readonly value="India">
                                                                            <div class="err_msg" id="newBillingAddressCountryErrMsg"></div>
                                                                        </div>
                                                                    </div>


                                                                    <div class="row">
                                                                        <div class="form-group col-lg-6">
                                                                            <select class="select2drop1 form-control" name="newBillingAddressState" id="newBillingAddressState">
                                                                                <option value="">Please Select State</option>
                                                                                <?php


                                                                                foreach ($dashboard->getData('state_list', 'id,state', 'country_id=99') as $state) {
                                                                                ?>
                                                                                    <option value="<?= $state['id']; ?>">
                                                                                        <?= $state['state']; ?></option>

                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </select>
                                                                            <div class="err_msg" id="newBillingAddressStateErrMsg">
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group col-lg-6">
                                                                            <input name="newBillingAddressZipCode" placeholder="Postcode / ZIP" type="text" class="form-control">
                                                                            <div class="err_msg" id="newBillingAddressZipCodeErrMsg"></div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="form-group col-lg-6 mb-3">
                                                                            <input name="newBillingAddressCity" placeholder="Town / City" type="text" class="form-control">
                                                                            <div class="err_msg" id="newBillingAddressCityErrMsg">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="account-fields">
                                                                <div class="create-acc">
                                                                    <input id="cbox" type="checkbox">
                                                                    <label>Ship to a different address?</label>
                                                                </div>
                                                                <div id="cbox_info" class="create-account" style="display:none;">
                                                                    <div class="coupon-accordion">
                                                                        <!--Accrodion Start-->
                                                                        <!-- <h3><span id="showcoupon">Shipping Details</span></h3> -->
                                                                        <div id="checkout_coupon" class="coupon-content">
                                                                            <!-- <div class="checkout-title">
                                                    <h3>Shipping details</h3>
                                                </div> -->
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <div class="product-radio">
                                                                                        <input type="hidden" name="newDifferentShippingAddress" id="newDifferentShippingAddress">

                                                                                        <ul class="product-now">
                                                                                            <li>
                                                                                                <input type="radio" class="custom-radio" id="newDifferentShipping1" name="newDifferentShippingType" value="Home">
                                                                                                <label for="newDifferentShipping1">Home</label>
                                                                                            </li>
                                                                                            <li>
                                                                                                <input type="radio" class="custom-radio" id="newDifferentShipping2" name="newDifferentShippingType" value="Office">
                                                                                                <label for="newDifferentShipping2">Office</label>
                                                                                            </li>
                                                                                            <li>
                                                                                                <input type="radio" class="custom-radio" id="newDifferentShipping3" name="newDifferentShippingType" value="Other">
                                                                                                <label for="newDifferentShipping3">Other</label>
                                                                                            </li>
                                                                                        </ul>
                                                                                        <div class="err_msg" id="newDifferentShippingTypeErrMsg">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                            <div class="ceckout-form">
                                                                                <div class="billing-fields">

                                                                                    <div class="row">
                                                                                        <div class="form-group col-lg-6">
                                                                                            <input type="text" class="form-control" placeholder="First name *" name="newDifferentShippingFirstName" <?= (USER::isLoggedIn()) ? "value='" .
                                                                                                                                                                                                        $userData['firstname'] . "' readonly" : ""; ?>>
                                                                                            <div class="err_msg" id="newDifferentShippingFirstNameErrMsg">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-lg-6">
                                                                                            <input type="text" class="form-control" placeholder="Last name *" name="newDifferentShippingLastName" <?= (USER::isLoggedIn()) ? "value='" .
                                                                                                                                                                                                        $userData['lastname'] . "' readonly" : ""; ?>>
                                                                                            <div class="err_msg" id="newDifferentShippingLastNameErrMsg">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div class="form-group col-lg-6">
                                                                                            <input class="form-control" placeholder="Phone" pattern="[1-9]{1}[0-9]{9}" title="Please enter exactly 10 digits" onkeydown="return ( event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )" maxlength="10" name="newDifferentShippingPhone" type="text" <?= (USER::isLoggedIn()) ? " value='" .
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                $userData['mobile'] . "' readonly" : ""; ?>>
                                                                                            <div class="err_msg" id="newDifferentShippingPhoneErrMsg">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-lg-6">
                                                                                            <input name="newDifferentShippingEmail" placeholder="Email *" class="form-control" type="text" <?= (USER::isLoggedIn()) ? "value='" .
                                                                                                                                                                                                $userData['email'] . "' readonly" : ""; ?>>
                                                                                            <div class="err_msg" id="newDifferentShippingEmailErrMsg">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div class="row">
                                                                                        <div class="form-group col-lg-6">
                                                                                            <input class="form-control" placeholder="Full address *" name="newDifferentShippingFlat" placeholder="House number and Flat number" type="text">
                                                                                            <div class="err_msg" id="newDifferentShippingFlatErrMsg">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group col-lg-6">
                                                                                            <input class="form-control" placeholder="Street / Apartment *" name="newDifferentShippingStreet" placeholder="Street,Apartment etc" type="text">
                                                                                            <div class="err_msg" id="newDifferentShippingStreetErrMsg">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="row">
                                                                                        <div class="form-group col-lg-6">
                                                                                            <input class="form-control" name="newDifferentShippingLocality" placeholder="Locality, unit etc. (optional)" type="text">
                                                                                            <div class="err_msg" id="newDifferentShippingLocalityErrMsg">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="form-group col-lg-6">
                                                                                            <input type="text" class="form-control" value="India" readonly>
                                                                                            <input class="form-control" name="newDifferentShippingCountry" id="newDifferentShippingCountry" type="hidden">
                                                                                            <div class="err_msg" id="newDifferentShippingCountryErrMsg">
                                                                                            </div>
                                                                                        </div>



                                                                                        <div class="form-group col-lg-6">

                                                                                            <select class="select2drop1" name="newDifferentShippingState" id="newDifferentShippingState">
                                                                                                <option value="">Please Select
                                                                                                    State
                                                                                                </option>
                                                                                                <?php

                                                                                                foreach ($dashboard->getData('state_list', 'id,state', 'country_id=99') as $state) {
                                                                                                ?>
                                                                                                    <option value="<?= $state['id']; ?>">
                                                                                                        <?= $state['state']; ?>
                                                                                                    </option>

                                                                                                <?php
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                            <div class="err_msg" id="newDifferentShippingStateErrMsg">
                                                                                            </div>

                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="row">
                                                                                        <div class="form-group col-lg-6">
                                                                                            <input name="newDifferentShippingZipCode" placeholder="Postcode / ZIP *" type="text" class="form-control">
                                                                                            <div class="err_msg" id="newDifferentShippingZipCodeErrMsg">
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="form-group col-lg-6">
                                                                                            <input class="form-control" name="newDifferentShippingCity" placeholder="City *" type="text">
                                                                                            <div class="err_msg" id="newDifferentShippingCityErrMsg">
                                                                                            </div>
                                                                                        </div>

                                                                                    </div>


                                                                                </div>
                                                                            </div>
                                                                            <!--Accrodion End-->
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                    <?php }
                                                } ?>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <?php
            $items = $cart->cartDetail();
            if (isset($items['cartEmpty'])) {
            ?>
                <script>
                    window.location.href = "./index.php";
                </script>
                <?php
                header("Location: ./index.php");
                exit();
                ?>
            <?php } else { ?>
                <div class="col-lg-4 checkoutPage">
                    <div class="innerCheckoutPage">
                        <div class=" position-relative mb-3 p-2">
                            <form id="coupanForm">
                                <input type="hidden" id="couponAmount" name="couponAmount">
                                <div class="form-group couponInp d-flex">
                                    <input type="hidden" value="<?= $cart->cartSubTotalAmount(); ?>" name="orderPrice">
                                    <input type="text" name="coupanCode" class="form-control hny coupanCodeInput" placeholder="Enter Coupon Code" required>
                                    <button class="btn hny" id="coupanCodeButton" type="submit"><i class="icofont-sale-discount"></i> APPLY</button>
                                </div>
                                <div id="ErrMsg" class="text-left prmcode"></div>
                            </form>
                        </div>
                        <div class="fixed-sidebar">
                            <form id="placeOrder">
                                <div class="bg-white cart-box position-relative mb-3">
                                    <div class="mb-3 border-bottom">
                                        <h5 class="mb-0 fw-bold">Your Cart</h5>
                                        <p class="small mb-0">Your ordered items from <span class="text-success">MSG</span></p>
                                    </div>
                                    <div class="py-2 ckout_cart">

                                        <?php foreach ($items as $item) {
                                            if (strlen($item['product_name']) > 40) {
                                                $item['product_name'] = substr($item['product_name'], 0, 40) . '... ';
                                            } ?>
                                            <div class="cart-box-item d-flex align-items-center cartitemdiv justify-content-between">
                                                <div class="cart-box-item-title ms-3">
                                                    <div class="pro-img">
                                                        <img src="asset/image/product/<?= $item['image']; ?>" class="img-fluid  checkout-image rounded-1" alt="Checkout" width="60px">
                                                    </div>
                                                    <div class="success-dot"></div>
                                                    <p class="mb-0 text-capitalize"><?= $item['product_name']; ?> </p>
                                                    <?php
                                                    $isdeal = $homePage->isDealByProduct($item['id']);
                                                    if (!empty($isdeal)) {
                                                        if ($isdeal[0]['stock'] != 0) {
                                                            $price = $isdeal[0]['price'];
                                                        } else {
                                                            if (($item['price'] == $item['discount']) || ($item['discount'] == 0)) {
                                                                $price = $item['price'];
                                                            } else {
                                                                $price = $item['discount'];
                                                            }
                                                        }
                                                    } else {
                                                        if (($item['price'] == $item['discount']) || ($item['discount'] == 0)) {
                                                            $price = $item['price'];
                                                        } else {
                                                            $price = $item['discount'];
                                                        }
                                                    }
                                                    ?>


                                                    <?php
                                                     $taxValue = !empty($item['tax']) ? $item['tax'] : '0';
                                                    $totalPriceProduct = $price * $item['quantity'];
                                                    $totalPriceProductTAX = $totalPriceProduct / 100;
                                                    $totalPriceProductTAX = $totalPriceProductTAX * $taxValue;
                                                    $total_TAX += $totalPriceProductTAX;
                                                    ?>
                                                    <p class="hny_p"> <?= $price . ' x ' . $item['quantity']; ?></p>

                                                </div>

                                                <div class="cart-box-item-price text-end ms-auto">
                                                    <div><?= $currency; ?><?= ($price * $item['quantity']); ?></div>
                                                </div>
                                            </div>

                                        <?php } ?>

                                    </div>
                                </div>

                                <div class=" position-relative overflow-hidden mb-3">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item ">
                                            <div class="odr-summry">
                                                <h5 class="accordion-header mb-0" id="headingOne">Order Summary</h5>
                                                <p class="mb-1">Here is your Order Summary</p>
                                            </div>
                                            <div id="collapseOne" class="accordion-collapse collapse text-dark show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body pb-3 pt-3 cartitemdiv">
                                                    <div class="d-flex justify-content-between align-items-center pb-1">
                                                        <div class="text-muted fw-bold">Sub-total</div>
                                                        <div class="text-dark"><?= $currency; ?>
                                                            <?= $cart->cartSubTotalAmount(); ?></div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center py-1 text-warning" id="coupanAppliedDiv" style="display:none !important;">
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center py-1">
                                                        <div class="text-muted">Shipping fee&nbsp;<span><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Free shipping covers all delivery charges such as delivery fee" class="bi bi-info-circle text-muted small"></i></span></div>
                                                        <div class="text-muted"> <?= $currency; ?> 100</div>
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center py-1">
                                                        <div class="text-muted fw-bold">Tax&nbsp;<span><i data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Tax applied on product" class="bi bi-info-circle text-muted small"></i></span>
                                                        </div>
                                                        <div class="text-dark"><?= $currency; ?> <span id="CheckoutTaxSection"><?= $total_TAX ?></span></div>
                                                    </div>
                                                    <div class="d-flex justify-content-between align-items-center pt-1">
                                                        <div class="fw-bold">Total Amount</div>
                                                        <div class="fw-bold" id="totalAmount">
                                                            <?= $currency; ?><?= ($cart->cartTotalAmount() + $total_TAX + 100) ?? 0; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- <div class="bg-warning text-white px-3 py-2">
                                                    <span><i class="bi bi-check-circle-fill text-white"></i></span>&nbsp; Thanks! for shopping, now proceed to place order
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class=" position-relative overflow-hidden">
                                <div class="accordion" id="accordionExample2">
                                    <div class="accordion-item ">
                                        <div class="payment-title-sec">
                                            <h5 class="accordion-header mb-0" id="headingOne">Payment Method</h5>
                                            <p class="mb-0">Select any Payment method</p>
                                        </div>
                                        <div id="collapseOne2" class="accordion-collapse collapse text-dark show" aria-labelledby="headingOne" data-bs-parent="#accordionExample2">
                                            <div class="accordion-body pb-3 pt-3">
                                                <form id="pymentMethodForm">
                                                    <input type="hidden" name="paymentMethod" value="" id="paymentMethodInp">
                                                    <input type="hidden" name='shippingFee' value='100' id='shippingFeeInp'>
                                                    <div class="">
                                                        <?php
                                                        //Check is cod available
                                                        $items = $cart->codStatus();
                                                        ?>
                                                        <label for="paymentmethod2" class="payment_bg">
                                                            <div class="paytype">
                                                                <input id="paymentmethod2" class="input-radio form-check-input custom-radio" name="paymentmethod" type="radio" value="razorpay">
                                                                <div class="d-flex align-items-center ml-2">
                                                                    <h6 class="hny_payc onlineTxt">Online</h6>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <label for="paymentmethod1" class="payment_bg">
                                                            <div class="paytype codchck">
                                                                <input id="paymentmethod1" <?= ($items != NULL) ? 'disabled' : ''; ?> class="input-radio form-check-input custom-radio" name="paymentmethod" type="radio" value="cashondelivery">
                                                                <div class="d-flex align-items-center ml-2">
                                                                    <h6 class="hny_payc codText">Cash On Delivery</h6>
                                                                </div>
                                                            </div>
                                                        </label>
                                                        <label for="paymentmethod3" id="pACSelect" class="payment_bg" style="display:none;">
                                                            <div class="rounded paytype codchck">
                                                                <input id="paymentmethod3" class="input-radio form-check-input custom-radio" name="paymentmethod" type="radio" value="payagainstcoupon">
                                                                <div class="d-flex align-items-center gap-3 border-bottom p-3">
                                                                    <h6 class="hny_payc">Pay Against Coupon</h6>
                                                                </div>
                                                            </div>
                                                        </label>

                                                        <?php
                                                        if (isset($_SESSION['loginid'])) {
                                                            $loginId = $_SESSION['loginid'];
                                                            $query = "SELECT * FROM user WHERE id = '$loginId' AND role = 'agent'";
                                                            $result = mysqli_query($con, $query);

                                                            if ($result && mysqli_num_rows($result) > 0) {
                                                        ?>
                                                                <label for="paymentmethod3" class="payment_bg">
                                                                    <div class="paytype codchck">
                                                                        <input id="paymentmethod4" class="input-radio form-check-input custom-radio" name="paymentmethod" type="radio" value="wallet">
                                                                        <div class="d-flex align-items-center ml-2">
                                                                            <h6 class="hny_payc">Pay With Wallet</h6>
                                                                        </div>
                                                                    </div>
                                                                </label>
                                                        <?php
                                                            }
                                                        }
                                                        ?>


                                                        <div class="col-md-12">
                                                            <div class="notincod">
                                                                <?php if ($items != NULL) { ?>
                                                                    <p class="mt-2">Note: COD is not available on: <br>
                                                                        <?php foreach ($items as $item) {
                                                                            $symbol = mysqli_fetch_assoc(mysqli_query($con, "SELECT sc.name FROM size_class sc, products p where sc.id = p.class0 AND p.id ='" . $item['id'] . "'"))['name'];
                                                                            echo "<span> " . $item['product_name'] . " (" . $symbol . ")</span> <br>";
                                                                        } ?></span>
                                                                    </p>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Current Wallet Balance Section-->
                            <div class=" position-relative overflow-hidden">
                                <div class="accordion" id="accordionExample2">
                                    <div class="accordion-item ">
                                        <div class="payment-title-sec">
                                            <?php
                                            if (isset($_SESSION['loginid'])) {
                                                $loginId = $_SESSION['loginid'];
                                                $query = "SELECT * FROM user WHERE id = '$loginId' AND role = 'agent'";
                                                $result = mysqli_query($con, $query);

                                                if ($result && mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $agent_id = $row['agt_id'];
                                                    $query2 = "SELECT * FROM agents WHERE id = '$agent_id'";
                                                    $result2 = mysqli_query($con, $query2);
                                                    $row2 = mysqli_fetch_assoc($result2);
                                            ?>
                                                    <h5 class="accordion-header mb-0" id="headingOne">Current Wallet Balance</h5>

                                                    <p class="mb-0"><?= $row2['balance']; ?></p>
                                        </div>
                                <?php
                                                }
                                            }
                                ?>
                                    </div>
                                </div>
                            </div>
                            <!-- Current Wallet Balance Section ends-->
                            <!-- Agent  Reward Section-->
                            
                            <?php 
                                $loginId = $_SESSION['loginid'];
                                $query_role = "SELECT role FROM user WHERE id = '$loginId'";
                                $result_role = mysqli_query($con, $query_role);
                                $role = mysqli_fetch_assoc($result_role)['role'];
                            ?>
                            <?php if($role == 'agent'){ ?>
                                <!--<div class=" position-relative overflow-hidden pt-2">
                                    <div class="accordion" id="accordionExample2">
                                        <div class="accordion-item ">
                                            <div class="payment-title-sec">
                                                
                                                        <h5 class="accordion-header mb-0" id="headingOne">Reward Points You will Receive</h5>
                                                        
                                                        <?php
                                                            $orderprice = $cart->cartSubTotalAmount();;
                                                            $rewardsPrice = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM admin_rewards WHERE id = 1"))['min_amt'];
                                                            $rewardsPercent = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM admin_rewards WHERE id = 1"))['percent'];
                                                            $totalRewards = 0;
                                                            
                                                            if($orderprice >= $rewardsPrice){
                                                                $totalRewards = $orderprice * ($rewardsPercent/100);
                                                            }
                                                        ?>
                                                        <p class="mb-0" style="color:green; font-weight:700;"><?= $totalRewards ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>-->
                            <?php } ?>
                            <!-- Agent  Reward Section ends-->
                            <div id="d-grid">
                                <?php
                                if (!USER::isLoggedIn()) {
                                ?>

                                    <button id="loginbtnmdl" data-bs-toggle='modal' data-bs-target='#modal-checkout' data-bs-whatever='@mdo' type='button' class="order-loog btn btn-primary btn-rounded btn-icon-right mt-3 w-100">Place Order</button>
                                <?php } else { ?>

                                    <button id="btn54" type='button' class="btn btn-primary btn-rounded btn-icon-right mt-3 w-100">Place Order</button>
                                    <button id="paySubmitButton" type='button' class="d-none">Place Order</button>
                                <?php } ?>
                            </div>

                            <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="confirmationModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="confirmationModalLabel">PLACE ORDER</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="closebtns">X</button>

                                        </div>
                                        <div class="modal-body">
                                            <h2>The Coupon is not applied in<span style="color: red;"> Cash On Delivery</span></h2>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="closebtns">Cancel</button>

                                            <button id="confirmOrderButton" type="button" class="btn btn-primary">Confirm</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            <?php } ?>
        </div>
</section>

<?php include('include/footer.php') ?>

<script>
    $(document).ready(function() {
        $(document).on("click", "#loginbtnmdl", function() {
            // checkoutsec
            $("html, body").delay(80).animate({
                scrollTop: $('.main').offset().top - 80
            }, 80);

            $('#showlogin').click()
            $("#checkout-login").addClass("show");
        });
    });
</script>

<script>
    //     $(".different_address").hide();
    //   $(document).on('click' , 'newAddrCheck', function() {
    //       console.log('clicked')

    //     if($(this).is(":checked")) {
    //         $(".different_address").show();

    //     } else {
    //         $(".different_address").hide();
    //     }
    //       var radios = document.getElementsByName('shipad');

    //     radios.forEach(element => {
    //         element.checked = false
    //     });
    // });

    function showDffAddrForm(elem) {

        if ($(elem).prop("checked") == true) {
            $(".different_address").show();
            $('#newShippingAddress').val('newShippingAddress');

        } else {
            $(".different_address").hide();
            $('#newShippingAddress').val('');
        }
        var radios = document.querySelectorAll('.shipad');

        radios.forEach(element => {
            element.checked = false
        });
    }
</script>

<script>
    $('.panel-collapse').hide();
    $(document).ready(function() {
        $('#loginbtnmdl').click(function() {
            $('.panel-collapse').toggle();
        });
        $('#cllick-to').click(function() {
            $('.panel-collapse').toggle();
        });
        $('.order-loog').click(function() {
            $('.panel-collapse').toggle();
        });

    });
</script>
<script>
    function scrollToTop() {
        Swal.fire({
            title: 'Sign in',
            html: "To complete your shopping checkout, please log in to your account. Logging in is necessary to proceed with your purchase.",
            showCancelButton: true,
            type: 'warning',
            icon: "warning",
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            showCancelButton: false,
            confirmButtonText: 'OK'
        }).then((result) => {
            if (result.isConfirmed) {
                // $('#checkout-login').scrollToCenter();
            }
        });
    }
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

    var checkbox = document.getElementById('buyAsGuestCheck');
    $(document).on('change', '#buyAsGuestCheck', function() {
        if ($(this).is(':checked')) {
            $('#buyAsGuest').val(true);
            $('#loginbtnmdl').hide();
            // $('#paySubmitButton').show();
            $('#buttonDiv').append(
                "<button id='paySubmitButton' onclick='clickPaybutton()' type='button' class='btn btn-sqr btn-md w-100 mt-4 fw-bold'>Place Order</button>"
            )
            <?php $buyAsGuest = true; ?>
        } else {
            $('#loginbtnmdl').show()
            $('#buyAsGuest').val(false)
            // $('#paySubmitButton').hide();
            $("#paySubmitButton").remove();

            <?php $buyAsGuest = false; ?>
        }
    });

    $('#cbox_info').hide();
    var cbox = document.getElementById('cbox');
    $(document).on('change', '#cbox', function() {

        if ($(this).is(':checked')) {
            $('#cbox_info').show();
            $('#newDifferentShippingAddress').val('newDifferentShippingAddress');

        } else {
            $('#cbox_info').hide();
            $('#newDifferentShippingAddress').val('');
        }
    });

    function disabledeliver() {

        if ($('#cl').attr('aria-expanded') == 'true') {
            $('#newShippingAddress').val('newShippingAddress');

        } else {
            $('#newShippingAddress').val('');

        }
    }
</script>


<script type="text/javascript">
    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        var x = document.getElementById("logInPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    });

    $(".toggle-passwordtwo").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        var x = document.getElementById("userPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    });

    function registerNow() {
        $('#checkout_login').hide();
        $('#checkout_signup').show();
        // $('#loginArea').click();
        // $('#loginAreaAccordion').click();

        // $('#signUpArea').hide();
    }

    function logInNow() {
        $('#checkout_login').show();
        $('#checkout_signup').hide();
    }


    function checkIfSelected() {
        var radioButtons = document.getElementsByName("newBillingAddressType");
        var isSelected = false;
        for (var i = 0; i < radioButtons.length; i++) {
            if (radioButtons[i].checked) {
                isSelected = true;
                break;
            }
        }
        if (isSelected) {
            return true;
        } else {
            return false;
        }
    }
    $(document).ready(function() {
        if (checkIfSelected() == false) {
            var newBillingAddress1Element = document.getElementById('newBillingAddress1');
            if (newBillingAddress1Element != null) {
                newBillingAddress1Element.checked = true;
            }
        }
    });
</script>
<script>
    $('#paymentmethod2').on('click', function() {
        console.log('fasdrg')
    })
</script>
<script>
    document.getElementById("agent-register").addEventListener("click", function() {
        Swal.fire({
            title: 'Proceed to agent login?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Proceed',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = 'agent-account.php'; // Redirect to agent login page
            }
        });
    });
</script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>