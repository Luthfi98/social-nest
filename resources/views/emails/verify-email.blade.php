<!DOCTYPE html>
<html>
<head>
    <title>Email Verification</title>
</head>
<body>
    <h2>Welcome to Social Nest!</h2>
    <p>Hello {{ $user->name }},</p>
    <p>Thank you for registering. Please click the button below to verify your email address:</p>
    
    <a href="{{ url('/verify-email/' . $token) }}" 
       style="background-color: #4CAF50; 
              color: white; 
              padding: 14px 20px; 
              text-decoration: none; 
              border-radius: 4px;
              display: inline-block;
              margin: 20px 0;">
        Verify Email Address
    </a>

    <p>If you did not create an account, no further action is required.</p>
    
    <p>Regards,<br>Social Nest Team</p>
</body>
</html> 