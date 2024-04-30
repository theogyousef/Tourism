<?php
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

// if (!empty($_SESSION['products']) && $row['guest'] == 1) {
//   header("Location: login");
// }

if ($row["deactivated"] == 1) {
    header("Location: deactivated");
}

include "header.php" ;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egypt Tourism</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <style>
        <?php include "../public/css/index.css" ?>
    </style>

</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="https://egymonuments.gov.eg/Style%20Library/images/new-logo_web.png" alt="Egypt Tourism"
                    height="40" style="font-size: 200px;">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
                aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Where to go
                        </a>
                        <ul class="dropdown-menu dropdown-menu-large" aria-labelledby="navbarDropdownMenuLink">
                            <li>
                                <h6 class="dropdown-header fs-5 fw-bold">Choose your destination</h6>
                                <p class="ms-2 text-muted">Sea, mountains, cities and national parks: in Egypt every
                                    destination is a unique experience to be fully enjoyed.</p>
                            </li>
                            <div class="d-flex column-dropdown">
                                <div class="list-section">
                                    <h6 class="dropdown-header">Cities</h6>
                                    <a class="dropdown-item" href="#">Cairo</a>
                                    <a class="dropdown-item" href="#">Alexandria</a>
                                    <a class="dropdown-item" href="#">Luxor</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="list-section">
                                    <h6 class="dropdown-header">Regions</h6>
                                    <a class="dropdown-item" href="#">Nile Delta</a>
                                    <a class="dropdown-item" href="#">Sinai Peninsula</a>
                                    <a class="dropdown-item" href="#">Red Sea Coast</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="list-section">
                                    <h6 class="dropdown-header">Tourist Destinations</h6>
                                    <a class="dropdown-item" href="#">Pyramids of Giza</a>
                                    <a class="dropdown-item" href="#">Karnak Temple</a>
                                    <a class="dropdown-item" href="#">Valley of the Kings</a>
                                    <a class="dropdown-link" href="#">See all →</a>
                                </div>
                                <div class="container my-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <img src="https://images.memphistours.com/large/528001641d46401fd0294117d7849411.jpg"
                                                    class="card-img-top" alt="Villages">
                                                <div class="card-body text-center">
                                                    <p class="card-text">Mountains</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="card">
                                                <img src="https://lp-cms-production.imgix.net/2019-06/GettyImages-465987354_high.jpg?auto=format&w=1920&h=640&fit=crop&crop=faces,edges&q=75"
                                                    class="card-img-top" alt="UNESCO sites">
                                                <div class="card-body text-center">
                                                    <p class="card-text">National parks</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">What to do</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Plan your trip</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Information</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-search"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="bi bi-heart"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown" href="#" id="navbarDropdownSignIn" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownSignIn">
                            <div class="list-section">
                                <h6 class="dropdown-header">Profile</h6>
                                <?php if (isset($row) && isset($row["guest"]) && $row["guest"] != 1) { ?>

                                    <li><a class="dropdown-item" href="profilesettings">profile settings </a></li>
                                    <?php if ($row["admin"] == 1) {
                                        echo ' <li><a class="dropdown-item" href="admindashboard">Admin dashboard </a></li> ';
                                    } ?>
                                    <li><a class="dropdown-item" href="logout">Log out </a></li>
                                <?php } else if ( $row["guest"] == 1){
                                echo ' <li><a class="dropdown-item" href="login">Log in </a></li> ' ;
                                echo ' <li><a class="dropdown-item" href="signup">Register  </a></li> ' ;
                                }
                                ?>
                            </div>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav> -->



    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <video id="myVideo" width="100%" autoplay loop muted>
                    <source src="../public/photos/y2mate.is - This is Egypt-mfxQy5A_tHs-720p-1714078248.mp4"
                        type="video/mp4">
                </video>
            </div>


            <div class="carousel-item">
                <img src="../public/photos/slider4.jpg" class="d-block custom-size mx-auto" alt="Egypt" width="100%">
                <div class="carousel-caption1">

                </div>
            </div>
            <div class="carousel-item">
                <img src="../public/photos/aswan1.jpg" class="d-block w-100" alt="..." width="100%">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <div class="container-simple-text with-background-image"
        style="background-image: url('https://tourismmedia.italia.it/is/image/mitur/landscape_1-100-1?wid=2880&amp;hei=1280&amp;fit=constrain,1&amp;fmt=webp'); background-size: cover; height: 300px;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-10 offset-lg-1">
                    <div
                        class="container-simple-text__container-text container-simple-text__container-text--desktop-center container-simple-text__container-text--mobile-center text-center">
                        <div class="container-simple-text__container-text__fs-28-38">
                            <h2 class="container-simple-text__title mb-0" style="margin-top: 100px; color: #13315C;">
                                Landscapes that will take your breath away, rich <br> history, and delicious food, your
                                trip to Egypt will be <br>nothing short of unforgettable.
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="featured-destinations py-5">
        <div class="container">
            <h6 class="text-center mb-4" style="font-weight: normal;">BOOK NOW</h6>
            <h1 class="text-center mb-4" style="color:#13315C; font-family: Georgia, 'Times New Roman', Times, serif;">
                NEW EL ALAMEIN CITY</h1>
            <div class="row">
                <div class="position-relative text-center" style="height : 300;">
                    <a href="#" id="centered-anchor" class="d-block" style="height : 300;">
                        <img src="https://cityedgedevelopments.com/uploads/destinations/destination_4/cover_image03e4e8bd-0f1d-4a40-8dbe-fc350a64da36.jpg"
                            alt="Clickable Image" class="img-fluid mx-auto" height="300px">
                        <button
                            class="btn mitur btn-lg position-absolute bottom-0 start-50 translate-middle-x rounded-pill"
                            style="bottom: -20px; background-color: #0B2545; color: white; margin-bottom: -60PX;"
                            id="shopnow">
                            BOOK NOW
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!-- Trips -->

    <div class="viewproduct">
        <div class="row">
            <div class="col-md text-center">
                <h6 class="text-center mb-4" style="font-weight: normal;">EVENTS</h6>
                <h1>Top Cities to Visit in Egypt</h1>
            </div>
        </div>

        <div class="container products-carousel">
            <div class="row">
                <div class="slider">
                    <div class="col-md-3 ">
                        <div class="products">
                            <div class="product-image">
                                <a href="product.php" class="images">
                                    <img src="../public/photos/nuweiba.jpg" alt="Concept 2 PM5 BikeErg" class="pic-1"
                                        width="500px">

                                    <img src="../public/photos/nweiba.jpg" alt="Concept 2 PM5 BikeErg" class="pic-2"
                                        width="500px">
                                </a>
                                <div class="links">
                                    <div class="Icon">
                                        <a href="#"><i class="bi bi-cart3"></i></i></a>
                                        <span class="tooltiptext">Add to cart</span>
                                    </div>
                                    <div class="Icon">
                                        <a href=""><i class="bi bi-heart"></i></i></a>
                                        <span class="tooltiptext">Move to wishlist</span>
                                    </div>
                                </div>
                            </div>
                            <div class="Content">
                                <h3>nuweiba</h3>
                                <p class="detailsinfo">
                                    <span class="typetrip">ASWAN</span> <span class="separate"></span> <span
                                        class="nofdays">EGYPT</span>
                                </p>
                                <div class="cost">
                                    <p class="lower-price">
                                        From <span class="price">72.000 EGP</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="products">
                            <div class="product-image">
                                <a href="" class="images">
                                    <img src="../public/photos/dahab.jpg" alt="Flat-Bench" class="pic-1" width="500px">

                                    <img src="../public/photos/gouna2.jpg" alt="Flat-Bench" class="pic-2" width="500px">
                                </a>
                                <div class="links">
                                    <div class="Icon">
                                        <a href="#"><i class="bi bi-cart3"></i></i></a>
                                        <span class="tooltiptext">Add to cart</span>
                                    </div>
                                    <div class="Icon">
                                        <a href=""><i class="bi bi-heart"></i></i></a>
                                        <span class="tooltiptext">Move to wishlist</span>
                                    </div>
                                </div>
                            </div>
                            <div class="Content">
                                <h3>GOUNA</h3>
                                <p class="detailsinfo">
                                    <span class="typetrip">GOUNA</span>
                                    <span class="separate"></span> <span class="nofdays">EGYPT</span>
                                </p>
                                <div class="cost">
                                    <p class="lower-price">
                                        From <span class="price">5.850 EGP</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="products">
                            <div class="product-image">
                                <a href="" class="images">
                                    <img src="../public/photos/siwa.jpg" alt="Concept 2 SkiErg" class="pic-1"
                                        width="500px">

                                    <img src="../public/photos/Siwa-Oasis-Egypt-1.webp" alt="Concept 2 SkiErg"
                                        class="pic-2" width="500px">
                                </a>
                                <div class="links">
                                    <div class="Icon">
                                        <a href="#"><i class="bi bi-cart3"></i></i></a>
                                        <span class="tooltiptext">Add to cart</span>
                                    </div>
                                    <div class="Icon">
                                        <a href=""><i class="bi bi-heart"></i></i></a>
                                        <span class="tooltiptext">Move to wishlist</span>
                                    </div>
                                </div>
                            </div>
                            <div class="Content">
                                <h3>SIWA</h3>
                                <p class="detailsinfo">
                                    <span class="typetrip">SIWA</span> <span class="separate"></span> <span
                                        class="nofdays">EGYPT</span>
                                </p>
                                <div class="cost">
                                    <p class="lower-price">
                                        From <span class="price">58.000 EGP</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="products">
                            <div class="product-image">
                                <a href="" class="images">
                                    <img src="../public/photos/aswan1.jpg" alt="ASSAULT AIRBIKE" class="pic-1"
                                        width="500px">

                                    <img src="../public/photos/aswan2.jpg" alt="ASSAULT AIRBIKE" class="pic-2"
                                        width="500px">
                                </a>
                                <div class="links">
                                    <div class="Icon">
                                        <a href="#"><i class="bi bi-cart3"></i></i></a>
                                        <span class="tooltiptext">Add to cart</span>
                                    </div>
                                    <div class="Icon">
                                        <a href=""><i class="bi bi-heart"></i></i></a>
                                        <span class="tooltiptext">Move to wishlist</span>
                                    </div>
                                </div>
                            </div>
                            <div class="Content">
                                <h3>ASWAN</h3>
                                <p class="detailsinfo">
                                    <span class="typetrip">EGYPT</span> <span class="separate"></span> <span
                                        class="nofdays">ASWAN</span>
                                </p>
                                <div class="cost">
                                    <p class="lower-price">
                                        From <span class="price">39.000 EGP</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 ">
                        <div class="products">
                            <div class="product-image">
                                <a href="" class="images">
                                    <img src="../public/photos/alex.jpg" alt="Concept 2 SkiErg" class="pic-1"
                                        width="500px">

                                    <img src="../public/photos/dahab.jpg" alt="Concept 2 SkiErg" class="pic-2"
                                        width="500px">
                                </a>
                                <div class="links">
                                    <div class="Icon">
                                        <a href="#"><i class="bi bi-cart3"></i></i></a>
                                        <span class="tooltiptext">Add to cart</span>
                                    </div>
                                    <div class="Icon">
                                        <a href=""><i class="bi bi-heart"></i></i></a>
                                        <span class="tooltiptext">Move to wishlist</span>
                                    </div>
                                </div>
                            </div>
                            <div class="Content">
                                <h3>DAHAB</h3>
                                <p class="detailsinfo">
                                    <span class="typetrip">EGYPT</span> <span class="separate"></span> <span
                                        class="nofdays">DAHAB</span>
                                </p>
                                <div class="cost">
                                    <p class="lower-price">
                                        From <span class="price">58.000 EGP</span>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>
    <!-- map -->
    <div>
        <section class="featured-destinations py-5">
            <div class="container">
                <h6 class="text-center mb-4" style="font-weight: normal;">EGYPT</h6>
                <h1 class="text-center mb-4">Discover Egypt</h1>
                <div class="row">
                    <div id="map">
                        <iframe src="map.php" frameborder="0" width="100%" height="700px"></iframe>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <div class="row">
        <div class="col-md text-center">
            <h6 class="text-center mb-4" style="font-weight: normal;">BOOK</h6>
            <h1>Book Your Full Trip Now</h1>
        </div>
    </div>

    <div class="container products-carousel" style="margin-top: 5px;">
        <div class="row">
            <div class="slider">
                <div class="col-md-3">
                    <div class="flights">
                        <div class="flight-image">
                            <a href="" class="images">
                                <img src="../public/photos/aswan1.jpg" alt="newyork photo" class="pic-1" width="500px">

                                <img src="../public/photos/aswan2.jpg" alt="sanfransisco photo" class="pic-2"
                                    width="500px">
                            </a>
                            <div class="links">
                                <div class="Icon">
                                    <a href="#"><i class="bi bi-cart3"></i></i></a>
                                    <span class="tooltiptext">Add to cart</span>
                                </div>
                                <div class="Icon">
                                    <a href=""><i class="bi bi-heart"></i></i></a>
                                    <span class="tooltiptext">Move to wishlist</span>
                                </div>
                            </div>
                        </div>
                        <div class="Content">
                            <h3 class="product-title">
                                Aswan&nbsp; &nbsp;<span class="arrow"><i
                                        class='bx bx-transfer-alt'></i></span>&nbsp;Alexandria
                            </h3>
                            <p class="detailsinfo">
                                <span class="typetrip">Round-trip</span> <span class="separate"></span> <span
                                    class="nofdays">7 days</span>
                            </p>
                            <div class="cost">
                                <p class="lower-price">
                                    From <span class="price">EGY5,376.88</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="flights">
                        <div class="flight-image">
                            <a href="" class="images">
                                <img src="../public/photos/Siwa-Oasis-Egypt-1.webp" alt="switzerland photo"
                                    class="pic-1" width="500px">
                                <img src="../public/photos/aswan2.jpg" alt="Greece photo" class="pic-2" width="500px">
                            </a>
                            <div class="links">
                                <div class="Icon">
                                    <a href="#"><i class="bi bi-cart3"></i></i></a>
                                    <span class="tooltiptext">Add to cart</span>
                                </div>
                                <div class="Icon">
                                    <a href=""><i class="bi bi-heart"></i></i></a>
                                    <span class="tooltiptext">Move to wishlist</span>
                                </div>
                            </div>

                        </div>
                        <div class="Content">
                            <h3 class="product-title">
                                Siwa&nbsp; &nbsp;<span class="arrow"><i
                                        class='bx bx-transfer-alt'></i></span>&nbsp;Aswan
                            </h3>
                            <p class="detailsinfo">
                                <span class="typetrip">Round-trip</span> <span class="separate"></span> <span
                                    class="nofdays">4 days</span>
                            </p>
                            <div class="cost">
                                <p class="lower-price">
                                    From <span class="price">EGY2,657</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="flights">
                        <div class="flight-image">
                            <a href="" class="images">
                                <img src="https://www.barcelo.com/guia-turismo/wp-content/uploads/2022/05/el-cairo-torre-888.jpg"
                                    alt="Egypt photo" class="pic-1" width="500px">
                                <img src="../public/photos/sharm.jpg" alt="Morocco photo" class="pic-2" width="500px">
                            </a>
                            <div class="links">
                                <div class="Icon">
                                    <a href="#"><i class="bi bi-cart3"></i></i></a>
                                    <span class="tooltiptext">Add to cart</span>
                                </div>
                                <div class="Icon">
                                    <a href=""><i class="bi bi-heart"></i></i></a>
                                    <span class="tooltiptext">Move to wishlist</span>
                                </div>

                            </div>

                        </div>
                        <div class="Content">
                            <h3 class="product-title">
                                Cairo&nbsp; &nbsp;<span class="arrow"><i
                                        class='bx bx-transfer-alt'></i></span>&nbsp;Sharm-EL-Sheikh
                            </h3>
                            <p class="detailsinfo">
                                <span class="typetrip">Round-trip</span> <span class="separate"></span> <span
                                    class="nofdays">3 days</span>
                            </p>
                            <div class="cost">
                                <p class="lower-price">
                                    From <span class="price">EGY5,130</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="flights">
                        <div class="flight-image">
                            <a href="" class="images">
                                <img src="../public/photos/alex.jpg" alt="London photo" class="pic-1" width="500px">
                                <img src="https://i0.wp.com/www.touristegypt.com/wp-content/uploads/2023/05/mount-sinai-sunrise-scaled.jpg?fit=4500%2C3000&ssl=1"
                                    alt="newyork photo" class="pic-2" width="500px">
                            </a>
                            <div class="links">
                                <div class="Icon">
                                    <a href="#"><i class="bi bi-cart3"></i></i></a>
                                    <span class="tooltiptext">Add to cart</span>
                                </div>
                                <div class="Icon">
                                    <a href=""><i class="bi bi-heart"></i></i></a>
                                    <span class="tooltiptext">Move to wishlist</span>
                                </div>

                            </div>

                        </div>
                        <div class="Content">
                            <h3 class="product-title">
                                Alexandria&nbsp; &nbsp;<span class="arrow"><i
                                        class='bx bx-transfer-alt'></i></span>&nbsp;Sinai
                            </h3>
                            <p class="detailsinfo">
                                <span class="typetrip">Round-trip</span> <span class="separate"></span> <span
                                    class="nofdays">7 days</span>
                            </p>
                            <div class="cost">
                                <p class="lower-price">
                                    From <span class="price">EGY5,840</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="flights">
                        <div class="flight-image">
                            <a href="" class="images">
                                <img src="../public/photos/dahab2.jpg" alt="Istanbul photo" class="pic-1" width="500px">
                                <img src="../public/photos/marsa matrouh.jpg" alt="Paris photo" class="pic-2"
                                    width="500px">
                            </a>
                            <div class="links">
                                <div class="Icon">
                                    <a href="#"><i class="bi bi-cart3"></i></i></a>
                                    <span class="tooltiptext">Add to cart</span>
                                </div>
                                <div class="Icon">
                                    <a href=""><i class="bi bi-heart"></i></i></a>
                                    <span class="tooltiptext">Move to wishlist</span>
                                </div>
                            </div>

                        </div>
                        <div class="Content">
                            <h3 class="product-title">
                                Dahab&nbsp; &nbsp;<span class="arrow"><i
                                        class='bx bx-transfer-alt'></i></span>&nbsp;Marsa Matrouh
                            </h3>
                            <p class="detailsinfo">
                                <span class="typetrip">Round-trip</span> <span class="separate"></span> <span
                                    class="nofdays">2 days</span>
                            </p>
                            <div class="cost">
                                <p class="lower-price">
                                    From <span class="price">EGY11,000</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="flights">
                        <div class="flight-image">
                            <a href="" class="images">
                                <img src="../public/photos/giza.jpg" alt="Maldives photo" class="pic-1" width="500px">
                                <img src="https://i0.wp.com/www.touristegypt.com/wp-content/uploads/2023/01/st-catherines-monastery-174446_1920.jpg?resize=1536%2C1024&ssl=1"
                                    alt="Dubai photo" class="pic-2" width="500px">
                            </a>
                            <div class="links">
                                <div class="Icon">
                                    <a href="#"><i class="bi bi-cart3"></i></i></a>
                                    <span class="tooltiptext">Add to cart</span>
                                </div>
                                <div class="Icon">
                                    <a href=""><i class="bi bi-heart"></i></i></a>
                                    <span class="tooltiptext">Move to wishlist</span>
                                </div>
                            </div>
                        </div>
                        <div class="Content">
                            <h3 class="product-title">
                                Giza&nbsp; &nbsp;<span class="arrow"><i
                                        class='bx bx-transfer-alt'></i></span>&nbsp;saint catherine
                            </h3>
                            <p class="detailsinfo">
                                <span class="typetrip">Round-trip</span> <span class="separate"></span> <span
                                    class="nofdays">8 days</span>
                            </p>
                            <div class="cost">
                                <p class="lower-price">
                                    From <span class="price">EGY7,109</span>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- social wall -->
    <div class="social-wall-section" style="margin-bottom: 100px;">
        <h5>SOCIAL WALL</h5>
        <h1>Egypt seen by you</h1>
        <p>Join the <a href="https://www.instagram.com/thisisegypt/" target="_blank">#Thisisegypt</a> community and post
            your experiences</p>
        <button class="btn btn-primary">Find out more</button>
    </div>

    <!-- stay with us -->
    <div class="container">
        <div class="row">
            <div class="col-md-6" style="height: 400px; width: 750px; margin-left: -100px;">
                <img src="../public/photos/slider1.jpg" class="custom-img img-fluid" alt="Your Image">
            </div>
            <div class="col-md-6">
                <div class="image-container position-relative text-center">
                    <div class="background-image"
                        style="background-image: url('https://tourismmedia.italia.it/is/image/mitur/landscape_1-100-1?wid=2880&amp;hei=1280&amp;fit=constrain,1&amp;fmt=webp'); height: 435px; width: 900px;">
                        <div class="overlay d-flex flex-column justify-content-center align-items-center">
                            <div class="quote mt-2 text-center align-items-center " style="margin-left: 30px;">
                                <h4 class="custom-about-us">STAY WITH US</h4>
                                <p class="custom-quote">Continue living like an Egyptian</p>
                                <h5 class="custom-caption">Subscribe to the Newsletter so as not to miss places,
                                    events and experiences for experiencing the best side of Egypt: the authentic one.
                                </h5>
                            </div>
                            <!-- newsettler Form -->
                            <form action="" id="ContactFooter" class="footer-form">
                                <div class="d-flex">
                                    <div class="form-floating me-2 custom-email-input">
                                        <input type="email" class="form-control border-0 custom-email-field" id="email"
                                            placeholder=" " style="background: transparent; color: #000;">
                                        <label for="email">Enter your email address</label>
                                    </div>
                                    <button type="button" class="btn-About-us btn-dark rounded-pill">Confirm</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>


<script>
    <?php include "../public/js/index.js" ?>
</script>

</html>