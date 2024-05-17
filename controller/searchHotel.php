<?php
require_once "../model/adminModle.php";

// Create a new instance of the adminModel to initialize the database connection
$adminModel = new adminModel();
$conn = $adminModel->getConn();

// Check if the connection is established
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if the search term exists, and assign value or an empty string to the variable
$searchTerm = isset($_GET['query']) ? mysqli_real_escape_string($conn, $_GET['query']) : '';

// Split the search term into parts by space
$searchTerms = explode(' ', $searchTerm);

// Construct the query based on the search terms, but only for name and location
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

// Returning the HTML after searching
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
