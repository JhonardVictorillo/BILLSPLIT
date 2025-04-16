<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('css/welcomeEmail.css')}}" rel="stylesheet">
    <title>Welcome to BillSplit Pro</title>
    
</head>
<body>
    <div class="header">
        <div class="logo">
            <svg class="logo-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 8C9.79 8 8 9.79 8 12C8 14.21 9.79 16 12 16C14.21 16 16 14.21 16 12C16 9.79 14.21 8 12 8ZM12 20C7.58 20 4 16.42 4 12C4 7.58 7.58 4 12 4C16.42 4 20 7.58 20 12C20 16.42 16.42 20 12 20ZM12 2C6.48 2 2 6.48 2 12C2 17.52 6.48 22 12 22C17.52 22 22 17.52 22 12C22 6.48 17.52 2 12 2Z" fill="#4F46E5"/>
            </svg>
            BillSplit Pro
        </div>
    </div>

    <div class="content">
        <h1>Welcome to BillSplit Pro, {{ $user->first_name }}!</h1>
        
        <p>Thank you for creating an account with BillSplit Pro. We're excited to help you manage your shared expenses easily and fairly.</p>
        
        <p>To get started, please verify your email address by clicking the button below:</p>
        
        <p>
            <a href="{{ $verificationUrl }}" class="button">Verify Email Address</a>
        </p>
        
        <p>If you didn't create an account with us, please ignore this email.</p>
        
        <div class="verification-link">
            <p>If you're having trouble with the button above, copy and paste this link into your browser:</p>
            <p>{{ $verificationUrl }}</p>
        </div>
    </div>

    <div class="footer">
        <p>© {{ date('Y') }} BillSplit Pro. All rights reserved.</p>
        <p>
            <a href="{{ route('login.form') }}" style="color: #4F46E5; text-decoration: none;">Login to your account</a> | 
            <a href="#" style="color: #4F46E5; text-decoration: none;">Help Center</a>
        </p>
    </div>
</body>
</html>