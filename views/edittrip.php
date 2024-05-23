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
    $AdminFunctions->updatetrip();
}

if (isset($_GET['id'])) {
    $tripid = $_GET['id'];

    $sql = "SELECT * FROM trips WHERE id = $tripid";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $tripdetails = mysqli_fetch_assoc($result);
    } else {
        echo '<p>No flight details found.</p>';
    }
} else {
    echo '<p>Flight ID is not provided.</p>';
}

include "adminnav.php";

$dbh = new Dbh();
$sql = "SELECT * FROM hotels";
$result = mysqli_query($conn, $sql);
$hotels = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $hotels[] =$row['ID'] . ' - ' . $row['name'] .'  (' . $row['location'] . ')';
    }
}

$sql2 = "SELECT * FROM flights";
$result2 = mysqli_query($conn, $sql2);
$flights = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result2)) {
        $flights[] = $row['id'] . ' - ' .$row['flight_dep'] . ' to  ' . $row['flight_arr'] ;
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
<div class="main" id="addproduct">
        <div class="formcards">
            <div class="formcard">
                <div class="card-content form-container">

                    <h1>Edit Trip</h1>
                    <form method="POST" action="" enctype="multipart/form-data">
                    <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" name="ID" value="<?php echo $tripdetails['ID']; ?>"required>
                        </div> 
                    
                    <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" value="<?php echo $tripdetails['name']; ?>"required>
                        </div>

                        <div class="mb-3">
                            <label for="stock">Select an hotel:</label>
                            <select class="form-control" name="hotel" required>
                            <option value="" disabled selected> </option>
                            <option value="<?php echo $tripdetails['hotelID'] ?>" selected>
                                    <?php echo $tripdetails['hotelID'] ?>
                                </option>  <?php
                                foreach ($hotels as $hotel) {
                                    echo "<option value='" . $hotel . "'>" . $hotel . "</option>";
                                }?>
                            </select>  


                        </div>

                        <div class="mb-3">
                            <label for="stock">Select a flight :</label>
                            <select class="form-control" name="flight" required>
                            <option value="" disabled selected> </option>
                         <option value="<?php echo $tripdetails['flightID'] ?>" selected>
                                    <?php echo $tripdetails['flightID'] ?>
                                </option>  <?php
                                foreach ($flights as $flight) {
                                    echo "<option value='" . $flight . "'>" . $flight . "</option>";
                                }?>
                            </select>  


                        </div>
                        <div class="mb-3">
                            <input type="submit" name="updateflight" value="update trip"
                                style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>