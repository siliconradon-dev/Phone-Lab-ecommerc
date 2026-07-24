<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f8f9fa; padding: 20px;">

    <div
        style="max-width: 600px; margin: auto; background: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 2px 8px rgba(0,0,0,0.05);">

        <!-- Logo -->
        <div style="text-align: center; margin-bottom: 20px;">
            @if ($siteSettings['site_logo'] ?? false)
                <img src="{{ asset($siteSettings['site_logo']) }}" alt="{{ $siteSettings['site_name'] ?? 'Site Name' }} Logo"
                    style="height: 80px;">
            @else
                <img src="{{ asset('assets/images/logo/logo-placeholder.png') }}" alt="logo" style="height: 80px;">
            @endif
        </div>

        <!-- Company Name -->
        <h2 style="text-align: center; color: #333;">{{ $siteSettings['site_name'] ?? 'Site Name' }}</h2>

        <!-- Greeting -->
        <h3>Hello {{ $name }},</h3>

        <p style="color: #555;">
            Thank you for registering with <strong>{{ $siteSettings['site_name'] ?? 'Site Name' }}</strong>.<br>
            To complete your registration, please verify your email address by clicking the button below:
        </p>

        <!-- Button -->
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $url }}"
                style="padding: 12px 25px; background-color: #4CAF50; color: #ffffff; text-decoration: none; font-weight: bold; border-radius: 5px;">
                Verify My Account
            </a>
        </div>

        <p style="color: #777;">
            If you did not create an account with us, you can safely ignore this email.
        </p>

        <hr style="margin-top: 40px;">

        <p style="text-align: center; font-size: 12px; color: #aaa;">
            &copy; {{ date('Y') }} {{ $siteSettings['site_name'] ?? 'Site Name' }}. All rights reserved.
        </p>
    </div>

</body>

</html>
