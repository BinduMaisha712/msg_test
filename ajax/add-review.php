<?php
require('../config.php');


$data = array();

// print_r($_POST);
// print_r($_FILES);exit();



if(USER::isLoggedIn()){
$userId = $_SESSION['loginid'];

$query = "SELECT os.id 
FROM `order_status` as os 
INNER JOIN `order_details` as od 
ON os.order_id = od.order_id AND os.tracking_id = od.tracking_id 
AND os.user_id='".$userId."' AND od.productid='". $_POST['productId']."' 
AND os.tracking_status = 'Delivered'";

$count = $user->countByQuery($query);
// print_r($count);exit;
// $count = 1;

if($count>0){

    if((isset($_POST['starRating']))&&($_POST['starRating']!="")){
////////// Add Record //////////
// print_r($_POST);
    $dataArr = array(
        "review" => $_POST['comment'],
        "userid" => $userId,
        "star" => $_POST['starRating'],
        "pid" => $_POST['productId'],
        // "email" => $_POST['authorEmail']
    );
    $productrating = $_POST['starRating'];
    $prodids= $_POST['productId'];
    $prod_Query = "SELECT * FROM products WHERE id ='$prodids'";
    $run_produt = mysqli_query($con,$prod_Query);
    $ex_query = mysqli_fetch_array($run_produt);
    $imageid = $ex_query['product_code'];
    $image_query ="SELECT * FROM image WHERE p_id ='$imageid'";
    $RUN_image = mysqli_query($con,$image_query);
    $imagedata = mysqli_fetch_array($RUN_image);
    $imageurl = $imagedata['image'];
    $link = 'asset/image/product/'.$imageurl;
    $userids = $_SESSION['loginid'];
    $user_query = "SELECT * FROM user WHERE  id ='$userids' ";
    $user_ex = mysqli_query($con,$user_query);
    $get_user = mysqli_fetch_array($user_ex);
    $username = $get_user['firstname'].' ' .$get_user['lastname'];
    $usermail = $get_user['email'];
    if($productrating==0){
        $imagestar = 'star.png';
    }elseif($productrating==1){
        $imagestar = 'star_one.png';
    }elseif($productrating==2){
        $imagestar = 'star_two.png';
    }elseif($productrating==3){
        $imagestar = 'star_three.png';
    }elseif($productrating==4){ 
        $imagestar = 'star_four.png';
    }elseif($productrating==5){
        $imagestar = 'star_five.png';
    }

    if($user->forcedInsert('review',$dataArr)){
        $content ='<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body style="margin: 0;padding:0;color: #424242;font-family: '.'Raleway'.';">

    <div style="width: 650px; margin: auto; padding:0px;background-color:#f7f7f7">
        <div style="width: 600px;height: auto;margin: auto;background: #fff;box-shadow: 1px 1px 9px #bbbbbb;">
            <div style="background: #F59623;height: 10px;"></div>
        <div style="text-align: center; padding-top: 30px; margin-bottom: 10px">
            <img style="width: 100px;" src="../emailimages/logo-new.png">
        </div>
        <div style="padding: 10px;text-align: center;justify-content: center;">
            <h1 style="color: #3d4f6f">Thank you for your review!</h1>
            <p style="font-size: 16px; padding: 0px 30px;">'.$username.', thank you for taking a moment and writing a review of our product. We are glad that you liked our product. Your review will help us to improve.</p>
        </div>
        <div style="width: 100%; display: inline-block;">
            <div style="width: 40%; float: left;">
            <img src="../'.$link.'" style="width: 150px; padding: 15px;">
        </div>
        <div style="width: 60%; float: right;font-size: 15px;">
            <h3>'.$username.'</h3>
            <img src="../emailimages/'.$imagestar.'" style="width: 120px;">
            <p>Reviewed on 7 may 2021</p>
            <p style="padding: 0px 10px 10px 0px"> '.$_POST['comment'].'</p>
        </div>
        </div>
        <div style="background: #32A375;color: #E5E5E5;padding: 2px 0px;text-align: center;width: 100%;margin-top: 40px;">
            <p>Consider rating other past items! <strong>See more</strong></p>
        </div>
        </div>
        <div style="text-align: center;margin-top: 20px;padding-top: 10px;height: 300px; text-align: center;">
            <h1 style="font-weight: bold;color: #53599c">Stay in Touch</h1>
            <img src="../emailimages/facebook.png" style="float: left;padding-left: 200px;width: 35px;">
            <img src="../emailimages/insta.png" style="float: left;padding-left: 20px;width: 35px;">
            <img src="../emailimages/twit.png" style="float: left;padding-left: 20px;width: 35px;">
            <img src="../emailimages/youtube.png" style="float: left;padding-left: 20px;width: 35px;">
            <img src="../emailimages/whats-app.png" style="float: left;padding-left: 20px;width: 35px;">
            <br><br>
            <p style="font-size: 13px;margin-top: 35px;">Email sent by Hayaa</p>
            <p style="font-size: 13px;line-height: 1px;">© 2021 Hayaa. All Right Reserved.</p>
            <p style="font-size: 13px;float: left;padding-left:180px"><a href="#" style=";color: #808B96">About</a></p>
            <P style="font-size: 13px;float: left;padding-left: 20px;"><a href="#" style=";color: #808B96">Terms & condition</a></P>
            <p style="font-size: 13px;float: left;padding-left: 20px;"><a href="#" style=";color: #808B96">Privacy Policy</a></p>
            <p style="font-size: 13px;float: left;padding-left: 20px;"><a href="#" style=";color: #808B96">Contact</a></p>
        </div>
    </div>
</body>
</html>';
        $subject = "Your feedback";
        // include('../mail-send.php');
        // plmail($usermail,$subject,$content);

        if((isset($_FILES["images"]))&&($_FILES["images"]["name"][0]!="")){
            $image_name=($_FILES["images"]["name"]);  
            $image_type=($_FILES["images"]["tmp_name"]);  
            $i=0;
            foreach ($image_name as $value){
                $mul_img=$_FILES["images"]["tmp_name"][$i];
            
                $temp = explode(".", $value);
                $newfilename = $temp[0].round(microtime(true)) . '.' . end($temp);
            
                if(move_uploaded_file($mul_img,"../asset/image/review/".$newfilename)){
    
                    $reviewId = $user->lastInsertedId('review');
    
                    $dataTempArr = array(
                        "image" => $newfilename,
                        "reviewid" => $reviewId,
                    );

                    $user->forcedInsert('review_image',$dataTempArr);
                }
             
            
                $i++;
            }
            }


        $avgRating = $homePage->getAvgReviewStar($_POST['productId']);

        $tempDataArr = array(
            "id" => $_POST['productId'],
            "avg_rating" => $avgRating
        );
    
        $user->forcedInsert('products',$tempDataArr);

        $data['status'] = 'success';
        $data['result'] = 'Review added Successfully';

        }else{
            $data['status'] = 'error';
            $data['result'] = 'Error Occur Please re-try again';
        }
////////// Add Record //////////



}else{
    $data['status'] = 'buyErr';
    $data['result'] = 'Please! select rating';
}




    }else{
        $data['status'] = 'buyErr';
        $data['result'] = 'You are not allow to Review this Product because you did not buy it yet.';
    }


    
}else{
    $data['status'] = 'logInErr';
    $data['result'] = 'Please Login to update Reviews';
}
if(isset($_POST['url'])){
    $data['url'] = $_POST['url'];
}

echo json_encode($data);
?>