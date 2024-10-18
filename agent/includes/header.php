<?php   @session_start(); 
if ((!isset($_SESSION['agentLoginStatus']) || !$_SESSION['agentLoginStatus'])) {
    header('location:../agent-account.php');
}
include('config/connection.php');
if (isset($_SESSION['userLoginStatus']) && $_SESSION['userLoginStatus']) {
    $agemail = $_SESSION['email'];
    $row1 = mysqli_query($conn, "SELECT * FROM agents WHERE `email` = '$agemail'");
    if (mysqli_num_rows($row1) > 0) {
        $result1 = mysqli_fetch_array($row1);
        $_SESSION['agent_loginid'] = $result1['id']; // Use $result1 instead of $row1
        $_SESSION['agent_email'] = $result1['email']; // Use $result1 instead of $row1
        $_SESSION['agent_mobile'] = $result1['phone']; // Use $result1 instead of $row1
        $_SESSION['agentLoginStatus'] = true;
    }
}
    $query = 'SELECT * FROM currency WHERE id=1';
    
    $query1 = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($query1);
    $currency=$result['currency'] ?? '';
//     ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// print_r($_SESSION);
?>


<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ==== Document Title ==== -->
    <title>Dashboard - MSG</title>

    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- ==== Favicon ==== -->
    <?php
$query = 'SELECT * FROM fav_icon WHERE id=1';
    
    $query1 = mysqli_query($conn,$query);
    $favIcon = mysqli_fetch_assoc($query1)['icon'];
    ?>
    <link rel="icon" href="../asset/image/favIcon/<?=$favIcon;?>" type="image/x-icon">

    <!-- ==== Google Font ==== -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/jquery-ui.min.css">
    <link rel="stylesheet" href="assets/css/perfect-scrollbar.min.css">
    <link rel="stylesheet" href="assets/css/morris.min.css">
    <link rel="stylesheet" href="assets/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/jquery-jvectormap.min.css">
    <link rel="stylesheet" href="assets/css/horizontal-timeline.min.css">
    <link rel="stylesheet" href="assets/css/weather-icons.min.css">
    <link rel="stylesheet" href="assets/css/dropzone.min.css">
    <link rel="stylesheet" href="assets/css/ion.rangeSlider.min.css">
    <link rel="stylesheet" href="assets/css/ion.rangeSlider.skinFlat.min.css">
    <link rel="stylesheet" href="assets/css/datatables.min.css">
    <link rel="stylesheet" href="assets/css/fullcalendar.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel='stylesheet'
        href='https://cdn.jsdelivr.net/npm/bootstrap-colorpicker@3.0.3/dist/css/bootstrap-colorpicker.min.css'>
    <!--<link rel="stylesheet" href="./style.css">-->
    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

    <!-- Page Level Stylesheets -->

</head>

