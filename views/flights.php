<?php
require '../includes/config.php';
require '../includes/Dbh.php';

// include "header.php";
require_once '../model/fetchModle.php';
require_once '../controller/usercontroller.php';
$usercontroller = new usercontroller();
$fetchModle = new fetchModle();
$conn = $usercontroller->getConn();
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    $result = mysqli_query($conn, " SELECT p.*, u.* FROM permissions p JOIN users u ON p.user_id = u.id WHERE p.guest = '1' ");
    $row = mysqli_fetch_assoc($result);
    $_SESSION["login"] = true;
    $_SESSION["id"] = $row["id"];
} else if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id';");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login");
}


$dbh = new Dbh();
$result = $dbh->query("SELECT * FROM flights");
$flights = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights</title>
    <link rel="stylesheet" href="../public/flights.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
    <header>
        <?php include "header.php"; ?>
        <style>
            <?php include "../public/css/flights.css"; ?>
        </style>
    </header>
    <div class="container mt-4">
            <h1>Flights Collection</h1>

            <div class="row mb-3" id="filters">
                <div class="col-md-2">
                    <form class="filter" id="filterF" method="post">
                        <select class="form-select filter-select filter-dropdown" aria-label="Availability" name="availability" data-form-id="filterF">
                            <option value="">Availability</option>
                            <option value="1">Available</option>
                            <option value="2">Full !</option>
                        </select>
                    </form>
                </div>
                <div class="col-md-2">
                    <form class="filter" id="filterCategory" method="post">
                        <select class="form-select filter-select filter-dropdown" aria-label="Category" name="category" data-form-id="filterCategory">
                            <option value="">Rating Stars</option>
                            <option value="1">Category 1</option>
                            <option value="2">Category 2</option>
                            <!-- Add more categories as needed -->
                        </select>
                    </form>
                </div>

                <div class="col-md-2">
                    <form class="filter" id="filterForm" method="post">
                        <select class="form-select filter-select filter-dropdown" aria-label="Price" name="price" data-form-id="filterForm">
                            <option value="">Price</option>
                            <option value="4">Highest To Lowest</option>
                            <option value="5">Lowest To Highest</option>
                            <option value="1">Under 10000</option>
                            <option value="2">10000 to 40000</option>
                            <option value="3">40000 and above</option>
                        </select>
                    </form>
                </div>

                <div class="col-md-2" id="reset">
                    <form method="post" action="">
                        <div class="col-md-2">
                            <button name="reset" type="submit" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="container mb-3 mt-3">
                <button class="btn btn-light btn-grid">
                    <i class="bi bi-grid-3x3-gap"></i>
                </button>

                <button class="btn btn-light btn-list">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>
    <div class="container products-carousel" style="margin-top: 5px;">
        <div class="row">
            <?php foreach ($flights as $flight):
                $deptTime = strtotime($flight['dept_time']);
                $arrTime = strtotime($flight['arr_time']);
                $duration = gmdate('H:i', $arrTime - $deptTime);
                ?>
                <div class="col-md-3">
                    <div class="flights">
                        <div class="Content">
                            <div class="details">
                                <h3 class="product-title route">
                                    <?php echo $flight['flight_dep']; ?>&nbsp;&nbsp;
                                    <span class="arrow"><i class='bx bx-transfer-alt'></i></span>&nbsp;
                                    <?php echo $flight['flight_arr']; ?>
                                </h3>
                                <h3 class="product-title time">
                                    <?php echo date('h:i A', $deptTime); ?>&nbsp;&nbsp;
                                    <span class="arrow"><i class='bx bx-transfer-alt'></i></span>&nbsp;
                                    <?php echo date('h:i A', $arrTime); ?>
                                </h3>
                                <p class="detailsinfo" style="margin-bottom: 0;">
                                    <span class="typetrip">Round-trip</span>
                                    <span class="separate"></span>
                                    <span class="nofdays"><?php echo $duration . ' Hrs'; ?></span>
                                </p>
                                <p class="detailsinfo" style="margin-top: 0; padding:0;">
                                    <span class="typetrip"><?php echo $flight['flight_day']; ?></span>
                                
                                </p>
                                
                            <ul class="">
                                <li class="list-group-item">
                                    <p class="lower-price">
                                        <span class="from-text">From</span>
                                        <span
                                            class="price"><?php echo number_format($flight['eco_price'], 2) . ' LE'; ?></span>
                                    </p>
                                </li>
                            </ul>
                            </div>


                            <div class="product-actions mt-3">
                            
                                <button  class="btn btn-primary">Book Now</button>
                                <button class="btn btn-secondary add-to-wishlist">Add to Wishlist</button>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        <?php include "footer.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>