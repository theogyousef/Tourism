<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../controller/AdminFunctions.php';
$AdminFunctions = new AdminFunctions();
if (isset($_POST["adduserb"])) {
    
    $AdminFunctions->adduser();
}
if (!empty($_SESSION["id"])) {
	$id = $_SESSION["id"];
	$conn = $AdminFunctions->getConn();
	$result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id';");
	$row = mysqli_fetch_assoc($result);
  } else {
	header("Location: login");
  }

if ($row["admin"] != 1) {
    header("Location: index");

}

if ($row["guest"] == 1) {
    header("Location: login");

}

include "adminnav.php";


?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />


    <title>Admin panel</title>
    <style>
        <?php include "../public/CSS/adminDasboard.css" ?>
    </style>

</head>


<div class="container">


    <!-- Add user -->

    <div class="main" id="adduser">
        <div class="formcards">
            <div class="formcard">
                <div class="form-container">

                    <h1>ADD User</h1>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="two-forms">
                            <div class="input-box">
                                <input type="text" class="input-field" placeholder="First name" name="fname">
                                <i class="bx bx-user"></i>
                            </div>
                            <div class="input-box">
                                <input type="text" class="input-field" placeholder="Last name" name="lname">
                                <i class="bx bx-user"></i>
                            </div>
                        </div>
                        <div class="input-box">
                            <input type="email" class="input-field" placeholder="Email" name="email">
                            <i class="bx bx-envelope"></i>
                        </div>
                        <div class="input-box">
                            <input id="reg-password" type="password" class="input-field" placeholder="Password"
                                name="password">
                        </div>
                        <div class="input-box">
                            <input id="conpassword" type="password" class="input-field" placeholder="Confirm password"
                                name="confirmpassword">
                        </div>
                        <div class="mb-3">
                            <input type="submit" name="adduserb" value="add user"
                                style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>