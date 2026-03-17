<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>OTP Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #007bff;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 5px 5px 0 0;
        }
        .content {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 0 0 5px 5px;
        }
        .otp-code {
            background-color: #007bff;
            color: white;
            font-size: 32px;
            font-weight: bold;
            text-align: center;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            letter-spacing: 5px;
        }
        .warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #6c757d;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>OTP Verification</h1>
    </div>
    
    <div class="content">
        <p>Hello!</p>
        
        <p>You have requested an OTP verification code for your bus booking. Please use the following code to verify your contact information:</p>
        
        <div class="otp-code">
            {{ $otp }}
        </div>
        
        <p>This code will expire in 10 minutes for security reasons.</p>
        
        <div class="warning">
            <strong>Important:</strong> Never share this OTP with anyone. Our team will never ask for this code over the phone or email.
        </div>
        
        <p>If you didn't request this OTP, please ignore this email or contact our support team immediately.</p>
        
        <p>Thank you for choosing our service!</p>
        
        <div class="footer">
            <p>This is an automated message. Please do not reply to this email.</p>
            <p>&copy; {{ date('Y') }} FastBuss Market. All rights reserved.</p>
        </div>
    </div>
</body>
</html> 