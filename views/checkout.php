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
                    <p class="fw-bold">Trip Name</p>
                    <p class="fw-lighter"><span class="fas fa-dollar-sign"></span>33.00+</p>
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
                            <img src="../public/photos/gouna2.jpg"
                                class="d-block w-100">
                        </div>
                        <div class="carousel-item">
                            <img src="../public/photos/gouna2.jpg"
                                class="d-block w-100 h-100">
                        </div>
                        <div class="carousel-item">
                            <img src="../public/photos/gouna2.jpg"
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
                            <input type="text" class="form-control" placeholder="Card Details">
                            <div class="d-flex w-50">
                                <input type="text" class="form-control px-0" placeholder="MM/YY">
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
                            <div class=" my-3">
                                <p class="dis fw-bold mb-2">Voucher Code</p>
                                <div class="inputWithcheck">
                                    <input class="form-control" type="text" value="">

                                </div>
                            </div>
                            <div class="d-flex flex-column dis">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p>Subtotal</p>
                                    <p><span class="fas fa-dollar-sign"></span>33.00</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p>Voucher<span>(20%)</span></p>
                                    <p><span class="fas fa-dollar-sign"></span>2.80</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <p class="fw-bold">Total</p>
                                    <p class="fw-bold"><span class="fas fa-dollar-sign"></span>35.80</p>
                                </div>
                                <div class="btn btn-primary mt-2">Pay<span class="fas fa-dollar-sign px-1"></span>35.80
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>