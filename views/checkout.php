<?php


// Include necessary files
require '../includes/config.php';
require '../includes/Dbh.php';

// Fetch items from the session
$selectedProducts = isset($_SESSION['products']) ? $_SESSION['products'] : [];
$selectedFlights = isset($_SESSION['flights']) ? $_SESSION['flights'] : [];
$totalPrice = 0;

// Calculate total price
foreach ($selectedProducts as $product) {
    $totalPrice += $product['price'];
}
foreach ($selectedFlights as $flight) {
    $totalPrice += $flight['price'];
}

// Store total in session for further use
$_SESSION['total'] = $totalPrice;

$hotelImage = '../public/photos/gouna2.jpg'; 
foreach ($selectedProducts as $product) {
    $hotelImage = $product['image'];
       }

       $hotelName = ''; 
foreach ($selectedProducts as $product) {
    $hotelName = $product['name'];
       }
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
            <?php include "../public/css/checkout.css"; ?>
        </style>
    </header>
<div class="container d-lg-flex">
        <div class="box-1 bg-light user">
            <div class="d-flex align-items-center mb-3">
                <img src="../public/photos/userPhotos/joe.png"
                    class="pic rounded-circle" alt="">
                <p class="ps-2 name">Username</p>
            </div>
            <div class="box-inner-1 pb-3 mb-3 ">
                <div class="d-flex justify-content-between mb-3 userdetails">
                    <p class="fw-bold"><?php echo $hotelName?></p>
                    <p class="fw-lighter"><span class="fas fa-dollar-sign"></span></p>
                </div>
                <div id="my" class="carousel slide carousel-fade img-details" data-bs-ride="carousel"
                    data-bs-interval="2000">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#my" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#my" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#my" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo $hotelImage; ?>"
                                class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo $hotelImage; ?>"
                                class="d-block w-100 h-100">
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo $hotelImage; ?>"   
                                class="d-block w-100">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#my" data-bs-slide="prev">
                        <div class="icon">
                            <span class="fas fa-arrow-left"></span>
                        </div>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#my" data-bs-slide="next">
                        <div class="icon">
                            <span class="fas fa-arrow-right"></span>
                        </div>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
                <p class="dis info my-3">Trip Details
                </p>
                <div class="radiobtn">
                    <input type="radio" name="box" id="one">
                    <input type="radio" name="box" id="two">
                    <input type="radio" name="box" id="three">
                    <label for="one" class="box py-2 first">
                        <div class="d-flex align-items-start">
                            <span class="circle"></span>
                            <div class="course">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold">
                                        Hotel Name
                                    </span>
                                    <span class="fas fa-dollar-sign">29</span>
                                </div>
                                <span>Hotel details</span>
                            </div>
                        </div>
                    </label>
                    <label for="two" class="box py-2 second">
                        <div class="d-flex">
                            <span class="circle"></span>
                            <div class="course">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold">
                                        Flight
                                    </span>
                                    <span class="fas fa-dollar-sign">29</span>
                                </div>
                                <span>Flight details</span>
                            </div>
                        </div>
                    </label>
                    <label for="three" class="box py-2 third">
                        <div class="d-flex">
                            <span class="circle"></span>
                            <div class="course">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="fw-bold">
                                        Activities
                                    </span>
                                    <span class="fas fa-dollar-sign">29</span>
                                </div>
                                <span>Activity details</span>
                            </div>
                        </div>
                    </label>
                </div>
            </div>
        </div>
        <div class="box-2">
            <div class="box-inner-2">
                <div>
                    <p class="fw-bold">Payment Details</p>
                    <p class="dis mb-3">Complete your purchase by providing your payment details</p>
                </div>
                <form action="">
                    <div class="mb-3">
                        <p class="dis fw-bold mb-2">Email address</p>
                        <input class="form-control" type="email" value="luke@skywalker.com">
                    </div>
                    <div>
                        <p class="dis fw-bold mb-2">Card details</p>
                        <div class="d-flex align-items-center justify-content-between card-atm border rounded">
                            <div class="fab fa-cc-visa ps-3"></div>
                            <input type="text" class="form-control" placeholder="Card Details" oninput="formatCardNumber(this)">
                            <div class="d-flex w-50">
                                <input type="text" class="form-control px-0" placeholder="MM/YY" oninput="formatMMYY(this)">
                                <input type="password" maxlength=3 class="form-control px-0" placeholder="CVV">
                            </div>
                        </div>
                        <div class="my-3 cardname">
                            <p class="dis fw-bold mb-2">Cardholder name</p>
                            <input class="form-control" type="text">
                        </div>
                        <div class="address">
                            <p class="dis fw-bold mb-3">Billing address</p>
                            <select class="form-select" aria-label="Default select example">
                                <option selected hidden>Egypt</option>
                                <option value="1">India</option>
                                <option value="2">Australia</option>
                                <option value="3">Canada</option>
                            </select>
                            <div class="d-flex">
                                <input class="form-control zip" type="text" placeholder="ZIP">
                                <input class="form-control state" type="text" placeholder="State">
                            </div>
                           <br></br>
                            </div>
                            <div class="d-flex flex-column dis">
                                
                               
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="fw-bold">Total</p>
                                    <p class="fw-bold"><span class="fas fa-dollar-sign"></span><?php echo number_format($totalPrice, 2); ?></p>
                                </div>
                                <div class="btn btn-primary mt-2">Pay<span class="fas fa-dollar-sign px-1"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function formatMMYY(input) {
    // Remove any non-numeric characters
    input.value = input.value.replace(/\D/g, '');

    // Ensure the input is not longer than 4 characters
    if (input.value.length > 4) {
        input.value = input.value.slice(0, 4);
    }

    // Split the input into MM and YY parts
    let mm = input.value.slice(0, 2);
    let yy = input.value.slice(2, 4);

    // Format MM/YY
    input.value = mm + (mm.length === 2 && yy ? '/' : '') + yy;
}
function formatCardNumber(input) {
    // Remove any non-numeric characters
    input.value = input.value.replace(/\D/g, '');

    // Ensure the input is not longer than 16 characters
    if (input.value.length > 16) {
        input.value = input.value.slice(0, 16);
    }

    // Format the input as "1111 1111 1111 1111"
    input.value = input.value.replace(/(\d{4})/g, '$1 ').trim();
}
</script>
</body>
</html>