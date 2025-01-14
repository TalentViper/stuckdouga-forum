<!DOCTYPE html>
<html>
<head>
    <title>Invoice</title>
    <style type="text/css">
        html, body, div, span, p,
        table, tr, th, td, header      
        {
            margin: 0;
            padding: 0;
            border: 0;
            font: inherit;
            font-size: 100%;
            vertical-align: baseline;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 0;
            text-align: center;
        }

        .group:before,
        .group:after {
            content: " ";
            display: table;
        }

        .group:after {
            clear: both;
        }

        html {
            font-size: 16px;
        }
        body {
            min-width: 485px;
            color: #333333;
            font-family: Arial, 'Helvetica Neue', Helvetica, sans-serif;
            font-size: 0.75rem; /* 12px / 16px = 0.75rem */
            font-style: normal;
            font-weight: normal;
            letter-spacing: 0;
            text-decoration: none;
            line-height: 1;
        }
        .global_container_ {
            float: none;
            height: auto;
            margin: 0 auto;
            padding: 83px 0 98px;
            position: relative;
            width: 100%; /* 671px / 671px = 100% */
        }
        .l-constrained {
            margin: 0 auto;
            padding: 10px 10px 10px 10px;
            position: relative;
            width: 505px;
            border: 1px solid black;
        }
        .header {
            position: relative;
            width: 470px;
            margin: 0 auto;
        }
        .col-2 {
            position: relative;
        }
        .header-2 {
            height: 70px;
            position: relative;            
            align-items: center;
        }
        .header-2 img {
            max-width: 200px;
            height: auto;
        }
        .text {
            margin: 2px 0 0 0px;
            font-size: 0.84375rem; /* 13.5px / 16px = 0.84375rem */
            line-height: 20px;
        }
        .row {
            margin: 22px auto 0;
            position: relative;
            width: 470px;
        }
        .text-2 {
            float: left;
            margin: 15px 0 0;
            width: 305px;
            font-size: 0.84375rem; /* 13.5px / 16px = 0.84375rem */
        }
        .text-3 {
            float: right;
            width: 150px;
            line-height: 16px;
            text-align: right;
        }
        .text-4 {
            width: 356px;
            line-height: 20px;
        }
        .text-5 {
            margin: 48px 0 0;
            font-size: 1.125rem; /* 18px / 16px = 1.125rem */
            text-align: center;
        }
        .text-style-4 {
            line-height: 25px;
        }
        .text-style-3 {
            font-size: 0.9375rem; /* 15px / 16px = 0.9375rem */
            line-height: 20px;
        }
        .text-style-2 {
            display: block;
            line-height: 10px;
            margin-bottom: 0;
        }
        .text-style {
            font-size: 0.9375rem; /* 15px / 16px = 0.9375rem */
        }
        table tr, td {
            border: 1px solid black;
            border-collapse: collapse;
            padding: 8px 8px;
        }
        table tr th {
            padding: 8px 8px;
            font-weight: bold;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }

        .text-large{
            float: right;
            width: 120px;
            font-size: 20px;
            font-weight: bold;
            line-height: 16px;
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="global_container_">
        <div class="l-constrained">
            <header class="header">
                <div class="col-2">
                    <header class="header-2 row group">
                        <!-- <img src="{{ static_asset('images/invoice/logo.png') }}" alt=""> -->
                        <img src="{{ static_asset('images/elite/logo.jpg') }}" alt="Logo">
                        <span class="text-3">Inv Out: {{$date}}</span>
                    </header>
                    <div class="row group" style="align-items: center;">
                        <p class="text-2">
                            <span class="text-style">London Green Hills Ltd</span>
                            <br>
                            <span class="text-style">10 Shaldon Rd</span>
                            <br>
                            <span class="text-style">Edgware</span>
                            <br>
                            <span class="text-style">London HA 86AL</span>
                            <br>
                        </p>
                        <div class="text-large">
                            <h1>10552</h1>
                            <br>
                            <h2 style="font-weight:normal">INVOICE</h2>
                        </div>
                    </div>
                    <p class="text">
                        www.eliteproviders.uk &nbsp;&nbsp;|&nbsp;&nbsp;Tel:&nbsp;020 3084 1986&nbsp;|&nbsp;Email: &nbsp;info@eliteproviders.uk
                    </p>
                    <hr>
                </div>
            </header>
            <div class="row group">
                <h2 style="text-align: left">BILL TO:</h2>
                <p class="text-2">
                    <span class="text-style-3">Customer Name: {{$customerName}}</span>
                    <br class="text-style-2">
                    <span class="text-style-3">Address: {{$jobAddress}}</span>
                    <br class="text-style-2">                    
                    <span class="text-style-4">Tel: &nbsp; {{$phone}} &nbsp;| &nbsp;Email: &nbsp;{{$email}}</span>
                </p>
                <p class="text-3">
                    Bank Details:
                    <br>                    
                    London Green Hills Ltd  
                    <br>
                    Metro Bank
                    <br>
                    23-05-80 Sort code
                    <br>
                    49914539 Account Number
                </p>
            </div>
            <div class="row">
                <table>
                    <tr>
                        <th>Work</th>
                        <th>Amount</th>
                    </tr>
                    <tr>
                        <td>
                            <p class="text-4">
                                Job Address: {{ $jobAddress }}
                                <br>
                                Job Date: &nbsp;{{ $startDate }} &nbsp;| &nbsp;Job Time: {{ $startTime }} &nbsp;&nbsp;| &nbsp;Job Duration: &nbsp;{{ $hours }}h {{ $minutes }}min
                                <br>
                                Garden: &nbsp;{{$garden}}
                                <br>
                                Services:
                                <br>
                                Front Garden: &nbsp; {{ $services_front_garden }}
                                <br>
                                Back Garden: &nbsp; {{ $services_back_garden }}
                                <br>
                                Extras: &nbsp;{{ $extras }}
                            </p>
                        </td>
                        <td>
                            <p style="text-align:center; font-weight:bold">{{ number_format($price, 2, '.', '') }}</p>
                        </td>                    
                    </tr>
                    <tr>
                        <td style="border-left: 1px solid white; border-bottom: 1px solid white">
                            <p style="text-align:right; font-weight:bold">
                                Total:
                            </p>                        
                        </td>
                        <td>
                            <p style="text-align:center; font-weight:bold">&pound; {{ number_format($price, 2, '.', '') }}</p>                        
                        </td>
                    </tr>
                </table>
            </div>   
            <p class="text-5">Thank you for choosing ELITE PROVIDERS</p>        
            <p style="text-align:center">You are obliged to send payment within 10 days</p>
        </div>
    </div>
</body>
</html>
