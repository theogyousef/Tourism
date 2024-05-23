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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="../public/CSS/adminDasboard.css">


    <title>Admin panel</title>
    <style>
        <?php include "../public/CSS/adminDasboard.css" ?>
    </style>


</head>


<body>
    <div class="container">
        <div class="main" id="product">
            <div class="cards">
                <div class="card">
                    <div class="card-content">
                        <div class="number">
                            <?php
                            $sql = "SELECT COUNT(*) AS total_trips FROM trips";
                            $result = mysqli_query($conn, $sql);
                            $data = mysqli_fetch_assoc($result);
                            echo $data['total_trips'];
                            ?>
                        </div>
                        <div class="card-name">Total Trips</div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-suitcase"></i>
                    </div>
                </div>
            </div>

            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search for products">
                <button class="search-button" style="background-color: black;">Search</button>
            </div>

            <div id="searchResult"></div>

            <div class="container-fluid">
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Trip name</th>
                            <th>Departure</th>
                            <th>Arrival</th>
                            <th>Flight</th>
                            <th>Hotel</th>
                            <th>Hotel name</th>
                            <th>Price</th>
                            <th>Duration</th>
                            <th>Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
$sql = "SELECT t.ID AS trip_id , t.name , t.flightID , t.hotelID , f.dept_time, f.arr_time, f.flight_dep, f.flight_arr, f.eco_price, f.flight_day , h.name AS hotel_name, h.price, h.duration FROM trips t
        JOIN flights f ON t.flightID = f.id
        JOIN hotels h ON t.hotelID = h.ID";
$result = mysqli_query($conn, $sql);

while ($row = mysqli_fetch_assoc($result)) {
    // Calculate the total price inside the loop for each row fetched
    $totalprice = $row["price"] + $row["eco_price"];
    
    echo "<tr>
        <td>" . $row["trip_id"] . "</td>
        <td>" . $row["name"] . "</td>
        <td>" . $row["flight_dep"] . "</td>
        <td>" . $row["flight_arr"] . "</td>
        <td>" . $row["flightID"] . "</td>
        <td>" . $row["hotelID"] . "</td>
        <td>" . $row["hotel_name"] . "</td>
        <td>" . $totalprice . "</td>
        <td>" . $row["duration"] . "</td>
        <td>" . $row["flight_day"] . "</td>

        <td>
            <a href='edittrip?id=" . $row["trip_id"] . "' style='color: orange;'>
                <span class='fas fa-edit'></span>
            </a>
        </td>
        <td>
            <a href='deletetrip?id=" . $row["trip_id"] . "' style='color: red;'>
                <span class='fas fa-trash-alt'></span>
            </a>
        </td>
    </tr>";
}
?>


                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../public/JS/productsearch.js"></script>
    <script src="../public/JS/admindasboard.js"></script>
</body>


</html>