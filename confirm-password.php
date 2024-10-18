<?php
include('header.php');
$mobile = "";
if (isset($_GET['token'])) {
    $mobile = $_GET['token'];
    $userid = $_GET['tokentwo'];
} else {
?>
    <script>
        window.location.href = "index.php";
    </script>
<?php
}
?>
<style>
    .login_main {
        border: #dcdee3 solid 1px;
        padding: 25px 25px 10px;
        margin: auto;
        font-size: 15px;
        position: relative;
    }

    .main_conform_box h1 {
        text-align: center;
        margin-bottom: 10px;
        background: #ffffff;
        color: #17263e;
        font-size: 18px;
        padding: 15px 0;
        position: relative;
        float: left;
        width: 100%;
        border-bottom: 1px solid #dcdee3;
    }

    .main_conform_box .form-control {
        padding: 11px 200px;
    }

    .banner {
        margin-top: 30px;
        height: 200px !important;
    }

    .container-fluid {
        width: 100%;
        margin: auto;
        padding: 0px;
    }

    .container-fluid img {
        width: 100%;
    }

    .conform-box {
        margin-bottom: 50px;
    }

    .conform-box input {
        padding-left: 12px !important;
    }
</style>
<style type="text/css">
    .field-icon {
        float: right;
        right: 7px;
        margin-top: -28px;
        position: relative;
        z-index: 2;
    }

    .main_conform_box.checkoutaccordion {
        margin-bottom: 0px;
    }

    .checkoutaccordion h4 {
        margin-bottom: 0px;
    }

    input.form-control {
        border-radius: 10px;
    }

    .err_msg {
        color: red;
        font-size: 11px;
        margin-top: 10px;
        max-width: 375px;
    }

    .confrm-pass-bg {
        background-color: #f6f6f6;
        width: 45%;
        margin: auto;
        border-radius: 10px;
        padding: 17px;
        position: relative;
    }

    .confrm-pass-bg:before {
        content: "";
        position: absolute;
        width: 100%;
        height: 27px;
        border-radius: 10px;
        top: -12px;
        background-color: rgb(189 189 189);
        left: 0;
        -webkit-transform: scale(0.95);
        transform: scale(0.95);
        z-index: -1;
    }
</style>

<section class="heading-banner-area pt-30">
    <div class="container">
        <!--Account Info area start-->
        <div class="conforminfo">
            <div class="container conform-box">
                <div class="row align-items-center" style="display:flex;">
                    <div class="col-lg-12 col-sm-12">
                        <div class="confrm-pass-bg">
                            <div class="main_conform_box checkoutaccordion">
                                <img class="border-radius-15" src="assets/img/conf-pass.png" alt="">
                                <h4 class="mb-4 mt-3">Create New Password</h4>
                            </div>
                            <div>
                                <form action="3" method="post" class="reset-block " id="confirmPasswordotpcic">
                                    <div class="form-group mb-3">
                                        <input type="hidden" name="" id="mobileotp" value="<?php echo $mobile; ?>">
                                        <input type="hidden" name="" id="userid" value="<?php echo $userid; ?>">
                                        <div class="icon"><i class="icon-lock icons"></i></div>
                                        <input type="password" name="newPassword" placeholder="Enter New Password" id="newPassword" value="" class="form-control checking input_check newPassword" required>
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                    <div class="form-group">
                                        <div class="icon"><i class="icon-lock icons"></i></div>
                                        <input type="password" name="userPassword" value="" placeholder="Confirm Password" class="form-control password" id="confirmPassword" required>
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-passwordtwo"></span>
                                        <div class="err_msg" id="userPasswordErrMsg"></div>
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="cbtn-animation btn btn-primary btn-roundeduser_login userRegBtn" id="lg_btn"><span id="#">SUBMIT</span></button>
                                    </div> <br />
                                    <div id="errorW" style="color: red">

                                    </div>
                                    <div class="trueotp" style="color: red">

                                    </div>
                                    <div class="sucesotp" style="color: green">

                                    </div>
                                    <br />
                                </form>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
        <!-- Account Info area end-->
    </div>
</section>


<!--footer area start-->
<script type="text/javascript">
    var max = 0;
</script>
<?php include('include/footer.php'); ?>
<script type="text/javascript">
    $('#confirmPasswordotpcic').on('submit', function(e) {
        e.preventDefault();
        var mobileotp = $('#mobileotp').val();
        var newPassword = $('#newPassword').val();
        var userid = $('#userid').val();
        var confirmPassword = $('#confirmPassword').val();
        $('#lg_btn').hide();
        $('#errorW').text('Please wait...');
        if (newPassword != confirmPassword) {
            $('#lg_btn').show();
            $('#errorW').text('Password not match. Please try again');

            return false;
        } else {

            $.ajax({
                url: 'changepassword.php',
                method: 'post',
                data: 'token=' + mobileotp + "&userid=" + userid + "&passw=" + confirmPassword,
                success: function(dataa) {
                    var result = JSON.parse(dataa);
                   
                    if (result.status == "success" && result.agent == '') {
                        $('#errorW').text('');
                        $('.sucesotp').text(result.message);
                        window.location.href = "account.php";
                    }  
                    if (result.status == "success" && result.agent != '') {
                        $('#errorW').text('');
                        $('.sucesotp').text(result.message);
                        window.location.href = "agent-account.php";
                    }
                    if (result.status == "failed") {
                        $('#lg_btn').show();
                        $('#errorW').text(result.message);
                    }



                }
            })
        }
    })


    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        var x = document.getElementById("newPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    });

    $(".toggle-passwordtwo").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        var x = document.getElementById("confirmPassword");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    });

    $(".password").on("keyup", function(e) {
        $(this).prop('type', 'password');
        var value = $(this).val();
        if (value != '') {
            var regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
            var isValid = regex.test(value);
            if (!isValid) {
                $(".err_msg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Password must between 8 to 15 characters which contain at least one numeric digit,one special character, one uppercase and one lowercase letter</div>");
            }
        }
    });

    $(".newPassword").on("keyup", function(e) {
        $(this).prop('type', 'password');
        var value = $(this).val();
        if (value != '') {
            var regex = /^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/;
            var isValid = regex.test(value);
            if (!isValid) {
                $(".err_msg").html("<div class='err_msg' id='" + this.id + "ErrMsg'>Password must between 8 to 15 characters which contain at least one numeric digit,one special character, one uppercase and one lowercase letter</div>");
            }
        }
    });
</script>