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
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
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
                            $sql = "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id ";
                            $resultuser = mysqli_query($conn, $sql);

                            $counteruser = -1;
                            while ($row = mysqli_fetch_assoc($resultuser)) {
                                $counteruser++;
                            }
                            echo $counteruser ?>
                        </div>
                        <div class="card-name">Total users </div>
                    </div>
                    <div class="icon-box">
                        <i class="fas fa-users"></i>
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
                            <th>name</th>
                            <th>email</th>
                            <th>Admin</th>
                            <th>Deactivated</th>
                            <th>Edit</th>
                            <th>Delete</th>
                            <th>make user</th>
                            <th>make admin</th>

                        </tr>

                    </thead>

                    <tbody>



                        <?php

                        echo "<tr>
        <td colspan='9'style='padding-top: 0px ;padding-bottom: 0px;padding-right: 0px;padding-left: 0px;'><div style='margin-left: -55px;'  id='searchresulte'></div></td>
      </tr>";
                        $sql2 = "SELECT a.*, p.*, u.* FROM addresses a JOIN permissions p ON a.user_id = p.user_id JOIN users u ON a.user_id = u.id  ";
                        $resultusers = mysqli_query($conn, $sql2);

                        while ($row = mysqli_fetch_assoc($resultusers)) {

                            if ($row["admin"] == 1) {
                                $admin = "Admin";
                            } elseif ($row["admin"] == 0) {
                                $admin = " ";
                            }

                            if ($row["deactivated"] == 1) {
                                $deactivated = "deactivated";
                            } elseif ($row["deactivated"] == 0) {
                                $deactivated = " ";
                            }


                            if ($row["guest"] != 1) {
                                echo " <tr>
<td>" . $row["id"] . "</td>
<td>" . $row["firstname"] . " " . $row["lastname"] . "</td>
<td>" . $row["email"] . "</td>
<td> " . $admin . "</td>
<td> " . $deactivated . "</td>
<td>  <a href='edituser?id=" . $row["id"] . "' style='color: orange;'> <span class='fas fa-edit'></span> </a> </td>
<td> <a href='deleteuser?id=" . $row["id"] . "' style='color: red;'> <span class='fas fa-trash-alt'></span> </a>  </td>
<td>  <a href='makeuser?id=" . $row["id"] . "' style='color: green;'> <span class='fas fa-user'></span> </a> </td>
<td>  <a href='makeadmin?id=" . $row["id"] . "' style='color: black;'> <span class='fas fa-user-shield'></span> </a> </td>

</tr>";
                            }
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