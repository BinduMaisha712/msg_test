<?php

include ('includes/header.php');
?>
<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <!-- Records List Start -->
            <div class="records--list" data-title="Wallet Transactions">
                <table id="recordsListView">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Transaction ID</th>
                            <th>Amount</th>
                            <th>Action</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $agent_id = $_SESSION['agent_loginid'];
                            $mySqlQuery = "SELECT * FROM agent_transactions WHERE agent_id = '$agent_id' AND txn_status = 'Failed' ORDER BY id DESC;";
                            $query=mysqli_query($conn, $mySqlQuery);
                            
                            $sr=1;
                            while($data=mysqli_fetch_array($query))
                            { ?>
                        <tr>
                            <td><?php echo $sr ?></td>
                            <td><?php echo $data['txn_id'];?></td>
                            <td>&#8377;<?php echo $data['amount']; ?></td>
                            <td><?php echo $data['action'];?>
                            </td>
                            <td>
                                <?php if($data['txn_status'] == 'Success'){?>
                                <span class="text-success">Success</span>
                                <?php }else if ($data['txn_status'] == 'Pending'){?>
                                <span class="text-warning">Pending</span>
                                <?php } else {?>
                                <span class="text-danger">Failed</span>
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

    <!-- Main Footer Start -->
    <?php include('includes/footer.php'); ?>