<?php
require '../includes/config.php';
require '../includes/Dbh.php';
require_once '../controller/usercontroller.php';

$usercontroller = new usercontroller();

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

$dbh = new Dbh();
$result = $dbh->query("SELECT * FROM flights");
$flights = $result->fetch_all(MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

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
    <div class="container mt-4">
            <h1>Flights Collection</h1>

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
      <div class="flight-info-group">
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
                <p class="eco-price"> <?php echo number_format($flight['eco_price'], 0, '', ',') . "  " .  "EGP"; ?></p>
                <div class="dropdown-container">
            
                <div class="dropdown-card" id = "eco-card">
                
                            <h3>Economy Classic</h3>
                            <p><strong><?php echo number_format($flight['eco_price'], 0, '', ',') . " EGP"; ?></strong></p>
                            <p>Total for all passengers</p>
                            <form action="action.php" method="POST">
                                    <input type="hidden" name="flight_id" value="<?php echo $flight['id']; ?>">
                                    <input type="hidden" name="flight_dep" value="<?php echo $flight['flight_dep']; ?>">
                                    <input type="hidden" name="flight_arr" value="<?php echo $flight['flight_arr']; ?>">
                                    <input type="hidden" name="flight_price" value="<?php echo $flight['eco_price']; ?>">
                                    <button type="submit" class="btn btn-secondary add-to-cart">Select Fare</button>
                                </form>
                            <p>Earn 639 Avios</p>
                            <ul>
                                <li>Flexibility to make 1 change</li>
                                <li>Cancellation within 24hrs of booking without fees</li>
                                <li>Checked baggage: 2 pieces, 23 kg each</li>
                                <li>Hand baggage: 1 piece, 7 kg</li>
                                <li>Seat selection for a fee</li>
                                <li>Upgrade with Avios</li>
                            </ul>
                        </div>
                      
                </div>

            </div>
            <div class="flight-price-container">
                <p class="bus-price"> <?php echo number_format($flight['bus_price'], 0, '', ',') . "  " . "EGP"; ?></p>
                <div class="dropdown-container">
                <div class="dropdown-card"  id = "bus-card">
                            <h3>Business Class</h3>
                            <p><strong><?php echo number_format($flight['bus_price'], 0, '', ',') . " EGP"; ?></strong></p>
                            <p>Total for all passengers</p>
                            <form action="action.php" method="POST">
                                    <input type="hidden" name="flight_id" value="<?php echo $flight['id']; ?>">
                                    <input type="hidden" name="flight_dep" value="<?php echo $flight['flight_dep']; ?>">
                                    <input type="hidden" name="flight_arr" value="<?php echo $flight['flight_arr']; ?>">
                                    <input type="hidden" name="flight_price" value="<?php echo $flight['eco_price']; ?>">
                                    <button type="submit" class="btn btn-secondary add-to-cart">Select Fare</button>
                                </form>
                            <p>Earn 1,200 Avios</p>
                            <ul>
                                <li>Flexibility to make unlimited changes</li>
                                <li>Free cancellation at any time</li>
                                <li>Checked baggage: 3 pieces, 32 kg each</li>
                                <li>Hand baggage: 2 pieces, 10 kg each</li>
                                <li>Seat selection included</li>
                                <li>Upgrade with Avios</li>
                            </ul>
                        </div>
                </div>
            </div>
            </div>
      </div>
     
    <?php endforeach; ?>
  </div>
    <footer>
        <?php include "footer.php"; ?>
    </footer>
    <script>
     document.querySelectorAll('.flight-price-container').forEach(container => {
      container.addEventListener('click', function (event) {
        event.stopPropagation();

        const flightContainer = this.closest('.flight-container');
        const dropdown = this.querySelector('.dropdown-container');
        const activeDropdown = flightContainer.querySelector('.flight-price-container.active .dropdown-container');

        if (activeDropdown && activeDropdown !== dropdown) {
            activeDropdown.style.display = 'none';
            activeDropdown.closest('.flight-price-container').classList.remove('active');
        }

        if (this.classList.contains('active')) {
            this.classList.remove('active');
            dropdown.style.display = 'none';
            flightContainer.style.height = 'auto';
        } else {
            this.classList.add('active');
            dropdown.style.display = 'block';
            const flightDetailsHeight = flightContainer.querySelector('.flight-details').offsetHeight;
            const dropdownHeight = this.querySelector('.dropdown-container').offsetHeight;
            const fullHeight = flightDetailsHeight + dropdownHeight + 450; 
            flightContainer.style.height = fullHeight + 'px';
        }
    });
    container.addEventListener('click', function (event) {
       
        if (event.target.matches('#select-fare-button')) {
           
            alert('You clicked the Select fare button!');
        }
    });
    container.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.stopPropagation();
                    this.closest('form').submit();
                });
            });
        });

   



</script>

</body>
</html>