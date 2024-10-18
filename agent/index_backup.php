<?php
session_start();
include("config/connection.php");
 if(!isset($_SESSION['agentLoginStatus']) || !$_SESSION['agentLoginStatus'] ){?>
<script>
window.location.href = '../agent-account.php';
</script>
<?php } 
include('includes/header.php');

date_default_timezone_set("Asia/kolkata");

$agent_id = $_SESSION['agent_loginid'];
$agenteml = mysqli_fetch_assoc(mysqli_query($conn, "SELECT email FROM agents WHERE id = '$agent_id'"))['email'];

$agentuid = mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM user WHERE email = '$agenteml'"))['id'];
?>
<style type="text/css">
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

.mb--20 {
    margin-bottom: 20px;
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
                    <div class="col-lg-2">
                        <!-- Page Title Start -->
                        <h2 class="page--title h5">Dashboard</h2>
                        <!-- Page Title End -->

                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active"><span>Dashboard</span></li>
                        </ul>

                    </div>
                    <form action="" method="post" id="form">
                        <div class="col-lg-4">
                            <!-- Page Title Start -->
                            <div class="row form-group">
                                <div class="col-md-3" align="right">
                                    <h2 class="page--title h5">From</h2>
                                </div>
                                <div class="col-md-9">

                                    <h2 class="page--title h5"><input type="date" name="fromdate" id="fromdate"
                                            class="form-control" value="<?php if (!empty($_POST['fromdate'])) {
                                            echo $_POST['fromdate'];
                                            } else {
                                            echo date("Y-m-d");
                                            } ?>"></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <!-- Page Title Start -->
                            <div class="row form-group">
                                <div class="col-md-3" align="right">
                                    <h2 class="page--title h5">To</h2>
                                </div>
                                <div class="col-md-9">
                                    <h2 class="page--title h5"><input type="date" name="todate" id="todate"
                                            class="form-control" value="<?php if (!empty($_POST['todate'])) {
                                            echo $_POST['todate'];
                                            } else {
                                            echo date("Y-m-d");
                                            } ?>"></h2>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <button class="btn btn-success">Check</button>
                        </div>
                    </form>
                </div>
            </form>
        </div>
    </section>
    <!-- Page Header End -->


    <section class="main--content" id="main-content">

        <div class="row gutter-20">
            
            <!-- All Orders Starts -->
            <div class="col-md-3">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="orderAll">
                            <div class="miniStats--header bg-darker">

                                <p class="miniStats--label text-white bg-success">
                                    <!--<i class="fas fa-level-down-alt"></i>-->
                                    <span>All Orders</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <!--<i class="miniStats--icon fas fa-ticket-alt text-success"></i>-->
                            <a href="javascript:;" id="orderAll1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                <h3 class="miniStats--title h4">ALL Orders</h3>
                            </a>
                            <?php
                            if (!empty($_POST['fromdate'])) {
                                $fromdate = $_POST['fromdate'];
                                $todate = $_POST['todate'];
                                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND userid = '$agentuid' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['completedOrder'];
                            } else {
                                date_default_timezone_set("Asia/kolkata");
                                $fromdate = date("Y-m-d");
                                $todate = date("Y-m-d");
                                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND userid = '$agentuid' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['completedOrder'];
                            }

                            ?>
                            <p class="miniStats--num text-success"><?php echo $count; ?></p>
                        </div>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            $("#orderAll,#orderAll1").click(function(url) {
                                var fromdate = $("#fromdate").val();
                                var todate = $("#todate").val();
                                var win = window.open("view-order-all.php?fromdate=" + fromdate +
                                    "&todate=" + todate + "&status=Complete", '_blank');
                                win.focus();
                            });
                            $("#orderAll,#orderAll1").on("contextmenu", function(e) {
                                return false;
                            });

                        });
                        </script>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>
            <!-- All Orders Ends Here-->
            
            <!-- Completed Order Starts Here-->
            <div class="col-md-3">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="completeorder">
                            <div class="miniStats--header bg-darker">

                                <p class="miniStats--label text-white bg-success">
                                    <i class="fas fa-level-down-alt"></i>
                                    <span>Complete Order</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <i class="miniStats--icon fas fa-ticket-alt text-success"></i>
                            <a href="javascript:;" id="completeorder1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                <h3 class="miniStats--title h4">Complete Order</h3>
                            </a>
                            <?php
                            if (!empty($_POST['fromdate'])) {
                                $fromdate = $_POST['fromdate'];
                                $todate = $_POST['todate'];
                                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND userid = '$agentuid' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['completedOrder'];
                            } else {
                                date_default_timezone_set("Asia/kolkata");
                                $fromdate = date("Y-m-d");
                                $todate = date("Y-m-d");
                                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND userid = '$agentuid' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['completedOrder'];
                            }

                            ?>
                            <p class="miniStats--num text-success"><?php echo $count; ?></p>
                        </div>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            $("#completeorder,#completeorder1").click(function(url) {
                                var fromdate = $("#fromdate").val();
                                var todate = $("#todate").val();
                                var win = window.open("view-order.php?fromdate=" + fromdate +
                                    "&todate=" + todate + "&status=Complete", '_blank');
                                win.focus();
                            });
                            $("#completeorder,#completeorder1").on("contextmenu", function(e) {
                                return false;
                            });

                        });
                        </script>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>
            <!-- Completed Order Ends Here-->
            
            <!-- Pending Order Starts Here-->
            <div class="col-md-3">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="pendingorder">
                            <div class="miniStats--header bg-darker">

                                <p class="miniStats--label text-white bg-success">
                                    <i class="fas fa-level-up-alt"></i>
                                    <span>Pending Order</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <i class="miniStats--icon fas fa-rocket text-success"></i>
                            <a href="javascript:;" id="pendingorder1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                <h3 class="miniStats--title h4">Pending order</h3>
                            </a>
                            <?php
                if (!empty($_POST['fromdate'])) {
                  $fromdate = $_POST['fromdate'];
                  $todate = $_POST['todate'];
                  $sel_query = mysqli_query($conn, "SELECT * FROM `order_details` WHERE tracking_id NOT IN (SELECT tracking_id FROM `order_status`) AND `date` BETWEEN '$fromdate' AND '$todate'");
                  while ($sel_data = mysqli_fetch_array($sel_query)) {
                    $order_id[] = $sel_data['order_id'];
                    $order_id = array_unique($order_id);
                    $datas = count($order_id);
                  }
                } else {
                  date_default_timezone_set("Asia/kolkata");
                  $fromdate = date("Y-m-d");
                  $todate = date("Y-m-d");
                  $sel_query = mysqli_query($conn, "SELECT * FROM `order_details` WHERE tracking_id NOT IN (SELECT tracking_id FROM `order_status`) AND `date` BETWEEN '$fromdate' AND '$todate'");
                  while ($sel_data = mysqli_fetch_array($sel_query)) {
                    $order_id[] = $sel_data['order_id'];
                    $order_id = array_unique($order_id);
                    $datas = count($order_id);
                  }
                }
                //$data=mysqli_num_rows($query);

                ?>
                            <p class="miniStats--num text-success"><?php if (!empty($datas)) echo $datas;
                                                        else echo "0"; ?></p>
                        </div>

                        <script type="text/javascript">
                        $(document).ready(function() {
                            $("#pendingorder,#pendingorder1").click(function(url) {
                                var fromdate = $("#fromdate").val();
                                var todate = $("#todate").val();
                                var win = window.open("pending-order.php?status=Pending", '_blank');
                                win.focus();
                            });
                            $("#pendingorder,#pendingorder1").on("contextmenu", function(e) {
                                return false;
                            });
                        });
                        </script>


                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>
            <!-- Pending Order Ends Here-->
            
            <!-- Canceled Orders Starts -->
            <div class="col-md-3">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="canceledOrder">
                            <div class="miniStats--header bg-darker">

                                <p class="miniStats--label text-white bg-success">
                                    <!--<i class="fas fa-level-down-alt"></i>-->
                                    <span>Canceled Orders</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <!--<i class="miniStats--icon fas fa-ticket-alt text-success"></i>-->
                            <a href="javascript:;" id="canceledOrder1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                <h3 class="miniStats--title h4">Canceled Orders</h3>
                            </a>
                            <?php
                            if (!empty($_POST['fromdate'])) {
                                $fromdate = $_POST['fromdate'];
                                $todate = $_POST['todate'];
                                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND userid = '$agentuid' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['completedOrder'];
                            } else {
                                date_default_timezone_set("Asia/kolkata");
                                $fromdate = date("Y-m-d");
                                $todate = date("Y-m-d");
                                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND userid = '$agentuid' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['completedOrder'];
                            }

                            ?>
                            <p class="miniStats--num text-success"><?php echo $count; ?></p>
                        </div>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            $("#canceledOrder,#canceledOrder1").click(function(url) {
                                var fromdate = $("#fromdate").val();
                                var todate = $("#todate").val();
                                var win = window.open("view-order-canceled.php?fromdate=" + fromdate +
                                    "&todate=" + todate + "&status=Complete", '_blank');
                                win.focus();
                            });
                            $("#canceledOrder,#canceledOrder1").on("contextmenu", function(e) {
                                return false;
                            });

                        });
                        </script>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>
            <!-- Canceled Orders Ends Here-->
            
            <!-- Delivered Orders Starts -->
            <div class="col-md-3">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="deliveredOrder">
                            <div class="miniStats--header bg-darker">

                                <p class="miniStats--label text-white bg-success">
                                    <!--<i class="fas fa-level-down-alt"></i>-->
                                    <span>Delivered Orders</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <!--<i class="miniStats--icon fas fa-ticket-alt text-success"></i>-->
                            <a href="javascript:;" id="deliveredOrder1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                <h3 class="miniStats--title h4">Delivered Orders</h3>
                            </a>
                            <?php
                            if (!empty($_POST['fromdate'])) {
                                $fromdate = $_POST['fromdate'];
                                $todate = $_POST['todate'];
                                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND userid = '$agentuid' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['completedOrder'];
                            } else {
                                date_default_timezone_set("Asia/kolkata");
                                $fromdate = date("Y-m-d");
                                $todate = date("Y-m-d");
                                $sel_query1 = mysqli_query($conn, "SELECT COUNT(*) as total FROM `order_status` WHERE tracking_status = 'Cancelled' and user_id = '$agentuid';");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['total'];
                            }

                            ?>
                            <p class="miniStats--num text-success"><?php echo $count; ?></p>
                        </div>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            $("#deliveredOrder,#deliveredOrder1").click(function(url) {
                                var fromdate = $("#fromdate").val();
                                var todate = $("#todate").val();
                                var win = window.open("view-order-delivered.php?fromdate=" + fromdate +
                                    "&todate=" + todate + "&status=Complete", '_blank');
                                win.focus();
                            });
                            $("#deliveredOrder,#deliveredOrder1").on("contextmenu", function(e) {
                                return false;
                            });

                        });
                        </script>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>
            <!-- Canceled Orders Ends Here-->
            
            <!-- Out For Delivery Orders Starts -->
            <div class="col-md-3">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="outForDelivery">
                            <div class="miniStats--header bg-darker">

                                <p class="miniStats--label text-white bg-success">
                                    <!--<i class="fas fa-level-down-alt"></i>-->
                                    <span>Out for Delivery Orders</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <!--<i class="miniStats--icon fas fa-ticket-alt text-success"></i>-->
                            <a href="javascript:;" id="outForDelivery1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                <h3 class="miniStats--title h4">Out for Delivery</h3>
                            </a>
                            <?php
                            if (!empty($_POST['fromdate'])) {
                                $fromdate = $_POST['fromdate'];
                                $todate = $_POST['todate'];
                                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND userid = '$agentuid' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['completedOrder'];
                            } else {
                                date_default_timezone_set("Asia/kolkata");
                                $fromdate = date("Y-m-d");
                                $todate = date("Y-m-d");
                                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND userid = '$agentuid' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['completedOrder'];
                            }

                            ?>
                            <p class="miniStats--num text-success"><?php echo $count; ?></p>
                        </div>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            $("#outForDelivery,#outForDelivery1").click(function(url) {
                                var fromdate = $("#fromdate").val();
                                var todate = $("#todate").val();
                                var win = window.open("view-order-out-for-delivery.php?fromdate=" + fromdate +
                                    "&todate=" + todate + "&status=Complete", '_blank');
                                win.focus();
                            });
                            $("#outForDelivery,#outForDelivery").on("contextmenu", function(e) {
                                return false;
                            });

                        });
                        </script>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>
            <!-- Out for Delivery Orders Ends Here-->
            
            <!-- Received Orders Starts -->
            <div class="col-md-3">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="recievedOrders">
                            <div class="miniStats--header bg-darker">

                                <p class="miniStats--label text-white bg-success">
                                    <i class="fas fa-level-up-alt"></i>
                                    <span>Received Orders</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <!--<i class="miniStats--icon fas fa-ticket-alt text-success"></i>-->
                            <a href="javascript:;" id="recievedOrders1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                <h3 class="miniStats--title h4">Received Orders</h3>
                            </a>
                            <?php
                            if (!empty($_POST['fromdate'])) {
                                $fromdate = $_POST['fromdate'];
                                $todate = $_POST['todate'];
                                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND userid = '$agentuid' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['completedOrder'];
                            } else {
                                date_default_timezone_set("Asia/kolkata");
                                $fromdate = date("Y-m-d");
                                $todate = date("Y-m-d");
                                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND userid = '$agentuid' AND `date` BETWEEN '$fromdate' AND '$todate'");
                                $sel_data1 = mysqli_fetch_array($sel_query1);

                                $count = $sel_data1['completedOrder'];
                            }

                            ?>
                            <p class="miniStats--num text-success"><?php echo $count; ?></p>
                        </div>
                        <script type="text/javascript">
                        $(document).ready(function() {
                            $("#recievedOrders,#recievedOrders1").click(function(url) {
                                var fromdate = $("#fromdate").val();
                                var todate = $("#todate").val();
                                var win = window.open("view-order-received.php?fromdate=" + fromdate +
                                    "&todate=" + todate + "&status=Complete", '_blank');
                                win.focus();
                            });
                            $("#recievedOrders,#recievedOrders1").on("contextmenu", function(e) {
                                return false;
                            });

                        });
                        </script>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>
            <!-- Received Orders Ends Here-->
            
        </div>

        <div class="row gutter-20">

            <div class="col-md-12">
                <h3 class="page--title h5 mb--20">Wallet Details</h3>
            </div>
            <div class="col-md-3">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="currentbal">
                            <div class="miniStats--header bg-warning">
                                <p class="miniStats--label text-white bg-info">
                                    <i class="fas fa-level-down-alt"></i>
                                    <span>Wallet Balance</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <i class="miniStats--icon fas fa-rupee-sign text-success"></i>
                            <a href="javascript:;" id="currentbal1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;"> &nbsp;</p>
                                <h3 class="miniStats--title h4">Wallet Balance</h3>
                            </a>
                            <?php
                                $agent_id = $_SESSION['agent_loginid'];
                                $sel_query1 = mysqli_query($conn, "SELECT `balance` FROM `agents` WHERE `id` = '$agent_id'");

                                if ($sel_query1) {
                                    $row = mysqli_fetch_assoc($sel_query1);
                                    $wallet_balance = $row['balance'];
                                    echo '<p class="miniStats--num text-success">&#8377;' . number_format($wallet_balance) . '</p>';
                                } else {
                                    echo '<p class="miniStats--num text-danger">0</p>';
                                }
                            ?>
                        </div>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>
        </div>
        <div class="row gutter-20">

            <div class="col-md-12">
                <h3 class="page--title h5 mb--20">Rewards Details</h3>
            </div>
            <div class="col-md-3">
                <div class="panel">
                    <!-- Mini Stats Panel Start -->
                    <div class="miniStats--panel">
                        <a href="javascript:;" id="currentbal">
                            <div class="miniStats--header bg-warning">

                                <p class="miniStats--label text-white bg-info">
                                    <i class="fas fa-level-down-alt"></i>
                                    <span>Total Rewards Points</span>
                                </p>
                            </div>
                        </a>
                        <div class="miniStats--body">
                            <i class="miniStats--icon fas fa-rupee-sign text-success"></i>
                            <a href="javascript:;" id="currentbal1">
                                <p class="miniStats--caption text-success" style="margin-top: -24px;"> &nbsp;</p>
                                <h3 class="miniStats--title h4">Reward Balance</h3>
                            </a>
                            <?php
                                $agent_id = $_SESSION['agent_loginid'];
                                $sel_query1 = mysqli_query($conn, "SELECT `total_rewards` FROM `agents` WHERE `id` = '$agent_id'");

                                if ($sel_query1) {
                                    $row = mysqli_fetch_assoc($sel_query1);
                                    $wallet_balance = $row['total_rewards'];
                                    echo '<p class="miniStats--num text-success">&#8377;' . number_format($wallet_balance) . '</p>';
                                } else {
                                    echo '<p class="miniStats--num text-danger">0</p>';
                                }
                            ?>
                        </div>
                    </div>
                    <!-- Mini Stats Panel End -->
                </div>
            </div>
        </div>
    </section>






    <?php
  include('includes/footer.php');
  ?>