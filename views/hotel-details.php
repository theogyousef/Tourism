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

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $sql = "SELECT * FROM hotels WHERE id = $productId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $hoteldetials = mysqli_fetch_assoc($result);
    } else {
        echo '<p>No product details found.</p>';
    }
} else {
    echo '<p>Product ID is not provided.</p>';
}
include "header.php";
?>
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Sona Template">
    <meta name="keywords" content="Sona, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-fVtjjoQ5+wvjM0Pe7v+53C8F+v/Dz+w9gIrIo0rKEQ+djEaq9tl5IQVSS+R+zu7f" crossorigin="anonymous">

    <!-- Css Styles -->
    <link rel="stylesheet" href="../public/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="../public/css/flaticon.css" type="text/css">
    <link rel="stylesheet" href="../public/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="../public/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/magnific-popup.css" type="text/css">
    <link rel="stylesheet" href="../public/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="../public/css/style.css" type="text/css">
</head>

<body>

    <!-- Room Details Section Begin -->
    <section class="room-details-section spad" style="margin-top: 40px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="room-details-item">
                        <!-- Main Image -->
                        <img src="<?php echo $hoteldetials['photo'] ?>" alt="" class="main-image" style="width: 60%; margin-left: 150px;">
                        <!-- Thumbnails -->
                        <!-- <div class="thumbnail-container">
                            <img src="../public/photos/room-2.jpg" alt="" class="thumbnail">
                            <img src="../public/photos/room-3.jpg" alt="" class="thumbnail">
                            <img src="../public/photos/room-4.jpg" alt="" class="thumbnail">
                            <img src="../public/photos/room-5.jpg" alt="" class="thumbnail">
                        </div> -->
                        <div class="rd-text">
                            <div class="rd-title">
                                <h3><?php echo $hoteldetials['name'] . ' room'; ?></h3>
                                <div class="rdt-right">
                                    <div class="rating">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                    <button class="btn btn-secondary add-to-cart" data-hotel-id="<?php echo $hoteldetials['ID']; ?>" data-hotel-name="<?php echo $hoteldetials['name']; ?>" data-hotel-price="<?php echo $hoteldetials['price']; ?>" data-hotel-image="<?php echo $hoteldetials['photo']; ?>">Add to Cart</button>
                                </div>
                            </div>
                            <h5><?php echo $hoteldetials['location']; ?></h5>


                            <h2><?php echo number_format($hoteldetials['price'], 2) . ' LE' ?><span>/Pernight</span>
                            </h2>
                            <table>
                                <tbody>
                                    <tr>
                                        <td class="r-o">Size:</td>
                                        <td>30 ft</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Capacity:</td>
                                        <td>Max persion 5</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Bed:</td>
                                        <td>King Beds</td>
                                    </tr>
                                    <tr>
                                        <td class="r-o">Services:</td>
                                        <td>Wifi, Television, Bathroom,...</td>
                                    </tr>
                                </tbody>
                            </table>
                            <p class="f-para">Motorhome or Trailer that is the question for you. Here are some of the
                                advantages and disadvantages of both, so you will be confident when purchasing an RV.
                                When comparing Rvs, a motorhome or a travel trailer, should you buy a motorhome or fifth
                                wheeler? The advantages and disadvantages of both are studied so that you can make your
                                choice wisely when purchasing an RV. Possessing a motorhome or fifth wheel is an
                                achievement of a lifetime. It can be similar to sojourning with your residence as you
                                search the various sites of our great land, America.</p>
                            <p>The two commonly known recreational vehicle classes are the motorized and towable.
                                Towable rvs are the travel trailers and the fifth wheel. The rv travel trailer or fifth
                                wheel has the attraction of getting towed by a pickup or a car, thus giving the
                                adaptability of possessing transportation for you when you are parked at your campsite.
                            </p>
                        </div>
                    </div>
                    <div class="rd-reviews">
                        <h4>Reviews</h4>
                        <div class="review-item">

                            <div class="ri-text">
                                <span>27 Aug 2019</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>


                                </div>
                                <h5>Brandon Kelley</h5>
                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                    magnam.</p>
                            </div>
                        </div>
                        <div class="review-item">

                            <div class="ri-text">
                                <span>27 Aug 2019</span>
                                <div class="rating">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>

                                </div>
                                <h5>Brandon Kelley</h5>
                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                                    adipisci velit, sed quia non numquam eius modi tempora. incidunt ut labore et dolore
                                    magnam.</p>
                            </div>
                        </div>
                    </div>
                    <div class="review-add">
                        <h4>Add Review</h4>
                        <form action="#" class="ra-form">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Name*">
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" placeholder="Email*">
                                </div>
                                <div class="col-lg-12">
                                    <div>
                                        <h5>You Rating:</h5>
                                        <div class="rating">
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>
                                            <i class="fas fa-star"></i>

                                        </div>
                                    </div>
                                    <textarea placeholder="Your Review"></textarea>
                                    <button type="submit">Submit Now</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="room-booking">
                        <h3>Your Reservation</h3>
                        <form action="#">
                            <div class="check-date">
                                <label for="date-in">Check In:</label>
                                <input type="text" class="date-input" id="date-in">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="date-out">Check Out:</label>
                                <input type="text" class="date-input" id="date-out">
                                <i class="fas fa-calendar"></i>
                            </div>
                            <div class="check-date">
                                <label for="guest">Guests:</label>
                                <select id="guest">
                                    <option value="">3 Adults</option>
                                </select>
                            </div>
                            <div class="check-date">
                                <label for="room">Room:</label>
                                <select id="room">
                                    <option value="">1 Room</option>
                                </select>
                            </div>
                            <button type="submit">Check Availability</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const mainImage = document.querySelector(".main-image");
            const thumbnails = document.querySelectorAll(".thumbnail");

            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener("mouseover", function() {
                    mainImage.src = thumbnail.src;
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const hotelId = this.getAttribute('data-hotel-id');
                    const hotelName = this.getAttribute('data-hotel-name');
                    const hotelPrice = this.getAttribute('data-hotel-price');
                    const hotelImage = this.getAttribute('data-hotel-image');

                    fetch('add_to_wishlist.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json'
                            },
                            body: JSON.stringify({
                                id: hotelId,
                                name: hotelName,
                                price: hotelPrice,
                                image: hotelImage
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // alert('Hotel added to Cart!');
                            } else {
                                // alert('Failed to add hotel to Cart.');
                            }
                        });
                });
            });
        });
    </script>

    <?php include "footer.php" ?>

</body>

</html>