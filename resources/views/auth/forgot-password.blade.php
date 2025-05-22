<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Reset Your Password</title>
    <style>
        /* Simple inline-friendly styles */
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 30px auto;
            padding: 25px;
            background-color: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 8px;
        }

        h2 {
            color: #212529;
        }

        p {
            color: #212529;
            font-size: 16px;
            line-height: 1.5;
        }

        .btn-reset {
            display: inline-block;
            background-color: #0d6efd;
            color: #ffffff !important;
            padding: 12px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            margin-top: 15px;
        }

        .footer {
            margin-top: 30px;
            font-size: 12px;
            color: #6c757d;
            text-align: center;
            font-family: Arial, sans-serif;
        }
    </style>
</head>

<body>

    <div class="email-container">
        <h2>Reset Your Password</h2>

        <p>Hello {{ $user->name ?? 'User' }},</p>

        <p>We received a request to reset your password. Click the button below to reset it:</p>

        <a href="{{ config('app.react_app_url') }}/resetpassword?token={{ $resetLink }}" class="btn-reset">Reset Password</a>

        <p>If you didn’t request a password reset, no action is needed.</p>

        <hr>

        <p class="footer">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
    </div>

</body>

</html>