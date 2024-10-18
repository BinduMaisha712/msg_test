<?php
ob_start();
session_start();
include("config/connection.php");
include ('includes/header.php');
?>
<style type="text/css">
.steps {
    display: none;
}

.field-icon {
    float: right;
    margin-left: -25px;
    margin-top: -25px;
    position: relative;
    z-index: 2;
}
</style>

<!-- Main Container Start -->
<main class="main--container">
    <!-- Main Content Start -->
    <section class="main--content">
        <div class="panel">
            <div class="panel-content">
                <!-- Form Wizard Start -->
                <form action="" method="post" id="formWizard" class="form--wizard" enctype="multipart/form-data">
                    <h3>Change Password</h3>
                    <section>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>
                                        <span class="label-text">Old Password: *</span>
                                        <input type="password" name="old-password" class="form-control oldPassword" placeholder="Enter Old Password" required>
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" id="oldPassword"></span>
                                        <span id="error_oldpass" style="color: tomato;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>
                                        <span class="label-text">New Password: *</span>
                                        <input type="password" class="form-control password" name="new-password" placeholder="Enter New Password" required>
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" id="password"></span>
                                        <span id="error_newpass" style="color: tomato;"></span>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>
                                        <span class="label-text">Confirm Password: *</span>
                                        <input type="password" name="confirm-password" class="form-control confirmPassword" required>
                                        <span id="error_v" style="color: tomato;"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-9 offset-md-3">
                                <button class="btn btn-success" name="submit" id="sub" disabled>Submit</button>
                            </div>
                        </div>
                    </section>

                </form>
            </div>
        </div>
    </section>
    <!-- Main Content End -->

    <!-- Main Footer Start -->

    <?php include('includes/footer.php'); ?>
<script src="https://code.jquery.com/jquery-1.9.1.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    jQuery(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $(this).attr("id");
        var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
        $("." + input).attr("type", type);

    });
    jQuery(".password").keyup(function(e) {
        $(this).prop('type', 'password');
        var value = $(this).val();
        if (value != '') {
            var regex = /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
            var isValid = regex.test(value);
            $('#sub').show();
            if (!isValid) {
                $('#sub').hide();
                $("#error_newpass").html(
                    "Password must be minimum 8 characters which contain alphanumeric, one special Charracter "
                    );
            } else {
                $("#error_newpass").html('');
            }
        }
    });
    jQuery(".confirmPassword").keyup(function(e) {
        confirmPasswordValidationFn();
    });
    ////////// Confirm Password Validation //////////
    function confirmPasswordValidationFn() { // function START
        let password = $('.password').val();
        let rePassword = $('.confirmPassword').val();
        if (rePassword != '') {
            $('#sub').show();
            if (password == rePassword) {
                $('#error_v').html('');
            } else {
                $('#sub').hide();
                $('#error_v').html('Password and confirm password fields do not match');
            }
        }
    } // function END

    $(".oldPassword").keyup(function(e) {
        var value = $(this).val();
        console.log(value);
        $.ajax({
            url: 'agcorrect-password.php',
            type: 'POST',
            data: {
                pass: value,
                wuser: '<?php echo $_SESSION['agent_email']; ?>'
            },
            success: function(data) {
                console.log(data);
                $('#sub').show();
                $('#error_oldpass').html("");
                if (data == 0) {
                    $('#error_oldpass').html("Incorrect Password");
                    $('#sub').hide();
                }
            }
        })

    });
});


document.addEventListener('DOMContentLoaded', function() {
    const oldPassword = document.querySelector('.oldPassword');
    const newPassword = document.querySelector('.password');
    const confirmPassword = document.querySelector('.confirmPassword');
    const submitBtn = document.getElementById('sub');
    
    const errorOldPass = document.getElementById('error_oldpass');
    const errorNewPass = document.getElementById('error_newpass');
    const errorV = document.getElementById('error_v');
    
    function validateForm() {
        if (errorOldPass.innerText || errorNewPass.innerText || errorV.innerText) {
            submitBtn.disabled = true;
        } else {
            submitBtn.disabled = false;
        }
    }

    oldPassword.addEventListener('input', function() {
        // Placeholder for validation logic
        if (oldPassword.value === '') {
            errorOldPass.innerText = 'Old password is required';
        } else {
            errorOldPass.innerText = '';
        }
        validateForm();
    });

    newPassword.addEventListener('input', function() {
        // Placeholder for validation logic
        if (newPassword.value === '') {
            errorNewPass.innerText = 'New password is required';
        } else {
            errorNewPass.innerText = '';
        }
        validateForm();
    });

    confirmPassword.addEventListener('input', function() {
        // Placeholder for validation logic
        if (confirmPassword.value !== newPassword.value) {
            errorV.innerText = 'Passwords do not match';
        } else {
            errorV.innerText = '';
        }
        validateForm();
    });
});




</script>
<!-- Main Footer End -->
<?php 
if(isset($_POST['submit'])) {
    $oldpassword=md5($_POST['old-password']);
    $newPassword=md5($_POST['new-password']);
    $confirmPassword=md5($_POST['confirm-password']);
    if($newPassword==$confirmPassword) {
        $query = "SELECT * from agents where email='".$_SESSION['agent_email']."' AND password='".$oldpassword."'"; $result = mysqli_query($conn, $query) or die(mysql_error());
        $cnt = mysqli_num_rows($result);
        if($cnt >= 1) {
            $query1=mysqli_query($conn, "UPDATE agents SET password='".$confirmPassword."' WHERE email='".$_SESSION['agent_email']."'");
            $query2=mysqli_query($conn, "UPDATE user SET password='".$confirmPassword."' WHERE email='".$_SESSION['agent_email']."'");
            if($query1 && $query2) {
                echo '<div id="snackbar">Change Password Sucessfully...</div>';
                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                echo"var delay = 1000;setTimeout(function(){ window.location = 'agent_change_password.php'; }, delay);";
                echo "</script>";
            } else {
                echo '<div id="snackbar">Not Able to change password...</div>';
                echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
                echo"var delay = 1000;setTimeout(function(){ window.location = 'agent_change_password.php'; }, delay);";
                echo "</script>";
            }
        } else { 
            echo mysqli_error($conn);
            echo '<div id="snackbar">Incorrect Old Password...</div>';
            echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
            echo"var delay = 1000;setTimeout(function(){ window.location = 'agent_change_password.php'; }, delay);";
            echo "</script>";
        } 
    }
}
?>