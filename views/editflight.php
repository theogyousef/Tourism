<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../controller/AdminFunctions.php';
require_once '../includes/config.php';
require_once '../includes/Dbh.php';
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

if (isset($_POST["updateflight"])) {
    $AdminFunctions->updateFlight();
}

if (isset($_GET['id'])) {
    $flightId = $_GET['id'];

    $sql = "SELECT * FROM flights WHERE id = $flightId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $flightDetails = mysqli_fetch_assoc($result);
    } else {
        echo '<p>No flight details found.</p>';
    }
} else {
    echo '<p>Flight ID is not provided.</p>';
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
    <link rel="stylesheet" href="../public/CSS/adminDasboard.css">
    <title>Admin panel</title>
    <style>
        <?php include "../public/CSS/adminDasboard.css" ?>
    </style>
</head>

<div class="container">
    <div class="main" id="editflight">
        <div class="formcards">
            <div class="formcard">
                <div class="card-content form-container">
                    <h1>Edit Flight</h1>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" name="id" required
                                value="<?php echo $flightDetails['id'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Departure Time</label>
                            <input type="time" class="form-control" name="dept_time" required
                                value="<?php echo $flightDetails['dept_time'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Arrival Time</label>
                            <input type="time" class="form-control" name="arr_time" required
                                value="<?php echo $flightDetails['arr_time'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Economy Price</label>
                            <input type="text" class="form-control" name="eco_price" required
                                value="<?php echo $flightDetails['eco_price'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Business Price</label>
                            <input type="text" class="form-control" name="bus_price" required
                                value="<?php echo $flightDetails['bus_price'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Departure City</label>
                            <!-- <input type="text" class="form-control" name="flight_dep" required
                                value=""> -->
                            <select class="form-control" name="flight_dep" required>
                                <option value="<?php echo $flightDetails['flight_dep'] ?>" selected>
                                    <?php echo $flightDetails['flight_dep'] ?>
                                </option> <?php
                                foreach ($cities as $city) {
                                    echo "<option value='" . $city . "'>" . $city . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Arrival City</label>
                            <select class="form-control" name="flight_arr" required>
                                <option value="<?php echo $flightDetails['flight_arr'] ?>" selected>
                                    <?php echo $flightDetails['flight_arr'] ?>
                                </option> <?php
                                foreach ($cities as $city) {
                                    echo "<option value='" . $city . "'>" . $city . "</option>";
                                } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Departure Date</label>
                            <input type="date" class="form-control" name="flight_day" required
                                value="<?php echo $flightDetails['flight_day']; ?>">
                        </div>


                        <div class="mb-3">
                            <input type="submit" name="updateflight" value="Update Flight"
                                style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>