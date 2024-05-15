<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>
<?php

require "../controller/forgetpassword.php";
$usercontroller = new Forgetpassword();

if (isset($_POST["submitpass"])) {
  $usercontroller->newpassword();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/CSS/signup.css">
    <title>Forget password</title>

    <style>
        <?php
        include "../public/CSS/signin.css";
        ?>
    </style>

</head>

<body>

    <!-- nav Bar -->
    <div class="breadcrumb-container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Forget Password</li>
            </ol>
        </nav>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="text-center mb-4">
                    <img src="https://egymonuments.gov.eg/Style%20Library/images/new-logo_web.png" alt="egyptlogo" style="max-width: 120px;">
                </div>
                <h2 class="text-center mb-4">NEW PASSWORD</h2>
                <p class="text-center mb-4" style="font-weight: normal;">Please enter your new password.</p>

                <!-- reset password Form -->


    <form method="post" name="passwordResetForm" id="passwordResetForm" onsubmit="return validatePasswordResetForm()">
        <div class="mb-3 custom-form-input">
            <label for="passwordInput" class="form-label">PASSWORD <span class="text-danger">*</span></label>
            <input type="password" name="password" class="form-control" id="passwordInput" placeholder="Enter Password">
            <div class="error" id="passwordError"></div>
        </div>

        <div class="mb-3 custom-form-input">
            <label for="confirmpasswordInput" class="form-label">CONFIRM PASSWORD <span class="text-danger">*</span></label>
            <input type="password" name="confirmpassword" class="form-control" id="confirmpasswordInput" placeholder="Confirm Password">
            <div class="error" id="confirmPasswordError"></div>
        </div>

        <div class="d-grid">
            <button type="submit" name="submitpass" id="submitnewpassword" class="login"class="btn btn-lg btn-primary start-50 rounded-pill">Submit</button>
        </div>
    </form>

                <div class="text-center mt-4">
                    <hr class="my-0" style="width: 80%; margin:auto;  margin-right: 40px;" />
                    <p class="mt-3"><a href="../views/login.php" class="signup-link">Back to login</a></p>
                </div>

            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"></script>
</body>

<script>
        <?php include "../public/js/resetpassword.js" ?>
    </script>
</html>