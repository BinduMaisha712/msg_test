

<?php

require('../config/connection.php');

$data = array();
   if(isset($_POST['id']))
    {
        $id=$_POST['id'];

        $query="UPDATE image
        SET status = 'Deleted'
        WHERE id = '".$id."';";

// print_r($query);exit();
        
$query=mysqli_query($conn,$query);

if($query){
    $data['status']='success';
    $data['result']= '<div id="snackbar">Image Removed Sucessfully...</div>
     <script type="text/javascript">var x = document.getElementById("snackbar");x.className = "show";setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    var delay = 1000;setTimeout(function(){ }, delay);
     </script>';
}else{
    $data['status']='failed';
    $data['result']= '<div id="snackbar">Failed! Please try again...</div>
     <script type="text/javascript">var x = document.getElementById("snackbar");x.className = "show";setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    var delay = 1000;setTimeout(function(){}, delay);
     </script>';
}

$imageData = "";
$sq_im=mysqli_query($conn,"select * from image where status='Active' AND p_id='".$_POST['productCode']."'");
while($ro_im=mysqli_fetch_assoc($sq_im))
{
    $imageData .= '<span>';
    $imageData .= '<img src="../asset/image/product/'.$ro_im['image'].'" width="100px" style="border:1px solid">';
    $imageData .= '<span class="fa fa-trash" onclick="remove_img(\''.$ro_im['id'].'\',\''.$_POST['productCode'].'\')" style="cursor:pointer"></span></span>';
} 
$data['imageData']=$imageData;
    }
    echo json_encode($data);

    ?>