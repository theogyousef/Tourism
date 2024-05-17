<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

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
if (isset($_POST["updateproduct"])) {
    $AdminFunctions->updatehotel();
}

if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    $sql = "SELECT * FROM hotels WHERE id = $productId";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $productDetails = mysqli_fetch_assoc($result);


    } else {
        echo '<p>No product details found.</p>';
    }
} else {
    echo '<p>Product ID is not provided.</p>';
}

$dbh = new Dbh();
$sql = "SELECT * FROM cities";
$result = mysqli_query($conn, $sql);
$cities = [];
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $cities[] = $row['city_name'];
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
    <link rel="stylesheet" href="../public/CSS/adminDasboard.css">


    <title>Admin panel</title>
    <style>
        <?php include "../public/CSS/adminDasboard.css" ?>
    </style>

</head>


<div class="container">



    <div class="main" id="editproduct">
        <div class="formcards">
            <div class="formcard">
                <div class="card-content form-container">

                    <h1>Edit Hotel</h1>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">ID</label>
                            <input type="text" class="form-control" name="id" required
                                value="<?php echo $productDetails['ID'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required
                                value="<?php echo $productDetails['name'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" name="price" required
                                value="<?php echo $productDetails['price'] ?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Duration in nights</label>
                            <input type="text" class="form-control" name="duration" required
                                value="<?php echo $productDetails['duration'] ?>">
                        </div>
                        <div class="mb-3">
                            <label for="stock">Select a location:</label>
                            <select class="form-control" name="location" required>
                            <option value="<?php echo $productDetails['location'] ?>" selected>
                                    <?php echo $productDetails['location'] ?>
                                </option>                            <?php
                                foreach ($cities as $city) {
                                    echo "<option value='" . $city . "'>" . $city . "</option>";
                                }?>
                            </select>  
                        </div>
            
                   
                   
                        <div class="mb-3">
                            <input type="submit" name="updateproduct" value="Update Hotel"
                                style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">
                        </div>
                    </form>
                   
                </div>
            </div>
        </div>
    </div>
</div>
</body>