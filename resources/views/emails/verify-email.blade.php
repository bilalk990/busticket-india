<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Verify Your Email Address - FastBuss Market</title>
    <style>
        /* Reset and base styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            line-height: 1.6;
            color: #2d3748;
            background: linear-gradient(135deg, #667eea 0%, #1f75d8 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
        }
        
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        /* Header Section */
        .header {
            background: linear-gradient(135deg, #1f75d8 0%, #5a67d8 100%);
            padding: 40px 30px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-20px) rotate(180deg); }
        }
        
        .logo {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }
        
        .logo-icon {
            display: inline-block;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            margin-right: 12px;
            vertical-align: middle;
            position: relative;
        }
        
        .logo-icon::before {
            content: '✈️';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            font-size: 20px;
        }
        
        .title {
            font-size: 24px;
            font-weight: 600;
            color: #ffffff;
            margin-bottom: 8px;
            position: relative;
            z-index: 1;
        }
        
        .subtitle {
            font-size: 16px;
            color: rgba(255, 255, 255, 0.9);
            position: relative;
            z-index: 1;
        }
        
        /* Content Section */
        .content {
            padding: 40px 30px;
        }
        
        .greeting {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 20px;
        }
        
        .message {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 30px;
            line-height: 1.7;
        }
        
        /* Button Section */
        .button-container {
            text-align: center;
            margin: 30px 0;
        }
        
        .verify-button {
            display: inline-block;
            background: linear-gradient(135deg, #1f75d8 0%, #5a67d8 100%);
            color: #ffffff;
            padding: 16px 40px;
            text-decoration: none;
            border-radius: 12px;
            font-weight: 600;
            font-size: 16px;
            box-shadow: 0 4px 14px 0 rgba(125, 51, 245, 0.4);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        
        .verify-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        
        .verify-button:hover::before {
            left: 100%;
        }
        
        /* Link Section */
        .link-section {
            background: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
        }
        
        .link-title {
            font-size: 14px;
            font-weight: 600;
            color: #4a5568;
            margin-bottom: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .verification-link {
            color: #1f75d8;
            text-decoration: none;
            word-break: break-all;
            font-family: 'Courier New', monospace;
            font-size: 14px;
            background: #ffffff;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            display: block;
            transition: all 0.3s ease;
        }
        
        .verification-link:hover {
            background: #f7fafc;
            border-color: #1f75d8;
        }
        
        /* Warning Section */
        .warning {
            background: linear-gradient(135deg, #fed7d7 0%, #feb2b2 100%);
            border: 1px solid #fc8181;
            border-radius: 12px;
            padding: 20px;
            margin: 25px 0;
            position: relative;
        }
        
        .warning::before {
            content: '⚠️';
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 20px;
        }
        
        .warning-content {
            margin-left: 35px;
        }
        
        .warning-title {
            font-size: 16px;
            font-weight: 600;
            color: #c53030;
            margin-bottom: 8px;
        }
        
        .warning-text {
            font-size: 14px;
            color: #742a2a;
            line-height: 1.5;
        }
        
        /* Footer Section */
        .footer {
            background: #f7fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        
        .footer-content {
            margin-bottom: 20px;
        }
        
        .footer-text {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 8px;
        }
        
        .footer-signature {
            font-size: 18px;
            font-weight: 600;
            color: #2d3748;
            margin-bottom: 15px;
        }
        
        .footer-note {
            font-size: 12px;
            color: #718096;
            font-style: italic;
        }
        
        /* Social Links */
        .social-links {
            margin-top: 20px;
        }
        
        .social-link {
            display: inline-block;
            width: 32px;
            height: 32px;
            background: #1f75d8;
            color: #ffffff;
            text-decoration: none;
            border-radius: 50%;
            margin: 0 8px;
            text-align: center;
            line-height: 32px;
            font-size: 14px;
            transition: all 0.3s ease;
        }
        
        .social-link:hover {
            background: #5a67d8;
            transform: translateY(-2px);
        }
        
        /* Responsive Design */
        @media (max-width: 600px) {
            body {
                padding: 10px;
            }
            
            .email-wrapper {
                border-radius: 12px;
            }
            
            .header {
                padding: 30px 20px;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            .footer {
                padding: 25px 20px;
            }
            
            .logo {
                font-size: 24px;
            }
            
            .title {
                font-size: 20px;
            }
            
            .verify-button {
                padding: 14px 30px;
                font-size: 15px;
            }
        }
    </style>
</head>
<body>
    <div class="email-wrapper">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <span class="logo-icon"></span>
                FastBuss Market
            </div>
            <div class="title">Email Verification Required</div>
            <div class="subtitle">Complete your registration to get started</div>
        </div>
        
        <!-- Content -->
        <div class="content">
            <div class="greeting">Hello {{ $notifiable->name }}! 👋</div>
            
            <div class="message">
                Welcome to FastBuss Market! We're excited to have you on board. To complete your registration and unlock all the amazing features we offer, please verify your email address by clicking the button below.
            </div>
            
            <!-- Verification Button -->
            <div class="button-container">
                <a href="{{ $verificationUrl }}" class="verify-button">
                    Verify Email Address
                </a>
            </div>
            
            <!-- Alternative Link -->
            <div class="link-section">
                <div class="link-title">Having trouble with the button?</div>
                <p style="font-size: 14px; color: #718096; margin-bottom: 10px;">
                    Copy and paste this link into your browser:
                </p>
                <a href="{{ $verificationUrl }}" class="verification-link">
                    {{ $verificationUrl }}
                </a>
            </div>
            
            <!-- Warning -->
            <div class="warning">
                <div class="warning-content">
                    <div class="warning-title">Security Notice</div>
                    <div class="warning-text">
                        This verification link will expire in 60 minutes for your security. If you didn't create an account with FastBuss Market, please ignore this email.
                    </div>
                </div>
            </div>
            
            <div class="message">
                Once verified, you'll have access to:
                <ul style="margin: 15px 0; padding-left: 20px; color: #4a5568;">
                    <li>🚌 Bus and flight bookings</li>
                    <li>🎫 Ticket resale marketplace</li>
                    <li>⭐ Rate and review experiences</li>
                    <li>👤 Manage your profile and bookings</li>
                    <li>💳 Secure payment processing</li>
                </ul>
            </div>
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <div class="footer-content">
                <div class="footer-signature">Best regards,</div>
                <div class="footer-text">The FastBuss Market Team</div>
            </div>
            
            <div class="social-links">
                <a href="#" class="social-link">📧</a>
                <a href="#" class="social-link">📱</a>
                <a href="#" class="social-link">🌐</a>
            </div>
            
            <div class="footer-note">
                This is an automated message. Please do not reply to this email.
            </div>
        </div>
    </div>
</body>
</html> 