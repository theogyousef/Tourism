<?php
require_once '../includes/config.php';
require_once '../includes/Dbh.php';



// Ensure the user is logged in
if (!isset($_SESSION["id"])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION["id"];

$db = new DBh();
$conn = $db->getConn();

$sql = "SELECT b.*, f.flightNumber, f.departure, f.arrival, h.name AS hotelName, h.location 
        FROM bookings b
        JOIN flights f ON b.flightID = f.id
        JOIN hotels h ON b.hotelID = h.id
        WHERE b.user_id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$bookings = $result->fetch_all(MYSQLI_ASSOC);

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="../public/flights.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
<header>
    <?php include "header.php"; ?>
    <style>
        <?php include "../public/css/my_bookings.css"; ?>
    </style>
</header>
<div class="container">
    <h1>My Bookings</h1>
    <?php if (count($bookings) > 0): ?>
        <table class="table">
            <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Flight Number</th>
                    <th>Departure</th>
                    <th>Arrival</th>
                    <th>Hotel Name</th>
                    <th>Hotel Location</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($booking['id']); ?></td>
                        <td><?php echo htmlspecialchars($booking['flightNumber']); ?></td>
                        <td><?php echo htmlspecialchars($booking['departure']); ?></td>
                        <td><?php echo htmlspecialchars($booking['arrival']); ?></td>
                        <td><?php echo htmlspecialchars($booking['hotelName']); ?></td>
                        <td><?php echo htmlspecialchars($booking['location']); ?></td>
                        <td><?php echo htmlspecialchars($booking['status']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no bookings.</p>
    <?php endif; ?>
</div>
</body>
</html>
