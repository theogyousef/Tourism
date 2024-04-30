<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Reset Password Email</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .email-header {
        background-color: #ffffff;
        padding: 10px;
        text-align: center;
    }
    .email-body {
        padding: 20px;
        background-color: #f8f9fa; 
    }
    .email-footer {
        font-size: 0.8rem;
        padding: 20px;
        text-align: center;
        background-color: #ffffff;
        color: #6c757d; 
    }
    .email-header img {
        width: 100%;
        height: auto;
        max-width: 1400px;
    }
    .email-body {
        padding: 20px;
        background-color: #f8f9fa; 
        text-align: center; 
    }
    .greeting, .content-text {
        margin: 0 auto;
        max-width: 600px; 
    }
    .thin-line {
        border: 0;
        height: 1px;
        background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0));
        margin: 20px 0;
    }
    .email-footer {
        font-size: 0.8rem;
        padding: 20px;
        text-align: center;
        background-color: #ffffff;
        color: #6c757d;
        margin-top: 20px;
    }
    @media only screen and (max-width: 600px) {
        .greeting, .content-text {
            margin: 0 10px;
        }
        .email-header img {
            max-width: 100%; 
        }
    }
</style>
</head>
<body>

<!-- Email Header -->
<div class="email-header">
    <img src="https://egymonuments.gov.eg/Style%20Library/images/new-logo_web.png" alt="Logo" style="max-width: 100px;"> 
</div>

<div class="email-header">
</div>

<!-- Email Body -->
<div class="email-body">
    <h2 class="greeting" >Hello </h2>

    <hr class="thin-line"> 

    <div class="content-text">
        <p>We received a request to reset your password for your account.</p>
        <p>Your OTP code is: {{otp_code}}</p>
        <p>If you didn't ask to change your password, please ignore this email.</p>
        <p>Best Wishes</p>
    </div>
</div>

<div class="email-footer">
    <hr>
    <p>This is an automated message, please do not reply.</p>
</div>

</body>
</html>
