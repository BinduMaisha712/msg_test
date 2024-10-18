<?php
include('../config/connection.php');

if(isset($_GET['agentId']) && !empty($_GET['agentId'])) {
    $agentId = mysqli_real_escape_string($conn, $_GET['agentId']);

    $query = "SELECT * FROM agent_reward WHERE agent_id = '$agentId'";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
        $sr = 1;
            $result1 = mysqli_query($conn, "SELECT * FROM agents WHERE id = '$agentId'");
            $rowresult = mysqli_fetch_assoc($result1);
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $sr . "</td>";
            echo "<td>" . $rowresult['email'] . "</td>";
            echo "<td>" . $row['order_id'] . "</td>";
            echo "<td>&#8377;" . $row['order_amt'] . "</td>";
            echo "<td>&#8377;" . $row['rp_credit'] . "</td>";
            echo "<td>" . $rowresult['medal'] . "</td>";
            echo "</tr>";
            $sr++;
        }
    } else {
        echo "<tr><td colspan='5'>No data available for this agent.</td></tr>";
    }
} else {
    echo "<tr><td colspan='5'>Please select an agent.</td></tr>";
}
?>
