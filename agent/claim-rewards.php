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
<style type="text/css">
    .steps {
        display: none;
    }
</style>
<style type="text/css">
    .info {
        background-color: #e7f3fe;
        border-left: 6px solid #2196F3;
        margin-bottom: 15px;
        padding: 4px 12px;

    }

    .select2-container .select2-selection--multiple,
    span.select2.select2-container.select2-container--default {
        width: 100% !important;
    }

    .select2-container--default .select2-search--inline .select2-search__field {
        background: transparent;
        border: none;
        outline: 0;
        box-shadow: none;
        /* -webkit-appearance: textfield; */
        width: 120px !important;
    }
</style>
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
                            <li class="breadcrumb-item active"><span>Claim Rewards</span></li>
                        </ul>
                    </div>
                    <div class="col-lg-2">
                        <!-- Button trigger modal -->
                        <a class="btn btn-success" href="your-rewards.php">
                            Back
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <section class="main--content">
        <div class="panel">
            <div class="panel-content">

                <!-- Form Wizard Start -->
                <form action="javascript:;" method="post" id="formWizard" class="form--wizard convertform">
                    <h3>ACHIEVEMENT NAME</h3>
                    <section>
                        <div class="row">

                            <div class="col-md-12">
                                <h4>Your current Medal is -
                                    <?php
                                    $agent_id = $_SESSION['agent_loginid'];
                                    $query = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from agents WHERE `id` = $agent_id"));
                                    $medal = $query['medal'];
                                    ?>
                                    <?= $medal; ?>
                                </h4>
                                <h4>You have total -
                                    <?php
                                    $agent_id = $_SESSION['agent_loginid'];
                                    $query2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from agents WHERE `id` = $agent_id"));
                                    $totalRewards = $query2['total_rewards'];
                                    ?>
                                    <?= $totalRewards; ?>
                                    Reward Point
                                </h4>
                                <h4>You can only redeem -
                                    <?php
                                    $query1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from achievement_structure WHERE `achievement` = '$medal'"));

                                    $redemption = $query1['redemption'];
                                    $redemPoints = ($totalRewards / 100) * $redemption;
                                    ?>
                                    <?= $redemPoints; ?>
                                    Points
                                </h4>
                                <h4>Converted Rewards Point will be -
                                    <?php
                                    $query1 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * from achievement_structure WHERE `achievement` = '$medal'"));

                                    $conversion = $query1['conversion'];
                                    $convertPoints = ($redemPoints / 100) * ($conversion / 100);
                                    ?>
                                    
                                    &#8377;<?= $convertPoints; ?>
                                </h4>
                            </div>
                        </div>
                    </section>
                        <h5>Click on the button below to get these points in your wallet</h5>
                        <input type="hidden" value="<?= $convertPoints; ?>" name="covert" id="covert">
                        <input type="hidden" value="<?= $redemPoints; ?>" name="rewardtotal" id="rewardtotal">
                        <input type="submit" class="btn btn-primary" name="submitcon" id="submitcon" value="Click Me">
                    
                </form>
            </div>
        </div>
    </section>
    <section class="main--content">
        <div class="panel">
            <!-- Records List Start -->
            <div class="records--list" data-title="Claim Rewards History">

                <table id="recordsListView">
                <thead>
                        <tr>
                            <th>Sr.No</th>
                            <th>Credited to Wallet</th>
                            <th>Transaction Id</th>
                            <th>Date</th>
                            <th>Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $agent_id = $_SESSION['agent_loginid'];
                            $query=mysqli_query($conn,"SELECT * from claim_rewards WHERE `agent_id` = '$agent_id' ORDER BY id DESC ");
                            $sr=1;
                            while($data=mysqli_fetch_array($query))
                            { ?>
                        <tr>
                            <td><?php echo $sr ?></td>
                            <td>&#8377;<?php echo $data['points'];?></td>
                            <td><?php echo $data['txn_id']; ?></td>
                            <td><?php echo $data['date'];?></td>
                            <td><?php echo $data['time'];?></td>
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
    <script>
        $(document).on("submit", ".convertform", function() {

            $.ajax({
                type: "POST",
                url: "ajax/claim-rewards.php",
                processData: false,
                contentType: false,
                data: new FormData(this),
                beforeSend: function() {
                    $("#submitcon").attr("disabled", "disabled");
                    $("#submitcon").html(
                        "<b> Please Wait </b> <i class='fa fa-spinner fa-spin' aria-hidden='true'></i>"
                    );
                },

                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status == true) {
                        window.setTimeout(function () {
                            location.reload();
                        }, 10);
                        alert("Successfully Done");
                    } else {
                        alert("There is some error");
                    }
                },
                complete: function() {
                    $("#submitcon").removeAttr("disabled", "disabled");
                    $("#submitcon").html("Click Me");
                },
            });
        });
    </script>