<?php
include('../config/connection.php');

// Add Blog Category 
if (isset($_POST['formType']) && $_POST['formType'] == "addtestitype") {


    $name  =  mysqli_real_escape_string($conn, $_POST['testiname']);
    $Content  =  mysqli_real_escape_string($conn, $_POST['trestiContent']);
 

    $currentDateTime = date("Y-m-d H:i:s");

    
      $myAquery = "INSERT INTO `testimonial`( `name`, `content`,`date_time`) VALUES ('$name','$Content','$currentDateTime')";
    
    $insertBlogQuery = mysqli_query($conn, $myAquery);

    if ($insertBlogQuery) {
        // echo $var; 
        

        $data['status'] = true;
        $data['message'] = 'Testimonial Add Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in Testimonial submission..';
    }
}


if (isset($_POST['formType']) && $_POST['formType'] == "ststesti") {

    $testiid  = $_POST['testiid'];
    $sts  = $_POST['sts'];

    $DeleteCatQ = mysqli_query($conn, "UPDATE `testimonial` SET `status`='$sts' WHERE `id`='$testiid' ");

    if ($DeleteCatQ) {
        $data['status'] = true;
        $data['message'] = 'Testimonial ' . ucfirst($sts) . ' Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in Testimonial Status..';
    }
}

if (isset($_POST['formType']) && $_POST['formType'] == "dltTest") {

    $testid  = $_POST['testid'];

    $DeleteCatQ = mysqli_query($conn, "UPDATE `testimonial` SET  `trash`='1' WHERE `id`='$testid' ");

    if ($DeleteCatQ) {
        $data['status'] = true;
        $data['message'] = 'Testimonial Removed Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in Testimonial Delete..';
    }
}



// Edit Blog 

if (isset($_POST['formType']) && $_POST['formType'] == "Edittestitype") {
    $name  =  mysqli_real_escape_string($conn, $_POST['testiname']);
    $content  =  mysqli_real_escape_string($conn, $_POST['trestiContent']);
    $testiid  =  mysqli_real_escape_string($conn, $_POST['testiid']);

    $upBlogQuery = "UPDATE `testimonial` SET  `name`='$name',`content`='$content' WHERE `id`='$testiid'";


    $upBlogQueryr = mysqli_query($conn, $upBlogQuery);

    if ($upBlogQueryr) {
        $data['status'] = true;
        $data['message'] = 'Testimonial Updated Successfully..';
    } else {
        $data['status'] = false;
        $data['message'] = 'Error Occur in Testimonial submission..';
    }
}





echo json_encode($data);
