<?php 
include('config/connection.php');
  					//state and city code ==================
$countryId = $_POST['countryId'];

$query=mysqli_query($conn,"SELECT * FROM `city_list` WHERE country_id = '$countryId' order by city_name asc"); 
		echo "<option>---select city-----</option>";
        while($data=mysqli_fetch_array($query))
        {

        echo "<option value='".$data['id']."'>" .$data['city_name']."</option>";


        
        }


?>