<?php
require_once "../model/adminModle.php";

$adminModel = new adminModel();
$conn = $adminModel->getConn();

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

$searchTerm = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

$searchTerms = explode(' ', $searchTerm);

$query = "SELECT * FROM flights";
if ($searchTerm !== '') {
    $conditions = [];
    foreach ($searchTerms as $term) {
        $escapedTerm = mysqli_real_escape_string($conn, $term);
        $conditions[] = "(flight_dep LIKE '%{$escapedTerm}%' OR flight_arr LIKE '%{$escapedTerm}%')";
    }
    $query .= " WHERE " . implode(' AND ', $conditions);
}

$result = mysqli_query($conn, $query);
$flights = mysqli_fetch_all($result, MYSQLI_ASSOC);

if (isset($_GET['html']) && $_GET['html'] == 'true') {
    foreach ($flights as $flight) {
        echo "<tr>
                <td>{$flight['id']}</td>
                <td>{$flight['flight_dep']}</td>
                <td>{$flight['flight_arr']}</td>
                <td>{$flight['dept_time']}</td>
                <td>{$flight['arr_time']}</td>
                <td>{$flight['eco_price']}</td>
                <td>{$flight['bus_price']}</td>
                <td><a href='editflight?id={$flight['id']}' style='color: orange;'><span class='fas fa-edit'></span></a></td>
                <td><a href='deleteflight?id={$flight['id']}' style='color: red;'><span class='fas fa-trash-alt'></span></a></td>
              </tr>";
    }
} else {
    echo json_encode($flights);
}
?>
