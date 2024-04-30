<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../controller/usercontroller.php';
$usercontroller = new usercontroller();

if (!empty($_SESSION["id"])) {
	$id = $_SESSION["id"];
	$conn = $usercontroller->getConn();
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <title>Admin panel</title>
    <style>
        <?php include "../public/CSS/adminDasboard.css" ?>
    </style>


</head>


<body>
    <div class="container">

        <!-- Dashboard -->
        <div class="main" id="mainpart">
            <div class="cards">






                <div class="card">
                    <div class="card-content">
                        <div class="number">
                            <?php
                            $sql = "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id";
                            $resultuser = mysqli_query($conn, $sql);

                            $counteruser = -1;
                            while ($row = mysqli_fetch_assoc($resultuser)) {
                                $counteruser++;
                            }
                            echo $counteruser ?>
                        </div>
                        <div class="card-name">Total users :</div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-users"></i>
                    </div>
                </div>


                <div class="card">
                    <div class="card-content">
                        <div class="number">
                            <?php
                            $sql = "SELECT * from products ";
                            $resultproduct = mysqli_query($conn, $sql);

                            $counterproducts = 0;
                            while ($row = mysqli_fetch_assoc($resultproduct)) {
                                $counterproducts++;
                            }
                            echo $counterproducts ?>
                        </div>
                        <div class="card-name">pieces of equipment</div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-dumbbell"></i>
                    </div>
                </div>


                <div class="card">
                    <div class="card-content">
                        <div class="number">
                            <?php
                            $sql = "SELECT * from orders  ";
                            $resultproduct = mysqli_query($conn, $sql);

                            $counterproducts = 0;
                            while ($row = mysqli_fetch_assoc($resultproduct)) {
                                $counterproducts++;
                            }
                            echo $counterproducts ?>
                        </div>
                        <div class="card-name"> Orders</div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-box-open"></i>
                    </div>
                </div>


            </div>



        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>

        <script src="../public/JS/admindasboard.js"></script>


</body>

</html>