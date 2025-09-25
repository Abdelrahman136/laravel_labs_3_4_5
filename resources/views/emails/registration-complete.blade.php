<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Our Platform</title>
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
            background-color: #4f46e5;
            color: white;
            padding: 20px;
            text-align: center;
            border-radius: 8px 8px 0 0;
        }

        .content {
            background-color: #f9fafb;
            padding: 30px;
            border-radius: 0 0 8px 8px;
        }

        .welcome-message {
            font-size: 18px;
            margin-bottom: 20px;
        }

        #button {
            display: inline-block;
            background-color: #4f46e5;
            color: white !important;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 6px;
            margin: 20px 0;
        }

        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
            color: #6b7280;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Welcome to Our Platform!</h1>
    </div>

    <div class="content">
        <div class="welcome-message">
            <p>Hello {{ $user->name }},</p>

            <p>Thank you for registering with us!</p>

            <p>Here are your account details:</p>
            <ul>
                <li><strong>Name:</strong> {{ $user->name }}</li>
                <li><strong>Email:</strong> {{ $user->email }}</li>
                <li><strong>Registration Date:</strong> {{ $user->created_at->format('F j, Y') }}</li>
            </ul>

            <p>You can now log in and start using all the features available to you.</p>

        </div>

    </div>
</body>

</html>