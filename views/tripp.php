
<?php
require '../includes/config.php';
require '../includes/Dbh.php';
require_once '../controller/usercontroller.php';
require_once '../model/fetchModle.php';

$usercontroller = new usercontroller();
$totalPrice = 0;
// Check if user is logged in
$conn = $usercontroller->getConn();
if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    // Redirect to login page if not logged in
    header("Location: login");
    exit;
}

// Fetch hotels from the database
$fetchModle = new fetchModle();
$result = $fetchModle->allhotels();
$hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch flights from the database
$dbh = new Dbh();
$result = $dbh->query("SELECT * FROM flights");
$flights = $result->fetch_all(MYSQLI_ASSOC);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["select_hotel"])) {
        // Process hotel selection
        $_SESSION['selected_hotel'] = $_POST['ID']; // Store selected hotel ID in session

    } elseif (isset($_POST["select_flight"])) {
        // Process flight selection
        $_SESSION['selected_flight'] = $_POST['id']; // Store selected flight ID in session

        $flightPriceResult = $dbh->query("SELECT eco_price FROM flights WHERE id = $selectedFlightId");
        $flightPriceRow = mysqli_fetch_assoc($flightPriceResult);
        $flightPrice = $flightPriceRow['eco_price'];

    } elseif (isset($_POST["checkout"])) {
        
        header("Location: checkout.php");
        exit;
    }
    $selectedHotelId = $_SESSION['selected_hotel'];
    $selectedFlightId = $_SESSION['selected_flight'];

    $hotelPriceResult = $dbh->query("SELECT price FROM hotels WHERE id = $selectedHotelId");
    $hotelPriceRow = mysqli_fetch_assoc($hotelPriceResult);
    $hotelPrice = $hotelPriceRow['price'];

    $flightPriceResult = $dbh->query("SELECT eco_price FROM flights WHERE id = $selectedFlightId");
    $flightPriceRow = mysqli_fetch_assoc($flightPriceResult);
    $flightPrice = $flightPriceRow['eco_price'];

    $totalPrice = $hotelPrice + $flightPrice;}
    
?>
        
        <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Your Trip</title>
    <link rel="stylesheet" href="../public/css/tripp.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet"> 
</head>
<header>

</header>
<body>
    <div class="form__container">
        <div class="title__container">
            <h1>Plan Your Trip</h1>
            <p>Follow the steps below to plan your trip</p>
        </div>
        <div class="body__container">
            <div class="left__container">
                <div class="side__titles">
                    <div class="title__name">
                        <h3>Select Hotel</h3>
                        <p>Choose your accommodation</p>
                    </div>
                    <div class="title__name">
                        <h3>Select Flight</h3>
                        <p>Choose your flight</p>
                    </div>
                    <div class="title__name">
                        <h3>Checkout</h3>
                        <p>Finalize your booking</p>
                    </div>
                </div>
                <div class="progress__bar__container">
                    <ul>
                        <li class="active" id="icon1"><ion-icon name="bed"></ion-icon></li>
                        <li id="icon2"><ion-icon name="airplane"></ion-icon></li>
                        <li id="icon3"><ion-icon name="card"></ion-icon></li>
                    </ul>
                </div>
            </div>
            <form action="package-action.php" method="post">
            <div class="right__container">
                <!-- Hotel Selection Form -->
                <fieldset id="form1">
                    <div class="sub__title__container">
                        <p>Step 1/3</p>
                        <h2>Select Your Hotel</h2>
                        <p>Choose your accommodation from the available options</p>
                    </div>
                    <div class="input__container">
                    
            <select name="hotel_id">
                <?php foreach ($hotels as $hotel) : ?>
                    <option value="<?php echo $hotel['ID']; ?>"><?php echo $hotel['name']; ?></option>
                <?php endforeach; ?>
            </select>
            
     
                    </div>
                    <div class="buttons">
                        <!-- Button to navigate to the next step -->
                        <a class="nxt__btn" onclick="nextForm('form1', 'form2');"> Next</a>
                    </div>
                </fieldset>

                <!-- Flight Selection Form -->
                <fieldset id="form2" style="display: none;">
                    <div class="sub__title__container">
                        <p>Step 2/3</p>
                        <h2>Select Your Flight</h2>
                        <p>Choose your flight from the available options</p>
                    </div>
                    <div class="input__container">
                    
                    
                    <select name="flight_id">
                        <?php foreach ($flights as $flight) : ?>
                    <option value="<?php echo $flight['id']; ?>"><?php echo $flight['flight_dep'] . ' to ' . $flight['flight_arr']; ?></option>
                        <?php endforeach; ?>
                    </select>
                
                
                    </div>  
                    <div class="buttons">
                        <!-- Button to navigate to the previous step -->
                        <a class="prev__btn" onclick="prevForm('form2', 'form1');"> Back</a>
                        <!-- Button to navigate to the next step -->
                        <a class="nxt__btn" onclick="nextForm('form2', 'form3');"> Next</a>
                    </div>
                </fieldset>

                <!-- Checkout Form -->
                <fieldset id="form3" style="display: none;">
                    <div class="sub__title__container">
                        <p>Step 3/3</p>
                        <h2>Checkout</h2>
                        <p>Finalize your booking</p>
                    </div>
                    <div class="input__container">
                    <div class="box-2">
            <div class="box-inner-2">
               
                <form onsubmit="return validateForm()">
                    <div class="mb-3">
                        <p class="dis fw-bold mb-2">Email address</p>
                        <input class="form-control" type="email" value="luke@skywalker.com">
                    </div>
                    <div>
                        <p class="dis fw-bold mb-2">Card details</p>
                        
                            
                            <input type="text" class="form-control" placeholder="Card Number" oninput="formatCardNumber(this)">
                            
                                <input type="text" class="form-control px-0" placeholder="MM/YY" oninput="formatMMYY(this)">
                                <input type="password" maxlength=3 class="form-control px-0" placeholder="CVV">
                           
                        
                        <div class="my-3 cardname">
                            <p class="dis fw-bold mb-2">Cardholder name</p>
                            <input class="form-control" type="text">
                        </div>
                        <div class="address">
                            <p class="dis fw-bold mb-3">Billing address</p>
                            <input class="form-control zip" type="text" placeholder="Address Line 1">
                            <div class="d-flex">
                                <input class="form-control zip" type="text" placeholder="ZIP">
                                <input class="form-control state" type="text" placeholder="City">
                            </div>
                          
                            </div>
                            <div class="d-flex flex-column dis">
                                
                                
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="fw-bold">Total</p>
                                    <p id="totalPrice" class="fw-bold"><span class="fas fa-dollar-sign"></span><?php echo $totalPrice?></p>

                                </div>
                                
                            </div>
                        </div>
                    </div>
                
                        </div>
                    </div>
                    <div class="buttons">
                        <!-- Button to navigate to the previous step -->
                        <a class="prev__btn" onclick="prevForm('form3', 'form2');"> Back</a>
                        <!-- Button to submit the form -->
                     
                        
                                    
                        <button type="submit" class="prev__btn" name="submit">Pay</button>
                      
                        </form>
                    </div>
                </fieldset>
                
            </div>
            </form>
        </div>
    </div>

    <script>
    const nxtBtn = document.querySelector('#submitBtn');
