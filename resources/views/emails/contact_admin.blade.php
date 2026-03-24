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
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
        </div>
        
        <div class="content">
            <p>You have received a new contact form submission with the following details:</p>
            
            <p><strong>Name:</strong> {{ $contact->full_name }}</p>
            <p><strong>Email:</strong> {{ $contact->email }}</p>
            @if($contact->phone)
            <p><strong>Phone:</strong> {{ $contact->phone }}</p>
            @endif
            <p><strong>Message:</strong></p>
            <p>{{ $contact->message }}</p>
            
            <p><strong>Submitted:</strong> {{ $contact->created_at->format('F j, Y, g:i a') }}</p>
        </div>
        
        <div class="footer">
            <p>This is an automated message from your website's contact form.</p>
        </div>
    </div>
</body>
</html> 