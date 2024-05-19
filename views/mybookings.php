<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../model/fetchModle.php';
require_once '../controller/usercontroller.php';
$usercontroller = new usercontroller();
$fetchModle = new fetchModle();
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
                    <th scope="col">Hotel</th>
                    <th scope="col">Departure</th>
                    <th scope="col">Arrival</th>
                    <th scope="col">Date</th>
                    <th scope="col">Price</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>

                <?php
                $id = $_SESSION["id"];
                $sql = "SELECT b.ID AS booking_id, b.user_id, b.flightID, b.hotelID, b.status, u.id, u.firstname, u.lastname, f.flight_dep, f.flight_arr, f.eco_price, f.flight_day, h.name AS hotel_name, h.price, h.duration
 FROM bookings b
 JOIN flights f ON b.flightID = f.id
 JOIN users u ON b.user_id = u.id
 JOIN hotels h ON b.hotelID = h.ID where b.user_id = '$id';
 ";

                $resultbookings = mysqli_query($conn, $sql);


                if (mysqli_num_rows($result) > 0) {
                    $bookings = mysqli_fetch_all($resultbookings, MYSQLI_ASSOC);
                }
                if (!empty($bookings)) :
                    foreach ($bookings as $booking) :
                        $total_price =  $booking['price'] +  $booking['eco_price'];

                ?>
                        <tr>
                            <th scope="row"><?php echo $booking['booking_id'] ?></th>
                            <td><?php echo $booking['hotel_name'] ?>/td>
                            <td><?php echo $booking['flight_dep'] ?></td>
                            <td><?php echo $booking['flight_arr'] ?></td>
                            <td><?php echo $booking['flight_day'] ?></td>
                            <td><?php echo $total_price ?></td>
                            <?php if ($booking['status'] == 1) {
                                echo "<td style='color:green;'> Active </td>";
                            } else if ($booking['status'] == 0) {
                                echo "<td style='color:red;'> Cancelled </td>";
                            } ?>
                            <td>
                                <button class="btn custom-btn">Cancel</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No products found.</p>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php include "footer.php" ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</body>