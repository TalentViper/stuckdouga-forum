<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,600" rel="stylesheet" type="text/css">
    <!-- Web Font / @font-face : BEGIN -->

    <style>
        html,
        body {
            margin: 0 auto !important;
            padding: 0 !important;
            height: 100% !important;
            width: 100% !important;
            font-family: 'Poppins', sans-serif !important;
            font-size: 14px;
            margin-bottom: 10px;
            line-height: 24px;
            color:#8094ae;
            font-weight: 400;
        }
        * {
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif !important;
        }
        table,
        td {
            mso-table-lspace: 0pt !important;
            mso-table-rspace: 0pt !important;
        }
        table {
            border-spacing: 0 !important;
            border-collapse: collapse !important;
            table-layout: fixed !important;
            margin: 0 auto !important;
        }

        table table table {
            table-layout: auto;
        }
        a{
            font-weight: bold;
            text-decoration: none;
            word-break: break-all;
        }
        img {
            -ms-interpolation-mode:bicubic;
        }
        p {
            margin-top: 0;
            margin-bottom: 2rem;
        }
    </style>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f5f6fa;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td style="padding: 40px 0;">
                <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
                    <tr>
                        <td style="padding: 50px 30px;">
                            <h3>Hi <?=$mailData['html']?></h3>
                            <br>
                            <p>Your temporary password is</p>
                            <p><h3 style="text-align: center;">Access2000</h3></p>
                            <p>Please do change your password in your account to keep your account secured.</p>
                            <p>You have successfully created your account with the Elite Providers Ltd. Now you can Sign In with your credentials <a href="{{route('login')}}" style="color:#249316;font-weight:bold;">here</a>.</p>
                            <p>We offer professional gardening services plus some other services you might be interested in. Please find out more about our company and the services we offer on our website.</p>
                            <p>For any enquires, free quotes or making bookings do not hesitate to contact our friendly team.</p>
                            <p>We are waiting for your requirements.</p>
                            <p>Best Regards<br>-<br>Elite Providers Team<br><a href="{{route('home')}}" style="color:#249316;font-weight:bold;">www.elitegardeners.uk</a></p>
                            <p>T: 020 3084 1986<br>E: info@eliteproviders.uk</p>
                            <a href="{{route('home')}}">
                                <img src="{{ static_asset('images/elite/logo.jpg')}}" style="width: 200px;" alt="Logo">
                            </a>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
