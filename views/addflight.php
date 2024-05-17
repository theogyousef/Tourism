<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../includes/config.php';
require_once '../includes/Dbh.php';
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

if (isset($_POST["addflight"])) {
    $AdminFunctions->addflight();
}

include "adminnav.php";

$dbh = new Dbh();
$sql = "SELECT * FROM cities";
$result = mysqli_query($conn, $sql);
$cities = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cities[] = $row['city_name'];
    }
}

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
    <!-- Add flight -->
    <div class="main" id="addflight">
        <div class="formcards">
            <div class="formcard">
                <div class="card-content form-container">
                    <h1>ADD FLIGHT</h1>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Departure Time</label>
                            <input type="time" class="form-control" name="dept_time" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Arrival Time</label>
                            <input type="time" class="form-control" name="arr_time" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Economy Price</label>
                            <input type="text" class="form-control" name="eco_price" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Price</label>
                            <input type="text" class="form-control" name="bus_price" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Departure City</label>
                            <select class="form-control" name="flight_dep" required>
                            <option value="" disabled selected> </option>
                            <?php
                                foreach ($cities as $city) {
                                    echo "<option value='" . $city . "'>" . $city . "</option>";
                                }?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Arrival City</label>
                            <select class="form-control" name="flight_arr" required>
                            <option value="" disabled selected> </option>
                            <?php
                                foreach ($cities as $city) {
                                    echo "<option value='" . $city . "'>" . $city . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                          <label class="form-label">Departure Date</label>
                          <input type="date" class="form-control" name="flight_day" required>
                        </div>

                        
                        <div class="mb-3">
                            <input type="submit" name="addflight" value="ADD FLIGHT"
                                style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
