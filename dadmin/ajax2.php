<?php 
include('config/connection.php');
$categoryId = $_POST['categoryId'];

$query=mysqli_query("SELECT * FROM `subcategory` WHERE cat_id = $categoryId order by id asc"); 

			echo "<option value=''>----select subcategory----</option>";

        while($data=mysqli_fetch_array($query))
        {

        echo "<option value='".$data['id']."'>" .$data['sub_cat_name']."</option>";
        }



?>