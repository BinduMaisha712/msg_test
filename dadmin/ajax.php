<?php 
include('config/connection.php');
$categoryId = $_POST['categoryId'];
$content='';
$query=mysqli_query($conn,"SELECT * FROM `subcategory` WHERE cat_id = $categoryId order by id asc"); 
if(mysqli_num_rows($query)>0)
{
    $content='<span class="label-text col-md-3 col-form-label">Select Sub-Category: *</span>
                <div class="col-md-9">
                    <select name="subcategory" id="subcat" class="form-control" required>
                        <option value="" selected>----select subcategory-----</option>';
                        while($data=mysqli_fetch_array($query))
                        {
                            $content.="<option value='".$data['id']."' data-clastype='".$data['classtype_id']."'>" .$data['sub_cat_name']."</option>";
                        }
    $content.="</div>";                
}
echo $content;

?>