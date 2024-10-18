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
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Action</th>
                            <th>Payment Approval</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $query=mysqli_query($conn,"SELECT * FROM agent_transactions WHERE paymentrp_status = 'Success' ORDER BY id DESC;
                            ");
                            $sr=1;
                            while($data=mysqli_fetch_array($query))
                            { ?>
                        <tr>
                            <td><?php echo $sr ?></td>
                            <td><?php 
                            $agentId = $data['agent_id'];

                            $query1 = mysqli_query($conn, "SELECT * FROM agents WHERE id = $agentId");
                            while($data1=mysqli_fetch_array($query1)) {
                            ?>
                                <?php echo $data1['first_name'];?>&nbsp;<?php echo $data1['last_name'];?></td>
                            <?php } ?>
                            <td><?php echo $data['txn_id'];?></td>
                            <td>&#8377;<?php echo $data['amount']; ?></td>
                            <td><?php echo ($data['action'] == 'added') ? '<span class="text-success"> + Added </span>' : '<span class="text-danger"> - Spent </span>';?>
                            </td>
                            <td data-toggle="modal" data-target="#modalstatus"
                                onclick="updatePayment(<?= $data['id']; ?>,<?= $data['agent_id']; ?>,'<?= $data['txn_id']; ?>','<?= $data['txn_status']; ?>','<?= $data['amount']; ?>','<?= $data['action']; ?>');">
                                <?php if($data['txn_status'] == 'Success'){?>
                                <button class="btn paybtnks btn-success" value="Success">Success</button>
                                <?php }else if ($data['txn_status'] == 'Pending'){?>
                                <button class="btn paybtnks btn-warning" value="Pending">Pending</button>
                                <?php } else {?>
                                <button class="btn paybtnks btn-danger" value="Failed">Failed</button>
                                <?php } ?>
                            </td>
                            <td><?php echo $data['date'];?> </td>
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
    <div class="modal fade" id="modalstatus" tabindex="-1" role="dialog" aria-labelledby="modalstatusLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalstatusLabel">Recharge Wallet</h5>
                    <button type="button" id="closeModel" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="verifypayment">
                        <input type="hidden" name="idpayment" id="idpayment" value="">
                        <input type="hidden" name="agid" id="agid" value="">
                        <input type="hidden" name="txnss_id" id="txnss_id" value="">
                        <input type="hidden" name="amount" id="amount" value="">
                        <input type="hidden" name="action" id="action" value="">
                        <div class="form-group">
                            <span class="col-form-label">Status: </span>

                            <select name="payment_status" id="payment_status" class="form-select" value="">
                                <option value="Pending" selected>Pending</option>
                                <option value="Failed">Failed</option>
                                <option value="Success">Success</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-success m-2 ">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
    $(document).ready(function() {
        $('.paybtnks').each(function() {
            var buttonText = $(this).val().trim();
            if (buttonText === 'Success' || buttonText === 'Failed') {
                $(this).prop('disabled', true);
            }
        });
    });
    </script>


    <script>
    function updatePayment(id, agid, txn_id, txnsts, amount, action) {
        $("#idpayment").val(id);
        $("#agid").val(agid);
        $("#txnss_id").val(txn_id);
        $("#amount").val(amount);
        $("#payment_status").val(txnsts);
        $("#action").val(action);
    }

    $("#verifypayment").on("submit", function(e) {
        e.preventDefault();
        actionUrl = 'ajax/update-payment-status.php';
        formData = $(this).serialize();

        $.ajax({
            url: actionUrl,
            type: 'POST',
            data: formData,
            dataType: 'json',
            success: function(data) {
                console.log(data);
                if (data.status == 'success') {
                    window.location.href = 'agent-payment-confirmation.php';
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