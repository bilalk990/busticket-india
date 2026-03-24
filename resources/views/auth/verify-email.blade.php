<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - FastBuss</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #4a90e2;
            --primary-dark: #357abd;
            --gradient-start: #4a90e2;
            --gradient-end: #1f75d8;
            --text-primary: #2d3748;
            --text-secondary: #4a5568;
            --bg-light: #f7fafc;
            --bg-white: #ffffff;
            --shadow-sm: 0 1px 3px rgba(0,0,0,0.12);
            --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
            --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--text-primary);
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #f6f9fc 0%, #edf2f7 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 600px;
            width: 90%;
            margin: 20px auto;
            background-color: var(--bg-white);
            border-radius: 16px;
            box-shadow: var(--shadow-lg);
            overflow: hidden;
            transform: translateY(0);
            transition: transform 0.3s ease;
        }

        .container:hover {
            transform: translateY(-5px);
        }

        .header {
            text-align: center;
            padding: 40px 20px;
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end));
            color: white;
            position: relative;
            overflow: hidden;
        }

        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 100%);
            z-index: 1;
        }

        .header h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin: 0;
            position: relative;
            z-index: 2;
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .content {
            padding: 40px;
            background-color: var(--bg-white);
        }

        .verification-icon {
            font-size: 64px;
            margin-bottom: 24px;
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }

        .highlight {
            background-color: var(--bg-light);
            padding: 24px;
            border-radius: 12px;
            margin: 24px 0;
            border-left: 4px solid var(--primary);
            transition: transform 0.3s ease;
        }

        .highlight:hover {
            transform: translateX(5px);
        }

        .highlight h3 {
            color: var(--text-primary);
            margin-bottom: 16px;
            font-weight: 600;
        }

        .highlight ul {
            list-style: none;
        }

        .highlight li {
            margin: 12px 0;
            padding-left: 24px;
            position: relative;
        }

        .highlight li::before {
            content: '✓';
            position: absolute;
            left: 0;
            color: var(--primary);
            font-weight: bold;
        }

        .button {
            display: inline-block;
            padding: 14px 32px;
            background: linear-gradient(135deg, var(--primary), var(--primary-dark));
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin: 24px 0;
            transition: all 0.3s ease;
            border: none;
            font-weight: 500;
            font-size: 1rem;
            cursor: pointer;
            box-shadow: var(--shadow-sm);
        }

        .button:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
            background: linear-gradient(135deg, var(--primary-dark), var(--primary));
        }

        .status-message {
            text-align: center;
            margin: 24px 0;
            padding: 16px;
            border-radius: 8px;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from { transform: translateY(-20px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .status-message.success {
            background-color: #f0fff4;
            color: #2f855a;
            border: 1px solid #c6f6d5;
        }

        .status-message.error {
            background-color: #fff5f5;
            color: #c53030;
            border: 1px solid #fed7d7;
        }

        .footer {
            text-align: center;
            padding: 24px;
            background-color: var(--bg-light);
            font-size: 14px;
            color: var(--text-secondary);
        }

        .footer a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer a:hover {
            color: var(--primary-dark);
        }

        .text-center {
            text-align: center;
        }

        h2 {
            color: var(--text-primary);
            font-size: 1.75rem;
            margin-bottom: 16px;
            font-weight: 600;
        }

        p {
            color: var(--text-secondary);
            margin-bottom: 16px;
        }

        .resend-link {
            color: var(--primary);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .resend-link:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Email Verification</h1>
        </div>
        <div class="content">
            @if (session('status') == 'verification-link-sent')
                <div class="status-message success">
                    <p>A new verification link has been sent to your email address.</p>
                </div>
            @endif

            <div class="text-center">
                <div class="verification-icon">✉️</div>
                <h2>Verify Your Email Address</h2>
                <p>Thank you for signing up! Please verify your email address to access all features of your account.</p>
            </div>

            <div class="highlight">
                <h3>Why Verify Your Email?</h3>
                <ul>
                    <li>Secure your account</li>
                    <li>Access all platform features</li>
                    <li>Receive important notifications</li>
                    <li>Reset your password if needed</li>
                </ul>
            </div>

            <div class="text-center">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <button type="submit" class="button">
                        Resend Verification Email
                    </button>
                </form>
            </div>

            <p class="text-center">
                Didn't receive the email? Check your spam folder or 
                <a href="{{ route('verification.send') }}" class="resend-link">
                    click here to request a new one
                </a>
            </p>
        </div>
        <div class="footer">
                            <p>© {{ date('Y') }} FastBuss. All rights reserved.</p>
                <p>If you need assistance, please contact our support team at <a href="mailto:support@fastbuss.com">support@fastbuss.com</a></p>
        </div>
    </div>
</body>
</html> 