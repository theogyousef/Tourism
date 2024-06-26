<?php
require_once '../model/fetchModle.php';
require_once '../controller/usercontroller.php';
$usercontroller = new usercontroller();
$fetchModle = new fetchModle();

$conn = $usercontroller->getConn();

if (!isset($_SESSION["login"]) || $_SESSION["login"] !== true) {
    $result = mysqli_query($conn, "SELECT p.*, u.* FROM permissions p JOIN users u ON p.user_id = u.id WHERE p.guest = '1'");
    $row = mysqli_fetch_assoc($result);
    $_SESSION["login"] = true;
    $_SESSION["id"] = $row["id"];
} else if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id'");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login");
    exit;
}

if ($row["deactivated"] == 1) {
    header("Location: deactivated");
    exit;
}

include "header.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Collection</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/hotels.css">
</head>

<body>

    <main>
        <div class="container mt-4">
            <h1>Hotel Collection</h1>

            <div class="row mb-3" id="filters">
                <div class="col-md-2">
                    <form class="filter" id="filterF" method="post">
                        <select class="form-select filter-select filter-dropdown" aria-label="Availability" name="availability" data-form-id="filterF">
                            <option value="">Availability</option>
                            <option value="1">Available</option>
                            <option value="2">Full !</option>
                        </select>
                    </form>
                </div>
                <div class="col-md-2">
                    <form class="filter" id="filterCategory" method="post">
                        <select class="form-select filter-select filter-dropdown" aria-label="Category" name="category" data-form-id="filterCategory">
                            <option value="">Rating Stars</option>
                            <option value="1">Category 1</option>
                            <option value="2">Category 2</option>
                            <!-- Add more categories as needed -->
                        </select>
                    </form>
                </div>

                <div class="col-md-2">
                    <form class="filter" id="filterForm" method="post">
                        <select class="form-select filter-select filter-dropdown" aria-label="Price" name="price" data-form-id="filterForm">
                            <option value="">Price</option>
                            <option value="4">Highest To Lowest</option>
                            <option value="5">Lowest To Highest</option>
                            <option value="1">Under 10000</option>
                            <option value="2">10000 to 40000</option>
                            <option value="3">40000 and above</option>
                        </select>
                    </form>
                </div>

                <div class="col-md-2" id="reset">
                    <form method="post" action="">
                        <div class="col-md-2">
                            <button name="reset" type="submit" class="btn btn-primary">Reset</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="container mb-3 mt-3">
                <button class="btn btn-light btn-grid">
                    <i class="bi bi-grid-3x3-gap"></i>
                </button>

                <button class="btn btn-light btn-list">
                    <i class="bi bi-list"></i>
                </button>
            </div>
        </div>

        <div class="container grid-container">
            <div class="row">
                <?php
                $result = $fetchModle->allhotels();

                if (mysqli_num_rows($result) > 0) {
                    $hotels = mysqli_fetch_all($result, MYSQLI_ASSOC);
                } else {
                    $hotels = [];
                }
                ?>

                <?php if (!empty($hotels)) : ?>
                    <?php foreach ($hotels as $hotel) : ?>
                        <div class="col-md-3 mb-4">
                            <a href="hotel-details?id=<?php echo $hotel['ID']; ?>" class="hotel-link" style="text-decoration: none; color: inherit;">
                                <div style="width: 300px;" class="card mb-4 product-card">
                                    <img src="<?php echo $hotel['photo']; ?>" class="card-img-top" alt="<?php echo $hotel['name']; ?>">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $hotel['name']; ?></h5>
                                        <li class="list-group-item"><?php echo $hotel['location']; ?></li>

                                        <ul style="margin-left: 80px; font-weight: bold;" class="list-group list-group-flush">
                                            <li class="list-group-item" style="display: flex; align-items: center;">
                                                <?php echo number_format($hotel['price'], 2) . ' LE'; ?>
                                                <p style="color: orange; margin-left: 5px; margin-bottom: 0;">/night</p>
                                            </li>
                                        </ul>
                                        <div class="product-actions mt-3">
                                            <button type="button" class="btn btn-secondary add-to-cart" style="background-color: #0d6efd; border : none;"data-hotel-id="<?php echo $hotel['ID']; ?>" data-hotel-name="<?php echo $hotel['name']; ?>" data-hotel-price="<?php echo $hotel['price']; ?>" data-hotel-image="<?php echo $hotel['photo']; ?>">Add to Cart</button>
                                            <button type="button" class="btn btn-secondary add-to-wishlist" data-hotel-id="<?php echo $hotel['ID']; ?>" data-hotel-name="<?php echo $hotel['name']; ?>" data-hotel-price="<?php echo $hotel['price']; ?>" data-hotel-image="<?php echo $hotel['photo']; ?>">Add to Wishlist</button>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    event.stopPropagation();
                    const hotelId = this.getAttribute('data-hotel-id');
                    const hotelName = this.getAttribute('data-hotel-name');
                    const hotelPrice = this.getAttribute('data-hotel-price');
                    const hotelImage = this.getAttribute('data-hotel-image');

                    fetch('add_to_cart.php', {
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
                                // Optional: alert or update UI to show item added to cart
                            } else {
                                // Optional: alert or show error message
                            }
                        });
                });
            });
        });
    </script>

     <!-- <script src="../public/JS/collections.js"></script> -->

    <!-- <script>
        $(document).ready(function() {
            $('.filter-select').change(function() {
                var formId = $(this).data('form-id');
                $('#' + formId).submit();
            });
        });
    </script> -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
<footer>
    <?php include "footer.php"; ?>
</footer>

</html>
