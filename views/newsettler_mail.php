<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Email</title>
<link href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
<style>
    .email-container {
        max-width: 600px;
        margin: auto;
    }
    .header, .footer {
        background-color: #f8f9fa;
        padding: 20px;
        text-align: center;
    }
    .main {
        padding: 20px;
    }
    .btn-main {
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
    .email-image {
        width: 100%;
        height: auto;
        display: block;
    }
</style>
</head>
<body>
<div class="container email-container">
    <div class="header">
        <h1>Welcome to Tourism project </h1>
    </div>
    <div class="main">
    <p>{{FirstName}},</p>
        <p>Great news, you will now be the first to see exclusive previews of our latest collections, hear about news and execlusive disscounts! community and get the most up to date news in the world of equipments.</p>
    </div>
    <div class="footer">
        <p>Love, The Tourism team</p>
    </div>
</div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>