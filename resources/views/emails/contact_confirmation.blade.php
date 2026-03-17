<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
        }
        .content {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 12px;
            color: #666;
        }
        .message {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin: 15px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Thank You for Contacting Us</h2>
        </div>
        
        <div class="content">
            <p>Dear {{ $contact->first_name }},</p>
            
            <p>Thank you for reaching out to us. We have received your message and will get back to you as soon as possible.</p>
            
            <div class="message">
                <p><strong>Your Message:</strong></p>
                <p>{{ $contact->message }}</p>
            </div>
            
            <p>If you have any additional information to add to your inquiry, please don't hesitate to reply to this email.</p>
            
            <p>Best regards,<br>
            The {{ config('app.name') }} Team</p>
        </div>
        
        <div class="footer">
            <p>This is an automated response to your contact form submission. Please do not reply to this email.</p>
        </div>
    </div>
</body>
</html> 