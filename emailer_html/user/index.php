<?php $content = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta http-equiv='Content-Type' content='text/html; charset=UTF-8'>

    <meta http-equiv='X-UA-Compatible' content='IE=edge'>

    <meta name='viewport' content='width=device-width, initial-scale=1.0'>

    <link rel='icon' href='images/favicon.png' type='image/x-icon'>

    <title>Account Created Successfully</title>

    <link href='https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap' rel='stylesheet'>



    <style type='text/css'>
        body {
            text-align: center;
            margin: 5px auto;
            width: 650px;
            font-family: 'Rubik', sans-serif;
            background-color: #e2e2e2;
            display: block;
        }
        
        .mb-3 {
            margin-bottom: 30px;
        }
        
        h5 {
            margin: 10px;
            color: #777;
        }
        
        .text-center {
            text-align: center
        }
        
        .welcome-name h5 {
            font-weight: normal;
            color: #232323;
            text-align: center;
            line-height: 1.6;
            font-size: 14px;
            max-width: 550px;
            margin: auto;
            text-align: center;
            margin-top: 10px;
        }
        
        table.order-detail {
            border: 1px solid #ddd;
            border-collapse: collapse;
        }
        
        table.order-detail tr:nth-child(even) {
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
        }
        
        table.order-detail tr:nth-child(odd) {
            border-bottom: 1px solid #ddd;
        }
        
        .order-detail th {
            font-size: 16px;
            padding: 15px;
            background: #eff2f7;
        }
        
        .welcome-details p span {
            color: #e22454;
            font-weight: 700;
            margin: 0 2px;
            text-decoration: underline;
        }
        
        .welcome-details p {
            font-weight: normal;
            font-size: 14px;
            color: #232323;
            line-height: 1.6;
            letter-spacing: 0.05em;
            margin: 0;
            text-align: justify;
        }
        
        .verify-button button {
            padding: 12px 30px;
            border: none;
            background-color: #e22454;
            color: #fff;
            font-weight: 500;
            font-size: 15px;
            letter-spacing: 1.3px;
            border-radius: 5px;
        }
        
        .main-bg-light {
            background-color: #fafafa;
        }
        
        @media only screen and (max-width: 700px) {
            body {
                margin: 0px auto;
                width: auto;
                height: 100vh;
            }
        }
    </style>
</head>

<body>
    <table align='center' border='0' cellpadding='0' cellspacing='0' style='background-color: #fff; width: 100%; box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);-webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);'>
        <tbody>
            <tr>
                <td style='padding: 15px;'>
                    <table align='center' border='0' cellpadding='0' cellspacing='0' width='100%'>
                        <tbody>
                            <tr class='header'>
                                <td align='center' valign='top'>
                                    <a href='index.html'>
                                        <img src='logo2.png ' class='main-logo' alt='logo'>
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table align='center' border='0' cellpadding='0' cellspacing='0' style='background-color: white; width: 100%; padding: 3px 30px;'>
        <tbody>
            <tr>
                <td class='welcome-image mb-3' style='display: block;'>
                    <img src='welcome.jpg' style='width: 100%; margin-top: 20px;' alt=''>
                </td>

                <td class='welcome-name mb-3' style='text-align: center; display: block;'>
                    <h4 style='text-transform: capitalize; margin: 0; font-weight: 500; color: #232323; font-size: 20px;'>Hi User welcome to Oraganic Feeds!</h4>
                    <h5>Thank you for creating account on Organic Feeds.</h5>
                </td>


                <td class='welcome-details mb-3' style='display: block;'>
                    <table class='order-detail' border='0' cellpadding='0' cellspacing='0' align='left' style='width: 100%;    margin-bottom: 30px;'>
                      
                        <tr>
                            <th style='font-weight: 500;'>User Name</th>
                            <td valign='top' style='padding-left: 15px;' align='left'>
                                <h5 style='margin-top: 15px; font-weight: 400;'>".$username."</h5>
                            </td>
                        </tr>

                        
                        <tr>
                            <th style='padding-left: 15px; font-weight: 500;'>User Email</th>
                            <td valign='top' style='padding-left: 15px;' align='left'>
                                <h5 style='margin-top: 15px; font-weight: 400;'>".$email."</h5>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

        </tbody>

    </table>


    <table class='text-center' align='center' border='0' cellpadding='0' cellspacing='0' width='100%' style='background-color: #eff2f7; color: #232323; padding: 20px 30px;'>
        <tr>
            <td>
                <table border='0' cellpadding='0' cellspacing='0' width='100%'>
                    <tr class='footer-details'>
                        <p style='margin: 10px auto 0; font-size: 14px; width: 80%; color: #7e7e7e;'>Yor Have received this email as a registered user of
                            <a style='color: #e22454; text-decoration: underline; font-weight: 700;'>Organic Feeds</a> from these emails here(Don't worry. take it personally).
                        </p>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>";