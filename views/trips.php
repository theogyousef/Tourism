<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trips</title>
    <link rel="stylesheet" href="../public/flights.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>

<body>
    <header>
        <?php include "header.php"; ?>
        <style>
            <?php include "../public/css/trips.css"; ?>
        </style>
    </header>
    <div class="container mt-4">
        <h1>Trips Collection</h1>

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
    <div class="container products-carousel" style="margin-top: 5px;">
        <div class="container py-4">
            <div class="row">
                <div class="col-12">
                    <div class="trip-card">
                        <img src="../public/photos/hotelPhotos/hilton-alexandria-corniche.jpg" alt="Hotel" class="hotel-image">
                        <div class="trip-details">
                            <div class="trip-info">
                                <h5>Best Western Plus</h5>
                                <p class="label-available">Available - $1,234 per night</p>
                                <p>Convenient for shopping - Too noisy</p>
                            </div>
                            <div class="flight-info">
                                <h5><i class="bi bi-airplane-fill"></i> Flight Details</h5>
                                <p><strong>Depart:</strong> 04:45 - CAI</p>
                                <p><strong>Arrive:</strong> 17:00 - FRA</p>
                                <p>1 stop - Via FCO</p>
                                <span class="price">2,500 EGP</span>
                                <button class="btn mitur position-absolute rounded-pill" style="margin-left: 120px; background-color: #0B2545; color: white; padding: 5px 10px;" id="book">
                                    BOOK NOW
                                </button>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <footer>
        <?php include "footer.php"; ?>
    </footer>
</body>
<script>
    <?php include "../public/js/trips.js" ?>
</script>

</html>