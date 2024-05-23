<?php
require_once '../controller/AdminFunctions.php';
$AdminFunctions = new AdminFunctions();

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $conn = $AdminFunctions->getConn();
    $result = mysqli_query($conn, "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id WHERE a.user_id = '$id' AND u.id = '$id';");
    $row = mysqli_fetch_assoc($result);
} else {
    header("Location: login");
}

if ($row["admin"] != 1) {
    header("Location: index");
}

if ($row["guest"] == 1) {
    header("Location: login");
}

if (isset($_POST["addbooking"])) {

    $AdminFunctions->addbooking();
}

$conn = $AdminFunctions->getConn();

// Fetch hotels
$sql = "SELECT * FROM hotels";
$result = mysqli_query($conn, $sql);
$hotels = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $hotels[] = ['ID' => $row['ID'], 'name' => $row['name'], 'location' => $row['location']];
    }
}

// Fetch flights
$sql2 = "SELECT * FROM flights";
$result2 = mysqli_query($conn, $sql2);
$flights = [];
if (mysqli_num_rows($result2) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $flights[] = ['id' => $row['id'], 'flight_dep' => $row['flight_dep'], 'flight_arr' => $row['flight_arr']];
    }
}

// Fetch users
$sql3 = "SELECT * FROM users";
$result3 = mysqli_query($conn, $sql3);
$users = [];
if (mysqli_num_rows($result3) > 0) {
    while ($row = mysqli_fetch_assoc($result3)) {
        if ($row["firstname"] != 'Guest') {
            $users[] = ['id' => $row['id'], 'firstname' => $row['firstname'], 'lastname' => $row['lastname']];
        }
    }
}

include "adminnav.php";
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <title>Admin panel</title>
    <style>
        <?php include "../public/CSS/adminDasboard.css" ?>
    </style>
</head>

<div class="container">
    <!-- Add product  -->
    <div class="main" id="addproduct">
        <div class="formcards">
            <div class="formcard">
                <div class="card-content form-container">
                    <h1>ADD Booking</h1>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="userid">Select a user:</label>
                            <select class="form-control" name="userid" required>
                                <option value="" disabled selected> </option>
                                <?php foreach ($users as $user): ?>
                                    <option value="<?php echo $user['id']; ?>">
                                        <?php echo $user['id'] . ' - ' . $user['firstname'] . ' ' . $user['lastname']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="hotel">Select a hotel:</label>
                            <select class="form-control" name="hotel" required>
                                <option value="" disabled selected> </option>
                                <?php foreach ($hotels as $hotel): ?>
                                    <option value="<?php echo $hotel['ID']; ?>">
                                        <?php echo $hotel['ID'] . ' - ' . $hotel['name'] . ' (' . $hotel['location'] . ')'; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="flight">Select a flight:</label>
                            <select class="form-control" name="flight" required>
                                <option value="" disabled selected> </option>
                                <?php foreach ($flights as $flight): ?>
                                    <option value="<?php echo $flight['id']; ?>">
                                        <?php echo $flight['id'] . ' - ' . $flight['flight_dep'] . ' to ' . $flight['flight_arr']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <input type="submit" name="addbooking" value="ADD booking"
                                style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