<body>

    <style>
    .logo img {
        width: 60px;
    }
    .linkcolo{
        color:#098ea3 !important;
    }
    .linkcolo:hover{
        color:#28a745 !important;
    }
    </style>
    <!-- Wrapper Start -->
    <div class="wrapper">
        <!-- Navbar Start -->
        <header class="navbar navbar-fixed">
            <!-- Navbar Header Start -->
            <div class="navbar--header">
                <!-- Logo Start -->
                <a href="index.php" class="logo">
                    <?php
                    $query = 'select * from `logo` where id="1"';
      $query = mysqli_query($conn,$query);
      $logo = mysqli_fetch_array($query);
                        // $sql_logo=mysqli_query($conn,"select * from logo where id='1'");
                        // $var_logo=mysqli_fetch_assoc($sql_logo); 
                        ?>
                    <img src="../asset/image/logo/<?=$logo['logo']?>" alt="" >
                </a>
                <!-- Logo End -->

                <!-- Sidebar Toggle Button Start -->
                <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                    <i class="fa fa-bars"></i>
                </a>
                <!-- Sidebar Toggle Button End -->
            </div>
            <!-- Navbar Header End -->

            <!-- Sidebar Toggle Button Start -->
            <a href="#" class="navbar--btn" data-toggle="sidebar" title="Toggle Sidebar">
                <i class="fa fa-bars"></i>
            </a>
            <!-- Sidebar Toggle Button End -->

            <!-- Navbar Search Start -->
            <!--<div class="navbar--search">
                <form action="search-results.php">
                    <input type="search" name="search" class="form-control" placeholder="Search Something..." required>
                    <button class="btn-link"><i class="fa fa-search"></i></button>
                </form>
            </div>-->
            <!-- Navbar Search End -->

            <div class="navbar--nav ml-auto">
                <ul class="nav"> 

                       <li class="nav-item dropdown online">
                        <a href="../index.php" class="nav-link linkcolo">
                           <i class="fa fa-home"></i> Shop With MSG
                        </a>

                    </li>
                    <!-- Nav User Start -->
                    <li class="nav-item dropdown nav--user online">
                        <a href="#" class="nav-link" data-toggle="dropdown">
                            <span>Profile</span>
                            <i class="fa fa-angle-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                           
                            <li><a href="profile.php"><i class="far fa-user"></i>Profile</a></li>
                            <li><a href="agent_change_password.php"><i class="fa fa-key"></i>Change Password </a></li>
                            <li><a href="logout.php"><i class="fa fa-power-off"></i>Logout</a></li>
                        </ul>
                    </li>
                    <!-- Nav User End -->
                </ul>
            </div>
        </header>
        <!-- Navbar End -->

        <!-- Sidebar Start -->
        <aside class="sidebar" data-trigger="scrollbar">
            <!-- Sidebar Profile Start -->
            <!--           <div class="sidebar--profile">
                <div class="profile--img">
                    <a href="#">
                        <img src="assets/img/avatars/01_80x80.png" alt="" class="rounded-circle" style="background-color: #d0c7de;">
                    </a>
                </div>

                <div class="profile--name">
                    <a href="#" class="btn-link">Consta Shop</a>
                </div>

                <div class="profile--nav">
                    <ul class="nav">
                        <li class="nav-item">
                            <a href="#" class="nav-link" title="User Profile">
                                <i class="fa fa-user"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" title="Lock Screen">
                                <i class="fa fa-lock"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" title="Messages">
                                <i class="fa fa-envelope"></i>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" title="Logout">
                                <i class="fa fa-sign-out-alt"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>-->
            <!-- Sidebar Profile End -->

            <!-- Sidebar Navigation Start -->
            <div class="sidebar--nav">
                <ul>
                    <li class="mb-0">
                        <ul class="pb-0">
                            <li class="">
                                <a href="index.php">
                                    <i class="fa fa-home"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="srb-sidebar-head-bg">Agent</a>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Wallet</span>
                                </a>

                                <ul>
                                    <li><a href="wallet-details.php">Wallet Details</a></li>
                                    <li><a href="recharge-wallet.php">Recharge Wallet</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Transactions</span>
                                </a>

                                <ul>
                                    <li><a href="transaction-details.php">Successful Wallet Transactions</a></li>
                                    <!--<li><a href="transaction-details-failed.php">Failed Wallet Transactions</a></li>-->
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Rewards</span>
                                </a>

                                <ul>
                                    <li><a href="reward-points.php">Reward Details</a></li>
                                    <li><a href="your-rewards.php">Your Rewards</a></li>
                                    <li><a href="your-achievements.php">Your Achivements</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Agent Commission</span>
                                </a>

                                <ul>
                                    <li><a href="agent-commission-history.php">Agent Commission History</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="srb-sidebar-head-bg">Order Details</a>

                        <ul>
                            <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Order History</span>
                                </a>
                                <ul>
                                    <li><a href="view-order.php">View Order</a></li>
                                    <!-- <li><a href="pending-order.php">Pending Order</a></li> -->
                                </ul>
                            </li>
                             <li>
                                <a href="#">
                                    <i class="fa fa-th"></i>
                                    <span>Track Order</span>
                                </a>
                                <ul>
                                    <li><a href="agent_track_order.php">Track Order</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>

                </ul>
            </div>
            <!-- Sidebar Navigation End -->
        </aside>
        <!-- Sidebar End -->