<?php

function gnerateInvoiceNo($conn)
{
    $sel_query = mysqli_query($conn, "SELECT * FROM `invoice_generate` order by id desc");
    if (mysqli_num_rows($sel_query) > 0) {
        $vaar = mysqli_fetch_assoc($sel_query);
        return $vaar['invoice_no'] + 1;
    } else {
        return 10000;
    }
}


function generateToken($length)
{
    $str = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
    $token = substr(str_shuffle($str), 0, $length);
    return $token;
}
function generateNumToken($length)
{
    $str = '1234567890';
    $token = substr(str_shuffle($str), 0, $length);
    return $token;
}

function insert_data($tableName, array $record, $conn)
{
    $columnSet = implode(",", array_keys($record));
    $valueSet = "'" . implode("','", array_values($record)) . "'";
    $query = "INSERT INTO $tableName ($columnSet)
            VALUES ($valueSet)";

        

    if (mysqli_query($conn, $query)) {
        return true;
    } else {
        return false;
    }
}

function userInvoiceByOrderId($orderId, $userId, $conn)
{
    $query = "SELECT ig.token,ig.invoice_date,u.firstname
            FROM invoice_generate as ig
            INNER JOIN user as u on u.id=ig.user_id
            WHERE ig.order_id = '" . $orderId . "' AND ig.user_id = '" . $userId . "'";

    $queryQ = mysqli_query($conn, $query);
    $result = mysqli_fetch_array($queryQ);

    return $result;
}

function orderProducts($orderId, $conn)
{
    $query = "SELECT ot.*,u.product_name,u.id 
    FROM order_details as ot
    INNER JOIN products as u on ot.productid=u.id
    WHERE ot.order_id = '" . $orderId . "'";


    $queryQ = mysqli_query($conn, $query);
    // $result = mysqli_fetch_array($queryQ);
    
    // return $result;
    $result = [];
    while ($result2 = mysqli_fetch_array($queryQ)) {
        array_push($result,$result2);
        // echo "<pre>";
        // print_r($result);
    }
    return $result;

    // $numResults1 = mysqli_num_rows($queryQ);
    // echo $numResults1;

    // echo "<pre>";

    // print_r($result);

    // die;
}


function shippingAddress($orderId, $conn)
{
    $result = array();
    $query = "SELECT u.id,u.order_id,u.first_name,u.last_name,u.phone,u.email, u.flat,u.street, u.locality,u.city,u.zip_code,sl.state,c.country_name, u.addr_type 
    FROM shiping_address as u 
    LEFT JOIN countries as c on c.id=u.country
    LEFT JOIN state_list as sl on sl.id=u.state
    WHERE u.order_id = '" . $orderId . "'";

    // $result[0] = $this->getUserDetail();

    $queryQ = mysqli_query($conn, $query);
    // If the query returns >= 1 assign the number of rows to numResults


    $r = mysqli_fetch_array($queryQ);

    $address = ($r['flat'] != "") ? $r['flat'] . ", " : "";
    $address .= ($r['street'] != "") ? $r['street'] . ", " : "";
    $address .=  ($r['locality'] != "") ? $r['locality'] . ", " : "";
    $address .= ($r['city'] != "") ? $r['city'] . ", " : "";
    $address .= ($r['state'] != "") ? $r['state'] . ", " : "";
    $address .= ($r['country_name'] != "") ? $r['country_name'] : "";
    $address .= ($r['zip_code'] != "") ? " - " . $r['zip_code'] : "";

    $r['address'] = $address;

    return $r; // Query was successful
}

function billingAddress($orderId, $conn)
{
    $result = array();
    $query = "SELECT u.id,u.order_id,u.first_name,u.last_name,u.phone,u.email, u.flat,u.street, u.locality,u.city,u.zip_code,sl.state,c.country_name, u.addr_type 
    FROM billing_address as u 
    LEFT JOIN countries as c on c.id=u.country
    LEFT JOIN state_list as sl on sl.id=u.state
    WHERE u.order_id = '" . $orderId . "'";

    // $result[0] = $this->getUserDetail();

    $queryQ = mysqli_query($conn, $query);
    // If the query returns >= 1 assign the number of rows to numResults


    $r = mysqli_fetch_array($queryQ);

    $address = ($r['flat'] != "") ? $r['flat'] . ", " : "";
    $address .= ($r['street'] != "") ? $r['street'] . ", " : "";
    $address .=  ($r['locality'] != "") ? $r['locality'] . ", " : "";
    $address .= ($r['city'] != "") ? $r['city'] . ", " : "";
    $address .= ($r['state'] != "") ? $r['state'] . ", " : "";
    $address .= ($r['country_name'] != "") ? $r['country_name'] : "";
    $address .= ($r['zip_code'] != "") ? " - " . $r['zip_code'] : "";

    $r['address'] = $address;

    return $r; // Query was successful
}

function orderCouponByOrderId($orderId, $conn)
{
    $query = "SELECT *
                FROM order_coupon_code WHERE order_id = '" . $orderId . "'";

    $query = mysqli_query($conn, $query);
    $result = mysqli_fetch_array($query);

    return $result;
}
function invoiceDetail($token, $con)
{
    $result = array();
    $query = "SELECT ig.*,ot.payment_type,ot.orderprice,ot.shipping,ot.promo_code_id
            FROM invoice_generate as ig
            INNER JOIN order_tbl as ot on ot.order_id=ig.order_id
            WHERE ig.token = '" . $token . "'";
    $queryQ = mysqli_query($con, $query);

    $numResults = mysqli_num_rows($queryQ);
    // // Loop through the query results by the number of rows returned
    if ($numResults > 0) {
        $result = mysqli_fetch_array($queryQ);

        $result['products'] = orderProducts($result['order_id'], $con);
        $result['shipping_address'] = shippingAddress($result['order_id'], $con);
        $result['billing_address'] =    billingAddress($result['order_id'], $con);
        $result['promo'] = orderCouponByOrderId($result['order_id'], $con);
    } else {
        $result = NULL;
    }
    return $result;
}

function contactInfo($column, $conn)
{
    $result = array();

    $query = 'SELECT ' . $column . ' FROM footer LIMIT 1';
    $query1 = mysqli_query($conn, $query);
    if (mysqli_num_rows($query1) > 0) {
        $result = mysqli_fetch_array($query1);

        return $result[$column]; // Query was successful
    } else {
        return false;
    }
}


