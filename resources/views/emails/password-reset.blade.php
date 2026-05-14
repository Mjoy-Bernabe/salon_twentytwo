<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #d97706;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            color: #000;
            font-size: 24px;
        }
        .header .accent {
            color: #d97706;
        }
        .content {
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .content h2 {
            color: #000;
            font-size: 18px;
            margin-top: 0;
        }
        .reset-code {
            background-color: #f9fafb;
            border: 2px solid #d97706;
            border-radius: 4px;
            padding: 20px;
            text-align: center;
            margin: 20px 0;
        }
        .reset-code-value {
            font-size: 32px;
            font-weight: bold;
            color: #d97706;
            letter-spacing: 2px;
        }
        .expiration {
            background-color: #fef3c7;
            border-left: 4px solid #d97706;
            padding: 15px;
            margin: 20px 0;
            border-radius: 4px;
        }
        .expiration p {
            margin: 0;
            color: #92400e;
            font-size: 14px;
        }
        .footer {
            text-align: center;
            color: #666;
            font-size: 12px;
            border-top: 1px solid #e5e7eb;
            padding-top: 20px;
        }
        .button {
            display: inline-block;
            background-color: #000;
            color: #fff;
            padding: 12px 30px;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .button:hover {
            background-color: #d97706;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Salon<span class="accent">TwentyTwo</span></h1>
        </div>

        <div class="content">
            <h2>Password Reset Request</h2>
            <p>Hello {{ $customerName }},</p>
            <p>We received a request to reset the password for your Salon TwentyTwo account. Use the code below to proceed with resetting your password.</p>

            <div class="reset-code">
                <div style="color: #666; font-size: 14px; margin-bottom: 10px;">Your Reset Code:</div>
                <div class="reset-code-value">{{ $resetCode }}</div>
            </div>

            <div class="expiration">
                <p><strong>This code will expire in 1 hour.</strong></p>
                <p>If you didn't request this password reset, please ignore this email or contact our support team.</p>
            </div>

            <p>Visit our website and use the password reset page to enter this code and create a new password.</p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Salon TwentyTwo. All rights reserved.</p>
            <p>For questions or issues, please contact us at salontwentytwo26@gmail.com</p>
        </div>
    </div>
</body>
</html>
