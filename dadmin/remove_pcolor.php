<?php 
include('config/connection.php');
$id=$_POST['id'];
// mysqli_query($conn,"delete from products where id='$id'"); 
$sl=mysqli_query($conn,"select * from products where id='$id'");
$ro=mysqli_fetch_assoc($sl);
mysqli_query($conn,"delete from products where id='".$id."'") or die(mysqli_error()); 
$sql1a=mysqli_query($conn,"select * from products where product_code='".$ro['product_code']."' order by id desc");
while ($roww1=mysqli_fetch_assoc($sql1a))
{
    $p_weight[]=$roww1['weight'];
}
mysqli_query($conn,"delete from wishlist where product_id='$id'");
mysqli_query($conn,"delete from add_cart where pid='$id'");
?>
<div class="form-group row">
                                        <span class="label-text col-md-3 col-form-label">Weight Class: </span>
                                        <div class="col-md-9">
                                            
                                            <select name="weight[]" class="form-control"  id="weight" onchange="getweight(this)" multiple="">
                                                <?php
                                                //print_r($p_weight);
                                                $sql_w= mysqli_query($conn, "select * from weight where status='Active'");
                                                while($row_w=mysqli_fetch_assoc($sql_w))
                                                {
                                                    $sql_wc= mysqli_query($conn,"select * from weight_class where id='".$row_w['class']."'");
                                                    $row_wc= mysqli_fetch_assoc($sql_wc);
                                                    $check_w=$row_w['name'].$row_wc['symbol'];
                                                    if(in_array($check_w,$p_weight))
                                                    {}
                                                    else
                                                    { ?>
                                                        <option value="<?=$row_w['name'].$row_wc['symbol'];?>"><?=$row_w['name']." ".ucwords($row_wc['name'])?></option>
                                                <?php
                                                    }
                                                }?>
                                            </select>
                                        </div>
                                    </div>
