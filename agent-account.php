<?php
include('header.php');
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_GET['url'])) {
  $url = urldecode($_GET['url']);
}
$dashboard = new Dashboard($con);
if (isset($_SESSION['agentLoginStatus']) && $_SESSION['agentLoginStatus'] == true) {
  
?>
  <script type="text/javascript">
    window.location.href = "agent/index.php";
  </script>
<?php
}

?>
<link rel="stylesheet" href="assets/css/account.css">
<style>
    .regi_main_hny{
        width: 80%;
        margin: auto;
        position: relative;
    }
</style>

<!--Heading Banner Area End-->
<!--My Account Area Start-->
<section class="my-account-area account1">
  <div class="container-fluid">
    <div class="row align-items-center">

      <!--Login Form Start-->
      <div class="col-lg-12 col-md-6 p-0">
        <div class="wrapper-2 myavilogin log-in-section">
          <div class="form-container">
            <div class="form-inner account1 log-in-box">
              <form method="post" class="login agentLoginForm" id="agentLoginForm">
                <div class="customer-login-register">
                  <div class="login-form">
                    <?php
                    if (isset($_GET['url'])) {
                      // echo $_GET['url'];
                      // exit();
                      echo '<input type="hidden" name="url" value="' . $url . '">';
                    }
                    ?>
                    <input type="hidden" name="logIn" value="logIn">
                    <div class="col-12 mb-3 text-center hny_log_t">

                      <?php
                      //show logo
                      $logo = $homePage->logo();
                      ?>
                      <a href="index.php"><img src="asset/image/logo/<?= $logo['logo'] ?>" alt="Logo" width="170px"></a>

                      <h2>Agent Login</h2>
                    </div>
                    <input type="hidden" name="action"  value="agent_login">
                    <div class="form-fild mb-3">
                      <label>Email <span class="required">*</span></label>
                      <input type="email" name="logInMobileNumber" id="logInMobileNumber" value="" autocomplete="off" class="form-control checking input_check">
                      <div class="err_msg " id="logInMobileNumberErrMsg" style="color: red;"></div>
                    </div>
                    <div class="form-fild">
                      <label>Password <span class="required">*</span></label>
                      <input type="password" name="logInPassword" id="logInPassword" value="" class="form-control checking input_check">
                      <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                      <div class="err_msg" id="logInPasswordErrMsg" style="color: red;"></div>
                    </div>
                     <div class="lost-password text-right mt-2">
                      <a href="agent_forgot_password.php"><i class="fa fa-lock"></i> Forgot Your Password?</a>
                    </div>
                    <div class="login-submit mt-4 mb-3">
                      <button type="submit" class="btn-animation w-100 justify-content-center btn btn-primary btn-rounded" id="lg_btn">Login</button>
                    </div>
                    <div class="other-log-in mb-2 text-center">
                      <h6 class="m-0">or</h6>
                    </div>
                    <h5 class="text-center" style="font-size: 16px; font-weight: 500;"><a href="javascript:void(0);" class="registerfrm" style="color:#ed3237 !important;">Register</a>
                    </h5>
                    <div class="text-center" id="login_formMsg"></div>
                  </div>
                </div>
              </form>
            
            </div>
            <div class="regi_main_hny">
                  <form class="signup agentLoginForm" id="registrationForm2" method="post" onkeydown="return event.key != 'Enter';">
                <div class="customer-login-register register-pt-0">
                  <div class="register-form">
                    <p id="reg_msg" class="alert alert-info" style="display:none;"></p>
                    <!-- <form id="registrationForm" action="#" method="post" class="login " style="height: 750px;"> -->
                    <?php
                    if (isset($_GET['url'])) {
                      echo '<input type="hidden" name="url" value="' . $url . '">';
                    }
                    ?>
                    <input type="hidden" name="action" value="agent_register">
                    <div class="row">
                      <div class="col-12  text-center hny_log_t ">
                        <?php
                        //show logo
                        $logo = $homePage->logo();
                        ?>
                        <a href="index.php"><img src="asset/image/logo/<?= $logo['logo'] ?>" alt="Logo" width="170px"></a>
                        <h2 class="text-center mb-4">Agent Register</h2>
                      </div>
                      <div class="col-lg-4 mb-2">
                        <div class="form-fild">
                          <label>First Name <span class="required">*</span></label>
                          <input type="text" name="first_name" id="firstName" value="" class="form-control checking input_check" autocomplete="off" required>
                          <div class="err_msg" id="firstNameErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      <div class="col-lg-4 mb-2">
                        <div class="form-fild">
                          <label>Last Name <span class="required">*</span></label>
                          <input type="text" name="last_name" id="lastName" value="" class="form-control checking input_check" autocomplete="off" required>
                          <div class="err_msg" id="lastNameErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      
                      <div class="col-lg-4 mb-2">
                        <div class="form-fild mb-2">
                          <label>Mobile Number<span class="required">*</span></label>
                          <input type="text" name="phone" id="mobileNumber" class="form-control phone" maxlength="10" required>
                          <div class="err_msg" id="mobileNumberErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      
                      <div class="col-lg-4 mb-2">
                        <div class="form-fild mb-2">
                          <label>E-mail Id<span class="required">*</span></label>
                          <input type="email" name="email" value="" class="form-control" id="emailId" autocomplete="off" required>
                          <div class="err_msg" id="emailIdErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      
                      <div class="col-lg-8 mb-2">
                        <div class="form-fild ">
                          <label>Password <span class="required">*</span></label>
                          <input type="password" name="pass" value="" placeholder="" class="form-control password" id="userPassword" required autocomplete="new-password">
                          <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-passwordtwo"></span>
                          <div class="err_msg" id="userPasswordErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      
                      <div class="col-lg-4 mb-2">
                        <div class="form-fild ">
                          <label>Flat <span class="required">*</span></label>
                          <input class="form-control" name="addflat" placeholder="House number and Flat number " type="text" required>
                          <div class="err_msg" id="addflatErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      
                      <div class="col-lg-4 mb-2">
                        <div class="form-fild ">
                          <label>Street <span class="required">*</span></label>
                          <input class="form-control" name="addstreet" placeholder="Street,Apartment etc" type="text" required>
                          <div class="err_msg" id="addstreetErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      
                      <div class="col-lg-4 mb-2">
                        <div class="form-fild ">
                          <label>Locality <span class="required">*</span></label>
                          <input class="form-control" name="addlocality" placeholder="Locality" type="text" required>
                          <div class="err_msg" id="addlocalityErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      
                      <div class="col-lg-4 mb-2">
                        <div class="form-fild ">
                          <label>Country <span class="required">*</span></label>
                          <input name="addcountry" type="hidden" value="99">
                          <input class="form-control" type="text" readonly value="India">
                          <div class="err_msg" id="addcountryErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      
                      <div class="col-lg-4 mb-2">
                        <div class="form-fild ">
                          <label>State <span class="required">*</span></label>
                          <select class="select2drop1 form-control" name="addstate" required>
                            <option value="">Please Select State</option>
                                <?php
                                foreach ($dashboard->getData('state_list', 'id,state', 'country_id=99') as $state) {
                                ?>
                                    <option value="<?= $state['id']; ?>">
                                        <?= $state['state']; ?></option>

                                <?php
                                }
                                ?>
                            </select>
                          <div class="err_msg" id="addstateErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      
                      <div class="col-lg-4 mb-2">
                        <div class="form-fild ">
                          <label>City <span class="required">*</span></label>
                          <input name="addcity" placeholder="Town / City" type="text" class="form-control" required>
                          <div class="err_msg" id="addcityErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      
                      <div class="col-lg-4 mb-2">
                        <div class="form-fild ">
                          <label>Zip code <span class="required">*</span></label>
                          <input name="addzip" placeholder="Postcode / ZIP" type="text" class="form-control" required>
                          <div class="err_msg" id="addzipErrMsg" style="color: red;"></div>
                        </div>
                      </div>
                      
                    </div>

                    <div class="register-submit mt-3">
                      <button type="submit" class="btn-animation w-100 justify-content-center btn btn-primary btn-rounded userRegBtn" name="submit" id="submit">Register</button>
                    </div>
                    <div class="other-log-in mb-2 mt-2 text-center">
                      <h6 class="m-0">or</h6>
                    </div>
                    <h5 class="text-center" style="font-size: 16px; font-weight: 500;"> <a href="javascript:void(0);" class="loginfrm" style="color:#ed3237 !important;">Login</a>
                    </h5>

                    <!-- </form> -->
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
        <!--Register Form End-->
      </div>


    </div>
  </div>
