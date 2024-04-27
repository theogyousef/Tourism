<?php
require '../includes/config.php';
require '../includes/Dbh.php';


$dbh = new Dbh();
$result = $dbh->query("SELECT * FROM flights");
$flights = $result->fetch_all(MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang ="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flights</title>
    <link rel="stylesheet" href="../public/flights.css">
</head>

<body>
<header>
        <h1>Flights</h1>
        <style>
            <?php include "../public/css/flights.css"; ?>
        </style>
    </header>

   
    <div class="flight-wrap">
        <?php foreach ($flights as $flight) : ?>
            <div class="flight-container">
               
                <div class="flight-details">
                    
                    <p class="flight-duration">Duration: <?php echo $flight['flight_dur']; ?> hours</p>
                    <p class="flight-stops">Stops: <?php echo $flight['flight_day']; ?></p>
                    <p class="flight-day">Day: <?php echo $flight['flight_day']; ?></p>
                    <p class="flight-departure">Departure: <?php echo $flight['flight_dep']; ?></p>
                    <p class="flight-arrival">Arrival: <?php echo $flight['flight_arr']; ?></p>
                    <p class="departure-time">Departure Time: <?php echo $flight['dept_time']; ?></p>
                    <p class="arrival-time">Arrival Time: <?php echo $flight['arr_time']; ?></p>
                    <p class="flight-price">Price: <?php echo $flight['flight_price']; ?></p>
                    <a href="?add=<" class="add-to-cart-button">Book Now</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>
</html>