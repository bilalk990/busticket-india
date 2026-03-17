<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Your Interest</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }
        .header {
            text-align: center;
            padding: 20px 0;
            background: linear-gradient(135deg, #4a90e2, #1f75d8);
            color: white;
            border-radius: 8px 8px 0 0;
        }
        .content {
            padding: 30px;
            background-color: #ffffff;
        }
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 0 0 8px 8px;
            font-size: 12px;
            color: #666;
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background-color: #4a90e2;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            margin: 20px 0;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            margin: 0 10px;
            color: #4a90e2;
            text-decoration: none;
        }
        .highlight {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
                            <h1>Welcome to FastBuss!</h1>
        </div>
        <div class="content">
            <p>Dear {{ $data->first_name }} {{ $data->last_name }},</p>
            
                            <p>Thank you for your interest in becoming a partner with FastBuss. We're excited to have you join our network of trusted transportation providers!</p>
            
            <div class="highlight">
                <h3>What's Next?</h3>
                <p>Our team will review your application and get back to you within 2-3 business days. We'll discuss:</p>
                <ul>
                    <li>Partnership opportunities</li>
                    <li>Integration process</li>
                    <li>Revenue sharing model</li>
                    <li>Technical requirements</li>
</ul>
            </div>

            <p>In the meantime, you can learn more about our platform by visiting our partner portal.</p>
            
            <div style="text-align: center;">
                <a href="https://fastbuss.com/partners" class="button">Visit Partner Portal</a>
            </div>

                            <p>If you have any questions, feel free to reach out to our partner support team at <a href="mailto:partners@fastbuss.com">partners@fastbuss.com</a>.</p>

            <div class="social-links" style="text-align: center;">
                <p>Follow us on social media:</p>
                <a href="https://facebook.com/fastbuss">Facebook</a> |
                <a href="https://twitter.com/fastbuss">Twitter</a> |
                <a href="https://linkedin.com/company/fastbuss">LinkedIn</a>
            </div>
        </div>
        <div class="footer">
                            <p>© {{ date('Y') }} FastBuss. All rights reserved.</p>
            <p>This is an automated message, please do not reply directly to this email.</p>
        </div>
    </div>
</body>
</html>
