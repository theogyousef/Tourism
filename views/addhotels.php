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

if (isset($_POST["addhotel"])) {
    $AdminFunctions->addhotel();
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

                    <h1>ADD HOTEL</h1>
                    <form method="POST" action="" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="stock">Select a Governorate:</label>
                            <select class="form-control" id="governorate" name="governorate">
                                <option value="" disabled selected> </option>
                                <option value="Cairo">Cairo (Al Qahirah)</option>
                                <option value="Giza">Giza (Al Jizah)</option>
                                <option value="Alexandria">Alexandria (Al Iskandariyah)</option>
                                <option value="Qalyubia">Qalyubia (Al Qalyubiyah)</option>
                                <option value="Port Said">Port Said (Bur Sa'id)</option>
                                <option value="Suez">Suez (As Suways)</option>
                                <option value="Ismailia">Ismailia (Al Isma'iliyah)</option>
                                <option value="Damietta">Damietta (Dumyat)</option>
                                <option value="Dakahlia">Dakahlia (Ad Daqahliyah)</option>
                                <option value="Sharqia">Sharqia (Ash Sharqiyah)</option>
                                <option value="Kafr El Sheikh">Kafr El Sheikh (Kafr ash Shaykh)</option>
                                <option value="Gharbia">Gharbia (Al Gharbiyah)</option>
                                <option value="Monufia">Monufia (Al Minufiyah)</option>
                                <option value="Beheira">Beheira (Al Buhayrah)</option>
                                <option value="Faiyum">Faiyum (Al Fayyum)</option>
                                <option value="Beni Suef">Beni Suef (Bani Suwayf)</option>
                                <option value="Minya">Minya (Al Minya)</option>
                                <option value="Asyut">Asyut (Asyut)</option>
                                <option value="Sohag">Sohag (Suhaj)</option>
                                <option value="Qena">Qena (Qina)</option>
                                <option value="Luxor">Luxor (Al Uqsur)</option>
                                <option value="Aswan">Aswan (Aswan)</option>
                                <option value="Red Sea">Red Sea (Al Bahr al Ahmar)</option>
                                <option value="New Valley">New Valley (Al Wadi al Jadid)</option>
                                <option value="Matruh">Matruh (Matruh)</option>
                                <option value="North Sinai">North Sinai (Shamal Sina)</option>
                                <option value="South Sinai">South Sinai (Janub Sina)</option>
                                <option value="Sharm El Sheikh">Sharm El Sheikh </option>

                            </select>


                        </div>



                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="text" class="form-control" name="price" required>
                        </div>
                     
                        <div class="mb-3">
                            <label for="newProductImage" class="form-label">Image</label>
                            <input type="file" class="form-control" id="newProductImage"
                                accept="image/png, image/gif, image/jpeg , image/webp" name="file" required>
                        </div>
                    
                        <div class="mb-3">
                            <input type="submit" name="addhotel" value="ADD Hotel"
                                style="background-color: #007BFF; color: #fff; padding: 10px 20px; border: none; cursor: pointer;">
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>