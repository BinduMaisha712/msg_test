<?php
session_start();
include('config/connection.php');
if(isset($_SESSION['user']))
{
    header('location:index.php');
}
if(isset($_POST['login']))
{
   include('login-class.php');
} ?>


<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ==== Document Title ==== -->
    <title>ADMIN LOGIN</title>
    
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700%7CMontserrat:400,500">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome-all.min.css">
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

    <!-- Page Level Stylesheets -->

</head>
<body>
    <!-- Wrapper Start -->
    <div class="wrapper admin-bg">
        <!-- Login Page Start -->
        <div class="m-account-w">
            <div class="m-account">
                <div class="row no-gutters">
                    <div class="col-md-12">
                        <!-- Login Form Start -->
                        <div class="m-account--form-w" style="background-color:transparent;">
                            <div class="m-account--form">
                                <!-- Logo Start -->
                                <div class="logo">
                                    <?php
                    $query = 'select * from `logo` where id="1"';
      $query = mysqli_query($conn,$query);
      $logo = mysqli_fetch_array($query);
                        // $sql_logo=mysqli_query($conn,"select * from logo where id='1'");
                        // $var_logo=mysqli_fetch_assoc($sql_logo); 
                        ?>
                        <img src="../asset/image/logo/<?=$logo['logo']?>" alt="" >
                
                                </div>
                                <!-- Logo End -->

                                <form action="" method="post">
                                    <label class="m-account--title" style="color: #524233;">Login to admin account</label>
                                    <div style="color: white; text-align: center;"><?php include('session-error.php');?></div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-user"></i>
                                            </div>

                                            <input type="text" name="username" placeholder="Username" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <input type="password" name="password" placeholder="Password" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>

                                    <div class="m-account--actions">
                                        <!-- <a href="#" class="btn-link" style="color: #524233;">Forgot Password?</a> -->

                                        <button type="submit" class="btn btn-rounded btn-success" name="login">Login</button>
                                    </div>

                                    <div class="m-account--footer">
                                        <p style="color: #524233;">Copyright &copy; 2023 All Rights Reserved. | Powered by <a href="javascript:void(0);" target="_blank" style="color: #2a3364;">MSG</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Login Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Login Page End -->
    </div>
    <!-- Wrapper End -->

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/perfect-scrollbar.min.js"></script>
    <script src="assets/js/jquery.sparkline.min.js"></script>
    <script src="assets/js/raphael.min.js"></script>
    <script src="assets/js/morris.min.js"></script>
    <script src="assets/js/select2.min.js"></script>
    <script src="assets/js/jquery-jvectormap.min.js"></script>
    <script src="assets/js/jquery-jvectormap-world-mill.min.js"></script>
    <script src="assets/js/horizontal-timeline.min.js"></script>
    <script src="assets/js/jquery.validate.min.js"></script>
    <script src="assets/js/jquery.steps.min.js"></script>
    <script src="assets/js/dropzone.min.js"></script>
    <script src="assets/js/ion.rangeSlider.min.js"></script>
    <script src="assets/js/datatables.min.js"></script>
    <script src="assets/js/main.js"></script>

    <!-- Page Level Scripts -->

</body>
</html>
