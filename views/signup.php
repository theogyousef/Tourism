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

include "header.php";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
      <link rel="stylesheet" href="../public/CSS/signup.css">

    <title>Create Account</title>

    <style>
        <?php
        include "../public/CSS/signup.css";
        ?>
    </style>

</head>

<body>

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <h3 class="h3 mb-3 fw-bold text-center" style="margin-left:30px;" >CREATE ACCOUNT</h3>

                <form method="post" name="signupform" id="myform" onsubmit="validateRegistration(event)" style="padding-left: 30px; ">
                    <div class="form-floating mb-3 ">
                        <input type="text" class="form-control" id="floatingInputEmail" name="fname" placeholder="First name">
                        <label for="floatingInputEmail">First name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="floatingPassword" name="lname" placeholder="Last name">
                        <label for="floatingPassword">Last name</label>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingPassword" name="email" placeholder="Email">
                        <label for="floatingPassword">Email</label>
                    </div>

                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="password" name="password" placeholder="password">
                        <label for="password">Password</label>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3" onclick="togglePasswordVisibility('password', this)" style="margin-right: 50px;"></i>
                    </div>

                    <div class="form-floating mb-3 position-relative">
                        <input type="password" class="form-control" id="confirmpassword" name="confirmpassword" placeholder="Confirm password">
                        <label for="confirmpassword">Confirm password</label>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3" onclick="togglePasswordVisibility('confirmpassword', this)" style="margin-right: 50px;"></i>
                    </div>

                    <div style="height: 20px;">
                        <span id="errorMessages" class="error-message"></span>
                    </div>

                    <div class="d-grid center-btn">
                        <input name="submit" type="submit" class="btn btn-lg btn-dark" value="Register" id="submit-button">
                    </div>

                </form>
<!-- 
                <div class="divider-or my-4">
                    <span>OR</span>
                </div>

                <a href="#" class="social-button">
                    <img src="https://eg.hm.com/themes/custom/transac/alshaya_white_label/imgs/social-icons/google-login-logo.svg" alt="Google" class="social-icon"> Continue with Google
                </a>

                <a href="#" class="social-button">
                    <img src="https://eg.hm.com/themes/custom/transac/alshaya_white_label/imgs/social-icons/facebook-login-logo.svg" alt="Facebook" class="social-icon"> Continue with Facebook
                </a> -->

                <p class="mt-4 text-center">
                    <a href="login" class="text-muted">Already have an account?</a>
                </p>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/JS/Registeration.js"></script>
    <script src="../public/JS/togglePassword.js"></script>


    <footer>
        <?php
        include "footer.php";
        ?>
    </footer>
</body>

</html>