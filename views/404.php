<?php
require_once("../includes/Dbh.php");
require_once '../controller/usercontroller.php';
$usercontroller = new usercontroller();
// Instantiate the ProductController
    $conn = $usercontroller->getConn();

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    $conn = $usercontroller->getConn();
    $result = mysqli_query($conn, "SELECT p.*, u.* FROM permissions p JOIN users u ON p.user_id = u.id WHERE p.guest = '1'");
    $row = mysqli_fetch_assoc($result);
  
    if ($row) {
        $_SESSION["login"] = true;
        $_SESSION["id"] = $row["id"];
    } else {
       
    }
  }
  else if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $conn = $usercontroller->getConn();
    $result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id';");
    $row = mysqli_fetch_assoc($result);
  } else {
    header("Location: login");
  }
// include "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="../public/CSS/index.css">
        <link rel="stylesheet" href="../public/CSS/404.css">


    <title>product</title>
    <style>
        <?php
        include "../public/css/index.css"
            ?>
        <?php
        include "../public/css/404.css"
            ?>
    </style>
</head>

<body>


    <section class="page_404">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 ">
                    <div class="col-sm-10 col-sm-offset-1  text-center">
                        <div class="four_zero_four_bg">
                            <h1 class="text-center ">404</h1>


                        </div>

                        <div class="contant_box_404">
                            <h3 class="h2">
                                Look like you're lost
                            </h3>

                            <p>the page you are looking for not avaible!</p>

                            <a href="index" class="link_404">Go to Home</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <?php
        include "footer.php" ?>
    </footer>

    <script src="../public/JS/product.js"></script>

</body>

</html>