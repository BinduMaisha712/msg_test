

<?php

require('../config/connection.php');

$data = array();
   if(isset($_POST['productId']))
    {
        $id=$_POST['productId'];
        $stock=$_POST['inStock'];
        
        date_default_timezone_set("Asia/kolkata");
        $date=date("Y-m-d");
        $time=date("H:i:s");

        $sel_query=mysqli_query($conn,"SELECT in_stock, stock FROM `products` WHERE id='".$id."'");
        if(mysqli_num_rows($sel_query)>0)
        {
        $vaar= mysqli_fetch_array($sel_query);
        $totalStock = $stock+$vaar['in_stock'];
        }
        else
        {
            $totalStock=0;
        }
      
        
        if($vaar['stock'] == 'No' && $totalStock > 0){
             $query="UPDATE products
            SET in_stock = '$totalStock', stock = 'Yes'
            WHERE id = '".$id."';";
        }
        else{
             $query="UPDATE products
            SET in_stock = '$totalStock'
            WHERE id = '".$id."';";
        }
       

// print_r($query);exit();
        
$query=mysqli_query($conn,$query);

if($query){

/// Update Stock Record ///
$dquery=mysqli_query($conn,"INSERT INTO `stock`(`p_id`,`stock`,`type`,`created_date`,`created_time`) VALUES ('$id','$stock','Credit','$date','$time')")or die(mysqli_error());
/// Update Stock Record ///



    $data['status']='success';
    $data['result']= '<div id="snackbar">Stock Updated Sucessfully...</div>
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

$updatedRow = "";
 $query = "SELECT p.*,symbol as size_symbol FROM products as p 
                              LEFT JOIN size_class as sc on p.class0=sc.id and sc.status='Active'
                             WHERE p.trash = 'No' and p.id='".$id."'";
$sq_im=mysqli_query($conn,$query);
$productInfo=mysqli_fetch_assoc($sq_im);

$rowNo= $_POST['rowNo'];
 $c=0;
                        if($productInfo['class0']!='')
                        {
                          $c++;  
                        }
                        if($productInfo['class1']!='')
                        {
                          $c++;  
                        }
                        if($productInfo['class2']!='')
                        {
                          $c++;  
                        }
                        if($productInfo['class3']!='')
                        {
                          $c++;  
                        }
$updatedRow .= '<td>'.$rowNo.'</td>                            
<td>'.$productInfo['product_name'].'</td>';

                                      if($c==3)
                                      {
      $thirdSize=mysqli_fetch_assoc(mysqli_query($conn,"SELECT symbol FROM size_class WHERE id=".$productInfo['class2']))['symbol'];

                                      $updatedRow .= '<td>'.$productInfo['class1'].'</td>
                                      <td>'.$productInfo['size_symbol'].'</td>
                                      <td>'.$thirdSize.'</td>';
                                   
                                    } 
                                    elseif($c==2)
                                      {
                                      
                                      $updatedRow .= '<td>'.$productInfo['class1'].'</td>
                                         <td>.'.$productInfo['size_symbol'].'</td>';
                                    } 
                                    elseif($c==1 && $query1[0]!=16)
                                    {
                                    $updatedRow .= '<td>'.$productInfo['size_symbol'].'</td>';
                                      
                                    }
                                 

if($data['discount']=='0' || $data['discount']==''){
$updatedRow .= '<td>'.$productInfo['price'].'</td>';
}
else
{
 $updatedRow .= '<td>'.$productInfo['discount'].'</td>';
   
}
$updatedRow .= '<td>';
if($productInfo['in_stock']==0){
    $updatedRow .= 'Out of Stock';
}else{
    $updatedRow .= $productInfo['in_stock'];
}
$updatedRow .= '</td>
<td>';

if( $productInfo['status']=='Active' ){ 
    $updatedRow .= '<a href="change_pdec.php?hid='.$productInfo['id'].'&type=status&product='.$productInfo['group_code'].'"><button class="btn btn-success" onClick="return confirm(\"Are you sure you want to Inactive this products\")">Active</button></a>';
}
else
{
    $updatedRow .= '<a href="change_pdec.php?hid='.$productInfo['id'].'&type=status&product='.$productInfo['group_code'].'"><button class="btn btn-danger" onClick="return confirm(\"Are you sure you want to Active this products\")">Inactive</button> </a>';
}
$updatedRow .= '</td>
<td>
<a data-toggle="modal" data-target="#manageStock" style="cursor: pointer;" onclick="manageStock('.$productInfo['id'].','.$rowNo.');"><span class="fa fa-cart-plus" title="Manage Stock"></span></a>&nbsp;&nbsp;&nbsp;
<a href="edit_product.php?id='.$productInfo['id'].'"><span class="fa fa-edit" title="Edit Details"></span></a>&nbsp;&nbsp;&nbsp;
<a href="trash-product.php?eid='.$productInfo['id'].'&Active=Inactive&trash=Yes&product='.$productInfo['group_code'].'" onClick="return confirm(\"Are you sure you want to Delete this Product\")"><i class="fa fa-trash" style=" "></i></a>
</td>';

 
$data['updatedRow']=$updatedRow;
$data['productId']=$id;
    }
    echo json_encode($data);

    ?>