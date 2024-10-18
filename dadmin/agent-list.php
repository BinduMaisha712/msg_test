<?php

include ('includes/header.php');
?>
<style>
.table-hover tr:hover {
    cursor: pointer;
}
</style>
<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <!-- Records List Start -->
            <div class="records--list">
                <table id="recordsListView" class="table-hover">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Agent Name</th>
                            <th>Status</th>
                            <th>Email </th>
                            <th>Address</th>
                            <th>Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            $query=mysqli_query($conn,"SELECT * from agents ORDER BY id ASC ");
                            $sr=1;

                            while($data=mysqli_fetch_array($query))

                            { ?>
                        <tr>
                            <td><?php echo $sr ?></td>
                            <td><?php echo $data['first_name'];?>&nbsp;<?php echo $data['last_name'];?></td>
                            <td><?php echo ($data['status'] == '0') ? '<span class="text-danger"> Pending </span>' : '<span class="text-success"> Authozied </span>';?>
                            </td>
                            <td><?php echo $data['email']?></td>
                            <td> 
                                <?php
                                $query3 = mysqli_query($conn, "SELECT flat, street, locality, city, zipcode, state FROM user WHERE agt_id='".$data['id']."'");
                                
                                if ( mysqli_num_rows($query3) > 0) {
                                    $address_data = mysqli_fetch_array($query3);
                           
                                    $query4 = mysqli_query($conn, "SELECT state FROM state_list WHERE country_id='99' AND id='".$address_data['state']."' ");
                                    $stated = mysqli_fetch_array($query4);
                                    
                                    echo $address_data['flat'] . ", " . $address_data['street'] . ", " . $address_data['locality'] . 
                                    ", " . $address_data['city'] . ", " . $address_data['zipcode'] . ", " . $stated['state'] . " India";
                                } else {
                                    echo "";
                                }
                                ?>

                            </td>
                            <td><?php echo $data['added_at'];?> </td>
                            <td data-toggle="modal" data-target="#modalverification"
                                onclick="updateStatus(<?= $data['id']; ?>,<?= $data['status']; ?>);">
                                <span class="btn btn-success">Change Status</span>
                            </td>
                        </tr>
                        <?php  $sr++; 
                            } ?>
                    </tbody>
                </table>
            </div>
            <!-- Records List End -->
        </div>
    </section>
    <!-- Main Content End -->
    <div class="modal fade" id="modalverification" tabindex="-1" role="dialog" aria-labelledby="modalverificationLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalverificationLabel">Authorize Agent</h5>
                    <button type="button" id="closeModel" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="verifyagent">
                        <input type="hidden" name="idagent" id="idagent" value="">
                        <div class="form-group">
                            <span class="col-form-label">Status: </span>

                            <select name="agent_status" id="agent_status" class="form-select" value="">
                                <option value="0" selected>Pending</option>
                                <option value="1">Authorized</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success m-2 ">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    function updateStatus(idagent, agent_status) {
        $("#idagent").val(idagent);
        $("#agent_status").val(agent_status);
    }

    $("#verifyagent").on("submit", function(e) {
        e.preventDefault();
        actionUrl = 'ajax/update-agent-status.php';
        formData = $(this).serialize();

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.status == 'success') {
                    window.location.href = 'agent-list.php';
                }
                $('#closeModel').click();
            },
            error: function(xhr, status, error) {
                console.log(error);
            }
        });
    });
    </script>
    <!-- Main Footer Start -->
    <?php include('includes/footer.php'); ?>