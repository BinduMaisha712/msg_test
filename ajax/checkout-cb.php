<?php

require('../config.php');
$checkout = new Checkout($con);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
error_reporting(E_ALL);
$data = array();
$errMessage = array();
$dashboard = new Dashboard($con);

// }

// exit();
if (isset($_SESSION['loginid'])) {
    $loginId = $_SESSION['loginid'];
} else {
    $loginId = 0;
}
date_default_timezone_set('Asia/Kolkata');
$date = date("Y-m-d");
$time = date('H:i:s');
$timeStamp = date("Y-m-d h:i:s");

$orderPlaced = false;
$checkOutStatus = false;
$placeOrder = false;
// print_r($_POST);

if (isset($_POST['paymentmethod'])) {
    ////////// New Billing Address Form //////////
    if (isset($_POST['newBillingAddress'])) {
        if (!isset($_POST['newBillingAddressType'])) {
            $errMessage['newBillingAddressType'] = 'Please Select address Type';
        } else {
            $billingAddressType =  $_POST['newBillingAddressType'];
        }

        if (($_POST['newBillingAddressFirstName'] == "") || ($_POST['newBillingAddressFirstName'] == null)) {
            $errMessage['newBillingAddressFirstName'] = 'Field Required';
        } else {
            $billingAddressFirstName =  $_POST['newBillingAddressFirstName'];
        }

        if (($_POST['newBillingAddressLastName'] == "") || ($_POST['newBillingAddressLastName'] == null)) {
            $errMessage['newBillingAddressLastName'] = 'Field Required';
        } else {
            $billingAddressLastName =  $_POST['newBillingAddressLastName'];
        }

        if (($_POST['newBillingAddressCountry'] == "") || ($_POST['newBillingAddressCountry'] == null)) {
            $errMessage['newBillingAddressCountry'] = 'Field Required';
        } else {
            $billingAddressCountry =  $_POST['newBillingAddressCountry'];
        }

        if (($_POST['newBillingAddressFlat'] == "") || ($_POST['newBillingAddressFlat'] == null)) {
            $errMessage['newBillingAddressFlat'] = 'Field Required';
        } else {
            $billingAddressFlat =  $_POST['newBillingAddressFlat'];
        }

        if (($_POST['newBillingAddressStreet'] == "") || ($_POST['newBillingAddressStreet'] == null)) {
            $errMessage['newBillingAddressStreet'] = 'Field Required';
        } else {
            $billingAddressStreet =  $_POST['newBillingAddressStreet'];
        }

        $billingAddressLocality =  $_POST['newBillingAddressLocality'];

        if (($_POST['newBillingAddressCity'] == "") || ($_POST['newBillingAddressCity'] == null)) {
            $errMessage['newBillingAddressCity'] = 'Field Required';
        } else {
            $billingAddressCity =  $_POST['newBillingAddressCity'];
        }

        if (($_POST['newBillingAddressZipCode'] == "") || ($_POST['newBillingAddressZipCode'] == null)) {
            $errMessage['newBillingAddressZipCode'] = 'Field Required';
        } else {

            if (!preg_match('/^[0-9]+$/', $_POST['newBillingAddressZipCode'])) {
                $errMessage['newBillingAddressZipCode'] = 'Only Number Allowed';
            } else {
                $billingAddressZipCode =  $_POST['newBillingAddressZipCode'];
            }
        }

        if (($_POST['newBillingAddressState'] == "") || ($_POST['newBillingAddressState'] == null)) {
            $errMessage['newBillingAddressState'] = 'Field Required';
        } else {
            $billingAddressState =  $_POST['newBillingAddressState'];
        }

        if (($_POST['newBillingAddressPhone'] == "") || ($_POST['newBillingAddressPhone'] == null)) {
            $errMessage['newBillingAddressPhone'] = 'Field Required';
        } else {

            if (!preg_match('/^[0-9+]+$/', $_POST['newBillingAddressPhone'])) {
                $errMessage['newBillingAddressPhone'] = 'Mobile format invalid.';
            } else {
                $billingAddressPhone =  $_POST['newBillingAddressPhone'];
            }
        }

        if (($_POST['newBillingAddressEmail'] == "") || ($_POST['newBillingAddressEmail'] == null)) {
            $errMessage['newBillingAddressEmail'] = 'Field Required';
        } else {

            if (!filter_var($_POST['newBillingAddressEmail'], FILTER_VALIDATE_EMAIL)) {
                $errMessage['newBillingAddressEmail'] = 'Email format invalid.';
            } else {
                $billingAddressEmail =  $_POST['newBillingAddressEmail'];
            }
        }

        if (empty($errMessage)) {
            $tempArr = array(
                "user_id" => $loginId,
                "first_name" => $billingAddressFirstName,
                "last_name" => $billingAddressLastName,
                "flat" => $billingAddressFlat,
                "street" => $billingAddressStreet,
                "locality" => $billingAddressLocality,
                "city" => $billingAddressCity,
                "zip_code" => $billingAddressZipCode,
                "state" => $billingAddressState,
                "country" => $billingAddressCountry,
                "email" => $billingAddressEmail,
                "phone" => $billingAddressPhone,
                "addr_type" => $billingAddressType
            );
            $isAddress = $dashboard->isAddr($tempArr);
            if (!empty($isAddress['first_name'])) {
                $tempArr = array(
                    "id" => $isAddress['id'],
                    "user_id" => $loginId,
                    "first_name" => $billingAddressFirstName,
                    "last_name" => $billingAddressLastName,
                    "flat" => $billingAddressFlat,
                    "street" => $billingAddressStreet,
                    "locality" => $billingAddressLocality,
                    "city" => $billingAddressCity,
                    "zip_code" => $billingAddressZipCode,
                    "state" => $billingAddressState,
                    "country" => $billingAddressCountry,
                    "email" => $billingAddressEmail,
                    "phone" => $billingAddressPhone,
                    "addr_type" => $billingAddressType
                );
            }


            $checkout->forcedInsert('user_shipping_addresses', $tempArr); ///// Insert shiping_address table Data
        }


        if ((isset($_POST['newDifferentShippingAddress'])) && ($_POST['newDifferentShippingAddress'] == 'newDifferentShippingAddress')) {
            ////////// New Different Shipping Address Form //////////
            if (!isset($_POST['newDifferentShippingType'])) {
                $errMessage['newDifferentShippingType'] = 'Please Select address Type';
            } else {
                $shippingType =  $_POST['newDifferentShippingType'];
            }

            if (($_POST['newDifferentShippingFirstName'] == "") || ($_POST['newDifferentShippingFirstName'] == null)) {
                $errMessage['newDifferentShippingFirstName'] = 'Field Required';
            } else {
                $shippingFirstName =  $_POST['newDifferentShippingFirstName'];
            }

            if (($_POST['newDifferentShippingLastName'] == "") || ($_POST['newDifferentShippingLastName'] == null)) {
                $errMessage['newDifferentShippingLastName'] = 'Field Required';
            } else {
                $shippingLastName =  $_POST['newDifferentShippingLastName'];
            }

            if (($_POST['newDifferentShippingCountry'] == "") || ($_POST['newDifferentShippingCountry'] == null)) {
                $errMessage['newDifferentShippingCountry'] = 'Field Required';
            } else {
                $shippingCountry =  $_POST['newDifferentShippingCountry'];
            }

            if (($_POST['newDifferentShippingFlat'] == "") || ($_POST['newDifferentShippingFlat'] == null)) {
                $errMessage['newDifferentShippingFlat'] = 'Field Required';
            } else {
                $shippingFlat =  $_POST['newDifferentShippingFlat'];
            }

            if (($_POST['newDifferentShippingStreet'] == "") || ($_POST['newDifferentShippingStreet'] == null)) {
                $errMessage['newDifferentShippingStreet'] = 'Field Required';
            } else {
                $shippingStreet =  $_POST['newDifferentShippingStreet'];
            }

            $shippingLocality =  $_POST['newDifferentShippingLocality'];

            if (($_POST['newDifferentShippingCity'] == "") || ($_POST['newDifferentShippingCity'] == null)) {
                $errMessage['newDifferentShippingCity'] = 'Field Required';
            } else {
                $shippingCity =  $_POST['newDifferentShippingCity'];
            }

            if (($_POST['newDifferentShippingZipCode'] == "") || ($_POST['newDifferentShippingZipCode'] == null)) {
                $errMessage['newDifferentShippingZipCode'] = 'Field Required';
            } else {
                $shippingZipCode =  $_POST['newDifferentShippingZipCode'];
            }

            if (($_POST['newDifferentShippingState'] == "") || ($_POST['newDifferentShippingState'] == null)) {
                $errMessage['newDifferentShippingState'] = 'Field Required';
            } else {
                $shippingState =  $_POST['newDifferentShippingState'];
            }

            if (($_POST['newDifferentShippingPhone'] == "") || ($_POST['newDifferentShippingPhone'] == null)) {
                $errMessage['newDifferentShippingPhone'] = 'Field Required';
            } else {
                $shippingPhone =  $_POST['newDifferentShippingPhone'];
            }

            if (($_POST['newDifferentShippingEmail'] == "") || ($_POST['newDifferentShippingEmail'] == null)) {
                $errMessage['newDifferentShippingEmail'] = 'Field Required';
            } else {
                $shippingEmail =  $_POST['newDifferentShippingEmail'];
            }
            ////////// New Different Shipping Address Form //////////

            if (empty($errMessage)) {
                $tempArr = array(
                    "user_id" => $loginId,
                    "first_name" => $shippingFirstName,
                    "last_name" => $shippingLastName,
                    "flat" => $shippingFlat,
                    "street" => $shippingStreet,
                    "locality" => $shippingLocality,
                    "country" => $shippingCountry,
                    "city" => $shippingCity,
                    "state" => $shippingState,
                    "zip_code" => $shippingZipCode,
                    "email" => $shippingEmail,
                    "phone" => $shippingPhone,
                    "addr_type" => $shippingType
                );
                $isAddress = $dashboard->isAddr($tempArr);
                if (!empty($isAddress['first_name'])) {
                    $tempArr = array(
                        "id" => $isAddress,
                        "user_id" => $loginId,
                        "first_name" => $shippingFirstName,
                        "last_name" => $shippingLastName,
                        "flat" => $shippingFlat,
                        "street" => $shippingStreet,
                        "locality" => $shippingLocality,
                        "country" => $shippingCountry,
                        "city" => $shippingCity,
                        "state" => $shippingState,
                        "zip_code" => $shippingZipCode,
                        "email" => $shippingEmail,
                        "phone" => $shippingPhone,
                        "addr_type" => $shippingType
                    );
                }
                $checkout->forcedInsert('user_shipping_addresses', $tempArr); ///// Insert shiping_address table Data
            }
        } else { ////// else Shiping Address as New Billing Address Start
            $shippingType =  (isset($_POST['newBillingAddressType'])) ? $_POST['newBillingAddressType'] : "";
            $shippingFirstName =  $_POST['newBillingAddressFirstName'];
            $shippingLastName =  $_POST['newBillingAddressLastName'];
            $shippingCountry =  $_POST['newBillingAddressCountry'];
            $shippingFlat =  $_POST['newBillingAddressFlat'];
            $shippingStreet =  $_POST['newBillingAddressStreet'];
            $shippingLocality =  $_POST['newBillingAddressLocality'];
            $shippingCity =  $_POST['newBillingAddressCity'];
            $shippingZipCode =  $_POST['newBillingAddressZipCode'];
            $shippingState =  $_POST['newBillingAddressState'];
            $shippingPhone =  $_POST['newBillingAddressPhone'];
            $shippingEmail =  $_POST['newBillingAddressEmail'];
        } ////// else Shiping Address as New Billing Address END
    } ////// newBillingAddressType if END
    ////////// New Billing Address Form //////////

    if ((isset($_POST['newShippingAddress'])) && ($_POST['newShippingAddress'] == 'newShippingAddress')) {
        ////////// New Different Shipping Address Form //////////
        if (!isset($_POST['newShippingAddressType'])) {
            $errMessage['newShippingAddressType'] = 'Please Select address Type';
        } else {
            $shippingType =  $_POST['newShippingAddressType'];
        }

        if (($_POST['newShippingAddressFirstName'] == "") || ($_POST['newShippingAddressFirstName'] == null)) {
            $errMessage['newShippingAddressFirstName'] = 'Field Required';
        } else {
            $shippingFirstName =  $_POST['newShippingAddressFirstName'];
        }

        if (($_POST['newShippingAddressLastName'] == "") || ($_POST['newShippingAddressLastName'] == null)) {
            $errMessage['newShippingAddressLastName'] = 'Field Required';
        } else {
            $shippingLastName =  $_POST['newShippingAddressLastName'];
        }

        if (!isset($_POST['newShippingAddressCountry']) || empty($_POST['newShippingAddressCountry'])) {
            $errMessage['newShippingAddressCountry'] = 'Field Required';
        } else {
            $shippingCountry =  $_POST['newShippingAddressCountry'];
        }

        if (($_POST['newShippingAddressFlat'] == "") || ($_POST['newShippingAddressFlat'] == null)) {
            $errMessage['newShippingAddressFlat'] = 'Field Required';
        } else {
            $shippingFlat =  $_POST['newShippingAddressFlat'];
        }

        if (($_POST['newShippingAddressStreet'] == "") || ($_POST['newShippingAddressStreet'] == null)) {
            $errMessage['newShippingAddressStreet'] = 'Field Required';
        } else {
            $shippingStreet =  $_POST['newShippingAddressStreet'];
        }

        $shippingLocality =  $_POST['newShippingAddressLocality'];

        if (($_POST['newShippingAddressCity'] == "") || ($_POST['newShippingAddressCity'] == null)) {
            $errMessage['newShippingAddressCity'] = 'Field Required';
        } else {
            $shippingCity =  $_POST['newShippingAddressCity'];
        }

        if (($_POST['newShippingAddressZipCode'] == "") || ($_POST['newShippingAddressZipCode'] == null)) {
            $errMessage['newShippingAddressZipCode'] = 'Field Required';
        } else {
            $shippingZipCode =  $_POST['newShippingAddressZipCode'];
        }

        if (($_POST['newShippingAddressState'] == "") || ($_POST['newShippingAddressState'] == null)) {
            $errMessage['newShippingAddressState'] = 'Field Required';
        } else {
            $shippingState =  $_POST['newShippingAddressState'];
        }

        if (($_POST['newShippingAddressPhone'] == "") || ($_POST['newShippingAddressPhone'] == null)) {
            $errMessage['newShippingAddressPhone'] = 'Field Required';
        } else {
            $shippingPhone =  $_POST['newShippingAddressPhone'];
        }

        if (($_POST['newShippingAddressEmail'] == "") || ($_POST['newShippingAddressEmail'] == null)) {
            $errMessage['newShippingAddressEmail'] = 'Field Required';
        } else {
            $shippingEmail =  $_POST['newShippingAddressEmail'];
        }
        ////////// New Different Shipping Address Form //////////


        if (empty($errMessage)) {
            $tempArr = array(
                "user_id" => $loginId,
                "first_name" => $shippingFirstName,
                "last_name" => $shippingLastName,
                "flat" => $shippingFlat,
                "street" => $shippingStreet,
                "locality" => $shippingLocality,
                "country" => $shippingCountry,
                "city" => $shippingCity,
                "state" => $shippingState,
                "zip_code" => $shippingZipCode,
                "email" => $shippingEmail,
                "phone" => $shippingPhone,
                "addr_type" => $shippingType
            );
            $isAddress = $dashboard->isAddr($tempArr);
            if (!empty($isAddress['first_name'])) {
                $tempArr = array(
                    "id" => $isAddress,
                    "user_id" => $loginId,
                    "first_name" => $shippingFirstName,
                    "last_name" => $shippingLastName,
                    "flat" => $shippingFlat,
                    "street" => $shippingStreet,
                    "locality" => $shippingLocality,
                    "country" => $shippingCountry,
                    "city" => $shippingCity,
                    "state" => $shippingState,
                    "zip_code" => $shippingZipCode,
                    "email" => $shippingEmail,
                    "phone" => $shippingPhone,
                    "addr_type" => $shippingType
                );
            }
            $checkout->forcedInsert('user_shipping_addresses', $tempArr); ///// Insert shiping_address table Data
        }
    } else {
        if (isset($_POST['selectShippingAddress'])) {
            if (isset($_POST['shippingAddress'])) {
                $shippingAddress = $checkout->shippingAddressById($_POST['shippingAddress']);

                $shippingType =  $shippingAddress['addr_type'];
                $shippingFirstName =  $shippingAddress['first_name'];
                $shippingLastName =  $shippingAddress['last_name'];
                $shippingCountry =  $shippingAddress['country'];
                $shippingFlat =  $shippingAddress['flat'];
                $shippingStreet =  $shippingAddress['street'];
                $shippingLocality =  $shippingAddress['locality'];
                $shippingCity =  $shippingAddress['city'];
                $shippingZipCode =  $shippingAddress['zip_code'];
                $shippingState =  $shippingAddress['state'];
                $shippingPhone =  $shippingAddress['phone'];
                $shippingEmail =  $shippingAddress['email'];
            } else {
                $errMessage['selectShippingAddress'] = 'Please Select Shipping Address';
            }
        }
    }

    $orderId = $checkout->generateOrderId();

    // print_r($errMessage);
    // exit();
    if (empty($errMessage)) {

        $itemOutofstock = 0;
        $OOSItemsIds = [];
        $oosCount = 0;
        


        foreach ($checkout->cartDetail() as $item) {
            if (($item['stock'] !== 'Yes')  || $item['minimum'] > $item['in_stock']) {

                $html = '';
                $itemId = $item['id'];
                $itemOutofstock++;
                array_push($OOSItemsIds, $item['id']);

                if (isset($_SESSION['loginid'])) {

                    $loginId = $_SESSION['loginid'];

                    // $deleteFromCart = mysqli_query($con, "DELETE FROM add_cart WHERE pid = '$itemId' AND user_id = '$loginId'");
                } else {
                    $key = array_search($item['id'], $_SESSION['products']['id']);

                    // remove unavailable items from cart (from session)
                    // unset($_SESSION['products']['id'][$key]);
                }

                foreach ($OOSItemsIds as $id) {
                    // $allIds .= $id . ",";

                    $product = mysqli_fetch_assoc(mysqli_query($con, "SELECT p.*, i.image FROM products p, image i WHERE p.id = $id AND p.product_code = i.p_id;"));
                    $html .= '<div> <img src = "asset/image/product/' . $product['image'] . '"> ' . $product['product_name'] . '</div>';
                }
                $oosCount ++;
                $data['leftItem'] = $cart->totalItemInCart() - $oosCount;
                $data['oostatus'] = "outOfStock";
                $data['html'] = $html;
                
            } else {
                $data['oostatus'] = "";
            }
        }



        if ($data['oostatus'] == '') {        ///////// Apply Coupon code conditions /////////
            if ((isset($_POST['coupanCode'])) && ($_POST['coupanCode'] != '') && $_POST['paymentmethod']!='cashondelivery') {
                $coupanCode = $_POST['coupanCode'];
                $checkout->setCoupan($_POST['coupanCode']);
                $coupanData = $checkout->coupan();

                if ($coupanData['status'] == 'success') {
                    $orderPrice = $coupanData['totalPrice'];
                    $orderPrice = floatval($orderPrice);

                    $orderCouponTempArr = array(
                        "order_id" => $orderId,
                        "user_id" => $loginId,
                        "coupon_code" => $coupanCode,
                        "totalprice" => $orderPrice,
                        "discount_price" => $coupanData['savePrice'],
                        "date" => $date,
                        "time" => $time,
                        "datetime" => $timeStamp
                    );

                    $checkout->forcedInsert('order_coupon_code', $orderCouponTempArr); ///// Insert order_coupon_code table Data
                } else {

                    $coupanCode = "";
                    $orderPrice = $checkout->cartTotalAmount();

                    $cartGstTotalAmount = $checkout->cartGstTotalAmount();

                    $orderPrice = floatval($orderPrice);
                    $orderPrice +=  $cartGstTotalAmount;
                }
            } else {
                $coupanCode = "";

                $orderPrice = $checkout->cartTotalAmount();

                $cartGstTotalAmount = $checkout->cartGstTotalAmount();

                $orderPrice = floatval($orderPrice);

                $orderPrice += $cartGstTotalAmount;
            }

            if ($_POST['paymentmethod'] == 'cashondelivery') {
                if ($cart->codStatus() == null) {
                    $placeOrder = true;
                    $paymentType = 'Cash On Delivery';
                    $paymentMode = 'COD';
                    $data['status'] = 'cod';
                    $paymentStatus = 'Pending';
                } else {
                    $placeOrder = false;
                    $data['status'] = 'failed';
                    $data['result'] = 'This order cannot be placed with COD Payment because some of your products are not avialable for COD.';
                }
            } ///// COD if END
            if ($_POST['paymentmethod'] == 'paytm') {

                $paramList = array();


                // Create an array having all required parameters for creating checksum.
                $paramList['oid'] = $orderId;
                $paramList['uid'] = $loginId;
                $paramList['op'] = $orderPrice;
                $placeOrder = true;
                $paymentType = 'Online';
                $paymentMode = 'Paytm';
                $paymentStatus = 'Pending';
                $data['status'] = 'Paytm';
                $data['PaytmData'] = $paramList;
            }
             if ($_POST['paymentmethod'] == 'razorpay') {

                $paramList = array();

                // Create an array having all required parameters for creating checksum.
                $paramList['oid'] = $orderId;
                $paramList['uid'] = $loginId;
                // echo number_format((float)$orderPrice, 2);
                // die();
                // $paramList['TXN_AMOUNT'] = number_format((float)$orderPrice, 2);
                // $paramList['TXN_AMOUNT'] += 100;
                $paramList['TXN_AMOUNT'] = sprintf("%.2f", (float)$orderPrice);
                $paramList['TXN_AMOUNT'] += 100;
                
                // echo $paramList['TXN_AMOUNT'];die();
                
                $placeOrder = true;
                $paymentType = 'Online';
                $paymentMode = 'Online';
                $paymentStatus = 'Pending';
                $data['status'] = 'razorpay';
                $data['razorpayData'] = $paramList;
            }
            if ($_POST['paymentmethod'] == 'wallet') {
                $email_agent = mysqli_fetch_assoc(mysqli_query($con, "SELECT email FROM user WHERE id = '$loginId' and agt_verify='true' and status='active'"))['email'];
                $amount = mysqli_fetch_assoc(mysqli_query($con, "SELECT balance FROM agents WHERE email = '$email_agent' and status = '1' and trash = '0'"))['balance'];
                $orderPricew = round($orderPrice + 100);
              
                if ($amount >= $orderPricew) {
                    $placeOrder = true;
                    $paymentType = 'Pay With Wallet';
                    $paymentMode = 'wallet';
                    $paymentStatus = 'Pending';
                    $data['status'] = 'wlt';
                    $data['orderId'] = $orderId;
                } else {
                    $placeOrder = false;
                    $data['status'] = 'failed';
                    $data['result'] = 'Your wallet is running low on funds. Please top up to ensure sufficient balance.';
                }
            }
            if ($_POST['paymentmethod'] == 'payagainstcoupon') {
                $placeOrder = true;
                $paymentType = 'Pay Against Coupon';
                $paymentMode = 'PAC';
                $paymentStatus = 'Success';
                $data['status'] = 'pac';
            }
            if ($placeOrder == true) {
                $orderdetailshtml = '';
                $subTotal = 0;
                $newordepp=$orderPrice+100;
                
                $discountedAmountt = 0;
                foreach ($checkout->cartDetail() as $item) {
                    
                    $trackingId = $checkout->generateTrackingId();
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

                    $gstOnProduct = $checkout->currentGstOnProduct($item['id']);
                    $productTotal = $item['quantity'] * $price;
                    // echo $gstOnProduct;
                    $taxValue = $gstOnProduct ?? 0;

                    $totalPriceProductTAX = $productTotal / 100;

                    $totalPriceProductTAX2 = (floatval($totalPriceProductTAX) * floatval($taxValue));
                   
                    $subTotal = $subTotal + $productTotal;
                    
                    $userdisc = $item['userdisc'];
                    if ($userdisc !== null) {
                        $discountedAmountt += $subTotal * ($userdisc / 100);
                    }

                    $tempArr = array(
                        "user_id" => $loginId,
                        "order_id" => $orderId,
                        "tracking_id" => $trackingId,
                        "productid" => $item['id'],
                        "productname" => $item['product_name'],
                        "productimage" => $item['image'],
                        "class0" => $item['class0'],
                        "class1" => $item['class1'],
                        "class2" => $item['class2'],
                        "class3" => $item['class3'],
                        "gst" => $totalPriceProductTAX2,
                        "price" => $productTotal,
                        "quantity" => $item['quantity'],
                        "payment_status" => $paymentStatus,
                        "shipment_mode" => null,
                        "payment_type" => $paymentType,
                        "date" => $date,
                        "time" => $time,
                        "timeStamp" => $timeStamp
                    );


                    $img = BASE_URL . 'asset/image/product/' . $item['image'];
                    $colorName = "";


                    if (!empty($item['class1']) && is_numeric($item['class1'])) {
                        $colorName = ", " . mysqli_fetch_assoc(mysqli_query($con, "SELECT symbol FROM size_class WHERE id=" . $item['class1']))['symbol'];
                    } else {
                        $colorName = ", " . $item['class1'];
                    }
                    if (!empty($item['class0'])) {
                        $colorName = ", " . mysqli_fetch_assoc(mysqli_query($con, "SELECT symbol FROM size_class WHERE id=" . $item['class0']))['symbol'];
                    }


                    if ($item['class2'] != '') $colorName .= ', ' . mysqli_fetch_assoc(mysqli_query($con, "SELECT symbol FROM size_class WHERE id=" . $item['class2']))['symbol'] . ', ' . mysqli_fetch_assoc(mysqli_query($con, "SELECT symbol FROM size_class WHERE id=" . $item['class0']))['symbol'];

                    // $columns = implode(', ', array_keys($tempArr));
                    // $values = "'" . implode("', '", array_values($tempArr)) . "'";
                    // echo $columns . " " . $values;
                    // $insertord = "INSERT INTO order_details ($columns) VALUES ($values)";
                    // $resultord = mysqli_query($con, $insertord);
                    // if ($resultord) {
                        
                    if ($checkout->forcedInsert('order_details', $tempArr)) {   
                        
                        if ($checkout->orderConfig() == 'Automatic') {
                            $tempArr = array(
                                "user_id" => $loginId,
                                "order_id" => $orderId,
                                "tracking_id" => $trackingId,
                                "tracking_status" => 'Ordered and Approved',
                                "date" => $date,
                                "time" => $time
                            );

                            $orderStatus = $checkout->forcedInsert('order_status', $tempArr);   ///// Insert Order Status Data

                            $tempArr = array(
                                "user_id" => $loginId,
                                "order_id" => $orderId,
                                "tracking_id" => $trackingId,
                                "tracking_status" => 'Your Order has been placed',
                                "date" => $date,
                                "time" => $time
                            );
                            $orderStatus = $checkout->forcedInsert('order_status', $tempArr);   ///// Insert Order Status Data


                            ///////// Manage Stock /////////
                            $isdeal = $homePage->isDealByProduct($item['id']);
                            if (!empty($isdeal)) {
                                if ($isdeal[0]['stock'] != 0) {
                                    $dealstock = $isdeal[0]['stock'] - $item['quantity'];

                                    $tempArr = array(
                                        "pid" => $item['id'],
                                        "stock" => $dealstock,
                                    );
                                    $dealstockUpdate = $checkout->dealsave('today_deal', $tempArr);
                                }
                            }

                            $stock = $item['in_stock'] - $item['quantity'];
                            $isStock = ($stock == 0) ? 'No' : 'Yes';
                            $tempArr = array(
                                "id" => $item['id'],
                                "stock" => $isStock,
                                "in_stock" => $stock
                            );
                            $stockUpdate = $checkout->save('products', $tempArr);

                            $tempArr = array(
                                "p_id" => $item['id'],
                                "stock" => $stock,
                                "type" => 'Debit',
                                "created_date" => $date,
                                "created_time" => $time
                            );
                            $stockUpdate = $checkout->forcedInsert('stock', $tempArr);
                            ///////// Manage Stock /////////
                        }
                        //////// if Order Status is Automatic ////////
                    }
                } ///// Cart Details if END 

                if (isset($_SESSION['login_count']) && $_SESSION['login_count'] == 0 && $discountedAmountt > 0) {
                    $curdate = date("Y-m-d");
                    $roundedDiscountedAmount = round($discountedAmountt, 2);
                    $email_agent = mysqli_fetch_assoc(mysqli_query($con, "SELECT email FROM user WHERE id = '$loginId' and agt_verify='true' and status='active'"))['email'];
                    $agtttid = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM agents WHERE email = '$email_agent' and status = '1' and trash = '0'"))['id'];
                    $insertagtdisc = mysqli_query($con, "INSERT INTO `agent_disc`(`order_id`, `agent_id`, `amt`, `disc_date`) VALUES ('$orderId', '$agtttid', '$roundedDiscountedAmount', '$curdate')");
                    
                } 


                $orderTempArr = array(
                    "userid" => $loginId,
                    "orderprice" => $orderPrice,
                    "promo_code_id" => $coupanCode,
                    "payment_type" => $paymentType,
                    "payment_mode" => $paymentMode,
                    "shipping" => '100',
                    "order_id" => $orderId,
                    "gst" => $_POST['couponAmount'],
                    "exp_time" => '',
                    "exp_date" => '',
                    "coupan_code" => $coupanCode,
                    "date" => $date,
                    "time" => $time
                );


                $placeOrder = $checkout->forcedInsert('order_tbl', $orderTempArr);


                if ($placeOrder) { ///// Insert order_tbl table Data
                    if ($_POST['paymentmethod'] == 'CCGateway') {
                        $orderTempArr['paymentM'] = 'CCGateway';
                        $data['order_details'] = $orderTempArr;
                    }

                    $orderPlaced = true;
                    $checkOutStatus = true;

                    $data['result'] = 'Order Placed Successfully!';
                    $data['orderId'] = $orderId;
                } else {
                    $orderPlaced = false;
                }


                //check user address
                $userData = $dashboard->getUserDetail();


                if (empty($userData['flat']) && empty($userData['street']) && empty($userData['locality']) && empty($userData['city']) && empty($userData['zipcode']) && empty($userData['state']) && empty($userData['country'])) {
                    //user details
                    $tempArr = array(
                        "flat" => $billingAddressFlat,
                        "street" => $billingAddressStreet,
                        "locality" => $billingAddressLocality,
                        "city" => $billingAddressCity,
                        "zipcode" => $billingAddressZipCode,
                        "state" => $billingAddressState,
                        "country" => $billingAddressCountry,
                        "addr_type" => $billingAddressType,
                        'id' => $loginId

                    );


                    $checkout->forcedInsert('user', $tempArr); ///// Update User table Address Details
                    //user details
                } else {
                    $billingAddressFirstName = $userData['firstname'];
                    $billingAddressLastName = $userData['lastname'];
                    $billingAddressPhone = $userData['mobile'];
                    $billingAddressEmail = $userData['email'];
                    $billingAddressFlat = $userData['flat'];
                    $billingAddressStreet = $userData['street'];
                    $billingAddressLocality = $userData['locality'];
                    $billingAddressCity = $userData['city'];
                    $billingAddressZipCode = $userData['zipcode'];
                    $billingAddressState = $userData['state'];
                    $billingAddressCountry = $userData['country'];
                    $billingAddressType = $userData['addr_type'];
                }


                $tempArr = array(
                    "order_id" => $orderId,
                    "user_id" => $loginId,
                    "first_name" => $billingAddressFirstName,
                    "last_name" => $billingAddressLastName,
                    "flat" => $billingAddressFlat,
                    "street" => $billingAddressStreet,
                    "locality" => $billingAddressLocality,
                    "city" => $billingAddressCity,
                    "zip_code" => $billingAddressZipCode,
                    "state" => $billingAddressState,
                    "country" => $billingAddressCountry,
                    "email" => $billingAddressEmail,
                    "phone" => $billingAddressPhone,
                    "o_date" => $date,
                    "o_time" => $time,
                    "addr_type" => $billingAddressType
                );


                $checkout->forcedInsert('billing_address', $tempArr); ///// Insert billing_address table Address Details

                if (!isset($shippingFirstName) && !isset($shippingLastName) && !isset($shippingFlat) && !isset($shippingStreet) && !isset($shippingLocality) && !isset($shippingCountry) && !isset($shippingCity) && !isset($shippingState) && !isset($shippingZipCode) && !isset($shippingEmail) && !isset($shippingPhone) && !isset($shippingType)) {
                    $shippingFirstName = $userData['firstname'];
                    $shippingLastName = $userData['lastname'];
                    $shippingPhone = $userData['mobile'];
                    $shippingEmail = $userData['email'];
                    $shippingFlat = $userData['flat'];
                    $shippingStreet = $userData['street'];
                    $shippingLocality = $userData['locality'];
                    $shippingCity = $userData['city'];
                    $shippingZipCode = $userData['zipcode'];
                    $shippingState = $userData['state'];
                    $shippingCountry = $userData['country'];
                    $shippingType = $userData['addr_type'];
                }

                $tempArr = array(
                    "order_id" => $orderId,
                    "user_id" => $loginId,
                    "first_name" => $shippingFirstName,
                    "last_name" => $shippingLastName,
                    "flat" => $shippingFlat,
                    "street" => $shippingStreet,
                    "locality" => $shippingLocality,
                    "country" => $shippingCountry,
                    "city" => $shippingCity,
                    "state" => $shippingState,
                    "zip_code" => $shippingZipCode,
                    "email" => $shippingEmail,
                    "phone" => $shippingPhone,
                    "addr_type" => $shippingType,
                    "o_date" => $date,
                    "o_time" => $time
                );

                $checkout->forcedInsert('shiping_address', $tempArr); ///// Insert shiping_address table Data
                if ($_POST['paymentmethod'] == 'cashondelivery') {
                    // if(file_exists('../emailer_html/order-purchase.html')){
                    //     $EmailOTP_HTML = file_get_contents('../emailer_html/order-purchase.html');
                    // }elseif(file_exists('../../emailer_html/order-purchase.html')){
                    //     $EmailOTP_HTML = file_get_contents('../../emailer_html/order-purchase.html');
                    // }elseif(file_exists('../../../emailer_html/order-purchase.html')){
                    //      $EmailOTP_HTML = file_get_contents('../../../emailer_html/order-purchase.html');
                    // }elseif(file_exists('emailer_html/order-purchase.html')){
                    //      $EmailOTP_HTML = file_get_contents('emailer_html/order-purchase.html');
                    // }else{
                    //     $EmailOTP_HTML = ' __LOGO__';
                    // }
                    // $logo=BASE_URL.'asset/image/logo/'.$homePage->logo()['logo']; 
                    // $orderdetailshtml.='<td align="center">
                    //                                             <table align="center" border="0" cellpadding="0" cellspacing="0" class="display-width" width="100%">
                    //                                                 <tr>
                    //                                                     <td height="10"></td>
                    //                                                 </tr>
                    //                                                 <tr>
                    //                                                     <td>

                    //                                                         <!-- TABLE LEFT -->

                    //                                                         <table align="left" border="0" cellpadding="0" cellspacing="0" class="display-width" width="43%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;width:auto;">
                    //                                                             <tbody>
                    //                                                                 <tr>
                    //                                                                     <td align="center">
                    //                                                                         <table align="center" border="0" cellpadding="0" cellspacing="0" class="display-width" width="100%" style="width:auto !important;">
                    //                                                                             <tr>
                    //                                                                                 <td align="left" class="MsoNormal" style="color:#000000;font-family:Segoe UI,sans-serif,Arial,Helvetica,Lato;font-size:14px;letter-spacing:1px;line-height:24px;">
                    //                                                                                     <multiline>Subtotal</multiline>
                    //                                                                                 </td>
                    //                                                                             </tr>
                    //                                                                         </table>
                    //                                                                     </td>
                    //                                                                 </tr>
                    //                                                             </tbody>
                    //                                                         </table>
                    //                                                         <table align="left" border="0" cellpadding="0" cellspacing="0" width="15%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                    //                                                             <tr>
                    //                                                                 <td style="line-height:20px;" height="10" width="1"></td>
                    //                                                             </tr>
                    //                                                         </table>
                    //                                                         <!-- TABLE RIGHT -->
                    //                                                         <table align="right" border="0" cellpadding="0" cellspacing="0" class="display-width" width="37%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;width:auto;">
                    //                                                             <tr>
                    //                                                                 <td align="center">
                    //                                                                     <table align="center" border="0" cellspacing="0" cellpadding="0" class="display-width" style="width:auto !important;">
                    //                                                                         <tr>
                    //                                                                             <td align="left" class="MsoNormal" style="color:#000000;font-family:Segoe UI,sans-serif,Arial,Helvetica,Lato;font-size:14px;letter-spacing:1px;line-height:24px;">
                    //                                                                                 <multiline>'.$currency.$subTotal.'/-</multiline>
                    //                                                                             </td>

                    //                                                                         </tr>
                    //                                                                     </table>
                    //                                                                 </td>
                    //                                                             </tr>
                    //                                                         </table>
                    //                                                     </td>
                    //                                                 </tr>
                    //                                             </table>
                    //                                               <!-- TABLE LEFT -->

                    //                                             <table align="center" border="0" cellpadding="0" cellspacing="0" class="display-width" width="100%">
                    //                                                 <tr>
                    //                                                     <td height="10"></td>
                    //                                                 </tr>
                    //                                                 <tr>
                    //                                                     <td>

                    //                                                         <!-- TABLE LEFT -->

                    //                                                         <table align="left" border="0" cellpadding="0" cellspacing="0" class="display-width" width="43%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;width:auto;">
                    //                                                             <tbody>
                    //                                                                 <tr>
                    //                                                                     <td align="center">
                    //                                                                         <table align="center" border="0" cellpadding="0" cellspacing="0" class="display-width" width="100%" style="width:auto !important;">
                    //                                                                             <tr>
                    //                                                                                 <td align="left" class="MsoNormal" style="color:#000000;font-family:Segoe UI,sans-serif,Arial,Helvetica,Lato;font-size:14px;letter-spacing:1px;line-height:24px;">
                    //                                                                                     <multiline>Total Tax</multiline>
                    //                                                                                 </td>
                    //                                                                             </tr>
                    //                                                                         </table>
                    //                                                                     </td>
                    //                                                                 </tr>
                    //                                                             </tbody>
                    //                                                         </table>
                    //                                                         <table align="left" border="0" cellpadding="0" cellspacing="0" width="15%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                    //                                                             <tr>
                    //                                                                 <td style="line-height:20px;" height="10" width="1"></td>
                    //                                                             </tr>
                    //                                                         </table>
                    //                                                         <!-- TABLE RIGHT -->
                    //                                                         <table align="right" border="0" cellpadding="0" cellspacing="0" class="display-width" width="37%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;width:auto;">
                    //                                                             <tr>
                    //                                                                 <td align="center">
                    //                                                                     <table align="center" border="0" cellspacing="0" cellpadding="0" class="display-width" style="width:auto !important;">
                    //                                                                         <tr>
                    //                                                                             <td align="left" class="MsoNormal" style="color:#000000;font-family:Segoe UI,sans-serif,Arial,Helvetica,Lato;font-size:14px;letter-spacing:1px;line-height:24px;">
                    //                                                                                 <multiline>'.$currency.$cart->cartGstTotalAmount().'/-</multiline>
                    //                                                                             </td>

                    //                                                                         </tr>
                    //                                                                     </table>
                    //                                                                 </td>
                    //                                                             </tr>
                    //                                                         </table>
                    //                                                     </td>
                    //                                                 </tr>
                    //                                             </table>';
                    //                                             if((isset($_POST['coupanCode']))&&($_POST['coupanCode'] != '')&& ($_POST['paymentmethod'] != 'cashondelivery')) {

                    //                                             $orderdetailshtml.=' <table align="left" border="0" cellpadding="0" cellspacing="0" class="display-width" width="43%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;width:auto;">
                    //                                                 <tbody>
                    //                                                     <tr>
                    //                                                         <td align="center">
                    //                                                             <table align="center" border="0" cellpadding="0" cellspacing="0" class="display-width" width="100%" style="width:auto !important;">
                    //                                                                 <tr>
                    //                                                                     <td align="left" class="MsoNormal" style="color:#000000;font-family:Segoe UI,sans-serif,Arial,Helvetica,Lato;font-size:14px;letter-spacing:1px;line-height:24px;">
                    //                                                                         <multiline>Coupan Discount</multiline>
                    //                                                                     </td>
                    //                                                                 </tr>
                    //                                                             </table>
                    //                                                         </td>
                    //                                                     </tr>
                    //                                                 </tbody>
                    //                                             </table>
                    //                                             <table align="left" border="0" cellpadding="0" cellspacing="0" width="15%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                    //                                                 <tr>
                    //                                                     <td style="line-height:20px;" height="10" width="1"></td>
                    //                                                 </tr>
                    //                                             </table>
                    //                                             <!-- TABLE RIGHT -->
                    //                                             <table align="right" border="0" cellpadding="0" cellspacing="0" class="display-width" width="37%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;width:auto;">
                    //                                                 <tr>
                    //                                                     <td align="center">
                    //                                                         <table align="center" border="0" cellspacing="0" cellpadding="0" class="display-width" style="width:auto !important;">
                    //                                                             <tr>
                    //                                                                 <td align="left" class="MsoNormal" style="color:#000000;font-family:Segoe UI,sans-serif,Arial,Helvetica,Lato;font-size:14px;letter-spacing:1px;line-height:24px;">
                    //                                                                     <multiline>'.$currency.$coupanData['savePrice'].'/-</multiline>
                    //                                                                 </td>

                    //                                                             </tr>

                    //                                                         </table>
                    //                                                     </td>
                    //                                                 </tr>

                    //                                             </table>
                    //                                         ';
                    //                                             }

                    //                                         $orderdetailshtml.='</td>';


                    //                                         $totalhtml=' <tr>
                    //                                     <td>

                    //                                         <!-- TABLE LEFT -->

                    //                                         <table align="left" border="0" cellpadding="0" cellspacing="0" class="display-width" width="40%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;width:auto;">
                    //                                             <tbody>
                    //                                                 <tr>
                    //                                                     <td align="center">
                    //                                                         <table align="center" border="0" cellpadding="0" cellspacing="0" class="display-width" width="100%" style="width:auto !important;margin-left: 25px;">
                    //                                                             <tbody><tr>
                    //                                                                 <td align="left" class="MsoNormal" style="color:#000000;font-family:Segoe UI,sans-serif,Arial,Helvetica,Lato;font-size:14px;letter-spacing:1px;line-height:24px;font-weight: 800;">
                    //                                                                     <multiline>TOTAL</multiline>
                    //                                                                 </td>
                    //                                                             </tr>
                    //                                                         </tbody></table>
                    //                                                     </td>
                    //                                                 </tr>
                    //                                             </tbody>
                    //                                         </table>
                    //                                         <table align="left" border="0" cellpadding="0" cellspacing="0" width="15%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;">
                    //                                             <tbody><tr>
                    //                                                 <td style="line-height:20px;" height="10" width="1"></td>
                    //                                             </tr>
                    //                                         </tbody></table>
                    //                                         <!-- TABLE RIGHT -->
                    //                                         <table align="right" border="0" cellpadding="0" cellspacing="0" class="display-width" width="37%" style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;width:auto;">
                    //                                             <tbody><tr>
                    //                                                 <td align="center">
                    //                                                     <table align="center" border="0" cellspacing="0" cellpadding="0" class="display-width" style="width:auto !important;margin-right: 25px;">
                    //                                                         <tbody><tr>
                    //                                                             <td align="left" class="MsoNormal" style="color:#000000;font-family:Segoe UI,sans-serif,Arial,Helvetica,Lato;font-size:14px;letter-spacing:1px;line-height:24px;font-weight: 800;">
                    //                                                                 <multiline>'.$currency.ceil($orderPrice + $shippingCharge).'/-</multiline>
                    //                                                             </td>
                    //                                                             <tr>
                    //                                                              <td height="10"></td>
                    //                                                          </tr>
                    //                                                         </tr>
                    //                                                     </tbody></table>
                    //                                                 </td>
                    //                                             </tr>
                    //                                         </tbody></table>
                    //                                     </td>
                    //                                 </tr>';

                    // $EmailOTP_HTML = str_replace('__LOGO__', $logo, $EmailOTP_HTML);
                    // $EmailOTP_HTML = str_replace('__ORDERID__', $orderId, $EmailOTP_HTML);
                    // $EmailOTP_HTML = str_replace('__ORDERDETAILS__', $orderdetailshtml, $EmailOTP_HTML);
                    // $EmailOTP_HTML = str_replace('__TOTAL__', $totalhtml, $EmailOTP_HTML);
                    // sendEmail($userData['email'], "An order have been placed", $EmailOTP_HTML);



                    //$cart->clearCart(); ///// Remove All Item From Cart
                }
            }

            ///// errMessage if END
        } else {
            $data['oostatus'] = 'outOfStock';
        }
    } else {
        $data['status'] = 'inputErr';
        $data['errMessage'] = $errMessage;      /////// Error Message If Input Fiels is NULL
    }
} else { ///// Payment Method if END
    // echo 'no payment method selected.';
    $data['status'] = 'failed';
    $data['result'] = 'Please Select Payment method';
}

// die();
$data['checkOutStatus'] = $checkOutStatus;
echo json_encode($data);