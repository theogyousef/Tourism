<script>
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<?php
require_once '../controller/usercontroller.php';
$usercontroller = new usercontroller();

if (!empty($_SESSION["id"])) {
    $id = $_SESSION["id"];
    $conn = $usercontroller->getConn();
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

include "adminnav.php";


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />


    <title>Admin panel</title>
    <style>
        <?php include "../public/CSS/adminDasboard.css" ?>
    </style>

</head>


<body>
    <div class="container">
        <div class="main" id="users">
            <div class="cards">

                <div class="card">
                    <div class="card-content">
                        <div class="number">
                            <?php
                            $sql = "SELECT * from bookings ";
                            $resultbooking = mysqli_query($conn, $sql);
                            $counterbooking = 0;
                            while ($row = mysqli_fetch_assoc($resultbooking)) {
                                $counterbooking++;
                            }
                            echo $counterbooking ?>
                        </div>
                        <div class="card-name">Total bookings </div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-link"></i>
                    </div>
                </div>



            </div>


            <div class="search-container">
                <input type="text" id="searchInput" placeholder="Search for users">
                <button class="search-button" style="background-color: black;">Search</button>
            </div>


            <div id="searchResult"></div>


            <div class="container-fluid">
                <table class="table custom-table">

                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>user name</th>
                            <th>flight Departure</th>
                            <th>flight Arrival</th>
                            <th>Hotel </th>
                            <th>Date</th>
                            <th>hotel ID</th>
                            <th>flight ID</th>
                            <th>status</th>
                            <th>Edit</th>
                            <th>Delete</th>
                           

                        </tr>

                    </thead>

                    <tbody>



                        <?php

                        echo "<tr>
        <td colspan='9'style='padding-top: 0px ;padding-bottom: 0px;padding-right: 0px;padding-left: 0px;'><div style='margin-left: -55px;'  id='searchresulte'></div></td>
      </tr>";
      $sql = "SELECT b.ID AS booking_id, b.status , b.user_id, b.flightID, b.hotelID, u.id, u.firstname, u.lastname, f.flight_dep, f.flight_arr, f.eco_price, f.flight_day, h.name AS hotel_name, h.price, h.duration
      FROM bookings b
      JOIN flights f ON b.flightID = f.id
      JOIN users u ON b.user_id = u.id
      JOIN hotels h ON b.hotelID = h.ID
      ";

                        $resultbookings = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($resultbookings)) {

                        
                                echo " <tr>
<td>" . $row["booking_id"] . "</td>
<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>
<td> " . $row["flight_dep"]  . "</td>
<td> " . $row["flight_arr"]  . "</td>
<td> " . $row["hotel_name"]  . "</td>
<td> " . $row["flight_day"]  . "</td>
<td> " . $row["hotelID"]  . "</td>
<td> " . $row["flightID"]  . "</td>
"; ?>
<?php if ($row['status'] == 1) {
    echo "<td style='color:green;'> Active </td>";
} else if ($row['status'] == 0) {
    echo "<td style='color:red;'> Cancelled </td>";
} ?>
<?php echo "
<td>  <a href='editbooking?id=" . $row["booking_id"] . "' style='color: orange;'> <span class='fas fa-edit'></span> </a> </td>
<td> <a href='deletebooking?id=" . $row["booking_id"] . "' style='color: red;'> <span class='fas fa-trash-alt'></span> </a>  </td>


</tr>";
                         
                            }
                        
                        ?>

                    </tbody>

                </table>
            </div>


        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.5.1/dist/chart.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="../public/JS/admindasboard.js"></script>
    <script src="../public/JS/adminSearch.js"></script>

</body>

</html>