</section>
<!--My Account Area End-->
<!--Brand Area Start-->
<div id="loader"></div>
<!-- OTP area start-->
<section class="my-account-area otpVerify" style="display:none;">
  <div class="container-fluid mb-4 mt-4">
    <div class="row align-items-center">
     
      <div class="col-lg-12 col-md-6 ">
        <div class="wrapper-2 hny">
          <div class="form-container">
            <div class="otpvvfy mb-3">
              <h3 class="fw-600">Validate OTP</h3>
              <p> OTP has been sent to your email</p>
              <label>Verify Your Email <span class="required">*</span></label>
              <div class="slider-tab"></div>
            </div>
            <div class="form-inner">
              <form method="POST" id="verifyOtpForm" class="otp-form">
                <div class="customer-login-register text-center">
                  <div class="login-form my-form">

                    <div class="form-fild">
                      <?php
                      if (isset($_GET['url'])) {
                        echo '<input type="hidden" name="url" value="' . $url . '">';
                      }
                      ?>
                      <input type="hidden" name="userInfo" id="userInfo" value="">
                      <input id="codeBox1" class="codeBox" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" />
                      <input id="codeBox2" class="codeBox" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(2)" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" />
                      <input id="codeBox3" class="codeBox" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(3)" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" />
                      <input id="codeBox4" class="codeBox" type="number" name="otp[]" maxlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(4)" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" />
                    </div>
                    <div class="register-submit mt-4 mb-4">
                      <button type="submit" class="btn-animation  justify-content-center btn btn-primary btn-rounded" id="otpsubmit" name="submit">Verify</button>
                    </div>

                    <div class="text-center" id="verifyOtpFormMsg"><span></span></div>
                    <div><span id="timer"></span></div>


                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- OTP area start-->
