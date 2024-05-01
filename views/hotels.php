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
            <!-- Product cards will be dynamically generated here -->
            <div class="col-md-4">
                <div class="card mb-4 product-card">
                    <img src="../public/photos/JW_Marriott.jpg" class="card-img-top" alt="Hotel Image">
                    <div class="card-body">
                        <h5 class="card-title">JW Marriott</h5>
                        <p class="card-text">Perched gracefully by the Nile, JW Marriott Egypt epitomizes luxury,
                            offering a refined escape where every detail is meticulously curated for an unparalleled experience.</p>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">Price: 4.5K per night</li>
                            <li class="list-group-item">Availability: In Stock</li>
                            <li class="list-group-item">Category: Luxury</li>
                        </ul>
                        <div class="product-actions mt-3">
                            <button class="btn btn-primary">Book Now</button>
                            <button class="btn btn-secondary">Add to Wishlist</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>



    <!-- <script src="../public/JS/collections.js"></script> -->

    <!-- <script>
        $(document).ready(function() {
            $('.filter-select').change(function() {
                var formId = $(this).data('form-id');
                $('#' + formId).submit();
            });
        });
    </script> -->
</body>
<footer>
    <?php include "footer.php"; ?>
</footer>

</html>