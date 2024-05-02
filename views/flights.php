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
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
                

</head>

<body>
<header>
<?php include "header.php"; ?>
        <style>
            <?php include "../public/css/flights.css"; ?>
        </style>
    </header>

    <div class="flight-view">
    <?php foreach ($flights as $flight) : 
        $deptTimeInteger = strtotime($flight['dept_time']);
        $arrTimeInteger = strtotime($flight['arr_time']);
        $timeDiff = $arrTimeInteger - $deptTimeInteger;
        if ($timeDiff >= 0){
        $hours = floor($timeDiff / 3600);
        $min = floor(($timeDiff % 3600) / 60);
        $min = str_pad($min, 2, '0', STR_PAD_LEFT);
        }
        else{
        $hours = floor($timeDiff / 3600) + 24;
        $min = floor(($timeDiff % 3600) / 60);
        $min = str_pad($min, 2, '0', STR_PAD_LEFT);
        }
        ?>
      <div class="flight-container">
        <div class="flight-details">
          <div class="flight-time">
            <p class="departure-time"> <?php echo date('h:i A', $deptTimeInteger); ?></p>
            <p class="flight-dep"><?php echo $flight['flight_dep']; ?></p>
          </div>
          
          <div class="flight-separator"> 
            <p class="flight-duration"> <?php echo $hours . "h" . " " . $min . "m" ?> </p>
          </div>
         
          <div class="flight-time">
            <p class="arrival-time"> <?php echo date('h:i A',$arrTimeInteger); ?></p>
            <p class="flight-arr"><?php echo $flight['flight_arr']; ?></p>
          </div>
        </div>
        <a href ="#" class="flight-details-link"><span>Flight Details</span></a> 
        <div class="flight-price-container">
          <p class="eco-price"> <?php echo number_format($flight['eco_price'],0,'',',') . "  " .  "EGP"; ?></p>
          
        </div>
        <div class="flight-price-container">
        <p class="bus-price"> <?php echo  number_format($flight['bus_price'],0,'',',') . "  " . "EGP"; ?></p> 
    </div>
      </div>
    <?php endforeach; ?>
  </div>
    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>
</html>