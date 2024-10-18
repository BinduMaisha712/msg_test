<?php
$content = "<html>

<body style='margin: 0;padding:0;color: #424242;font-family: Raleway;'>

    <div style='width: 100%; margin: auto; padding:0px;background-color:#fff;'>
        <div style='width: 100%;height: auto;margin: auto;background: #fff;box-shadow: 1px 1px 9px #bbbbbb;font-family: Raleway;'>
            <div style='background: #131e4a;color: #E5E5E5;height: 30px;text-align: center;width: 100%;margin-top: 40px;'>
            </div>
          
            <div style='padding: 0px;text-align: center;justify-content: center;margin-top: 30px;'>
                <h1 style='color: #000000;'>".$msg1."</h1>
            </div>

            <div style='padding: 10px; text-align: center; background-color: #ffb53a;
            border-radius: 10px;box-shadow: 0px 0px 5px 0px #19adc640; width: 400px;margin: auto;margin-top: 30px; color: rgb(15, 7, 88);'>
                <p>".$msg2."</p>
                <p><strong style='font-size: 16px;'>OTP : </strong>".$otp."</p>
            </div>
            
            <div style='text-align: center;margin-top: 20px;padding-top: 10px;height: 90px; text-align: center;'>

                <p style='font-size: 13px;margin-top: 35px;'>Email sent by MSG</p>
                <p style='font-size: 13px;line-height: 1px;'>Copyright © <?= date('Y') ?> MSG. All Right Reserved.</p>
            </div>
            <div style='background: #131e4a;color: #E5E5E5;height: 25px;text-align: center;width: 100%;margin-top: 40px;'>
            </div>
        </div>
    </div>
</body>

</html>";
