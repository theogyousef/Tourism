<?php
require_once "../model/adminModle.php";

$adminModel = new adminModel();
$conn = $adminModel->getConn();

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$searchTerm = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

$searchTerms = explode(' ', $searchTerm);

$query = "SELECT * FROM hotels";
if ($searchTerm !== '') {
    $conditions = [];
    foreach ($searchTerms as $term) {
        $escapedTerm = mysqli_real_escape_string($conn, $term);
        $conditions[] = "(name LIKE '%{$escapedTerm}%' OR location LIKE '%{$escapedTerm}%')";
    }
    $query .= " WHERE " . implode(' AND ', $conditions);
}

$result = mysqli_query($conn, $query);
$hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_GET['html']) && $_GET['html'] == 'true') {
    foreach ($hotels as $hotel) {
        echo "<tr>
                <td>{$hotel['ID']}</td>
                <td>{$hotel['name']}</td>
                <td>{$hotel['location']}</td>
                <td>{$hotel['price']}</td>
                <td><a href='edithotel?id={$hotel['ID']}' style='color: orange;'><span class='fas fa-edit'></span></a></td>
                <td><a href='deletehotel?id={$hotel['ID']}' style='color: red;'><span class='fas fa-trash-alt'></span></a></td>
              </tr>";
    }
} else {
    echo json_encode($hotels);
}
?>
