 <?php include('includes/header.php'); ?>
    <style type="text/css">
        .steps{
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
                        <form action="" method="post" id="formWizard" class="form--wizard"enctype="multipart/form-data">
                            <h3>Change Password</h3>
                            <section>
                                <div class="row">
                                    
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Old Password: *</span>
                                                <input type="password" name="old-password" class="form-control oldPassword"
                                                placeholder="Enter Old Password" required> 
                                                 <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" id="oldPassword"></span><!-- </div> -->
                                                          <span id="error_oldpass" style="color: tomato;"></span> 
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">New Password: *</span>
                                                   <input type="password"  class="form-control password" name="new-password" placeholder="Enter New Password" required>
                                                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" id="password" ></span>
                                                        <!-- </div>     -->
                                                        <span id="error_newpass" style="color: tomato;"></span>

                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <label>
                                                <span class="label-text">Confirm Password: *</span>
                                                <input type="password" name="confirm-password" class="form-control confirmPassword" required/>
                                                        <span id="error_v" style="color: tomato;"></span>

                                            </label>
                                        </div>
                                    </div>
                                </div>
                                               <div class="row mt-3">
                <div class="col-md-9 offset-md-3">
                    <button class="btn btn-success" name="submit" id="sub">Submit</button>
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
            <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
 <script type="text/javascript">
    $(document).ready(function(){ 

       jQuery(".toggle-password").click(function() {
          $(this).toggleClass("fa-eye fa-eye-slash");
          var input = $(this).attr("id");
          var type = $(this).hasClass("fa-eye-slash") ? "text" : "password";
          $("."+input).attr("type", type);

      }); 

       jQuery(".password").keyup(function (e) {
        $(this).prop('type', 'password');
        var value = $(this).val();
        if (value != '') {
            var regex =  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{8,}$/;
            var isValid = regex.test(value);
            $('#sub').show();
            if (!isValid) {
             $('#sub').hide();
             $("#error_newpass").html("Password must be minimum 8 characters which contain alphanumeric, one special Charracter ");
         }
         else
         {
             $("#error_newpass").html(''); 
         }
     }
 });

    jQuery(".confirmPassword").keyup(function (e) {
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

$(".oldPassword").keyup(function (e) {
  
   var value = $(this).val();
   $.ajax({
        url: 'iscorrect-password.php',
           type: 'POST',
           data: {pass:value},
          success: function (data) 
          {
            $('#sub').show();
            $('#error_oldpass').html("");
            if(data==0)
            {
            $('#error_oldpass').html("Incorrect Password");
            $('#sub').hide();
            }
          }    
      })

});
   });






   </script>
    
            <!-- Main Footer End -->

            <?php
            if(isset($_POST['submit']))
            {
               
$oldpassword=$_POST['old-password'];
$newPassword=$_POST['new-password'];
$confirmPassword=$_POST['confirm-password'];


if($newPassword==$confirmPassword)
{
$query = "SELECT * from admin where user_name='".$_SESSION['user']."' AND password='".$oldpassword."'";
$result = mysqli_query($conn, $query) or die(mysql_error());
$cnt = mysqli_num_rows($result);
if($cnt >= 1)
{
$query1=mysqli_query($conn, "UPDATE admin SET password='".$confirmPassword."' WHERE user_name='".$_SESSION['user']."'");
if($query1)
echo '<div id="snackbar">Change Password Sucessfully...</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo"var delay = 1000;setTimeout(function(){ window.location = 'change-password.php'; }, delay);";
        echo "</script>";
    
}
else
{
    echo '<div id="snackbar">Incoreect Old Password...</div>';
        echo "<script type='text/javascript'>var x = document.getElementById('snackbar');x.className = 'show';setTimeout(function(){ x.className = x.className.replace('show', ''); }, 3000);";
        echo"var delay = 1000;setTimeout(function(){ window.location = 'add-products.php'; }, delay);";
        echo "</script>";

}
}

            }

            ?>