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


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    <link rel="stylesheet" href="../public/CSS/adminDasboard.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>


    <title>Admin panel</title>
    <style>
        <?php include "../public/CSS/adminDasboard.css" ?>
    </style>

</head>


<body>

    <div class="container">

        <div class="topbar">
            <div class="logo">
                <h2>Tourism</h2>
            </div>



            <div class="user">
                <img src="<?php echo $row['profilepicture'] ?>" alt="">
            </div>

        </div>
        <!-- Sidebar -->

        <div class="d-grid gap-2 col-6">
            <form method="post">
                <button name="tsales" class="btn btn-primary" type="submit"> Sales Report</button>
            </form>
        </div>

        <div class="sidebar">
            <ul>
                <li class="active" id="dashboard">
                    <a href="admindashboard">
                        <i class="fas fa-th-large"></i>
                        <div>Dashboard</div>
                    </a>
                </li>

                <!-- <li class="dropdown" id="photos">
                    <a href="photoselector">
                        <i class="fas fa-images"></i>
                        <div>Photos manager</div>
                    </a>

                </li> -->

                <li class="dropdown" id="users">
                    <a href="users">
                        <i class="fas fa-users"></i>
                        <div>Users</div>
                    </a>
                    <div class="dropdown-content">

                        <a href="adduser">Add user</a>



                    </div>
                </li>
                <li class="dropdown" id="products">
                    <a href="admintrips">
                        <i class="fas fa-suitcase"></i>
                        <div>Trips</div>
                    </a>
                    <div class="dropdown-content">
                        <a href="addtrip">Add Trip</a>
                        <!-- <a href="addoption">Add Product Option</a>
                        <a href="addsale">Add Product Sale</a>
                        <a href="addvaluetoOP"> Add Value Option</a> -->
                    </div>
                </li>
                <li class="dropdown" id="products">
                    <a href="adminflights">
                        <i class="fas fa-plane"></i>
                        <div>flights</div>
                    </a>
                    <div class="dropdown-content">
                        <a href="addflight">Add flight</a>
                        <!-- <a href="addoption">Add Product Option</a>
                        <a href="addsale">Add Product Sale</a>
                        <a href="addvaluetoOP"> Add Value Option</a> -->
                    </div>
                </li>
                <li class="dropdown" id="products">
                    <a href="adminhotels">
                        <i class="fas fa-hotel"></i>
                        <div>Hotels</div>
                    </a>
                    <div class="dropdown-content">
                        <a href="addhotels">Add hotel</a>
                        <!-- <a href="addoption">Add Product Option</a>
                        <a href="addsale">Add Product Sale</a>
                        <a href="addvaluetoOP"> Add Value Option</a> -->
                    </div>
                </li>
                <!-- <li class="dropdown" id="orders">
                    <a href="Adminreviews">
                        <i class="fas fa-inbox"></i>
                        <div>reviews</div>
                    </a>

                </li> -->

                <!-- <li class="dropdown" id="products">
                    <a href="products">
                        <i class="fas fa-dumbbell"></i>
                        <div>Reports</div>
                    </a>
                    <div class="dropdown-content">
                        <form method="post">
                            <a href="tsales">Total Sales</a>
                        </form>
                        <a href="msales">Monthly Sales</a>
                        <a href="qsales">Quarterly Sales</a>
                        <a href="ysales">Yearly Sales</a>
                    </div>
                </li> -->


                <li>
                    <a href="profilesettings">
                        <i class="fas fa-cog"></i>
                        <div>Profile Settings</div>
                    </a>
                </li>


                <li>
                    <a href="index">
                        <i class="fas fa-home"></i>
                        <div>Home</div>
                    </a>
                </li>
            </ul>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
        <script src="../public/JS/admindasboard.js"></script>

    </div>

    </div>

</body>

</html>