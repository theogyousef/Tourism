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

    <title>LOGIN</title>

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
                <h3 class="h3 mb-3 fw-bold text-center" style="margin-left:30px;">LOGIN</h3>

                <form method="post" name="loginForm" id="loginForm" onsubmit="validateLogin(event)" style="padding-left:30px;">

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingPassword" placeholder="email" name="email">
                        <label for="floatingPassword">Email</label>
                    </div>

                    <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="password" name="pass" placeholder="password">
                        <label for="password">Password</label>
                        <i class="bi bi-eye-slash position-absolute top-50 end-0 translate-middle-y pe-3" onclick="togglePasswordVisibility('password', this)" style="margin-right: 50px; margin-top : -20px;"></i>
                  
                        <p class="mt-4 text-left">
                            <a href="forgetpassword" class="text-muted">Forget password?</a>
                        </p>
                    </div>
                    <div style="height: 20px;">
                        <span id="loginErrorMessages" style="display: none;"></span>
                    </div>

                    <div class="d-grid center-btn">
                        <input name="login" type="submit" class="btn btn-lg btn-dark" value="Log in" style="margin-top: 15px;" id="submit-button">

                    </div>
                </form>


                <p class="mt-4 text-center">
                    <a href="signup" class="text-muted">Create an account ?</a>
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