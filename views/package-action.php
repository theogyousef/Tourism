<?php
require_once '../includes/config.php';
require_once '../includes/Dbh.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Check if both hotel and flight are selected
    if (isset($_POST["hotel_id"]) && isset($_POST["flight_id"])) {
        // Retrieve the selected hotel and flight IDs from the form submission
        $selectedHotelId = $_POST["hotel_id"];
        $selectedFlightId = $_POST["flight_id"];

        $userId = $_SESSION["id"];

        $bookingStatus = "pending"; 
        // Insert the selected hotel and flight IDs into the orders table
        $db = new DBh();
        $conn = $db->getConn();
        $sql = "INSERT INTO bookings (user_id, flightID, hotelID, status) VALUES ('$userId', '$selectedHotelId', '$selectedFlightId', '$bookingStatus')";

        // Check if the insertion was successful
        if ($conn->query($sql) === TRUE) {
            // Insertion successful, redirect to a success page or do further processing
            header("Location: index.php");
            exit;
        } else {
            // Insertion failed, handle error
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        // Hotel or flight not selected, handle error
        echo "Error: Hotel or flight not selected.";
    }
}
?>
