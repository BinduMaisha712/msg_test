<?php 
include('config/connection.php');
$countryId = $_POST['countryId'];

$query=mysqli_query($conn,"SELECT * FROM `state_list` WHERE country_id = $countryId order by id asc"); 

          
           echo "<option>-----Select state-----</option>";                                   
                                            
        while($data=mysqli_fetch_array($query))
        {

        echo "<option value='".$data['id']."'>" .$data['state']."</option>";

        } 

?>
