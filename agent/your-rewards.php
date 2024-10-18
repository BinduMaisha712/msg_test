<?php
session_start();
include("config/connection.php");
include '../dadmin/functions/common.php';
if (!isset($_SESSION['agentLoginStatus']) || !$_SESSION['agentLoginStatus']) { ?>
<script>
window.location.href = '../agent-account.php';
</script>
<?php }
include('includes/header.php');
date_default_timezone_set("Asia/kolkata");
?>

<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="page--header">
        <div class="container-fluid">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-10">
                        <!-- Page Title Start -->
                        <h2 class="page--title h5">Rewards</h2>
                        <!-- Page Title End -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active"><span>Rewards Transactions</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <!-- Button trigger modal -->
                        <a class="btn btn-success" href="claim-rewards.php">
                            Claim Rewards
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="main--content">
        <div class="panel">
            <!-- Records List Start -->
            <div class="records--list" data-title="Reward Details">

                <table id="recordsListView">
                    <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Order Id</th>
                            <th>Order Amount</th>
                            <th>Reward Points</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $agent_id = $_SESSION['agent_loginid'];
                            $query=mysqli_query($conn,"SELECT * from agent_reward WHERE `agent_id` = '$agent_id' ORDER BY id DESC ");
                            $sr=1;
                            while($data=mysqli_fetch_array($query))
                            { ?>
                        <tr>
                            <td><?php echo $sr ?></td>
                            <td><?php echo $data['order_id'];?></td>
                            <td>&#8377;<?php echo ($data['order_amt'] -100); ?></td>
                            <td><?php echo $data['rp_credit'];?></td>
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