<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome - Sugar-Pappi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: "Segoe UI", Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 30px;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .header {
            text-align: center;
            padding: 25px 0 10px 0;
            background: #ffffff;
        }
        .header img {
            width: 130px;
            height: auto;
        }
        .content {
            padding: 25px 30px;
        }
        .content h2 {
            color: #222;
            margin-bottom: 15px;
            text-align: center;
        }
        .content p {
            font-size: 15px;
            color: #555;
            line-height: 1.6;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #007bff;
            padding: 12px 15px;
            border-radius: 6px;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            background: #dc3838;
            color: #fff;
            padding: 8px 16px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f4f4f4;
            color: #888;
            font-size: 13px;
        }
        .app-links {
            margin-top: 20px;
            font-size: 14px;
        }
        .app-links a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="email-container">

    <!-- Header -->
    <div class="header">
        <img src="{{ asset('public/img/logo.png') }}" alt="Sugar-Pappi Logo">
    </div>

    <!-- Content -->
    <div class="content">
        <h2>Welcome to Sugar-Pappi!</h2>

        <p>Dear <strong>{{ $data['username'] }}</strong>,</p>

        <p>Thank you for registering with <strong>Sugar-Pappi</strong>. Your account has been successfully created.</p>

        <div class="info-box">
            <p><strong>Email:</strong> {{ $data['useremail'] }}</p>
            <p><strong>Password:</strong> {{ $data['password'] }}</p>
        </div>

        <p style="text-align:center;">
            <a href="{{ url('/login') }}" class="btn">Click here to Login</a>
        </p>

        <div class="app-links">
            <h3>Download Our App</h3>
            <p><strong>For Apple Users:</strong><br>
                <a href="https://apps.apple.com/us/app/a-z-nutrition-and-smoothies/id6476598086">Download on App Store</a>
            </p>
            <p><strong>For Android Users:</strong><br>
                <a href="https://play.google.com/store/apps/details?id=com.aznutritionandsmoothie">Get it on Google Play</a>
            </p>
        </div>

        <p>We’re excited to have you on board!<br>Stay healthy and refreshed with our smoothies.</p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p>Thanks,<br><strong>Sugar-Pappi Team</strong></p>
    </div>

</div>

</body>
</html>
