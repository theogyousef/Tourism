<script>
  if (window.history.replaceState) {
    window.history.replaceState(null, null, window.location.href);
  }

</script>

<?php
require_once("../includes/Dbh.php");
require "../controller/registerationsystem.php";
$reqgisterationsystem = new Registerationsystem();


if (isset($_POST["submit"])) {
    $reqgisterationsystem->signup();
} else if (isset($_POST["login"])) {
    $reqgisterationsystem->signin();
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/CSS/signup.css">
    <title>Sign in</title>

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
                <li class="breadcrumb-item active" aria-current="page">Login</li>
            </ol>
        </nav>
    </div>

    <div class="container my-5">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="text-center mb-4">
                    <img src="https://egymonuments.gov.eg/Style%20Library/images/new-logo_web.png" alt="egyptlogo" style="max-width: 120px;">
                </div>
                <h2 class="text-center mb-4">Discover the Wonders of Egypt</h2>
                <p class="text-center mb-4" style="font-weight: normal;">Join us and explore a world of history, mystery, and adventure.</p>

                <div class="social-login-buttons d-grid gap-2 mb-3">
                    <button class="btn btn-google" type="button">
                        <img src="https://eg.hm.com/themes/custom/transac/alshaya_white_label/imgs/social-icons/google-login-logo.svg" alt="Google"> Google
                    </button>
                    <button class="btn btn-facebook" type="button">
                        <img src="https://eg.hm.com/themes/custom/transac/alshaya_white_label/imgs/social-icons/facebook-login-logo.svg" alt="Facebook"> Facebook
                    </button>
                </div>

                <div class="divider">
                    <span>Or</span>
                </div>

                <!-- Login Form -->
                <form method="post" name="loginForm" id="loginForm">
                    <div class="mb-3 custom-form-input">
                        <label for="emailInput" class="form-label">EMAIL <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" id="emailInput" placeholder="Enter *" >
                    </div>
                    <div class="mb-3 custom-form-input">
                        <label for="passwordInput" class="form-label">PASSWORD <span class="text-danger">*</span></label>
                        <input type="password" name="pass"  class="form-control" id="passwordInput" placeholder="Enter *">
                        <a href="../views/forgetpassword.php" class="password-reset-link">Forgotten your password?</a>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="login" class="login" id="submit-button" class="btn btn-lg start-50 rounded-pill">Sign in</button>
                    </div>
                </form>

                <div class="text-center mt-4">
                    <hr class="my-0" style="width: 80%; margin:auto;  margin-right: 40px;" />
                    <p class="mt-3">Not a member yet? <a href="signup" class="signup-link">Sign up</a></p>
                </div>

                <p class="disclaimer-text">
                    We cares about the protection of your personal data and, where strictly
                    necessary, uses them with the utmost care, in compliance with the regulations,
                    in order to provide you with services and to answer your requests, to customize
                    contents and offers, to send you promotional communications, to measure the
                    effectiveness of services and to create new ones, to detect anomalies and to
                    comply with legal obligations.
                </p>
            </div>
        </div>
    </div>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha2/js/bootstrap.bundle.min.js"></script>
</body>

</html>