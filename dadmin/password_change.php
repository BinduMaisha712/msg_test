
 <?php 
    include('config/connection.php');
    include('includes/header.php');
    session_start();
?>


<!DOCTYPE html>
<html dir="ltr" lang="en" class="no-outlines">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- ==== Document Title ==== -->
    <title>Password Change</title>
    
    <!-- ==== Document Meta ==== -->
    <meta name="author" content="">
    <meta name="description" content="">
    <meta name="keywords" content="">

    <!-- ==== Favicon ==== -->
    <link rel="icon" href="favicon.png" type="image/png">

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
    <div class="wrapper">
        <!-- Register Page Start -->
        <div class="m-account-w" data-bg-img="">
            <div class="m-account">
                <div class="row no-gutters flex-row-reverse">
                  
                    <div class="col-md-10 col-md-offset-2">
                        <!-- Register Form Start -->
                        <div class="m-account--form-w" style="background-color: #d0c7de;">
                            <div class="m-account--form">
                                <!-- Logo Start -->
                                <div class="logo">
                                    <img src="assets/img/consta-shop-logo.png" alt="">
                                </div>
                                <!-- Logo End -->

                                <form action="" method="post">
<?php

                                        $sel_query=mysqli_query($conn,"SELECT * FROM `admin`");
                                      $sel_data=mysqli_fetch_array($sel_query);
                                    
?>
                                    <input type="hidden" name="password" id="password1" value="<?php echo $sel_data['password']; ?>" >
                                    <label class="m-account--title" style="color:#725d93;">Change Your Password</label>
                                    <div class="form-group">

                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <input type="password" name="old_password" placeholder="Old Password" id="old" onChange="isPasswordMatcha();" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <input type="password" name="new_password" placeholder="New Password" id="new" class="form-control" autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <i class="fas fa-key"></i>
                                            </div>

                                            <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm" onChange="isPasswordMatch();" class="form-control" autocomplete="off" required>
                                        </div><br>
                                        <div id="password"></div>
                                    </div>
                                    <div class="m-account--actions">
                                        <button type="submit" name="submit" id="submit" class="btn btn-block btn-rounded btn-success" value="submit" disabled="true">Submit</button>
                                    </div>

                                    <div class="m-account--footer">
                                       <p style="color: #725d93;" align="center">Copyright © 2019.<a href="http://www.constashop.com/" target="_blank" style="color: #ffa500;">Consta Shop</a> All Rights Reserved.  Powered by <a href="http://maishainfotech.com" target="_blank" style="color: #ffa500;">MAISHA INFOTECH PVT LTD</a></p>
                                    </div>
                                </form>
                                <?php
                                if(isset($_POST['submit']))
                                {
                                      $user=$_SESSION['user'];
                                      $sel_query=mysqli_query($conn,"SELECT * FROM `admin`");
                                      $sel_data=mysqli_fetch_array($sel_query);
                                      if($sel_data['password'] == $_POST['old_password'])
                                      {
                                        $new_password=$_POST['new_password'];
                                        $up_query=mysqli_query($conn,"UPDATE `admin` SET `password`='$new_password'");
                                            unset($_SESSION['user']); 
                                        ?>
                                            <script type="text/javascript">
                                                alert('password Change please login');
                                                window.location.href="login.php";
                                                 
                                            </script>
                                        <?php
                                      }else{
                                        ?>
                                            <script type="text/javascript">
                                                alert('user name and old password not match');
                                            </script>
                                        <?php
                                      }
                                }

                                ?>
                                    <script>
                                         function isPasswordMatch() {
                                        var password = $("#new").val();
                                        var confirmPassword = $("#confirm").val();
                                        var enter = $("#submit").val();
                                        

                                        if (password != confirmPassword)
                                            { 
                                                $("#password").html("New Password and Confirm Password do not match!");
                                                $("#password").css("color", "red");

                                            }
                                            else
                                            { 
                                                
                                                $('#submit').removeAttr('disabled');
                                                $("#password").html("Password match.");
                                                $("#password").css("color", "green");
                                                
                                            }
                                    }

                                    $(document).ready(function () {
                                        $("#confirm").keyup(isPasswordMatch);
                                    });
                                    function isPasswordMatcha() {
                                        var old = $("#old").val();
                                        var password = $("#password1").val();
                                          if (old != password)
                                            { 
                                                $("#password").html("Old Passwords do not match!");
                                                $("#password").css("color", "red");

                                            }
                                            else
                                            { 
                                                
                                                
                                                $("#password").html("Passwords match.");
                                                $("#password").css("color", "green");
                                                
                                            }
                                                                            
                                    }

                                    $(document).ready(function () {
                                        $("#old").keyup(isPasswordMatcha);
                                    });

                                 </script>
                            </div>
                        </div>
                        <!-- Register Form End -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Register Page End -->
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
