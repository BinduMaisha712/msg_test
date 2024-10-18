<?php
// error_reporting(0);


include("config/connection.php");
include('includes/header.php');

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);


date_default_timezone_set("Asia/kolkata");
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

                  <h2 class="page--title h5"><input type="date" name="fromdate" id="fromdate" class="form-control" value="<?php if (!empty($_POST['fromdate'])) {
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
                  <h2 class="page--title h5"><input type="date" name="todate" id="todate" class="form-control" value="<?php if (!empty($_POST['todate'])) {
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
                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND `date` BETWEEN '$fromdate' AND '$todate'");
                $sel_data1 = mysqli_fetch_array($sel_query1);

                $count = $sel_data1['completedOrder'];
              } else {
                date_default_timezone_set("Asia/kolkata");
                $fromdate = date("Y-m-d");
                $todate = date("Y-m-d");
                $sel_query1 = mysqli_query($conn, "SELECT count(id) as completedOrder FROM `order_tbl`  WHERE order_status = 'Completed' AND `date` BETWEEN '$fromdate' AND '$todate'");
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
                  var win = window.open("view-order.php?fromdate=" + fromdate + "&todate=" + todate + "&status=Complete", '_blank');
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

      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="completeproducts">
              <div class="miniStats--header bg-darker">

                <p class="miniStats--label text-white bg-success">
                  <i class="fas fa-level-down-alt"></i>
                  <span>Complete Products</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-ticket-alt text-success"></i>
              <a href="javascript:;" id="completeproducts1">
                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                <h3 class="miniStats--title h4">Complete Products</h3>
              </a>
              <?php

              if (!empty($_POST['fromdate'])) {
                $fromdate = $_POST['fromdate'];
                $todate = $_POST['todate'];

                $query = mysqli_query($conn, "SELECT DISTINCT tracking_id FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Delivered'");
              } else {
                date_default_timezone_set("Asia/kolkata");
                $fromdate = date("Y-m-d");
                $todate = date("Y-m-d");
                $query = mysqli_query($conn, "SELECT DISTINCT tracking_id FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Delivered'");
              }

              $data = mysqli_num_rows($query);
              ?>
              <p class="miniStats--num text-success"><?php echo $data; ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#completeproducts,#completeproducts1").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  var win = window.open("view-order.php?fromdate=" + fromdate + "&todate=" + todate + "&status=ProductComplete", '_blank');
                  win.focus();
                });
                $("#completeproducts,#completeproducts1").on("contextmenu", function(e) {
                  return false;
                });

              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>

      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="receivedorder">
              <div class="miniStats--header bg-darker">
                <p class="miniStats--label text-white bg-blue">
                  <i class="fas fa-level-down-alt"></i>
                  <span>Received Order</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-ticket-alt text-blue"></i>
              <a href="javascript:;" id="receivedorderO">
                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                <h3 class="miniStats--title h4">Received Order</h3>
              </a>
              <?php
              if (!empty($_POST['fromdate'])) {
                $fromdate = $_POST['fromdate'];
                $todate = $_POST['todate'];
                $query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate'");
              } else {
                date_default_timezone_set("Asia/kolkata");
                $fromdate = date("Y-m-d");
                $todate = date("Y-m-d");
                $query = mysqli_query($conn, "SELECT * FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate'");
              }
              $data = mysqli_num_rows($query);

              ?>
              <p class="miniStats--num text-blue"><?php echo $data; ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#receivedorderO").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  var win = window.open("view-order.php?fromdate=" + fromdate + "&todate=" + todate + "&status=Received", '_blank');
                  win.focus();
                });
                $("#receivedorderO").on("contextmenu", function(e) {
                  return false;
                });
              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>


      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="receivedorder">
              <div class="miniStats--header bg-darker">

                <p class="miniStats--label text-white bg-blue">
                  <i class="fas fa-level-down-alt"></i>
                  <span>Received Products</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-ticket-alt text-blue"></i>
              <a href="javascript:;" id="receivedorder1">
                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                <h3 class="miniStats--title h4">Received Products</h3>
              </a>
              <?php
              if (!empty($_POST['fromdate'])) {
                $fromdate = $_POST['fromdate'];
                $todate = $_POST['todate'];

                $query = mysqli_query($conn, "SELECT * FROM `order_details` WHERE `date` BETWEEN '$fromdate' AND '$todate'");
              } else {
                date_default_timezone_set("Asia/kolkata");
                $fromdate = date("Y-m-d");
                $todate = date("Y-m-d");

                $query = mysqli_query($conn, "SELECT * FROM `order_details` WHERE `date` BETWEEN '$fromdate' AND '$todate'");
              }
              $data = mysqli_num_rows($query);

              ?>
              <p class="miniStats--num text-blue"><?php echo $data; ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#receivedorder,#receivedorder1").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  var win = window.open("view-order.php?fromdate=" + fromdate + "&todate=" + todate + "&status=productsReceived", '_blank');
                  win.focus();
                });
                $("#receivedorder,#receivedorder1").on("contextmenu", function(e) {
                  return false;
                });
              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>





      <?php
      $sel_query1 = mysqli_query($conn, "SELECT config_type FROM `order_config`  WHERE id = 1");
      $sel_data1 = mysqli_fetch_array($sel_query1);

      if ($sel_data1['config_type'] == 'Manual') {
      ?>



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

            </div>
            <!-- Mini Stats Panel End -->
          </div>
        </div>

        <div class="col-md-3">
          <div class="panel">
            <!-- Mini Stats Panel Start -->
            <div class="miniStats--panel">
              <a href="javascript:;" id="pendingorder">
                <div class="miniStats--header bg-darker">

                  <p class="miniStats--label text-white bg-success">
                    <i class="fas fa-level-up-alt"></i>
                    <span>Pending Products</span>
                  </p>
                </div>
              </a>
              <div class="miniStats--body">
                <i class="miniStats--icon fas fa-rocket text-success"></i>
                <a href="javascript:;" id="pendingorder1">
                  <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                  <h3 class="miniStats--title h4">Pending Products</h3>
                </a>
                <?php
                if (!empty($_POST['fromdate'])) {
                  $fromdate = $_POST['fromdate'];
                  $todate = $_POST['todate'];

                  $query = mysqli_query($conn, "SELECT DISTINCT tracking_id FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate') AND tracking_id NOT IN (SELECT tracking_id FROM `order_status`)");
                } else {
                  date_default_timezone_set("Asia/kolkata");
                  $fromdate = date("Y-m-d");
                  $todate = date("Y-m-d");

                  $query = mysqli_query($conn, "SELECT DISTINCT tracking_id FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate') AND tracking_id NOT IN (SELECT tracking_id FROM `order_status`)");
                }
                $data = mysqli_num_rows($query);

                ?>
                <p class="miniStats--num text-success"><?php echo $data; ?></p>
              </div>
              <script type="text/javascript">
                $(document).ready(function() {
                  $("#pendingorder,#pendingorder1").click(function(url) {
                    var fromdate = $("#fromdate").val();
                    var todate = $("#todate").val();
                    var win = window.open("pending-order.php?fromdate=" + fromdate + "&todate=" + todate + "&status=Pending", '_blank');
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


        <div class="col-md-3">
          <div class="panel">
            <!-- Mini Stats Panel Start -->
            <div class="miniStats--panel">
              <a href="javascript:;" id="pendingorder2">
                <div class="miniStats--header bg-darker">

                  <p class="miniStats--label text-white bg-success">
                    <i class="fas fa-level-up-alt"></i>
                    <span>Pending Order</span>
                  </p>
                </div>
              </a>
              <div class="miniStats--body">
                <i class="miniStats--icon fas fa-rocket text-success"></i>
                <a href="javascript:;" id="pendingorder3">
                  <p class="miniStats--caption text-success" style="margin-top: -24px;">Total</p>
                  <h3 class="miniStats--title h4">Pending order</h3>
                </a>
                <?php

                $sel_query = mysqli_query($conn, "SELECT * FROM `order_details` WHERE tracking_id NOT IN (SELECT tracking_id FROM `order_status`)");
                while ($sel_data = mysqli_fetch_array($sel_query)) {
                  $order_id[] = $sel_data['order_id'];
                  $order_id = array_unique($order_id);
                  $data = count($order_id);
                }
                ?>
                <p class="miniStats--num text-success"><?php echo $data; ?></p>
              </div>
              <script type="text/javascript">
                $(document).ready(function() {
                  $("#pendingorder2,#pendingorder3").click(function(url) {
                    var fromdate = $("#fromdate").val();
                    var todate = $("#todate").val();
                    var win = window.open("pending-order.php?status=Pending", '_blank');
                    win.focus();
                  });
                  $("#pendingorder2,#pendingorder3").on("contextmenu", function(e) {
                    return false;
                  });
                });
              </script>
            </div>
            <!-- Mini Stats Panel End -->
          </div>
        </div>

      <?php
      }                ///// Order Config Manual End
      ?>


      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="Cancelledorder">
              <div class="miniStats--header bg-darker">

                <p class="miniStats--label text-white bg-danger">
                  <i class="fas fa-level-up-alt"></i>
                  <span>Cancelled Order</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-rocket text-danger"></i>
              <a href="javascript:;" id="Cancelledorder1">
                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                <h3 class="miniStats--title h4">Cancelled order</h3>
              </a>
              <?php
              if (!empty($_POST['fromdate'])) {
                $fromdate = $_POST['fromdate'];
                $todate = $_POST['todate'];
                // $sel_query1=mysqli_query($conn,"SELECT * FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Cancelled'");
$sel_query1 = mysqli_query($conn, "SELECT order_id, MAX(date) AS max_date, tracking_status
FROM order_status
WHERE date BETWEEN '$fromdate' AND '$todate' AND tracking_status = 'Cancelled'
GROUP BY order_id, tracking_status");
$cancelledOrderCount = mysqli_num_rows($sel_query1);

              } else {
                date_default_timezone_set("Asia/kolkata");
                $fromdate = date("Y-m-d");
                $todate = date("Y-m-d");

                $sel_query1 = mysqli_query($conn, "SELECT order_id, MAX(date) AS max_date, tracking_status
FROM order_status
WHERE date BETWEEN '$fromdate' AND '$todate' AND tracking_status = 'Cancelled'
GROUP BY order_id, tracking_status");
$cancelledOrderCount = mysqli_num_rows($sel_query1);

              }

              ?>
              <p class="miniStats--num text-danger"><?php echo $cancelledOrderCount; ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#Cancelledorder,#Cancelledorder1").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  var win = window.open("view-order.php?fromdate=" + fromdate + "&todate=" + todate + "&status=Cancelled", '_blank');
                  win.focus();
                });
                $("#Cancelledorder,#Cancelledorder1").on("contextmenu", function(e) {
                  return false;
                });
              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>



      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="Cancelleproducts">
              <div class="miniStats--header bg-darker">
                <p class="miniStats--label text-white bg-danger">
                  <i class="fas fa-level-up-alt"></i>
                  <span>Cancelled Products</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-rocket text-danger"></i>
              <a href="javascript:;" id="Cancelleproducts1">
                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                <h3 class="miniStats--title h4">Cancelled Products</h3>
              </a>
              <?php
              if (!empty($_POST['fromdate'])) {
                $fromdate = $_POST['fromdate'];
                $todate = $_POST['todate'];
                //  $query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Cancelled'");
                 $query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Cancelled'");

              } else {
                date_default_timezone_set("Asia/kolkata");
                $fromdate = date("Y-m-d");
                $todate = date("Y-m-d");
                $query=mysqli_query($conn,"SELECT * FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Cancelled'");

              }
              $data = mysqli_num_rows($query);

              ?>
              <p class="miniStats--num text-danger"><?php echo $data; ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#Cancelleproducts,#Cancelleproducts1").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  var win = window.open("cancelled-products.php?fromdate=" + fromdate + "&todate=" + todate + "&status=Cancelled" + "&products=products", '_blank');
                  win.focus();
                });
                $("#Cancelleproducts,#Cancelleproducts1").on("contextmenu", function(e) {
                  return false;
                });
              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>

      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="Cancelledorder2">
              <div class="miniStats--header bg-darker">

                <p class="miniStats--label text-white bg-danger">
                  <i class="fas fa-level-up-alt"></i>
                  <span>Cancelled Order</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-rocket text-danger"></i>
              <a href="javascript:;" id="Cancelledorder3">
                <p class="miniStats--caption text-success" style="margin-top: -24px;">Total</p>
                <h3 class="miniStats--title h4">Cancelled order</h3>
              </a>
              <?php
              $count = 0;

                $sel_query1 = mysqli_query($conn, "SELECT order_id, MAX(date) AS max_date, tracking_status
FROM order_status
WHERE tracking_status = 'Cancelled'
GROUP BY order_id, tracking_status");
$cancelledOrderCount = mysqli_num_rows($sel_query1);

              $cancelledOrderCount = mysqli_num_rows($sel_query1);
              ?>
              <p class="miniStats--num text-danger"><?php echo $cancelledOrderCount; ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#Cancelledorder2,#Cancelledorder3").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  var win = window.open("view-order.php?status=Cancelled", '_blank');
                  win.focus();
                });
                $("#Cancelledorder2,#Cancelledorder3").on("contextmenu", function(e) {
                  return false;
                });
              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>

      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="deliverdfor">
              <div class="miniStats--header bg-darker">

                <p class="miniStats--label text-white bg-blue">
                  <i class="fas fa-level-down-alt"></i>
                  <span>Out of Delivery</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-ticket-alt text-blue"></i>
              <a href="javascript:;" id="deliverdfor1">
                <?php if (!isset($_POST['fromdate'])) { ?><p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p> <?php } else { ?><p class="miniStats--caption text-success" style="margin-top: -24px;">Total</p> <?php } ?>
                <h3 class="miniStats--title h4" style="font-size: 14px;">Out of Delivery</h3>
              </a>
              <?php
              if (!empty($_POST['fromdate'])) {
                $fromdate = $_POST['fromdate'];
                $todate = $_POST['todate'];
                $query = mysqli_query($conn, "SELECT DISTINCT tracking_id FROM `order_status` WHERE tracking_status='your item out for delivery' AND delivery_date BETWEEN '$fromdate' AND '$todate'");
              } else {
                date_default_timezone_set("Asia/kolkata");
                $fromdate = date("Y-m-d");
                $todate = date("Y-m-d");
                $query = mysqli_query($conn, "SELECT DISTINCT tracking_id FROM `order_status` WHERE tracking_status='your item out for delivery' AND delivery_date BETWEEN '$fromdate' AND '$todate'");
              }
              $data = mysqli_num_rows($query);

              ?>
              <p class="miniStats--num text-blue"><?php echo $data; ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#deliverdfor,#deliverdfor1").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  var win = window.open("view-order.php?fromdate=" + fromdate + "&todate=" + todate + "&status=Delivery", '_blank');
                  win.focus();
                });
                $("#deliverdfor,#deliverdfor1").on("contextmenu", function(e) {
                  return false;
                });
              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>

      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="nodeliverymenass">
              <div class="miniStats--header bg-darker">

                <p class="miniStats--label text-white bg-success">
                  <i class="fas fa-level-down-alt"></i>
                  <span>No Deliverymen Assign</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-ticket-alt text-success"></i>
              <a href="javascript:;" id="nodeliverymenass1">
                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                <h3 class="miniStats--title h4">NO D.men Assign</h3>
              </a>
              <?php
              if (!empty($_POST['fromdate'])) {
                $fromdate = $_POST['fromdate'];
                $todate = $_POST['todate'];

                $noDAssignQuery = "SELECT * FROM `order_details`  WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_id NOT IN (SELECT tracking_id FROM `delivery_schedule`) AND tracking_id NOT IN (SELECT tracking_id FROM order_status WHERE tracking_status='Cancelled') ORDER BY `id` DESC";
                //   print_r($noDAssignQuery);
                //   exit();   
                $query = mysqli_query($conn, $noDAssignQuery);
              } else {
                date_default_timezone_set("Asia/kolkata");
                $fromdate = date("Y-m-d");
                $todate = date("Y-m-d");
                $noDAssignQuery = "SELECT * FROM `order_details`  WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_id NOT IN (SELECT tracking_id FROM `delivery_schedule`) AND tracking_id NOT IN (SELECT tracking_id FROM order_status WHERE tracking_status='Cancelled') ORDER BY `id` DESC";
                // print_r($noDAssignQuery);
                // exit();   
                $query = mysqli_query($conn, $noDAssignQuery);
              }
              $data = mysqli_num_rows($query);

              ?>
              <p class="miniStats--num text-success"><?php echo $data; ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#nodeliverymenass,#nodeliverymenass1").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  var win = window.open("deliverymen-assign-order.php?fromdate=" + fromdate + "&todate=" + todate + "&status=Pending", '_blank');
                  win.focus();
                });
                $("#nodeliverymenass,#nodeliverymenass1").on("contextmenu", function(e) {
                  return false;
                })
              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>



      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="deliverymencancelled">
              <div class="miniStats--header bg-darker">

                <p class="miniStats--label text-white bg-danger">
                  <i class="fas fa-level-up-alt"></i>
                  <span style="font-size: 10px;">D.Men Cancelled Products</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-rocket text-danger"></i>
              <a href="javascript:;" id="deliverymencancelled1">
                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                <h3 class="miniStats--title h4">D.Men Products</h3>
              </a>
              <?php
              if (!empty($_POST['fromdate'])) {
                $fromdate = $_POST['fromdate'];
                $todate = $_POST['todate'];
                $query = mysqli_query($conn, "SELECT * FROM `delivery_schedule` WHERE delivery_status='Cancelled'  AND delivery_status_by='deliverymen' AND `dmen_date` BETWEEN '$fromdate' AND '$todate'");
              } else {
                date_default_timezone_set("Asia/kolkata");
                $fromdate = date("Y-m-d");
                $todate = date("Y-m-d");

                $query = mysqli_query($conn, "SELECT * FROM `delivery_schedule` WHERE delivery_status='Cancelled'  AND delivery_status_by='deliverymen' AND `dmen_date` BETWEEN '$fromdate' AND '$todate'");
              }
              $data = mysqli_num_rows($query);

              ?>
              <p class="miniStats--num text-danger"><?php echo $data; ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#deliverymencancelled,#deliverymencancelled1").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  var win = window.open("deliverymen-assign-order.php?fromdate=" + fromdate + "&todate=" + todate + "&status=Cancelled", '_blank');
                  win.focus();
                });
                $("#deliverymencancelled,#deliverymencancelled1").on("contextmenu", function(e) {
                  return false;
                })
              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>


      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="onlinepayment">
              <div class="miniStats--header bg-darker">

                <p class="miniStats--label text-white bg-success">
                  <i class="fas fa-level-up-alt"></i>
                  <span>Online Payment</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-rocket text-success"></i>
              <a href="javascript:;" id="onlinepayment1">
                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                <h3 class="miniStats--title h4">Online Payment</h3>
              </a>
              <?php
              if (!empty($_POST['fromdate'])) {
                $fromdate = $_POST['fromdate'];
                $todate = $_POST['todate'];
                $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE `date` BETWEEN '$fromdate' AND '$todate' AND payment_type='Online' AND payment_status='Success' ORDER BY id DESC");
              } else {
                date_default_timezone_set("Asia/kolkata");
                $fromdate = date("Y-m-d");
                $todate = date("Y-m-d");
                $query = mysqli_query($conn, "SELECT * FROM `order_tbl`  WHERE `date` BETWEEN '$fromdate' AND '$todate' AND payment_type='Online' AND payment_status='Success' ORDER BY id DESC");
              }
              //$data=mysqli_num_rows($query);
              $total = 0;
              while ($data = mysqli_fetch_array($query)) {
                $total += $data['orderprice'];
              }


              ?>
              <p class="miniStats--num text-success"><i class="fas fa-rupee-sign" aria-hidden="true"></i>&nbsp;<?php if ($total == 0) {
                                                                                                                  echo "0";
                                                                                                                } else {
                                                                                                                  echo $total;
                                                                                                                } ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#onlinepayment,#onlinepayment1").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  var win = window.open("view-order.php?fromdate=" + fromdate + "&todate=" + todate + "&payment=Online&status=Success", '_blank');
                  win.focus();
                });
                $("#onlinepayment,#onlinepayment1").on("contextmenu", function(e) {
                  return false;
                })
              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>

      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="cod">
              <div class="miniStats--header bg-darker">

                <p class="miniStats--label text-white bg-success">
                  <i class="fas fa-level-up-alt"></i>
                  <span>COD Payment</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-rocket text-success"></i>
              <a href="javascript:;" id="cod1">
                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                <h3 class="miniStats--title h4">COD Payment</h3>
              </a>
              <?php
              if (!empty($_POST['fromdate'])) {
                $fromdate = $_POST['fromdate'];
                $todate = $_POST['todate'];
                $query = mysqli_query($conn, "SELECT * FROM order_details WHERE tracking_id IN (SELECT tracking_id FROM order_status WHERE tracking_status='Delivered' AND `date` BETWEEN '$fromdate' AND '$todate') AND order_id IN (SELECT order_id FROM order_tbl WHERE payment_type='Cash On Delivery')");
              } else {
                date_default_timezone_set("Asia/kolkata");
                $fromdate = date("Y-m-d");
                $todate = date("Y-m-d");
                $query = mysqli_query($conn, "SELECT * FROM order_details WHERE tracking_id IN (SELECT tracking_id FROM order_status WHERE tracking_status='Delivered' AND `date` BETWEEN '$fromdate' AND '$todate') AND order_id IN (SELECT order_id FROM order_tbl WHERE payment_type='Cash On Delivery')");
              }
              //$data=mysqli_num_rows($query);
              $total1 = 0;
              while ($data = mysqli_fetch_array($query)) {
                $total1 += $data['price'];
              }


              ?>
              <p class="miniStats--num text-success"><i class="fas fa-rupee-sign" aria-hidden="true"></i>&nbsp;<?php if ($total1 == 0) {
                                                                                                                  echo "0";
                                                                                                                } else {
                                                                                                                  echo $total1;
                                                                                                                } ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#cod,#cod1").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  var win = window.open("view-order.php?fromdate=" + fromdate + "&todate=" + todate + "&payment=COD&status=Delivered", '_blank');
                  win.focus();
                });
                $("#cod,#cod1").on("contextmenu", function(e) {
                  return false;
                })
              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>

      <div class="col-md-3">
        <div class="panel">
          <!-- Mini Stats Panel Start -->
          <div class="miniStats--panel">
            <a href="javascript:;" id="totalpayment">
              <div class="miniStats--header bg-darker">

                <p class="miniStats--label text-white bg-success">
                  <i class="fas fa-level-up-alt"></i>
                  <span>Total Payment</span>
                </p>
              </div>
            </a>
            <div class="miniStats--body">
              <i class="miniStats--icon fas fa-rocket text-success"></i>
              <a href="javascript:;" id="totalpayment1">
                <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                <h3 class="miniStats--title h4">Total Payment</h3>
              </a>

              <p class="miniStats--num text-success"><i class="fas fa-rupee-sign" aria-hidden="true"></i>&nbsp;<?php echo $total + $total1;  ?></p>
            </div>
            <script type="text/javascript">
              $(document).ready(function() {
                $("#totalpayment,#totalpayment1").click(function(url) {
                  var fromdate = $("#fromdate").val();
                  var todate = $("#todate").val();
                  totalpayment
                });
                $("#totalpayment,#totalpayment1").on("contextmenu", function(e) {
                  return false;
                })
              });
            </script>
          </div>
          <!-- Mini Stats Panel End -->
        </div>
      </div>



    </div>
  </section>

  <?php
  include('includes/footer.php');
  ?>