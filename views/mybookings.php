<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php

include "header.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Egypt Tourism</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        <?php include "../public/css/mybookings.css" ?>
    </style>

</head>

<body>
<div class="container mt-5">
        <h2 style="color: #13315C;">My Bookings</h2>
        <div class="custom-line" style="margin-top: 25px; margin-bottom: 15px;"></div>  
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Destination</th>
                    <th scope="col">Dates</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Pyramids of Giza</td>
                    <td>2024-06-01 to 2024-06-05</td>
                    <td>EGP 500</td>
                    <td>Confirmed</td>
                    <td>
                        <button class="btn custom-btn">View</button>
                        <button class="btn custom-btn">Cancel</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Pyramids of Giza</td>
                    <td>2024-06-01 to 2024-06-05</td>
                    <td>EGP 500</td>
                    <td>Confirmed</td>
                    <td>
                        <button class="btn custom-btn">View</button>
                        <button class="btn custom-btn">Cancel</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Pyramids of Giza</td>
                    <td>2024-06-01 to 2024-06-05</td>
                    <td>EGP 500</td>
                    <td>Confirmed</td>
                    <td>
                        <button class="btn custom-btn">View</button>
                        <button class="btn custom-btn">Cancel</button>
                    </td>
                </tr>
                <tr>
                    <th scope="row">1</th>
                    <td>Pyramids of Giza</td>
                    <td>2024-06-01 to 2024-06-05</td>
                    <td>EGP 500</td>
                    <td>Confirmed</td>
                    <td>
                        <button class="btn custom-btn">View</button>
                        <button class="btn custom-btn">Cancel</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>