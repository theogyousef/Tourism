<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
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

// if (!empty($_SESSION['products']) && $row['guest'] == 1) {
//   header("Location: login");
// }

if ($row["deactivated"] == 1) {
    header("Location: deactivated");
}

include "header.php";
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trips</title>
    <link rel="stylesheet" href="../public/flights.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <header>
        <style>
            <?php include "../public/css/trips.css"; ?>
        </style>
    </header>
    <div class="container mt-4">
        <h1>Trips Collection</h1>

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
    <?php $sql = "SELECT t.ID AS trip_id , t.name , t.flightID , t.hotelID , f.dept_time, f.arr_time, f.flight_dep, f.flight_arr, f.eco_price, f.flight_day , h.name AS hotel_name, h.price, h.duration, h.photo
        FROM trips t
        JOIN flights f ON t.flightID = f.id
        JOIN hotels h ON t.hotelID = h.ID";
$result = mysqli_query($conn, $sql);

if ($result->num_rows > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $totalprice = $row["price"] + $row["eco_price"];
        echo "<div class='container products-carousel' style='margin-top: 5px;'>
                <div class='container py-4'>
                    <div class='row'>
                        <div class='col-12'>
                            <div class='trip-card'>
                                <img src='" . $row["photo"] . "' alt='Hotel' class='hotel-image'>
                                <div class='trip-details'>
                                    <div class='trip-info'>
                                    <h3>" . $row["name"] . " trip</h3>
                                        <h5> At the " . $row["hotel_name"] . " hotel</h5>
                                        <p class='label-available'>Available - " . number_format($row["price"],2) . " LE /night</p>
                                        <p> Starting " . $row['flight_day'] .  " </p>
                                    </div>
                                    <div class='flight-info'>
                                        <h5><i class='bi bi-airplane-fill'></i> Flight Details</h5>
                                        <p><strong>Depart:</strong> " . $row["dept_time"] . " - " . $row["flight_dep"] . "</p>
                                        <p><strong>Arrive:</strong> " . $row["arr_time"] . " - " . $row["flight_arr"] . "</p>
                                        <p>" . $row["duration"]  . " days </p>
                                        <span class='price'> " . number_format($totalprice,2) . " LE</span>
                                        <button class='btn mitur position-absolute rounded-pill' style='margin-left: 120px; background-color: #0B2545; color: white; padding: 5px 10px;' id='book'>
                                            BOOK NOW
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>";
    }
}
?>
    <footer>
        <?php include "footer.php"; ?>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
<script>
    <?php include "../public/js/trips.js" ?>
</script>

</html>