    <?php
    error_reporting();
    include("config/connection.php");
    include('includes/header.php');
    date_default_timezone_set("Asia/kolkata");
    ?>
<style type="text/css">
h4, .h4 {
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
                                    <div class="col-md-3" align="right"><h2 class="page--title h5">From</h2></div>
                                    <div class="col-md-9">

                                       <h2 class="page--title h5"><input type="date" name="fromdate" id="fromdate" class="form-control" value="<?php if(!empty($_POST['fromdate'])){ echo $_POST['fromdate']; }else{ echo date("Y-m-d"); } ?>"></h2>
                                    </div>
                                </div>   
                            </div>
                             
                            <div class="col-lg-4">
                                <!-- Page Title Start -->
                                <div class="row form-group">
                                    <div class="col-md-3" align="right"><h2 class="page--title h5">To</h2></div>
                                    <div class="col-md-9"><h2 class="page--title h5"><input type="date" name="todate" id="todate" class="form-control" value="<?php if(!empty($_POST['todate'])){ echo $_POST['todate']; }else{ echo date("Y-m-d"); } ?>"></h2></div>
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
                                <a <?php if(isset($_POST['fromdate'])){ ?>href="javascript:;" id="completeorder" <?php }else{ ?>href="view-order.php?status=Complete" target="_blank" <?php } ?>>
                                <div class="miniStats--header bg-darker">
                              
                                    <p class="miniStats--label text-white bg-success">
                                        <i class="fa fa-level-down-alt"></i>
                                        <span>Complete Order</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-ticket-alt text-success"></i>
                                    <a href="javascript:;" id="completeorder1">
                                        <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p> 
                                        <h3 class="miniStats--title h4">Complete Order</h3>
                                    </a>
                                    <?php
                                    if(!empty($_POST['fromdate'])){
                                     $fromdate=$_POST['fromdate'];
                                     $todate=$_POST['todate'];
                              
                                     $query=mysqli_query("SELECT * FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Delivered'");
                                  }else{
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                    
                                        $query=mysqli_query("SELECT * FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Delivered'");

                                    }

                                        $data=mysqli_num_rows($query);
                                    ?>
                                    <p class="miniStats--num text-success"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#completeorder,#completeorder1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=Complete", '_blank');
                                                win.focus();
                                            });
                                            $("#completeorder,#completeorder1").on("contextmenu",function(e){
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
                                        <i class="fa fa-level-down-alt"></i>
                                        <span>Received Order</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-ticket-alt text-blue"></i>
                                    <a href="javascript:;" id="receivedorder1" >
                                        <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p> 
                                        <h3 class="miniStats--title h4">Received Order</h3>
                                    </a>
                                    <?php
                                    if(!empty($_POST['fromdate'])){
                                     $fromdate=$_POST['fromdate'];
                                     $todate=$_POST['todate'];
                                   
                                     $query=mysqli_query("SELECT * FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate')");
                                  }else{
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                 
                                        $query=mysqli_query("SELECT * FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate')");
                                    }
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-blue"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#receivedorder,#receivedorder1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=Received", '_blank');
                                                win.focus();
                                            });
                                            $("#receivedorder,#receivedorder1").on("contextmenu",function(e){
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
                                <a href="javascript:;" id="pendingorder">
                                <div class="miniStats--header bg-darker">
                                
                                    <p class="miniStats--label text-white bg-success">
                                        <i class="fa fa-level-up-alt"></i>
                                        <span>Pending Order</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-rocket text-success"></i>
                                    <a href="javascript:;" id="pendingorder1">
                                        <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                    <h3 class="miniStats--title h4">Pending order</h3>
                                    </a>
                                    <?php
                                    if(!empty($_POST['fromdate'])){
                                     $fromdate=$_POST['fromdate'];
                                     $todate=$_POST['todate'];
                                   
                                     $query=mysqli_query("SELECT * FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND order_id NOT IN (SELECT order_id FROM `order_status`))");
                                  }else{
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                    
                                        $query=mysqli_query("SELECT * FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND order_id NOT IN (SELECT order_id FROM `order_status`))");
                                    }
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-success"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#pendingorder,#pendingorder1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=Pending", '_blank');
                                                win.focus();
                                            });
                                            $("#pendingorder,#pendingorder1").on("contextmenu",function(e){
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
                                        <i class="fa fa-level-up-alt"></i>
                                        <span>Pending Order</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-rocket text-success"></i>
                                    <a href="javascript:;" id="pendingorder3">
                                    <p class="miniStats--caption text-success" style="margin-top: -24px;">Total</p>
                                    <h3 class="miniStats--title h4">Pending order</h3>
                                    </a>
                                    <?php
                                  
                                        $query=mysqli_query("SELECT * FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE order_id NOT IN (SELECT order_id FROM `order_status`))");
                                    
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-success"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#pendingorder2,#pendingorder3").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?status=Pending", '_blank');
                                                win.focus();
                                            });
                                            $("#pendingorder2,#pendingorder3").on("contextmenu",function(e){
                                                return false;
                                             });
                                    });
                                </script>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>
                </div>

                <div class="row gutter-20">
                   
                    <div class="col-md-3">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel">
                                <a href="javascript:;" id="Cancelledorder">
                                <div class="miniStats--header bg-darker">
                                
                                    <p class="miniStats--label text-white bg-danger">
                                        <i class="fa fa-level-up-alt"></i>
                                        <span>Cancelled Order</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-rocket text-danger"></i>
                                    <a href="javascript:;" id="Cancelledorder1">
                                        <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                    <h3 class="miniStats--title h4">Cancelled order</h3>
                                    </a>
                                    <?php
                                     if(!empty($_POST['fromdate'])){
                                     $fromdate=$_POST['fromdate'];
                                     $todate=$_POST['todate'];
                              
                                     $query=mysqli_query("SELECT * FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Cancelled'");
                                  }else{
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                        
                                        $query=mysqli_query("SELECT * FROM `order_status` WHERE `date` BETWEEN '$fromdate' AND '$todate' AND tracking_status='Cancelled'");
                                    }
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-danger"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#Cancelledorder,#Cancelledorder1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=Cancelled", '_blank');
                                                win.focus();
                                            });
                                            $("#Cancelledorder,#Cancelledorder1").on("contextmenu",function(e){
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
                                        <i class="fa fa-level-up-alt"></i>
                                        <span>Cancelled Order</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-rocket text-danger"></i>
                                    <a href="javascript:;" id="Cancelledorder3">
                                    <p class="miniStats--caption text-success" style="margin-top: -24px;">Total</p>
                                    <h3 class="miniStats--title h4">Cancelled order</h3>
                                    </a>
                                    <?php
                                  
                                        $query=mysqli_query("SELECT * FROM `order_status` WHERE tracking_status='Cancelled'");
                                    
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-danger"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#Cancelledorder2,#Cancelledorder3").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?status=Cancelled", '_blank');
                                                win.focus();
                                            });
                                            $("#Cancelledorder2,#Cancelledorder3").on("contextmenu",function(e){
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
                                <a href="javascript:;" id="deliverdfor" >
                                <div class="miniStats--header bg-darker">
                              
                                    <p class="miniStats--label text-white bg-blue">
                                        <i class="fa fa-level-down-alt"></i>
                                        <span>Order For Delivery</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-ticket-alt text-blue"></i>
                                    <a href="javascript:;" id="deliverdfor1" >
                                        <?php if(!isset($_POST['fromdate'])){ ?><p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p> <?php }else{ ?><p class="miniStats--caption text-success" style="margin-top: -24px;">Total</p> <?php } ?>
                                        <h3 class="miniStats--title h4">Order For Delivery</h3>
                                    </a>
                                   <?php
                                    if(!empty($_POST['fromdate'])){
                                     $fromdate=$_POST['fromdate'];
                                     $todate=$_POST['todate'];
                                    
                                    $query=mysqli_query("SELECT * FROM `order_details` WHERE tracking_id IN (SELECT tracking_id FROM order_status WHERE `delivery_date` BETWEEN '$fromdate' AND '$todate' AND tracking_status!='Cancelled')");
                                  }else{
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                        $query=mysqli_query("SELECT * FROM `order_details` WHERE tracking_id IN (SELECT tracking_id FROM order_status WHERE `delivery_date` BETWEEN '$fromdate' AND '$todate' AND tracking_status!='Cancelled')");

                                    }
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-blue"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#deliverdfor,#deliverdfor1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=Delivered", '_blank');
                                                win.focus();
                                            });
                                            $("#deliverdfor,#deliverdfor1").on("contextmenu",function(e){
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
                                        <i class="fa fa-level-down-alt"></i>
                                        <span>No Deliverymen Assign</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-ticket-alt text-success"></i>
                                    <a href="javascript:;" id="nodeliverymenass1">
                                        <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p> 
                                        <h3 class="miniStats--title h4">NO D.men Assign</h3>
                                    </a>
                                    <?php
                                    if(!empty($_POST['fromdate'])){
                                     $fromdate=$_POST['fromdate'];
                                     $todate=$_POST['todate'];
                              
                                     $query=mysqli_query("SELECT * FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate' And `order_id` NOT IN (SELECT order_id FROM `delivery_schedule`))");
                                  }else{
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                
                                        $query=mysqli_query("SELECT * FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate' And `order_id` NOT IN (SELECT order_id FROM `delivery_schedule`))");
                                    }
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-success"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#nodeliverymenass,#nodeliverymenass1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=nodeliverymenassign", '_blank');
                                                win.focus();
                                            });
                                            $("#nodeliverymenass,#nodeliverymenass1").on("contextmenu",function(e){
                                                return false;
                                             })
                                    });
                                </script>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>

                  </div>


                  <div class="row gutter-20">
                      <div class="col-md-3">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel">
                                <a href="javascript:;" id="nowarehouseass" >
                                <div class="miniStats--header bg-darker">
                              
                                    <p class="miniStats--label text-white bg-success">
                                        <i class="fa fa-level-down-alt"></i>
                                        <span>No W.house Assign</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-ticket-alt text-success"></i>
                                    <a href="javascript:;" id="nowarehouseass1" >
                                        <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p> 
                                        <h3 class="miniStats--title h4">No W.house Assign</h3>
                                    </a>
                                    <?php
                                    if(!empty($_POST['fromdate'])){
                                     $fromdate=$_POST['fromdate'];
                                     $todate=$_POST['todate'];
                       
                                     $query=mysqli_query("SELECT * FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate' And `order_id` NOT IN (SELECT order_id FROM `warehouse_schedule`))");
                                  }else{
                                       
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                 
                                        $query=mysqli_query("SELECT * FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate' And `order_id` NOT IN (SELECT order_id FROM `warehouse_schedule`))");
                                    }
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-success"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#nowarehouseass,#nowarehouseass1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=nowarehouseassign", '_blank');
                                                win.focus();
                                            });
                                            $("#nowarehouseass,#nowarehouseass1").on("contextmenu",function(e){
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
                                <a href="javascript:;" id="novendorass" >
                                <div class="miniStats--header bg-darker">
                              
                                    <p class="miniStats--label text-white bg-success">
                                        <i class="fa fa-level-down-alt"></i>
                                        <span>No Vendor Assign</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-ticket-alt text-success"></i>
                                    <a href="javascript:;" id="novendorass1" >
                                        <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p> 
                                        <h3 class="miniStats--title h4">No Vendor Assign</h3>
                                    </a>
                                    <?php
                                    if(!empty($_POST['fromdate'])){
                                     $fromdate=$_POST['fromdate'];
                                     $todate=$_POST['todate'];
                       
                                     $query=mysqli_query("SELECT * FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate' And `order_id` NOT IN (SELECT order_id FROM `vendor_order_tbl`))");
                                  }else{
                                       
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                 
                                        $query=mysqli_query("SELECT * FROM `order_details` WHERE order_id IN (SELECT order_id FROM `order_tbl` WHERE `date` BETWEEN '$fromdate' AND '$todate' And `order_id` NOT IN (SELECT order_id FROM `vendor_order_tbl`))");
                                    }
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-success"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#novendorass,#novendorass1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=novendorassign", '_blank');
                                                win.focus();
                                            });
                                            $("#novendorass,#novendorass1").on("contextmenu",function(e){
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
                                <a href="javascript:;" id="deliverymencancelled">
                                <div class="miniStats--header bg-darker">
                                
                                    <p class="miniStats--label text-white bg-danger">
                                        <i class="fa fa-level-up-alt"></i>
                                        <span style="font-size: 10px;">D.Men Cancelled Order</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-rocket text-danger"></i>
                                    <a href="javascript:;" id="deliverymencancelled1">
                                    <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                    <h3 class="miniStats--title h4">D.Men Cancelled</h3>
                                    </a>
                                    <?php
                                    if(!empty($_POST['fromdate'])){
                                     $fromdate=$_POST['fromdate'];
                                     $todate=$_POST['todate'];
                       
                                    $query=mysqli_query("SELECT order_id FROM `delivery_schedule` WHERE `dmen_date` BETWEEN '$fromdate' AND '$todate' AND `delivery_status`='Cancelled'  AND `delivery_status_by`='deliverymen'");    
                                  }else{
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                             
                                        $query=mysqli_query("SELECT order_id FROM `delivery_schedule` WHERE `dmen_date` BETWEEN '$fromdate' AND '$todate' AND `delivery_status`='Cancelled'  AND `delivery_status_by`='deliverymen'");
                                    }
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-danger"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#deliverymencancelled,#deliverymencancelled1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=Cancelled"+"&d=deliverymen", '_blank');
                                                win.focus();
                                            });
                                            $("#deliverymencancelled,#deliverymencancelled1").on("contextmenu",function(e){
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
                                <a href="javascript:;" id="warehousecancelled">
                                <div class="miniStats--header bg-darker">
                                
                                    <p class="miniStats--label text-white bg-danger">
                                        <i class="fa fa-level-up-alt"></i>
                                        <span style="font-size: 11px;">Warehouse Cancelled Order</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-rocket text-danger"></i>
                                    <a href="javascript:;" id="warehousecancelled1">
                                    <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                    <h3 class="miniStats--title h4">W.House Cancelled</h3>
                                    </a>
                                    <?php
                                      if(!empty($_POST['fromdate'])){
                                        $fromdate=$_POST['fromdate'];
                                         $todate=$_POST['todate']; 
                                        $query=mysqli_query("SELECT `order_id` FROM `warehouse_schedule` WHERE `order_status`='Cancelled' AND `order_status_by`='warehouse' AND `war_date` BETWEEN '$fromdate' AND '$todate'");   
                                  }else{
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                        $query=mysqli_query("SELECT `order_id` FROM `warehouse_schedule` WHERE `order_status`='Cancelled' AND `order_status_by`='warehouse' AND `war_date` BETWEEN '$fromdate' AND '$todate'");
                                    }
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-danger"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#warehousecancelled,#warehousecancelled1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=Cancelled"+"&w=warehouse", '_blank');
                                                win.focus();
                                            });
                                            $("#warehousecancelled,#warehousecancelled1").on("contextmenu",function(e){
                                                return false;
                                             })
                                    });
                                </script>
                            </div>
                            <!-- Mini Stats Panel End -->
                        </div>
                    </div>
                </div>


                <div class="row gutter-20">
                     <div class="col-md-3">
                        <div class="panel">
                            <!-- Mini Stats Panel Start -->
                            <div class="miniStats--panel">
                                <a href="javascript:;" id="vendorcancelled">
                                <div class="miniStats--header bg-darker">
                                
                                    <p class="miniStats--label text-white bg-danger">
                                        <i class="fa fa-level-up-alt"></i>
                                        <span style="font-size: 11px;">Vendor Cancelled Order</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-rocket text-danger"></i>
                                    <a href="javascript:;" id="vendorcancelled1">
                                    <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                    <h3 class="miniStats--title h4">Vendor Cancelled</h3>
                                    </a>
                                    <?php
                                      if(!empty($_POST['fromdate'])){
                                        $fromdate=$_POST['fromdate'];
                                         $todate=$_POST['todate']; 
                                        $query=mysqli_query("SELECT `order_id` FROM `vendor_order_tbl` WHERE `order_status`='Cancelled' AND `order_status_by`='vendor' AND `vendor_date` BETWEEN '$fromdate' AND '$todate'");   
                                  }else{
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                        $query=mysqli_query("SELECT `order_id` FROM `vendor_order_tbl` WHERE `order_status`='Cancelled' AND `order_status_by`='vendor' AND `vendor_date` BETWEEN '$fromdate' AND '$todate'");
                                    }
                                        $data=mysqli_num_rows($query);

                                    ?>
                                    <p class="miniStats--num text-danger"><?php echo $data; ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#vendorcancelled,#vendorcancelled1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=Cancelled"+"&v=vendor", '_blank');
                                                win.focus();
                                            });
                                            $("#vendorcancelled,#vendorcancelled1").on("contextmenu",function(e){
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
                                        <i class="fa fa-level-up-alt"></i>
                                        <span>Online Payment</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-rocket text-success"></i>
                                    <a href="javascript:;" id="onlinepayment1">
                                    <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                    <h3 class="miniStats--title h4">Online Payment</h3>
                                    </a>
                                    <?php
                                     if(!empty($_POST['fromdate'])){
                                     $fromdate=$_POST['fromdate'];
                                     $todate=$_POST['todate'];
                                   $query=mysqli_query("SELECT * FROM `order_tbl`  WHERE `date` BETWEEN '$fromdate' AND '$todate' AND payment_type='ONLINE PAYMENT' ORDER BY id DESC");    
                                  }else{
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                        $query=mysqli_query("SELECT * FROM `order_tbl`  WHERE `date` BETWEEN '$fromdate' AND '$todate' AND payment_type='ONLINE PAYMENT' ORDER BY id DESC");
                                    }
                                        //$data=mysqli_num_rows($query);
                                    $total=0;
                                        while($data=mysqli_fetch_array($query))
                                        {
                                            $total +=$data['orderprice'];
                                        }


                                    ?>
                                    <p class="miniStats--num text-success">$&nbsp;<?php if($total==0){ echo "0"; }else{  echo $total; } ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#onlinepayment,#onlinepayment1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=ONLINE PAYMENT", '_blank');
                                                win.focus();
                                            });
                                            $("#onlinepayment,#onlinepayment1").on("contextmenu",function(e){
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
                                        <i class="fa fa-level-up-alt"></i>
                                        <span>COD Payment</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-rocket text-success"></i>
                                    <a href="javascript:;" id="cod1">
                                    <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                    <h3 class="miniStats--title h4">COD Payment</h3>
                                    </a>
                                    <?php
                                     if(!empty($_POST['fromdate'])){
                                     $fromdate=$_POST['fromdate'];
                                     $todate=$_POST['todate'];
                                     $query=mysqli_query("SELECT * FROM `order_tbl`  WHERE `date` BETWEEN '$fromdate' AND '$todate' AND payment_type='CASH ON DELIVERY' AND order_id IN (SELECT order_id FROM `order_status` WHERE tracking_status='Delivered') ORDER BY id DESC");   
                                  }else{
                                        date_default_timezone_set("Asia/kolkata");
                                        $fromdate=date("Y-m-d");
                                        $todate=date("Y-m-d");
                                        $query=mysqli_query("SELECT * FROM `order_tbl`  WHERE `date` BETWEEN '$fromdate' AND '$todate' AND payment_type='CASH ON DELIVERY' AND order_id IN (SELECT order_id FROM `order_status` WHERE tracking_status='Delivered') ORDER BY id DESC");
                                    }
                                        //$data=mysqli_num_rows($query);
                                    $total1=0;
                                        while($data=mysqli_fetch_array($query))
                                        {
                                            $total1 +=$data['orderprice'];
                                        }


                                    ?>
                                    <p class="miniStats--num text-success">$&nbsp;<?php if($total1==0){ echo "0";}else{ echo $total1; } ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#cod,#cod1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=CASH ON DELIVERY", '_blank');
                                                win.focus();
                                            });
                                            $("#cod,#cod1").on("contextmenu",function(e){
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
                                        <i class="fa fa-level-up-alt"></i>
                                        <span>Total Payment</span>
                                    </p>
                                </div>
                                </a>
                                <div class="miniStats--body">
                                    <i class="miniStats--icon fa fa-rocket text-success"></i>
                                    <a href="javascript:;" id="totalpayment1">
                                    <p class="miniStats--caption text-success" style="margin-top: -24px;">By Date</p>
                                    <h3 class="miniStats--title h4">Total Payment</h3>
                                    </a>
                                 
                                    <p class="miniStats--num text-success">$&nbsp;<?php  echo $total+$total1;  ?></p>
                                </div>
                                <script type="text/javascript">
                                    $(document).ready(function(){
                                            $("#totalpayment,#totalpayment1").click(function(url){
                                                var fromdate=$("#fromdate").val();
                                                var todate=$("#todate").val();
                                                var win=window.open("view-order.php?fromdate="+fromdate+"&todate="+todate+"&status=TOTAL PAYMENT", '_blank');
                                                win.focus();
                                            });
                                            $("#totalpayment,#totalpayment1").on("contextmenu",function(e){
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
