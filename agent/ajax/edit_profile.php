<?php
require('../config/connection.php');

if (isset($_POST['editProfile'])) {
    $inputErr = array();

    if ($_POST['firstName'] == '') {
        $inputErr['firstName'] = 'Field Required';
    }
    if ($_POST['lastName'] == '') {
        $inputErr['lastName'] = 'Field Required';
    }
    if (!isset($_POST['gender'])) {
        $inputErr['gender'] = 'Please Select Gender';
    }
    if (!isset($_POST['addressType'])) {
        $inputErr['addressType'] = 'Please Select Address Type';
    }
    if ($_POST['addressFlat'] == '') {
        $inputErr['addressFlat'] = 'Field Required';
    }
    if ($_POST['addressStreet'] == '') {
        $inputErr['addressStreet'] = 'Field Required';
    }
    // if ($_POST['addressLocality'] == '') {
    //     $inputErr['addressLocality'] = 'Field Required';
    // }
    if ($_POST['addressCountry'] == '') {
        $inputErr['addressCountry'] = 'Field Required';
    }
    if ($_POST['addressState'] == '') {
        $inputErr['addressState'] = 'Field Required';
    }
    if ($_POST['addressCity'] == '') {
        $inputErr['addressCity'] = 'Field Required';
    }
    if ($_POST['addressZipCode'] == '') {
        $inputErr['addressZipCode'] = 'Field Required';
    }

    if (empty($inputErr)) {
        $agent_id = $_POST['userId'];
        $query = "UPDATE user SET
                    firstname = '{$_POST['firstName']}',
                    lastname = '{$_POST['lastName']}',
                    gender = '{$_POST['gender']}',
                    addr_type = '{$_POST['addressType']}',
                    flat = '{$_POST['addressFlat']}',
                    street = '{$_POST['addressStreet']}',
                    locality = '{$_POST['addressLocality']}',
                    country = '{$_POST['addressCountry']}',
                    state = '{$_POST['addressState']}',
                    city = '{$_POST['addressCity']}',
                    zipcode = '{$_POST['addressZipCode']}'
                WHERE agt_id = '$agent_id'";

        $result = mysqli_query($conn, $query);

        $query2 = "UPDATE agents SET
                    first_name = '{$_POST['firstName']}',
                    last_name = '{$_POST['lastName']}'
                WHERE id = '$agent_id'";

        $result2 = mysqli_query($conn, $query2);

        if ($result && $result2) {
            $data['action'] = 'addressFormSubmit';
            $data['status'] = 'success';
            $data['result'] = 'Information Updated Successfully';
        } else {
            $data['status'] = 'formMsg';
            $data['result'] = 'Error Occurred. Please try again.';
        }
    } else {
        $data['status'] = 'failed';
        $data['errMessage'] = $inputErr;
    }

    echo json_encode($data);
}
?>
