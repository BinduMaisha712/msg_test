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
<style>
h4,
.h4 {
    font-size: 15px;
}

.miniStats--num {
    margin-top: 2px;
    font-size: 26px;
    line-height: 26px;
    font-weight: 600;
}
</style>
<!-- Main Container Start -->
<main class="main--container">
    <!-- Page Header Start -->
    <!-- Page Header Start -->
    <section class="page--header">
        <div class="container-fluid">
            <form action="" method="post">
                <div class="row">
                    <div class="col-lg-10">
                        <!-- Page Title Start -->
                        <h2 class="page--title h5">Dashboard</h2>
                        <!-- Page Title End -->
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active"><span>Wallet</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModal1">
                            + Recharge Wallet
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </section>



    <!-- Page Header End -->
    <style>
    .shadow-card {
        padding: 5px;
        min-height: 150px;
        border-radius: 20px;
        background: white;
        box-shadow: 20px 20px 60px #bebebe,
            -20px -20px 60px #ffffff;
    }
    </style>

    <section class="main--content" id="main-content">

        <div class="row gutter-20">
            <div class="col-md-4">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="completeorder">
                            <div class="miniStats--header bg-darker">

                                <p class="miniStats--label text-white bg-success">
                                    <i class="fas fa-level-down-alt"></i>
                                    <span>Total Expense</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <i class="miniStats--icon fas fa-ticket-alt text-success"></i>
                            <a href="javascript:;" id="completeorder1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;"> &nbsp;</p>
                                <h3 class="miniStats--title h4">Total Expense</h3>
                            </a>

                            <?php
                            $agent_id = $_SESSION['agent_loginid'];
                            $sel_query3 = mysqli_query($conn, "SELECT SUM(amount) as totalBalance FROM `agent_transactions` WHERE `action` = 'spent' AND `txn_status`='Success' AND `agent_id` = '$agent_id'");
                            
                            $sel_data3 = mysqli_fetch_array($sel_query3);
                            $totalexpbal = $sel_data3['totalBalance'];
                            ?>
                            <p class="miniStats--num text-success">&#8377;
                                <?= number_format($totalexpbal); ?>
                            </p>
                        </div>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>

            </div>
            <div class="col-md-4">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="completeorder">
                            <div class="miniStats--header bg-darker">

                                <p class="miniStats--label text-white bg-success">
                                    <i class="fas fa-level-down-alt"></i>
                                    <span>Current Balance</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <i class="miniStats--icon fas fa-ticket-alt text-success"></i>
                            <a href="javascript:;" id="completeorder1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;"> &nbsp;</p>
                                <h3 class="miniStats--title h4">Current Balance</h3>
                            </a>
                            <?php
                                $agent_id = $_SESSION['agent_loginid'];
                                $sel_query1 = mysqli_query($conn, "SELECT `balance` FROM `agents` WHERE `id` = '$agent_id'");

                                // Check if the query was successful
                                if ($sel_query1) {
                                    // Fetch the result
                                    $row = mysqli_fetch_assoc($sel_query1);

                                    // Extract the value from the result
                                    $wallet_balance = $row['balance'];

                                    // Output the formatted balance
                                    echo '<p class="miniStats--num text-success">&#8377;' . number_format($wallet_balance) . '</p>';
                                } else {
                                    // Handle the case where the query failed
                                    echo '<p class="miniStats--num text-danger">Error fetching wallet balance</p>';
                                }
                            ?>

                        </div>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>

            </div>

            <div class="col-md-4">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="completeorder">
                            <div class="miniStats--header bg-darker">

                                <p class="miniStats--label text-white bg-success">
                                    <i class="fas fa-level-down-alt"></i>
                                    <span>Pending Balance</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <i class="miniStats--icon fas fa-ticket-alt text-success"></i>
                            <a href="javascript:;" id="completeorder1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;"> &nbsp;</p>
                                <h3 class="miniStats--title h4">Pending Balance</h3>
                            </a>
                            <?php
                            $agent_id = $_SESSION['agent_loginid'];
                            
                            $sel_query2 = mysqli_query($conn, "SELECT SUM(amount) as totalBalance FROM `agent_transactions` WHERE `action` = 'added' AND `txn_status`='Pending' AND `paymentrp_status`='Success' AND `agent_id` = '$agent_id'");
                            $sel_data2 = mysqli_fetch_array($sel_query2);
                            $totalBalance2 = $sel_data2['totalBalance'];
                            ?>
                            <p class="miniStats--num text-success">&#8377;
                                <?= number_format($totalBalance2); ?>
                            </p>
                        </div>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>

            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel1">Recharge Wallet</h5>
                    <button type="button" id="closeModel" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="payform">
                        <input type="hidden" name="agent_loginid" id="agent_loginid" value="<?php echo $agent_id ?>">
                        <div class="form-group">
                            <span class=" col-form-label">Amount: </span>

                            <input type="number" class="form-control" name="amount" id="amount" placeholder="Amount"
                                value="" required>
                        </div>
                        <button id="payBtn" type="submit" class="btn btn-success m-2">Pay</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    include('includes/footer.php');?>