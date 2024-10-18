<?php

include ('includes/header.php');
?>
<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <!-- Records List Start -->
            <div class="records--list" data-title="Agent Commission History">
                <table id="recordsListView">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Order ID</th>
                            <th>Amount (Discount)</th>
                            <th>Status</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $agent_id = $_SESSION['agent_loginid'];
                        $query = mysqli_query($conn, "SELECT * FROM agent_disc WHERE agent_id = $agent_id ORDER BY id DESC;");
                        $sr = 1;
                        while ($data = mysqli_fetch_array($query)) { ?>
                            <tr>
                                <td>
                                    <?php echo $sr ?>
                                </td>
                                <td>
                                    <?php echo $data['order_id']; ?>
                                </td>
                                <td>&#8377;
                                    <?php echo $data['amt']; ?>
                                </td>
                                <td><?php echo $data['status']; ?></td>
                                <td>
                                    <?php echo $data['disc_date']; ?>
                                </td>
                            </tr>
                            <?php $sr++;
                        } ?>
                    </tbody>
                </table>
            </div>
            <!-- Records List End -->
        </div>
    </section>
    <!-- Main Content End -->

    <!-- Main Footer Start -->
    <?php include ('includes/footer.php'); ?>