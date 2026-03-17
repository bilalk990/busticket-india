<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Partner Application</title>
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
            background: linear-gradient(135deg, #1f75d8, #4a90e2);
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
        .details {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 4px;
            margin: 20px 0;
        }
        .details-item {
            margin-bottom: 10px;
        }
        .details-label {
            font-weight: bold;
            color: #1f75d8;
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
        .priority {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            border-radius: 4px;
            margin: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Partner Application</h1>
        </div>
        <div class="content">
            <div class="priority">
                <strong>Action Required:</strong> New partner application needs review
            </div>

            <p>Hello Admin,</p>
            
                            <p>A new partner application has been submitted through the FastBuss platform. Please review the details below:</p>
            
            <div class="details">
                <div class="details-item">
                    <span class="details-label">Name:</span>
                    {{ $data->first_name }} {{ $data->last_name }}
                </div>
                <div class="details-item">
                    <span class="details-label">Company:</span>
                    {{ $data->company }}
                </div>
                <div class="details-item">
                    <span class="details-label">Email:</span>
                    <a href="mailto:{{ $data->email }}">{{ $data->email }}</a>
                </div>
                <div class="details-item">
                    <span class="details-label">Phone:</span>
                    {{ $data->phone ?? 'Not provided' }}
                </div>
                <div class="details-item">
                    <span class="details-label">Website:</span>
                    {{ $data->url ? '<a href="' . $data->url . '">' . $data->url . '</a>' : 'Not provided' }}
                </div>
                <div class="details-item">
                    <span class="details-label">Country:</span>
                    {{ $data->country }}
                </div>
                <div class="details-item">
                    <span class="details-label">Address:</span>
                    {{ $data->address ?? 'Not provided' }}
                </div>
                <div class="details-item">
                    <span class="details-label">Additional Comments:</span>
                    {{ $data->comments ?? 'No additional comments' }}
                </div>
            </div>

            <div style="text-align: center;">
                <a href="https://fastbuss.com/admin/partners" class="button">Review Application</a>
            </div>

            <p><strong>Next Steps:</strong></p>
            <ol>
                <li>Review the application details</li>
                <li>Check company background and credentials</li>
                <li>Contact the applicant within 2-3 business days</li>
                <li>Update the application status in the admin panel</li>
            </ol>
        </div>
        <div class="footer">
                            <p>© {{ date('Y') }} FastBuss. All rights reserved.</p>
                <p>This is an automated message from the FastBuss Partner Portal.</p>
        </div>
    </div>
</body>
</html>
