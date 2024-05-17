<?php
require_once "../model/adminModle.php";

$adminModel = new adminModel();
$conn = $adminModel->getConn();

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

header('Content-Type: application/json;charset=utf8');

if (isset($_GET['q'])) {
    $query = $_GET['q'];
    $searchResults = [];

    // Search for hotels
    $queryHotels = "SELECT id, name, location, price, photo FROM hotels WHERE name LIKE ?";
    $stmtHotels = $conn->prepare($queryHotels);
    $likeQuery = '%' . $query . '%';
    $stmtHotels->bind_param("s", $likeQuery);
    $stmtHotels->execute();
    $resultHotels = $stmtHotels->get_result();

    while ($row = $resultHotels->fetch_assoc()) {
        $searchResults[] = [
            'id' => $row['id'],
            'name' => $row['name'],
            'location' => $row['location'],
            'price' => $row['price'],
            'photo' => $row['photo'],
            'type' => 'Hotel'
        ];
    }
    $stmtHotels->close();

    // Search for flights
    $queryFlights = "SELECT id, flight_dep, flight_arr, eco_price as price FROM flights WHERE flight_dep LIKE ? OR flight_arr LIKE ?";
    $stmtFlights = $conn->prepare($queryFlights);
    $stmtFlights->bind_param("ss", $likeQuery, $likeQuery);
    $stmtFlights->execute();
    $resultFlights = $stmtFlights->get_result();

    while ($row = $resultFlights->fetch_assoc()) {
        $searchResults[] = [
            'id' => $row['id'],
            'name' => $row['flight_dep'] . ' to ' . $row['flight_arr'],
            'price' => $row['price'],
            'type' => 'Flight'
        ];
    }
    $stmtFlights->close();

    echo json_encode($searchResults);
}

?>
