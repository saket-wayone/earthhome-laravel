<!doctype html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <title>OTP | Grow Fortuna</title>
    <meta name="description" content="Reset Password Email Template.">
    <style type="text/css">
        a:hover {
            text-decoration: underline !important;
        }

        body {
            margin: 0;
            background-color: #f2f3f8;
            font-family: 'Open Sans', sans-serif;
        }

        table {
            border-spacing: 0;
            border-collapse: collapse;
        }

        td {
            padding: 0;
        }

        .container {
            max-width: 670px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 6px 18px 0 rgba(0, 0, 0, 0.06);
            overflow: hidden;
        }

        .header {
            text-align: center;
            padding: 40px 0;
            background-color: #0d6efd;
            color: #ffffff;
        }

        .header img {
            width: 150px;
        }

        .content {
            padding: 40px 35px;
        }

        .content h1 {
            color: #1e1e2d;
            font-weight: 500;
            margin: 20px 0;
            font-size: 32px;
            font-family: 'Rubik', sans-serif;
        }

        .content p {
            color: #455056;
            font-size: 15px;
            line-height: 24px;
            margin: 0;
        }

        .content .separator {
            display: inline-block;
            vertical-align: middle;
            margin: 29px 0 26px;
            border-bottom: 1px solid #cecece;
            width: 100px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            font-size: 14px;
            color: rgba(69, 80, 86, 0.74);
            line-height: 18px;
        }
    </style>
</head>

<body>
    <table width="100%" bgcolor="#f2f3f8">
        <tr>
            <td>
                <table class="container" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class="header">
                            <a href="https://crm.growfortuna.com/" title="logo" target="_blank">
                                <img src="https://crm.growfortuna.com/admin/images/logo.webp" title="logo" alt="logo">
                            </a>
                            <h2>Grow Fortuna</h2>
                        </td>
                    </tr>
                    <tr>
                        <td class="content">
                            <span class="separator"></span>
                            <p>
                                Hi Grow Fortuna,<br><br>
                                <span style="font-weight: bold; color: #0d6efd;">{{ $info['name'] }}</span> tried to log in to the account on 
                                <span style="font-weight: bold; color: #0d6efd;">
                                    {{ \Carbon\Carbon::now()->setTimezone('Asia/Kolkata')->format('d-m-Y h:i:s a') }}
                                </span>.
                            </p>
                            <h1>
                                Authentication code is {{ $info['otp'] ?? '' }}
                            </h1>
                        </td>
                    </tr>
                    <tr>
                        <td class="footer">
                            &copy; <strong>Grow Fortuna</strong>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
