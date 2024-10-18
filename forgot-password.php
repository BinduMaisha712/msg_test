<?php
include('header.php');
?>

<style>
    input[type=number]::-webkit-inner-spin-button,
    input[type=number]::-webkit-outer-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .login_main {
        border: #dcdee3 solid 1px;
        padding: 25px 25px 10px;
        margin: auto;
        font-size: 15px;
        position: relative;
    }

    .main_reset_box h1 {
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

    .otpVerify {
        margin-top: 50px;
    }

    .resert-box {
        margin-bottom: 40px;
        margin-top: 50px;
    }

    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    .checkoutaccordion {
        margin-bottom: 23px;
    }

    .main_reset_box.checkoutaccordion img {
        width: 70px;
        filter: none;
    }

    .image-contai img {
        width: 67%;
        margin: auto;
    }

    input#forgetpass {
        border-radius: 10px;
    }

    .checkoutaccordion h4 {
        margin-bottom: 0px;
    }

    span#timerd {
        background-color: #ed2b39;
        color: white;
        padding: 3px 10px;
        cursor: pointer;
        border-radius: 5px;
        font-size: 12px;
    }

    input.codeBox1 {
        height: 45px;
        width: 45px;
        font-size: 18px;
        text-align: center;
        border: 1px solid #bebcbc;
        border-radius: 3px;
        color: gray;
    }

    .container.resert-box {
        background-color: #f6f6f6;
        width: 45%;
        text-align: center;
        padding-top: 15px;
        border-radius: 10px;
        position: relative;
    }

    .container.resert-box:before {
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

    .forget-form.hny {
        background-color: #f6f6f6;
        width: 45%;
        margin: auto;
        border-radius: 10px;
        padding: 28px;
        position: relative;
    }

    .forget-form.hny:before {
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
        <div class="resetinfo">
            <div class="container resert-box">
                <div class="row align-items-center">

                    <div class="col-lg-12 col-sm-12">
                        <div class=" forget-form">
                            <div class="main_reset_box checkoutaccordion">
                                <img class="border-radius-15" src="assets/img/forgot-password-icon.png" alt="">
                                <h4 class="text-center">Forgot Password</h4>
                            </div>
                            <div>
                                <form action="3" method="post" class="reset-block" id="verifyOtpForms">
                                    <p>Not to worry, we got you! Let’s get you a new password. Please <br> enter your registered Email.</p>
                                    <div class="form-group ">
                                        <div class="icon"><i class="icon-user icons"></i></div>
                                        <input type="email" name="phone" placeholder="Enter Your Email" id="forgetpass" value="" autocomplete="off" class="form-control checking input_check email_check" required="">
                                    </div>
                                    <div class="form-group mt-3">
                                        <button type="submit" class="w-100 btn-animation btn btn-primary btn-rounded" id="lg_btn"><span id="#">SUBMIT</span></button>
                                    </div>
                                    <br />
                                    <div class="usermsg" style="color:red">
                                    </div><br />
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- Account Info area end-->

        <!-- OTP area start-->
        <div class="container otpVerify mb-5" style="display:none;">
            <div class="row justify-content-center" style="margin-bottom:35px;">

                <div class="col-lg-12 col-sm-12">
                    <div class="forget-form hny">
                        <div class="main_reset_box checkoutaccordion text-center">
                            <img class="border-radius-15" src="assets/images/otp.png" alt="">
                            <h4 class="text-center">OTP Verification</h4>
                            <p> An OTP has been sent to your email</p>

                        </div>
                        <div>
                            <form method="POST" id="submitotp" class="otp-form reset-block text-center">
                                <p class="showoptmsg" style="color: red"></p>
                                <div class="form-group">
                                    <input type="hidden" name="" id="varifiedstatus" value="">
                                    <input type="hidden" name="" id="mobilenumber" value="">

                                    <input type="hidden" name="userInfo" id="userInfo" value="">
                                    <input class="codeBox1" type="number" maxlength="1" minlength="1" maxlength="1" onkeyup="onKeyUpEvent(1, event)" onfocus="onFocusEvent(1)" name="otp" id="codeBox1" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" required>
                                    <input class="codeBox1" type="number" maxlength="1" minlength="1" onkeyup="onKeyUpEvent(2, event)" onfocus="onFocusEvent(1)" name="otp" id="codeBox2" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" required>
                                    <input class="codeBox1" type="number" maxlength="1" minlength="1" onkeyup="onKeyUpEvent(3, event)" onfocus="onFocusEvent(1)" name="otp" id="codeBox3" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" required>
                                    <input class="codeBox1" type="number" maxlength="1" minlength="1" onkeyup="onKeyUpEvent(4, event)" onfocus="onFocusEvent(1)" name="otp" id="codeBox4" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==1) return false;" required>
                                </div>
                                <div class="form-group mt-3 mb-3">
                                    <button type="submit" class="btn-animation btn btn-primary btn-rounded user_login hibeutton" id="lg_btn"><span id="#">SUBMIT</span></button>
                                </div>
                                <div id="timerdotp"><span id="timerd"></span></div>
                                <p class="usermsge" style=""></p>
                                <p class="usermsgee" style="color: green"></p>
                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!-- OTP area start-->
        </div>
</section>
<!--footer area start-->

<script type="text/javascript">
    var max = 0;
</script>
<?php
include('include/footer.php');
?>
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
    $('#verifyOtpForms').on('submit', function(e) {
        e.preventDefault();
        var mobile = $('#forgetpass').val();
        $.ajax({
            url: 'check-mobille.php',
            method: 'post',
            data: 'mobile=' + mobile,
            success: function(dataa) {
                var result = JSON.parse(dataa);

                if (result.status == 'notregisterd') {
                    $('.usermsg').html(result.msg);
                }
                if (result.status == 'sendopt') {

                    $('#mobilenumber').val(mobile);
                    $('.resetinfo').hide();
                    $('.otpVerify').show();
                    $('.showoptmsg').text(result.msg);
                    htimer(60);
                }

            }
        })
    })




    $('#submitotp').on('submit', function(e) {
        e.preventDefault();
        // var varifiedstatus = $('#varifiedstatus').val();
        var mobile = $('#mobilenumber').val();
        $('.hibeutton').hide();
        var otp1 = $('#codeBox1').val();
        var otp2 = $('#codeBox2').val();
        var otp3 = $('#codeBox3').val();
        var otp4 = $('#codeBox4').val();
        var otp = otp1 + otp2 + otp3 + otp4;
        $.ajax({
            url: 'varifi-opt.php',
            method: 'post',
            data: 'mobile=' + mobile + "&otpmobile=" + otp,
            success: function(mdata) {

                var mresult = JSON.parse(mdata);

                if (mresult.status == 'failed') {
                    $('#otp1').val('');
                    $('#otp2').val('');
                    $('#otp3').val('');
                    $('#otp4').val('');
                    $('.hibeutton').show();
                    $('.usermsge').html(mresult.message);
                    $('.hibeutton').show();
                    //htimer(60);
                }
                if (mresult.status == 'success') {

                    $('#otp1').val('');
                    $('#otp2').val('');
                    $('#otp3').val('');
                    $('#otp4').val('');

                    $('.hibeutton').hide();
                    //$('.otpVerify').show();
                    $('.usermsge').html('');
                    $('.usermsgee').text(mresult.message);
                    //htimer(60);
                    $('#timerdotp').hide();
                    setTimeout(function() {
                        window.location.href = "confirm-password.php?token=" + mresult.tokenmob + "&tokentwo=" + mresult.tokentwo;
                    }, 1000);
                }

            }
        })
    })


    function htimer(remaining) {
        //allert
        let timerOn = true;
        var m = Math.floor(remaining / 60);
        var s = remaining % 60;

        m = m < 10 ? '0' + m : m;
        s = s < 10 ? '0' + s : s;
        document.getElementById('timerd').innerHTML = m + ':' + s;
        remaining -= 1;

        if (remaining >= 0 && timerOn) {
            setTimeout(function() {
                htimer(remaining);
            }, 1000);
            return;
        }

        if (!timerOn) {
            // Do validate stuff here
            return;
        }

        // Do timeout stuff here


        $('#timerd').html('<a onClick="sendOTPh();">Resend OTP</a>');


    }


    function sendOTPh() {

        var mobile = $('#mobilenumber').val();
        $('.usermsge').text('');
        $('#otp1').val('');
        $('#otp2').val('');
        $('#otp3').val('');
        $('#otp4').val('');
        $.ajax({
            url: 'check-mobille.php',
            method: 'post',
            data: 'mobile=' + mobile,
            success: function(dataa) {
                var result = JSON.parse(dataa);

                if (result.status == 'notregisterd') {
                    //$('.usermsg').text(result.msg);
                }
                if (result.status == 'sendopt') {

                    // $('#mobilenumber').val(mobile);
                    // $('.resetinfo').hide();
                    // $('.otpVerify').show();
                    // $('.showoptmsg').text(result.msg);
                    htimer(60);
                }
            }
        })

    }
</script>