const form1 = document.querySelector('#form1');
const form2 = document.querySelector('#form2');
const form3 = document.querySelector('#form3');



const icon1 = document.querySelector('#icon1');
const icon2 = document.querySelector('#icon2');
const icon3 = document.querySelector('#icon3');



var viewId = 1;
// function nextForm(){
//     console.log("hellonext");
//     viewId=viewId+1;
//     progressBar();
//     displayForms();
    
//     console.log(viewId);

// }

// function prevForm(){
//     console.log("helloprev");
//     viewId=viewId-1;
//     console.log(viewId);
//     progressBar1();
//     displayForms();
// }
function nextForm(currentFormId, nextFormId) {
            document.getElementById(currentFormId).style.display = "none";
            document.getElementById(nextFormId).style.display = "block";
            console.log("hellonext");
            viewId=viewId+1;
            progressBar();
            displayForms();
    
            console.log(viewId);
        }

        function prevForm(currentFormId, prevFormId) {
            document.getElementById(currentFormId).style.display = "none";
            document.getElementById(prevFormId).style.display = "block";
            console.log("helloprev");
            viewId=viewId-1;
            console.log(viewId);
            progressBar1();
            displayForms();
        }
function progressBar1(){
    if(viewId===1){
        icon2.classList.add('active');
        icon2.classList.remove('active');
        icon3.classList.remove('active');
      
    }
    if(viewId===2){
        icon2.classList.add('active');
        icon3.classList.remove('active');
        
    }
    if(viewId===3){
        icon3.classList.add('active');
       
    }
  
}

function progressBar(){
    if(viewId===2){
        icon2.classList.add('active');
    }
    if(viewId===3){
        icon3.classList.add('active');
    }
    if(viewId===4){
        icon4.classList.add('active');
    }
    if(viewId===5){
        icon5.classList.add('active');
        nxtBtn.innerHTML = "Submit"
    }
    if(viewId>5){
        icon2.classList.remove('active');
        icon3.classList.remove('active');
        icon4.classList.remove('active');
        icon5.classList.remove('active');
        
    }
}

function displayForms(){
    
    if(viewId>5){
        viewId=1;
    }

    if(viewId ===1){
        form1.style.display = 'block';
        form2.style.display = 'none';
        form3.style.display = 'none';
        form4.style.display = 'none';
        form5.style.display = 'none';


    }else if(viewId === 2){
        form1.style.display = 'none';
        form2.style.display = 'block';
        form3.style.display = 'none';
        form4.style.display = 'none';
        form5.style.display = 'none';

    }else if(viewId === 3){
        form1.style.display = 'none';
        form2.style.display = 'none';
        form3.style.display = 'block';
        form4.style.display = 'none';
        form5.style.display = 'none';}
}

// for slider

var slider = document.querySelector(".slider");
var output = document.querySelector(".output__value");
output.innerHTML = slider.value ;

slider.oninput = function() {
    output.innerHTML = this.value ;
    
    
}
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
function validateForm() {
        // Get form inputs
        var email = document.getElementById('email').value;
        var cardNumber = document.getElementById('cardNumber').value;
        var expiryDate = document.getElementById('expiryDate').value;
        var cvv = document.getElementById('cvv').value;

        // Validate email format
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email)) {
            alert('Please enter a valid email address.');
            return false;
        }

        // Validate card number
        var cardNumberRegex = /^\d{16}$/;
        if (!cardNumberRegex.test(cardNumber)) {
            alert('Please enter a valid 16-digit card number.');
            return false;
        }

        // Validate expiry date format
        var expiryDateRegex = /^(0[1-9]|1[0-2])\/\d{2}$/;
        if (!expiryDateRegex.test(expiryDate)) {
            alert('Please enter a valid expiry date in MM/YY format.');
            return false;
        }

        // Validate CVV
        var cvvRegex = /^\d{3}$/;
        if (!cvvRegex.test(cvv)) {
            alert('Please enter a valid 3-digit CVV.');
            return false;
        }

        // If all validations pass, return true to submit the form
        return true;
    }

    </script>
</body>

</html>

