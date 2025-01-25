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
            margin-top: 1.2rem;
            margin-bottom: 1.2rem;
        }
        .my-2 {
            padding-top: 1.2rem;
            padding-bottom: 1.2rem;
        }
        .text-center {
            text-align: center;
        }
    </style>

</head>

<body width="100%" style="margin: 0; padding: 0 !important; mso-line-height-rule: exactly; background-color: #f5f6fa;">
    <table width="100%" border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td style="padding: 40px 0;">
                <table style="width:100%;max-width:620px;margin:0 auto;background-color:#ffffff;">
                    <th>
                        <tr>
                            <td class="header text-center my-2">
                                <a href="{{ route('home') }}" style="display: inline-block;">
                                    <img src="{{ static_asset('images/img/stuckdouga_logo.jpg') }}" style="width: 190px; height: 47px;" class="logo" alt="stuckdouga Logo">

                                </a>
                            </td>
                        </tr>
                    </th>
                    <tr>
                        <td style="padding: 50px 30px;">
                            <h3>A new contact message:</h3>
                            <br>
                            <p ><span style="font-weight:bold;">Name:</span> <?php echo $mailData['name']?></p>
                            <p><span style="font-weight:bold;">From:</span> <?php echo $mailData['email']?></p>
                            <p><span style="font-weight:bold;">Location:</span> <?php echo $mailData['location']?></p>
                            <p><span style="font-weight:bold;">Subject:</span> <?php echo $mailData['subject']?></p>
                            <pre><span style="font-weight:bold;">Message:</span> <?php echo $mailData['message']?></pre>

                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
