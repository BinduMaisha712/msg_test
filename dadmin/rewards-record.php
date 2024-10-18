<?php include('includes/header.php'); ?>
<style type="text/css">
.steps {
    display: none;
}
tr, td, th {
    width: 100%;
}
#agentData tr td{
    padding:3px;
}
#recordsList thead tr th{
    background:lightgray;
    padding:4px;
}
#recordsList{
    padding:20px;
}
</style>

<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <div class="panel-content p-4">
                <!-- Form Wizard Start -->
                <h3 style="border-bottom: 1px solid #ddd;">Rewards Record</h3>
                <section class="">
                    <form action="" method="post" id="form1">
                        <div class="row align-items-center">
                            <div class="col-12">
                                <label for="agentid" class="label-text col-form-label">Select Agent</label>
                                   <select required class="form-control" name="agentid" id="agentid" onchange="showAgentData(this.value)">
                                        <option selected value="">--Select Agent--</option>
                                       <?php
                                            $query = mysqli_query($conn, "SELECT DISTINCT agent_id FROM agent_reward;");
                                            while ($data = mysqli_fetch_array($query)) {
                                                $agent_id = $data['agent_id'];
                                                $query1 = mysqli_query($conn, "SELECT * FROM agents WHERE id='$agent_id' AND status='1' AND trash='0'");
                                                while ($data1 = mysqli_fetch_array($query1)) {
                                                    echo "<option value='" . $data1['id'] . "'>" . $data1['email'] . "</option>";
                                                }
                                            }
                                            ?>


                            </select>

                            </div>
                        </div>
                    </form>
                </section>
                <!-- Form Wizard End -->
            </div>
        </div>
        <div class="panel">
            <!-- Records List Start -->
            <div class="records--listt">
                <table id="recordsList" class="table-hover" style="display: none;">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Agent Email</th>
                            <th>Order ID</th>
                            <th>Order Amount</th>
                            <th>Rewards Points</th>
                            <th>Agent Stage</th>
                        </tr>
                    </thead>
                    <tbody id="agentData">
                    </tbody>
                </table>
            </div>
            <!-- Records List End -->
        </div>
    </section>
<script>
    function showAgentData(agentId) {
        if (agentId) {
            document.getElementById("recordsList").style.display = "block";
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("agentData").innerHTML = this.responseText;
                }
            };
            xmlhttp.open("GET", "ajax/get_agent_data.php?agentId=" + agentId, true);
            xmlhttp.send();
        } else {
            document.getElementById("recordsList").style.display = "none";
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        // Add event listeners to table headers for filtering
        var tableHeaders = document.querySelectorAll("#recordsList th");
        tableHeaders.forEach(function(header, index) {
            header.addEventListener("click", function() {
                sortTable(index);
            });
        });
    });

    function sortTable(index) {
        var table, rows, switching, i, x, y, shouldSwitch;
        table = document.getElementById("recordsList");
        switching = true;
        /* Make a loop that will continue until no switching has been done: */
        while (switching) {
            // Start by saying: no switching is done:
            switching = false;
            rows = table.rows;
            /* Loop through all table rows (except the first, which contains table headers): */
            for (i = 1; i < (rows.length - 1); i++) {
                // Start by saying there should be no switching:
                shouldSwitch = false;
                /* Get the two elements you want to compare, one from current row and one from the next: */
                x = rows[i].getElementsByTagName("TD")[index];
                y = rows[i + 1].getElementsByTagName("TD")[index];
                // Check if the two rows should switch place:
                if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                    // If so, mark as a switch and break the loop:
                    shouldSwitch = true;
                    break;
                }
            }
            if (shouldSwitch) {
                /* If a switch has been marked, make the switch and mark that a switch has been done: */
                rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                switching = true;
            }
        }
    }
</script>

    <!-- Main Footer Start -->
    <?php include('includes/footer.php'); ?>
    
        <script>
        

    </script>
    