<script type="text/javascript">
  var max = 0;
</script>
<?php include('include/footer.php'); ?>

<script>
  function getCodeBoxElement(index) {
    return document.getElementById('codeBox' + index);
  }

  function onKeyUpEvent(index, event) {
    const eventCode = event.which || event.keyCode;
    if (getCodeBoxElement(index).value.length === 1) {
      if (index !== 4) {
        getCodeBoxElement(index + 1).focus();
      } else {
        getCodeBoxElement(index).blur();
        // Submit code
        console.log('submit code ');
      }
    }
    if (eventCode === 8 && index !== 1) {
      getCodeBoxElement(index - 1).focus();
    }
  }

  function onFocusEvent(index) {
    for (item = 1; item < index; item++) {
      const currentElement = getCodeBoxElement(item);
      if (!currentElement.value) {
        currentElement.focus();
        break;
      }
    }
  }
</script>

<script type="text/javascript">
  $(".toggle-password").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    var x = document.getElementById("logInPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  });

  $(".toggle-passwordtwo").click(function() {

    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    var x = document.getElementById("userPassword");
    if (x.type === "password") {
      x.type = "text";
    } else {
      x.type = "password";
    }
  });
</script>
<script>
  $(document).ready(function() {
    $("#registrationForm2").hide();
    $(document).on("click", ".registerfrm", function() {
      $("#registrationForm2").show();
      $("#agentLoginForm").hide();
    });
    $(document).on("click", ".loginfrm", function() {
      $("#agentLoginForm").show();
      $("#registrationForm2").hide();
    });
  }); 
</script>